
DROP PROCEDURE IF EXISTS spViewAllergies;

DELIMITER //

CREATE PROCEDURE spViewAllergies
( -- Dit zijn alle argumenten die je meegeeft met het aanroepen van de procedure

) 
BEGIN
    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN 
        ROLLBACK;
        SELECT 'An error has occurred, operation rollbacked and the stored procedure was terminated';
    END;

    START TRANSACTION;
        SELECT G.Id, G.Code, G.Naam, G.Omschrijving, G.AantalVolwassenen, G.AantalKinderen, G.AantalBabys, CONCAT(P.Voornaam, ' ', COALESCE(P.Tussenvoegsel, ''), ' ', P.Achternaam) AS Vertegenwoordiger, G.id AS gezinId
        FROM Gezin G
        INNER JOIN Persoon P ON G.Id = P.GezinId
        WHERE IsVertegenwoordiger = 1;
    COMMIT;
END //
DELIMITER ;

DROP PROCEDURE IF EXISTS spViewAllergiesByAllergy;

DELIMITER //

CREATE PROCEDURE spViewAllergiesByAllergy
( -- Dit zijn alle argumenten die je meegeeft met het aanroepen van de procedure
    p_id int(6)
) 
BEGIN
    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN 
        ROLLBACK;
        SELECT 'An error has occurred, operation rollbacked and the stored procedure was terminated';
    END;

    START TRANSACTION;
        SELECT G.Code, G.Naam, G.Omschrijving, G.AantalVolwassenen, G.AantalKinderen, G.AantalBabys, CONCAT(P.Voornaam, ' ', COALESCE(P.Tussenvoegsel, ''), ' ', P.Achternaam) AS Vertegenwoordiger, A.Id, APP.allergieId as AppId, A.Naam AS allergienaam, G.id AS gezinId
        FROM Gezin G
        INNER JOIN Persoon P ON G.Id = P.GezinId
        INNER JOIN AllergiePerPersoon APP ON P.Id = APP.PersoonId
        INNER JOIN Allergie A ON APP.AllergieId = A.Id
        WHERE APP.allergieId = p_id;

    COMMIT;
END //
DELIMITER ;



DROP PROCEDURE IF EXISTS spViewFamilyDetails;

DELIMITER //

CREATE PROCEDURE spViewFamilyDetails
( -- Dit zijn alle argumenten die je meegeeft met het aanroepen van de procedure
    p_id int(6)
) 
BEGIN
    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN 
        ROLLBACK;
        SELECT 'An error has occurred, operation rollbacked and the stored procedure was terminated';
    END;

    START TRANSACTION;
        SELECT
		A.Id AS allergieId,
		P.Id as persoonId,
	    G.Id AS gezinId,
        G.Naam AS Gezinsnaam,
        G.Omschrijving,
        G.AantalVolwassenen + G.AantalKinderen + G.AantalBabys AS TotaalAantalPersonen,
        CONCAT(P.Voornaam, ' ', COALESCE(P.Tussenvoegsel, ''), ' ', P.Achternaam) AS Naam,
        P.TypePersoon,
        CASE WHEN P.IsVertegenwoordiger = 1 THEN 'Vertegenwoordiger' ELSE 'Familielid' END AS Gezinsrol,
        A.Naam AS Allergie
        FROM
        Gezin G
        INNER JOIN Persoon P ON G.Id = P.GezinId
        LEFT JOIN AllergiePerPersoon APP ON P.Id = APP.PersoonId
        LEFT JOIN Allergie A ON APP.AllergieId = A.Id
        WHERE G.id = p_id;
    COMMIT;
END //
DELIMITER ;




DROP PROCEDURE IF EXISTS spViewPersonAllergy;

DELIMITER //

CREATE PROCEDURE spViewPersonAllergy
( -- Dit zijn alle argumenten die je meegeeft met het aanroepen van de procedure
    p_id int(6)
) 
BEGIN
    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN 
        ROLLBACK;
        SELECT 'An error has occurred, operation rollbacked and the stored procedure was terminated';
    END;

    START TRANSACTION;
        
SELECT
    A.Id AS AllergyId,
    A.Naam AS AllergyName,
    P.Id as personId
FROM
    Persoon P
    INNER JOIN AllergiePerPersoon APP ON P.Id = APP.PersoonId
    INNER JOIN Allergie A ON APP.AllergieId = A.Id
WHERE
    P.Id = p_id;

    COMMIT;
END //
DELIMITER ;



DROP PROCEDURE IF EXISTS spUpdatePersonAllergy;

DELIMITER //

CREATE PROCEDURE spUpdatePersonAllergy
( -- Dit zijn alle argumenten die je meegeeft met het aanroepen van de procedure
    p_personId int(6),
    p_newAllergyId int(6)
) 
BEGIN
    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN 
        ROLLBACK;
        SELECT 'An error has occurred, operation rollbacked and the stored procedure was terminated';
    END;

    START TRANSACTION;

    UPDATE AllergiePerPersoon
    SET AllergieId = p_newAllergyId
    WHERE PersoonId = p_personId;

    COMMIT;
END //
DELIMITER ;

