package com.swp391.jewelrysalessystem.repositories;

import com.swp391.jewelrysalessystem.models.Order;
import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.stereotype.Repository;

@Repository
public interface OrderRepo extends JpaRepository<Order, Integer> {
}
