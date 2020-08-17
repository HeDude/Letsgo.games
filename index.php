<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//! Checkj if config file exists
$filename = "config.json";
if ( !is_readable( $filename ) )
{
  echo "ERROR: config file is not readable!";
  exit;
}

$config = json_decode
(
    utf8_encode
    (
        file_get_contents( $filename )
    ),
    JSON_OBJECT_AS_ARRAY
);

//! Check if config files contains valid JSON format
if ( !$config || !is_array( $config ) )
{
  echo "ERROR: config file is not a valid UTF8 JSON file!";
  exit;
}

$configuration = $config;

$elements = array( "domain", "level", "playground" );

//! The config file should contain the domains and for each domain the levels and for each level the playgrounds
foreach( $elements as $element )
{
    $list_name = $element . "s";
    if ( !array_key_exists( $list_name, $configuration ) )
    {
      echo "ERROR: config file has no " . $list_name . " as a JSON object (at the correct position)!";
    }
    $configuration_list = $configuration[ $list_name ];

    if ( array_key_exists( $element, $_GET ) && array_key_exists( $_GET[ $element ], $configuration_list ) )
    {
      //! Set a variable with the name of the element and the value passed by the URL
      $$element = htmlspecialchars( $_GET[ $element ] );
    }
    elseif ( array_key_exists( $element, $_POST ) && array_key_exists( $_POST[ $element ], $configuration_list ) )
    {
      //! Set a variable with the name of the element and set it to the posted value
      $$element = htmlspecialchars( $_POST[ $element ] );
    }
    else
    {
        if ( !reset( $configuration_list ) )
        {
            echo "ERROR: config file has no " . $list_name . " specified!";
            exit;
        }
        //! Set a variable with the name of the element and set it to the first value
        $$element = key( $configuration_list );

    }

    //! Determine the next element
    $next_element_name = "next_" . $element;

    while ( key( $configuration_list ) != $$element && key( $configuration_list ) !== null )
    {
        next( $configuration_list );
    }
    if ( next( $configuration_list ) )
    {
         $$next_element_name = key( $configuration_list );
    }
    else
    {
        $$next_element_name = false; 
    }
    
    //! Set a variable for the list with all the info (subarray) of that list
    $$list_name = $configuration[ $list_name ];

    //! Reduce the configuration to the list for the element on a deeper level
    $configuration = $configuration_list[ $$element ];
}

$html_heading  = '    <h1>Memory Game';
$variables_in_url = "?";
foreach( $elements as $element )
{
      $html_heading .= ' - ';
      $html_heading .= '<div class="dropdown">';
      $html_heading .= '    <button class="dropbtn">&nbsp;' . ucfirst( $element ) . ' ' . ucfirst( $$element ) . '&nbsp;</button>';
      $html_heading .= '    <div class="dropdown-content">';
      $list_name = $element . "s";
      foreach ( $$list_name as $list_key => $list_item )
      {
        $html_heading .= '        <a href="' . $_SERVER['PHP_SELF'] . $variables_in_url . "&" . $element . '=' . $list_key . '">' . ucfirst( $list_key ) . '</a>';    
      } 
      $html_heading .= '    </div>';
      $html_heading .= '</div>';
      $variables_in_url .= "&" . $element . "=" . $$element; 
}
$html_heading .= '    </h1>';

//! The memory game section can be loaded woth the element info
$html_section_memory_game  = '    <section class="memory-game">' . PHP_EOL;

//! The default back face of each card can be overruled per domain
if ( array_key_exists( "back-face", $config[ "domains" ][ $domain ] ) )
{
    $back_face = $domains[ $domain ][ "back-face" ];
}
else
{
    $back_face = "image/logo_letsgo.svg";
}

//! The default filename syntax of the images of the cards can be overruled per playground
if ( array_key_exists( "syntax", $playgrounds[ $playground ] ) && is_array( $playgrounds[ $playground ][ 'syntax' ] ) )
{
    $card_syntax = $playgrounds[ $playground ][ 'syntax' ];
}
else
{
    $card_syntax = false;
}

//! The default path of the images of the cards can be overruled per playground
if ( array_key_exists( "path", $playgrounds[ $playground ] ) )
{
    $card_path = $playgrounds[ $playground ][ 'path' ];
}
else
{
    $card_path = 'image/domain/' . $domain . '/' . $level . '/' . $playground . '/';
}

//! The default type (file extension) of the image can be overruled per playground 
if ( array_key_exists( "type", $playgrounds[ $playground ] ) )
{
    $card_image_type = $playgrounds[ $playground ][ 'type' ];
}
else
{
    $card_image_type = "svg";
}

//! 20 matching cards sets must be displayed on the playground. They maybe exact copies or matching copies (key "match" in syntax is defined)
for ( $card_set_number = 1; $card_set_number <= 20; $card_set_number++ ) 
{
    $prefix = "";
    foreach ( array( "original", "match") as $memory_card )
    {
        if ( $card_syntax )
        {
            if ( array_key_exists( $memory_card, $card_syntax )  )
            {
                $prefix = $card_syntax[ $memory_card ];
            }
        }
        $card_filename = $prefix . sprintf( '%1$02d', $card_set_number ) . '.' . $card_image_type;
        $card_file_location = $card_path . $card_filename;      
        $html_section_memory_game .=  '        <div class="memory-card" data-framework=data_' . $card_set_number . '>' . PHP_EOL;
        $html_section_memory_game .= '            <img class="front-face" src="' . $card_file_location . '" alt="Card ' . $card_filename . ' " />'  . PHP_EOL;
        $html_section_memory_game .= '            <img class="back-face" src="' . $back_face . '" alt="Logo" />'  . PHP_EOL;
        $html_section_memory_game .= '        </div>';
    }
}
$html_section_memory_game .= '    </section>';

//! Determine next form action
if ( $next_playground )
{
    $button_text = "Speelveld " . ucfirst( $playground ) . " GEHAALD! Naar volgend speelveld " . ucfirst( $next_playground ) . ".";
    $next_level = $level;
    $next_domain = $domain;
}
elseif( $next_level )
{
    $button_text = "Level " . ucfirst( $level ) . " GEHAALD! Naar volgend level " . ucfirst( $next_level ) . ".";
    $next_playground = false;
    $next_domain = $domain;
}
elseif( $next_domain )
{
    $button_text = "Domein " . ucfirst( $domain ) . " GEHAALD! Naar volgend domein " . ucfirst( $next_domain ) . ".";
    $next_playground = false;
    $next_level = false;
}

//! Define the form
$html_form_next      = '    <form class="next_playground" action="' . $_SERVER['PHP_SELF'] . '" method="POST">' . PHP_EOL;
if ( $next_level )
{
    $html_form_next .= '        <input type="hidden" name="playground" value="' . $next_playground . '">' . PHP_EOL;
}
if ( $next_level )
{
    $html_form_next .= '        <input type="hidden" name="level" value="' . $next_level . '">' . PHP_EOL;
}
if ( $next_level )
{
    $html_form_next .= '        <input type="hidden" name="domain" value="' . $next_domain . '">' . PHP_EOL;
}
$html_form_next     .= '        <input class="next_playground_button" type = "submit" value="' . $button_text . '">' . PHP_EOL;
$html_form_next     .= '    </form>' . PHP_EOL;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Memory - <?php echo ucfirst( $domain ); ?></title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>

<?php
    echo $html_heading . PHP_EOL;
    echo $html_section_memory_game . PHP_EOL;
    echo $html_form_next;
?>
    <script src="js/main.js"></script>
</body>
</html>
