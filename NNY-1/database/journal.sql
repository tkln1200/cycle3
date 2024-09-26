SET @@AUTOCOMMIT = 1;

DROP DATABASE IF EXISTS Journal;
CREATE DATABASE Journal;

USE Journal;

CREATE TABLE Journal(
    journalId int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    title varchar(255) NOT NULL,
    dateCreated DATE NOT NULL,
    timeCreated TIME NOT NULL,
    details LONGTEXT NOT NULL,
    moodLevel int NOT NULL,
    file BLOB,
    patientId int NOT NULL,
    CONSTRAINT FK_Patient FOREIGN KEY (patientId) REFERENCES {Patient}(patientId)
) AUTO_INCREMENT = 1;

