import React, { Component } from 'react';
import { Container } from 'flux/utils';
import { BrowserRouter, Route } from 'react-router-dom';

import App from '../components/App';
import Home from '../components/Home/Home';
import SignIn from '../components/SignIn';

import UserStore from '../data/UserStore';
import { signinAction } from '../data/UserActions';

class AppContainer extends Component {
  static getStores() {
    return [UserStore];
  }

  static calculateState() {
    return {
      user: UserStore.getState(),

      onUserSignin: signinAction,
    };
  }

  get appState() {
    return Object.assign({}, this.state, this.props);
  }

  render() {
    return (
      <BrowserRouter>
        <Route
          path="/"
          render={props => (
            <App {...props}>
              <Route path="/" exact render={() => <Home {...this.appState} />} />
              <Route path="/signin" render={() => <SignIn {...this.appState} />} />
            </App>
          )}
        />
      </BrowserRouter>
    );
  }
}

export default Container.create(AppContainer);
