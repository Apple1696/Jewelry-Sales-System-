package com.swp391.jewelrysalessystem.repositories;

import com.swp391.jewelrysalessystem.models.Gold;
import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.stereotype.Repository;

@Repository
public interface GoldRepo extends JpaRepository<Gold, Integer> {
}
