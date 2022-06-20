<?php

/**
 * This gateway is used to collect details related to the authors within the DIS database.
 * By default, the gateway will display all authors ordered by last name, with an additional parameter to find authors using their unique ID number.
 * 
 * @author Ethan Borrill W18001798
 */
class GatewayAuthors extends Gateway
{

    private $sql = "SELECT author.author_id as id, 
                    first_name as firstName, 
                    last_name as lastName 
                    FROM author"; // This is the SQL Used to collect the relevant data from the database.

    public function __construct() {
        $this->setDatabase(DIS_DATABASE); //This will set the database to be used as the Base db in config (The DIS.sqlite).
    }

    /**
     * This function with return all actors within the database  
     */
    public function findAll() {
        $this->sql .= " order by author.last_name";
        $result = $this->getDatabase()->executeSQL($this->sql);
        $this->setResult($result);
    }

    /**
     * This function will return the same details, but only for a selected ID.
     * 
     * @param int $id - collects the id from the database and stores it within this parameter.
     */
    public function findAuthor($id) {
        $this->sql .= " WHERE author_id = :id"; // This line means that only data related to a specific ID will be retrieved from the database.
        $params = ["id" => $id];
        $result = $this->getDatabase()->executeSQL($this->sql, $params);
        $this->setResult($result);
    }
    /**
     * This function will return all the authors based on the paper id entered
     * 
     * @param int $paperid - collects the paper id from the database.
     */
    public function findAuthorByPaper($paperid) {
        $this->sql .= " join paper_author on (paper_author.author_id = author.author_id)
                       join paper on (paper.paper_id = paper_author.paper_id ) 
                       WHERE paper.paper_id = :id";
        $params = ["id" => $paperid];
        $result = $this->getDatabase()->executeSQL($this->sql, $params);
        $this->setResult($result);
    }
}
