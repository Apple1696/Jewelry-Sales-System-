package com.swp391.jewelrysalessystem.repositories;

import com.swp391.jewelrysalessystem.models.User;
import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.stereotype.Repository;

@Repository
public interface UserRepo extends JpaRepository<User, Integer> {
}
