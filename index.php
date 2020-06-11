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
for ( $card_number = 1; $card_number <= 20; $card_number++ ) 
{
  $message = '    <div class="memory-card" data-framework=data_"' . $card_number. '">' . PHP_EOL;
  $message .= '      <img class="front-face" src="image/russian/a/1/';
  $message .=  sprintf( '%1$02d', $card_number );
  $message .=  '.jpg" alt="Card number ' . $card_number . ' " />'  . PHP_EOL;
  $message .= '      <img class="back-face" src="image/logo_letsgo.svg" alt="Logo" />';
  $message .= '    </div>';
  echo $message . PHP_EOL . $message;
}
?>
  </section>

  <script src="js/main.js"></script>
</body>
</html>
