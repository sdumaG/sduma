/* SP CreateUser */
DELIMITER //
CREATE PROCEDURE sp_create_user(
    IN username varchar(255),
    IN email varchar(255),
    IN password_hash varchar(255),
    IN auth_key varchar(32),
    IN password_reset_token varchar(255),
    IN verification_token varchar(255),
    IN nombre varchar(255),
    IN apellidoP varchar(255),
    IN apellidoM varchar(255)

 )
BEGIN

    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
        /* LOG */
        ROLLBACK;
         
        /*  EXIT PROCEDURE */
    END;

    START TRANSACTION;
        BEGIN
            INSERT INTO `sduma`.`Persona` ( `nombre`, `apellidoP`, `apellidoM`) 
            VALUES ( nombre, apellidoP, apellidoP);        
            INSERT INTO `user` (
                `username`,
                `auth_key`, `password_hash`, `password_reset_token`, 
                `email`, `status`, 
                `created_at`, `updated_at`, 
                `id_Datos_Persona`, `id_Horario`, `id_UserLevel`,
                `verification_token`
                ) 
            VALUES (username, 
                auth_key, password_hash, password_reset_token, 
                email, '10', 
            NOW(), NOW(),
            LAST_INSERT_ID(), '1', '1',
            verification_token);
        END;
        COMMIT;
         SELECT mysql_affected_rows() AS AffectedRows;
END //

DELIMITER ;


/* DELIMITER //
CREATE PROCEDURE sp_test(
    IN username varchar(255),
    IN email varchar(255)
 )
BEGIN
    INSERT INTO sduma.probaractive
    VALUES ("FFF2", username,9);
END //

DELIMITER ;



DELIMITER //
CREATE PROCEDURE sp_test_v2(
    
 )
BEGIN
    SELECT 2;
END // */

DELIMITER ;