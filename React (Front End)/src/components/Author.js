import React from "react";
import Papers from "./Papers";

/**
 * The structure of the author entries.
 * 
 * By default only the first and last name is displayed. However, upon clicking the author name,
 * the value display value is set to be true. This allows for additional details regarding papers written by each author to be displayed.
 * 
 * @author Ethan Borrill W18001798
 */
class Author extends React.Component {

    constructor(props) {
        super(props)
        this.state = { 
            display: false 
        }
    }

    /**
     * Method changes the state of display value between true or false, allowing for content to be displayed.
     */
    handleClick = () => {
        this.setState({ display: !this.state.display })
    }

    render() {
        let details = ""

        if (this.state.display) {
            details =
                <div>
                    <Papers authorid={this.props.author.id} />
                </div>
        }
        return (
            <div>
                <p onClick={this.handleClick}>
                    {this.props.author.firstName} {this.props.author.lastName}
                </p>
                {details}
            </div>
        )
    }
}

export default Author;