DROP TRIGGER IF EXISTS `check_jumlah_terima_before_insert`;
delimiter ;;
CREATE TRIGGER `check_jumlah_terima_before_insert` BEFORE INSERT ON `detail_penerimaan` FOR EACH ROW BEGIN
    DECLARE max_jumlah INT;

    SELECT jumlah INTO max_jumlah
    FROM detail_pengadaan
    WHERE barang_id = NEW.barang_id
    AND pengadaan_id = (SELECT pengadaan_id FROM penerimaan WHERE penerimaan_id = NEW.penerimaan_id LIMIT 1);

    IF NEW.jumlah_terima > max_jumlah THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Jumlah terima tidak boleh melebihi jumlah pengadaan';
    END IF;
END
;;
delimiter ;

DROP TRIGGER IF EXISTS `after_insert_detail_penerimaan`;
delimiter ;;
CREATE TRIGGER `after_insert_detail_penerimaan` AFTER INSERT ON `detail_penerimaan` FOR EACH ROW BEGIN
    DECLARE current_stock INT;

    SELECT stock INTO current_stock
    FROM kartu_stok
    WHERE barang_id = NEW.barang_id
    ORDER BY kartu_stok_id DESC LIMIT 1;

    IF current_stock IS NULL THEN
        SET current_stock = 0;
    END IF;

    IF current_stock IS NOT NULL THEN
        INSERT INTO kartu_stok (jenis_transaksi, masuk, keluar, stock, created_at, transaksi_id, barang_id)
        VALUES ('O', NEW.jumlah_terima, 0, current_stock + NEW.jumlah_terima, NOW(), NEW.penerimaan_id, NEW.barang_id);
    END IF;
END
;;
delimiter ;

DROP TRIGGER IF EXISTS `check_jumlah_terima_before_update`;
delimiter ;;
CREATE TRIGGER `check_jumlah_terima_before_update` BEFORE UPDATE ON `detail_penerimaan` FOR EACH ROW BEGIN
    DECLARE max_jumlah INT;

    SELECT jumlah INTO max_jumlah
    FROM detail_pengadaan
    WHERE barang_id = NEW.barang_id
    AND pengadaan_id = (SELECT pengadaan_id FROM penerimaan WHERE penerimaan_id = NEW.penerimaan_id LIMIT 1);

    IF NEW.jumlah_terima > max_jumlah THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Jumlah terima tidak boleh melebihi jumlah pengadaan';
    END IF;
END
;;
delimiter ;

DROP TRIGGER IF EXISTS `after_update_detail_penerimaan`;
delimiter ;;
CREATE TRIGGER `after_update_detail_penerimaan` AFTER UPDATE ON `detail_penerimaan` FOR EACH ROW BEGIN
    DECLARE current_stock INT;

    SELECT stock INTO current_stock
    FROM kartu_stok
    WHERE barang_id = NEW.barang_id
    ORDER BY kartu_stok_id DESC LIMIT 1;

    IF current_stock IS NULL THEN
        SET current_stock = 0;
    END IF;

    IF current_stock IS NOT NULL THEN
        INSERT INTO kartu_stok (jenis_transaksi, masuk, keluar, stock, created_at, transaksi_id, barang_id)
        VALUES ('O', NEW.jumlah_terima - OLD.jumlah_terima, 0, current_stock + (NEW.jumlah_terima - OLD.jumlah_terima), NOW(), NEW.penerimaan_id, NEW.barang_id);
    END IF;
END
;;
delimiter ;

DROP TRIGGER IF EXISTS `after_delete_detail_penerimaan`;
delimiter ;;
CREATE TRIGGER `after_delete_detail_penerimaan` AFTER DELETE ON `detail_penerimaan` FOR EACH ROW BEGIN
    DECLARE current_stock INT;

    SELECT stock INTO current_stock
    FROM kartu_stok
    WHERE barang_id = OLD.barang_id
    ORDER BY kartu_stok_id DESC LIMIT 1;

    IF current_stock IS NULL THEN
        SET current_stock = 0;
    END IF;

    IF current_stock IS NOT NULL THEN
        INSERT INTO kartu_stok (jenis_transaksi, masuk, keluar, stock, created_at, transaksi_id, barang_id)
        VALUES ('O', OLD.jumlah_terima, 0, current_stock - OLD.jumlah_terima, NOW(), OLD.penerimaan_id, OLD.barang_id);
    END IF;
END
;;
delimiter ;

DROP TRIGGER IF EXISTS `after_insert_detail_pengadaan`;
delimiter ;;
CREATE TRIGGER `after_insert_detail_pengadaan` AFTER INSERT ON `detail_pengadaan` FOR EACH ROW BEGIN
    DECLARE current_stock INT;

    SELECT stock INTO current_stock
    FROM kartu_stok
    WHERE barang_id = NEW.barang_id
    ORDER BY kartu_stok_id DESC LIMIT 1;

    IF current_stock IS NULL THEN
        SET current_stock = 0;
    END IF;

    INSERT INTO kartu_stok (jenis_transaksi, masuk, keluar, stock, created_at, transaksi_id, barang_id)
    VALUES ('P', NEW.jumlah, 0, current_stock, NOW(), NEW.pengadaan_id, NEW.barang_id);
END
;;
delimiter ;

DROP TRIGGER IF EXISTS `after_update_detail_pengadaan`;
delimiter ;;
CREATE TRIGGER `after_update_detail_pengadaan` AFTER UPDATE ON `detail_pengadaan` FOR EACH ROW BEGIN
    DECLARE current_stock INT;

    SELECT stock INTO current_stock
    FROM kartu_stok
    WHERE barang_id = NEW.barang_id
    ORDER BY kartu_stok_id DESC LIMIT 1;

    IF current_stock IS NULL THEN
        SET current_stock = 0;
    END IF;

    INSERT INTO kartu_stok (jenis_transaksi, masuk, keluar, stock, created_at, transaksi_id, barang_id)
    VALUES ('P', NEW.jumlah - OLD.jumlah, 0, current_stock + (NEW.jumlah - OLD.jumlah), NOW(), NEW.pengadaan_id, NEW.barang_id);
END
;;
delimiter ;

DROP TRIGGER IF EXISTS `after_delete_detail_pengadaan`;
delimiter ;;
CREATE TRIGGER `after_delete_detail_pengadaan` AFTER DELETE ON `detail_pengadaan` FOR EACH ROW BEGIN
    -- Tidak perlu mengambil stok terakhir, cukup pastikan perubahan stok menjadi 0
    INSERT INTO kartu_stok (jenis_transaksi, masuk, keluar, stock, created_at, transaksi_id, barang_id)
    VALUES ('P', 0, 0, 0, NOW(), OLD.pengadaan_id, OLD.barang_id);
END
;;
delimiter ;

DROP TRIGGER IF EXISTS `after_insert_detail_penjualan`;
delimiter ;;
CREATE TRIGGER `after_insert_detail_penjualan` AFTER INSERT ON `detail_penjualan` FOR EACH ROW BEGIN
    DECLARE current_stock INT;

    SELECT stock INTO current_stock
    FROM kartu_stok
    WHERE barang_id = NEW.barang_id
    ORDER BY kartu_stok_id DESC LIMIT 1;

    IF current_stock IS NULL OR current_stock < NEW.jumlah THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Stok tidak cukup untuk penjualan';
    ELSE
        INSERT INTO kartu_stok (jenis_transaksi, masuk, keluar, stock, created_at, transaksi_id, barang_id)
        VALUES ('S', 0, NEW.jumlah, current_stock - NEW.jumlah, NOW(), NEW.penjualan_id, NEW.barang_id);
    END IF;
END
;;
delimiter ;

DROP TRIGGER IF EXISTS `after_update_detail_penjualan`;
delimiter ;;
CREATE TRIGGER `after_update_detail_penjualan` AFTER UPDATE ON `detail_penjualan` FOR EACH ROW BEGIN
    DECLARE current_stock INT;
    DECLARE stock_change INT;

    SELECT stock INTO current_stock
    FROM kartu_stok
    WHERE barang_id = NEW.barang_id
    ORDER BY kartu_stok_id DESC LIMIT 1;

    IF current_stock IS NULL THEN
        SET current_stock = 0;
    END IF;

    SET stock_change = NEW.jumlah - OLD.jumlah;

    IF stock_change > 0 THEN
        IF current_stock < stock_change THEN
            SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Stok tidak cukup untuk penjualan';
        ELSE
            INSERT INTO kartu_stok (jenis_transaksi, masuk, keluar, stock, created_at, transaksi_id, barang_id)
            VALUES ('S', 0, stock_change, current_stock - stock_change, NOW(), NEW.penjualan_id, NEW.barang_id);
        END IF;
    ELSEIF stock_change < 0 THEN
        INSERT INTO kartu_stok (jenis_transaksi, masuk, keluar, stock, created_at, transaksi_id, barang_id)
        VALUES ('S', -stock_change, 0, current_stock - stock_change, NOW(), NEW.penjualan_id, NEW.barang_id);
    END IF;
END
;;
delimiter ;

DROP TRIGGER IF EXISTS `after_delete_detail_penjualan`;
delimiter ;;
CREATE TRIGGER `after_delete_detail_penjualan` AFTER DELETE ON `detail_penjualan` FOR EACH ROW BEGIN
    DECLARE current_stock INT;

    SELECT stock INTO current_stock
    FROM kartu_stok
    WHERE barang_id = OLD.barang_id
    ORDER BY kartu_stok_id DESC LIMIT 1;

    IF current_stock IS NULL THEN
        SET current_stock = 0;
    END IF;

    INSERT INTO kartu_stok (jenis_transaksi, masuk, keluar, stock, created_at, transaksi_id, barang_id)
    VALUES ('S', OLD.jumlah, 0, current_stock + OLD.jumlah, NOW(), OLD.penjualan_id, OLD.barang_id);
END
;;
delimiter ;

DROP TRIGGER IF EXISTS `after_insert_detail_retur`;
delimiter ;;
CREATE TRIGGER `after_insert_detail_retur` AFTER INSERT ON `detail_retur` FOR EACH ROW BEGIN
    DECLARE current_stock INT;

    SELECT stock INTO current_stock
    FROM kartu_stok
    WHERE barang_id = (SELECT barang_id FROM detail_penerimaan WHERE detail_penerimaan_id = NEW.detail_penerimaan_id)
    ORDER BY kartu_stok_id DESC LIMIT 1;

    IF current_stock IS NULL THEN
        SET current_stock = 0;
    END IF;

    INSERT INTO kartu_stok (jenis_transaksi, masuk, keluar, stock, created_at, transaksi_id, barang_id)
    VALUES ('R', 0, NEW.jumlah, current_stock - NEW.jumlah, NOW(), NEW.retur_id, 
            (SELECT barang_id FROM detail_penerimaan WHERE detail_penerimaan_id = NEW.detail_penerimaan_id));
END
;;
delimiter ;

DROP TRIGGER IF EXISTS `after_update_detail_retur`;
delimiter ;;
CREATE TRIGGER `after_update_detail_retur` AFTER UPDATE ON `detail_retur` FOR EACH ROW BEGIN
    DECLARE current_stock INT;

    SELECT stock INTO current_stock
    FROM kartu_stok
    WHERE barang_id = (SELECT barang_id FROM detail_penerimaan WHERE detail_penerimaan_id = NEW.detail_penerimaan_id)
    ORDER BY kartu_stok_id DESC LIMIT 1;

    IF current_stock IS NULL THEN
        SET current_stock = 0;
    END IF;

    INSERT INTO kartu_stok (jenis_transaksi, masuk, keluar, stock, created_at, transaksi_id, barang_id)
    VALUES ('R', 0, NEW.jumlah - OLD.jumlah, current_stock - (NEW.jumlah - OLD.jumlah), NOW(), NEW.retur_id, 
            (SELECT barang_id FROM detail_penerimaan WHERE detail_penerimaan_id = NEW.detail_penerimaan_id));
END
;;
delimiter ;

DROP TRIGGER IF EXISTS `after_delete_detail_retur`;
delimiter ;;
CREATE TRIGGER `after_delete_detail_retur` AFTER DELETE ON `detail_retur` FOR EACH ROW BEGIN
    DECLARE current_stock INT;

    SELECT stock INTO current_stock
    FROM kartu_stok
    WHERE barang_id = (SELECT barang_id FROM detail_penerimaan WHERE detail_penerimaan_id = OLD.detail_penerimaan_id)
    ORDER BY kartu_stok_id DESC LIMIT 1;

    IF current_stock IS NULL THEN
        SET current_stock = 0;
    END IF;

    INSERT INTO kartu_stok (jenis_transaksi, masuk, keluar, stock, created_at, transaksi_id, barang_id)
    VALUES ('R', OLD.jumlah, 0, current_stock + OLD.jumlah, NOW(), OLD.retur_id, 
            (SELECT barang_id FROM detail_penerimaan WHERE detail_penerimaan_id = OLD.detail_penerimaan_id));
END
;;
delimiter ;

DROP TRIGGER IF EXISTS `update_status_after_insert_penerimaan`;
delimiter ;;
CREATE TRIGGER `update_status_after_insert_penerimaan` AFTER INSERT ON `penerimaan` FOR EACH ROW BEGIN
    DECLARE total_penerimaan INT;
    
    SELECT COUNT(*) INTO total_penerimaan
    FROM penerimaan
    WHERE pengadaan_id = NEW.pengadaan_id;

    IF total_penerimaan > 0 THEN
        UPDATE pengadaan
        SET status = 1  
        WHERE pengadaan_id = NEW.pengadaan_id;
    END IF;
END
;;
delimiter ;

DROP TRIGGER IF EXISTS `update_status_after_delete_penerimaan`;
delimiter ;;
CREATE TRIGGER `update_status_after_delete_penerimaan` AFTER DELETE ON `penerimaan` FOR EACH ROW BEGIN
    DECLARE total_penerimaan INT;
    
    SELECT COUNT(*) INTO total_penerimaan
    FROM penerimaan
    WHERE pengadaan_id = OLD.pengadaan_id;

    IF total_penerimaan = 0 THEN
        UPDATE pengadaan
        SET status = 0 
        WHERE pengadaan_id = OLD.pengadaan_id;
    END IF;
END
;;
delimiter ;