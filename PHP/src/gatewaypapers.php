<?php

/** 
 * This gateway contains the SQL queries required to access content related to papers from the DIS database.
 * By default, the gateway will display all papers ordered by the title, with additional search parameters available to assist in locating papers.
 * 
 * @author Ethan Borrill W18001798
 */
class GatewayPapers extends Gateway
{

    private $sql = "SELECT paper.paper_id as paperid, paper.title, paper.abstract,paper.doi,paper.preview,paper.video,award_type.name as awardName 
    from paper
    left join award on (paper.paper_id = award.paper_id)
    left join award_type on (award.award_type_id = award_type.award_type_id )";
    
    public function __construct() {
        $this->setDatabase(DIS_DATABASE);
    }

    /**
     * This function executes the $sql Query above as a default, which will show Paper details such as ID, title, and abstract. Aswell as author details and any award details.
     */
    public function findAll() {
        $this->sql .= "order by paper.title";
        $result = $this->getDatabase()->executeSQL($this->sql);
        $this->setResult($result);
    }

    /**
     * This function executes the additional SQL query code responsible for finding paper details related to a specific paper's ID. 
     * 
     * @param int $id - collects the ID of the paper and displays its respective details.
     */
    public function findPaper($id) {
        $this->sql .= "WHERE paper.paper_id = :id";
        $params = ["id" => $id];
        $result = $this->getDatabase()->executeSQL($this->sql, $params);
        $this->setResult($result);
    }

    /**
     * This function executes the additional SQL query code responsible for finding paper details related to a specific Author ID. 
     * 
     * @param int $authorid - collects the ID of the author and displays the details of the paper.
     */
    public function findAuthorsPaper($authorid) {
        $this->sql .= "inner join paper_author on (paper.paper_id = paper_author.paper_id )
                       inner join author on (paper_author.author_id = author.author_id) WHERE author.author_id = :id";
        $params = ["id" => $authorid];
        $result = $this->getDatabase()->executeSQL($this->sql, $params);
        $this->setResult($result);
    }

    /**
     * This function executes the additional SQL query code responsible for finding paper details within papers which have receieved an award. 
     */
    public function findPaperAwards() {
        $this->sql .= "WHERE award_type.name IS NOT NULL order by paper.title";
        $result = $this->getDatabase()->executeSQL($this->sql);
        $this->setResult($result);
    }

    /**
     * This function executes additional SQL query code which presents research papers which have not receieved an award. 
     */
    public function findPaperNoAwards() {
        $this->sql .= "WHERE award_type.name IS NULL order by paper.title";
        $result = $this->getDatabase()->executeSQL($this->sql);
        $this->setResult($result);
    }

    /**
     * This function executes SQL query code allowing for papers to be collected based on the award they have one, searched for by ID.
     * 
     * @param int $awardid - Parameter which contains the awardid requested in order to pull all paper details related from the database.
     */
    public function findPaperAwardID($awardid) {
        $this->sql .= "WHERE award_type.award_type_id = :id";
        $params = ["id" => $awardid];
        $result = $this->getDatabase()->executeSQL($this->sql, $params);
        $this->setResult($result);
    }

    /**
     * This function is used to collect a random film to be displayed on the React Homepage. 
     */
    public function findRandom() {
        $this->sql .= " order by random() limit 1";
        $result = $this->getDatabase()->executeSQL($this->sql);
        $this->setResult($result);
    }
}