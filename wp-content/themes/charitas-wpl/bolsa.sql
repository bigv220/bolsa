/*
MySQL Data Transfer
Source Host: localhost
Source Database: bolsa
Target Host: localhost
Target Database: bolsa
Date: 2013/9/24 15:40:11
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for wp_commentmeta
-- ----------------------------
CREATE TABLE `wp_commentmeta` (
  `meta_id` bigint(20) unsigned NOT NULL auto_increment,
  `comment_id` bigint(20) unsigned NOT NULL default '0',
  `meta_key` varchar(255) default NULL,
  `meta_value` longtext,
  PRIMARY KEY  (`meta_id`),
  KEY `comment_id` (`comment_id`),
  KEY `meta_key` (`meta_key`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for wp_comments
-- ----------------------------
CREATE TABLE `wp_comments` (
  `comment_ID` bigint(20) unsigned NOT NULL auto_increment,
  `comment_post_ID` bigint(20) unsigned NOT NULL default '0',
  `comment_author` tinytext NOT NULL,
  `comment_author_email` varchar(100) NOT NULL default '',
  `comment_author_url` varchar(200) NOT NULL default '',
  `comment_author_IP` varchar(100) NOT NULL default '',
  `comment_date` datetime NOT NULL default '0000-00-00 00:00:00',
  `comment_date_gmt` datetime NOT NULL default '0000-00-00 00:00:00',
  `comment_content` text NOT NULL,
  `comment_karma` int(11) NOT NULL default '0',
  `comment_approved` varchar(20) NOT NULL default '1',
  `comment_agent` varchar(255) NOT NULL default '',
  `comment_type` varchar(20) NOT NULL default '',
  `comment_parent` bigint(20) unsigned NOT NULL default '0',
  `user_id` bigint(20) unsigned NOT NULL default '0',
  PRIMARY KEY  (`comment_ID`),
  KEY `comment_post_ID` (`comment_post_ID`),
  KEY `comment_approved_date_gmt` (`comment_approved`,`comment_date_gmt`),
  KEY `comment_date_gmt` (`comment_date_gmt`),
  KEY `comment_parent` (`comment_parent`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for wp_links
-- ----------------------------
CREATE TABLE `wp_links` (
  `link_id` bigint(20) unsigned NOT NULL auto_increment,
  `link_url` varchar(255) NOT NULL default '',
  `link_name` varchar(255) NOT NULL default '',
  `link_image` varchar(255) NOT NULL default '',
  `link_target` varchar(25) NOT NULL default '',
  `link_description` varchar(255) NOT NULL default '',
  `link_visible` varchar(20) NOT NULL default 'Y',
  `link_owner` bigint(20) unsigned NOT NULL default '1',
  `link_rating` int(11) NOT NULL default '0',
  `link_updated` datetime NOT NULL default '0000-00-00 00:00:00',
  `link_rel` varchar(255) NOT NULL default '',
  `link_notes` mediumtext NOT NULL,
  `link_rss` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`link_id`),
  KEY `link_visible` (`link_visible`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for wp_options
-- ----------------------------
CREATE TABLE `wp_options` (
  `option_id` bigint(20) unsigned NOT NULL auto_increment,
  `option_name` varchar(64) NOT NULL default '',
  `option_value` longtext NOT NULL,
  `autoload` varchar(20) NOT NULL default 'yes',
  PRIMARY KEY  (`option_id`),
  UNIQUE KEY `option_name` (`option_name`)
) ENGINE=MyISAM AUTO_INCREMENT=100 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for wp_postmeta
-- ----------------------------
CREATE TABLE `wp_postmeta` (
  `meta_id` bigint(20) unsigned NOT NULL auto_increment,
  `post_id` bigint(20) unsigned NOT NULL default '0',
  `meta_key` varchar(255) default NULL,
  `meta_value` longtext,
  PRIMARY KEY  (`meta_id`),
  KEY `post_id` (`post_id`),
  KEY `meta_key` (`meta_key`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for wp_posts
-- ----------------------------
CREATE TABLE `wp_posts` (
  `ID` bigint(20) unsigned NOT NULL auto_increment,
  `post_author` bigint(20) unsigned NOT NULL default '0',
  `post_date` datetime NOT NULL default '0000-00-00 00:00:00',
  `post_date_gmt` datetime NOT NULL default '0000-00-00 00:00:00',
  `post_content` longtext NOT NULL,
  `post_title` text NOT NULL,
  `post_excerpt` text NOT NULL,
  `post_status` varchar(20) NOT NULL default 'publish',
  `comment_status` varchar(20) NOT NULL default 'open',
  `ping_status` varchar(20) NOT NULL default 'open',
  `post_password` varchar(20) NOT NULL default '',
  `post_name` varchar(200) NOT NULL default '',
  `to_ping` text NOT NULL,
  `pinged` text NOT NULL,
  `post_modified` datetime NOT NULL default '0000-00-00 00:00:00',
  `post_modified_gmt` datetime NOT NULL default '0000-00-00 00:00:00',
  `post_content_filtered` longtext NOT NULL,
  `post_parent` bigint(20) unsigned NOT NULL default '0',
  `guid` varchar(255) NOT NULL default '',
  `menu_order` int(11) NOT NULL default '0',
  `post_type` varchar(20) NOT NULL default 'post',
  `post_mime_type` varchar(100) NOT NULL default '',
  `comment_count` bigint(20) NOT NULL default '0',
  PRIMARY KEY  (`ID`),
  KEY `post_name` (`post_name`),
  KEY `type_status_date` (`post_type`,`post_status`,`post_date`,`ID`),
  KEY `post_parent` (`post_parent`),
  KEY `post_author` (`post_author`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for wp_term_relationships
-- ----------------------------
CREATE TABLE `wp_term_relationships` (
  `object_id` bigint(20) unsigned NOT NULL default '0',
  `term_taxonomy_id` bigint(20) unsigned NOT NULL default '0',
  `term_order` int(11) NOT NULL default '0',
  PRIMARY KEY  (`object_id`,`term_taxonomy_id`),
  KEY `term_taxonomy_id` (`term_taxonomy_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for wp_term_taxonomy
-- ----------------------------
CREATE TABLE `wp_term_taxonomy` (
  `term_taxonomy_id` bigint(20) unsigned NOT NULL auto_increment,
  `term_id` bigint(20) unsigned NOT NULL default '0',
  `taxonomy` varchar(32) NOT NULL default '',
  `description` longtext NOT NULL,
  `parent` bigint(20) unsigned NOT NULL default '0',
  `count` bigint(20) NOT NULL default '0',
  PRIMARY KEY  (`term_taxonomy_id`),
  UNIQUE KEY `term_id_taxonomy` (`term_id`,`taxonomy`),
  KEY `taxonomy` (`taxonomy`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for wp_terms
-- ----------------------------
CREATE TABLE `wp_terms` (
  `term_id` bigint(20) unsigned NOT NULL auto_increment,
  `name` varchar(200) NOT NULL default '',
  `slug` varchar(200) NOT NULL default '',
  `term_group` bigint(10) NOT NULL default '0',
  PRIMARY KEY  (`term_id`),
  UNIQUE KEY `slug` (`slug`),
  KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for wp_usermeta
-- ----------------------------
CREATE TABLE `wp_usermeta` (
  `umeta_id` bigint(20) unsigned NOT NULL auto_increment,
  `user_id` bigint(20) unsigned NOT NULL default '0',
  `meta_key` varchar(255) default NULL,
  `meta_value` longtext,
  PRIMARY KEY  (`umeta_id`),
  KEY `user_id` (`user_id`),
  KEY `meta_key` (`meta_key`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for wp_users
-- ----------------------------
CREATE TABLE `wp_users` (
  `ID` bigint(20) unsigned NOT NULL auto_increment,
  `user_login` varchar(60) NOT NULL default '',
  `user_pass` varchar(64) NOT NULL default '',
  `user_nicename` varchar(50) NOT NULL default '',
  `user_email` varchar(100) NOT NULL default '',
  `user_url` varchar(100) NOT NULL default '',
  `user_registered` datetime NOT NULL default '0000-00-00 00:00:00',
  `user_activation_key` varchar(60) NOT NULL default '',
  `user_status` int(11) NOT NULL default '0',
  `display_name` varchar(250) NOT NULL default '',
  PRIMARY KEY  (`ID`),
  KEY `user_login_key` (`user_login`),
  KEY `user_nicename` (`user_nicename`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records 
-- ----------------------------
INSERT INTO `wp_comments` VALUES ('1', '1', 'Mr WordPress', '', 'http://wordpress.org/', '', '2013-09-24 07:39:09', '2013-09-24 07:39:09', 'Hi, this is a comment.\nTo delete a comment, just log in and view the post&#039;s comments. There you will have the option to edit or delete them.', '0', '1', '', '', '0', '0');
INSERT INTO `wp_options` VALUES ('1', 'siteurl', 'http://localhost:807/bolsa', 'yes');
INSERT INTO `wp_options` VALUES ('2', 'blogname', 'Bolsahay', 'yes');
INSERT INTO `wp_options` VALUES ('3', 'blogdescription', 'Just another WordPress site', 'yes');
INSERT INTO `wp_options` VALUES ('4', 'users_can_register', '0', 'yes');
INSERT INTO `wp_options` VALUES ('5', 'admin_email', 'admin@bolsahay.com', 'yes');
INSERT INTO `wp_options` VALUES ('6', 'start_of_week', '1', 'yes');
INSERT INTO `wp_options` VALUES ('7', 'use_balanceTags', '0', 'yes');
INSERT INTO `wp_options` VALUES ('8', 'use_smilies', '1', 'yes');
INSERT INTO `wp_options` VALUES ('9', 'require_name_email', '1', 'yes');
INSERT INTO `wp_options` VALUES ('10', 'comments_notify', '1', 'yes');
INSERT INTO `wp_options` VALUES ('11', 'posts_per_rss', '10', 'yes');
INSERT INTO `wp_options` VALUES ('12', 'rss_use_excerpt', '0', 'yes');
INSERT INTO `wp_options` VALUES ('13', 'mailserver_url', 'mail.example.com', 'yes');
INSERT INTO `wp_options` VALUES ('14', 'mailserver_login', 'login@example.com', 'yes');
INSERT INTO `wp_options` VALUES ('15', 'mailserver_pass', 'password', 'yes');
INSERT INTO `wp_options` VALUES ('16', 'mailserver_port', '110', 'yes');
INSERT INTO `wp_options` VALUES ('17', 'default_category', '1', 'yes');
INSERT INTO `wp_options` VALUES ('18', 'default_comment_status', 'open', 'yes');
INSERT INTO `wp_options` VALUES ('19', 'default_ping_status', 'open', 'yes');
INSERT INTO `wp_options` VALUES ('20', 'default_pingback_flag', '1', 'yes');
INSERT INTO `wp_options` VALUES ('21', 'posts_per_page', '10', 'yes');
INSERT INTO `wp_options` VALUES ('22', 'date_format', 'F j, Y', 'yes');
INSERT INTO `wp_options` VALUES ('23', 'time_format', 'g:i a', 'yes');
INSERT INTO `wp_options` VALUES ('24', 'links_updated_date_format', 'F j, Y g:i a', 'yes');
INSERT INTO `wp_options` VALUES ('25', 'links_recently_updated_prepend', '<em>', 'yes');
INSERT INTO `wp_options` VALUES ('26', 'links_recently_updated_append', '</em>', 'yes');
INSERT INTO `wp_options` VALUES ('27', 'links_recently_updated_time', '120', 'yes');
INSERT INTO `wp_options` VALUES ('28', 'comment_moderation', '0', 'yes');
INSERT INTO `wp_options` VALUES ('29', 'moderation_notify', '1', 'yes');
INSERT INTO `wp_options` VALUES ('30', 'permalink_structure', '', 'yes');
INSERT INTO `wp_options` VALUES ('31', 'gzipcompression', '0', 'yes');
INSERT INTO `wp_options` VALUES ('32', 'hack_file', '0', 'yes');
INSERT INTO `wp_options` VALUES ('33', 'blog_charset', 'UTF-8', 'yes');
INSERT INTO `wp_options` VALUES ('34', 'moderation_keys', '', 'no');
INSERT INTO `wp_options` VALUES ('35', 'active_plugins', 'a:0:{}', 'yes');
INSERT INTO `wp_options` VALUES ('36', 'home', 'http://localhost:807/bolsa', 'yes');
INSERT INTO `wp_options` VALUES ('37', 'category_base', '', 'yes');
INSERT INTO `wp_options` VALUES ('38', 'ping_sites', 'http://rpc.pingomatic.com/', 'yes');
INSERT INTO `wp_options` VALUES ('39', 'advanced_edit', '0', 'yes');
INSERT INTO `wp_options` VALUES ('40', 'comment_max_links', '2', 'yes');
INSERT INTO `wp_options` VALUES ('41', 'gmt_offset', '0', 'yes');
INSERT INTO `wp_options` VALUES ('42', 'default_email_category', '1', 'yes');
INSERT INTO `wp_options` VALUES ('43', 'recently_edited', '', 'no');
INSERT INTO `wp_options` VALUES ('44', 'template', 'twentythirteen', 'yes');
INSERT INTO `wp_options` VALUES ('45', 'stylesheet', 'twentythirteen', 'yes');
INSERT INTO `wp_options` VALUES ('46', 'comment_whitelist', '1', 'yes');
INSERT INTO `wp_options` VALUES ('47', 'blacklist_keys', '', 'no');
INSERT INTO `wp_options` VALUES ('48', 'comment_registration', '0', 'yes');
INSERT INTO `wp_options` VALUES ('49', 'html_type', 'text/html', 'yes');
INSERT INTO `wp_options` VALUES ('50', 'use_trackback', '0', 'yes');
INSERT INTO `wp_options` VALUES ('51', 'default_role', 'subscriber', 'yes');
INSERT INTO `wp_options` VALUES ('52', 'db_version', '24448', 'yes');
INSERT INTO `wp_options` VALUES ('53', 'uploads_use_yearmonth_folders', '1', 'yes');
INSERT INTO `wp_options` VALUES ('54', 'upload_path', '', 'yes');
INSERT INTO `wp_options` VALUES ('55', 'blog_public', '1', 'yes');
INSERT INTO `wp_options` VALUES ('56', 'default_link_category', '2', 'yes');
INSERT INTO `wp_options` VALUES ('57', 'show_on_front', 'posts', 'yes');
INSERT INTO `wp_options` VALUES ('58', 'tag_base', '', 'yes');
INSERT INTO `wp_options` VALUES ('59', 'show_avatars', '1', 'yes');
INSERT INTO `wp_options` VALUES ('60', 'avatar_rating', 'G', 'yes');
INSERT INTO `wp_options` VALUES ('61', 'upload_url_path', '', 'yes');
INSERT INTO `wp_options` VALUES ('62', 'thumbnail_size_w', '150', 'yes');
INSERT INTO `wp_options` VALUES ('63', 'thumbnail_size_h', '150', 'yes');
INSERT INTO `wp_options` VALUES ('64', 'thumbnail_crop', '1', 'yes');
INSERT INTO `wp_options` VALUES ('65', 'medium_size_w', '300', 'yes');
INSERT INTO `wp_options` VALUES ('66', 'medium_size_h', '300', 'yes');
INSERT INTO `wp_options` VALUES ('67', 'avatar_default', 'mystery', 'yes');
INSERT INTO `wp_options` VALUES ('68', 'large_size_w', '1024', 'yes');
INSERT INTO `wp_options` VALUES ('69', 'large_size_h', '1024', 'yes');
INSERT INTO `wp_options` VALUES ('70', 'image_default_link_type', 'file', 'yes');
INSERT INTO `wp_options` VALUES ('71', 'image_default_size', '', 'yes');
INSERT INTO `wp_options` VALUES ('72', 'image_default_align', '', 'yes');
INSERT INTO `wp_options` VALUES ('73', 'close_comments_for_old_posts', '0', 'yes');
INSERT INTO `wp_options` VALUES ('74', 'close_comments_days_old', '14', 'yes');
INSERT INTO `wp_options` VALUES ('75', 'thread_comments', '1', 'yes');
INSERT INTO `wp_options` VALUES ('76', 'thread_comments_depth', '5', 'yes');
INSERT INTO `wp_options` VALUES ('77', 'page_comments', '0', 'yes');
INSERT INTO `wp_options` VALUES ('78', 'comments_per_page', '50', 'yes');
INSERT INTO `wp_options` VALUES ('79', 'default_comments_page', 'newest', 'yes');
INSERT INTO `wp_options` VALUES ('80', 'comment_order', 'asc', 'yes');
INSERT INTO `wp_options` VALUES ('81', 'sticky_posts', 'a:0:{}', 'yes');
INSERT INTO `wp_options` VALUES ('82', 'widget_categories', 'a:2:{i:2;a:4:{s:5:\"title\";s:0:\"\";s:5:\"count\";i:0;s:12:\"hierarchical\";i:0;s:8:\"dropdown\";i:0;}s:12:\"_multiwidget\";i:1;}', 'yes');
INSERT INTO `wp_options` VALUES ('83', 'widget_text', 'a:0:{}', 'yes');
INSERT INTO `wp_options` VALUES ('84', 'widget_rss', 'a:0:{}', 'yes');
INSERT INTO `wp_options` VALUES ('85', 'uninstall_plugins', 'a:0:{}', 'no');
INSERT INTO `wp_options` VALUES ('86', 'timezone_string', '', 'yes');
INSERT INTO `wp_options` VALUES ('87', 'page_for_posts', '0', 'yes');
INSERT INTO `wp_options` VALUES ('88', 'page_on_front', '0', 'yes');
INSERT INTO `wp_options` VALUES ('89', 'default_post_format', '0', 'yes');
INSERT INTO `wp_options` VALUES ('90', 'link_manager_enabled', '0', 'yes');
INSERT INTO `wp_options` VALUES ('91', 'initial_db_version', '24448', 'yes');
INSERT INTO `wp_options` VALUES ('92', 'wp_user_roles', 'a:5:{s:13:\"administrator\";a:2:{s:4:\"name\";s:13:\"Administrator\";s:12:\"capabilities\";a:62:{s:13:\"switch_themes\";b:1;s:11:\"edit_themes\";b:1;s:16:\"activate_plugins\";b:1;s:12:\"edit_plugins\";b:1;s:10:\"edit_users\";b:1;s:10:\"edit_files\";b:1;s:14:\"manage_options\";b:1;s:17:\"moderate_comments\";b:1;s:17:\"manage_categories\";b:1;s:12:\"manage_links\";b:1;s:12:\"upload_files\";b:1;s:6:\"import\";b:1;s:15:\"unfiltered_html\";b:1;s:10:\"edit_posts\";b:1;s:17:\"edit_others_posts\";b:1;s:20:\"edit_published_posts\";b:1;s:13:\"publish_posts\";b:1;s:10:\"edit_pages\";b:1;s:4:\"read\";b:1;s:8:\"level_10\";b:1;s:7:\"level_9\";b:1;s:7:\"level_8\";b:1;s:7:\"level_7\";b:1;s:7:\"level_6\";b:1;s:7:\"level_5\";b:1;s:7:\"level_4\";b:1;s:7:\"level_3\";b:1;s:7:\"level_2\";b:1;s:7:\"level_1\";b:1;s:7:\"level_0\";b:1;s:17:\"edit_others_pages\";b:1;s:20:\"edit_published_pages\";b:1;s:13:\"publish_pages\";b:1;s:12:\"delete_pages\";b:1;s:19:\"delete_others_pages\";b:1;s:22:\"delete_published_pages\";b:1;s:12:\"delete_posts\";b:1;s:19:\"delete_others_posts\";b:1;s:22:\"delete_published_posts\";b:1;s:20:\"delete_private_posts\";b:1;s:18:\"edit_private_posts\";b:1;s:18:\"read_private_posts\";b:1;s:20:\"delete_private_pages\";b:1;s:18:\"edit_private_pages\";b:1;s:18:\"read_private_pages\";b:1;s:12:\"delete_users\";b:1;s:12:\"create_users\";b:1;s:17:\"unfiltered_upload\";b:1;s:14:\"edit_dashboard\";b:1;s:14:\"update_plugins\";b:1;s:14:\"delete_plugins\";b:1;s:15:\"install_plugins\";b:1;s:13:\"update_themes\";b:1;s:14:\"install_themes\";b:1;s:11:\"update_core\";b:1;s:10:\"list_users\";b:1;s:12:\"remove_users\";b:1;s:9:\"add_users\";b:1;s:13:\"promote_users\";b:1;s:18:\"edit_theme_options\";b:1;s:13:\"delete_themes\";b:1;s:6:\"export\";b:1;}}s:6:\"editor\";a:2:{s:4:\"name\";s:6:\"Editor\";s:12:\"capabilities\";a:34:{s:17:\"moderate_comments\";b:1;s:17:\"manage_categories\";b:1;s:12:\"manage_links\";b:1;s:12:\"upload_files\";b:1;s:15:\"unfiltered_html\";b:1;s:10:\"edit_posts\";b:1;s:17:\"edit_others_posts\";b:1;s:20:\"edit_published_posts\";b:1;s:13:\"publish_posts\";b:1;s:10:\"edit_pages\";b:1;s:4:\"read\";b:1;s:7:\"level_7\";b:1;s:7:\"level_6\";b:1;s:7:\"level_5\";b:1;s:7:\"level_4\";b:1;s:7:\"level_3\";b:1;s:7:\"level_2\";b:1;s:7:\"level_1\";b:1;s:7:\"level_0\";b:1;s:17:\"edit_others_pages\";b:1;s:20:\"edit_published_pages\";b:1;s:13:\"publish_pages\";b:1;s:12:\"delete_pages\";b:1;s:19:\"delete_others_pages\";b:1;s:22:\"delete_published_pages\";b:1;s:12:\"delete_posts\";b:1;s:19:\"delete_others_posts\";b:1;s:22:\"delete_published_posts\";b:1;s:20:\"delete_private_posts\";b:1;s:18:\"edit_private_posts\";b:1;s:18:\"read_private_posts\";b:1;s:20:\"delete_private_pages\";b:1;s:18:\"edit_private_pages\";b:1;s:18:\"read_private_pages\";b:1;}}s:6:\"author\";a:2:{s:4:\"name\";s:6:\"Author\";s:12:\"capabilities\";a:10:{s:12:\"upload_files\";b:1;s:10:\"edit_posts\";b:1;s:20:\"edit_published_posts\";b:1;s:13:\"publish_posts\";b:1;s:4:\"read\";b:1;s:7:\"level_2\";b:1;s:7:\"level_1\";b:1;s:7:\"level_0\";b:1;s:12:\"delete_posts\";b:1;s:22:\"delete_published_posts\";b:1;}}s:11:\"contributor\";a:2:{s:4:\"name\";s:11:\"Contributor\";s:12:\"capabilities\";a:5:{s:10:\"edit_posts\";b:1;s:4:\"read\";b:1;s:7:\"level_1\";b:1;s:7:\"level_0\";b:1;s:12:\"delete_posts\";b:1;}}s:10:\"subscriber\";a:2:{s:4:\"name\";s:10:\"Subscriber\";s:12:\"capabilities\";a:2:{s:4:\"read\";b:1;s:7:\"level_0\";b:1;}}}', 'yes');
INSERT INTO `wp_options` VALUES ('93', 'widget_search', 'a:2:{i:2;a:1:{s:5:\"title\";s:0:\"\";}s:12:\"_multiwidget\";i:1;}', 'yes');
INSERT INTO `wp_options` VALUES ('94', 'widget_recent-posts', 'a:2:{i:2;a:2:{s:5:\"title\";s:0:\"\";s:6:\"number\";i:5;}s:12:\"_multiwidget\";i:1;}', 'yes');
INSERT INTO `wp_options` VALUES ('95', 'widget_recent-comments', 'a:2:{i:2;a:2:{s:5:\"title\";s:0:\"\";s:6:\"number\";i:5;}s:12:\"_multiwidget\";i:1;}', 'yes');
INSERT INTO `wp_options` VALUES ('96', 'widget_archives', 'a:2:{i:2;a:3:{s:5:\"title\";s:0:\"\";s:5:\"count\";i:0;s:8:\"dropdown\";i:0;}s:12:\"_multiwidget\";i:1;}', 'yes');
INSERT INTO `wp_options` VALUES ('97', 'widget_meta', 'a:2:{i:2;a:1:{s:5:\"title\";s:0:\"\";}s:12:\"_multiwidget\";i:1;}', 'yes');
INSERT INTO `wp_options` VALUES ('98', 'sidebars_widgets', 'a:4:{s:19:\"wp_inactive_widgets\";a:0:{}s:9:\"sidebar-1\";a:6:{i:0;s:8:\"search-2\";i:1;s:14:\"recent-posts-2\";i:2;s:17:\"recent-comments-2\";i:3;s:10:\"archives-2\";i:4;s:12:\"categories-2\";i:5;s:6:\"meta-2\";}s:9:\"sidebar-2\";a:0:{}s:13:\"array_version\";i:3;}', 'yes');
INSERT INTO `wp_options` VALUES ('99', 'cron', 'a:2:{i:1380008354;a:3:{s:16:\"wp_version_check\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:10:\"twicedaily\";s:4:\"args\";a:0:{}s:8:\"interval\";i:43200;}}s:17:\"wp_update_plugins\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:10:\"twicedaily\";s:4:\"args\";a:0:{}s:8:\"interval\";i:43200;}}s:16:\"wp_update_themes\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:10:\"twicedaily\";s:4:\"args\";a:0:{}s:8:\"interval\";i:43200;}}}s:7:\"version\";i:2;}', 'yes');
INSERT INTO `wp_postmeta` VALUES ('1', '2', '_wp_page_template', 'default');
INSERT INTO `wp_posts` VALUES ('1', '1', '2013-09-24 07:39:09', '2013-09-24 07:39:09', 'Welcome to WordPress. This is your first post. Edit or delete it, then start blogging!', 'Hello world!', '', 'publish', 'open', 'open', '', 'hello-world', '', '', '2013-09-24 07:39:09', '2013-09-24 07:39:09', '', '0', 'http://localhost:807/bolsa/?p=1', '0', 'post', '', '1');
INSERT INTO `wp_posts` VALUES ('2', '1', '2013-09-24 07:39:09', '2013-09-24 07:39:09', 'This is an example page. It\'s different from a blog post because it will stay in one place and will show up in your site navigation (in most themes). Most people start with an About page that introduces them to potential site visitors. It might say something like this:\n\n<blockquote>Hi there! I\'m a bike messenger by day, aspiring actor by night, and this is my blog. I live in Los Angeles, have a great dog named Jack, and I like pi&#241;a coladas. (And gettin\' caught in the rain.)</blockquote>\n\n...or something like this:\n\n<blockquote>The XYZ Doohickey Company was founded in 1971, and has been providing quality doohickeys to the public ever since. Located in Gotham City, XYZ employs over 2,000 people and does all kinds of awesome things for the Gotham community.</blockquote>\n\nAs a new WordPress user, you should go to <a href=\"http://localhost:807/bolsa/wp-admin/\">your dashboard</a> to delete this page and create new pages for your content. Have fun!', 'Sample Page', '', 'publish', 'open', 'open', '', 'sample-page', '', '', '2013-09-24 07:39:09', '2013-09-24 07:39:09', '', '0', 'http://localhost:807/bolsa/?page_id=2', '0', 'page', '', '0');
INSERT INTO `wp_term_relationships` VALUES ('1', '1', '0');
INSERT INTO `wp_term_taxonomy` VALUES ('1', '1', 'category', '', '0', '1');
INSERT INTO `wp_terms` VALUES ('1', 'Uncategorized', 'uncategorized', '0');
INSERT INTO `wp_usermeta` VALUES ('1', '1', 'first_name', '');
INSERT INTO `wp_usermeta` VALUES ('2', '1', 'last_name', '');
INSERT INTO `wp_usermeta` VALUES ('3', '1', 'nickname', 'admin');
INSERT INTO `wp_usermeta` VALUES ('4', '1', 'description', '');
INSERT INTO `wp_usermeta` VALUES ('5', '1', 'rich_editing', 'true');
INSERT INTO `wp_usermeta` VALUES ('6', '1', 'comment_shortcuts', 'false');
INSERT INTO `wp_usermeta` VALUES ('7', '1', 'admin_color', 'fresh');
INSERT INTO `wp_usermeta` VALUES ('8', '1', 'use_ssl', '0');
INSERT INTO `wp_usermeta` VALUES ('9', '1', 'show_admin_bar_front', 'true');
INSERT INTO `wp_usermeta` VALUES ('10', '1', 'wp_capabilities', 'a:1:{s:13:\"administrator\";b:1;}');
INSERT INTO `wp_usermeta` VALUES ('11', '1', 'wp_user_level', '10');
INSERT INTO `wp_usermeta` VALUES ('12', '1', 'dismissed_wp_pointers', 'wp330_toolbar,wp330_saving_widgets,wp340_choose_image_from_library,wp340_customize_current_theme_link,wp350_media,wp360_revisions,wp360_locks');
INSERT INTO `wp_usermeta` VALUES ('13', '1', 'show_welcome_panel', '1');
INSERT INTO `wp_users` VALUES ('1', 'admin', '$P$Ba9WUPQ2R/8xHTH5LOAqINqiTwPWBu/', 'admin', 'admin@bolsahay.com', '', '2013-09-24 07:39:09', '', '0', 'admin');
