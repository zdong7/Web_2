/* Group member: Zhekai Dong & Haowei Cao */
SELECT DISTINCT outcomeId, outcomeDescription FROM Outcomes
NATURAL JOIN OutcomeResults
WHERE major='CS'
AND sectionId = 3
ORDER BY outcomeId;
