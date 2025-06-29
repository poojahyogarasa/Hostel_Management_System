
CREATE TABLE IF NOT EXISTS admin_login (
    ID VARCHAR(10) PRIMARY KEY,
    Password VARCHAR(255)
);
INSERT INTO admin_login (ID, Password) VALUES (
    'admin001',
    '$2y$10$JZwCLTt0AE4Vw7rOZc5F/.1z5TqY82B3zWHD1vYG7iF78AXA2.8/S'
);
-- password = admin123

CREATE TABLE IF NOT EXISTS notifications (
    ID INT AUTO_INCREMENT PRIMARY KEY,
    Student_ID VARCHAR(10),
    Contact VARCHAR(20),
    Message TEXT,
    Date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
