import React from "react";
import Footer from "./Footer.js";

/**
 * This component is used deployed when a user attempts to enter a page that does not exist on the server. 
 * At which point they are prompted to return to the existing pages using the navigation bar at the top of the page.
 * 
 * @author Ethan Borrill W18001798
 */
class ErrorPage extends React.Component {

    constructor(props) {
        super(props)
        this.state = {

        }
    }

    render() {
        return (
            <div>
                <h1>Page not found!</h1>
                <p>Unfortunately, the page you are looking for does not exist! Please use the Navigation bar at the top to return to an existing page:</p>
                <Footer />
            </div>
        )
    }
}

export default ErrorPage;