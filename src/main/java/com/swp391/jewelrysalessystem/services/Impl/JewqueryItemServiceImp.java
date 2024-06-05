package com.swp391.jewelrysalessystem.services.Impl;

import com.swp391.jewelrysalessystem.models.JewelryItem;
import com.swp391.jewelrysalessystem.repositories.JewelryItemRepo;
import com.swp391.jewelrysalessystem.services.JewlqureryService;
import jakarta.transaction.Transactional;
import org.springframework.stereotype.Service;

import java.util.List;

@Service
@Transactional
public class JewqueryItemServiceImp implements JewlqureryService {

    private final JewelryItemRepo _jewelryItemRepo;
    public JewqueryItemServiceImp(JewelryItemRepo jewelryItemRepo) {
        _jewelryItemRepo = jewelryItemRepo;
    }

    @Override
    public List<JewelryItem> getAllJewlQueryItems() {
        return _jewelryItemRepo.findAll();
    }
}
