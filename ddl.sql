DROP TABLE IF EXISTS `satuan`;
CREATE TABLE `satuan`  (
  `satuan_id` int NOT NULL AUTO_INCREMENT,
  `nama_satuan` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `status` tinyint NOT NULL DEFAULT 1,
  `created_at` datetime NULL DEFAULT NULL,
  `updated_at` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`satuan_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = DYNAMIC;


DROP TABLE IF EXISTS `barang`;
CREATE TABLE `barang`  (
  `barang_id` int NOT NULL AUTO_INCREMENT,
  `jenis` char(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `nama_barang` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `satuan_id` int NOT NULL,
  `status` tinyint NOT NULL,
  `harga` int NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`barang_id`) USING BTREE,
  INDEX `satuan_id`(`satuan_id` ASC) USING BTREE,
  CONSTRAINT `barang_ibfk_1` FOREIGN KEY (`satuan_id`) REFERENCES `satuan` (`satuan_id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = DYNAMIC;


DROP TABLE IF EXISTS `role`;
CREATE TABLE `role`  (
  `role_id` int NOT NULL AUTO_INCREMENT,
  `nama_role` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`role_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = DYNAMIC;


DROP TABLE IF EXISTS `user`;
CREATE TABLE `user`  (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `password` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `role_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id`) USING BTREE,
  INDEX `role_id`(`role_id` ASC) USING BTREE,
  CONSTRAINT `user_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `role` (`role_id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = DYNAMIC;


DROP TABLE IF EXISTS `vendor`;
CREATE TABLE `vendor`  (
  `vendor_id` int NOT NULL AUTO_INCREMENT,
  `nama_vendor` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `badan_hukum` char(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `status` tinyint NOT NULL,
  PRIMARY KEY (`vendor_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = DYNAMIC;


DROP TABLE IF EXISTS `pengadaan`;
CREATE TABLE `pengadaan`  (
  `pengadaan_id` bigint NOT NULL AUTO_INCREMENT,
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int NOT NULL,
  `status` tinyint NOT NULL,
  `vendor_id` int NOT NULL,
  `subtotal_nilai` int NOT NULL,
  `ppn` int NOT NULL,
  `total_nilai` int NOT NULL,
  PRIMARY KEY (`pengadaan_id`) USING BTREE,
  INDEX `user_id`(`user_id` ASC) USING BTREE,
  INDEX `vendor_id`(`vendor_id` ASC) USING BTREE,
  CONSTRAINT `pengadaan_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `pengadaan_ibfk_2` FOREIGN KEY (`vendor_id`) REFERENCES `vendor` (`vendor_id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = DYNAMIC;


DROP TABLE IF EXISTS `detail_pengadaan`;
CREATE TABLE `detail_pengadaan`  (
  `detail_pengadaan_id` bigint NOT NULL AUTO_INCREMENT,
  `pengadaan_id` bigint NOT NULL,
  `barang_id` int NOT NULL,
  `harga_satuan` int NOT NULL,
  `jumlah` int NOT NULL,
  `subtotal` int NOT NULL,
  PRIMARY KEY (`detail_pengadaan_id`) USING BTREE,
  INDEX `pengadaan_id`(`pengadaan_id` ASC) USING BTREE,
  INDEX `barang_id`(`barang_id` ASC) USING BTREE,
  CONSTRAINT `detail_pengadaan_ibfk_1` FOREIGN KEY (`pengadaan_id`) REFERENCES `pengadaan` (`pengadaan_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `detail_pengadaan_ibfk_2` FOREIGN KEY (`barang_id`) REFERENCES `barang` (`barang_id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = DYNAMIC;


DROP TABLE IF EXISTS `penerimaan`;
CREATE TABLE `penerimaan`  (
  `penerimaan_id` bigint NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `pengadaan_id` bigint NOT NULL,
  `user_id` int NOT NULL,
  PRIMARY KEY (`penerimaan_id`) USING BTREE,
  INDEX `pengadaan_id`(`pengadaan_id` ASC) USING BTREE,
  INDEX `user_id`(`user_id` ASC) USING BTREE,
  CONSTRAINT `penerimaan_ibfk_1` FOREIGN KEY (`pengadaan_id`) REFERENCES `pengadaan` (`pengadaan_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `penerimaan_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = DYNAMIC;


DROP TABLE IF EXISTS `detail_penerimaan`;
CREATE TABLE `detail_penerimaan`  (
  `detail_penerimaan_id` bigint NOT NULL AUTO_INCREMENT,
  `penerimaan_id` bigint NOT NULL,
  `barang_id` int NOT NULL,
  `jumlah_terima` int NOT NULL,
  `harga_satuan_terima` int NOT NULL,
  `subtotal_terima` int NOT NULL,
  PRIMARY KEY (`detail_penerimaan_id`) USING BTREE,
  INDEX `penerimaan_id`(`penerimaan_id` ASC) USING BTREE,
  INDEX `barang_id`(`barang_id` ASC) USING BTREE,
  CONSTRAINT `detail_penerimaan_ibfk_1` FOREIGN KEY (`penerimaan_id`) REFERENCES `penerimaan` (`penerimaan_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `detail_penerimaan_ibfk_2` FOREIGN KEY (`barang_id`) REFERENCES `barang` (`barang_id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = DYNAMIC;


DROP TABLE IF EXISTS `margin_penjualan`;
CREATE TABLE `margin_penjualan`  (
  `margin_penjualan_id` int NOT NULL AUTO_INCREMENT,
  `persen` double NOT NULL,
  `status` tinyint NOT NULL,
  `user_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`margin_penjualan_id`) USING BTREE,
  INDEX `user_id`(`user_id` ASC) USING BTREE,
  CONSTRAINT `margin_penjualan_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = DYNAMIC;


DROP TABLE IF EXISTS `retur`;
CREATE TABLE `retur`  (
  `retur_id` bigint NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int NOT NULL,
  `penerimaan_id` bigint NOT NULL,
  PRIMARY KEY (`retur_id`) USING BTREE,
  INDEX `user_id`(`user_id` ASC) USING BTREE,
  INDEX `penerimaan_id`(`penerimaan_id` ASC) USING BTREE,
  CONSTRAINT `retur_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `retur_ibfk_2` FOREIGN KEY (`penerimaan_id`) REFERENCES `penerimaan` (`penerimaan_id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = DYNAMIC;


DROP TABLE IF EXISTS `detail_retur`;
CREATE TABLE `detail_retur`  (
  `detail_retur_id` int NOT NULL AUTO_INCREMENT,
  `retur_id` bigint NOT NULL,
  `jumlah` int NOT NULL,
  `alasan` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `detail_penerimaan_id` bigint NOT NULL,
  PRIMARY KEY (`detail_retur_id`) USING BTREE,
  INDEX `retur_id`(`retur_id` ASC) USING BTREE,
  INDEX `detail_penerimaan_id`(`detail_penerimaan_id` ASC) USING BTREE,
  CONSTRAINT `detail_retur_ibfk_1` FOREIGN KEY (`retur_id`) REFERENCES `retur` (`retur_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `detail_retur_ibfk_2` FOREIGN KEY (`detail_penerimaan_id`) REFERENCES `detail_penerimaan` (`detail_penerimaan_id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = DYNAMIC;


DROP TABLE IF EXISTS `penjualan`;
CREATE TABLE `penjualan`  (
  `penjualan_id` bigint NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `subtotal_nilai` int NOT NULL,
  `ppn` int NOT NULL,
  `total_nilai` int NOT NULL,
  `user_id` int NOT NULL,
  `margin_penjualan_id` int NOT NULL,
  PRIMARY KEY (`penjualan_id`) USING BTREE,
  INDEX `user_id`(`user_id` ASC) USING BTREE,
  INDEX `margin_penjualan_id`(`margin_penjualan_id` ASC) USING BTREE,
  CONSTRAINT `penjualan_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `penjualan_ibfk_2` FOREIGN KEY (`margin_penjualan_id`) REFERENCES `margin_penjualan` (`margin_penjualan_id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = DYNAMIC;


DROP TABLE IF EXISTS `detail_penjualan`;
CREATE TABLE `detail_penjualan`  (
  `detail_penjualan_id` bigint NOT NULL AUTO_INCREMENT,
  `penjualan_id` bigint NOT NULL,
  `barang_id` int NOT NULL,
  `harga_satuan` int NOT NULL,
  `jumlah` int NOT NULL,
  `subtotal` int NOT NULL,
  PRIMARY KEY (`detail_penjualan_id`) USING BTREE,
  INDEX `penjualan_id`(`penjualan_id` ASC) USING BTREE,
  INDEX `barang_id`(`barang_id` ASC) USING BTREE,
  CONSTRAINT `detail_penjualan_ibfk_1` FOREIGN KEY (`penjualan_id`) REFERENCES `penjualan` (`penjualan_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `detail_penjualan_ibfk_2` FOREIGN KEY (`barang_id`) REFERENCES `barang` (`barang_id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = DYNAMIC;


DROP TABLE IF EXISTS `kartu_stok`;
CREATE TABLE `kartu_stok`  (
  `kartu_stok_id` bigint NOT NULL AUTO_INCREMENT,
  `jenis_transaksi` char(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `masuk` int NOT NULL,
  `keluar` int NOT NULL,
  `stock` int NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `transaksi_id` int NOT NULL,
  `barang_id` int NOT NULL,
  PRIMARY KEY (`kartu_stok_id`) USING BTREE,
  INDEX `barang_id`(`barang_id` ASC) USING BTREE,
  CONSTRAINT `kartu_stok_ibfk_1` FOREIGN KEY (`barang_id`) REFERENCES `barang` (`barang_id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = DYNAMIC;