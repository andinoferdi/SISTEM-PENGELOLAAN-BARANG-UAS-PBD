DROP VIEW IF EXISTS `v_kartu_stok`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `v_kartu_stok` AS select `ks`.`kartu_stok_id` AS `kartu_stok_id`,`ks`.`barang_id` AS `kartu_barang_id`,`b`.`nama_barang` AS `nama_barang`,`ks`.`jenis_transaksi` AS `jenis_transaksi`,`ks`.`masuk` AS `masuk`,`ks`.`keluar` AS `keluar`,`ks`.`stock` AS `stock`,`ks`.`created_at` AS `created_at`,`ks`.`transaksi_id` AS `transaksi_id`,ifnull((select sum((`kartu_stok`.`masuk` - `kartu_stok`.`keluar`)) from `kartu_stok` where ((`kartu_stok`.`barang_id` = `ks`.`barang_id`) and (`kartu_stok`.`created_at` <= `ks`.`created_at`) and (`kartu_stok`.`jenis_transaksi` <> 'P'))),0) AS `saldo` from (`kartu_stok` `ks` join `barang` `b` on((`ks`.`barang_id` = `b`.`barang_id`))) order by `ks`.`created_at` desc;

DROP PROCEDURE IF EXISTS `DeleteBarang`;
delimiter ;;
CREATE PROCEDURE `DeleteBarang`(IN p_barang_id INT)
BEGIN
    DELETE FROM barang
    WHERE barang_id = p_barang_id;
    SELECT 'success' AS message;
END
;;
delimiter ;

DROP PROCEDURE IF EXISTS `DeleteRole`;
delimiter ;;
CREATE PROCEDURE `DeleteRole`(IN p_role_id INT)
BEGIN
    DELETE FROM role
    WHERE role_id = p_role_id;
    SELECT 'success' AS message;
END
;;
delimiter ;

DROP PROCEDURE IF EXISTS `DeleteSatuan`;
delimiter ;;
CREATE PROCEDURE `DeleteSatuan`(IN p_satuan_id INT)
BEGIN
    DELETE FROM satuan
    WHERE satuan_id = p_satuan_id;
    SELECT 'success' AS message;
END
;;
delimiter ;

DROP PROCEDURE IF EXISTS `DeleteUser`;
delimiter ;;
CREATE PROCEDURE `DeleteUser`(IN p_user_id INT)
BEGIN
    DELETE FROM user
    WHERE user_id = p_user_id;
    SELECT 'success' AS message;
END
;;
delimiter ;

DROP PROCEDURE IF EXISTS `DeleteVendor`;
delimiter ;;
CREATE PROCEDURE `DeleteVendor`(IN p_vendor_id INT)
BEGIN
    DELETE FROM vendor
    WHERE vendor_id = p_vendor_id;
    SELECT 'success' AS message;
END
;;
delimiter ;

DROP FUNCTION IF EXISTS `get_current_stock`;
delimiter ;;
CREATE FUNCTION `get_current_stock`(p_barang_id BIGINT)
 RETURNS int
  DETERMINISTIC
BEGIN
    DECLARE current_stock INT;

    SELECT stock INTO current_stock
    FROM kartu_stok
    WHERE barang_id = p_barang_id
    ORDER BY kartu_stok_id DESC
    LIMIT 1;

    IF current_stock IS NULL THEN
        RETURN 0;
    END IF;

    RETURN current_stock;
END
;;
delimiter ;

DROP PROCEDURE IF EXISTS `InsertBarang`;
delimiter ;;
CREATE PROCEDURE `InsertBarang`(IN p_jenis CHAR(1),
    IN p_nama_barang VARCHAR(45),
    IN p_satuan_id INT,
    IN p_status TINYINT, 
    IN p_harga INT)
BEGIN
    INSERT INTO barang (jenis, nama_barang, satuan_id, status, harga)
    VALUES (p_jenis, p_nama_barang, p_satuan_id, p_status, p_harga);
    SELECT LAST_INSERT_ID() AS barang_id;
END
;;
delimiter ;

DROP PROCEDURE IF EXISTS `InsertPenerimaan`;
delimiter ;;
CREATE PROCEDURE `InsertPenerimaan`(IN pengadaan_id INT, IN user_id INT)
BEGIN
    INSERT INTO penerimaan (pengadaan_id, user_id)
    VALUES (pengadaan_id, user_id);
END
;;
delimiter ;

DROP PROCEDURE IF EXISTS `InsertPengadaan`;
delimiter ;;
CREATE PROCEDURE `InsertPengadaan`(IN p_user_id INT,
    IN p_vendor_id INT,
    IN p_status TINYINT,
    IN p_subtotal_nilai INT,
    IN p_ppn INT,
    IN p_total_nilai INT)
BEGIN
    INSERT INTO pengadaan (user_id, vendor_id, status, subtotal_nilai, ppn, total_nilai)
    VALUES (p_user_id, p_vendor_id, p_status, p_subtotal_nilai, p_ppn, p_total_nilai);
    SELECT LAST_INSERT_ID() AS pengadaan_id;
END
;;
delimiter ;

DROP PROCEDURE IF EXISTS `InsertPenjualan`;
delimiter ;;
CREATE PROCEDURE `InsertPenjualan`(IN p_user_id INT,
    IN p_margin_penjualan_id INT,
    IN p_subtotal_nilai INT,
    IN p_ppn INT,
    IN p_total_nilai INT)
BEGIN
    INSERT INTO penjualan (user_id, margin_penjualan_id, subtotal_nilai, ppn, total_nilai, created_at)
    VALUES (p_user_id, p_margin_penjualan_id, p_subtotal_nilai, p_ppn, p_total_nilai, NOW());
END
;;
delimiter ;

DROP PROCEDURE IF EXISTS `InsertRole`;
delimiter ;;
CREATE PROCEDURE `InsertRole`(IN p_nama_role VARCHAR(100))
BEGIN
    INSERT INTO role (nama_role)
    VALUES (p_nama_role);
    SELECT LAST_INSERT_ID() AS role_id;
END
;;
delimiter ;

DROP PROCEDURE IF EXISTS `InsertSatuan`;
delimiter ;;
CREATE PROCEDURE `InsertSatuan`(IN p_nama_satuan VARCHAR(45),
    IN p_status TINYINT)
BEGIN
    INSERT INTO satuan (nama_satuan, status)
    VALUES (p_nama_satuan, p_status);
    SELECT LAST_INSERT_ID() AS satuan_id;
END
;;
delimiter ;

DROP PROCEDURE IF EXISTS `InsertUser`;
delimiter ;;
CREATE PROCEDURE `InsertUser`(IN p_username VARCHAR(45),
    IN p_password VARCHAR(100),
    IN p_role_id INT)
BEGIN
    INSERT INTO user (username, password, role_id)
    VALUES (p_username, p_password, p_role_id);
    SELECT LAST_INSERT_ID() AS user_id;
END
;;
delimiter ;

DROP PROCEDURE IF EXISTS `InsertVendor`;
delimiter ;;
CREATE PROCEDURE `InsertVendor`(IN p_nama_vendor VARCHAR(255),
    IN p_badan_hukum CHAR(1),
    IN p_status TINYINT)
BEGIN
    INSERT INTO vendor (nama_vendor, badan_hukum, status)
    VALUES (p_nama_vendor, p_badan_hukum, p_status);
    SELECT LAST_INSERT_ID() AS vendor_id;
END
;;
delimiter ;

DROP PROCEDURE IF EXISTS `insert_detail_penerimaan`;
delimiter ;;
CREATE PROCEDURE `insert_detail_penerimaan`(IN barang_id INT,
    IN harga_satuan_terima INT,
    IN jumlah_terima INT,
    IN penerimaan_id BIGINT,
    IN subtotal_terima INT)
BEGIN
    INSERT INTO detail_penerimaan (barang_id, harga_satuan_terima, jumlah_terima, penerimaan_id, subtotal_terima)
    VALUES (barang_id, harga_satuan_terima, jumlah_terima, penerimaan_id, subtotal_terima);
END
;;
delimiter ;

DROP PROCEDURE IF EXISTS `insert_detail_pengadaan`;
delimiter ;;
CREATE PROCEDURE `insert_detail_pengadaan`(IN barang_id INT,
    IN harga_satuan INT,
    IN jumlah INT,
    IN pengadaan_id INT)
BEGIN
    DECLARE subtotal INT;
    SET subtotal = harga_satuan * jumlah;

    INSERT INTO detail_pengadaan (barang_id, harga_satuan, jumlah, subtotal, pengadaan_id)
    VALUES (barang_id, harga_satuan, jumlah, subtotal, pengadaan_id);
END
;;
delimiter ;

DROP PROCEDURE IF EXISTS `insert_detail_penjualan`;
delimiter ;;
CREATE PROCEDURE `insert_detail_penjualan`(IN p_barang_id INT,
    IN p_harga_satuan INT,
    IN p_jumlah INT,
    IN p_penjualan_id INT)
BEGIN
    DECLARE p_subtotal INT;

    SET p_subtotal = p_harga_satuan * p_jumlah;

    INSERT INTO detail_penjualan (penjualan_id, barang_id, harga_satuan, jumlah, subtotal)
    VALUES (p_penjualan_id, p_barang_id, p_harga_satuan, p_jumlah, p_subtotal);
END
;;
delimiter ;

DROP PROCEDURE IF EXISTS `insert_detail_retur`;
delimiter ;;
CREATE PROCEDURE `insert_detail_retur`(IN retur_id BIGINT,
    IN jumlah INT,
    IN alasan VARCHAR(200),
    IN detail_penerimaan_id BIGINT)
BEGIN
    INSERT INTO detail_retur (retur_id, jumlah, alasan, detail_penerimaan_id)
    VALUES (retur_id, jumlah, alasan, detail_penerimaan_id);
END
;;
delimiter ;

DROP PROCEDURE IF EXISTS `insert_retur`;
delimiter ;;
CREATE PROCEDURE `insert_retur`(IN user_id INT,
    IN penerimaan_id BIGINT)
BEGIN
    INSERT INTO retur (user_id, penerimaan_id)
    VALUES (user_id, penerimaan_id);
END
;;
delimiter ;

DROP PROCEDURE IF EXISTS `SelectAllBarang`;
delimiter ;;
CREATE PROCEDURE `SelectAllBarang`()
BEGIN
    SELECT 
        b.barang_id, 
        b.jenis, 
        b.nama_barang, 
        b.satuan_id, 
        s.nama_satuan, 
        b.status, 
        b.harga
    FROM barang b
    JOIN satuan s ON b.satuan_id = s.satuan_id;
END
;;
delimiter ;

DROP PROCEDURE IF EXISTS `SelectAllRole`;
delimiter ;;
CREATE PROCEDURE `SelectAllRole`()
BEGIN
    SELECT * FROM role;
END
;;
delimiter ;

DROP PROCEDURE IF EXISTS `SelectAllSatuan`;
delimiter ;;
CREATE PROCEDURE `SelectAllSatuan`()
BEGIN
    SELECT * FROM satuan;
END
;;
delimiter ;

DROP PROCEDURE IF EXISTS `SelectAllUsers`;
delimiter ;;
CREATE PROCEDURE `SelectAllUsers`()
BEGIN
    SELECT 
        u.user_id, 
        u.username, 
        u.password, 
        u.role_id, 
        r.nama_role
    FROM user u
    JOIN role r ON u.role_id = r.role_id;
END
;;
delimiter ;

DROP PROCEDURE IF EXISTS `SelectAllVendors`;
delimiter ;;
CREATE PROCEDURE `SelectAllVendors`()
BEGIN
    SELECT * FROM vendor;
END
;;
delimiter ;

DROP PROCEDURE IF EXISTS `UpdateBarang`;
delimiter ;;
CREATE PROCEDURE `UpdateBarang`(IN p_barang_id INT,
    IN p_jenis CHAR(1),
    IN p_nama_barang VARCHAR(45),
    IN p_satuan_id INT,
    IN p_status TINYINT,
    IN p_harga INT)
BEGIN
    UPDATE barang
    SET jenis = p_jenis,
        nama_barang = p_nama_barang,
        satuan_id = p_satuan_id,
        status = p_status,
        harga = p_harga
    WHERE barang_id = p_barang_id;
    SELECT p_barang_id AS barang_id;
END
;;
delimiter ;

DROP PROCEDURE IF EXISTS `UpdateRole`;
delimiter ;;
CREATE PROCEDURE `UpdateRole`(IN p_role_id INT,
    IN p_nama_role VARCHAR(100))
BEGIN
    UPDATE role
    SET nama_role = p_nama_role
    WHERE role_id = p_role_id;
    SELECT p_role_id AS role_id;
END
;;
delimiter ;

DROP PROCEDURE IF EXISTS `UpdateSatuan`;
delimiter ;;
CREATE PROCEDURE `UpdateSatuan`(IN p_satuan_id INT,
    IN p_nama_satuan VARCHAR(45))
BEGIN
    UPDATE satuan
    SET nama_satuan = p_nama_satuan
    WHERE satuan_id = p_satuan_id;
    SELECT p_satuan_id AS satuan_id;
END
;;
delimiter ;

DROP PROCEDURE IF EXISTS `UpdateUser`;
delimiter ;;
CREATE PROCEDURE `UpdateUser`(IN p_user_id INT,
    IN p_username VARCHAR(45),
    IN p_password VARCHAR(100),
    IN p_role_id INT)
BEGIN
    UPDATE user
    SET username = p_username,
        password = p_password,
        role_id = p_role_id
    WHERE user_id = p_user_id;
    SELECT p_user_id AS user_id;
END
;;
delimiter ;

DROP PROCEDURE IF EXISTS `UpdateVendor`;
delimiter ;;
CREATE PROCEDURE `UpdateVendor`(IN p_vendor_id INT,
    IN p_nama_vendor VARCHAR(255),
    IN p_badan_hukum CHAR(1),
    IN p_status CHAR(1))
BEGIN
    UPDATE vendor
    SET nama_vendor = p_nama_vendor,
        badan_hukum = p_badan_hukum,
        status = p_status
    WHERE vendor_id = p_vendor_id;
    SELECT p_vendor_id AS vendor_id;
END
;;
delimiter ;