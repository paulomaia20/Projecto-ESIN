-- Tables
 CREATE TABLE users(
 name VARCHAR PRIMARY KEY,
 email VARCHAR NOT NULL,
 password VARCHAR NOT NULL
 );

-- Evento(id, nome, data, descricao, local, pontuacao, #id_criador->user)

 CREATE TABLE event(
 id SERIAL,
 title VARCHAR NOT NULL,
 date DATE default CURRENT_DATE, 
 description VARCHAR,
 place VARCHAR,
 type VARCHAR,
 score INT,
 name_creator VARCHAR
 );





