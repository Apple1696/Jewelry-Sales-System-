package com.swp391.jewelrysalessystem.Controllers;

import com.swp391.jewelrysalessystem.models.Promotion;
import com.swp391.jewelrysalessystem.services.PromotionService;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RestController;

import java.util.List;

@RestController
@RequestMapping("/api/promotion")
public class PromotionController {
    @Autowired
    private PromotionService promotionService;
    @GetMapping("/viewAllApprove")
    public ResponseEntity<List<Promotion>> GetPromotionApproveTrue(){
        List<Promotion> approvePromotions = promotionService.getPromotionsApproveTrue();
        return ResponseEntity.ok(approvePromotions);
    }
}
