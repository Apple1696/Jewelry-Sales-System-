import React from 'react'
import { useNavigate } from 'react-router-dom'

export default function handleRedirect() {
    const navigate = useNavigate();
    const pickPromotion=()=>navigate('/pick-promotion')
    const handleLogoutConfirm=()=>navigate('/login')
    return{
        pickPromotion,
        handleLogoutConfirm
    }
 
}
