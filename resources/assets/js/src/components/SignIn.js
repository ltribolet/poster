import React, { Component } from 'react';
import { Link } from 'react-router-dom';

class SignIn extends Component {
  email = null;
  input = null;

  onSubmit = event => {
    event.preventDefault();

    console.log(this.email.value, this.password.value);

    return false;
  };

  render() {
    return (
      <div className="container page">
        <div className="row">
          <div className="col-md-3">
            <form onSubmit={this.onSubmit}>
              <div>
                <input type="test" ref={input => (this.email = input)} />
              </div>
              <div>
                <input type="password" ref={input => (this.password = input)} />
              </div>

              <input type="submit" />
            </form>
            <Link to="/">Back to homepage</Link>
          </div>
        </div>
      </div>
    );
  }
}

export default SignIn;
