import React from "react";
import Paper from "./Paper";

/**
 * Component fetches the paper data from the papers web API.
 * 
 * Functionality to search for papers is also implemented, allowing papers to be searched by the title and abstract.
 * Papers are also sepereated into pages with 25 entries per page.
 * 
 * A fetch is also implemented to update the displayed list of papers based on the awardID associated to each paper.
 * 
 * @author Ethan Borrill W18001798
 */
class Papers extends React.Component {

    constructor(props) {
        super(props)
        this.state = {
            results: [],
            message: "",
            page: 1
        }
    }

    /**
     * Fetches the data from the Papers API.
     */
    componentDidMount() {
        let url = ""
        this.fetchData(url)
    }

    /**
     * Updates the entries being shown to display content with a specific awardid.
     * @param int prevProps - The award id related to the papers shown
     */
    componentDidUpdate(prevProps) {
        if (prevProps.awardid !== this.props.awardid) {
            let url = ""
            this.fetchData(url)
        }
    }

    fetchData = (url) => {
        if (this.props.authorid !== undefined) {
            url += "?authorid=" + this.props.authorid
        } else if (this.props.randomPaper) {
            url += "?id=random"
        } else if (this.props.awardid !== undefined && this.props.awardid !== "") {
            url += "?awardid=" + this.props.awardid
        }

        fetch(url)
            .then((response) => {
                if (response.status === 200) {
                    return response.json()
                } else {
                    throw Error(response.statusText)
                }
            })
            .then((data) => {
                this.setState({ results: data.results })
            })
            .catch((err) => {
                console.log("something has gone wrong ", err)
            });
    }

    /**
     * This handles what values are filtered in the searchbox, in this case the paper's title and abstract
     * @param text s - The characters being searched. 
     * @returns - The title or abstract searched
     */
    filterSearch = (s) => {
        return s.title.toLowerCase().includes(this.props.search.toLowerCase()) || s.abstract.toLowerCase().includes(this.props.search.toLowerCase())
    }

    render() {

        /**
         * Method used to update the results returned when searching for papers using the search options provided.
         */ 
        let filteredResults = this.state.results
        if ((filteredResults.length > 0) && (this.props.search !== undefined)) {
            filteredResults = this.state.results.filter(this.filterSearch)
        }

        let button = ""

        if (this.props.page !== undefined) {
            const pageSize = 25
            let pageMax = this.props.page * pageSize
            let pageMin = pageMax - pageSize

            //This will create buttons to be used in list navigation, with means in place to disable the buttons should they reach the end of available entries or if on the first page.
            button = (
                <div>
                    <button onClick={this.props.handlePreviousClick} disabled={this.props.page <= 1}>Previous</button>
                    <button onClick={this.props.handleNextClick} disabled={this.props.page >= Math.ceil(filteredResults.length / pageSize)}>Next</button>
                </div>
            )
            filteredResults = filteredResults.slice(pageMin, pageMax) //Will slice the array of papers returned to 25 maximum
        }
        return (
            <div>
                {filteredResults.map((paper, i) => (<Paper key={i + paper.title} paper={paper} />))}
                {button}
            </div>
        )
    }
}

export default Papers