package com.swp391.jewelrysalessystem.repositories;

import com.swp391.jewelrysalessystem.models.JewelryItem;
import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.stereotype.Repository;

@Repository
public interface JewelryItemRepo extends JpaRepository<JewelryItem, Integer> {
}
