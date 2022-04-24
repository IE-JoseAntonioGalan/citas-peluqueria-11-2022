CREATE DATABASE IF NOT EXISTS hairdressers;

USE hairdressers;

CREATE TABLE IF NOT EXISTS services (
  id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  service VARCHAR(255) NOT NULL,
  price VARCHAR(15)
);

CREATE TABLE IF NOT EXISTS clients (
  id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  fullname VARCHAR(255) NOT NULL,
  gender VARCHAR(50) NOT NULL,
  phone_number VARCHAR(255) NOT NULL,
  email VARCHAR(255)
);

CREATE TABLE IF NOT EXISTS appointments (
  id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  appointment_date DATE NOT NULL,
  client_id INT NOT NULL,
  comment VARCHAR(255),
  FOREIGN KEY(client_id) REFERENCES clients(id)
);

CREATE TABLE IF NOT EXISTS appointments_services (
  appointment_id INT NOT NULL,
  service_id INT NOT NULL,
  FOREIGN KEY(appointment_id) REFERENCES appointments(id),
  FOREIGN KEY(service_id) REFERENCES services(id)
);
