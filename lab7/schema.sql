
CREATE DATABASE IF NOT EXISTS test;

USE test;

DROP TABLE user;

CREATE TABLE user (
    id              INT          AUTO_INCREMENT PRIMARY KEY,
    email           VARCHAR(255) UNIQUE NOT NULL,
    hashed_password VARCHAR(255) NOT NULL,
    created_at      TIMESTAMP    DEFAULT CURRENT_TIMESTAMP
);
