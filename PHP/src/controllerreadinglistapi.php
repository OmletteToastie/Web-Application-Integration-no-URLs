<?php

use Firebase\JWT\JWT; //Implements the FireBase JWT Class.
use Firebase\JWT\Key; //Implements the FireBase Key Class.

/**
 * This controller handles and manages the papers on users reading lists.
 * 
 * The class uses a POST request method within an if statement to return respective users papers from the database.
 *
 * @author Ethan Borrill W18001798
 */
class ControllerReadingListApi extends Controller
{
    /**
     * The setGateway function allocates the List Gateway to this controller in order to access the relevant 'params' objects collected from their respective SQL Queries. 
     */
    protected function setGateway() {
        $this->gateway = new GatewayList();
    }

    /**
     * Processrequest takes the parameters implemented in the gateway for lists to provide the readinglist functionality.
     * 
     * This includes checking if the webtoken provided is not empty/invalid, allowing for the list to then be viewed and edited.
     * 
     * @return mixed $this - Returns the results collected from the gateway.
     */
    protected function processRequest() {
        $token = $this->getRequest()->getParameter("token");
        $add = $this->getRequest()->getParameter("add");
        $remove = $this->getRequest()->getParameter("remove");

        if ($this->getRequest()->getRequestMethod() === "POST") {
            if (!is_null($token)) {
                $key = SECRET_KEY;
                $decoded = JWT::decode($token, new Key($key, 'HS256'));
                $user_id = $decoded->user_id;
            }
            if (!is_null($add)) {
                $this->getGateway()->add($user_id, $add);
            } elseif (!is_null($remove)) {
                $this->getGateway()->remove($user_id, $remove);
            }
            $this->getGateway()->findAll($user_id);
        } else {
            $this->getResponse()->setMessage("Method not allowed");
            $this->getResponse()->setStatus(405);
        }
        return $this->getGateway()->getResult();
    }
}