package com.swp391.jewelrysalessystem.repositories;

import com.swp391.jewelrysalessystem.models.Fee;
import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.stereotype.Repository;

@Repository
public interface FeeRepo extends JpaRepository<Fee, Integer> {
}
