--> user profile
SELECT username, last_name, first_name, email, image_path, city_id
  FROM users 
  WHERE users.id = $user_id; 
 
--> user friends
SELECT user_id_1, user_id_2
  FROM friendships
  WHERE user_id_1 = $user_id OR user_id_2 = $user_id;

--> user events
SELECT event_id
  FROM participants
  WHERE user_id = $user_id

SELECT event_id
  FROM owners
  WHERE user_id = $user_id

--> notifications
SELECT sender_id
  FROM friend_requests
  WHERE receiver_id = $user_id

SELECT sender_id, event_id
  FROM friend_activities
  WHERE receiver_id = $user_id

SELECT owner_id, event_id
  FROM event_invites
  WHERE receiver_id = $user_id

SELECT event_id, "message"
  FROM event_warnings
  WHERE receiver_id = $user_id

 --> search user
SELECT id, username, image_path 
FROM users 
  WHERE username LIKE %$search%
  ORDER BY username;

--> search event
SELECT id, "name", image_id, "date", localization, category
FROM events
  WHERE "name" LIKE %$search% OR localization LIKE %$search% AND event_type = 'public'
  ORDER BY "name";

--> filter by category
SELECT id, "name", image_id, "date", localization, category
FROM events
  WHERE "name" LIKE %$search% OR localization LIKE %$search% AND event_type = 'public' AND events.category LIKE %$categories%
  ORDER BY "name";
  
--> search user
SELECT username, email, image_path
  FROM users 
  WHERE username LIKE %$search% OR email LIKE %$search%
ORDER BY username; 

--> event page
SELECT events.id, events.name, events.category, events.image_id, events.description, events."date" users.username
  FROM events, users
  WHERE events.owner_id = users.id AND events.id = $event_id;
 
SELECT posts.description, posts.id, posts.image_id, posts.user_id
  FROM posts,events
  WHERE posts.event_id = $event_id;
  
SELECT users.username, users.image_path
  FROM participants
  WHERE users.id = participants.user_id AND participants.event_id=$event_id; 

--> Rating of a event
SELECT AVG(rating)
  FROM dones 
  WHERE dones.event_id= $event_id; 

-->who can i invite to the event
SELECT users.username
  FROM users, events
  WHERE users.id!= event.owner_id AND users.id  NOT IN (
    SELECT user_id
    FROM participants
    WHERE user_id IS NOT NULL AND participants.event_id=$event_id) ;


