import React from "react";

/**
 * Component responsible for allowing users to add or remove papers from their personal reading list.
 * 
 * This is managed by utilising the 'add' or 'remove' parameters and implementing changes to the reading list based on whether or not the checkbox is selected.
 * JWT Tokens are utilised to associate the choices made to the respective user, this token will also remember what papers have been selected/removed upon leaving the page.
 * 
 * @author Ethan Borrill W18001798
 */
class CheckBox extends React.Component {

    constructor(props) {
        super(props);
        this.state = { checked: false }
    }

    componentDidMount() {
        let filteredList = this.props.readinglist.filter((item) => (this.isOnList(item)))
        if (filteredList.length > 0) {
            this.setState({ checked: true })
        }
    }

    /**
     * Function checks if paper_id on the page is matched to paper id from readinglist database.
     * @param int item - contains the paper_id from the database.
     * @returns int item - the paper_id's that are shared both in the readinglist and on the page.
     */
    isOnList = (item) => {
        return (item.paper_id === this.props.paper_id)
    }

    /**
     * Function adds papers that have been selected to the user's readinglist.
     */
    addToReadingList = () => {
        let url = ""

        let formData = new FormData();
        formData.append('token', localStorage.getItem('myReadingListToken'));
        formData.append('add', this.props.paper_id);

        fetch(url, {
            method: 'POST',
            headers: new Headers(),
            body: formData
        })
            .then((response) => {
                if ((response.status === 200) || (response.status === 204)) {
                    this.setState({checked:!this.state.checked})
                } else {
                    throw Error(response.statusText);
                }
            })
            .catch((err) => {
                console.log("something went wrong ", err)
            });
    }

    /**
     * Function removes selected papers from the user's readinglist.
     */
    removeFromReadingList = () => {
        let url = ""

        let formData = new FormData();
        formData.append('token', localStorage.getItem('myReadingListToken'));
        formData.append('remove', this.props.paper_id);

        fetch(url, {
            method: 'POST',
            headers: new Headers(),
            body: formData
        })
            .then((response) => {
                if ((response.status === 200) || (response.status === 204)) {
                    this.setState({checked:!this.state.checked})
                } else {
                    throw Error(response.statusText);
                }
            })
            .catch((err) => {
                console.log("something went wrong ", err)
            });
    }

    /**
     * Manages the state of the checkbox and adjusts the functions accordingly.
     */
    handleOnChange = () => {
        if (this.state.checked) {
            this.removeFromReadingList()
        } else {
            this.addToReadingList()
        }
    }

    render() {
        return (
            <input
                type="checkbox"
                id="readinglist"
                name="readinglist"
                value="paper"
                checked={this.state.checked}
                onChange={this.handleOnChange}
            />
        )
    }
}

export default CheckBox;