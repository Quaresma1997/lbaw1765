DROP TYPE IF EXISTS categories CASCADE;
DROP TYPE IF EXISTS types CASCADE;
--Tables
DROP TABLE IF EXISTS baned_users CASCADE;
CREATE TABLE baned_users (
    id SERIAL NOT NULL,
    CONSTRAINT baned_users_pk PRIMARY KEY (id)    
);

DROP TABLE IF EXISTS categories CASCADE;
CREATE TABLE categories (
    id SERIAL NOT NULL,
    name text NOT NULL,
    CONSTRAINT categories_pk PRIMARY KEY (id)
);

DROP TABLE IF EXISTS cities CASCADE;
CREATE TABLE cities (
    id SERIAL NOT NULL,
    name text NOT NULL,
    country_id INTEGER NOT NULL,
    CONSTRAINT cities_pk PRIMARY KEY (id)    
);

DROP TABLE IF EXISTS "current_date" CASCADE;
CREATE TABLE "current_date" (
    id SERIAL NOT NULL,
    date TIMESTAMP WITH TIME zone NOT NULL,
    CONSTRAINT current_date_pk PRIMARY KEY (id)
);

DROP TABLE IF EXISTS countries CASCADE;
CREATE TABLE countries (
    id SERIAL NOT NULL,
    name text NOT NULL,
    CONSTRAINT countries_pk PRIMARY KEY (id),
    CONSTRAINT countries_name_uk UNIQUE (name)
);

DROP TABLE IF EXISTS dones CASCADE;
CREATE TABLE dones (
    event_id INTEGER NOT NULL,
    rating FLOAT,
    CONSTRAINT dones_pk PRIMARY KEY (event_id),
    CONSTRAINT rating_ck CHECK (((rating >= 1) AND (rating <= 5)))
);

DROP TABLE IF EXISTS events CASCADE;
CREATE TABLE events (
    id SERIAL NOT NULL,
    name text NOT NULL,
    date DATE NOT NULL,
    time TIME NOT NULL,
    description text NOT NULL,
    owner_id INTEGER NOT NULL,
    localization_id INTEGER,
    is_public BOOLEAN DEFAULT false NOT NULL,
    category_id INTEGER,
    CONSTRAINT events_pk PRIMARY KEY (id),
    CONSTRAINT event_category_fk FOREIGN KEY (category_id) REFERENCES 
    categories(id) ON DELETE SET NULL,
    CONSTRAINT date_ck CHECK ((date >current_date))
);

DROP TABLE IF EXISTS event_invites CASCADE;
CREATE TABLE event_invites (
    id SERIAL NOT NULL,
    answer text,
    event_id INTEGER NOT NULL,
    receiver_id INTEGER NOT NULL,
    CONSTRAINT event_invites_pk PRIMARY KEY (id)
);

DROP TABLE IF EXISTS event_delete_warnings CASCADE;
CREATE TABLE event_delete_warnings (
    id SERIAL NOT NULL,
    event_name text NOT NULL,
    receiver_id INTEGER NOT NULL,
    CONSTRAINT event_delete_warnings_pk PRIMARY KEY (id)
);

DROP TABLE IF EXISTS event_update_warnings CASCADE;
CREATE TABLE event_update_warnings (
    id SERIAL NOT NULL,
    event_id INTEGER NOT NULL,
    receiver_id INTEGER NOT NULL,
    CONSTRAINT event_update_warnings_pk PRIMARY KEY (id),
    CONSTRAINT event_update_warnings_event_id_fk FOREIGN KEY (event_id) REFERENCES 
    events(id) ON DELETE CASCADE
);

DROP TABLE IF EXISTS friend_activities CASCADE;
CREATE TABLE friend_activities (
    id SERIAL NOT NULL,
    sender_id INTEGER NOT NULL,
    receiver_id INTEGER NOT NULL,
    event_id INTEGER NOT NULL,
    CONSTRAINT friend_activities_pk PRIMARY KEY (id),
    CONSTRAINT friend_activities_event_id_fk FOREIGN KEY (event_id) REFERENCES 
    events(id) ON DELETE CASCADE
);

DROP TABLE IF EXISTS friend_requests CASCADE;
CREATE TABLE friend_requests (
    id SERIAL NOT NULL,
    answer text,
    sender_id INTEGER NOT NULL,
    receiver_id INTEGER NOT NULL,
    CONSTRAINT friend_requests_pk PRIMARY KEY (id)
);
DROP TABLE IF EXISTS friendships CASCADE;
CREATE TABLE friendships (
    id SERIAL NOT NULL,
    user_id_1 INTEGER NOT NULL,
    user_id_2 INTEGER NOT NULL,
    CONSTRAINT friendships_users_ids_uk UNIQUE (user_id_1, user_id_2)
);

DROP TABLE IF EXISTS images CASCADE;
CREATE TABLE images (
    id SERIAL NOT NULL,
    event_id INTEGER NOT NULL,
    path text NOT NULL,
    CONSTRAINT images_pk PRIMARY KEY (id),
    CONSTRAINT images_path_uk UNIQUE (path)
);

DROP TABLE IF EXISTS localizations CASCADE;
CREATE TABLE localizations (
    id SERIAL NOT NULL,
    name text NOT NULL,
    address text NOT NULL,
    city_id INTEGER NOT NULL,
    CONSTRAINT localizations_pk PRIMARY KEY (id),
    CONSTRAINT localizations_city_id_fk FOREIGN KEY (city_id) REFERENCES 
    cities(id) ON DELETE SET NULL
);

DROP TABLE IF EXISTS not_dones CASCADE;
CREATE TABLE not_dones (
    event_id INTEGER NOT NULL,
    CONSTRAINT not_dones_pk PRIMARY KEY (event_id),
    CONSTRAINT not_dones_event_id_fk FOREIGN KEY (event_id) REFERENCES 
    events(id) ON DELETE CASCADE
);

DROP TABLE IF EXISTS options CASCADE;
CREATE TABLE options (
    id SERIAL NOT NULL,
    description text NOT NULL,
    poll_id INTEGER NOT NULL,
    CONSTRAINT options_pk PRIMARY KEY (id)
);

DROP TABLE IF EXISTS participants CASCADE;
CREATE TABLE participants (
    id SERIAL NOT NULL,
    user_id INTEGER NOT NULL,
    event_id INTEGER NOT NULL,
    CONSTRAINT participants_pk PRIMARY KEY (id),
    CONSTRAINT participants_user_id_event_id_uk UNIQUE (user_id, event_id),
    CONSTRAINT participants_event_id_fk FOREIGN KEY (event_id) REFERENCES 
    events(id) ON DELETE CASCADE
);

DROP TABLE IF EXISTS polls CASCADE;
CREATE TABLE polls (
    id SERIAL NOT NULL,
    post_id INTEGER NOT NULL,
    CONSTRAINT polls_pk PRIMARY KEY (id)    
);

DROP TABLE IF EXISTS posts CASCADE;
CREATE TABLE posts (
    id SERIAL NOT NULL,
    description text NOT NULL,
    date TIMESTAMP WITH TIME zone NOT NULL,
    event_id INTEGER NOT NULL,
    user_id INTEGER NOT NULL,
    image_path text,
    CONSTRAINT posts_pk PRIMARY KEY (id),
    CONSTRAINT posts_event_id_fk FOREIGN KEY (event_id) REFERENCES 
    events(id) ON DELETE CASCADE
);

DROP TABLE IF EXISTS ratings CASCADE;
CREATE TABLE ratings (
    id SERIAL NOT NULL,
    "value" INTEGER NOT NULL,
    event_id INTEGER NOT NULL,
    user_id INTEGER,
    CONSTRAINT ratings_pk PRIMARY KEY (id),
    CONSTRAINT ratings_user_id_event_id_uk UNIQUE (user_id, event_id),
    CONSTRAINT ratings_event_id_fk FOREIGN KEY (event_id) REFERENCES 
    events(id) ON DELETE CASCADE
);

DROP TABLE IF EXISTS "users" CASCADE;
CREATE TABLE "users" (
    id SERIAL NOT NULL,
    username text NOT NULL,
    password text NOT NULL,
    email text NOT NULL,
    regist_date TIMESTAMP WITH TIME zone DEFAULT now() NOT NULL,
    first_name text NOT NULL,
    last_name text NOT NULL,
    image_path text DEFAULT '/imgs/profile.jpg' NOT NULL,
    city_id INTEGER,
    remember_token text,
    is_admin BOOLEAN DEFAULT false NOT NULL,
    CONSTRAINT users_pk PRIMARY KEY (id),
    CONSTRAINT users_name_uk UNIQUE (username),
    CONSTRAINT users_email_uk UNIQUE (email),
    CONSTRAINT users_city_id_fk FOREIGN KEY (city_id) REFERENCES 
    cities(id) ON DELETE SET NULL
);


ALTER TABLE ONLY cities
    ADD CONSTRAINT cities_country_id_fk FOREIGN KEY (country_id) REFERENCES 
    countries(id) ON DELETE SET NULL;

ALTER TABLE ONLY dones
    ADD CONSTRAINT dones_event_id_fk FOREIGN KEY (event_id) REFERENCES
     events(id) ON DELETE CASCADE;

ALTER TABLE ONLY events
    ADD CONSTRAINT events_owner_id_fk FOREIGN KEY (owner_id) REFERENCES 
    "users"(id) ON DELETE CASCADE;

ALTER TABLE ONLY events
    ADD CONSTRAINT events_localization_id_fk FOREIGN KEY (localization_id) REFERENCES 
    localizations(id) ON DELETE SET NULL;

ALTER TABLE ONLY event_invites
    ADD CONSTRAINT event_invites_event_id_fk FOREIGN KEY (event_id) REFERENCES 
    not_dones(event_id) ON DELETE CASCADE;

ALTER TABLE ONLY event_invites
    ADD CONSTRAINT event_invites_receiver_id_fk FOREIGN KEY (receiver_id) REFERENCES 
    "users"(id) ON DELETE CASCADE;

ALTER TABLE ONLY event_delete_warnings
    ADD CONSTRAINT event_delete_warnings_receiver_id_fk FOREIGN KEY (receiver_id) REFERENCES 
    "users"(id) ON DELETE CASCADE;

ALTER TABLE ONLY event_update_warnings
    ADD CONSTRAINT event_update_warnings_receiver_id_fk FOREIGN KEY (receiver_id) REFERENCES 
    "users"(id) ON DELETE CASCADE;

ALTER TABLE ONLY friend_activities
    ADD CONSTRAINT friend_activities_sender_id_fk FOREIGN KEY (sender_id) REFERENCES
    "users"(id) ON DELETE CASCADE;

ALTER TABLE ONLY friend_activities
    ADD CONSTRAINT friend_activities_receiver_id_fk FOREIGN KEY (receiver_id) REFERENCES 
    "users"(id) ON DELETE CASCADE;

ALTER TABLE ONLY friend_requests
    ADD CONSTRAINT friend_requests_sender_id_fk FOREIGN KEY (sender_id) REFERENCES 
    participants(id) ON DELETE CASCADE;

ALTER TABLE ONLY friend_requests   
    ADD CONSTRAINT friend_requests_receiver_id_fk FOREIGN KEY (receiver_id) REFERENCES 
    "users"(id) ON DELETE CASCADE;

ALTER TABLE ONLY friendships
    ADD CONSTRAINT friendships_user_id_1 FOREIGN KEY (user_id_1) REFERENCES
    "users"(id) ON DELETE CASCADE;

ALTER TABLE ONLY friendships
    ADD CONSTRAINT friendships_user_id_2 FOREIGN KEY (user_id_2) REFERENCES
    "users"(id) ON DELETE CASCADE;

ALTER TABLE ONLY options
    ADD CONSTRAINT options_poll_id_fk FOREIGN KEY (poll_id) REFERENCES 
    polls(id) ON DELETE CASCADE;

ALTER TABLE ONLY participants
    ADD CONSTRAINT participants_user_id_fk FOREIGN KEY (user_id) REFERENCES 
    "users"(id) ON DELETE CASCADE;

ALTER TABLE ONLY polls
    ADD CONSTRAINT polls_post_id_fk FOREIGN KEY (post_id) REFERENCES 
    posts(id) ON DELETE CASCADE;

ALTER TABLE ONLY posts
    ADD CONSTRAINT posts_user_id_fk FOREIGN KEY (user_id) REFERENCES 
    "users"(id) ON DELETE CASCADE;

ALTER TABLE ONLY ratings
    ADD CONSTRAINT ratings_user_id_fk FOREIGN KEY (user_id) REFERENCES 
    "users"(id) ON DELETE SET NULL;


-- CREATE OR REPLACE FUNCTION set_event_as_done() RETURNS TRIGGER AS
-- $BODY$
-- BEGIN
--   IF EXISTS (SELECT event_id FROM not_done WHERE NEW.event_id = id) 
--   THEN
--     INSERT INTO dones VALUES (NEW.event_id, NULL);
--     DELETE FROM not_dones WHERE id = NEW.event_id;
--   END IF;
--   RETURN NEW;
-- END
-- $BODY$
-- LANGUAGE plpgsql;
 
-- DROP TRIGGER IF EXISTS set_event_as_done ON "current_date";
-- CREATE TRIGGER set_event_as_done
--   BEFORE UPDATE OF date ON "current_date"
--   FOR EACH ROW
--   WHEN NEW.date = current_date()
--     EXECUTE PROCEDURE set_event_as_done(); 
 
CREATE OR REPLACE FUNCTION notificate_event_delete() RETURNS TRIGGER AS
$BODY$
DECLARE
    idx int;
BEGIN
    FOR idx IN SELECT user_id FROM participants WHERE participants.event_id = OLD.id
    LOOP
        INSERT INTO event_delete_warnings (event_name, receiver_id) VALUES (OLD.name, idx);
    END LOOP;
    RETURN OLD;
END;
$BODY$
LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS notificate_event_delete ON "events";
CREATE TRIGGER notificate_event_delete
  BEFORE DELETE ON events
  FOR EACH ROW
    EXECUTE PROCEDURE notificate_event_delete();  

CREATE OR REPLACE FUNCTION notificate_event_update() RETURNS TRIGGER AS
$BODY$
DECLARE
    idx int;
BEGIN
    FOR idx IN SELECT id FROM participants WHERE participants.event_id = New.id
    LOOP
        INSERT INTO event_update_warnings (event_id, receiver_id) VALUES (New.id, idx);
    END LOOP;
    RETURN New;
END;
$BODY$
LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS notificate_event_update ON "events";
CREATE TRIGGER notificate_event_update
  AFTER UPDATE ON events
  FOR EACH ROW
    EXECUTE PROCEDURE notificate_event_update();  

CREATE OR REPLACE FUNCTION rating_update() RETURNS TRIGGER AS
$BODY$
BEGIN
  UPDATE dones SET rating = (SELECT AVG("value") FROM ratings WHERE New.event_id = event_id) WHERE event_id = New.event_id;
  RETURN NULL;
END
$BODY$

LANGUAGE plpgsql;
 
CREATE TRIGGER rating_update
  AFTER INSERT ON ratings
  FOR EACH ROW
    EXECUTE PROCEDURE rating_update();


CREATE OR REPLACE FUNCTION accept_friend_request() RETURNS TRIGGER AS
$BODY$
BEGIN
  IF New.answer = 'yes' 
  THEN
    INSERT INTO friendships (user_id_1, user_id_2) VALUES (New.sender_id, New.receiver_id);
  END IF;
  RETURN NULL;
END
$BODY$
LANGUAGE plpgsql;
 
CREATE TRIGGER accept_friend_request
  AFTER UPDATE ON friend_requests
  FOR EACH ROW
    EXECUTE PROCEDURE accept_friend_request();


CREATE OR REPLACE FUNCTION accept_event_invite() RETURNS TRIGGER AS
$BODY$
BEGIN
  IF New.answer = 'yes' 
  THEN
    INSERT INTO participants (user_id, event_id) VALUES (New.receiver_id, New.event_id);
  END IF;
  RETURN NULL;
END
$BODY$
LANGUAGE plpgsql;
 
CREATE TRIGGER accept_event_invite
  AFTER UPDATE ON event_invites
  FOR EACH ROW
    EXECUTE PROCEDURE accept_event_invite();


	
--> INDEXES

 CREATE INDEX user_username ON "users" USING hash (username); 
 
 CREATE INDEX owner_events ON events USING hash(owner_id); 
 
 CREATE INDEX search_events ON events USING GIST (to_tsvector('english', name));


--> INSERTS

-- Here goes the SQL code - INSERTS

INSERT INTO categories (name) VALUES ('Music');
INSERT INTO categories (name) VALUES ('Sports');
INSERT INTO categories (name) VALUES ('Entertainment');
INSERT INTO categories (name) VALUES ('Educational');
INSERT INTO categories (name) VALUES ('Business');
 
INSERT INTO countries (name) VALUES ('Portugal');
INSERT INTO countries (name) VALUES ('Espanha');
INSERT INTO countries (name) VALUES ('USA');


INSERT INTO cities (name,country_id) VALUES ('Braga',1);
INSERT INTO cities (name,country_id) VALUES ('Porto',1);
INSERT INTO cities (name,country_id) VALUES ('Lisboa',1);

INSERT INTO localizations (name,address,city_id) VALUES ('Restaurante O Pirata','Rua da Isabelinha',1);
INSERT INTO localizations (name,address,city_id) VALUES ('FEUP','Rua Roberto Frias',2);
INSERT INTO localizations (name,address,city_id) VALUES ('Parque da BelaVista','Av. Arlindo Vicente',3);
INSERT INTO localizations (name,address,city_id) VALUES ('Passeio Maritimo de Alges','Alges',3);
INSERT INTO localizations (name,address,city_id) VALUES ('Hotel Douro','Rua de Agramonte',2);
INSERT INTO localizations (name,address,city_id) VALUES ('Norte shopping','Matosinhos',2);

INSERT INTO "users" (username,password,email,regist_date,first_name,last_name, image_path,city_id)
			VALUES ('sodales','$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W','sodales.at@curae.co.uk',NOW(),'Zeph','Griffin','profile.jpg',2);
			
			
INSERT INTO "users" (username,password,email,regist_date,first_name,last_name, image_path,city_id)
			VALUES ('uso1','$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W','aliquam.iaculis.lacus@amet.co.uk',NOW(),'Ben','Warren','profile.jpg',1);
			
INSERT INTO "users" (username,password,email,regist_date,first_name,last_name, image_path,city_id, is_admin)
			VALUES ('robin','$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W','amet.ante@faucibusleo.net',NOW(),'Robin','Wright','profile.jpg',2, true);
			
			
INSERT INTO "users" (username,password,email,regist_date,first_name,last_name, image_path,city_id)
			VALUES ('bar123','$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W','ut.dolor@gmail.com',NOW(),'Barry','Allen','profile.jpg',3);
			
INSERT INTO "users" (username,password,email,regist_date,first_name,last_name, image_path,city_id)
			VALUES ('reddevil','$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W','Nulla@et.net',NOW(),'Andrew','Irons','profile.jpg',2);
			
INSERT INTO "users" (username,password,email,regist_date,first_name,last_name, image_path,city_id)
			VALUES ('rpedro10','$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W','rpedro10@iol.pt',NOW(),'Rui','Araujo','profile.jpg',3);
			
						
INSERT INTO "users" (username,password,email,regist_date,first_name,last_name, image_path,city_id)
			VALUES ('joss123','$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W','ante@fleo.com',NOW(),'Joss','Stone','profile.jpg',1);
			
INSERT INTO "users" (username,password,email,regist_date,first_name,last_name, image_path,city_id)
			VALUES ('top123','$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W','cursus.et@orciUt.co.uk',NOW(),'Chris','Harris','profile.jpg',1);
			
			
INSERT INTO "users" (username,password,email,regist_date,first_name,last_name, image_path,city_id)
			VALUES ('roland1','$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W','eget.dictum@orciDonec.edu',NOW(),'Roland','Schitt','profile.jpg',2);
						
INSERT INTO "users" (username,password,email,regist_date,first_name,last_name, image_path,city_id)
			VALUES ('david123','$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W','amet@faucibusleo.net',NOW(),'David','Rose','profile.jpg',2);
						
INSERT INTO "users" (username,password,email,regist_date,first_name,last_name, image_path,city_id)
			VALUES ('catones', '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W','amec.donec@faucibusleo.net',NOW(),'Carlos','Antonio','profile.jpg',2);
						
INSERT INTO "users" (username,password,email,regist_date,first_name,last_name, image_path,city_id)
			VALUES ('emanem','$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W','donex@sapo.net',NOW(),'Raheem','Sterling','profile.jpg',3);			
			
INSERT INTO "users" (username,password,email,regist_date,first_name,last_name, image_path,city_id)
			VALUES ('ufoExtis','$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W','amet@iol.net',NOW(),'Delle','Alli','profile.jpg',2);
						
INSERT INTO "users" (username,password,email,regist_date,first_name,last_name, image_path,city_id)
			VALUES ('ragnar','$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W','risus.In.mi@egestas.com',NOW(),'Thor','Ragnarok','profile.jpg',1);
						
INSERT INTO "users" (username,password,email,regist_date,first_name,last_name, image_path,city_id)
			VALUES ('seth','$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W','aliquet.diam.Sed@tinciduntnibh.co.uk',NOW(),'Seth','Byers','profile.jpg',2);
						
INSERT INTO "users" (username,password,email,regist_date,first_name,last_name, image_path,city_id)
			VALUES ('edNorton','$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W','scelerisque.scelerisque.dui@arcuiaculisenim.ca',NOW(),'Ed','Norton','profile.jpg',1);
						
INSERT INTO "users" (username,password,email,regist_date,first_name,last_name, image_path,city_id)
			VALUES ('Pacquiao','$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W','magnis@cursuset.edu',NOW(),'Paky','Barret','profile.jpg',3);	
			
INSERT INTO "users" (username,password,email,regist_date,first_name,last_name, image_path,city_id)
			VALUES ('steven','$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W','arcu.Vestibulum@amet.org',NOW(),'Donovan','Stevenson','profile.jpg',1);
						
INSERT INTO "users" (username,password,email,regist_date,first_name,last_name, image_path,city_id)
			VALUES ('porter123','$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W','dui.nec@ultriciesadipiscing.co.uk',NOW(),'Porter','Osborn','profile.jpg',2);
						
INSERT INTO "users" (username,password,email,regist_date,first_name,last_name, image_path,city_id)
			VALUES ('human','$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W','facilisis.magna.tellus@sociis.net',NOW(),'Hu','Randolphe','profile.jpg',2);
					
					
INSERT INTO events (name,date, time,description,owner_id,localization_id,is_public,category_id)
			VALUES ('Antonys Birthday Party', '2019-04-25', '12:30:00', 'nunc ac mattis ornare, lectus',1,1,true,1);
			
INSERT INTO events (name,date, time,description,owner_id,localization_id,is_public,category_id)
			VALUES ('ENEI','2019-04-24', '12:30:00','Nunc quis arcu vel quam',2,2,true,1);
			
INSERT INTO events (name,date, time,description,owner_id,localization_id,is_public,category_id)
			VALUES ('RockInRio','2019-06-04', '12:30:00','tempus eu, ligula. Aenean euismod',3,3,true,1);
			
INSERT INTO events (name,date, time,description,owner_id,localization_id,is_public,category_id)
			VALUES ('Nos Alive','2019-08-04', '12:30:00','dignissim pharetra. Nam ac nulla.',4,4,true,1);
			
INSERT INTO events (name,date, time,description,owner_id,localization_id,is_public,category_id)
			VALUES ('Christmas Dinner','2019-10-04', '12:30:00','dignissim pharetra. Nam ac nulla.',5,5,true,2);
			
INSERT INTO events (name,date, time,description,owner_id,localization_id,is_public,category_id)
			VALUES ('Mark Birthday Party','2019-04-13', '12:30:00','dignissim pharetra. Nam ac nulla.',6,1,true,2);
			
INSERT INTO events (name,date, time,description,owner_id,localization_id,is_public,category_id)
			VALUES ('WebSummit','2019-04-12', '12:30:00','lorem lorem, luctus ut, pellentesque',7,6,true,2);
			
INSERT INTO events (name,date, time,description,owner_id,localization_id,is_public,category_id)
			VALUES ('Ted Talk','2019-04-24', '12:30:00','sollicitudin orci sem eget massa.',8,2,true,2);
			
INSERT INTO events (name,date, time,description,owner_id,localization_id,is_public,category_id)
			VALUES ('Teaches Conference','2019-04-13', '12:30:00','dignissim pharetra. Nam ac nulla.',9,1,false,5);
			


INSERT INTO images (event_id,path) VALUES (1,'/imgs/natur.jpg');			
INSERT INTO images (event_id,path) VALUES (2,'/imgs/natu.jpg');			
INSERT INTO images (event_id,path) VALUES (3,'/imgs/pyr.jpg');			
INSERT INTO images (event_id,path) VALUES (4,'/imgs/november.jpg');			
INSERT INTO images (event_id,path) VALUES (5,'/imgs/taj.jpg');			
INSERT INTO images (event_id,path) VALUES (6,'/imgs/fer.jpg');			
INSERT INTO images (event_id,path) VALUES (7,'/imgs/fa1.jpg');			
INSERT INTO images (event_id,path) VALUES (8,'/imgs/fa2.jpg');



			
INSERT INTO dones (event_id)
			VALUES (2);
INSERT INTO dones (event_id)
			VALUES (7);
			
INSERT INTO not_dones (event_id)
			VALUES (1);
INSERT INTO not_dones (event_id)
			VALUES (3);
INSERT INTO not_dones (event_id)
			VALUES (4);
INSERT INTO not_dones (event_id)
			VALUES (5);
INSERT INTO not_dones (event_id)
			VALUES (6);
INSERT INTO not_dones (event_id)
			VALUES (8);
INSERT INTO not_dones (event_id)
			VALUES (9);
			

INSERT INTO ratings ( "value", event_id, user_id)
            VALUES (4, 2, 2);
			
			
INSERT INTO participants (user_id,event_id)
			VALUES (1,2);
INSERT INTO participants (user_id,event_id)
			VALUES (2,1);
INSERT INTO participants (user_id,event_id)
			VALUES (2,3);
INSERT INTO participants (user_id,event_id)
			VALUES (7,1);			
INSERT INTO participants (user_id,event_id)
			VALUES (4,1);			
INSERT INTO participants (user_id,event_id)
			VALUES (5,8);			
INSERT INTO participants (user_id,event_id)
			VALUES (6,8);			
INSERT INTO participants (user_id,event_id)
			VALUES (7,3);			
INSERT INTO participants (user_id,event_id)
			VALUES (12,3);			
INSERT INTO participants (user_id,event_id)
			VALUES (13,3);			
INSERT INTO participants (user_id,event_id)
			VALUES (14,3);			
INSERT INTO participants (user_id,event_id)
			VALUES (15,1);			
INSERT INTO participants (user_id,event_id)
			VALUES (16,2);			
INSERT INTO participants (user_id,event_id)
			VALUES (17,3);			
INSERT INTO participants (user_id,event_id)
			VALUES (18,2);			
INSERT INTO participants (user_id,event_id)
			VALUES (19,1);			
INSERT INTO participants (user_id,event_id)
			VALUES (20,3);			
INSERT INTO participants (user_id,event_id)
			VALUES (12,6);			
INSERT INTO participants (user_id,event_id)
			VALUES (12,5);			
INSERT INTO participants (user_id,event_id)
			VALUES (10,4);
			
INSERT INTO posts (description,date,event_id, user_id, image_path) VALUES ('Lorem ipsum dolor sit amet. ',NOW(),1,1,'/img/new.jpg');
INSERT INTO posts (description,date,event_id, user_id, image_path) VALUES ('Lorem ipsum dolor sit amet. ',NOW(),1,3,'/img/new.jpg');
INSERT INTO posts (description,date,event_id, user_id, image_path) VALUES ('Lorem ipsum dolor sit amet. ',NOW(),1,4,'/img/new.jpg');
INSERT INTO posts (description,date,event_id, user_id, image_path) VALUES ('Lorem ipsum dolor sit amet. ',NOW(),1,16,'/img/new.jpg');
INSERT INTO posts (description,date,event_id, user_id, image_path) VALUES ('Lorem ipsum dolor sit amet. ',NOW(),2,18,'/img/new.jpg');
INSERT INTO posts (description,date,event_id, user_id) VALUES ('Lorem ipsum dolor sit amet. ',NOW(),4,10);
INSERT INTO posts (description,date,event_id, user_id) VALUES ('Lorem ipsum dolor sit amet. ',NOW(),3,17);
INSERT INTO posts (description,date,event_id, user_id) VALUES ('Lorem ipsum dolor sit amet. ',NOW(),3,14);
INSERT INTO posts (description,date,event_id, user_id) VALUES ('Lorem ipsum dolor sit amet. ',NOW(),4,5);
INSERT INTO posts (description,date,event_id, user_id) VALUES ('Lorem ipsum dolor sit amet. ',NOW(),2,16);
INSERT INTO posts (description,date,event_id, user_id) VALUES ('Lorem ipsum dolor sit amet. ',NOW(),3,12);
INSERT INTO posts (description,date,event_id, user_id) VALUES ('Lorem ipsum dolor sit amet. ',NOW(),1,15);
INSERT INTO posts (description,date,event_id, user_id) VALUES ('Lorem ipsum dolor sit amet. ',NOW(),5,12);

INSERT INTO polls (post_id) VALUES (1);
INSERT INTO polls (post_id) VALUES (2);
INSERT INTO polls (post_id) VALUES (3);
INSERT INTO polls (post_id) VALUES (4);

INSERT INTO options (description,poll_id) VALUES ('Bar',1);
INSERT INTO options (description,poll_id) VALUES ('Cafe',1);
INSERT INTO options (description,poll_id) VALUES ('Club',1);
INSERT INTO options (description,poll_id) VALUES ('Home',1);
INSERT INTO options (description,poll_id) VALUES ('12/05/2018',2);
INSERT INTO options (description,poll_id) VALUES ('13/05/2018',2);
INSERT INTO options (description,poll_id) VALUES ('Great',3);
INSERT INTO options (description,poll_id) VALUES ('Good',3);
INSERT INTO options (description,poll_id) VALUES ('Available',4);
INSERT INTO options (description,poll_id) VALUES ('Not Available',4);

INSERT INTO friend_requests (sender_id, receiver_id) VALUES (1, 2);
INSERT INTO friend_requests (sender_id, receiver_id) VALUES (3, 4);

INSERT INTO event_invites (event_id, receiver_id) VALUES (1, 10);
INSERT INTO event_invites (event_id, receiver_id) VALUES (1, 12);