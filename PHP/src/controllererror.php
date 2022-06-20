<?php

/**
 * This controller is used when a user attempts to access a page/url that does not exist on the webpage, providing users with return links to the documentation or homepage.
 * This has been produced to prevent users from being stuck or lost.
 * 
 * @author Ethan Borrill W18001798
 */
class ControllerError extends Controller
{
    /**
     * Function below will generate the contents that will be displayed on the errorpage.
     * 
     * @return mixed $page - Contains the contents created on within the processRequest.
     */
    protected function processRequest() {
        $page = new ErrorPage("Page not found", "This page does not exist!");
        $page->addParagraph("Unfortunately, the page you are searching for does not exist! 
                            <br>
                            Please use the links below to return to pages used on the webpage:");
        $page->addLink("<li>
                        <ul><a href=\"/kf6012/coursework/part1/home\">Home</a></ul> 
                        <ul><a href=\"/kf6012/coursework/part1/documentation\">Documentation</a></ul>
                        </li>");

        return $page->generateWebPage();
    }
}