-- phpMyAdmin SQL Dump
-- version 4.0.7
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 15, 2016 at 04:56 PM
-- Server version: 5.5.47
-- PHP Version: 5.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `cl59-gcu`
--

-- --------------------------------------------------------

--
-- Table structure for table `forms`
--

CREATE TABLE IF NOT EXISTS `forms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `form` longtext NOT NULL,
  `form_name` varchar(365) NOT NULL,
  `user_name` varchar(365) NOT NULL,
  `Archive` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=270 ;

--
-- Dumping data for table `forms`
--

INSERT INTO `forms` (`id`, `form`, `form_name`, `user_name`, `Archive`) VALUES
(223, '[{"type":"text2","label":"Report Raiser","req":1},{"type":"text4","label":"Submission Date","req":1},{"type":"text3","label":"Report Owner","req":1},{"type":"textarea","label":"Details","req":0},{"type":"text","label":"QUESTION:?","req":0},{"type":"text","label":"LOL","req":0}]', 'FSAD', 'amr', 0),
(225, '[{"type":"text2","label":"Report Raiser","req":1},{"type":"text4","label":"Submission Date","req":1},{"type":"text3","label":"Report Owner","req":1},{"type":"textarea","label":"Details","req":0},{"type":"text","label":"Details","req":0}]', 'test66', 'eddie', 1),
(228, '[{"type":"text2","label":"Report Raiser","req":1},{"type":"text4","label":"Submission Date","req":1},{"type":"text3","label":"Report Owner","req":1},{"type":"textarea","label":"Details","req":0},{"type":"text","label":"This is an example","req":0},{"type":"select","label":"Should we win","req":0,"choices":[{"label":"Yes","sel":0},{"label":"Yes","sel":0}]}]', 'Lorem Ipsum Report', 'manager', 0),
(230, '[{"type":"text2","label":"Report Raiser","req":1},{"type":"text4","label":"Submission Date","req":1},{"type":"text3","label":"Report Owner","req":1},{"type":"textarea","label":"Details","req":0},{"type":"date","label":"When did this happen","req":1},{"type":"textarea","label":"More details","req":1}]', 'Anderson Report', 'manager', 0),
(263, '[{"type":"text2","label":"Report Raiser","req":1},{"type":"text4","label":"Submission Date","req":1},{"type":"text3","label":"Report Owner","req":1},{"type":"textarea","label":"Details","req":0},{"type":"text","label":"","req":0}]', 'gcu', 'amr', 0),
(264, '[{"type":"text2","label":"Report Raiser","req":1},{"type":"text4","label":"Submission Date","req":1},{"type":"text3","label":"Report Owner","req":1},{"type":"textarea","label":"Details","req":0},{"type":"date","label":"When did this happen","req":1},{"type":"text","label":"Example","req":0}]', 'Ideagen report', 'manager', 0),
(266, '[{"type":"text2","label":"Report Raiser","req":1},{"type":"text4","label":"Submission Date","req":1},{"type":"text3","label":"Report Owner","req":1},{"type":"textarea","label":"Details","req":0},{"type":"select","label":"Pick a number","req":0,"choices":[{"label":"1","sel":0},{"label":"2","sel":0},{"label":"3","sel":0}]}]', 'testing', 'Eddie', 0),
(267, '[{"type":"text2","label":"Report Raiser","req":0},{"type":"text4","label":"Submission Date","req":0},{"type":"text3","label":"Report Owner","req":0},{"type":"textarea","label":"Details","req":0},{"type":"text","label":"example","req":1},{"type":"date","label":"when did this happen","req":0},{"type":"select","label":"dropdown","req":0,"choices":[{"label":"1","sel":0},{"label":"2","sel":0}]},{"type":"radio","label":"this is a radio","req":1,"choices":[{"label":"1","sel":1},{"label":"2","sel":0}]},{"type":"text","label":"test","req":0}]', 'test1', 'manager', 0),
(268, '[{"type":"text2","label":"Report Raiser","req":1},{"type":"text4","label":"Submission Date","req":1},{"type":"text3","label":"Report Owner","req":1},{"type":"textarea","label":"Details","req":0},{"type":"text","label":"Destination","req":0},{"type":"text","label":"Departure","req":0},{"type":"textarea","label":"Incident Details","req":0}]', 'Air Safety Report', 'ideagen', 0),
(269, '[{"type":"text2","label":"Report Raiser","req":1},{"type":"text4","label":"Submission Date","req":1},{"type":"text3","label":"Report Owner","req":1},{"type":"textarea","label":"Details","req":0}]', '1', 'Ideagen', 0);

-- --------------------------------------------------------

--
-- Table structure for table `FormSubmission`
--

CREATE TABLE IF NOT EXISTS `FormSubmission` (
  `form_id` int(11) NOT NULL AUTO_INCREMENT,
  `submission` longtext NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_name` varchar(365) NOT NULL,
  `formt_id` varchar(365) NOT NULL,
  `status` varchar(365) NOT NULL,
  `submit_date` date NOT NULL,
  `Severity` int(10) NOT NULL,
  PRIMARY KEY (`form_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=178 ;

--
-- Dumping data for table `FormSubmission`
--

INSERT INTO `FormSubmission` (`form_id`, `submission`, `date`, `user_name`, `formt_id`, `status`, `submit_date`, `Severity`) VALUES
(151, '{"Report_Raiser":"eddie","date":"2016-04-11","Report_Owner":"Eddie","Details":"I ","QUESTION:?":"I ","LOL":"I "}', '2016-04-11 12:22:26', 'eddie', '223', 'Draft', '0000-00-00', 1),
(153, '{"Report_Raiser":"eddie","date":"2016-04-12","Report_Owner":"Edward","Details":""}', '2016-04-12 08:55:28', 'eddie', '225', 'Closed', '2016-04-14', 5),
(158, '{"Report_Raiser":"Reporter","date":"2016-04-12","Report_Owner":"Lorem Ipsum","Details":"Nullam pretium eros ut nisi dictum, a bibendum ex rutrum. Cras nec mauris velit. Vivamus nec dolor id augue posuere mattis in ac urna. Phasellus bibendum metus arcu, et consequat mi suscipit in. Suspendisse volutpat nec libero tempor mattis. Ut elementum lorem id mi lacinia molestie. ","This_is_an_example":"Yes it is.","Should_we_win":"Yes"}', '2016-04-12 22:08:26', 'Reporter', '228', 'Closed', '2016-04-12', 3),
(160, '{"Report_Raiser":"Reporter","date":"2016-04-12","Report_Owner":"Dave","Details":"Maecenas a purus quis tellus pellentesque tempus. Ut venenatis hendrerit odio ultricies lobortis. Mauris pellentesque, dolor nec convallis mattis, odio eros dictum ex, tempus vulputate tellus dui quis nulla. Maecenas lectus nunc, imperdiet vitae auctor convallis, pharetra a erat. Nunc varius fringilla nulla ac semper. Aliquam erat volutpat. Sed dapibus dui quis est ullamcorper faucibus. Duis luctus erat vel tristique malesuada. ","When_did_this_happen":"1992-10-13","More_details":"Aliquam a nunc leo. Integer posuere, sem quis efficitur malesuada, orci ligula malesuada lectus, ut lobortis nunc enim convallis nisi. Donec ultrices diam velit, eu scelerisque purus cursus ac. Nullam vulputate tempor felis at aliquet. Nam quis lacus mollis, congue velit mollis, malesuada ante."}', '2016-04-12 22:31:45', 'Reporter', '230', 'Open', '2016-04-12', 1),
(161, '{"Report_Raiser":"Reporter","date":"2016-04-12","Report_Owner":"Tom","Details":"Phasellus ultrices, felis ac luctus sagittis, lorem odio elementum orci, quis venenatis risus felis eu sapien. Mauris id varius erat. Aliquam ac malesuada odio, vitae mollis arcu.","When_did_this_happen":"2001-01-01","More_details":"Fusce iaculis, velit eu volutpat feugiat, est tellus porttitor ex, vitae pretium mi urna in massa. Praesent non enim nulla. Mauris dictum libero et volutpat auctor. Nam justo eros, pretium aliquet purus et, pellentesque bibendum tortor. Cras a erat sit amet nibh ornare lobortis sit amet ut magna."}', '2016-04-12 22:53:24', 'Reporter', '230', 'Open', '2016-04-15', 3),
(162, '{"Report_Raiser":"amr","date":"2016-04-13","Report_Owner":"AFADF","Details":"a?"}', '2016-04-13 16:56:36', 'amr', '263', 'Draft', '0000-00-00', 1),
(163, '{"Report_Raiser":"Reporter","date":"2016-04-13","Report_Owner":"Asdfg","Details":"123456789101112","When_did_this_happen":"2016-04-14","Example":"Example"}', '2016-04-13 21:23:54', 'Reporter', '264', 'Open', '2016-04-13', 5),
(164, '{"Report_Raiser":"gcu","date":"2016-04-13","Report_Owner":"Dave","Details":"details of the report. This is an example!","This_is_an_example":"example","Should_we_win":"Yes"}', '2016-04-13 21:38:58', 'gcu', '228', 'Closed', '2016-04-13', 3),
(165, '{"Report_Raiser":"ideagen","date":"2016-04-13","Report_Owner":"test","Details":"test","When_did_this_happen":"2060-04-03","More_details":"this is more detail!"}', '2016-04-13 21:42:26', 'ideagen', '230', 'Draft', '0000-00-00', 1),
(166, '{"Report_Raiser":"ideagen","date":"2016-04-13","Report_Owner":"Testtesttest","Details":"lorim ipsummmmmmm","When_did_this_happen":"0008-08-08","More_details":"more more more details"}', '2016-04-13 21:42:54', 'ideagen', '230', 'Draft', '0000-00-00', 1),
(167, '{"Report_Raiser":"ideagen","date":"2016-04-13","Report_Owner":"report owner!","Details":"this is the details"}', '2016-04-13 21:43:49', 'ideagen', '263', 'Draft', '0000-00-00', 5),
(168, '{"Report_Raiser":"caledonian","date":"2016-04-13","Report_Owner":"Me!","Details":"Details!!!!!! give us a good grade please!","This_is_an_example":"we would love a good grade, cheers","Should_we_win":"Yes"}', '2016-04-13 21:46:59', 'caledonian', '228', 'Draft', '0000-00-00', 1),
(169, '{"Report_Raiser":"caledonian","date":"2016-04-13","Report_Owner":"dave ","Details":"So many details","When_did_this_happen":"0004-04-04","More_details":"one two threeeee"}', '2016-04-13 21:47:43', 'caledonian', '230', 'Draft', '0000-00-00', 1),
(170, '{"Report_Raiser":"caledonian","date":"2016-04-13","Report_Owner":"ME!","Details":"So many details not enough time","When_did_this_happen":"0001-01-01","More_details":"even more details? didnt I tell you I dont have enough time."}', '2016-04-13 21:48:37', 'caledonian', '230', 'Draft', '0000-00-00', 5),
(173, '{"Report_Raiser":"Reporter","date":"2016-04-14","Report_Owner":"","Details":"","example":"yes","when_did_this_happen":"0001-01-01","dropdown":"1","this_is_a_radio":["1"],"test":"yes"}', '2016-04-14 14:13:38', 'Reporter', '267', 'Open', '2016-04-14', 5),
(174, '{"Report_Raiser":"ideagen","date":"2016-04-14","Report_Owner":"Big Jim","Details":"","Destination":"Glasgow","Departure":"London","Incident_Details":"Ground crew staff crashed into plane! It wasn''t nice."}', '2016-04-14 14:14:04', 'ideagen', '268', 'Open', '2016-04-14', 5),
(175, '{"Report_Raiser":"Ideagen","date":"2016-04-15","Report_Owner":"Big Jim","Details":"","Destination":"Glasgow","Departure":"London","Incident_Details":"Ground crew staff crashed into plane! It wasn''t nice."}', '2016-04-15 10:11:25', 'Ideagen', '268', 'Draft', '0000-00-00', 5),
(176, '{"Report_Raiser":"Ideagen","date":"2016-04-15","Report_Owner":"big jim!","Details":"","Destination":"","Departure":"","Incident_Details":""}', '2016-04-15 10:11:51', 'Ideagen', '268', 'Draft', '0000-00-00', 5),
(177, '{"Report_Raiser":"Ideagen","date":"2016-04-15","Report_Owner":"big jim","Details":"","Destination":"","Departure":"","Incident_Details":""}', '2016-04-15 10:12:07', 'Ideagen', '268', 'Draft', '0000-00-00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `user_role` varchar(365) NOT NULL,
  `role_id` int(11) NOT NULL AUTO_INCREMENT,
  `CreateTemplate` tinyint(1) NOT NULL,
  `CreateReport` tinyint(1) NOT NULL,
  `DeleteReport` tinyint(1) NOT NULL,
  `EditReport` tinyint(1) NOT NULL,
  `OpenReport` tinyint(1) NOT NULL,
  `CloseReport` tinyint(1) NOT NULL,
  `user_management` tinyint(1) NOT NULL,
  `delete_template` tinyint(1) NOT NULL,
  `update_template` tinyint(1) NOT NULL,
  `AddAttatchment` tinyint(1) NOT NULL,
  `DeleteAttatchment` tinyint(1) NOT NULL,
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 ;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`user_role`, `role_id`, `CreateTemplate`, `CreateReport`, `DeleteReport`, `EditReport`, `OpenReport`, `CloseReport`, `user_management`, `delete_template`, `update_template`, `AddAttatchment`, `DeleteAttatchment`) VALUES
('admin', 4, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1),
('Reporter', 23, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0),
('Manager', 24, 1, 0, 1, 1, 1, 1, 0, 1, 1, 1, 1),
('test', 25, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
('Administration', 26, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0),
(' ', 28, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `upload`
--

CREATE TABLE IF NOT EXISTS `upload` (
  `upload_id` int(11) NOT NULL AUTO_INCREMENT,
  `form_id` int(11) NOT NULL,
  `newname` varchar(365) NOT NULL,
  `oldname` varchar(365) NOT NULL,
  PRIMARY KEY (`upload_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=55 ;

--
-- Dumping data for table `upload`
--

INSERT INTO `upload` (`upload_id`, `form_id`, `newname`, `oldname`) VALUES
(9, 127, '570a3e7ca84599.05047176', 'download111111.jpg'),
(10, 127, '570a3e8a923d96.80810936', 'ArchiveTemplate.php'),
(11, 127, '570a3eb97b6c28.79719623', 'ArchiveTemplate.php'),
(12, 127, '570a3f146ab289.02880356', 'download111111.jpg'),
(36, 127, '570a42aece0729.24531328', 'download111111.jpg'),
(37, 127, '570a42e1911a61.23875139', 'done (2).zip'),
(39, 129, '570a4409c65736.12844549', 'download111111.jpg'),
(40, 129, '570a441c711292.46711288', 'download111111.jpg'),
(41, 129, '570a446bf059b1.44084717', 'ArchiveTemplate.php'),
(42, 129, '570a44a8267825.20455628', 'download111111.jpg'),
(44, 128, '570a4d2e255582.71579330', 'download111111.jpg'),
(45, 126, '570a4e07a7c157.74034925', 'ArchiveTemplate.php'),
(46, 132, '570a5c7c5e0545.05741132', 'download111111.jpg'),
(47, 134, '570a5d478f1237.14917994', 'download111111 (1).jpg'),
(48, 144, '570a9b6239f943.40101238', 'download111111 (1).jpg'),
(49, 145, '570aaa48bb7a70.51145656', 'image.jpeg'),
(50, 146, '570b93bdab7296.68931088', 'chrome.dll'),
(51, 151, '570b972910e364.17509382', 'Scotland-wallpaper-10055985.jpg'),
(53, 163, '570eb937dcb0d3.53047318', '1280X800_02.jpg'),
(54, 173, '570fa5b4c9f8a8.82990339', 'group16_presentation.pptx');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'auto incrementing user_id of each user, unique index',
  `user_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL COMMENT 'user''s name, unique',
  `user_password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'user''s password in salted and hashed format',
  `user_email` varchar(64) COLLATE utf8_unicode_ci NOT NULL COMMENT 'user''s email, unique',
  `user_role` varchar(365) COLLATE utf8_unicode_ci NOT NULL,
  `first_name` varchar(365) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(365) COLLATE utf8_unicode_ci NOT NULL,
  `Archive` int(1) NOT NULL,
  `newname` varchar(365) COLLATE utf8_unicode_ci NOT NULL,
  `oldname` varchar(365) COLLATE utf8_unicode_ci NOT NULL,
  `login` datetime NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_name` (`user_name`),
  UNIQUE KEY `user_email` (`user_email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='user data' AUTO_INCREMENT=73 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_password_hash`, `user_email`, `user_role`, `first_name`, `last_name`, `Archive`, `newname`, `oldname`, `login`) VALUES
(19, 'Amr', '$2y$10$KeDgLb9daLi/TXb6C7UR..PVShomblbWGx46a7yxBWZyf73NEXE5K', 'adam-rfc@live.co.uk', 'admin', 'adam', 'wheatley', 0, '570f93c48bcb40.36622232', 'image.jpg', '2016-04-15 11:08:32'),
(48, 'Eddie', '$2y$10$nxTP5RNk0MtBy.SJU0Aimucy.Pxd5F0fDxhTcJBmjiyBG7SFyb/FG', 'eddie@eddie.com', 'admin', 'Eddie', 'eddie', 0, '570f7c175f42c3.94670700', '10403668_10152646718524637_4738171071194930552_n.jpg', '2016-04-15 01:01:46'),
(62, 'test1', '$2y$10$U07RUVPRQZIpBnb1qN8JpOvq1u8uaMznfgxyg8XVtu6c9lLuKjODG', 'test@test.com', 'admin', 'test', 'test', 1, '', '', '0000-00-00 00:00:00'),
(64, 'gcu', '$2y$10$LpFZ2yEJ82Wtx5S7gY1PE.0MgmdPGI55GhTzwid/czkEcO/Blw6Oy', 'gcu@gcu.com', 'admin', 'test', 'test', 1, '', '', '2016-04-13 22:37:47'),
(66, 'Example', '$2y$10$vJFk0q0t1Q7RZW7HzPBInegk4q9zSNdIYy1w/rMIqznzRu2QWtvxu', 'fghjk@liv.com', 'admin', 'Adam', 'Adam', 1, '', '', '0000-00-00 00:00:00'),
(67, 'Reporter', '$2y$10$zxmwMHn3Ms/hK/LojPRXWOrSDgxqNivCj5zI4kSloBRmxDzkuu1rC', 'reporter@live.com', 'Reporter', 'Reporter', 'Reporter', 0, '570d768229ccb0.25578313', 'man2.jpg', '2016-04-15 16:08:17'),
(68, 'manager', '$2y$10$XH1DPbIa/D60S2atqX76T.yw9pUlUpy4IHUHWPspLEKM5okoxj8pS', 'adam@live.com', 'Manager', 'adam', 'wheatley', 0, '570d75b7a747c7.74764729', 'man.jpg', '2016-04-14 15:15:10'),
(69, 'Test123', '$2y$10$gswgrtrj5DDCEpkERYnMYezog88CUFJe4uNShtDeZ9MtprMK/zdNi', 'test@ttttt.com', 'test', 'Test', 'Test', 0, '', '', '0000-00-00 00:00:00'),
(70, 'Ideagen', '$2y$10$IMJz0.x3lRahJ5ER3UcU3eC3c6GkPdDDEHeO1BKGMhh3Uhhd6gRA.', 'invalid@invalid', 'admin', 'Ideagen', 'Ideagen', 0, '', '', '2016-04-15 16:07:56'),
(71, 'caledonian', '$2y$10$15EgOTXiezF9UWBO3CS6GOJEkpyyNnIif4YVDVQweiO9RDcvNQa6m', 'lorim@ipsum.com', 'admin', 'Lorim', 'Ipsum', 0, '', '', '2016-04-14 15:01:19'),
(72, 'Admin', '$2y$10$rwxBGIdqf0XI8t/ADc2xn.RKUtttw/xhRwxo7NgGF1mVi8V43hf7a', 'admin@email.com', 'Administration', 'Adam', 'Wheatley', 0, '570f75d891cb63.31718043', 'man.jpg', '2016-04-14 15:02:09');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
