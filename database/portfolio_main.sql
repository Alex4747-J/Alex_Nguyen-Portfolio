-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Feb 28, 2026 at 07:00 AM
-- Server version: 8.0.40
-- PHP Version: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `portfolio_main`
--

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `contact_id` int NOT NULL,
  `contact_name` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `contact_email` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `contact_message` text COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`contact_id`, `contact_name`, `contact_email`, `contact_message`, `created_at`) VALUES
(1, 'test', 'email@email.com', 'aslkdjasdd', '2026-02-26 07:45:26'),
(2, 'asd,kjasdk', 'email@email.com', '123456', '2026-02-26 16:10:31'),
(3, 'asd', 'email@email.com', 'askdasjd', '2026-02-27 14:40:27'),
(4, 'asdad', 'email@email.com', 'sdfsad', '2026-02-27 17:15:31'),
(5, 'asdad', 'email@email.com', 'sdfsad', '2026-02-27 17:18:07'),
(6, 'qwqe', 'email@email.com', 'asdasd', '2026-02-27 17:19:29'),
(7, 'CTA Subscriber', 'email@email.com', 'Subscribed via CTA form', '2026-02-27 18:25:25'),
(8, 'CTA Subscriber', 'asdasd@email.com', 'Subscribed via CTA form', '2026-02-27 19:35:05'),
(9, 'dasdasd', 'sadasdasds@sdkasmda.com', 'sjdjkdek', '2026-02-27 19:44:37'),
(10, 'CTA Subscriber', 'a_nguyen253716@fanshaweonline.ca', 'Subscribed via CTA form', '2026-02-27 22:35:03'),
(11, 'ad;la,sd', 'asdlkmasd@email.com', 'askdmad', '2026-02-27 22:35:14');

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` int NOT NULL,
  `title` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `slug` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `short_desc` text COLLATE utf8mb4_general_ci,
  `description` text COLLATE utf8mb4_general_ci,
  `problem` text COLLATE utf8mb4_general_ci,
  `research` text COLLATE utf8mb4_general_ci,
  `solution` text COLLATE utf8mb4_general_ci,
  `duration_value` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `duration_desc` text COLLATE utf8mb4_general_ci,
  `video_src` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `video_poster` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `video_title` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `thumbnail_sm` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `thumbnail_md` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `thumbnail_lg` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `featured_label` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `gallery_title` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `gallery_subtitle` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `title`, `slug`, `short_desc`, `description`, `problem`, `research`, `solution`, `duration_value`, `duration_desc`, `video_src`, `video_poster`, `video_title`, `thumbnail_sm`, `thumbnail_md`, `thumbnail_lg`, `featured_label`, `gallery_title`, `gallery_subtitle`, `created_at`) VALUES
(1, 'Gekk Earbuds', 'gekk-earbuds', 'A project where I had to create a strong earbuds branding website for my own 3D creation.', 'This is a project that requires a harmony between handling Design and Coding. This is one of my personally most favourite piece in all of my projects thus far. Gekk was one of my proudest creation, though there were many challenges mostly in the 3D department, and I ended up making another model for the last submission. Overall it was a great project, including Branding, Design, Motion Design and Web Development\r\n', 'The initial 3D model I created lacked visual impact—it felt incomplete without a charging case and the overall design wasn\'t appealing enough to represent the vibrant, quirky brand identity I envisioned. To make matters more challenging, when I attempted to export the model to GLB format for web integration, rendering errors made it unusable. I needed to completely redesign the product while maintaining a tight deadline and ensuring the final model would work seamlessly on the website.', 'I drew inspiration from Gekko, the colorful and energetic agent from Valorant, which shaped the entire brand direction—vibrant, playful, and unapologetically bold. My research into the earbuds market revealed an opportunity: most products target mainstream consumers with sleek, minimalist designs. By going the opposite direction with wild colors and unconventional shapes, I could carve out a niche for people who love quirky, statement-making accessories. I also studied ergonomic designs and discovered that a rounded back could improve ear grip and comfort.', 'I started fresh in Cinema 4D, designing a completely new earbud model featuring a distinctive rounded back for better ear grip and a matching charging case that completed the product story. The color palette embraced the \"hippie\" aesthetic—bold, vibrant, and impossible to ignore. For the web experience, I carefully optimized the 3D export process to avoid the previous GLB rendering issues. The promotional video was crafted in After Effects to capture the playful energy of the brand, while the website itself was built with clean, semantic HTML, Sass for maintainable styling, and JavaScript for smooth interactions—all designed in Figma first to ensure a cohesive visual experience.', '1 week', 'From scrapping the original model to delivering a complete brand package—3D product, motion graphics, and a fully functional website—all within one intensive week of creative problem-solving.', 'video/Earbuds.webm', 'images/earbuds_poster.webp', 'Gekk Earbuds Promotional Video', 'images/earbuds/gekk_thumbnail_S.jpg', 'images/earbuds/gekk_thumbnail_M.jpg', 'images/earbuds/gekk_thumbnail_L.jpg', NULL, 'The Hall of Fame', 'A gallery showing my work in process and products', '2026-02-24 04:20:12'),
(2, 'Dr.Nut Rebranding', 'drnut-rebranding', 'A project where the main challenge lies in how I re-create an old decayed brand into its new skin.', 'This was the project that I had the most fun with in Summer Sem of 2025. It includes a whole rebranding of several \"dead\" brands, and the professor challenged us to find a way a re-new it. I chose Dr.Nut, well, because of the name overall, it was funny and had a ring to the ear. Just like the Gekk Earbuds project, I also scrapped the idea of the first logo, and then went ahead and created a new one. I was then sastisfied with the result. In the end, I gained a lot of fun time, first of all, and also how to create a brand guidline from scratch!', 'Dr.Nut was a beloved soda brand from the 1960s that faded into obscurity by the 1970s. The challenge was to resurrect this \"dead\" brand and give it a fresh identity that could compete in today\'s market. My first logo attempt fell short—it lacked the visual appeal and energy needed to bring this nostalgic brand back to life. As my professor Jarrod pointed out, the initial color scheme lacked the vibrancy necessary to connect with customers and stand out on store shelves.', 'I dove deep into the history of Dr.Nut and 1960s soda branding, studying what made brands from that era memorable. My research revealed that successful beverage brands balance nostalgia with modern appeal—they need to feel familiar yet fresh. I also analyzed current market trends and discovered that retro-inspired designs with vibrant colors perform exceptionally well, especially when targeting a broad audience from children to adults. The key insight was that friendliness and fun needed to be at the core of the rebrand.', 'I scrapped the original logo and started fresh with a completely new direction—embracing a retro aesthetic with significantly more vibrant colors that pop off the shelf. The new logo prioritizes fluidity and friendliness, making it approachable for all ages while honoring the brand\'s 1960s roots. I developed a comprehensive brand package: a detailed brand guideline document ensuring consistency, eye-catching can label designs ready for production, promotional posters that capture the fun spirit of the brand, and a dynamic promotional video crafted in After Effects. The 3D can mockups were rendered in Cinema 4D, while the entire visual identity was designed in Figma and Illustrator, with a website built using HTML, CSS, and JavaScript to showcase the rebrand.', '1 month', 'A comprehensive rebranding journey—from researching a forgotten 1960s soda to delivering a complete brand identity system including logo, guidelines, packaging, promotional materials, motion graphics, and a showcase website.', 'video/Drnut.webm', 'images/Drnut_poster.webp', 'Dr.Nut Promotional Video', 'images/drnut/drnut_thumbnail_S.jpg', 'images/drnut/drnut_thumbnail_M.jpg', 'images/drnut/drnut_thumbnail_L.jpg', 'Branding', 'The Hall of Fame', 'A gallery showing my work in process and products', '2026-02-24 04:20:20');

-- --------------------------------------------------------

--
-- Table structure for table `project_gallery`
--

CREATE TABLE `project_gallery` (
  `id` int NOT NULL,
  `project_id` int NOT NULL,
  `image_sm` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `image_md` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `image_lg` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `alt_text` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `project_gallery`
--

INSERT INTO `project_gallery` (`id`, `project_id`, `image_sm`, `image_md`, `image_lg`, `alt_text`) VALUES
(1, 1, 'images/earbuds/earbuds_gallery1_S.jpg', 'images/earbuds/earbuds_gallery1_M.jpg', 'images/earbuds/earbuds_gallery1_L.jpg', 'Earbuds Gallery Image 1'),
(2, 1, 'images/earbuds/earbuds_gallery2_S.jpg', 'images/earbuds/earbuds_gallery2_M.jpg', 'images/earbuds/earbuds_gallery2_L.jpg', 'Earbuds Gallery Image 2'),
(3, 1, 'images/earbuds/earbuds_gallery3_S.jpg', 'images/earbuds/earbuds_gallery3_M.jpg', 'images/earbuds/earbuds_gallery3_L.jpg', 'Earbuds Gallery Image 3'),
(4, 1, 'images/earbuds/earbuds_gallery4_S.jpg', 'images/earbuds/earbuds_gallery4_M.jpg', 'images/earbuds/earbuds_gallery4_L.jpg', 'Earbuds Gallery Image 4'),
(5, 2, 'images/drnut/drnut_gallery1_S.jpg', 'images/drnut/drnut_gallery1_M.jpg', 'images/drnut/drnut_gallery1_L.jpg', 'Dr.Nut Gallery Image 1'),
(6, 2, 'images/drnut/drnut_gallery2_S.jpg', 'images/drnut/drnut_gallery2_M.jpg', 'images/drnut/drnut_gallery2_L.jpg', 'Dr.Nut Gallery Image 2'),
(7, 2, 'images/drnut/drnut_gallery3_S.jpg', 'images/drnut/drnut_gallery3_M.jpg', 'images/drnut/drnut_gallery3_L.jpg', 'Dr.Nut Gallery Image 3'),
(8, 2, 'images/drnut/drnut_gallery4_S.jpg', 'images/drnut/drnut_gallery4_M.jpg', 'images/drnut/drnut_gallery4_L.jpg', 'Dr.Nut Gallery Image 4');

-- --------------------------------------------------------

--
-- Table structure for table `project_tags`
--

CREATE TABLE `project_tags` (
  `id` int NOT NULL,
  `project_id` int NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `sort_order` int DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `project_tags`
--

INSERT INTO `project_tags` (`id`, `project_id`, `name`, `sort_order`) VALUES
(1, 1, 'Web Design', 1),
(2, 1, 'Development', 2),
(3, 1, 'UI/UX', 3),
(4, 1, '3D Modeling', 4),
(5, 1, 'Motion Design', 5),
(6, 1, 'Branding', 6),
(7, 2, 'Branding', 1),
(8, 2, 'Logo Design', 2),
(9, 2, 'Packaging', 3),
(10, 2, 'Motion Design', 4),
(11, 2, 'Web Development', 5);

-- --------------------------------------------------------

--
-- Table structure for table `project_tools`
--

CREATE TABLE `project_tools` (
  `id` int NOT NULL,
  `project_id` int NOT NULL,
  `tool_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `project_tools`
--

INSERT INTO `project_tools` (`id`, `project_id`, `tool_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 1, 4),
(5, 1, 5),
(6, 1, 6),
(7, 2, 1),
(8, 2, 2),
(9, 2, 3),
(10, 2, 4),
(11, 2, 5),
(12, 2, 6),
(13, 2, 8);

-- --------------------------------------------------------

--
-- Table structure for table `tools`
--

CREATE TABLE `tools` (
  `id` int NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `icon_url` varchar(500) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tools`
--

INSERT INTO `tools` (`id`, `name`, `icon_url`) VALUES
(1, 'Figma', 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/figma/figma-original.svg'),
(2, 'Cinema 4D', 'https://cdn.simpleicons.org/cinema4d/5C2D91'),
(3, 'After Effects', 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/aftereffects/aftereffects-original.svg'),
(4, 'HTML5', 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/html5/html5-original.svg'),
(5, 'Sass', 'https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/sass/sass-original.svg'),
(6, 'JavaScript', 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/javascript/javascript-original.svg'),
(7, 'Illustrator', 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/illustrator/illustrator-plain.svg'),
(8, 'CSS3', 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/css3/css3-original.svg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `username` varchar(120) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(1, 'admin', '$2y$10$9fsDSITRP.ummvJm7aZTQe5cClQ5UOtfSGyXCFmicwGhmn8jxFf/C');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`contact_id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Indexes for table `project_gallery`
--
ALTER TABLE `project_gallery`
  ADD PRIMARY KEY (`id`),
  ADD KEY `project_id` (`project_id`);

--
-- Indexes for table `project_tags`
--
ALTER TABLE `project_tags`
  ADD PRIMARY KEY (`id`),
  ADD KEY `project_id` (`project_id`);

--
-- Indexes for table `project_tools`
--
ALTER TABLE `project_tools`
  ADD PRIMARY KEY (`id`),
  ADD KEY `project_id` (`project_id`),
  ADD KEY `tool_id` (`tool_id`);

--
-- Indexes for table `tools`
--
ALTER TABLE `tools`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `contact_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `project_gallery`
--
ALTER TABLE `project_gallery`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `project_tags`
--
ALTER TABLE `project_tags`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `project_tools`
--
ALTER TABLE `project_tools`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tools`
--
ALTER TABLE `tools`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `project_gallery`
--
ALTER TABLE `project_gallery`
  ADD CONSTRAINT `project_gallery_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `project_tags`
--
ALTER TABLE `project_tags`
  ADD CONSTRAINT `project_tags_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `project_tools`
--
ALTER TABLE `project_tools`
  ADD CONSTRAINT `project_tools_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `project_tools_ibfk_2` FOREIGN KEY (`tool_id`) REFERENCES `tools` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
