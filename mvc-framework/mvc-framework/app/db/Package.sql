
DROP PROCEDURE IF EXISTS spViewPackages;

DELIMITER //

CREATE PROCEDURE spViewPackages
( -- Dit zijn alle argumenten die je meegeeft met het aanroepen van de procedure

) 
BEGIN
    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN 
        ROLLBACK;
        SELECT 'An error has occurred, operation rollbacked and the stored procedure was terminated';
    END;

    START TRANSACTION;
        SELECT pakket.id as pakketid, klant.gezinsnaam, SUM(productperpakket.aantal) as totaal FROM pakket
        INNER JOIN productperpakket 
        ON pakket.id = productperpakket.pakketid
        INNER JOIN product 
        ON product.id = productperpakket.productid
        
        INNER JOIN pakketperklant 
        ON pakketperklant.pakketid = pakket.id
        INNER JOIN klant
        ON pakketperklant.klantid = klant.id
        GROUP BY pakket.id;
    COMMIT;
END //
DELIMITER ;

-- AddProductToPackage


DROP PROCEDURE IF EXISTS spAddProductToPackage;

DELIMITER //

CREATE PROCEDURE spAddProductToPackage
( -- Dit zijn alle argumenten die je meegeeft met het aanroepen van de procedure
    p_packageId INT(6),
    p_productId INT(6)
) 
BEGIN
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
END //
DELIMITER ;


-- RemoveProductFromPackage


DROP PROCEDURE IF EXISTS spRemoveProductFromPackage;

DELIMITER //

CREATE PROCEDURE spRemoveProductFromPackage
( -- Dit zijn alle argumenten die je meegeeft met het aanroepen van de procedure
    p_packageId INT(6),
    p_productId INT(6)
) 
BEGIN
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
END //
DELIMITER ;



-- CreatePackage


DROP PROCEDURE IF EXISTS spCreatePackage;

DELIMITER //

CREATE PROCEDURE spCreatePackage
( -- Dit zijn alle argumenten die je meegeeft met het aanroepen van de procedure
    p_date date
) 
BEGIN
    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN 
        ROLLBACK;
        SELECT 'An error has occurred, operation rollbacked and the stored procedure was terminated';
    END;

    START TRANSACTION;
         INSERT INTO pakket (uitgiftedarum, createdAt, updatedAt) VALUES (p_date, SYSDATE(6), SYSDATE(6));
    COMMIT;
END //
DELIMITER ;



-- CreatePackage


DROP PROCEDURE IF EXISTS spViewPackageContent;

DELIMITER //

CREATE PROCEDURE spViewPackageContent
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
        
SELECT pakket.id as pakketid, product.productnaam, productperpakket.aantal, klant.gezinsnaam FROM pakket
        INNER JOIN productperpakket 
        ON pakket.id = productperpakket.pakketid
        INNER JOIN product 
        ON product.id = productperpakket.productid
        
        INNER JOIN pakketperklant 
        ON pakketperklant.pakketid = pakket.id
        INNER JOIN klant
        ON pakketperklant.klantid = klant.id
        WHERE pakket.id = p_id;
    COMMIT;
END //
DELIMITER ;


