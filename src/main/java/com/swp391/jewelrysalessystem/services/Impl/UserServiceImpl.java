package com.swp391.jewelrysalessystem.services.Impl;

import com.swp391.jewelrysalessystem.models.User;
import com.swp391.jewelrysalessystem.repositories.UserRepo;
import com.swp391.jewelrysalessystem.services.UserService;
import jakarta.transaction.Transactional;
import lombok.RequiredArgsConstructor;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.boot.autoconfigure.AutoConfiguration;
import org.springframework.stereotype.Service;

import java.util.List;

@Service
@Transactional

public class UserServiceImpl implements UserService {
    private final UserRepo userRepo;

    public UserServiceImpl(UserRepo userRepo) {
        this.userRepo = userRepo;
    }


    @Override
    public List<User> getAllUsers() {
        return userRepo.findAll();
    }
}
