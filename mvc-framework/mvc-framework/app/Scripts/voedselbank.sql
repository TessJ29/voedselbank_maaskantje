-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Gegenereerd op: 20 jun 2023 om 13:15
-- Serverversie: 5.7.36
-- PHP-versie: 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `voedselbank`
--

DELIMITER $$
--
-- Procedures
--
DROP PROCEDURE IF EXISTS `spAddProductToPackage`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `spAddProductToPackage` (`p_packageId` INT(6), `p_productId` INT(6))  BEGIN
    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN 
        ROLLBACK;
        SELECT 'An error has occurred, operation rollbacked and the stored procedure was terminated';
    END;

    START TRANSACTION;
        UPDATE productperpakket
        SET aantal = (aantal + 1)
        WHERE pakketid = p_packageId 
        AND productid = p_productId; 

        UPDATE product
        SET vooraad = (vooraad - 1)
        WHERE product.id = p_productId;
    COMMIT;
END$$

DROP PROCEDURE IF EXISTS `spCreatePackage`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `spCreatePackage` (`p_date` VARCHAR(10))  BEGIN
    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN 
        ROLLBACK;
        SELECT 'An error has occurred, operation rollbacked and the stored procedure was terminated';
    END;

    START TRANSACTION;
        INSERT INTO pakket (uitgiftedatum, createdAt, updatedAt) VALUES (p_date, SYSDATE(6), SYSDATE(6));
    COMMIT;
END$$

DROP PROCEDURE IF EXISTS `spDeletePackage`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `spDeletePackage` (`p_id` INT(6))  BEGIN
    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN 
        ROLLBACK;
        SELECT 'An error has occurred, operation rollbacked and the stored procedure was terminated';
    END;

    START TRANSACTION;
        
DELETE FROM pakket WHERE id = p_id;
    COMMIT;
END$$

DROP PROCEDURE IF EXISTS `spLinkPackageProduct`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `spLinkPackageProduct` ()  BEGIN
    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN 
        ROLLBACK;
        SELECT 'An error has occurred, operation rollbacked and the stored procedure was terminated';
    END;

    START TRANSACTION;
        INSERT INTO productperpakket (pakketid, productid, aantal) VALUES ((SELECT MAX(id) FROM pakket) ,1, 0);
        INSERT INTO productperpakket (pakketid, productid, aantal) VALUES ((SELECT MAX(id) FROM pakket) ,2, 0);
        INSERT INTO productperpakket (pakketid, productid, aantal) VALUES ((SELECT MAX(id) FROM pakket) ,3, 0);
        INSERT INTO productperpakket (pakketid, productid, aantal) VALUES ((SELECT MAX(id) FROM pakket) ,4, 0);
        INSERT INTO productperpakket (pakketid, productid, aantal) VALUES ((SELECT MAX(id) FROM pakket) ,5, 0);
    COMMIT;
END$$

DROP PROCEDURE IF EXISTS `spRemoveProductFromPackage`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `spRemoveProductFromPackage` (`p_packageId` INT(6), `p_productId` INT(6))  BEGIN
    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN 
        ROLLBACK;
        SELECT 'An error has occurred, operation rollbacked and the stored procedure was terminated';
    END;

    START TRANSACTION;
        UPDATE productperpakket
        SET aantal = (aantal - 1)
        WHERE pakketid = p_packageId 
        AND productid = p_productId; 

        UPDATE product
        SET vooraad = (vooraad + 1)
        WHERE product.id = p_productId;
    COMMIT;
END$$

DROP PROCEDURE IF EXISTS `spViewAllProducts`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `spViewAllProducts` ()  BEGIN
    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN 
        ROLLBACK;
        SELECT 'An error has occurred, operation rollbacked and the stored procedure was terminated';
    END;

    START TRANSACTION;
        
        SELECT product.productnaam, product.vooraad FROM product;
    COMMIT;
END$$

DROP PROCEDURE IF EXISTS `spViewPackageContent`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `spViewPackageContent` (`p_id` INT(6))  BEGIN
    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN 
        ROLLBACK;
        SELECT 'An error has occurred, operation rollbacked and the stored procedure was terminated';
    END;

    START TRANSACTION;
        
SELECT pakket.id as packageid, product.id as productid, product.productnaam, productperpakket.aantal, product.vooraad FROM pakket
        INNER JOIN productperpakket 
        ON pakket.id = productperpakket.pakketid
        INNER JOIN product 
        ON product.id = productperpakket.productid
        WHERE pakket.id = p_id;

    COMMIT;
END$$

DROP PROCEDURE IF EXISTS `spViewPackageContentAndProducts`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `spViewPackageContentAndProducts` (`p_id` INT(6))  BEGIN
    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN 
        ROLLBACK;
        SELECT 'An error has occurred, operation rollbacked and the stored procedure was terminated';
    END;

    START TRANSACTION;
        
        SELECT product.productnaam as pnaam, product.vooraad FROM product;

        SELECT pakket.id as packageid, product.id as productid, product.productnaam, productperpakket.aantal FROM pakket
        INNER JOIN productperpakket 
        ON pakket.id = productperpakket.pakketid
        INNER JOIN product 
        ON product.id = productperpakket.productid
        WHERE pakket.id = p_id;
        COMMIT;
END$$

DROP PROCEDURE IF EXISTS `spViewPackages`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `spViewPackages` ()  BEGIN
    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN 
        ROLLBACK;
        SELECT 'An error has occurred, operation rollbacked and the stored procedure was terminated';
    END;

    START TRANSACTION;
        SELECT pakket.id as pakketid, klant.gezinsnaam, pakket.uitgiftedatum, SUM(productperpakket.aantal) as totaal FROM pakket
        LEFT OUTER JOIN productperpakket 
        ON pakket.id = productperpakket.pakketid
        LEFT OUTER JOIN product 
        ON product.id = productperpakket.productid
        
        LEFT OUTER JOIN pakketperklant 
        ON pakketperklant.pakketid = pakket.id
        LEFT OUTER JOIN klant
        ON pakketperklant.klantid = klant.id
        GROUP BY pakket.id;
    COMMIT;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `adres`
--

DROP TABLE IF EXISTS `adres`;
CREATE TABLE IF NOT EXISTS `adres` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `leverancierid` int(6) NOT NULL,
  `isActive` bit(1) DEFAULT NULL,
  `comment` varchar(250) DEFAULT NULL,
  `createdAt` datetime DEFAULT NULL,
  `updatedAt` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `leverancierid` (`leverancierid`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `adres`
--

INSERT INTO `adres` (`id`, `leverancierid`, `isActive`, `comment`, `createdAt`, `updatedAt`) VALUES
(1, 1, NULL, NULL, '2023-06-20 12:52:26', '2023-06-20 12:52:26'),
(2, 2, NULL, NULL, '2023-06-20 12:52:31', '2023-06-20 12:52:31'),
(3, 3, NULL, NULL, '2023-06-20 12:52:33', '2023-06-20 12:52:33'),
(4, 4, NULL, NULL, '2023-06-20 12:52:36', '2023-06-20 12:52:36'),
(5, 5, NULL, NULL, '2023-06-20 12:52:38', '2023-06-20 12:52:38');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `allergie`
--

DROP TABLE IF EXISTS `allergie`;
CREATE TABLE IF NOT EXISTS `allergie` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `allergienaam` varchar(50) NOT NULL,
  `isActive` bit(1) DEFAULT NULL,
  `comment` varchar(250) DEFAULT NULL,
  `createdAt` datetime DEFAULT NULL,
  `updatedAt` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `allergie`
--

INSERT INTO `allergie` (`id`, `allergienaam`, `isActive`, `comment`, `createdAt`, `updatedAt`) VALUES
(1, 'vezel', NULL, NULL, '2023-06-20 12:52:49', '2023-06-20 12:52:49'),
(2, 'zuivel', NULL, NULL, '2023-06-20 12:53:07', '2023-06-20 12:53:07'),
(3, 'water', NULL, NULL, '2023-06-20 12:53:09', '2023-06-20 12:53:09'),
(4, 'pinda', NULL, NULL, '2023-06-20 12:53:16', '2023-06-20 12:53:16'),
(5, 'chocola', NULL, NULL, '2023-06-20 12:53:28', '2023-06-20 12:53:28');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `klant`
--

DROP TABLE IF EXISTS `klant`;
CREATE TABLE IF NOT EXISTS `klant` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `gezinsnaam` varchar(50) NOT NULL,
  `adres` varchar(50) NOT NULL,
  `postcode` varchar(10) NOT NULL,
  `telefoon` int(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `aantalvolwassenen` varchar(2) DEFAULT NULL,
  `aantalkinderen` varchar(2) DEFAULT NULL,
  `aantalbaby` varchar(2) DEFAULT NULL,
  `specialewens` varchar(50) DEFAULT NULL,
  `isActive` bit(1) DEFAULT NULL,
  `comment` varchar(250) DEFAULT NULL,
  `createdAt` datetime DEFAULT NULL,
  `updatedAt` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `klant`
--

INSERT INTO `klant` (`id`, `gezinsnaam`, `adres`, `postcode`, `telefoon`, `email`, `aantalvolwassenen`, `aantalkinderen`, `aantalbaby`, `specialewens`, `isActive`, `comment`, `createdAt`, `updatedAt`) VALUES
(1, '1', 'janskerkhof 200', '1243BH', 684628463, 'arj@mail.nl', '2', '0', '1', NULL, NULL, NULL, '2023-06-20 12:53:33', '2023-06-20 12:53:33'),
(2, 'white', 'blorblaan 2000', '4174BK', 6184269, 'will@gmail.com', '0', '1', '0', NULL, NULL, NULL, '2023-06-20 12:53:53', '2023-06-20 12:53:53'),
(3, 'the brouwer', 'blorblaan 2001', '4174fK', 6265469, 'blorb@gmail.com', '0', '1', '0', NULL, NULL, NULL, '2023-06-20 12:53:53', '2023-06-20 12:53:53'),
(4, 'jansen', '308 negro arroya lane', '6135GG', 612345678, 'jansron@gmail.com', '0', '0', '1', NULL, NULL, NULL, '2023-06-20 12:54:36', '2023-06-20 12:54:36'),
(5, 'kabouters', 'plopland', '1243BH', 62873654, 'gnom@gmail.com', '1', '1', '1', 'i love casting spells', NULL, NULL, '2023-06-20 12:55:01', '2023-06-20 12:55:01');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `klantwens`
--

DROP TABLE IF EXISTS `klantwens`;
CREATE TABLE IF NOT EXISTS `klantwens` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `wens` varchar(50) NOT NULL,
  `isActive` bit(1) DEFAULT NULL,
  `comment` varchar(250) DEFAULT NULL,
  `createdAt` datetime DEFAULT NULL,
  `updatedAt` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `klantwens`
--

INSERT INTO `klantwens` (`id`, `wens`, `isActive`, `comment`, `createdAt`, `updatedAt`) VALUES
(1, 'geen varken', NULL, NULL, '2023-06-20 12:55:38', '2023-06-20 12:55:38'),
(2, 'geen kip', NULL, NULL, '2023-06-20 12:55:55', '2023-06-20 12:55:55'),
(3, 'vegetarisch', NULL, NULL, '2023-06-20 12:56:00', '2023-06-20 12:56:00'),
(4, 'geen alcohol', NULL, NULL, '2023-06-20 12:56:06', '2023-06-20 12:56:06'),
(5, 'carnivorisch', NULL, NULL, '2023-06-20 12:56:12', '2023-06-20 12:56:12');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `leverancier`
--

DROP TABLE IF EXISTS `leverancier`;
CREATE TABLE IF NOT EXISTS `leverancier` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `bedrijfsnaam` varchar(50) NOT NULL,
  `contactpersoon` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `telefoonnummer` int(10) DEFAULT NULL,
  `isActive` bit(1) DEFAULT NULL,
  `comment` varchar(250) DEFAULT NULL,
  `createdAt` datetime DEFAULT NULL,
  `updatedAt` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `leverancier`
--

INSERT INTO `leverancier` (`id`, `bedrijfsnaam`, `contactpersoon`, `email`, `telefoonnummer`, `isActive`, `comment`, `createdAt`, `updatedAt`) VALUES
(1, 'aperture', 'john', 'josh@gmail.com', 6192837, NULL, NULL, '2023-06-20 12:56:28', '2023-06-20 12:56:28'),
(2, 'aperture', 'caroline', 'carlin@gmail.com', NULL, NULL, NULL, '2023-06-20 12:56:53', '2023-06-20 12:56:53'),
(3, 'supamarkt', 'jan', 'jan@gmail.com', 6746, NULL, NULL, '2023-06-20 12:57:04', '2023-06-20 12:57:04'),
(4, 'THE SHADOW GOVERNMENT', 'red wizzard', 'shaddowwizzardmoneygang@gmail.com', 3164104, NULL, NULL, '2023-06-20 12:57:24', '2023-06-20 12:57:24'),
(5, 'murder', 'me', 'icarly@gmail.cim', 6192837, NULL, NULL, '2023-06-20 12:58:02', '2023-06-20 12:58:02');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `medewerker`
--

DROP TABLE IF EXISTS `medewerker`;
CREATE TABLE IF NOT EXISTS `medewerker` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `gebruikersnaam` varchar(50) NOT NULL,
  `wachtwoord` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `rol` int(6) NOT NULL,
  `isActive` bit(1) DEFAULT NULL,
  `comment` varchar(250) DEFAULT NULL,
  `createdAt` datetime DEFAULT NULL,
  `updatedAt` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `rol` (`rol`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `medewerker`
--

INSERT INTO `medewerker` (`id`, `gebruikersnaam`, `wachtwoord`, `email`, `rol`, `isActive`, `comment`, `createdAt`, `updatedAt`) VALUES
(1, 'wom', '12345678', 'will@gmail.com', 1, NULL, NULL, '2023-06-20 12:58:23', '2023-06-20 12:58:23'),
(2, 'bom', '87654321', 'mrbest@gmail.com', 2, NULL, NULL, '2023-06-20 12:58:48', '2023-06-20 12:58:48'),
(3, 'hom', '54637829', 'pipis@cybermail.net', 3, NULL, NULL, '2023-06-20 12:59:00', '2023-06-20 12:59:00'),
(4, 'com', 'com', 'com@gmail.com', 1, NULL, NULL, '2023-06-20 13:11:05', '2023-06-20 13:11:05'),
(5, 'klaas-pieter', 'OIFUSYDT&^D*SFR', 'klaaspieter@gmail.com', 1, NULL, NULL, '2023-06-20 13:11:29', '2023-06-20 13:11:29');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `pakket`
--

DROP TABLE IF EXISTS `pakket`;
CREATE TABLE IF NOT EXISTS `pakket` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `uitgiftedatum` date DEFAULT NULL,
  `isActive` bit(1) DEFAULT NULL,
  `comment` varchar(250) DEFAULT NULL,
  `createdAt` datetime DEFAULT NULL,
  `updatedAt` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `pakket`
--

INSERT INTO `pakket` (`id`, `uitgiftedatum`, `isActive`, `comment`, `createdAt`, `updatedAt`) VALUES
(2, '1111-11-11', NULL, NULL, '2023-06-20 15:08:47', '2023-06-20 15:08:47'),
(3, '2121-02-12', NULL, NULL, '2023-06-20 15:08:56', '2023-06-20 15:08:56'),
(4, '1111-11-11', NULL, NULL, '2023-06-20 15:09:08', '2023-06-20 15:09:08'),
(5, '1111-11-11', NULL, NULL, '2023-06-20 15:09:11', '2023-06-20 15:09:11'),
(6, '1121-11-11', NULL, NULL, '2023-06-20 15:09:19', '2023-06-20 15:09:19');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `pakketperklant`
--

DROP TABLE IF EXISTS `pakketperklant`;
CREATE TABLE IF NOT EXISTS `pakketperklant` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `klantid` int(6) NOT NULL,
  `pakketid` int(6) NOT NULL,
  `isActive` bit(1) DEFAULT NULL,
  `comment` varchar(250) DEFAULT NULL,
  `createdAt` datetime DEFAULT NULL,
  `updatedAt` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `klantid` (`klantid`),
  KEY `pakketid` (`pakketid`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `pakketperklant`
--

INSERT INTO `pakketperklant` (`id`, `klantid`, `pakketid`, `isActive`, `comment`, `createdAt`, `updatedAt`) VALUES
(1, 1, 1, NULL, NULL, '2023-06-20 12:59:20', '2023-06-20 12:59:20'),
(2, 2, 2, NULL, NULL, '2023-06-20 12:59:27', '2023-06-20 12:59:27'),
(3, 3, 3, NULL, NULL, '2023-06-20 12:59:30', '2023-06-20 12:59:30'),
(4, 4, 4, NULL, NULL, '2023-06-20 12:59:33', '2023-06-20 12:59:33'),
(5, 5, 5, NULL, NULL, '2023-06-20 12:59:36', '2023-06-20 12:59:36');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `product`
--

DROP TABLE IF EXISTS `product`;
CREATE TABLE IF NOT EXISTS `product` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `productnaam` varchar(50) NOT NULL,
  `productcategorieid` int(6) NOT NULL,
  `alregieid` int(6) NOT NULL,
  `EAN` int(13) NOT NULL,
  `vooraad` int(6) NOT NULL,
  `isActive` bit(1) DEFAULT NULL,
  `comment` varchar(250) DEFAULT NULL,
  `createdAt` datetime DEFAULT NULL,
  `updatedAt` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `productcategorieid` (`productcategorieid`),
  KEY `alregieid` (`alregieid`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `product`
--

INSERT INTO `product` (`id`, `productnaam`, `productcategorieid`, `alregieid`, `EAN`, `vooraad`, `isActive`, `comment`, `createdAt`, `updatedAt`) VALUES
(1, 'appel', 1, 0, 1, 10, NULL, NULL, '2023-06-20 12:59:43', '2023-06-20 12:59:43'),
(2, 'banaan', 1, 0, 2, 10, NULL, NULL, '2023-06-20 13:00:02', '2023-06-20 13:00:02'),
(3, 'kiwi', 1, 0, 3, 10, NULL, NULL, '2023-06-20 13:00:15', '2023-06-20 13:00:15'),
(4, 'kaas', 2, 2, 4, 99, NULL, NULL, '2023-06-20 13:00:29', '2023-06-20 13:00:29'),
(5, 'eieren', 3, 4, 5, 87, NULL, NULL, '2023-06-20 13:01:01', '2023-06-20 13:01:01');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `productcategorie`
--

DROP TABLE IF EXISTS `productcategorie`;
CREATE TABLE IF NOT EXISTS `productcategorie` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `categorienaam` varchar(50) NOT NULL,
  `isActive` bit(1) DEFAULT NULL,
  `comment` varchar(250) DEFAULT NULL,
  `createdAt` datetime DEFAULT NULL,
  `updatedAt` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `productcategorie`
--

INSERT INTO `productcategorie` (`id`, `categorienaam`, `isActive`, `comment`, `createdAt`, `updatedAt`) VALUES
(1, 'Aardappel groente fruit', NULL, NULL, '2023-06-20 13:01:27', '2023-06-20 13:01:27'),
(2, 'kaas, vleeswaren', NULL, NULL, '2023-06-20 13:01:32', '2023-06-20 13:01:32'),
(3, 'zuivel, plantaardig en eieren', NULL, NULL, '2023-06-20 13:01:48', '2023-06-20 13:01:48'),
(4, 'bakkerij en banket', NULL, NULL, '2023-06-20 13:01:56', '2023-06-20 13:01:56'),
(5, 'frisdrank, sappen, koffie en thee', NULL, NULL, '2023-06-20 13:02:03', '2023-06-20 13:02:03'),
(6, 'pasta, rijst en wereldkeuken', NULL, NULL, '2023-06-20 13:02:11', '2023-06-20 13:02:11'),
(7, 'soepen, sauzen, kruiden en olie', NULL, NULL, '2023-06-20 13:02:17', '2023-06-20 13:02:17'),
(8, 'snoep, koek, chips en chocolade', NULL, NULL, '2023-06-20 13:02:22', '2023-06-20 13:02:22'),
(9, 'baby, verzorging en hygyene', NULL, NULL, '2023-06-20 13:02:43', '2023-06-20 13:02:43');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `productperleverancier`
--

DROP TABLE IF EXISTS `productperleverancier`;
CREATE TABLE IF NOT EXISTS `productperleverancier` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `leverancierid` int(6) NOT NULL,
  `productid` int(6) NOT NULL,
  `datumeerstvolgendelevering` date DEFAULT NULL,
  `tijdeerstvolgendelevering` time DEFAULT NULL,
  `isActive` bit(1) DEFAULT NULL,
  `comment` varchar(250) DEFAULT NULL,
  `createdAt` datetime DEFAULT NULL,
  `updatedAt` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `leverancierid` (`leverancierid`),
  KEY `productid` (`productid`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `productperleverancier`
--

INSERT INTO `productperleverancier` (`id`, `leverancierid`, `productid`, `datumeerstvolgendelevering`, `tijdeerstvolgendelevering`, `isActive`, `comment`, `createdAt`, `updatedAt`) VALUES
(1, 1, 1, '2023-06-15', NULL, NULL, NULL, '2023-06-20 13:02:53', '2023-06-20 13:02:53'),
(2, 2, 2, NULL, NULL, NULL, NULL, '2023-06-20 13:03:30', '2023-06-20 13:03:30'),
(3, 3, 3, NULL, NULL, NULL, NULL, '2023-06-20 13:03:36', '2023-06-20 13:03:36'),
(4, 4, 4, NULL, NULL, NULL, NULL, '2023-06-20 13:03:39', '2023-06-20 13:03:39'),
(5, 5, 5, NULL, NULL, NULL, NULL, '2023-06-20 13:03:42', '2023-06-20 13:03:42');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `productperpakket`
--

DROP TABLE IF EXISTS `productperpakket`;
CREATE TABLE IF NOT EXISTS `productperpakket` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `pakketid` int(6) NOT NULL,
  `productid` int(6) NOT NULL,
  `aantal` int(6) UNSIGNED NOT NULL DEFAULT '0',
  `isActive` bit(1) DEFAULT NULL,
  `comment` varchar(250) DEFAULT NULL,
  `createdAt` datetime DEFAULT NULL,
  `updatedAt` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pakketid` (`pakketid`)
) ENGINE=MyISAM AUTO_INCREMENT=36 DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `productperpakket`
--

INSERT INTO `productperpakket` (`id`, `pakketid`, `productid`, `aantal`, `isActive`, `comment`, `createdAt`, `updatedAt`) VALUES
(1, 1, 1, 0, NULL, NULL, '2023-06-20 13:03:49', '2023-06-20 13:03:49'),
(2, 2, 2, 0, NULL, NULL, '2023-06-20 13:03:54', '2023-06-20 13:03:54'),
(3, 3, 3, 0, NULL, NULL, '2023-06-20 13:03:57', '2023-06-20 13:03:57'),
(4, 4, 4, 0, NULL, NULL, '2023-06-20 13:03:59', '2023-06-20 13:03:59'),
(5, 5, 5, 0, NULL, NULL, '2023-06-20 13:04:02', '2023-06-20 13:04:02'),
(6, 2, 1, 0, NULL, NULL, NULL, NULL),
(7, 2, 2, 0, NULL, NULL, NULL, NULL),
(8, 2, 3, 0, NULL, NULL, NULL, NULL),
(9, 2, 4, 0, NULL, NULL, NULL, NULL),
(10, 2, 5, 0, NULL, NULL, NULL, NULL),
(11, 3, 1, 0, NULL, NULL, NULL, NULL),
(12, 3, 2, 0, NULL, NULL, NULL, NULL),
(13, 3, 3, 0, NULL, NULL, NULL, NULL),
(14, 3, 4, 0, NULL, NULL, NULL, NULL),
(15, 3, 5, 0, NULL, NULL, NULL, NULL),
(16, 4, 1, 0, NULL, NULL, NULL, NULL),
(17, 4, 2, 0, NULL, NULL, NULL, NULL),
(18, 4, 3, 0, NULL, NULL, NULL, NULL),
(19, 4, 4, 0, NULL, NULL, NULL, NULL),
(20, 4, 5, 0, NULL, NULL, NULL, NULL),
(21, 5, 1, 0, NULL, NULL, NULL, NULL),
(22, 5, 2, 0, NULL, NULL, NULL, NULL),
(23, 5, 3, 0, NULL, NULL, NULL, NULL),
(24, 5, 4, 0, NULL, NULL, NULL, NULL),
(25, 5, 5, 0, NULL, NULL, NULL, NULL),
(26, 5, 1, 0, NULL, NULL, NULL, NULL),
(27, 5, 2, 0, NULL, NULL, NULL, NULL),
(28, 5, 3, 0, NULL, NULL, NULL, NULL),
(29, 5, 4, 0, NULL, NULL, NULL, NULL),
(30, 5, 5, 0, NULL, NULL, NULL, NULL),
(31, 6, 1, 0, NULL, NULL, NULL, NULL),
(32, 6, 2, 0, NULL, NULL, NULL, NULL),
(33, 6, 3, 0, NULL, NULL, NULL, NULL),
(34, 6, 4, 0, NULL, NULL, NULL, NULL),
(35, 6, 5, 0, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `rol`
--

DROP TABLE IF EXISTS `rol`;
CREATE TABLE IF NOT EXISTS `rol` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `rol` varchar(50) DEFAULT NULL,
  `isActive` bit(1) DEFAULT NULL,
  `comment` varchar(250) DEFAULT NULL,
  `createdAt` datetime DEFAULT NULL,
  `updatedAt` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `rol`
--

INSERT INTO `rol` (`id`, `rol`, `isActive`, `comment`, `createdAt`, `updatedAt`) VALUES
(1, 'medewerker', NULL, NULL, '2023-06-20 13:04:09', '2023-06-20 13:04:09'),
(2, 'vrijwilliger', NULL, NULL, '2023-06-20 13:04:14', '2023-06-20 13:04:14'),
(3, 'baas', NULL, NULL, '2023-06-20 13:04:18', '2023-06-20 13:04:18'),
(4, 'manager', NULL, NULL, '2023-06-20 13:12:21', '2023-06-20 13:12:21'),
(5, 'owner', NULL, NULL, '2023-06-20 13:12:30', '2023-06-20 13:12:30');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `wensperklant`
--

DROP TABLE IF EXISTS `wensperklant`;
CREATE TABLE IF NOT EXISTS `wensperklant` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `klantid` int(6) NOT NULL,
  `klantwensid` int(6) NOT NULL,
  `isActive` bit(1) DEFAULT NULL,
  `comment` varchar(250) DEFAULT NULL,
  `createdAt` datetime DEFAULT NULL,
  `updatedAt` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `klantid` (`klantid`),
  KEY `klantwensid` (`klantwensid`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `wensperklant`
--

INSERT INTO `wensperklant` (`id`, `klantid`, `klantwensid`, `isActive`, `comment`, `createdAt`, `updatedAt`) VALUES
(1, 1, 1, NULL, NULL, '2023-06-20 13:04:46', '2023-06-20 13:04:46'),
(2, 2, 2, NULL, NULL, '2023-06-20 13:04:55', '2023-06-20 13:04:55'),
(3, 3, 3, NULL, NULL, '2023-06-20 13:05:00', '2023-06-20 13:05:00'),
(4, 4, 4, NULL, NULL, '2023-06-20 13:05:03', '2023-06-20 13:05:03'),
(5, 5, 5, NULL, NULL, '2023-06-20 13:05:06', '2023-06-20 13:05:06');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
