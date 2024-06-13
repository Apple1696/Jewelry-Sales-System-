import React, { useMemo, useState } from 'react';
import { MaterialReactTable } from 'material-react-table';
import { Button, Stack, IconButton } from '@mui/material';
import { FaEdit, FaTrash } from 'react-icons/fa'; // Import icons from react-icons
import { Modal, Input } from 'antd'; // Import Ant Design components

import handleRedirect from './../../HandleFunction/handleRedirect';
import Edit from './Edit';

const initialData = [
  {
    id: 1,
    name: {
      firstName: 'John',
      lastName: 'Doe',
    },
    address: '261 Erdman Ford',
    city: 'East Daphne',
    state: 'Kentucky',
  },
  {
    id: 2,
    name: {
      firstName: 'Jane',
      lastName: 'Doe',
    },
    address: '769 Dominic Grove',
    city: 'Columbus',
    state: 'Ohio',
  },
  {
    id: 3,
    name: {
      firstName: 'Joe',
      lastName: 'Doe',
    },
    address: '566 Brakus Inlet',
    city: 'South Linda',
    state: 'West Virginia',
  },
  {
    id: 4,
    name: {
      firstName: 'Kevin',
      lastName: 'Vandy',
    },
    address: '722 Emie Stream',
    city: 'Lincoln',
    state: 'Nebraska',
  },
  {
    id: 5,
    name: {
      firstName: 'Joshua',
      lastName: 'Rolluffs',
    },
    address: '32188 Larkin Turnpike',
    city: 'Charleston',
    state: 'South Carolina',
  },
];

const Product = () => {
  const { addProduct } = handleRedirect();
  const [data, setData] = useState(initialData);
  const [showLogoutModal] = useState(false);
  const [isModalVisible, setIsModalVisible] = useState(false);
  const [currentRow, setCurrentRow] = useState(null);

  const handleEdit = (row) => {
    setCurrentRow(row);
    setIsModalVisible(true);
  };

  const handleDelete = (row) => {
    setData((prevData) => prevData.filter((item) => item.id !== row.original.id));
    console.log("Delete", row.original.id);
    // Here you can add your API call to delete the item from the server
    // Example:
    // fetch(`your-api-endpoint/${row.original.id}`, {
    //   method: 'DELETE',
    // })
    // .then(response => response.json())
    // .then(data => {
    //   console.log('Item deleted:', data);
    // })
    // .catch(error => {
    //   console.error('Error deleting item:', error);
    // });
  };

  const columns = useMemo(
    () => [
      {
        accessorKey: 'name.firstName', // access nested data with dot notation
        header: 'ID',
        size: 150,
      },
      {
        accessorKey: 'name.lastName',
        header: 'Name',
        size: 150,
      },
      {
        accessorKey: 'address', // normal accessorKey
        header: 'Category',
        size: 200,
      },
      {
        accessorKey: 'city',
        header: 'Price',
        size: 150,
      },
      {
        accessorKey: 'state',
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

      <Edit
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
