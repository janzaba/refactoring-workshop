<?php
/**
 * Created by PhpStorm.
 * User: janzaba
 * Date: 2019-06-18
 * Time: 08:56
 */

class Search
{
    // get search results
    public function get($f)
    {
        // wyświetl zapytanie
      echo("<p>Search results for query: " .
              $_GET['query'] . ".</p>");        // od razu HTML

        // Get the extension off the image filename
        $pieces = explode('.', $f);
        $extension = array_pop($pieces);
        if ($extension == 'txt') {
            if ($_GET['query'] == '') {
                // do something
            } else {
                //search in the file
            }
        } else if($extension == 'json') {

        }
    }
}

class DataHelper {

}
