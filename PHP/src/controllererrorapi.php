<?php

/**
 * This controller is used to display an error when a User enters an API endpoint that is not known to the webpage.
 * 
 * @author Ethan Borrill W18001798
 */
class ControllerErrorApi extends Controller
{
    protected function processRequest() {
        $this->getResponse()->setMessage("Page not Found"); //Message is shown when non-supported endpoint is entered.
        $this->getResponse()->setStatus(404); //Corresponding status code, meaning 'Page not found'.
    }
}