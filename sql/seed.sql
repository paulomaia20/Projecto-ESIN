-- Tables

-- User(id, username, email, password, caminho_foto, pontuação)
 CREATE TABLE users(
 name VARCHAR PRIMARY KEY,
 email VARCHAR UNIQUE NOT NULL,
 path_photo VARCHAR,
 regist_date DATE default CURRENT_DATE,
 password VARCHAR NOT NULL
 );

 -- Tipo_evento(id, tipo, pontuação)

 CREATE TABLE event_type(
 id SERIAL PRIMARY KEY,
 type VARCHAR NOT NULL,
 path_img VARCHAR NOT NULL,
 score INT NOT NULL
 );

-- Evento(id, nome, data, descricao, local, pontuacao, #id_criador->user)

 CREATE TABLE event(
 id SERIAL PRIMARY KEY,
 title VARCHAR NOT NULL,
 date DATE default CURRENT_DATE, 
 description VARCHAR,
 place VARCHAR NOT NULL,
 id_type INTEGER NOT NULL REFERENCES event_type(id),
 score INT,
 name_creator VARCHAR NOT NULL REFERENCES users(name)
 );

-- Missao(id, pontuação, descrição)
  CREATE TABLE mission(
 id SERIAL PRIMARY KEY,
 score INTEGER NOT NULL,
 description VARCHAR
 );

 --Tarefas(id, descrição, completada)
  CREATE TABLE task(
 id SERIAL PRIMARY KEY,
 description VARCHAR NOT NULL,
 id_mission INTEGER REFERENCES mission(id)
 );

 -- Missoes_user(#id_user->user, #id_missao->missao)
 CREATE TABLE user_mission(
 id_mission INTEGER REFERENCES mission(id),
 name_user VARCHAR REFERENCES users(name)
 );

ALTER TABLE ONLY user_mission
ADD CONSTRAINT user_missions_pkey PRIMARY KEY
(id_mission, name_user);

   -- Tarefas_user(#id_user->user, #id_task->task)
 CREATE TABLE user_progress(
 id SERIAL PRIMARY KEY,
 id_task INTEGER REFERENCES task(id),
 name_user VARCHAR NOT NULL REFERENCES users(name),
 id_event INTEGER REFERENCES event(id)
 );

 -- Comment(id, description, #id_event->event, #name_user->user) 
CREATE TABLE comment(
  id SERIAL PRIMARY KEY,
  description VARCHAR NOT NULL,
  id_event INTEGER NOT NULL REFERENCES event(id),
  date DATE default CURRENT_DATE, 
  name_user VARCHAR NOT NULL REFERENCES users(name)
);

-- Participantes_Evento(#id_evento->evento, #name_user->User)
 CREATE TABLE event_participants(
 id_event INTEGER REFERENCES event(id),
 name_user VARCHAR REFERENCES users(name)
 );

ALTER TABLE ONLY event_participants
ADD CONSTRAINT event_user_pkey PRIMARY KEY
(id_event, name_user);

  -- Badge
 CREATE TABLE badge(
 name VARCHAR PRIMARY KEY,
 path_img VARCHAR,
 id_mission INTEGER REFERENCES mission(id)
 );

   -- Level
 CREATE TABLE level(
 id_level INTEGER PRIMARY KEY,
 min_score INTEGER
 );

INSERT INTO level(id_level, min_score) VALUES(1,10);
INSERT INTO level(id_level, min_score) VALUES(2,70);
INSERT INTO level(id_level, min_score) VALUES(3,110);
INSERT INTO level(id_level, min_score) VALUES(4,170);

INSERT INTO mission(score, description) VALUES(30,'Descricao missao 1');
INSERT INTO mission(score, description) VALUES(40,'Descricao missao 2');
INSERT INTO mission(score, description) VALUES(50,'Descricao missao 3');

INSERT INTO task(description,id_mission) VALUES('Task1_m1',1);
INSERT INTO task(description, id_mission) VALUES('Task2_m1',1);
INSERT INTO task(description,id_mission) VALUES('Task3_m1',1);
INSERT INTO task(description, id_mission) VALUES('Task1_m2',2);
INSERT INTO task(description, id_mission) VALUES('Task2_m2',2);
INSERT INTO task(description, id_mission) VALUES('Task3_m2',2);

INSERT INTO event_type(id,type,path_img,score)  VALUES(1,'Apanhar jornais','newspaper.png', 3);
INSERT INTO event_type(id,type,path_img,score)  VALUES(2,'Apanhar plástico', 'plastic_container.png', 5);
INSERT INTO event_type(id,type,path_img,score)  VALUES(3,'Apanhar vidro', 'glass_jar.png', 6);

INSERT INTO badge(name, path_img, id_mission) VALUES('Plastic Bag','plastic_bag.png',1);
INSERT INTO badge(name, path_img, id_mission) VALUES('Newspaper','newspaper.png',2);