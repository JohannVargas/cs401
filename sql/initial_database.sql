
DROP TABLE IF EXISTS collegelist;
DROP TABLE IF EXISTS states;
DROP TABLE IF EXISTS destinations;
CREATE TABLE IF NOT EXISTS collegelist(
   ID    INTEGER  NOT NULL PRIMARY KEY 
  ,name  VARCHAR(58) NOT NULL
  ,stateID VARCHAR(2) NOT NULL
  ,date  VARCHAR(22) NOT NULL,
  FOREIGN KEY (stateID) REFERENCES states(stateID)
);
CREATE TABLE IF NOT EXISTS states(
   stateID    VARCHAR(2)  NOT NULL PRIMARY KEY
  ,statename  VARCHAR(58) NOT NULL
);
CREATE TABLE IF NOT EXISTS destinations(
   destinationID    integer  NOT NULL PRIMARY KEY AUTO_INCREMENT 
  ,destinationname  VARCHAR(58) NOT NULL
  ,stateID VARCHAR(2)
  ,destination_description TEXT
  ,FOREIGN KEY (stateID) REFERENCES states(stateID)
);
INSERT INTO collegelist(ID,name,stateID,date) VALUES (1,'Abraham Baldwin Agricultural College','GA','3/18/2023 to 3/25/2023');
INSERT INTO collegelist(ID,name,stateID,date) VALUES (2,'Adams State University','CO','3/18/2023 to 3/25/2024');
INSERT INTO collegelist(ID,name,stateID,date) VALUES (3,'Adelphi University','NY','3/18/2023 to 3/25/2025');
INSERT INTO collegelist(ID,name,stateID,date) VALUES (4,'Adrian College','MI','3/18/2023 to 3/25/2026');
INSERT INTO states(stateID,statename) VALUES('GA','Georgia');
INSERT INTO states(stateID,statename) VALUES('CO','Colorado');
INSERT INTO states(stateID,statename) VALUES('NY','New York');
INSERT INTO states(stateID,statename) VALUES('MI','Michigan');
INSERT INTO destinations(destinationname,stateID,destination_description) VALUES('Atlanta','GA',
'The capital of Georgia is the perfect spring break destination if you are more inclined to cultural attractions and staying in a buzzing city. Visit the World of Coca Cola, the Georgia Aquarium, and the house of Martin Luther King Jr. Spend the afternoon laying under the sun in the Centennial Olympic Park or freshen up at the Six Flags White Water waterpark.');
INSERT INTO destinations(destinationname,stateID,destination_description) VALUES('Savannah','GA',
'This is the quintessential southern town. Stroll through the charming cobblestone streets surrounded by oak trees. Visit the antebellum mansions that can be found spread around the area. Take an old trolley to check out one of the countless art galleries on River Street. Do not miss out on spending the day having a picnic in the sun on Forsyth Park.');
INSERT INTO destinations(destinationname,stateID,destination_description) VALUES('Tybee Island','GA',
'Located just a short drive out of Savannah, Tybee Island is the perfect place to enjoy the sun. The five-mile stretch of public beach will allow you to take part in many activities such as fishing, sailing, biking, and sunbathing.');
INSERT INTO destinations(destinationname,stateID,destination_description) VALUES('Jekyll Island','GA',
'Situated just off of the coast of Georgia, in Glynn County, Jekyll Island provides you with stunning beaches, landmark historic districts, and many other attractions. The island is also well known for its wildlife which you might encounter while taking one of the many nature trails.');
INSERT INTO destinations(destinationname,stateID,destination_description) VALUES('Grand Lake','CO',
'You will love the beauty of Grand Lake, which is near the Rocky Mountain National Park. Hike, horseback ride, fish, or relax at the marina during mild weather. The scenery is fantastic, so come with your camera. The Grand Lake Nordic Center has skating facilities. If you prefer, take a snowmobile trip on the Trail. Top off your day with some music and dancing at the various bars and restaurants');
INSERT INTO destinations(destinationname,stateID,destination_description) VALUES('Breckenridge','CO',
'If you''ve ever been curious about gold and the process of getting it, Breckenridge will be a fantastic learning place for you. Tour gold mining facilities such as Lomax Gulch. Other activities include skiing and snowboarding. Unwind by going for a massage at the spa. A tour of Breckenridge distillery is also a great experience.');
INSERT INTO destinations(destinationname,stateID,destination_description) VALUES('Monte Vista','CO',
'If you have a love for animals and love to take their pictures, head over to Monte Vista. You will spot the Lords of the Dance, a crane that assembles in the fields. Attend educational workshops and take part in the Monte Vista Clinic Festival. Learn about mining at the Western Museum. You can also opt to just spend the day relaxing or dining at the various eating spots.');
INSERT INTO destinations(destinationname,stateID,destination_description) VALUES(' Colorado Springs','CO',
'The Cheyenne Mountain Zoo in Colorado Springs is an excellent place to take the kids. The ghost town Museum will also let you know what it was like during the mining era. If you want some physical activity, climb CityRock. Or why not take a ride of the world''s largest cog train? The Pikes Peak Cog Railway will help you experience the amazing sceneries during the 14,000-foot ride up Pike Peak.');
INSERT INTO destinations(destinationname,stateID,destination_description) VALUES('Brooklyn','NY',
'Brooklyn, one of the five boroughs in the City of New York, holds a bounty of spring break activities. South Brooklyn’s Marine Park neighborhood includes the Aviator Sports and Event Center, offering rock wall-climbing fun for 5-year-olds and up. On Coney Island’s boardwalk, you can enjoy hot dogs at Nathan’s, site of the 4th of July hot dog eating contest. Ride the Cyclone, the iconic wooden roller coaster, and tour the New York Aquarium. At Brooklyn’s north end, the neighborhood down under the Manhattan and Brooklyn overpasses (DUMBO) includes the Brooklyn Children’s Museum Kid Play Space. There’s also Choco-Story New York: The Chocolate Museum and Experience, with tours, live demonstrations, samplings, and a kid’s play area. Before leaving, enjoy a meal at Grimaldi’s, famous for its pizza.');
INSERT INTO destinations(destinationname,stateID,destination_description) VALUES('Cooperstown','NY',
'Baseball fans know Cooperstown as home of the National Baseball Hall of Fame and Museum, but it’s also home to the Heroes of Baseball Wax Museum, and games at Doubleday Field, which begin in mid-April. Experience American history live at Lippitt Farmstead, part of the Farmers’ Museum, and stroll through the Historic Village. Fenimore Art Museum features traditional Native American art to modern art. Foodies enjoy seeing cider made and tasting their way through dozens of products at Fly Creek Cider Mill and Orchard, and then shopping at the Mill Store Marketplace. Tour Brewery Ommegang and see how brew masters craft fine Belgian-style ales. To relax, launch out on Goodyear Lake or the Susquehanna River in a rented canoe or kayak from Portlandville Paddle Sports Store.');
INSERT INTO destinations(destinationname,stateID,destination_description) VALUES('Lake Placid','NY',
'A Winter Olympics host city in 1932 and 1980, Lake Placid is perfect for cold weather spring break activities. Visit the Lake Placid Olympic Museum, tour Olympic sites, and ride a luge or bobsled for the thrill of a lifetime. Rent snowmobiles from Farmhouse Snowmobiling or Adirondack Snowmobile for sightseeing on groomed trails. Take a dogsled ride across Mirror Lake, ice skate on the Olympic Oval, and ski or snowboard down Whiteface Mountain. Indoors, Bowlwinkles provides games like laser tag, cosmic bowling, and bounce houses. Enjoy breakfast all day at The Breakfast Club, or chow down on huge burgers at Redneck Bistro, BBQ & Grill before returning to your Lake Placid vacation rental.');
INSERT INTO destinations(destinationname,stateID,destination_description) VALUES(' Traverse City','MI',
'Your Spring Break in Michigan is incomplete without some watersports. Vacationers gather at the stunning beaches of Traverse City and swim in the sapphire blue waters. Take your family to learn about the great lakes or enjoy more than 38 000 square feet of water rides at the Great Wolf Lodge.');
INSERT INTO destinations(destinationname,stateID,destination_description) VALUES('Frankenmuth','MI',
'Also known as Little Bavaria, this city has the best German cuisine, with waiters dressed in traditional costumes. The shops at the Frankenmuth River Place offer a variety of shopping options. Historic sites are plenty, with some pieces reserved in the city museums.');
INSERT INTO destinations(destinationname,stateID,destination_description) VALUES('Grand Rapids','MI',
'In the valley of Grand River lies the city of Grand Rapids, a leading destination for a myriad of cultural and recreational opportunities. For outdoor fun, enjoy a classic carriage ride, hiking, paddling, or diving. Watch different species from around the world at the John Ball Zoo.');
INSERT INTO destinations(destinationname,stateID,destination_description) VALUES('Ann Arbor','MI',
'If you''re an art-lover looking to spend spring break in Michigan, you should visit Ann Arbor. The city prides itself on gorgeous historic buildings and the University of Michigan of course. The Ann Arbor Hands-On Museum features at least 250 exhibits. Nightlife comprises restaurants and pubs where you can unwind and appreciate the city.');