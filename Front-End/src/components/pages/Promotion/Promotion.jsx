import React, { useState, useEffect, useMemo } from 'react';
import { Box, IconButton, Stack } from '@mui/material';
import { FaEdit, FaTrash } from 'react-icons/fa';
import axios from 'axios';
import CustomTable from './../../Designs/CustomTable';
import AddPromotion from './AddPromotion';
import EditPromotion from './EditPromotion'; // Assuming you have an Edit component

const Promotion = () => {
  // State to hold the promotions
  const [promotions, setPromotions] = useState([]);
  const [isModalVisible, setIsModalVisible] = useState(false);
  const [currentRow, setCurrentRow] = useState(null);

  // Fetch data from the API
  useEffect(() => {
    const fetchPromotions = async () => {
      try {
        const response = await axios.get('https://666aa8737013419182d04e24.mockapi.io/api/Promotion');
        setPromotions(response.data);
      } catch (error) {
        console.error('Error fetching promotions:', error);
      }
    };

    fetchPromotions();
  }, []);

  // Handler for adding a promotion
  const addPromotion = (newPromotion) => {
    setPromotions([...promotions, newPromotion]);
  };

  const handleEdit = (row) => {
    setCurrentRow(row);
    setIsModalVisible(true);
  };

  const handleDelete = (row) => {
    setPromotions((prevPromotions) => prevPromotions.filter((item) => item.id !== row.original.id));
    console.log("Delete", row.original.id);
    // API call to delete the item
    axios.delete(`https://666aa8737013419182d04e24.mockapi.io/api/Promotion/${row.original.id}`)
      .then(response => {
        console.log('Item deleted:', response.data);
      })
      .catch(error => {
        console.error('Error deleting item:', error);
      });
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
        accessorKey: 'PromotionName',
        header: 'Promotion Name',
        size: 150,
      },
      {
        accessorKey: 'Description',
        header: 'Description',
        size: 150,
      },
      {
        accessorKey: 'StartDate',
        header: 'Start Date',
        size: 150,
      },
      {
        accessorKey: 'EndDate',
        header: 'End Date',
        size: 150,
      },
      {
        accessorKey: 'Status',
        header: 'Status',
        size: 150,
      },
      {
        accessorKey: 'action',
        header: 'Action',
        size: 150,
        Cell: ({ row }) => (
          <Stack direction="row" spacing={1}>
            <IconButton color="primary" onClick={() => handleEdit(row)}>
              <FaEdit />
            </IconButton>
            <IconButton color="secondary" onClick={() => handleDelete(row)}>
              <FaTrash />
            </IconButton>
          </Stack>
        ),
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

      <EditPromotion
        isVisible={isModalVisible}
        onClose={() => setIsModalVisible(false)}
        rowData={currentRow ? currentRow.original : null}
        updateData={(updatedRow) => {
          setPromotions((prevPromotions) =>
            prevPromotions.map((item) =>
              item.id === updatedRow.id ? { ...item, ...updatedRow } : item
            )
          );
        }}
      />
    </Box>
  );
};

export default Promotion;
