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
$game_number = intval( $_POST[ "next_game_id" ] );
$game_number++;
$game_locations = array
(
   1 => 'russian/a/1/',
   2 => 'russian/a/2/',
   3 => 'russian/a/3/',
   4 => 'russian/a/4/',
   5 => 'russian/a/5/',
   6 => 'russian/a/6/',
   7 => 'russian/a/7/',
   8 => 'russian/c/1/',
   9 => 'russian/c/2/',
  10 => 'russian/c/3/',
  11 => 'russian/c/4/',
  12 => 'russian/c/5/',
  13 => 'russian/c/6/',
  14 => 'russian/c/7/'
);
if ( !array_key_exists( $game_number, $game_locations ) )
{
  $game_number = 0;
  $button_text = "Geslaagd! Onieuw?";
}
else
{
  $game_location = $game_locations[ $game_number ];
  for ( $card_number = 1; $card_number <= 20; $card_number++ ) 
  {
    $message = '    <div class="memory-card" data-framework=data_"' . $card_number. '">' . PHP_EOL;
    $message .= '      <img class="front-face" src="image/' . $game_location;
    $message .=  sprintf( '%1$02d', $card_number );
    $message .=  '.jpg" alt="Card number ' . $card_number . ' " />'  . PHP_EOL;
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
