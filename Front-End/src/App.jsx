import { useState } from 'react'

import AllRoutes from './components/AllRoutes/AllRoutes';
import Login from './components/Login';

function App() {
  const [count, setCount] = useState(0)

  return (
    <>
   <AllRoutes/>
    </>
  )
}

export default App
