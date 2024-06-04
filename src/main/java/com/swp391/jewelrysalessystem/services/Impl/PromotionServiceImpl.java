package com.swp391.jewelrysalessystem.services.Impl;

import com.swp391.jewelrysalessystem.models.Promotion;
import com.swp391.jewelrysalessystem.repositories.PromotionRepo;
import com.swp391.jewelrysalessystem.services.PromotionService;
import jakarta.transaction.Transactional;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import java.util.List;

@Service
@Transactional
public class PromotionServiceImpl implements PromotionService {
    private final PromotionRepo promotionRepo;
    @Autowired
    public PromotionServiceImpl(PromotionRepo promotionRepo) {
        this.promotionRepo = promotionRepo;
    }

    @Override
    public List<Promotion> getPromotionsApproveTrue() {
        List<Promotion> appovePromotion = promotionRepo.findByApproveTrue();
        return appovePromotion;
    }
}

