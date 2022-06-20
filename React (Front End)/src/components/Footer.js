import React from "react";

/**
 * Component sets the footer module used on all pages, containing Student name, ID and disclaimer relating to the use of DIS conference content.
 * This component is deployed within the Render of all deployed pages.
 * 
 * @author Ethan Borrill W18001798
 */
class Footer extends React.Component {
    render() {
        return (
            <footer>
                <p>Created by: Ethan Borrill <br />
                    Student ID: W18001798
                </p>
                <p>The contents of this webpage are not affiliated or endorsed by DIS Conference <br />
                    and are only for use within this academic project.</p>
            </footer>
        )
    }
}

export default Footer;