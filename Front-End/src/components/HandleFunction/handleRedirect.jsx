import React from 'react'
import { useNavigate } from 'react-router-dom'

export default function handleRedirect() {
    const navigate = useNavigate();
    const addProduct=()=> navigate('/add-product')
    // const addPromotion=()=> navigate('/add-promotion')
    const pickPromotion=()=>navigate('/pick-promotion')
    return{
        addProduct,
        // addPromotion,
        pickPromotion
    }
 
}
