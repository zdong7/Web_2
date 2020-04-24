/* Group member: Zhekai Dong & Haowei Cao */
SELECT sectionId, email, outcomeId, major, SUM(weight) AS weightTotal
FROM Assessments NATURAL JOIN Sections NATURAL JOIN Instructors
WHERE  Assessments.weight<>100
GROUP BY Assessments.major
ORDER BY email ASC, major ASC, outcomeId ASC;

