import React from "react";
import Papers from "./Papers";
import SelectAward from "./SelectAward";
import SearchBox from "./SearchBox";
import Footer from "./Footer";

/**
 * Component displays the paper entries collected from the web API.
 * 
 * @author Ethan Borrill W18001798
 */
class PapersPage extends React.Component {
    
    constructor(props) {
        super(props)
        this.state = {
            awardid: "",
            search: "",
            page: 1
        }
        this.handleSearch = this.handleSearch.bind(this);
        this.handleAwardSelect = this.handleAwardSelect.bind(this);
        this.handleNextClick = this.handleNextClick.bind(this);
        this.handlePreviousClick = this.handlePreviousClick.bind(this);
    }

    /**
     * This handles the Search box functionality, applying the value of parameter 'e' to be used in the 'search' prop.
     * @param mixed e - contains the characters entered to be searched.
     */
    handleSearch = (e) => { 
        this.setState({search:e.target.value, page:1})
    }

    /**
     * This handles the drop down box functionality, applying the option selected on the drop-down to the parameter 'e' so that it can be applied to the 'awardid' prop.
     * @param mixed e - contains the dropdown option selected.
     */
    handleAwardSelect = (e) => { 
        this.setState({awardid:e.target.value, page:1})
    }

    /**
     * This method handles the 'Next' button's functionality, setting the page value to be +1 of the current page.
     */
    handleNextClick = () => {
        this.setState({page:this.state.page+1})
    }

    /**
     * This method handles the 'Previous' button's functionality setting the page value to be -1 of the current page.
     */
    handlePreviousClick = () => { 
       this.setState({page:this.state.page-1})
    }    
   
    render(){
        return(
            <div>
            <h1>Papers Page</h1>
            <SearchBox search={this.state.search} handleSearch={this.handleSearch} />    
            <SelectAward awardid={this.state.awardid} handleAwardSelect={this.handleAwardSelect} />
            <h3>(Click the Paper's title to see more details.)</h3>
            <Papers awardid={this.state.awardid} 
                    search={this.state.search} 
                    page={this.state.page} 
                    handleNextClick={this.handleNextClick} 
                    handlePreviousClick={this.handlePreviousClick}/>
            <Footer/>
        </div>
        )
    }
}

export default PapersPage;