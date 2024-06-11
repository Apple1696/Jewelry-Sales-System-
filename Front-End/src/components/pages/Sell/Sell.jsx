import React, { useState, useMemo } from 'react';
import CustomTable from '../../Designs/CustomTable';
import handleRedirect from './../../HandleFunction/handleRedirect';
import { TextField, Button, Box } from '@mui/material';

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
  const { pickPromotion } = handleRedirect();

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
    <Box p={2}>
      <h1>Customer and Cart details</h1>
      <Box mb={2}>
        <TextField
          label="Enter Customer Name or Contact Info"
          margin="normal"
          variant="outlined"
          fullWidth
        />
        <Button
          variant="contained"
          color="primary"
          onClick={handleSave}
          style={{ marginTop: '16px' }}
        >
          Inspect
        </Button>
        <Button
          variant="contained"
          style={{ marginTop: '16px', marginLeft: '16px' }}
        >
          Add new customer
        </Button>
      </Box>
      {showCart && (
        <Box mb={2}>
          <h2>Add items into cart</h2>
          <TextField
            label="Product Name"
            value={productName}
            onChange={(e) => setProductName(e.target.value)}
            margin="normal"
            variant="outlined"
            fullWidth
          />
          <TextField
            label="Product ID"
            value={productId}
            onChange={(e) => setProductId(e.target.value)}
            margin="normal"
            variant="outlined"
            fullWidth
          />
          <TextField
            label="Price Per Unit"
            type="number"
            value={pricePerUnit}
            onChange={(e) => setPricePerUnit(parseFloat(e.target.value))}
            margin="normal"
            variant="outlined"
            fullWidth
          />
          <Button
            variant="contained"
            color="primary"
            onClick={handleAddItem}
            style={{ marginTop: '16px' }}
          >
            Add item
          </Button>
        </Box>
      )}
      {showCart && (
        <Box>
          <h3>Cart Details</h3>
          <br/>
          <CustomTable columns={columns} data={cartItems} />
          <br />
          <h4>Total Amount: {totalAmount.toFixed(2)}</h4>
          <Button
            variant="contained"
            color="primary"
            onClick={pickPromotion}
            style={{ marginTop: '16px', marginRight: '16px' }}
          >
            Promotion
          </Button>
          <Button
            variant="contained"
            color="primary"
            style={{ marginTop: '16px' }}
          >
            Next
          </Button>
        </Box>
      )}
    </Box>
  );
};

export default Sell;
