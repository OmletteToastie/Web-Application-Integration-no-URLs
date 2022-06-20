import React from "react";
import ReadingList from "./ReadingList.js";
import Login from "./Login.js";
import Logout from "./Logout.js";
import Footer from "./Footer";

/**
 * This component below implements the content shown on the 'Reading List' page.
 * 
 * This component contains several important functions, such as the handleLoginClick and handleLogoutclick. Both of which are vital to access the readinglist,
 * the functions handleEmail and handlePassword are used within the handleLoginClick function.
 * 
 * Should the details entered be correct, an item called 'myReadingListToken' is created and kept locally on the user's pc. 
 * This contains the token produced during the authentication process and is used to verify the user's session on the page. 
 * 
 * @author Ethan Borrill W18001798
 */
class ReadingListPage extends React.Component {

    constructor(props) {
        super(props);
        this.state = {
            authenticated: false,
            token: null,
            email: "",
            password: ""
        }

        this.handleEmail = this.handleEmail.bind(this);
        this.handlePassword = this.handlePassword.bind(this);
        this.handleLoginClick = this.handleLoginClick.bind(this);
        this.handleLogoutClick = this.handleLogoutClick.bind(this);
    }

    componentDidMount() {
        if (localStorage.getItem('myReadingListToken')) {
            this.setState(
                {
                    authenticated: true,
                    token: localStorage.getItem('myReadingListToken')
                }
            );
        }
    }

    /**
     * Manages the password input into the login form, which is then used within the authentication process.
     * @param text e - stores the entered password.
     */
    handlePassword = (e) => {
        this.setState({ password: e.target.value })
    }

    /**
     * Manages the email address input into the login form, which is then used within the authentication process.
     * @param text e - stores the entered email address.
     */
    handleEmail = (e) => {
        this.setState({ email: e.target.value })
    }

    /**
     * Handles the Login functionality of the readinglist.
     * 
     * fetch() method is used to request details from the API, using a POST HTTP method to verify the login details.
     * If details are correct, a token is created and authenticated is set to true, allowing access to the page.
     * This token is also stored within LocalStorage on the browser to keep the user logged in when changing pages.
     */
    handleLoginClick = () => {
        let url = ""

        let formData = new FormData();
        formData.append('email', this.state.email);
        formData.append('password', this.state.password);

        fetch(url, {
            method: 'POST',
            headers: new Headers(),
            body: formData
        })
            .then((response) => {
                if (response.status === 200) {
                    return response.json()
                } else {
                    throw Error(response.statusText)
                }
            })
            .then((data) => {
                if ("token" in data.results) {
                    this.setState(
                        {
                            authenticated: true,
                            token: data.results.token
                        }
                    )

                    localStorage.setItem('myReadingListToken', data.results.token);
                }
            })
            .catch((err) => {
                console.log("something went wrong ", err)
            }
            );
    }

    /**
     * This handles the Logout functionality of the readinglist, which will set the authentication back to false and removing the token from local storage.
     */
    handleLogoutClick = () => {
        this.setState(
            {
                authenticated: false,
                token: null
            }
        )
        localStorage.removeItem('myReadingListToken');
    }

    render() {
        let page = (
            <div>
                <h1>The Reading List</h1>
                <Login
                    handleEmail={this.handleEmail}
                    handlePassword={this.handlePassword}
                    handleLoginClick={this.handleLoginClick}
                />
                <Footer />
            </div>
        )
        if (this.state.authenticated) {
            page = (
                <div>
                    <h1>The Reading List</h1>
                    <Logout handleLogoutClick={this.handleLogoutClick} />
                    <ReadingList token={this.state.token} />
                    <Footer />
                </div>
            )
        }

        return (
            <div>{page}</div>
        )
    }
}

export default ReadingListPage;