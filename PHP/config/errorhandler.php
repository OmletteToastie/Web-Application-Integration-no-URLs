<?php

/** 
 * Catches errors on the webpage, outputting the error number, name of error, the file with the error 
 * and line within the file where the error is located.
 *
 * @author Ethan Borrill W18001798 
 * 
 * @param int $errno - The error number related to the error.
 * @param string $errstr - Message relating to the error and what is occuring.
 * @param string $errfile - Which file is causing the issue.
 * @param string $errline - The line which is causcing the error in the respective file.
 */
function errorHandler($errno, $errstr, $errfile, $errline) {
  if (($errno != 2 && $errno != 8) || DEVELOPMENT_MODE) {
    throw new Exception("Error Detected: [$errno] $errstr file: $errfile line: $errline", 1);
  }
}