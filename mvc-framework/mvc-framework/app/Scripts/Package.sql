
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
    p_date varchar(10)
) 
BEGIN
    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN 
        ROLLBACK;
        SELECT 'An error has occurred, operation rollbacked and the stored procedure was terminated';
    END;

    START TRANSACTION;
        INSERT INTO pakket (uitgiftedatum, createdAt, updatedAt) VALUES (p_date, SYSDATE(6), SYSDATE(6));
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
        
SELECT pakket.id as packageid, product.id as productid, product.productnaam, productperpakket.aantal, product.vooraad FROM pakket
        INNER JOIN productperpakket 
        ON pakket.id = productperpakket.pakketid
        INNER JOIN product 
        ON product.id = productperpakket.productid
        WHERE pakket.id = p_id;

    COMMIT;
END //
DELIMITER ;


     

-- CreatePackage


DROP PROCEDURE IF EXISTS spViewAllProducts;

DELIMITER //

CREATE PROCEDURE spViewAllProducts
( -- Dit zijn alle argumenten die je meegeeft met het aanroepen van de procedure
    
) 
BEGIN
    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN 
        ROLLBACK;
        SELECT 'An error has occurred, operation rollbacked and the stored procedure was terminated';
    END;

    START TRANSACTION;
        
        SELECT product.productnaam, product.vooraad FROM product;
    COMMIT;
END //
DELIMITER ;


     
-- Delete package


DROP PROCEDURE IF EXISTS spDeletePackage;

DELIMITER //

CREATE PROCEDURE spDeletePackage
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
        
DELETE FROM pakket WHERE id = p_id;
    COMMIT;
END //
DELIMITER ;



-- CreatePackage


DROP PROCEDURE IF EXISTS spLinkPackageProduct;

DELIMITER //

CREATE PROCEDURE spLinkPackageProduct
( -- Dit zijn alle argumenten die je meegeeft met het aanroepen van de procedure
    
) 
BEGIN
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
END //
DELIMITER ;



DROP PROCEDURE IF EXISTS spViewPackageContentAndProducts;

DELIMITER //

CREATE PROCEDURE spViewPackageContentAndProducts
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
        
        SELECT product.productnaam as pnaam, product.vooraad FROM product;

        SELECT pakket.id as packageid, product.id as productid, product.productnaam, productperpakket.aantal FROM pakket
        INNER JOIN productperpakket 
        ON pakket.id = productperpakket.pakketid
        INNER JOIN product 
        ON product.id = productperpakket.productid
        WHERE pakket.id = p_id;
        COMMIT;
END //
DELIMITER ;
