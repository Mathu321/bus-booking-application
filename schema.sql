CREATE DATABASE IF NOT EXISTS bus_reservation;
USE bus_reservation;

DROP TABLE IF EXISTS bookings;
DROP TABLE IF EXISTS buses;

CREATE TABLE buses (
    bus_id INT AUTO_INCREMENT PRIMARY KEY,
    bus_name VARCHAR(100) NOT NULL,
    source VARCHAR(100) NOT NULL,
    destination VARCHAR(100) NOT NULL,
    departure_time DATETIME NOT NULL,
    total_seats INT NOT NULL,
    fare DECIMAL(10,2) NOT NULL
);

CREATE TABLE bookings (
    booking_id INT AUTO_INCREMENT PRIMARY KEY,
    passenger_name VARCHAR(100) NOT NULL,
    bus_id INT NOT NULL,
    seat_number VARCHAR(100) NOT NULL,
    booking_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (bus_id) REFERENCES buses(bus_id) ON DELETE CASCADE
);