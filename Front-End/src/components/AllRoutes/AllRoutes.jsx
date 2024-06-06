import React from 'react';
import { BrowserRouter, Route, Routes } from 'react-router-dom';
import Sidebar from './Sidebar';
import Dashboard from './../pages/Dashboard';
import OrderReport from './../pages/OrderReport';
import Promotion from './../pages/Promotion';
import Product from './../pages/Product';
import Logout from './../pages/Logout';
import AddProduct from '../pages/AddProduct';
import Rebuy from './../pages/Rebuy';
import Sell from './../pages/Sell/Sell';
import PickPromotion from '../pages/Sell/PickPromotion';



const AllRoutes = () => {
  return (
    <BrowserRouter>
      <Sidebar>
        <Routes>
          <Route path="/" element={<Dashboard />} />
          <Route path="/dashboard" element={<Dashboard />} />
          <Route path="/sell" element={<Sell/>} />
          <Route path="/pick-promotion" element={<PickPromotion/>} />
          <Route path="/order-report" element={<OrderReport />} />
          <Route path="/promotion" element={<Promotion />} />
          <Route path="/product" element={<Product />} />
          <Route path="/add-product" element={<AddProduct />} />
          <Route path="/rebuy" element={<Rebuy />} />
          <Route path="/logout" element={<Logout />} />
        </Routes>
      </Sidebar>
    </BrowserRouter>
    );
  };

export default AllRoutes;