import React from 'react';
import { Link } from 'react-router-dom';

import MainView from './MainView';

export default class Home extends React.Component {
  render() {
    return (
      <div className="home-page">
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
