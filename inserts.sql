
--> INSERTS

-- Here goes the SQL code - INSERTS
 
INSERT INTO countries (id,name) VALUES (1,'Portugal');
INSERT INTO countries (id,name) VALUES (2,'Espanha');
INSERT INTO countries (id,name) VALUES (3,'USA');


INSERT INTO cities (id,name,country_id) VALUES (1,'Braga',1);
INSERT INTO cities (id,name,country_id) VALUES (2,'Porto',1);
INSERT INTO cities (id,name,country_id) VALUES (3,'Lisboa',1);

INSERT INTO localizations (id,name,address,latitude,longitude,city_id) VALUES (1,'Restaurante O Pirata','Rua da Isabelinha',41.452993,-8.5775364,1);
INSERT INTO localizations (id,name,address,latitude,longitude,city_id) VALUES (2,'FEUP','Rua Roberto Frias',41.1779401,-8.5998763,2);
INSERT INTO localizations (id,name,address,latitude,longitude,city_id) VALUES (3,'Parque da BelaVista','Av. Arlindo Vicente',38.7507558,-9.1265431,3);
INSERT INTO localizations (id,name,address,latitude,longitude,city_id) VALUES (4,'Passeio Maritimo de Alges','Alges',38.697318,-9.2375993,3);
INSERT INTO localizations (id,name,address,latitude,longitude,city_id) VALUES (5,'Hotel Douro','Rua de Agramonte',41.1564707,-8.6288115,2);
INSERT INTO localizations (id,name,address,latitude,longitude,city_id) VALUES (6,'Norte shopping','Matosinhos',41.1825143,-8.6803795,2);

INSERT INTO users (id,username,password,email,regist_date,first_name,last_name, image_path,city_id)
			VALUES (1,'sodales','GUL95ZXR9EX','sodales.at@curae.co.uk',NOW(),'Zeph','Griffin','/imgs/natu.jpg',2);
			
			
INSERT INTO users (id,username,password,email,regist_date,first_name,last_name, image_path,city_id)
			VALUES (2,'uso1','12345','aliquam.iaculis.lacus@amet.co.uk',NOW(),'Ben','Warren','/imgs/natur.jpg',1);
			
INSERT INTO users (id,username,password,email,regist_date,first_name,last_name, image_path,city_id)
			VALUES (3,'robin','pass123','amet.ante@faucibusleo.net',NOW(),'Robin','Wright','/imgs/natur.jpg',2);
			
			
INSERT INTO users (id,username,password,email,regist_date,first_name,last_name, image_path,city_id)
			VALUES (4,'bar123','semper123','ut.dolor@gmail.com',NOW(),'Barry','Allen','/imgs/natur.jpg',3);
			
INSERT INTO users (id,username,password,email,regist_date,first_name,last_name, image_path,city_id)
			VALUES (5,'reddevil','LBAW','Nulla@et.net',NOW(),'Andrew','Irons','/imgs/november.jpg',2);
			
INSERT INTO users (id,username,password,email,regist_date,first_name,last_name, image_path,city_id)
			VALUES (6,'rpedro10','lbaw1765','rpedro10@iol.pt',NOW(),'Rui','Araujo','/imgs/fer.jpg',3);
			
						
INSERT INTO users (id,username,password,email,regist_date,first_name,last_name, image_path,city_id)
			VALUES (7,'joss123','CKB15AAW5MM','ante@fleo.com',NOW(),'Joss','Stone','/imgs/natur.jpg',1);
			
INSERT INTO users (id,username,password,email,regist_date,first_name,last_name, image_path,city_id)
			VALUES (8,'top123','SXT16TTW3MH','cursus.et@orciUt.co.uk',NOW(),'Chris','Harris','/imgs/natur.jpg',1);
			
			
INSERT INTO users (id,username,password,email,regist_date,first_name,last_name, image_path,city_id)
			VALUES (9,'roland1','ZYS24FHN5GR','eget.dictum@orciDonec.edu',NOW(),'Roland','Schitt','/imgs/natur.jpg',2);
						
INSERT INTO users (id,username,password,email,regist_date,first_name,last_name, image_path,city_id)
			VALUES (10,'david123','ZUS29FRTGVJ','amet@faucibusleo.net',NOW(),'David','Rose','/imgs/natur.jpg',2);
						
INSERT INTO users (id,username,password,email,regist_date,first_name,last_name, image_path,city_id)
			VALUES (11,'catones', 'QQQ8EFHNGNR','amec.donec@faucibusleo.net',NOW(),'Carlos','Antonio','/imgs/november.jpg',2);
						
INSERT INTO users (id,username,password,email,regist_date,first_name,last_name, image_path,city_id)
			VALUES (12,'emanem','ASDFGHJKL','donex@sapo.net',NOW(),'Raheem','Sterling','/imgs/natur.jpg',3);			
			
INSERT INTO users (id,username,password,email,regist_date,first_name,last_name, image_path,city_id)
			VALUES (13,'ufoExtis','ZXCVBNM','amet@iol.net',NOW(),'Delle','Alli','/imgs/pyr.jpg',2);
						
INSERT INTO users (id,username,password,email,regist_date,first_name,last_name, image_path,city_id)
			VALUES (14,'ragnar','QAZWSXEDC','risus.In.mi@egestas.com',NOW(),'Thor','Ragnarok','/imgs/fer.jpg',1);
						
INSERT INTO users (id,username,password,email,regist_date,first_name,last_name, image_path,city_id)
			VALUES (15,'seth','QWERTYUIOP','aliquet.diam.Sed@tinciduntnibh.co.uk',NOW(),'Seth','Byers','/imgs/natu.jpg',2);
						
INSERT INTO users (id,username,password,email,regist_date,first_name,last_name, image_path,city_id)
			VALUES (16,'edNorton','TYT71DOD7YN','scelerisque.scelerisque.dui@arcuiaculisenim.ca',NOW(),'Ed','Norton','/imgs/natur.jpg',1);
						
INSERT INTO users (id,username,password,email,regist_date,first_name,last_name, image_path,city_id)
			VALUES (17,'Pacquiao','SXT16TTW3MH','magnis@cursuset.edu',NOW(),'Paky','Barret','/imgs/natur.jpg',3);	
			
INSERT INTO users (id,username,password,email,regist_date,first_name,last_name, image_path,city_id)
			VALUES (18,'steven','MPS10QPK6UE','arcu.Vestibulum@amet.org',NOW(),'Donovan','Stevenson','/imgs/pyr.jpg',1);
						
INSERT INTO users (id,username,password,email,regist_date,first_name,last_name, image_path,city_id)
			VALUES (19,'porter123','QIG24ZOK3EM','dui.nec@ultriciesadipiscing.co.uk',NOW(),'Porter','Osborn','/imgs/natu.jpg',2);
						
INSERT INTO users (id,username,password,email,regist_date,first_name,last_name, image_path,city_id)
			VALUES (20,'human','ZYG87WQA6FX','facilisis.magna.tellus@sociis.net',NOW(),'Hu','Randolphe','/imgs/pyr.jpg',2);
					
					
INSERT INTO events (id,name,date,description,owner_id,localization_id,type,category)
			VALUES (1,'Antonys Birthday Party', '2018-12-04 12:30:19.000000', 'nunc ac mattis ornare, lectus',1,1,'Public','Sports');
			
INSERT INTO events (id,name,date,description,owner_id,localization_id,type,category)
			VALUES (2,'ENEI','2018-04-24 12:30:19.000000','Nunc quis arcu vel quam',2,2,'Public','Sports');
			
INSERT INTO events (id,name,date,description,owner_id,localization_id,type,category)
			VALUES (3,'RockInRio','2018-06-04 12:30:19.000000','tempus eu, ligula. Aenean euismod',3,3,'Public','Sports');
			
INSERT INTO events (id,name,date,description,owner_id,localization_id,type,category)
			VALUES (4,'Nos Alive','2018-08-04 12:30:19.000000','dignissim pharetra. Nam ac nulla.',3,4,'Public','Sports');
			
INSERT INTO events (id,name,date,description,owner_id,localization_id,type,category)
			VALUES (5,'Christmas Dinner','2018-10-04 12:30:19.000000','dignissim pharetra. Nam ac nulla.',4,5,'Public','Sports');
			
INSERT INTO events (id,name,date,description,owner_id,localization_id,type,category)
			VALUES (6,'Mark Birthday Party','2018-04-13 12:30:19.000000','dignissim pharetra. Nam ac nulla.',1,1,'Public','Sports');
			
INSERT INTO events (id,name,date,description,owner_id,localization_id,type,category)
			VALUES (7,'WebSummit','2018-04-12 12:30:19.000000','lorem lorem, luctus ut, pellentesque',6,6,'Public','Sports');
			
INSERT INTO events (id,name,date,description,owner_id,localization_id,type,category)
			VALUES (8,'Ted Talk','2018-04-24 12:30:19.000000','sollicitudin orci sem eget massa.',12,2,'Public','Sports');
			
INSERT INTO events (id,name,date,description,owner_id,localization_id,type,category)
			VALUES (9,'Teaches Conference','2018-04-13 12:30:19.000000','dignissim pharetra. Nam ac nulla.',1,1,'Private','Business');
			




INSERT INTO admins (id,username,password,email) VALUES (1,'admin1','password','sapo@iol.pt');


INSERT INTO images (id,event_id,path) VALUES (1,1,'/imgs/natur.jpg');			
INSERT INTO images (id,event_id,path) VALUES (2,2,'/imgs/natu.jpg');			
INSERT INTO images (id,event_id,path) VALUES (3,3,'/imgs/pyr.jpg');			
INSERT INTO images (id,event_id,path) VALUES (4,4,'/imgs/november.jpg');			
INSERT INTO images (id,event_id,path) VALUES (5,5,'/imgs/taj.jpg');			
INSERT INTO images (id,event_id,path) VALUES (6,6,'/imgs/fer.jpg');			
INSERT INTO images (id,event_id,path) VALUES (7,7,'/imgs/fa1.jpg');			
INSERT INTO images (id,event_id,path) VALUES (8,8,'/imgs/fa2.jpg');



			
INSERT INTO dones (event_id,rating)
			VALUES (2,NULL);
INSERT INTO dones (event_id,rating)
			VALUES (7,NULL);
			
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
			

INSERT INTO ratings (id, "value", event_id, user_id)
            VALUES (1, 4, 2, 2);
			
			
INSERT INTO participants (id,user_id,event_id)
			VALUES (1,1,1);
INSERT INTO participants (id,user_id,event_id)
			VALUES (2,2,1);
INSERT INTO participants (id,user_id,event_id)
			VALUES (3,2,2);
INSERT INTO participants (id,user_id,event_id)
			VALUES (4,3,1);			
INSERT INTO participants (id,user_id,event_id)
			VALUES (5,4,1);			
INSERT INTO participants (id,user_id,event_id)
			VALUES (6,5,8);			
INSERT INTO participants (id,user_id,event_id)
			VALUES (7,6,8);			
INSERT INTO participants (id,user_id,event_id)
			VALUES (8,7,3);			
INSERT INTO participants (id,user_id,event_id)
			VALUES (9,12,3);			
INSERT INTO participants (id,user_id,event_id)
			VALUES (10,13,3);			
INSERT INTO participants (id,user_id,event_id)
			VALUES (11,14,3);			
INSERT INTO participants (id,user_id,event_id)
			VALUES (12,15,1);			
INSERT INTO participants (id,user_id,event_id)
			VALUES (13,16,2);			
INSERT INTO participants (id,user_id,event_id)
			VALUES (14,17,3);			
INSERT INTO participants (id,user_id,event_id)
			VALUES (15,18,2);			
INSERT INTO participants (id,user_id,event_id)
			VALUES (16,19,1);			
INSERT INTO participants (id,user_id,event_id)
			VALUES (17,20,3);			
INSERT INTO participants (id,user_id,event_id)
			VALUES (18,12,6);			
INSERT INTO participants (id,user_id,event_id)
			VALUES (19,12,5);			
INSERT INTO participants (id,user_id,event_id)
			VALUES (20,10,4);
INSERT INTO participants (id,user_id,event_id)
			VALUES (21,20,9);
INSERT INTO participants (id,user_id,event_id)
			VALUES (22,19,9);
			
			
INSERT INTO owners (id,user_id,event_id)
			VALUES (1,1,1);
INSERT INTO owners (id,user_id,event_id)
			VALUES (2,2,2);			
INSERT INTO owners (id,user_id,event_id)
			VALUES (3,3,3);			
INSERT INTO owners (id,user_id,event_id)
			VALUES (4,3,4);			
INSERT INTO owners (id,user_id,event_id)
			VALUES (5,5,5);			
INSERT INTO owners (id,user_id,event_id)
			VALUES (6,1,6);			
INSERT INTO owners (id,user_id,event_id)
			VALUES (7,6,7);			
INSERT INTO owners (id,user_id,event_id)
			VALUES (8,12,8);
INSERT INTO owners (id,user_id,event_id)
			VALUES (9,20,9);

INSERT INTO posts (id,description,date,event_id, user_id, image_path) VALUES (1,'Lorem ipsum dolor sit amet. ','2018-02-12 15:55:12',1,1,'/img/new.jpg');
INSERT INTO posts (id,description,date,event_id, user_id, image_path) VALUES (2,'Lorem ipsum dolor sit amet. ','2018-02-12 15:55:12',1,3,'/img/new.jpg');
INSERT INTO posts (id,description,date,event_id, user_id, image_path) VALUES (3,'Lorem ipsum dolor sit amet. ','2018-02-12 15:55:12',1,4,'/img/new.jpg');
INSERT INTO posts (id,description,date,event_id, user_id, image_path) VALUES (4,'Lorem ipsum dolor sit amet. ',NOW(),1,16,'/img/new.jpg');
INSERT INTO posts (id,description,date,event_id, user_id, image_path) VALUES (5,'Lorem ipsum dolor sit amet. ','2018-02-12 15:55:12',2,18,'/img/new.jpg');
INSERT INTO posts (id,description,date,event_id, user_id, image_path) VALUES (6,'Lorem ipsum dolor sit amet. ','2018-02-12 15:55:12',4,10,'/img/panda.jpg');
INSERT INTO posts (id,description,date,event_id, user_id, image_path) VALUES (7,'Lorem ipsum dolor sit amet. ','2018-02-12 15:55:12',3,17,'/img/panda.jpg');
INSERT INTO posts (id,description,date,event_id, user_id, image_path) VALUES (8,'Lorem ipsum dolor sit amet. ','2018-02-12 15:55:12',3,14,'/img/panda.jpg');
INSERT INTO posts (id,description,date,event_id, user_id, image_path) VALUES (9,'Lorem ipsum dolor sit amet. ','2018-02-12 15:55:12',4,5,'/img/panda.jpg');
INSERT INTO posts (id,description,date,event_id, user_id, image_path) VALUES (10,'Lorem ipsum dolor sit amet. ','2018-01-12 15:55:12',2,16,'/img/panda.jpg');
INSERT INTO posts (id,description,date,event_id, user_id, image_path) VALUES (11,'Lorem ipsum dolor sit amet. ','2018-02-12 15:55:12',3,12,'/img/sports.jpg');
INSERT INTO posts (id,description,date,event_id, user_id, image_path) VALUES (12,'Lorem ipsum dolor sit amet. ','2018-02-12 15:55:12',1,15,'/img/sports.jpg');
INSERT INTO posts (id,description,date,event_id, user_id, image_path) VALUES (13,'Lorem ipsum dolor sit amet. ','2018-02-12 15:55:12',5,12,'/img/sports.jpg');

INSERT INTO polls (id,post_id) VALUES (1,1);
INSERT INTO polls (id,post_id) VALUES (2,2);
INSERT INTO polls (id,post_id) VALUES (3,3);
INSERT INTO polls (id,post_id) VALUES (4,4);

INSERT INTO options (id,description,poll_id) VALUES (1,'Bar',1);
INSERT INTO options (id,description,poll_id) VALUES (2,'Cafe',1);
INSERT INTO options (id,description,poll_id) VALUES (3,'Club',1);
INSERT INTO options (id,description,poll_id) VALUES (4,'Home',1);
INSERT INTO options (id,description,poll_id) VALUES (5,'12/05/2018',2);
INSERT INTO options (id,description,poll_id) VALUES (6,'13/05/2018',2);
INSERT INTO options (id,description,poll_id) VALUES (7,'Great',3);
INSERT INTO options (id,description,poll_id) VALUES (8,'Good',3);
INSERT INTO options (id,description,poll_id) VALUES (9,'Available',4);
INSERT INTO options (id,description,poll_id) VALUES (10,'Not Available',4);