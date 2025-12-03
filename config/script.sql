#CREATE DATABASE db_tatifitwear;
USE db_tatifitwear;

CREATE TABLE tatifit_users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    
    name VARCHAR(80) NOT NULL,
    email VARCHAR(80) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL, 
    phone VARCHAR(20) NOT NULL,
    cpf VARCHAR(14) UNIQUE NOT NULL, 
    role ENUM('user', 'admin') DEFAULT 'user'
);

CREATE TABLE tatifit_users_address (
    id INT PRIMARY KEY AUTO_INCREMENT,
    
    cep VARCHAR(8) NOT NULL, 
    street VARCHAR(150) NOT NULL,
    number VARCHAR(10) NULL,
    complement VARCHAR(100) NULL,
    additional_info VARCHAR(128) NULL,
    
    type ENUM('Casa', 'Trabalho', 'Outro') NOT NULL,
    
    recipient_name VARCHAR(100) NOT NULL,
    contact_phone VARCHAR(20) NOT NULL,
    
    neighborhood VARCHAR(100) NOT NULL,
    city VARCHAR(100) NOT NULL,
    state VARCHAR(2) NOT NULL,
    
    user_id INT NOT NULL,
    FOREIGN KEY (user_id) REFERENCES tatifit_users (id)
);

CREATE TABLE tatifit_categories (
    id INT PRIMARY KEY AUTO_INCREMENT,
    
    name VARCHAR(100) UNIQUE NOT NULL
);

CREATE TABLE tatifit_suppliers (
    id INT PRIMARY KEY AUTO_INCREMENT,
    
    name VARCHAR(100) UNIQUE NOT NULL,
    telephone CHAR(13) NOT NULL,
    type VARCHAR(20)
);

CREATE TABLE tatifit_products (
    id INT PRIMARY KEY AUTO_INCREMENT,
    
    name VARCHAR(120) NOT NULL,
    description TEXT,
    price DECIMAL(10 , 2) NOT NULL,
    old_price DECIMAL(10,2) NULL,
    discount_percent INT NULL,
    free_shipping BOOLEAN DEFAULT 0,
    rating DECIMAL(3,2) DEFAULT 0,
    rating_count INT DEFAULT 0,
    installments_info VARCHAR(50) NULL,
    is_new BOOLEAN DEFAULT 0,
    status ENUM('Ativo', 'Inativo') DEFAULT 'Ativo',
    date_created TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    date_update TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    url_image VARCHAR(255),
    
    category_id INT NOT NULL,
    FOREIGN KEY (category_id) REFERENCES tatifit_categories (id),
    
    author_id INT NOT NULL,
    FOREIGN KEY (author_id) REFERENCES tatifit_users (id)
);

CREATE TABLE tatifit_stocks (
    id INT PRIMARY KEY AUTO_INCREMENT,
    
    size ENUM('P', 'M', 'G', 'GG', 'XG') NOT NULL,
    stock_quantity INT NOT NULL DEFAULT 0,
    amount_request INT DEFAULT 0,
    
    products_id INT NOT NULL,
    suppliers_id INT,
    
    FOREIGN KEY (products_id) REFERENCES tatifit_products (id),
    FOREIGN KEY (suppliers_id) REFERENCES tatifit_suppliers (id),
    UNIQUE KEY uk_product_stock (products_id, size) 
);

CREATE TABLE tatifit_orders (
    id INT PRIMARY KEY AUTO_INCREMENT,
    
    total_price DECIMAL(10 , 2 ) NOT NULL, 
    shipping_price DECIMAL(10 , 2 ) DEFAULT 0,
    status ENUM('Carrinho', 'Pendente', 'Em Processamento', 'Enviado', 'Entregue', 'Cancelado') NOT NULL DEFAULT 'Pendente',
    date_creation TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    
    user_id INT NOT NULL,
    address_id INT,
    FOREIGN KEY (user_id) REFERENCES tatifit_users (id)
    -- FOREIGN KEY (address_id) REFERENCES tatifit_users_address (id)
);

CREATE TABLE tatifit_order_items (
    id INT PRIMARY KEY AUTO_INCREMENT,
    
    quantity INT NOT NULL,
    unit_price DECIMAL(10, 2) NOT NULL,
    
    order_id INT NOT NULL,
    stock_id INT NOT NULL,
    
    FOREIGN KEY (order_id) REFERENCES tatifit_orders (id),
    FOREIGN KEY (stock_id) REFERENCES tatifit_stocks (id),
    UNIQUE KEY uk_order_stock (order_id, stock_id)
);

CREATE TABLE tatifit_payments (
    id INT PRIMARY KEY AUTO_INCREMENT,
    transaction_code VARCHAR(50) NOT NULL,
    status ENUM('Aprovado', 'Recusado', 'Aguardando', 'Estornado') NOT NULL,
    payment_method VARCHAR(50),
    amount DECIMAL(10, 2) NOT NULL,
    date_payment TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    
    order_id INT UNIQUE NOT NULL,
    FOREIGN KEY (order_id) REFERENCES tatifit_orders (id)
);

INSERT INTO tatifit_users (name, email, password, phone, cpf, role) VALUES
('admin', 'tatifitwearadm@gmail.com', '$2y$10$zZ9ELGb.O4tSLfkVXhgYDeKa.VxvezZwjbBrxuQvud.kYfqQd9n16', '11 94456-8825', '237.110.482-45', 'admin');

INSERT INTO tatifit_users_address (type, cep, street, neighborhood, number, city, state, user_id) VALUES
('Residencial', '01001000', 'Rua das Flores', 'Centro', '100', 'São Paulo', 'SP', 1);

INSERT INTO tatifit_categories (name) VALUES
('Conjuntos'),
('Camisetas'),
('Tops'),
('Shorts'),
('Jaquetas');

INSERT INTO tatifit_suppliers (name, telephone, type) VALUES
('Roupas & Esportes Brasil', '11999990000', 'Roupas Esportivas');
