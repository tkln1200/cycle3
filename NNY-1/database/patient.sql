SET @@AUTOCOMMIT = 1;

DROP DATABASE IF EXISTS Patient;
CREATE DATABASE Patient;

USE Patient;

CREATE TABLE Patient (
 id INT AUTO_INCREMENT PRIMARY KEY,  -- Auto-incrementing primary key
   therapistId INT,                    -- Foreign key to reference the therapist
   title VARCHAR(10),                  -- For titles such as Mr., Mrs., etc.
   fName VARCHAR(50),                  -- First name of the patient
   lName VARCHAR(50),                  -- Last name of the patient
   dob DATE,                           -- Date of birth instead of age
   gender VARCHAR(10),                 -- Gender of the patient
   contactNo VARCHAR(15),              -- Contact number
   email VARCHAR(100),                 -- Email address
   streetAddress VARCHAR(255),         -- Street address of the patient
   postCode VARCHAR(10),               -- Postal code
   height DECIMAL(5,2),                -- Height (in cm or meters)
   weight DECIMAL(5,2),                -- Weight (in kg or pounds)
   startDate DATE,                     -- Start date of the treatment
   endDate DATE,                       -- End date of the treatment
   diagnosis TEXT,                     -- Diagnosis details
   status VARCHAR(20),                 -- Status of the patient (e.g., Active, Inactive, etc.)
   profile LONGBLOB,                   -- Profile image stored as large binary data
   FOREIGN KEY (therapistId) REFERENCES Therapist(id)  -- Foreign key relationship to Therapist
) AUTO_INCREMENT = 1;

INSERT INTO Patient (therapistId, title, fName, lName, dob, gender, contactNo, email, streetAddress, postCode, height, weight, startDate, endDate, diagnosis, status, profile)
VALUES
(1, 'Ms', 'Zoe', 'Glasson', '1999-02-18', 'F', '0412345678', 'zoe.glasson@gmail.com', '122 Main Rd', '5000', 156, 60, '2024-01-23', NULL, 'GAD', 'Active', NULL),
(2, 'Ms.', 'Emily', 'Clark', '1995-04-12', 'F', '0419876543', 'emilyc@gmail.com.com', '456 Oak Ave', '3001', 165, 60, '2022-09-12', NULL, 'Depression', 'Follow-up', NULL),
(1, 'Mr.', 'Michael', 'Brown', '1978-06-15', 'M', '0412348888', 'mikeb@gmail.com.com', '789 Pine Rd', '2000', 175, 85, '2023-02-25', NULL, 'PTSD', 'Follow-up', NULL),
(3, 'Mrs.', 'Sophia', 'Miller', '1971-09-22', 'F', '0423456789', 'sophiam@gmail.com.com', '321 Maple Ln', '6002', 170, 68, '2021-11-05', NULL, 'Bipolar Disorder', 'Active', NULL),
(2, 'Mr.', 'James', 'Wilson', '1984-02-19', 'M', '0421234567', 'jamesw@gmail.com.com', '654 Elm St', '4003', 182, 90, '2022-06-15', NULL, 'Schizophrenia', 'Active', NULL);

ALTER TABLE Patient
ADD COLUMN password VARCHAR(255);  

UPDATE Patient SET password = 'ZoeAsh1' WHERE id = 1;