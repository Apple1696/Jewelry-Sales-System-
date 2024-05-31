package com.swp391.jewelrysalessystem.repositories;

import com.swp391.jewelrysalessystem.models.Invoice;
import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.stereotype.Repository;

@Repository
public interface InvoiceRepo extends JpaRepository<Invoice, Integer> {
}
