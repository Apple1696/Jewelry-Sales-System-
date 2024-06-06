import React, { useState, useMemo } from 'react';
import CustomTable from '../../Designs/CustomTable';
import handleRedirect from './../../HandleFunction/handleRedirect';

const Sell = () => {
  const [showCart, setShowCart] = useState(false);
  const [cartItems, setCartItems] = useState([
    { productId: 'P001', productName: 'Product 1', pricePerUnit: 100, totalCost: 100 },
    { productId: 'P002', productName: 'Product 2', pricePerUnit: 200, totalCost: 200 },
    { productId: 'P003', productName: 'Product 3', pricePerUnit: 150, totalCost: 150 },
  ]);
  const [productName, setProductName] = useState('');
  const [productId, setProductId] = useState('');
  const [pricePerUnit, setPricePerUnit] = useState(0);
  const{pickPromotion}=handleRedirect();
  const handleSave = () => {
    setShowCart(true);
  };

  const handleAddItem = () => {
    const totalCost = pricePerUnit; // Assuming quantity is 1 for simplicity
    const newItem = {
      productId,
      productName,
      pricePerUnit,
      totalCost,
    };
    setCartItems([...cartItems, newItem]);
    setProductName('');
    setProductId('');
    setPricePerUnit(0);
  };

  const columns = useMemo(
    () => [
      {
        accessorKey: 'productId',
        header: 'Product ID',
        size: 150,
      },
      {
        accessorKey: 'productName',
        header: 'Product Name',
        size: 200,
      },
      {
        accessorKey: 'pricePerUnit',
        header: 'Price Per Unit',
        size: 150,
      },
      {
        accessorKey: 'totalCost',
        header: 'Total Cost',
        size: 150,
      },
    ],
    []
  );

  const totalAmount = cartItems.reduce((acc, item) => acc + item.totalCost, 0);

  return (
    <div>
      <h1>Customer and Cart details</h1>
      <div>
        <label>Enter Customer Name or Contact Info:</label>
        <br/>
        <input type="text" />
        <button onClick={handleSave}>Inspect</button>
      </div>
      <button>Add new customer</button>
      {showCart && (
        <div>
          <h2>Add items into cart</h2>
          <label>Product Name:</label>
          <input
            type="text"
            value={productName}
            onChange={(e) => setProductName(e.target.value)}
          />
          <br />
          <label>Product ID:</label>
          <input
            type="text"
            value={productId}
            onChange={(e) => setProductId(e.target.value)}
          />
          <br />
          <label>Price Per Unit:</label>
          <input
            type="number"
            value={pricePerUnit}
            onChange={(e) => setPricePerUnit(parseFloat(e.target.value))}
          />
          <br />
          <button onClick={handleAddItem}>Add item</button>

          <h3>Cart Details</h3>
          <CustomTable columns={columns} data={cartItems} />
          <br />
          <h4>Total Amount: {totalAmount.toFixed(2)}</h4>
          <button onClick={pickPromotion}>Promotion</button>
          <button>Next</button>
        </div>
      )}
    </div>
  );
};

export default Sell;
