package com.swp391.jewelrysalessystem.models;

import jakarta.persistence.*;
import lombok.Getter;
import lombok.Setter;

import java.math.BigDecimal;

@Getter
@Setter
@Entity
@Table(name = "fee")
public class Fee {
    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    @Column(name = "id", nullable = false)
    private Integer id;

    @ManyToOne(fetch = FetchType.LAZY)
    @JoinColumn(name = "gem_id")
    private Gem gem;

    @Column(name = "charge", precision = 10, scale = 2)
    private BigDecimal charge;

    @Column(name = "stone_fee", precision = 10, scale = 2)
    private BigDecimal stoneFee;

    @Column(name = "discount_rate", precision = 10, scale = 2)
    private BigDecimal discountRate;

}