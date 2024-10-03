SET @@AUTOCOMMIT = 1;

DROP DATABASE IF EXISTS Therapist;
CREATE DATABASE Therapist;

USE Therapist;

CREATE TABLE Therapist (
   id INT AUTO_INCREMENT PRIMARY KEY,  -- Auto-incrementing primary key
   title VARCHAR(10),                  -- For titles such as Dr., Mr., etc.
   fName VARCHAR(50),                  -- First name of the therapist
   lName VARCHAR(50),                  -- Last name of the therapist
   email VARCHAR(100),                 -- Email address of the therapist
   contactNo VARCHAR(15),              -- Contact number of the therapist
   address VARCHAR(255),               -- Street address of the therapist
   profile LONGBLOB                    -- Profile image stored as large binary data
) AUTO_INCREMENT = 1; 


INSERT INTO Therapist (title, fName, lName, email, contactNo, address, profile)
VALUES
('Dr', 'Lauren', 'Li', 'lauren.li@care.com', '0401122334', '45 King St, Adelaide, SA 5000', NULL),
('Dr', 'David', 'Black', 'david.black@care.com', '0412233445', '789 Health St, Sydney, NSW 2000', NULL),
('Dr', 'Evelyn', 'Carter', 'evelyn.carter@care.com', '0423344556', '456 Wellness Ave, Melbourne, VIC 3000', NULL);
