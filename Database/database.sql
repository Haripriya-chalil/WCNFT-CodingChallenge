USE [master]
GO
/****** Object:  Database [WCNFTCodingChallengeDB]    Script Date: 7/10/2024 11:03:19 PM ******/
CREATE DATABASE [WCNFTCodingChallengeDB]
 CONTAINMENT = NONE
 ON  PRIMARY 
( NAME = N'WCNFTCodingChallengeDB', FILENAME = N'C:\Program Files\Microsoft SQL Server\MSSQL16.SQLEXPRESS\MSSQL\DATA\WCNFTCodingChallengeDB.mdf' , SIZE = 8192KB , MAXSIZE = UNLIMITED, FILEGROWTH = 65536KB )
 LOG ON 
( NAME = N'WCNFTCodingChallengeDB_log', FILENAME = N'C:\Program Files\Microsoft SQL Server\MSSQL16.SQLEXPRESS\MSSQL\DATA\WCNFTCodingChallengeDB_log.ldf' , SIZE = 8192KB , MAXSIZE = 2048GB , FILEGROWTH = 65536KB )
 WITH CATALOG_COLLATION = DATABASE_DEFAULT, LEDGER = OFF
GO
ALTER DATABASE [WCNFTCodingChallengeDB] SET COMPATIBILITY_LEVEL = 160
GO
IF (1 = FULLTEXTSERVICEPROPERTY('IsFullTextInstalled'))
begin
EXEC [WCNFTCodingChallengeDB].[dbo].[sp_fulltext_database] @action = 'enable'
end
GO
ALTER DATABASE [WCNFTCodingChallengeDB] SET ANSI_NULL_DEFAULT OFF 
GO
ALTER DATABASE [WCNFTCodingChallengeDB] SET ANSI_NULLS OFF 
GO
ALTER DATABASE [WCNFTCodingChallengeDB] SET ANSI_PADDING OFF 
GO
ALTER DATABASE [WCNFTCodingChallengeDB] SET ANSI_WARNINGS OFF 
GO
ALTER DATABASE [WCNFTCodingChallengeDB] SET ARITHABORT OFF 
GO
ALTER DATABASE [WCNFTCodingChallengeDB] SET AUTO_CLOSE OFF 
GO
ALTER DATABASE [WCNFTCodingChallengeDB] SET AUTO_SHRINK OFF 
GO
ALTER DATABASE [WCNFTCodingChallengeDB] SET AUTO_UPDATE_STATISTICS ON 
GO
ALTER DATABASE [WCNFTCodingChallengeDB] SET CURSOR_CLOSE_ON_COMMIT OFF 
GO
ALTER DATABASE [WCNFTCodingChallengeDB] SET CURSOR_DEFAULT  GLOBAL 
GO
ALTER DATABASE [WCNFTCodingChallengeDB] SET CONCAT_NULL_YIELDS_NULL OFF 
GO
ALTER DATABASE [WCNFTCodingChallengeDB] SET NUMERIC_ROUNDABORT OFF 
GO
ALTER DATABASE [WCNFTCodingChallengeDB] SET QUOTED_IDENTIFIER OFF 
GO
ALTER DATABASE [WCNFTCodingChallengeDB] SET RECURSIVE_TRIGGERS OFF 
GO
ALTER DATABASE [WCNFTCodingChallengeDB] SET  DISABLE_BROKER 
GO
ALTER DATABASE [WCNFTCodingChallengeDB] SET AUTO_UPDATE_STATISTICS_ASYNC OFF 
GO
ALTER DATABASE [WCNFTCodingChallengeDB] SET DATE_CORRELATION_OPTIMIZATION OFF 
GO
ALTER DATABASE [WCNFTCodingChallengeDB] SET TRUSTWORTHY OFF 
GO
ALTER DATABASE [WCNFTCodingChallengeDB] SET ALLOW_SNAPSHOT_ISOLATION OFF 
GO
ALTER DATABASE [WCNFTCodingChallengeDB] SET PARAMETERIZATION SIMPLE 
GO
ALTER DATABASE [WCNFTCodingChallengeDB] SET READ_COMMITTED_SNAPSHOT OFF 
GO
ALTER DATABASE [WCNFTCodingChallengeDB] SET HONOR_BROKER_PRIORITY OFF 
GO
ALTER DATABASE [WCNFTCodingChallengeDB] SET RECOVERY SIMPLE 
GO
ALTER DATABASE [WCNFTCodingChallengeDB] SET  MULTI_USER 
GO
ALTER DATABASE [WCNFTCodingChallengeDB] SET PAGE_VERIFY CHECKSUM  
GO
ALTER DATABASE [WCNFTCodingChallengeDB] SET DB_CHAINING OFF 
GO
ALTER DATABASE [WCNFTCodingChallengeDB] SET FILESTREAM( NON_TRANSACTED_ACCESS = OFF ) 
GO
ALTER DATABASE [WCNFTCodingChallengeDB] SET TARGET_RECOVERY_TIME = 60 SECONDS 
GO
ALTER DATABASE [WCNFTCodingChallengeDB] SET DELAYED_DURABILITY = DISABLED 
GO
ALTER DATABASE [WCNFTCodingChallengeDB] SET ACCELERATED_DATABASE_RECOVERY = OFF  
GO
ALTER DATABASE [WCNFTCodingChallengeDB] SET QUERY_STORE = ON
GO
ALTER DATABASE [WCNFTCodingChallengeDB] SET QUERY_STORE (OPERATION_MODE = READ_WRITE, CLEANUP_POLICY = (STALE_QUERY_THRESHOLD_DAYS = 30), DATA_FLUSH_INTERVAL_SECONDS = 900, INTERVAL_LENGTH_MINUTES = 60, MAX_STORAGE_SIZE_MB = 1000, QUERY_CAPTURE_MODE = AUTO, SIZE_BASED_CLEANUP_MODE = AUTO, MAX_PLANS_PER_QUERY = 200, WAIT_STATS_CAPTURE_MODE = ON)
GO
USE [WCNFTCodingChallengeDB]
GO
/****** Object:  Table [dbo].[patient_responses]    Script Date: 7/10/2024 11:03:19 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[patient_responses](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[patient_id] [int] NOT NULL,
	[question_id] [int] NOT NULL,
	[score] [int] NOT NULL,
PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[patients]    Script Date: 7/10/2024 11:03:20 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[patients](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[first_name] [nvarchar](100) NOT NULL,
	[surname] [nvarchar](100) NOT NULL,
	[date_of_birth] [date] NOT NULL,
	[age] [int] NOT NULL,
	[total_score] [int] NULL,
	[created_at] [datetime] NULL,
PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[questions]    Script Date: 7/10/2024 11:03:20 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[questions](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[panel] [nvarchar](50) NOT NULL,
	[question_text] [nvarchar](max) NOT NULL,
	[max_score] [int] NOT NULL,
PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[users]    Script Date: 7/10/2024 11:03:20 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[users](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[username] [nvarchar](50) NOT NULL,
	[password] [nvarchar](250) NOT NULL,
PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
ALTER TABLE [dbo].[patients] ADD  DEFAULT (getdate()) FOR [created_at]
GO
ALTER TABLE [dbo].[patient_responses]  WITH CHECK ADD FOREIGN KEY([patient_id])
REFERENCES [dbo].[patients] ([id])
GO
ALTER TABLE [dbo].[patient_responses]  WITH CHECK ADD FOREIGN KEY([patient_id])
REFERENCES [dbo].[patients] ([id])
GO
ALTER TABLE [dbo].[patient_responses]  WITH CHECK ADD FOREIGN KEY([patient_id])
REFERENCES [dbo].[patients] ([id])
GO
ALTER TABLE [dbo].[patient_responses]  WITH CHECK ADD FOREIGN KEY([patient_id])
REFERENCES [dbo].[patients] ([id])
GO
ALTER TABLE [dbo].[patient_responses]  WITH CHECK ADD FOREIGN KEY([question_id])
REFERENCES [dbo].[questions] ([id])
GO
ALTER TABLE [dbo].[patient_responses]  WITH CHECK ADD FOREIGN KEY([question_id])
REFERENCES [dbo].[questions] ([id])
GO
ALTER TABLE [dbo].[patient_responses]  WITH CHECK ADD FOREIGN KEY([question_id])
REFERENCES [dbo].[questions] ([id])
GO
ALTER TABLE [dbo].[patient_responses]  WITH CHECK ADD FOREIGN KEY([question_id])
REFERENCES [dbo].[questions] ([id])
GO
/****** Object:  StoredProcedure [dbo].[DeletePatient]    Script Date: 7/10/2024 11:03:20 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[DeletePatient]
    @patient_id INT
AS
BEGIN
    DELETE FROM patients WHERE id = @patient_id;
END;
GO
/****** Object:  StoredProcedure [dbo].[FetchAllPatients]    Script Date: 7/10/2024 11:03:20 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[FetchAllPatients]
    @firstName NVARCHAR(50) = NULL
AS
BEGIN
    IF @firstName IS NOT NULL
    BEGIN
        SELECT id, first_name, surname, FORMAT(date_of_birth, 'yyyy-MM-dd') AS formatted_date_of_birth, 
               age, total_score, FORMAT(created_at, 'yyyy-MM-dd') AS formatted_created_at
        FROM patients
        WHERE first_name LIKE '%' + @firstName + '%';
    END
    ELSE
    BEGIN
        SELECT id, first_name, surname, FORMAT(date_of_birth, 'yyyy-MM-dd') AS formatted_date_of_birth, 
               age, total_score, FORMAT(created_at, 'yyyy-MM-dd') AS formatted_created_at
        FROM patients;
    END
END;
GO
/****** Object:  StoredProcedure [dbo].[FetchAllPatientsWithPagination]    Script Date: 7/10/2024 11:03:20 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[FetchAllPatientsWithPagination]
    @FirstName NVARCHAR(100) = NULL,
    @Limit INT,
    @Offset INT
AS
BEGIN
    SET NOCOUNT ON;

    DECLARE @SQL NVARCHAR(MAX);
    SET @SQL = 'SELECT id, first_name, surname, FORMAT(date_of_birth, ''yyyy-MM-dd'') AS formatted_date_of_birth, age, total_score, FORMAT(created_at, ''yyyy-MM-dd'') AS formatted_created_at FROM patients';

    IF (@FirstName IS NOT NULL)
    BEGIN
        SET @SQL = @SQL + ' WHERE first_name LIKE @FirstName';
    END

    SET @SQL = @SQL + ' ORDER BY created_at DESC OFFSET @Offset ROWS FETCH NEXT @Limit ROWS ONLY';

    EXEC sp_executesql @SQL,
                       N'@FirstName NVARCHAR(100), @Limit INT, @Offset INT',
                       @FirstName = @FirstName,
                       @Limit = @Limit,
                       @Offset = @Offset;
END
GO
/****** Object:  StoredProcedure [dbo].[FetchAllPatientsWithPaginationAndFilters]    Script Date: 7/10/2024 11:03:20 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[FetchAllPatientsWithPaginationAndFilters]
    @FirstName NVARCHAR(100) = NULL,
    @SurName NVARCHAR(100) = NULL,
    @MinAge INT = NULL,
    @MaxAge INT = NULL,
    @Limit INT,
    @Offset INT
AS
BEGIN
    SET NOCOUNT ON;

    DECLARE @SQL NVARCHAR(MAX);
    SET @SQL = 'SELECT id, first_name, surname, FORMAT(date_of_birth, ''yyyy-MM-dd'') AS formatted_date_of_birth, age, total_score, FORMAT(created_at, ''yyyy-MM-dd'') AS formatted_created_at FROM patients';

    DECLARE @WhereClause NVARCHAR(MAX);
    SET @WhereClause = '';

    IF (@FirstName IS NOT NULL)
    BEGIN
        SET @WhereClause = @WhereClause + ' AND first_name LIKE @FirstName';
    END

    IF (@SurName IS NOT NULL)
    BEGIN
        SET @WhereClause = @WhereClause + ' AND surname LIKE @SurName';
    END

    IF (@MinAge IS NOT NULL)
    BEGIN
        SET @WhereClause = @WhereClause + ' AND age >= @MinAge';
    END

    IF (@MaxAge IS NOT NULL)
    BEGIN
        SET @WhereClause = @WhereClause + ' AND age <= @MaxAge';
    END

    -- Remove leading ' AND ' if any filters are applied
    IF (LEN(@WhereClause) > 0)
    BEGIN
        SET @WhereClause = ' WHERE ' + RIGHT(@WhereClause, LEN(@WhereClause) - 4);
    END

    SET @SQL = @SQL + @WhereClause + ' ORDER BY created_at DESC OFFSET @Offset ROWS FETCH NEXT @Limit ROWS ONLY';

    EXEC sp_executesql @SQL,
                       N'@FirstName NVARCHAR(100), @SurName NVARCHAR(100), @MinAge INT, @MaxAge INT, @Limit INT, @Offset INT',
                       @FirstName = @FirstName,
                       @SurName = @SurName,
                       @MinAge = @MinAge,
                       @MaxAge = @MaxAge,
                       @Limit = @Limit,
                       @Offset = @Offset;
END
GO
/****** Object:  StoredProcedure [dbo].[FetchPatientById]    Script Date: 7/10/2024 11:03:20 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

CREATE PROCEDURE [dbo].[FetchPatientById]
    @id INT
AS
BEGIN
    SELECT id, first_name, surname, age, FORMAT(date_of_birth, 'yyyy-MM-dd') AS formatted_date_of_birth, 
           total_score, FORMAT(created_at, 'yyyy-MM-dd') AS formatted_created_at
    FROM patients
    WHERE id = @id;
END;
GO
/****** Object:  StoredProcedure [dbo].[FetchPatientResponses]    Script Date: 7/10/2024 11:03:20 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

CREATE PROCEDURE [dbo].[FetchPatientResponses]
    @patient_id INT
AS
BEGIN
    SELECT 
        q.id AS question_id, 
        q.question_text, 
		q.max_score, 
        pr.score,
		pr.id as response_id
    FROM 
        patient_responses pr 
    JOIN 
        questions q ON pr.question_id = q.id 
    WHERE 
        pr.patient_id = @patient_id;
END;
GO
/****** Object:  StoredProcedure [dbo].[sp_CheckPatientExists]    Script Date: 7/10/2024 11:03:20 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[sp_CheckPatientExists]
    @FirstName NVARCHAR(255),
    @Surname NVARCHAR(255),
    @DateOfBirth DATE
AS
BEGIN
    SELECT id, FORMAT(created_at, 'yyyy-MM-dd') AS formatted_created_at 
    FROM patients 
    WHERE first_name = @FirstName AND surname = @Surname AND FORMAT(date_of_birth, 'yyyy-MM-dd') = @DateOfBirth
END
GO
/****** Object:  StoredProcedure [dbo].[sp_DeletePatient]    Script Date: 7/10/2024 11:03:20 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[sp_DeletePatient]
    @PatientID INT
AS
BEGIN
    -- Start a transaction
    BEGIN TRANSACTION

    BEGIN TRY
        -- Delete patient responses
        DELETE FROM patient_responses WHERE patient_id = @PatientID;

        -- Delete the patient
        DELETE FROM patients WHERE id = @PatientID;

        -- Commit the transaction
        COMMIT TRANSACTION;
    END TRY
    BEGIN CATCH
        -- Rollback the transaction if an error occurs
        ROLLBACK TRANSACTION;

        -- Return the error
        DECLARE @ErrorMessage NVARCHAR(4000) = ERROR_MESSAGE();
        DECLARE @ErrorSeverity INT = ERROR_SEVERITY();
        DECLARE @ErrorState INT = ERROR_STATE();

        RAISERROR (@ErrorMessage, @ErrorSeverity, @ErrorState);
    END CATCH
END
GO
/****** Object:  StoredProcedure [dbo].[sp_GetQuestionIDs]    Script Date: 7/10/2024 11:03:20 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[sp_GetQuestionIDs]
    @PanelName NVARCHAR(255)
AS
BEGIN
    SELECT id
    FROM questions
    WHERE panel = @PanelName;
END
GO
/****** Object:  StoredProcedure [dbo].[sp_GetQuestionsByPanel]    Script Date: 7/10/2024 11:03:20 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[sp_GetQuestionsByPanel]
    @PanelName NVARCHAR(255)
AS
BEGIN
    SELECT * 
    FROM dbo.questions 
    WHERE panel = @PanelName;
END
GO
/****** Object:  StoredProcedure [dbo].[sp_InsertPatient]    Script Date: 7/10/2024 11:03:20 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[sp_InsertPatient]
    @FirstName NVARCHAR(255),
    @Surname NVARCHAR(255),
    @DateOfBirth DATE,
    @Age INT,
    @TotalScore INT,
    @PatientID INT OUTPUT
AS
BEGIN
    INSERT INTO patients (first_name, surname, date_of_birth, age, total_score) 
    VALUES (@FirstName, @Surname, @DateOfBirth, @Age, @TotalScore);

    SET @PatientID = SCOPE_IDENTITY();
END
GO
/****** Object:  StoredProcedure [dbo].[sp_InsertPatientResponse]    Script Date: 7/10/2024 11:03:20 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[sp_InsertPatientResponse]
    @PatientID INT,
    @QuestionID INT,
    @Score INT
AS
BEGIN
    INSERT INTO patient_responses (patient_id, question_id, score) 
    VALUES (@PatientID, @QuestionID, @Score);
END
GO
/****** Object:  StoredProcedure [dbo].[sp_LoginUser]    Script Date: 7/10/2024 11:03:20 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[sp_LoginUser]
    @Email NVARCHAR(255)
AS
BEGIN
    SELECT Password FROM users WHERE username = @Email
END
GO
/****** Object:  StoredProcedure [dbo].[UpdatePatient]    Script Date: 7/10/2024 11:03:20 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[UpdatePatient]
    @patientId INT,
    @firstName NVARCHAR(50),
    @surName NVARCHAR(50),
    @dateOfBirth DATE,
    @age INT,
    @totalScore INT
AS
BEGIN
    UPDATE patients
    SET first_name = @firstName,
        surname = @surName,
        date_of_birth = @dateOfBirth,
        age = @age,
        total_score = @totalScore
    WHERE id = @patientId;
END;
GO
/****** Object:  StoredProcedure [dbo].[UpdatePatientResponse]    Script Date: 7/10/2024 11:03:20 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[UpdatePatientResponse]
    @responseId INT,
    @score INT
AS
BEGIN
    UPDATE patient_responses
    SET score = @score
    WHERE id = @responseId;
END;
GO
USE [master]
GO
ALTER DATABASE [WCNFTCodingChallengeDB] SET  READ_WRITE 
GO
