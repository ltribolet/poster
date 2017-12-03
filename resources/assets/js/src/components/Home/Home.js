import React from 'react';
import { connect } from 'react-redux';
import { Link } from 'react-router-dom';
import PropTypes from 'prop-types';

import Banner from './Banner';
import MainView from './MainView';

class Home extends React.Component {
  render() {
    return (
      <div className="home-page">
        <Banner token={null} appName="poster" />

        <div className="container page">
          <div className="row">
            <MainView />
            <Link to="/signin">Signin</Link>
          </div>
        </div>
      </div>
    );
  }
}

Home.contextTypes = {
  token: PropTypes.string,
};

export default connect(null, null)(Home);
