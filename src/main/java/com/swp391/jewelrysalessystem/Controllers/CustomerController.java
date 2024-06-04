package com.swp391.jewelrysalessystem.Controllers;

import com.swp391.jewelrysalessystem.models.Customer;
import com.swp391.jewelrysalessystem.services.CustomerService;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.RequestParam;
import org.springframework.web.bind.annotation.RestController;

@RestController(value = "/customer")
public class CustomerController {

    @Autowired
    private CustomerService customerService;

    @GetMapping("findbyfullNameorPhoneNumber")
    public ResponseEntity<Customer> getCustomer(@RequestParam String fullName, @RequestParam String phoneNumber) {
        Customer c = customerService.getCustomerbyfullNameorphoneNumber(fullName,phoneNumber);
        if (c == null) {
            return ResponseEntity.notFound().build();
        }
        return ResponseEntity.ok(c);
    }
}
