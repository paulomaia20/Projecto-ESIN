-- Tables
 CREATE TABLE users(
 name VARCHAR PRIMARY KEY,
 email VARCHAR NOT NULL,
 password VARCHAR NOT NULL
 );

-- Evento(id, nome, data, descricao, local, pontuacao, #id_criador->user)

 CREATE TABLE event(
 id SERIAL PRIMARY KEY,
 title VARCHAR NOT NULL,
 date DATE default CURRENT_DATE, 
 description VARCHAR,
 place VARCHAR,
 type VARCHAR,
 score INT,
 name_creator VARCHAR
 );

 -- Tipo_evento(id, tipo, pontuação)

 CREATE TABLE event_type(
 id SERIAL PRIMARY KEY,
 type VARCHAR NOT NULL,
 score INT
 );

-- Missao(id, pontuação, descrição)
  CREATE TABLE mission(
 id SERIAL PRIMARY KEY,
 score int,
 description VARCHAR
 );

 --Tarefas(id, descrição, completada)
  CREATE TABLE task(
 id SERIAL PRIMARY KEY,
 description VARCHAR,
 completed boolean,
 id_mission INTEGER
 );


 -- Missoes_user(#id_user->user, #id_missao->missao)
 CREATE TABLE user_mission(
 id_mission INTEGER,
 name_user VARCHAR
 );

   -- Tarefas_user(#id_user->user, #id_task->task)
 CREATE TABLE user_tasks(
 id_task INTEGER,
 name_user VARCHAR,
 completed boolean DEFAULT false
 );

 -- UserPoints(id, id_user->user, id_missao->missao, id_tipo_evento->tipo_evento, points) 
CREATE TABLE userpoints(
  id SERIAL PRIMARY KEY,
  name_user VARCHAR,
  id_mission INTEGER,
  id_event_type INTEGER,
  score INTEGER
);

 -- Comment(id, description, #id_event->event, #name_user->user) 
CREATE TABLE comment(
  id SERIAL PRIMARY KEY,
  description VARCHAR,
  id_event INTEGER REFERENCES event(id),
  date DATE default CURRENT_DATE, 
  name_user VARCHAR REFERENCES users(name)
);



ALTER TABLE ONLY userpoints
 ADD CONSTRAINT userpoints_name_user FOREIGN KEY (name_user)
REFERENCES users(name) ON UPDATE CASCADE ON DELETE CASCADE;

ALTER TABLE ONLY userpoints
 ADD CONSTRAINT userpoints_id_mission FOREIGN KEY (id_mission)
REFERENCES mission(id) ON UPDATE CASCADE ON DELETE CASCADE;


ALTER TABLE ONLY user_tasks 
ADD CONSTRAINT user_tasks_mission_pkey PRIMARY KEY
(id_task, name_user);

ALTER TABLE ONLY user_tasks
 ADD CONSTRAINT user_tasks_id_task_fkey FOREIGN KEY (id_task)
REFERENCES task(id) ON UPDATE CASCADE ON DELETE CASCADE;

ALTER TABLE ONLY user_tasks 
 ADD CONSTRAINT user_tasks_user_name_fkey FOREIGN KEY (name_user)
REFERENCES users(name) ON UPDATE CASCADE ON DELETE CASCADE;

ALTER TABLE ONLY task
 ADD CONSTRAINT id_mission_fkey FOREIGN KEY (id_mission)
REFERENCES mission(id) ON UPDATE CASCADE ON DELETE CASCADE;

ALTER TABLE ONLY user_mission
ADD CONSTRAINT user_missions_pkey PRIMARY KEY
(id_mission, name_user);

ALTER TABLE ONLY user_mission
 ADD CONSTRAINT user_mission_id_mission_fkey FOREIGN KEY (id_mission)
REFERENCES mission(id) ON UPDATE CASCADE ON DELETE CASCADE;

ALTER TABLE ONLY user_mission
 ADD CONSTRAINT user_mission_id_user_fkey FOREIGN KEY (name_user)
REFERENCES users(name) ON UPDATE CASCADE ON DELETE CASCADE;


INSERT INTO mission(score, description) VALUES(30,'descricao missao 1');
INSERT INTO mission(score, description) VALUES(40,'descricao missao 2');

INSERT INTO task(description,completed, id_mission) VALUES('task1_m1',false,1);
INSERT INTO task(description,completed, id_mission) VALUES('task2_m1',false,1);
INSERT INTO task(description,completed, id_mission) VALUES('task3_m1',false,1);
INSERT INTO task(description,completed, id_mission) VALUES('task1_m2',false,2);
INSERT INTO task(description,completed, id_mission) VALUES('task2_m2',false,2);
INSERT INTO task(description,completed, id_mission) VALUES('task3_m2',false,2);

INSERT INTO event_type(id,type,score)  VALUES(1,'Teste1', 3);
INSERT INTO event_type(id,type,score)  VALUES(2,'Teste2', 5);
INSERT INTO event_type(id,type,score)  VALUES(3,'Teste3', 6);

INSERT INTO user_mission (id_mission, name_user) VALUES (1, 'paulo');

INSERT INTO user_tasks (id_task, name_user) VALUES (1,'paulo');
INSERT INTO user_tasks (id_task, name_user) VALUES (2,'paulo');
INSERT INTO user_tasks (id_task, name_user) VALUES (3,'paulo');

INSERT INTO event(title, description, place, type, name_creator) VALUES ('Title1', 'ola isto e um evento', 'feup','Teste1','Joao');
INSERT INTO event(title, description, place, type, name_creator) VALUES ('Title1', 'ola isto e um evento', 'feup','Teste1','Joao');
INSERT INTO event(title, description, place, type, name_creator) VALUES ('Title1', 'ola isto e um evento', 'feup','Teste1','Joao');
INSERT INTO event(title, description, place, type, name_creator) VALUES ('Title1', 'ola isto e um evento', 'feup','Teste1','Joao');
INSERT INTO event(title, description, place, type, name_creator) VALUES ('Title1', 'ola isto e um evento', 'feup','Teste1','Joao');
INSERT INTO event(title, description, place, type, name_creator) VALUES ('Title1', 'ola isto e um evento', 'feup','Teste1','Joao');

INSERT INTO comment(description,id_event,name_user) VALUES('lorem ipsumlorem ipsum lorem ipsumlorem ipsumlorem ipsum ', 1, 'paulo');
