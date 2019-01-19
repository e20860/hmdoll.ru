SELECT `id`,`num`,
(SELECT name from items WHERE items.id = orders.id) AS itemname, 
(SELECT name from types WHERE types.id =(SELECT type from items WHERE items.id = orders.id)) AS itemtype,
DATE(time) AS ddt, 
TIME(time) AS ttd 
FROM `orders` 
WHERE id = 1 