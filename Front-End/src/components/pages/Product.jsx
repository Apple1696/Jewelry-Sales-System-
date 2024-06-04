import { useMemo } from 'react';
import { useNavigate } from 'react-router-dom';
import {
  MaterialReactTable,
  useMaterialReactTable,
} from 'material-react-table';

//nested data is ok, see accessorKeys in ColumnDef below
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

const Product = () => {
  const navigate = useNavigate();

  //should be memoized or stable
  const columns = useMemo(
    () => [
      {
        accessorKey: 'name.firstName', //access nested data with dot notation
        header: 'No',
        size: 150,
      },
      {
        accessorKey: 'name.lastName',
        header: 'ID',
        size: 150,
      },
      {
        accessorKey: 'address', //normal accessorKey
        header: 'Name',
        size: 200,
      },
      {
        accessorKey: 'city',
        header: 'Category',
        size: 150,
      },
      {
        accessorKey: 'state',
        header: 'Price',
        size: 150,
      },
      {
        accessorKey: 'state',
        header: 'Quantity',
        size: 150,
      },
      // {
      //   accessorKey: 'state',
      //   header: 'Action',
      //   size: 150,
      // },
    ],
    [],
  );

  const table = useMaterialReactTable({
    columns,
    data, //data must be memoized or stable (useState, useMemo, defined outside of this component, etc.)
  });

  const handleAdd = () => {
    navigate('/add-product'); // replace with your actual route
  };

  return (
    <div>
      <MaterialReactTable table={table} />
      <button onClick={handleAdd}>Add</button>
    </div>
  );
};

export default Product;