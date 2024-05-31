import React, { useState } from 'react';
import {
    FaTh,
    FaBars,
    FaRegChartBar,
    FaMoneyBillWave,
    FaRegGem
}from "react-icons/fa";
import { BsCurrencyDollar } from "react-icons/bs";
import { NavLink } from 'react-router-dom';
import { IoMdExit } from "react-icons/io";
import './AllRoutes.css'

const Sidebar = ({children}) => {
    const[isOpen ,setIsOpen] = useState(false);
    const toggle = () => setIsOpen (!isOpen);
    const menuItem=[
        {
            path:"/",
            name:"Dashboard",
            icon:<FaTh/>
        },
        {
            path:"/sell",
            name:"Sell",
            icon:<FaMoneyBillWave />
        },
        {
            path:"/order-report",
            name:"Order Report",
            icon:<FaRegChartBar/>
        },
        {
            path:"/product",
            name:"Product",
            icon:<FaRegGem />
        },
        {
            path:"/promotion",
            name:"Promotions",
            icon:<BsCurrencyDollar/>
        },
        {
            path:"/logout",
            name:"Logout",
            icon:<IoMdExit />
        }
    ]
    return (
        <div className="container">
           <div style={{width: isOpen ? "200px" : "50px"}} className="sidebar">
               <div className="top_section">
                   <h1 style={{display: isOpen ? "block" : "none"}} className="logo">Logo</h1>
                   <div style={{marginLeft: isOpen ? "50px" : "0px"}} className="bars">
                       <FaBars onClick={toggle}/>
                   </div>
               </div>
               {
                   menuItem.map((item, index)=>(
                       <NavLink to={item.path} key={index} className="link" activeclassName="active">
                           <div className="icon">{item.icon}</div>
                           <div style={{display: isOpen ? "block" : "none"}} className="link_text">{item.name}</div>
                       </NavLink>
                   ))
               }
           </div>
           <main>{children}</main>
        </div>
    );
};

export default Sidebar;