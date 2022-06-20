<?php
/**
 * Index acts as a central hub for all controllers and api's to be contained and displayed within.
 * this is performing using the 'switch' method, which makes use of cases with the titles being used within the URL to move to the respective controller
 * 
 * @author Ethan Borrill W18001798
 */

include "config/config.php";

$request = new Request();

//If statement below checks for whether an API is being used or a HTML webservice and will assign the appropriate header response.
if(substr($request->getpath(),0,3)=== "api"){
    $response = new ResponseJSON();
}
else{
    set_exception_handler("exceptionHandlerHTML");
    $response = new ResponseHTML();
}

switch ($request->getPath()) {
    case '':
    case 'home':
        $controller = new ControllerHome($request, $response);
        break;
    case 'documentation':
        $controller = new ControllerDocumentation($request, $response);
        break;
    case 'api':
        $controller = new ControllerBaseApi($request, $response);
        break;
    case 'api/authors':
        $controller = new ControllerAuthorApi($request, $response);
        break;
    case 'api/papers':
        $controller = new ControllerPaperApi($request, $response);
        break;
    case 'api/authenticate':
        $controller = new ControllerAuthenticateApi($request,$response);
            break;
    case 'api/readinglist':
        $controller = new ControllerReadingListApi($request,$response);
            break;
    default: //If statement below will implement the appropriate Error Controller should an error occur, this is determined based on which response file is being used.
        if(is_a($response, "ResponseHTML")){
            $controller = new ControllerError($request, $response);
       } else {
           $controller = new ControllerErrorApi($request, $response);
       }
        break;
}

echo $response->getData();