import React, { useMemo, useState } from 'react';
import { useNavigate } from 'react-router-dom';
import { MaterialReactTable, useMaterialReactTable } from 'material-react-table';
import { Button } from '@mui/material';

import handleRedirect from '../HandleFunction/handleRedirect';

const data = [
  {
    name: {
      firstName: 'John',
      lastName: 'Doe',
    },
    address: '261 Erdman Ford',
    city: 'East Daphne',
    state: 'Kentucky',
  },
  {
    name: {
      firstName: 'Jane',
      lastName: 'Doe',
    },
    address: '769 Dominic Grove',
    city: 'Columbus',
    state: 'Ohio',
  },
  {
    name: {
      firstName: 'Joe',
      lastName: 'Doe',
    },
    address: '566 Brakus Inlet',
    city: 'South Linda',
    state: 'West Virginia',
  },
  {
    name: {
      firstName: 'Kevin',
      lastName: 'Vandy',
    },
    address: '722 Emie Stream',
    city: 'Lincoln',
    state: 'Nebraska',
  },
  {
    name: {
      firstName: 'Joshua',
      lastName: 'Rolluffs',
    },
    address: '32188 Larkin Turnpike',
    city: 'Charleston',
    state: 'South Carolina',
  },
 
 
 
];
 // your data array

const Product = () => {
  const { addProduct, addPromotion } = handleRedirect();
  const [showLogoutModal, setShowLogoutModal] = useState(false);

  const handleLogout = () => {
    setShowLogoutModal(true);
  };

  const handleLogoutConfirm = () => {
    // Add your logout logic here, e.g. calling an API to log out the user
    // For now, we'll just redirect to the login page
    window.location.href = '/login';
  };

  const handleLogoutCancel = () => {
    setShowLogoutModal(false);
  };

  const columns = useMemo(
    () => [
      {
        accessorKey: 'name.firstName', // access nested data with dot notation
        header: 'No',
        size: 150,
      },
      {
        accessorKey: 'name.lastName',
        header: 'ID',
        size: 150,
      },
      {
        accessorKey: 'address', // normal accessorKey
        header: 'Name',
        size: 200,
      },
      {
        accessorKey: 'city',
        header: 'Category',
        size: 150,
      },
      {
        accessorKey: 'tate',
        header: 'Price',
        size: 150,
      },
      {
        accessorKey: 'tate',
        header: 'Quantity',
        size: 150,
      },
    ],
    [],
  );

  const table = useMaterialReactTable({
    columns,
    data, // data must be memoized or stable (useState, useMemo, defined outside of this component, etc.)
  });

  return (
    <div>
      {showLogoutModal? (
        <div
          className="logout-modal"
          style={{
            position: 'absolute',
            top: 0,
            left: 0,
            width: '100%',
            height: '100%',
            backgroundColor: 'rgba(0, 0, 0, 0.5)',
            zIndex: 1000,
          }}
        >
          <div className="logout-modal-content">
            <h2>Are you sure you want to log out?</h2>
            <button onClick={handleLogoutConfirm}>Yes</button>
            <button onClick={handleLogoutCancel}>Cancel</button>
          </div>
        </div>
      ) : null}
      <div
        className="table-container"
        style={{
          opacity: showLogoutModal? 0 : 1,
          transition: 'opacity 0.3s',
        }}
      >
        <MaterialReactTable table={table} />
        <Button
          variant="contained"
          color="primary"
          style={{ marginTop: '16px' }}
          onClick={addProduct}
        >
          Add Product
        </Button>
      </div>
    </div>
  );
};

export default Product;