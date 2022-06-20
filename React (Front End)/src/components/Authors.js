import React from "react";
import Author from "./Author";

/**
 * Component will fetches the data collected from the Authors Web API, 
 * also implements the functionality used to search for authors.
 * 
 * This component also seperates the authors presented into entries of 25 per page.
 * 
 * Searchbox used filters based on author's first and last name.
 * 
 * @author Ethan Borrill W18001798
 */
class Authors extends React.Component {

    constructor(props) {
        super(props)
        this.state = {
            results: [],
            message: "",
            page: 1
        }
    }

    /**
     * Fetches details from Author web API.
     */
    componentDidMount() {
        let url = ""
        this.fetchData(url)
    }

    fetchData = (url) => {
        if (this.props.paperid !== undefined) {
            url += "?paperid=" + this.props.paperid
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
     * Function implements what values are filtered in the searchbox, in this case the Author's first and last name.
     * @param text s - The characters being searched. 
     * @returns - The names being searched.
     */
    filterSearch = (s) => {
        return s.firstName.toLowerCase().includes(this.props.search.toLowerCase()) || s.lastName.toLowerCase().includes(this.props.search.toLowerCase())
    }

    render() {

        /**
         * Method is used to update the results returned when searching for authors by name.
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
                {filteredResults.map((author, i) => (<Author key={i + author.firstName} author={author} />))}
                {button}
            </div>
        )
    }
}

export default Authors