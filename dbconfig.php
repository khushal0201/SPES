<?php
    echo "herebe";
    $sql1="";
    $sql1.="CREATE TABLE IF NOT EXISTS `user_n` (
        `name` varchar(100) DEFAULT NULL,
        `email` varchar(100) DEFAULT NULL,
        `pass` varchar(100) DEFAULT NULL,
        `user_id` int NOT NULL,
        `img` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT 'pics/default.jpg',
        PRIMARY KEY (`user_id`)
      );";

      $sql1.="CREATE TABLE IF NOT EXISTS `attendance` (
        `id` int NOT NULL AUTO_INCREMENT,
        `class_id` varchar(100) DEFAULT NULL,
        `sub_id` varchar(100) DEFAULT NULL,
        `daty` date DEFAULT NULL,
        `status` varchar(50) DEFAULT NULL,
        PRIMARY KEY (`id`)
      );";

      $sql1.="CREATE TABLE IF NOT EXISTS `chatn` (
        `id` int NOT NULL AUTO_INCREMENT,
        `class_id` varchar(100) DEFAULT NULL,
        `chat_name` varchar(100) DEFAULT NULL,
        `designation` varchar(50) DEFAULT NULL,
        PRIMARY KEY (`id`)
      );";

      $sql1.="CREATE TABLE IF NOT EXISTS `classes` (
        `id` varchar(20) NOT NULL,
        `name` varchar(50) DEFAULT NULL,
        `creator` int DEFAULT NULL,
        `institute` varchar(100) DEFAULT NULL,
        `sess` varchar(100) DEFAULT NULL,
        `cred` date DEFAULT NULL,
        PRIMARY KEY (`id`)
      );";

      $sql1.="CREATE TABLE IF NOT EXISTS `madeup_test` (
        `id` int NOT NULL AUTO_INCREMENT,
        `test_name` varchar(200) DEFAULT NULL,
        `adds` varchar(200) DEFAULT NULL,
        `ends` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT '1',
        `total` int DEFAULT NULL,
        `class_id` varchar(100) NOT NULL,
        `status` varchar(100) DEFAULT 'draft',
        PRIMARY KEY (`id`)
      ) ;";

      $sql1.="CREATE TABLE IF NOT EXISTS `ma_test_s` (
        `id` int NOT NULL AUTO_INCREMENT,
        `class_id` varchar(100) NOT NULL,
        `m_test_id` int DEFAULT NULL,
        `sub_id` varchar(100) DEFAULT NULL,
        PRIMARY KEY (`id`)
      );";

     $sql1.="CREATE TABLE IF NOT EXISTS `ma_test_t` (
        `id` int NOT NULL AUTO_INCREMENT,
        `class_id` varchar(100) NOT NULL,
        `test_id` int DEFAULT NULL,
        `weightage` int DEFAULT NULL,
        `o_test` int DEFAULT NULL,
        PRIMARY KEY (`id`)
      );";

    $sql1.="CREATE TABLE IF NOT EXISTS `messages` (
        `id` int NOT NULL AUTO_INCREMENT,
        `class_id` varchar(100) DEFAULT NULL,
        `join_id` varchar(100) DEFAULT NULL,
        `join_name` varchar(100) DEFAULT NULL,
        `message` varchar(10000) DEFAULT NULL,
        `dati` date DEFAULT NULL,
        `timi` time DEFAULT NULL,
        `status` varchar(50) DEFAULT 'yes',
        `chat_id` int DEFAULT NULL,
        PRIMARY KEY (`id`)
      ) ;";

    $sql1.="CREATE TABLE IF NOT EXISTS `no_test_s` (
        `id` int NOT NULL AUTO_INCREMENT,
        `class_id` varchar(100) NOT NULL,
        `sub_id` varchar(50) DEFAULT NULL,
        `test_id` int DEFAULT NULL,
        `status` varchar(100) DEFAULT 'not',
        PRIMARY KEY (`id`)
      );";

      $sql1.="CREATE TABLE IF NOT EXISTS `otp_gen` (
        `code` int NOT NULL,
        `email` varchar(100) DEFAULT NULL,
        `id` int NOT NULL AUTO_INCREMENT,
        `ts` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        PRIMARY KEY (`id`)
      );";

      $sql1.="CREATE TABLE IF NOT EXISTS `subjects` (
        `class_id` varchar(100) NOT NULL,
        `sub_id` varchar(100) NOT NULL,
        `sub_name` varchar(100) DEFAULT NULL,
        PRIMARY KEY (`sub_id`),
        KEY `class_id` (`class_id`)
      );";

      $sql1.="CREATE TABLE IF NOT EXISTS `teachers` (
        `id` int NOT NULL AUTO_INCREMENT,
        `tid` varchar(50) DEFAULT NULL,
        `tnm` varchar(100) DEFAULT NULL,
        `temail` varchar(100) DEFAULT NULL,
        `sub_id` varchar(50) DEFAULT NULL,
        `class_id` varchar(100) DEFAULT NULL,
        PRIMARY KEY (`id`)
      ) ;";

      $sql1.="CREATE TABLE IF NOT EXISTS `tests` (
        `id` int NOT NULL AUTO_INCREMENT,
        `class_id` varchar(100) DEFAULT NULL,
        `test_name` varchar(1000) DEFAULT NULL,
        `total_mark` int NOT NULL,
        `status` varchar(100) DEFAULT 'pending',
        `submission_d` date DEFAULT NULL,
        PRIMARY KEY (`id`),
        KEY `class_id` (`class_id`)
      ) ;";

      $sql1.="CREATE TABLE IF NOT EXISTS `user_class` (
        `user_id` int DEFAULT NULL,
        `class_user_id` varchar(50) DEFAULT NULL,
        `user_name` varchar(50) DEFAULT NULL,
        `class_id` varchar(50) DEFAULT NULL,
        `des` varchar(50) DEFAULT NULL,
        `id` int NOT NULL AUTO_INCREMENT,
        PRIMARY KEY (`id`)
      );";

      $sql1.="CREATE TABLE IF NOT EXISTS `user_g` (
        `name` varchar(100) DEFAULT NULL,
        `email` varchar(100) DEFAULT NULL,
        `user_id` int NOT NULL,
        `img` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT 'pics/default.jpg',
        PRIMARY KEY (`user_id`)
      );";

      $sql1.="CREATE TABLE IF NOT EXISTS `user_n` (
        `name` varchar(100) DEFAULT NULL,
        `email` varchar(100) DEFAULT NULL,
        `pass` varchar(100) DEFAULT NULL,
        `user_id` int NOT NULL,
        `img` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT 'pics/default.jpg',
        PRIMARY KEY (`user_id`)
      );";
 
      $tobb=mysqli_multi_query($conn,$sql1);
      if(!$tobb)
        die("Erorr is".mysqli_error($conn));
      mysqli_close($conn);
      include 'connector.php';

?>