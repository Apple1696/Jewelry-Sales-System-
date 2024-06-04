package com.swp391.jewelrysalessystem.services.Impl;

import com.swp391.jewelrysalessystem.models.Customer;
import com.swp391.jewelrysalessystem.repositories.CustomerRepo;
import com.swp391.jewelrysalessystem.services.CustomerService;
import jakarta.transaction.Transactional;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

@Service
@Transactional
public class CustomerServiceImpl implements CustomerService {

    @Autowired
    private CustomerRepo customerRepo;

    @Override
    public Customer getCustomerbyfullNameorphoneNumber(String fullName, String phoneNumber) {
        return customerRepo.findByFullNameOrPhoneNumber(fullName, phoneNumber);
    }
}
