import React from "react";

/**
 * Component creates a dropdown menu to allow users to select papers which have won the award selected.
 * 
 * The ID number of the award is used to select the papers which have won the respective award, 
 * with the award's name being matched to their ID number to better help users idenitfy which award is being selected.
 * 
 * @author Ethan Borrill W18001798
 */
class SelectAward extends React.Component {
    render() {
        return (
            <label>
                <select value={this.props.awardid} onChange={this.props.handleAwardSelect}>
                    <option value="">All Papers</option>
                    <option value="1">Best paper</option>
                    <option value="2">Best paper honourable mention</option>
                    <option value="3">Best pictorial</option>
                    <option value="4">Best pictorial honourable mention</option>
                    <option value="5">Special recognition for diversity and inclusion</option>
                </select>
            </label>
        )
    }
}

export default SelectAward;