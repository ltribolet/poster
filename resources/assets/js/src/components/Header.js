import React from 'react';
import PropTypes from 'prop-types';

const Header = ({ appName }) => {
  return (
    <nav className="navbar navbar-light">
      <div className="container">{appName}</div>
    </nav>
  );
};

Header.propTypes = {
  appName: PropTypes.string,
};

export default Header;
