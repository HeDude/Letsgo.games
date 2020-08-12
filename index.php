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
if ( array_key_exists( "game_id", $_POST ) )
{
  $game_id = intval( $_POST[ "game_id" ] );
}
else
{
  $game_id = "russian";
}
if ( array_key_exists( "level_id", $_POST ) )
{
  $level_id = intval( $_POST[ "level_id" ] );
}
else
{
  $level_id = "A";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">

  <title>Memory Game - <?php echo ucfirst( $game_id ); ?> - level <?php echo ucfirst( $level_id ); ?> - scherm <?php echo $game_number; ?></title>

  <link rel="stylesheet" href="css/styles.css">
</head>
<body>
  <h1>Memory Game - <?php echo ucfirst( $game_id ); ?> - level <?php echo ucfirst( $level_id ); ?> - scherm <?php echo $game_number; ?></h1>
  <section class="memory-game">
<?php
$game_number++;
$filename = "config.json";
if ( is_readable( $filename ) )
{
    $config = json_decode
    (
        utf8_encode
        (
            file_get_contents( $filename )
        ),
        JSON_OBJECT_AS_ARRAY
    );
}
else
{
    exit;
}
// var_dump( $config );
// exit;
$game_locations = $config["games"][ $game_id ]["levels"];

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
    $message =  '    <div class="memory-card" data-framework=data_"' . $card_number. '">' . PHP_EOL;
    $message .= '      <img class="front-face" src="image/' . $game_location;
    $message .= sprintf( '%1$02d', $card_number ) . '.' . $game_type . '"';
    $message .= ' alt="Card number ' . $card_number . ' " />'  . PHP_EOL;
    $message .= '      <img class="back-face" src="' . $config["games"]["russian"]["back-face"] . '" alt="Logo" />';
    $message .= '    </div>';
    echo $message . PHP_EOL . $message;
  }
  $button_text = "Volgend scherm";
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
