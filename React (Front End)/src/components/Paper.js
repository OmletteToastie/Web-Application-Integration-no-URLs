import React from "react";
import Authors from "./Authors";

/**
 * The structure of the paper entries.
 * 
 * By default only the paper's title is displayed. However, upon clicking the title,
 * the value display value is set to be true. This will display additional details relating to the paper.
 * 
 * @author Ethan Borrill W18001798
 */
class Paper extends React.Component {

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
        let details = "";

        if (this.state.display) {

            details = <div>
                <h4>Authors:</h4>
                <Authors paperid={this.props.paper.paperid} />
                <h4>Abstract:</h4>
                <p>{this.props.paper.abstract}</p>
                <h4>DoI</h4>
                <a href = {this.props.paper.doi}> {this.props.paper.doi}</a>
                <h4>Preview</h4>
                <a href = {this.props.paper.preview}> {this.props.paper.preview}</a>
                <h4>Video:</h4>
                <a className="ex1" href = {this.props.paper.video}> {this.props.paper.video}</a>
            </div>
        }
        return (
            <div onClick={this.handleClick}>
                <p className="ex1">{this.props.paper.title}</p>
                {details}
            </div>
        )
    }
}

export default Paper;