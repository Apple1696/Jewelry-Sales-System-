import React, { useState, useMemo } from 'react';
import { Typography, Box, Button } from '@mui/material';
import CustomTable from './../../Designs/CustomTable';

export default function PickPromotion() {
  const [promotions, setPromotions] = useState([
    { id: 1, name: 'Promo 1', description: 'Description 1', startDate: '2023-06-01', endDate: '2023-06-30', status: 'Active' },
    { id: 2, name: 'Promo 2', description: 'Description 2', startDate: '2023-07-01', endDate: '2023-07-31', status: 'Expired' },
    { id: 3, name: 'Promo 3', description: 'Description 3', startDate: '2023-08-01', endDate: '2023-08-31', status: 'Active' },
    { id: 4, name: 'Promo 4', description: 'Description 4', startDate: '2023-09-01', endDate: '2023-09-30', status: 'Upcoming' },
  ]);

  const [selectedPromotion, setSelectedPromotion] = useState(null);

  const columns = useMemo(
    () => [
      {
        accessorKey: 'id',
        header: 'ID',
        size: 150,
      },
      {
        accessorKey: 'name',
        header: 'Promotion Name',
        size: 200,
      },
      {
        accessorKey: 'description',
        header: 'Description',
        size: 200,
      },
      {
        accessorKey: 'startDate',
        header: 'Start Date',
        size: 150,
      },
      {
        accessorKey: 'endDate',
        header: 'End Date',
        size: 150,
      },
      {
        accessorKey: 'status',
        header: 'Status',
        size: 150,
      },
      {
        accessorKey: 'pick',
        header: 'Pick',
        size: 100,
        Cell: ({ row }) => (
          <Button
            variant="contained"
            sx={{
              backgroundColor: selectedPromotion === row.id ? '#333' : '#fff',
              color: selectedPromotion === row.id ? '#fff' : '#333',
              cursor: row.status === 'Expired' ? 'not-allowed' : 'pointer',
              opacity: row.status === 'Expired' ? 0.5 : 1,
              pointerEvents: row.status === 'Expired' ? 'none' : 'auto',
            }}
            onClick={() => {
              if (row.status !== 'Expired') {
                setSelectedPromotion(selectedPromotion === row.id ? null : row.id);
              }
            }}
            disabled={row.status === 'Expired'}
          >
            {selectedPromotion === row.id ? 'Unpick' : 'Pick'}
          </Button>
        ),
      },
    ],
    [selectedPromotion],
  );

  const handleConfirm = () => {
    // Navigate back to sell page
    console.log('Confirm button clicked');
  };

  const isConfirmButtonDisabled = selectedPromotion === null;

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
          Choose promotion for Order ID: 1234
        </Typography>
      </Box>
      <Box height={400} sx={{ overflowY: 'auto' }}>
        <CustomTable columns={columns} data={promotions} />
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
