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
create table Leverancier(
 Id int(6) UNSIGNED NOT NULL AUTO_INCREMENT
,Naam varchar(100) not null
,ContactPersoon varchar(100) not null
,LeverancierNummer varchar(5) not null
,LeverancierType varchar(100) not null
,IsActive tinyint not null
,Opmerking varchar(255) null
,DatumAangemaakt datetime not null
,DatumGewijzigd datetime not null
,CONSTRAINT PK_Leverancier_Id PRIMARY KEY (Id)
)engine = innodb;


-- Insert data in leverancier tabel
INSERT INTO `Leverancier` (
    `Id`,
    `Naam`,
    `ContactPersoon`,
    `LeverancierNummer`,
    `LeverancierType`,
    `IsActive`,
    `Opmerking`,
    `DatumAangemaakt`,
    `DatumGewijzigd`)
    VALUES
	 (NULL, 'Albert Heijn', 'Ruud ter Weijden', 'L0001', 'Bedrijf', 1, '', SYSDATE(), SYSDATE())
	,(NULL, 'Albertus Kerk', 'Leo Pastoor', 'L0002', 'Instelling', 1, '', SYSDATE(), SYSDATE())
    ,(NULL, 'Gemeente Utrecht', 'Mohammed Yazidi', 'L0003', 'Overheid', 1, '', SYSDATE(), SYSDATE())
    ,(NULL, 'Boerderij Meerhoven', 'Bertus van Driel', 'L0004', 'Particulier', 1, '', SYSDATE(), SYSDATE())
    ,(NULL, 'Jan van der Heijden', 'Jan van der Heijden', 'L0005', 'Donor', 1, '', SYSDATE(), SYSDATE())
    ,(NULL, 'Vomar', 'Jaco Pastorius', 'L0006', 'Bedrijf', 1, '', SYSDATE(), SYSDATE())
    ,(NULL, 'DekaMarkt', 'Sil den Dollaard', 'L0007', 'Bedrijf', 1, '', SYSDATE(), SYSDATE())
    ,(NULL, 'Gemeente Vught', 'Jan Blokker', 'L0008', 'Overheid', 1, '', SYSDATE(), SYSDATE());
    

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
  CONSTRAINT FK_Adres_LeverancierId FOREIGN KEY (leverancierId) REFERENCES Leverancier(Id)
) ENGINE=InnoDB;

-- Insert data into Adres tabel
INSERT INTO Adres (leverancierId, adres, isActive, comment, createdAt, updatedAt)
VALUES
  (1, 'Provincialeweg 11 Zaandam', 1, NULL, SYSDATE(6), SYSDATE(6)),
  (2, 'Baroniestraat 10B Utrecht', 1, NULL, SYSDATE(6), SYSDATE(6)),
  (3, 'Beatrixlaan 10 Zwolle',1, NULL, SYSDATE(6), SYSDATE(6)),
  (4, 'Alexanderlaan 23 Den Haag', 1, NULL, SYSDATE(6), SYSDATE(6)),
  (5, 'Willenvanoranjestraat Den Haag', 1, NULL, SYSDATE(6), SYSDATE(6));

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
  CONSTRAINT FK_Allergie_klantWensId FOREIGN KEY (klantWensId) REFERENCES KlantWens(id)
)ENGINE=InnoDB;

-- toevoegen data in allergie tabel
INSERT INTO Allergie (klantId, klantWensId, isActive, comment, createdAt, updatedAt)
VALUES 
    (1,1,1,NULL, SYSDATE(6), SYSDATE(6)),
    (2,2,1,NULL, SYSDATE(6), SYSDATE(6)),
    (3,3,1,NULL, SYSDATE(6), SYSDATE(6)),
    (4,4,1,NULL, SYSDATE(6), SYSDATE(6)),
    (5,5,1,NULL, SYSDATE(6), SYSDATE(6));

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




-
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


-- maken tabel Product
DROP TABLE IF EXISTS Product;
create table Product(
 Id int not null auto_increment primary key
,ProductCategorieId int not null
,Naam varchar(100) not null
,SoortAllergie varchar(100) null
,Barcode varchar(100) not null
,Houdbaarheidsdatum date not null
,Omschrijving varchar(250) not null
,Status varchar(100) not null
,IsActive tinyint not null
,Opmerking varchar(255) null
,DatumAangemaakt datetime not null
,DatumGewijzigd datetime not null
)engine = innodb;

-- Toevoegen data in Product tabel
INSERT INTO `Product` (
    `Id`,
    `ProductCategorieId`,
    `Naam`,
    `SoortAllergie`,
    `Barcode`,
    `Houdbaarheidsdatum`,
    `Omschrijving`,
    `Status`,
    `IsActive`,
    `Opmerking`,
    `DatumAangemaakt`,
    `DatumGewijzigd`)
    VALUES
	 (NULL, 1, 'Aardappel', NULL, 8719587321239, '2023-06-12', 'Kruimige aardappel', 'OpVoorraad', 1, NULL, SYSDATE(), SYSDATE())
    ,(NULL, 1, 'Ui', NULL, 8719437321335, '2023-05-02', 'Gele Ui', 'NietOpVoorraad', 1, NULL, SYSDATE(), SYSDATE())
    ,(NULL, 1, 'Appel', NULL, 8719486321332, '2023-09-16', 'Granny Smith', 'NietLeverbaar', 1, NULL, SYSDATE(), SYSDATE())
	,(NULL, 1, 'Banaan', 'Banaan', 8719484321336, '2023-04-12', 'Biologische Banaan ', 'OverHoudbaarheidsDatum', 1, NULL, SYSDATE(), SYSDATE())
    ,(NULL, 2, 'Kaas', 'Lactose', 8719487421338, '2023-07-19', 'Jonge Kaas', 'OpVoorraad', 1, NULL, SYSDATE(), SYSDATE())
    ,(NULL, 2, 'Rosbief', NULL, 8719487421331, '2023-08-23', 'Rundvlees', 'OpVoorraad', 1, NULL, SYSDATE(), SYSDATE())
    ,(NULL, 3, 'Melk', NULL, 8719447321332, '2023-08-23', 'Halfvolle melk', 'OpVoorraad', 1, NULL, SYSDATE(), SYSDATE())
    ,(NULL, 3, 'Margarine', NULL, 8719486321336,'2023-07-02', 'Plantaardige boter', 'OpVoorraad', 1, NULL, SYSDATE(), SYSDATE())
    ,(NULL, 3, 'Ei', 'Eier', 8719487421334, '2023-02-04', 'Scharrelei', 'OpVoorraad', 1, NULL, SYSDATE(), SYSDATE())
    ,(NULL, 4, 'Brood', 'Gluten', 8719487721337, '2023-05-17', 'Volkoren brood', 'OpVoorraad', 1, NULL, SYSDATE(), SYSDATE())
    ,(NULL, 4, 'Gevulde Koek', 'Amandel', 8719483321333, '2023-05-04', 'Banketbakkers', 'OpVoorraad', 1, NULL, SYSDATE(), SYSDATE())
    ,(NULL, 5, 'Fristi', 'Lactose', 8719487121331, '2023-05-28', 'Frisdrank', 'NietOpVoorraad', 1, NULL, SYSDATE(), SYSDATE())  
    ,(NULL, 5,'Appelsap', NULL, 8719487521335, '2023-05-19', 'vruchtensap', 'OpVoorraad', 1, NULL, SYSDATE(), SYSDATE())
    ,(NULL, 5, 'Koffie', 'Caffeïne', 8719487381338, '2023-05-23', 'Arabica koffie', 'OverHoudbaarheidsDatum', 1, NULL, SYSDATE(), SYSDATE())
    ,(NULL, 5, 'Thee', NULL, 8719487329339, '2023-04-02', 'Ceylon thee', 'OpVoorraad', 1, NULL, SYSDATE(), SYSDATE())
    ,(NULL, 6, 'Pasta', 'Gluten', 8719487321334, '2023-05-16', 'Macaroni', 'NietLeverbaar', 1, NULL, SYSDATE(), SYSDATE())
    ,(NULL, 6, 'Rijst', NULL, 8719487331332, '2023-05-25', 'Basmati', 'OpVoorraad', 1, NULL, SYSDATE(), SYSDATE())
    ,(NULL, 6, 'Knorr Nasi Mix', NULL, 8719487351354, '2023-05-13', 'Nasi', 'OpVoorraad', 1, NULL, SYSDATE(), SYSDATE())
    ,(NULL, 7, 'Tomatensoep', NULL, 8719487371337, '2023-05-23', 'Romige tomatensoep', 'OpVoorraad', 1, NULL, SYSDATE(), SYSDATE())
    ,(NULL, 7, 'Tomatensaus', NULL, 8719487341334, '2023-05-21', 'Pizza saus', 'NietOpVoorraad', 1, NULL, SYSDATE(), SYSDATE())
    ,(NULL, 7, 'Peterselie', NULL, 8719487321636, '2023-05-31', 'Verse kruidenpot', 'OpVoorraad', 1, NULL, SYSDATE(), SYSDATE())
    ,(NULL, 8, 'Olie', NULL, 8719487327337, '2023-05-27', 'Olijfolie', 'OpVoorraad', 1, NULL, SYSDATE(), SYSDATE())
    ,(NULL, 8, 'Mars', NULL, 8719487324334, '2023-05-11', 'Snoep', 'OpVoorraad', 1, NULL, SYSDATE(), SYSDATE())
    ,(NULL, 8, 'Biscuit', NULL, 8719487311331, '2023-05-07', 'San Francisco biscuit', 'OpVoorraad', 1, NULL, SYSDATE(), SYSDATE())
    ,(NULL, 8, 'Paprika Chips', NULL, 8719487321839, '2023-05-22', 'Ribbelchips paprika', 'OpVoorraad', 1, NULL, SYSDATE(), SYSDATE())
    ,(NULL, 8, 'Chocolade reep', 'Cacoa', 8719487321533, '2023-05-21', 'Tony Chocolonely', 'OpVoorraad', 1, NULL, SYSDATE(), SYSDATE())
    ,(NULL, 9, 'Luier', NULL, 8719487321436, '2023-05-30', 'Baby luier', 'OpVoorraad', 1, NULL, SYSDATE(), SYSDATE())
    ,(NULL, 9, 'Scheerschuim', NULL, 8719487323338, '2023-02-22', 'Verzorgende scheerschuim', 'OpVoorraad', 1, NULL, SYSDATE(), SYSDATE())
    ,(NULL, 9, 'Toiletpapier', NULL, 8719487321535, '2023-01-02', 'rollen 3 laags toiletpapier', 'OpVoorraad', 1, NULL, SYSDATE(), SYSDATE());

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






        -- Dag 3 toegevoegde tabellen en data

  DROP TABLE IF EXISTS Contact;
  CREATE TABLE Contact (
    Id INT(6) UNSIGNED NOT NULL AUTO_INCREMENT,
    Straat VARCHAR(255) NOT NULL,
    Huisnummer INT(9) NOT NULL,
    Toevoeging VARCHAR(5) NULL,
    Postcode VARCHAR(6) NOT NULL,
    Woonplaats VARCHAR(100) NOT NULL,
    Adres VARCHAR(110) AS (CASE WHEN Toevoeging IS NULL THEN CONCAT(Straat,' ',Huisnummer) ELSE CONCAT(Straat,' ',Huisnummer, '',Toevoeging)END)STORED,
    Email VARCHAR(50) NOT NULL,
    Mobiel VARCHAR(13) NOT NULL,
    IsActive BIT NOT NULL DEFAULT 1,
    Comment VARCHAR(100) NULL,
    CreatedAt DATETIME(6) NOT NULL,
    UpdatedAt DATETIME(6) NOT NULL,
    CONSTRAINT PK_Contact_Id PRIMARY KEY (Id)
  ) ENGINE=InnoDB;


    INSERT INTO Contact (Id, Straat, Huisnummer, Toevoeging, Postcode, Woonplaats, Email, Mobiel, IsActive, Comment, CreatedAt, UpdatedAt)
    VALUES
    (1, 'Prinses Irenestraat', '12', 'A', '5271TH', 'Maaskantje', 'j.van.zevenhuizen@gmail.com', '+31 623456123',1,NULL,SYSDATE(6),SYSDATE(6)),
    (2, 'Gibraltarstraat', '234', NULL, '5271TJ', 'Maaskantje', 'a.bergkamp@hotmail.com', '+31 623456123',1,NULL,SYSDATE(6),SYSDATE(6)),
    (3, 'Der Kinderenstraat', '456', 'Bis', '5271TH', 'Maaskantje', 's.van.de.heuvel@gmail.com', '+31 623456123',1,NULL,SYSDATE(6),SYSDATE(6)),
    (4, 'Nachtegaalstraat', '233', 'A', '5271TJ', 'Maaskantje', 'e.scherder@gmail.com', '+31 623456123',1,NULL,SYSDATE(6),SYSDATE(6)),
    (5, 'Bertram Russellstraat', '45', NULL, '5271TH', 'Maaskantje', 'f.de.jong@hotmail.com', '+31 623456123',1,NULL,SYSDATE(6),SYSDATE(6)),
    (6, 'Leonardo Da VinciHof', '34', NULL, '5271ZE', 'Maaskantje', 'h.van.der.berg@gmail.com', '+31 623456123',1,NULL,SYSDATE(6),SYSDATE(6)),
    (7, 'Siegfried Knutsenlaan', '234', NULL, '5271ZE', 'Maaskantje', 'r.ter.weijden@ah.nl', '+31 623456123',1,NULL,SYSDATE(6),SYSDATE(6)),
    (8, 'Theo de Bokstraat', '256', NULL, '5271ZH', 'Maaskantje', 'l.pastoor@gmail.com', '+31 623456123',1,NULL,SYSDATE(6),SYSDATE(6)),
    (9, 'Meester van Leerhof', '2', 'A', '5271ZH', 'Maaskantje', 'm.yazidi@gemeenteutrecht.nl', '+31 623456123',1,NULL,SYSDATE(6),SYSDATE(6)),
    (10, 'Van Wemelenplantsoen', '300', NULL, '5271TH', 'Maaskantje', 'b.van.driel@gmail.com', '+31 623456123',1,NULL,SYSDATE(6),SYSDATE(6)),
    (11, 'Terlingenhof', '20', NULL, '5271TH', 'Maaskantje', 'j.pastorius@gmail.com', '+31 623456356',1,NULL,SYSDATE(6),SYSDATE(6)),
    (12, 'Veldhoen', '31', NULL, '5271ZE', 'Maaskantje', 's.dollaard@gmail.com', '+31 623452314',1,NULL,SYSDATE(6),SYSDATE(6)),
    (13, 'ScheringaDreef', '37', NULL, '5271ZE', 'Vught', 'j.blokker@gemeentevught.nl', '+31 623452314',1,NULL,SYSDATE(6),SYSDATE(6));

    DROP TABLE IF EXISTS Gezin;
    CREATE TABLE Gezin (
    Id INT(6) UNSIGNED NOT NULL AUTO_INCREMENT,
    Naam VARCHAR(50),
    Code VARCHAR(10) NOT NULL,
    Omschrijving VARCHAR(50) NOT NULL,
    AantalVolwassenen INT NOT NULL,
    AantalKinderen INT NOT NULL,
    AantalBabys INT NOT NULL,
    TotaalAantalPersonen INT NOT NULL,
    IsActive BIT NOT NULL DEFAULT 1,
    Comment VARCHAR(100) NULL,
    CreatedAt DATETIME(6) NOT NULL,
    UpdatedAt DATETIME(6) NOT NULL,
    CONSTRAINT PK_Gezin_Id PRIMARY KEY (Id)
    )ENGINE=InnoDB;

    INSERT INTO Gezin (Id, Naam, Code, Omschrijving, AantalVolwassenen, AantalKinderen, AantalBabys, TotaalAantalPersonen, IsActive, Comment, CreatedAt, UpdatedAt)
    VALUES
    (1, 'ZevenhuizenGezin', 'G0001', 'Bijstandsgezin', 2, 2, 0, 4,1,NULL,SYSDATE(6),SYSDATE(6)),
    (2, 'BergkampGezin', 'G0002', 'Bijstandsgezin', 2, 1, 1, 4,1,NULL,SYSDATE(6),SYSDATE(6)),
    (3, 'HeuvelGezin', 'G0003', 'Bijstandsgezin', 2, 0, 0, 2,1,NULL,SYSDATE(6),SYSDATE(6)),
    (4, 'ScherderGezin', 'G0004', 'Bijstandsgezin', 1, 0, 2, 3,1,NULL,SYSDATE(6),SYSDATE(6)),
    (5, 'DeJongGezin', 'G0005', 'Bijstandsgezin', 1, 1, 0, 2,1,NULL,SYSDATE(6),SYSDATE(6)),
    (6, 'VanderBergGezin', 'G0006', 'AlleenGaande', 1, 0, 0, 1,1,NULL,SYSDATE(6),SYSDATE(6));

    DROP TABLE IF EXISTS ContactPerGezin;
    CREATE TABLE ContactPerGezin (
    Id INT(6) UNSIGNED NOT NULL AUTO_INCREMENT,
    GezinId INT(6) UNSIGNED NOT NULL,
    ContactId INT(6) UNSIGNED NOT NULL,
    IsActive BIT NOT NULL DEFAULT 1,
    Comment VARCHAR(100) NULL,
    CreatedAt DATETIME(6) NOT NULL,
    UpdatedAt DATETIME(6) NOT NULL,
    CONSTRAINT PK_ContactPerGezin_Id PRIMARY KEY (Id),
    CONSTRAINT FK_ContactPerGezin_GezinId FOREIGN KEY (GezinId) REFERENCES Gezin(Id),
    CONSTRAINT FK_ContactPerGezin_ContactId FOREIGN KEY (ContactId) REFERENCES Contact(Id)
    )ENGINE=InnoDB;

    INSERT INTO ContactPerGezin (Id, GezinId, ContactId, IsActive, Comment, CreatedAt, UpdatedAt)
    VALUES
    (1, 1, 1,1,NULL,SYSDATE(6),SYSDATE(6)),
    (2, 2, 2,1,NULL,SYSDATE(6),SYSDATE(6)),
    (3, 3, 3,1,NULL,SYSDATE(6),SYSDATE(6)),
    (4, 4, 4,1,NULL,SYSDATE(6),SYSDATE(6)),
    (5, 5, 5,1,NULL,SYSDATE(6),SYSDATE(6)),
    (6, 6, 6,1,NULL,SYSDATE(6),SYSDATE(6));

    DROP TABLE IF EXISTS Persoon;
    CREATE TABLE Persoon (
    Id INT(6) UNSIGNED NOT NULL,
    GezinId INT(6) UNSIGNED NULL,
    Voornaam VARCHAR(50) NOT NULL,
    Tussenvoegsel VARCHAR(10) NULL,
    Achternaam VARCHAR(50) NOT NULL,
    Volledignaam VARCHAR(110) AS (CASE WHEN Tussenvoegsel IS NULL THEN CONCAT(Voornaam,' ',Achternaam) ELSE CONCAT(Voornaam,' ',Tussenvoegsel, ' ',Achternaam)END)STORED,
    Geboortedatum DATE NOT NULL,
    TypePersoon VARCHAR(50) NOT NULL,
    IsVertegenwoordiger INT NOT NULL,
    IsActive BIT NOT NULL DEFAULT 1,
    Comment VARCHAR(100) NULL,
    CreatedAt DATETIME(6) NOT NULL,
    UpdatedAt DATETIME(6) NOT NULL,
    CONSTRAINT PK_Persoon_Id PRIMARY KEY (Id),
    CONSTRAINT FK_Persoon_GezinId FOREIGN KEY (GezinId) REFERENCES Gezin(Id)
    )ENGINE=InnoDB;

    INSERT INTO Persoon (Id, GezinId, Voornaam, Tussenvoegsel, Achternaam, Geboortedatum, TypePersoon, IsVertegenwoordiger, IsActive, Comment, CreatedAt, UpdatedAt)
    VALUES
    (1, NULL, 'Hans', 'van', 'Leeuwen', '1958-02-12', 'Manager', 0,1,NULL,SYSDATE(6),SYSDATE(6)),
    (2, NULL, 'Jan', 'van der', 'Sluijs', '1993-04-30', 'Medewerker', 0,1,NULL,SYSDATE(6),SYSDATE(6)),
    (3, NULL, 'Herman', 'den', 'Duiker', '1989-08-30', 'Vrijwilliger', 0,1,NULL,SYSDATE(6),SYSDATE(6)),
    (4, 1, 'Johan', 'van', 'Zevenhuizen', '1990-05-20', 'Klant', 1,1,NULL,SYSDATE(6),SYSDATE(6)),
    (5, 1, 'Sarah', 'den', 'Dolder', '1985-03-23', 'Klant', 0,1,NULL,SYSDATE(6),SYSDATE(6)),
    (6, 1, 'Theo', 'van', 'Zevenhuizen', '2015-03-08', 'Klant', 0,1,NULL,SYSDATE(6),SYSDATE(6)),
    (7, 1, 'Jantien', 'van', 'Zevenhuizen', '2016-09-20', 'Klant', 0,1,NULL,SYSDATE(6),SYSDATE(6)),
    (8, 2, 'Arjan', NULL, 'Bergkamp', '1968-07-12', 'Klant', 1,1,NULL,SYSDATE(6),SYSDATE(6)),
    (9, 2, 'Janneke', NULL, 'Sanders', '1969-05-11', 'Klant', 0,1,NULL,SYSDATE(6),SYSDATE(6)),
    (10, 2, 'Stein', NULL, 'Bergkamp', '2009-02-02', 'Klant', 0,1,NULL,SYSDATE(6),SYSDATE(6)),
    (11, 2, 'Judith', NULL, 'Bergkamp', '2022-02-05', 'Klant', 0,1,NULL,SYSDATE(6),SYSDATE(6)),
    (12, 3, 'Mazin', 'van', 'Vliet', '1968-08-18', 'Klant', 0,1,NULL,SYSDATE(6),SYSDATE(6)),
    (13, 3, 'Selma', 'van de', 'Heuvel', '1965-09-04', 'Klant', 1,1,NULL,SYSDATE(6),SYSDATE(6)),
    (14, 4, 'Eva', NULL, 'Scherder', '2000-04-07', 'Klant', 1,1,NULL,SYSDATE(6),SYSDATE(6)),
    (15, 4, 'Felicia', NULL, 'Scherder', '2021-11-29', 'Klant', 0,1,NULL,SYSDATE(6),SYSDATE(6)),
    (16, 4, 'Devin', NULL, 'Scherder', '2023-03-01', 'Klant', 0,1,NULL,SYSDATE(6),SYSDATE(6)),
    (17, 5, 'Frieda', NULL, 'de Jong', '1980-09-04', 'Klant', 1,1,NULL,SYSDATE(6),SYSDATE(6)),
    (18, 5, 'Simeon', NULL, 'de Jong', '2018-05-23', 'Klant', 0,1,NULL,SYSDATE(6),SYSDATE(6)),
    (19, 6, 'Hanna', 'van der', 'Berg', '1999-09-09', 'Klant', 1,1,NULL,SYSDATE(6),SYSDATE(6));


DROP TABLE IF EXISTS Eetwens;
CREATE TABLE Eetwens (
  id int(6) PRIMARY KEY AUTO_INCREMENT,
  Naam varchar(50) NOT NULL,
  Omschrijving varchar(100), 
  IsActief bit,
  Opmerking varchar(255),
  DatumAangemaakt datetime,
  DatumGewijzigd datetime
);

INSERT INTO Eetwens
(
       Naam 
	  ,Omschrijving 
	  ,IsActief 
	  ,Opmerking 
	  ,DatumAangemaakt
	  ,DatumGewijzigd
)
VALUES
     ('GeenVarken', 'Geen Varkensvlees',  1, NULL, SYSDATE(6), SYSDATE(6))
    ,('Veganistisch',  'Geen zuivelproducten en vlees',  1, NULL, SYSDATE(6), SYSDATE(6))
    ,('Vegetarisch',  'Geen vlees',   1, NULL, SYSDATE(6), SYSDATE(6))
    ,('Omnivoor',  'Geen beperkingen',  1, NULL, SYSDATE(6), SYSDATE(6));
    
    DROP TABLE IF EXISTS EetwensPerGezin;
CREATE TABLE EetwensPerGezin (
  id int(6) PRIMARY KEY AUTO_INCREMENT,
  GezinId int(6) NOT NULL,
  EetwensId int(6) NOT NULL,
  IsActief bit,
  Opmerking varchar(255),
  DatumAangemaakt datetime,
  DatumGewijzigd datetime
);
ALTER TABLE `EetwensPerGezin` ADD FOREIGN KEY (`GezinId`) REFERENCES `Gezin` (`id`);
ALTER TABLE `EetwensPerGezin` ADD FOREIGN KEY (`EetwensId`) REFERENCES `Eetwens` (`id`);

INSERT INTO EetwensPerGezin
(
       GezinId 
	  ,EetwensId 
	  ,IsActief 
	  ,Opmerking 
	  ,DatumAangemaakt
	  ,DatumGewijzigd
)
VALUES
     (1, 2,  1, NULL, SYSDATE(6), SYSDATE(6))
    ,(2, 4,  1, NULL, SYSDATE(6), SYSDATE(6))
    ,(3, 4,  1, NULL, SYSDATE(6), SYSDATE(6))
    ,(4, 3,  1, NULL, SYSDATE(6), SYSDATE(6))
    ,(5, 2,  1, NULL, SYSDATE(6), SYSDATE(6));
    
    create table ContactPerLeverancier(
 Id int not null auto_increment primary key
,LeverancierId int(6) UNSIGNED not null
,ContactId int(6) UNSIGNED not null
,IsActive tinyint not null
,Opmerking varchar(255) null
,DatumAangemaakt datetime not null
,DatumGewijzigd datetime not null
,foreign key(LeverancierId) references Leverancier(Id)
,foreign key(ContactId) references Contact(Id)
)engine = innodb;

 INSERT INTO `ContactPerLeverancier` (
    `Id`,
    `LeverancierId`,
    `ContactId`,
    `IsActive`,
    `Opmerking`,
    `DatumAangemaakt`,
    `DatumGewijzigd`)
    VALUES
	 (NULL, 1, 7, 1, '', SYSDATE(), SYSDATE())
	,(NULL, 2, 8, 1, '', SYSDATE(), SYSDATE())
    ,(NULL, 3, 9, 1, '', SYSDATE(), SYSDATE())
    ,(NULL, 4, 10, 1, '', SYSDATE(), SYSDATE())
    ,(NULL, 6, 11, 1, '', SYSDATE(), SYSDATE())
    ,(NULL, 7, 12, 1, '', SYSDATE(), SYSDATE())
    ,(NULL, 8, 13, 1, '', SYSDATE(), SYSDATE());



