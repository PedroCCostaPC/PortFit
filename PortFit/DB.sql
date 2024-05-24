-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 24/05/2024 às 14:48
-- Versão do servidor: 10.4.28-MariaDB
-- Versão do PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `portfit2`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `blog`
--

CREATE TABLE `blog` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` varchar(200) NOT NULL,
  `published` date NOT NULL,
  `banner` varchar(100) NOT NULL,
  `post` text DEFAULT NULL,
  `views` int(11) DEFAULT NULL,
  `situation` tinyint(1) NOT NULL,
  `employee_id` int(11) UNSIGNED NOT NULL,
  `category_id` int(11) UNSIGNED NOT NULL,
  `send_email` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `blog`
--

INSERT INTO `blog` (`id`, `title`, `published`, `banner`, `post`, `views`, `situation`, `employee_id`, `category_id`, `send_email`) VALUES
(7, 'Porque comer mais frutas!', '2023-08-03', 'blog2023_08_03_10_06_41.jpg', '                                                        <h1><font color=\"#191919\">What is Lorem Ipsum?</font></h1><p><font color=\"#191919\"><br></font></p><p><font color=\"#191919\">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has <strong>survived </strong>not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</font></p><p><br></p><p><br></p><h2><font color=\"#191919\">Why do we use it?</font></h2><p><font color=\"#191919\"><br></font></p><p><font color=\"#191919\">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</font></p><p><br></p><p><br></p><p><br></p><h2><font color=\"#191919\">Where does it come from?</font></h2><p><font color=\"#191919\"><br></font></p><p><font color=\"#191919\">Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source.&nbsp;</font></p><p><font color=\"#191919\"><br></font></p><ul><li><font color=\"#191919\">Lorem Ipsum comes from sections 1.10.32 and&nbsp;</font></li><li><font color=\"#191919\">1.10.33 of \"de Finibus Bonorum et Malorum\"&nbsp;</font></li><li><font color=\"#191919\">(The Extremes of Good and Evil) by Cicero,</font></li><li><font color=\"#191919\">&nbsp;written in 45 BC. This book is a treatise&nbsp;</font></li><li><font color=\"#191919\">on the theory of ethics, very popular during&nbsp;</font></li><li><font color=\"#191919\">the Renaissance. The first line of Lorem Ipsum,&nbsp;</font></li><li><font color=\"#191919\">\"Lorem ipsum dolor sit amet..\", comes&nbsp;</font></li><li><font color=\"#191919\">from a line in section 1.10.32.</font></li></ul>                            \r\n                                                                        ', 4, 1, 2, 2, 0),
(8, 'Por que beber mais água', '2023-08-03', 'blog2023_08_03_11_24_47.jpg', '<h2 style=\"letter-spacing: 0.7px;\"><font color=\"#191919\">What is Lorem Ipsum?</font></h2><p style=\"letter-spacing: 0.7px;\"><font color=\"#191919\"><br></font></p><p style=\"letter-spacing: 0.7px;\"><font color=\"#191919\">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</font></p><p style=\"letter-spacing: 0.7px;\"><br></p><p style=\"letter-spacing: 0.7px;\"><br></p><p style=\"letter-spacing: 0.7px;\"><br></p><h2 style=\"letter-spacing: 0.7px;\"><font color=\"#191919\">Why do we use it?</font></h2><p style=\"letter-spacing: 0.7px;\"><font color=\"#191919\"><br></font></p><p style=\"letter-spacing: 0.7px;\"><font color=\"#191919\">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</font></p>', 8, 1, 3, 2, 0),
(12, 'Treinar abdome', '2023-08-07', 'blog2023_08_07_14_41_53.png', '<h2><font color=\"#191919\">What is Lorem Ipsum?</font></h2><p><font color=\"#191919\"><br></font></p><p><font color=\"#191919\">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</font></p><p><br></p><p><br></p><p><br></p><h2><font color=\"#191919\">Why do we use it?</font></h2><p><font color=\"#191919\"><br></font></p><p><font color=\"#191919\">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</font></p>', 6, 1, 2, 8, 0),
(13, 'Benefícios do peixe', '2023-08-14', 'blog2023_08_14_09_22_50.jpg', '                                                        <h2 style=\"margin-bottom: 10px; font-family: DauphinPlain; font-size: 24px; line-height: 24px;\">What is Lorem Ipsum?</h2><p style=\"margin-bottom: 15px; margin-left: 0px; text-align: justify;\"><span style=\"color: rgb(25, 25, 25);\">Lorem Ipsum</span>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries,<strong> but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages</strong>, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p><p style=\"margin-bottom: 15px; margin-left: 0px; text-align: justify;\"><br></p><h2 style=\"margin-bottom: 10px; font-family: DauphinPlain; font-size: 24px; line-height: 24px;\">Why do we use it?</h2><p style=\"padding: 0px; margin: 0px 0px 15px; box-sizing: border-box; font-family: Lato; font-weight: 400; color: rgb(0, 0, 0); text-align: justify;\">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>                            \r\n                                                                        ', 269, 1, 3, 2, 0),
(14, 'Creatina', '2023-08-14', 'blog2023_08_14_09_53_02.png', '                                                        <h2 style=\"margin-bottom: 10px; font-family: DauphinPlain; letter-spacing: 0.7px; font-size: 24px; line-height: 24px;\">What is Lorem Ipsum?</h2><h2 style=\"margin-bottom: 10px; font-family: DauphinPlain; font-size: 24px; line-height: 24px;\"><p style=\"margin-bottom: 15px; margin-left: 0px; font-size: 14px; letter-spacing: 0.7px; text-align: justify;\"><span style=\"color: rgb(25, 25, 25);\">Lorem Ipsum</span>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p></h2><h2 style=\"margin-bottom: 10px; font-family: DauphinPlain; letter-spacing: 0.7px; font-size: 24px; line-height: 24px;\">Why do we use it?</h2><h2 style=\"margin-bottom: 10px; font-family: DauphinPlain; font-size: 24px; line-height: 24px;\"><p style=\"margin-bottom: 15px; margin-left: 0px; font-size: 14px; letter-spacing: 0.7px; text-align: justify;\">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p><p style=\"font-size: 14px; letter-spacing: 0.7px;\"><br open=\"\" sans\",=\"\" arial,=\"\" sans-serif;=\"\" letter-spacing:=\"\" normal;=\"\" text-align:=\"\" center;=\"\" background-color:=\"\" rgb(255,=\"\" 255,=\"\" 255);\"=\"\" style=\"color: rgb(0, 0, 0); clear: both;\"></p></h2><h2 style=\"margin-bottom: 10px; font-family: DauphinPlain; letter-spacing: 0.7px; font-size: 24px; line-height: 24px;\">Where does it come from?</h2><h2 style=\"margin-bottom: 10px; font-family: DauphinPlain; font-size: 24px; line-height: 24px;\"><p style=\"margin-bottom: 15px; margin-left: 0px; font-size: 14px; letter-spacing: 0.7px; text-align: justify;\">Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.</p></h2>                            \r\n                                                                        ', 1, 1, 2, 3, 0),
(15, 'BCAA', '2023-08-14', 'blog2023_08_14_09_53_42.png', '                            <h2 style=\"margin-bottom: 10px; font-family: DauphinPlain; letter-spacing: 0.7px; font-size: 24px; line-height: 24px;\">What is Lorem Ipsum?</h2><h2 style=\"margin-bottom: 10px; font-family: DauphinPlain; font-size: 24px; line-height: 24px;\"><p style=\"margin-bottom: 15px; margin-left: 0px; font-size: 14px; letter-spacing: 0.7px; text-align: justify;\"><span style=\"color: rgb(25, 25, 25);\">Lorem Ipsum</span>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p></h2><h2 style=\"margin-bottom: 10px; font-family: DauphinPlain; letter-spacing: 0.7px; font-size: 24px; line-height: 24px;\">Why do we use it?</h2><h2 style=\"margin-bottom: 10px; font-family: DauphinPlain; font-size: 24px; line-height: 24px;\"><p style=\"margin-bottom: 15px; margin-left: 0px; font-size: 14px; letter-spacing: 0.7px; text-align: justify;\">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p></h2>                            \r\n                                                ', 0, 1, 2, 3, 0),
(16, 'Carne Vermelha', '2023-08-14', 'blog2023_08_14_09_54_12.jpg', '<h2 style=\"margin-bottom: 10px; font-family: DauphinPlain; font-size: 24px; line-height: 24px;\">What is Lorem Ipsum?</h2><p style=\"margin-bottom: 15px; margin-left: 0px; text-align: justify;\"><span style=\"color: rgb(25, 25, 25);\">Lorem Ipsum</span>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p><h2 style=\"margin-bottom: 10px; font-family: DauphinPlain; font-size: 24px; line-height: 24px;\">Why do we use it?</h2><p></p><p style=\"padding: 0px; margin: 0px 0px 15px; box-sizing: border-box; font-family: Lato; font-weight: 400; color: rgb(0, 0, 0); text-align: justify;\">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>                            \r\n                        ', 13, 1, 2, 2, 0),
(17, 'Porque Tomar Whey Protein', '2023-08-14', 'blog2023_08_14_09_54_51.jpg', '                                                        <h2 style=\"margin-bottom: 10px; font-family: DauphinPlain; font-size: 24px; line-height: 24px;\">What is Lorem Ipsum?</h2><p style=\"margin-bottom: 15px; margin-left: 0px; text-align: justify;\"><span style=\"color: rgb(25, 25, 25);\">Lorem Ipsum</span> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p><h2 style=\"margin-bottom: 10px; font-family: DauphinPlain; font-size: 24px; line-height: 24px;\">Why do we use it?</h2><p></p><p style=\"padding: 0px; margin: 0px 0px 15px; box-sizing: border-box; font-family: Lato; font-weight: 400; color: rgb(0, 0, 0); text-align: justify;\">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>                            \r\n                                                                        ', 20, 1, 2, 3, 0),
(41, 'Leg Press', '2023-08-17', 'blog2023_08_17_10_08_27.jpg', '<h2 style=\"letter-spacing: 0.7px;\"><font color=\"#191919\">What is Lorem Ipsum?</font></h2><p style=\"letter-spacing: 0.7px;\"><font color=\"#191919\"><br></font></p><p style=\"letter-spacing: 0.7px;\"><font color=\"#191919\">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</font></p><p style=\"letter-spacing: 0.7px;\"><br></p><p style=\"letter-spacing: 0.7px;\"><br></p><p style=\"letter-spacing: 0.7px;\"><br></p><h2 style=\"letter-spacing: 0.7px;\"><font color=\"#191919\">Why do we use it?</font></h2><p style=\"letter-spacing: 0.7px;\"><font color=\"#191919\"><br></font></p><p style=\"letter-spacing: 0.7px;\"><font color=\"#191919\">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</font></p>                            \r\n                        ', 0, 1, 3, 4, 0),
(42, 'Verduras e seus benefícios', '2023-08-17', 'blog2023_08_17_10_10_29.jpg', '<h2 style=\"letter-spacing: 0.7px;\"><font color=\"#191919\">What is Lorem Ipsum?</font></h2><p style=\"letter-spacing: 0.7px;\"><font color=\"#191919\"><br></font></p><p style=\"letter-spacing: 0.7px;\"><font color=\"#191919\">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</font></p><p style=\"letter-spacing: 0.7px;\"><br></p><p style=\"letter-spacing: 0.7px;\"><br></p><p style=\"letter-spacing: 0.7px;\"><br></p><h2 style=\"letter-spacing: 0.7px;\"><font color=\"#191919\">Why do we use it?</font></h2><p style=\"letter-spacing: 0.7px;\"><font color=\"#191919\"><br></font></p><p style=\"letter-spacing: 0.7px;\"><font color=\"#191919\">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</font></p>                            \r\n                        ', 0, 1, 3, 2, 0),
(43, 'Os benefícios da vitamina C para a saúde', '2023-08-17', 'blog2023_08_17_10_12_32.jpg', '<h2 style=\"letter-spacing: 0.7px;\"><font color=\"#191919\">What is Lorem Ipsum?</font></h2><p style=\"letter-spacing: 0.7px;\"><font color=\"#191919\"><br></font></p><p style=\"letter-spacing: 0.7px;\"><font color=\"#191919\">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</font></p><p style=\"letter-spacing: 0.7px;\"><br></p><p style=\"letter-spacing: 0.7px;\"><br></p><p style=\"letter-spacing: 0.7px;\"><br></p><h2 style=\"letter-spacing: 0.7px;\"><font color=\"#191919\">Why do we use it?</font></h2><p style=\"letter-spacing: 0.7px;\"><font color=\"#191919\"><br></font></p><p style=\"letter-spacing: 0.7px;\"><font color=\"#191919\">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</font></p>                            \r\n                        ', 10, 1, 3, 2, 0),
(44, 'Vitamina D', '2023-08-17', 'blog2023_08_17_10_15_11.jpg', '<h2 style=\"letter-spacing: 0.7px;\"><font color=\"#191919\">What is Lorem Ipsum?</font></h2><p style=\"letter-spacing: 0.7px;\"><font color=\"#191919\"><br></font></p><p style=\"letter-spacing: 0.7px;\"><font color=\"#191919\">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</font></p><p style=\"letter-spacing: 0.7px;\"><br></p><p style=\"letter-spacing: 0.7px;\"><br></p><p style=\"letter-spacing: 0.7px;\"><br></p><h2 style=\"letter-spacing: 0.7px;\"><font color=\"#191919\">Why do we use it?</font></h2><p style=\"letter-spacing: 0.7px;\"><font color=\"#191919\"><br></font></p><p style=\"letter-spacing: 0.7px;\"><font color=\"#191919\">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</font></p>                            \r\n                        ', 0, 1, 3, 2, 0),
(45, 'Por que fazer Musculação', '2023-08-17', 'blog2023_08_17_10_26_28.jpg', '<h2 style=\"letter-spacing: 0.7px;\"><font color=\"#191919\">What is Lorem Ipsum?</font></h2><p style=\"letter-spacing: 0.7px;\"><font color=\"#191919\"><br></font></p><p style=\"letter-spacing: 0.7px;\"><font color=\"#191919\">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</font></p><p style=\"letter-spacing: 0.7px;\"><br></p><p style=\"letter-spacing: 0.7px;\"><br></p><p style=\"letter-spacing: 0.7px;\"><br></p><h2 style=\"letter-spacing: 0.7px;\"><font color=\"#191919\">Why do we use it?</font></h2><p style=\"letter-spacing: 0.7px;\"><font color=\"#191919\"><br></font></p><p style=\"letter-spacing: 0.7px;\"><font color=\"#191919\">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</font></p>                            \r\n                        ', 1, 1, 3, 20, 0),
(46, 'Boxe', '2023-08-17', 'blog2023_08_17_10_28_05.jpg', '<h2 style=\"letter-spacing: 0.7px;\"><font color=\"#191919\">What is Lorem Ipsum?</font></h2><p style=\"letter-spacing: 0.7px;\"><font color=\"#191919\"><br></font></p><p style=\"letter-spacing: 0.7px;\"><font color=\"#191919\">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</font></p><p style=\"letter-spacing: 0.7px;\"><br></p><p style=\"letter-spacing: 0.7px;\"><br></p><p style=\"letter-spacing: 0.7px;\"><br></p><h2 style=\"letter-spacing: 0.7px;\"><font color=\"#191919\">Why do we use it?</font></h2><p style=\"letter-spacing: 0.7px;\"><font color=\"#191919\"><br></font></p><p style=\"letter-spacing: 0.7px;\"><font color=\"#191919\">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</font></p>                            \r\n                        ', 0, 1, 3, 20, 0),
(47, 'Salada', '2023-08-17', 'blog2023_08_17_10_32_03.jpg', '<h2 style=\"letter-spacing: 0.7px;\"><font color=\"#191919\">What is Lorem Ipsum?</font></h2><p style=\"letter-spacing: 0.7px;\"><font color=\"#191919\"><br></font></p><p style=\"letter-spacing: 0.7px;\"><font color=\"#191919\">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</font></p><p style=\"letter-spacing: 0.7px;\"><br></p><p style=\"letter-spacing: 0.7px;\"><br></p><p style=\"letter-spacing: 0.7px;\"><br></p><h2 style=\"letter-spacing: 0.7px;\"><font color=\"#191919\">Why do we use it?</font></h2><p style=\"letter-spacing: 0.7px;\"><font color=\"#191919\"><br></font></p><p style=\"letter-spacing: 0.7px;\"><font color=\"#191919\">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</font></p>                            \r\n                        ', 3, 1, 3, 2, 0),
(48, 'Alimentação Saudável', '2023-08-17', 'blog2023_08_17_10_34_25.jpg', '<h2 style=\"letter-spacing: 0.7px;\"><font color=\"#191919\">What is Lorem Ipsum?</font></h2><p style=\"letter-spacing: 0.7px;\"><font color=\"#191919\"><br></font></p><p style=\"letter-spacing: 0.7px;\"><font color=\"#191919\">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</font></p><p style=\"letter-spacing: 0.7px;\"><br></p><p style=\"letter-spacing: 0.7px;\"><br></p><h2 style=\"letter-spacing: 0.7px;\"><font color=\"#191919\">Why do we use it?</font></h2><p style=\"letter-spacing: 0.7px;\"><font color=\"#191919\"><br></font></p><p style=\"letter-spacing: 0.7px;\"><font color=\"#191919\">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</font></p>                            \r\n                        ', 11, 1, 3, 2, 1),
(84, 'Teste', '2023-12-11', 'blog_2024_02_16_09_02_39.png', 'asd asdasd', 6, 1, 2, 37, 0);

-- --------------------------------------------------------

--
-- Estrutura para tabela `blog_category`
--

CREATE TABLE `blog_category` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `blog_category`
--

INSERT INTO `blog_category` (`id`, `name`) VALUES
(8, 'Abdome'),
(2, 'Alimentação'),
(20, 'Atividade Física'),
(7, 'Peito'),
(4, 'Perna'),
(3, 'Suplementos'),
(37, 'Teste');

-- --------------------------------------------------------

--
-- Estrutura para tabela `blog_comment`
--

CREATE TABLE `blog_comment` (
  `id` int(11) UNSIGNED NOT NULL,
  `comment` text NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `date` date NOT NULL,
  `blog_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `blog_comment`
--

INSERT INTO `blog_comment` (`id`, `comment`, `name`, `email`, `date`, `blog_id`) VALUES
(1, 'Teste Comentario aqui!', 'Quase Nada', 'quasenada@email.com', '2023-08-15', 17),
(3, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 'Rosa Rumorosa', 'rosarumorosa@email.com', '2023-08-15', 13),
(27, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'Pedro Cesar', 'pedro.ccosta@hotmail.com', '2023-12-08', 17),
(28, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'Joao Raimundo', 'joao@teste.com', '2023-12-08', 43),
(29, 'teste', 'Pedro Cesar', 'pedro.ccosta@hotmail.com', '2023-12-19', 13),
(30, 'asdasd as dawegtbhtynjytujuyity ujtg dfgbdfgb sdf bdrfgb ', 'Alma Negra', 'almanegra@email.com', '2023-12-19', 13);

-- --------------------------------------------------------

--
-- Estrutura para tabela `cargos`
--

CREATE TABLE `cargos` (
  `ID` int(11) UNSIGNED NOT NULL,
  `nome` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `contact`
--

CREATE TABLE `contact` (
  `id` int(11) UNSIGNED NOT NULL,
  `ddd` int(2) DEFAULT NULL,
  `phone` int(9) DEFAULT NULL,
  `dddSapp` int(2) DEFAULT NULL,
  `whatsapp` int(9) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `unit_id` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `contact`
--

INSERT INTO `contact` (`id`, `ddd`, `phone`, `dddSapp`, `whatsapp`, `email`, `unit_id`) VALUES
(1, 11, 930102315, 11, 930102315, 'pedro.ccosta@hotmail.com', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `email`
--

CREATE TABLE `email` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `student` tinyint(1) NOT NULL,
  `ddd` int(2) DEFAULT NULL,
  `phone` int(9) DEFAULT NULL,
  `message` text NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `view` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `email`
--

INSERT INTO `email` (`id`, `name`, `email`, `student`, `ddd`, `phone`, `message`, `date`, `time`, `view`) VALUES
(1, 'Quase Nada', 'quasenada@email.com', 0, 11, 123456789, 'What is Lorem Ipsum?\r\nLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '2023-08-10', '13:18:54', 0),
(2, 'Alma negra', 'almanegra@email.com', 1, 22, 98765432, 'thrt hrth rthr th wtrh wrth wrt w', '2023-08-10', '13:19:34', 0),
(3, 'Poucas Trancas', 'poucastrancas@email.com', 1, NULL, NULL, 'Teste contato', '2023-08-11', '12:05:59', 0),
(4, 'Rosa Rumorosa', 'rosarumorosa@email.com', 0, 11, 12345678, 'What is Lorem Ipsum?\r\nLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\r\n\r\nWhy do we use it?\r\nIt is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).\r\n\r\n\r\nWhere does it come from?\r\nContrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.', '2023-08-11', '16:40:11', 1),
(12, 'Teste Email', 'essetes@email.com', 0, 11, 12345678, 'asd asd asdasd asasas sd', '2023-12-07', '10:09:56', 1),
(13, 'Raimundo Joao', 'joao@teste.com', 1, NULL, NULL, 'erge rger hgrtbnfgnfgndf gn ghmn dghmndmndtgyjmndthmndfg mndfgtn dfgn dfgn', '2023-12-07', '10:10:42', 1),
(14, 'Vito Corleone', 'vitocorleone@email.com', 0, NULL, NULL, 'aasda a fweg esrhnydtgn', '2023-12-07', '10:17:45', 1),
(15, 'Pedro Cesar', 'teste@email.com', 1, 11, 12345678, 'asd asd asdasddv ergwretbrgrtb ertb ertbtrbnert b ertbertbrtgb rtbertb ret bertb erbghnjhm uk,i lo,. o.ui jk,yujm iu,ujkm, ', '2023-12-08', '18:29:29', 0),
(16, 'Teste', 'teste@email.com', 0, NULL, NULL, 'asda asdasdasd as da', '2023-12-11', '08:32:17', 0),
(17, 'Novo Teste', 'essetes@email.com', 0, NULL, NULL, 'asd asda dasdasd asdas', '2023-12-11', '08:33:14', 0),
(18, 'Teste', 'teste@email.com', 0, NULL, NULL, 'asdasd asd asda sd ', '2023-12-14', '19:26:22', 0),
(19, 'Teste', 'teste@create2.com', 0, 22, 12345678, 'Testando front-end', '2023-12-18', '09:54:32', 0),
(20, 'Pedro Cesar', 'pedro.ccosta@hotmail.com', 0, 11, 12345678, 'asd asdas dasd asd asd asd asd asd adasd', '2023-12-18', '12:29:47', 0),
(21, 'Raimundo', 'raimunda@email.com', 1, NULL, NULL, 'asdasd asd asd asdsdfvgnkik,i, iu uik,iuk, juk, k, k, ', '2023-12-18', '12:33:57', 0),
(22, 'Quase Nada', 'quasenada@email.com', 1, NULL, NULL, 'fghjfyjyu kyukgyukuik gyuk gyuk yuk gyukgyukyukwsqawdA SDASD ASD ASD ASD ', '2023-12-18', '14:29:24', 0),
(23, 'Mensal', 'almanegra@email.com', 0, 11, 123456789, 'dcvgb   gh gjmghj ghn n dfgb nrbn5tn  6tyny', '2023-12-18', '19:03:14', 1),
(24, 'Teste', 'pedro.ccosta@hotmail.com', 0, NULL, NULL, 'asd', '2023-12-20', '10:46:27', 1),
(25, 'Novo Teste', 'almanegra@email.com', 0, NULL, NULL, 'asfdasf gbdgndt GGGGGGGGG', '2023-12-20', '10:46:42', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `employees`
--

CREATE TABLE `employees` (
  `id` int(11) UNSIGNED NOT NULL,
  `firstName` varchar(100) NOT NULL,
  `lastName` varchar(100) NOT NULL,
  `fullName` varchar(200) NOT NULL,
  `birth` date NOT NULL,
  `sex` tinyint(1) DEFAULT NULL,
  `rg` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `ddd` int(2) DEFAULT NULL,
  `phone` int(9) DEFAULT NULL,
  `password` varchar(100) NOT NULL,
  `photo` varchar(100) DEFAULT NULL,
  `situation` tinyint(1) DEFAULT NULL,
  `position_id` int(11) UNSIGNED DEFAULT NULL,
  `token` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `employees`
--

INSERT INTO `employees` (`id`, `firstName`, `lastName`, `fullName`, `birth`, `sex`, `rg`, `email`, `ddd`, `phone`, `password`, `photo`, `situation`, `position_id`, `token`) VALUES
(2, 'Pedro', 'Cesar Costa', 'Pedro Cesar Costa', '1995-05-18', 1, '100000012', 'pedro.ccosta@hotmail.com', 11, 12345678, '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'photo_2024_01_10_10_01_01.jpg', 1, 1, NULL),
(3, 'Vito', 'Corleone', 'Vito Corleone', '1887-04-29', 1, '100000020', 'vitocorleone@email.com', 11, 123456789, '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'photo_2024_01_10_09_01_50.jpg', 1, 2, NULL),
(7, 'Ellen', 'Ripley', 'Ellen Ripley', '1983-05-10', 0, '100000029cf', 'ellenripley@email.com', NULL, NULL, '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'employees_72023_08_15_14_04_00.jpg', 1, 2, NULL),
(8, 'Freddy ', 'Krueger', 'Freddy  Krueger', '1960-10-10', 1, '100rt0020', 'freddy@email.com', NULL, NULL, '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'employees_82023_08_17_11_17_21.jpg', 1, 3, NULL),
(9, 'Cersei', 'Lannister', 'Cersei Lannister', '1979-01-01', 0, '565jh65h56h5', 'cersei@email.com', 11, 12345678, '40bd001563085fc35165329ea1ff5c5ecbdbbeef', NULL, 1, 3, NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `exam`
--

CREATE TABLE `exam` (
  `id` int(11) UNSIGNED NOT NULL,
  `height` int(3) NOT NULL,
  `weight` int(3) NOT NULL,
  `idealWeight` int(3) NOT NULL,
  `leanMass` int(3) NOT NULL,
  `idealLeanMass` int(3) NOT NULL,
  `fatMass` int(3) NOT NULL,
  `idealFatMass` int(3) NOT NULL,
  `tbw` int(3) NOT NULL,
  `idealTbw` int(3) NOT NULL,
  `ecw` int(3) NOT NULL,
  `idealEcw` int(3) NOT NULL,
  `icw` int(3) NOT NULL,
  `idealIcw` int(3) NOT NULL,
  `systolic` int(3) NOT NULL,
  `diastolic` int(3) NOT NULL,
  `smoke` varchar(10) NOT NULL,
  `alcoholic` varchar(10) NOT NULL,
  `injuries` text DEFAULT NULL,
  `allergy` text DEFAULT NULL,
  `deficiency` text DEFAULT NULL,
  `surgeries` text DEFAULT NULL,
  `pains` text DEFAULT NULL,
  `dateExam` date NOT NULL,
  `student_id` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `exam`
--

INSERT INTO `exam` (`id`, `height`, `weight`, `idealWeight`, `leanMass`, `idealLeanMass`, `fatMass`, `idealFatMass`, `tbw`, `idealTbw`, `ecw`, `idealEcw`, `icw`, `idealIcw`, `systolic`, `diastolic`, `smoke`, `alcoholic`, `injuries`, `allergy`, `deficiency`, `surgeries`, `pains`, `dateExam`, `student_id`) VALUES
(6, 173, 47, 80, 15, 60, 20, 15, 52, 55, 52, 43, 40, 57, 150, 90, 'Sim', 'Muito', 'Distensão muscular, Luxação, Fratura óssea, Entorse', 'Leite, Glúten, amendoim', '', '', 'Todas', '2015-04-07', 6),
(7, 174, 64, 80, 37, 60, 17, 15, 52, 55, 40, 43, 55, 57, 124, 89, 'Sim', 'Pouco', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '2017-09-15', 6),
(8, 174, 72, 80, 57, 60, 17, 15, 55, 55, 43, 43, 57, 57, 120, 82, 'Não', 'Não', '', '', '', '', '', '2020-06-02', 6),
(9, 175, 80, 80, 60, 60, 15, 15, 55, 55, 43, 43, 57, 57, 117, 79, 'Não', 'Não', '', '', '', '', '', '2023-08-16', 6),
(10, 180, 90, 95, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 'Não', 'Não', NULL, NULL, NULL, NULL, NULL, '2023-07-20', 7),
(11, 180, 90, 95, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 'Não', 'Não', NULL, NULL, NULL, NULL, NULL, '2023-10-20', 7),
(12, 180, 90, 95, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 'Não', 'Não', '', '', '', '', '', '2017-10-20', 5),
(20, 175, 97, 80, 51, 60, 22, 15, 57, 55, 57, 43, 60, 57, 129, 84, 'Sim', 'Muito', 'Distensão muscular, Luxação, Fratura óssea, Entorse', 'Leite, Glúten, amendoim', '', '', 'Todas', '2024-01-05', 6);

-- --------------------------------------------------------

--
-- Estrutura para tabela `exercises`
--

CREATE TABLE `exercises` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `banner` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `video` varchar(700) DEFAULT NULL,
  `external` tinyint(1) DEFAULT NULL,
  `situation` tinyint(1) DEFAULT NULL,
  `exCategory_id` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `exercises`
--

INSERT INTO `exercises` (`id`, `name`, `banner`, `description`, `video`, `external`, `situation`, `exCategory_id`) VALUES
(10, 'Leg Press', 'exercises2023_08_03_10_37_12.png', '', '', 0, 1, 8),
(14, 'Puxada Frontal', 'exercises2023_08_16_09_13_19.png', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 'exercise_2024_01_02_14_01_02.mp4', 0, 1, 9),
(15, 'Pulley Articulado', 'exercises2023_08_16_09_15_43.png', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/GgnClrx8N2k\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\" allowfullscreen></iframe>', 1, 1, 9),
(16, 'Remada Curvada', 'exercises2023_08_16_09_19_03.png', '', '', 0, 1, 9),
(17, 'Remada Cavalinho', 'exercises2023_08_16_09_24_22.png', '', '', 0, 1, 9),
(18, 'Remada Unilateral', 'exercises2023_08_16_09_25_11.png', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '', 0, 1, 9),
(19, 'Fly Inverso', 'exercises2023_08_16_09_26_15.png', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 'exercises2023_08_16_09_27_14.mp4', 0, 1, 9),
(20, 'Levantamento Terra', 'exercises2023_08_16_09_30_23.png', '', '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/GgnClrx8N2k\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\" allowfullscreen></iframe>', 1, 1, 9),
(21, 'Agachamento', 'exercises2023_08_16_09_32_26.png', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/GgnClrx8N2k\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\" allowfullscreen></iframe>', 1, 1, 8),
(22, 'Extensora', 'exercises2023_08_16_09_33_55.png', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 'exercises2023_08_16_09_33_55.mp4', 0, 1, 8),
(24, 'Stiff', 'exercises2023_08_16_09_37_45.png', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/RbmS3tQJ7Os\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\" allowfullscreen></iframe>', 1, 1, 8),
(25, 'Flexora Deitada', 'exercises2023_08_16_09_39_24.png', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/RbmS3tQJ7Os\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\" allowfullscreen></iframe>', 1, 1, 8),
(26, 'Agachamento No Rack', 'exercises2023_08_16_09_42_40.png', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/RbmS3tQJ7Os\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\" allowfullscreen></iframe>', 1, 1, 8),
(27, 'Supino Inclinado Com Halteres', 'exercises2023_08_16_09_44_59.png', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '', 0, 1, 10),
(28, 'Supino Reto Com Halteres', 'exercises2023_08_16_09_46_40.png', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '', 0, 1, 10),
(29, 'Supino Inclinado Com Barra', 'exercises2023_08_16_09_46_58.png', '', '', 0, 1, 10),
(30, 'Supino Reto Com Barra', 'exercises2023_08_16_09_48_08.png', '', '', 0, 1, 10),
(31, 'Voador No Cabo Com Banco Inclinado', 'exercises2023_08_16_09_49_14.png', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 'exercises2023_08_16_09_49_14.mp4', 0, 1, 10),
(32, 'Peck Deck', 'exercises2023_08_16_09_50_46.jpg', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/RbmS3tQJ7Os\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\" allowfullscreen></iframe>', 1, 1, 10),
(33, 'Peito Nas Paralelas', 'exercises2023_08_16_09_52_28.jpg', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/86URGgqONvA\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\" allowfullscreen></iframe>', 1, 1, 10),
(34, 'Elevação Lateral', 'exercises2023_08_16_09_54_43.jpg', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/86URGgqONvA\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\" allowfullscreen></iframe>', 1, 1, 11),
(35, 'Elevação Frontal', 'exercises2023_08_16_09_57_03.png', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/RVUK2rtAkJE\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\" allowfullscreen></iframe>', 1, 1, 11),
(36, 'Encolhimento De Ombros', 'exercises2023_08_16_09_58_34.jpg', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 'exercises2023_08_16_09_58_34.mp4', 0, 1, 11),
(37, 'Arnold Press', 'exercises2023_08_16_09_59_50.png', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '', 0, 1, 11),
(38, 'Remada Alta No Cross', 'exercises2023_08_16_10_01_03.jpg', '', '', 0, 1, 11),
(39, 'Rotação Externa De Ombros', 'exercises2023_08_16_10_02_53.png', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/nJYdDmUvgok\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\" allowfullscreen></iframe>', 1, 1, 11),
(40, 'Elevação Unilateral No Cross', 'exercises2023_08_16_10_04_39.jpg', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '', 0, 1, 11),
(41, 'Rosca Bíceps Direta Com Barra', 'exercises2023_08_16_10_07_14.jpg', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/FWQRDI7mTyw\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\" allowfullscreen></iframe>', 1, 1, 12),
(42, 'Rosca Bíceps Direta Com Halteres', 'exercises2023_08_16_10_08_06.jpg', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '', 0, 1, 12),
(43, 'Rosca Bíceps Martelo Em Pé Com Halteres', 'exercises2023_08_16_10_10_07.jpg', '', '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/FWQRDI7mTyw\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\" allowfullscreen></iframe>', 1, 1, 12),
(44, 'Rosca Bíceps Em Pé Na Barra EZ', 'exercises2023_08_16_10_11_36.jpg', '', '', 0, 1, 12),
(45, 'Rosca Bíceps No Cabo E Usando A Corda', 'exercises2023_08_16_10_12_57.jpg', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/qEnF6EB-yMs\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\" allowfullscreen></iframe>', 1, 1, 12),
(46, 'Rosca Bíceps Concentrada Unilateral', 'exercises2023_08_16_10_14_03.jpg', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/qEnF6EB-yMs\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\" allowfullscreen></iframe>', 1, 1, 12),
(47, 'Rosca Bíceps Apoiado No Banco Scott', 'exercises2023_08_16_10_15_03.jpg', '', '', 0, 1, 12),
(48, 'Tríceps Corda', 'exercises2023_08_16_10_17_07.jpg', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/skdE0KAFCEA\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\" allowfullscreen></iframe>', 1, 1, 13),
(49, 'Tríceps Testa', 'exercises2023_08_16_10_18_11.jpg', '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/skdE0KAFCEA\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\" allowfullscreen></iframe>', '', 0, 1, 13),
(50, 'Mergulho Em Barras Paralelas', 'exercises2023_08_16_10_19_01.jpg', '', '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/q31WY0Aobro\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\" allowfullscreen></iframe>', 1, 1, 13),
(51, 'Tríceps Na Polia Com Barra', 'exercises2023_08_16_10_21_04.jpg', '', '', 0, 1, 13),
(52, 'Tríceps Coice Com Halter', 'exercises2023_08_16_10_22_19.jpg', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/1DWiB7ZuLvI\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\" allowfullscreen></iframe>', 1, 1, 13),
(53, 'Tríceps Francês', 'exercises2023_08_16_10_23_19.jpg', '', '', 0, 1, 13),
(54, 'Tríceps Coice Na Polia', 'exercises2023_08_16_10_24_24.jpg', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/1DWiB7ZuLvI\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\" allowfullscreen></iframe>', 1, 1, 13),
(55, 'Rosca De Punho', 'exercises2023_08_16_10_26_21.jpg', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/2AYB-Gjo6cU\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\" allowfullscreen></iframe>', 1, 1, 14),
(56, 'Rosca De Punho Invertido', 'exercises2023_08_16_10_27_48.jpg', '', '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/2AYB-Gjo6cU\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\" allowfullscreen></iframe>', 1, 1, 14),
(57, 'Abdominal Supra', 'exercises2023_08_16_10_29_53.jpg', '', '', 0, 1, 15),
(58, 'Abdominal Infra', 'banner_2024_02_16_09_02_43.png', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/w_cpYEjM330\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\" allowfullscreen></iframe>', 1, 1, 15),
(59, 'Abdominal Cruzado', 'exercises2023_08_16_10_32_30.jpg', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/RbmS3tQJ7Os?si=QuooJXn8tlNtqLBy\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\" allowfullscreen></iframe>', 1, 1, 15),
(60, 'Abdominal em v', 'banner_2023_11_29_10_11_59.jpg', '', '', 0, 1, 15);

-- --------------------------------------------------------

--
-- Estrutura para tabela `ex_category`
--

CREATE TABLE `ex_category` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `ex_category`
--

INSERT INTO `ex_category` (`id`, `name`) VALUES
(15, 'Abdominal'),
(14, 'Antebraço'),
(12, 'Bíceps'),
(9, 'Costa'),
(11, 'Ombro'),
(10, 'Peito'),
(8, 'Perna'),
(13, 'Tríceps');

-- --------------------------------------------------------

--
-- Estrutura para tabela `food`
--

CREATE TABLE `food` (
  `id` int(11) UNSIGNED NOT NULL,
  `day` int(2) NOT NULL,
  `time` time DEFAULT NULL,
  `food` text DEFAULT NULL,
  `student_id` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `food`
--

INSERT INTO `food` (`id`, `day`, `time`, `food`, `student_id`) VALUES
(8, 1, '12:00:00', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 6),
(9, 1, '15:00:00', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 6),
(10, 1, '18:00:00', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 6),
(13, 1, '09:00:00', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 6),
(14, 2, '12:15:00', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 6),
(15, 2, '15:00:00', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 6),
(16, 2, '18:00:00', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 6),
(17, 2, '21:21:00', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 6),
(18, 2, '06:30:00', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 6),
(19, 2, '09:00:00', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 6),
(20, 3, '12:00:00', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 6),
(21, 3, '15:00:00', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 6),
(22, 3, '18:00:00', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 6),
(23, 3, '21:00:00', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 6),
(24, 3, '06:00:00', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 6),
(25, 3, '09:00:00', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 6),
(26, 4, '12:00:00', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 6),
(27, 4, '15:00:00', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 6),
(28, 4, '18:00:00', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 6),
(29, 4, '21:22:00', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 6),
(30, 4, '06:00:00', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 6),
(31, 4, '09:00:00', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 6),
(36, 6, '10:00:00', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 6),
(37, 6, '13:00:00', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 6),
(38, 6, '17:30:00', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 6),
(39, 6, '20:30:00', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 6),
(40, 5, '12:30:00', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 6),
(41, 5, '16:00:00', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 6),
(42, 5, '19:30:00', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 6),
(43, 5, '06:22:00', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 6),
(44, 5, '09:21:00', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 6),
(45, 1, '06:00:00', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 6),
(58, 1, '21:00:00', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 6),
(61, 1, '01:00:00', 'asdasf ae grh yftu tfy', 4);

-- --------------------------------------------------------

--
-- Estrutura para tabela `modalities`
--

CREATE TABLE `modalities` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(30) NOT NULL,
  `summary` varchar(250) NOT NULL,
  `phrase` varchar(100) NOT NULL,
  `about` varchar(1500) NOT NULL,
  `whyte` varchar(1500) NOT NULL,
  `banner` varchar(100) NOT NULL,
  `image` varchar(100) NOT NULL,
  `situation` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `modalities`
--

INSERT INTO `modalities` (`id`, `name`, `summary`, `phrase`, `about`, `whyte`, `banner`, `image`, `situation`) VALUES
(1, 'Musculação', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. ', 'Lorem Ipsum is simply dummy text of the printing and', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum. ', 'banner2023_08_07_09_09_04.jpg', 'image2023_08_07_08_50_37.jpg', 1),
(2, 'Muay Thai', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. ', 'Lorem Ipsum is simply dummy text of the printing and ', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.  ', 'banner2023_08_07_08_53_38.jpg', 'image2023_08_07_08_53_38.jpg', 1),
(3, 'Zumba', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. ', 'Lorem Ipsum is simply dummy text of the printing and', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum. ', 'banner2023_08_07_08_55_29.jpg', 'image2023_08_07_08_55_29.jpg', 1),
(6, 'Natação', 'Texto de resumo das aulas de natação', 'Lorem Ipsum is simply dummy text of the printing and', 'Como são as aulas de natação', 'por que fazer as aulas de natação', 'banner_2023_08_28_14_08_20.jpg', 'image_2023_08_29_12_08_15.jpg', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `photos`
--

CREATE TABLE `photos` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `unit_id` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `photos`
--

INSERT INTO `photos` (`id`, `name`, `unit_id`) VALUES
(1, 'photo_1_2023_08_10_09_14_31.jpg', 1),
(2, 'photo_2_2023_08_10_09_14_31.jpg', 1),
(3, 'photo_3_2023_08_10_09_14_31.jpg', 1),
(4, 'photo_4_2023_08_10_09_14_31.jpg', 1),
(5, 'photo_5_2023_08_10_09_14_31.jpg', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `positions`
--

CREATE TABLE `positions` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `positions`
--

INSERT INTO `positions` (`id`, `name`) VALUES
(1, 'Boss'),
(2, 'Administrador'),
(3, 'Editor');

-- --------------------------------------------------------

--
-- Estrutura para tabela `prices`
--

CREATE TABLE `prices` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `time` int(2) NOT NULL,
  `price` float NOT NULL,
  `month` tinyint(1) NOT NULL,
  `situation` tinyint(1) NOT NULL,
  `emphasis` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `prices`
--

INSERT INTO `prices` (`id`, `name`, `time`, `price`, `month`, `situation`, `emphasis`) VALUES
(1, 'Mensal', 1, 90.99, 1, 1, 0),
(2, 'Anual', 1, 800.5, 0, 1, 1),
(3, 'Bimestral', 2, 130.07, 1, 1, 0),
(7, 'Trimestral', 3, 195, 1, 1, 0),
(8, 'Semestral', 6, 399.99, 1, 1, 0),
(9, 'Mensal', 1, 70, 1, 1, 0),
(10, 'Bienal', 2, 1600, 0, 1, 0),
(12, 'Semestral', 6, 15.55, 1, 1, 0);

-- --------------------------------------------------------

--
-- Estrutura para tabela `scheme_price`
--

CREATE TABLE `scheme_price` (
  `id` int(11) UNSIGNED NOT NULL,
  `scheme` varchar(200) NOT NULL,
  `price_id` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `scheme_price`
--

INSERT INTO `scheme_price` (`id`, `scheme`, `price_id`) VALUES
(39, 'Musculação', 3),
(40, '1 avaliação fisica', 3),
(41, 'Musculação', 7),
(43, 'Musculação', 2),
(44, 'Musculação', 9),
(48, 'Musculação', 1),
(49, 'Yoga', 1),
(50, 'Zumba', 1),
(51, 'Musculação', 8),
(53, 'Musculação', 10),
(68, 'Boxe', 12),
(69, 'Musculação', 12),
(70, 'Matricula grátis', 12),
(85, 'Teste', 7),
(88, 'Muay Thai', 2),
(89, 'Box', 2),
(90, 'Karatê', 2);

-- --------------------------------------------------------

--
-- Estrutura para tabela `social`
--

CREATE TABLE `social` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `icon` varchar(100) DEFAULT NULL,
  `link` text DEFAULT NULL,
  `unit_id` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `social`
--

INSERT INTO `social` (`id`, `name`, `icon`, `link`, `unit_id`) VALUES
(4, 'Facebook', 'social_2023_07_31_11_19_55.png', 'https://pt-br.facebook.com/', 1),
(5, 'Twitter', 'social_2023_07_31_11_20_08.png', 'https://twitter.com/', 1),
(6, 'Instagram', 'social_2023_07_31_11_20_20.png', 'https://www.instagram.com/', 1),
(7, 'YouTube', 'social_2023_07_31_11_31_06.png', 'https://www.youtube.com/', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `students`
--

CREATE TABLE `students` (
  `id` int(11) UNSIGNED NOT NULL,
  `firstName` varchar(100) NOT NULL,
  `lastName` varchar(100) NOT NULL,
  `fullName` varchar(200) NOT NULL,
  `birth` date NOT NULL,
  `sex` tinyint(1) NOT NULL,
  `rg` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `ddd` int(2) DEFAULT NULL,
  `phone` int(9) DEFAULT NULL,
  `password` varchar(100) NOT NULL,
  `photo` varchar(100) DEFAULT NULL,
  `situation` tinyint(1) DEFAULT NULL,
  `token` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `students`
--

INSERT INTO `students` (`id`, `firstName`, `lastName`, `fullName`, `birth`, `sex`, `rg`, `email`, `ddd`, `phone`, `password`, `photo`, `situation`, `token`) VALUES
(4, 'Quase', 'Nada', 'Quase Nada', '1970-01-15', 1, '100000029cf', 'quasenada@email.com', NULL, NULL, '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'students_42023_08_03_12_11_51.png', 1, NULL),
(5, 'Rosa', 'Rumorosa', 'Rosa Rumorosa', '1989-03-15', 0, '100000028', 'rosarumorosa@email.com', 22, 987654321, '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'students_52023_08_16_11_48_53.png', 1, NULL),
(6, 'Alma', 'Negra', 'Alma Negra', '1978-12-11', 1, '100000029c', 'almanegra@email.com', 33, 12345678, '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'photo_2023_12_11_11_12_54.png', 1, NULL),
(7, 'Poucas', 'Trancas', 'Poucas Trancas', '1980-06-05', 1, '100000024', 'poucastrancas@email.com', NULL, NULL, '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'students_72023_08_16_11_49_17.png', 1, NULL),
(12, 'Tony ', 'Montana', 'Tony  Montana', '1999-03-07', 0, '100000029123123', 'tony@email.com', 11, 12345678, 'fb3ab677d93524a6804119a721a9c7d60e499a50', NULL, 1, NULL),
(17, 'Ferris', 'Bueller', 'Ferris Bueller', '1800-01-01', 1, '10000002934rt3', 'ferris@hotmail.com', NULL, NULL, '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'photo_2023_12_08_10_12_06.jpg', 1, NULL),
(18, 'Beatrix', 'Kiddo', 'Beatrix Kiddo', '1990-06-01', 0, 'rhryj67i67u5', 'beatrixkiddo@email.com', 22, 987654321, '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'photo_2024_01_08_12_01_15.png', 1, NULL),
(19, 'Bruxa', 'Baratuxa', 'Bruxa Baratuxa', '1989-09-20', 0, '100000029asdfasfe', 'bruxabaratuxa@email.com', 33, 12345678, '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'photo_2024_01_03_10_01_53.jpg', 1, NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `supplements`
--

CREATE TABLE `supplements` (
  `id` int(11) UNSIGNED NOT NULL,
  `day` int(2) NOT NULL,
  `time` time DEFAULT NULL,
  `supplement` text DEFAULT NULL,
  `student_id` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `supplements`
--

INSERT INTO `supplements` (`id`, `day`, `time`, `supplement`, `student_id`) VALUES
(15, 0, '10:01:00', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 6),
(16, 0, '15:00:00', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 6),
(17, 0, '20:25:00', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 6),
(36, 3, '10:00:00', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 6),
(37, 3, '15:30:00', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 6),
(38, 3, '19:00:00', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 6),
(41, 4, '01:00:00', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.\r\n\r\n\r\n', 6),
(42, 4, '09:30:00', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.\r\n\r\n\r\n', 6),
(43, 4, '15:00:00', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.\r\n\r\n\r\n', 6),
(44, 4, '17:00:00', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.\r\n\r\n\r\n', 6),
(45, 1, '15:05:00', 'asdasdasdasdas', 4);

-- --------------------------------------------------------

--
-- Estrutura para tabela `time_modality`
--

CREATE TABLE `time_modality` (
  `id` int(11) UNSIGNED NOT NULL,
  `day` int(2) NOT NULL,
  `open` time NOT NULL,
  `close` time NOT NULL,
  `modality_id` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `time_modality`
--

INSERT INTO `time_modality` (`id`, `day`, `open`, `close`, `modality_id`) VALUES
(7, 6, '10:00:00', '11:00:00', 2),
(11, 5, '09:00:00', '10:30:00', 2),
(12, 5, '15:30:00', '16:30:00', 2),
(13, 5, '19:00:00', '20:00:00', 2),
(15, 3, '10:00:00', '11:00:00', 3),
(16, 3, '15:00:00', '16:30:00', 3),
(17, 5, '10:00:00', '11:30:00', 6),
(18, 5, '19:00:00', '20:00:00', 6),
(29, 1, '06:00:00', '07:22:00', 6),
(53, 5, '22:00:00', '22:30:00', 2),
(59, 1, '10:30:00', '11:30:00', 2),
(60, 1, '17:00:00', '18:00:00', 2),
(77, 1, '08:30:00', '10:00:00', 6);

-- --------------------------------------------------------

--
-- Estrutura para tabela `training`
--

CREATE TABLE `training` (
  `id` int(11) UNSIGNED NOT NULL,
  `day` int(2) NOT NULL,
  `series` int(3) NOT NULL,
  `min` int(3) NOT NULL,
  `max` int(3) NOT NULL,
  `exercise_id` int(11) UNSIGNED DEFAULT NULL,
  `exCategory_id` int(11) UNSIGNED DEFAULT NULL,
  `student_id` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `training`
--

INSERT INTO `training` (`id`, `day`, `series`, `min`, `max`, `exercise_id`, `exCategory_id`, `student_id`) VALUES
(17, 2, 4, 20, 25, 55, 14, 6),
(18, 2, 5, 25, 30, 56, 14, 6),
(19, 2, 3, 10, 15, 47, 12, 6),
(20, 2, 3, 10, 15, 42, 12, 6),
(21, 2, 3, 10, 15, 44, 12, 6),
(22, 2, 3, 10, 15, 43, 12, 6),
(23, 2, 3, 10, 15, 32, 10, 6),
(24, 2, 3, 10, 15, 33, 10, 6),
(25, 2, 3, 10, 15, 29, 10, 6),
(26, 2, 3, 10, 15, 28, 10, 6),
(27, 3, 3, 10, 15, 19, 9, 6),
(28, 3, 3, 10, 15, 20, 9, 6),
(29, 3, 3, 10, 15, 15, 9, 6),
(30, 3, 3, 10, 15, 14, 9, 6),
(31, 3, 3, 10, 15, 17, 9, 6),
(32, 3, 3, 10, 15, 16, 9, 6),
(33, 3, 3, 10, 15, 18, 9, 6),
(34, 3, 3, 10, 15, 52, 13, 6),
(35, 3, 3, 10, 15, 54, 13, 6),
(36, 3, 3, 10, 15, 53, 13, 6),
(37, 3, 3, 10, 15, 51, 13, 6),
(38, 3, 3, 10, 15, 49, 13, 6),
(39, 5, 3, 10, 15, 60, 15, 6),
(40, 5, 3, 12, 15, 58, 15, 6),
(41, 5, 3, 10, 15, 56, 14, 6),
(42, 5, 3, 10, 15, 35, 11, 6),
(43, 5, 3, 10, 15, 34, 11, 6),
(44, 5, 3, 10, 15, 36, 11, 6),
(45, 5, 3, 10, 15, 38, 11, 6),
(46, 5, 3, 10, 15, 39, 11, 6),
(47, 5, 3, 10, 15, 21, 8, 6),
(48, 5, 3, 10, 15, 26, 8, 6),
(49, 5, 3, 10, 15, 22, 8, 6),
(50, 5, 3, 10, 15, 25, 8, 6),
(51, 5, 3, 10, 15, 10, 8, 6),
(52, 5, 3, 10, 15, 24, 8, 6),
(53, 6, 3, 10, 15, 46, 12, 6),
(54, 6, 3, 10, 15, 41, 12, 6),
(55, 6, 3, 10, 15, 44, 12, 6),
(56, 6, 3, 10, 15, 43, 12, 6),
(57, 6, 3, 10, 15, 32, 10, 6),
(58, 6, 3, 10, 15, 33, 10, 6),
(59, 6, 3, 10, 15, 30, 10, 6),
(60, 6, 3, 10, 15, 28, 10, 6),
(61, 6, 3, 10, 15, 31, 10, 6),
(62, 0, 3, 10, 15, 60, 15, 6),
(63, 0, 3, 10, 15, 58, 15, 6),
(64, 0, 3, 10, 15, 55, 14, 6),
(65, 0, 3, 10, 15, 20, 9, 6),
(66, 0, 3, 10, 15, 14, 9, 6),
(67, 0, 3, 10, 15, 17, 9, 6),
(68, 0, 3, 10, 15, 16, 9, 6),
(69, 4, 3, 25, 50, 59, 15, 6),
(72, 4, 3, 10, 15, 41, 12, 6),
(73, 4, 3, 10, 15, 42, 12, 6),
(74, 4, 3, 10, 15, 44, 12, 6),
(75, 4, 3, 10, 15, 36, 11, 6),
(76, 4, 3, 10, 15, 38, 11, 6),
(77, 4, 3, 10, 15, 39, 11, 6),
(90, 4, 3, 10, 15, 57, 15, 6),
(94, 2, 3, 10, 15, 21, 8, 4),
(95, 2, 3, 10, 15, 22, 8, 4),
(97, 4, 3, 10, 15, 21, 8, 4),
(98, 4, 3, 10, 15, 10, 8, 4),
(107, 4, 3, 10, 15, 46, 12, 4),
(108, 4, 3, 10, 15, 41, 12, 4),
(109, 4, 3, 10, 15, 44, 12, 4),
(110, 4, 3, 10, 15, 17, 9, 4),
(111, 4, 3, 10, 15, 22, 8, 4),
(112, 4, 3, 10, 15, 25, 8, 4),
(113, 2, 3, 10, 15, 59, 15, 4),
(114, 2, 3, 10, 15, 60, 15, 4),
(115, 1, 3, 10, 15, 50, 13, 4),
(116, 1, 3, 10, 15, 54, 13, 4),
(117, 1, 3, 10, 15, 51, 13, 4),
(118, 1, 4, 15, 20, 49, 13, 4);

-- --------------------------------------------------------

--
-- Estrutura para tabela `unit`
--

CREATE TABLE `unit` (
  `id` int(11) UNSIGNED NOT NULL,
  `headquarters` tinyint(1) NOT NULL,
  `banner` varchar(50) DEFAULT NULL,
  `state` varchar(100) DEFAULT NULL,
  `uf` varchar(2) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `road` varchar(100) DEFAULT NULL,
  `cep` varchar(10) DEFAULT NULL,
  `number` varchar(45) DEFAULT NULL,
  `map` text DEFAULT NULL,
  `openWeek` time DEFAULT NULL,
  `closeWeek` time DEFAULT NULL,
  `openHoliday` time DEFAULT NULL,
  `closeHoliday` time DEFAULT NULL,
  `openSaturday` time DEFAULT NULL,
  `closeSaturday` time DEFAULT NULL,
  `openSunday` time DEFAULT NULL,
  `closeSunday` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `unit`
--

INSERT INTO `unit` (`id`, `headquarters`, `banner`, `state`, `uf`, `address`, `road`, `cep`, `number`, `map`, `openWeek`, `closeWeek`, `openHoliday`, `closeHoliday`, `openSaturday`, `closeSaturday`, `openSunday`, `closeSunday`) VALUES
(1, 1, 'banner_2023_09_29_10_09_33.jpg', 'São Paulo', 'SP', 'Av. Ibirapuera', 'Indianópolis', '04029-902', '3103', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d14623.338278074274!2d-46.6666172!3d-23.6102652!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94ce5a09161d82d3%3A0xeea06a7cc702728a!2sShopping%20Ibirapuera!5e0!3m2!1spt-BR!2sbr!4v1691673891860!5m2!1spt-BR!2sbr\" width=\"600\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"></iframe>', '06:00:00', '23:00:00', '00:00:00', '00:00:00', NULL, NULL, '09:00:00', '13:00:00');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `blog`
--
ALTER TABLE `blog`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employee_id` (`employee_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Índices de tabela `blog_category`
--
ALTER TABLE `blog_category`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Índices de tabela `blog_comment`
--
ALTER TABLE `blog_comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `blog_id` (`blog_id`);

--
-- Índices de tabela `cargos`
--
ALTER TABLE `cargos`
  ADD PRIMARY KEY (`ID`);

--
-- Índices de tabela `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`),
  ADD KEY `unit_id` (`unit_id`);

--
-- Índices de tabela `email`
--
ALTER TABLE `email`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `rg` (`rg`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `position_id` (`position_id`);

--
-- Índices de tabela `exam`
--
ALTER TABLE `exam`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`);

--
-- Índices de tabela `exercises`
--
ALTER TABLE `exercises`
  ADD PRIMARY KEY (`id`),
  ADD KEY `exCategory_id` (`exCategory_id`);

--
-- Índices de tabela `ex_category`
--
ALTER TABLE `ex_category`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Índices de tabela `food`
--
ALTER TABLE `food`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`);

--
-- Índices de tabela `modalities`
--
ALTER TABLE `modalities`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `photos`
--
ALTER TABLE `photos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `unit_id` (`unit_id`);

--
-- Índices de tabela `positions`
--
ALTER TABLE `positions`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `prices`
--
ALTER TABLE `prices`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `scheme_price`
--
ALTER TABLE `scheme_price`
  ADD PRIMARY KEY (`id`),
  ADD KEY `price_id` (`price_id`);

--
-- Índices de tabela `social`
--
ALTER TABLE `social`
  ADD PRIMARY KEY (`id`),
  ADD KEY `unit_id` (`unit_id`);

--
-- Índices de tabela `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `rg` (`rg`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Índices de tabela `supplements`
--
ALTER TABLE `supplements`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`);

--
-- Índices de tabela `time_modality`
--
ALTER TABLE `time_modality`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modality_id` (`modality_id`);

--
-- Índices de tabela `training`
--
ALTER TABLE `training`
  ADD PRIMARY KEY (`id`),
  ADD KEY `exercise_id` (`exercise_id`),
  ADD KEY `exCategory_id` (`exCategory_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Índices de tabela `unit`
--
ALTER TABLE `unit`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `blog`
--
ALTER TABLE `blog`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT de tabela `blog_category`
--
ALTER TABLE `blog_category`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT de tabela `blog_comment`
--
ALTER TABLE `blog_comment`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de tabela `cargos`
--
ALTER TABLE `cargos`
  MODIFY `ID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `email`
--
ALTER TABLE `email`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de tabela `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de tabela `exam`
--
ALTER TABLE `exam`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de tabela `exercises`
--
ALTER TABLE `exercises`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT de tabela `ex_category`
--
ALTER TABLE `ex_category`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT de tabela `food`
--
ALTER TABLE `food`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT de tabela `modalities`
--
ALTER TABLE `modalities`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de tabela `photos`
--
ALTER TABLE `photos`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT de tabela `positions`
--
ALTER TABLE `positions`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `prices`
--
ALTER TABLE `prices`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de tabela `scheme_price`
--
ALTER TABLE `scheme_price`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121;

--
-- AUTO_INCREMENT de tabela `social`
--
ALTER TABLE `social`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de tabela `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de tabela `supplements`
--
ALTER TABLE `supplements`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT de tabela `time_modality`
--
ALTER TABLE `time_modality`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT de tabela `training`
--
ALTER TABLE `training`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=175;

--
-- AUTO_INCREMENT de tabela `unit`
--
ALTER TABLE `unit`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `blog`
--
ALTER TABLE `blog`
  ADD CONSTRAINT `blog_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`),
  ADD CONSTRAINT `blog_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `blog_category` (`id`);

--
-- Restrições para tabelas `blog_comment`
--
ALTER TABLE `blog_comment`
  ADD CONSTRAINT `blog_comment_ibfk_1` FOREIGN KEY (`blog_id`) REFERENCES `blog` (`id`);

--
-- Restrições para tabelas `contact`
--
ALTER TABLE `contact`
  ADD CONSTRAINT `contact_ibfk_1` FOREIGN KEY (`unit_id`) REFERENCES `unit` (`id`);

--
-- Restrições para tabelas `employees`
--
ALTER TABLE `employees`
  ADD CONSTRAINT `employees_ibfk_1` FOREIGN KEY (`position_id`) REFERENCES `positions` (`id`);

--
-- Restrições para tabelas `exam`
--
ALTER TABLE `exam`
  ADD CONSTRAINT `exam_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`);

--
-- Restrições para tabelas `exercises`
--
ALTER TABLE `exercises`
  ADD CONSTRAINT `exercises_ibfk_1` FOREIGN KEY (`exCategory_id`) REFERENCES `ex_category` (`id`);

--
-- Restrições para tabelas `food`
--
ALTER TABLE `food`
  ADD CONSTRAINT `food_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`);

--
-- Restrições para tabelas `photos`
--
ALTER TABLE `photos`
  ADD CONSTRAINT `photos_ibfk_1` FOREIGN KEY (`unit_id`) REFERENCES `unit` (`id`);

--
-- Restrições para tabelas `scheme_price`
--
ALTER TABLE `scheme_price`
  ADD CONSTRAINT `scheme_price_ibfk_1` FOREIGN KEY (`price_id`) REFERENCES `prices` (`id`);

--
-- Restrições para tabelas `social`
--
ALTER TABLE `social`
  ADD CONSTRAINT `social_ibfk_1` FOREIGN KEY (`unit_id`) REFERENCES `unit` (`id`);

--
-- Restrições para tabelas `supplements`
--
ALTER TABLE `supplements`
  ADD CONSTRAINT `supplements_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`);

--
-- Restrições para tabelas `time_modality`
--
ALTER TABLE `time_modality`
  ADD CONSTRAINT `time_modality_ibfk_1` FOREIGN KEY (`modality_id`) REFERENCES `modalities` (`id`);

--
-- Restrições para tabelas `training`
--
ALTER TABLE `training`
  ADD CONSTRAINT `training_ibfk_1` FOREIGN KEY (`exercise_id`) REFERENCES `exercises` (`id`),
  ADD CONSTRAINT `training_ibfk_2` FOREIGN KEY (`exCategory_id`) REFERENCES `ex_category` (`id`),
  ADD CONSTRAINT `training_ibfk_3` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
