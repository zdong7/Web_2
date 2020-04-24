/* Group member: Zhekai Dong & Haowei Cao */
SELECT s.instructorId, s.sectionId, s.courseId,  c.major, s.semester, s.year FROM Sections s, Instructors i, CourseOutcomeMapping c
WHERE i.email = "coyote@utk.edu" AND i.password = PASSWORD('password') AND i.instructorId = s.instructorId AND s.courseId=c.courseId
ORDER BY year DESC, semester ASC;