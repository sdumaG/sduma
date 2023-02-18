/* DROP DATABASE IF EXISTS sduma;

CREATE DATABASE sduma; */

CREATE TABLE IF NOT EXISTS `sduma`.`MotivoConstruccion` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NOT NULL,
  `isActivo` BIT NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


CREATE TABLE IF NOT EXISTS `sduma`.`Domicilio` (
  `Id` INT NOT NULL AUTO_INCREMENT,
  `coloniaFraccBarrio` INT NOT NULL,
  `calle` VARCHAR(45) NOT NULL,
  `numExt` VARCHAR(45) NULL,
  `numInt` VARCHAR(45) NOT NULL,
  `cp` VARCHAR(45) NOT NULL, 
  `entreCallesH` VARCHAR(90) NOT NULL,
  `entreCallesV` VARCHAR(90) NOT NULL,
  PRIMARY KEY (`Id`))
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `sduma`.`TipoPredio` (
  `Id` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NOT NULL,
  `isActivo` BIT NOT NULL DEFAULT 1,
  PRIMARY KEY (`Id`))
ENGINE = InnoDB;


CREATE TABLE IF NOT EXISTS `sduma`.`Contacto` (
  `Id` INT NOT NULL AUTO_INCREMENT,
  `email` VARCHAR(45) NOT NULL,
  `telefono` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`Id`))
ENGINE = InnoDB;


CREATE TABLE IF NOT EXISTS `sduma`.`GeneroConstruccion` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NOT NULL,
  `isActivo` BIT NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


CREATE TABLE IF NOT EXISTS `sduma`.`SubGeneroConstruccion` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NOT NULL,
  `udm` VARCHAR(10) NOT NULL,
  `tamanioLimiteInferior` DECIMAL(8,4) NOT NULL,
  `tamanioLimiteSuperior` DECIMAL(8,4) NOT NULL,
  `nombreTarifa` VARCHAR(45) NOT NULL,
  `tarifa` DECIMAL(8,5) NOT NULL,
  `fechaCreacion` DATETIME NOT NULL,
  `anioVigencia` VARCHAR(45) NOT NULL,
  `isActivo` BIT NOT NULL DEFAULT 1,
  `id_GeneroConstruccion` INT NOT NULL,
  PRIMARY KEY (`id`, `id_GeneroConstruccion`),
  INDEX `fk_SubGeneroConstruccion_GeneroConstruccion1_idx` (`id_GeneroConstruccion` ASC),
  CONSTRAINT `fk_SubGeneroConstruccion_GeneroConstruccion1`
    FOREIGN KEY (`id_GeneroConstruccion`)
    REFERENCES `sduma`.`GeneroConstruccion` (`id`)
     )
ENGINE = InnoDB;
  

CREATE TABLE IF NOT EXISTS `sduma`.`TipoConstruccion` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NOT NULL,
  `isActivo` VARCHAR(45) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`))
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `sduma`.`TipoTramite` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NOT NULL,
  `isActivo` VARCHAR(45) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`))
ENGINE = InnoDB;

INSERT INTO `sduma`.`TipoTramite` (`id`, `nombre`)
 VALUES (NULL, 'CONSTRUCCION');

 CREATE TABLE IF NOT EXISTS `sduma`.`Documento` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NOT NULL,
  `isActivo` BIT NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


CREATE TABLE IF NOT EXISTS `sduma`.`TipoTramite_has_Documento` (
  `id_TipoTramite` INT NOT NULL,
  `id_Documento` INT NOT NULL,
  PRIMARY KEY (`id_TipoTramite`, `id_Documento`),
  INDEX `fk_TipoTramite_has_Documento_Documento_idx` (`id_Documento` ASC) ,
  INDEX `fk_TipoTramite_has_Documento_TipoTramite_idx` (`id_TipoTramite` ASC) ,
  CONSTRAINT `fk_TipoTramite_has_Documento_TipoTramite`
    FOREIGN KEY (`id_TipoTramite`)
    REFERENCES `sduma`.`TipoTramite` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_TipoTramite_has_Documento_Documento1`
    FOREIGN KEY (`id_Documento`)
    REFERENCES `sduma`.`Documento` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;





CREATE TABLE IF NOT EXISTS `sduma`.`Persona` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(255) NOT NULL,
  `apellidoP` VARCHAR(255) NOT NULL,
  `apellidoM` VARCHAR(255) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `sduma`.`Horario` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NOT NULL,
  `inicioActividad` TIME NOT NULL DEFAULT '8:00:00',
  `finActividad` TIME NOT NULL DEFAULT '13:00:00',
  PRIMARY KEY (`id`))
ENGINE = InnoDB;

INSERT INTO `sduma`.`Horario` ( `nombre`) 
VALUES ('DEFAULT');


CREATE TABLE IF NOT EXISTS `sduma`.`Rol` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NULL,
  PRIMARY KEY (`Id`))
ENGINE = InnoDB;

INSERT INTO `sduma`.`Rol` (`id`, `nombre`) 
VALUES 
(NULL, 'ADMIN'),
(NULL, 'INTERNO'),
(NULL, 'EXTERNO')
;

CREATE TABLE IF NOT EXISTS `sduma`.`UserLevel` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `Nombre` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;
INSERT INTO `sduma`.`UserLevel` (`Nombre`) VALUES ( 'EXTERNO');
INSERT INTO `sduma`.`UserLevel` (`Nombre`) VALUES ( 'INTERNO');
INSERT INTO `sduma`.`UserLevel` (`Nombre`) VALUES ( 'ADMINISTRADOR');

/* SELECT  EXISTS (SELECT 1 FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_NAME = `sduma`.`User`) */
TRUNCATE TABLE  `sduma`.`User`;


ALTER TABLE `sduma`.`User`
/* ADD `id_Datos_Persona` INT NOT NULL, */
ADD CONSTRAINT `fk_Users_Propietario`
    FOREIGN KEY (`id_Datos_Persona`)
    REFERENCES `sduma`.`Persona` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
/* ADD  `id_Horario` INT NOT NULL, */
ADD CONSTRAINT `fk_User_Horario`
    FOREIGN KEY (`id_Horario`)
    REFERENCES `sduma`.`Horario` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_User_UserLevel`
    FOREIGN KEY (`id_UserLevel`)
    REFERENCES `sduma`.`UserLevel` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION    
    
    ;

ALTER TABLE `sduma`.`User`
ALTER `id_Horario` SET DEFAULT 1; 

ALTER TABLE `sduma`.`User`
ALTER `id_UserLevel` SET DEFAULT 1; 

 




/* CREATE INDEX [index name] ON [table name]([column name]);  */
CREATE INDEX `fk_Users_Propietario_idx` ON `sduma`.`User`(`id_Datos_Persona` ASC);
CREATE INDEX `fk_User_Horario_idx`ON  `sduma`.`User`(`id_Horario` ASC);


/* Tabla usuario ya existente, solo se modifica, para no hacer un desmadre alv */
/*  CREATE TABLE IF NOT EXISTS `sduma`.`User` (
  `id` INT NOT NULL,
  `id_Datos_Persona` INT NOT NULL,
  `id_Horario` INT NOT NULL,
  PRIMARY KEY (`id`, `id_Datos_Persona`, `id_Horario`),
  INDEX `fk_Users_Propietario_idx` (`id_Datos_Persona` ASC) ,
  INDEX `fk_User_Horario_idx` (`id_Horario` ASC) ,
  CONSTRAINT `fk_Users_Propietario1`
    FOREIGN KEY (`id_Datos_Persona`)
    REFERENCES `sduma`.`Persona` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_User_Horario1`
    FOREIGN KEY (`id_Horario`)
    REFERENCES `sduma`.`Horario` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB; */


CREATE TABLE IF NOT EXISTS `sduma`.`User_has_Rol` (
  `Id_User` INT NOT NULL,
  `Id_Rol` INT NOT NULL,
  `ver` BIT NOT NULL,
  `editar` BIT NOT NULL,
  `actualizar` BIT NOT NULL,
  `eliminar` BIT NOT NULL,
  PRIMARY KEY (`Id_User`, `Id_Rol`),
  INDEX `fk_User_has_Roles_Roles_idx` (`Id_Rol` ASC),
  INDEX `fk_User_has_Roles_User_idx` (`Id_User` ASC),
  CONSTRAINT `fk_User_has_Roles_User1`
    FOREIGN KEY (`Id_User`)
    REFERENCES `sduma`.`User` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_User_has_Roles_Roles1`
    FOREIGN KEY (`Id_Rol`)
    REFERENCES `sduma`.`Rol` (`Id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;




CREATE TABLE IF NOT EXISTS `sduma`.`CorrSeguridadEstruc` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `titulo` VARCHAR(45) NOT NULL,
  `abreviacion` VARCHAR(10) NOT NULL,
  `cedula` VARCHAR(45) NOT NULL,
  `isActivo` BIT NOT NULL DEFAULT 1,
  `id_Persona` INT NOT NULL,
  PRIMARY KEY (`id`, `id_Persona`),
  INDEX `fk_CorrSeguridadEstruc_idPersona_idx` (`id_Persona` ASC)  ,
  CONSTRAINT `fk_CorrSeguridadEstruc_Persona1`
    FOREIGN KEY (`id_Persona`)
    REFERENCES `sduma`.`Persona` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


CREATE TABLE IF NOT EXISTS `sduma`.`DirectorResponsableObra` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `titulo` VARCHAR(45) NOT NULL,
  `abreviación` VARCHAR(10) NOT NULL,
  `cedula` VARCHAR(45) NOT NULL,
  `isActivo` BIT NOT NULL DEFAULT 1,
  `id_Persona` INT NOT NULL,
  PRIMARY KEY (`id`, `id_Persona`),
  INDEX `fk_DirectorResponsableObra_Persona_idx` (`id_Persona` ASC) ,
  CONSTRAINT `fk_DirectorResponsableObra_Persona1`
    FOREIGN KEY (`id_Persona`)
    REFERENCES `sduma`.`Persona` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


CREATE TABLE IF NOT EXISTS `sduma`.`SolicitudConstruccion` (
  `Id` INT NOT NULL AUTO_INCREMENT,
  `superficieTotal` INT NULL,
  `superficiePorConstruir` INT NULL,
  `superficiePreexistente` INT NULL,
  `Niveles` INT NULL,
  `Cajones` INT NULL,
  `COS` VARCHAR(45) NULL,
  `CUS` VARCHAR(45) NULL,
  `RPP` VARCHAR(45) NULL,
  `Tomo` VARCHAR(45) NULL,
  `FolioElec` VARCHAR(45) NULL,
  `CuentaCatastral` VARCHAR(45) NULL,
  `FechaCreacion` DATETIME NOT NULL,
  `FechaModificacion` DATETIME NOT NULL,
  `isDeleted` BIT NOT NULL DEFAULT 0,
  `id_Persona_CreadoPor` INT NOT NULL,
  `id_Persona_ModificadoPor` INT NOT NULL,
  `id_Persona_DomicilioNotificaciones` INT NOT NULL,
  `id_DomicilioPredio` INT NOT NULL,
  `id_MotivoConstruccion` INT NOT NULL,
  `id_Contacto` INT NULL,
  `id_TipoPredio` INT NULL,
  `id_TipoConstruccion` INT NOT NULL,
  `id_GeneroConstruccion` INT NOT NULL,
  `id_SubGeneroConstruccion` INT NULL,
  `id_DirectorResponsableObra` INT NULL,
  `id_CorrSeguridadEstruc` INT NULL,
  PRIMARY KEY (`Id`, `id_Persona_CreadoPor`, `id_Persona_ModificadoPor`, `id_Persona_DomicilioNotificaciones`, `id_DomicilioPredio`, `id_MotivoConstruccion`, `id_Contacto`, `id_TipoPredio`, `id_TipoConstruccion`, `id_GeneroConstruccion`, `id_SubGeneroConstruccion`, `id_DirectorResponsableObra`, `id_CorrSeguridadEstruc`),
  INDEX `fk_SolicitudConstruccion_DomicilioNotif_idx` (`id_Persona_DomicilioNotificaciones` ASC) ,
  INDEX `fk_SolicitudConstruccion_MotivoConstruccion1_idx` (`id_MotivoConstruccion` ASC) ,
  INDEX `fk_SolicitudConstruccion_DomicilioPredio_idx` (`id_DomicilioPredio` ASC) ,
  INDEX `fk_SolicitudConstruccion_Contacto_idx` (`id_Contacto` ASC) ,
  INDEX `fk_SolicitudConstruccion_TipoPredio_idx` (`id_TipoPredio` ASC) ,
  INDEX `fk_SolicitudConstruccion_TipoConstruccion_idx` (`id_TipoConstruccion` ASC) ,
  INDEX `fk_SolicitudConstruccion_UserCreadoPor_idx` (`id_Persona_CreadoPor` ASC) ,
  INDEX `fk_SolicitudConstruccion_UserModificadoPor_idx` (`id_Persona_ModificadoPor` ASC) ,
  INDEX `fk_SolicitudConstruccion_GeneroConstruccion_idx` (`id_GeneroConstruccion` ASC) ,
  INDEX `fk_SolicitudConstruccion_SubGeneroConstruccion_idx` (`id_SubGeneroConstruccion` ASC) ,
  INDEX `fk_SolicitudConstruccion_DirectorResponsableObra_idx` (`id_DirectorResponsableObra` ASC) ,
  INDEX `fk_SolicitudConstruccion_CorrSeguridadEstruc_idx` (`id_CorrSeguridadEstruc` ASC) ,
  CONSTRAINT `fk_SolicitudConstruccion_DomicilioNotif`
    FOREIGN KEY (`id_Persona_DomicilioNotificaciones`)
    REFERENCES `sduma`.`Domicilio` (`Id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_SolicitudConstruccion_MotivoConstruccion1`
    FOREIGN KEY (`id_MotivoConstruccion`)
    REFERENCES `sduma`.`MotivoConstruccion` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_SolicitudConstruccion_DomicilioPredio`
    FOREIGN KEY (`id_DomicilioPredio`)
    REFERENCES `sduma`.`Domicilio` (`Id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_SolicitudConstruccion_Contacto1`
    FOREIGN KEY (`id_Contacto`)
    REFERENCES `sduma`.`Contacto` (`Id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_SolicitudConstruccion_TipoPredio1`
    FOREIGN KEY (`id_TipoPredio`)
    REFERENCES `sduma`.`TipoPredio` (`Id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_SolicitudConstruccion_TipoConstruccion1`
    FOREIGN KEY (`id_TipoConstruccion`)
    REFERENCES `sduma`.`TipoConstruccion` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_SolicitudConstruccion_UserCreadoPor`
    FOREIGN KEY (`id_Persona_CreadoPor`)
    REFERENCES `sduma`.`User` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_SolicitudConstruccion_UserModificadoPor`
    FOREIGN KEY (`id_Persona_ModificadoPor`)
    REFERENCES `sduma`.`User` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_SolicitudConstruccion_GeneroConstruccion1`
    FOREIGN KEY (`id_GeneroConstruccion`)
    REFERENCES `sduma`.`GeneroConstruccion` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_SolicitudConstruccion_SubGeneroConstruccion1`
    FOREIGN KEY (`id_SubGeneroConstruccion`)
    REFERENCES `sduma`.`SubGeneroConstruccion` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_SolicitudConstruccion_DirectorResponsableObra1`
    FOREIGN KEY (`id_DirectorResponsableObra`)
    REFERENCES `sduma`.`DirectorResponsableObra` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_SolicitudConstruccion_CorrSeguridadEstruc1`
    FOREIGN KEY (`id_CorrSeguridadEstruc`)
    REFERENCES `sduma`.`CorrSeguridadEstruc` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


CREATE TABLE IF NOT EXISTS `sduma`.`Expediente` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `idAnual` INT NOT NULL,
  `anio` INT NOT NULL,
  `fechaCreacion` DATETIME NOT NULL,
  `fechaModificacion` DATETIME NOT NULL,
  `estado` BIT NOT NULL DEFAULT 0,
  `id_Persona_Solicita` INT NOT NULL,
  `id_solicitudConstruccion` INT NOT NULL,
  `id_User_CreadoPor` INT NOT NULL,
  `id_User_modificadoPor` INT NOT NULL,
  PRIMARY KEY (`id`, `id_Persona_Solicita`, `id_solicitudConstruccion`, `id_User_CreadoPor`, `id_User_modificadoPor`),
  INDEX `fk_Expediente_PersonaSolicita_idx` (`id_Persona_Solicita` ASC)  ,
  INDEX `fk_Expediente_SolicitudConstruccion_idx` (`id_solicitudConstruccion` ASC)  ,
  INDEX `fk_Expediente_UserCreadoPor_idx` (`id_User_CreadoPor` ASC)  ,
  INDEX `fk_Expediente_UserModificadoPor_idx` (`id_User_modificadoPor` ASC)  ,
  CONSTRAINT `fk_Expediente_Propietario1`
    FOREIGN KEY (`id_Persona_Solicita`)
    REFERENCES `sduma`.`Persona` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Expediente_SolicitudConstruccion1`
    FOREIGN KEY (`id_solicitudConstruccion`)
    REFERENCES `sduma`.`SolicitudConstruccion` (`Id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Expediente_UserCreadoPor`
    FOREIGN KEY (`id_User_CreadoPor`)
    REFERENCES `sduma`.`User` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Expediente_UserModifPor`
    FOREIGN KEY (`id_User_modificadoPor`)
    REFERENCES `sduma`.`User` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `sduma`.`SolicitudConstruccion_has_Persona` (
  `SolicitudConstruccion_Id` INT NOT NULL,
  `Persona_id` INT NOT NULL,
  PRIMARY KEY (`SolicitudConstruccion_Id`, `Persona_id`),
  INDEX `fk_SolicitudConstruccion_has_Persona_Persona_idx` (`Persona_id` ASC)  ,
  INDEX `fk_SolicitudConstruccion_has_Persona_SolicitudConstruccion_idx` (`SolicitudConstruccion_Id` ASC)  ,
  CONSTRAINT `fk_SolicitudConstruccion_has_Persona_SolicitudConstruccion1`
    FOREIGN KEY (`SolicitudConstruccion_Id`)
    REFERENCES `sduma`.`SolicitudConstruccion` (`Id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_SolicitudConstruccion_has_Persona_Persona1`
    FOREIGN KEY (`Persona_id`)
    REFERENCES `sduma`.`Persona` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `sduma`.`SolicitudConstruccion_has_Documento` (
  `id_SolicitudConstruccion` INT NOT NULL,
  `id_Documento` INT NOT NULL,
  `isEntregado` BIT NOT NULL,
  `nombreArchivo` VARCHAR(128) NOT NULL,
  `path` VARCHAR(128) NOT NULL,
  `realNombreArchivo` VARCHAR(90) NOT NULL,
  PRIMARY KEY (`id_SolicitudConstruccion`, `id_Documento`),
  INDEX `fk_SolicitudConstruccion_has_Documento_Documento_idx` (`id_Documento` ASC)  ,
  INDEX `fk_SolicitudConstruccion_has_Documento_SolicitudConstruccio_idx` (`id_SolicitudConstruccion` ASC)  ,
  CONSTRAINT `fk_SolicitudConstruccion_has_Documento_SolicitudConstruccion1`
    FOREIGN KEY (`id_SolicitudConstruccion`)
    REFERENCES `sduma`.`SolicitudConstruccion` (`Id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_SolicitudConstruccion_has_Documento_Documento1`
    FOREIGN KEY (`id_Documento`)
    REFERENCES `sduma`.`Documento` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

 