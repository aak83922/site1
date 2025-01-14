<?php
/* This file doesn't load WordPress, it simple increment counters for posts in wp-content/cache/fv-tracker/{tag}-{site id}.data */

Class FvPlayerTrackerWorker {

  private $wp_content = false;
  private $cache_path = false;
  private $cache_filename = false;
  private $video_id = false;
  private $post_id = false;
  private $player_id = false;
  private $user_id = 0;
  private $watched = false;
  private $tag = false;

  private $file = false;

  function __construct() {

    if(
      !isset( $_REQUEST['blog_id'] ) ||
      !isset( $_REQUEST['tag'] ) ||
      !isset( $_REQUEST['video_id'] ) && !isset( $_REQUEST['watched'] )
    ){
      die( "Error: missing arguments!" );
    }

    $blog_id = intval($_REQUEST['blog_id']);
    $tag = preg_replace( '~[^a-z]~', '', substr( $_REQUEST['tag'], 0, 16 ) );
    $this->tag = $tag;

    $this->wp_content = dirname( dirname( dirname( dirname( __FILE__ ) ) ) );
    $this->cache_path = $this->wp_content."/fv-player-tracking";
    $this->cache_filename = "{$tag}-{$blog_id}.data";

    $this->video_id = !empty($_REQUEST['video_id']) ? intval($_REQUEST['video_id']) : false;
    $this->player_id = !empty($_REQUEST['player_id']) ? intval($_REQUEST['player_id']) : false;
    $this->post_id = !empty($_REQUEST['post_id']) ? intval($_REQUEST['post_id']) : false;
    $this->user_id = intval($_REQUEST['user_id']);
    $this->watched = !empty($_REQUEST['watched']) ? $_REQUEST['watched'] : false;

    // TODO: Verify some kind of signature here

    $this->checkCacheFile();
  }

  /**
   * Check and initialize cache file
   * @return void
   */
  function checkCacheFile() {
    $full_path = $this->cache_path . "/" . $this->cache_filename;

    //cache file exists?
    if( file_exists( $full_path ) ) return;

    //cache directory exists
    if( !file_exists( $this->cache_path ) ){
      //create dir
      //todo: actually don't create it, if it doesn't exist it should mean the option is not enabled and this script shouldn't write anything!
      if( !mkdir( $this->cache_path, 0775, true ) ){
        die("Error: failed to create cache directory.");
      }
    }

    //init file
    touch( $full_path );
  }

  /**
   * Load cache file data, find specific video_id and increment coutner for it
   * @return boolean True when file lock was obtained, this doesn't ensure successful write. Otherwise false is returned
   */
  function incrementCacheCounter() {
    $max_attempts = 3;

    for( $i = 0; $i < $max_attempts; $i++ ){

      if( flock( $this->file, LOCK_EX | LOCK_NB ) ) {

        //increment counter
        $encoded_data = fgets( $this->file );
        $data = false;
        if( $encoded_data ) {
          $data = json_decode( $encoded_data, true );
  
          $json_error = json_last_error();
          if( $json_error !== JSON_ERROR_NONE ) {
            file_put_contents( $this->wp_content.'/fv-player-track-error.log', date('r')." JSON decode error:\n".var_export( array( 'err' => $json_error, 'data' => $encoded_data ), true )."\n", FILE_APPEND ); // todo: remove
            ftruncate( $this->file, 0 );
            return false;
          }
        }

        if( !$data ) { 
          $data = array();
        }

        if ( 'seconds' === $this->tag ) {
          $this->watched = json_decode( urldecode( $this->watched), true );

          $json_error = json_last_error();
          if( $json_error !== JSON_ERROR_NONE ) {
            file_put_contents( $this->wp_content.'/fv-player-track-error.log', date('r')." JSON decode error for watched:\n".var_export( array( 'err' => $json_error, 'data' => $this->watched ), true )."\n", FILE_APPEND ); // todo: remove
            return false;
          }

          foreach ( $this->watched as $player_id => $players ) {

            foreach( $players as $post_id => $videos ) {

              foreach( $videos as $video_id => $seconds ) {

                // Add to the existing JSON data
                $found = false;
                foreach( $data as $index => $item ) {
                  if( $item['video_id'] == $video_id && $item['post_id'] == $post_id && $item['player_id'] == $player_id && $item['user_id'] == $this->user_id ) {
                    $data[$index]['seconds'] = round( $data[$index]['seconds'] + $seconds );
                    $found = true;
                  }
                }

                // New JSON data
                if ( ! $found ) {
                  $data[] = array(
                    'video_id'  => $video_id,
                    'post_id'   => $post_id,
                    'player_id' => $player_id,
                    'user_id'   => $this->user_id,
                    'seconds'   => round($seconds)
                  );
                }
              }
            }
          }

        } else if ( 'play' === $this->tag ) {
          $found = false;
          foreach( $data as $index => $item ) {
            if( $item['video_id'] == $this->video_id && $item['post_id'] == $this->post_id && $item['player_id'] == $this->player_id && $item['user_id'] == $this->user_id ) {
              $data[$index]['play'] += 1;
              $found = true;
              break;
            }
          }

          if( !$found ) {
            $data[] = array(
              'video_id'  => $this->video_id,
              'post_id'   => $this->post_id,
              'player_id' => $this->player_id,
              'user_id'   => $this->user_id,
              'play'      => 1
            );
          }
        }

        $encoded_data = json_encode($data);

        ftruncate( $this->file, 0 );
        rewind( $this->file );
        fputs( $this->file, $encoded_data );

        //UNLOCK
        flock( $this->file, LOCK_UN );
        return true;
      }
      else{
        //wait random interval from 50ms to 100ms
        usleep( rand(50,100) );
      }
    }

    return false;
  }

  /**
   * Main tracker functionality
   * @return void
   */
  function track() {
    $this->file = fopen( $this->cache_path."/".$this->cache_filename, 'r+');

    if( ! $this->incrementCacheCounter() ){
      file_put_contents( $this->wp_content.'/fv-player-track-error.log', date('r') . " flock or other error:\n".var_export($_REQUEST,true)."\n", FILE_APPEND ); // todo: remove
    }

    fclose( $this->file );
  }
}

$fv_player_tracker_worker = new FvPlayerTrackerWorker();
$fv_player_tracker_worker->track();
