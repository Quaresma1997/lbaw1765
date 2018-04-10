UPDATE "users"
SET password = $password,
    email = $email,
    first_name = $first_name,
    last_name = $last_name,
    image_path = $image_path,
    city_id = $city_id
WHERE id = $id;

UPDATE events
SET name = $name,
    date = $date,
    description = $description,
    localization_id = $localization_id,
    event_type = $event_type,
    category = $category
WHERE id = $id;

UPDATE options
SET description = $description
WHERE id = $id;

UPDATE posts
SET description = $description,
    date = $date,
    image_path = $image_path
WHERE id = $id;

UPDATE "current_date"
SET date = $date
WHERE id = $id;

DELETE FROM "users"
WHERE id = $id;

DELETE FROM events
WHERE id = $id;

DELETE FROM posts
WHERE id = $id;

DELETE FROM options
WHERE id = $id;

DELETE FROM polls
WHERE id = $id;

DELETE FROM friendships
WHERE id = $id;

DELETE FROM friend_requests
WHERE id = $id;

DELETE FROM event_invites
WHERE id = $id; 