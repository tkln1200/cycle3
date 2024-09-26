SET @@AUTOCOMMIT = 1;

DROP DATABASE IF EXISTS Therapist;
CREATE DATABASE Therapist;

USE Therapist;

CREATE TABLE Therapist(
    therapistId int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    title varchar NOT NULL,
    fName varchar NOT NULL,
    lName varchar NOT NULL,
) AUTO_INCREMENT = 1;

INSERT INTO Therapist(title, fName, lName) 
VALUES
('Dr', 'Lauren', 'Li'),
('Dr', 'David', 'Black'),
('Dr', 'Evelyn', 'Carter'),
('Dr', 'Jullian', 'Smith')
('Dr', 'Jacob', 'Young');