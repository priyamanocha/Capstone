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
    booking_id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(100) NOT NULL,
    booking_date DATE NOT NULL,
    booking_time TIME NOT NULL,
    service_date DATE NOT NULL,
    service_time TIME NOT NULL,
    booking_first_name VARCHAR(100) NOT NULL,
    booking_last_name VARCHAR(100) NOT NULL,
    booking_contact_number VARCHAR(10) NOT NULL,
    address VARCHAR(100) NOT NULL,
    city VARCHAR(100) NOT NULL,
    state VARCHAR(50) NOT NULL,
    postal_code VARCHAR(6) NOT NULL,
    amount DECIMAL(10,2) NOT NULL,
    tax DECIMAL(10,2) NOT NULL,
    total_amount DECIMAL(10,2) NOT NULL,
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
insert into sub_categories values(28, 'Insects');
insert into sub_categories values(29, 'Rodents');


-- Insert Queries for Services
INSERT INTO services (service_id, service_name, description, service_img, price)
VALUES 
(1, 'Half-Washroom Classic Cleaning', 'Basic half-bathroom cleaning.', 'images/cleaning.jpg', 9.99),
(2, 'Half-Washroom Deep Cleaning', 'Intensive half-bathroom cleaning.', 'images/cleaning.jpg', 14.99),
(3, 'Full-Washroom Classic Cleaning', 'Regular full-bathroom cleaning.', 'images/cleaning.jpg', 12.99),
(4, 'Full-Washroom Deep Cleaning', 'Thorough full-bathroom cleaning.', 'images/cleaning.jpg', 16.99),
(5, 'Move-In Cleaning', 'Detailed kitchen cleaning.', 'images/cleaning.jpg', 49.99),
(6, 'Shelve Cleaning', 'Kitchen shelf dusting.', 'images/cleaning.jpg', 20.99),
(7, 'Chimney Cleaning', 'Kitchen chimney deep cleaning.', 'images/cleaning.jpg', 20.99),
(8, 'Refrigerator Cleaning', 'Refrigerator interior and exterior cleaning.', 'images/cleaning.jpg', 20.99),
(9, 'Induction Cleaning', 'Induction cooktop cleaning.', 'images/cleaning.jpg', 20.99),
(10, 'Microwave Cleaning', 'Microwave interior and exterior cleaning.', 'images/cleaning.jpg', 20.99),
(11, 'Classic Home Cleaning', 'Regular home area cleaning.', 'images/cleaning.jpg', 99.99),
(12, 'Deep Home Cleaning', 'Extensive home cleaning.', 'images/cleaning.jpg', 149.99),
(13, 'Deep Carpet Cleaning', 'Vacuum-based carpet cleaning.', 'images/cleaning.jpg', 99.99),
(14, 'Tap Repair', 'Fixing tap issues.', 'images/cleaning.jpg', 39.99),
(15, 'Tap Installation/Replacement', 'Tap installation or replacement.', 'images/cleaning.jpg', 49.99),
(16, 'Shower Repair', 'Repairing shower issues.', 'images/cleaning.jpg', 39.99),
(17, 'Shower Installation/Replacement', 'Shower installation or replacement.', 'images/cleaning.jpg', 49.99),
(18, 'Sink Repair', 'Fixing sink issues.', 'images/cleaning.jpg', 49.99),
(19, 'Sink Installation', 'Sink installation or replacement.', 'images/cleaning.jpg', 59.99),
(20, 'Jet Spray Installation/Repair', 'Jet spray installation or repair.', 'images/cleaning.jpg', 49.99),
(21, 'Minor Fittings/Installation', 'Installing minor fittings.', 'images/cleaning.jpg', 49.99),
(22, 'Toilet Repair', 'Fixing toilet issues.', 'images/cleaning.jpg', 79.99),
(23, 'Toilet Installation/Replacement', 'Toilet installation or replacement.', 'images/cleaning.jpg', 99.99),
(24, 'Flush Tank Repair', 'Repairing flush tanks.', 'images/cleaning.jpg', 79.99),
(25, 'Flush Tank Replacement', 'Replacing flush tanks.', 'images/cleaning.jpg', 89.99),
(26, 'Call an expert', 'General home consultation.', 'images/cleaning.jpg', 89.99),
(27, 'Switch Replacement/Installation', 'Switch installation or replacement.', 'images/cleaning.jpg', 29.99),
(28, 'Switch Repair', 'Fixing switch issues.', 'images/cleaning.jpg', 29.99),
(29, 'Socket Replacement/Installation', 'Socket installation or replacement.', 'images/cleaning.jpg', 29.99),
(30, 'Socket Repair', 'Repairing socket issues.', 'images/cleaning.jpg', 29.99),
(31, 'Ceiling Light Installation/Replacement', 'Ceiling light installation or replacement.', 'images/cleaning.jpg', 49.99),
(32, 'Ceiling Light Repair', 'Repairing ceiling light issues.', 'images/cleaning.jpg', 59.99),
(33, 'Decorative Light Installation', 'Installing decorative lights.', 'images/cleaning.jpg', 99.99),
(34, 'Door bell Installation/Repair', 'Installing or repairing doorbells.', 'images/cleaning.jpg', 49.99),
(35, 'TV installation/uninstallation', 'Installing or uninstalling TVs.', 'images/cleaning.jpg', 99.99),
(36, 'Book an electrician', 'Professional electrical services.', 'images/cleaning.jpg', 49.99),
(37, 'Mini Refrigerator Repair', 'Fixing mini refrigerator issues.', 'images/cleaning.jpg', 49.99),
(38, 'Side by Side Refrigerator Repair', 'Repairing side-by-side refrigerators.', 'images/cleaning.jpg', 49.99),
(39, 'Top Freezer Refrigerator Repair', 'Repairing top freezer refrigerators.', 'images/cleaning.jpg', 49.99),
(40, 'Bottom Freezer Refrigerator Repair', 'Repairing bottom freezer refrigerators.', 'images/cleaning.jpg', 49.99),
(41, 'Microwave Repair', 'Fixing microwave issues.', 'images/cleaning.jpg', 29.99),
(42, 'Induction Stove Repair', 'Repairing induction stoves.', 'images/cleaning.jpg', 49.99),
(43, 'Chimney Repair', 'Repairing kitchen chimneys.', 'images/cleaning.jpg', 49.99),
(44, 'Front Load Washer Repair', 'Repairing front-load washers.', 'images/cleaning.jpg', 49.99),
(45, 'Top Load Washer Repair', 'Repairing top-load washers.', 'images/cleaning.jpg', 49.99),
(46, 'Front Load Dryer Repair', 'Repairing front-load dryers.', 'images/cleaning.jpg', 49.99),
(47, 'Top Load Dryer Repair', 'Repairing top-load dryers.', 'images/cleaning.jpg', 49.99),
(48, 'Dishwasher Repair', 'Fixing dishwashers.', 'images/cleaning.jpg', 49.99),
(49, 'Single Door', 'Single-door cabinet installation.', 'images/cleaning.jpg', 49.99),
(50, 'Double Door', 'Double-door cabinet installation.', 'images/cleaning.jpg', 59.99),
(51, 'Three Door', 'Three-door cabinet installation.', 'images/cleaning.jpg', 69.99),
(52, 'Side Table', 'Side table assembly.', 'images/cleaning.jpg', 29.99),
(53, 'Coffee Table', 'Coffee table assembly.', 'images/cleaning.jpg', 39.99),
(54, 'Drawer Chest', 'Drawer chest assembly.', 'images/cleaning.jpg', 49.99),
(55, 'Office Table', 'Office table assembly.', 'images/cleaning.jpg', 29.99),
(56, 'Office Chair', 'Office chair assembly.', 'images/cleaning.jpg', 29.99),
(57, 'Dining Table - 4 chairs', 'Dining table (4 chairs) assembly.', 'images/cleaning.jpg', 49.99),
(58, 'Dining Table - 6 chairs', 'Dining table (6 chairs) assembly.', 'images/cleaning.jpg', 59.99),
(59, 'Dining Table - 8 chairs', 'Dining table (8 chairs) assembly.', 'images/cleaning.jpg', 69.99),
(60, 'King Size', 'King-size bed assembly.', 'images/cleaning.jpg', 69.99),
(61, 'Queen Size', 'Queen-size bed assembly.', 'images/cleaning.jpg', 59.99),
(62, 'Double', 'Double bed assembly.', 'images/cleaning.jpg', 49.99),
(63, 'Twin', 'Twin bed assembly.', 'images/cleaning.jpg', 49.99),
(64, 'Hydraulic Bed', 'Hydraulic bed assembly.', 'images/cleaning.jpg', 89.99),
(65, 'Sofa - 2 seater', '2-seater sofa assembly.', 'images/cleaning.jpg', 89.99),
(66, 'Sofa - 3 seater', '3-seater sofa assembly.', 'images/cleaning.jpg', 99.99),
(67, 'Sofa - 4 seater', '4-seater sofa assembly.', 'images/cleaning.jpg', 99.99),
(68, 'Insects Control', 'Ants, Bed Bugs, Cockroaches, and Fleas', 'images/insects.jpg', 499.99),
(69, 'Rodents Control', 'Mice and Rats', 'images/rodents.jpg', 499.99);
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
insert into category_subcategory_service_mapping values(5, 28, 68);
insert into category_subcategory_service_mapping values(5, 29, 69);





