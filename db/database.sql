/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50137
Source Host           : localhost:3306
Source Database       : darkengine_4

Target Server Type    : MYSQL
Target Server Version : 50137
File Encoding         : 65001

Date: 2010-03-29 15:56:24
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `announcements`
-- ----------------------------
DROP TABLE IF EXISTS `announcements`;
CREATE TABLE `announcements` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subject` varchar(200) NOT NULL,
  `front` mediumtext NOT NULL,
  `content` longtext NOT NULL,
  `user_created` varchar(100) NOT NULL,
  `date_created` datetime NOT NULL,
  `user_modified` varchar(100) NOT NULL,
  `date_modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of announcements
-- ----------------------------
INSERT INTO `announcements` VALUES ('1', 'Announcement', 'Welcome to darkengine version 4, Ipsum dolor sit amet, consectetuer adipiscing elit. Nullam consequat diam arcu. Donec sit amet orci sit amet lorem nonummy congue. In hac habitasse platea dictumst. Proin hendrerit pharetra nisl. Sed vestibulum porta augue suada justo eget aliquam volutpat ed vestibulum porta augue suada justo eget aliquam volutpat.', 'Aenean nec eros. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Suspendisse sollicitudin velit sed leo. Ut pharetra augue nec augue. Nam elit magna, hendrerit sit amet, tincidunt ac, viverra sed, nulla. Donec porta diam eu massa. Quisque diam lorem, interdum vitae, dapibus ac, scelerisque vitae, pede. Donec eget tellus non erat lacinia fermentum. Donec in velit vel ipsum auctor pulvinar. Proin ullamcorper urna et felisNam elit magna, hendrerit sit amet, tincidunt ac, viverra sed, nullonecpo.\r\n\r\nVestibulum iaculis lacinia est. Proin dictum elementum velit. Fusce euismod consequat ante. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Pellentesque sed dolor. Aliquam congue fermentum nisl. Mauris accumsan nulla vel diam. Sed in lacus ut enim adipiscing aliquet. Nulla venenatis. In pede mi, aliquet sit amet, euismod in, auctor ut, ligula. Aliquam dapibus tincidunt metus. Praesent justo dolor, lobortis quis, lobortis dignissim, pulvinar ac, lorem. Vestibulum sed ante. Donec sagittis euismod purus.\r\n\r\nSed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatemNam elit magna, hendrerit sit amet, tincidunt ac, viverra sed, nullaonec po.\r\n', 'hendry', '2010-03-25 00:00:00', 'hendry', '2010-03-25 00:00:00');

-- ----------------------------
-- Table structure for `articles`
-- ----------------------------
DROP TABLE IF EXISTS `articles`;
CREATE TABLE `articles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subject` varchar(200) NOT NULL,
  `front` mediumtext NOT NULL,
  `content` longtext NOT NULL,
  `user_created` varchar(100) NOT NULL,
  `date_created` datetime NOT NULL,
  `user_modified` varchar(100) NOT NULL,
  `date_modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of articles
-- ----------------------------
INSERT INTO `articles` VALUES ('1', 'Test article 1', 'Ipsum dolor sit amet, consectetuer adipiscing elit. Nullam consequat diam arcu. Donec sit amet orci sit amet lorem nonummy congue. In hac habitasse platea dictumst. Proin hendrerit pharetra nisl. Sed vestibulum porta augue suada justo eget aliquam volutpat ed vestibulum porta augue suada justo eget aliquam volutpat.', 'Aenean nec eros. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Suspendisse sollicitudin velit sed leo. Ut pharetra augue nec augue. Nam elit magna, hendrerit sit amet, tincidunt ac, viverra sed, nulla. Donec porta diam eu massa. Quisque diam lorem, interdum vitae, dapibus ac, scelerisque vitae, pede. Donec eget tellus non erat lacinia fermentum. Donec in velit vel ipsum auctor pulvinar. Proin ullamcorper urna et felisNam elit magna, hendrerit sit amet, tincidunt ac, viverra sed, nullonecpo.\r\n\r\nVestibulum iaculis lacinia est. Proin dictum elementum velit. Fusce euismod consequat ante. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Pellentesque sed dolor. Aliquam congue fermentum nisl. Mauris accumsan nulla vel diam. Sed in lacus ut enim adipiscing aliquet. Nulla venenatis. In pede mi, aliquet sit amet, euismod in, auctor ut, ligula. Aliquam dapibus tincidunt metus. Praesent justo dolor, lobortis quis, lobortis dignissim, pulvinar ac, lorem. Vestibulum sed ante. Donec sagittis euismod purus.\r\n\r\nSed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatemNam elit magna, hendrerit sit amet, tincidunt ac, viverra sed, nullaonec po.\r\n', 'hendry', '2010-03-25 00:00:00', 'hendry', '2010-03-25 00:00:00'), ('2', 'Test article 2', 'Ipsum dolor sit amet, consectetuer adipiscing elit. Nullam consequat diam arcu. Donec sit amet orci sit amet lorem nonummy congue. In hac habitasse platea dictumst. Proin hendrerit pharetra nisl. Sed vestibulum porta augue suada justo eget aliquam volutpat ed vestibulum porta augue suada justo eget aliquam volutpat.', 'Ipsum dolor sit amet, consectetuer adipiscing elit. Nullam consequat diam arcu. Donec sit amet orci sit amet lorem nonummy congue. In hac habitasse platea dictumst. Proin hendrerit pharetra nisl. Sed vestibulum porta augue suada justo eget aliquam volutpat ed vestibulum porta augue suada justo eget aliquam volutpat.Ipsum dolor sit amet, consectetuer adipiscing elit. Nullam consequat diam arcu. Donec sit amet orci sit amet lorem nonummy congue. In hac habitasse platea dictumst. Proin hendrerit pharetra nisl. Sed vestibulum porta augue suada justo eget aliquam volutpat ed vestibulum porta augue suada justo eget aliquam volutpat.', 'hendry', '2010-03-25 00:00:00', 'hendry', '2010-03-25 00:00:00'), ('3', 'test article 3', 'Ipsum dolor sit amet, consectetuer adipiscing elit. Nullam consequat diam arcu. Donec sit amet orci sit amet lorem nonummy congue. In hac habitasse platea dictumst. Proin hendrerit pharetra nisl.', ' Sed vestibulum porta augue suada justo eget aliquam volutpat ed vestibulum porta augue suada justo eget aliquam volutpat. Aenean nec eros. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Suspendisse sollicitudin velit sed leo. Ut pharetra augue nec augue. Nam elit magna, hendrerit sit amet, tincidunt ac, viverra sed, nulla. Donec porta diam eu massa. Quisque diam lorem, interdum vitae, dapibus ac, scelerisque vitae, pede. Donec eget tellus non erat lacinia fermentum. Donec in velit vel ipsum auctor pulvinar. Proin ullamcorper urna et felisNam elit magna, hendrerit sit amet, tincidunt ac, viverra sed, nullonecpo. Vestibulum iaculis lacinia est. Proin dictum elementum velit. Fusce euismod consequat ante. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Pellentesque sed dolor. Aliquam congue fermentum nisl. Mauris accumsan nulla vel diam. Sed in lacus ut enim adipiscing aliquet. Nulla venenatis. In pede mi, aliquet sit amet, euismod in, auctor ut, ligula. Aliquam dapibus tincidunt metus. Praesent justo dolor, lobortis quis, lobortis dignissim, pulvinar ac, lorem. Vestibulum sed ante. Donec sagittis euismod purus. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatemNam elit magna, hendrerit sit amet, tincidunt ac, viverra sed, nullaonec po. \r\n', 'hendry', '2010-03-25 00:00:00', 'hendry', '2010-03-25 00:00:00');

-- ----------------------------
-- Table structure for `comments`
-- ----------------------------
DROP TABLE IF EXISTS `comments`;
CREATE TABLE `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(50) NOT NULL,
  `ids` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `subject` varchar(200) NOT NULL,
  `comment` varchar(200) NOT NULL,
  `status` varchar(50) NOT NULL,
  `user_created` varchar(100) NOT NULL,
  `date_created` datetime NOT NULL,
  `user_modified` varchar(100) NOT NULL,
  `date_modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of comments
-- ----------------------------
INSERT INTO `comments` VALUES ('1', 'articles', '1', 'hendry', 'ahh biasaaaaaaaaaaaaaaaaaaaaaaaaaa', 'ahhh biasa ajah.... ahhh biasa ajah.... ahhh biasa ajah.... ', '1', 'hendry', '2010-03-25 00:00:00', 'hendry', '2010-03-25 00:00:00'), ('2', 'news', '1', 'hendry', 'abcdef', 'hkjahsd kajshliuly3 kljhjakad kljhads', '1', 'hendry', '2010-03-26 00:00:00', 'hendry', '2010-03-26 00:00:00'), ('3', 'announcements', '1', 'hendry', 'lskdflk sdlfkj', 'ksldfkldsjlk sdlkfjsldkjf ldskjflkdsfj', '1', 'hendry', '2010-03-26 09:53:09', 'hendry', '2010-03-26 09:53:12'), ('4', 'news', '1', 'ahgsd', 'jdshdjjk khkhkhjlk', 'kjashdkjalshdkjh askdhaksd dkjhaskd asdkhashasd ', '1', 'sjadh', '2010-03-26 09:53:09', 'adas', '2010-03-26 09:53:09');

-- ----------------------------
-- Table structure for `news`
-- ----------------------------
DROP TABLE IF EXISTS `news`;
CREATE TABLE `news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subject` varchar(200) NOT NULL,
  `front` mediumtext NOT NULL,
  `content` longtext NOT NULL,
  `user_created` varchar(100) NOT NULL,
  `date_created` datetime NOT NULL,
  `user_modified` varchar(100) NOT NULL,
  `date_modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of news
-- ----------------------------
INSERT INTO `news` VALUES ('1', 'news 1', 'Quisque nulla. Vestibulum libero nisl, porta vel, scelerisque eget, malesuada at, neque. Vivamus eget nibh. Etiam cursus leo vel metus. Nulla facilisi.', 'Aenean nec eros. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Suspendisse sollicitudin velit sed leo. Ut pharetra augue nec augue. Nam elit magna, hendrerit sit amet, tincidunt ac, viverra sed, nulla. Donec porta diam eu massa. Quisque diam lorem, interdum vitae, dapibus ac, scelerisque vitae, pede. Donec eget tellus non erat lacinia fermentum. Donec in velit vel ipsum auctor pulvinar. Proin ullamcorper urna et felisNam elit magna, hendrerit sit amet, tincidunt ac, viverra sed, nullonecpo.\r\n\r\nVestibulum iaculis lacinia est. Proin dictum elementum velit. Fusce euismod consequat ante. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Pellentesque sed dolor. Aliquam congue fermentum nisl. Mauris accumsan nulla vel diam. Sed in lacus ut enim adipiscing aliquet. Nulla venenatis. In pede mi, aliquet sit amet, euismod in, auctor ut, ligula. Aliquam dapibus tincidunt metus. Praesent justo dolor, lobortis quis, lobortis dignissim, pulvinar ac, lorem. Vestibulum sed ante. Donec sagittis euismod purus.\r\n\r\nSed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatemNam elit magna, hendrerit sit amet, tincidunt ac, viverra sed, nullaonec po.\r\n', 'hendry', '2010-03-25 00:00:00', 'hendry', '2010-03-25 00:00:00'), ('2', 'news 2', 'Quisque nulla. Vestibulum libero nisl, porta vel, scelerisque eget, malesuada at, neque. Vivamus eget nibh. Etiam cursus leo vel metus. Nulla facilisi.', 'Aenean nec eros. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Suspendisse sollicitudin velit sed leo. Ut pharetra augue nec augue. Nam elit magna, hendrerit sit amet, tincidunt ac, viverra sed, nulla. Donec porta diam eu massa. Quisque diam lorem, interdum vitae, dapibus ac, scelerisque vitae, pede. Donec eget tellus non erat lacinia fermentum. Donec in velit vel ipsum auctor pulvinar. Proin ullamcorper urna et felisNam elit magna, hendrerit sit amet, tincidunt ac, viverra sed, nullonecpo.\r\n', 'hendry', '2010-03-25 00:00:00', 'hendry', '2010-03-25 00:00:00'), ('3', 'news 3', 'Quisque nulla. Vestibulum libero nisl, porta vel, scelerisque eget, malesuada at, neque. Vivamus eget nibh. Etiam cursus leo vel metus. Nulla facilisi.', 'Aenean nec eros. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Suspendisse sollicitudin velit sed leo. Ut pharetra augue nec augue. Nam elit magna, hendrerit sit amet, tincidunt ac, viverra sed, nulla. Donec porta diam eu massa. Quisque diam lorem, interdum vitae, dapibus ac, scelerisque vitae, pede. Donec eget tellus non erat lacinia fermentum. Donec in velit vel ipsum auctor pulvinar. Proin ullamcorper urna et felisNam elit magna, hendrerit sit amet, tincidunt ac, viverra sed, nullonecpo.\r\n', 'hendry', '2010-03-25 00:00:00', 'hendry', '2010-03-25 00:00:00'), ('4', 'news 4', 'Quisque nulla. Vestibulum libero nisl, porta vel, scelerisque eget, malesuada at, neque. Vivamus eget nibh. Etiam cursus leo vel metus. Nulla facilisi.', 'Aenean nec eros. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Suspendisse sollicitudin velit sed leo. Ut pharetra augue nec augue. Nam elit magna, hendrerit sit amet, tincidunt ac, viverra sed, nulla. Donec porta diam eu massa. Quisque diam lorem, interdum vitae, dapibus ac, scelerisque vitae, pede. Donec eget tellus non erat lacinia fermentum. Donec in velit vel ipsum auctor pulvinar. Proin ullamcorper urna et felisNam elit magna, hendrerit sit amet, tincidunt ac, viverra sed, nullonecpo.\r\n', 'hendry', '2010-03-25 00:00:00', 'hendry', '2010-03-25 00:00:00');

-- ----------------------------
-- View structure for `v_comments`
-- ----------------------------
DROP VIEW IF EXISTS `v_comments`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_comments` AS select `comments`.`id` AS `id`,`comments`.`type` AS `type`,`comments`.`ids` AS `ids`,`comments`.`name` AS `name`,`comments`.`subject` AS `subject`,`comments`.`comment` AS `comment`,`comments`.`status` AS `status`,`comments`.`user_created` AS `user_created`,`comments`.`date_created` AS `date_created`,`comments`.`user_modified` AS `user_modified`,`comments`.`date_modified` AS `date_modified`,`news`.`subject` AS `content_subject` from (`comments` join `news` on((`news`.`id` = `comments`.`ids`))) where (`comments`.`type` = 'news') union select `comments`.`id` AS `id`,`comments`.`type` AS `type`,`comments`.`ids` AS `ids`,`comments`.`name` AS `name`,`comments`.`subject` AS `subject`,`comments`.`comment` AS `comment`,`comments`.`status` AS `status`,`comments`.`user_created` AS `user_created`,`comments`.`date_created` AS `date_created`,`comments`.`user_modified` AS `user_modified`,`comments`.`date_modified` AS `date_modified`,`articles`.`subject` AS `content_subject` from (`comments` join `articles` on((`articles`.`id` = `comments`.`ids`))) where (`comments`.`type` = 'articles') union select `comments`.`id` AS `id`,`comments`.`type` AS `type`,`comments`.`ids` AS `ids`,`comments`.`name` AS `name`,`comments`.`subject` AS `subject`,`comments`.`comment` AS `comment`,`comments`.`status` AS `status`,`comments`.`user_created` AS `user_created`,`comments`.`date_created` AS `date_created`,`comments`.`user_modified` AS `user_modified`,`comments`.`date_modified` AS `date_modified`,`announcements`.`subject` AS `content_subject` from (`comments` join `announcements` on((`announcements`.`id` = `comments`.`ids`))) where (`comments`.`type` = 'announcements');

-- ----------------------------
-- View structure for `v_numofcomments`
-- ----------------------------
DROP VIEW IF EXISTS `v_numofcomments`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_numofcomments` AS select `comments`.`id` AS `id`,`comments`.`type` AS `type`,`comments`.`ids` AS `ids`,count(`comments`.`ids`) AS `Num` from `comments` group by `comments`.`type`,`comments`.`ids`;
