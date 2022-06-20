import React from "react";
import Authors from "./Authors.js";
import SearchBox from "./SearchBox.js";
import Footer from "./Footer.js";

/**
 * This component displays the content shown on the 'Authors' page on the website.
 * 
 * Several functions are used on this page, including a searchbox to allow for authors to be searched by name.
 * The page is also seperated into several seperate pages which 'next' and 'previous' buttons to allow for navigation between these pages. 
 *
 * @author Ethan Borrill W18001798
 */
class AuthorPage extends React.Component {

    constructor(props) {
        super(props)
        this.state = {
            search: "",
            page: 1
        }
        this.handleSearch = this.handleSearch.bind(this);
        this.handleNextClick = this.handleNextClick.bind(this);
        this.handlePreviousClick = this.handlePreviousClick.bind(this);
    }

    /**
     * This handles the Search box functionality, applying the value of parameter e to be used in the search prop.
     * @param mixed e - contains the characters entered to be searched.
     */
    handleSearch = (e) => {
        this.setState({ search: e.target.value, page: 1 })
    }

    /**
     * This method handles the 'Next' button's functionality, setting the page value to be +1 of the current page.
     */
    handleNextClick = () => {
        this.setState({ page: this.state.page + 1 })
    }

    /**
     * This method handles the 'Previous' button's functionality setting the page value to be -1 of the current page.
     */
    handlePreviousClick = () => {
        this.setState({ page: this.state.page - 1 })
    }

    render() {
        return (
            <div>
                <h1>Authors Page</h1>
                <SearchBox search={this.state.search} handleSearch={this.handleSearch} />
                <h3>(Click the Author's name to see more details.)</h3>
                <Authors search={this.state.search}
                    page={this.state.page}
                    handleNextClick={this.handleNextClick}
                    handlePreviousClick={this.handlePreviousClick}
                />
                <Footer />
            </div>
        );
    }
}
export default AuthorPage;