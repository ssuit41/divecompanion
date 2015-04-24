DROP TABLE IF EXISTS SiteLocation;
CREATE TABLE SiteLocation (
	zipCode INTEGER NOT NULL,
	addressNumber INTEGER NOT NULL,
	address VARCHAR(150) NOT NULL,
	PRIMARY KEY(zipCode, addressNumber));
	
INSERT INTO SiteLocation VALUES (34480, 1, "4040 SE 84th Lane Rd");
INSERT INTO SiteLocation VALUES (32643, 1, "7300 Ginnie Springs Rd");
INSERT INTO SiteLocation VALUES (32696, 1, "5390 NE 180th Ave");
INSERT INTO SiteLocation VALUES (32702, 1, "49525 County Road 445");
INSERT INTO SiteLocation VALUES (33403, 1, "900 E Blue Heron Boulevard");
INSERT INTO SiteLocation VALUES (32763, 1, "2100 W French Ave");
INSERT INTO SiteLocation VALUES (33062, 1, "2621 N Riverside Dr");