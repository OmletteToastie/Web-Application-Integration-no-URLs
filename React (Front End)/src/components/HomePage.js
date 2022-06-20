import React from "react";
import Footer from "./Footer.js"
import library from "./../image/library.jpg";
import Papers from "./Papers.js";

/**
 * Component displays the content needed for the Homepage users will land on when entering the website. 
 * 
 * @author Ethan Borrill W18001798
 */
class HomePage extends React.Component {

    constructor(props) {
        super(props)
        this.state = {

        }
    }

    render() {
        return (
            <div id="App">
                <h1>Home Page</h1>
                <img src={library} className="library" alt="library bookshelf" />
                <p>
                    Photo by <a href="https://unsplash.com/@alfonsmc10?utm_source=unsplash&utm_medium=referral&utm_content=creditCopyText">Alfons Morales</a> on <a href="https://unsplash.com/s/photos/library?utm_source=unsplash&utm_medium=referral&utm_content=creditCopyText">Unsplash</a>
                </p>
                <h2>Random Paper of the day:</h2>
                <h3>(Click the paper's title to see more details.)</h3>
                <Papers randomPaper={true} />
                <Footer />
            </div>
        );
    }
}
export default HomePage;