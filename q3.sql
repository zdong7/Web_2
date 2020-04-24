/* Group member: Zhekai Dong & Haowei Cao */
SELECT p.description,o.numberOfStudents 
FROM OutcomeResults o
NATURAL JOIN Outcomes
NATURAL JOIN PerformanceLevels p
WHERE major = 'CS'
AND sectionId = 3
AND outcomeId = 2
ORDER BY o.performanceLevel;