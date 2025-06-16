-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 14, 2025 at 08:15 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cake_demo`
--

-- --------------------------------------------------------

--
-- Table structure for table `certificates`
--

CREATE TABLE `certificates` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `issued_at` datetime DEFAULT current_timestamp(),
  `certificate_path` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `certificates`
--

INSERT INTO `certificates` (`id`, `user_id`, `course_id`, `issued_at`, `certificate_path`) VALUES
(1, 8, 7, '2025-06-13 06:58:19', NULL),
(2, 5, 10, '2025-06-13 10:27:21', NULL),
(3, 11, 10, '2025-06-14 03:29:16', NULL),
(4, 5, 7, '2025-06-14 04:54:52', NULL),
(5, 10, 8, '2025-06-14 05:45:51', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `thumbnail` varchar(255) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created` datetime DEFAULT current_timestamp(),
  `modified` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `title`, `description`, `thumbnail`, `user_id`, `created`, `modified`) VALUES
(7, 'Web Development', 'Learn making interactive websites with us. Enroll now', 'pngtree-web-development-illustration-modern-can-be-used-for-landing-pages-web-png-image-1496223_1749205130.jpg', 5, '2025-06-06 10:18:50', '2025-06-06 10:18:50'),
(8, 'Python', 'Learn python a growing and in demand programming language ', 'png-transparent-learning-to-program-using-python-programming-language-computer-programming-the-python-papers-anthology-computer-text-computer-logo-thumbnail_1749206288.png', 5, '2025-06-06 10:38:08', '2025-06-06 10:38:08'),
(10, 'Cyber Security ', 'Prevent system from cyber threats and system vulnerabilities', 'cyber-security-course-igmguru-1273766112-l_1749271081.jpg', 6, '2025-06-07 04:38:01', '2025-06-07 04:38:01');

-- --------------------------------------------------------

--
-- Table structure for table `enrollments`
--

CREATE TABLE `enrollments` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `enrolled_on` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `enrollments`
--

INSERT INTO `enrollments` (`id`, `user_id`, `course_id`, `enrolled_on`) VALUES
(6, 7, 7, '2025-06-06 12:00:29'),
(7, 10, 8, '2025-06-06 12:06:18'),
(15, 9, 10, '2025-06-09 04:40:06'),
(20, 11, 8, '2025-06-11 05:50:52'),
(21, 9, 8, '2025-06-11 09:16:10'),
(23, 7, 8, '2025-06-11 10:05:33'),
(40, 8, 7, '2025-06-13 08:39:46'),
(41, 5, 10, '2025-06-13 10:26:39'),
(43, 11, 10, '2025-06-14 03:31:28'),
(44, 5, 7, '2025-06-14 04:57:42');

-- --------------------------------------------------------

--
-- Table structure for table `lessons`
--

CREATE TABLE `lessons` (
  `id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lessons`
--

INSERT INTO `lessons` (`id`, `course_id`, `title`, `description`, `created`, `modified`) VALUES
(7, 7, 'HTML  and CSS', 'Learn HTML and CSS the fundamental languages for front-end development ', '2025-06-10 08:47:07', '2025-06-10 08:47:07'),
(8, 10, 'System Vulnerability', 'Learn your system\'s vulnerabilities that hackers uses to exploit your system and gain unauthorize access\r\n', '2025-06-10 10:37:27', '2025-06-10 10:37:27'),
(9, 8, 'Introduction to Python', 'In this chapter we will learn about the Python language', '2025-06-10 11:58:50', '2025-06-10 11:58:50'),
(10, 8, 'Conditional Statements & Loops', 'In this chapter we will learn more about conditional statements and loops', '2025-06-11 04:11:20', '2025-06-11 04:11:20'),
(11, 10, 'Types of Attacks', 'In this lesson you learn about types of attacks in your system', '2025-06-11 10:09:06', '2025-06-11 10:09:06'),
(12, 7, 'Javascript', 'In this chapter you will learn about Javascript ', '2025-06-11 12:08:45', '2025-06-11 12:08:45');

-- --------------------------------------------------------

--
-- Table structure for table `lesson_contents`
--

CREATE TABLE `lesson_contents` (
  `id` int(11) NOT NULL,
  `lesson_id` int(11) NOT NULL,
  `content_type` enum('text','video','file') DEFAULT 'text',
  `content` text DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lesson_contents`
--

INSERT INTO `lesson_contents` (`id`, `lesson_id`, `content_type`, `content`, `created`, `modified`) VALUES
(2, 7, 'text', 'HTML and CSS are the core building blocks of every website on the internet. HTML (HyperText Markup Language) is responsible for the structure and content of a web page, while CSS (Cascading Style Sheets) is used to control the presentation, layout, and style.\r\n\r\nHTML defines elements like headings, paragraphs, links, images, and forms using tags. These tags give meaning to the content and help browsers display it correctly. Every website you visit is built with HTML at its core.\r\n\r\nCSS, on the other hand, is used to enhance the appearance of HTML elements. It allows developers to control colors, fonts, spacing, positioning, and responsiveness across different screen sizes. CSS can be written inline, internally within a <style> tag, or externally using a .css file.\r\n\r\nThe separation of HTML and CSS improves code organization and reusability. Designers can change the look of an entire website by editing a single CSS file without touching the HTML structure.\r\n\r\nLearning HTML and CSS is the first step toward becoming a web developer, and understanding how structure and style work together is essential for creating visually appealing and accessible websites.\r\n', '2025-06-10 09:35:59', '2025-06-11 08:45:01'),
(3, 8, 'text', 'What are vulnerabilities, and how are they exploited?\r\nA vulnerability is a weakness in an IT system that can be exploited by an attacker to deliver a successful attack. They can occur through flaws, features or user error, and attackers will look to exploit any of them, often combining one or more, to achieve their end goal.\r\nFlaws\r\nA flaw is unintended functionality. This may either be a result of poor design or through mistakes made during implementation. Flaws may go undetected for a significant period of time. The majority of common attacks we see today exploit these types of vulnerabilities.\r\nZero-day vulnerabilities\r\nZero-days are frequently used in bespoke attacks by the more capable and resourced attackers. Once the zero-days become publicly known, reusable attacks are developed and they quickly become a commodity capability. This poses a risk to any computer or system that has not had the relevant patch applied, or updated its antivirus software. The ability for an attacker to find and attack software flaws or subvert features depends on the nature of the software and their technical capabilities. Some target platforms are relatively simple to access, for example web applications could, by design, be capable of interacting with the Internet and may provide an opportunity for an attacker.\r\nUser error\r\nA computer or system that has been carefully designed and implemented can minimise the vulnerabilities of exposure to the Internet. Unfortunately, such efforts can be easily undone (for example by an inexperienced system administrator who enables vulnerable features, fails to fix a known flaw, or leaves default passwords unchanged).\r\n\r\nMore generally, users can be a significant source of vulnerabilities. They make mistakes, such as choosing a common or easily guessed password, or leave their laptop or mobile phone unattended. Even the most cyber aware users can be fooled into giving away their password, installing malware, or divulging information that may be useful to an attacker (such as who holds a particular role within an organization, and their schedule). These details would allow an attacker to target and time an attack appropriately. ', '2025-06-10 10:41:08', '2025-06-11 05:34:19'),
(4, 9, 'text', 'Python is a high-level, interpreted programming language known for its simplicity and readability. It is widely used for web development, data analysis, automation, artificial intelligence, and many other fields.\r\n\r\nOne of Python\'s main strengths is its clean and easy-to-understand syntax, which makes it an excellent choice for beginners. Unlike many other languages, Python allows developers to write fewer lines of code to accomplish complex tasks.\r\n\r\nPython supports multiple programming paradigms, including procedural, object-oriented, and functional programming. It comes with a vast standard library and thousands of third-party packages that extend its capabilities even further.\r\n\r\nPython code is executed line by line by an interpreter, which makes it easier to test and debug. It is cross-platform, meaning you can write and run Python code on different operating systems like Windows, macOS, and Linux without needing to change the code.\r\n\r\nWhether you\'re building a simple calculator or training a machine learning model, Python provides the tools and flexibility needed to develop efficient and scalable solutions.', '2025-06-10 12:05:45', '2025-06-11 08:52:29'),
(5, 10, 'text', 'Conditional statements and loops are fundamental control structures in Python that determine the flow of a program.\r\n\r\nConditional statements, such as if, elif, and else, are used to perform different actions based on different conditions. Python evaluates the condition, and if it\'s True, the corresponding block of code is executed. This allows the program to make decisions dynamically.\r\n\r\nLoops are used to repeat a block of code multiple times. Python supports two main types of loops: for loops and while loops. A for loop is commonly used when the number of iterations is known, such as looping through items in a list. A while loop is used when the number of iterations is not known in advance and continues running as long as a condition remains True.\r\n\r\nBoth conditional statements and loops use indentation to define the block of code to execute. Without proper indentation, Python will raise an error.\r\n\r\nThese control structures allow developers to create more powerful, flexible, and interactive programs by controlling how and when code is executed.\r\n', '2025-06-11 04:11:39', '2025-06-11 08:58:56'),
(6, 11, 'text', 'In cybersecurity, an attack refers to any attempt to gain unauthorized access to data, disrupt services, or cause harm to systems and networks. There are many different types of cyber attacks, each with its own method and purpose.\r\n\r\nOne common type is the phishing attack, where attackers trick users into revealing sensitive information through fake emails or websites. Malware attacks involve the installation of malicious software like viruses, worms, ransomware, or spyware on a user\'s device to steal data or damage systems.\r\n\r\nA Denial of Service (DoS) or Distributed Denial of Service (DDoS) attack floods a network or server with traffic, making it unavailable to legitimate users. These attacks can take down entire websites or services for extended periods.\r\n\r\nAnother serious threat is the Man-in-the-Middle (MitM) attack, where an attacker secretly intercepts and possibly alters communication between two parties, such as a user and a website.\r\n\r\nSQL injection is a more technical attack where an attacker inputs malicious SQL commands into a website\'s form or URL to access or manipulate the database.\r\n\r\nUnderstanding these types of attacks helps organizations and individuals strengthen their defenses and take proactive steps to protect data and systems from being compromised.', '2025-06-11 10:09:42', '2025-06-11 10:09:42'),
(7, 12, 'text', 'After learning HTML and CSS, the next important step in web development is mastering JavaScript. While HTML provides the structure and CSS handles the styling, JavaScript adds interactivity and dynamic behavior to web pages.\r\n\r\nWith JavaScript, developers can create features like dropdown menus, sliders, form validation, and live content updates without refreshing the page. JavaScript is a client-side scripting language, meaning it runs directly in the user’s browser and responds instantly to user actions.\r\n\r\nOnce you\'re comfortable with JavaScript, the next stage typically includes learning about the Document Object Model (DOM), which allows JavaScript to interact with HTML and CSS dynamically. Developers can then explore JavaScript libraries like jQuery or frameworks like React, Vue, or Angular to build more complex user interfaces efficiently.', '2025-06-11 12:09:51', '2025-06-11 12:10:58');

-- --------------------------------------------------------

--
-- Table structure for table `lesson_user_progress`
--

CREATE TABLE `lesson_user_progress` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `lesson_id` int(11) DEFAULT NULL,
  `quiz_passed` tinyint(1) DEFAULT 0,
  `completed_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lesson_user_progress`
--

INSERT INTO `lesson_user_progress` (`id`, `user_id`, `lesson_id`, `quiz_passed`, `completed_at`) VALUES
(9, 9, 8, 1, '2025-06-12 06:42:41'),
(10, 9, 11, 1, '2025-06-12 07:13:52'),
(12, 8, 11, 1, '2025-06-12 08:41:58'),
(13, 10, 9, 1, '2025-06-12 08:46:59'),
(16, 8, 7, 1, '2025-06-13 07:19:34'),
(17, 8, 12, 1, '2025-06-13 07:20:05'),
(18, 5, 8, 1, '2025-06-13 10:25:19'),
(19, 5, 11, 1, '2025-06-13 10:25:43'),
(20, 11, 8, 1, '2025-06-13 12:25:48'),
(21, 11, 11, 1, '2025-06-13 12:26:05'),
(22, 5, 7, 1, '2025-06-14 04:54:18'),
(23, 5, 12, 1, '2025-06-14 04:54:43'),
(24, 10, 10, 1, '2025-06-14 05:45:48');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `message` text DEFAULT NULL,
  `is_read` tinyint(1) DEFAULT 0,
  `created` datetime DEFAULT current_timestamp(),
  `modified` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `user_id`, `title`, `message`, `is_read`, `created`, `modified`) VALUES
(4, 7, 'Start learning ', 'Start learning the course as you haven\'t started it yet', 1, '2025-06-14 04:51:08', '2025-06-14 04:51:30'),
(5, 5, 'Congratulations message', 'Congratulations on holding your 1st position keep on learning and growing ', 1, '2025-06-14 05:51:53', '2025-06-14 05:56:12');

-- --------------------------------------------------------

--
-- Table structure for table `quizzes`
--

CREATE TABLE `quizzes` (
  `id` int(11) NOT NULL,
  `lesson_id` int(11) DEFAULT NULL,
  `question` text DEFAULT NULL,
  `option_a` varchar(255) DEFAULT NULL,
  `option_b` varchar(255) DEFAULT NULL,
  `option_c` varchar(255) DEFAULT NULL,
  `option_d` varchar(255) DEFAULT NULL,
  `correct_option` char(1) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `quizzes`
--

INSERT INTO `quizzes` (`id`, `lesson_id`, `question`, `option_a`, `option_b`, `option_c`, `option_d`, `correct_option`, `created`, `modified`) VALUES
(1, 8, '1)  What is a vulnerability in the context of IT systems?', 'A feature added to improve user experience', 'A form of antivirus software', 'A weakness in a system that can be exploited by attackers', 'A system backup method', 'C', '2025-06-11 05:47:38', '2025-06-11 06:18:04'),
(2, 8, '2)  What is a zero-day vulnerability?', 'A flaw that is fixed on the day it is discovered', 'A vulnerability that is known but not yet patched', 'A vulnerability exploited before it becomes publicly known', 'A bug found only on the last day of testing', 'C', '2025-06-11 05:52:57', '2025-06-11 06:18:24'),
(3, 8, '3)  How can user error contribute to system vulnerabilities?', 'By rewriting system code to protect the system', 'By applying too many updates', 'By enabling vulnerable features or using default passwords', 'By using only trusted applications', 'C', '2025-06-11 05:53:45', '2025-06-11 06:18:34'),
(4, 8, '4)  What is an example of a flaw-based vulnerability?', 'Leaving a phone unattended', 'Poorly designed or implemented software', 'Strong password use', 'Applying all security patches', 'B', '2025-06-11 05:55:13', '2025-06-11 06:18:44'),
(5, 8, '5)  Why are web applications often targeted by attackers?', 'They are always offline', 'They are not connected to the Internet', 'They have built-in antivirus', 'They are accessible through the Internet by design', 'D', '2025-06-11 05:56:12', '2025-06-11 06:18:53'),
(6, 7, 'What is the primary purpose of HTML?', 'To add animations to a website', 'To manage databases', 'To define the structure and content of a web page', 'To encrypt website data', 'C', '2025-06-11 08:46:42', '2025-06-11 08:46:42'),
(7, 7, 'Which language is used to control the presentation and layout of a website?', 'HTML ', 'CSS', 'Java', 'MySQL', 'B', '2025-06-11 08:47:22', '2025-06-11 08:47:22'),
(8, 7, 'How does CSS enhance HTML?', 'It replaces HTML tags', 'It controls the behavior of backend scripts', 'It improves security', 'It styles HTML elements like colors, fonts, and spacing', 'D', '2025-06-11 08:48:07', '2025-06-11 08:48:07'),
(9, 7, 'What is the benefit of separating HTML and CSS?', 'It slows down the loading of web pages', 'It improves code organization and reusability', 'It prevents user interaction', 'It eliminates the need for JavaScript', 'B', '2025-06-11 08:49:04', '2025-06-11 08:49:17'),
(10, 7, 'Which of the following is NOT a way to apply CSS to a webpage?', 'Inline', 'Internal', 'Database Query', 'External', 'C', '2025-06-11 08:50:27', '2025-06-11 08:50:27'),
(11, 9, 'What makes Python a good choice for beginners?', 'Complicated syntax', 'Requires more code for simple tasks', 'Clean and readable syntax', 'Only works on Windows', 'C', '2025-06-11 08:53:54', '2025-06-11 08:53:54'),
(12, 9, 'Which of the following is a use of Python?', 'Image compression only', 'Data analysis', 'Mobile network setup', 'BIOS programming', 'B', '2025-06-11 08:54:39', '2025-06-11 08:54:39'),
(13, 9, 'What type of programming language is Python?', 'Low-level, compiled', 'Assembly-based', 'High-level, interpreted', 'Markup language', 'C', '2025-06-11 08:55:34', '2025-06-11 08:55:34'),
(14, 9, 'How is Python code executed?', 'All at once by a compiler', 'Only after uploading to a server', 'Line by line by an interpreter', 'Using a spreadsheet tool', 'C', '2025-06-11 08:56:15', '2025-06-11 08:56:15'),
(15, 9, 'Which programming paradigms does Python support?', 'Only object-oriented', 'Only functional', 'Procedural, object-oriented, and functional ', 'None of the above', 'C', '2025-06-11 08:57:20', '2025-06-11 08:57:20'),
(16, 10, 'What is the purpose of conditional statements in Python?', 'To import external libraries', 'To repeat blocks of code', 'To make decisions based on conditions', 'To define variables', 'C', '2025-06-11 09:00:39', '2025-06-11 09:00:39'),
(17, 10, 'Which of the following is NOT a valid conditional keyword in Python?', 'if', 'when', 'else', 'elif', 'B', '2025-06-11 09:01:26', '2025-06-14 05:42:38'),
(18, 10, 'Which loop is best when the number of iterations is known?', 'if', 'for', 'while', 'loop', 'B', '2025-06-11 09:01:52', '2025-06-11 09:01:52'),
(19, 10, 'What will happen if you forget to indent the code inside a loop or conditional?', 'It will run faster', 'Nothing will happen', 'Python will raise an error', 'It will automatically indent', 'C', '2025-06-11 09:02:55', '2025-06-11 09:02:55'),
(20, 10, 'What condition causes a while loop to continue executing?', 'When the loop counter is not used', 'As long as the condition is True', 'When the condition is False', 'Only one time, regardless of the condition', 'B', '2025-06-11 09:22:40', '2025-06-11 09:22:40'),
(21, 11, 'What is the goal of a phishing attack?', 'To physically damage hardware', 'To steal sensitive information by pretending to be a trusted source ', 'To install antivirus software', 'To upgrade user accounts', 'B', '2025-06-11 10:10:58', '2025-06-11 10:10:58'),
(22, 11, 'What does malware typically do?', 'Protect a system from hackers', 'Improve software performance', 'Perform malicious actions like stealing data or damaging systems', 'Clean up temporary files', 'C', '2025-06-11 10:11:41', '2025-06-11 10:11:41'),
(23, 11, 'What is a Denial of Service (DoS) attack designed to do?', 'Encrypt files for backup', 'Make a network or service unavailable', 'Test server speed', 'Block email spam', 'B', '2025-06-11 10:12:28', '2025-06-11 10:12:28'),
(24, 11, 'In a Man-in-the-Middle attack, what does the attacker do?', 'Floods a network with data', 'Steals physical devices', ' Intercepts communication between two parties', 'Bypasses CAPTCHA forms', 'C', '2025-06-11 10:13:22', '2025-06-11 10:13:22'),
(25, 11, 'What is the purpose of an SQL injection attack?', 'To change the webpage layout', 'To modify or access a website’s database using malicious SQL code', 'To reset user passwords', 'To scan open ports', 'B', '2025-06-11 10:14:26', '2025-06-11 10:14:26'),
(26, 12, '1)  What is the main purpose of JavaScript in web development?', 'Styling the web page', 'Structuring the page', 'Adding interactivity to the web page', 'Storing data in databases', 'C', '2025-06-11 12:11:57', '2025-06-11 12:17:45'),
(27, 12, 'What does the Document Object Model (DOM) allow JavaScript to do?', 'Change colors in CSS files', 'Store information in cookies', 'Interact with and change HTML and CSS dynamically', 'Encrypt website data', 'C', '2025-06-11 12:13:35', '2025-06-11 12:13:35'),
(28, 12, 'Which of the following is a JavaScript framework?', 'Bootstrap', 'React', 'MySQL', 'Python', 'B', '2025-06-11 12:14:12', '2025-06-11 12:14:12'),
(29, 12, 'After learning JavaScript, what should a developer learn to build complete web applications?', 'Photo editing', 'word processing tools', 'Database Query', 'Backend', 'D', '2025-06-11 12:15:12', '2025-06-11 12:15:12'),
(30, 12, 'Apart from browser console where can we run javascript code', 'NodeJS', 'ReactJS', 'AngularJS', 'VueJS', 'A', '2025-06-11 12:16:56', '2025-06-11 12:16:56');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `rating` tinyint(4) NOT NULL CHECK (`rating` between 1 and 5),
  `comment` text DEFAULT NULL,
  `created` datetime DEFAULT current_timestamp(),
  `modified` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `course_id`, `user_id`, `rating`, `comment`, `created`, `modified`) VALUES
(3, 8, 10, 4, 'Great course to learn', '2025-06-07 03:32:06', '2025-06-07 03:32:06'),
(7, 10, 11, 4, 'Testing review\r\n', '2025-06-09 12:11:40', '2025-06-09 12:11:40'),
(8, 10, 8, 4, 'Outstanding place to learn anything you want ', '2025-06-09 12:35:45', '2025-06-09 12:38:53'),
(9, 7, 7, 5, 'Excellent', '2025-06-10 03:49:50', '2025-06-10 03:49:50'),
(10, 10, 9, 5, 'testing \r\n', '2025-06-10 04:55:23', '2025-06-10 04:55:23'),
(11, 10, 5, 5, 'Great course ', '2025-06-13 10:26:53', '2025-06-13 10:26:53');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created` datetime DEFAULT current_timestamp(),
  `modified` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `role` varchar(20) DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `created`, `modified`, `role`) VALUES
(5, 'user1', 'user1@gmail.com', '$2y$10$BOy2wQvEXY7DoS4o//jga.9CRJrRc8CQQsL../dIN1GxnVjySABgm', '2025-06-06 03:34:15', '2025-06-06 03:34:15', 'user'),
(6, 'admin', 'admin@gmail.com', '$2y$10$7u3pcMeX7PLs6B2HibwNhusZJwLTUaEfDcp1GRkRk2F.kuOmvgwFq', '2025-06-06 10:02:22', '2025-06-06 16:43:29', 'admin'),
(7, 'user2', 'user2@gmail.com', '$2y$10$NO6hJDKPZZxydvnxKb/1vOMiA2gSx.1pud0qStws6KWf40HBKq6Fm', '2025-06-06 10:02:36', '2025-06-06 10:02:36', 'user'),
(8, 'user3', 'user3@gmail.com', '$2y$10$U7teSS6EMtRAHgl2PRd4LOMf6UEZOmqMLoZi8SllT58C0lEqy3/ga', '2025-06-06 10:03:33', '2025-06-06 10:03:33', 'user'),
(9, 'user4', 'user4@gmail.com', '$2y$10$X7z9zW19yfB3m/hvrjWK.OHnuAKXahz/B.9Asf.Ocj3fMpqOUQslW', '2025-06-06 10:03:48', '2025-06-06 10:03:48', 'user'),
(10, 'user6', 'user6@gmail.com', '$2y$10$nIOtgHPpmMtf1d6L4tHe1eChU5maywcfRKzJ6kEz1Ax6qLnKCD8Yy', '2025-06-06 12:05:30', '2025-06-06 12:05:30', 'user'),
(11, 'user5', 'user5@gmail.com', '$2y$10$39HDmqa8AG4rU7XVnxrpCutDp5poh6L.RSPMVkc5r.Rf5VaDqWVKy', '2025-06-07 04:13:39', '2025-06-07 04:13:39', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `certificates`
--
ALTER TABLE `certificates`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`,`course_id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `enrollments`
--
ALTER TABLE `enrollments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `course_id` (`course_id`);

--
-- Indexes for table `lessons`
--
ALTER TABLE `lessons`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course_id` (`course_id`);

--
-- Indexes for table `lesson_contents`
--
ALTER TABLE `lesson_contents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lesson_id` (`lesson_id`);

--
-- Indexes for table `lesson_user_progress`
--
ALTER TABLE `lesson_user_progress`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`,`lesson_id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `quizzes`
--
ALTER TABLE `quizzes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course_id` (`course_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `certificates`
--
ALTER TABLE `certificates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `enrollments`
--
ALTER TABLE `enrollments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `lessons`
--
ALTER TABLE `lessons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `lesson_contents`
--
ALTER TABLE `lesson_contents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `lesson_user_progress`
--
ALTER TABLE `lesson_user_progress`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `quizzes`
--
ALTER TABLE `quizzes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `enrollments`
--
ALTER TABLE `enrollments`
  ADD CONSTRAINT `enrollments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `enrollments_ibfk_2` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `lessons`
--
ALTER TABLE `lessons`
  ADD CONSTRAINT `lessons_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`);

--
-- Constraints for table `lesson_contents`
--
ALTER TABLE `lesson_contents`
  ADD CONSTRAINT `lesson_contents_ibfk_1` FOREIGN KEY (`lesson_id`) REFERENCES `lessons` (`id`);

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
