 **Клонируем репозиторию**
 
 **Запускаем `composer`**
 
 **Файл конфигурации для подключения к базе `App/Config.php`**
 
**В нашей базе создаем две таблицы**

`CREATE TABLE `posts` (
   `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
   `slug` varchar(33) COLLATE utf8_unicode_ci NOT NULL,
   `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
   `sub_title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
   `body` longtext COLLATE utf8_unicode_ci,
   `source` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
   `origin_url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
   `post_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
   `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
   `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
   PRIMARY KEY (`id`),
   UNIQUE KEY `posts_id_uindex` (`id`),
   UNIQUE KEY `posts_slug_uindex` (`slug`),
   FULLTEXT KEY `posts_title_index` (`title`)
 ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci`
 
 `CREATE TABLE `post_images` (
    `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `post_id` int(10) DEFAULT NULL,
    `name` varchar(33) COLLATE utf8_unicode_ci DEFAULT NULL,
    `details` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
    `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    UNIQUE KEY `post_images_id_uindex` (`id`)
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci`
  
  
  **Из консоли запускаем скрипт **
  `php Parsers/RbkParser.php`
  
 **После завершения скрипта открываем из браузера `sitName.local` и видим результат парса**