DROP DATABASE IF EXISTS `voedselbank`;
CREATE DATABASE IF NOT EXISTS `voedselbank`;

USE `voedselbank`;

-- maken Productperleverancier tabel
-- koppeltabel leverancier---product
DROP TABLE IF EXISTS ProductPerLeverancier;
CREATE TABLE ProductPerLeverancier (
  id int(6) UNSIGNED NOT NULL AUTO_INCREMENT,
  leverancierId int(6) UNSIGNED NOT NULL,
  productId int(6) UNSIGNED NOT NULL,
  datumeerstvolgendelevering date NOT NULL,
  tijdeerstvolgendelevering time NOT NULL,
  isActive bit NOT NULL DEFAULT 1,
  comment varchar(250) NULL,
  createdAt datetime(6) NOT NULL,
  updatedAt datetime(6) NOT NULL,
  CONSTRAINT PK_ProductPerLeverancier_Id PRIMARY KEY CLUSTERED (id)
)ENGINE=InnoDB;

-- toeveogen data in productpereverancier tabel
INSERT INTO ProductPerLeverancier (leverancierId, productId, datumeerstvolgendelevering, tijdeerstvolgendelevering, isActive, comment, createdAt, updatedAt)
VALUES
    (1, 1, '2023-06-19', '09:00:00', 1, NULL, SYSDATE(6), SYSDATE(6)),
    (2, 3, '2023-06-20', '14:30:00', 1,NULL, SYSDATE(6), SYSDATE(6)),
    (3, 2, '2023-06-21', '11:45:00', 1, NULL, SYSDATE(6), SYSDATE(6)),
    (4, 4, '2023-06-22', '12:30:00', 1, NULL, SYSDATE(6), SYSDATE(6)),
    (5,5, '2023-06-23', '13:30:00',1,NULL, SYSDATE(6), SYSDATE(6));

-- maken leverancier tabel
DROP TABLE IF EXISTS Leverancier;
CREATE TABLE Leverancier (
  id int(6) UNSIGNED NOT NULL AUTO_INCREMENT,
  bedrijfsnaam varchar(50) NOT NULL,
  contactpersoon varchar(50) NOT NULL,
  email varchar(50) NOT NULL,
  telefoonnummer varchar(11) NOT NULL,
  isActive bit NOT NULL DEFAULT 1,
  comment varchar(250) NULL,
  createdAt datetime(6) NOT NULL,
  updatedAt datetime(6) NOT NULL,
  CONSTRAINT PK_Leverancier_Id PRIMARY KEY CLUSTERED (id)
)ENGINE=InnoDB;

-- Insert data in leverancier tabel
INSERT INTO Leverancier (bedrijfsnaam, contactpersoon, email, telefoonnummer, isActive, comment, createdAt, updatedAt)
VALUES
  ('Albert Heijn Kerckebosch', 'Albert Heijn', 'Albert@example.com', '06-12345678', 1, NULL, SYSDATE(6), SYSDATE(6)),
  ('Jumbo', 'Bob Boom', 'bobBoom@example.com', '06-76543210', 1, NULL, SYSDATE(6), SYSDATE(6)),
  ('Plus', 'Henk Vis', 'HenkVis@example.com', '06-67890123', 1, NULL, SYSDATE(6), SYSDATE(6)),
  ('Lidl', 'Dominique Stam', 'DominiqueStam@example.com', '06-76543210', 1, NULL, SYSDATE(6), SYSDATE(6)),
  ('Aldi', 'Hans van Duin', 'Hansvduin@example.com', '06-76543210', 1, NULL, SYSDATE(6), SYSDATE(6));


-- Maken adres tabel
DROP TABLE IF EXISTS Adres;
CREATE TABLE Adres (
  id int(6) UNSIGNED NOT NULL AUTO_INCREMENT,
  leverancierId int(6) UNSIGNED NOT NULL,
  adres varchar(50) NOT NULL,
  isActive bit NOT NULL DEFAULT 1,
  comment varchar(250) NULL,
  createdAt datetime(6) NOT NULL,
  updatedAt datetime(6) NOT NULL,
  CONSTRAINT PK_Adres_Id PRIMARY KEY CLUSTERED (id),
  CONSTRAINT FK_Adres_LeverancierId FOREIGN KEY (leverancierId) REFERENCES Leverancier(id)
) ENGINE=InnoDB;

-- Insert data into Adres tabel
INSERT INTO Adres (leverancierId, adres, isActive, comment, createdAt, updatedAt)
VALUES
  (1, 'Provincialeweg 11 Zaandam', 1, NULL, SYSDATE(6), SYSDATE(6)),
  (2, 'Baroniestraat 10B Utrecht', 1, NULL, SYSDATE(6), SYSDATE(6)),
  (3, 'Beatrixlaan 10 Zwolle',1, NULL, SYSDATE(6), SYSDATE(6)),
  (4, 'Alexanderlaan 23 Den Haag', 1, NULL, SYSDATE(6), SYSDATE(6)),
  (5, 'Willenvanoranjestraat Den Haag', 1, NULL, SYSDATE(6), SYSDATE(6));

-- maken allergie tabel
DROP TABLE IF EXISTS Allergie;
CREATE TABLE Allergie (
  `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT,
  `klantId` int(6) UNSIGNED NOT NULL,
  `klantWensId` int(6) UNSIGNED NOT NULL,
  `isActive` bit NOT NULL DEFAULT 1,
  `comment` varchar(250) NULL,
  `createdAt` datetime(6) NOT NULL,
  `updatedAt` datetime(6) NOT NULL,
  CONSTRAINT PK_Allergie_Id PRIMARY KEY CLUSTERED (id),
  CONSTRAINT FK_Allergie_klantId FOREIGN KEY (klantId) REFERENCES Klant(id),
  CONSTRAINT FK_Allergi_klantWensID FOREIGN KEY (klantWensId) REFERENCES KlantWens(id)
)ENGINE=InnoDB;

-- toevoegen data in allergie tabel
INSERT INTO Allergie (klantId, klantWensId, isActive, comment, createdAt, updatedAt)
VALUES 
    (1,1,1,NULL, SYSDATE(6), SYSDATE(6)),
    (2,2,1,NULL, SYSDATE(6), SYSDATE(6)),
    (3,3,1,NULL, SYSDATE(6), SYSDATE(6)),
    (4,4,1,NULL, SYSDATE(6), SYSDATE(6)),
    (5,5,1,NULL, SYSDATE(6), SYSDATE(6));

-- maken medewerker tabel
DROP TABLE IF EXISTS Medewerker;
CREATE TABLE Medewerker (
  id int(6) UNSIGNED NOT NULL AUTO_INCREMENT,
  gebruikersnaam varchar(50) NOT NULL,
  wachtwoord varchar(50) NOT NULL,
  email varchar(50) NOT NULL,
  rolId int(6) UNSIGNED NOT NULL,
  isActive bit NOT NULL DEFAULT 1,
  comment varchar(250) NULL,
  createdAt datetime(6) NOT NULL,
  updatedAt datetime(6) NOT NULL,
  CONSTRAINT PK_Medewerker_Id PRIMARY KEY CLUSTERED (id),
  CONSTRAINT FK_Medwerker_rolId FOREIGN KEY (rolId) REFERENCES Rol(id)
) ENGINE=InnoDB;

-- toeveogen data in medewerker tabel
INSERT INTO Medewerker (gebruikersnaam, wachtwoord, email, rolId, isActive, comment, createdAt, updatedAt)
VALUES
    ('hans13', 'jfodqda', 'hansmed@example.com',2,1,NULL,SYSDATE(6), SYSDATE(6)),
    ('bert14', 'dsfdaf', 'gertmed@example.com',2,1,NULL,SYSDATE(6), SYSDATE(6)),
    ('gerda15', 'afdafdsa', 'gerdamed@example.com',2,1,NULL,SYSDATE(6), SYSDATE(6)),
    ('bob16', 'adfasfd', 'bobtmed@example.com',2,1,NULL,SYSDATE(6), SYSDATE(6)),
    ('karel15', 'dafsfdf', 'karelmed@example.com',2,1,NULL,SYSDATE(6), SYSDATE(6));


-- maken rol tabel
DROP TABLE IF EXISTS Rol;
CREATE TABLE Rol (
  id int(6) UNSIGNED NOT NULL AUTO_INCREMENT,
  rol varchar(50) NOT NULL,
  isActive bit NOT NULL DEFAULT 1,
  comment varchar(250) NULL,
  createdAt datetime(6) NOT NULL,
  updatedAt datetime(6) NOT NULL,
  CONSTRAINT PK_Rol_Id PRIMARY KEY CLUSTERED (id)
) ENGINE=InnoDB;

-- Toeveogen data in ROl tabel
INSERT INTO Rol (rol, isActive, comment, createdAt, updatedAt)
VALUES
    ('Directie',1,NULL,  SYSDATE(6), SYSDATE(6)),
    ('Medewerker',1,NULL,  SYSDATE(6), SYSDATE(6)),
    ('Vrijwilliger',1,NULL,  SYSDATE(6), SYSDATE(6));

-- Maken klant tabel
DROP TABLE IF EXISTS Klant;
CREATE TABLE Klant (
  id int(6) UNSIGNED NOT NULL AUTO_INCREMENT,
  gezinsnaam varchar(50) NOT NULL,
  adres varchar(50) NOT NULL,
  telefoon varchar(11) NOT NULL,
  email varchar(50) NOT NULL,
  aantalvolwassenen varchar(2) NOT NULL,
  aantalkinderen varchar(2) NULL,
  aantalbaby varchar(2) NULL,
  isActive bit NOT NULL DEFAULT 1,
  comment varchar(250) NULL,
  createdAt datetime(6) NOT NULL,
  updatedAt datetime(6) NOT NULL,
  CONSTRAINT PK_Klant_Id PRIMARY KEY CLUSTERED (id)
)ENGINE=InnoDB;

-- Toevoegen data in Klant tabel
INSERT INTO Klant (gezinsnaam, adres, telefoon, email, aantalvolwassenen, aantalkinderen, aantalbaby,isActive,comment, createdAt, updatedAt)
VALUES 
    ('van Dam', 'oranjeplein 13', '06-12345678','lindaVanDam@example.com','2','1','1',1,NULL, SYSDATE(6), SYSDATE(6)),
    ('van Oranje', 'WimHoogendoornplein 14', '06-09474831','HenkVanOranje@example.com','1','2',NULL,1,NULL, SYSDATE(6), SYSDATE(6)),
    ('Jansen', 'Beatrixplein 122', '06-65492041','WillemJansen@example.com','2','1',NULL,1,NULL, SYSDATE(6), SYSDATE(6)),
    ('Doorn', 'Willenvanoranjestraat 11', '06-53932323','LisaDoorn@example.com','2',NULL,NULL,1,NULL, SYSDATE(6), SYSDATE(6)),
    ('Huizinga', 'Wilhelminaplein 12', '06-44365477','BobHuizinga@example.com','2','2','1',1,NULL, SYSDATE(6), SYSDATE(6));

-- Maken KlantWens tabel
DROP TABLE IF EXISTS KlantWens;
CREATE TABLE KlantWens (
  id int(6) UNSIGNED NOT NULL AUTO_INCREMENT,
  wens varchar(50) NULL,
  isActive bit NOT NULL DEFAULT 1,
  comment varchar(250) NULL,
  createdAt datetime(6) NOT NULL,
  updatedAt datetime(6) NOT NULL,
  CONSTRAINT PK_KlantWens_Id PRIMARY KEY CLUSTERED (id)
)ENGINE=InnoDB;

-- Toevoegen data in KlantWens tabel
INSERT INTO KlantWens (wens, isActive, comment, createdAt, updatedAt)
VALUES
    (NULL, 1, NULL, SYSDATE(6), SYSDATE(6)),
    ('Geen varkensvlees', 1, NULL, SYSDATE(6), SYSDATE(6)),
    ('Geen noten', 1, NULL, SYSDATE(6), SYSDATE(6)),
    ('Veganistisch', 1, NULL, SYSDATE(6), SYSDATE(6)),
    ('Geen vis', 1, NULL, SYSDATE(6), SYSDATE(6));

-- Maken tabel WensPerKlant
DROP TABLE IF EXISTS WensPerKlant;
CREATE TABLE WensPerKlant (
  id int(6) UNSIGNED NOT NULL AUTO_INCREMENT,
  klantId int(6) UNSIGNED NOT NULL,
  klantWensId int(6) UNSIGNED NOT NULL,
  isActive bit NOT NULL DEFAULT 1,
  comment varchar(250) NULL,
  createdAt datetime(6) NOT NULL,
  updatedAt datetime(6) NOT NULL,
  CONSTRAINT PK_Klant_Id PRIMARY KEY CLUSTERED (id),
  CONSTRAINT FK_WensPerKlant_KlantId FOREIGN KEY (klantId) REFERENCES Klant(id),
  CONSTRAINT FK_WensPerKlant_KlantWensId FOREIGN KEY (klantWensId) REFERENCES KlantWens(id)
)ENGINE=InnoDB;

-- Toevoegen data in wensPerKlant tabel
INSERT INTO WensPerKlant (klantId, klantWensId, isActive, comment, createdAt, updatedAt)
VALUES
    (1,1,1,NULL,SYSDATE(6),SYSDATE(6)),
    (2,2,1,NULL,SYSDATE(6),SYSDATE(6)),
    (3,3,1,NULL,SYSDATE(6),SYSDATE(6)),
    (4,4,1,NULL,SYSDATE(6),SYSDATE(6)),
    (5,5,1,NULL,SYSDATE(6),SYSDATE(6));

-- Maken Pakket tabel
DROP TABLE IF EXISTS Pakket;
CREATE TABLE Pakket (
  id int(6) UNSIGNED NOT NULL AUTO_INCREMENT,
  isActive bit NOT NULL DEFAULT 1,
  comment varchar(250) NULL,
  createdAt datetime(6) NOT NULL,
  updatedAt datetime(6) NOT NULL,
  CONSTRAINT PK_Pakket_Id PRIMARY KEY CLUSTERED (id)
)ENGINE=InnoDB;

-- Toevoegen data in Pakket tabel
INSERT INTO Pakket (isActive, comment, createdAt, updatedAt)
VALUES
    (1,NULL,SYSDATE(6),SYSDATE(6)),
    (1,NULL,SYSDATE(6),SYSDATE(6)),
    (1,NULL,SYSDATE(6),SYSDATE(6)),
    (1,NULL,SYSDATE(6),SYSDATE(6)),
    (1,NULL,SYSDATE(6),SYSDATE(6));


-- maken tabel Product
DROP TABLE IF EXISTS Product;
CREATE TABLE Product (
  id int(6) UNSIGNED NOT NULL AUTO_INCREMENT,
  productnaam varchar(50) NOT NULL,
  productcategorieId int(6) UNSIGNED NOT NULL,
  EAN int(13) NOT NULL,
  vooraad int(6) NOT NULL,
  isActive bit NOT NULL DEFAULT 1,
  comment varchar(250) NULL,
  createdAt datetime(6) NOT NULL,
  updatedAt datetime(6) NOT NULL,
  CONSTRAINT PK_Product_id PRIMARY KEY CLUSTERED (id),
  CONSTRAINT FK_Product_ProductcategorieId FOREIGN KEY (ProductcategorieId) REFERENCES Productcategorie (id)
)ENGINE=InnoDB;

-- Toevoegen data in Product tabel
INSERT INTO Product (productnaam, productcategorieId, EAN, vooraad, isActive, comment, createdAt, updatedAt)
VALUES
    ('Appel', 1, 123456789, 10, 1, NULL, SYSDATE(6), SYSDATE(6)),
    ('Volkoren brood', 2, 234567890, 15, 1, NULL, SYSDATE(6), SYSDATE(6)),
    ('Melk', 1, 345678901, 20, 1, NULL, SYSDATE(6), SYSDATE(6)),
    ('Kaas',1, 123498765, 14,1, NULL, SYSDATE(6), SYSDATE(6)),
    ('Cola',2, 643920428,11,1,NULL, SYSDATE(6), SYSDATE(6)),
    ('Cassis',2,123843202,13,1,NULL, SYSDATE(6), SYSDATE(6));


-- Maken tabel ProductPerPakket
-- koppeltabel product>--pakket
DROP TABLE IF EXISTS ProducPerPakket;
CREATE TABLE ProductPerPakket (
  id int(6) UNSIGNED NOT NULL AUTO_INCREMENT,
  pakketId int(6) UNSIGNED NOT NULL,
  productId int(6) UNSIGNED NOT NULL,
  isActive bit NOT NULL DEFAULT 1,
  comment varchar(250) NULL,
  createdAt datetime(6) NOT NULL,
  updatedAt datetime(6) NOT NULL,
  CONSTRAINT PK_ProductPerPakket_Id PRIMARY KEY CLUSTERED (id),
  CONSTRAINT FK_ProductPerPakket_pakketId FOREIGN KEY (pakketid) REFERENCES Pakket(id),
  CONSTRAINT FK_ProductPerPakket_productId FOREIGN KEY (productId) REFERENCES Product(id)
)ENGINE=InnoDB;

-- Toevoegen data in ProductPerPaket tabel
INSERT INTO ProductPerPakket(pakketId, productId, isActive, comment, createdAt, updatedAt)
VALUES
    (1,1,1,NOT NULL, SYSDATE(6),SYSDATE(6)),
    (1,2,1,NOT NULL, SYSDATE(6),SYSDATE(6)),
    (1,3,1,NOT NULL, SYSDATE(6),SYSDATE(6)),
    (1,4,1,NOT NULL, SYSDATE(6),SYSDATE(6)),
    (1,5,1,NOT NULL, SYSDATE(6),SYSDATE(6));

-- Maken tabel ProductCategorie
DROP TABLE IF EXISTS ProductCategorie;
CREATE TABLE ProductCategorie (
  id int(6) UNSIGNED NOT NULL AUTO_INCREMENT,
  categorienaam varchar(50) NOT NULL,
  isActive bit NOT NULL DEFAULT 1,
  comment varchar(250) NULL,
  createdAt datetime(6) NOT NULL,
  updatedAt datetime(6) NOT NULL,
  CONSTRAINT PK_ProductPerCategorie_Id PRIMARY KEY CLUSTERED (id)
)ENGINE=InnoDB;

-- Toevoegen data in de tabel ProductCategorie
INSERT INTO ProductCategorie (categorienaam,isActive,comment,createdAt,updatedAt)
VALUES
    ('Zuivel',1,NOT NULL, SYSDATE(6),SYSDATE(6)),
    ('Frisdrank',1,NOT NULL, SYSDATE(6),SYSDATE(6)),
    ('Fruit',1,NOT NULL, SYSDATE(6),SYSDATE(6)),
    ('Groente',1,NOT NULL, SYSDATE(6),SYSDATE(6)),
    ('Snoep',1,NOT NULL, SYSDATE(6),SYSDATE(6));