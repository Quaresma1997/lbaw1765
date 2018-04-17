
--> INSERTS

-- Here goes the SQL code - INSERTS
 
INSERT INTO countries (name) VALUES ('Portugal');
INSERT INTO countries (name) VALUES ('Espanha');
INSERT INTO countries (name) VALUES ('USA');


INSERT INTO cities (name,country_id) VALUES ('Braga',1);
INSERT INTO cities (name,country_id) VALUES ('Porto',1);
INSERT INTO cities (name,country_id) VALUES ('Lisboa',1);

INSERT INTO localizations (name,address,latitude,longitude,city_id) VALUES ('Restaurante O Pirata','Rua da Isabelinha',41.452993,-8.5775364,1);
INSERT INTO localizations (name,address,latitude,longitude,city_id) VALUES ('FEUP','Rua Roberto Frias',41.1779401,-8.5998763,2);
INSERT INTO localizations (name,address,latitude,longitude,city_id) VALUES ('Parque da BelaVista','Av. Arlindo Vicente',38.7507558,-9.1265431,3);
INSERT INTO localizations (name,address,latitude,longitude,city_id) VALUES ('Passeio Maritimo de Alges','Alges',38.697318,-9.2375993,3);
INSERT INTO localizations (name,address,latitude,longitude,city_id) VALUES ('Hotel Douro','Rua de Agramonte',41.1564707,-8.6288115,2);
INSERT INTO localizations (name,address,latitude,longitude,city_id) VALUES ('Norte shopping','Matosinhos',41.1825143,-8.6803795,2);

INSERT INTO users (username,password,email,regist_date,first_name,last_name, image_path,city_id)
			VALUES ('sodales','GUL95ZXR9EX','sodales.at@curae.co.uk',NOW(),'Zeph','Griffin','/imgs/natu.jpg',2);
			
			
INSERT INTO users (username,password,email,regist_date,first_name,last_name, image_path,city_id)
			VALUES ('uso1','12345','aliquam.iaculis.lacus@amet.co.uk',NOW(),'Ben','Warren','/imgs/natur.jpg',1);
			
INSERT INTO users (username,password,email,regist_date,first_name,last_name, image_path,city_id)
			VALUES ('robin','pass123','amet.ante@faucibusleo.net',NOW(),'Robin','Wright','/imgs/natur.jpg',2);
			
			
INSERT INTO users (username,password,email,regist_date,first_name,last_name, image_path,city_id)
			VALUES ('bar123','semper123','ut.dolor@gmail.com',NOW(),'Barry','Allen','/imgs/natur.jpg',3);
			
INSERT INTO users (username,password,email,regist_date,first_name,last_name, image_path,city_id)
			VALUES ('reddevil','LBAW','Nulla@et.net',NOW(),'Andrew','Irons','/imgs/november.jpg',2);
			
INSERT INTO users (username,password,email,regist_date,first_name,last_name, image_path,city_id)
			VALUES ('rpedro10','lbaw1765','rpedro10@iol.pt',NOW(),'Rui','Araujo','/imgs/fer.jpg',3);
			
						
INSERT INTO users (username,password,email,regist_date,first_name,last_name, image_path,city_id)
			VALUES ('joss123','CKB15AAW5MM','ante@fleo.com',NOW(),'Joss','Stone','/imgs/natur.jpg',1);
			
INSERT INTO users (username,password,email,regist_date,first_name,last_name, image_path,city_id)
			VALUES ('top123','SXT16TTW3MH','cursus.et@orciUt.co.uk',NOW(),'Chris','Harris','/imgs/natur.jpg',1);
			
			
INSERT INTO users (username,password,email,regist_date,first_name,last_name, image_path,city_id)
			VALUES ('roland1','ZYS24FHN5GR','eget.dictum@orciDonec.edu',NOW(),'Roland','Schitt','/imgs/natur.jpg',2);
						
INSERT INTO users (username,password,email,regist_date,first_name,last_name, image_path,city_id)
			VALUES ('david123','ZUS29FRTGVJ','amet@faucibusleo.net',NOW(),'David','Rose','/imgs/natur.jpg',2);
						
INSERT INTO users (username,password,email,regist_date,first_name,last_name, image_path,city_id)
			VALUES ('catones', 'QQQ8EFHNGNR','amec.donec@faucibusleo.net',NOW(),'Carlos','Antonio','/imgs/november.jpg',2);
						
INSERT INTO users (username,password,email,regist_date,first_name,last_name, image_path,city_id)
			VALUES ('emanem','ASDFGHJKL','donex@sapo.net',NOW(),'Raheem','Sterling','/imgs/natur.jpg',3);			
			
INSERT INTO users (username,password,email,regist_date,first_name,last_name, image_path,city_id)
			VALUES ('ufoExtis','ZXCVBNM','amet@iol.net',NOW(),'Delle','Alli','/imgs/pyr.jpg',2);
						
INSERT INTO users (username,password,email,regist_date,first_name,last_name, image_path,city_id)
			VALUES ('ragnar','QAZWSXEDC','risus.In.mi@egestas.com',NOW(),'Thor','Ragnarok','/imgs/fer.jpg',1);
						
INSERT INTO users (username,password,email,regist_date,first_name,last_name, image_path,city_id)
			VALUES ('seth','QWERTYUIOP','aliquet.diam.Sed@tinciduntnibh.co.uk',NOW(),'Seth','Byers','/imgs/natu.jpg',2);
						
INSERT INTO users (username,password,email,regist_date,first_name,last_name, image_path,city_id)
			VALUES ('edNorton','TYT71DOD7YN','scelerisque.scelerisque.dui@arcuiaculisenim.ca',NOW(),'Ed','Norton','/imgs/natur.jpg',1);
						
INSERT INTO users (username,password,email,regist_date,first_name,last_name, image_path,city_id)
			VALUES ('Pacquiao','SXT16TTW3MH','magnis@cursuset.edu',NOW(),'Paky','Barret','/imgs/natur.jpg',3);	
			
INSERT INTO users (username,password,email,regist_date,first_name,last_name, image_path,city_id)
			VALUES ('steven','MPS10QPK6UE','arcu.Vestibulum@amet.org',NOW(),'Donovan','Stevenson','/imgs/pyr.jpg',1);
						
INSERT INTO users (username,password,email,regist_date,first_name,last_name, image_path,city_id)
			VALUES ('porter123','QIG24ZOK3EM','dui.nec@ultriciesadipiscing.co.uk',NOW(),'Porter','Osborn','/imgs/natu.jpg',2);
						
INSERT INTO users (username,password,email,regist_date,first_name,last_name, image_path,city_id)
			VALUES ('human','ZYG87WQA6FX','facilisis.magna.tellus@sociis.net',NOW(),'Hu','Randolphe','/imgs/pyr.jpg',2);
					
					
INSERT INTO events (name,date,description,owner_id,localization_id,type,category)
			VALUES ('Antonys Birthday Party', '2019-12-04 12:30:19.000000', 'nunc ac mattis ornare, lectus',1,1,'Public','Sports');
			
INSERT INTO events (name,date,description,owner_id,localization_id,type,category)
			VALUES ('ENEI','2019-04-24 12:30:19.000000','Nunc quis arcu vel quam',2,2,'Public','Sports');
			
INSERT INTO events (name,date,description,owner_id,localization_id,type,category)
			VALUES ('RockInRio','2019-06-04 12:30:19.000000','tempus eu, ligula. Aenean euismod',3,3,'Public','Sports');
			
INSERT INTO events (name,date,description,owner_id,localization_id,type,category)
			VALUES ('Nos Alive','2019-08-04 12:30:19.000000','dignissim pharetra. Nam ac nulla.',3,4,'Public','Sports');
			
INSERT INTO events (name,date,description,owner_id,localization_id,type,category)
			VALUES ('Christmas Dinner','2019-10-04 12:30:19.000000','dignissim pharetra. Nam ac nulla.',4,5,'Public','Sports');
			
INSERT INTO events (name,date,description,owner_id,localization_id,type,category)
			VALUES ('Mark Birthday Party','2019-04-13 12:30:19.000000','dignissim pharetra. Nam ac nulla.',1,1,'Public','Sports');
			
INSERT INTO events (name,date,description,owner_id,localization_id,type,category)
			VALUES ('WebSummit','2019-04-12 12:30:19.000000','lorem lorem, luctus ut, pellentesque',6,6,'Public','Sports');
			
INSERT INTO events (name,date,description,owner_id,localization_id,type,category)
			VALUES ('Ted Talk','2019-04-24 12:30:19.000000','sollicitudin orci sem eget massa.',12,2,'Public','Sports');
			
INSERT INTO events (name,date,description,owner_id,localization_id,type,category)
			VALUES ('Teaches Conference','2019-04-13 12:30:19.000000','dignissim pharetra. Nam ac nulla.',1,1,'Private','Business');
			




INSERT INTO admins (username,password,email) VALUES ('admin1','password','sapo@iol.pt');


INSERT INTO images (event_id,path) VALUES (1,'/imgs/natur.jpg');			
INSERT INTO images (event_id,path) VALUES (2,'/imgs/natu.jpg');			
INSERT INTO images (event_id,path) VALUES (3,'/imgs/pyr.jpg');			
INSERT INTO images (event_id,path) VALUES (4,'/imgs/november.jpg');			
INSERT INTO images (event_id,path) VALUES (5,'/imgs/taj.jpg');			
INSERT INTO images (event_id,path) VALUES (6,'/imgs/fer.jpg');			
INSERT INTO images (event_id,path) VALUES (7,'/imgs/fa1.jpg');			
INSERT INTO images (event_id,path) VALUES (8,'/imgs/fa2.jpg');



			
INSERT INTO dones (event_id)
			VALUES (2);
INSERT INTO dones (event_id)
			VALUES (7);
			
INSERT INTO not_dones (event_id)
			VALUES (1);
INSERT INTO not_dones (event_id)
			VALUES (3);
INSERT INTO not_dones (event_id)
			VALUES (4);
INSERT INTO not_dones (event_id)
			VALUES (5);
INSERT INTO not_dones (event_id)
			VALUES (6);
INSERT INTO not_dones (event_id)
			VALUES (8);
INSERT INTO not_dones (event_id)
			VALUES (9);
			

INSERT INTO ratings ( "value", event_id, user_id)
            VALUES (4, 2, 2);
			
			
INSERT INTO participants (user_id,event_id)
			VALUES (1,1);
INSERT INTO participants (user_id,event_id)
			VALUES (2,1);
INSERT INTO participants (user_id,event_id)
			VALUES (2,2);
INSERT INTO participants (user_id,event_id)
			VALUES (3,1);			
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
			VALUES (10,4);
			
			
INSERT INTO owners (user_id,event_id)
			VALUES (1,1);
INSERT INTO owners (user_id,event_id)
			VALUES (2,2);			
INSERT INTO owners (user_id,event_id)
			VALUES (3,3);			
INSERT INTO owners (user_id,event_id)
			VALUES (3,4);			
INSERT INTO owners (user_id,event_id)
			VALUES (5,5);			
INSERT INTO owners (user_id,event_id)
			VALUES (1,6);			
INSERT INTO owners (user_id,event_id)
			VALUES (6,7);			
INSERT INTO owners (user_id,event_id)
			VALUES (12,8);
INSERT INTO owners (user_id,event_id)
			VALUES (20,9);

INSERT INTO posts (description,date,event_id, user_id, image_path) VALUES ('Lorem ipsum dolor sit amet. ','2018-02-12 15:55:12',1,1,'/img/new.jpg');
INSERT INTO posts (description,date,event_id, user_id, image_path) VALUES ('Lorem ipsum dolor sit amet. ','2018-02-12 15:55:12',1,3,'/img/new.jpg');
INSERT INTO posts (description,date,event_id, user_id, image_path) VALUES ('Lorem ipsum dolor sit amet. ','2018-02-12 15:55:12',1,4,'/img/new.jpg');
INSERT INTO posts (description,date,event_id, user_id, image_path) VALUES ('Lorem ipsum dolor sit amet. ',NOW(),1,16,'/img/new.jpg');
INSERT INTO posts (description,date,event_id, user_id, image_path) VALUES ('Lorem ipsum dolor sit amet. ','2018-02-12 15:55:12',2,18,'/img/new.jpg');
INSERT INTO posts (description,date,event_id, user_id, image_path) VALUES ('Lorem ipsum dolor sit amet. ','2018-02-12 15:55:12',4,10,'/img/panda.jpg');
INSERT INTO posts (description,date,event_id, user_id, image_path) VALUES ('Lorem ipsum dolor sit amet. ','2018-02-12 15:55:12',3,17,'/img/panda.jpg');
INSERT INTO posts (description,date,event_id, user_id, image_path) VALUES ('Lorem ipsum dolor sit amet. ','2018-02-12 15:55:12',3,14,'/img/panda.jpg');
INSERT INTO posts (description,date,event_id, user_id, image_path) VALUES ('Lorem ipsum dolor sit amet. ','2018-02-12 15:55:12',4,5,'/img/panda.jpg');
INSERT INTO posts (description,date,event_id, user_id, image_path) VALUES ('Lorem ipsum dolor sit amet. ','2018-01-12 15:55:12',2,16,'/img/panda.jpg');
INSERT INTO posts (description,date,event_id, user_id, image_path) VALUES ('Lorem ipsum dolor sit amet. ','2018-02-12 15:55:12',3,12,'/img/sports.jpg');
INSERT INTO posts (description,date,event_id, user_id, image_path) VALUES ('Lorem ipsum dolor sit amet. ','2018-02-12 15:55:12',1,15,'/img/sports.jpg');
INSERT INTO posts (description,date,event_id, user_id, image_path) VALUES ('Lorem ipsum dolor sit amet. ','2018-02-12 15:55:12',5,12,'/img/sports.jpg');

INSERT INTO polls (post_id) VALUES (1);
INSERT INTO polls (post_id) VALUES (2);
INSERT INTO polls (post_id) VALUES (3);
INSERT INTO polls (post_id) VALUES (4);

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

INSERT INTO friend_requests (sender_id, receiver_id) VALUES (1, 2);
INSERT INTO friend_requests (sender_id, receiver_id) VALUES (3, 4);

INSERT INTO event_invites (event_id, owner_id, receiver_id) VALUES (1, 1, 10);
INSERT INTO event_invites (event_id, owner_id, receiver_id) VALUES (1, 1, 12);