<?php
require 'db/connection.php';

$connection = DBConnection::get_connection();
$connection->exec("
CREATE TABLE IF NOT EXISTS `transactions` (
    `id` BIGINT(20) NOT NULL PRIMARY KEY,
    `bank_code` CHAR(50) DEFAULT NULL,
    `account_number` CHAR(50) DEFAULT NULL,
    `amount` INT(11) DEFAULT NULL,
    `fee` INT(11) DEFAULT NULL,
    `beneficiary_name` CHAR(50) DEFAULT NULL,
    `status` CHAR(50) DEFAULT NULL,
    `receipt` VARCHAR(255) DEFAULT NULL,
    `remark` VARCHAR(255) DEFAULT NULL,
    `timestamp` DATETIME DEFAULT NULL,
    `time_served` DATETIME DEFAULT NULL,
    `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
);        
");
