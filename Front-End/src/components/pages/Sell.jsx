import React, { useState } from 'react';

const Sell = () => {
  const [showCart, setShowCart] = useState(false);

  const handleSave = () => {
    setShowCart(true);
  };

  return (
    <div>
      <h1>Customer and Order details</h1>
      <div>
        <label>Order ID:</label>
        <input type="text" />
        <br />
        <label>Order Date:</label>
        <input type="date" />
        <br />
        <label>Customer Name:</label>
        <input type="text" />
        <br />
        <label>Contact Info:</label>
        <input type="text" />
        <br />
        <button onClick={handleSave}>Save</button>
      </div>
      {showCart && (
        <div>
          <h2>Add items into cart</h2>
          <label>Product Name:</label>
          <input type="text" />
          <br />
          <label>Enter Product ID:</label>
          <input type="text" />
          <br />
          <h3>Order Item Details</h3>
          <button>Promotion</button>
          <button>Next</button>
        </div>
      )}
    </div>
  );
};

export default Sell;