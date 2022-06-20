<?php

/**
 * The ControllerPapeApi displays the related content produced from the SQL queries within gatewaypapers.php 
 * 
 * This is done through the use of a parameters or 'params' set within the gateway to identify which SQL Query is to be performed should its parameter be used.
 * 
 * @author Ethan Borrill W18001798
 */
class ControllerPaperApi extends Controller
{
    /**
     * The setGateway function allocates the Paper Gateway to this controller in order to access the relevant 'params' objects collected from their respective SQL Queries. 
     */
    protected function setGateway()
    {
        $this->gateway = new GatewayPapers();
    }

    /**
     * The function below utilises the parameters set within gatewaypapers to determine when to present which SQL queries on the API.
     * 
     * By default, it was present all papers with the respective details, with additional parameters availavle to search for specific papers by their ID and by the ID of authors.
     * Additional parameters are available to search for papers by whether they have/have not won an award and by the specific ID of an award.
     * 
     * @return mixed $this - Returns the results collected from the gateway.
     */
    protected function processRequest() {
        $id = $this->getRequest()->getParameter("id"); // This parameter is allocated to retriving all details when searching for a specific paper via its ID.
        $authorid = $this->getRequest()->getParameter("authorid"); //This parameter is allocated to retrieving all paper details when searching for a specific author.
        $award = $this->getRequest()->getParameter("award"); //This parameter is allocated to retrieving all details of papers which have won awards.
        $awardid = $this->getRequest()->getParameter("awardid"); //This parameter is allocated to retrieving all details of papers with a specific award ID associated.

        if ($this->getRequest()->getRequestMethod() === "GET") {
            if (!is_null($id)) {
                if ($id === "random") {
                    $this->getGateway()->findRandom($id);
                } else {
                    $this->getGateway()->findPaper($id);
                }
            } else if (!is_null($authorid)) {
                $this->getGateway()->findAuthorsPaper($authorid);
            } else if (!is_null($awardid)) {
                $this->getGateway()->findPaperAwardID($awardid);
            } elseif ((!is_null($award)) && ($award == "all")) {
                $this->getGateway()->findPaperAwards();
            } elseif ((!is_null($award)) && ($award == "none")) {
                $this->getGateway()->findPaperNoAwards();
            } else {
                $this->getGateway()->findAll();
            }
        } else {
            $this->getResponse()->setMessage("Method not allowed");
            $this->getResponse()->setStatus(405);
        }

        return $this->getGateway()->getResult();
    }
}