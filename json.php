<?php
$game_locations = array
(
   1 => array( 'path' => 'russian/a/1/', 'type' => 'png' ),
   2 => array( 'path' => 'russian/a/2/', 'type' => 'png' ),
   3 => array( 'path' => 'russian/a/3/', 'type' => 'png' ),
   4 => array( 'path' => 'russian/a/4/', 'type' => 'png' ),
   5 => array( 'path' => 'russian/a/5/', 'type' => 'png' ),
   6 => array( 'path' => 'russian/a/6/', 'type' => 'png' ),
   7 => array( 'path' => 'russian/a/7/', 'type' => 'png' ),
   8 => array( 'path' => 'russian/b/1/', 'type' => 'png' ),
   9 => array( 'path' => 'russian/b/2/', 'type' => 'png' ),
  10 => array( 'path' => 'russian/b/3/', 'type' => 'png' ),
  11 => array( 'path' => 'russian/b/4/', 'type' => 'png' ),
  12 => array( 'path' => 'russian/b/5/', 'type' => 'png' ),
  13 => array( 'path' => 'russian/b/6/', 'type' => 'png' ),
  14 => array( 'path' => 'russian/b/7/', 'type' => 'png' ),
  15 => array( 'path' => 'russian/c/1/', 'type' => 'png' ),
  16 => array( 'path' => 'russian/c/2/', 'type' => 'png' ),
  17 => array( 'path' => 'russian/c/3/', 'type' => 'jpg' ),
  18 => array( 'path' => 'russian/c/4/', 'type' => 'png' ),
  19 => array( 'path' => 'russian/c/5/', 'type' => 'png' ),
  20 => array( 'path' => 'russian/c/6/', 'type' => 'png' ),
  21 => array( 'path' => 'russian/c/7/', 'type' => 'png' ),
  22 => array( 'path' => 'russian/d/1/', 'type' => 'png' ),
  23 => array( 'path' => 'russian/d/2/', 'type' => 'png' ),
  24 => array( 'path' => 'russian/d/3/', 'type' => 'png' ),
  25 => array( 'path' => 'russian/d/4/', 'type' => 'png' ),
  26 => array( 'path' => 'russian/d/5/', 'type' => 'png' ),
  27 => array( 'path' => 'russian/d/6/', 'type' => 'png' ),
  28 => array( 'path' => 'russian/d/7/', 'type' => 'png' )
);
var_dump($game_locations);
$game_locations_json = json_encode( $game_locations, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES );
var_dump( $game_locations_json );
file_put_contents( "config.json", $game_locations_json );