import React, { useState, useMemo } from 'react';
import { Typography, Box, Button } from '@mui/material';
import CustomTable from './../../Designs/CustomTable';

export default function Rebuy() {
  const [rebuyItems, setRebuyItems] = useState([
    { id: 1, name: 'Ring', description: 'Gold Ring', price: 100, quantity: 1 },
    { id: 2, name: 'Necklace', description: 'Silver Necklace', price: 50, quantity: 2 },
    { id: 3, name: 'Earrings', description: 'Diamond Earrings', price: 200, quantity: 3 },
    { id: 4, name: 'Bracelet', description: 'Gold Bracelet', price: 150, quantity: 4 },
  ]);

  const [selectedRebuyItem, setSelectedRebuyItem] = useState(null);

  const columns = useMemo(
    () => [
      {
        accessorKey: 'id',
        header: 'ID',
        size: 150,
      },
      {
        accessorKey: 'name',
        header: 'Item Name',
        size: 200,
      },
      {
        accessorKey: 'description',
        header: 'Description',
        size: 200,
      },
      {
        accessorKey: 'price',
        header: 'Price',
        size: 150,
      },
      {
        accessorKey: 'quantity',
        header: 'Quantity',
        size: 150,
      },
      {
        accessorKey: 'rebuy',
        header: 'Rebuy',
        size: 100,
        Cell: ({ row }) => (
          <Button
            variant="contained"
            sx={{
              backgroundColor: selectedRebuyItem === row.id ? '#333' : '#fff',
              color: selectedRebuyItem === row.id ? '#fff' : '#333',
              cursor: row.quantity <= 0 ? 'not-allowed' : 'pointer',
              opacity: row.quantity <= 0 ? 0.5 : 1,
              pointerEvents: row.quantity <= 0 ? 'none' : 'auto',
            }}
            onClick={() => {
              if (row.quantity > 0) {
                setSelectedRebuyItem(selectedRebuyItem === row.id ? null : row.id);
              }
            }}
            disabled={row.quantity <= 0}
          >
            {selectedRebuyItem === row.id ? 'Unrebuy' : 'Rebuy'}
          </Button>
        ),
      },
    ],
    [selectedRebuyItem],
  );

  const handleConfirm = () => {
    // Navigate back to sell page
    console.log('Confirm button clicked');
  };

  const isConfirmButtonDisabled = selectedRebuyItem === null;

  return (
    <Box
      sx={{
        backgroundColor: '#f0f0f0',
        padding: 2,
        borderRadius: 1,
        boxShadow: '0px 0px 10px rgba(0,0,0,0.1)',
      }}
    >
      <Box display="flex" alignItems="center" mb={2}>
        <Typography variant="h5" sx={{ color: '#333', flexGrow: 1 }}>
          Rebuy Items
        </Typography>
      </Box>
      <Box height={400} sx={{ overflowY: 'auto' }}>
        <CustomTable columns={columns} data={rebuyItems} />
      </Box>
      <Box display="flex" alignItems="center" mt={2}>
        <Button variant="contained" sx={{ backgroundColor: '#333', color: '#fff', mr: 2 }} disabled={isConfirmButtonDisabled} onClick={handleConfirm}>
          Confirm
        </Button>
        <Button variant="contained" sx={{ backgroundColor: '#333', color: '#fff' }} href="/sell">
          Back
        </Button>
      </Box>
    </Box>
  );
}
