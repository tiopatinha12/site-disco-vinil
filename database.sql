
create table administrador (
	nome varchar(55),
	senha char(255)
	primary key(nome)
);

create table produto (
	imagem blob,
	nome varchar(55),
	album varchar(55),
	valor decimal(5,2)
	id int,
	primary key (id)
);
