---------------------------------------------
---------- Drop all tables ------------------
---------------------------------------------
DROP TABLE IF EXISTS CourseOutcomeMapping;
DROP TABLE IF EXISTS PerformanceLevels;
DROP TABLE IF EXISTS Narratives;
DROP TABLE IF EXISTS Assessments;
DROP TABLE IF EXISTS OutcomeResults;
DROP TABLE IF EXISTS Outcomes;
DROP TABLE IF EXISTS Sections;
DROP TABLE IF EXISTS Courses;
DROP TABLE IF EXISTS Instructors;

---------------------------------------------
---------- Create all tables ----------------
---------------------------------------------

CREATE TABLE Instructors(
	instructorId INT(4) PRIMARY KEY,
	firstname VARCHAR(100) NOT NULL,
	lastname VARCHAR(100) NOT NULL,
	email VARCHAR(100) NOT NULL,
	password VARCHAR(255) NOT NULL
);

CREATE TABLE Courses(
	courseId VARCHAR(10) PRIMARY KEY,
	courseTitle VARCHAR(100)
);

CREATE TABLE Sections(
	sectionId INT(4) AUTO_INCREMENT PRIMARY KEY,
	courseId VARCHAR(10),
	instructorId INT(4),
	semester ENUM ('fall', 'spring', 'summer'),
	year INT(4) NOT NULL,
	FOREIGN KEY (courseId)
		REFERENCES Courses(courseId)
		ON UPDATE CASCADE
		ON DELETE CASCADE,
	FOREIGN KEY (instructorId)
		REFERENCES Instructors(instructorId)
		ON UPDATE CASCADE
		ON DELETE CASCADE
);

CREATE TABLE Outcomes(
	outcomeId INT(4),
	outcomeDescription VARCHAR(255),
	major ENUM ('CS', 'CpE', 'EE'),
	PRIMARY KEY (outcomeId, major)
);

CREATE TABLE OutcomeResults(
	sectionId INT(4),
	outcomeId INT(4),
	major ENUM ('CS', 'CpE', 'EE'),
	performanceLevel ENUM ('1', '2', '3'),
	numberOfStudents INT(4),
	PRIMARY KEY (sectionId, outcomeId, major, performanceLevel),
	FOREIGN KEY (sectionId)
		REFERENCES Sections(sectionId)
		ON UPDATE CASCADE
		ON DELETE CASCADE,
	FOREIGN KEY (outcomeId)
		REFERENCES Outcomes(outcomeId)
		ON UPDATE CASCADE
		ON DELETE CASCADE
);

CREATE TABLE Assessments(
	assessmentId INT AUTO_INCREMENT PRIMARY KEY,
	sectionId INT(4),
	assessmentDescription VARCHAR(255),
	weight INT(4) NOT NULL,
	outcomeId INT(4),
	major ENUM ('CS', 'CpE', 'EE'),
	FOREIGN KEY (sectionId)
		REFERENCES Sections(sectionId)
		ON UPDATE CASCADE
		ON DELETE CASCADE,
	FOREIGN KEY (outcomeId)
		REFERENCES Outcomes(outcomeId)
		ON UPDATE CASCADE
		ON DELETE CASCADE
);

CREATE TABLE Narratives(
	sectionId INT(4),
	major ENUM ('CS', 'CpE', 'EE'),
	outcomeId INT(4),
	strengths VARCHAR(255),
	weaknesses VARCHAR(255),
	actions VARCHAR(255),
	PRIMARY KEY (sectionId, major, outcomeId),
	FOREIGN KEY (sectionId)
		REFERENCES Sections(sectionId)
		ON UPDATE CASCADE
		ON DELETE CASCADE,
	FOREIGN KEY (outcomeId)
		REFERENCES Outcomes(outcomeId)
		ON UPDATE CASCADE
		ON DELETE CASCADE
);

CREATE TABLE PerformanceLevels(
	performanceLevel ENUM ('1', '2', '3') PRIMARY KEY,
	description ENUM ('Not Meets Expectations', 'Meets Expectations', 'Exceeds Expectations')
);

CREATE TABLE CourseOutcomeMapping(
	courseId VARCHAR(10),
	outcomeId INT(4),
	major ENUM ('CS', 'CpE', 'EE'),
	semester VARCHAR(40),
	year INT(4),
	FOREIGN KEY (courseId)
		REFERENCES Courses(courseId)
		ON UPDATE CASCADE
		ON DELETE CASCADE,
	FOREIGN KEY (outcomeId)
		REFERENCES Outcomes(outcomeId)
		ON UPDATE CASCADE
		ON DELETE CASCADE
);


---------------------------------------------
------------- End of file -------------------
---------------------------------------------
