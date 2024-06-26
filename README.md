Table: carrinho
Columns:
id int(11) AI PK 
usuario_id int(11) 
produto_id int(11) 
quantidade int(11)

Table: estoque
Columns:
id int(11) AI PK 
nome varchar(255) 
tipo enum('comida','bebida','doce') 
quantidade int(11) 
preco decimal(10,2) 
imagem varchar(255) 
data_adicao timestamp

Table: pedido_itens
Columns:
id int(11) AI PK 
pedido_id int(11) 
produto_id int(11) 
quantidade int(11) 
preco decimal(10,2)

Table: pedidos
Columns:
id int(11) AI PK 
usuario_id int(11) 
total decimal(10,2) 
status varchar(50) 
data_pedido timestamp

Table: users
Columns:
id int(11) AI PK 
name varchar(100) 
email varchar(100) 
password varchar(255) 
role enum('aluno','funcionario','admin')


SET FOREIGN_KEY_CHECKS = 0;

INSERT INTO users (name, email, password, role)
VALUES ('Administrador', 'adm@gmail.com', '$2y$10$SRsTD.d3GjzlAF9.7b.gMOv9jAkFUI7xEitT0E7rgk9H4mwUzx6Km', 'admin');
