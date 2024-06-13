import React from 'react'
import { TextField, Button, Box } from '@mui/material';
import CustomTable from './../../Designs/CustomTable';

export default function PickPromotion() {
// State to hold the input values
const [promotionId, setPromotionId] = useState('');
const [promotionName, setPromotionName] = useState('');
const [startDate, setStartDate] = useState('');
const [endDate, setEndDate] = useState('');
const [promotions, setPromotions] = useState([
  { id: 1, name: 'Promo 1', description: 'Description 1', startDate: '2023-06-01', endDate: '2023-06-30', status: 'Active' },
  { id: 2, name: 'Promo 2', description: 'Description 2', startDate: '2023-07-01', endDate: '2023-07-31', status: 'Expired' },
  { id: 3, name: 'Promo 3', description: 'Description 3', startDate: '2023-08-01', endDate: '2023-08-31', status: 'Active' },
  { id: 4, name: 'Promo 4', description: 'Description 4', startDate: '2023-09-01', endDate: '2023-09-30', status: 'Upcoming' },
]);
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
    <>
    <div>Choose promotion for Order ID: XXXX</div>
   <Box p={2}>
      <Box height={400}>
        <CustomTable columns={columns} data={promotions} />
      </Box>
   </Box>
   </>
  );
}
