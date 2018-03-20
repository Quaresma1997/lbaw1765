-- Tables
 
CREATE TABLE user (
    user_id INTEGER NOT NULL,
    username text NOT NULL,
    email text NOT NULL,
	"registDate" TIMESTAMP WITH TIME zone DEFAULT now() NOT NULL,
	firstName text NOT NULL,
	lastName text NOT NULL,
	image text,
	id_city INTEGER NOT NULL
	
);
 
CREATE TABLE event (
    id_event INTEGER NOT NULL,
    name text NOT NULL,
	date DATE NOT NULL,
	description text NOT NULL,
	owner_id NOT NULL,
	localization_id INTEGER NOT NULL,
	image_id INTEGER NOT NULL,
	category text NOT NULL 
	CONSTRAINT category_ck CHECK ((CATEGORY = ANY (ARRAY['Music'::text, 'Sports'::text, 'Enterteinment'::text, 'Educational'::text,'Business'::text,'Other'::text])))
	type text NOT NULL, -- SO DA PARA ESCOLHER UMA
    CONSTRAINT type_ck CHECK ((TYPE = ANY (ARRAY['Public'::text, 'Private'::text])))
);
 
CREATE TABLE done (
    id_event INTEGER NOT NULL,
	rating INTEGER NOT NULL CONSTRAINT rating_ck CHECK (((rating > 0) OR (rating <= 5)))
   
);
CREATE TABLE notDone (
    id_event INTEGER NOT NULL  
);
 
CREATE TABLE participant (
    id_user INTEGER NOT NULL,
    id_event INTEGER NOT NULL
);
 
CREATE TABLE owner (
    id_user INTEGER NOT NULL,
    id_event INTEGER NOT NULL,
);
 
CREATE TABLE image (
    id INTEGER NOT NULL,
	path text NOT NULL
);
 
CREATE TABLE location (
    location_id INTEGER NOT NULL,
    name text,
    address text NOT NULL,
    latitude text,
	longitude text,
	city_id INTEGER NOT NULL
);
 
CREATE TABLE city (
    id INTEGER NOT NULL,
	country_id INTEGER NOT NULL
   
);
 
CREATE TABLE country (
    id INTEGER NOT NULL,
    name text NOT NULL
);
 
CREATE TABLE post (
    id INTEGER NOT NULL,
	description text NOT NULL,
    "date" TIMESTAMP WITH TIME zone DEFAULT now() NOT NULL,
	event_id INTEGER NOT NULL,
	user_id INTEGER NOT NULL,
	image_id INTEGER
);
 
CREATE TABLE poll(
    id INTEGER NOT NULL,
    post_id INTEGER NOT NULL ,
);
 
CREATE TABLE option (
    id INTEGER NOT NULL,
	description text NOT NULL,
    poll_id INTEGER NOT NULL
);
 
CREATE TABLE admin (
	id INTEGER NOT NULL,
    username text NOT NULL,
    email text NOT NULL,
	password text NOT NULL,
);

CREATE TABLE friendRequest (
	id INTEGER NOT NULL,
    answer BOOLEAN NOT NULL,
    sender_id INTEGER NOT NULL,
	receiver_id INTEGER NOT NULL,
);

CREATE TABLE friendActivity (
	id INTEGER NOT NULL,
    sender_id INTEGER NOT NULL,
	receiver_id INTEGER NOT NULL,
	event_id INTEGER NOT NULL
);
CREATE TABLE eventInvite (
	id INTEGER NOT NULL,
	answer BOOLEAN NOT NULL,
	event_id INTEGER NOT NULL,
	owner_id INTEGER NOT NULL,
	receiver_id INTEGER NOT NULL

);
 
