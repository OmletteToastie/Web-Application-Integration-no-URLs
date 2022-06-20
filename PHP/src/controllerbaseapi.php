<?php

/**
 * This controller displays The base API page used to access the additional endpoints available. This page additionally contains the student name and ID along with a disclaimer relating to the use
 * of DIS Conference papers. Finally, the webpage presents a link to the Documentation page, containing all API endpoints and their relative information.
 * 
 * @author Ethan Borrill W18001798 
 */
class ControllerBaseApi extends Controller
{

    /**
     * The processRequest function below takes values assigned to the variable $data, with the intention of being displayed within the pages API.
     * 
     * To display the text on the API, Titles are assigned to the corresponding text using [example], this is to ensure organisation and make the webpage clear and structured. 
     * 
     * @return mixed $data - The values assigned within the controller.
     */
    protected function processRequest() {
        $data['author']['name'] = "Ethan Borrill";
        $data['author']['id'] = "W18001798";
        $data['information']['about'] = "This API allows for access to several DIS Conference papers via several additional API endpoints.";
        $data['information']['documentation'] = "Documentation for API endpoints available can be found here: ";
        $data['disclaimer'] = "The API endpoints available and all related content are used for an assignment within: KV6012, Web application intergration at Northumbria University. It is not associated with or endorsed by the DIS Conference";
        return $data;
    }
}