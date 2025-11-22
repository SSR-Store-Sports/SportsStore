DROP DATABASE tatifit_database;
CREATE DATABASE tatifit_database;

USE tatifit_database;

CREATE TABLE tatifit_users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(80) NOT NULL,
    email VARCHAR(80) UNIQUE NOT NULL,
    password VARCHAR(20) NOT NULL,
    telefone VARCHAR(20) NOT NULL,
    cpf VARCHAR(11) NOT NULL,
    role ENUM('user', 'admin')
);

CREATE TABLE tatifit_users_address (
    id INT PRIMARY KEY AUTO_INCREMENT,
    type VARCHAR(20) NOT NULL,
    cep VARCHAR(8) NOT NULL,
    street VARCHAR(99) NOT NULL,
    neighborhood VARCHAR(100) NOT NULL,
    number INT NOT NULL,
    city VARCHAR(100) NOT NULL,
    state VARCHAR(100) NOT NULL,
    
    user_id INT NOT NULL,
    FOREIGN KEY (user_id)
        REFERENCES tatifit_users (id)
);

CREATE TABLE tatifit_products (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(120),
    descrição VARCHAR(120),
    price DECIMAL(10 , 2) NOT NULL,
    old_price DECIMAL(10,2) NULL,
    discount_percent INT NULL,
    free_shipping BOOLEAN DEFAULT 0,
    rating DECIMAL(3,2) DEFAULT 0,
    rating_count INT DEFAULT 0,
    installments_info VARCHAR(50) NULL,
    is_new BOOLEAN DEFAULT 0,
    amount INT,
    status ENUM('Ativo', 'Inativo'),
    date_created TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    date_update TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    url_image VARCHAR(120),
    
    author_id INT NOT NULL,
    FOREIGN KEY (author_id)
        REFERENCES tatifit_users (id)
);

CREATE TABLE tatifit_orders (
    id INT PRIMARY KEY AUTO_INCREMENT,
    price DECIMAL(10 , 2 ) NOT NULL,
    date_creation TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    user_id INT,
    product_id INT,
    FOREIGN KEY (user_id)
        REFERENCES tatifit_users (id),
    FOREIGN KEY (product_id)
        REFERENCES tatifit_products (id)
);

CREATE TABLE tatifit_categories (
    Categories_id INT PRIMARY KEY AUTO_INCREMENT,
    price DECIMAL(10 , 2 ) NOT NULL,
    amount INT,
    status ENUM('Entregue', 'Em Andamento', 'Cancelado'),
    date_creation TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    url_image VARCHAR(50),
    user_id INT,
    FOREIGN KEY (user_id)
        REFERENCES tatifit_users (id)
);

CREATE TABLE tatifit_suppliers (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100),
    telephone CHAR(13) NOT NULL,
    type VARCHAR(20)
);

CREATE TABLE tatifit_stocks (
    id INT PRIMARY KEY AUTO_INCREMENT,
    price DECIMAL(10 , 2) NOT NULL,
    size ENUM('P', 'M', 'G', 'GG'),
    color ENUM('Vermelho', 'Azul', 'Preto', 'Branco', 'Verde', 'Laraja'),
    amount_lung INT,
    amount_request INT,
    products_id INT,
    suppliers_id INT,
    FOREIGN KEY (products_id)
        REFERENCES tatifit_products (id),
    FOREIGN KEY (suppliers_id)
        REFERENCES tatifit_suppliers (id)
);

CREATE TABLE tatifit_payments (
    id INT PRIMARY KEY AUTO_INCREMENT,
    code INT,
    status VARCHAR(20),
    order_id INT,
    FOREIGN KEY (order_id)
        REFERENCES tatifit_orders (id)
);

INSERT INTO tatifit_users (name, email, password, telefone, cpf, role) VALUES
('Mariana Santos', 'mariana.santos@example.com', 'senha123', '11988887777', '12345678901', 'user'),
('Lucas Almeida', 'lucas.almeida@example.com', 'senha123', '21977776666', '23456789012', 'user'),
('Fernanda Lopes', 'fernanda.lopes@example.com', 'senha123', '31966665555', '34567890123', 'user'),
('Thiago Ramos', 'thiago.ramos@example.com', 'senha123', '41955554444', '45678901234', 'admin'),
('Camila Ferreira', 'camila.ferreira@example.com', 'senha123', '51944443333', '56789012345', 'admin');

INSERT INTO tatifit_users_address (type, cep, street, neighborhood, number, city, state, user_id) VALUES
('Residencial', '01001000', 'Rua das Flores', 'Centro', 100, 'São Paulo', 'SP', 1),
('Comercial', '20040000', 'Avenida Atlântica', 'Copacabana', 50, 'Rio de Janeiro', 'RJ', 2),
('Residencial', '30110000', 'Rua dos Andes', 'Savassi', 200, 'Belo Horizonte', 'MG', 3),
('Residencial', '80010000', 'Rua XV de Novembro', 'Centro', 400, 'Curitiba', 'PR', 4),
('Comercial', '90010000', 'Rua Padre Chagas', 'Moinhos', 220, 'Porto Alegre', 'RS', 5);

INSERT INTO tatifit_products
(name, descrição, price, old_price, discount_percent, free_shipping, rating, rating_count, installments_info, is_new, amount, status, url_image, author_id)
VALUES
('Conjunto Fitness Completo - Top + Legging', 'Conjunto esportivo de alta compressão', 120.00, 160.00, 25, 1, 4.8, 203, '12x de R$ 10,00 sem juros', 1, 15, 'Ativo', '/public/images/produto1.png', 4),
('Camiseta Dry Fit', 'Camiseta leve e respirável para treinos', 99.90, 129.90, 23, 0, 4.6, 180, '10x de R$ 9,99', 0, 25, 'Ativo', '/public/images/produto1.png', 4),
('Top Esportivo Alta Sustentação', 'Top ideal para treinos de impacto', 89.90, 119.90, 25, 1, 4.9, 250, '8x de R$ 11,24', 0, 30, 'Ativo', '/public/images/produto1.png', 5),
('Short Fitness Pocket', 'Short com bolsos laterais e tecido respirável', 79.90, 99.90, 20, 1, 4.5, 140, '6x de R$ 13,31', 0, 40, 'Ativo', '/public/images/produto1.png', 5),
('Jaqueta Corta Vento', 'Jaqueta leve para treino ao ar livre', 199.90, 249.90, 20, 0, 4.7, 120, '10x de R$ 19,99', 0, 10, 'Ativo', '/public/images/produto1.png', 5);

INSERT INTO tatifit_orders (price, user_id, product_id) VALUES
(120.00, 1, 1),
(99.90, 2, 2),
(89.90, 3, 3),
(79.90, 4, 4),
(199.90, 5, 5);

INSERT INTO tatifit_categories (price, amount, status, url_image, user_id) VALUES
(120.00, 10, 'Entregue', 'fitness_completo.jpg', 1),
(99.90, 20, 'Entregue', 'camisetas.jpg', 2),
(89.90, 15, 'Em Andamento', 'tops.jpg', 3),
(79.90, 12, 'Entregue', 'shorts.jpg', 4),
(199.90, 5, 'Cancelado', 'jaquetas.jpg', 5);

INSERT INTO tatifit_suppliers (name, telephone, type) VALUES
('FitWear Brasil', '11999990000', 'Roupas Esportivas'),
('TecidoSul', '21988880000', 'Tecelagem'),
('StrongModa', '31977770000', 'Roupas Fitness'),
('PowerTex', '41966660000', 'Tecido Técnico'),
('BodyShape', '51955550000', 'Moda Esportiva');

INSERT INTO tatifit_stocks (price, size, color, amount_lung, amount_request, products_id, suppliers_id) VALUES
(120.00, 'M', 'Azul', 30, 5, 1, 1),
(99.90, 'G', 'Preto', 25, 4, 2, 2),
(89.90, 'M', 'Branco', 20, 3, 3, 3),
(79.90, 'P', 'Vermelho', 35, 6, 4, 4),
(199.90, 'GG', 'Verde', 10, 2, 5, 5);

INSERT INTO tatifit_payments (code, status, order_id) VALUES
(2001, 'Aprovado', 1),
(2002, 'Aguardando', 2),
(2003, 'Aprovado', 3),
(2004, 'Cancelado', 4),
(2005, 'Aprovado', 5);

SELECT * FROM tatifit_products;
