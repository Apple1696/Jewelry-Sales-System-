package com.swp391.jewelrysalessystem.services;

import com.swp391.jewelrysalessystem.models.Promotion;
import org.springframework.stereotype.Service;

import java.util.List;
@Service
public interface PromotionService {
    List<Promotion> getPromotionsApproveTrue();
}
