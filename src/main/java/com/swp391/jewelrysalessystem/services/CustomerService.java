package com.swp391.jewelrysalessystem.services;

import com.swp391.jewelrysalessystem.models.Customer;


public interface CustomerService {
    Customer getCustomerbyfullNameAndphoneNumber(String fullname, String phoneNumber);
}
