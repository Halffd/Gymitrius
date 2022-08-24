create database academias;

use academias;

create table academia (
	id int not null primary key auto_increment,
	nome varchar(50) not null,
	email varchar(50) not null,
	telefone varchar(14) not null,
	endereco varchar(100) not null,
	cnpj varchar(14) not null,
	preco varchar(32) not null,
	cupom varchar(32),
	imagem LONGBLOB
);

create table usuario (
	id int not null primary key auto_increment,
	nome varchar(50),
	sobrenome varchar(50),
	email varchar(100) not null,
	senha varchar(32) not null,
	imagem varchar(150) not null
);

create table personal (
	id int not null primary key auto_increment,
	nome varchar(50),
	sobrenome varchar(50),
	senha varchar(32) not null,
	preco varchar(50) not null,
	data_criacao datetime default current_timestamp,
	imagem varchar(150) not null
);
