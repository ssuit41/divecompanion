DROP TABLE IF EXISTS DiveSite;
CREATE TABLE DiveSite (
	diveSite VARCHAR(100) NOT NULL,
	addressNumber INTEGER NOT NULL,
	zipCode INTEGER NOT NULL,
	PRIMARY KEY(diveSite)
	FOREIGN KEY (addressNumber) REFERENCES SiteLocation(addressNumber)
	FOREIGN KEY (zipCode) REFERENCES SiteLocation(zipCode));
	
INSERT INTO DiveSite VALUES ("South Florida Diving Headquarters", 1, 33062, NULL, "Tidal");
INSERT INTO DiveSite VALUES ("Paradise Spring", 1, 34480, 72, "None");
INSERT INTO DiveSite VALUES ("Ginnie Springs", 1, 32643, 72, "Varies");
INSERT INTO DiveSite VALUES ("Devil's Den", 1, 32696, 72, "None");
INSERT INTO DiveSite VALUES ("Alexander Spring", 1, 32702, 72, "Boil");
INSERT INTO DiveSite VALUES ("Blue Heron Bridge", 1, 33403, NULL, "Tidal");
INSERT INTO DiveSite VALUES ("Blue Spring", 1, 32763, 72, "Boil");