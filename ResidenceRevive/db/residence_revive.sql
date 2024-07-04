create schema residence_revive;
use residence_revive;

drop table user_details;
drop table categories;
drop table sub_categories;
drop table services;
drop table category_subcategory_service_mapping;
drop table cart;
drop table booking;
drop table booking_services;
drop table contact_us; 

CREATE TABLE IF NOT EXISTS user_details (
    email VARCHAR(100) PRIMARY KEY,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    contact_number VARCHAR(10) NOT NULL,
    password VARCHAR(100) NOT NULL
);

CREATE TABLE IF NOT EXISTS categories (
    category_id INT PRIMARY KEY,
    category_name VARCHAR(100) NOT NULL UNIQUE
);
CREATE TABLE IF NOT EXISTS sub_categories (
    sub_category_id INT PRIMARY KEY,
    sub_category_name VARCHAR(100) NOT NULL UNIQUE
);

CREATE TABLE IF NOT EXISTS services (
    service_id INT PRIMARY KEY,
    service_name VARCHAR(100) NOT NULL UNIQUE,
    description VARCHAR(1000) NOT NULL,
    price DECIMAL(10, 2) NOT NULL 
);

CREATE TABLE IF NOT EXISTS category_subcategory_service_mapping (
    category_id INT,
    sub_category_id INT,
    service_id INT,
    FOREIGN KEY (category_id) REFERENCES categories(category_id),
    FOREIGN KEY (sub_category_id) REFERENCES sub_categories(sub_category_id),
    FOREIGN KEY (service_id) REFERENCES services(service_id),
    PRIMARY KEY (category_id, sub_category_id, service_id)
);
CREATE TABLE IF NOT EXISTS cart (
    email VARCHAR(100),
    category_id INT,
    subcategory_id INT,
    service_id INT ,
    quantity INT ,
    FOREIGN KEY (email) REFERENCES user_details(email),
    FOREIGN KEY (category_id) REFERENCES categories(category_id),
    FOREIGN KEY (subcategory_id) REFERENCES sub_categories(sub_category_id),
    FOREIGN KEY (service_id) REFERENCES services(service_id),
    PRIMARY KEY(email, category_id, subcategory_id, service_id)
);
CREATE TABLE IF NOT EXISTS booking (
    booking_id INT PRIMARY KEY,
    email VARCHAR(100) NOT NULL,
    book_id INT NOT NULL,
    booking_date DATE NOT NULL,
    booking_time TIME NOT NULL,
    service_date DATE NOT NULL,
    service_time TIME NOT NULL,
    booking_first_name VARCHAR(100) NOT NULL,
    booking_last_name VARCHAR(100) NOT NULL,
    booking_contact_number varchar(10) NOT NULL,
    address varchar(100) NOT NULL,
    city varchar(100) NOT NULL,
    state varchar(50) NOT NULL,
    postal_code varchar(6) NOT NULL,
    amount decimal(10,2) NOT NULL,
    tax decimal(10,2) NOT NULL,
    total_amount decimal(10,2) NOT NULL,
    FOREIGN KEY (email) REFERENCES user_details(email)
);

CREATE TABLE IF NOT EXISTS booking_services (
    booking_id INT NOT NULL,
    category_id INT NOT NULL,
    subcategory_id INT NOT NULL,
    service_id INT NOT NULL,
    FOREIGN KEY (booking_id) REFERENCES booking(booking_id),
    FOREIGN KEY (category_id) REFERENCES categories(category_id),
    FOREIGN KEY (subcategory_id) REFERENCES sub_categories(sub_category_id),
    FOREIGN KEY (service_id) REFERENCES services(service_id),
    PRIMARY KEY(booking_id, category_id, service_id)
);

CREATE TABLE IF NOT EXISTS contact_us (
    id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    email VARCHAR(50) NOT NULL,
    phone VARCHAR(50) NOT NULL,
    message VARCHAR(5000) NOT NULL
);

-- Insert Queries for Categories
insert into categories values(1, 'Cleaning/Disinfection');
insert into categories values(2, 'Plumbing');
insert into categories values(3, 'Electrician');
insert into categories values(4, 'Appliance Repair');
insert into categories values(5, 'Pest-Control');
insert into categories values(6, 'Furniture Assembly');

-- Insert Queries for Sub-Categories
-- SET SQL_SAFE_UPDATES = 0;
insert into sub_categories values(1, 'Bathroom Cleaning');
insert into sub_categories values(2, 'Kitchen Cleaning');
insert into sub_categories values(3, 'Carpet Cleaning');
insert into sub_categories values(4, 'Home Cleaning');
insert into sub_categories values(5, 'Tap');
insert into sub_categories values(6, 'Shower');
insert into sub_categories values(7, 'Basin & Sink');
insert into sub_categories values(8, 'Bath fittings');
insert into sub_categories values(9, 'Minor Fitting/Installation');
insert into sub_categories values(10, 'Toilet');
insert into sub_categories values(11, 'Others');
insert into sub_categories values(12, 'Switch and Socket');
insert into sub_categories values(13, 'Light');
insert into sub_categories values(14, 'Doorbell');
insert into sub_categories values(15, 'Television');
insert into sub_categories values(16, 'Expert Consultation');
insert into sub_categories values(17, 'Refrigerator');
insert into sub_categories values(18, 'Microwave');
insert into sub_categories values(19, 'Induction');
insert into sub_categories values(20, 'Chimney');
insert into sub_categories values(21, 'Washer');
insert into sub_categories values(22, 'Dryer');
insert into sub_categories values(23, 'Dish Washer');
insert into sub_categories values(24, 'Wardrobe');
insert into sub_categories values(25, 'Tables/Drawers/Workspaces');
insert into sub_categories values(26, 'Bed');
insert into sub_categories values(27, 'Sofa');

-- Insert Queries for Services
insert into services values(1, 'Half-Washroom Classic Cleaning', 'Half-Washroom Classic Cleaning', 9.99);
insert into services values(2, 'Half-Washroom Deep Cleaning', 'Half-Washroom Deep Cleaning', 14.99);
insert into services values(3, 'Full-Washroom Classic Cleaning', 'Full-Washroom Classic Cleaning', 12.99);
insert into services values(4, 'Full-Washroom Deep Cleaning', 'Full-Washroom Deep Cleaning', 16.99);
insert into services values(5, 'Move-In Cleaning', 'Move-in Kitchen Cleaning', 49.99);
insert into services values(6, 'Shelve Cleaning', 'Kitchen Shelve Cleaning', 20.99);
insert into services values(7, 'Chimney Cleaning', 'Kitchen Chimney Cleaning', 20.99);
insert into services values(8, 'Refrigerator Cleaning', 'Refrigerator Cleaning', 20.99);
insert into services values(9, 'Induction Cleaning', 'Induction Cleaning', 20.99);
insert into services values(10, 'Microwave Cleaning', 'Induction Cleaning', 20.99);
insert into services values(11, 'Classic Home Cleaning', 'Classic Home cleaning without Kitchen and Washroom', 99.99);
insert into services values(12, 'Deep Home Cleaning', 'Deep Home cleaning ', 149.99);
insert into services values(13, 'Deep Carpet Cleaning', 'Deep Carpet Cleaning (vaccum)', 99.99);

-- Insert Queries for category_subcategory_service_mapping
insert into category_subcategory_service_mapping values(1, 1, 1);
insert into category_subcategory_service_mapping values(1, 1, 2);
insert into category_subcategory_service_mapping values(1, 1, 3);
insert into category_subcategory_service_mapping values(1, 1, 4);
insert into category_subcategory_service_mapping values(1, 2, 5);
insert into category_subcategory_service_mapping values(1, 2, 6);
insert into category_subcategory_service_mapping values(1, 2, 7);
insert into category_subcategory_service_mapping values(1, 2, 8);
insert into category_subcategory_service_mapping values(1, 2, 9);
insert into category_subcategory_service_mapping values(1, 2, 10);
insert into category_subcategory_service_mapping values(1, 3, 13);
insert into category_subcategory_service_mapping values(1, 4, 11);
insert into category_subcategory_service_mapping values(1, 4, 12);


/*  services data with name, price, image */

INSERT INTO services (service_id, service_name, description, price)
VALUES 
(1, 'Cleaning/Disinfection', 'images/cleaning.png', 0),
(2, 'Appliance Repair', 'images/gas-stove.png', 0),
(3, 'Electrician', 'images/electrician.png', 0),
(4, 'Furniture Assembly', 'images/sofa.png', 0),
(5, 'Pest-Control', 'images/bug-spray.png', 0),
(6, 'Plumbing', 'images/plumbing.png', 0);