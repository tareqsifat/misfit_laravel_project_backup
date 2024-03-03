
CREATE TABLE `employee` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `occupation` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `salary` int(6) NOT NULL DEFAULT '0',
  `leader_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `employee` (`id`, `name`, `occupation`, `salary`, `leader_id`) VALUES
(1,	'Joshim',	'Doctor',	45000,	1),
(2,	'Aleya',	'Doctor',	15000,	1),
(3,	'Galib',	'Engineer',	12000,	5),
(4,	'Caynath',	'Professor',	17000,	6),
(5,	'Majbah Habib',	'Singer',	35000,	6),
(6,	'Sanjidah',	'Singer',	40000,	0),
(7,	'Jui akter',	'Singer',	20000,	6),
(8,	'Korim',	'Architect',	5000,	5);


CREATE TABLE `salary` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) NOT NULL DEFAULT '0',
  `month` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `given_salary` int(6) NOT NULL DEFAULT '0',
  `deferred_amount` int(6) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `salary` (`id`, `employee_id`, `month`, `given_salary`, `deferred_amount`) VALUES
(1,	1,	'January',	45000,	5000),
(2,	1,	'February',	45000,	5000),
(3,	2,	'January',	15000,	500),
(4,	3,	'March',	12000,	120),
(5,	3,	'February',	12000,	120),
(6,	3,	'March',	12000,	0),
(7,	4,	'June',	17000,	1700),
(8,	4,	'July',	17000,	1700),
(9,	4,	'June',	17000,	0),
(10,	5,	'January',	35000,	0),
(11,	5,	'February',	30000,	3500),
(12,	6,	'March',	35000,	250),
(13,	6,	'April',	40000,	500);
