-- Insert data into the admin table
INSERT INTO admin (id, email, fname, lname, password, city, street)
VALUES
    (1, 'admin@gmail.com', 'John', 'Doe', 'admin', 'CityAdmin', 'StreetAdmin');

-- Insert data into the car table
INSERT INTO car (plate_id, model, color, brand, year, image, description, price_per_hour)
VALUES
    (1, 'ModelS', 'Black', 'Tesla', 2022, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQq8Z_TF0FpMR1T7o_T6c8J4a-UN5x8Jx3Lrw&usqp=CAU', 'Electric car', 120);
        INSERT INTO car (plate_id, model, color, brand, year, image, description, price_per_hour)
VALUES
    (2, 'SUV', 'Black', 'BMW', 2022, 'https://media.gemini.media/img/Original/2018/3/14/2018_3_14_13_38_15_942.jpg', 'Exclusive car', 105);
        INSERT INTO car (plate_id, model, color, brand, year, image, description, price_per_hour)
VALUES
    (3, 'Accent', 'Silver', 'Hyundai', 2005, 'https://www.elbalad.news/UploadCache/libfiles/951/8/600x338o/179.jpg', 'rent and you wont regret', 120);
        INSERT INTO car (plate_id, model, color, brand, year, image, description, price_per_hour)
VALUES
    (4, 'Maxima', 'Silver', 'Nissan', 2015, 'https://upload.wikimedia.org/wikipedia/commons/thumb/0/02/Nissan_Maxima_SV_%28A36%29_%E2%80%93_Frontansicht%2C_1._Oktober_2016%2C_New_York.jpg/1920px-Nissan_Maxima_SV_%28A36%29_%E2%80%93_Frontansicht%2C_1._Oktober_2016%2C_New_York.jpg', 'rent and you wont regret it', 7);
        INSERT INTO car (plate_id, model, color, brand, year, image, description, price_per_hour)
VALUES
    (5, 'Sunny', 'White', 'Nissan', 2022, 'https://upload.wikimedia.org/wikipedia/commons/thumb/0/07/Nissan_Sunny_1998.JPG/390px-Nissan_Sunny_1998.JPG', 'rent and you wont regret it', 8);
        INSERT INTO car (plate_id, model, color, brand, year, image, description, price_per_hour)
VALUES
    (6, 'Corolla Sprinter', 'White', 'Tyota', 2020, 'https://upload.wikimedia.org/wikipedia/commons/thumb/c/cb/2022_Toyota_GR86_Premium_in_Halo%2C_Front_Right%2C_04-10-2022_%282%29.jpg/390px-2022_Toyota_GR86_Premium_in_Halo%2C_Front_Right%2C_04-10-2022_%282%29.jpg', 'rent and you wont regret it', 12);
        INSERT INTO car (plate_id, model, color, brand, year, image, description, price_per_hour)
VALUES
    (7, 'Accent', 'Grey', 'Hyundai', 2019, 'https://upload.wikimedia.org/wikipedia/commons/thumb/5/57/2012_Hyundai_Accent_GLS_sedan_--_12-14-2011.jpg/1280px-2012_Hyundai_Accent_GLS_sedan_--_12-14-2011.jpg', 'rent and you wont regret it', 10);
        INSERT INTO car (plate_id, model, color, brand, year, image, description, price_per_hour)
VALUES
    (8, 'Nasr', 'Burgundy', 'Shahin', 1999, 'https://upload.wikimedia.org/wikipedia/commons/d/d6/Shahin1.jpg', 'Come and rent, there is nothing cheaper than this', 5);
            INSERT INTO car (plate_id, model, color, brand, year, image, description, price_per_hour)
VALUES
    (9, 'Nasr', 'Burgundy', 'Shahin', 1999, 'https://content.almalnews.com/wp-content/uploads/2020/05/%D8%A3%D8%B3%D8%B9%D8%A7%D8%B1-%D9%87%D9%8A%D9%88%D9%86%D8%AF%D8%A7%D9%8A-%D9%81%D9%8A%D8%B1%D9%86%D8%A7.jpg', 'Really wanna rent this?', 6);
            INSERT INTO car (plate_id, model, color, brand, year, image, description, price_per_hour)
VALUES
    (10, 'cayenne s', 'Black', 'porsche', 202, 'https://www.elbalad.news/UploadCache/libfiles/331/4/600x338o/62.jpg', 'Exclusive car', 145);
    
    

-- Insert data into the reserved_cars table
INSERT INTO reserved_cars (plate_id, start_time, return_date)
VALUES
    (1, '2023-01-15', '2023-01-20');
    
-- Insert data into the customer table
INSERT INTO customer (cssn, email, fname, lname, cpass, bdate, total_rent)
VALUES
    ('2205008', 'ahmed@gmail.com', 'ahmed', 'abdelrahman', 'aaAA11!!', '2004-05-10', 1);
    INSERT INTO customer (cssn, email, fname, lname, cpass, bdate, total_rent)
VALUES
    ('2205040', 'mark@gmail.com', 'mark', 'magdy', 'mmMM11!!', '2004-05-10', 0);
    INSERT INTO customer (cssn, email, fname, lname, cpass, bdate, total_rent)
VALUES
    ('2205122', 'arsany@gmail.com', 'arsany', 'osama', 'aaAA11!!', '2004-05-10', 0);
    
-- Insert data into the rent table
INSERT INTO rent (cssn, plate_id, total_hours, start_date, return_date, total_price)
VALUES
    ('2205008', 1, 5, '2023-01-15', '2023-01-20', 150.00);

-- Insert data into the rent_contact table
INSERT INTO rent_contact (rent_id, phone_number1, phone_number2)
VALUES
    (1, '01010324822', '01212001212');

-- Insert data into the customer_address table
INSERT INTO customer_address (cssn, country, city, street)
VALUES
    ('2205008', 'Country1', 'City1', 'Street1');

-- Insert data into the rent_address table
INSERT INTO rent_address (rent_id, address_id)
VALUES
    (1, 1);
