-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Dim 31 Janvier 2016 à 10:26
-- Version du serveur :  10.1.9-MariaDB
-- Version de PHP :  5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `db_starwars`
--

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `categories`
--

INSERT INTO `categories` (`id`, `title`, `slug`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Lasers', 'lasers', 'Laser Attention les yeux !!!', '2016-01-25 14:09:08', '0000-00-00 00:00:00'),
(2, 'Casques', 'casques', 'Casque Houra !! une super portection !', '2016-01-25 14:09:08', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `customers`
--

CREATE TABLE `customers` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `address` text COLLATE utf8_unicode_ci NOT NULL,
  `number_card` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `number_command` smallint(6) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `customers`
--

INSERT INTO `customers` (`id`, `user_id`, `address`, `number_card`, `number_command`, `created_at`, `updated_at`) VALUES
(1, 1, '95395 Wolf Oval Suite 729\nWest Corrinemouth, MI 37927-6384', '5244545506264992', 4, '2016-01-25 14:09:08', '2016-01-25 14:09:08'),
(2, 2, '4262 Devon Fork\nPort Nannieside, VT 80655', '4916201259586021', 137, '2016-01-25 14:09:08', '2016-01-25 14:09:08'),
(3, 3, '4861 Davin Lane Apt. 975\nNorth Jake, ME 64865-4652', '5138342114819121', 164, '2016-01-25 14:09:08', '2016-01-25 14:09:08'),
(4, 4, '4491 Rau Court\nWebertown, PA 59305-5284', '5544400301739169', 4, '2016-01-25 14:09:08', '2016-01-25 14:09:08');

-- --------------------------------------------------------

--
-- Structure de la table `histories`
--

CREATE TABLE `histories` (
  `id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `customer_id` int(10) UNSIGNED NOT NULL,
  `price` decimal(7,2) NOT NULL,
  `quantity` smallint(6) NOT NULL,
  `command_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` enum('finalized','unfinalized') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'finalized',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `histories`
--

INSERT INTO `histories` (`id`, `product_id`, `customer_id`, `price`, `quantity`, `command_at`, `status`, `created_at`, `updated_at`) VALUES
(52, 16, 4, '150.99', 3, '2016-01-30 18:27:58', 'finalized', '2016-01-30 18:27:58', '2016-01-30 18:27:58'),
(53, 5, 4, '150.99', 3, '2016-01-30 18:27:58', 'finalized', '2016-01-30 18:27:58', '2016-01-30 18:27:58'),
(54, 8, 3, '25.99', 1, '2016-01-30 18:29:59', 'finalized', '2016-01-30 18:29:59', '2016-01-30 18:29:59'),
(55, 15, 3, '22.55', 4, '2016-01-30 18:29:59', 'finalized', '2016-01-30 18:29:59', '2016-01-30 18:29:59'),
(56, 1, 3, '15.25', 2, '2016-01-30 18:30:42', 'finalized', '2016-01-30 18:30:42', '2016-01-30 18:30:42'),
(57, 6, 3, '315.39', 1, '2016-01-30 18:30:42', 'finalized', '2016-01-30 18:30:42', '2016-01-30 18:30:42'),
(58, 2, 2, '30.19', 1, '2016-01-30 18:31:24', 'finalized', '2016-01-30 18:31:24', '2016-01-30 18:31:24'),
(59, 16, 4, '150.99', 1, '2016-01-30 19:19:54', 'finalized', '2016-01-30 19:19:54', '2016-01-30 19:19:54'),
(60, 16, 4, '150.99', 2, '2016-01-31 08:02:40', 'finalized', '2016-01-31 08:02:40', '2016-01-31 08:02:40'),
(61, 1, 2, '15.25', 2, '2016-01-31 09:06:27', 'finalized', '2016-01-31 09:06:27', '2016-01-31 09:06:27'),
(62, 3, 2, '45.25', 2, '2016-01-31 09:17:58', 'finalized', '2016-01-31 09:17:58', '2016-01-31 09:17:58');

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2014_10_12_000000_create_users_table', 1),
('2014_10_12_100000_create_password_resets_table', 1),
('2015_12_30_100136_create_table_categories_table', 1),
('2015_12_30_101640_create_table_tags_table', 1),
('2015_12_30_110826_create_products_table', 1),
('2015_12_30_114352_create_pictures_table', 1),
('2015_12_30_115407_create_product_tag_table', 1),
('2015_12_30_133246_create_customers_table', 1),
('2015_12_30_133927_create_histories_table', 1),
('2015_12_30_135556_alter_pictures_table', 1),
('2016_01_12_104401_alter_products_table', 1),
('2016_01_12_111157_alter_category_table', 1);

-- --------------------------------------------------------

--
-- Structure de la table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `pictures`
--

CREATE TABLE `pictures` (
  `id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `title` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `uri` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `size` smallint(6) NOT NULL,
  `type` enum('png','jpg','gif') COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `pictures`
--

INSERT INTO `pictures` (`id`, `product_id`, `title`, `uri`, `size`, `type`, `created_at`, `updated_at`) VALUES
(16, 1, '', 'JmKTOZWYAqWP.JPG', 19285, 'jpg', '2016-01-28 10:14:33', '2016-01-28 10:14:33'),
(17, 2, '', 'keJhvUVB9k7M.jpg', 32767, 'jpg', '2016-01-28 10:15:59', '2016-01-28 10:15:59'),
(18, 3, '', 'HtTudWOjbRkc.jpg', 15929, 'jpg', '2016-01-28 10:16:49', '2016-01-28 10:16:49'),
(19, 4, '', '6PSmrLQRpzSV.jpg', 29026, 'jpg', '2016-01-28 10:19:25', '2016-01-28 10:19:25'),
(20, 5, '', '2JJNC4k5zyOG.jpg', 32767, 'jpg', '2016-01-28 10:20:43', '2016-01-28 10:20:43'),
(21, 6, '', 'O7ufvBwjEu9I.jpg', 5024, 'jpg', '2016-01-28 10:21:35', '2016-01-28 10:21:35'),
(22, 7, '', 'VaWCBRbwtgJJ.jpg', 20965, 'jpg', '2016-01-28 10:23:16', '2016-01-28 10:23:16'),
(23, 8, '', 'QMlm71cXeURx.jpg', 9045, 'jpg', '2016-01-28 10:24:35', '2016-01-28 10:24:35'),
(24, 9, '', 'itef89bA7K0m.jpg', 17658, 'jpg', '2016-01-28 10:25:35', '2016-01-28 10:25:35'),
(27, 12, '', '51AfUpbuhZUV.jpg', 32767, 'jpg', '2016-01-28 10:31:36', '2016-01-28 10:31:36'),
(29, 14, '', 'aEFntTxyeu9n.jpg', 14131, 'jpg', '2016-01-28 10:34:28', '2016-01-28 10:34:28'),
(31, 15, '', 'ba9QIq7fhen3.jpg', 9117, 'jpg', '2016-01-28 10:48:54', '2016-01-28 10:48:54'),
(32, 13, '', '0i2DlS2beQP2.jpg', 32767, 'jpg', '2016-01-28 10:52:08', '2016-01-28 10:52:08'),
(37, 11, '', 'mJaEU9t6TcCs.jpg', 32767, 'jpg', '2016-01-28 11:05:39', '2016-01-28 11:05:39'),
(39, 16, '', 'GIrL1y9cIAsw.jpg', 32767, 'jpg', '2016-01-30 18:08:22', '2016-01-30 18:08:22');

-- --------------------------------------------------------

--
-- Structure de la table `products`
--

CREATE TABLE `products` (
  `id` int(10) UNSIGNED NOT NULL,
  `category_id` int(10) UNSIGNED DEFAULT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `abstract` text COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `price` decimal(7,2) NOT NULL,
  `quantity` smallint(5) UNSIGNED NOT NULL,
  `status` enum('opened','closed') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'opened',
  `published_at` datetime NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `products`
--

INSERT INTO `products` (`id`, `category_id`, `name`, `slug`, `abstract`, `content`, `price`, `quantity`, `status`, `published_at`, `created_at`, `updated_at`) VALUES
(1, 2, 'Mug Star Wars', 'mug-star-wars', 'Et repudiandae veniam earum autem dolorem ea voluptas ipsum. Eos voluptate et repudiandae autem explicabo.', 'Dignissimos exercitationem exercitationem est enim voluptate eos vero. Quia consectetur quis nihil qui qui et quod. Est est culpa enim. Beatae ex accusantium excepturi nam eos autem delectus. Tenetur nisi ut et ratione suscipit quibusdam mollitia. Quasi sed nulla qui veniam est laborum voluptatem dolorum. Ipsa quia quia odio et qui. Aut enim aperiam nam laborum quaerat.', '15.25', 12, 'opened', '2015-12-01 19:08:54', '2016-01-30 18:09:23', '2016-01-30 18:08:54'),
(2, 1, 'Baguettes Laser', 'baguette-laser', 'Neque ad dolore quas vitae eum. Maiores impedit sed consequatur quia est quis sunt. Laboriosam id et suscipit dolorem tempora. Perspiciatis dolores molestias est blanditiis quia nulla nesciunt.', 'Ut et eveniet voluptatem facilis consequatur adipisci. Fuga ut doloremque voluptas suscipit cum commodi mollitia. Optio corporis harum et saepe. Explicabo voluptatibus molestiae nesciunt quo optio. Sed ipsa ratione quos fuga. Voluptas libero qui est in ut consequatur corrupti. Facilis sint ratione impedit voluptatem saepe nisi quia. Ut minima sunt est et voluptas. Unde non qui exercitationem et eum. Quod non totam similique ipsa.', '30.19', 45, 'opened', '2014-12-23 11:27:12', '2016-01-30 18:09:27', '2016-01-29 10:27:12'),
(3, 2, 'Cartable triple casques', 'cartable-triple-casques', 'Id eum repellendus qui quam earum provident. Facilis tenetur fuga fuga. Laudantium quae consequuntur ipsum praesentium est animi velit. Excepturi dolores et est necessitatibus. Ut vero ex voluptas et nulla sint.', 'Molestiae repellat soluta reprehenderit voluptatum non. Officiis maiores earum perspiciatis quis. Voluptate dignissimos ipsum pariatur eum. Nostrum est architecto autem tempora asperiores autem. Possimus veritatis corrupti deserunt tenetur doloremque. Eveniet dolor autem nostrum maiores iusto sed est.', '45.25', 2, 'opened', '2015-05-05 19:03:26', '2016-01-30 18:09:29', '2016-01-30 18:03:26'),
(4, 1, 'Cartable Laser', 'cartable-laser', 'Doloremque voluptas ut tempore voluptatem nisi porro rerum. Aperiam accusamus omnis hic dolore ad modi.', 'Qui non deleniti dolores nulla dolorem voluptas. Sapiente nemo nihil tempore quo qui dolorem cupiditate. Et laborum aperiam eos qui sit sit. Facilis voluptas tempora deleniti consectetur quis at expedita. Incidunt eveniet rerum ratione id consequuntur sunt. Dicta quasi hic neque libero sapiente velit.', '35.55', 25, 'closed', '2014-05-29 11:27:34', '2016-01-30 18:09:35', '2016-01-29 10:27:34'),
(5, 2, 'Casque Boba', 'casque-boba', 'Dignissimos excepturi veritatis nam at et inventore officiis.', 'Dolorem omnis neque quam est eum saepe expedita. Architecto omnis corrupti pariatur eos ipsum molestiae repudiandae. Dolores et iure modi consequatur illum facere alias dolor. Ad necessitatibus a id incidunt qui repellendus velit. Temporibus sed eius iste et maxime quia. Placeat qui ut fuga et.', '150.99', 23, 'opened', '2013-10-10 18:50:44', '2016-01-30 18:09:39', '2016-01-30 17:50:44'),
(6, 2, 'Casque chasseur de prime', 'casque-chasseur', 'Et est quia aliquid quia voluptatum quis quidem. Harum et repudiandae doloribus. Necessitatibus et voluptas ducimus aspernatur mollitia dignissimos autem. Molestiae non eius delectus optio nulla iusto.', 'Adipisci minima repellendus nostrum saepe. Non sit sequi corrupti facere consequatur. Porro modi labore facere vero id cum quidem. Odio nesciunt autem sed id aut deleniti. Quia impedit nisi ipsam explicabo quo.', '315.39', 8, 'opened', '2015-02-13 11:22:11', '2016-01-30 18:10:02', '2016-01-28 10:22:11'),
(7, 2, 'Casque Vador Collector', 'casque-vador', 'Aliquid libero non iure recusandae. Hic autem non cupiditate non excepturi quam. Molestiae non sapiente dicta voluptatibus hic aliquam aut neque. Enim quisquam nam unde harum consequatur nisi natus. Accusamus ut qui veritatis aperiam.', 'Qui aspernatur magni inventore quis alias voluptate sunt. Amet rem dolorem quis sit consectetur voluptatum. Corporis qui nulla ut beatae id ut dolor. In dolor quasi ea suscipit culpa amet ullam. Laudantium quia maxime dolorem eos voluptatem. Est dolor quos nisi architecto inventore. Esse ea sapiente hic. Dolorem dignissimos adipisci illo laboriosam enim qui perferendis sint. Voluptatem perspiciatis nostrum in veritatis dignissimos quasi aperiam. Sit est temporibus fuga praesentium. Et possimus inventore non sit repudiandae.', '560.99', 7, 'opened', '2014-04-09 19:02:37', '2016-01-30 18:10:05', '2016-01-30 18:02:37'),
(8, 2, 'Coque téléphone casque', 'coque-telephone-casque', 'Aut et sint sint. Voluptas saepe sapiente quibusdam qui.', 'Dolore aliquid quidem unde veritatis et. Illo natus exercitationem nisi reiciendis totam. Architecto reprehenderit nisi debitis praesentium numquam. Dolorem voluptas provident velit itaque aut aut natus. Voluptate perferendis qui et aut nobis. Rerum molestiae voluptas placeat cum sit.', '25.99', 15, 'opened', '2013-11-07 11:27:49', '2016-01-30 18:10:07', '2016-01-29 10:27:49'),
(9, 1, 'Coque téléphone laser', 'coque-telephone-laser', 'Nisi soluta sunt sapiente temporibus. Qui unde cupiditate voluptas possimus.', 'Sit qui aperiam eos numquam soluta sit ut sed. Cumque recusandae aut omnis porro repellendus labore. Eos porro quia et. Aspernatur dignissimos mollitia earum nemo voluptas enim. Neque ullam libero modi. Sit dolorem ducimus explicabo placeat qui. Et sed sint animi repudiandae dicta dignissimos. Architecto et non et dicta ut. Quia accusamus quo quibusdam consectetur odit qui. Alias rerum officia dolorem velit. Vitae dolorem voluptatum dolor minima.', '28.55', 23, 'opened', '2015-08-28 10:03:37', '2016-01-31 09:03:37', '2016-01-31 09:03:37'),
(11, 2, 'Tshirt casque', 'tshirt-casque', 'Delectus minima sit cupiditate dolores mollitia et. Dignissimos corporis repudiandae laborum aut hic. Modi aperiam dolor numquam occaecati quis assumenda voluptas. Molestiae rerum adipisci et qui sapiente. Quis reprehenderit non ratione qui est.', 'Quo explicabo repellendus aspernatur voluptate quam. Qui aliquam cumque voluptas. Quae et nam doloremque doloribus. Aut consequatur voluptatem nulla praesentium id. Et enim repellendus eos excepturi. Nesciunt et magni deserunt voluptatem unde.', '25.99', 35, 'opened', '2012-12-14 10:04:19', '2016-01-31 09:04:19', '2016-01-31 09:04:19'),
(12, 1, 'Tshirt laser', 'tshirt-laser', 'Quia omnis ipsam eos magni omnis quo. Quidem ut velit quo incidunt. Ad distinctio rem eligendi eos. Non quia atque asperiores facere pariatur.', 'Delectus quia sed quasi quam delectus odio. Quaerat dolore eum nam eligendi inventore earum. Totam sed nihil error ducimus dolorum. Dolorem eum aut voluptatem aut maxime corporis quia pariatur. Atque in aut qui et sint. Omnis distinctio at sed repellendus minus est alias. Eius error ut vitae omnis in molestiae eum.', '32.25', 14, 'opened', '2010-06-12 10:04:40', '2016-01-31 09:04:40', '2016-01-31 09:04:40'),
(13, 1, 'Tapis de souris', 'tapis-de-souris', 'Animi sint et totam ut.', 'Sequi assumenda odio cum doloremque et doloribus. Repellat doloribus doloribus pariatur ab non. Eos quo non rem. Est quos fugiat dolorum qui qui aspernatur corrupti aliquid. Nisi ab nisi est molestias tempora unde. Deserunt voluptatem nihil fugit in est eum rem quod. Quisquam sed officia ab et quod dolorum. Et repudiandae veritatis commodi. Qui quam autem cupiditate et est. Quam voluptas dolores repellat eum.', '21.55', 27, 'opened', '2012-02-08 10:05:05', '2016-01-31 09:05:05', '2016-01-31 09:05:05'),
(14, 1, 'Stylo star wars', 'stylo-star-wars', 'Nisi ipsa consequuntur explicabo sit. Reiciendis sed provident temporibus rerum. Corporis quisquam molestiae qui maiores qui quis qui. Est beatae et qui architecto saepe beatae dicta aspernatur. Inventore saepe numquam sit et.', 'Voluptas dolorem sunt beatae ut non quos quo. Qui aspernatur sit in est laboriosam fugiat. Expedita aspernatur doloremque nisi ratione commodi sed. Libero minima amet quas nostrum ut modi. Quidem molestiae vero sed doloribus quo. Minus iure vel aut est pariatur ullam et. Rerum hic nemo eligendi labore natus ex distinctio necessitatibus. Tenetur sit veritatis consequuntur doloribus qui. Delectus voluptatem eos maxime et quam consectetur. Et et ea vel est veniam enim voluptatem necessitatibus.', '8.15', 8, 'opened', '2015-04-11 11:28:43', '2016-01-30 18:10:26', '2016-01-29 10:28:43'),
(15, 2, 'Souris Vador', 'souris-vador', 'Corporis et facilis accusamus in. Fugit ut est velit voluptas. Cum voluptatem consequatur laudantium.', 'Voluptas fuga architecto quia cumque quas expedita voluptate. Quos harum aliquid voluptatem accusantium. Eos et quia debitis nulla quo. Dolores aut ut possimus aliquid id. Accusantium deleniti eaque illo corrupti recusandae earum. Saepe facere sed sed qui itaque. Adipisci porro quam saepe. Vel quaerat praesentium consequatur velit iusto quasi accusantium.', '22.55', 6, 'opened', '2015-12-10 19:01:51', '2016-01-30 18:10:30', '2016-01-30 18:01:51'),
(16, 1, 'Sabre laser', 'sabre-laser', 'Curabitur ut sem nec diam tempor blandit non id lorem. ', 'Suspendisse augue lorem, lacinia volutpat dui et, consectetur vulputate libero. Nunc venenatis auctor dui, ac rhoncus ligula luctus quis. Ut finibus, nisl sit amet viverra lacinia, urna tortor tempus dui, vel ultrices nulla ligula ac lorem. Curabitur ut sem nec diam tempor blandit non id lorem. ', '150.99', 8, 'opened', '2012-12-12 19:08:22', '2016-01-30 18:10:33', '2016-01-30 18:08:22');

-- --------------------------------------------------------

--
-- Structure de la table `product_tag`
--

CREATE TABLE `product_tag` (
  `product_id` int(10) UNSIGNED NOT NULL,
  `tag_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `product_tag`
--

INSERT INTO `product_tag` (`product_id`, `tag_id`) VALUES
(1, 1),
(1, 2),
(1, 3),
(2, 2),
(2, 5),
(2, 6),
(3, 1),
(3, 3),
(3, 4),
(4, 1),
(4, 2),
(4, 5),
(5, 3),
(5, 4),
(6, 1),
(6, 2),
(6, 4),
(7, 1),
(7, 2),
(7, 3),
(7, 4),
(8, 2),
(8, 3),
(8, 4),
(9, 1),
(9, 2),
(9, 5),
(11, 2),
(11, 4),
(12, 2),
(12, 3),
(12, 5),
(13, 2),
(13, 5),
(13, 6),
(14, 1),
(14, 2),
(14, 5),
(14, 6),
(15, 1),
(15, 2),
(15, 3),
(15, 4),
(16, 1),
(16, 2),
(16, 3),
(16, 5),
(16, 6);

-- --------------------------------------------------------

--
-- Structure de la table `tags`
--

CREATE TABLE `tags` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `tags`
--

INSERT INTO `tags` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'star', '2016-01-25 14:09:08', '0000-00-00 00:00:00'),
(2, 'galaxy', '2016-01-25 14:09:08', '0000-00-00 00:00:00'),
(3, 'saga', '2016-01-25 14:09:08', '0000-00-00 00:00:00'),
(4, 'casque', '2016-01-25 14:09:08', '0000-00-00 00:00:00'),
(5, 'laser', '2016-01-25 14:09:08', '0000-00-00 00:00:00'),
(6, 'princess', '2016-01-25 14:09:08', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `role` enum('administrator','editor','author','visitor') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'editor',
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Laeti', 'laeti@laeti.fr', '$2y$10$fvKrkCAVH.a2rg6kyeFcHOvpn/MtbCgb2UYpNMvXR8r2mfE2qhPVa', 'administrator', 'QSJEnyWlwb1ClhTD2gfyX97LiChGKJo297Ga8f8ojgIt4k6PiGEvkq4pzT0o', '2016-01-31 09:05:23', '2016-01-31 09:05:23'),
(2, 'Romain', 'romain@romain.fr', '$2y$10$x2/0lEJpJTl2eYPSH7g3uOP.HLcH8JPoPq4DpqaNOBfCJfjbbVbAS', 'visitor', '11nCyCXfZIcwHbTABj0nHYmPE1YMnZesARsYdsUv9W9nBKptBwmeYYEQqhtL', '2016-01-31 09:18:07', '2016-01-31 09:18:07'),
(3, 'Sophie', 'sophie@sophie.fr', '$2y$10$wAOZ5KY8wEPPk7W3CRCfv.zPmDrCtMJKa.ZrgXrqrVjVn98ktwCzm', 'visitor', 'VsQAa7MTzcbo1kBv2jrZVepgsZCleVy9p9WMvFEAlsD9hsFqiAg9QZqYzQKN', '2016-01-30 18:30:47', '2016-01-30 18:30:47'),
(4, 'Clement', 'clement@clement.fr', '$2y$10$4BOgN7O1rB04/WXJuShy2.Hck/uKqcgm1RLvGZX.0qouY/bsSBZPe', 'visitor', 'oraEAFOTuqBjRlnDwLtLC3uw4ydQXBgLNpewoacOYg3zmV5sBYgc7keXsSsK', '2016-01-31 08:03:04', '2016-01-31 08:03:04');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customers_user_id_foreign` (`user_id`);

--
-- Index pour la table `histories`
--
ALTER TABLE `histories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `histories_product_id_foreign` (`product_id`),
  ADD KEY `histories_customer_id_foreign` (`customer_id`);

--
-- Index pour la table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Index pour la table `pictures`
--
ALTER TABLE `pictures`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pictures_product_id_foreign` (`product_id`);

--
-- Index pour la table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_category_id_foreign` (`category_id`);

--
-- Index pour la table `product_tag`
--
ALTER TABLE `product_tag`
  ADD UNIQUE KEY `product_tag_product_id_tag_id_unique` (`product_id`,`tag_id`),
  ADD KEY `product_tag_tag_id_foreign` (`tag_id`);

--
-- Index pour la table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `histories`
--
ALTER TABLE `histories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;
--
-- AUTO_INCREMENT pour la table `pictures`
--
ALTER TABLE `pictures`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
--
-- AUTO_INCREMENT pour la table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT pour la table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `customers`
--
ALTER TABLE `customers`
  ADD CONSTRAINT `customers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `histories`
--
ALTER TABLE `histories`
  ADD CONSTRAINT `histories_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `histories_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `pictures`
--
ALTER TABLE `pictures`
  ADD CONSTRAINT `pictures_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL;

--
-- Contraintes pour la table `product_tag`
--
ALTER TABLE `product_tag`
  ADD CONSTRAINT `product_tag_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_tag_tag_id_foreign` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
