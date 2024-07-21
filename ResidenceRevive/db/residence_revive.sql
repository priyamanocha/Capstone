create schema residence_revive;
use residence_revive;

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
    description VARCHAR(1000) NULL,
    service_img VARCHAR(100) NOT NULL,
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
INSERT INTO services (service_id, service_name, description, service_img, price)
VALUES 
(1, 'Half-Washroom Classic Cleaning', 'Half-Washroom Classic Cleaning', 'images/cleaning.jpg', 9.99),
(2, 'Half-Washroom Deep Cleaning', 'Half-Washroom Deep Cleaning', 'images/cleaning.jpg', 14.99),
(3, 'Full-Washroom Classic Cleaning', 'Full-Washroom Classic Cleaning', 'images/cleaning.jpg', 12.99),
(4, 'Full-Washroom Deep Cleaning', 'Full-Washroom Deep Cleaning', 'images/cleaning.jpg', 16.99),
(5, 'Move-In Cleaning', 'Move-in Kitchen Cleaning', 'images/cleaning.jpg', 49.99),
(6, 'Shelve Cleaning', 'Kitchen Shelve Cleaning', 'images/cleaning.jpg', 20.99),
(7, 'Chimney Cleaning', 'Kitchen Chimney Cleaning', 'images/cleaning.jpg', 20.99),
(8, 'Refrigerator Cleaning', 'Refrigerator Cleaning', 'images/cleaning.jpg', 20.99),
(9, 'Induction Cleaning', 'Induction Cleaning', 'images/cleaning.jpg', 20.99),
(10, 'Microwave Cleaning', 'Induction Cleaning', 'images/cleaning.jpg', 20.99),
(11, 'Classic Home Cleaning', 'Classic Home cleaning without Kitchen and Washroom', 'images/cleaning.jpg', 99.99),
(12, 'Deep Home Cleaning', 'Deep Home cleaning', 'images/cleaning.jpg', 149.99),
(13, 'Deep Carpet Cleaning', 'Deep Carpet Cleaning (vacuum)', 'images/cleaning.jpg', 99.99),
(14, 'Tap Repair', 'Tap Repair', 'images/cleaning.jpg', 39.99),
(15, 'Tap Installation/Replacement', 'Tap Installation/Replacement', 'images/cleaning.jpg',49.99),
(16, 'Shower Repair', 'Shower Repair', 'images/cleaning.jpg', 39.99),
(17, 'Shower Installation/Replacement', 'Shower Installation/Replacement', 'images/cleaning.jpg', 49.99),
(18, 'Sink Repair', 'Sink Repair', 'images/cleaning.jpg', 49.99),
(19, 'Sink Installation', 'Sink Installation', 'images/cleaning.jpg', 59.99),
(20, 'Jet Spray Installation/Repair', 'Jet Spray Installation/Repair', 'images/cleaning.jpg', 49.99),
(21, 'Minor Fittings/Installation', 'Minor Fittings/Installation',  'images/cleaning.jpg', 49.99),
(22, 'Toilet Repair', 'Toilet Repair',  'images/cleaning.jpg', 79.99),
(23, 'Toilet Installation/Replacement', 'Toilet Installation/Replacement', 'images/cleaning.jpg', 99.99),
(24, 'Flush Tank Repair', 'Flush Tank Repair', 'images/cleaning.jpg', 79.99),
(25, 'Flush Tank Replacement', 'Flush Tank Replacement', 'images/cleaning.jpg', 89.99),
(26, 'Call an expert', 'Call an expert', 'images/cleaning.jpg', 89.99),
(27, 'Switch Replacement/Installation', 'Switch Replacement/Installation', 'images/cleaning.jpg', 29.99),
(28, 'Switch Repair', 'Switch Repair', 'images/cleaning.jpg', 29.99),
(29, 'Socket Replacement/Installation', 'Socket Replacement/Installation', 'images/cleaning.jpg', 29.99),
(30, 'Socket Repair', 'Socket Repair', 'images/cleaning.jpg', 29.99),
(31, 'Ceiling Light Installation/Replacement', 'Ceiling Light Installation/Replacement', 'images/cleaning.jpg', 49.99),
(32, 'Ceiling Light Repair', 'Ceiling Light Repair', 'images/cleaning.jpg', 59.99),
(33, 'Decorative Light Installation', 'Decorative Light Installation', 'images/cleaning.jpg', 99.99),
(34, 'Door bell Installation/Repair', 'Door bell Installation/Repair', 'images/cleaning.jpg', 49.99),
(35, 'TV installation/uninstallation', 'TV installation/uninstallation', 'images/cleaning.jpg', 99.99),
(36, 'Book an electrician', 'Book an electrician', 'images/cleaning.jpg', 49.99),
(37, 'Mini Refrigerator Repair', 'Mini Refrigerator Repair', 'images/cleaning.jpg', 49.99),
(38, 'Side by Side Refrigerator Repair', 'Side by Side Refrigerator Repair', 'images/cleaning.jpg', 49.99),
(39, 'Top Freezer Refrigerator Repair', 'Top freezer Refrigerator Repair', 'images/cleaning.jpg', 49.99),
(40, 'Botton Freezer Refrigerator Repair', 'Bottom freezer Refrigerator Repair', 'images/cleaning.jpg', 49.99),
(41, 'Microwave Repair', 'Microwave Repair', 'images/cleaning.jpg', 29.99),
(42, 'Induction Stove Repair', 'Induction Stove Repair', 'images/cleaning.jpg', 49.99),
(43, 'Chimney Repair', 'Chimney Repair', 'images/cleaning.jpg', 49.99),
(44, 'Front Load Washer Repair', 'Front Load Washer Repair', 'images/cleaning.jpg', 49.99),
(45, 'Top Load Washer Repair', 'Top Load Washer Repair', 'images/cleaning.jpg', 49.99),
(46, 'Front Load Dryer Repair', 'Front Load Dryer Repair', 'images/cleaning.jpg', 49.99),
(47, 'Top Load Dryer Repair', 'Top Load Dryer Repair', 'images/cleaning.jpg', 49.99),
(48, 'Dishwasher Repair', 'Dishwasher Repair', 'images/cleaning.jpg', 49.99),
(49, 'Single Door', 'Single Door', 'images/cleaning.jpg', 49.99),
(50, 'Double Door', 'Double Door', 'images/cleaning.jpg', 59.99),
(51, 'Three Door', 'Three Door', 'images/cleaning.jpg', 69.99),
(52, 'Side Table', 'Side Table', 'images/cleaning.jpg', 29.99),
(53, 'Coffee Table', 'Coffee Table', 'images/cleaning.jpg', 39.99),
(54, 'Drawer Chest', 'Drawer Chest', 'images/cleaning.jpg', 49.99),
(55, 'Office Table', 'Office Table', 'images/cleaning.jpg', 29.99),
(56, 'Office Chair', 'Office Chair', 'images/cleaning.jpg', 29.99),
(57, 'Dining Table - 4 chairs', 'Dining Table - 4 chairs', 'images/cleaning.jpg', 49.99),
(58, 'Dining Table - 6 chairs', 'Dining Table - 6 chairs', 'images/cleaning.jpg', 59.99),
(59, 'Dining Table - 8 chairs', 'Dining Table - 8 chairs', 'images/cleaning.jpg', 69.99),
(60, 'King Size', 'King Size', 'images/cleaning.jpg', 69.99),
(61, 'Queen Size', 'Queen Size', 'images/cleaning.jpg', 59.99),
(62, 'Double', 'Double', 'images/cleaning.jpg', 49.99),
(63, 'Twin', 'Twin', 'images/cleaning.jpg', 49.99),
(64, 'Hydraulic Bed', 'Hydraulic Bed', 'images/cleaning.jpg', 89.99),
(65, 'Sofa - 2 seater', 'Sofa - 2 seater', 'images/cleaning.jpg', 89.99),
(66, 'Sofa - 3 seater', 'Sofa - 3 seater', 'images/cleaning.jpg', 99.99),
(67, 'Sofa - 4 seater', 'Sofa - 4 seater', 'images/cleaning.jpg', 99.99);


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
insert into category_subcategory_service_mapping values(2, 5, 14);
insert into category_subcategory_service_mapping values(2, 5, 15);
insert into category_subcategory_service_mapping values(2, 6, 16);
insert into category_subcategory_service_mapping values(2, 6, 17);
insert into category_subcategory_service_mapping values(2, 7, 18);
insert into category_subcategory_service_mapping values(2, 7, 19);
insert into category_subcategory_service_mapping values(2, 8, 20);
insert into category_subcategory_service_mapping values(2, 9, 21);
insert into category_subcategory_service_mapping values(2, 10, 22);
insert into category_subcategory_service_mapping values(2, 10, 23);
insert into category_subcategory_service_mapping values(2, 10, 24);
insert into category_subcategory_service_mapping values(2, 11, 25);
insert into category_subcategory_service_mapping values(2, 11, 26);
insert into category_subcategory_service_mapping values(3, 12, 27);
insert into category_subcategory_service_mapping values(3, 12, 28);
insert into category_subcategory_service_mapping values(3, 12, 29);
insert into category_subcategory_service_mapping values(3, 12, 30);
insert into category_subcategory_service_mapping values(3, 13, 31);
insert into category_subcategory_service_mapping values(3, 13, 32);
insert into category_subcategory_service_mapping values(3, 13, 33);
insert into category_subcategory_service_mapping values(3, 14, 34);
insert into category_subcategory_service_mapping values(3, 15, 35);
insert into category_subcategory_service_mapping values(3, 16, 36);
insert into category_subcategory_service_mapping values(4, 17, 37);
insert into category_subcategory_service_mapping values(4, 17, 38);
insert into category_subcategory_service_mapping values(4, 17, 39);
insert into category_subcategory_service_mapping values(4, 17, 40);
insert into category_subcategory_service_mapping values(4, 18, 41);
insert into category_subcategory_service_mapping values(4, 19, 42);
insert into category_subcategory_service_mapping values(4, 20, 43);
insert into category_subcategory_service_mapping values(4, 20, 44);
insert into category_subcategory_service_mapping values(4, 21, 45);
insert into category_subcategory_service_mapping values(4, 21, 46);
insert into category_subcategory_service_mapping values(4, 22, 47);
insert into category_subcategory_service_mapping values(4, 23, 48);
insert into category_subcategory_service_mapping values(6, 24, 49);
insert into category_subcategory_service_mapping values(6, 24, 50);
insert into category_subcategory_service_mapping values(6, 24, 51);
insert into category_subcategory_service_mapping values(6, 25, 52);
insert into category_subcategory_service_mapping values(6, 25, 53);
insert into category_subcategory_service_mapping values(6, 25, 54);
insert into category_subcategory_service_mapping values(6, 25, 55);
insert into category_subcategory_service_mapping values(6, 25, 56);
insert into category_subcategory_service_mapping values(6, 25, 57);
insert into category_subcategory_service_mapping values(6, 25, 58);
insert into category_subcategory_service_mapping values(6, 26, 59);
insert into category_subcategory_service_mapping values(6, 26, 60);
insert into category_subcategory_service_mapping values(6, 26, 61);
insert into category_subcategory_service_mapping values(6, 26, 62);
insert into category_subcategory_service_mapping values(6, 26, 63);
insert into category_subcategory_service_mapping values(6, 26, 64);
insert into category_subcategory_service_mapping values(6, 27, 65);
insert into category_subcategory_service_mapping values(6, 27, 66);
insert into category_subcategory_service_mapping values(6, 27, 67);





