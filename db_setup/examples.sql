--Actualizar multiples rows de una tabla en el mismo statemente
--pero actualizando cada row con diferentes valores (@docParams).
 
--Actualiza multiples records desde multiples records. Soportanto N records 7u7
--

DECLARE @docParams AS SoliHasDocParam;

INSERT INTO @docParams (id_Documento,isEntregado,nombreArchivo,[path] ,realNombreArchivo)
SELECT 1,0,'nombre update 1',NULL,NULL;

INSERT INTO @docParams (id_Documento,isEntregado,nombreArchivo,[path] ,realNombreArchivo)
SELECT 2,0,'nombre update 2',NULL,NULL;


UPDATE SCD 
	SET  isEntregado = temp.isEntregado,
		 nombreArchivo = temp.nombreArchivo,
		 [path] = temp.[path],
		 realNombreArchivo = temp.realNombreArchivo
	FROM   SolicitudConstruccion_has_Documento   AS SCD
	INNER JOIN @docParams AS temp --TVP SP Param uwu
		ON SCD.id_Documento = temp.id_Documento
WHERE SCD.id_SolicitudConstruccion = 13;

--ELIMINAR LOS QUE NO HAGAN INNER JOIN, 
--porque fueron deslinkeados en UI. 7u7 
  
CREATE TABLE sduma.dbo.TableA(
	id INT NOT NULL IDENTITY(1,1),
	datosTableA VARCHAR(255) NULL,
	PRIMARY KEY (id)
);
CREATE TABLE sduma.dbo.TableB(
	id INT NOT NULL IDENTITY(1,1),
	datosTableB VARCHAR(255) NULL,
	PRIMARY KEY (id)
);
CREATE TABLE sduma.dbo.TableC(

	id_TableA INT NOT NULL,
	id_TableB INT NOT NULL,		
	--...etc fields
	yearVersion INT NOT NULL,	

	PRIMARY KEY(id_TableA, id_TableB, yearVersion)
);

ALTER TABLE sduma.dbo.[TableC] ADD CONSTRAINT fk_TableC_has_TableA_id
    FOREIGN KEY (id_TableA) REFERENCES sduma.dbo.TableA (id)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION;
ALTER TABLE sduma.dbo.[TableC] ADD CONSTRAINT fk_TableC_has_TableB_id
    FOREIGN KEY (id_TableB) REFERENCES sduma.dbo.TableB (id)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION;

DROP TABLE TableC;
DROP TABLE TableA;
DROP TABLE TableB;



