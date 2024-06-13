import React, { useState, useMemo } from 'react';
import { Box } from '@mui/material';
import CustomTable from './../../Designs/CustomTable';
import AddPromotion from './AddPromotion';

const Promotion = () => {
  // State to hold the promotions
  const [promotions, setPromotions] = useState([
    { id: 1, name: 'Promo 1', description: 'Description 1', startDate: '2023-06-01', endDate: '2023-06-30', status: 'Active' },
    { id: 2, name: 'Promo 2', description: 'Description 2', startDate: '2023-07-01', endDate: '2023-07-31', status: 'Expired' },
    { id: 3, name: 'Promo 3', description: 'Description 3', startDate: '2023-08-01', endDate: '2023-08-31', status: 'Active' },
    { id: 4, name: 'Promo 4', description: 'Description 4', startDate: '2023-09-01', endDate: '2023-09-30', status: 'Upcoming' },
  ]);

  // Handler for adding a promotion
  const addPromotion = (newPromotion) => {
    setPromotions([...promotions, newPromotion]);
  };

  // Define the columns for the table
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
    ],
    [],
  );

  return (
    <Box p={2}>
      <AddPromotion addPromotion={addPromotion} />
      <Box height={400}>
        <CustomTable columns={columns} data={promotions} />
      </Box>
    </Box>
  );
};

export default Promotion;
