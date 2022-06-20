<?php

/**
 * Handles exceptions within the HTML areas of the webpage.
 * Will display a 500 status code and 'Internal server error' message along with details of the error, file and line which is causing the error.
 *
 * @author Ethan Borrill W18001798
 * 
 * @param $e - Contains the relevant information to be displayed to produce the exception message.
 */
function exceptionHandlerHTML($e) {
    echo "<p>internal server error! (Status 500)</p>";
    if (DEVELOPMENT_MODE) {
        echo "<p>";
        echo "500: " .  $e->getMessage();
        echo "<br>File: " . $e->getFile();
        echo "<br>Line: " . $e->getLine();
        echo "</p>";
    }
}