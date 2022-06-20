<?php

/**
 * This function holds SQL queries that are necessary for the login functionality, 
 * this is performed through executing SQL relating to user information from the User.sqlite file.
 * 
 * @author Ethan Borrill W18001798
 */
class GatewayUser extends Gateway
{
    public function __construct() {
        $this->setDatabase(USER_DATABASE);
    }

    /**
     * Function executes an SQL query to locate the password and ID of a user based on the email address associated with the ID.
     * 
     * @param string $email - Stores the email address collected from the database.
     */
    public function findPassword($email) {
        $sql = " Select id, password from user where email = :email"; //This SQL selects the Id and password from the database based on a corresponding email address.
        $params = [":email" => $email];
        $result = $this->getDatabase()->executeSQL($sql, $params);
        $this->setResult($result);
    }
}