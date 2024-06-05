package com.swp391.jewelrysalessystem.services.Impl;

import com.swp391.jewelrysalessystem.models.Customer;
import com.swp391.jewelrysalessystem.repositories.CustomerRepo;
import com.swp391.jewelrysalessystem.services.CustomerService;
import jakarta.transaction.Transactional;
import org.springframework.stereotype.Service;

@Service
@Transactional
public class CustomerServiceImpl implements CustomerService {

    private final CustomerRepo customerRepo;

    public CustomerServiceImpl(CustomerRepo customerRepo) {
        this.customerRepo = customerRepo;
    }

    @Override
    public Customer getCustomerbyfullNameAndphoneNumber(String fullName, String phone) {
        return customerRepo.findByFullNameAndPhoneNumber(fullName,phone);
    }
}
