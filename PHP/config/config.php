<?php

/**
 * Config defines the constants used on the webpage, such as the database's used, the basepath for the webpage to use.
 * The secret key used to encrypt users details during authentication is also set here.
 * Several additional classes are also included here to be used for exception and error handling for both HTML and JSON.
 * 
 * @author Ethan Borrill W18001798
 */
define('BASEPATH', ''); /**Sets the basename of the file. */
define('DIS_DATABASE', ''); /**Sets the database to be utilised in the web server */
define('USER_DATABASE', '');
define ('DEVELOPMENT_MODE', true);
define ('SECRET_KEY', '3F53682FA68DFCE82CCCDBD5F28D8'); //Implements the Secret key used to sign JSON Web Tokens.

ini_set('display_errors', DEVELOPMENT_MODE);
ini_set('display_startup_errors', DEVELOPMENT_MODE);

//Connects the autoloader.
include 'config/autoloader.php';
spl_autoload_register("autoloader");

//Connects the errorhandler.
include 'config/errorhandler.php';
set_error_handler("errorHandler");

//Connects the error handlers for both JSON and HTML Web Formats, setting the primary exception handler to JSON.
include 'config/exceptionhandlerhtml.php';
include 'config/exceptionhandlerjson.php';
set_exception_handler("exceptionHandlerJSON");