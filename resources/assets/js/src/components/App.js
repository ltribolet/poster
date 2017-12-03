import React, { Component } from 'react';
import PropTypes from 'prop-types';

import Header from './Header';

class App extends Component {
  render() {
    return (
      <div>
        <Header appName="Poster" />
        {this.props.children}
      </div>
    );
  }
}

App.propTypes = {
  router: PropTypes.object.isRequired,
  children: PropTypes.node,
};

export default App;
