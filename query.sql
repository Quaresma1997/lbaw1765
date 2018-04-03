
-->user profile
SELECT username, last_name, first_name, email, image_path 
  FROM "users" 
  WHERE "users".id = $userId;
 
 
 -->pesquisa user
SELECT id, username, last_name, first_name, image_path FROM users 
  WHERE username LIKE %$search% OR first_name LIKE %$search%
ORDER BY username;


-->pesquisa categoria

-->pesquisa event
SELECT id, name, description, image_id, date FROM events
  WHERE name LIKE %$search% OR date LIKE %$search%;
-->pesquisa
SELECT id, title, obs, img, YEAR FROM WORK 
  WHERE title LIKE %$search% OR obs LIKE %$search%
ORDER BY title; 

-- pagina evento
SELECT events.id, events.title, events.obs, events.img, events.year, "user".name
  FROM events, "user"
  WHERE events.id_user = "user".id AND events.id = $id;
 
SELECT "user".name, comment.description, comment."date"
  FROM "user", comment
  WHERE comment.id_user = "user".id AND comment.id_work = $id;
  
 -- IF date>current date 
 
SELECT rate.rate
  FROM "user", rate
  WHERE rate.id_user = $userId AND rate.id_work = $id;
 
SELECT AVG(rate)
  FROM rate
  WHERE rate.id_work = $id; 
 
 
--