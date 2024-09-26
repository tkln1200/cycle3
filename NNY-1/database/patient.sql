SET @@AUTOCOMMIT = 1;

DROP DATABASE IF EXISTS Patient;
CREATE DATABASE Patient;

USE Patient;

CREATE TABLE Patient (
    patientId int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    title varchar(4) NOT NULL,
    fName varchar(20) NOT NULL,
    lName varchar(20) NOT NULL,
    age int NOT NULL,
    gender varchar(10) NOT NULL,
    contactNo varchar(10) NOT NULL,
    email varchar(255) NOT NULL,
    streetAddress varchar(255) NOT NULL,
    postCode varchar(4) NOT NULL,
    height int NOT NULL,
    weight int NOT NULL,
    startDate DATE NOT NULL,
    endDate DATE,
    diagnosis varchar(255) NOT NULL,
    status varchar(50),
    therapistId int NOT NULL,
    CONSTRAINT FK_Therapist FOREIGN KEY (therapistId) REFERENCES Therapist(therapistId)
) AUTO_INCREMENT = 1;

INSERT INTO Patient(title, fName, lName, age, gender, contactNo, email, streetAddress, postCode, height, weight, startDate, endDate, diagnosis, status, therapistId) 
VALUES
('Ms', 'Zoe', 'Glasson', 25, 'F', '0412345678', 'zoe.glasson@gmail.com', '122 Main Rd', '5000', 156, 60, '2024-01-23', NULL, 'GAD', 'Active', 1),
('Ms.', 'Emily', 'Clark', 28, 'F', '0419876543', 'emilyc@example.com', '456 Oak Ave', '3001', 165, 60, '2022-09-12', NULL, 'Depression', 'Follow-up', 2),
('Mr.', 'Michael', 'Brown', 45, 'M', '0412348888', 'mikeb@example.com', '789 Pine Rd', '2000', 175, 85, '2023-02-25', NULL, 'PTSD', 'Follow-up', 1),
('Mrs.', 'Sophia', 'Miller', 52, 'F', '0423456789', 'sophiam@example.com', '321 Maple Ln', '6002', 170, 68, '2021-11-05', NULL, 'Bipolar Disorder', 'Active', 3),
('Mr.', 'James', 'Wilson', 39, 'M', '0421234567', 'jamesw@example.com', '654 Elm St', '4003', 182, 90, '2022-06-15', NULL, 'Schizophrenia', 'Active', 2);