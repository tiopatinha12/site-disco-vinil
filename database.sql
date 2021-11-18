create database disco;
use disco;

create table administrador (
	nome varchar(55),
	senha char(255),
	primary key(nome)
);

create table produto (
	imagem varchar(255),
	nome varchar(55),
	banda varchar(55),
	valor decimal(5,2),
	quantidade int,
	id int auto_increment,
	primary key (id)
);
