package com.swp391.jewelrysalessystem.repositories;

import com.swp391.jewelrysalessystem.models.OrderDetail;
import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.stereotype.Repository;

@Repository
public interface OrderDetailRepo extends JpaRepository<OrderDetail, Integer> {
}
