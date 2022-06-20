<?php

/**
 * The DBConnection class is used to route and manage connections to the databases needed within the systems.
 * This class contains important functions used to connect to the required database and executeSQL queries produced within gateways.
 * 
 * @author Ethan Borrill W18001798
 */
class DBConnection
{
    private $dbConnection;
    
    /**
     * The constructor below initialises the parameters needed for the DBconnection class to operate.
     * 
     * @param string $dbName - Contains the database's file name.
     */
    public function __construct($dbName) {
        $this->setDbConnection($dbName);
    }

    /**
     * setDBconnection will attempt to connect to the database being called
     * otherwise an exception is thrown with the relevant resposnse message.
     * 
     * @param string $dbName - Contains the name of the database file attempting to be connected to.
     */
    private function setDbConnection($dbName) {
        try {
            $this->dbConnection = new PDO('sqlite:' . $dbName);
            $this->dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Database Connection Error: " . $e->getMessage();
            exit();
        }
    }

    /**
     * This function will execute begin communication with the database. 
     * 
     * @param string $sql - used to contain the SQL query needed to collect relevant API information.
     * @param string $param - contains the parameter needed to execute the SQL query.
     * 
     * @return mixed $stmt - returns the databaase and the executed parameters associated.
     */
    public function executeSQL($sql, $params = []) {
        $stmt = $this->dbConnection->prepare($sql);
        $stmt->execute($params);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}