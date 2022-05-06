-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 01, 2022 at 02:18 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cmssite`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(10) NOT NULL,
  `datetime` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(60) NOT NULL,
  `aname` varchar(30) NOT NULL,
  `aheadline` varchar(30) NOT NULL,
  `abio` varchar(500) NOT NULL,
  `aimage` varchar(60) NOT NULL DEFAULT 'avatar.png',
  `addedby` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `datetime`, `username`, `password`, `aname`, `aheadline`, `abio`, `aimage`, `addedby`) VALUES
(1, 'January-1-2022 22:27:28', 'attiqueurrehman12', '5251050', 'attique', 'Web Developer', 'IT Professional ', 'PicsArt_01-20-01.50.35.jpg', ''),
(2, 'January-13-2022 23:57:13', 'Shaun', '12345', 'Shaun Mendis', 'Designer', '  Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.   ', 'avatar.png', 'attiqueurrehman12'),
(6, 'January-14-2022 11:27:38', 'miller12', '12345', 'miller', ' Blogger', '  Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.   ', 'avatar.png', 'attiqueurrehman12'),
(7, 'January-14-2022 11:28:44', 'collin', '12345', 'collin w', 'Content Writer', 'I am good at writing. My duty involved writing content for Morning Washington. Designing social media campaign for local merchants and road map for investigative journalism. During the period of 20012-1017 i worked as a Bureau chief for Gajumatta Herald. Furthermore, i worked on many projects which includes investigating economical crisis at Mars. Finding water at Sun and writing a thesis for black holes in moon.', 'avatar.png', 'attiqueurrehman12'),
(8, 'January-15-2022 21:30:58', 'Jarico', '12345', 'Jarico W', 'Sports Trainer ', '  Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\r\n  ', 'avatar.png', 'attiqueurrehman12'),
(9, 'January-27-2022 19:54:22', 'dove', '12345', 'J Dove', 'Software Engineer', '', 'avatar.png', 'akram'),
(19, 'April-29-2022 01:25:48', 'malicatic12', '55555', 'malicatic12', '', '', 'avatar.png', 'attiqueurrehman12'),
(20, 'April-29-2022 18:36:47', 'akram1', '1234', 'Akram1', 'IT Consultant', 'As a passionate Developer and long-time fan of XYZ Company, I was elated to see an opening for a Junior Web Developer role. I have experience in HTML, CSS, and JavaScript. Combined with my recent internship in front-end web development, I am confident I have the skills to help XYZ Company succeed.', 'avatar.png', 'akram123456'),
(27, 'April-30-2022 02:45:36', 'attiqueurrehmannew12', '55555', 'attiqueurrehmannew', '', '', 'avatar.png', ''),
(28, 'May-01-2022 16:35:21', 'malicatic123', '55555', 'ghhhnn', '', '', 'avatar.png', 'malicatic1233'),
(29, 'May-01-2022 16:26:25', 'malicatic1234', '55555', 'malicatic1234', '', '', 'avatar.png', ''),
(30, 'May-01-2022 16:30:55', 'malicatic123456', '55555', 'malicatic123456', '', '', 'avatar.png', 'malicatic12345'),
(31, 'May-01-2022 16:35:21', 'malicatic123', '55555', 'ghhhnn', '', '', 'avatar.png', 'malicatic1233'),
(32, 'May-01-2022 16:37:16', 'malicatic122', '55555', 'malikkkk', '', '', 'avatar.png', 'malicatic12333');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(10) NOT NULL,
  `title` varchar(50) NOT NULL,
  `author` varchar(50) NOT NULL,
  `datetime` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `title`, `author`, `datetime`) VALUES
(1, 'Technology', 'attiqueurrehman12', 'January-01-2022 21:05:43'),
(2, 'Programming', 'attiqueurrehman12', 'January-1-2022 21:09:26'),
(3, 'Fitness', 'attiqueurrehman12', 'January-01-2022 21:09:29'),
(5, 'Science', 'collin', 'January-14-2022 11:24:52'),
(6, 'Politics', 'attiqueurrehman12', 'January-14-2022 11:25:42'),
(7, 'Sports', 'miller12', 'January-15-2022 12:25:37'),
(8, 'World', 'miller12', 'January-15-2022 12:25:45'),
(9, 'News', 'miller12', 'January-15-2022 12:25:48'),
(10, 'Movies', 'miller12', 'January-15-2022 12:25:56');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(10) NOT NULL,
  `datetime` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(60) NOT NULL,
  `comment` varchar(500) NOT NULL,
  `post_author` varchar(50) NOT NULL,
  `approvedby` varchar(50) NOT NULL,
  `status` varchar(3) NOT NULL,
  `post_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `datetime`, `name`, `email`, `comment`, `post_author`, `approvedby`, `status`, `post_id`) VALUES
(45, 'May-01-2022 15:19:24', 'asad', 'asad@gmail.com', 'nice', 'attiqueurrehman12', 'attique', 'ON', 55),
(46, 'May-01-2022 15:35:19', 'ali', 'sl22i@gmail.com', 'nice', 'attiqueurrehman12', 'Pending', 'OFF', 54);

-- --------------------------------------------------------

--
-- Table structure for table `contactus`
--

CREATE TABLE `contactus` (
  `id` int(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `message` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `contactus`
--

INSERT INTO `contactus` (`id`, `email`, `message`) VALUES
(1, 'rehmanawan.contact@gmail.com', 'query'),
(2, 'rizwanurrehman12.contact@gmail.com', 'CHECKING'),
(3, 'malicatic12@gmail.com', 'testing');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(10) NOT NULL,
  `datetime` varchar(50) NOT NULL,
  `title` varchar(300) NOT NULL,
  `category` varchar(50) NOT NULL,
  `author` varchar(50) NOT NULL,
  `image` varchar(50) NOT NULL,
  `post` varchar(10000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `datetime`, `title`, `category`, `author`, `image`, `post`) VALUES
(16, 'January-15-2022 12:20:29', 'The New Educational Initiative', 'Technology', 'miller12', 'BeFunky-sample.jpg', '                                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, qu                            '),
(17, 'January-15-2022 12:20:47', 'What is Chip 8547', 'Technology', 'miller12', 'agi-banner-ai1.jpg', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi u'),
(18, 'January-15-2022 12:21:14', 'Black Money', 'Politics', 'miller12', '_102968357_diverse_politics.jpg', '    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi u'),
(19, 'January-15-2022 12:22:54', 'Post 4', 'Politics', 'collin', 'safe_image.jpg', ''),
(20, 'January-15-2022 12:23:09', 'Losing weight is a thing of Past', 'Fitness', 'collin', 'fit.jpg', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut '),
(21, 'January-15-2022 12:23:38', 'Post 6 ', 'Science', 'collin', 'safe_image.jpg', ''),
(22, 'January-15-2022 12:24:05', 'Post 7', 'Science', 'collin', 'HTML5 CSS3.jpg', ''),
(23, 'January-15-2022 12:24:52', 'Fun Exercises for Kids', 'Fitness', 'dove', 'children-running-t.jpg', 'Sarah Palen a famous physician says letting kids play the way they want make them happy, active and healthy. Parent advice on thing which they can do or dont leave a bad effect on children, she maintained. '),
(25, 'January-15-2022 12:26:22', 'Watchdog groups say oil Refineries are causing Pollution in African peninsula ', 'News', 'dove', 'gas.jpg', '                              '),
(26, 'January-15-2022 12:26:35', 'Cold Gujjars ', 'Movies', 'dove', 'tt.jpg', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi u'),
(27, 'January-15-2022 12:26:53', 'The Beautiful Wazir Khan Mosque', 'World', 'dove', 'rt.jpg', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis '),
(28, 'January-15-2022 12:27:34', 'Learn HTML5 and CSS3', 'Technology', 'dove', 'htmlcourse.jpg', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, qu'),
(34, 'January-16-2022 10:04:22', 'The most awaited laptop by Dell', 'Technology', 'dove', 'safe_image.jpg', '                                                                                                                                                                                                                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. \r\n<h2 class=\"display-4\">The wait is finally over</h1>\r\n\r\n  <div style=\"height:10px; background:#27aae1;\"></div>\r\n <p class=\"lead\">Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. \r\nExcepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. </p>\r\n<div style=\"height:10px; background:#27aae1;\"></div>\r\n<img src=\"uploads/laptop.jpg\" class=\"d-block img-fluid\" />       \r\n<h2 class=\"display-4\"> Specification</h2>\r\n<ul>\r\n<li>Memory</li>\r\n<li>Hard drive</li>\r\n<li>Processor</li>\r\n<li>Cache</li>\r\n<li>Metallic Body</li>\r\n</ul>\r\n<img src=\"uploads/laptop1.jpg\" class=\"d-block img-fluid\" />  \r\n<p class=\"text-justify\">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. \r\nExcepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. \r\nExcepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. \r\nExcepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.   </p>                                                                               '),
(35, 'January-26-2022 07:47:52', 'Is intensive work-out bad for health?', 'Fitness', 'attiqueurrehman12', 'asasas.jpg', '                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in \r\n              '),
(36, 'January-26-2022 07:48:40', 'post 15', 'Politics', 'attiqueurrehman12', 'unnamed.jpg', ''),
(37, 'January-26-2022 07:49:27', 'Lahore Open Rainy Tennis ', 'Sports', 'attiqueurrehman12', 'ty.jpg', '                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco l              '),
(38, 'January-26-2022 07:49:42', 'France offers citizenship to Malian immigrant', 'News', 'miller12', 'download.jpg', '                              '),
(39, 'January-26-2022 07:49:54', 'The Hall of Hog', 'Movies', 'attiqueurrehman12', 'ddd.jpg', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi u'),
(40, 'January-26-2022 07:50:05', 'Heat Wave in Australia', 'News', 'miller12', 'sc.jpg', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi u'),
(41, 'January-26-2022 07:50:13', 'Ashes Series is upon us', 'Sports', 'attiqueurrehman12', 'cc.jpg', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis '),
(42, 'January-26-2022 07:50:22', 'Brain Mineralogy ', 'Technology', 'attiqueurrehman12', 'dd.jpg', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.               '),
(43, 'January-26-2022 07:51:02', 'The New Honda Phurr', 'Technology', 'miller12', 'jj.jpg', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. '),
(44, 'January-26-2022 07:51:09', 'Machine Learning and If-Else statements', 'Technology', 'malicatic12', 'ss.jpg', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.                   '),
(45, 'January-26-2022 07:51:14', 'The Future of AI', 'Technology', 'attiqueurrehman12', 'aa.jpg', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. '),
(46, 'January-26-2022 07:51:19', 'Tesla III is ready to launch', 'Technology', 'attiqueurrehman12', 'Tesla-Model-X-Silver.jpg', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. '),
(47, 'January-26-2022 07:51:33', 'The new iphone update slows phone | Chacha Accepted', 'Technology', 'dove', 'iphone.jpg', '                              '),
(48, 'January-26-2022 07:51:38', 'The Travel diary 2050', 'World', 'attiqueurrehman12', 'travelBlogger.jpg', '                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat                             '),
(49, 'January-26-2022 07:51:41', 'Manchester United is going for a twist', 'Sports', 'dove', 'ronaldo.jpg', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat '),
(50, 'January-26-2022 07:51:47', 'The future of Online Education ', 'News', 'attiqueurrehman12', 'dd.jpg', '                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis               '),
(51, 'January-26-2022 07:51:50', 'Education for Syrian Refugee Children', 'News', 'dove', 'education.jpg', '                Symbolic Syrian Woman Alkuman-Made is asking for Free Education to all under-privileges . This will definitely a milestone in the middle eastern region.               '),
(52, 'January-26-2022 07:52:01', 'Relaying on Veges is good? Study Says...', 'Fitness', 'dove', 'food.jpg', '                              Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.              Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.              '),
(53, 'January-26-2022 07:52:05', 'AVENGERS 3: INFINITY WAR | Movie Review', 'Movies', 'dove', 'maxresdefault.jpg', ' Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.  <h2 class=\"display-4\">People are Talking !!! </h1>    \r\n<div style=\"height:10px; background:#27aae1;\"></div>\r\n  <p class=\"lead\">Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.  Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. </p> <div style=\"height:10px; background:#27aae1;\"></div>\r\n <img src=\"uploads/cacha.jpg\" class=\"d-block img-fluid\" />           \r\n\r\n   <p class=\"text-justify\">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.  Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.  Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.  Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.   </p>                                                                                                                                       '),
(54, 'January-26-2022 07:52:09', 'The Cool Laptop in History', 'Technology', 'attiqueurrehman12', '650222_0738_12.jpg', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.  <h2 class=\"display-4\">The wait is finally over</h1>    <div style=\"height:10px; background:#27aae1;\"></div>  <p class=\"lead\">Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.  Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. </p> <div style=\"height:10px; background:#27aae1;\"></div> <img src=\"uploads/laptop.jpg\" class=\"d-block img-fluid\" /> \r\n       <h2 class=\"display-4\"> Specification</h2> <ul> <li>Memory</li> <li>Hard drive</li> <li>Processor</li> <li>Cache</li> <li>Metallic Body</li> </ul>\r\n\r\n <img src=\"uploads/laptop1.jpg\" class=\"d-block img-fluid\" />   <p class=\"text-justify\">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.  Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.  Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.  Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.   </p>                                                                                                                                                     '),
(55, 'April-27-2022 02:54:43', 'Testing', 'Technology', 'attiqueurrehman12', 'pexels-negative-space-34600.jpg', '                                loremm testing loremm testingloremm testingloremm testingloremm testingloremm testingloremm testingloremm testingloremm testingloremm testingloremm testingloremm testingloremm testingloremm testingloremm testingloremm testingloremm testingloremm testing                            ');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_id` (`post_id`),
  ADD KEY `post_author` (`post_author`);

--
-- Indexes for table `contactus`
--
ALTER TABLE `contactus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `author` (`author`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `contactus`
--
ALTER TABLE `contactus`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `Foreign_Relation` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Foreign_Relationnn` FOREIGN KEY (`post_author`) REFERENCES `posts` (`author`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
