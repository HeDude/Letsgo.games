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
$game_number = intval( $_POST[ "next_game_id" ] );
$game_number++;
$game_locations = array
(
   1 => array( 'path' => 'russian/a/1/', 'type' => 'jpg' ),
   2 => array( 'path' => 'russian/a/2/', 'type' => 'jpg' ),
   3 => array( 'path' => 'russian/a/3/', 'type' => 'jpg' ),
   4 => array( 'path' => 'russian/a/4/', 'type' => 'jpg' ),
   5 => array( 'path' => 'russian/a/5/', 'type' => 'jpg' ),
   6 => array( 'path' => 'russian/a/6/', 'type' => 'jpg' ),
   7 => array( 'path' => 'russian/a/7/', 'type' => 'jpg' ),
   8 => array( 'path' => 'russian/c/1/', 'type' => 'jpg' ),
   9 => array( 'path' => 'russian/c/2/', 'type' => 'jpg' ),
  10 => array( 'path' => 'russian/c/3/', 'type' => 'jpg' ),
  11 => array( 'path' => 'russian/c/4/', 'type' => 'jpg' ),
  12 => array( 'path' => 'russian/c/5/', 'type' => 'jpg' ),
  13 => array( 'path' => 'russian/c/6/', 'type' => 'jpg' ),
  14 => array( 'path' => 'russian/c/7/', 'type' => 'jpg' )
);
if ( !array_key_exists( $game_number, $game_locations ) )
{
  $game_number = 0;
  $button_text = "Geslaagd! Onieuw?";
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
