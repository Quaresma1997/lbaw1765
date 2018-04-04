
--> user profile
SELECT username, last_name, first_name, email, image_path, city_id
  FROM users 
  WHERE users.id = $user_id; 
 
 --> search user
SELECT id, username, image_path 
FROM users 
  WHERE username LIKE %$search%
ORDER BY username;

--> search event
SELECT id, name, description, image_id, date, localization 
FROM events
  WHERE name LIKE %$search% OR localization LIKE %$search%;

-->pesquisa categoria
SELECT id, name, "date", description, image_id, category FROM events 
  WHERE events.category LIKE %$category_type%
ORDER BY date;

-->pesquisa event
SELECT id, name, description, image_id, category, "date" FROM events
  WHERE name LIKE %$search%
  ORDER BY date;
  
-->pesquisa
SELECT id, users.username, users.last_name, users.first_name, users.image_path, events.name, events.category, events.description, events.image_id FROM events, users 
  WHERE title LIKE %$search% OR obs LIKE %$search%
ORDER BY title; 

-- pagina evento
SELECT events.id, events.name, events.category, events.image_id, events.description, events."date" users.username
  FROM events, users
  WHERE events.owner_id = users.id AND events.id = $id;
 
SELECT posts.description, posts.id, posts.image_id, posts.user_id
  FROM posts,events
  WHERE posts.event_id = events.id;
  
SELECT users.username, users.image_path
  FROM participants
  WHERE users.id = participants.user_id AND participants.event_id=event.id; 
  
--- testar e fazer modificações frequentes e os indexes

