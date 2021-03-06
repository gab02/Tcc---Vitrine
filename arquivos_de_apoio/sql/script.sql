USE [VITRINE_201901]
GO
/****** Object:  Table [dbo].[tbl_arquivo]    Script Date: 16/06/2019 23:44:07 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[tbl_arquivo](
	[id_arquivo] [int] IDENTITY(1,1) NOT NULL,
	[id_projeto_arquivo] [int] NOT NULL,
	[nome_arquivo] [varchar](50) NOT NULL,
	[caminho_arquivo] [varchar](100) NOT NULL,
PRIMARY KEY CLUSTERED 
(
	[id_arquivo] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[tbl_arquivo_perfil]    Script Date: 16/06/2019 23:44:07 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[tbl_arquivo_perfil](
	[id_arquivo] [int] IDENTITY(1,1) NOT NULL,
	[id_artista_arquivo] [int] NOT NULL,
	[caminho_arquivo] [varchar](500) NOT NULL
) ON [PRIMARY]

GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[tbl_artista]    Script Date: 16/06/2019 23:44:07 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[tbl_artista](
	[id_usuario] [int] NOT NULL,
	[remoto_artista] [bit] NULL,
	[nascimento_artista] [date] NOT NULL,
PRIMARY KEY CLUSTERED 
(
	[id_usuario] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
/****** Object:  Table [dbo].[tbl_candidatura]    Script Date: 16/06/2019 23:44:07 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[tbl_candidatura](
	[id_candidatura] [int] IDENTITY(1,1) NOT NULL,
	[id_artista_candidatura] [int] NOT NULL,
	[id_vaga_candidatura] [int] NOT NULL,
	[status_candidatura] [int] NOT NULL,
PRIMARY KEY CLUSTERED 
(
	[id_candidatura] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
/****** Object:  Table [dbo].[tbl_contratante]    Script Date: 16/06/2019 23:44:07 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[tbl_contratante](
	[id_usuario] [int] NOT NULL,
	[premium_contratante] [bit] NOT NULL,
	[ramo_contratante] [varchar](50) NOT NULL,
	[razaosocial_contratante] [varchar](50) NOT NULL,
	[site_contratante] [varchar](50) NULL,
	[cnpj_contratante] [int] NULL,
	[porte_contratante] [varchar](20) NULL,
PRIMARY KEY CLUSTERED 
(
	[id_usuario] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[tbl_experiencia]    Script Date: 16/06/2019 23:44:07 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[tbl_experiencia](
	[id_exp] [int] NOT NULL,
	[id_artista_exp] [int] NOT NULL,
	[empresa_exp] [varchar](50) NOT NULL,
	[cargo_exp] [varchar](50) NOT NULL,
	[inicio_exp] [date] NOT NULL,
	[fim_exp] [date] NULL,
	[descricao_exp] [text] NULL
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]

GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[tbl_projeto]    Script Date: 16/06/2019 23:44:07 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[tbl_projeto](
	[id_projeto] [int] IDENTITY(1,1) NOT NULL,
	[id_artista_projeto] [int] NOT NULL,
	[nm_projeto] [varchar](50) NOT NULL,
	[dtInclu_projeto] [date] NOT NULL,
	[categ_projeto] [varchar](50) NOT NULL,
	[descr_projeto] [text] NULL,
PRIMARY KEY CLUSTERED 
(
	[id_projeto] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]

GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[tbl_usuario]    Script Date: 16/06/2019 23:44:07 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[tbl_usuario](
	[id_usuario] [int] IDENTITY(1,1) NOT NULL,
	[nm_usuario] [varchar](100) NOT NULL,
	[login_usuario] [varchar](20) NOT NULL,
	[senha_usuario] [char](32) NOT NULL,
	[local_usuario] [varchar](100) NULL,
	[email_usuario] [varchar](100) NOT NULL,
	[telefone_usuario] [varchar](15) NULL,
	[descricao_usuario] [text] NULL,
	[ativo_usuario] [bit] NOT NULL DEFAULT ((1)),
	[profissao] [varchar](50) NULL,
PRIMARY KEY CLUSTERED 
(
	[id_usuario] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]

GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[tbl_vaga]    Script Date: 16/06/2019 23:44:07 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[tbl_vaga](
	[id_vaga] [int] IDENTITY(1,1) NOT NULL,
	[id_contratante_vaga] [int] NOT NULL,
	[qtd_vaga] [int] NOT NULL,
	[remuneracao_vaga] [numeric](18, 0) NOT NULL,
	[tipo_vaga] [varchar](20) NOT NULL,
	[requisito_vaga] [text] NOT NULL,
	[descricao_vaga] [text] NULL,
	[status_vaga] [bit] NOT NULL,
	[cargo_vaga] [varchar](50) NOT NULL,
	[nm_vaga] [varchar](50) NULL,
	[ramo_vaga] [varchar](50) NULL,
	[localizacao] [varchar](50) NULL,
	[tipo_local] [varchar](50) NULL,
PRIMARY KEY CLUSTERED 
(
	[id_vaga] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]

GO
SET ANSI_PADDING OFF
GO
ALTER TABLE [dbo].[tbl_arquivo]  WITH CHECK ADD  CONSTRAINT [FK_projeto_arquivo] FOREIGN KEY([id_projeto_arquivo])
REFERENCES [dbo].[tbl_projeto] ([id_projeto])
GO
ALTER TABLE [dbo].[tbl_arquivo] CHECK CONSTRAINT [FK_projeto_arquivo]
GO
ALTER TABLE [dbo].[tbl_artista]  WITH CHECK ADD  CONSTRAINT [FK_usuario_artista] FOREIGN KEY([id_usuario])
REFERENCES [dbo].[tbl_usuario] ([id_usuario])
GO
ALTER TABLE [dbo].[tbl_artista] CHECK CONSTRAINT [FK_usuario_artista]
GO
ALTER TABLE [dbo].[tbl_candidatura]  WITH CHECK ADD  CONSTRAINT [FK_artista_candidatura] FOREIGN KEY([id_artista_candidatura])
REFERENCES [dbo].[tbl_artista] ([id_usuario])
GO
ALTER TABLE [dbo].[tbl_candidatura] CHECK CONSTRAINT [FK_artista_candidatura]
GO
ALTER TABLE [dbo].[tbl_candidatura]  WITH CHECK ADD  CONSTRAINT [FK_vaga_candidatura] FOREIGN KEY([id_vaga_candidatura])
REFERENCES [dbo].[tbl_vaga] ([id_vaga])
GO
ALTER TABLE [dbo].[tbl_candidatura] CHECK CONSTRAINT [FK_vaga_candidatura]
GO
ALTER TABLE [dbo].[tbl_contratante]  WITH CHECK ADD  CONSTRAINT [FK_usuario_contratante] FOREIGN KEY([id_usuario])
REFERENCES [dbo].[tbl_usuario] ([id_usuario])
GO
ALTER TABLE [dbo].[tbl_contratante] CHECK CONSTRAINT [FK_usuario_contratante]
GO
ALTER TABLE [dbo].[tbl_experiencia]  WITH CHECK ADD  CONSTRAINT [FK_artista_experiencia] FOREIGN KEY([id_artista_exp])
REFERENCES [dbo].[tbl_artista] ([id_usuario])
GO
ALTER TABLE [dbo].[tbl_experiencia] CHECK CONSTRAINT [FK_artista_experiencia]
GO
ALTER TABLE [dbo].[tbl_projeto]  WITH CHECK ADD  CONSTRAINT [FK_artista_projeto] FOREIGN KEY([id_artista_projeto])
REFERENCES [dbo].[tbl_artista] ([id_usuario])
GO
ALTER TABLE [dbo].[tbl_projeto] CHECK CONSTRAINT [FK_artista_projeto]
GO
ALTER TABLE [dbo].[tbl_vaga]  WITH CHECK ADD  CONSTRAINT [FK_contratante_projeto] FOREIGN KEY([id_contratante_vaga])
REFERENCES [dbo].[tbl_contratante] ([id_usuario])
GO
ALTER TABLE [dbo].[tbl_vaga] CHECK CONSTRAINT [FK_contratante_projeto]
GO
/****** Object:  StoredProcedure [dbo].[BuscaUsuario]    Script Date: 16/06/2019 23:44:07 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[BuscaUsuario]
@LOGIN VARCHAR (MAX),
@SENHA CHAR(32)
AS

DECLARE @ID INT; 
SELECT @ID = U.id_usuario FROM tbl_usuario U WHERE U.login_usuario = @LOGIN AND senha_usuario = @SENHA;

if ((select count(*) from tbl_artista A WHERE A.id_usuario = @ID) > 0)
		SELECT U.*, A.* FROM tbl_usuario U LEFT JOIN tbl_artista A ON U.id_usuario = A.id_usuario WHERE U.id_usuario = @ID


if ((select count(*) from tbl_contratante C WHERE C.id_usuario = @ID) > 0)
		SELECT U.*, C.* FROM tbl_usuario U LEFT JOIN tbl_contratante C ON U.id_usuario = C.id_usuario WHERE U.id_usuario = @ID


GO
/****** Object:  StoredProcedure [dbo].[buscaVagaPorContratante]    Script Date: 16/06/2019 23:44:07 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[buscaVagaPorContratante] 
@id_contratante_vaga INT
AS
BEGIN
	SELECT * FROM tbl_vaga WHERE id_contratante_vaga = @id_contratante_vaga
END


GO
/****** Object:  StoredProcedure [dbo].[filtrarVagas]    Script Date: 16/06/2019 23:44:07 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[filtrarVagas] @TIPO VARCHAR(50), @LOCAL VARCHAR (50), @RAMO VARCHAR(50) 
AS
BEGIN

	declare @SQL VARCHAR(255) 

	IF @TIPO IS NULL AND @LOCAL IS NULL AND @RAMO IS NULL
		select * from tbl_vaga

	IF @TIPO IS NOT NULL AND @LOCAL IS NULL AND @RAMO IS NULL
		select * from tbl_vaga where tipo_vaga = @TIPO

	IF @TIPO IS NULL AND @LOCAL IS NOT NULL AND @RAMO IS NULL
		select * from tbl_vaga where localizacao = @LOCAL

	IF @TIPO IS NOT NULL AND @LOCAL IS NOT NULL AND @RAMO IS NOT NULL
		select * from tbl_vaga where tipo_vaga = @TIPO AND localizacao = @LOCAL AND ramo_vaga = @RAMO

END

GO
/****** Object:  StoredProcedure [dbo].[insertUsuario]    Script Date: 16/06/2019 23:44:07 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[insertUsuario] --- Declarando o nome da procedure,

@LOGIN VARCHAR (MAX),
@SENHA CHAR(32),
@NOME VARCHAR (MAX),
@EMAIL VARCHAR (MAX),
@LOCAL VARCHAR (MAX),
@TELEFONE VARCHAR (MAX),
@DESCRICAO VARCHAR (MAX),
@ATIVO VARCHAR (MAX),
@REMOTO BIT,
@NASCIMENTO DATE,
@PREMIUM BIT,
@RAMO VARCHAR(MAX),
@RAZAO_SOCIAL VARCHAR(MAX),
@SITE VARCHAR(MAX),
@CNPJ INT,
@PORTE VARCHAR(MAX),
@TIPO_INSERT VARCHAR(MAX)
AS
BEGIN TRANSACTION;
--INSERT USUARIO
	INSERT INTO [dbo].[tbl_usuario]
           ([nm_usuario]
           ,[login_usuario]
           ,[senha_usuario]
           ,[local_usuario]
           ,[email_usuario]
           ,[telefone_usuario]
           ,[descricao_usuario]
           ,[ativo_usuario])
     VALUES
           (@NOME
           ,@LOGIN
           ,@SENHA
           ,@LOCAL
           ,@EMAIL
           ,@TELEFONE
           ,@DESCRICAO
           ,@ATIVO)

	

	DECLARE @id int

	SELECT @id = MAX(id_usuario) FROM tbl_usuario

--INSERT ARTISTA
	IF(@TIPO_INSERT = 'A')
	BEGIN
		INSERT INTO [dbo].[tbl_artista]
			   ([id_usuario]
			   ,[remoto_artista]
			   ,[nascimento_artista])
		 VALUES
			   (@id
			   ,@REMOTO
			   ,@NASCIMENTO
			   )
	END
    ELSE IF(@TIPO_INSERT = 'C')
	BEGIN
		INSERT INTO [dbo].[tbl_contratante]
           ([id_usuario]
           ,[premium_contratante]
           ,[ramo_contratante]
           ,[razaosocial_contratante]
           ,[site_contratante]
           ,[cnpj_contratante]
           ,[porte_contratante])
     VALUES
           (@id
           ,@PREMIUM
		   ,@RAMO
		   ,@RAZAO_SOCIAL
		   ,@SITE 
		   ,@CNPJ 
		   ,@PORTE)
	END
IF @@ERROR = 0
	COMMIT
ELSE
	ROLLBACK


GO
/****** Object:  StoredProcedure [dbo].[insertVaga]    Script Date: 16/06/2019 23:44:07 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[insertVaga] 
 @id_contratante_vaga INT
,@qtd_vaga INT = 1
,@remuneracao_vaga NUMERIC(18,0)
,@tipo_vaga VARCHAR(20)
,@requisito_vaga TEXT = 'Requisitos'
,@descricao_vaga TEXT
,@status_vaga BIT = 1
,@cargo_vaga VARCHAR(50) = 'Cargo'
,@nm_vaga VARCHAR(50)
,@ramo_vaga VARCHAR(50)
,@localizacao VARCHAR(50)
,@tipo_local VARCHAR(50)
AS
BEGIN

	INSERT INTO [dbo].[tbl_vaga]
			   ([id_contratante_vaga]
			   ,[qtd_vaga]
			   ,[remuneracao_vaga]
			   ,[tipo_vaga]
			   ,[requisito_vaga]
			   ,[descricao_vaga]
			   ,[status_vaga]
			   ,[cargo_vaga]
			   ,[nm_vaga]
			   ,[ramo_vaga]
			   ,[localizacao]
			   ,[tipo_local])
		 VALUES
			   (@id_contratante_vaga
				,@qtd_vaga
				,@remuneracao_vaga 
				,@tipo_vaga
				,@requisito_vaga
				,@descricao_vaga
				,@status_vaga
				,@cargo_vaga
				,@nm_vaga
				,@ramo_vaga
				,@localizacao
				,@tipo_local
				)
END


GO

--TESTE
EXEC dbo.insertUsuario 'vitrine','123','','email@vitrine.com','são paulo','112354565','descricao','1',1,'06-10-2000',0,'artes','vitrine','vitrine.com',12345678,'medio','A'