USE [sduma]
GO
SET IDENTITY_INSERT [dbo].[Persona] ON 
GO
INSERT [dbo].[Persona] ([id], [nombre], [apellidoP], [apellidoM]) VALUES (1, N'Victor Alfonso', N'Pérez', N'Espino')
GO
INSERT [dbo].[Persona] ([id], [nombre], [apellidoP], [apellidoM]) VALUES (2, N'Victor Alfoso', N'Pérez', N'Pérez')
GO
INSERT [dbo].[Persona] ([id], [nombre], [apellidoP], [apellidoM]) VALUES (3, N'goku', N'javies', N'javies')
GO
INSERT [dbo].[Persona] ([id], [nombre], [apellidoP], [apellidoM]) VALUES (4, N'goku', N'javies', N'javies')
GO
INSERT [dbo].[Persona] ([id], [nombre], [apellidoP], [apellidoM]) VALUES (5, N'goku', N'javies', N'javies')
GO
INSERT [dbo].[Persona] ([id], [nombre], [apellidoP], [apellidoM]) VALUES (6, N'goku', N'javies', N'javies')
GO
INSERT [dbo].[Persona] ([id], [nombre], [apellidoP], [apellidoM]) VALUES (7, N'goku', N'javies', N'javies')
GO
INSERT [dbo].[Persona] ([id], [nombre], [apellidoP], [apellidoM]) VALUES (8, N'Vic123_G', N'asdasd', N'asdasd')
GO
INSERT [dbo].[Persona] ([id], [nombre], [apellidoP], [apellidoM]) VALUES (9, N'Vic123_G', N'asdasd', N'asdasd')
GO
INSERT [dbo].[Persona] ([id], [nombre], [apellidoP], [apellidoM]) VALUES (10, N'Vic123', N'rr', N'rr')
GO
INSERT [dbo].[Persona] ([id], [nombre], [apellidoP], [apellidoM]) VALUES (11, N'Victor Alfonso', N'Pérez', N'Pérez')
GO
INSERT [dbo].[Persona] ([id], [nombre], [apellidoP], [apellidoM]) VALUES (12, N'Victor Alfonso', N'Pérez', N'Pérez')
GO
SET IDENTITY_INSERT [dbo].[Persona] OFF
GO
 

GO
SET IDENTITY_INSERT [dbo].[user] ON 
GO
INSERT [dbo].[user] ([id], [username], [auth_key], [password_hash], [password_reset_token], [email], [status], [id_Datos_Persona], [id_Horario], [id_UserLevel], [createdAt], [updatedAt], [verification_token]) VALUES (1, N'Vic1', N'e1wsnPlf-eGIEhdTeeZuqvNXPtM0PrPL', N'$2y$13$vRqw/BkT1gYME0sX4tZ3MeXlKo1aBaywIjHl2yCSE3Cqf1iI3Tej.', NULL, N'ap.vicespino@gmail.com', 10, 1, 1, 3, CAST(N'2022-11-08T11:23:41.947' AS DateTime), CAST(N'2022-11-08T11:23:41.947' AS DateTime), N'NmUSiARLUvE-raQgNIsvh61ibRfhtk_R_1667928221')
GO
SET IDENTITY_INSERT [dbo].[user] OFF
GO
GO
SET IDENTITY_INSERT [dbo].[Domicilio] ON 
GO
INSERT [dbo].[Domicilio] ([id], [coloniaFraccBarrio], [calle], [numExt], [numInt], [cp], [entreCallesH], [entreCallesV]) VALUES (1, 'colonia 1', N'micalle', N'5', N'6', N'60000', N'emtre calle h', N'emtre calle v')
GO
INSERT [dbo].[Domicilio] ([id], [coloniaFraccBarrio], [calle], [numExt], [numInt], [cp], [entreCallesH], [entreCallesV]) VALUES (2, 'colonia 2', N'calle', N'222', N'2232', N'60012', N'asdasd', N'UWUWUW')
GO
SET IDENTITY_INSERT [dbo].[Domicilio] OFF

GO
SET IDENTITY_INSERT [dbo].[Expediente] ON 
GO
INSERT [dbo].[Expediente] ([id], [idAnual], [anio], [fechaCreacion], [fechaModificacion], [estado], [id_Persona_Solicita], [id_User_CreadoPor], [id_User_modificadoPor], [id_TipoTramite]) VALUES (1, 1, 2022, CAST(N'2022-11-11T00:20:20.173' AS DateTime), CAST(N'2022-11-11T00:20:20.173' AS DateTime), 1, 2, 1, 1, 1)
GO
INSERT [dbo].[Expediente] ([id], [idAnual], [anio], [fechaCreacion], [fechaModificacion], [estado], [id_Persona_Solicita], [id_User_CreadoPor], [id_User_modificadoPor], [id_TipoTramite]) VALUES (2, 2, 2022, CAST(N'2022-11-11T00:21:33.673' AS DateTime), CAST(N'2022-11-11T00:21:33.673' AS DateTime), 1, 3, 1, 1, 1)
GO
INSERT [dbo].[Expediente] ([id], [idAnual], [anio], [fechaCreacion], [fechaModificacion], [estado], [id_Persona_Solicita], [id_User_CreadoPor], [id_User_modificadoPor], [id_TipoTramite]) VALUES (3, 3, 2022, CAST(N'2022-11-11T00:29:27.130' AS DateTime), CAST(N'2022-11-11T00:29:27.130' AS DateTime), 1, 4, 1, 1, 1)
GO
INSERT [dbo].[Expediente] ([id], [idAnual], [anio], [fechaCreacion], [fechaModificacion], [estado], [id_Persona_Solicita], [id_User_CreadoPor], [id_User_modificadoPor], [id_TipoTramite]) VALUES (4, 4, 2022, CAST(N'2022-11-11T00:31:01.430' AS DateTime), CAST(N'2022-11-11T00:31:01.430' AS DateTime), 1, 5, 1, 1, 1)
GO
INSERT [dbo].[Expediente] ([id], [idAnual], [anio], [fechaCreacion], [fechaModificacion], [estado], [id_Persona_Solicita], [id_User_CreadoPor], [id_User_modificadoPor], [id_TipoTramite]) VALUES (5, 5, 2022, CAST(N'2022-11-11T00:31:03.063' AS DateTime), CAST(N'2022-11-11T00:31:03.063' AS DateTime), 1, 6, 1, 1, 1)
GO
INSERT [dbo].[Expediente] ([id], [idAnual], [anio], [fechaCreacion], [fechaModificacion], [estado], [id_Persona_Solicita], [id_User_CreadoPor], [id_User_modificadoPor], [id_TipoTramite]) VALUES (6, 6, 2022, CAST(N'2022-11-11T00:31:05.440' AS DateTime), CAST(N'2022-11-11T00:31:05.440' AS DateTime), 1, 7, 1, 1, 1)
GO
INSERT [dbo].[Expediente] ([id], [idAnual], [anio], [fechaCreacion], [fechaModificacion], [estado], [id_Persona_Solicita], [id_User_CreadoPor], [id_User_modificadoPor], [id_TipoTramite]) VALUES (7, 7, 2022, CAST(N'2022-11-11T00:31:19.157' AS DateTime), CAST(N'2022-11-11T00:31:19.157' AS DateTime), 1, 8, 1, 1, 1)
GO
INSERT [dbo].[Expediente] ([id], [idAnual], [anio], [fechaCreacion], [fechaModificacion], [estado], [id_Persona_Solicita], [id_User_CreadoPor], [id_User_modificadoPor], [id_TipoTramite]) VALUES (8, 8, 2022, CAST(N'2022-11-11T00:31:31.490' AS DateTime), CAST(N'2022-11-11T00:31:31.490' AS DateTime), 1, 9, 1, 1, 1)
GO
INSERT [dbo].[Expediente] ([id], [idAnual], [anio], [fechaCreacion], [fechaModificacion], [estado], [id_Persona_Solicita], [id_User_CreadoPor], [id_User_modificadoPor], [id_TipoTramite]) VALUES (9, 9, 2022, CAST(N'2022-11-11T00:32:32.170' AS DateTime), CAST(N'2022-11-11T00:32:32.170' AS DateTime), 1, 10, 1, 1, 1)
GO
INSERT [dbo].[Expediente] ([id], [idAnual], [anio], [fechaCreacion], [fechaModificacion], [estado], [id_Persona_Solicita], [id_User_CreadoPor], [id_User_modificadoPor], [id_TipoTramite]) VALUES (10, 10, 2022, CAST(N'2022-11-11T00:33:04.003' AS DateTime), CAST(N'2022-11-11T00:33:04.003' AS DateTime), 1, 11, 1, 1, 1)
GO
INSERT [dbo].[Expediente] ([id], [idAnual], [anio], [fechaCreacion], [fechaModificacion], [estado], [id_Persona_Solicita], [id_User_CreadoPor], [id_User_modificadoPor], [id_TipoTramite]) VALUES (11, 11, 2022, CAST(N'2022-11-11T00:35:24.360' AS DateTime), CAST(N'2022-11-11T00:35:24.360' AS DateTime), 1, 12, 1, 1, 1)
GO
SET IDENTITY_INSERT [dbo].[Expediente] OFF








USE [sduma]
GO

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
           ,[id_Persona_CreadoPor]
           ,[id_Persona_ModificadoPor]
           ,[id_Persona_DomicilioNotificaciones]
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
           (100
           ,101
           ,102
           ,2
           ,3
           ,'coss'
           ,'cuss'
           ,'rpp'
           ,'tomooo'
           ,'folio elec'
           ,'cuenta cata'
           ,GETDATE()
           ,GETDATE()
           ,0--is deleted
           ,1
           ,1
           ,1--domicilio notif
           ,2--domicilio predio
           ,1
           ,NULL --contacto
           ,1--tipo predio
           ,1
           ,1--SUB genero constru
           ,1--dir respon
           ,NULL
           ,NULL
           ,1)
GO