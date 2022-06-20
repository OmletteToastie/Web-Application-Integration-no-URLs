<?php

/**
 * This controller is utilised to collect and display author data from the DIS.sqlite file onto the Authors API page.
 * 
 * @author Ethan Borrill W18001798.
 */
class ControllerAuthorApi extends Controller
{

    /**
     * The setGateway function allocates the Author Gateway to this controller in order to access the relevant 'params' objects collected from their respective SQL Queries. 
     */
    protected function setGateway() {
        $this->gateway = new GatewayAuthors();
    }

    /**
     * ProcessRequest manages the parameters used within the api, showing the list of all authors by default. Additional options are available to identity authors based on their unique ID number or by the ID of a Paper several authors have worked on.
     * 
     * @return mixed $this - Returns the results collected from the gateway.
     */
    protected function processRequest() {
        $id = $this->getRequest()->getParameter("id"); //Collects the 'id' parameter used to find authors by a their unique id number.
        $paperid = $this->getRequest()->getParameter("paperid"); //Collects the 'paperid' parameter used to find authors based on the paper id they worked on.

        if ($this->getRequest()->getRequestMethod() === "GET") {
            if (!is_null($id)) {
                $this->getGateway()->findAuthor($id); //If ?id= is used, it will use the findAuthor function.
            } elseif ($paperid) {
                $this->getGateway()->findAuthorByPaper($paperid);
            } else {
                $this->getGateway()->findAll(); //Otherwise all authors will be displayed.
            }
        } else {
            $this->getResponse()->setMessage("Method not allowed");
            $this->getResponse()->setStatus(405);
        }
        return $this->getGateway()->getResult();
    }
}
