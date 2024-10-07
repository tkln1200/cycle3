CREATE TABLE patients (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    diagnosis VARCHAR(255) NOT NULL, -- 患者诊断信息
    progress INT NOT NULL,           -- 患者康复进展 (0-100%)
    status ENUM('Active', 'Inactive', 'On Hold', 'Follow-up') NOT NULL, -- 患者当前状态
    medical_history TEXT,            -- 患者病史
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP -- 创建时间
);

INSERT INTO patients (name, diagnosis, progress, status, medical_history) 
VALUES 
('John Anders', 'Depression', 33, 'Active', 'No known allergies'),
('Zoe Ashford', 'Generalized Anxiety Disorder', 7, 'Follow-up', 'Diabetic'),
('Emma Harris', 'Bipolar Disorder', 98, 'Active', 'Bipolar treatment ongoing'),
('James Foster', 'Generalized Anxiety Disorder', 58, 'On Hold', 'Anxiety therapy on hold');
