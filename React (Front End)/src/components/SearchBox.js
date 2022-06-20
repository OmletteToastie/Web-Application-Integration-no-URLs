import React from "react";

/**
 * The component below implements a Searchbox function which is used on the Papers and Authors pages.
 * 
 * This is performed by using the props 'search', which collects the characters entered. 
 * The props handleSearch is then used to return any values in the list that contains those same characters in the searchbox.
 * 
 * @author Ethan Borrill W18001798
 */
class SearchBox extends React.Component {
    render() {
        return (
            <label>
                <input type='text' placeholder='Search here' value={this.props.search} onChange={this.props.handleSearch} />
            </label>
        )
    }
}

export default SearchBox;