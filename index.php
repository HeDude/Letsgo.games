<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">

  <title>Memory Game</title>

  <link rel="stylesheet" href="css/styles.css">
</head>
<body>
  <section class="memory-game">
<?php  
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
if ( array_key_exists( "next_game_id", $_POST ) )
{
  $game_number = intval( $_POST[ "next_game_id" ] );
}
else
{
  $game_number = 0;
}
$game_number++;
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
if ( !array_key_exists( $game_number, $game_locations ) )
{
  $game_number = 0;
  $button_text = "Geslaagd! Opnieuw?";
}
else
{
  $game_location = $game_locations[ $game_number ][ 'path' ];
  $game_type = $game_locations[ $game_number ][ 'type' ];
  for ( $card_number = 1; $card_number <= 20; $card_number++ ) 
  {
    $message = '    <div class="memory-card" data-framework=data_"' . $card_number. '">' . PHP_EOL;
    $message .= '      <img class="front-face" src="image/' . $game_location;
    $message .=  sprintf( '%1$02d', $card_number ) . '.' . $game_type . '"';
    $message .=  ' alt="Card number ' . $card_number . ' " />'  . PHP_EOL;
    $message .= '      <img class="back-face" src="image/logo_letsgo.svg" alt="Logo" />';
    $message .= '    </div>';
    echo $message . PHP_EOL . $message;
  }
  $button_text = "Volgende game";
}
?>
  </section>

  <form class="next_form" action="<?php $_PHP_SELF ?>" method="POST">
      <input type="hidden" name="next_game_id" value="<?php echo $game_number;?>">
      <input class="next_game" type = "submit" / value="<?php echo $button_text;?>">
  </form>
  <script src="js/main.js"></script>
</body>
</html>
