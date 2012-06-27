-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Machine: localhost
-- Genereertijd: 27 jun 2012 om 15:24
-- Serverversie: 5.5.16
-- PHP-Versie: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `expotool`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `active`
--

CREATE TABLE IF NOT EXISTS `active` (
  `location_id` int(11) NOT NULL AUTO_INCREMENT,
  `active` int(11) NOT NULL,
  PRIMARY KEY (`location_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Gegevens worden uitgevoerd voor tabel `active`
--

INSERT INTO `active` (`location_id`, `active`) VALUES
(0, 2);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `expos`
--

CREATE TABLE IF NOT EXISTS `expos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `curator` varchar(255) NOT NULL,
  `curator_email` varchar(255) NOT NULL,
  `password` text NOT NULL,
  `description` text NOT NULL,
  `location_id` int(11) NOT NULL,
  `canvas` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Gegevens worden uitgevoerd voor tabel `expos`
--

INSERT INTO `expos` (`id`, `name`, `curator`, `curator_email`, `password`, `description`, `location_id`, `canvas`) VALUES
(1, 'test%20expo', 'tester1', 'tester@tester.com', '5f4dcc3b5aa765d61d8327deb882cf99', 'This%20is%20an%20expo%20to%20play%20around%20with', 0, '%3Cdiv%20class%3D%22item%20canvas%22%20data-id%3D%221%22%20data-name%3D%22Wall%201%22%20style%3D%22width%3A%2095%25%3B%20height%3A%20324.25px%3B%20%22%3E%3Cdiv%20class%3D%22piece%20image%20border%20undefined%20ui-draggable%20ui-resizable%22%20id%3D%22high%22%20width%3D%22150px%22%20height%3D%22150px%22%20style%3D%22position%3A%20absolute%3B%20width%3A%20222px%3B%20height%3A%20299px%3B%20left%3A%20104px%3B%20top%3A%2010px%3B%20%22%3E%3Cimg%20width%3D%22100%25%22%20height%3D%22100%25%22%20src%3D%22http%3A//cache.gawker.com/assets/images/39/2010/10/cheezburger_410.jpg%22%3E%3Cinput%20type%3D%22hidden%22%20id%3D%22expo%22%20value%3D%221%22%3E%3Cinput%20type%3D%22hidden%22%20id%3D%22wall%22%20value%3D%221%22%3E%09%09%09%09%09%3Cinput%20type%3D%22hidden%22%20id%3D%22pieceTitle%22%20value%3D%22cheezburger%22%3E%3Cinput%20type%3D%22hidden%22%20id%3D%22pieceDesc%22%20value%3D%22cats%2521%22%3E%3Cdiv%20class%3D%22ui-resizable-handle%20ui-resizable-e%22%20style%3D%22%22%3E%3C/div%3E%3Cdiv%20class%3D%22ui-resizable-handle%20ui-resizable-s%22%20style%3D%22%22%3E%3C/div%3E%3Cdiv%20class%3D%22ui-resizable-handle%20ui-resizable-se%20ui-icon%20ui-icon-gripsmall-diagonal-se%22%20style%3D%22z-index%3A%201001%3B%20%22%3E%3C/div%3E%3C/div%3E%3Cdiv%20class%3D%22piece%20image%20border%20undefined%20ui-draggable%20ui-resizable%22%20id%3D%22high%22%20width%3D%22150px%22%20height%3D%22150px%22%20style%3D%22position%3A%20absolute%3B%20left%3A%20677px%3B%20top%3A%209px%3B%20%22%3E%3Cimg%20width%3D%22100%25%22%20height%3D%22100%25%22%20src%3D%22http%3A//harry.enzoverder.be/cats/i-can-has-cheezburger-you-can-has-laptop.jpg%22%3E%3Cinput%20type%3D%22hidden%22%20id%3D%22expo%22%20value%3D%221%22%3E%3Cinput%20type%3D%22hidden%22%20id%3D%22wall%22%20value%3D%221%22%3E%09%09%09%09%09%3Cinput%20type%3D%22hidden%22%20id%3D%22pieceTitle%22%20value%3D%22cheezburger2%22%3E%3Cinput%20type%3D%22hidden%22%20id%3D%22pieceDesc%22%20value%3D%22more%2520cats%2521%22%3E%3Cdiv%20class%3D%22ui-resizable-handle%20ui-resizable-e%22%20style%3D%22%22%3E%3C/div%3E%3Cdiv%20class%3D%22ui-resizable-handle%20ui-resizable-s%22%20style%3D%22%22%3E%3C/div%3E%3Cdiv%20class%3D%22ui-resizable-handle%20ui-resizable-se%20ui-icon%20ui-icon-gripsmall-diagonal-se%22%20style%3D%22z-index%3A%201001%3B%20%22%3E%3C/div%3E%3C/div%3E%3C/div%3E'),
(2, 'text%20expo%202', 'tester1', 'tester@tester.com', '5f4dcc3b5aa765d61d8327deb882cf99', 'The%20password%20for%20both%20expo%27s%20is%20%22password%22', 0, '%3Cdiv%20class%3D%22item%20canvas%22%20data-id%3D%221%22%20data-name%3D%22Wall%201%22%20style%3D%22width%3A%2095%25%3B%20height%3A%20324.25px%3B%20%22%3E%3Cdiv%20rel%3D%22youtube%22%20class%3D%22piece%20movie%20youtube%20border%20undefined%20ui-draggable%20ui-resizable%22%20width%3D%22150px%22%20height%3D%22150px%22%20style%3D%22position%3A%20absolute%3B%20width%3A%20582px%3B%20height%3A%20292px%3B%20left%3A%20367px%3B%20top%3A%20-16px%3B%20%22%3E%3Ciframe%20src%3D%22http%3A//www.youtube.com/embed/plWnm7UpsXk%3Fhtml5%3D1%26amp%3Bautoplay%3D1%26amp%3Bautohide%3D1%26amp%3Bwmode%3Dtransparent%26amp%3Bloop%3D1%26amp%3Bplaylist%3DplWnm7UpsXk%22%20frameborder%3D%220%22%20width%3D%22100%25%22%20height%3D%22100%25%22%20allowfullscreen%3D%22%22%3E%3C/iframe%3E%3Cinput%20type%3D%22hidden%22%20id%3D%22expo%22%20value%3D%222%22%3E%3Cinput%20type%3D%22hidden%22%20id%3D%22wall%22%20value%3D%221%22%3E%09%09%09%09%3Cinput%20type%3D%22hidden%22%20id%3D%22pieceTitle%22%20value%3D%22dramatic%22%3E%3Cinput%20type%3D%22hidden%22%20id%3D%22pieceDesc%22%20value%3D%22drama%22%3E%3Cdiv%20class%3D%22ui-resizable-handle%20ui-resizable-e%22%20style%3D%22%22%3E%3C/div%3E%3Cdiv%20class%3D%22ui-resizable-handle%20ui-resizable-s%22%20style%3D%22%22%3E%3C/div%3E%3Cdiv%20class%3D%22ui-resizable-handle%20ui-resizable-se%20ui-icon%20ui-icon-gripsmall-diagonal-se%22%20style%3D%22z-index%3A%201001%3B%20%22%3E%3C/div%3E%3C/div%3E%3C/div%3E');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `location`
--

CREATE TABLE IF NOT EXISTS `location` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `location_name` varchar(255) NOT NULL,
  `location_curator` varchar(255) NOT NULL,
  `location_curator_email` varchar(255) NOT NULL,
  `password` text NOT NULL,
  `width` int(11) NOT NULL,
  `height` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Gegevens worden uitgevoerd voor tabel `location`
--

INSERT INTO `location` (`id`, `location_name`, `location_curator`, `location_curator_email`, `password`, `width`, `height`) VALUES
(0, 'OG183', 'Setup Utrecht', 'heinze@setup.nl', '', 2000, 1024);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `playlist`
--

CREATE TABLE IF NOT EXISTS `playlist` (
  `id` int(11) NOT NULL DEFAULT '0',
  `playlist_name` varchar(255) NOT NULL,
  `location_id` int(11) NOT NULL,
  `expos` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden uitgevoerd voor tabel `playlist`
--

INSERT INTO `playlist` (`id`, `playlist_name`, `location_id`, `expos`) VALUES
(0, 'default', 0, '1,2');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `playlist_walls`
--

CREATE TABLE IF NOT EXISTS `playlist_walls` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `playlist_name` varchar(255) NOT NULL,
  `location_id` int(11) NOT NULL,
  `wall` int(11) NOT NULL,
  `expos` varchar(255) NOT NULL,
  `timer` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `locaction_id` (`location_id`,`wall`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Gegevens worden uitgevoerd voor tabel `playlist_walls`
--

INSERT INTO `playlist_walls` (`id`, `playlist_name`, `location_id`, `wall`, `expos`, `timer`) VALUES
(1, 'noName', 0, 1, '1,2,3', 5),
(3, 'noName', 0, 2, '2,3,1,2,3', 5),
(5, 'noName', 0, 3, '2,1,2,3,1', 3);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `remote`
--

CREATE TABLE IF NOT EXISTS `remote` (
  `location_id` int(11) NOT NULL,
  `wall_number` int(11) NOT NULL,
  `active` int(11) NOT NULL,
  `hide` tinyint(1) NOT NULL,
  `playlist_on` tinyint(1) NOT NULL,
  `playlist_id` int(11) NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`),
  UNIQUE KEY `location_id` (`location_id`,`wall_number`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=91 ;

--
-- Gegevens worden uitgevoerd voor tabel `remote`
--

INSERT INTO `remote` (`location_id`, `wall_number`, `active`, `hide`, `playlist_on`, `playlist_id`, `id`) VALUES
(0, 2, 2, 1, 0, 3, 8),
(0, 3, 1, 0, 1, 5, 9),
(0, 1, 2, 1, 0, 1, 10),
(0, 0, 3, 0, 0, 1, 90);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `sources`
--

CREATE TABLE IF NOT EXISTS `sources` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `expo_id` int(11) NOT NULL,
  `wall` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `type` varchar(10) NOT NULL,
  `url` text NOT NULL,
  `description` text NOT NULL,
  `position_x` float NOT NULL,
  `position_y` float NOT NULL,
  `width` float NOT NULL,
  `heigth` float NOT NULL,
  `list` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Gegevens worden uitgevoerd voor tabel `sources`
--

INSERT INTO `sources` (`id`, `expo_id`, `wall`, `title`, `type`, `url`, `description`, `position_x`, `position_y`, `width`, `heigth`, `list`) VALUES
(1, 1, 1, 'cheezburger', 'image', 'http://cache.gawker.com/assets/images/39/2010/10/cheezburger_410.jpg', 'cats%2521', 0.0811866, 0.0308642, 0.173302, 0.92284, 1),
(2, 1, 1, 'cheezburger2', 'image', 'http://harry.enzoverder.be/cats/i-can-has-cheezburger-you-can-has-laptop.jpg', 'more%2520cats%2521', 0.528493, 0.0277778, 0.234192, 0.925926, 1),
(3, 1, 2, 'cheezburger3', 'image', 'http://farm3.staticflickr.com/2671/4036050881_9bc14c89a2.jpg', 'even%2520more%2520cats%2521', 0.0960961, 0.052, 0.765766, 0.878, 1),
(4, 1, 3, 'cheezburger4', 'image', 'http://tiredfreakedoutweirdogames.webs.com/photos/LOLCATS/i-waits-here-4-cheezburger-drop.jpg', 'even%2520more%2520cats%2521%2521', 0.289316, 0.14, 0.360144, 0.72, 1),
(5, 2, 1, 'dramatic', 'youtube', 'http://www.youtube.com/embed/plWnm7UpsXk?html5=1&autoplay=1&autohide=1&wmode=transparent&loop=1&playlist=plWnm7UpsXk', 'drama', 0.286495, -0.0493827, 0.454333, 0.901235, 1),
(6, 2, 2, 'dubstep%2520cat', 'vimeo', 'http://player.vimeo.com/video/36820781?autoplay=1&title=0&byline=0&portrait=0&loop=1', 'dubstep%2520cat', 0.00900901, 0.04, 0.923423, 0.8, 1),
(7, 2, 3, 'Random%2520stuff%2520about%2520cars', 'vimeo', 'http://player.vimeo.com/video/19296151?autoplay=1&title=0&byline=0&portrait=0&loop=1', 'Hi%2520Ruben%2521', 0.159664, 0.016, 0.621849, 0.808, 1);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `wall`
--

CREATE TABLE IF NOT EXISTS `wall` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `location_id` int(11) NOT NULL,
  `wallNumber` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `width` int(11) NOT NULL,
  `height` int(11) NOT NULL,
  `width_real` int(11) NOT NULL,
  `height_real` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Gegevens worden uitgevoerd voor tabel `wall`
--

INSERT INTO `wall` (`id`, `location_id`, `wallNumber`, `name`, `width`, `height`, `width_real`, `height_real`) VALUES
(1, 0, 1, 'Wall 1', 3072, 768, 12, 3),
(2, 0, 2, 'Wall 2', 1024, 768, 12, 3),
(3, 0, 3, 'Wall 3', 1280, 768, 3, 2);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
