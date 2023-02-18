CREATE PROCEDURE dbo.sp_create_user
    @username nvarchar(255),
    @email nvarchar(255),
    @password_hash nvarchar(255),
    @auth_key nvarchar(32),
    @password_reset_token nvarchar(255),
    @verification_token nvarchar(255),
    @nombre nvarchar(255),
    @apellidoP nvarchar(255),
    @apellidoM nvarchar(255) 
    
 AS
    BEGIN TRY
        DECLARE @rowsInserted INT = @@ROWCOUNT;

        BEGIN TRANSACTION CreateUserTran;
            
            SET NOCOUNT ON ;
            
            IF( EXISTS ( SELECT TOP 1 * FROM sduma.dbo.[user] WHERE username = @username ))--solo si es agente
            BEGIN ;
                THROW 54321, 'Ese nombre de usuario ya existe.',1;
            END;

            IF( EXISTS ( SELECT TOP 1 * FROM sduma.dbo.[user] WHERE email = @email ))--solo si es agente
            BEGIN ;
                THROW 54322, 'Ese email ya está asociado a una cuenta.',1;
            END;

            INSERT INTO sduma.dbo.Persona ( nombre, apellidoP, apellidoM) 
            VALUES ( @nombre, @apellidoP, @apellidoP);        
            
           

            DECLARE @personaInsertedIndex int = (SELECT SCOPE_IDENTITY() );
            SET @rowsInserted = @@ROWCOUNT;

            INSERT INTO sduma.dbo.[user] (
                [username],
                [auth_key], [password_hash], [password_reset_token], 
                [email], [status], 
              --  [created_at], [updated_at], 
                [id_Datos_Persona], [id_Horario], [id_UserLevel],
                [verification_token],
                createdAt, updatedAt
                ) 
            VALUES (
                @username, 
                @auth_key, @password_hash, @password_reset_token, 
                @email, '9', --INACTIVE
              --  SYSDATETIME() , SYSDATETIME(),
                @personaInsertedIndex, --Persona PK id inserted
                '1', '1',
                @verification_token,
                SYSDATETIME() , SYSDATETIME()
            );

            SET @rowsInserted = @rowsInserted + @@ROWCOUNT;

        COMMIT TRANSACTION CreateUserTran;
        SELECT  @rowsInserted AS ROWS_INSERTED;
    END TRY
    
    BEGIN CATCH
		DECLARE @ERROR_NUM INT = ERROR_NUMBER();
          
        DECLARE @ERROR_MSG nvarchar = ERROR_MESSAGE(); --return error as string or raised exception

		DECLARE @ERROR_STATE INT = ERROR_STATE();
        --RAISE  EXCEPTION 
        ROLLBACK TRANSACTION CreateUserTran;
        THROW; --@ERROR_NUM, @ERROR_MSG, @ERROR_STATE;

    END CATCH
GO


           
INSERT INTO [dbo].[user]
           ([username]
           ,[auth_key]
           ,[password_hash]
           ,[password_reset_token]
           ,[email]
           ,[status]
           ,[id_Datos_Persona]
           ,[id_Horario]
           ,[id_UserLevel]
           ,[createdAt]
           ,[updatedAt]
           ,[verification_token])
     VALUES
           ('Vic1'
           ,'e1wsnPlf-eGIEhdTeeZuqvNXPtM0PrPL'
           ,'$2y$13$vRqw/BkT1gYME0sX4tZ3MeXlKo1aBaywIjHl2yCSE3Cqf1iI3Tej.'
           ,NULL
           ,'ap.vicespino@gmail.com'
           ,10
           ,1
           ,1
           ,3
           ,'2022-11-08 11:23:41.947'
           ,'2022-11-08 11:23:41.947'
           ,'NmUSiARLUvE-raQgNIsvh61ibRfhtk_R_1667928221'
		   )
           ,
            (
           'RicardoExtern'
           ,'0N3Nd62-tMtHu65-8CmLk3lkVir9dXU0'
           ,'$2y$13$M3M.jbiJn8wNmXiJc9PAYOLW9.tR93R2HqzCXrj9pmoIzjR6zRU3m'
           ,NULL
           ,'cortersys@gmail.com'
           ,10
           ,2
           ,1
           ,1
           ,'2023-02-15 00:53:02.933000000'
           ,'2023-02-15 00:53:02.933000000'
           ,'TJAeV6EOGrzC3uORswsWFrV3-t40rQuJ_1676443975'
           )
           ;
GO

  		
CREATE PROCEDURE dbo.sp_create_expediente
    @idSolicitudGenerica INT,
    @newStatus INT,
    @tipoTramite INT,
    @idUserCreated INT --el que crea el expediente es el mismo que hará modificación de la solicitud generica
 AS
    BEGIN TRY
        DECLARE @rowsInserted INT = 0;
		DECLARE @newIdAnual INT;

        BEGIN TRANSACTION CreateExpediente;
            SET NOCOUNT ON 
            IF NOT (EXISTS ( SELECT  TOP (1) id FROM sduma.dbo.TipoTramite WHERE id = @tipoTramite))
            BEGIN ;
                THROW 54323, 'El tipo de trámite no existe.',1;
            END;

            IF NOT (EXISTS ( SELECT  TOP (1) id FROM sduma.dbo.SolicitudGenerica WHERE id = @idSolicitudGenerica))
            BEGIN ;
                THROW 54323, 'La solicitud no existe.',1;
            END;

            DECLARE @currentYear INT = YEAR(GETDATE());

            /* DECLARE @nextIdAnual INT =  */
            IF NOT EXISTS( SELECT TOP(1) *  FROM dbo.Expediente AS Expe ORDER BY id DESC )
                BEGIN 
                    SET  @newIdAnual = 1;
                END
            ELSE
                BEGIN 
                    SELECT TOP(1) @newIdAnual =
                        CASE 
                        -- WHEN ( NOT (EXISTS (anio) ) ) THEN  1/* no hay rows */
                            WHEN anio = @currentYear THEN  idAnual + 1 
                            WHEN anio < @currentYear THEN 1 /*  cuando el  */
                            ELSE /* Exp.anio > @currentYear */ -1
                        END
                    FROM dbo.Expediente AS Expe ORDER BY id DESC;
                END


            IF(@newIdAnual = -1)
            BEGIN ;
                THROW 54324, 'Incoherencia en fechas de expedientes. -> SP_54323_C_EXPEDIENTE ',1;
            END;   
            

            UPDATE TOP(1) [dbo].[SolicitudGenerica]
            SET  [statusSolicitud] = @newStatus     
                ,[id_User_ModificadoPor] = @idUserCreated
                ,[fechaModificacion] = GETDATE()
            WHERE id = @idSolicitudGenerica;

           -- DECLARE @solicitud int = (SELECT SCOPE_IDENTITY() ); --no need
            SET @rowsInserted = @@ROWCOUNT;

            INSERT INTO [dbo].[Expediente]
                    (
					 [idAnual]
                    ,[anio]
                    ,[fechaCreacion]
                    ,[fechaModificacion]
                    ,[estado]
                    ,[id_SolicitudGenerica]
                    ,[id_User_CreadoPor]
                    ,[id_User_modificadoPor]
                    ,[id_TipoTramite]

					)
                VALUES
                    (@newIdAnual
                    ,@currentYear
                    ,GETDATE()
                    ,GETDATE()
                    ,0
                    ,@idSolicitudGenerica
                    ,@idUserCreated 
                    ,@idUserCreated 
                    , @tipoTramite
                    )
            SET @rowsInserted = @rowsInserted + @@ROWCOUNT;

            COMMIT TRANSACTION CreateExpediente;
            SELECT  @rowsInserted AS ROWS_INSERTED;
    END TRY    
    BEGIN CATCH
		 
        --RAISE  EXCEPTION 
        ROLLBACK TRANSACTION CreateExpediente;
        THROW; --@ERROR_NUM, @ERROR_MSG, @ERROR_STATE;

    END CATCH       

GO


/* 
(<superficieTotal, int,>
,<superficiePorConstruir, int,>
,<superficiePreexistente, int,>
,<niveles, int,>
,<cajones, int,>
,<COS, nvarchar(45),>
,<CUS, nvarchar(45),>
,<RPP, nvarchar(45),>
,<tomo, nvarchar(45),>
,<folioElec, nvarchar(45),>
,<cuentaCatastral, nvarchar(45),>
,<fechaCreacion, datetime,>
,<fechaModificacion, datetime,>
,<isDeleted, bit,>
,<id_Persona_CreadoPor, int,>
,<id_Persona_ModificadoPor, int,>
,<id_Persona_DomicilioNotificaciones, int,>
,<id_DomicilioPredio, int,>
,<id_MotivoConstruccion, int,>
,<id_Contacto, int,>
,<id_TipoPredio, int,>
,<id_TipoConstruccion, int,>
,<id_GeneroConstruccion, int,>
,<id_SubGeneroConstruccion, int,>
,<id_DirectorResponsableObra, int,>
,<id_CorrSeguridadEstruc, int,>
,<id_Expediente, int,>)
 */
 	
CREATE PROCEDURE dbo.sp_create_soliconstruccion
    /* Propietario datos */
    @propietarioNombre nvarchar(255),
    @propietarioApellidoP nvarchar(255),
    @propietarioApellidoM nvarchar(255),
    
    /* Contacto */
    @email nvarchar(45),
    @telefono nvarchar(45), 
    

    /* Domicilio Notificaciones */
    @notificacionesColoniaFraccBarrio nvarchar(90),
    @notificacionesCalle nvarchar(45),
    @notificacionesNumExt nvarchar(45),
    @notificacionesNumInt nvarchar(45),
    @notificacionesCP nvarchar(10),
    @notificacionesEntreCalleV nvarchar(90),
    @notificacionesEntreCalleH nvarchar(90),
    


    @idMotivoConstruccion INT,
    @idTipoPredio INT,
    @superficieTotal INT,
    @superficiePorConstruir INT,

    /* Domicilio Predio */
    @predioColoniaFraccBarrio nvarchar(90),
    @predioCalle nvarchar(45),
    @predioNumExt nvarchar(45),
    @predioNumInt nvarchar(45),
    @predioCP nvarchar(10),
    @predioEntreCalleV nvarchar(90),
    @predioEntreCalleH nvarchar(90),

    /* Info de la construcción */
    @idGeneroConstruccion INT,
    @idSubGeneroConstruccion INT,
    @idTipoConstruccion INT,

    @niveles INT,
    @cajones INT,
    @cos nvarchar(45),
    @cus nvarchar(45),
    @superficiePreexistente INT,
    @rpp nvarchar(45),
    @tomo nvarchar(45),
    @folioElec nvarchar(45),
    @cuentaCatastral nvarchar(45),

    @idDirectorResponsableObra INT,
    @idCorrSeguridadEstruc INT,

    @idUserCreadoPor INT,
    @idExpediente INT,
    @documentos SoliHasDocParam READONLY --tipo custom

    AS
        BEGIN TRY
            DECLARE @rowsInserted INT = 0;
            DECLARE @contactoInsertedIndex int ;
            DECLARE @notificacionesDomicilioInsertedIndex int ;
            DECLARE @predioDomicilioInsertedIndex int ;
            DECLARE @soliConstrucInsertedIndex int ;
            DECLARE @propietarioInsertedIndex int ;
            

            BEGIN TRANSACTION CreateSolicitudConstruccion;
                SET NOCOUNT ON 

                IF NOT (EXISTS ( SELECT  TOP (1) id FROM sduma.dbo.Expediente WHERE id = @idExpediente))
                BEGIN ;
                    THROW 54324, 'El expediente no existe.',1;
                END;   

                IF (EXISTS ( SELECT  TOP (1) id FROM sduma.dbo.SolicitudConstruccion WHERE id_Expediente = @idExpediente))
                BEGIN ;
                    THROW 54325, 'Ya hay una solicitud para este expediente.',1;
                END;   

/* Checar que el expediente no tenga solicitud */
                INSERT INTO [dbo].[Contacto] ([email] ,[telefono])  VALUES (@email , @telefono );
    
                SET @contactoInsertedIndex = (SELECT SCOPE_IDENTITY() );
                SET @rowsInserted = @@ROWCOUNT;
    
                INSERT INTO [dbo].[Domicilio]
                        ([coloniaFraccBarrio]
                        ,[calle]
                        ,[numExt]
                        ,[numInt]
                        ,[cp]
                        ,[entreCallesH]
                        ,[entreCallesV])
                    VALUES
                        (@notificacionesColoniaFraccBarrio
                        ,@notificacionesCalle
                        ,@notificacionesNumExt
                        ,@notificacionesNumExt
                        ,@notificacionesCP
                        ,@notificacionesEntreCalleH
                        ,@notificacionesEntreCalleV
                        );
                SET @notificacionesDomicilioInsertedIndex = (SELECT SCOPE_IDENTITY() );
                SET @rowsInserted = @rowsInserted + @@ROWCOUNT;

                INSERT INTO [dbo].[Domicilio]
                        ([coloniaFraccBarrio]
                        ,[calle]
                        ,[numExt]
                        ,[numInt]
                        ,[cp]
                        ,[entreCallesH]
                        ,[entreCallesV])
                    VALUES
                        (@predioColoniaFraccBarrio
                        ,@predioCalle
                        ,@predioNumExt
                        ,@predioNumExt
                        ,@predioCP
                        ,@predioEntreCalleH
                        ,@predioEntreCalleV
                        );
                SET @predioDomicilioInsertedIndex = (SELECT SCOPE_IDENTITY() );
                SET @rowsInserted = @rowsInserted + @@ROWCOUNT;

                
                INSERT INTO [dbo].[SolicitudConstruccion]
                        ([superficieTotal]
                        ,[superficiePorConstruir]
                        ,[superficiePreexistente]
                        ,[niveles]
                        ,[cajones]
                        ,[COS]
                        ,[CUS]
                        ,[RPP]
                        ,[tomo]
                        ,[folioElec]
                        ,[cuentaCatastral]
                        ,[fechaCreacion]
                        ,[fechaModificacion]
                        ,[isDeleted]
                        ,[id_User_CreadoPor]
                        ,[id_User_ModificadoPor]
                        ,[id_DomicilioNotificaciones]
                        ,[id_DomicilioPredio]
                        ,[id_MotivoConstruccion]
                        ,[id_Contacto]
                        ,[id_TipoPredio]
                        ,[id_TipoConstruccion]
                        ,[id_GeneroConstruccion]
                        ,[id_SubGeneroConstruccion]
                        ,[id_DirectorResponsableObra]
                        ,[id_CorrSeguridadEstruc]
                        ,[id_Expediente])
                VALUES
                    (@superficieTotal
                    ,@superficiePorConstruir
                    ,@superficiePreexistente 
                    ,@niveles 
                    ,@cajones 
                    ,@cos 
                    ,@cus 
                    ,@rpp
                    ,@tomo
                    ,@folioElec
                    ,@cuentaCatastral 
                    ,GETDATE()--fechaCreacion 
                    ,GETDATE()--fechaModificacion 
                    ,0--<isDeleted, bit,>
                    ,@idUserCreadoPor--<id_User_CreadoPor, int,>
                    ,@idUserCreadoPor--<id_User_ModificadoPor, int,>
                    ,@notificacionesDomicilioInsertedIndex--<id_DomicilioNotificaciones, int,>
                    ,@predioDomicilioInsertedIndex--<id_DomicilioPredio, int,>
                    ,@idMotivoConstruccion--<id_MotivoConstruccion, int,>
                    ,@contactoInsertedIndex--<id_Contacto, int,>
                    ,@idTipoPredio--<id_TipoPredio, int,>
                    ,@idTipoConstruccion--<id_TipoConstruccion, int,>
                    ,@idGeneroConstruccion--<id_GeneroConstruccion, int,>
                    ,@idSubGeneroConstruccion--<id_SubGeneroConstruccion, int,>
                    ,@idDirectorResponsableObra--<id_DirectorResponsableObra, int,>
                    ,@idCorrSeguridadEstruc--<id_CorrSeguridadEstruc, int,>
                    ,@idExpediente--<id_Expediente, int,>
                    );

                SET @soliConstrucInsertedIndex = (SELECT SCOPE_IDENTITY() );
                SET @rowsInserted = @rowsInserted + @@ROWCOUNT;

                INSERT INTO [dbo].[Persona]
                    ([nombre]
                    ,[apellidoP]
                    ,[apellidoM])
                VALUES
                    (@propietarioNombre
                    ,@propietarioApellidoP
                    ,@propietarioApellidoM
                    );
                SET @propietarioInsertedIndex = (SELECT SCOPE_IDENTITY() );
                SET @rowsInserted = @rowsInserted + @@ROWCOUNT;

                INSERT INTO [dbo].[SolicitudConstruccion_has_Persona]
                    ([SolicitudConstruccion_Id] ,[Persona_id])
                VALUES
                    (   @soliConstrucInsertedIndex ,
                        @propietarioInsertedIndex
                    );
                SET @rowsInserted = @rowsInserted + @@ROWCOUNT;


                INSERT INTO [dbo].[SolicitudConstruccion_has_Documento]
                    ([id_SolicitudConstruccion]
                    ,[id_Documento]
                    ,[isEntregado]
                    ,[nombreArchivo]
                    ,[path]
                    ,[realNombreArchivo])
                
                SELECT  @soliConstrucInsertedIndex,id_Documento,
                        isEntregado,nombreArchivo,
                        [path],realNombreArchivo
                FROM @documentos;          
                /*   (<id_SolicitudConstruccion, int,>
                    ,<id_Documento, int,>
                    ,<isEntregado, bit,>
                    ,<nombreArchivo, nvarchar(128),>
                    ,<path, nvarchar(128),>
                    ,<realNombreArchivo, nvarchar(90),>
                    ); */
            SET @rowsInserted = @rowsInserted + @@ROWCOUNT;

            COMMIT TRANSACTION CreateSolicitudConstruccion;
                    SELECT  @rowsInserted AS ROWS_INSERTED;
        END TRY    
        BEGIN CATCH
            
            --RAISE  EXCEPTION 
            ROLLBACK TRANSACTION CreateSolicitudConstruccion;
            THROW; --@ERROR_NUM, @ERROR_MSG, @ERROR_STATE;

        END CATCH       
GO        


CREATE PROCEDURE dbo.sp_update_soliconstruccion
     /* Propietario datos */
    @propietarioNombre nvarchar(255),
    @propietarioApellidoP nvarchar(255),
    @propietarioApellidoM nvarchar(255),
    
    /* Contacto */
    @email nvarchar(45),
    @telefono nvarchar(45), 
    

    /* Domicilio Notificaciones */
    @notificacionesColoniaFraccBarrio nvarchar(90),
    @notificacionesCalle nvarchar(45),
    @notificacionesNumExt nvarchar(45),
    @notificacionesNumInt nvarchar(45),
    @notificacionesCP nvarchar(10),
    @notificacionesEntreCalleV nvarchar(90),
    @notificacionesEntreCalleH nvarchar(90),
    

    @idMotivoConstruccion INT,
    @idTipoPredio INT,
    @superficieTotal INT,
    @superficiePorConstruir INT,

    /* Domicilio Predio */
    @predioColoniaFraccBarrio nvarchar(90),
    @predioCalle nvarchar(45),
    @predioNumExt nvarchar(45),
    @predioNumInt nvarchar(45),
    @predioCP nvarchar(10),
    @predioEntreCalleV nvarchar(90),
    @predioEntreCalleH nvarchar(90),--23

    /* Info de la construcción */
    @idGeneroConstruccion INT,
    @idSubGeneroConstruccion INT,
    @idTipoConstruccion INT,

    @niveles INT,
    @cajones INT,
    @cos nvarchar(45),
    @cus nvarchar(45),
    @superficiePreexistente INT,
    @rpp nvarchar(45),
    @tomo nvarchar(45),
    @folioElec nvarchar(45),
    @cuentaCatastral nvarchar(45),--35

    @idDirectorResponsableObra INT,
    @idCorrSeguridadEstruc INT,

    @idUserModificadoPor INT,   
    @idExpediente INT,
    @documentos SoliHasDocParam READONLY --tipo custom --40
    
    AS
        BEGIN TRY
         /* Todos los PK de las tablas relacionadas, se obtienen por medio el expediente ID.
            De esta manera, se evita traer los IDs directos de cada unade las relaciones de la solicitud
            y así evitar cambios inesperados por algun sql injection o no intencional (error al pasar el id o un id equivocado).
        */
            DECLARE @idSolicitudConstrucEdit INT;
            DECLARE @rowsInserted INT = 0;
            DECLARE @contactoIndex INT ;
            DECLARE @notificacionesDomicilioIndex INT ;
            DECLARE @predioDomicilioIndex INT ;
            DECLARE @soliConstrucIndex INT ;
            DECLARE @propietarioIndex INT ;

            BEGIN TRANSACTION UpdateSolicitudConstruccion;
                SET NOCOUNT ON 

                IF NOT (EXISTS ( SELECT  TOP (1) id FROM sduma.dbo.Expediente WHERE id = @idExpediente))
                BEGIN ;
                    THROW 54326, 'El expediente no existe.',1;
                END;   

                IF NOT (EXISTS ( SELECT  TOP (1) id FROM sduma.dbo.SolicitudConstruccion WHERE id_Expediente = @idExpediente))
                BEGIN ;
                    THROW 54327, 'La solicitud solicitud no existe.',1;
                END;   
/*  
    Se obtienen los ID de las entidades relacionadas. 
    Así se evita que en la consulta pueda traer un ID incorrecto y modificar los datos de alguien mas.
 */
 --Los demás IDs si deben existir, ya que son obligatorios, y no se pueden borrar por el constraint de las tablas
 --asi que no se revisa que existtan
 
                SELECT 
                    @idSolicitudConstrucEdit = id,
                    @contactoIndex = id_Contacto,
                    @notificacionesDomicilioIndex = id_DomicilioNotificaciones,
                    @predioDomicilioIndex = id_DomicilioPredio
                FROM sduma.dbo.SolicitudConstruccion 
                WHERE id_Expediente = @idExpediente;

                /* Actualizar contacto */
                UPDATE [dbo].[Contacto]
                    SET [email] = @email, [telefono] = @telefono
                    WHERE id = @contactoIndex;
                SET @rowsInserted = @@ROWCOUNT;

                /* Actualizar notificaciones */
                UPDATE [dbo].[Domicilio]
                    SET  [coloniaFraccBarrio] = @notificacionesColoniaFraccBarrio
                        ,[calle] = @notificacionesCalle
                        ,[numExt] = @notificacionesNumExt
                        ,[numInt] = @notificacionesNumInt
                        ,[cp] = @notificacionesCP
                        ,[entreCallesH] = @notificacionesEntreCalleV
                        ,[entreCallesV] = @notificacionesEntreCalleH
                    WHERE id = @notificacionesDomicilioIndex;
                SET @rowsInserted = @rowsInserted + @@ROWCOUNT;

                /* Actualizar predio */
                UPDATE [dbo].[Domicilio]
                    SET  [coloniaFraccBarrio] = @predioColoniaFraccBarrio
                            ,[calle] = @predioCalle
                            ,[numExt] = @predioNumExt
                            ,[numInt] = @predioNumInt
                            ,[cp] = @predioCP
                            ,[entreCallesH] = @predioEntreCalleV
                            ,[entreCallesV] = @predioEntreCalleH
                    WHERE id = @predioDomicilioIndex;
                SET @rowsInserted = @rowsInserted + @@ROWCOUNT;

                /* Update Solicitud Construccion */
                
                UPDATE [dbo].[SolicitudConstruccion]
                    SET [superficieTotal] =  @superficieTotal
                        ,[superficiePorConstruir] = @superficiePorConstruir
                        ,[superficiePreexistente] = @superficiePreexistente
                        ,[niveles] = @niveles
                        ,[cajones] = @cajones
                        ,[COS] = @cos
                        ,[CUS] = @cus  
                        ,[RPP] = @rpp
                        ,[tomo] = @tomo
                        ,[folioElec] = @folioElec
                        ,[cuentaCatastral] = @cuentaCatastral
                        --,[fechaCreacion] = <fechaCreacion, datetime,>
                        ,[fechaModificacion] = GETDATE()
                        --,[isDeleted] = <isDeleted, bit,>
                        --,[id_User_CreadoPor] = <id_User_CreadoPor, int,>
                        ,[id_User_ModificadoPor] = @idUserModificadoPor
                        --,[id_DomicilioNotificaciones] = <id_DomicilioNotificaciones, int,>
                       -- ,[id_DomicilioPredio] = <id_DomicilioPredio, int,>
                        ,[id_MotivoConstruccion] = @idMotivoConstruccion
                        --,[id_Contacto] = <id_Contacto, int,>
                        ,[id_TipoPredio] = @idTipoPredio
                        ,[id_TipoConstruccion] = @idTipoConstruccion
                        ,[id_GeneroConstruccion] =  @idGeneroConstruccion
                        ,[id_SubGeneroConstruccion] = @idSubGeneroConstruccion
                        ,[id_DirectorResponsableObra] =  @idDirectorResponsableObra
                        ,[id_CorrSeguridadEstruc] = @idCorrSeguridadEstruc
                       -- ,[id_Expediente] = <id_Expediente, int,>
                    WHERE id = @idSolicitudConstrucEdit;
                SET @rowsInserted = @rowsInserted + @@ROWCOUNT;


                /* Actualiza los documentos */                
                UPDATE SCD 
                    SET  isEntregado = temp.isEntregado,
                        nombreArchivo = temp.nombreArchivo,
                        [path] = temp.[path],
                        realNombreArchivo = temp.realNombreArchivo
                    FROM   SolicitudConstruccion_has_Documento   AS SCD
                    INNER JOIN @documentos AS temp --TVP SP Param uwu
                        ON SCD.id_Documento = temp.id_Documento
                WHERE SCD.id_SolicitudConstruccion = @idSolicitudConstrucEdit;--Unicamente para el id solicitud que llega en el SP.
                SET @rowsInserted = @rowsInserted + @@ROWCOUNT;

                --ELIMINAR LOS QUE NO HAGAN INNER JOIN, 
                --porque fueron deslinkeados en UI. 7u7 
                
                 /* Actualiza los propietarios */                
                UPDATE P 
                    SET  nombre =@propietarioNombre, --usar TVP para soportar N propietarios
                        apellidoP = @propietarioApellidoP,
                        apellidoM = @propietarioApellidoM                        
                    FROM SolicitudConstruccion_has_Persona SCP 
                    INNER JOIN Persona P ON SCP.Persona_id = P.id                       
                WHERE SCP.SolicitudConstruccion_Id = @idSolicitudConstrucEdit;--Unicamente para el id solicitud que llega en el SP.
                
                
                SET @rowsInserted = @rowsInserted + @@ROWCOUNT;

            COMMIT TRANSACTION UpdateSolicitudConstruccion;
                    SELECT  @rowsInserted AS ROWS_INSERTED;
        END TRY
        BEGIN CATCH
            ROLLBACK TRANSACTION UpdateSolicitudConstruccion;
            THROW; --@ERROR_NUM, @ERROR_MSG, @ERROR_STATE;
        END CATCH

GO