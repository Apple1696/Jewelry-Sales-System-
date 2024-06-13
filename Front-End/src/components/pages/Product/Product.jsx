import React, { useMemo, useState, useEffect } from 'react';
import { MaterialReactTable } from 'material-react-table';
import { Button, Stack, IconButton } from '@mui/material';
import { FaEdit, FaTrash } from 'react-icons/fa';
import { Modal, Input } from 'antd';
import axios from 'axios'; // Import Axios

import handleRedirect from './../../HandleFunction/handleRedirect';
import EditProduct from './EditProduct';

const Product = () => {
  const { addProduct } = handleRedirect();
  const [data, setData] = useState([]);
  const [isModalVisible, setIsModalVisible] = useState(false);
  const [currentRow, setCurrentRow] = useState(null);

  useEffect(() => {
    // Fetch data from the API
    axios.get('https://666aa8737013419182d04e24.mockapi.io/api/Products')
      .then(response => {
        setData(response.data); // Assume the response contains an array of products
      })
      .catch(error => {
        console.error('Error fetching data:', error);
      });
  }, []); // Empty dependency array means this effect runs once on mount

  const handleEdit = (row) => {
    setCurrentRow(row);
    setIsModalVisible(true);
  };

  const handleDelete = (row) => {
    setData((prevData) => prevData.filter((item) => item.id !== row.original.id));
    console.log("Delete", row.original.id);
    // API call to delete the item
    axios.delete(`https://666aa8737013419182d04e24.mockapi.io/api/Products${row.original.id}`)
      .then(response => {
        console.log('Item deleted:', response.data);
      })
      .catch(error => {
        console.error('Error deleting item:', error);
      });
  };

  const columns = useMemo(
    () => [
      {
        accessorKey: 'id', // Adjusted to match actual API response
        header: 'ID',
        size: 150,
      },
      {
        accessorKey: 'name',
        header: 'Name',
        size: 150,
      },
      {
        accessorKey: 'category', // Adjusted to match actual API response
        header: 'Category',
        size: 150,
      },
      {
        accessorKey: 'price', // Adjusted to match actual API response
        header: 'Price',
        size: 150,
      },
      {
        accessorKey: 'quantity', // Adjusted to match actual API response
        header: 'Quantity',
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
    <div>
      <div className="table-container">
        <MaterialReactTable columns={columns} data={data} />
        <Button
          variant="contained"
          color="primary"
          style={{ marginTop: '16px' }}
          onClick={addProduct}
        >
          Add Product
        </Button>
      </div>

      <EditProduct
        isVisible={isModalVisible}
        onClose={() => setIsModalVisible(false)}
        rowData={currentRow ? currentRow.original : null}
        updateData={(updatedRow) => {
          setData((prevData) =>
            prevData.map((item) =>
              item.id === updatedRow.id ? { ...item, ...updatedRow } : item
            )
          );
        }}
      />
    </div>
  );
};

export default Product;
