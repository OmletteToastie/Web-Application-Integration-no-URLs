<?php

/**
 * This gateway class interacts with the list table created within user.sqlite, 
 * containing the papers within users viewing lists.
 * 
 * @author Ethan Borrill W18001798
 */
class GatewayList extends Gateway
{

    public function __construct() {
        $this->setDatabase(USER_DATABASE);
    }
    /**
     * The function below contains an SQL query which collects papers based on the user id associated.
     * 
     * @param string $user_id - used to collect data from the SQL query and display it within the gateway.
     */
    public function findAll($user_id) {
        $sql = "Select DISTINCT paper_id from readinglist where user_id = :user_id";
        $params = [":user_id" => $user_id];
        $result = $this->getDatabase()->executeSQL($sql, $params);
        $this->setResult($result);
    }

    /**
     * The function below contains an SQL query which will add a paper to the users reading list.
     * 
     * @param string $user_id - holds the SQL data related to the user id.
     * @param string $paper_id - holds the SQL data related to the paper id.
     */
    public function add($user_id, $paper_id) {
        $sql = "INSERT into readinglist (user_id, paper_id) VALUES (:user_id, :paper_id)";
        $params = [":user_id" => $user_id, ":paper_id" => $paper_id];
        $result = $this->getDatabase()->executeSQL($sql, $params);
    }

    /**
     * The function below contains an SQL query which will delete a paper from the users reading list.
     * 
     * @param string $user_id - holds the SQL data related to the user id.
     * @param string $paper_id - holds the SQL data related to the paper id.
     */
    public function remove($user_id, $paper_id) {
        $sql = "DELETE from readinglist where (user_id = :user_id) AND (paper_id = :paper_id)";
        $params = [":user_id" => $user_id, ":paper_id" => $paper_id];
        $result = $this->getDatabase()->executeSQL($sql, $params);
    }
}