-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Machine: localhost
-- Genereertijd: 16 feb 2012 om 13:38
-- Serverversie: 5.5.16
-- PHP-Versie: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `setup_wall`
--

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

--
-- Gegevens worden uitgevoerd voor tabel `expos`
--

INSERT INTO `expos` (`id`, `name`, `curator`, `curator_email`, `password`, `description`, `location_id`, `canvas`) VALUES
(21, 'test 1', 'test 1', 'test 1 ', '5a105e8b9d40e1329780d62ea2265d8a', 'test 1', 1, '\n	&lt;div class=&quot;piece border classic ui-draggable ui-resizable&quot; id=&quot;high&quot; width=&quot;150px&quot; height=&quot;150px&quot; style=&quot;left: 165px; top: 0px; &quot;&gt;&lt;img height=&quot;100%&quot; width=&quot;100%&quot; src=&quot;http://nicolekebolleke.punt.nl/upload/one.png&quot;&gt;&lt;div class=&quot;ui-resizable-handle ui-resizable-e&quot;&gt;&lt;/div&gt;&lt;div class=&quot;ui-resizable-handle ui-resizable-s&quot;&gt;&lt;/div&gt;&lt;div class=&quot;ui-resizable-handle ui-resizable-se ui-icon ui-icon-gripsmall-diagonal-se&quot; style=&quot;z-index: 1001; &quot;&gt;&lt;/div&gt;&lt;/div&gt;&lt;div class=&quot;piece  ui-draggable ui-resizable&quot; id=&quot;high&quot; width=&quot;150px&quot; height=&quot;150px&quot; style=&quot;position: absolute; width: 130px; height: 173px; left: 601px; top: 109px; &quot;&gt;&lt;img height=&quot;100%&quot; width=&quot;100%&quot; src=&quot;http://nicolekebolleke.punt.nl/upload/one.png&quot;&gt;&lt;div class=&quot;ui-resizable-handle ui-resizable-e&quot;&gt;&lt;/div&gt;&lt;div class=&quot;ui-resizable-handle ui-resizable-s&quot;&gt;&lt;/div&gt;&lt;div class=&quot;ui-resizable-handle ui-resizable-se ui-icon ui-icon-gripsmall-diagonal-se&quot; style=&quot;z-index: 1001; &quot;&gt;&lt;/div&gt;&lt;/div&gt;&lt;div class=&quot;piece  ui-draggable ui-resizable&quot; id=&quot;high&quot; width=&quot;150px&quot; height=&quot;150px&quot; style=&quot;position: absolute; top: 27px; left: 731px; width: 484px; height: 374px; &quot;&gt;&lt;img height=&quot;100%&quot; width=&quot;100%&quot; src=&quot;http://nicolekebolleke.punt.nl/upload/one.png&quot;&gt;&lt;div class=&quot;ui-resizable-handle ui-resizable-e&quot;&gt;&lt;/div&gt;&lt;div class=&quot;ui-resizable-handle ui-resizable-s&quot;&gt;&lt;/div&gt;&lt;div class=&quot;ui-resizable-handle ui-resizable-se ui-icon ui-icon-gripsmall-diagonal-se&quot; style=&quot;z-index: 1001; &quot;&gt;&lt;/div&gt;&lt;/div&gt;'),
(22, 'test 2', 'test 2', 'test 2', '38b0d2ff1c03df82aea67222983d337e', 'test 2', 1, '\n	&lt;div class=&quot;piece border classic ui-draggable ui-resizable&quot; id=&quot;high&quot; width=&quot;150px&quot; height=&quot;150px&quot; style=&quot;left: 410px; top: -8px; &quot;&gt;&lt;img height=&quot;100%&quot; width=&quot;100%&quot; src=&quot;http://lookatmyhappyrainbow.com/wp-content/uploads/2011/10/two.gif&quot;&gt;&lt;div class=&quot;ui-resizable-handle ui-resizable-e&quot;&gt;&lt;/div&gt;&lt;div class=&quot;ui-resizable-handle ui-resizable-s&quot;&gt;&lt;/div&gt;&lt;div class=&quot;ui-resizable-handle ui-resizable-se ui-icon ui-icon-gripsmall-diagonal-se&quot; style=&quot;z-index: 1001; &quot;&gt;&lt;/div&gt;&lt;/div&gt;&lt;div class=&quot;piece movie border classic ui-draggable ui-resizable&quot; width=&quot;150px&quot; height=&quot;150px&quot; style=&quot;position: absolute; width: 300px; height: 203px; left: 36px; top: 49px; &quot;&gt;&lt;iframe src=&quot;http://www.youtube.com/embed/MejbOFk7H6c?html5=1&amp;amp;autoplay=1&amp;amp;autohide=1&quot; frameborder=&quot;0&quot; width=&quot;100%&quot; height=&quot;100%&quot; allowfullscreen=&quot;&quot;&gt;&lt;/iframe&gt;&lt;div class=&quot;ui-resizable-handle ui-resizable-e&quot;&gt;&lt;/div&gt;&lt;div class=&quot;ui-resizable-handle ui-resizable-s&quot;&gt;&lt;/div&gt;&lt;div class=&quot;ui-resizable-handle ui-resizable-se ui-icon ui-icon-gripsmall-diagonal-se&quot; style=&quot;z-index: 1001; &quot;&gt;&lt;/div&gt;&lt;/div&gt;&lt;div class=&quot;piece movie border classic ui-draggable ui-resizable&quot; width=&quot;150px&quot; height=&quot;150px&quot; style=&quot;position: absolute; width: 317px; height: 247px; left: 820px; top: 8px; &quot;&gt;&lt;iframe src=&quot;http://www.youtube.com/embed/MejbOFk7H6c?html5=1&amp;amp;autoplay=1&amp;amp;autohide=1&quot; frameborder=&quot;0&quot; width=&quot;100%&quot; height=&quot;100%&quot; allowfullscreen=&quot;&quot;&gt;&lt;/iframe&gt;&lt;div class=&quot;ui-resizable-handle ui-resizable-e&quot;&gt;&lt;/div&gt;&lt;div class=&quot;ui-resizable-handle ui-resizable-s&quot;&gt;&lt;/div&gt;&lt;div class=&quot;ui-resizable-handle ui-resizable-se ui-icon ui-icon-gripsmall-diagonal-se&quot; style=&quot;z-index: 1001; &quot;&gt;&lt;/div&gt;&lt;/div&gt;'),
(23, 'test 3', 'test 3', 'test 3', 'e558c4dfc2a0f0d60f5ebff474c97ffc', 'test 3', 1, '\n	&lt;div class=&quot;piece movie  ui-draggable ui-resizable&quot; width=&quot;150px&quot; height=&quot;150px&quot;&gt;&lt;iframe src=&quot;http://www.youtube.com/embed/MejbOFk7H6c?html5=1&amp;amp;autoplay=1&amp;amp;autohide=1&quot; frameborder=&quot;0&quot; width=&quot;100%&quot; height=&quot;100%&quot; allowfullscreen=&quot;&quot;&gt;&lt;/iframe&gt;&lt;div class=&quot;ui-resizable-handle ui-resizable-e&quot;&gt;&lt;/div&gt;&lt;div class=&quot;ui-resizable-handle ui-resizable-s&quot;&gt;&lt;/div&gt;&lt;div class=&quot;ui-resizable-handle ui-resizable-se ui-icon ui-icon-gripsmall-diagonal-se&quot; style=&quot;z-index: 1001; &quot;&gt;&lt;/div&gt;&lt;/div&gt;&lt;div class=&quot;piece movie  ui-draggable ui-resizable&quot; width=&quot;150px&quot; height=&quot;150px&quot; style=&quot;left: 539px; top: 17px; &quot;&gt;&lt;iframe src=&quot;http://www.youtube.com/embed/xmT5i8hS2Pw?html5=1&amp;amp;autoplay=1&amp;amp;autohide=1&quot; frameborder=&quot;0&quot; width=&quot;100%&quot; height=&quot;100%&quot; allowfullscreen=&quot;&quot;&gt;&lt;/iframe&gt;&lt;div class=&quot;ui-resizable-handle ui-resizable-e&quot;&gt;&lt;/div&gt;&lt;div class=&quot;ui-resizable-handle ui-resizable-s&quot;&gt;&lt;/div&gt;&lt;div class=&quot;ui-resizable-handle ui-resizable-se ui-icon ui-icon-gripsmall-diagonal-se&quot; style=&quot;z-index: 1001; &quot;&gt;&lt;/div&gt;&lt;/div&gt;&lt;div class=&quot;piece movie border classic ui-draggable ui-resizable&quot; width=&quot;150px&quot; height=&quot;150px&quot; style=&quot;left: -277px; top: -6px; &quot;&gt;&lt;iframe src=&quot;http://www.youtube.com/embed/tFpGjFqnyXc?html5=1&amp;amp;autoplay=1&amp;amp;autohide=1&quot; frameborder=&quot;0&quot; width=&quot;100%&quot; height=&quot;100%&quot; allowfullscreen=&quot;&quot;&gt;&lt;/iframe&gt;&lt;div class=&quot;ui-resizable-handle ui-resizable-e&quot;&gt;&lt;/div&gt;&lt;div class=&quot;ui-resizable-handle ui-resizable-s&quot;&gt;&lt;/div&gt;&lt;div class=&quot;ui-resizable-handle ui-resizable-se ui-icon ui-icon-gripsmall-diagonal-se&quot; style=&quot;z-index: 1001; &quot;&gt;&lt;/div&gt;&lt;/div&gt;');

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

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `playlist`
--

CREATE TABLE IF NOT EXISTS `playlist` (
  `id` int(11) NOT NULL DEFAULT '0',
  `playlist_name` int(11) NOT NULL,
  `location_id` int(11) NOT NULL,
  `expos` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
