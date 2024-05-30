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



