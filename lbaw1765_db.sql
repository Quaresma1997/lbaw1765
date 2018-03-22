--Types Enums
PRAGMA foreign_keys = ON;

DROP TYPE IF EXISTS categories CASCADE;
CREATE TYPE categories AS ENUM(
    'Music',
    'Sports',
    'Entertainment',
    'Educational',
    'Business',
    'Other'
);
DROP TYPE IF EXISTS types_of_event CASCADE;
CREATE TYPE types_of_event AS ENUM(
    'Public',
    'Private'
);

--Tables
DROP TABLE IF EXISTS admins CASCADE;
CREATE TABLE admins (
    id SERIAL NOT NULL,
    username text NOT NULL,
    password text NOT NULL,
    email text NOT NULL,
    CONSTRAINT admins_pk PRIMARY KEY (id),
    CONSTRAINT admins_email_uk UNIQUE (email)
);

DROP TABLE IF EXISTS cities CASCADE;
CREATE TABLE cities (
    id SERIAL NOT NULL,
    name text NOT NULL,
    country_id INTEGER NOT NULL,
    CONSTRAINT cities_pk PRIMARY KEY (id),
    CONSTRAINT cities_name_uk UNIQUE (name),
    CONSTRAINT cities_country_id_fk FOREIGN KEY (country_id) REFERENCES 
    countries(id) ON DELETE SET NULL
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
    rating INTEGER NOT NULL,
    CONSTRAINT dones_pk PRIMARY KEY (event_id),
    CONSTRAINT dones_event_id_fk FOREIGN KEY (event_id) REFERENCES
     events(id) ON UPDATE CASCADE,
    CONSTRAINT rating_ck CHECK (((rating >= 1) AND (rating <= 5)))
);

DROP TABLE IF EXISTS events CASCADE;
CREATE TABLE events (
    id SERIAL NOT NULL,
    name text NOT NULL,
    date TIMESTAMP WITH TIME zone NOT NULL,
    description text NOT NULL,
    owner_id INTEGER NOT NULL,
    localization_id INTEGER NOT NULL,
    image_id INTEGER NOT NULL,
    type event_type NOT NULL,
    category categories NOT NULL,
    CONSTRAINT events_pk PRIMARY KEY (id),
    CONSTRAINT events_owner_id_fk FOREIGN KEY (owner_id) REFERENCES 
    users(id) ON UPDATE CASCADE,
    CONSTRAINT events_localization_id_fk FOREIGN KEY (localization_id) REFERENCES 
    localizations(id) ON DELETE SET NULL,
    CONSTRAINT events_image_id_fk FOREIGN KEY (image_id) REFERENCES 
    images(id) ON DELETE SET NULL,
    CONSTRAINT date_ck CHECK ((date > now()))
);

DROP TABLE IF EXISTS event_invites CASCADE;
CREATE TABLE event_invites (
    id SERIAL NOT NULL,
    answer text NOT NULL,
    event_id INTEGER NOT NULL,
    owner_id INTEGER NOT NULL,
    receiver_id INTEGER NOT NULL,
    CONSTRAINT event_invites_pk PRIMARY KEY (id),
    CONSTRAINT event_invites_event_id_fk FOREIGN KEY (event_id) REFERENCES 
    not_dones(event_id) ON DELETE CASCADE,
    CONSTRAINT event_invites_owner_id_fk FOREIGN KEY (owner_id) REFERENCES 
    owners(id) ON DELETE SET NULL,
    CONSTRAINT event_invites_receiver_id_fk FOREIGN KEY (receiver_id) REFERENCES 
    users(id) ON DELETE SET NULL
);

DROP TABLE IF EXISTS friend_activities CASCADE;
CREATE TABLE friend_activities (
    id SERIAL NOT NULL,
    sender_id INTEGER NOT NULL,
    receiver_id INTEGER NOT NULL,
    event_id INTEGER NOT NULL,
    CONSTRAINT friend_activities_pk PRIMARY KEY (id),
    CONSTRAINT friend_activities_sender_id_fk FOREIGN KEY (sender_id) REFERENCES
    users(id) ON DELETE SET NULL,
    CONSTRAINT friend_activities_receiver_id_fk FOREIGN KEY (receiver_id) REFERENCES 
    users(id) ON DELETE SET NULL,
    CONSTRAINT friend_activities_event_id_fk FOREIGN KEY (event_id) REFERENCES 
    events(id) ON DELETE CASCADE
);

DROP TABLE IF EXISTS friend_requests CASCADE;
CREATE TABLE friend_requests (
    id SERIAL NOT NULL,
    answer text NOT NULL,
    sender_id INTEGER NOT NULL,
    receiver_id INTEGER NOT NULL,
    event_id INTEGER NOT NULL,
    CONSTRAINT friend_requests_pk PRIMARY KEY (id),
    CONSTRAINT friend_requests_sender_id_fk FOREIGN KEY (sender_id) REFERENCES 
    participants(id) ON DELETE CASCADE,
    CONSTRAINT friend_requests_receiver_id_fk FOREIGN KEY (receiver_id) REFERENCES 
    users(id) ON DELETE CASCADE
);

DROP TABLE IF EXISTS images CASCADE;
CREATE TABLE images (
    id SERIAL NOT NULL,
    path text NOT NULL,
    CONSTRAINT images_pk PRIMARY KEY (id),
    CONSTRAINT images_path_uk UNIQUE (path)
);

DROP TABLE IF EXISTS localizations CASCADE;
CREATE TABLE localizations (
    id SERIAL NOT NULL,
    name text NOT NULL,
    address text NOT NULL,
    latitude FLOAT,
    longitude FLOAT,
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
    events(id) ON UPDATE CASCADE
);

DROP TABLE IF EXISTS options CASCADE;
CREATE TABLE options (
    id SERIAL NOT NULL,
    description text NOT NULL,
    poll_id INTEGER NOT NULL,
    CONSTRAINT options_pk PRIMARY KEY (id),
    CONSTRAINT options_poll_id_fk FOREIGN KEY (poll_id) REFERENCES 
    polls(id) ON DELETE CASCADE
);

DROP TABLE IF EXISTS owners CASCADE;
CREATE TABLE owners (
    id SERIAL NOT NULL,
    user_id INTEGER NOT NULL,
    event_id INTEGER NOT NULL,
    CONSTRAINT owners_pk PRIMARY KEY (id),
    CONSTRAINT owners_user_id_event_id_uk UNIQUE (user_id, event_id),
    CONSTRAINT owners_user_id_fk FOREIGN KEY (user_id) REFERENCES
    users(id) ON UPDATE CASCADE,
    CONSTRAINT owners_event_id_fk FOREIGN KEY (event_id) REFERENCES 
    events(id) ON DELETE SET NULL
);

DROP TABLE IF EXISTS participants CASCADE;
CREATE TABLE participants (
    id SERIAL NOT NULL,
    user_id INTEGER NOT NULL,
    event_id INTEGER NOT NULL,
    CONSTRAINT participants_pk PRIMARY KEY (id),
    CONSTRAINT participants_user_id_event_id_uk UNIQUE (user_id, event_id),
    CONSTRAINT participants_user_id_fk FOREIGN KEY (user_id) REFERENCES 
    users(id) ON UPDATE CASCADE,
    CONSTRAINT participants_event_id_fk FOREIGN KEY (event_id) REFERENCES 
    events(id) ON DELETE SET NULL
);

DROP TABLE IF EXISTS polls CASCADE;
CREATE TABLE polls (
    id SERIAL NOT NULL,
    post_id INTEGER NOT NULL,
    CONSTRAINT polls_pk PRIMARY KEY (id),
    CONSTRAINT polls_post_id_fk FOREIGN KEY (post_id) REFERENCES 
    posts(id) ON DELETE CASCADE
);

DROP TABLE IF EXISTS posts CASCADE;
CREATE TABLE posts (
    id SERIAL NOT NULL,
    description text NOT NULL,
    date TIMESTAMP WITH TIME zone NOT NULL,
    event_id INTEGER NOT NULL,
    user_id INTEGER NOT NULL,
    image_id INTEGER NOT NULL,
    CONSTRAINT posts_pk PRIMARY KEY (id),
    CONSTRAINT posts_event_id_fk FOREIGN KEY (event_id) REFERENCES 
    events(id) ON DELETE CASCADE,
    CONSTRAINT posts_user_id_fk FOREIGN KEY (user_id) REFERENCES 
    users(id) ON DELETE CASCADE,
    CONSTRAINT posts_image_id_fk FOREIGN KEY (image_id) REFERENCES 
    images(id) ON DELETE SET NULL
);

DROP TABLE IF EXISTS users CASCADE;
CREATE TABLE users (
    id SERIAL NOT NULL,
    username text NOT NULL,
    password text NOT NULL,
    email text NOT NULL,
    regist_date TIMESTAMP WITH TIME zone DEFAULT now() NOT NULL,
    first_name text NOT NULL,
    last_name text NOT NULL,
    image_path text NOT NULL,
    city_id INTEGER NOT NULL,
    CONSTRAINT users_pk PRIMARY KEY (id),
    CONSTRAINT users_name_uk UNIQUE (username),
    CONSTRAINT users_email_uk UNIQUE (email),
    CONSTRAINT users_city_id_fk FOREIGN KEY (city_id) REFERENCES 
    cities(id) ON DELETE SET NULL
);