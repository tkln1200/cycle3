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

ALTER TABLE Patient
ADD COLUMN password VARCHAR(255);  

