create database db_users;
use db_users;

create table user(
    id int primary key auto_increment not null,
    nome varchar(100) not null,
    email varchar(250) not null unique,
    telefone varchar(15) not null
);