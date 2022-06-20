import React from "react";
import CheckBox from "./CheckBox";
import Paper from "./Paper";

/**
 * Component fetches the list of paper's to be displayed on the page, which can then be added or removed from the user's readinglist.
 * 
 * @author Ethan Borrill W18001798
 */
class ReadingList extends React.Component {
    
    constructor(props) {
        super(props)
        this.state = {
            readinglist: [],
            results: []
        }
    }

    /**
     * Fetches the papers from the Paper API to be displayed on the page and secondly fetches the logged in users readinglist.
     */
    componentDidMount() {
        let url = ""

        fetch(url)
            .then((response) => {
                if (response.status === 200) {
                    return response.json()
                } else {
                    throw Error(response.statusText);
                }
            })
            .then((data) => {
                this.setState({ results: data.results })
            })
            .catch((err) => {
                console.log("something went wrong ", err)
            });

        url = ""
        let formData = new FormData();
        formData.append('token', this.props.token);

        fetch(url, {
            method: 'POST',
            headers: new Headers(),
            body: formData
        })
            .then((response) => {
                if (response.status === 200) {
                    return response.json()
                } else {
                    throw Error(response.statusText);
                }
            })
            .then((data) => {
                this.setState({ readinglist: data.results })
            })
            .catch((err) => {
                console.log("something went wrong ", err)
            });
    }
    
    render() {
        return (
            <div>
                {this.state.results.map((paper) => (
                    <div key={paper.paperid}>
                        <CheckBox readinglist={this.state.readinglist} paper_id={paper.paperid} />
                        <Paper paper={paper} />
                    </div>
                )
                )}
            </div>
        )
    }
}

export default ReadingList;