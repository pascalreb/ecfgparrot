
DROP TABLE IF EXISTS car;
CREATE TABLE car (
  id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  brand varchar(50) NOT NULL,
  model varchar(50) NOT NULL,
  year smallint NOT NULL,
  energy varchar(50) NOT NULL,
  kilometers int NOT NULL,
  price int NOT NULL,
  created_at datetime NOT NULL,
  updated_at datetime DEFAULT NULL
);

INSERT INTO car (brand, model, year, energy, kilometers, price) VALUES
('BMW', 'Serie 5 G30', 2020, 'diesel', 87889, 56680),
('BMW', 'X3 F25 phase 2', 2017, 'diesel', 85536, 40000),
('Ford', 'Mustang VI COUPE', 2018, 'essence', 25412, 80000),
('Ford', 'Mustang VI COUPE', 2021, 'essence', 81750, 90000),
('Porsche', 'PANAMERA II SPORT TURISMO', 2018, 'essence', 70456, 95000),
('Porsche', 'PANAMERA II SPORT TURISMO', 2018, 'essence', 70000, 95000),
('Audi', 'Q5 II phase 2', 2022, 'diesel', 25000, 55000),
('Mercedes', 'AMG GT R', 2022, 'essence', 10000, 400000),
('Chevrolet', 'Camaro VI', 2017, 'essence', 85000, 45000);

DROP TABLE IF EXISTS car_equipement;
CREATE TABLE car_equipement (
  car_id int NOT NULL,
  equipement_id int NOT NULL,
  PRIMARY KEY (car_id,equipement_id),
  Foreign Key (car_id) REFERENCES car(car_id),
  Foreign Key (equipement_id) REFERENCES equipement_id(equipement_id)
);

DROP TABLE IF EXISTS contact;
CREATE TABLE contact (
  id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  subject varchar(255) NOT NULL,
  name varchar(50) NOT NULL,
  firstname varchar(50) NOT NULL,
  email varchar(180) NOT NULL,
  phone varchar(255) NOT NULL,
  message longtext NOT NULL,
  created_at datetime NOT NULL,
  car_id int DEFAULT NULL,
  Foreign Key (car_id) REFERENCES car(car_id)
);

INSERT INTO contact (subject, name, firstname, email, phone, message) VALUES
('Maiores et ipsam recusandae itaque. Reprehenderit aut aut maiores quasi et optio natus.', 'Augustin Le Le Gall', 'Martine Poirier', 'auguste.thomas@wanadoo.fr', '0258548324', 'Veritatis voluptas animi quo est ut. Dolores est perferendis veniam magni quisquam pariatur omnis. Et ratione a illum delectus dolor voluptate quo. Non dolorem eum perferendis vitae.'),
('Iste labore ut accusantium et. Nemo aliquid possimus accusamus pariatur eos quo eius.', 'Bernard Antoine', 'Catherine Besnard', 'bernard.lucas@noos.fr', '0150251357', 'Sed laudantium fuga minima ratione. Cupiditate laboriosam ullam accusamus veritatis pariatur incidunt. Enim excepturi quibusdam assumenda. Autem voluptates qui est.'),
('At distinctio ut expedita tenetur. Beatae nihil perferendis sunt. Et natus ipsa accusantium.', 'Grégoire Le Roux', 'Dominique Daniel', 'franck.mahe@sfr.fr', '0263362491', 'Aut doloremque ab quia veritatis. Dolorem consequuntur enim consectetur totam porro. Cumque quia non voluptatem.'),
('Non et minima est dolor ad voluptas. Beatae aperiam ut voluptatem accusantium.', 'Gilbert Gomes', 'Monique Bazin', 'nguyen.elodie@sfr.fr', '0174765115', 'Dolor repellat quaerat modi nisi rerum. Eligendi itaque ut facilis et non. Voluptatem et voluptatem nobis et eius ipsam. Officia et est facere dolorum nostrum corporis nesciunt nemo.'),
('Ullam officiis ut doloribus nihil optio eos neque. Perferendis est non facilis sed.', 'Claire Lebon', 'Claudine du Fournier', 'jerome.vallet@live.com', '0584015938', 'Quis et quis beatae facere. Aut nostrum nulla et ea. In sint dolor similique et totam voluptate sequi.');

DROP TABLE IF EXISTS equipement;
CREATE TABLE equipement (
  id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  name varchar(255) NOT NULL,
);

INSERT INTO equipement (name) VALUES
('Caméra de recul'),
('Radar de recul'),
('Rétroviseurs électriques et dégivrants'),
('Régulateur limiteur de vitesse'),
('Sièges électriques'),
('GPS'),
('Alerte franchissement ligne'),
('Vitres électriques'),
('Bluetooth'),
('Feux automatiques');

DROP TABLE IF EXISTS hour;
CREATE TABLE hour (
  id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  day varchar(50) NOT NULL,
  opening_time1 time NOT NULL,
  closing_time1 time NOT NULL,
  opening_time2 time NOT NULL,
  closing_time2 time NOT NULL,
);

INSERT INTO hour (day, opening_time1, closing_time1, opening_time2, closing_time2) VALUES
('Lundi', '09:00:00', '12:00:00', '14:00:00', '18:00:00'),
('Mardi', '09:00:00', '12:00:00', '14:00:00', '18:00:00'),
('Mercredi', '09:00:00', '12:00:00', '14:00:00', '18:00:00'),
('Jeudi', '09:00:00', '12:00:00', '14:00:00', '18:00:00'),
('Vendredi', '09:00:00', '12:00:00', '14:00:00', '18:00:00'),
('Samedi', '09:00:00', '12:00:00', '00:00:00', '00:00:00');

DROP TABLE IF EXISTS image;
CREATE TABLE image (
  id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  name varchar(255) NOT NULL,
  car_id int DEFAULT NULL,
  Foreign Key (car_id) REFERENCES car(car_id)
);

INSERT INTO image (name) VALUES
('b56a8f4838d22c3f849574ce4a4768e9.jpg'),
('5086708a65c59eb6275d0099c91879df.jpg'),
('fad353176677b507a0883f6403fe5f41.jpg'),
('b48f8b00951f8b14f67370268386a94e.jpg'),
('c12eb4ec6b5e409c862904cf5683823a.jpg'),
('4e684a6c3382ced7aa632245159ac8cc.jpg'),
('5f0cbbe67b7364db6969263dfa1061be.jpg'),
('0db8fc47e2016104f135a16025ea98ee.jpg'),
('41e6e337a782c50ba3de71d4e739f374.jpg'),
('b381f9331f92ef674a126a80337ec50f.jpg'),
('f69e1665ee0cec74cf97fceaecac9148.jpg'),
('473164668aff26a35c283960c4909749.jpg');

DROP TABLE IF EXISTS opinion;
CREATE TABLE opinion (
  id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  name varchar(50) NOT NULL,
  message varchar(255) NOT NULL,
  mark smallint NOT NULL,
  is_approved tinyint(1) DEFAULT NULL,
  created_at datetime NOT NULL,
);

INSERT INTO opinion (name, message, mark, is_approved) VALUES
('Franck Ruiz', 'Neque sed officia officiis aspernatur eos. Ratione et est ullam sequi modi voluptatibus soluta.', 3, 0),
('Corinne Voisin', 'Odio dolores illo sit illo ad. Impedit nobis voluptatum magnam ex molestiae odio.', 1, 1),
('Émile-Thibault Lebrun', 'Doloremque voluptas accusamus sint veniam hic. Velit est minima nam omnis. Fugiat et qui occaecati.', 3, 1),
('Nicolas Carlier-Guerin', 'Numquam nesciunt eos qui corrupti. Deleniti fuga saepe saepe ut non.', 4, 0),
('Alphonse Petit', 'Et doloribus quo animi. Aut minima nam consequatur eos sunt.', 2, 0),
('Gabriel du Chevallier', 'Laborum magnam alias in et minus quis. Doloremque aut aut rerum enim.', 4, 1),
('Michelle de Vincent', 'Rerum rem cumque magni. Quam id consequuntur quod qui quibusdam.', 4, 1),
('Valérie Delaunay', 'Numquam recusandae est minima. Maxime enim voluptate alias et quia voluptatibus eius aut.', 1, 1),
('Marie Samson', 'Ut soluta pariatur commodi nulla. Repellat dolores optio labore nemo fugit numquam.', 3, 1),
('Guillaume Lebrun-Seguin', 'Alias ut veniam corrupti placeat ipsum. Commodi possimus quibusdam debitis iusto quia quos.', 2, 1),
('Mathilde-Valentine Duhamel', 'Ut sed voluptas pariatur iure. Ipsa dolores praesentium enim aut qui.', 2, 1),
('David-Augustin Gonzalez', 'Harum assumenda sunt incidunt et consectetur. Non aut nihil vel id. Quam et et quae debitis autem.', 4, 0),
('Laurent Lacroix', 'Quia et repellat omnis aperiam beatae. Recusandae nesciunt minima beatae amet.', 2, 0),
('Michel Daniel', 'Voluptatem est quas nostrum et. Ratione sunt nisi atque at qui vero repellat.', 5, 0),
('Nicolas Le Martin', 'Et rem sint asperiores. Magni iusto harum expedita adipisci qui quis.', 5, 1),
('Guillaume Lambert', 'Unde ratione rem quis recusandae maxime. Ex possimus ea soluta voluptas beatae error itaque.', 4, 0),
('Denis Maurice', 'Quaerat doloribus magnam suscipit. Enim et eaque qui quia facere sunt et perspiciatis.', 3, 1),
('Valentine Guillou', 'Tenetur neque id fuga. Repudiandae fugiat in iste temporibus sed molestiae.', 4, 1),
('Agnès Baudry', 'Quo beatae est aliquam eum. Accusamus dicta consequatur voluptatem qui sint.', 5, 0),
('Antoine Hernandez-Dufour', 'Tempora magnam distinctio voluptas nesciunt odio non. Rerum perferendis quia quis ea.', 2, 0);

DROP TABLE IF EXISTS user;
CREATE TABLE user (
  id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  email varchar(180) NOT NULL,
  roles json NOT NULL,
  password varchar(255) NOT NULL,
  created_at datetime NOT NULL,
  UNIQUE (email)
);

INSERT INTO user (email, roles) VALUES
('admin@garageparrot.fr', '["ROLE_USER", "ROLE_ADMIN"]'),
('erenault@fournier.com', '["ROLE_USER"]'),
('nicolas53@prevost.net', '["ROLE_USER"]'),
('marine23@yahoo.fr', '["ROLE_USER"]'),
('qboucher@sanchez.fr', '["ROLE_USER"]'),
('knicolas@reynaud.com', '["ROLE_USER"]'),
('marianne15@courtois.fr', '["ROLE_USER"]'),
('dossantos.aurore@hotmail.fr', '["ROLE_USER"]'),
('aurore.marchand@laposte.net', '["ROLE_USER"]'),
('charpentier.isaac@thibault.fr', '["ROLE_USER"]'),
('peltier.maryse@henry.com', '["ROLE_USER"]');
