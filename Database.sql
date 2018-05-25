-- TABLE CREATION --
CREATE TABLE `ProjectPark` (
    `parkID` INT(5) NOT NULL DEFAULT -5,
    `pName` VARCHAR(20) NOT NULL DEFAULT 'Park',
    `pDescription` TEXT NULL DEFAULT NULL,
	`pAvgRating` Decimal(3,2) NOT NULL DEFAULT 0,
    PRIMARY KEY (`parkID`)
) ENGINE = InnoDB;

CREATE TABLE `ProjectCampsites` (
    `campID` INT(5) NOT NULL DEFAULT -5,
    `cName` VARCHAR(20) NULL DEFAULT 'Camp',
    `cAddress` VARCHAR(20) NULL DEFAULT NULL,
    `cDescription` TEXT NULL DEFAULT NULL,
    `parkID` INT(5) NOT NULL DEFAULT -5,
	`cAvgRating` Decimal(3,2) NOT NULL DEFAULT 0, 
    PRIMARY KEY (`campID`),
    FOREIGN KEY (`parkID`)
   	REFERENCES `ProjectPark`(`parkID`)
    	ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE = InnoDB;

CREATE TABLE `ProjectHikes&Trails` (
    `htID` INT(5) NOT NULL DEFAULT 0 ,
    `htName` VARCHAR(20) NULL DEFAULT 'Hike or Trail',
    `htDescription` TEXT NULL DEFAULT NULL,
    `htStartAddress` VARCHAR(20) NULL DEFAULT NULL,
    `htEndAddress` VARCHAR(20) NULL DEFAULT NULL,
	`tAvgRating` Decimal(3,2) NOT NULL DEFAULT 0,
    PRIMARY KEY (`htID`)
) ENGINE = InnoDB;

CREATE TABLE `ProjectUser` (
    `username` VARCHAR(20) NOT NULL DEFAULT 'User',
    `email` VARCHAR(40) NULL DEFAULT NULL,
    `password` VARCHAR(20) NULL DEFAULT NULL,
    `salt` VARCHAR(20) NULL DEFAULT NULL,
    PRIMARY KEY (`username`)
) ENGINE = InnoDB;

CREATE TABLE `ProjectParkAddress` (
    `street` VARCHAR(20) NULL DEFAULT NULL,
    `city` VARCHAR(40) NULL DEFAULT NULL,
    `zip` INT(10) NULL DEFAULT NULL,
    `state` VARCHAR(2) NULL DEFAULT NULL,
    `parkID` INT(5) NOT NULL DEFAULT -5,
    FOREIGN KEY (`parkID`)
   	REFERENCES `ProjectPark`(`parkID`)
    	ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE = InnoDB;

CREATE TABLE ProjectFacilities (
    `facilityID` INT(5) NOT NULL DEFAULT -5,
    `otherID` INT(5) NOT NULL DEFAULT -5,
	`Ftype` CHAR(1) NOT NULL DEFAULT 'A',
    PRIMARY KEY(`facilityID`)
) ENGINE=InnoDB;

CREATE TABLE `ProjectRating` (
`ratingID` INT(5) NOT NULL DEFAULT -5,
`score` INT(1) NULL DEFAULT NULL,
`rDescription` TEXT NULL DEFAULT NULL,
`username` VARCHAR(20) NOT NULL DEFAULT 'User',
`facilityID` INT(5) NOT NULL DEFAULT -5, 
FOREIGN KEY (`username`)
REFERENCES `ProjectUser`(`username`)
ON UPDATE CASCADE ON DELETE CASCADE, 
FOREIGN KEY (`facilityID`)
REFERENCES `ProjectFacilities`(`facilityID`)
ON UPDATE CASCADE ON DELETE CASCADE
)
ENGINE = InnoDB;

CREATE TABLE ProjectVisits (
`parkID` INT(5) NOT NULL DEFAULT -5,
`username` VARCHAR(20) NOT NULL DEFAULT "User",
FOREIGN KEY (`parkID`)
	REFERENCES `ProjectPark`(`parkID`)
	ON UPDATE CASCADE ON DELETE CASCADE,
FOREIGN KEY (`username`)
	REFERENCES `ProjectUser`(`username`)
	ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE ProjectIsIn (
    `htID` INT(5) NOT NULL DEFAULT -5,
    `parkID` INT(5) NOT NULL DEFAULT -5,    
     FOREIGN KEY (`parkID`)
   	 REFERENCES `ProjectPark`(`parkID`)
   	 ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE ProjectRoute (
    `instructionNum` INT(4) NOT NULL DEFAULT -5,
    `instruction` TEXT NULL DEFAULT NULL,
    `htID` INT(5) NOT NULL DEFAULT -5,
    FOREIGN KEY (`htID`)
   	 REFERENCES `ProjectHikes&Trails`(`htID`)
   	 ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE=InnoDB;
-- END TABLE CREATION --

-- START TABLE INSERTION --
-- Filling Park --
INSERT INTO ProjectPark (parkID, pName, pDescription) VALUES (12300, "Jefferson Park", "Jefferson Park features lovely views of the Valley. It features a campsite that can be reserved.");
INSERT INTO ProjectPark (parkID, pName, pDescription) VALUES (12301, "Sierra Park", "Sierra Park features a fantastic waterfall in late summer to early fall.");
INSERT INTO ProjectPark (parkID, pName, pDescription) VALUES (12302, "Grant's Plateau", "Grant's Plateau has several campsites for reservation. Many hikes end up here for great views.");
INSERT INTO ProjectPark (parkID, pName, pDescription) VALUES (12303, "Arch Park", "Arch Park is the ideal location to begin many hikes. It also features picnic tables and campsites for reservation.");
INSERT INTO ProjectPark (parkID, pName, pDescription) VALUES (12304, "Washington Park", "Washington Park is a scenic location.");

-- Filling Hikes&Trails --
INSERT INTO `ProjectHikes&Trails` (htID, htName, htDescription, htStartAddress, htEndAddress) VALUES (12310, "Three Falls Hike", "This hike features three big waterfalls that are lovely to visit in early Fall.", "David's Trailhead", "Three Falls Hike Trail End"),
(12311, "Creek Adventure", "This hike features many creeks to explore.", "Arch Park", "Arch Park"),
(12312, "Pacific Crest Trail", "A trail that traverses several states and goes North-South.", "Southern California National Park", "Northern Washington Park"),
(12313, "Scenic Views Hike", "Travel along this hike and discover gorgeous views.", "Jefferson Park", "Sierra Park"),  
(12314, "Willamette River Trail", "This trail follows along the Willamette river.", "Arch Park", "Jefferson Park");

-- Filling Campsites --
INSERT INTO `ProjectCampsites` (campID, cName, cAddress, cDescription, parkID) VALUES 
(12320, "Jefferson Campsite 1", "456 Main, Jefferson Park", "Amenities: fire pit and bathrooms", 12300),
(12321, "Sierra Campsite 1", "456 Main, Sierra Park", "Amenities: fire pit and bathrooms", 12301),
(12322, "Sierra Campsite 2", "458 Main, Sierra Park", "Amenities: fire pit and bathrooms", 12301),
(12323, "Arch Park Campsite 1", "250 Main, Arch Park", "Amenities: fire pit and bathrooms", 12303),
(12324, "Arch Park Campsite 2", "252 Main, Arch Park", "Amenities: fire pit and bathrooms", 12303);

-- Filling User --
INSERT INTO ProjectUser (username, email, password, salt) VALUES ("HikerChick1", "janesmith@gmail.com", "hike4life", DEFAULT);
INSERT INTO ProjectUser (username, email, password, salt) VALUES ("carlz", "carlyjohnson@gmail.com", "bethray57", DEFAULT);
INSERT INTO ProjectUser (username, email, password, salt) VALUES ("birdwather86", "teresag@hotmail.com", "birdsight", DEFAULT);
INSERT INTO ProjectUser (username, email, password, salt) VALUES ("garyhikes", "garylee@hotmail.com", "123leelyfe", DEFAULT);
INSERT INTO ProjectUser (username, email, password, salt) VALUES ("jessie", "jessicahall@google.com", "jessie1245", DEFAULT);

-- Filling ParkAddress --
INSERT INTO ProjectParkAddress (street, city, zip, state, parkID) VALUES ("Park Road 578", "Grant City", 97502, "OR", 12300), 
("Lake Road", "Tri Cities", 97505, "OR", 12301),
("Park Road 480", "Grant City", 97502, "OR", 12302),
("Main St", "Laketon", 97440, "OR", 12303),
("Murray Highway", "Lakewoord", 97600, "OR", 12304);

-- Fill Project Facilities --
INSERT INTO ProjectFacilities (facilityID, otherID, Ftype) VALUES
(10000, 12300, 'p'),
(10001, 12301, 'p'),
(10002, 12302, 'p'),
(10003, 12303, 'p'),
(10004, 12304, 'p'),
(10010, 12310, 't'),
(10011, 12311, 't'),
(10012, 12312, 't'),
(10013, 12313, 't'),
(10014, 12314, 't'),
(10020, 12320, 'c'),
(10021, 12321, 'c'),
(10022, 12322, 'c'),
(10023, 12323, 'c'),
(10024, 12324, 'c');

-- Fill Rating --
INSERT INTO ProjectRating (ratingID, score, rDescription, username, facilityID)
VALUES
(12340, 5, "great hike!", "HikerChick1", 10010),
(12341, 4, "fun campsite", "HikerChick1", 10023),
(12342, 4, "great bird watching", "birdwather86", 10004),
(12340, 5, "fun hike", "garyhikes", 10010),
(12344, 4, "Arch Park is a great place to start hikes because they have bathrooms and maps!", "jessie", 10003);

-- Fill Visits --
INSERT INTO ProjectVisits (parkID, username)VALUES 
(12304, "birdwather86"),
(12303, "jessie"),
(12300, "carlz"),
(12301, "HikerChick1"),
(12302, "HikerChick1");

-- Fill IsIn --
INSERT INTO ProjectIsIn (htID, parkID) VALUES 
(12310, 12303),
(12311, 12303),
(12312, 12301),
(12313, 12300),
(12314, 12303);

-- Fill Route --
INSERT INTO ProjectRoute (instructionNum, instruction, htID) VALUES 
(0001, "Three Falls Hike begins at David's Trailhead and ends at Three Falls Hike Trailhead. Follow trail 340.", 12310),
(0002, "Follow Arch Park trail 300. Signage is posted along the route.", 12311),
(0003, "Stay along the PCT. There is signage.", 12312),
(0004, "This hike spans two parks in Oregon. Stay on trail 451 between the two parks.", 12313),
(0005, "Begin at Arch Park. Take trail 251 until you reach Jefferson Park and then take Jefferson Park trail 20.", 12314);
-- END TABLE INSERTION --

