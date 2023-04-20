-- Gym SQL --
--To do--

---------

-- ========== Gym Table ==========

DROP TABLE IF EXISTS Gym;
CREATE TABLE IF NOT EXISTS Gym(
    Address varchar(50) NOT NULL,
    PRIMARY KEY (Address)
);
-- Gym Data
INSERT INTO Gym (Address) VALUES
('123 Main St'),
('456 Park Ave'),
('789 Broadway');


-- ========== Equipment Table ==========
DROP TABLE IF EXISTS Equipment;
CREATE TABLE IF NOT EXISTS Equipment(
    EquipmentID INT NOT NULL,
    Manufacturer varchar(50) DEFAULT NULL,
    PRIMARY KEY (EquipmentID)
);
-- Equipment Data
INSERT INTO Equipment (EquipmentID, Manufacturer) VALUES
(1, 'Life Fitness'),
(2, 'Precor'),
(3, 'Cybex');

-- ========== Employee Table ==========
DROP TABLE IF EXISTS Employee;
CREATE TABLE IF NOT EXISTS Employee(
    EmployeeID INT NOT NULL,
    SSN INT NOT NULL UNIQUE,
    Password varchar(20) NOT NULL,
    FirstName varchar(50) DEFAULT NULL,
    LastName varchar(50) DEFAULT NULL,
    Phone varchar(20) DEFAULT NULL,
    IsTrainer BOOLEAN DEFAULT FALSE,
    CertificationID INT UNIQUE DEFAULT NULL,
    PRIMARY KEY (EmployeeID),
    KEY SSN (SSN)
);
-- Employee Data
INSERT INTO Employee (EmployeeID, SSN, Password, FirstName, LastName, Phone, IsTrainer, CertificationID) VALUES
(1, 123456789, 'Password', 'John', 'Doe', '555-1234', TRUE, 1),
(2, 987654321, 'Letmein', 'Jane', 'Smith', '555-5678', FALSE, NULL),
(3, 111222333, '1234', 'Bob', 'Johnson', '555-9999', TRUE, 2);

-- ========== Member Table ==========
DROP TABLE IF EXISTS Member;
CREATE TABLE IF NOT EXISTS Member(
    MemberID INT NOT NULL,
    FirstName varchar(50) DEFAULT NULL,
    LastName varchar(50) DEFAULT NULL,
    Phone varchar(50) DEFAULT NULL,
    PRIMARY KEY (MemberID)
);
-- Member Data
INSERT INTO Member (MemberID, FirstName, LastName, Phone) VALUES
(1, 'Alice', 'Jones', '555-1111'),
(2, 'Tom', 'Smith', '555-2222'),
(3, 'Sara', 'Lee', '555-3333');

-- ========== Training Program Table ==========
DROP TABLE IF EXISTS Program;
CREATE TABLE IF NOT EXISTS Program(
    ProgramID INT NOT NULL,
    PRIMARY KEY (ProgramID)
);
-- Program Data
INSERT INTO Program (ProgramID) VALUES
(1),
(2),
(3);

-- ========== Exercise Table ==========
DROP TABLE IF EXISTS Exercise;
CREATE TABLE IF NOT EXISTS Exercise(
    Name varchar(50) NOT NULL,
    PRIMARY KEY (Name)
);
-- Exercise Data
INSERT INTO Exercise (Name) VALUES
('Bench Press'),
('Squat'),
('Deadlift');

-- -
-- ================ Relations ================
-- -

-- ========== Equipment Gym Table (EquipmentLog) ==========
DROP TABLE IF EXISTS EquipmentLog;
CREATE TABLE IF NOT EXISTS EquipmentLog(
    Address varchar(50) NOT NULL,
    EquipmentID INT NOT NULL,
    PRIMARY KEY (Address, EquipmentID)
);
-- EquipmentLog Data
INSERT INTO EquipmentLog (Address, EquipmentID) VALUES
('123 Main St', 1),
('123 Main St', 2),
('456 Park Ave', 3),
('789 Broadway', 1),
('789 Broadway', 3);

-- ========== Gym Member Table (Membership) ==========
DROP TABLE IF EXISTS Membership;
CREATE TABLE IF NOT EXISTS Membership(
    Address varchar(50) NOT NULL,
    MemberID INT NOT NULL,
    Tier varchar(10) DEFAULT 'Silver',
    PRIMARY KEY (Address, MemberID)
);
-- Membership Data
INSERT INTO Membership (Address, MemberID, Tier) VALUES
('123 Main St', 1, 'Gold'),
('123 Main St', 2, 'Silver'),
('456 Park Ave', 3, 'Gold');

-- ========== Gym Employee Table (Works) ==========
DROP TABLE IF EXISTS Works;
CREATE TABLE IF NOT EXISTS Works(
    Address varchar(50) NOT NULL,
    EmployeeID INT NOT NULL,
    PRIMARY KEY (Address, EmployeeID)
);
-- Works Data
INSERT INTO Works (Address, EmployeeID) VALUES
('123 Main St', 1),
('456 Park Ave', 2),
('789 Broadway', 3);

-- ========== Trainer Program Table (Creates) ==========
DROP TABLE IF EXISTS Creates;
CREATE TABLE IF NOT EXISTS Creates(
    EmployeeID INT NOT NULL,
    CertificationID INT NOT NULL,
    ProgramID INT NOT NULL,
    PRIMARY KEY (EmployeeID, ProgramID)
);
-- Creates Data
INSERT INTO Creates (EmployeeID, CertificationID, ProgramID) VALUES
(1, 1, 1),
(1, 1, 2),
(3, 2, 3);

-- ========== Program Exercise Table (WorkoutPlan) ==========
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
-- WorkoutPlan Data
INSERT INTO WorkoutPlan (ProgramID, ExerciseName, NumberSets, Weight, NumberReps) VALUES
(1, 'Bench Press', 3, 135, 5),
(1, 'Squat', 3, 225, 5),
(1, 'Deadlift', 3, 315, 5),
(2, 'Bench Press', 5, 155, 3),
(2, 'Squat', 5, 275, 5),
(2, 'Deadlift', 5, 365, 3),
(3, 'Bench Press', 3, 185, 8),
(3, 'Squat', 3, 315, 8),
(3, 'Deadlift', 3, 405, 8);

-- ========== Trainer Member Table (Trains) ==========
DROP TABLE IF EXISTS Trains;
CREATE TABLE IF NOT EXISTS Trains(
    MemberID INT NOT NULL,
    EmployeeID INT NOT NULL,
    Fee DECIMAL(10,2) DEFAULT NULL,
    PRIMARY KEY (MemberID, EmployeeID)
);
-- Trains Data
INSERT INTO Trains (MemberID, EmployeeID, Fee) VALUES
(1, 1, 100.00),
(2, 3, 75.00),
(3, 1, 125.00);

-- ========== Member Program Table (Tracks) ==========
DROP TABLE IF EXISTS Tracks;
CREATE TABLE IF NOT EXISTS Tracks(
    MemberID INT NOT NULL,
    ProgramID INT NOT NULL,
    PRIMARY KEY (MemberID, ProgramID)
);
-- Tracks Data
INSERT INTO Tracks (MemberID, ProgramID)
VALUES
  (1, 1),
  (2, 2),
  (3, 3);







