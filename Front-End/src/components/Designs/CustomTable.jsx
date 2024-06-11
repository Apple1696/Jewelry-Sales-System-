import React, { useMemo } from 'react';
import { MaterialReactTable, useMaterialReactTable } from 'material-react-table';

const CustomTable = ({ columns, data }) => {
  const table = useMaterialReactTable({
    columns,
    data, // data must be memoized or stable (useState, useMemo, defined outside of this component, etc.)
  });

  return (
    <MaterialReactTable
      table={table}
      zIndex={0} // add this prop to set the z-index of the table
    />
  );
};

export default CustomTable;
