package com.swp391.jewelrysalessystem.Controllers;

import com.swp391.jewelrysalessystem.models.JewelryItem;
import com.swp391.jewelrysalessystem.services.Impl.JewqueryItemServiceImp;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.RestController;

import java.util.List;

@RestController(value = "/jewelryitems")
public class JewlqueryItemController {

    private final JewqueryItemServiceImp jewqueryItemServiceImp;

    public JewlqueryItemController(JewqueryItemServiceImp jewqueryItemServiceImp) {
        this.jewqueryItemServiceImp = jewqueryItemServiceImp;
    }

    @GetMapping("/")
    public ResponseEntity<List<JewelryItem>> getAll() {
        List<JewelryItem> list = jewqueryItemServiceImp.getAllJewlQueryItems();
        return ResponseEntity.ok(list);
    }
}
