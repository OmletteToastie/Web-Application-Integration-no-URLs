<?php

/**
 * The Autoloader is used within the webpage in order to call classes from other files 
 * without the requirement of need to utilise code such as require() , require_once() , include() , or include_once() functions.
 * helping to overall improve effciency.
 * 
 * @author Ethan Borrill W18001798
 * 
 * @param string $className - The class within the file.
 */
function autoloader($className) {
    $filename = "src//" . strtolower($className) . ".php";
    $filename = str_replace('\\', DIRECTORY_SEPARATOR, $filename);
    if (is_readable($filename)) {
        include_once $filename;
    } else {
        throw new Exception("File not found: " . $className . "( " . $filename . ")");
    }
}