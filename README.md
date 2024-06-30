<!-- Database -->

CREATE DATABASE growwithfarm;

<!-- User Table -->

CREATE TABLE users (
firstname VARCHAR(50) NOT NULL,
lastname VARCHAR(50) NOT NULL,
adharno CHAR(12) PRIMARY KEY,
mobileno CHAR(10) NOT NULL,
gender CHAR(1) NOT NULL,
userpassword VARCHAR(255) NOT NULL
);

<!-- Expenses and sales table -->

CREATE TABLE expenses_and_sales (
id INT AUTO_INCREMENT PRIMARY KEY,
selectfor ENUM('expenses', 'sales') NOT NULL,
crops VARCHAR(50) NOT NULL,
expenses VARCHAR(50) NOT NULL,
date DATE NOT NULL,
amount DECIMAL(10, 2) NOT NULL,
mode ENUM('Online', 'Cash') NOT NULL,
remark TEXT NOT NULL
);

<!-- Contact us sql query -->

CREATE TABLE contact_us (
id INT(11) AUTO_INCREMENT PRIMARY KEY,
name VARCHAR(255) NOT NULL,
email VARCHAR(255) NOT NULL,
message TEXT NOT NULL
);
