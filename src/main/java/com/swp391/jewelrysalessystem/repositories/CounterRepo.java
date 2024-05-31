package com.swp391.jewelrysalessystem.repositories;

import com.swp391.jewelrysalessystem.models.Counter;
import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.stereotype.Repository;

@Repository
public interface CounterRepo extends JpaRepository<Counter, Integer> {
}
