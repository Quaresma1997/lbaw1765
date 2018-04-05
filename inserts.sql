
INSERT INTO friend_requests (id,answer,sender_id,receiver_id) VALUES (1,'YES',1,2);
INSERT INTO friend_requests (id,answer,sender_id,receiver_id) VALUES (3,'YES',1,3);
INSERT INTO friend_requests (id,answer,sender_id,receiver_id) VALUES (4,'NO',1,4);
INSERT INTO friend_requests (id,answer,sender_id,receiver_id) VALUES (5,'YES',1,5);


INSERT INTO friend_activities (id,sender_id,receiver_id,event_id) VALUES (1,1,2,1);
INSERT INTO friend_activities (id,sender_id,receiver_id,event_id) VALUES (2,2,3,2);


INSERT INTO event_invites (id,answer,event_id,owner_id,receiver_id) VALUES (1,'YES',1,1,2);
INSERT INTO event_invites (id,answer,event_id,owner_id,receiver_id) VALUES (2,'YES',1,1,3);
INSERT INTO event_invites (id,answer,event_id,owner_id,receiver_id) VALUES (3,'YES',1,1,4);
INSERT INTO event_invites (id,answer,event_id,owner_id,receiver_id) VALUES (4,'YES',1,1,19);

INSERT INTO friendships (id, user_id_1, user_id_2) VALUES (1,2,3);
INSERT INTO friendships (id, user_id_1, user_id_2) VALUES (2,4,7);

INSERT INTO event_warnings (id, event_id, receiver_id, message) VALUES (1,4,1,'Canceled');
