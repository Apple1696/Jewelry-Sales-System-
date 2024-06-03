package com.swp391.jewelrysalessystem.Controllers;

import com.swp391.jewelrysalessystem.JWTConfig.JWTUtil;
import com.swp391.jewelrysalessystem.models.Role;
import com.swp391.jewelrysalessystem.models.User;
import com.swp391.jewelrysalessystem.repositories.UserRepo;
import jakarta.annotation.security.RolesAllowed;
import org.apache.catalina.mapper.Mapper;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;

import java.util.List;

@RestController(value = "/user")
public class UserController {

    @Autowired
    private JWTUtil jwtUtil;

    @Autowired
    private UserRepo _userrepo;

    @GetMapping(path = "/login")
    public String login() {
        Role r = new Role();

        r.setName("ROLE_USER");
        r.setDescription("ROLE_USER");

        User u = new User();
        u.setName("tung");
        u.setRole(r);
        String token = jwtUtil.generateToken(u);
        return token;
    }

    @GetMapping(path = "/viewalluser")
    public ResponseEntity<List<User>> viewAllUser() {

        List<User> users = _userrepo.findAll();
        return ResponseEntity.ok(users);
    }

}