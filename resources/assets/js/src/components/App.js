import React from 'react';
import PropTypes from 'prop-types';
import { connect } from 'react-redux';

import Header from './Header';

class App extends React.Component {
  render() {
    return (
      <div>
        <Header appName="Poster" />
        {this.props.children}
      </div>
    );
  }
}

App.contextTypes = {
  router: PropTypes.object.isRequired,
  children: PropTypes.node,
};

export default connect(null, null)(App);
