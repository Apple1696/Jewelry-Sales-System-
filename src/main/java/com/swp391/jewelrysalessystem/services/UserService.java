package com.swp391.jewelrysalessystem.services;

import com.swp391.jewelrysalessystem.models.User;
import org.springframework.stereotype.Service;

import java.util.List;


public interface UserService {
    public List<User> getAllUsers();
}
