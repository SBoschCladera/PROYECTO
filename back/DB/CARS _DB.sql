CREATE DATABASE IF NOT EXISTS cars_DB;

USE cars_DB;

CREATE TABLE IF NOT EXISTS vehicle_type (
     id INT AUTO_INCREMENT NOT NULL,
     name VARCHAR(150) NOT NULL,
     PRIMARY KEY (id)
);

CREATE TABLE IF NOT EXISTS country (
     id INT AUTO_INCREMENT NOT NULL,
     name VARCHAR(150) NOT NULL,
     PRIMARY KEY (id)
);

CREATE TABLE IF NOT EXISTS brand (
     id INT AUTO_INCREMENT NOT NULL,
     name VARCHAR(50) NOT NULL,
     country_id INT NOT NULL,
     logo VARCHAR(150) NOT NULL,
     PRIMARY KEY (id),
     FOREIGN KEY(country_id) REFERENCES country(id)
);

CREATE TABLE IF NOT EXISTS engine_type (
     id INT AUTO_INCREMENT NOT NULL,
     name VARCHAR(50) NOT NULL,
     PRIMARY KEY (id)
);

CREATE TABLE IF NOT EXISTS model (
     id INT AUTO_INCREMENT NOT NULL,
     name VARCHAR(50) NOT NULL,
     series VARCHAR(150) NOT NULL,
     engine_type_id INT NOT NULL,
     release_year YEAR NOT NULL,
     brand_id INT NOT NULL,
     vehicle_type_id INT NOT NULL,
     PRIMARY KEY (id),
     FOREIGN KEY(brand_id) REFERENCES brand(id),
     FOREIGN KEY(engine_type_id) REFERENCES engine_type(id),
     FOREIGN KEY(vehicle_type_id) REFERENCES vehicle_type(id)
);

CREATE TABLE IF NOT EXISTS motorization (
     id INT AUTO_INCREMENT NOT NULL,
     model_id INT NOT NULL,
     engine_type_id INT NOT NULL,
     displacement DECIMAL(4, 2) NOT NULL,
     power INT NOT NULL,
     PRIMARY KEY (id),
     FOREIGN KEY(model_id) REFERENCES model(id),
     FOREIGN KEY(engine_type_id) REFERENCES engine_type(id)
);

CREATE TABLE IF NOT EXISTS benefits (
     id INT AUTO_INCREMENT NOT NULL,
     model_id INT NOT NULL,
     max_velocity INT NOT NULL,
     acceleration_0_100 INT NOT NULL,
     consumption DECIMAL(4, 2) NOT NULL,
     PRIMARY KEY (id),
     FOREIGN KEY(model_id) REFERENCES model(id)
);

CREATE TABLE IF NOT EXISTS user_app (
     id INT AUTO_INCREMENT NOT NULL,
     email VARCHAR(250) NOT NULL,
     password VARCHAR(255) NOT NULL,
     PRIMARY KEY (id)
);

CREATE TABLE IF NOT EXISTS seller_user (
     id INT AUTO_INCREMENT NOT NULL,
     name VARCHAR(250) NOT NULL,
     NIF VARCHAR(10) NOT NULL,
     email VARCHAR(255) NOT NULL,
     phoneNumber VARCHAR(20) NOT NULL,
     user_app_id INT(10) NOT NULL,
     PRIMARY KEY (id),
     FOREIGN KEY (user_app_id) REFERENCES user_app(id)
);

CREATE TABLE IF NOT EXISTS multimedia (
     id INT AUTO_INCREMENT NOT NULL,
     model_id INT NOT NULL,
     photo1 VARCHAR(500) NOT NULL,
     photo2 VARCHAR(500) NOT NULL,
     photo3 VARCHAR(500) NOT NULL,
     photo4 VARCHAR(500) NOT NULL,
     photo5 VARCHAR(500) NOT NULL,
     PRIMARY KEY (id),
     FOREIGN KEY(model_id) REFERENCES model(id)
);

CREATE TABLE IF NOT EXISTS advertisement (
     id INT AUTO_INCREMENT NOT NULL,
     description TEXT NOT NULL,
     price DECIMAL(10, 2) NOT NULL,
     publication_date DATE NOT NULL,
     model_id INT NOT NULL,
     seller_user_id INT NOT NULL,
     color VARCHAR(100),
     km INT(10) NOT NULL,
     multimedia_id INT(10) NOT NULL,
     brand_id INT(10) NOT NULL,
     motorization_id INT(10) NOT NULL,
     benefits_id INT(10) NOT NULL,
     engine_type_id INT(10) NOT NULL,
     PRIMARY KEY (id),
     FOREIGN KEY(model_id) REFERENCES model(id),
     FOREIGN KEY(seller_user_id) REFERENCES seller_user(id),
     FOREIGN KEY(multimedia_id) REFERENCES multimedia(id),
     FOREIGN KEY(brand_id) REFERENCES brand(id),
     FOREIGN KEY(motorization_id) REFERENCES motorization(id),
     FOREIGN KEY(benefits_id) REFERENCES benefits(id),
     FOREIGN KEY(engine_type_id) REFERENCES engine_type(id)
);

-- --------------------------------------------------     INSERTS --------------------------------------------------------------------------- --
USE cars_DB;

-- Insertar registro en la tabla tipo_vehiculo
INSERT INTO
     vehicle_type (name)
VALUES
     ('Automóvil'),
     ('Camioneta'),
     ('Motocicleta');

-- Insertar registro en la tabla pais
INSERT INTO
     country (name)
VALUES
     ('Estados Unidos'),
     ('Alemania'),
     ('Japón'),
     ('Francia'),
     ('Reino Unido'),
     ('España'),
     ('Italia'),
     ('Suecia'),
     ('Corea del Sur'),
     ('Australia'),
     ('Austria');

-- Insertar registro en la tabla marca
INSERT INTO
     brand (name, logo, country_id)
VALUES
     (
          'Toyota',
          "../images/logosImages/toyota-sm.jpg",
          3
     ),
     (
          'Ford',
          "../images/logosImages/ford-sm.jpg",
          1
     ),
     (
          'Volkswagen',
          "../images/logosImages/volkswagen-sm.jpg",
          2
     ),
     (
          'Renault',
          "../images/logosImages/renault-sm.jpg",
          4
     ),
     (
          'Honda',
          "../images/logosImages/honda-sm.jpg",
          3
     ),
     ('BMW', "../images/logosImages/bmw-sm.jpg", 2),
     (
          'Mercedes-Benz',
          "../images/logosImages/mercedes-benz-sm.jpg",
          2
     ),
     (
          'Ferrari',
          "../images/logosImages/ferrari-sm.jpg",
          7
     ),
     (
          'Volvo',
          "../images/logosImages/volvo-sm.jpg",
          8
     ),
     (
          'Nissan',
          "../images/logosImages/nissan-sm.jpg",
          3
     ),
     (
          'Chevrolet',
          "../images/logosImages/chevrolet-sm.jpg",
          1
     ),
     (
          'Hyundai',
          "../images/logosImages/hyundai-sm.jpg",
          9
     ),
     (
          'Mazda',
          "../images/logosImages/mazda-sm.jpg",
          3
     ),
     (
          'Peugeot',
          "../images/logosImages/peugeot-sm.jpg",
          4
     ),
     (
          'Audi',
          "../images/logosImages/audi-sm.jpg",
          2
     ),
     (
          'Lamborghini',
          "../images/logosImages/lamborghini-sm.jpg",
          7
     ),
     (
          'Porsche',
          "../images/logosImages/porsche-sm.jpg",
          2
     ),
     ('Kia', "../images/logosImages/kia-sm.jpg", 9),
     (
          'Subaru',
          "../images/logosImages/subaru-sm.jpg",
          3
     ),
     (
          'Jaguar',
          "../images/logosImages/jaguar-sm.jpg",
          5
     ),
     (
          'Seat',
          '../images/logosImages/seat-sm.jpg',
          6
     ),
     (
          'Dodge',
          '../images/logosImages/dodge-sm.jpg',
          1
     ),
     (
          'Ducati',
          '../images/logosImages/ducati.jpg',
          7
     ),
     ('GMC', '../images/logosImages/gmc-sm.jpg', 1),
     ('KTM', '../images/logosImages/ktm.jpg', 11),
     (
          'Kawasaki',
          '../images/logosImages/kawasaki.jpeg',
          3
     ),
     (
          'Yamaha',
          '../images/logosImages/Yamaha-Logо.png',
          3
     ),
     (
          'Jeep',
          '../images/logosImages/jeep-sm.jpg',
          1
     );

-- Insertar registro en la tabla tipo_motor
INSERT INTO
     engine_type (name)
VALUES
     ('Gasolina'),
     ('Diesel'),
     ('Eléctrico'),
     ('Híbrido');

-- Insertar registro en la tabla modelo
INSERT INTO
     model (
          name,
          series,
          engine_type_id,
          release_year,
          brand_id,
          vehicle_type_id
     )
VALUES
     ('Corolla', 'SE', 1, 2022, 1, 1),
     ('F-150', 'XLT', 2, 2021, 2, 2),
     ('Golf', 'GTI', 1, 2020, 3, 1),
     ('Clio', 'RS', 1, 2021, 4, 1),
     ('Civic', 'Type R', 1, 2022, 5, 1),
     ('X3', 'M', 1, 2021, 6, 1),
     ('AMG GT', 'S', 1, 2022, 7, 1),
     ('488', 'Pista', 1, 2021, 8, 1),
     ('XC90', 'T8', 4, 2022, 9, 1),
     ('GT-R', 'NISMO', 1, 2020, 10, 1),
     ('Camaro', 'SS', 1, 2021, 11, 1),
     ('Santa Fe', 'SEL', 1, 2022, 12, 1),
     ('MX-5', 'RF', 1, 2021, 13, 1),
     ('208', 'GTi', 1, 2021, 14, 1),
     ('A3', 'S', 1, 2022, 15, 1),
     ('Huracán', 'EVO', 1, 2022, 16, 1),
     ('911', 'Turbo S', 1, 2021, 17, 1),
     ('Sportage', 'GT-Line', 1, 2022, 18, 1),
     ('WRX', 'STI', 1, 2020, 19, 1),
     ('A3', '1.5 TFSI COD', 1, 2018, 15, 1),
     ('A4', '2.0 TFSI', 1, 2016, 15, 1),
     ('A Allroad', '2.0 TDI', 2, 2018, 15, 1),
     ('A5', '2.0 TDI', 2, 2017, 15, 1),
     ('A6', '2.0 TDI', 2, 2018, 15, 1),
     ('A7', '3.0 TDI', 2, 2018, 15, 1),
     ('A8', '3.0 TDI', 2, 2018, 15, 1),
     ('Q2', '1.5 TFSI', 1, 2019, 15, 1),
     ('Q3', '2.0 TFSI', 1, 2019, 15, 1),
     ('Q3 Sportback', '2.0 TFSI', 1, 2019, 15, 1),
     ('Q5', '2.0 TDI', 2, 2018, 15, 1),
     ('Q7', '3.0 TDI', 2, 2018, 15, 1),
     ('TT', '2.0 TFSI', 1, 2016, 15, 1),
     ('i3', '33 kWh', 3, 2018, 6, 1),
     ('i8', '1.5 PHEV', 3, 2018, 6, 1),
     ('X1', '2.0 TDI', 2, 2018, 6, 1),
     ('X2', '2.0 TDI', 2, 2018, 6, 1),
     ('X3', '2.0 TDI', 2, 2018, 6, 1),
     ('X4', '2.0 TDI', 2, 2018, 6, 1),
     ('X5', '3.0 TDI', 2, 2018, 6, 1),
     ('X6', '3.0 TDI', 2, 2018, 6, 1),
     ('X7', '3.0 TDI', 2, 2018, 6, 1),
     ('1 Series', '118i', 1, 2018, 6, 1),
     ('2 Series', '218i', 1, 2018, 6, 1),
     ('3 Series', '320i', 1, 2018, 6, 1),
     ('Pilot', 'III', 2, '2022', 5, 1),
     ('Jetta', 'V', 1, '2021', 3, 1),
     ('Golf', 'VII', 2, '2022', 3, 1),
     ('Tiguan', 'I', 1, '2021', 3, 1),
     ('Touareg', 'III', 2, '2022', 3, 1),
     ('C-HR', 'I', 1, '2021', 5, 1),
     ('Camry', 'VII', 2, '2022', 1, 1),
     ('RAV4', 'IV', 1, '2021', 1, 2),
     ('Highlander', 'IV', 2, '2022', 1, 1),
     ('X5', 'III', 1, '2021', 6, 1),
     ('3 Series', 'G20', 2, '2022', 6, 1),
     ('X3', 'III', 1, '2021', 6, 1),
     ('5 Series', 'G30', 2, '2022', 6, 1),
     ('Clio', 'V', 1, '2021', 4, 1),
     ('Megane', 'IV', 2, '2022', 4, 1),
     ('Captur', 'I', 1, '2021', 4, 1),
     ('Kadjar', 'I', 2, '2022', 4, 1),
     ('Fiesta', 'VI', 1, '2021', 2, 1),
     ('Focus', 'IV', 2, '2022', 2, 1),
     ('Kuga', 'III', 1, '2021', 2, 1),
     ('Explorer', 'VI', 2, '2022', 2, 2),
     ('Leon', 'IV', 1, '2021', 21, 1),
     ('Ibiza', 'V', 2, '2022', 21, 1),
     ('Arona', 'I', 1, '2021', 21, 1),
     ('Ateca', 'I', 2, '2022', 21, 1),
     ('S90', 'II', 1, '2021', 9, 1),
     ('CR-V', 'V', 1, '2021', 5, 1),
     ('Civic', 'X', 1, '2021', 5, 1),
     ('Accord', 'XI', 2, '2022', 5, 1),
     ('CX-5', 'KE', 4, '2012', 13, 1),
     ('CR-V', 'RD', 3, '2012', 5, 1),
     ('Rav4', 'XA30', 3, '2005', 1, 1),
     ('Tiguan', '5N', 2, '2007', 3, 1),
     ('EcoSport', 'B515', 4, '2003', 2, 1),
     ('Explorer', 'U502', 1, '2011', 2, 1),
     ('Escape', 'C520', 1, '2012', 2, 1),
     ('Bronco', 'U725', 1, '2020', 2, 1),
     ('Ram', 'DR', 1, '2009', 22, 3),
     ('Wrangler', 'JK', 1, '2006', 28, 1),
     ('Cherokee', 'KL', 1, '2014', 28, 1),
     ('Soul', 'AM', 1, '2008', 18, 1),
     ('Rio', 'JB', 1, '2005', 18, 1),
     ('Sorento', 'BL', 1, '2002', 18, 1),
     ('Cadenza', 'VG', 1, '2009', 18, 1),
     ('C-Class', 'W203', 2, '2000', 7, 1),
     ('E-Class', 'W211', 2, '2002', 7, 1),
     ('GLA-Class', 'X156', 1, '2013', 7, 1),
     ('CL-Class', 'C215', 2, '1999', 7, 1),
     ('Kuga', 'C394', 2, '2008', 2, 1),
     ('Fiesta', 'MK7', 1, '2008', 2, 1),
     ('Focus', 'MK3', 1, '2010', 2, 1),
     ('Mustang', 'S550', 1, '2015', 2, 1),
     ('S60', 'P24', 4, '2010', 9, 1),
     ('XC60', 'Y20', 1, '2008', 9, 1),
     ('XC90', 'P28', 1, '2002', 9, 1),
     ('Golf', 'MK7', 1, '2012', 3, 1),
     ('Passat', 'B8', 2, '2014', 3, 1),
     ('Touareg', '7L', 2, '2002', 3, 1),
     ('Ibiza', 'Cupra', 2, '2022', 21, 1),
     ('Ibiza', 'FR', 2, '2018', 21, 1),
     ('Ibiza', 'FR', 2, '2017', 21, 1),
     ('Ibiza', 'FR', 1, '2019', 21, 1),
     ('Ninja', 'ZX-6R', 1, 2020, 26, 3),
     ('CBR', '1000RR', 1, 2019, 4, 3),
     ('MT', '09', 1, 2019, 26, 3),
     ('SuperSport', 'S', 1, 2017, 25, 3),
     ('Monster', '821', 1, 2018, 23, 3),
     ('Ram 1500', 'DT', 2, '2022', 22, 2),
     ('Ford F-150', 'TW14', 2, '2022', 2, 2),
     ('GMC Sierra 1500', 'T1SC', 1, '2021', 24, 2),
     ('Toyota Tundra', 'XK80', 1, '2022', 1, 1),
     (
          'Chevrolet Silverado 1500',
          'T1SC',
          3,
          '2021',
          11,
          2
     );

-- Insertar registro en la tabla motorizacion
INSERT INTO
     motorization (model_id, engine_type_id, displacement, power)
VALUES
     (1, 1, 1.8, 169),
     (2, 2, 1.5, 395),
     (3, 1, 2.0, 220),
     (4, 1, 1.8, 220),
     (5, 1, 2.0, 306),
     (6, 1, 3.0, 473),
     (7, 1, 4.0, 720),
     (8, 1, 3.9, 710),
     (9, 4, 2.0, 400),
     (10, 1, 3.8, 600),
     (11, 1, 6.2, 455),
     (12, 1, 2.5, 261),
     (13, 1, 2.0, 181),
     (14, 1, 1.6, 208),
     (15, 1, 2.0, 300),
     (16, 1, 5.2, 631),
     (17, 1, 3.8, 640),
     (18, 1, 1.6, 174),
     (19, 1, 2.5, 310),
     (20, 1, 1.5, 148),
     (21, 1, 2.0, 190),
     (22, 2, 2.0, 190),
     (23, 2, 2.0, 190),
     (24, 2, 2.0, 190),
     (25, 2, 3.0, 218),
     (26, 2, 3.0, 218),
     (27, 1, 1.5, 150),
     (28, 1, 2.0, 190),
     (29, 1, 2.0, 190),
     (30, 2, 2.0, 190),
     (31, 2, 3.0, 218),
     (32, 1, 2.0, 230),
     (33, 3, 33.0, 166),
     (34, 3, 1.5, 145),
     (35, 2, 2.0, 190),
     (36, 2, 2.0, 190),
     (37, 2, 2.0, 190),
     (38, 2, 3.0, 218),
     (39, 2, 3.0, 218),
     (40, 2, 3.0, 218),
     (41, 2, 1.5, 136),
     (42, 1, 1.5, 136),
     (43, 1, 2.0, 184),
     (44, 1, 3.5, 280),
     (45, 2, 1.4, 150),
     (46, 1, 2.0, 245),
     (47, 2, 1.4, 150),
     (48, 1, 3.0, 367),
     (49, 2, 1.2, 116),
     (50, 1, 2.5, 206),
     (51, 2, 2.5, 203),
     (52, 1, 1.6, 120),
     (53, 2, 1.8, 160),
     (54, 1, 2.0, 190),
     (55, 2, 2.5, 262),
     (56, 1, 2.0, 190),
     (57, 2, 1.0, 91),
     (58, 1, 1.3, 140),
     (59, 2, 1.0, 100),
     (60, 1, 1.3, 140),
     (61, 2, 1.0, 90),
     (62, 1, 1.5, 130),
     (63, 2, 1.5, 120),
     (64, 1, 2.5, 180),
     (65, 2, 1.5, 110),
     (66, 1, 1.0, 90),
     (67, 2, 1.0, 100),
     (68, 1, 2.0, 150),
     (69, 2, 2.0, 190),
     (70, 1, 1.5, 130),
     (71, 1, 1.0, 120),
     (72, 1, 2.0, 190),
     (73, 2, 2.5, 170),
     (74, 4, 2.4, 166),
     (75, 3, 2.4, 161),
     (76, 3, 2.0, 140),
     (77, 2, 1.5, 110),
     (78, 4, 3.5, 290),
     (79, 1, 3.0, 240),
     (80, 1, 2.7, 310),
     (81, 1, 5.7, 345),
     (82, 1, 3.8, 205),
     (83, 1, 3.2, 271),
     (84, 1, 1.6, 122),
     (85, 1, 4.7, 288),
     (86, 1, 3.5, 290),
     (87, 1, 2.2, 148),
     (88, 2, 3.2, 221),
     (89, 2, 2.0, 211),
     (90, 1, 5.5, 493),
     (91, 2, 2.5, 200),
     (92, 2, 1.2, 82),
     (93, 1, 2.0, 250),
     (94, 1, 5.0, 460),
     (95, 1, 3.0, 300),
     (96, 1, 3.0, 285),
     (97, 4, 2.5, 210),
     (98, 1, 1.4, 122),
     (99, 1, 2.0, 240),
     (100, 1, 4.2, 310),
     (101, 2, 2.0, 296),
     (102, 2, 1.5, 150),
     (103, 2, 1.4, 150),
     (104, 2, 1.5, 150),
     (105, 2, 0.64, 130),
     (106, 1, 1.0, 191),
     (107, 1, 0.85, 115),
     (108, 1, 0.94, 110),
     (109, 1, 0.82, 109),
     (110, 1, 5.7, 395),
     (111, 1, 3.5, 400),
     (112, 2, 6.2, 420),
     (113, 2, 5.7, 381),
     (114, 1, 5.3, 355),
     (115, 1, 2.8, 221),
     (116, 3, 5.8, 362);

-- Insertar registro en la tabla prestaciones
INSERT INTO
     benefits (
          model_id,
          max_velocity,
          acceleration_0_100,
          consumption
     )
VALUES
     (1, 180, 10, 7.5),
     (2, 200, 8, 9.2),
     (3, 250, 6.5, 8.3),
     (4, 230, 7.2, 7.9),
     (5, 270, 5.8, 9.5),
     (6, 280, 5.5, 11.2),
     (7, 310, 4.8, 12.5),
     (8, 340, 3.5, 15.2),
     (9, 220, 8.5, 5.5),
     (10, 320, 5.2, 10.5),
     (11, 240, 7.8, 8.1),
     (12, 210, 9.5, 6.9),
     (13, 230, 7.2, 8.2),
     (14, 250, 6.8, 7.8),
     (15, 280, 5.7, 10.2),
     (16, 330, 4.2, 13.8),
     (17, 320, 4.5, 14.1),
     (18, 200, 8.9, 5.9),
     (19, 260, 6.5, 9.8),
     (20, 210, 9.2, 6.5),
     (21, 240, 7.3, 6.5),
     (22, 214, 8.7, 5.2),
     (23, 230, 7.9, 4.7),
     (24, 220, 8.4, 4.8),
     (25, 245, 5.7, 5.3),
     (26, 250, 5.9, 5.6),
     (27, 205, 9.6, 6.0),
     (28, 215, 7.8, 6.7),
     (29, 216, 7.8, 6.7),
     (30, 212, 8.4, 5.6),
     (31, 233, 6.3, 6.3),
     (32, 250, 5.9, 6.2),
     (33, 150, 8.0, 0),
     (34, 250, 4.4, 1.9),
     (35, 220, 7.7, 5.5),
     (36, 220, 7.8, 5.4),
     (37, 215, 8.0, 5.5),
     (38, 235, 6.5, 6.0),
     (39, 230, 6.5, 6.0),
     (40, 230, 6.5, 6.0),
     (41, 212, 8.5, 6.3),
     (42, 220, 8.4, 6.1),
     (43, 235, 7.2, 5.9),
     (44, 200, 9.2, 8.7),
     (45, 198, 8.2, 6.1),
     (46, 210, 7.8, 5.6),
     (47, 197, 10.9, 7.5),
     (48, 238, 6.1, 8.8),
     (49, 180, 10.9, 5.7),
     (50, 223, 8.3, 6.0),
     (51, 180, 8.4, 5.7),
     (52, 230, 7.7, 7.4),
     (53, 250, 6.1, 8.6),
     (54, 250, 6.1, 8.7),
     (55, 240, 6.8, 6.8),
     (56, 250, 5.9, 7.3),
     (57, 185, 9.6, 5.6),
     (58, 190, 8.7, 6.0),
     (59, 171, 10.4, 5.4),
     (60, 183, 9.9, 6.1),
     (61, 180, 12, 6.0),
     (62, 200, 8, 7.2),
     (63, 190, 10, 5.5),
     (64, 210, 7, 9.0),
     (65, 185, 9, 6.5),
     (66, 195, 8, 7.0),
     (67, 175, 11, 5.0),
     (68, 200, 9, 7.5),
     (69, 240, 6, 8.5),
     (70, 190, 9, 7.0),
     (71, 210, 8, 6.5),
     (72, 230, 7, 8.0),
     (73, 210, 8, 8.0),
     (74, 190, 9, 7.5),
     (75, 180, 10, 6.0),
     (76, 200, 9, 7.2),
     (77, 160, 13, 9.5),
     (78, 190, 10, 8.0),
     (79, 180, 11, 7.0),
     (80, 200, 8, 10.0),
     (81, 180, 10, 12.5),
     (82, 172, 10, 13.2),
     (83, 200, 8, 11.8),
     (84, 185, 11, 9.5),
     (85, 200, 9, 10.2),
     (86, 230, 7, 11.8),
     (87, 250, 7, 14.2),
     (88, 250, 6, 13.8),
     (89, 220, 9, 8.9),
     (90, 250, 6, 15.5),
     (91, 210, 8, 11.2),
     (92, 190, 9, 9.8),
     (93, 230, 8, 10.5),
     (94, 250, 5, 13.5),
     (95, 240, 7, 11.6),
     (96, 230, 8, 12.2),
     (97, 215, 9, 14.5),
     (98, 200, 9, 8.6),
     (99, 210, 8, 9.2),
     (100, 240, 8, 12.8),
     (101, 245, 6.7, 7.5),
     (102, 230, 7.2, 6.9),
     (103, 225, 7.5, 7.1),
     (104, 230, 7.0, 7.0),
     (105, 248, 3.0, 5.5),
     (106, 299, 2.6, 6.5),
     (107, 225, 3.0, 5.0),
     (108, 250, 3.5, 6.0),
     (109, 225, 3.5, 6.2),
     (110, 180, 9.5, 13.5),
     (111, 185, 9.0, 12.5),
     (112, 180, 9.5, 13.0),
     (113, 180, 9.0, 14.0),
     (114, 180, 9.5, 13.0),
     (115, 178, 12.8, 13.4),
     (116, 198, 19.5, 8.7);

-- Insertar registro en la tabla usuario_app
INSERT INTO
     user_app (email, password)
VALUES
     ('juangarcia@example.com', 'secreto123'),
     ('mariahernandez@example.com', 'clave456'),
     ('pedrosanchez@example.com', 'secreto123'),
     ('luciagomez@example.com', 'secreto123'),
     ('carlosmartinez@example.com', 'secreto123'),
     ('anaperez@example.com', 'secreto123'),
     ('javierlopez@example.com', 'secreto123'),
     ('lauraruiz@example.com', 'secreto123'),
     ('davidfernandez@example.com', 'secreto123'),
     ('sofiagutierrez@example.com', 'secreto123'),
     ('miguelgonzalez@example.com', 'secreto123'),
     ('carmensantos@example.com', 'secreto123'),
     ('franciscocastillo@example.com', 'secreto123'),
     ('elenaramirez@example.com', 'secreto123'),
     ('antonioserrano@example.com', 'secreto123'),
     ('info@automovileslopez.com', 'secreto123'),
     ('ventas@autoslocos.com', 'secreto123'),
     ('info@motorshop.com', 'secreto123'),
     ('ventas@coolauto.com', 'secreto123'),
     ('info@automovilesmigjorn.com', 'secreto123');

-- Insertar registro en la tabla propietario
INSERT INTO
     seller_user (name, NIF, email, phoneNumber, user_app_id)
VALUES
     (
          'Juan García',
          '12345678A',
          'juangarcia@example.com',
          '555-1234',
          1
     ),
     (
          'María Hernández',
          'X7894561B',
          'mariahernandez@example.com',
          '555-5678',
          2
     ),
     (
          'Pedro Sánchez',
          '45678923C',
          'pedrosanchez@example.com',
          '555-9012',
          3
     ),
     (
          'Lucía Gómez',
          'H9876543D',
          'luciagomez@example.com',
          '555-3456',
          4
     ),
     (
          'Carlos Martínez',
          '65432187E',
          'carlosmartinez@example.com',
          '555-7890',
          5
     ),
     (
          'Ana Pérez',
          'R3214567F',
          'anaperez@example.com',
          '555-2345',
          6
     ),
     (
          'Javier López',
          'Y8967453G',
          'javierlopez@example.com',
          '555-6789',
          7
     ),
     (
          'Laura Ruiz',
          'L9874562H',
          'lauraruiz@example.com',
          '555-0123',
          8
     ),
     (
          'David Fernández',
          'M2345671J',
          'davidfernandez@example.com',
          '555-4567',
          9
     ),
     (
          'Sofía Gutiérrez',
          'S3456789K',
          'sofiagutierrez@example.com',
          '555-8901',
          10
     ),
     (
          'Miguel González',
          'Z8765432L',
          'miguelgonzalez@example.com',
          '555-2345',
          11
     ),
     (
          'Carmen Santos',
          'T4567123M',
          'carmensantos@example.com',
          '555-6789',
          12
     ),
     (
          'Francisco Castillo',
          'Q9876543N',
          'franciscocastillo@example.com',
          '555-0123',
          13
     ),
     (
          'Elena Ramírez',
          'W1234567P',
          'elenaramirez@example.com',
          '555-4567',
          14
     ),
     (
          'Antonio Serrano',
          'V4567891R',
          'antonioserrano@example.com',
          '555-8901',
          15
     ),
     (
          'Automóviles López',
          'A28001468 ',
          'info@automovileslopez.com',
          '+1 555-1111',
          16
     ),
     (
          'Autos Locos',
          'B58073191 ',
          'ventas@autoslocos.com',
          '+1 555-2222',
          17
     ),
     (
          'Motor Shop',
          'J65598208 ',
          'info@motorshop.com',
          '+1 555-3333',
          18
     ),
     (
          'CoolAuto',
          'N0826302F ',
          'ventas@coolauto.com',
          '+1 555-4444',
          19
     ),
     (
          'Automóviles Migjorn',
          'G78328535 ',
          'info@automovilesmigjorn.com',
          '+1 555-5555',
          20
     );

INSERT INTO
     multimedia (model_id, photo1, photo2, photo3, photo4, photo5)
VALUES
     (
          1,
          '../images/advertisementImages/TOYOTA-Corolla-EU-6511_20.jpg',
          '../images/advertisementImages/TOYOTA-Corolla-EU-6511_13.jpg',
          '../images/advertisementImages/TOYOTA-Corolla-EU-6511_18.jpg',
          '../images/advertisementImages/TOYOTA-Corolla-EU-6511_12.jpg',
          '../images/advertisementImages/TOYOTA-Corolla-EU-6511_31.jpg'
     ),
     (
          2,
          '../images/advertisementImages/FORD-F-150-Super-Crew-4069_23.jpg',
          '../images/advertisementImages/FORD-F-150-Super-Crew-4069_30.jpg',
          '../images/advertisementImages/FORD-F-150-Super-Crew-4069_31',
          '../images/advertisementImages/FORD-F-150-Super-Crew-4069_38',
          '../images/advertisementImages/FORDF-150SuperCrew-4069_17.jpg'
     ),
     (
          3,
          '../images/advertisementImages/VOLKSWAGEN-Golf-VIII-GTE-6751_8.jpg',
          '../images/advertisementImages/VOLKSWAGEN-Golf-VIII-GTE-6751_12.jpg',
          '../images/advertisementImages/VOLKSWAGEN-Golf-VIII-GTE-6751_13.jpg',
          '../images/advertisementImages/VOLKSWAGEN-Golf-VIII-GTE-6751_1.jpg',
          '../images/advertisementImages/VOLKSWAGEN-Golf-VIII-GTE-6751_2.jpg'
     ),
     (
          4,
          '../images/advertisementImages/RENAULT-Clio-RS-4789_27.jpg',
          '../images/advertisementImages/RENAULTClioRS-4789_5.jpg',
          '../images/advertisementImages/RENAULTClioRS-4789_9.jpg',
          '../images/advertisementImages/RENAULTClioRS-4789_12.jpg',
          '../images/advertisementImages/RENAULTClioRS-4789_21.jpg'
     ),
     (
          5,
          '../images/advertisementImages/honda-civic-type-r-2022-7347_7.jpg',
          '../images/advertisementImages/honda-civic-type-r-2022-7347_8.jpg',
          '../images/advertisementImages/honda-civic-type-r-2022-7347_9.jpg',
          '../images/advertisementImages/honda-civic-type-r-2022-7347_1.jpg',
          '../images/advertisementImages/honda-civic-type-r-2022-7347_2.jpg'
     ),
     (
          6,
          '../images/advertisementImages/bmw-x3-m-2021-7121_16.jpg',
          '../images/advertisementImages/bmw-x3-m-2021-7121_15.jpg',
          '../images/advertisementImages/bmw-x3-m-2021-7121_24.jpg',
          '../images/advertisementImages/bmw-x3-m-2021-7121_13.jpg',
          '../images/advertisementImages/bmw-x3-m-2021-7121_6.jpg'
     ),
     (
          7,
          '../images/advertisementImages/Mercedes-AMG-GT-Coupe--C190--6892_6.jpg',
          '../images/advertisementImages/Mercedes-AMG-GT-Coupe--C190--6892_7.jpg',
          '../images/advertisementImages/Mercedes-AMG-GT-Coupe--C190--6892_8.jpg',
          '../images/advertisementImages/Mercedes-AMG-GT-Coupe--C190--6892_3.jpg',
          '../images/advertisementImages/Mercedes-AMG-GT-Coupe--C190--6892_1.jpg'
     ),
     (
          8,
          '../images/advertisementImages/FERRARI-488-Pista-6247_4.jpg',
          '../images/advertisementImages/FERRARI-488-Pista-6247_3.jpg',
          '../images/advertisementImages/FERRARI-488-Pista-6247_6.jpg',
          '../images/advertisementImages/FERRARI-488-Pista-6247_7.jpg',
          '../images/advertisementImages/FERRARI-488-Pista-6247_2.jpg'
     ),
     (
          9,
          '../images/advertisementImages/VOLVO-XC60-5945_14.jpg',
          '../images/advertisementImages/VOLVO-XC60-5945_13.jpg',
          '../images/advertisementImages/VOLVO-XC60-5945_11.jpg',
          '../images/advertisementImages/VOLVO-XC60-5945_10.jpg',
          '../images/advertisementImages/VOLVO-XC60-5945_7.jpg'
     ),
     (
          10,
          '../images/advertisementImages/nissan-gt-r-nismo-2023-7366_12.jpg',
          '../images/advertisementImages/nissan-gt-r-nismo-2023-7366_13.jpg',
          '../images/advertisementImages/nissan-gt-r-nismo-2023-7366_18.jpg',
          '../images/advertisementImages/nissan-gt-r-nismo-2023-7366_7.jpg',
          '../images/advertisementImages/nissan-gt-r-nismo-2023-7366_9.jpg'
     ),
     (
          11,
          '../images/advertisementImages/CHEVROLET-Camaro-6318_6.jpg',
          '../images/advertisementImages/CHEVROLET-Camaro-6318_5.jpg',
          '../images/advertisementImages/CHEVROLET-Camaro-6318_4.jpg',
          '../images/advertisementImages/CHEVROLET-Camaro-6318_3.jpg',
          '../images/advertisementImages/CHEVROLET-Camaro-6318_2.jpg'
     ),
     (
          12,
          '../images/advertisementImages/HYUNDAI-Santa-Fe-6834_7.jpg',
          '../images/advertisementImages/HYUNDAI-Santa-Fe-6834_6.jpg',
          '../images/advertisementImages/HYUNDAI-Santa-Fe-6834_8.jpg',
          '../images/advertisementImages/HYUNDAI-Santa-Fe-6834_9.jpg',
          '../images/advertisementImages/HYUNDAI-Santa-Fe-6834_10.jpg'
     ),
     (
          13,
          '../images/advertisementImages/MAZDA-MX-5---Miata-RF-5780_1.jpg',
          '../images/advertisementImages/MAZDA-MX-5---Miata-RF-5780_4.jpg',
          '../images/advertisementImages/MAZDA-MX-5---Miata-RF-5780_2.jpg',
          '../images/advertisementImages/MAZDA-MX-5---Miata-RF-5780_3.jpg',
          '../images/advertisementImages/MAZDA-MX-5---Miata-RF-5780_5.jpg'
     ),
     (
          14,
          '../images/advertisementImages/PEUGEOT-208-5-doors-6676_22.jpg',
          '../images/advertisementImages/PEUGEOT-208-5-doors-6676_21.jpg',
          '../images/advertisementImages/PEUGEOT-208-5-doors-6676_19.jpg',
          '../images/advertisementImages/PEUGEOT-208-5-doors-6676_55.jpg',
          '../images/advertisementImages/PEUGEOT-208-5-doors-6676_57.jpg'
     ),
     (
          15,
          '../images/advertisementImages/AUDI-S3-5813_4.jpg',
          '../images/advertisementImages/AUDI-S3-5813_1.jpg',
          '../images/advertisementImages/AUDI-S3-5813_6.jpg',
          '../images/advertisementImages/AUDI-S3-5813_11.jpg',
          '../images/advertisementImages/AUDI-S3-5813_14.jpg'
     ),
     (
          16,
          '../images/advertisementImages/LAMBORGHINI-Evo-6471_3.jpg',
          '../images/advertisementImages/LAMBORGHINI-Evo-6471_5.jpg',
          '../images/advertisementImages/LAMBORGHINI-Evo-6471_6.jpg',
          '../images/advertisementImages/LAMBORGHINI-Evo-6471_7.jpg',
          '../images/advertisementImages/LAMBORGHINI-Evo-6471_8.jpg'
     ),
     (
          17,
          '../images/advertisementImages/PORSCHE-911-Turbo-S--992--6785_9.jpg',
          '../images/advertisementImages/PORSCHE-911-Turbo-S--992--6785_7.jpg',
          '../images/advertisementImages/PORSCHE-911-Turbo-S--992--6785_6.jpg',
          '../images/advertisementImages/PORSCHE-911-Turbo-S--992--6785_10.jpg',
          '../images/advertisementImages/PORSCHE-911-Turbo-S--992--6785_12.jpg'
     ),
     (
          18,
          '../images/advertisementImages/kia-sportage-hev-2022-7292_41.jpg',
          '../images/advertisementImages/kia-sportage-hev-2022-7292_43.jpg',
          '../images/advertisementImages/kia-sportage-hev-2022-7292_38.jpg',
          '../images/advertisementImages/kia-sportage-hev-2022-7292_37.jpg',
          '../images/advertisementImages/kia-sportage-hev-2022-7292_33.jpg'
     ),
     (
          19,
          '../images/advertisementImages/subaru-wrx-2021-7166_18.jpg',
          '../images/advertisementImages/subaru-wrx-2021-7166_19.jpg',
          '../images/advertisementImages/subaru-wrx-2021-7166_20.jpg',
          '../images/advertisementImages/subaru-wrx-2021-7166_22.jpg',
          '../images/advertisementImages/subaru-wrx-2021-7166_45.jpg'
     ),
     (
          20,
          '../images/advertisementImages/AUDI-A3-Sedan-6806_18.jpg',
          '../images/advertisementImages/AUDI-A3-Sedan-6806_16.jpg',
          '../images/advertisementImages/AUDI-A3-Sedan-6806_19.jpg',
          '../images/advertisementImages/AUDI-A3-Sedan-6806_21.jpg',
          '../images/advertisementImages/AUDI-A3-Sedan-6806_35.jpg'
     ),
     (
          21,
          '../images/advertisementImages/AUDI-A4-6631_15.jpg',
          '../images/advertisementImages/AUDI-A4-6631_165.jpg',
          '../images/advertisementImages/AUDI-A4-6631_17.jpg',
          '../images/advertisementImages/AUDI-A4-6631_18.jpg',
          '../images/advertisementImages/AUDI-A4-6631_19.jpg'
     ),
     (
          22,
          '../images/advertisementImages/AUDI-A6-allroad-quattro-6593_4.jpg',
          '../images/advertisementImages/AUDI-A6-allroad-quattro-6593_5.jpg',
          '../images/advertisementImages/AUDI-A6-allroad-quattro-6593_6.jpg',
          '../images/advertisementImages/AUDI-A6-allroad-quattro-6593_9.jpg',
          '../images/advertisementImages/AUDI-A6-allroad-quattro-6593_12.jpg'
     ),
     (
          23,
          '../images/advertisementImages/AUDI-A5-5718_38.jpg',
          '../images/advertisementImages/AUDI-A5-5718_14.jpg',
          '../images/advertisementImages/AUDI-A5-5718_37.jpg',
          '../images/advertisementImages/AUDI-A5-5718_1.jpg',
          '../images/advertisementImages/AUDI-A5-5718_4.jpg'
     ),
     (
          24,
          '../images/advertisementImages/AUDI-S6-Avant-6553_12.jpg',
          '../images/advertisementImages/AUDI-S6-Avant-6553_11.jpg',
          '../images/advertisementImages/AUDI-S6-Avant-6553_13.jpg',
          '../images/advertisementImages/AUDI-S6-Avant-6553_17.jpg',
          '../images/advertisementImages/AUDI-S6-Avant-6553_19.jpg'
     ),
     (
          25,
          '../images/advertisementImages/AUDI-A7-Sportback-6152_4.jpg',
          '../images/advertisementImages/AUDI-A7-Sportback-6152_8.jpg',
          '../images/advertisementImages/AUDI-A7-Sportback-6152_10.jpg',
          '../images/advertisementImages/AUDI-A7-Sportback-6152_14.jpg',
          '../images/advertisementImages/AUDI-A7-Sportback-6152_15.jpg'
     ),
     (
          26,
          '../images/advertisementImages/audi-a8-2021-7190_37.jpg',
          '../images/advertisementImages/audi-a8-2021-7190_38.jpg',
          '../images/advertisementImages/audi-a8-2021-7190_40.jpg',
          '../images/advertisementImages/audi-a8-2021-7190_36.jpg',
          '../images/advertisementImages/audi-a8-2021-7190_7.jpg'
     ),
     (
          27,
          '../images/advertisementImages/AUDI-Q2-6920_16.jpg',
          '../images/advertisementImages/AUDI-Q2-6920_15.jpg',
          '../images/advertisementImages/AUDI-Q2-6920_18.jpg',
          '../images/advertisementImages/AUDI-Q2-6920_19.jpg',
          '../images/advertisementImages/AUDI-Q2-6920_21.jpg'
     ),
     (
          28,
          '../images/advertisementImages/AUDI-Q3-6385_8.jpg',
          '../images/advertisementImages/AUDI-Q3-6385_9.jpg',
          '../images/advertisementImages/AUDI-Q3-6385_10.jpg',
          '../images/advertisementImages/AUDI-Q3-6385_11.jpg',
          '../images/advertisementImages/AUDI-Q3-6385_13.jpg'
     ),
     (
          29,
          '../images/advertisementImages/AUDI-Q3-Sportback-6634_24.jpg',
          '../images/advertisementImages/AUDI-Q3-Sportback-6634_26.jpg',
          '../images/advertisementImages/AUDI-Q3-Sportback-6634_27.jpg',
          '../images/advertisementImages/AUDI-Q3-Sportback-6634_28.jpg',
          '../images/advertisementImages/AUDI-Q3-Sportback-6634_37.jpg'
     ),
     (
          30,
          '../images/advertisementImages/AUDI-Q5-6870_22.jpg',
          '../images/advertisementImages/AUDI-Q5-6870_17.jpg',
          '../images/advertisementImages/AUDI-Q5-6870_11.jpg',
          '../images/advertisementImages/AUDI-Q5-6870_13.jpg',
          '../images/advertisementImages/AUDI-Q5-6870_15.jpg'
     ),
     (
          31,
          '../images/advertisementImages/AUDI-Q7-6609_5.jpg',
          '../images/advertisementImages/AUDI-Q7-6609_7.jpg',
          '../images/advertisementImages/AUDI-Q7-6609_8.jpg',
          '../images/advertisementImages/AUDI-Q7-6609_9.jpg',
          '../images/advertisementImages/AUDI-Q7-6609_18.jpg'
     ),
     (
          32,
          '../images/advertisementImages/audi-tts-coupe-competition-plus-2020-6983_9.jpg',
          '../images/advertisementImages/audi-tts-coupe-competition-plus-2020-6983_10.jpg',
          '../images/advertisementImages/audi-tts-coupe-competition-plus-2020-6983_14.jpg',
          '../images/advertisementImages/audi-tts-coupe-competition-plus-2020-6983_11.jpg',
          '../images/advertisementImages/audi-tts-coupe-competition-plus-2020-6983_12.jpg'
     ),
     (
          33,
          '../images/advertisementImages/BMW-i3-6095_10.jpg',
          '../images/advertisementImages/BMW-i3-6095_18.jpg',
          '../images/advertisementImages/BMW-i3-6095_9.jpg',
          '../images/advertisementImages/BMW-i3-6095_11.jpg',
          '../images/advertisementImages/BMW-i3-6095_29.jpg'
     ),
     (
          34,
          '../images/advertisementImages/BMW-i8-6183_10.jpg',
          '../images/advertisementImages/BMW-i8-6183_2.jpg',
          '../images/advertisementImages/BMW-i8-6183_9.jpg',
          '../images/advertisementImages/BMW-i8-6183_11.jpg',
          '../images/advertisementImages/BMW-i8-6183_18.jpg'
     ),
     (
          35,
          '../images/advertisementImages/bmw-x1-2022-7284_29.jpg',
          '../images/advertisementImages/bmw-x1-2022-7284_28.jpg',
          '../images/advertisementImages/bmw-x1-2022-7284_31.jpg',
          '../images/advertisementImages/bmw-x1-2022-7284_61.jpg',
          '../images/advertisementImages/bmw-x1-2022-7284_42.jpg'
     ),
     (
          36,
          '../images/advertisementImages/BMW-X2--F39--6154_13.jpg',
          '../images/advertisementImages/BMW-X2--F39--6154_14.jpg',
          '../images/advertisementImages/BMW-X2--F39--6154_11.jpg',
          '../images/advertisementImages/BMW-X2--F39--6154_20.jpg',
          '../images/advertisementImages/BMW-X2--F39--6154_39.jpg'
     ),
     (
          37,
          '../images/advertisementImages/bmw-x3-2021-7119_94.jpg',
          '../images/advertisementImages/bmw-x3-2021-7119_25.jpg',
          '../images/advertisementImages/bmw-x3-2021-7119_5.jpg',
          '../images/advertisementImages/bmw-x3-2021-7119_8.jpg',
          '../images/advertisementImages/bmw-x3-2021-7119_11.jpg'
     ),
     (
          38,
          '../images/advertisementImages/bmw-x4-2021-7120_18.jpg',
          '../images/advertisementImages/bmw-x4-2021-7120_17.jpg',
          '../images/advertisementImages/bmw-x4-2021-7120_34.jpg',
          '../images/advertisementImages/bmw-x4-2021-7120_13.jpg',
          '../images/advertisementImages/bmw-x4-2021-7120_4.jpg'
     ),
     (
          39,
          '../images/advertisementImages/bmw-x5-m-competition-2023-7430_76.jpg',
          '../images/advertisementImages/bmw-x5-m-competition-2023-7430_33.jpg',
          '../images/advertisementImages/bmw-x5-m-competition-2023-7430_48.jpg',
          '../images/advertisementImages/bmw-x5-m-competition-2023-7430_1.jpg',
          '../images/advertisementImages/bmw-x5-m-competition-2023-7430_49.jpg'
     ),
     (
          40,
          '../images/advertisementImages/bmw-x6-2023-7414_44.jpg',
          '../images/advertisementImages/bmw-x6-2023-7414_17.jpg',
          '../images/advertisementImages/bmw-x6-2023-7414_22.jpg',
          '../images/advertisementImages/bmw-x6-2023-7414_23.jpg',
          '../images/advertisementImages/bmw-x6-2023-7414_20.jpg'
     ),
     (
          41,
          '../images/advertisementImages/bmw-x7-2022-7264_143.jpg',
          '../images/advertisementImages/bmw-x7-2022-7264_108.jpg',
          '../images/advertisementImages/bmw-x7-2022-7264_46.jpg',
          '../images/advertisementImages/bmw-x7-2022-7264_44.jpg',
          '../images/advertisementImages/bmw-x7-2022-7264_45.jpg'
     ),
     (
          42,
          '../images/advertisementImages/BMW-1-Series-6581_73.jpg',
          '../images/advertisementImages/BMW-1-Series-6581_74.jpg',
          '../images/advertisementImages/BMW-1-Series-6581_77.jpg',
          '../images/advertisementImages/BMW-1-Series-6581_138.jpg',
          '../images/advertisementImages/BMW-1-Series-6581_7.jpg'
     ),
     (
          43,
          '../images/advertisementImages/bmw-2-series-coupe-2021-7135_59.jpg',
          '../images/advertisementImages/bmw-2-series-coupe-2021-7135_62.jpg',
          '../images/advertisementImages/bmw-2-series-coupe-2021-7135_44.jpg',
          '../images/advertisementImages/bmw-2-series-coupe-2021-7135_47.jpg',
          '../images/advertisementImages/bmw-2-series-coupe-2021-7135_48.jpg'
     ),
     (
          44,
          '../images/advertisementImages/bmw-3-series-sedan-2022-7272_30.jpg',
          '../images/advertisementImages/bmw-3-series-sedan-2022-7272_12.jpg',
          '../images/advertisementImages/bmw-3-series-sedan-2022-7272_13.jpg',
          '../images/advertisementImages/bmw-3-series-sedan-2022-7272_14.jpg',
          '../images/advertisementImages/bmw-3-series-sedan-2022-7272_15.jpg'
     ),
     (
          45,
          '../images/advertisementImages/honda-pilot-2022-7330_4.jpg',
          '../images/advertisementImages/honda-pilot-2022-7330_1.jpg',
          '../images/advertisementImages/honda-pilot-2022-7330_2.jpg',
          '../images/advertisementImages/honda-pilot-2022-7330_3.jpg',
          '../images/advertisementImages/honda-pilot-2022-7330_5.jpg'
     ),
     (
          46,
          '../images/advertisementImages/volkswagen-jetta-2021-7152_10.jpg',
          '../images/advertisementImages/volkswagen-jetta-2021-7152_12.jpg',
          '../images/advertisementImages/volkswagen-jetta-2021-7152_4.jpg',
          '../images/advertisementImages/volkswagen-jetta-2021-7152_2.jpg',
          '../images/advertisementImages/volkswagen-jetta-2021-7152_25.jpg'
     ),
     (
          47,
          '../images/advertisementImages/VOLKSWAGEN-Golf-VII-3-Doors-5894_3.jpg',
          '../images/advertisementImages/VOLKSWAGEN-Golf-VII-3-Doors-5894_4.jpg',
          '../images/advertisementImages/VOLKSWAGEN-Golf-VII-3-Doors-5894_5.jpg',
          '../images/advertisementImages/VOLKSWAGEN-Golf-VII-3-Doors-5894_6.jpg',
          '../images/advertisementImages/VOLKSWAGEN-Golf-VII-3-Doors-5894_1.jpg'
     ),
     (
          48,
          '../images/advertisementImages/volkswagen-tiguan-2021-7113_30.jpg',
          '../images/advertisementImages/volkswagen-tiguan-2021-7113_31.jpg',
          '../images/advertisementImages/volkswagen-tiguan-2021-7113_35.jpg',
          '../images/advertisementImages/volkswagen-tiguan-2021-7113_38.jpg',
          '../images/advertisementImages/volkswagen-tiguan-2021-7113_43.jpg'
     ),
     (
          49,
          '../images/advertisementImages/VOLKSWAGEN-Touareg-5281_4.jpg',
          '../images/advertisementImages/VOLKSWAGEN-Touareg-5281_5.jpg',
          '../images/advertisementImages/VOLKSWAGEN-Touareg-5281_7.jpg',
          '../images/advertisementImages/VOLKSWAGEN-Touareg-5281_8.jpg',
          '../images/advertisementImages/VOLKSWAGEN-Touareg-5281_20.jpg'
     ),
     (
          50,
          '../images/advertisementImages/TOYOTA-C-HR-6713_14.jpg',
          '../images/advertisementImages/TOYOTA-C-HR-6713_17.jpg',
          '../images/advertisementImages/TOYOTA-C-HR-6713_20.jpg',
          '../images/advertisementImages/TOYOTA-C-HR-6713_21.jpg',
          '../images/advertisementImages/imagegallery-46781-57724011575b4_1_1000x575.jpeg'
     ),
     (
          51,
          '../images/advertisementImages/toyota-camry-hybrid-2022-7301_7.jpg',
          '../images/advertisementImages/toyota-camry-hybrid-2022-7301_6.jpg',
          '../images/advertisementImages/toyota-camry-hybrid-2022-7301_10.jpg',
          '../images/advertisementImages/toyota-camry-hybrid-2022-7301_11.jpg',
          '../images/advertisementImages/toyota-camry-hybrid-2022-7301_12.jpg'
     ),
     (
          52,
          '../images/advertisementImages/TOYOTA-Rav4-6293_5.jpg',
          '../images/advertisementImages/TOYOTA-Rav4-6293_6.jpg',
          '../images/advertisementImages/TOYOTA-Rav4-6293_8.jpg',
          '../images/advertisementImages/TOYOTA-Rav4-6293_9.jpg',
          '../images/advertisementImages/TOYOTA-Rav4-6293_11.jpg'
     ),
     (
          53,
          '../images/advertisementImages/TOYOTA-Highlander---Kluger-6556_7.jpg',
          '../images/advertisementImages/TOYOTA-Highlander---Kluger-6556_5.jpg',
          '../images/advertisementImages/TOYOTA-Highlander---Kluger-6556_8.jpg',
          '../images/advertisementImages/TOYOTA-Highlander---Kluger-6556_10.jpg',
          '../images/advertisementImages/TOYOTA-Highlander---Kluger-6556_12.jpg'
     ),
     (
          54,
          '../images/advertisementImages/bmw-x5-2023-7413_19.jpg',
          '../images/advertisementImages/bmw-x5-2023-7413_20.jpg',
          '../images/advertisementImages/bmw-x5-2023-7413_26.jpg',
          '../images/advertisementImages/bmw-x5-2023-7413_36.jpg',
          '../images/advertisementImages/bmw-x5-2023-7413_56.jpg'
     ),
     (
          55,
          '../images/advertisementImages/bmw-m3-cs-2023-7386_23.jpg',
          '../images/advertisementImages/bmw-m3-cs-2023-7386_20.jpg',
          '../images/advertisementImages/bmw-m3-cs-2023-7386_25.jpg',
          '../images/advertisementImages/bmw-m3-cs-2023-7386_10.jpg',
          '../images/advertisementImages/bmw-m3-cs-2023-7386_27.jpg'
     ),
     (
          56,
          '../images/advertisementImages/bmw-m3-cs-2023-7386_23.jpg',
          '../images/advertisementImages/bmw-x3-2017-m40i-20_750x.jpg',
          '../images/advertisementImages/Imagen IMG_3769-U60882784134WIP-624x385@Las Provincias.jpg',
          '../images/advertisementImages/Imagen IMG_4029-Rxfz8bLeGZzeRxPnLOMYfpL-624x385@Las Provincias.jpg',
          '../images/advertisementImages/bmw-x3-2017-m40i-05-1024x683.jpg'
     ),
     (
          57,
          '../images/advertisementImages/BMW-5-Series-Touring-6826_35.jpg',
          '../images/advertisementImages/BMW-5-Series-Touring-6826_29.jpg',
          '../images/advertisementImages/BMW-5-Series-Touring-6826_31.jpg',
          '../images/advertisementImages/BMW-5-Series-Touring-6826_36.jpg',
          '../images/advertisementImages/BMW-5-Series-Touring-6826_10.jpg'
     ),
     (
          58,
          '../images/advertisementImages/RENAULT-Clio-5-Doors-5882_8.jpg',
          '../images/advertisementImages/RENAULT-Clio-5-Doors-5882_7.jpg',
          '../images/advertisementImages/RENAULT-Clio-5-Doors-5882_9.jpg',
          '../images/advertisementImages/RENAULT-Clio-5-Doors-5882_5.jpg',
          '../images/advertisementImages/RENAULT-Clio-5-Doors-5882_12.jpg'
     ),
     (
          59,
          '../images/advertisementImages/RENAULT-Megane-5-Doors-5251_34.jpg',
          '../images/advertisementImages/RENAULT-Megane-5-Doors-5251_32.jpg',
          '../images/advertisementImages/RENAULT-Megane-5-Doors-5251_33.jpg',
          '../images/advertisementImages/RENAULT-Megane-5-Doors-5251_31.jpg',
          '../images/advertisementImages/RENAULT-Megane-5-Doors-5251_29.jpg'
     ),
     (
          60,
          '../images/advertisementImages/RENAULT-Captur-6616_29.jpg',
          '../images/advertisementImages/RENAULT-Captur-6616_31.jpg',
          '../images/advertisementImages/RENAULT-Captur-6616_21.jpg',
          '../images/advertisementImages/RENAULT-Captur-6616_32.jpg',
          '../images/advertisementImages/RENAULT-Captur-6616_42.jpg'
     ),
     (
          61,
          '../images/advertisementImages/RENAULT-Kadjar-6402_41.jpg',
          '../images/advertisementImages/RENAULT-Kadjar-6402_36.jpg',
          '../images/advertisementImages/RENAULT-Kadjar-6402_38.jpg',
          '../images/advertisementImages/RENAULT-Kadjar-6402_37.jpg',
          '../images/advertisementImages/RENAULT-Kadjar-6402_40.jpg'
     ),
     (
          62,
          '../images/advertisementImages/ford-fiesta-st-3-doors-2018-7170_11.jpg',
          '../images/advertisementImages/ford-fiesta-st-3-doors-2018-7170_12.jpg',
          '../images/advertisementImages/ford-fiesta-st-3-doors-2018-7170_13.jpg',
          '../images/advertisementImages/ford-fiesta-st-3-doors-2018-7170_14.jpg',
          '../images/advertisementImages/ford-fiesta-st-3-doors-2018-7170_18.jpg'
     ),
     (
          63,
          '../images/advertisementImages/ford-focus-2021-7180_6.jpg',
          '../images/advertisementImages/ford-focus-2021-7180_4.jpg',
          '../images/advertisementImages/ford-focus-2021-7180_3.jpg',
          '../images/advertisementImages/ford-focus-2021-7180_1.jpg',
          '../images/advertisementImages/ford-focus-2021-7180_2.jpg'
     ),
     (
          64,
          '../images/advertisementImages/FORD-Kuga-6548_42.jpg',
          '../images/advertisementImages/FORD-Kuga-6548_41.jpg',
          '../images/advertisementImages/FORD-Kuga-6548_40.jpg',
          '../images/advertisementImages/FORD-Kuga-6548_43.jpg',
          '../images/advertisementImages/FORD-Kuga-6548_55.jpg'
     ),
     (
          65,
          '../images/advertisementImages/FORD-Explorer-6476_14.jpg',
          '../images/advertisementImages/FORD-Explorer-6476_15.jpg',
          '../images/advertisementImages/FORD-Explorer-6476_11.jpg',
          '../images/advertisementImages/FORD-Explorer-6476_12.jpg',
          '../images/advertisementImages/FORD-Explorer-6476_13.jpg'
     ),
     (
          66,
          '../images/advertisementImages/SEAT-Leon-5-doors-6732_5.jpg',
          '../images/advertisementImages/SEAT-Leon-5-doors-6732_6.jpg',
          '../images/advertisementImages/SEAT-Leon-5-doors-6732_8.jpg',
          '../images/advertisementImages/SEAT-Leon-5-doors-6732_10.jpg',
          '../images/advertisementImages/SEAT-Leon-5-doors-6732_11.jpg'
     ),
     (
          67,
          '../images/advertisementImages/SEAT-Ibiza-5-doors-6291_23.jpg',
          '../images/advertisementImages/SEAT-Ibiza-5-doors-6291_22.jpg',
          '../images/advertisementImages/SEAT-Ibiza-5-doors-6291_24.jpg',
          '../images/advertisementImages/SEAT-Ibiza-5-doors-6291_25.jpg',
          '../images/advertisementImages/SEAT-Ibiza-5-doors-6291_26.jpg'
     ),
     (
          68,
          '../images/advertisementImages/seat-arona-2021-7090_10.jpg',
          '../images/advertisementImages/seat-arona-2021-7090_11.jpg',
          '../images/advertisementImages/seat-arona-2021-7090_12.jpg',
          '../images/advertisementImages/seat-arona-2021-7090_13.jpg',
          '../images/advertisementImages/seat-arona-2021-7090_14.jpg'
     ),
     (
          69,
          '../images/advertisementImages/SEAT-Ateca-6845_6.jpg',
          '../images/advertisementImages/SEAT-Ateca-6845_5.jpg',
          '../images/advertisementImages/SEAT-Ateca-6845_7.jpg',
          '../images/advertisementImages/SEAT-Ateca-6845_9.jpg',
          '../images/advertisementImages/SEAT-Ateca-6845_11.jpg'
     ),
     (
          70,
          '../images/advertisementImages/VOLVO-S90-6747_2.jpg',
          '../images/advertisementImages/VOLVO-S90-6747_3.jpg',
          '../images/advertisementImages/VOLVO-S90-6747_4.jpg',
          '../images/advertisementImages/VOLVO-S90-6747_5.jpg',
          '../images/advertisementImages/VOLVO-S90-6747_6.jpg'
     ),
     (
          71,
          '../images/advertisementImages/honda-cr-v-2022-7289_3.jpg',
          '../images/advertisementImages/honda-cr-v-2022-7289_4.jpg',
          '../images/advertisementImages/honda-cr-v-2022-7289_5.jpg',
          '../images/advertisementImages/honda-cr-v-2022-7289_2.jpg',
          '../images/advertisementImages/honda-cr-v-2022-7289_1.jpg'
     ),
     (
          72,
          '../images/advertisementImages/honda-civic-hatchback-2021-7131_4.jpg',
          '../images/advertisementImages/honda-civic-hatchback-2021-7131_3.jpg',
          '../images/advertisementImages/honda-civic-hatchback-2021-7131_2.jpg',
          '../images/advertisementImages/honda-civic-hatchback-2021-7131_5.jpg',
          '../images/advertisementImages/honda-civic-hatchback-2021-7131_7.jpg'
     ),
     (
          73,
          '../images/advertisementImages/HONDAAccordTypeR-2985_3.jpg',
          '../images/advertisementImages/HONDAAccordTypeR-2985_2.jpg',
          '../images/advertisementImages/HONDA-Accord-Type-R-2985_12.jpg',
          '../images/advertisementImages/HONDAAccordTypeR-2985_1.jpg',
          '../images/advertisementImages/HONDAAccordTypeR-2985_3.jpg'
     ),
     (
          74,
          '../images/advertisementImages/MAZDA-CX-5-5849_5.jpg',
          '../images/advertisementImages/MAZDA-CX-5-5849_4.jpg',
          '../images/advertisementImages/MAZDA-CX-5-5849_7.jpg',
          '../images/advertisementImages/MAZDA-CX-5-5849_8.jpg',
          '../images/advertisementImages/MAZDA-CX-5-5849_6.jpg'
     ),
     (
          75,
          '../images/advertisementImages/honda-cr-v-2022-7289_6.jpg',
          '../images/advertisementImages/honda-cr-v-2022-7289_2_1.jpg',
          '../images/advertisementImages/honda-cr-v-2022-7289_7.jpg',
          '../images/advertisementImages/honda-cr-v-2022-7289_1_1.jpg',
          '../images/advertisementImages/2023-honda-cr-v-sport-touring-front-view.jpg'
     ),
     (
          76,
          '../images/advertisementImages/TOYOTARAV45Doors-4704_5.jpg',
          '../images/advertisementImages/TOYOTARAV45Doors-4704_6.jpg',
          '../images/advertisementImages/TOYOTARAV45Doors-4704_7.jpg',
          '../images/advertisementImages/TOYOTARAV45Doors-4704_8.jpg',
          '../images/advertisementImages/TOYOTARAV45Doors-4704_10.jpg'
     ),
     (
          77,
          '../images/advertisementImages/volkswagen-tiguan-2021-7113_44.jpg',
          '../images/advertisementImages/volkswagen-tiguan-2021-7113_48.jpg',
          '../images/advertisementImages/volkswagen-tiguan-2021-7113_33.jpg',
          '../images/advertisementImages/volkswagen-tiguan-2021-7113_32.jpg',
          '../images/advertisementImages/volkswagen-tiguan-2021-7113_42.jpg'
     ),
     (
          78,
          '../images/advertisementImages/FORD-EcoSport-6251_3.jpg',
          '../images/advertisementImages/FORD-EcoSport-6251_1.jpg',
          '../images/advertisementImages/FORD-EcoSport-6251_6.jpg',
          '../images/advertisementImages/FORD-EcoSport-6251_7.jpg',
          '../images/advertisementImages/FORD-EcoSport-6251_4.jpg'
     ),
     (
          79,
          '../images/advertisementImages/FORD-Explorer-6476_16.jpg',
          '../images/advertisementImages/FORD-Explorer-6476_17.jpg',
          '../images/advertisementImages/FORD-Explorer-6476_18.jpg',
          '../images/advertisementImages/FORD-Explorer-6476_20.jpg',
          '../images/advertisementImages/FORD-Explorer-6476_21.jpg'
     ),
     (
          80,
          '../images/advertisementImages/ford-escape-2022-7338_9.jpg',
          '../images/advertisementImages/ford-escape-2022-7338_10.jpg',
          '../images/advertisementImages/ford-escape-2022-7338_11.jpg',
          '../images/advertisementImages/ford-escape-2022-7338_6.jpg',
          '../images/advertisementImages/ford-escape-2022-7338_13.jpg'
     ),
     (
          81,
          '../images/advertisementImages/ford-bronco-raptor-2022-7225_12.jpg',
          '../images/advertisementImages/ford-bronco-raptor-2022-7225_13.jpg',
          '../images/advertisementImages/ford-bronco-raptor-2022-7225_14.jpg',
          '../images/advertisementImages/ford-bronco-raptor-2022-7225_15.jpg',
          '../images/advertisementImages/ford-bronco-raptor-2022-7225_17.jpg'
     ),
     (
          82,
          '../images/advertisementImages/DODGERam1500-4121_1.jpg',
          '../images/advertisementImages/DODGERam1500-4121_2.jpg',
          '../images/advertisementImages/DODGERam1500-4121_3.jpg',
          '../images/advertisementImages/DODGERam1500-4121_11.jpg',
          '../images/advertisementImages/DODGERam1500-4121_13.jpg'
     ),
     (
          83,
          '../images/advertisementImages/jeep-wrangler-willys-2023-7469_25.jpg',
          '../images/advertisementImages/jeep-wrangler-willys-2023-7469_22.jpg',
          '../images/advertisementImages/jeep-wrangler-willys-2023-7469_24.jpg',
          '../images/advertisementImages/jeep-wrangler-willys-2023-7469_28.jpg',
          '../images/advertisementImages/jeep-wrangler-willys-interior.jpg'
     ),
     (
          84,
          '../images/advertisementImages/JEEP-Cherokee-6198_4.jpg',
          '../images/advertisementImages/JEEP-Cherokee-6198_1.jpg',
          '../images/advertisementImages/JEEP-Cherokee-6198_14.jpg',
          '../images/advertisementImages/JEEP-Cherokee-6198_15.jpg',
          '../images/advertisementImages/JEEP-Cherokee-6198_19.jpg'
     ),
     (
          85,
          '../images/advertisementImages/kia-soul-2022-7266_19.jpg',
          '../images/advertisementImages/kia-soul-2022-7266_17.jpg',
          '../images/advertisementImages/kia-soul-2022-7266_18.jpg',
          '../images/advertisementImages/kia-soul-2022-7266_20.jpg',
          '../images/advertisementImages/kia-soul-2022-7266_21.jpg'
     ),
     (
          86,
          '../images/advertisementImages/KIA-Rio-6839_10.jpg',
          '../images/advertisementImages/KIA-Rio-6839_11.jpg',
          '../images/advertisementImages/KIA-Rio-6839_13.jpg',
          '../images/advertisementImages/KIA-Rio-6839_14.jpg',
          '../images/advertisementImages/KIA-Rio-6839_2.jpg'
     ),
     (
          87,
          '../images/advertisementImages/KIA-Sorento-6789_14.jpg',
          '../images/advertisementImages/KIA-Sorento-6789_16.jpg',
          '../images/advertisementImages/KIA-Sorento-6789_17.jpg',
          '../images/advertisementImages/KIA-Sorento-6789_21.jpg',
          '../images/advertisementImages/KIA-Sorento-6789_22.jpg'
     ),
     (
          88,
          '../images/advertisementImages/KIA-K7---Cadenza-5605_15.jpg',
          '../images/advertisementImages/KIA-K7---Cadenza-5605_13.jpg',
          '../images/advertisementImages/KIA-K7---Cadenza-5605_12.jpg',
          '../images/advertisementImages/KIA-K7---Cadenza-5605_11.jpg',
          '../images/advertisementImages/KIA-K7---Cadenza-5605_7.jpg'
     ),
     (
          89,
          '../images/advertisementImages/MERCEDES-BENZ-C-Class-Coupe-5619_27.jpg',
          '../images/advertisementImages/MERCEDES-BENZ-C-Class-Coupe-5619_26.jpg',
          '../images/advertisementImages/MERCEDES-BENZ-C-Class-Coupe-5619_25.jpg',
          '../images/advertisementImages/MERCEDES-BENZ-C-Class-Coupe-5619_71.jpg',
          '../images/advertisementImages/MERCEDES-BENZ-C-Class-Coupe-5619_73.jpg'
     ),
     (
          90,
          '../images/advertisementImages/MERCEDES-BENZ-E-Class--W213--6782_16.jpg',
          '../images/advertisementImages/MERCEDES-BENZ-E-Class--W213--6782_14.jpg',
          '../images/advertisementImages/MERCEDES-BENZ-E-Class--W213--6782_15.jpg',
          '../images/advertisementImages/MERCEDES-BENZ-E-Class--W213--6782_13.jpg',
          '../images/advertisementImages/MERCEDES-BENZ-E-Class--W213--6782_12.jpg'
     ),
     (
          91,
          '../images/advertisementImages/mercedes-benz-gla-2023-7445_3.jpg',
          '../images/advertisementImages/mercedes-benz-gla-2023-7445_4.jpg',
          '../images/advertisementImages/mercedes-benz-gla-2023-7445_5.jpg',
          '../images/advertisementImages/mercedes-benz-gla-2023-7445_6.jpg',
          '../images/advertisementImages/mercedes-benz-gla-2023-7445_8.jpg'
     ),
     (
          92,
          '../images/advertisementImages/MERCEDESBENZCL63AMG-C216--4702_6.png',
          '../images/advertisementImages/MERCEDESBENZCL63AMG-C216--4702_7.png',
          '../images/advertisementImages/MERCEDESBENZCL63AMG-C216--4702_17.png',
          '../images/advertisementImages/MERCEDESBENZCL63AMG-C216--4702_16.png',
          '../images/advertisementImages/MERCEDESBENZCL63AMG-C216--4702_28.png'
     ),
     (
          93,
          '../images/advertisementImages/FORD-Kuga-6548_67.jpg',
          '../images/advertisementImages/FORD-Kuga-6548_65.jpg',
          '../images/advertisementImages/FORD-Kuga-6548_63.jpg',
          '../images/advertisementImages/FORD-Kuga-6548_62.jpg',
          '../images/advertisementImages/FORD-Kuga-6548_61.jpg'
     ),
     (
          94,
          '../images/advertisementImages/FORD-Fiesta-3-doors-6055_10.jpg',
          '../images/advertisementImages/FORD-Fiesta-3-doors-6055_20.jpg',
          '../images/advertisementImages/FORD-Fiesta-3-doors-6055_6.jpg',
          '../images/advertisementImages/FORD-Fiesta-3-doors-6055_4.jpg',
          '../images/advertisementImages/FORD-Fiesta-3-doors-6055_1.jpg'
     ),
     (
          95,
          '../images/advertisementImages/ford-focus-st-2021-7182_2.jpg',
          '../images/advertisementImages/ford-focus-st-2021-7182_1.jpg',
          '../images/advertisementImages/ford-focus-st-2021-7182_3.jpg',
          '../images/advertisementImages/ford-focus-st-2021-7182_4.jpg',
          '../images/advertisementImages/ford-focus-st-2021-7182_8.jpg'
     ),
     (
          96,
          '../images/advertisementImages/ford-mustang-gt-2023-7402_14.jpg',
          '../images/advertisementImages/ford-mustang-gt-2023-7402_9.jpg',
          '../images/advertisementImages/ford-mustang-gt-2023-7402_10.jpg',
          '../images/advertisementImages/ford-mustang-gt-2023-7402_6.jpg',
          '../images/advertisementImages/ford-mustang-gt-2023-7402_4.jpg'
     ),
     (
          97,
          '../images/advertisementImages/VOLVO-S60-6415_72.jpg',
          '../images/advertisementImages/VOLVO-S60-6415_66.jpg',
          '../images/advertisementImages/VOLVO-S60-6415_65.jpg',
          '../images/advertisementImages/VOLVO-S60-6415_64.jpg',
          '../images/advertisementImages/VOLVO-S60-6415_60.jpg'
     ),
     (
          98,
          '../images/advertisementImages/VOLVO-XC90-6792_27.jpg',
          '../images/advertisementImages/VOLVO-XC90-6792_28.jpg',
          '../images/advertisementImages/VOLVO-XC90-6792_29.jpg',
          '../images/advertisementImages/VOLVO-XC90-6792_30.jpg',
          '../images/advertisementImages/VOLVO-XC90-6792_32.jpg'
     ),
     (
          99,
          '../images/advertisementImages/VOLVO-XC90-6792_75.jpg',
          '../images/advertisementImages/VOLVO-XC90-6792_78.jpg',
          '../images/advertisementImages/VOLVO-XC90-6792_76.jpg',
          '../images/advertisementImages/VOLVO-XC90-6792_74.jpg',
          '../images/advertisementImages/VOLVO-XC90-6792_1.jpg'
     ),
     (
          100,
          '../images/advertisementImages/VOLKSWAGEN-Golf-GTI-6750_13.jpg',
          '../images/advertisementImages/VOLKSWAGEN-Golf-GTI-6750_7.jpg',
          '../images/advertisementImages/VOLKSWAGEN-Golf-GTI-6750_11.jpg',
          '../images/advertisementImages/VOLKSWAGEN-Golf-GTI-6750_14.jpg',
          '../images/advertisementImages/VOLKSWAGEN-Golf-GTI-6750_16.jpg'
     ),
     (
          101,
          '../images/advertisementImages/VOLKSWAGEN-Passat--US--6487_13.jpg',
          '../images/advertisementImages/VOLKSWAGEN-Passat--US--6487_15.jpg',
          '../images/advertisementImages/VOLKSWAGEN-Passat--US--6487_10.jpg',
          '../images/advertisementImages/VOLKSWAGEN-Passat--US--6487_9.jpg',
          '../images/advertisementImages/VOLKSWAGEN-Passat--US--6487_6.jpg'
     ),
     (
          102,
          '../images/advertisementImages/VOLKSWAGEN-Touareg-6288_8.jpg',
          '../images/advertisementImages/VOLKSWAGEN-Touareg-6288_9.jpg',
          '../images/advertisementImages/VOLKSWAGEN-Touareg-6288_10.jpg',
          '../images/advertisementImages/VOLKSWAGEN-Touareg-6288_11.jpg',
          '../images/advertisementImages/VOLKSWAGEN-Touareg-6288_13.jpg'
     ),
     (
          103,
          '../images/advertisementImages/SEATIbizaCupra-2092_1.jpg',
          '../images/advertisementImages/SEATIbizaCupra-2092_2.jpg',
          '../images/advertisementImages/SEATIbizaCupra-2092_3.jpg',
          '../images/advertisementImages/SEATIbizaCupra-2092_22.jpg',
          '../images/advertisementImages/SEATIbizaCupra-2092_24.jpg'
     ),
     (
          104,
          '../images/advertisementImages/SEATIbizaFRSportCoupe-SC--4268_1.jpg',
          '../images/advertisementImages/SEATIbizaFRSportCoupe-SC--4268_2.jpg',
          '../images/advertisementImages/SEATIbizaFRSportCoupe-SC--4268_11.jpg',
          '../images/advertisementImages/SEATIbizaFRSportCoupe-SC--4268_19.jpg',
          '../images/advertisementImages/SEATIbizaFRSportCoupe-SC--4268_24.jpg'
     ),
     (
          105,
          '../images/advertisementImages/494246.jpg',
          '../images/advertisementImages/Seat_Ibiza_Full_Connect-01.jpg',
          '../images/advertisementImages/Seat_Ibiza_Full_Connect-04.jpg',
          '../images/advertisementImages/Seat-Ibiza-5-puertas-Style-2015-04.jpg',
          '../images/advertisementImages/VSSZZZKJZMR032024.jpg'
     ),
     (
          106,
          '../images/advertisementImages/SEAT-Ibiza-Cupra-5048_1.jpg',
          '../images/advertisementImages/SEAT-Ibiza-Cupra-5048_2.jpg',
          '../images/advertisementImages/SEAT-Ibiza-Cupra-5048_6.jpg',
          '../images/advertisementImages/SEAT-Ibiza-Cupra-5048_21.jpg',
          '../images/advertisementImages/SEAT-Ibiza-Cupra-5048_32.jpg'
     ),
     (
          107,
          '../images/advertisementImages/KAWASAKI-NINJA-ZX-10R-ABS-KRT-EDITION-14334_1.jpg',
          '../images/advertisementImages/KAWASAKI-NINJA-ZX-10R-ABS-KRT-EDITION-14334_2.jpg',
          '../images/advertisementImages/KAWASAKI-NINJA-ZX-10R-ABS-KRT-EDITION-14334_3.jpg',
          '../images/advertisementImages/KAWASAKI-NINJA-ZX-10R-ABS-KRT-EDITION-14334_5.jpg',
          '../images/advertisementImages/KAWASAKI-NINJA-ZX-10R-ABS-KRT-EDITION-14334_6.jpg'
     ),
     (
          108,
          '../images/advertisementImages/HONDA-CBR1000RR-SP-14031_1.jpg',
          '../images/advertisementImages/HONDA-CBR1000RR-SP-14031_2.jpg',
          '../images/advertisementImages/HONDA-CBR1000RR-SP-14031_3.jpg',
          '../images/advertisementImages/HONDA-CBR1000RR-SP-14031_4.jpg',
          '../images/advertisementImages/HONDA-CBR1000RR-SP-14031_18.jpg'
     ),
     (
          109,
          '../images/advertisementImages/ktm-450-sx-f-2022-14581_1.jpg',
          '../images/advertisementImages/ktm-450-sx-f-2022-14581_2.jpg',
          '../images/advertisementImages/ktm-450-sx-f-2022-14581_3.jpg',
          '../images/advertisementImages/ktm-450-sx-f-2022-14581_4.jpg',
          '../images/advertisementImages/ktm-450-sx-f-2022-14581_6.jpg'
     ),
     (
          110,
          '../images/advertisementImages/YAMAHA-FZ-10-TOURER-14483_1.jpg',
          '../images/advertisementImages/YAMAHA-FZ-10-TOURER-14483_2.jpg',
          '../images/advertisementImages/YAMAHA-FZ-10-TOURER-14483_7.jpg',
          '../images/advertisementImages/YAMAHA-FZ-10-TOURER-14483_8.jpg',
          '../images/advertisementImages/YAMAHA-FZ-10-TOURER-14483_9.jpg'
     ),
     (
          111,
          '../images/advertisementImages/ducati-monster-sp-2022-14571_1.jpg',
          '../images/advertisementImages/ducati-monster-sp-2022-14571_3.jpg',
          '../images/advertisementImages/ducati-monster-sp-2022-14571_4.jpg',
          '../images/advertisementImages/ducati-monster-sp-2022-14571_5.jpg',
          '../images/advertisementImages/ducati-monster-sp-2022-14571_6.jpg'
     ),
     (
          112,
          '../images/advertisementImages/DODGERam1994-1099_1.jpg',
          '../images/advertisementImages/DODGERam1994-1099_3.jpg',
          '../images/advertisementImages/DODGERam1994-1099_4.jpg',
          '../images/advertisementImages/DODGERam1994-1099_20.jpg',
          '../images/advertisementImages/DODGERam1994-1099_21.jpg'
     ),
     (
          113,
          '../images/advertisementImages/ford-f-150-raptor-2021-7009_11.jpg',
          '../images/advertisementImages/ford-f-150-raptor-2021-7009_7.jpg',
          '../images/advertisementImages/ford-f-150-raptor-2021-7009_4.jpg',
          '../images/advertisementImages/ford-f-150-raptor-2021-7009_2.jpg',
          '../images/advertisementImages/ford-f-150-raptor-2021-7009_1.jpg'
     ),
     (
          114,
          '../images/advertisementImages/gmc-sierra-at4x-2022-7359_14.jpg',
          '../images/advertisementImages/gmc-sierra-at4x-2022-7359_15.jpg',
          '../images/advertisementImages/gmc-sierra-at4x-2022-7359_11.jpg',
          '../images/advertisementImages/gmc-sierra-at4x-2022-7359_9.jpg',
          '../images/advertisementImages/gmc-sierra-at4x-2022-7359_8.jpg'
     ),
     (
          115,
          '../images/advertisementImages/toyota-tundra-2021-7194_36.jpg',
          '../images/advertisementImages/toyota-tundra-2021-7194_38.jpg',
          '../images/advertisementImages/toyota-tundra-2021-7194_39.jpg',
          '../images/advertisementImages/toyota-tundra-2021-7194_56.jpg',
          '../images/advertisementImages/toyota-tundra-2021-7194_58.jpg'
     ),
     (
          116,
          '../images/advertisementImages/CHEVROLETSilverado2500HDExtendedCab-3937_6.jpg',
          '../images/advertisementImages/CHEVROLETSilverado2500HDExtendedCab-3937_7.jpg',
          '../images/advertisementImages/CHEVROLETSilverado2500HDExtendedCab-3937_8.jpg',
          '../images/advertisementImages/CHEVROLETSilverado2500HDExtendedCab-3937_10.jpg',
          '../images/advertisementImages/CHEVROLETSilverado2500HDExtendedCab-3937_12.jpg'
     );

-- Insertar registro en la tabla anuncio
INSERT INTO
     advertisement (
          description,
          price,
          publication_date,
          model_id,
          seller_user_id,
          color,
          km,
          multimedia_id,
          brand_id,
          motorization_id,
          benefits_id,
          engine_type_id
     )
VALUES
     (
          'Toyota Corolla en perfecto estado',
          3000,
          '2022-04-13',
          1,
          1,
          'gris',
          24152,
          1,
          1,
          1,
          1,
          1
     ),
     (
          'Ford F-150 en perfecto estado',
          17099,
          '2022-04-18',
          2,
          2,
          'azul',
          24152,
          2,
          2,
          2,
          2,
          2
     ),
     (
          'Golf GTI en perfecto estado',
          14000,
          '2022-04-12',
          3,
          3,
          'blanco',
          24152,
          3,
          3,
          3,
          3,
          1
     ),
     (
          'Renault Clio en perfecto estado',
          17000,
          '2022-04-12',
          4,
          4,
          'amarillo',
          24152,
          4,
          4,
          4,
          4,
          1
     ),
     (
          'Civic Type R en perfecto estado',
          28000,
          '2022-04-12',
          5,
          5,
          'blanco',
          24152,
          5,
          5,
          5,
          5,
          1
     ),
     (
          'BMW X3 en perfecto estado',
          21000,
          ' 2022-03-12',
          6,
          6,
          'azul',
          24152,
          6,
          6,
          6,
          6,
          1
     ),
     (
          'Mercedes AMG en perfecto estado',
          172000,
          '2022-04-12',
          7,
          7,
          'negro mate',
          24152,
          7,
          7,
          7,
          7,
          1
     ),
     (
          'Ferrari en perfecto estado',
          262000,
          '2021-04-12',
          8,
          1,
          'rojo',
          24152,
          8,
          8,
          8,
          8,
          1
     ),
     (
          'Volvo XC90 en perfecto estado',
          11000,
          '2022-04-26',
          9,
          9,
          'blanco',
          24152,
          9,
          9,
          9,
          9,
          4
     ),
     (
          'Nissan GT-R en perfecto estado',
          125000,
          '2022-04-12',
          10,
          1,
          'gris claro',
          24152,
          10,
          10,
          10,
          10,
          1
     ),
     (
          'Camaro SS en perfecto estado',
          62000,
          '2021-04-12',
          11,
          15,
          'azul',
          24152,
          11,
          11,
          11,
          11,
          1
     ),
     (
          'Hyundai en perfecto estado',
          10000,
          '2022-04-01',
          12,
          3,
          'blanco',
          24152,
          12,
          12,
          12,
          12,
          1
     ),
     (
          'Mazda Miata en perfecto estado',
          9000,
          '2022-04-30',
          13,
          14,
          'gris',
          24152,
          13,
          13,
          13,
          13,
          1
     ),
     (
          'Peugeot 208 en perfecto estado',
          11500,
          '2022-12-12',
          14,
          13,
          'amarillo',
          24152,
          14,
          14,
          14,
          14,
          1
     ),
     (
          'Audi A3 en perfecto estado',
          14200,
          '2022-04-12',
          15,
          4,
          'amarillo',
          24152,
          15,
          15,
          15,
          15,
          1
     ),
     (
          'Lamborghini en perfecto estado',
          320000,
          '2022-07-12',
          16,
          8,
          'naranja',
          24152,
          16,
          16,
          16,
          16,
          1
     ),
     (
          'Porsche 911 en perfecto estado',
          174000,
          '2022-01-12',
          17,
          9,
          'gris',
          24152,
          17,
          17,
          17,
          17,
          1
     ),
     (
          'Kia en perfecto estado',
          4000,
          '2022-04-22',
          18,
          11,
          'azul',
          24152,
          18,
          18,
          18,
          18,
          1
     ),
     (
          'Subaru WRX en perfecto estado',
          18200,
          '2022-04-12',
          19,
          10,
          'blanco',
          24152,
          19,
          19,
          19,
          19,
          1
     ),
     (
          'Audi A3 en perfecto estado',
          14150,
          '2022-04-12',
          20,
          12,
          'gris',
          24152,
          20,
          15,
          20,
          20,
          1
     ),
     (
          'Audi en perfecto estado',
          21400,
          '2023-01-12',
          21,
          16,
          'gris',
          24152,
          21,
          15,
          21,
          21,
          1
     ),
     (
          'Audi en perfecto estado',
          31200,
          '2023-01-12',
          22,
          16,
          'plata',
          24152,
          22,
          15,
          22,
          22,
          2
     ),
     (
          'Audi en perfecto estado',
          19000,
          '2023-02-12',
          23,
          16,
          'azul',
          24152,
          23,
          15,
          23,
          23,
          2
     ),
     (
          'Audi en perfecto estado',
          41000,
          '2023-01-12',
          24,
          16,
          'rojo',
          24152,
          24,
          15,
          24,
          24,
          2
     ),
     (
          'Audi en perfecto estado',
          25200,
          '2023-02-12',
          25,
          16,
          'azul',
          24152,
          25,
          15,
          25,
          25,
          2
     ),
     (
          'Audi en perfecto estado',
          62000,
          '2023-01-12',
          26,
          16,
          'negro',
          24152,
          26,
          15,
          26,
          26,
          2
     ),
     (
          'Audi en perfecto estado',
          19210,
          '2023-03-12',
          27,
          16,
          'gris claro',
          24152,
          27,
          15,
          27,
          27,
          1
     ),
     (
          'Audi en perfecto estado',
          36200,
          '2023-01-12',
          28,
          16,
          'azul',
          24152,
          28,
          15,
          28,
          28,
          1
     ),
     (
          'Audi en perfecto estado',
          38000,
          '2023-02-12',
          29,
          16,
          'blanco',
          24152,
          29,
          15,
          29,
          29,
          1
     ),
     (
          'Audi en perfecto estado',
          27600,
          '2023-02-12',
          30,
          16,
          'verde',
          24152,
          30,
          15,
          30,
          30,
          2
     ),
     (
          'Audi en perfecto estado',
          38000,
          '2023-01-12',
          31,
          16,
          'rojo',
          24152,
          31,
          15,
          31,
          31,
          2
     ),
     (
          'Audi en perfecto estado',
          31250,
          '2023-01-12',
          32,
          16,
          'rojo',
          24152,
          32,
          15,
          32,
          32,
          1
     ),
     (
          'BMW en perfecto estado',
          32501,
          '2023-01-12',
          33,
          17,
          'azul/negro',
          24152,
          33,
          6,
          33,
          33,
          3
     ),
     (
          'BMW en perfecto estado',
          98740,
          '2021-01-12',
          34,
          17,
          'gris',
          24152,
          34,
          6,
          34,
          34,
          3
     ),
     (
          'BMW en perfecto estado',
          21001,
          '2022-11-12',
          35,
          17,
          'naranja',
          24152,
          35,
          6,
          35,
          35,
          2
     ),
     (
          'BMW en perfecto estado',
          18900,
          '2022-12-12',
          36,
          17,
          'oro',
          24152,
          36,
          6,
          36,
          36,
          2
     ),
     (
          'BMW en perfecto estado',
          29420,
          '2022-01-12',
          37,
          17,
          'negro',
          24152,
          37,
          6,
          37,
          37,
          2
     ),
     (
          'BMW en perfecto estado',
          15841,
          '2022-09-12',
          38,
          17,
          'gris claro',
          24152,
          38,
          6,
          38,
          38,
          2
     ),
     (
          'BMW en perfecto estado',
          35000,
          '2022-08-12',
          39,
          17,
          'verde',
          24152,
          39,
          6,
          39,
          39,
          2
     ),
     (
          'BMW en perfecto estado',
          59120,
          '2023-01-31',
          40,
          17,
          'azul',
          24152,
          40,
          6,
          40,
          40,
          2
     ),
     (
          'BMW en perfecto estado',
          62158,
          '2022-05-28',
          41,
          17,
          'gris',
          24152,
          41,
          6,
          41,
          41,
          2
     ),
     (
          'BMW en perfecto estado',
          16200,
          '2022-06-29',
          42,
          17,
          'blanco',
          24152,
          42,
          6,
          42,
          42,
          1
     ),
     (
          'BMW en perfecto estado',
          18740,
          '2022-10-12',
          43,
          17,
          'lila',
          24152,
          43,
          6,
          43,
          43,
          1
     ),
     (
          'BMW en perfecto estado',
          29530,
          '2022-01-13',
          44,
          17,
          'gris claro',
          24152,
          44,
          6,
          44,
          44,
          1
     ),
     (
          'Honda Pilot en perfecto estado',
          20400,
          '2023-03-12',
          45,
          18,
          'azul',
          24152,
          45,
          5,
          45,
          45,
          2
     ),
     (
          'Wolkswagen Jetta en perfecto estado',
          7800,
          '2022-11-19',
          46,
          18,
          'azul',
          24152,
          46,
          3,
          46,
          46,
          1
     ),
     (
          'Golf VII en perfecto estado',
          21220,
          '2022-05-14',
          47,
          18,
          'amarillo',
          24152,
          47,
          3,
          47,
          47,
          2
     ),
     (
          'Wolkswagen Tiguan en perfecto estado',
          26200,
          '2022-07-14',
          48,
          18,
          'verde',
          24152,
          48,
          3,
          48,
          48,
          1
     ),
     (
          'Wolkswagen Touareg en perfecto estado',
          31250,
          '2022-08-14',
          49,
          18,
          'azul',
          24152,
          49,
          3,
          49,
          49,
          2
     ),
     (
          'Honda CH-R en perfecto estado',
          19400,
          '2022-05-14',
          50,
          18,
          'naranja',
          24152,
          50,
          5,
          50,
          50,
          1
     ),
     (
          'Toyota Camry en perfecto estado',
          6300,
          '2022-05-14',
          51,
          18,
          'gris',
          24152,
          51,
          1,
          51,
          51,
          2
     ),
     (
          'Toyota RAV en perfecto estado',
          15200,
          '2022-05-14',
          52,
          18,
          'blanco',
          24152,
          52,
          1,
          52,
          52,
          1
     ),
     (
          'Toyota Highlander en perfecto estado',
          21900,
          '2022-05-14',
          53,
          18,
          'gris',
          24152,
          53,
          1,
          53,
          53,
          2
     ),
     (
          'BMW X5 en perfecto estado',
          32010,
          '2022-05-14',
          54,
          18,
          'azul',
          24152,
          54,
          6,
          54,
          54,
          1
     ),
     (
          'BMW Serie 3 en perfecto estado',
          14230,
          '2022-05-14',
          55,
          18,
          'verde',
          24152,
          55,
          6,
          55,
          55,
          2
     ),
     (
          'BMW X3 en perfecto estado',
          32010,
          '2022-05-14',
          56,
          18,
          'azul',
          24152,
          56,
          6,
          56,
          56,
          1
     ),
     (
          'BMW Serie 5 en perfecto estado',
          33200,
          '2022-05-14',
          57,
          18,
          'negro',
          24152,
          57,
          6,
          57,
          57,
          2
     ),
     (
          'Renault Clio en perfecto estado',
          7600,
          '2022-09-14',
          58,
          18,
          'azul',
          24152,
          58,
          4,
          58,
          58,
          1
     ),
     (
          'Renault Megane en perfecto estado',
          5200,
          '2022-10-14',
          59,
          18,
          'granate',
          24152,
          59,
          4,
          59,
          59,
          2
     ),
     (
          'Renault Captur en perfecto estado',
          10900,
          '2022-05-01',
          60,
          18,
          'naranja',
          24152,
          60,
          4,
          60,
          60,
          1
     ),
     (
          'Renault Kadjar en perfecto estado',
          9800,
          '2022-05-02',
          61,
          18,
          'azul',
          24152,
          61,
          4,
          61,
          61,
          2
     ),
     (
          'Ford Fiesta en perfecto estado',
          3600,
          '2022-05-03',
          62,
          18,
          'azul',
          24152,
          62,
          2,
          62,
          62,
          1
     ),
     (
          'Ford Focus en perfecto estado',
          9300,
          '2022-05-04',
          63,
          18,
          'azul',
          24152,
          63,
          2,
          63,
          63,
          2
     ),
     (
          'Ford Kuga en perfecto estado',
          9900,
          '2022-05-05',
          64,
          18,
          'granate',
          24152,
          64,
          2,
          64,
          64,
          1
     ),
     (
          'Ford Explorer en perfecto estado',
          16780,
          '2022-05-06',
          65,
          18,
          'azul',
          24152,
          65,
          2,
          65,
          65,
          2
     ),
     (
          'Seat León en perfecto estado',
          15200,
          '2022-05-11',
          66,
          18,
          'rojo',
          24152,
          66,
          21,
          66,
          66,
          1
     ),
     (
          'Seat Ibiza en perfecto estado',
          10100,
          '2022-05-11',
          67,
          18,
          'oro rosa',
          24152,
          67,
          21,
          67,
          67,
          2
     ),
     (
          'Seat Arona en perfecto estado',
          2800,
          '2022-05-14',
          68,
          18,
          'gris',
          24152,
          68,
          21,
          68,
          68,
          1
     ),
     (
          'Seat Ateca en perfecto estado',
          6300,
          '2022-09-14',
          69,
          18,
          'verde',
          24152,
          69,
          21,
          69,
          69,
          2
     ),
     (
          'Volvo S90 en perfecto estado',
          20500,
          '2022-10-14',
          70,
          18,
          'gris',
          24152,
          70,
          9,
          70,
          70,
          1
     ),
     (
          'Honda CR-V en perfecto estado',
          19900,
          '2022-11-21',
          71,
          18,
          'azul',
          24152,
          71,
          5,
          71,
          71,
          1
     ),
     (
          'Honda Civic en perfecto estado',
          12300,
          '2022-11-28',
          72,
          18,
          'azul',
          24152,
          72,
          5,
          72,
          72,
          1
     ),
     (
          'Honda Accord en perfecto estado',
          13000,
          '2022-11-01',
          73,
          18,
          'blanco',
          24152,
          73,
          5,
          73,
          73,
          2
     ),
     (
          'Mazda CX-5 en perfecto estado',
          9880,
          '2022-11-07',
          74,
          18,
          'rojo',
          24152,
          74,
          13,
          74,
          74,
          4
     ),
     (
          'Honda CR-V en perfecto estado',
          9990,
          '2022-12-12',
          75,
          18,
          'gris',
          24152,
          75,
          5,
          75,
          75,
          3
     ),
     (
          'Toyota Rav-4 en perfecto estado',
          10100,
          '2022-10-18',
          76,
          18,
          'negro',
          24152,
          76,
          1,
          76,
          76,
          3
     ),
     (
          'Volkswagen Tiguan  en perfecto estado',
          20090,
          '2022-09-07',
          77,
          18,
          'azul',
          24152,
          77,
          3,
          77,
          77,
          2
     ),
     (
          'Ford EcoSport en perfecto estado',
          7900,
          '2022-08-14',
          78,
          18,
          'azul',
          24152,
          78,
          2,
          78,
          78,
          4
     ),
     (
          'Ford Explorer en perfecto estado',
          19990,
          '2022-07-19',
          79,
          18,
          'granate',
          24152,
          79,
          2,
          79,
          79,
          1
     ),
     (
          'Ford Escape en perfecto estado',
          18000,
          '2022-05-14',
          80,
          18,
          'azul',
          24152,
          80,
          2,
          80,
          80,
          1
     ),
     (
          'Ford Bronco en perfecto estado',
          23000,
          '2022-02-14',
          81,
          18,
          'rojo',
          24152,
          81,
          2,
          81,
          81,
          1
     ),
     (
          'Dodge RAM en perfecto estado',
          42200,
          '2023-01-11',
          82,
          19,
          'marrón',
          24152,
          82,
          22,
          82,
          82,
          1
     ),
     (
          'Jeep Wrangler en perfecto estado',
          18800,
          '2022-03-12',
          83,
          19,
          'verde',
          24152,
          83,
          26,
          83,
          83,
          1
     ),
     (
          'Jeep Cherokee en perfecto estado',
          15200,
          '2022-05-09',
          84,
          19,
          'gris',
          24152,
          84,
          26,
          84,
          84,
          1
     ),
     (
          'Kia Soul en perfecto estado',
          9999,
          '2022-11-11',
          85,
          19,
          'azul',
          24152,
          85,
          18,
          85,
          85,
          1
     ),
     (
          'Kia Rio en perfecto estado',
          7000,
          '2022-05-21',
          86,
          19,
          'azul',
          24152,
          86,
          18,
          86,
          86,
          1
     ),
     (
          'Kia Sorento en perfecto estado',
          8200,
          '2021-05-11',
          87,
          19,
          'blanco',
          24152,
          87,
          18,
          87,
          87,
          1
     ),
     (
          'Kia Cadenza en perfecto estado',
          9320,
          '2022-02-19',
          88,
          19,
          'azul oscuro',
          24152,
          88,
          18,
          88,
          88,
          1
     ),
     (
          'Mercedes Clase C en perfecto estado',
          22100,
          '2022-06-01',
          89,
          19,
          'blanco',
          24152,
          89,
          7,
          89,
          89,
          2
     ),
     (
          'Mercedes Clase E en perfecto estado',
          39900,
          '2022-10-11',
          90,
          19,
          'gris',
          24152,
          90,
          7,
          90,
          90,
          2
     ),
     (
          'Mercedes GLA en perfecto estado',
          55200,
          '2022-07-18',
          91,
          19,
          'blanco',
          24152,
          91,
          7,
          91,
          91,
          1
     ),
     (
          'Mercedes Coupé perfecto estado',
          62200,
          '2022-03-18',
          92,
          19,
          'gris',
          24152,
          92,
          7,
          92,
          92,
          2
     ),
     (
          'Ford Kuga en perfecto estado',
          15201,
          '2023-01-21',
          93,
          19,
          'azul',
          24152,
          93,
          2,
          93,
          93,
          2
     ),
     (
          'Ford Fiesta en perfecto estado',
          2900,
          '2022-05-09',
          94,
          19,
          'blanco',
          24152,
          94,
          2,
          94,
          94,
          1
     ),
     (
          'Ford Focus en perfecto estado',
          10100,
          '2022-09-21',
          95,
          19,
          'verde',
          24152,
          95,
          2,
          95,
          95,
          1
     ),
     (
          'Ford Mustang en perfecto estado',
          39900,
          '2023-03-11',
          96,
          19,
          'azul',
          24152,
          96,
          2,
          96,
          96,
          1
     ),
     (
          'Volvo S60 en perfecto estado',
          22000,
          '2022-07-18',
          97,
          19,
          'gris',
          24152,
          97,
          9,
          97,
          97,
          4
     ),
     (
          'Volvo XC60 en perfecto estado',
          29900,
          '2022-09-21',
          98,
          19,
          'blanco',
          24152,
          98,
          9,
          98,
          98,
          1
     ),
     (
          'Volvo XC90 en perfecto estado',
          31900,
          '2022-08-22',
          99,
          19,
          'gris',
          24152,
          99,
          9,
          99,
          99,
          1
     ),
     (
          'Golf GTI en perfecto estado',
          18200,
          '2023-04-11',
          100,
          19,
          'rojo',
          24152,
          100,
          3,
          100,
          100,
          1
     ),
     (
          'Volkswagen Passat en perfecto estado',
          18200,
          '2022-07-01',
          101,
          19,
          'gris',
          24152,
          101,
          3,
          101,
          101,
          2
     ),
     (
          'Volkswagen Touareg en perfecto estado',
          25200,
          '2021-10-11',
          102,
          19,
          'dorado',
          24152,
          102,
          3,
          102,
          102,
          2
     ),
     (
          'Seat Ibiza en perfecto estado',
          19990,
          '2022-01-11',
          103,
          20,
          'amarillo',
          24152,
          103,
          21,
          103,
          103,
          2
     ),
     (
          'Seat Ibiza en perfecto estado',
          14900,
          '2022-05-19',
          104,
          20,
          'rojo',
          24152,
          104,
          21,
          104,
          104,
          2
     ),
     (
          'Seat Ibiza en perfecto estado',
          13000,
          '2022-05-19',
          105,
          20,
          'gris',
          24152,
          105,
          21,
          105,
          105,
          2
     ),
     (
          'Seat Ibiza en perfecto estado',
          13500,
          '2022-04-19',
          106,
          20,
          'blanco',
          24152,
          106,
          21,
          106,
          106,
          1
     ),
     (
          'Kawasaki Ninja en perfecto estado',
          5200,
          '2022-03-20',
          107,
          20,
          'verde',
          24152,
          107,
          26,
          107,
          107,
          1
     ),
     (
          'Honda CBR en perfecto estado',
          4800,
          '2022-08-10',
          108,
          20,
          'rojo',
          24152,
          108,
          5,
          108,
          108,
          1
     ),
     (
          'KTM MT en perfecto estado',
          3200,
          '2022-07-12',
          109,
          20,
          'naranja',
          24152,
          109,
          25,
          109,
          109,
          1
     ),
     (
          'Yamaha en perfecto estado',
          4900,
          '2022-11-11',
          110,
          20,
          'negro',
          24152,
          110,
          27,
          110,
          110,
          1
     ),
     (
          'Ducati en perfecto estado',
          12200,
          '2022-12-12',
          111,
          20,
          'rojo',
          24152,
          111,
          23,
          111,
          111,
          1
     ),
     (
          'Dodge RAM en perfecto estado',
          19820,
          '2021-12-10',
          112,
          20,
          'negro',
          24152,
          112,
          22,
          112,
          112,
          2
     ),
     (
          'Ford F-150 en perfecto estado',
          32000,
          '2023-02-28',
          113,
          20,
          'rojo',
          24152,
          113,
          2,
          113,
          113,
          2
     ),
     (
          'GMC Sierra en perfecto estado',
          22000,
          '2022-10-10',
          114,
          20,
          'rojo',
          24152,
          114,
          24,
          114,
          114,
          1
     ),
     (
          'Toyota Tundra en perfecto estado',
          23300,
          '2022-01-02',
          115,
          18,
          'negro',
          31458,
          115,
          2,
          115,
          115,
          1
     ),
     (
          'Chevrolet Silverado en perfecto estado',
          29000,
          '2022-05-31',
          116,
          20,
          'gris',
          24152,
          116,
          11,
          116,
          116,
          3
     );

-- Nuevos inserts  en la tabla modelo
INSERT INTO
     model (
          name,
          series,
          engine_type_id,
          release_year,
          brand_id,
          vehicle_type_id
     )
VALUES
     ('Civic', 'Type R', 1, 2004, 5, 1),
     ('AE86', 'hachi-Roku', 1, 1983, 1, 1);

-- Nuevos inserts  en la tabla motorización
INSERT INTO
     motorization (model_id, engine_type_id, displacement, power)
VALUES
     (117, 1, 2.0, 200),
     (118, 1, 1.6, 120);

-- Nuevos inserts  en la tabla prestaciones
INSERT INTO
     benefits (
          model_id,
          max_velocity,
          acceleration_0_100,
          consumption
     )
VALUES
     (117, 235, 6.6, 9.0),
     (118, 195, 8.5, 9.2);

-- Nuevo insert  en la tabla propietario
INSERT INTO
     user_app (email, password)
VALUES
     ('minatonamikaze@gmail.com', 'clave123');

-- Nuevo insert  en la tabla propietario
INSERT INTO
     seller_user (name, NIF, email, phoneNumber, user_app_id)
VALUES
     (
          'Minato Namikaze',
          '43714646M',
          'minatonamikaze@gmail.com',
          '666-1234',
          21
     );

-- Nuevos inserts  en la tabla multimedia
INSERT INTO
     multimedia (model_id, photo1, photo2, photo3, photo4, photo5)
VALUES
     (
          117,
          '../images/advertisementImages/63946c29f0993d82e8101942_1.PNG',
          '../images/advertisementImages/autowp.ru_honda_civic_type-r_30th_anniversary_1.jpg',
          '../images/advertisementImages/honda_civic_type-r_80.jpeg',
          '../images/advertisementImages/i170479.jpg',
          '../images/advertisementImages/honda_civic_type-r_22.jpg'
     ),
     (
          118,
          '../images/advertisementImages/7.jpg',
          '../images/advertisementImages/1366_2002.jpg',
          '../images/advertisementImages/1366_2003.jpg',
          '../images/advertisementImages/1366_2000.jpg',
          '../images/advertisementImages/1366_2001.jpg'
     );

-- Nuevos inserts  en la tabla anuncio
INSERT INTO
     advertisement (
          description,
          price,
          publication_date,
          model_id,
          seller_user_id,
          color,
          km,
          multimedia_id,
          brand_id,
          motorization_id,
          benefits_id,
          engine_type_id
     )
VALUES
     (
          'Fabuloso Type R',
          15000,
          '2022-04-13',
          117,
          21,
          'rojo',
          15002,
          117,
          5,
          117,
          117,
          1
     ),
     (
          'Hachi-Roku, oprtunidad única',
          60000,
          '2022-04-18',
          118,
          21,
          'blanco',
          41897,
          118,
          1,
          118,
          118,
          1
     );

-- Añade a la tabla anuncio la columna 'kilometraje'
-- ALTER TABLE anuncio
-- ADD kilometraje INT(10);