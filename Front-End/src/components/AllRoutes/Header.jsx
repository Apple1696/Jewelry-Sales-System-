import React from 'react';
import { FaUserCircle } from "react-icons/fa";

const Header = () => {
  return (
    <div className="header">
      <FaUserCircle size={25} />
      <span>User</span>
    </div>
  );
};

export default Header;