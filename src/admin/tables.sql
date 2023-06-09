-- Stores all user accounts
CREATE TABLE user (
    user_id MEDIUMINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    login_id VARCHAR(50),
    password_hash VARCHAR(32),
    salt VARCHAR(10),
    first_name VARCHAR(50),
    last_name VARCHAR(50),
    tel_no VARCHAR(12),
    email VARCHAR(100) UNIQUE,
    address VARCHAR(200),
    balance DOUBLE DEFAULT 0.00,
    points SMALLINT DEFAULT 0,
    free_delivery TINYINT(1) DEFAULT 0,
    admin TINYINT(1) DEFAULT 0
);

-- Stores all delivery vehicles
CREATE TABLE truck (
    truck_id MEDIUMINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    truck_code VARCHAR(50),
    availability_code TINYINT(1) DEFAULT 1
);

-- Stores all delivery trips
CREATE TABLE trip (
    trip_id MEDIUMINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    source VARCHAR(200),
    destination VARCHAR(200),
    distance DOUBLE,
    truck_id MEDIUMINT REFERENCES truck(truck_id) ON DELETE CASCADE,
    price DOUBLE
);

-- Stores all confirmed order receipts
CREATE TABLE receipt (
    receipt_id MEDIUMINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    date_issued DATETIME,
    date_delivered DATETIME,
    items VARCHAR(300),
    total_price DOUBLE,
    payment VARCHAR(256),
    user_id MEDIUMINT REFERENCES user(user_id) ON DELETE CASCADE,
    trip_id MEDIUMINT REFERENCES trip(trip_id) ON DELETE CASCADE
);

-- Stores all purchasable items
CREATE TABLE item (
    item_id MEDIUMINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    img_path VARCHAR(100) UNIQUE,
    item_name VARCHAR(100) UNIQUE,
    price DOUBLE,
    made_in VARCHAR(50),
    department VARCHAR(50),
    store_name VARCHAR(50)
);

-- Stores all user reviews
CREATE TABLE review (
    review_id MEDIUMINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id MEDIUMINT REFERENCES user(user_id) ON DELETE CASCADE,
    login_id VARCHAR(50) REFERENCES user(login_id) ON DELETE CASCADE,
    item_name VARCHAR(100) REFERENCES item(item_name) ON DELETE CASCADE,
    feedback VARCHAR(300),
    rating TINYINT,
    date_posted DATE,
    CHECK (rating>=1 AND rating<=5)
);

-- Stores all SCS warehouses
CREATE TABLE warehouse (
    warehouse_id MEDIUMINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    address VARCHAR(200) UNIQUE
)