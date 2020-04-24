/* Group member: Zhekai Dong & Haowei Cao */
CREATE TABLE Instructors (
		instructorId int(11) NOT NULL primary key,
		firstname varchar(100) NOT NULL,
		lastname varchar(100) NOT NULL,
		email varchar(255) NOT NULL,
		password varchar(255) NOT NULL
);
        

CREATE TABLE Outcomes(
  outcomeId INT(11) NOT NULL,
  outcomeDescription VARCHAR(1150)  NOT NULL,
  major ENUM('CS', 'CpE', 'EE') NOT NULL,
  PRIMARY KEY(outcomeId, major)
);



CREATE TABLE Courses(
  courseId CHARACTER(11) PRIMARY KEY,
  courseTitle VARCHAR(255) NOT NULL
);


CREATE TABLE PerformanceLevels(
  performanceLevel ENUM('1', '2', '3') PRIMARY KEY,
  description ENUM('Not Meets Expectations', 'Meets Expectations', 'Exceeds Expectations') NOT NULL
);


CREATE TABLE Sections(
  sectionId INT(11) primary key, 
  courseId CHARACTER(11), 
  instructorId INT(11) NOT NULL, 
  semester CHARACTER(11) NOT NULL, 
  year YEAR(4) NOT NULL,
  FOREIGN KEY (instructorId) REFERENCES Instructors (instructorId) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (courseId) REFERENCES Courses(courseId) ON DELETE CASCADE ON UPDATE CASCADE
);


CREATE TABLE CourseOutcomeMapping(
  courseId CHARACTER(11) NOT NULL, 
  outcomeId INT(11) NOT NULL, 
  major ENUM('CS', 'CpE', 'EE') NOT NULL, 
  semester CHARACTER(11) NOT NULL, 
  year YEAR(4) NOT NULL,
  FOREIGN KEY(courseId) REFERENCES Courses(courseId) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY(outcomeId) REFERENCES Outcomes(outcomeId) ON DELETE CASCADE
);


CREATE TABLE Narratives (
		sectionId int(11) NOT NULL,
		major varchar(255) NOT NULL,
		outcomeId int(11) NOT NULL,
		strengths varchar(1150) NOT NULL,
		weaknesses varchar(1150) NOT NULL,
        actions varchar(1150) NOT NULL,
        FOREIGN KEY (sectionId) REFERENCES Sections (sectionId),
        FOREIGN KEY (outcomeId) REFERENCES Outcomes (outcomeId)
);


CREATE TABLE OutcomeResults (
		sectionId int(11) NOT NULL,
		outcomeId int(11) NOT NULL,
		major enum('CS', 'CpE', 'EE') NOT NULL,
		performanceLevel ENUM('1', '2', '3') NOT NULL,
		numberOfStudents int(11) NOT NULL,
        FOREIGN KEY (sectionId) REFERENCES Sections (sectionId),
        FOREIGN KEY (performanceLevel) REFERENCES PerformanceLevels (performanceLevel)
);


CREATE TABLE Assessments (
		assessmentId int(11) auto_increment primary key,
		sectionId int(11) NOT NULL,
		assessmentDescription varchar(1150) NOT NULL,
		weight varchar(255) NOT NULL,
		outcomeId int(11) NOT NULL,
		major enum('CS', 'CpE', 'EE') NOT NULL,
        FOREIGN KEY (sectionId) REFERENCES Sections (sectionId),
        FOREIGN KEY (outcomeId) REFERENCES Outcomes (outcomeId)
);
