-- Gym SQL --
--To do--
-- Figure out relationship with personal trainer and employee, get cert # as attrbte
---------

-- Gym Table
DROP TABLE IF EXISTS Gym;
CREATE TABLE IF NOT EXISTS Gym(
    Address varchar(50) NOT NULL,
    PRIMARY KEY (Address)
);
-- Equipment Table
DROP TABLE IF EXISTS Equipment;
CREATE TABLE IF NOT EXISTS Equipment(
    EquipmentID INT NOT NULL,
    Manufacturer varchar(50) DEFAULT NULL,
    PRIMARY KEY (EquipmentID)
);

-- Employee Table
DROP TABLE IF EXISTS Employee;
CREATE TABLE IF NOT EXISTS Employee(
    EmployeeID INT NOT NULL,
    SSN INT NOT NULL UNIQUE,
    FirstName varchar(50) DEFAULT NULL,
    LastName varchar(50) DEFAULT NULL,
    Phone varchar(20) DEFAULT NULL,
    IsTrainer BOOLEAN DEFAULT FALSE,
    CertificationID INT UNIQUE DEFAULT NULL,
    PRIMARY KEY (EmployeeID),
    KEY SSN (SSN)
);

-- How do we handle personal trianers and certification number

-- Member Table
DROP TABLE IF EXISTS Member;
CREATE TABLE IF NOT EXISTS Member(
    MemberID INT NOT NULL,
    FirstName varchar(50) DEFAULT NULL,
    LastName varchar(50) DEFAULT NULL,
    Phone varchar(50) DEFAULT NULL,
    PRIMARY KEY (MemberID)
);

-- Training Program Table
DROP TABLE IF EXISTS Program;
CREATE TABLE IF NOT EXISTS Program(
    ProgramID INT NOT NULL,
    PRIMARY KEY (ProgramID)
);

-- Exercise Table
DROP TABLE IF EXISTS Exercise;
CREATE TABLE IF NOT EXISTS Exercise(
    Name varchar(50) NOT NULL,
    PRIMARY KEY (Name)
);

-- ================ Relations ================

-- Equipment Gym Table (EquipmentLog) 
DROP TABLE IF EXISTS EquipmentLog;
CREATE TABLE IF NOT EXISTS EquipmentLog(
    Address varchar(50) NOT NULL,
    EquipmentID INT NOT NULL,
    PRIMARY KEY (Address, EquipmentID)
);

-- Gym Member Table (Membership)
DROP TABLE IF EXISTS Membership;
CREATE TABLE IF NOT EXISTS Membership(
    Address varchar(50) NOT NULL,
    MemberID INT NOT NULL,
    Tier varchar(10) DEFAULT 'Silver',
    PRIMARY KEY (Address, MemberID)
);

-- Gym Employee Table (Works)
DROP TABLE IF EXISTS Works;
CREATE TABLE IF NOT EXISTS Works(
    Address varchar(50) NOT NULL,
    EmployeeID INT NOT NULL,
    PRIMARY KEY (Address, EmployeeID)
);

-- Trainer Program Table (Creates)
DROP TABLE IF EXISTS Creates;
CREATE TABLE IF NOT EXISTS Creates(
    EmployeeID INT NOT NULL,
    CertificationID INT NOT NULL,
    ProgramID INT NOT NULL,
    PRIMARY KEY (EmployeeID, ProgramID)
);

-- Program Exercise Table (WorkoutPlan)
-- Exercise name and ID tell you weight, reps, and sets that specific person does
DROP TABLE IF EXISTS WorkoutPlan;
CREATE TABLE IF NOT EXISTS WorkoutPlan(
    ProgramID INT NOT NULL,
    ExerciseName varchar(50) NOT NULL,
    NumberSets INT DEFAULT 3,
    Weight INT DEFAULT 0,
    NumberReps INT DEFAULT 5,
    PRIMARY KEY (ProgramID, ExerciseName)
);

-- Trainer Member Table (Trains)
DROP TABLE IF EXISTS Trains;
CREATE TABLE IF NOT EXISTS Trains(
    MemberID INT NOT NULL,
    EmployeeID INT NOT NULL,
    Fee DECIMAL(10,2) DEFAULT NULL,
    PRIMARY KEY (MemberID, EmployeeID)
);

--Member Program Table (Tracks)
DROP TABLE IF EXISTS Tracks;
CREATE TABLE IF NOT EXISTS Tracks(
    MemberID INT NOT NULL,
    ProgramID INT NOT NULL,
    PRIMARY KEY (MemberID, ProgramID)
);

