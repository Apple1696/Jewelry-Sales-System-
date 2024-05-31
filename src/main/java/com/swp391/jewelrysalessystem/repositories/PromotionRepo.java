package com.swp391.jewelrysalessystem.repositories;

import com.swp391.jewelrysalessystem.models.Promotion;
import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.stereotype.Repository;

@Repository
public interface PromotionRepo extends JpaRepository<Promotion, Integer> {
}
