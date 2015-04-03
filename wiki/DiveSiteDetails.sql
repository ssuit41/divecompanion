DROP TABLE IF EXISTS DiveSiteDetails;
CREATE TABLE DiveSiteDetails (
	diveSite VARCHAR(100) NOT NULL,
	diveSiteNum INTEGER NOT NULL AUTO_INCREMENT,
	subSiteName VARCHAR(100),
	siteInstruction VARCHAR(25) NULL,
	siteDetails VARCHAR(250) NULL,
	PRIMARY KEY(diveSite, diveSiteNum)
	FOREIGN KEY (diveSite) REFERENCES DiveSite(diveSite));
	
INSERT INTO DiveSiteDetails (diveSite, subSiteName, siteDetails) VALUES ("Ginnie Springs", "Snorkelling", "All areas are available to snorkellers");
INSERT INTO DiveSiteDetails (diveSite, subSiteName, siteDetails) VALUES ("Ginnie Springs", "Ball Room", "The Ball Room and surrounding waters");
INSERT INTO DiveSiteDetails (diveSite, subSiteName, siteDetails) VALUES ("Ginnie Springs", "River Drift Dive", "Drift dive, careful that you don't miss the exit");
INSERT INTO DiveSiteDetails (diveSite, subSiteName, siteDetails) VALUES ("Ginnie Springs", "Devil's Ear", "Cave diving");
INSERT INTO DiveSiteDetails (diveSite, subSiteName, siteDetails) VALUES ("Ginnie Springs", "Devil's Eye", "Cave diving");
INSERT INTO DiveSiteDetails (diveSite, subSiteName, siteDetails) VALUES ("Ginnie Springs", "Little Devil", "Cave diving");
INSERT INTO DiveSiteDetails (diveSite, subSiteName, siteDetails) VALUES ("Paradise Spring", "Sink Hole Dive", "Natural Sink hole with wide open spaces. Basic cavern environment");
INSERT INTO DiveSiteDetails (diveSite, subSiteName, siteDetails) VALUES ("Paradise Spring", "Sink Hole Dive", "Some swim throughs should not be attempted with additional experience");
INSERT INTO DiveSiteDetails (diveSite, subSiteName, siteDetails) VALUES ("Paradise Spring", "Sink Hole Dive", "Travel past the cave diving sign to explore a cave system");
INSERT INTO DiveSiteDetails (diveSite, subSiteName, siteDetails) VALUES ("Devil's Den", "Sink Hole Dive Resort", "Circular area to explore. Try searching for statues.");
INSERT INTO DiveSiteDetails (diveSite, subSiteName, siteDetails) VALUES ("Devil's Den", "Sink Hole Dive Resort", "Careful approaching some swim throughs");
INSERT INTO DiveSiteDetails (diveSite, subSiteName, siteDetails) VALUES ("Blue Spring", "Spring Head Dive", "Great for testing equipment and refreshers");
INSERT INTO DiveSiteDetails (diveSite, subSiteName, siteDetails) VALUES ("Blue Spring", "Popcorn Machine", "Cave divers can go down into the boil");
INSERT INTO DiveSiteDetails (diveSite, subSiteName, siteDetails) VALUES ("Alexander Spring", "Spring Dive", "Great training location");
INSERT INTO DiveSiteDetails (diveSite, subSiteName, siteDetails) VALUES ("South Florida Diving Headquarters","Reef Dive", "Multiple locations, boat dives");
INSERT INTO DiveSiteDetails (diveSite, subSiteName, siteDetails) VALUES ("South Florida Diving Headquarters", "Drift Dive", "Drift along the reef with the boat");
INSERT INTO DiveSiteDetails (diveSite, subSiteName, siteDetails) VALUES ("South Florida Diving Headquarters", "Deep Dive", "Beyond 120 ft to a wreck");
INSERT INTO DiveSiteDetails (diveSite, subSiteName, siteDetails) VALUES ("Blue Heron Bridge", "Reef track", "Dive along a artificial reef track, lots of sea life");
INSERT INTO DiveSiteDetails (diveSite, subSiteName, siteDetails) VALUES ("Blue Heron Bridge", "Bridge", "Dive underneath the bridge for smaller life, careful of tides");