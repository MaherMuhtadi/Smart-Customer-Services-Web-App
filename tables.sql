-- Stores all confirmed orders
CREATE TABLE order (
    order_id MEDIUMINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    date_issued DATETIME,
    date_delivered DATETIME DEFAULT NULL,
    total_price DOUBLE,
    payment VARCHAR(16),
    user_id REFERENCES user(user_id) ON DELETE CASCADE,
    trip_id REFERENCES trip(trip_id) ON DELETE CASCADE,
)

-- Stores all purchasable items
CREATE TABLE item (
    item_id MEDIUMINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    item_name VARCHAR(100),
    price DOUBLE,
    made_in VARCHAR(50),
    department VARCHAR(50),
    store_name VARCHAR(50)
)

-- Stores all user accounts
CREATE TABLE user (
    user_id MEDIUMINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    login_id VARCHAR(50),
    password VARCHAR(50),
    first_name VARCHAR(50),
    last_name VARCHAR(50),
    tel_no VARCHAR(12),
    email VARCHAR(100),
    address VARCHAR(50),
    balance DOUBLE DEFAULT 0.00
)

-- Stores all delivery trips
CREATE TABLE trip (
    trip_id MEDIUMINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    source_code VARCHAR(50),
    destination_code VARCHAR(50),
    distance DOUBLE,
    truck_id REFERENCES truck(truck_id) ON DELETE CASCADE,
    price DOUBLE
)

-- Stores all delivery vehicles
CREATE TABLE truck (
    truck_id MEDIUMINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    truck_code VARCHAR(50),
    availability_code TINYINT(1)
)