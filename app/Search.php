<?php
/**
 * Created by PhpStorm.
 * User: janzaba
 * Date: 2019-06-18
 * Time: 08:56
 */

namespace App;

/**
 * Files are:
 * txt
 *    search_query => value
 *   ...
 *
 */

class Search
{
    // get search results
    public function get($f)
    {
        // wyświetl zapytanie
      $return = "<p>Search results for query: " .
              $_GET['query'] . ".</p>";        // od razu HTML

        // Get the extension off the image filename
        $pieces = explode('.', $f);
        $extension = array_pop($pieces);
        if ($extension == 'txt') {
            $ha = @fopen($f, 'r');
            if($ha){
                while(!feof($ha)) {
                    $buffer = fgets($ha);
                    if($pos = strpos($buffer, $_GET['query'] . " => ") !== FALSE)
                        $matches[] = substr($buffer, $pos + strlen($_GET['query'] . "=> "));
                }
                fclose($ha);
            } else {
                // return Error code
                return 2;
            }


        } else {
            // error
            return 1;
        }

        // process matches into html
        if(isset($matches)) {
            foreach ($matches as $match) {
                $return .= '<p>' . trim($match) . '</p>';
            }
        }

        return $return;
    }
}
