SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

INSERT INTO `categories` (`cat_id`, `cat_name`, `cat_description`) VALUES
(1, 'Dive News', 'Dive News'),
(3, 'Second Cat', 'This is the second cat');

INSERT INTO `divelog` (`user_id`, `subSiteNum`, `logNumber`, `date`, `temperature`, `maxDepth`, `current`, `visibility`) VALUES
(1, 1, 3, '2015-03-28', 72, 22, 'moderate', 'low');

INSERT INTO `divesite` (`diveSiteNum`, `diveSite`, `addressNumber`, `zipCode`) VALUES
(1, 'Paradise Spring', 1, 34480);

INSERT INTO `divesitedetails` (`diveSiteNum`, `subSiteNum`, `subSiteName`, `siteInstruction`, `siteDetails`) VALUES
(1, 1, 'Sink Hole Dive', NULL, 'Natural Sink hole with wide open spaces. Basic cavern environment');

INSERT INTO `posts` (`post_id`, `post_content`, `post_date`, `post_topic`, `post_by`) VALUES
(1, 'A Discussion', '2015-04-08 20:54:13', 2, 1),
(2, 'This is a discussion', '2015-04-08 21:44:36', 3, 1),
(3, 'The very first reply!', '2015-04-20 22:45:00', 2, 1),
(4, 'This is the content of the second post.', '2015-04-20 23:02:30', 4, 1),
(5, 'A new reply', '2015-04-21 13:19:17', 3, 1),
(6, 'The third reply', '2015-04-22 00:25:18', 3, 1),
(7, 'A new example post.', '2015-04-22 00:25:47', 5, 1);

INSERT INTO `sitelocation` (`zipCode`, `addressNumber`, `address`) VALUES
(34480, 1, '4040 SE 84th Lane Rd');

INSERT INTO `topics` (`topic_id`, `topic_subject`, `topic_date`, `topic_cat`, `topic_by`) VALUES
(2, 'First Post', '2015-04-08 20:54:13', 1, 1),
(3, 'First Post', '2015-04-22 00:25:18', 3, 1),
(4, 'Second Post', '2015-04-20 23:02:30', 1, 1),
(5, 'Discussing the Website', '2015-04-22 00:25:47', 3, 1);

INSERT INTO `users` (`user_id`, `user_name`, `user_pass`, `user_email`, `user_date`, `user_level`, `fname`, `lname`, `phno`) VALUES
(1, 'testShawn', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 'ssuit41@gmail.com', '2015-04-08 16:28:32', 0, 'Shawn', 'Suit', '18881231234');

INSERT INTO `zipcode` (`zipCode`, `city`, `state`, `latitude`, `longitude`) VALUES
(32626, 'Chiefland', 'Fl', 29.4904, 82.9771),
(34480, 'Ocala', 'FL', 29.12, 82.09);

