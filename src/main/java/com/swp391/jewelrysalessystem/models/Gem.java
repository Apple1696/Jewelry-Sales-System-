package com.swp391.jewelrysalessystem.models;

import jakarta.persistence.*;
import lombok.Getter;
import lombok.Setter;
import org.hibernate.annotations.ColumnDefault;

import java.time.Instant;

@Getter
@Setter
@Entity
@Table(name = "gems")
public class Gem {
    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    @Column(name = "id", nullable = false)
    private Long id;

    @Column(name = "name", nullable = false)
    private String name;

    @ColumnDefault("0")
    @Column(name = "is_gem_stone", nullable = false)
    private Boolean isGemStone = false;

    @Column(name = "price", nullable = false)
    private Long price;

    @Column(name = "created_at")
    private Instant createdAt;

    @Column(name = "updated_at")
    private Instant updatedAt;

    @Column(name = "image")
    private String image;

}