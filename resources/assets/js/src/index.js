import React from 'react';
import ReactDOM from 'react-dom';
import { Provider } from 'react-redux';
import { BrowserRouter, Route } from 'react-router-dom';
import createStore from './store';

import Root from './components/App';
import Home from './components/Home/Home';
import SignIn from './components/SignIn';

ReactDOM.render(
  <Provider store={createStore()}>
    <BrowserRouter>
      <Route
        path="/"
        render={props => (
          <Root {...props}>
            <Route path="/" exact component={Home} />
            <Route path="/signin" component={SignIn} />
          </Root>
        )}
      />
    </BrowserRouter>
  </Provider>,
  document.getElementById('root')
);
