/* CREATE THE DATABASE NAMED CAFE */
CREATE DATABASE cafe;

/* USE THE DATABASE - CAFE */
USE cafe;

/* CREATE THE REQUIRED TABLES */
CREATE TABLE Categories (
    categoryID INT AUTO_INCREMENT PRIMARY KEY,
    categoryName VARCHAR(255) NOT NULL
);

/* Create the table that includes the product data */
CREATE TABLE PRODUCTS (
    productID INT AUTO_INCREMENT PRIMARY KEY,
    categoryID INT,
    productCode VARCHAR(255) NOT NULL,
    productName VARCHAR(255) NOT NULL,
    listPrice DECIMAL(10,2) NOT NULL,
    FOREIGN KEY (categoryID) REFERENCES Categories(categoryID)
);

/* Insert the data into the Categories table */
INSERT INTO Categories (categoryName) VALUES
('Regular'),
('Zero Sugar'),
('Energy');

/* Insert the data into the Products table */
INSERT INTO PRODUCTS (productID,categoryID, productCode, productName, listPrice) VALUES
(1, 1, 'a', 'CocaCola', 10.00),
(2, 1, 'b', 'Sprite', 10.00),
(3, 1, 'c', 'Solo Original Lemonade', 8.00),
(4, 1, 'd', 'Fanta', 7.99),
(5, 1, 'e', 'Sunkist', 8.00),
(6, 2, 'f', 'Schweppes', 11.00),
(7, 2, 'g', 'Pepsi', 10.99),
(8, 3, 'h', 'Red Bull', 7.99),
(9, 3, 'i', 'Gatorade', 10.99),
(10, 3, 'j', 'Monster', 10.99);
