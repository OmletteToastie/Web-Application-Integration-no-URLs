<?php

/**
 * This Controller operates as a child of the main controller file, 
 * overseeing the functionality relating to authentication of user login attempts and the creating of JSON Web Tokens upon a successful login attempt.
 * 
 * 
 * @author Ethan Borrill W18001798
 */
use Firebase\JWT\JWT; //Implements the FireBase JWT Class.

class ControllerAuthenticateApi extends Controller
{

    protected function setGateway() {
        $this->gateway = new GatewayUser();
    }

    /**
     * Process request below will collect the parameters 'email' and 'password' and determines whether the password entered matches the email address provided.
     * If it does match, the password is then hashed/encrypted using the secret key in Config.php. A web token is then produced with the corresponding user_id and an expiration date for the token.
     * This is then encoded using the JWT class from firebase to encode the token for use of the webpage.
     * 
     * If the password does not match the connected email address, a 401 (Unauthorised) is returned, or if a GET method is used a 405 will display.
     * 
     * @return mixed $data - The data produced by the controller.
     */
    protected function processRequest() {
        $data = [];

        //Sets the parameters used
        $email = $this->getRequest()->getParameter("email");
        $password = $this->getRequest()->getParameter("password");

        if ($this->getRequest()->getRequestMethod() === "POST") {
            if (!is_null($email) && !is_null($password)) { //If values are entered for both email and password, the password is entered is checked to if it matches the email address entered

                $this->getGateway()->findPassword($email);

                //If statement used if an password is found to a corresponding email within the database, retrieving the password in a hashed form for the user.
                if (count($this->getGateway()->getResult()) == 1) {
                    $hashpassword = $this->getGateway()->getResult()[0]['password'];

                    if (password_verify($password, $hashpassword)) {
                        $key = SECRET_KEY; //$key refers to the encryption key.

                        $payload = array(
                            "user_id" => $this->getGateway()->getResult()[0]['id'], //Assigns the user_id in the token to be the same as the id collected when checking the email address and password.
                            "exp" => time() + 2592000 //Set to 30 days till expiration.
                        );

                        $jwt = JWT::encode($payload, $key, 'HS256'); //Encodes the web token using JWT Class from Firebase.
                        $data = ['token' => $jwt];
                    }
                }
            }

            if (!array_key_exists('token', $data)) {
                $this->getResponse()->setMessage("Unauthorized");
                $this->getResponse()->setStatus(401);
            }
        } else {
            $this->getResponse()->setMessage("Method not Allowed");
            $this->getResponse()->setStatus(405);
        }

        return $data;
    }
}