DROP TABLE IF EXISTS DiveLog;
CREATE TABLE DiveLog (
	user_id INTEGER(8) NOT NULL,
	diveSite VARCHAR(100) NOT NULL,
	diveSiteNum INTEGER NOT NULL,
	logNumber INTERGER NOT NULL AUTO_INCREMENT,
	date DATE NOT NULL,
	temperature INTEGER NOT NULL,
	maxDepth INTEGER NOT NULL,
	current VARCHAR(25) NOT NULL,
	visibility VARCHAR(25) NOT NULL,
	PRIMARY KEY(diveSite, diveSiteNum, logNumber)
	FOREIGN KEY (diveSite) REFERENCES DiveSiteDetails(diveSite)
	FOREIGN KEY (diveSiteNum) REFERENCES DiveSiteDetails(diveSiteNum)
	FOREIGN KEY (user_id) REFERENCES users(user_id));
	
INSERT INTO DiveLog (diveSite, diveSiteNum, date, temperature, maxDepth, current, visibility)
VALUES("testShawn", "Ginnie Springs", 3, "2015-03-28", 72, 22, "moderate", "low");
