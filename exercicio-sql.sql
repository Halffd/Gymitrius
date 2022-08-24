create database maquina;

use maquina;

- Possuem (ID-Usuário, ID-Máquina)
- Contêm (ID-Máquina, ID-Software)


create table maquinas (
	ID-Máquina int not null primary key auto_increment,
	Tipo varchar(50) not null,
	Velocidade varchar(50) not null,
	Hard-Disk varchar(14) not null,
	Placa-Rede varchar(100) not null,
	Memória-RAM varchar(14) not null
);

create table software (
	ID-Software int not null primary key auto_increment,
	Produto varchar(50),
	Hard-Disk varchar(50),
	Memória-RAM varchar(100) not null
);

create table usuarios (
	ID-Usuário int not null primary key auto_increment,
	Tipo varchar(50) not null,
	Velocidade varchar(50) not null,
	Hard-Disk varchar(14) not null,
	Placa-Rede varchar(100) not null,
	Memória-RAM varchar(100) not null,
    Senha password(100) not null,
	Nome-Usuário varchar(14) not null,
	Ramal varchar(14) not null,
	Especialidade varchar(14) not null
);
