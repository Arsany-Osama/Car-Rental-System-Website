DROP DATABASE IF EXISTS car_rental_system;
CREATE DATABASE car_rental_system;
USE car_rental_system;

CREATE TABLE admin (
    id INT(10) PRIMARY KEY,
    email VARCHAR(255) NOT NULL,
    fname VARCHAR(30) NOT NULL,
    lname VARCHAR(30) NOT NULL,
    password VARCHAR(255) NOT NULL,
    city VARCHAR(200) NOT NULL,
    street VARCHAR(300) NOT NULL
);

CREATE TABLE car (
    plate_id INT(10) PRIMARY KEY,
    model VARCHAR(100) NOT NULL,
    color VARCHAR(100) NOT NULL,
    brand VARCHAR(100) NOT NULL,
    year INT(4) NOT NULL,
    image VARCHAR(600) NOT NULL,
    description VARCHAR(300) NOT NULL,
    price_per_hour FLOAT(10, 2)
);

CREATE TABLE reserved_cars(
    plate_id INT(10) ,
    start_time DATE NOT NULL ,
    return_date DATE NOT NULL 
);

CREATE TABLE rent (
    rent_id INT(10) AUTO_INCREMENT PRIMARY KEY,
    cssn VARCHAR(30),
    plate_id INT(10),
    total_hours INT(5) NOT NULL,
    start_date DATE NOT NULL,
    return_date DATE NOT NULL,
    total_price FLOAT(10, 2) NOT NULL
);

CREATE TABLE rent_contact (
    rent_id INT(10),
    phone_number1 VARCHAR(12) NOT NULL,
    phone_number2 VARCHAR(12),
    PRIMARY KEY (rent_id)
);

CREATE TABLE customer (
    cssn VARCHAR(30) PRIMARY KEY,
    email VARCHAR(255) NOT NULL UNIQUE,
    fname VARCHAR(255) NOT NULL,
    lname VARCHAR(255) NOT NULL,
    cpass VARCHAR(255) NOT NULL,
    bdate DATE NOT NULL,
    total_rent INT(4) NOT NULL
);

CREATE TABLE rent_address(
    rent_id INT(10),
    address_id INT(10)
);

CREATE TABLE customer_address (
    address_id INT(10) AUTO_INCREMENT PRIMARY KEY,
    cssn VARCHAR(30),
    country VARCHAR(30) NOT NULL,
    city VARCHAR(200) NOT NULL,
    street VARCHAR(300) NOT NULL
);


ALTER TABLE rent_address ADD CONSTRAINT fk_rent_address_rent_id FOREIGN KEY (rent_id) REFERENCES rent (rent_id) ON UPDATE CASCADE ON DELETE CASCADE;

ALTER TABLE rent_address ADD CONSTRAINT fk_rent_address_address_id FOREIGN KEY (address_id) REFERENCES customer_address (address_id) ON UPDATE CASCADE ON DELETE CASCADE;

ALTER TABLE reserved_cars ADD CONSTRAINT fk_reserved_cars_plate_id FOREIGN KEY (plate_id) REFERENCES car (plate_id) ON UPDATE CASCADE ON DELETE CASCADE;

ALTER TABLE rent ADD CONSTRAINT fk_rent_cssn FOREIGN KEY (cssn) REFERENCES customer (cssn) ON UPDATE CASCADE ON DELETE CASCADE;

ALTER TABLE rent ADD CONSTRAINT fk_rent_plate_id FOREIGN KEY (plate_id) REFERENCES car (plate_id) ON UPDATE CASCADE ON DELETE CASCADE;

ALTER TABLE customer_address ADD CONSTRAINT fk_customer_address_cssn FOREIGN KEY (cssn) REFERENCES customer (cssn) ON UPDATE CASCADE ON DELETE CASCADE;

ALTER TABLE rent_contact ADD CONSTRAINT fk_rent_contact_rent_id FOREIGN KEY (rent_id) REFERENCES rent (rent_id) ON UPDATE CASCADE ON DELETE CASCADE;

INSERT INTO admin VALUES(123 , "mark@gmail.com" , "mark" , "magdy" , "mmMM11++" , "alex" , "alagamy");
SELECT * FROM admin;
SELECT * FROM car;
SELECT * FROM reserved_cars;
SELECT * FROM rent;
SELECT * FROM rent_contact;
SELECT * FROM customer;
SELECT * FROM rent_address;
SELECT * FROM customer_address;
DELETE FROM reserved_cars;
INSERT INTO rent_address VALUE(1,1);

DELETE FROM reserved_cars;
DELETE FROM rent;
DELETE FROM rent_contact;
DELETE FROM rent_address;
DELETE FROM customer_address;
DELETE FROM reserved_cars;
DELETE FROM rent_address;
