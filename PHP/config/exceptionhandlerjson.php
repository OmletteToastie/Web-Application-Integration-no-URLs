<?php

/**
 * Catches and displays errors and exceptions within the JSON files on the webpage,
 * Will display a 500 status code and 'Internal server error' message along with details of the error, file and line which is causing the error.
 *
 * @author Ethan Borrill W18001798
 * 
 * @param $e - Contains the relevant information to be displayed to produce the exception message.
 */
function exceptionHandlerJSON($e) {
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");

    $output['error'] = "Internal server error! (Status 500)";

    if (DEVELOPMENT_MODE) {
        $output['Message'] = $e->getMessage();
        $output['File'] = $e->getFile();
        $output['Line'] = $e->getLine();
    }

    echo json_encode($output);
}