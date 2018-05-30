--Tables

DROP TABLE IF EXISTS baned_users CASCADE;
CREATE TABLE baned_users (
    id SERIAL NOT NULL,
    email text NOT NULL,
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
    categories(id) ON DELETE SET NULL
    -- CONSTRAINT date_ck CHECK ((date>current_date))
);

DROP TABLE IF EXISTS event_invites CASCADE;
CREATE TABLE event_invites (
    id SERIAL NOT NULL,
    answer BOOLEAN,
    event_id INTEGER NOT NULL,
    sender_id INTEGER NOT NULL,
    receiver_id INTEGER NOT NULL,
    created_at TIMESTAMP(0) DEFAULT now() NOT NULL, 
    updated_at TIMESTAMP(0) DEFAULT now() NOT NULL,
    CONSTRAINT event_invites_pk PRIMARY KEY (id),
    CONSTRAINT event_invites_uk UNIQUE (event_id, receiver_id)
);

DROP TABLE IF EXISTS event_delete_warnings CASCADE;
CREATE TABLE event_delete_warnings (
    id SERIAL NOT NULL,
    event_name text NOT NULL,
    receiver_id INTEGER NOT NULL,
    created_at TIMESTAMP(0) DEFAULT now() NOT NULL, 
    updated_at TIMESTAMP(0) DEFAULT now() NOT NULL,
    CONSTRAINT event_delete_warnings_pk PRIMARY KEY (id)
);

DROP TABLE IF EXISTS event_update_warnings CASCADE;
CREATE TABLE event_update_warnings (
    id SERIAL NOT NULL,
    event_id INTEGER NOT NULL,
    receiver_id INTEGER NOT NULL,
    created_at TIMESTAMP(0) DEFAULT now() NOT NULL, 
    updated_at TIMESTAMP(0) DEFAULT now() NOT NULL,
    CONSTRAINT event_update_warnings_pk PRIMARY KEY (id),
    CONSTRAINT event_update_warnings_event_id_fk FOREIGN KEY (event_id) REFERENCES 
    events(id) ON DELETE CASCADE
);

DROP TABLE IF EXISTS friend_requests CASCADE;
CREATE TABLE friend_requests (
    id SERIAL NOT NULL,
    answer BOOLEAN,
    sender_id INTEGER NOT NULL,
    receiver_id INTEGER NOT NULL,
    created_at TIMESTAMP(0) DEFAULT now() NOT NULL, 
    updated_at TIMESTAMP(0) DEFAULT now() NOT NULL,
    CONSTRAINT friend_requests_pk PRIMARY KEY (id),
    CONSTRAINT friend_requests_uk UNIQUE (sender_id, receiver_id)
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
    path text NOT NULL DEFAULT 'event.jpg',
    CONSTRAINT images_pk PRIMARY KEY (id),
    CONSTRAINT images_event_id_path_uk UNIQUE (event_id, path)
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
    created_at TIMESTAMP(0) DEFAULT now() NOT NULL, 
    updated_at TIMESTAMP(0) DEFAULT now() NOT NULL,
    CONSTRAINT participants_pk PRIMARY KEY (id),
    CONSTRAINT participants_user_id_event_id_uk UNIQUE (user_id, event_id),
    CONSTRAINT participants_event_id_fk FOREIGN KEY (event_id) REFERENCES 
    events(id) ON DELETE CASCADE
);

DROP TABLE IF EXISTS polls CASCADE;
CREATE TABLE polls (
    id SERIAL NOT NULL,
    question text,
    date TIMESTAMP(0) DEFAULT now() NOT NULL, 
    event_id INTEGER NOT NULL,
    CONSTRAINT polls_pk PRIMARY KEY (id)    
);

DROP TABLE IF EXISTS poll_votes CASCADE;
CREATE TABLE poll_votes (
    id SERIAL NOT NULL,
    poll_id INTEGER NOT NULL,
    option_id INTEGER NOT NULL,
    user_id INTEGER NOT NULL,
    CONSTRAINT poll_votes_pk PRIMARY KEY (id),
    CONSTRAINT poll_id_user_id_uk UNIQUE (poll_id, user_id),
    CONSTRAINT poll_id_fk FOREIGN KEY (poll_id) REFERENCES 
    polls(id) ON DELETE CASCADE
    
);

DROP TABLE IF EXISTS posts CASCADE;
CREATE TABLE posts (
    id SERIAL NOT NULL,
    description text NOT NULL,
    date TIMESTAMP(0) DEFAULT now() NOT NULL, 
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

DROP TABLE IF EXISTS shortcuts CASCADE;
CREATE TABLE shortcuts (
    id SERIAL NOT NULL,
    event_id INTEGER NOT NULL,
    user_id INTEGER NOT NULL,
    CONSTRAINT shortcuts_pk PRIMARY KEY (id),
    CONSTRAINT shortcuts_user_id_event_id_uk UNIQUE (user_id, event_id),
    CONSTRAINT shortcuts_event_id_fk FOREIGN KEY (event_id) REFERENCES 
    events(id) ON DELETE CASCADE
);

DROP TABLE IF EXISTS "users" CASCADE;
CREATE TABLE "users" (
    id SERIAL NOT NULL,
    username text NOT NULL,
    password text,
    provider text,
    provider_id text,
    email text NOT NULL,
    created_at TIMESTAMP(0) DEFAULT now() NOT NULL, 
    updated_at TIMESTAMP(0) DEFAULT now() NOT NULL,
    first_name text NOT NULL,
    last_name text NOT NULL,
    image_path text DEFAULT 'profile.jpg' NOT NULL,
    city_id INTEGER,
    remember_token text,
    is_admin BOOLEAN DEFAULT false NOT NULL,
    CONSTRAINT users_pk PRIMARY KEY (id),
    CONSTRAINT users_name_uk UNIQUE (username),
    CONSTRAINT users_email_uk UNIQUE (email),
    CONSTRAINT users_provider_id_uk UNIQUE (provider_id),
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
    ADD CONSTRAINT event_invites_sender_id_fk FOREIGN KEY (sender_id) REFERENCES 
    "users"(id) ON DELETE CASCADE;

ALTER TABLE ONLY event_invites
    ADD CONSTRAINT event_invites_receiver_id_fk FOREIGN KEY (receiver_id) REFERENCES 
    "users"(id) ON DELETE CASCADE;

ALTER TABLE ONLY event_delete_warnings
    ADD CONSTRAINT event_delete_warnings_receiver_id_fk FOREIGN KEY (receiver_id) REFERENCES 
    "users"(id) ON DELETE CASCADE;

ALTER TABLE ONLY event_update_warnings
    ADD CONSTRAINT event_update_warnings_receiver_id_fk FOREIGN KEY (receiver_id) REFERENCES 
    "users"(id) ON DELETE CASCADE;

ALTER TABLE ONLY friend_requests
    ADD CONSTRAINT friend_requests_sender_id_fk FOREIGN KEY (sender_id) REFERENCES 
    "users"(id) ON DELETE CASCADE;

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
    
ALTER TABLE ONLY poll_votes
    ADD CONSTRAINT poll_votes_id_fk FOREIGN KEY (poll_id) REFERENCES 
    polls(id) ON DELETE CASCADE;


ALTER TABLE ONLY participants
    ADD CONSTRAINT participants_user_id_fk FOREIGN KEY (user_id) REFERENCES 
    "users"(id) ON DELETE CASCADE;

ALTER TABLE ONLY polls
    ADD CONSTRAINT polls_event_id_fk FOREIGN KEY (event_id) REFERENCES 
    events(id) ON DELETE CASCADE;

ALTER TABLE ONLY posts
    ADD CONSTRAINT posts_user_id_fk FOREIGN KEY (user_id) REFERENCES 
    "users"(id) ON DELETE CASCADE;

ALTER TABLE ONLY ratings
    ADD CONSTRAINT ratings_user_id_fk FOREIGN KEY (user_id) REFERENCES 
    "users"(id) ON DELETE SET NULL;
    
ALTER TABLE ONLY shortcuts
    ADD CONSTRAINT shortcuts_user_id_fk FOREIGN KEY (user_id) REFERENCES 
    "users"(id) ON DELETE CASCADE;

ALTER TABLE ONLY poll_votes
    ADD CONSTRAINT poll_votes_user_id_fk FOREIGN KEY (user_id) REFERENCES 
    "users"(id) ON DELETE CASCADE;


CREATE OR REPLACE FUNCTION set_event_as_done() RETURNS TRIGGER AS
$BODY$
BEGIN 
  IF EXISTS(SELECT * FROM events WHERE id = Old.event_id)
  THEN
    INSERT INTO dones VALUES (OLD.event_id, NULL);
  END IF;
  RETURN OLD;
END
$BODY$
LANGUAGE plpgsql;
 
DROP TRIGGER IF EXISTS set_event_as_done ON "not_dones";
CREATE TRIGGER set_event_as_done
  AFTER DELETE ON "not_dones"
  FOR EACH ROW
    EXECUTE PROCEDURE set_event_as_done(); 

CREATE OR REPLACE FUNCTION set_event_as_not_done() RETURNS TRIGGER AS
$BODY$
BEGIN
  INSERT INTO not_dones VALUES (NEW.id);
  RETURN NEW;
END
$BODY$
LANGUAGE plpgsql;
 
DROP TRIGGER IF EXISTS set_event_as_not_done ON "events";
CREATE TRIGGER set_event_as_not_done
  AFTER INSERT ON "events"
  FOR EACH ROW
    EXECUTE PROCEDURE set_event_as_not_done(); 
 
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
    FOR idx IN SELECT user_id FROM participants WHERE participants.event_id = New.id
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
  AFTER UPDATE ON ratings
  FOR EACH ROW
    EXECUTE PROCEDURE rating_update();


CREATE OR REPLACE FUNCTION accept_friend_request() RETURNS TRIGGER AS
$BODY$
BEGIN
  IF New.answer = true 
  THEN
    INSERT INTO friendships (user_id_1, user_id_2) VALUES (New.sender_id, New.receiver_id);
    DELETE FROM friend_requests WHERE sender_id = New.sender_id AND receiver_id = New.receiver_id;
  ELSEIF New.answer = false THEN
    DELETE FROM friend_requests WHERE sender_id = New.sender_id AND receiver_id = New.receiver_id;
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
  IF New.answer = true 
  THEN
    INSERT INTO participants (user_id, event_id) VALUES (New.receiver_id, New.event_id);
    DELETE FROM event_invites WHERE event_id = New.event_id AND receiver_id = New.receiver_id;
  ELSEIF New.answer = false THEN
    DELETE FROM event_invites WHERE event_id = New.event_id AND receiver_id = New.receiver_id;
  END IF;
  RETURN NULL;
END
$BODY$
LANGUAGE plpgsql;
 
CREATE TRIGGER accept_event_invite
  AFTER UPDATE ON event_invites
  FOR EACH ROW
    EXECUTE PROCEDURE accept_event_invite();


CREATE OR REPLACE FUNCTION set_event_default_image() RETURNS TRIGGER AS
$BODY$
BEGIN
  INSERT INTO images (event_id) VALUES (NEW.id);
  RETURN NEW;
END
$BODY$
LANGUAGE plpgsql;
 
DROP TRIGGER IF EXISTS set_event_default_image ON "events";
CREATE TRIGGER set_event_default_image
  AFTER INSERT ON "events"
  FOR EACH ROW
    EXECUTE PROCEDURE set_event_default_image(); 


CREATE OR REPLACE FUNCTION avoid_reverse_friendships() RETURNS TRIGGER AS
$BODY$

DECLARE found_count int;
DECLARE newcol1 int;
DECLARE newcol2 int;
DECLARE dummy int;
BEGIN
    
        SELECT COUNT(1) INTO found_count FROM friendships
        WHERE user_id_1 = New.user_id_2 AND user_id_2 = New.user_id_1;
        IF found_count = 1 THEN
            SELECT 1 INTO dummy FROM information_schema.tables;
        ELSE
            RETURN New;
        END IF;

        RETURN NULL;
        
  END
$BODY$
LANGUAGE plpgsql;
 
CREATE TRIGGER avoid_reverse_friendships
  BEFORE INSERT ON friendships
  FOR EACH ROW
    EXECUTE PROCEDURE avoid_reverse_friendships();


	
--> INDEXES

 CREATE INDEX user_username ON "users" USING hash (username); 
 
 CREATE INDEX owner_events ON events USING hash(owner_id); 
 
 CREATE INDEX search_events ON events USING GIST (to_tsvector('english', name));


--> INSERTS

-- Here goes the SQL code - INSERTS

INSERT INTO categories (name) VALUES ('Business');
INSERT INTO categories (name) VALUES ('Educational');
INSERT INTO categories (name) VALUES ('Entertainment');
INSERT INTO categories (name) VALUES ('Music');
INSERT INTO categories (name) VALUES ('Sports');
INSERT INTO categories (name) VALUES ('Other');
 
INSERT INTO countries (name) VALUES ('Portugal');
INSERT INTO countries (name) VALUES ('Spain');
INSERT INTO countries (name) VALUES ('USA');
INSERT INTO countries (name) VALUES ('UK');
INSERT INTO countries (name) VALUES ('France');
INSERT INTO countries (name) VALUES ('China');


INSERT INTO cities (name,country_id) VALUES ('Braga',1);
INSERT INTO cities (name,country_id) VALUES ('Porto',1);
INSERT INTO cities (name,country_id) VALUES ('Lisboa',1);
INSERT INTO cities (name,country_id) VALUES ('Reading',4);
INSERT INTO cities (name,country_id) VALUES ('Ibiza',2);
INSERT INTO cities (name,country_id) VALUES ('Beijing',6);
INSERT INTO cities (name,country_id) VALUES ('Paris',5);
INSERT INTO cities (name,country_id) VALUES ('New York',3);



INSERT INTO localizations (name,address,city_id) VALUES ('Restaurante O Pirata','Rua da Isabelinha',1);
INSERT INTO localizations (name,address,city_id) VALUES ('FEUP','Rua Roberto Frias',2);
INSERT INTO localizations (name,address,city_id) VALUES ('Parque da BelaVista','Av. Arlindo Vicente',3);
INSERT INTO localizations (name,address,city_id) VALUES ('Passeio Maritimo de Alges','Alges',3);
INSERT INTO localizations (name,address,city_id) VALUES ('Hotel Douro','Rua de Agramonte',2);
INSERT INTO localizations (name,address,city_id) VALUES ('Norte shopping','Matosinhos',2);
INSERT INTO localizations (name,address,city_id) VALUES ('Yolo Park','Guan',6);
INSERT INTO localizations (name,address,city_id) VALUES ('Stade de France','Paris',7);
INSERT INTO localizations (name,address,city_id) VALUES ('Madison Sqare Garden','Manhattan',8);
INSERT INTO localizations (name,address,city_id) VALUES ('Playa den Bossa','Carrer de la Punta',4);
INSERT INTO localizations (name,address,city_id) VALUES ('Clube de Ténis Estoril','Estoril',3);
INSERT INTO localizations (name,address,city_id) VALUES ('Altice Arena','Lisboa',3);
INSERT INTO localizations (name,address,city_id) VALUES ('Theatro Circo','Rua das Oliveiras',1);





INSERT INTO "users" (username,password,email,first_name,last_name, image_path,city_id)
			VALUES ('sodales','$2y$10$E9y1Zu0ABZ5a7C6CeKzSCO02trngDXeMys0CwGZAE4HczYnvjFyfW', 'sodales.at@curae.co.uk','Zeph','Griffin','profile.jpg',2);
			
			
INSERT INTO "users" (username,password,email,first_name,last_name, image_path,city_id)
			VALUES ('uso1','$2y$10$E9y1Zu0ABZ5a7C6CeKzSCO02trngDXeMys0CwGZAE4HczYnvjFyfW', 'aliquam.iaculis.lacus@amet.co.uk','Ben','Warren','profile.jpg',1);
			
INSERT INTO "users" (username,password,email,first_name,last_name, image_path,city_id)
			VALUES ('robin','$2y$10$E9y1Zu0ABZ5a7C6CeKzSCO02trngDXeMys0CwGZAE4HczYnvjFyfW', 'amet.ante@faucibusleo.net','Robin','Wright','profile.jpg',2);
			
			
INSERT INTO "users" (username,password,email,first_name,last_name, image_path,city_id)
			VALUES ('bar123','$2y$10$E9y1Zu0ABZ5a7C6CeKzSCO02trngDXeMys0CwGZAE4HczYnvjFyfW', 'ut.dolor@gmail.com','Barry','Allen','profile.jpg',3);
			
INSERT INTO "users" (username,password,email,first_name,last_name, image_path,city_id)
			VALUES ('reddevil','$2y$10$E9y1Zu0ABZ5a7C6CeKzSCO02trngDXeMys0CwGZAE4HczYnvjFyfW', 'Nulla@et.net','Andrew','Irons','profile.jpg',2);
			
INSERT INTO "users" (username,password,email,first_name,last_name, image_path,city_id)
			VALUES ('rpedro10','$2y$10$E9y1Zu0ABZ5a7C6CeKzSCO02trngDXeMys0CwGZAE4HczYnvjFyfW', 'rpedro10@iol.pt','Rui','Araujo','profile.jpg',3);
			
						
INSERT INTO "users" (username,password,email,first_name,last_name, image_path,city_id)
			VALUES ('joss123','$2y$10$E9y1Zu0ABZ5a7C6CeKzSCO02trngDXeMys0CwGZAE4HczYnvjFyfW', 'ante@fleo.com','Joss','Stone','profile.jpg',1);
			
INSERT INTO "users" (username,password,email,first_name,last_name, image_path,city_id)
			VALUES ('top123','$2y$10$E9y1Zu0ABZ5a7C6CeKzSCO02trngDXeMys0CwGZAE4HczYnvjFyfW', 'cursus.et@orciUt.co.uk','Chris','Harris','profile.jpg',1);
			
			
INSERT INTO "users" (username,password,email,first_name,last_name, image_path,city_id)
			VALUES ('roland1','$2y$10$E9y1Zu0ABZ5a7C6CeKzSCO02trngDXeMys0CwGZAE4HczYnvjFyfW', 'eget.dictum@orciDonec.edu','Roland','Schitt','profile.jpg',2);
						
INSERT INTO "users" (username,password,email,first_name,last_name, image_path,city_id)
			VALUES ('david123','$2y$10$E9y1Zu0ABZ5a7C6CeKzSCO02trngDXeMys0CwGZAE4HczYnvjFyfW', 'amet@faucibusleo.net','David','Rose','profile.jpg',2);
						
INSERT INTO "users" (username,password,email,first_name,last_name, image_path,city_id)
			VALUES ('catones', '$2y$10$E9y1Zu0ABZ5a7C6CeKzSCO02trngDXeMys0CwGZAE4HczYnvjFyfW', 'amec.donec@faucibusleo.net','Carlos','Antonio','profile.jpg',2);
						
INSERT INTO "users" (username,password,email,first_name,last_name, image_path,city_id)
			VALUES ('emanem','$2y$10$E9y1Zu0ABZ5a7C6CeKzSCO02trngDXeMys0CwGZAE4HczYnvjFyfW', 'donex@sapo.net','Raheem','Sterling','profile.jpg',3);			
			
INSERT INTO "users" (username,password,email,first_name,last_name, image_path,city_id)
			VALUES ('ufoExtis','$2y$10$E9y1Zu0ABZ5a7C6CeKzSCO02trngDXeMys0CwGZAE4HczYnvjFyfW', 'amet@iol.net','Delle','Alli','profile.jpg',2);
						
INSERT INTO "users" (username,password,email,first_name,last_name, image_path,city_id)
			VALUES ('ragnar','$2y$10$E9y1Zu0ABZ5a7C6CeKzSCO02trngDXeMys0CwGZAE4HczYnvjFyfW', 'risus.In.mi@egestas.com','Thor','Ragnarok','profile.jpg',1);
						
INSERT INTO "users" (username,password,email,first_name,last_name, image_path,city_id)
			VALUES ('seth','$2y$10$E9y1Zu0ABZ5a7C6CeKzSCO02trngDXeMys0CwGZAE4HczYnvjFyfW', 'aliquet.diam.Sed@tinciduntnibh.co.uk','Seth','Byers','profile.jpg',2);
						
INSERT INTO "users" (username,password,email,first_name,last_name, image_path,city_id)
			VALUES ('edNorton','$2y$10$E9y1Zu0ABZ5a7C6CeKzSCO02trngDXeMys0CwGZAE4HczYnvjFyfW', 'scelerisque.scelerisque.dui@arcuiaculisenim.ca','Ed','Norton','profile.jpg',1);
						
INSERT INTO "users" (username,password,email,first_name,last_name, image_path,city_id)
			VALUES ('Pacquiao','$2y$10$E9y1Zu0ABZ5a7C6CeKzSCO02trngDXeMys0CwGZAE4HczYnvjFyfW', 'magnis@cursuset.edu','Paky','Barret','profile.jpg',3);	
			
INSERT INTO "users" (username,password,email,first_name,last_name, image_path,city_id)
			VALUES ('steven','$2y$10$E9y1Zu0ABZ5a7C6CeKzSCO02trngDXeMys0CwGZAE4HczYnvjFyfW', 'arcu.Vestibulum@amet.org','Donovan','Stevenson','profile.jpg',1);
						
INSERT INTO "users" (username,password,email,first_name,last_name, image_path,city_id)
			VALUES ('porter123','$2y$10$E9y1Zu0ABZ5a7C6CeKzSCO02trngDXeMys0CwGZAE4HczYnvjFyfW', 'dui.nec@ultriciesadipiscing.co.uk','Porter','Osborn','profile.jpg',2);
						
INSERT INTO "users" (username,password,email,first_name,last_name, image_path,city_id)
			VALUES ('human','$2y$10$E9y1Zu0ABZ5a7C6CeKzSCO02trngDXeMys0CwGZAE4HczYnvjFyfW', 'facilisis.magna.tellus@sociis.net','Hu','Randolphe','profile.jpg',2);
					
INSERT INTO "users" (username,password,email,first_name,last_name, image_path,city_id, is_admin)
			VALUES ('admin','$2y$10$E9y1Zu0ABZ5a7C6CeKzSCO02trngDXeMys0CwGZAE4HczYnvjFyfW', 'admin@gmail.com','Super','User','profile.jpg',2, true);
					

INSERT INTO events (name,date, time,description,owner_id,localization_id,is_public,category_id)
			VALUES ('Antonys Birthday Party', '2019-04-25', '12:30:00', 'nunc ac mattis ornare, lectus',1,1,true,1);
			
INSERT INTO events (name,date, time,description,owner_id,localization_id,is_public,category_id)
			VALUES ('ENEI','2019-04-24', '12:30:00','Nunc quis arcu vel quam',2,2,true,2);
			
INSERT INTO events (name,date, time,description,owner_id,localization_id,is_public,category_id)
			VALUES ('RockInRio','2025-06-04', '12:30:00','tempus eu, ligula. Aenean euismod',3,3,true,3);
			
INSERT INTO events (name,date, time,description,owner_id,localization_id,is_public,category_id)
			VALUES ('Nos Alive','2019-08-04', '12:30:00','dignissim pharetra. Nam ac nulla.',4,4,true,4);
			
INSERT INTO events (name,date, time,description,owner_id,localization_id,is_public,category_id)
			VALUES ('Christmas Dinner','2019-10-04', '12:30:00','dignissim pharetra. Nam ac nulla.',5,5,true,5);
			
INSERT INTO events (name,date, time,description,owner_id,localization_id,is_public,category_id)
			VALUES ('Mark Birthday Party','2019-04-13', '12:30:00','dignissim pharetra. Nam ac nulla.',6,1,true,6);
			
INSERT INTO events (name,date, time,description,owner_id,localization_id,is_public,category_id)
			VALUES ('WebSummit','2018-04-12', '12:30:00','lorem lorem, luctus ut, pellentesque',7,6,true,2);
			
INSERT INTO events (name,date, time,description,owner_id,localization_id,is_public,category_id)
			VALUES ('Ted Talk','2009-04-24', '12:30:00','sollicitudin orci sem eget massa.',8,2,true,2);
			
INSERT INTO events (name,date, time,description,owner_id,localization_id,is_public,category_id)
			VALUES ('Teacher Conference','2011-04-13', '12:30:00','dignissim pharetra. Nam ac nulla.',9,1,false,2);

INSERT INTO events (name,date, time,description,owner_id,localization_id,is_public,category_id)
			VALUES ('Estoril Open','2018-05-13', '15:30:00','The Estoril Open is an ATP clay court tennis tournament in Portugal. 
            The event take place at the sports complex of Clube de Ténis do Estoril in Cascais.',11,1,true,5);

INSERT INTO events (name,date, time,description,owner_id,localization_id,is_public,category_id)
			VALUES ('Vacation','2018-08-13', '06:30:00','Our annual summer vacation. I want to go to Ibiza',3,10,false,6);

INSERT INTO events (name,date, time,description,owner_id,localization_id,is_public,category_id)
			VALUES ('Champions League Final','2019-05-25', '19:45:00','The UEFA Champions League is an annual continental club football competition organised by the Union of European Football
             Associations and contested by top-division European clubs',8,8,true,5);

INSERT INTO events (name,date, time,description,owner_id,localization_id,is_public,category_id)
			VALUES ('Taylor Swift Concert','2019-10-25', '19:45:00','Taylor Alison Swift is an American singer-songwriter. One of the leading contemporary recording artists, she is known for narrative songs about her personal life, which have received widespread media coverage.
             Madison Square Garden, "MSG", is a multi-purpose indoor
              arena in the New York City borough of Manhattan',19,9,true,4);

INSERT INTO events (name,date, time,description,owner_id,localization_id,is_public,category_id)
			VALUES ('Eurovision','2018-05-25', '20:45:00','The Eurovision Song Contest, often simply called Eurovision, is an international song competition held primarily among the member countries of the European Broadcasting Union.',13,12,true,4);
            
INSERT INTO events (name,date, time,description,owner_id,localization_id,is_public,category_id)
			VALUES ('Feup CarreerFair','2018-10-13', '12:30:00','VENHA CONHECER OS 
            TALENTOS DE ENGENHARIA! PARTICIPE E FAÇA EQUIPA COM OS MELHORES! 
            A Faculdade de Engenharia da Universidade do Porto',16,2,true,1);

INSERT INTO events (name,date, time,description,owner_id,localization_id,is_public,category_id)
			VALUES ('Auto da Barca','2018-12-13', '12:30:00',' Auto da barca do inferno, escrita por Gil Vicente. 
            Companhia de teatro XPTO e encenada por John Doe',17,13,true,3);

INSERT INTO events (name,date, time,description,owner_id,localization_id,is_public,category_id)
			VALUES ('Rali','2018-10-13', '12:30:00','for lovers of rali, the first and soon to be best rali in the world',1,7,true,3);

INSERT INTO events (name,date, time,description,owner_id,localization_id,is_public,category_id)
			VALUES ('Kpop concert','2018-11-13', '12:30:00','Kpop band concert',20,4,true,4);


			


INSERT INTO images (event_id,path) VALUES (1,'natur.jpg');			
INSERT INTO images (event_id,path) VALUES (2,'natu.jpg');			
INSERT INTO images (event_id,path) VALUES (3,'pyr.jpg');			
INSERT INTO images (event_id,path) VALUES (4,'november.jpg');			
INSERT INTO images (event_id,path) VALUES (5,'taj.jpg');			
INSERT INTO images (event_id,path) VALUES (6,'fer.jpg');			
INSERT INTO images (event_id,path) VALUES (7,'fa1.jpg');			
INSERT INTO images (event_id,path) VALUES (8,'fa2.jpg');
INSERT INTO images (event_id,path) VALUES (9,'taj.jpg');
INSERT INTO images (event_id,path) VALUES (10,'november.jpg');


INSERT INTO ratings ( "value", event_id, user_id)
            VALUES (4, 2, 2);
INSERT INTO ratings ( "value", event_id, user_id)
            VALUES (4, 10, 2);
INSERT INTO ratings ( "value", event_id, user_id)
            VALUES (5, 10, 10);
INSERT INTO ratings ( "value", event_id, user_id)
            VALUES (2, 10, 12);
INSERT INTO ratings ( "value", event_id, user_id)
            VALUES (4, 10, 20);
INSERT INTO ratings ( "value", event_id, user_id)
            VALUES (3, 10, 15);
INSERT INTO ratings ( "value", event_id, user_id)
            VALUES (5, 14, 1);
INSERT INTO ratings ( "value", event_id, user_id)
            VALUES (5, 14, 3);
INSERT INTO ratings ( "value", event_id, user_id)
            VALUES (5, 14, 7);
			
			
INSERT INTO participants (user_id,event_id)
			VALUES (1,2);
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
			VALUES (10,8);
INSERT INTO participants (user_id,event_id)
			VALUES (2,4);
INSERT INTO participants (user_id,event_id)
			VALUES (2,5);
INSERT INTO participants (user_id,event_id)
			VALUES (2,6);
INSERT INTO participants (user_id,event_id)
			VALUES (2,7);
INSERT INTO participants (user_id,event_id)
			VALUES (2,8);
INSERT INTO participants (user_id,event_id)
			VALUES (2,9);
INSERT INTO participants (user_id,event_id)
			VALUES (2,10);
INSERT INTO participants (user_id,event_id)
			VALUES (10,10);
INSERT INTO participants (user_id,event_id)
			VALUES (20,10);
INSERT INTO participants (user_id,event_id)
			VALUES (15,10);
INSERT INTO participants (user_id,event_id)
			VALUES (11,10);
INSERT INTO participants (user_id,event_id)
			VALUES (3,11);
INSERT INTO participants (user_id,event_id)
			VALUES (1,11);
INSERT INTO participants (user_id,event_id)
			VALUES (4,11);
INSERT INTO participants (user_id,event_id)
			VALUES (17,11);
INSERT INTO participants (user_id,event_id)
			VALUES (1,12);
INSERT INTO participants (user_id,event_id)
			VALUES (5,12);
INSERT INTO participants (user_id,event_id)
			VALUES (16,12);
INSERT INTO participants (user_id,event_id)
			VALUES (6,12);
INSERT INTO participants (user_id,event_id)
			VALUES (4,12);
INSERT INTO participants (user_id,event_id)
			VALUES (13,12);
INSERT INTO participants (user_id,event_id)
			VALUES (19,12);

INSERT INTO participants (user_id,event_id)
			VALUES (2,14);
INSERT INTO participants (user_id,event_id)
			VALUES (3,14);
INSERT INTO participants (user_id,event_id)
			VALUES (6,14);
INSERT INTO participants (user_id,event_id)
			VALUES (8,14);
INSERT INTO participants (user_id,event_id)
			VALUES (9,14);
INSERT INTO participants (user_id,event_id)
			VALUES (11,13);
INSERT INTO participants (user_id,event_id)
			VALUES (12,13);
INSERT INTO participants (user_id,event_id)
			VALUES (13,13);
INSERT INTO participants (user_id,event_id)
			VALUES (14,13);
INSERT INTO participants (user_id,event_id)
			VALUES (15,13);
INSERT INTO participants (user_id,event_id)
			VALUES (1,13);
INSERT INTO participants (user_id,event_id)
			VALUES (2,15);
INSERT INTO participants (user_id,event_id)
			VALUES (14,15);
INSERT INTO participants (user_id,event_id)
			VALUES (13,15);
INSERT INTO participants (user_id,event_id)
			VALUES (19,15);
INSERT INTO participants (user_id,event_id)
			VALUES (20,15);
INSERT INTO participants (user_id,event_id)
			VALUES (20,16);
INSERT INTO participants (user_id,event_id)
			VALUES (17,16);
INSERT INTO participants (user_id,event_id)
			VALUES (1,16);
INSERT INTO participants (user_id,event_id)
			VALUES (3,17);
INSERT INTO participants (user_id,event_id)
			VALUES (5,17);
INSERT INTO participants (user_id,event_id)
			VALUES (13,18);
INSERT INTO participants (user_id,event_id)
			VALUES (13,14);



INSERT INTO posts (description,date,event_id, user_id, image_path) VALUES ('Lorem ipsum dolor sit amet. ',NOW(),1,1,'new.jpg');
INSERT INTO posts (description,date,event_id, user_id, image_path) VALUES ('Lorem ipsum dolor sit amet. ',NOW(),1,3,'new.jpg');
INSERT INTO posts (description,date,event_id, user_id, image_path) VALUES ('Lorem ipsum dolor sit amet. ',NOW(),1,4,'new.jpg');
INSERT INTO posts (description,date,event_id, user_id, image_path) VALUES ('Lorem ipsum dolor sit amet. ',NOW(),1,16,'new.jpg');
INSERT INTO posts (description,date,event_id, user_id, image_path) VALUES ('Lorem ipsum dolor sit amet. ',NOW(),2,18,'new.jpg');
INSERT INTO posts (description,date,event_id, user_id) VALUES ('Lorem ipsum dolor sit amet. ',NOW(),4,10);
INSERT INTO posts (description,date,event_id, user_id) VALUES ('Lorem ipsum dolor sit amet. ',NOW(),3,17);
INSERT INTO posts (description,date,event_id, user_id) VALUES ('Lorem ipsum dolor sit amet. ',NOW(),3,14);
INSERT INTO posts (description,date,event_id, user_id) VALUES ('Lorem ipsum dolor sit amet. ',NOW(),4,5);
INSERT INTO posts (description,date,event_id, user_id) VALUES ('Lorem ipsum dolor sit amet. ',NOW(),2,16);
INSERT INTO posts (description,date,event_id, user_id) VALUES ('Lorem ipsum dolor sit amet. ',NOW(),3,12);
INSERT INTO posts (description,date,event_id, user_id) VALUES ('Lorem ipsum dolor sit amet. ',NOW(),1,15);
INSERT INTO posts (description,date,event_id, user_id) VALUES ('Lorem ipsum dolor sit amet. ',NOW(),5,12);
INSERT INTO posts (description,date,event_id, user_id) VALUES ('Joao Sousa is really good ','2018-05-11 15:30:00',10,2);
INSERT INTO posts (description,date,event_id, user_id) VALUES ('Finally a portuguese player in the finals','2018-05-11 16:30:00',10,15);
INSERT INTO posts (description,date,event_id, user_id) VALUES ('Marcelo Rebelo de Sousa is in the attendence','2018-05-11 20:30:00',10,12);
INSERT INTO posts (description,date,event_id, user_id) VALUES ('If you want to go to spain, why dont we go to madrid? Its a lot better. I dont like to go to the beach (as you know)',NOW(),11,1);
INSERT INTO posts (description,date,event_id, user_id) VALUES ('Lets see what everyone says. They are invited already!',NOW(),11,3);
INSERT INTO posts (description,date,event_id, user_id) VALUES ('This year the winner will be Liverpool',NOW(),12,5);
INSERT INTO posts (description,date,event_id, user_id) VALUES ('Keep dreaming!',NOW(),12,1);
INSERT INTO posts (description,date,event_id, user_id) VALUES ('They wont even reach the semi finals. The winner will of course be Real Madrid',NOW(),12,6);
INSERT INTO posts (description,date,event_id, user_id) VALUES ('Congrats to Portugal on a great organization',NOW(),14,3);
INSERT INTO posts (description,date,event_id, user_id) VALUES ('100% mate',NOW(),14,9);
INSERT INTO posts (description,date,event_id, user_id) VALUES ('I just cant wait to be there',NOW(),13,14);
INSERT INTO posts (description,date,event_id, user_id, image_path) VALUES ('Look at this pic!',NOW(),13,13,'new.jpg');
INSERT INTO posts (description,date,event_id, user_id, image_path) VALUES ('Look at this pic!',NOW(),15,20,'new.jpg');
INSERT INTO posts (description,date,event_id, user_id) VALUES ('So many companies coming!',NOW(),15,16);
INSERT INTO posts (description,date,event_id, user_id) VALUES ('Can I take food into the theatre?',NOW(),16,1);
INSERT INTO posts (description,date,event_id, user_id) VALUES ('Hell No!',NOW(),16,17);




INSERT INTO polls (question,date,event_id) VALUES ('Whats the best place for the after party? ',NOW(),1);
INSERT INTO polls (question,date,event_id) VALUES ('What date do you guys prefer? ',NOW(),2);
INSERT INTO polls (question,date,event_id) VALUES ('What do you think about the location? ',NOW(),3);
INSERT INTO polls (question,date,event_id) VALUES ('Do you want alcool available?',NOW(),4);
INSERT INTO polls (question,date,event_id) VALUES ('Will Joao Sousa win? ','2018-05-06 20:30:00',10);
INSERT INTO polls (question,date,event_id) VALUES ('Where do you want to travel to? ','2018-05-30 20:30:00',11);


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
INSERT INTO options (description,poll_id) VALUES ('Yes',5);
INSERT INTO options (description,poll_id) VALUES ('No',5);
INSERT INTO options (description,poll_id) VALUES ('Madrid',6);
INSERT INTO options (description,poll_id) VALUES ('Ibiza',6);
INSERT INTO options (description,poll_id) VALUES ('Barcelona',6);


INSERT INTO poll_votes (poll_id,option_id,user_id) VALUES (5,12,15);
INSERT INTO poll_votes (poll_id,option_id,user_id) VALUES (5,11,10);
INSERT INTO poll_votes (poll_id,option_id,user_id) VALUES (5,11,20);
INSERT INTO poll_votes (poll_id,option_id,user_id) VALUES (6,13,1);



INSERT INTO friend_requests (sender_id, receiver_id) VALUES (1, 2);
INSERT INTO friend_requests (sender_id, receiver_id) VALUES (4, 3);
INSERT INTO friend_requests (sender_id, receiver_id) VALUES (5, 3);
INSERT INTO friend_requests (sender_id, receiver_id) VALUES (3, 6);
INSERT INTO friend_requests (sender_id, receiver_id) VALUES (7, 3);
INSERT INTO friend_requests (sender_id, receiver_id) VALUES (8, 4);

INSERT INTO event_invites (event_id, sender_id, receiver_id) VALUES (2, 2, 10);
INSERT INTO event_invites (event_id, sender_id, receiver_id) VALUES (2, 2, 12);
INSERT INTO event_invites (event_id, sender_id, receiver_id) VALUES (10, 11, 1);
INSERT INTO event_invites (event_id, sender_id, receiver_id) VALUES (10, 11, 3);

INSERT INTO event_invites (event_id, sender_id, receiver_id) VALUES (11, 3, 18);
INSERT INTO event_invites (event_id, sender_id, receiver_id) VALUES (11, 3, 19);


INSERT INTO friendships (user_id_1, user_id_2) VALUES (2, 10);
INSERT INTO friendships (user_id_1, user_id_2) VALUES (2, 4);
INSERT INTO friendships (user_id_1, user_id_2) VALUES (2, 6);
INSERT INTO friendships (user_id_1, user_id_2) VALUES (2, 7);
INSERT INTO friendships (user_id_1, user_id_2) VALUES (8, 1);
INSERT INTO friendships (user_id_1, user_id_2) VALUES (3, 2);
INSERT INTO friendships (user_id_1, user_id_2) VALUES (9, 10);
INSERT INTO friendships (user_id_1, user_id_2) VALUES (9, 11);
INSERT INTO friendships (user_id_1, user_id_2) VALUES (12, 20);
INSERT INTO friendships (user_id_1, user_id_2) VALUES (15, 16);
INSERT INTO friendships (user_id_1, user_id_2) VALUES (5, 4);
INSERT INTO friendships (user_id_1, user_id_2) VALUES (3, 17);
INSERT INTO friendships (user_id_1, user_id_2) VALUES (3, 19);
INSERT INTO friendships (user_id_1, user_id_2) VALUES (3, 1);
INSERT INTO friendships (user_id_1, user_id_2) VALUES (3, 4);
