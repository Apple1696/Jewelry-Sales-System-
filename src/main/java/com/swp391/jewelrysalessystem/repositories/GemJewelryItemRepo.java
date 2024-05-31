package com.swp391.jewelrysalessystem.repositories;

import com.swp391.jewelrysalessystem.models.GemsJewelryItem;
import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.stereotype.Repository;

@Repository
public interface GemJewelryItemRepo extends JpaRepository<GemsJewelryItem, Integer> {
}
