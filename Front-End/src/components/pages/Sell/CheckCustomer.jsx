// CheckCustomer.jsx

import React, { useState } from 'react';
import axios from 'axios';
import { Button, Snackbar } from '@mui/material';

const CheckCustomer = ({ fullName, phoneNumber, onValidCustomer }) => {
  const [message, setMessage] = useState('');

  const handleInspect = () => {
    if (!fullName && !phoneNumber) {
      setMessage('Invalid');
      return;
    }

    axios.get(`https://6670fb58e083e62ee439a8f8.mockapi.io/Customer?fullName=${fullName}&phoneNumber=${phoneNumber}`)
      .then(response => {
        if (response.data.length > 0) {
          // If customer exists, proceed with further action
          onValidCustomer();
        } else {
          setMessage('Invalid');
        }
      })
      .catch(error => {
        console.error('Error checking customer:', error);
        setMessage('Error checking customer');
      });
  };

  const handleCloseMessage = () => {
    setMessage('');
  };

  return (
    <>
      <Button variant="contained" color="primary" onClick={handleInspect}>
        Inspect
      </Button>
      <Snackbar
        open={!!message}
        autoHideDuration={3000}
        onClose={handleCloseMessage}
        message={message}
        anchorOrigin={{ vertical: 'bottom', horizontal: 'center' }}
      />
    </>
  );
};

export default CheckCustomer;
