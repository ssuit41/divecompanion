CREATE TABLE IF NOT EXISTS zipcode (
	zipCode INTEGER NOT NULL,
	city VARCHAR(40) NULL,
	state VARCHAR(2) NULL,
	latitude FLOAT NOT NULL,
	longitude FLOAT NOT NULL,
	PRIMARY KEY(zipCode));
	
CREATE TABLE IF NOT EXISTS sitelocation (
	zipCode INTEGER NOT NULL,
	addressNumber INTEGER NOT NULL AUTO_INCREMENT,
	address VARCHAR(150) NOT NULL,
	PRIMARY KEY(addressNumber));
	
	CREATE TABLE IF NOT EXISTS divesite (
	diveSiteNum INTEGER NOT NULL AUTO_INCREMENT,
	diveSite VARCHAR(100) NOT NULL,
	addressNumber INTEGER NOT NULL,
	zipCode INTEGER NOT NULL,
	PRIMARY KEY(diveSiteNum),
	KEY (diveSite),
	KEY (addressNumber),
	KEY (zipCode));
	
	CREATE TABLE IF NOT EXISTS divesitedetails (
	diveSiteNum INTEGER NOT NULL,
	subSiteNum INTEGER NOT NULL AUTO_INCREMENT,
	subSiteName VARCHAR(100),
	siteInstruction VARCHAR(25) NULL,
	siteDetails VARCHAR(250) NULL,
	PRIMARY KEY(subSiteNum),
	KEY (diveSiteNum));
	
	CREATE TABLE IF NOT EXISTS divelog (
	user_id INTEGER(8) NOT NULL,
	subSiteNum INTEGER NOT NULL,
	logNumber INTEGER NOT NULL AUTO_INCREMENT,
	date DATE NOT NULL,
	temperature INTEGER NOT NULL,
	maxDepth INTEGER NOT NULL,
	current VARCHAR(25) NOT NULL,
	visibility VARCHAR(25) NOT NULL,
	PRIMARY KEY(logNumber),
	KEY (subSiteNum),
	KEY (user_id));
	