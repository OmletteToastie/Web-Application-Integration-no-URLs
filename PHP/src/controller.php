<?php

/** 
 * This class functions are the parent class for all other controllers utilised within this assessment.
 * 
 * This file contains several important functions necessary for collecting and displaying the requested data/information on both the webpages and APIs.
 *
 * @author Ethan Borrill W18001798
 */
abstract class Controller
{

    private $request; //Used to store requested object passed from the webpage
    private $response; //Used to store the response collected from the webpage
    protected $gateway; //Stores information collected from interacting with the database


    /**
     * Constructor will initialise the important parameters needed to perform requests and responses on the webpage.
     * 
     * @param mixed $request - used to contain requests made to the webpage.
     * @param mixed $response - contains the responses given from the webpage from requests.
     */
    public function __construct($request, $response) {
        $this->setGateway();
        $this->setRequest($request);
        $this->setResponse($response);

        $data = $this->processRequest();
        $this->getResponse()->setData($data);
    }

    /**
     * The function below will create a request to the webapge and store it within the $request parameter
     * 
     * @param mixed $request = Contains the produced request.
     */
    private function setRequest($request) {
        $this->request = $request;
    }

    /**
     * Function will return the produced request from setRequest
     * 
     * @return mixed request - Contains the produced request.
     */
    protected function getRequest() {
        return $this->request;
    }

    /**
     * Function will create a response from the webpage and store it within a $response parameter.
     * 
     * @param mixed $response - Contains the response which has been produced.
     */
    private function setResponse($response) {
        $this->response = $response;
    }

    /**
     * getResponse will return the response produced within setResponse.
     * 
     * @return mixed response - Contains the response collected from the webpage.
     */
    protected function getResponse() {
        return $this->response;
    }

    /**
     * setGateway is used to implement the required gateway file to be used by the controller.
     */
    protected function setGateway() {
    }

    /**
     * Collects the required function from the selected gateway to perform the required query from the database.
     * 
     * @return string gateway - Contains the collected gateway.
     */
    protected function getGateway() {
        return $this->gateway;
    }


    protected function processRequest() {
    }
}