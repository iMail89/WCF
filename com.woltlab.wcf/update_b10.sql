/* 064caa4 */
DELETE FROM wcf1_user_storage;

ALTER TABLE wcf1_user_storage CHANGE fieldValue fieldValue MEDIUMTEXT;

/* ec09840 */
DROP TABLE IF EXISTS wcf1_cli_history;
CREATE TABLE wcf1_cli_history (
	historyItem INT(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
	userID INT(10) NOT NULL,
	command VARCHAR(255) NOT NULL,
	KEY (userID)
);