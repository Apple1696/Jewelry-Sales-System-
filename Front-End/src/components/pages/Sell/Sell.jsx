import React, { useState, useEffect, useMemo } from 'react';
import axios from 'axios';
import CustomTable from '../../Designs/CustomTable';
import handleRedirect from './../../HandleFunction/handleRedirect';
import { TextField, Button, Box, Typography } from '@mui/material';
import { createTheme, ThemeProvider } from '@mui/material/styles';

const theme = createTheme({
  palette: {
    primary: {
      main: '#333',
    },
    secondary: {
      main: '#666',
    },
  },
});

const Sell = () => {
  const [showCart, setShowCart] = useState(false);
  const [cartItems, setCartItems] = useState([]);
  const [productName, setProductName] = useState('');
  const [productId, setProductId] = useState('');
  const [pricePerUnit, setPricePerUnit] = useState(0);
  const { pickPromotion } = handleRedirect();
  const [totalAmount, setTotalAmount] = useState(0);

  useEffect(() => {
    axios.get('https://666aa8737013419182d04e24.mockapi.io/api/Products')
      .then(response => {
        setCartItems(response.data);
        const total = response.data.reduce((acc, item) => acc + item.totalCost, 0);
        setTotalAmount(total);
      })
      .catch(error => {
        console.error('Error fetching the products:', error);
      });
  }, []);

  const handleSave = () => {
    setShowCart(true);
  };

  const handleAddItem = () => {
    if (!productId || !productName || !pricePerUnit) {
      alert('All fields are required');
      return;
    }

    const newItem = {
      productId,
      productName,
      pricePerUnit,
      totalCost: pricePerUnit, // Assuming quantity is 1 for simplicity
    };

    axios.post('https://666aa8737013419182d04e24.mockapi.io/api/Products', newItem)
      .then(response => {
        const updatedItems = [...cartItems, response.data];
        setCartItems(updatedItems);
        setTotalAmount(updatedItems.reduce((acc, item) => acc + item.totalCost, 0));
        setProductName('');
        setProductId('');
        setPricePerUnit(0);
      })
      .catch(error => {
        console.error('Error adding the product:', error);
      });
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

  return (
    <ThemeProvider theme={theme}>
      <Box p={2} sx={{ maxWidth: 800, mx: 'auto', py: 4 }}>
        <Typography variant="h1" gutterBottom>
          Customer and Cart details
        </Typography>
        <Box mb={2}>
          <TextField
            label="Enter Customer Name or Contact Info"
            margin="normal"
            variant="outlined"
            fullWidth
            sx={{ mb: 2 }}
          />
          <Button
            variant="contained"
            color="primary"
            onClick={handleSave}
            sx={{ mr: 2 }}
          >
            Inspect
          </Button>
          <Button
            variant="contained"
            sx={{ mr: 2 }}
          >
            Add new customer
          </Button>
        </Box>
        {showCart && (
          <Box mb={2}>
            <Typography variant="h2" gutterBottom>
              Add items into cart
            </Typography>
            <TextField
              label="Product Name"
              value={productName}
              onChange={(e) => setProductName(e.target.value)}
              margin="normal"
              variant="outlined"
              fullWidth
              sx={{ mb: 2 }}
            />
            <TextField
              label="Product ID"
              value={productId}
              onChange={(e) => setProductId(e.target.value)}
              margin="normal"
              variant="outlined"
              fullWidth
              sx={{ mb: 2 }}
            />
            <TextField
              label="Price Per Unit"
              type="number"
              value={pricePerUnit}
              onChange={(e) => setPricePerUnit(parseFloat(e.target.value))}
              margin="normal"
              variant="outlined"
              fullWidth
              sx={{ mb: 2 }}
            />
            <Button
              variant="contained"
              color="primary"
              onClick={handleAddItem}
              sx={{ mr: 2 }}
            >
              Add item
            </Button>
          </Box>
        )}
        {showCart && (
          <Box>
            <Typography variant="h3" gutterBottom>
              Cart Details
            </Typography>
            <br />
            <CustomTable columns={columns} data={cartItems} />
            <br />
            <Typography variant="h4" gutterBottom>
              Total Amount: {totalAmount.toFixed(2)}
            </Typography>
            <Button
              variant="contained"
              color="primary"
              onClick={pickPromotion}
              sx={{ mr: 2 }}
            >
              Promotion
            </Button>
            <Button
              variant="contained"
              color="primary"
              sx={{ mr: 2 }}
            >
              Next
            </Button>
          </Box>
        )}
      </Box>
    </ThemeProvider>
  );
};

export default Sell;
