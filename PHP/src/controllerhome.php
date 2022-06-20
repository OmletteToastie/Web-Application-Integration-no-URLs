<?php

/**
 * Displays the Homepage of the webserver, this is displayed by default upon opening website from the default URL.
 * 
 * @author Ethan Borrill W18001798
 */
class ControllerHome extends Controller
{
    /**
     * Function below generates the contents required for the homepage of the webpage.
     * 
     * @return mixed $page - Contains the contents created on within the processRequest.
     */
    protected function processRequest() {
        $page = new HomePage("Homepage", "Welcome to the Homepage!");
        
        $page->addParagraph("Created by: Ethan Borrill 
                            <br> 
                            Student ID Number: W18001798");

        $page->addParagraph("Link to the documentation page: <a href= </a>");

        $page->addParagraph("This webpage and all related content are used for an assignment within:");

        $page->addList("<li>Web Application Integration</li>
                        <li>Module Code: KV6012</li>
                        <li>Module Lecturer: John Rooskby</li>
                        <li>Northumbria University</li>");

        $page->addParagraph("This webpage and project are used within a Northumbria University Assessment and as such is not endorsed or associated with the DIS Conference.");
        return $page->generateWebpage();
    }
}