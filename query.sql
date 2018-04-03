
--> user profile
SELECT username, last_name, first_name, email, image_path, city
  FROM "users" 
  WHERE "users".id = $userId;
 
 
 --> search user
SELECT id, username, image_path 
FROM "users" 
  WHERE username LIKE %$search%
ORDER BY username;

--> search event
SELECT id, name, description, image_id, date, localization 
FROM events
  WHERE name LIKE %$search% OR localization LIKE %$search%;

--> filter event by category
SELECT id, name, description, image_id, date, localization 
FROM events
  WHERE name LIKE %$search% OR localization LIKE %$search%; 

--> event page
SELECT events.id, events.title, events.obs, events.img, events.year, "user".name
  FROM events, "user"
  WHERE events.id_user = "user".id AND events.id = $id;
 
SELECT "user".name, comment.description, comment."date"
  FROM "user", comment
  WHERE comment.id_user = "user".id AND comment.id_work = $id;
  
 --> IF date>current date 
 
SELECT rate.rate
  FROM "user", rate
  WHERE rate.id_user = $userId AND rate.id_work = $id;
 
SELECT AVG(rate)
  FROM rate
  WHERE rate.id_work = $id; 
 
 
--