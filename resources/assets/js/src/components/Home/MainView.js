import React from 'react';
import { connect } from 'react-redux';

const MainView = () => {
  return (
    <div className="col-md-9">
      <div className="feed-toggle">Poster</div>
    </div>
  );
};

export default connect(null, null)(MainView);
