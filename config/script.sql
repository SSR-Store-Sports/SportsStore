DROP DATABASE tatifit_database;
CREATE DATABASE tatifit_database;

USE tatifit_database;

CREATE TABLE tatifit_users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(80) NOT NULL,
    email VARCHAR(80) UNIQUE NOT NULL,
    password VARCHAR(20) NOT NULL,
    telefone VARCHAR (20) NOT NULL,
    cpf VARCHAR(11) NOT NULL,
    role ENUM( 'user', 'admin')
);

CREATE TABLE tatifit_users_address (
    id INT PRIMARY KEY AUTO_INCREMENT,
    type varchar(20) NOT NULL,
    cep VARCHAR (8) NOT NULL,
    street VARCHAR (99) NOT NULL,
    neighborhood VARCHAR(100) NOT NULL,
    number INT NOT NULL,
    city VARCHAR(100) NOT NULL,
    state VARCHAR(100) NOT NULL,
    
    user_id INT NOT NULL,
    FOREIGN KEY (user_id) REFERENCES tatifit_users(id)
);

CREATE TABLE tatifit_products (
    id INT PRIMARY KEY AUTO_INCREMENT,
    price DECIMAL(10,2) NOT NULL,
    amount INT,
    status ENUM ('Entregue', 'Em Andamento', 'Cancelado'),
    date_creation TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    url_image VARCHAR(120),
    
    user_id int,
    FOREIGN KEY (user_id) REFERENCES tatifit_users(id)
);

CREATE TABLE tatifit_orders (
    id INT PRIMARY KEY AUTO_INCREMENT,
    price DECIMAL(10,2) NOT NULL,
    date_creation TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    
    user_id INT,
    product_id INT,
    FOREIGN KEY (user_id) REFERENCES tatifit_users(id),
    FOREIGN KEY (product_id) REFERENCES tatifit_products(id)
);

CREATE TABLE tatifit_categories (
    Categories_id INT PRIMARY KEY AUTO_INCREMENT,
    price DECIMAL(10,2) NOT NULL,
    amount INT,
    status ENUM ('Entregue', 'Em Andamento', 'Cancelado'),
    date_creation TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    url_image VARCHAR(50),
    
    user_id INT,
    FOREIGN KEY (user_id) REFERENCES tatifit_users(id)
);

CREATE TABLE tatifit_suppliers (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100),
    telephone char(13) NOT NULL,
    type VARCHAR(20)
);

CREATE TABLE tatifit_stocks (
    id INT PRIMARY KEY AUTO_INCREMENT,
    price DECIMAL(10,2) NOT NULL,
    size ENUM ('P', 'M', 'G', 'GG'),
    color ENUM('Vermelho','Azul','Preto','Branco','Verde', 'Laraja'),
    amount_lung INT,
    amount_request INT,
    
    products_id INT,
    suppliers_id INT,
    FOREIGN KEY (products_id) REFERENCES tatifit_products(id),
    FOREIGN KEY (suppliers_id) REFERENCES tatifit_suppliers(id)
);

CREATE TABLE tatifit_payments (
    id INT PRIMARY KEY AUTO_INCREMENT,
    code INT,
    status VARCHAR(20),
    
    order_id INT,
    FOREIGN KEY (order_id) REFERENCES tatifit_orders(id)
);
