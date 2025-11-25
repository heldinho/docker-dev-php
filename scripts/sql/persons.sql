CREATE TABLE IF NOT EXISTS persons (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name      VARCHAR(100) NOT NULL,
    age       TINYINT UNSIGNED NULL,
    city      VARCHAR(80) NULL,
    country   VARCHAR(60) NULL DEFAULT 'USA',
    email     VARCHAR(150) NOT NULL UNIQUE,
    phone     VARCHAR(20) NULL,
    address   VARCHAR(255) NULL,
    zip       VARCHAR(20) NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_email (email),
    INDEX idx_city (city),
    INDEX idx_country (country)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO persons (name, age, city, country, email, phone, address, zip)
VALUES ('John Doe', 20, 'New York', 'USA', 'john@example.com', '1234567890', '123 Main Street, Anytown, USA', '12345');