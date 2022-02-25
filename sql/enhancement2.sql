--Query 1 ** Insert some data to the clients table in the phpmotors DB
INSERT INTO clients
(clientFirstname,clientLastname,clientEmail,clientPassword,comment)
VALUES
("Tony", "Stark", "tony@starkent.com", "Iam1ronM@n", "I am the real Ironman");

--Query 2 ** Update the records added in query 1
UPDATE clients
SET clientLevel = 3
WHERE clientId = 1;

--Query 3 ** Replacing some text in the inventory tavle using the REPLACE() function
UPDATE inventory
SET invDescription = REPLACE(invDescription,'small interior','spacious interior')
WHERE invMake = "GM" AND invModel = "Hummer";

--Query 4
SELECT invModel, classificationName
FROM inventory
INNER JOIN carclassification
ON inventory.classificationId = carclassification.classificationId
WHERE classificationName = "SUV";

--Query 5 ** Delete a row from the inventory table
DELETE
FROM inventory
WHERE invMake = "Jeep" AND 	invModel = "Wrangler";

--Query 6 ** Using the CONCAT() function
UPDATE inventory
SET 
invImage = CONCAT("/phpmotors",invImage),
invThumbnail = CONCAT("/phpmotors",invThumbnail);
