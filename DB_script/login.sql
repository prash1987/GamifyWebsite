-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 30, 2017 at 01:13 AM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gamify`
--

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `User_id` varchar(128) DEFAULT NULL,
  `Password` varchar(128) DEFAULT NULL,
  `salt` varchar(128) DEFAULT NULL,
  `email_id` varchar(128) DEFAULT NULL,
  `otp` varchar(10) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`User_id`, `Password`, `salt`, `email_id`, `otp`) VALUES
('prash1987@gmail.com', '97fd239acea479c1e6e55db1ff56f90bbb149dc618478926f652ad3a8000acc9cc3e2c941539ba2ae25177dcd9b327a7f7fdfe986ef34a1f53754108fa9eca4d', '8f2899a41fc7150d182213f74ed1c7b1cb42543475daacd74b626d2e45b7d42e8ef1f05aaeac99d82e8d3fe9a6749739bf4314524ea16681f1fb3f3884f7480b', 'prash1987@gmail.com', '942596'),
('pradeep@gmail.com', 'c59b7b70b5fa2276dea0475c942c89283904ad304733898e583565a9a7bd2d4077497316d60dfc9bdb7d59282d9888f82d495a14f3bd1b67d0fc9c2c32123c40', '2eebe77c38573d9be763a0fa58af132ed019a0c8718bc00e3b65033007698ed32e2da2301afbf8ee5c605e74df40b15ca3f35012c7160a831ba3895e191af4fb', 'pradeep@gmail.com', ''),
('prakash@gmail.com', 'f6e6566b55dd85ee1ff2c1fd4197e0505ff44bc2514bc05eab7f93041528d550dc21523b6cbd62a5045b31cb1e213efc387f4952889ab2c56154836e7741258d', '3c680ef4dbf476e1547883b84dd44dc81497523c11e87dbb9f39e59496b21c83697a2cd09d0cf3929be220dbc932e9bd14804c2e45805e245fd99082dee405c4', 'prakash@gmail.com', '384545'),
('prbhat@indiana.edu', '6babf659d8671877e5c84dbfa121e1dcfe7ae9c42b68d798090c097a5838864d8c409548604f9370fb064e005c0e8f251d2c9f1e915ab68db9aa896c73a659a5', 'dc1b150fb34f296b81938d6aed1abbc77a811f95d835456d537f33fc280882a39cba7ba5031a4fb2d7d5d1a8311f4c00e56df77dc26d998eb2e33125d6d8d198', 'prbhat@indiana.edu', '230352'),
('sri@yahoo.com', 'b0a8ec3ffd82131a816ea502f4ab6324e98b27731e230469afd2a3ee6298392c44bd7e6fc3366e312dbf37071620407fc987abf031f37655a440fa0b1d7252e8', '49f5e321b0fa1b22b24aea601b3e0f010ebc65711174ec1289d62cb19c3a12e1489030159ccecc60c9c3e380883b9cde4d1f085c055690899b43ec5fc42e3088', 'sri@yahoo.com', '741574'),
('jaidevyd@gmail.com', '1a8811dc2e6b84eb3ec890c9f99bdebc3b0263899fe5ba6fb15e337075535ca0894f5df4a28661d30d6c1eea57930d9a5937ac1f63c8969141347ca02cb925fa', 'e28db6b0e2cdf0b388d14904b5b2018f22c2d722b02ad13505d140ddc9cea06fb4993416b42d51352c34139b383264327530e2ebb014ae4dae0f41171f02e3e4', 'jaidevyd@gmail.com', '715481'),
('prad92@gmail.com', '931aeb61c32ecc05f6a0f8438729050cc117cca3ab058ef6f706309416ce2390d1f5ee34d0813270dd4962d42f587e9bc5d7aabb0ff2698469695d685c00a6e0', '807961ab0f4a5bc85b73b10c2f8931f12702cb43d1c66cc1356c6c550f61a653b69329d90c0d4d5d25397506b9ae62486a8a97ee6d04a47a7481e8a7447aac22', 'prad92@gmail.com', '868246'),
('sagar.panchal11@gmail.com', '64d23911f6e1cd2064e9d3e24192a8dfba27f497871b1ec597effa27bd16017544c6cbc348d067a6266b6af1c61abda1089f8fe5b7241bd0afe7fb57fb8709aa', 'cc4d76f4afb085eab70e25dd97c5ec41b7aae99cd27e9742e1634d12ce985464729480f028c869b224d5a88bb9e2048b6670020f55521d9d5746b3d8d3d49c14', 'sagar.panchal11@gmail.com', '244415'),
('prash.kumta@gmail.com', 'efbf505aa5984a27bf1a3cc53a7bd7c3452068937c14a44af5331bd134a666e4a4a8cf06f999dd3165a6e3ccc762b2c3f3f360795aceb2fe61920e5496385a8f', 'c6fcdb776945df14fe1dfad8bf5332db02b28c0b949e5fe473f243083e2fcf04b2750cfea26ceab146dc2c7e8096b4c254e0b4b0097f86d4a332b727250b52e9', 'prash.kumta@gmail.com', '352081'),
('patilmeghesh91@gmail.com', '4da26e11e3c54edae58a27eaa0787d90b851a90c6a6ce41d75cdd59832463bc3586b58a2394d1318a09468deb32cc02c7862e190e5ad06b1fd6230d91d45b78a', '62a58d44e23083e4ca80ce0e19a3d9d3b6ab39c44c84eaec872122491444266900a9769de7e8704bea0abf8e6d8058e8ff65a20ec9b30dc017b4e871cce7af81', 'patilmeghesh91@gmail.com', '887994'),
('prash1988@gmail.com', 'c287cd5185cc1fc614c1489a15f3a61d913c0b950d36f7c354b49a8864cd791911c603ebd896fab14a6442fa81ba3e38c7862185bb9daab5794266c4cccd8ac8', '19ea8d8bb81d0c3cae242ab274252c94f578e1a3133a1378843920dcfead8c63f65d752627e2afb906e3977a0fdccbfae4550813b8f8d834df2d9783609fe161', 'prash1988@gmail.com', '552911'),
('prashant4782003@yahoo.com', '6027f079ce7e75fff23098874b720c594cb4d78d7fbc9661b48f1e0d88731ac1aecf322665faf4d298098b93f92d9e2aeef1df3a303601fd2e8bff2953386f50', '4ee30474cc53b614341fe3ba5a95ec57a1213fa0613797cad4d9225f218211adcf6968f63834b5c2f27a7ab65decfdfc7d32c127105fb1a9754e113f20e243ed', 'prashant4782003@yahoo.com', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD KEY `User_id` (`User_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
