package com.swp391.jewelrysalessystem.repositories;

import com.swp391.jewelrysalessystem.models.Gem;
import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.stereotype.Repository;

@Repository
public interface GemRepo extends JpaRepository<Gem, Integer> {
}
