import React from "react";

/**
 * Component implements the login inputs and login button utilised to access the Readinglist.
 * 
 * Each input handles a different value: Email and Password, both inputs handle the respective values entered.
 * When the login button is pressed, these values are verified with those stored in the user database.
 * 
 * @author Ethan Borrill W18001798
 */
class Login extends React.Component {
    render() {
        return (
            <div>
                <input
                    type='text'
                    placeholder='Email here'
                    value={this.props.email}
                    onChange={this.props.handleEmail}
                />
                <input
                    type='password'
                    placeholder='Password here'
                    value={this.props.password}
                    onChange={this.props.handlePassword}
                />
                <button onClick={this.props.handleLoginClick}>Log in</button>
            </div>
        );
    }
}

export default Login;