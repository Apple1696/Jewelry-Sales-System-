package com.swp391.jewelrysalessystem.services;

import com.swp391.jewelrysalessystem.models.Customer;

public interface CustomerService {
    public Customer getCustomerbyfullNameorphoneNumber(String fullName, String phoneNumber);
}
