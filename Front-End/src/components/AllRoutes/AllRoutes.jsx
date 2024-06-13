import React from 'react';
import { BrowserRouter, Route, Routes, useLocation } from 'react-router-dom';
import Sidebar from './Sidebar';
import Dashboard from './../pages/Dashboard';
import OrderReport from './../pages/OrderReport';
import Promotion from './../pages/Promotion';
import Product from './../pages/Product';
import AddProduct from '../pages/AddProduct';
import Rebuy from './../pages/Rebuy';
import Sell from './../pages/Sell/Sell';
import PickPromotion from '../pages/Sell/PickPromotion';
import Login from './../Login';

const AllRoutes = () => {
  const location = useLocation();

  return (
    <div>
      {location.pathname !== '/login' ? (
        <Sidebar>
          <Routes>
            <Route path="/" element={<Dashboard />} />
            <Route path="/dashboard" element={<Dashboard />} />
            <Route path="/sell" element={<Sell />} />
            <Route path="/pick-promotion" element={<PickPromotion />} />
            <Route path="/order-report" element={<OrderReport />} />
            <Route path="/promotion" element={<Promotion />} />
            <Route path="/product" element={<Product />} />
            <Route path="/add-product" element={<AddProduct />} />
            <Route path="/rebuy" element={<Rebuy />} />
          </Routes>
        </Sidebar>
      ) : (
        <Routes>
          <Route path="/login" element={<Login />} />
        </Routes>
      )}
    </div>
  );
};

const App = () => {
  return (
    <BrowserRouter>
      <AllRoutes />
    </BrowserRouter>
  );Y
};

export default App;
