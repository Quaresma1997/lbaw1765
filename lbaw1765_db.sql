--Types Enums

DROP TYPE IF EXISTS category_type CASCADE;
CREATE TYPE category_type AS ENUM(
    'Music',
    'Sports',
    'Entertainment',
    'Educational',
    'Business',
    'Other'
);
DROP TYPE IF EXISTS event_type CASCADE;
CREATE TYPE event_type AS ENUM(
    'Public',
    'Private'
);

--Tables
DROP TABLE IF EXISTS admin CASCADE;
CREATE TABLE admin (
    id SERIAL NOT NULL,
    username text NOT NULL,
    password text NOT NULL,
    email text NOT NULL
);

DROP TABLE IF EXISTS city CASCADE;
CREATE TABLE city (
    id SERIAL NOT NULL,
    name text NOT NULL,
    country_id INTEGER NOT NULL
);

DROP TABLE IF EXISTS country CASCADE;
CREATE TABLE country (
    id SERIAL NOT NULL,
    name text NOT NULL
);

DROP TABLE IF EXISTS done CASCADE;
CREATE TABLE done (
    event_id INTEGER NOT NULL,
    rating INTEGER NOT NULL,
    CONSTRAINT rating_ck CHECK (((rating > 0) AND (rating <= 5)))
);

DROP TABLE IF EXISTS event CASCADE;
CREATE TABLE event (
    id SERIAL NOT NULL,
    name text NOT NULL,
    date TIMESTAMP WITH TIME zone NOT NULL,
    description text NOT NULL,
    owner_id INTEGER NOT NULL,
    localization_id INTEGER NOT NULL,
    image_id INTEGER NOT NULL,
    type event_type NOT NULL,
    category category_type NOT NULL,
    CONSTRAINT date_ck CHECK ((date > now()))
);

DROP TABLE IF EXISTS eventInvite CASCADE;
CREATE TABLE eventInvite (
    id SERIAL NOT NULL,
    answer text NOT NULL,
    event_id INTEGER NOT NULL,
    owner_id INTEGER NOT NULL,
    receiver_id INTEGER NOT NULL
);

DROP TABLE IF EXISTS friendActivity CASCADE;
CREATE TABLE friendActivity (
    id SERIAL NOT NULL,
    sender_id INTEGER NOT NULL,
    receiver_id INTEGER NOT NULL,
    event_id INTEGER NOT NULL
);

DROP TABLE IF EXISTS friendRequest CASCADE;
CREATE TABLE friendRequest (
    id SERIAL NOT NULL,
    answer text NOT NULL,
    sender_id INTEGER NOT NULL,
    receiver_id INTEGER NOT NULL,
    event_id INTEGER NOT NULL
);

DROP TABLE IF EXISTS image CASCADE;
CREATE TABLE image (
    id SERIAL NOT NULL,
    path text NOT NULL
);

DROP TABLE IF EXISTS localization CASCADE;
CREATE TABLE localization (
    id SERIAL NOT NULL,
    name text NOT NULL,
    address text NOT NULL,
    latitude FLOAT,
    longitude FLOAT,
    city_id INTEGER NOT NULL
);

DROP TABLE IF EXISTS notDone CASCADE;
CREATE TABLE notDone (
    event_id INTEGER NOT NULL
);

DROP TABLE IF EXISTS option CASCADE;
CREATE TABLE option (
    id SERIAL NOT NULL,
    description text NOT NULL,
    poll_id INTEGER NOT NULL
);

DROP TABLE IF EXISTS owner CASCADE;
CREATE TABLE owner (
    user_id INTEGER NOT NULL,
    event_id INTEGER NOT NULL
);

DROP TABLE IF EXISTS participant CASCADE;
CREATE TABLE participant (
    user_id INTEGER NOT NULL,
    event_id INTEGER NOT NULL
);

DROP TABLE IF EXISTS poll CASCADE;
CREATE TABLE poll (
    id SERIAL NOT NULL,
    post_id INTEGER NOT NULL
);

DROP TABLE IF EXISTS post CASCADE;
CREATE TABLE post (
    id SERIAL NOT NULL,
    description text NOT NULL,
    date TIMESTAMP WITH TIME zone NOT NULL,
    event_id INTEGER NOT NULL,
    user_id INTEGER NOT NULL,
    image_id INTEGER NOT NULL
);

DROP TABLE IF EXISTS "user" CASCADE;
CREATE TABLE "user" (
    id SERIAL NOT NULL,
    username text NOT NULL,
    password text NOT NULL,
    email text NOT NULL,
    registDate TIMESTAMP WITH TIME zone DEFAULT now() NOT NULL,
    firstName text NOT NULL,
    lastName text NOT NULL,
    imagePath text NOT NULL,
    city_id INTEGER NOT NULL
);

-- Primary Keys and Uniques

ALTER TABLE ONLY admin
    ADD CONSTRAINT admin_pk PRIMARY KEY (id);

ALTER TABLE ONLY admin
    ADD CONSTRAINT admin_email_uk UNIQUE (email);

ALTER TABLE ONLY city
    ADD CONSTRAINT city_pk PRIMARY KEY (id);  

ALTER TABLE ONLY city
    ADD CONSTRAINT city_name_uk UNIQUE (name);

ALTER TABLE ONLY country
    ADD CONSTRAINT country_pk PRIMARY KEY (id);  

ALTER TABLE ONLY country
    ADD CONSTRAINT country_name_uk UNIQUE (name);

ALTER TABLE ONLY done
    ADD CONSTRAINT done_pk PRIMARY KEY (event_id);  

ALTER TABLE ONLY event
    ADD CONSTRAINT event_pk PRIMARY KEY (id);  

ALTER TABLE ONLY eventInvite
    ADD CONSTRAINT eventInvite_pk PRIMARY KEY (id);  

ALTER TABLE ONLY friendActivity
    ADD CONSTRAINT friendActivity_pk PRIMARY KEY (id);  

ALTER TABLE ONLY friendRequest
    ADD CONSTRAINT friendRequest_pk PRIMARY KEY (id); 

ALTER TABLE ONLY image
    ADD CONSTRAINT image_pk PRIMARY KEY (id); 

ALTER TABLE ONLY image
    ADD CONSTRAINT image_path_uk UNIQUE (path);  

ALTER TABLE ONLY localization
    ADD CONSTRAINT localization_pk PRIMARY KEY (id);

ALTER TABLE ONLY notDone
    ADD CONSTRAINT notDone_pk PRIMARY KEY (event_id); 

ALTER TABLE ONLY option
    ADD CONSTRAINT option_pk PRIMARY KEY (id);

ALTER TABLE ONLY owner
    ADD CONSTRAINT owner_pk PRIMARY KEY (user_id, event_id); 

ALTER TABLE ONLY participant
    ADD CONSTRAINT participant_pk PRIMARY KEY (user_id, event_id); 

ALTER TABLE ONLY poll
    ADD CONSTRAINT poll_pk PRIMARY KEY (id);

ALTER TABLE ONLY post
    ADD CONSTRAINT post_pk PRIMARY KEY (id);

ALTER TABLE ONLY "user"
    ADD CONSTRAINT user_pk PRIMARY KEY (id);

ALTER TABLE ONLY "user"
    ADD CONSTRAINT user_name_uk UNIQUE (username);

ALTER TABLE ONLY "user"
    ADD CONSTRAINT user_email_uk UNIQUE (email);

-- Foreign Keys

ALTER TABLE ONLY city
    ADD CONSTRAINT city_country_id_fk FOREIGN KEY (country_id) REFERENCES country(id) ON DELETE SET NULL;

ALTER TABLE ONLY done
    ADD CONSTRAINT done_event_id_fk FOREIGN KEY (event_id) REFERENCES event(id) ON UPDATE CASCADE;

ALTER TABLE ONLY event
    ADD CONSTRAINT event_owner_id_fk FOREIGN KEY (owner_id) REFERENCES "user"(id) ON UPDATE CASCADE;

ALTER TABLE ONLY event
    ADD CONSTRAINT event_localization_id_fk FOREIGN KEY (localization_id) REFERENCES localization(id) ON DELETE SET NULL;

ALTER TABLE ONLY event
    ADD CONSTRAINT event_image_id_fk FOREIGN KEY (image_id) REFERENCES image(id) ON DELETE SET NULL;

ALTER TABLE ONLY eventInvite
    ADD CONSTRAINT eventInvite_event_id_fk FOREIGN KEY (event_id) REFERENCES notDone(event_id) ON DELETE CASCADE;

ALTER TABLE ONLY eventInvite
    ADD CONSTRAINT eventInvite_owner_id_fk FOREIGN KEY (owner_id) REFERENCES "user"(id) ON DELETE SET NULL;

ALTER TABLE ONLY eventInvite
    ADD CONSTRAINT eventInvite_receiver_id_fk FOREIGN KEY (receiver_id) REFERENCES "user"(id) ON DELETE SET NULL;

ALTER TABLE ONLY friendActivity
    ADD CONSTRAINT friendActivity_sender_id_fk FOREIGN KEY (sender_id) REFERENCES "user"(id) ON DELETE SET NULL;

ALTER TABLE ONLY friendActivity
    ADD CONSTRAINT friendActivity_receiver_id_fk FOREIGN KEY (receiver_id) REFERENCES "user"(id) ON DELETE SET NULL;

ALTER TABLE ONLY friendActivity
    ADD CONSTRAINT friendActivity_event_id_fk FOREIGN KEY (event_id) REFERENCES event(id) ON DELETE CASCADE;

ALTER TABLE ONLY friendRequest
    ADD CONSTRAINT friendRequest_sender_id_fk FOREIGN KEY (sender_id) REFERENCES "user"(id) ON DELETE CASCADE;

ALTER TABLE ONLY friendRequest
    ADD CONSTRAINT friendRequest_receiver_id_fk FOREIGN KEY (receiver_id) REFERENCES "user"(id) ON DELETE CASCADE;

ALTER TABLE ONLY localization
    ADD CONSTRAINT localization_city_id_fk FOREIGN KEY (city_id) REFERENCES city(id) ON DELETE SET NULL;

ALTER TABLE ONLY notDone
    ADD CONSTRAINT notDone_event_id_fk FOREIGN KEY (event_id) REFERENCES event(id) ON UPDATE CASCADE;

ALTER TABLE ONLY option
    ADD CONSTRAINT option_poll_id_fk FOREIGN KEY (poll_id) REFERENCES poll(id) ON DELETE CASCADE;

ALTER TABLE ONLY owner
    ADD CONSTRAINT owner_user_id_fk FOREIGN KEY (user_id) REFERENCES "user"(id) ON UPDATE CASCADE;

ALTER TABLE ONLY owner
    ADD CONSTRAINT owner_event_id_fk FOREIGN KEY (event_id) REFERENCES event(id) ON DELETE SET NULL;

ALTER TABLE ONLY participant
    ADD CONSTRAINT participant_user_id_fk FOREIGN KEY (user_id) REFERENCES "user"(id) ON UPDATE CASCADE;

ALTER TABLE ONLY participant
    ADD CONSTRAINT participant_event_id_fk FOREIGN KEY (event_id) REFERENCES event(id) ON DELETE SET NULL;

ALTER TABLE ONLY poll
    ADD CONSTRAINT poll_post_id_fk FOREIGN KEY (post_id) REFERENCES post(id) ON DELETE CASCADE;

ALTER TABLE ONLY post
    ADD CONSTRAINT post_event_id_fk FOREIGN KEY (event_id) REFERENCES event(id) ON DELETE CASCADE;

ALTER TABLE ONLY post
    ADD CONSTRAINT post_user_id_fk FOREIGN KEY (user_id) REFERENCES "user"(id) ON DELETE CASCADE;

ALTER TABLE ONLY post
    ADD CONSTRAINT post_image_id_fk FOREIGN KEY (image_id) REFERENCES image(id) ON DELETE SET NULL;

ALTER TABLE ONLY "user"
    ADD CONSTRAINT user_city_id_fk FOREIGN KEY (city_id) REFERENCES city(id) ON DELETE SET NULL;

