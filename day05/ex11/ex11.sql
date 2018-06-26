SELECT UPPER(`last_name`) AS `NAME`, `first_name`, `price`
FROM `member`
JOIN `user_card` ON member.id_user_card = user_card.id_user
JOIN `subscription` ON member.id_sub = subscription.id_sub
WHERE `price` > 42
ORDER BY
	`last_name` ASC,
	`first_name` ASC
;
