select COUNT(*) AS 'movies'
FROM `member_history`
WHERE
	((DATE(`date`) < DATE('2007-07-27')) AND
	(DATE(`date`) > DATE('2006-10-30'))) OR
	(DATE_FORMAT(`date`, '%m-%d') = DATE_FORMAT('2000-12-24', '%m-%d'))
;
