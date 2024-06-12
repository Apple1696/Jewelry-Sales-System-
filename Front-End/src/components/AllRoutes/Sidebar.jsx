import React, { useState } from 'react';
import {
  FaTh,
  FaBars,
  FaRegChartBar,
  FaMoneyBillWave,
  FaRegGem,
  FaHandshake
} from "react-icons/fa";
import { BsCurrencyDollar } from "react-icons/bs";
import { NavLink } from 'react-router-dom';
import { IoMdExit } from "react-icons/io";
import './AllRoutes.css'
import handleRedirect from './../HandleFunction/handleRedirect';

const Sidebar = ({ children }) => {
  const [showLogoutModal, setShowLogoutModal] = useState(false);
  const [isBlurred, setIsBlurred] = useState(false);
  const handleLogout = () => {
    setShowLogoutModal(true);
    setIsBlurred(true);
  };
  // const handleLogoutConfirm = () => {
  //   // Add your logout logic here, e.g. calling an API to log out the user
  //   // For now, we'll just redirect to the login page
  //   window.location.href = '/login';
  // };
  const{handleLogoutConfirm} = handleRedirect();

  const handleLogoutCancel = () => {
    setShowLogoutModal(false);
    setIsBlurred(false);
  };
  const [isOpen, setIsOpen] = useState(false);
  const toggle = () => setIsOpen(!isOpen);
  const menuItem = [
    {
      path: "/",
      name: "Dashboard",
      icon: <FaTh />
    },
    {
      path: "/sell",
      name: "Sell",
      icon: <FaMoneyBillWave />
    },
    {
      path: "/order-report",
      name: "Order Report",
      icon: <FaRegChartBar />
    },
    {
      path: "/product",
      name: "Product",
      icon: <FaRegGem />
    },
    {
      path: "/promotion",
      name: "Promotions",
      icon: <BsCurrencyDollar />
    },
    {
      path: "/rebuy",
      name: "Rebuy",
      icon: <FaHandshake />
    },
  ]
  return (
    <div className="container">
      <div style={{ width: isOpen ? "300px" : "50px" }} className={`sidebar ${isBlurred ? 'blurred' : ''}`}>
        <div className="top_section">
          <h1 style={{ display: isOpen ? "block" : "none" }} className="logo">Logo</h1>
          <div style={{ marginLeft: isOpen ? "150px" : "0px" }} className="bars">
            <FaBars onClick={toggle} />
          </div>
        </div>
        {
          menuItem.map((item, index) => (
            <NavLink to={item.path} key={index} className="link" activeClassName="active">
              <div className="icon">{item.icon}</div>
              <div style={{ display: isOpen ? "block" : "none" }} className="link_text">{item.name}</div>
            </NavLink>
          ))
        }
        <div className="link" onClick={handleLogout}>
          <div className="icon"><IoMdExit /></div>
          <div style={{ display: isOpen ? "block" : "none" }} className="link_text">Logout</div>
        </div>
      </div>
      <main style={{ filter: isBlurred ? 'blur(5px)' : 'none' }}>{children}</main>
      {
        showLogoutModal && (
          <div className="logout-modal">
            <div className="logout-modal-content">
              <h2>Are you sure you want to log out?</h2>
              <button onClick={handleLogoutConfirm}>Yes</button>
              <button onClick={handleLogoutCancel}>Cancel</button>
            </div>
          </div>
        )
      }
    </div>
  );
};

export default Sidebar;