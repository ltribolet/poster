import React, { Component } from 'react';
import { Link } from 'react-router-dom';

export default class SignIn extends Component {
  email = null;
  password = null;

  onSubmit = event => {
    event.preventDefault();

    if (this.email.value && this.password.value) this.props.onUserSignin(this.email.value, this.password.value);

    return false;
  };

  render() {
    return (
      <div className="col-md-6 col-md-offset-3">
        <h2>Login</h2>
        <form name="form" onSubmit={this.onSubmit}>
          <div className="form-group">
            <label htmlFor="email">Email</label>
            <input ref={input => (this.email = input)} type="email" className="form-control" name="email" />
          </div>
          <div className="form-group">
            <label htmlFor="password">Password</label>
            <input ref={input => (this.password = input)} type="password" className="form-control" name="password" />
          </div>
          <div className="form-group">
            <button className="btn btn-primary">Login</button>
            <Link to="/">Back to homepage</Link>
          </div>
        </form>
      </div>
    );
  }
}
