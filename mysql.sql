-- phpMyAdmin SQL Dump
-- version 4.0.10.9
-- http://www.phpmyadmin.net
--
-- 主機: localhost
-- 建立日期: 2015-12-10: 14:33:57
-- 伺服器版本: 5.6.21
-- PHP 版本: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 資料庫: `fanswoo_com_fanswoo`
--

-- --------------------------------------------------------

--
-- 資料表結構 `fs_advertising`
--

CREATE TABLE IF NOT EXISTS `fs_advertising` (
  `advertisingid` mediumint(8) NOT NULL,
  `uid` mediumint(8) NOT NULL,
  `title` char(100) NOT NULL,
  `href` char(100) NOT NULL,
  `content` text NOT NULL,
  `picids` char(100) NOT NULL,
  `classids` char(100) NOT NULL,
  `prioritynum` mediumint(8) NOT NULL,
  `updatetime` datetime NOT NULL,
  `status` int(1) NOT NULL,
  UNIQUE KEY `advertisingid` (`advertisingid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 資料表結構 `fs_class`
--

CREATE TABLE IF NOT EXISTS `fs_class` (
  `classid` mediumint(8) NOT NULL,
  `classname` char(40) NOT NULL,
  `slug` char(40) NOT NULL DEFAULT '',
  `content` char(200) NOT NULL,
  `uid` mediumint(8) NOT NULL,
  `amountnum` mediumint(4) NOT NULL DEFAULT '0',
  `modelname` char(32) NOT NULL DEFAULT '',
  `classids` char(100) NOT NULL,
  `prioritynum` mediumint(8) NOT NULL,
  `updatetime` datetime NOT NULL,
  `locale` char(5) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  UNIQUE KEY `classid` (`classid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 資料表的匯出資料 `fs_class`
--

INSERT INTO `fs_class` (`classid`, `classname`, `slug`, `content`, `uid`, `amountnum`, `modelname`, `classids`, `prioritynum`, `updatetime`, `locale`, `status`) VALUES
(1, 'A級形象網站', 'a035b87f', '', 528502, 0, 'project', '5', 0, '2015-12-04 14:32:09', 'zh-TW', 1),
(2, 'A+級形象網站', '8f1225c7', '', 528502, 0, 'project', '5', 0, '2015-12-04 14:32:05', 'zh-TW', 1),
(3, 'A級購物網站', '2a1069c2', '', 528502, 0, 'project', '6', 0, '2015-12-04 14:32:02', 'zh-TW', 1),
(4, 'A+級購物網站', 'f495dcfe', '', 528502, 0, 'project', '6', 0, '2015-12-04 14:31:57', 'zh-TW', 1),
(5, '形象網站', 'bfe2f174', '', 528501, 0, 'project_class2', '', 0, '2015-12-04 14:26:06', 'zh-TW', 1),
(6, '購物網站', 'bafb9971', '', 528501, 0, 'project_class2', '', 0, '2015-12-04 14:26:12', 'zh-TW', 1),
(8, '美術設計', '7390d081', '', 528501, 0, 'design_class2', '', 0, '2015-12-08 17:44:17', 'zh-TW', 1),
(7, '系統開發', '2beaa290', '', 528501, 0, 'design_class2', '', 0, '2015-12-08 17:43:36', 'zh-TW', 1),
(13, '頁面美術設計(PC)', 'd36a9aed', '', 528501, 0, 'design', '8', 0, '2015-12-08 17:49:36', 'zh-TW', 1),
(11, '主視覺設計(PC)', '8b3bb734', '', 528501, 0, 'design', '8', 0, '2015-12-08 17:53:26', 'zh-TW', 1),
(10, 'PHP購物系統', 'dea9bc30', '', 528501, 0, 'design', '7', 0, '2015-12-08 17:48:01', 'zh-TW', 1),
(14, '頁面美術設計(Mobile)', 'c5a8d9c0', '', 528501, 0, 'design', '8', 0, '2015-12-08 17:49:29', 'zh-TW', 1),
(12, '主視覺設計(Mobile)', 'e42b0cfd', '', 528501, 0, 'design', '8', 0, '2015-12-08 17:53:46', 'zh-TW', 1),
(9, 'PHP基本管理', '3cf9bcee', '', 528501, 0, 'design', '7', 0, '2015-12-08 17:47:57', 'zh-TW', 1);

-- --------------------------------------------------------

--
-- 資料表結構 `fs_comment`
--

CREATE TABLE IF NOT EXISTS `fs_comment` (
  `commentid` mediumint(8) NOT NULL,
  `uid` mediumint(8) NOT NULL,
  `typename` char(100) NOT NULL,
  `id` mediumint(8) NOT NULL,
  `title` char(100) DEFAULT NULL,
  `content` text,
  `updatetime` datetime NOT NULL,
  `status` int(1) NOT NULL,
  UNIQUE KEY `commentid` (`commentid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 資料表的匯出資料 `fs_comment`
--

INSERT INTO `fs_comment` (`commentid`, `uid`, `typename`, `id`, `title`, `content`, `updatetime`, `status`) VALUES
(1, 528501, 'order', 1, '', 'hello', '2015-11-20 10:38:01', 1),
(2, 528505, 'order', 1, '', 'hi', '2015-11-20 10:42:13', 1),
(3, 528501, 'project', 5, '', 'test1', '2015-12-03 16:22:52', 1),
(4, 528501, 'project', 5, '', 'test2', '2015-12-03 16:27:05', 1);

-- --------------------------------------------------------

--
-- 資料表結構 `fs_contact`
--

CREATE TABLE IF NOT EXISTS `fs_contact` (
  `contactid` mediumint(8) NOT NULL,
  `username` char(100) NOT NULL,
  `email` char(100) NOT NULL,
  `phone` char(100) NOT NULL,
  `company` char(100) NOT NULL,
  `content` text NOT NULL,
  `status_process` int(11) NOT NULL,
  `classtype` char(100) NOT NULL,
  `classtype2` char(100) NOT NULL,
  `address` char(100) NOT NULL,
  `money` char(100) NOT NULL,
  `updatetime` datetime NOT NULL,
  `status` int(1) NOT NULL,
  UNIQUE KEY `contactid` (`contactid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 資料表的匯出資料 `fs_contact`
--

INSERT INTO `fs_contact` (`contactid`, `username`, `email`, `phone`, `company`, `content`, `status_process`, `classtype`, `classtype2`, `address`, `money`, `updatetime`, `status`) VALUES
(1, 'Mimi', 'mimi@fanswoo.com', '0912345678', 'fanswoo', 'Hello', 1, '程式系統開發', '手機App開發', '台北市重慶北路四段 248 號 3 樓', '15萬元以下', '2015-10-14 16:12:59', 1);

-- --------------------------------------------------------

--
-- 資料表結構 `fs_file`
--

CREATE TABLE IF NOT EXISTS `fs_file` (
  `fileid` mediumint(8) NOT NULL,
  `uid` mediumint(8) NOT NULL,
  `title` char(100) CHARACTER SET utf8 NOT NULL,
  `filename` char(100) CHARACTER SET utf8 NOT NULL,
  `size` mediumint(8) NOT NULL,
  `type` char(32) CHARACTER SET utf8 NOT NULL,
  `md5` char(16) CHARACTER SET utf8 NOT NULL,
  `classids` char(100) CHARACTER SET utf8 NOT NULL,
  `permission_uids` char(100) NOT NULL,
  `thumb` char(100) CHARACTER SET utf8 NOT NULL,
  `prioritynum` mediumint(8) NOT NULL,
  `updatetime` datetime NOT NULL,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`fileid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- 資料表結構 `fs_note`
--

CREATE TABLE IF NOT EXISTS `fs_note` (
  `noteid` mediumint(8) unsigned NOT NULL,
  `uid` mediumint(8) NOT NULL DEFAULT '0',
  `title` char(50) NOT NULL DEFAULT '',
  `username` char(30) NOT NULL DEFAULT '',
  `slug` char(100) NOT NULL,
  `picids` char(100) NOT NULL DEFAULT '',
  `classids` char(100) NOT NULL DEFAULT '',
  `modelname` char(100) NOT NULL DEFAULT '',
  `viewnum` mediumint(8) NOT NULL DEFAULT '0',
  `replynum` mediumint(8) NOT NULL DEFAULT '0',
  `prioritynum` mediumint(8) NOT NULL DEFAULT '0',
  `updatetime` datetime NOT NULL,
  `locale` char(5) NOT NULL,
  `shelves_status` int(1) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  UNIQUE KEY `noteid` (`noteid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 資料表的匯出資料 `fs_note`
--

INSERT INTO `fs_note` (`noteid`, `uid`, `title`, `username`, `slug`, `picids`, `classids`, `modelname`, `viewnum`, `replynum`, `prioritynum`, `updatetime`, `locale`, `shelves_status`, `status`) VALUES
(528501, 528501, '網頁設計的價差為什麼這麼大？在花錢買教訓之前，先瞭解台灣網頁設計的市場現況', '', '', '4', '', 'note', 0, 0, 0, '2015-07-09 02:23:26', 'zh-TW', 1, 1),
(528502, 528501, '誰說投資一定要花錢？不花錢的投資才是真正的投資', '', '', '5', '', 'note', 0, 0, 0, '2015-07-09 02:25:20', 'zh-TW', 1, 1);

-- --------------------------------------------------------

--
-- 資料表結構 `fs_note_field`
--

CREATE TABLE IF NOT EXISTS `fs_note_field` (
  `noteid` mediumint(8) NOT NULL,
  `content` text NOT NULL,
  UNIQUE KEY `noteid` (`noteid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 資料表的匯出資料 `fs_note_field`
--

INSERT INTO `fs_note_field` (`noteid`, `content`) VALUES
(528501, '<img src="http://news.xinhuanet.com/finance/2010-02/05/xinsrc_4420207051423171232418.jpg" style="font-family: ''Noto Sans CJK TC'', ''LiHei Pro'', 儷黑體, sans-serif; border: 0px; width: 520px; max-height: 520px; color: rgb(85, 85, 85); font-size: 15px; line-height: 30px;" /><br style="font-family: ''Noto Sans CJK TC'', ''LiHei Pro'', 儷黑體, sans-serif; color: rgb(85, 85, 85); font-size: 15px; line-height: 30px;" />\r\n<br style="font-family: ''Noto Sans CJK TC'', ''LiHei Pro'', 儷黑體, sans-serif; color: rgb(85, 85, 85); font-size: 15px; line-height: 30px;" />\r\n<span style="color: rgb(85, 85, 85); font-family: ''Noto Sans CJK TC'', ''LiHei Pro'', 儷黑體, sans-serif; font-size: 15px; line-height: 30px;">網路開店真的那麼簡單？</span><br style="font-family: ''Noto Sans CJK TC'', ''LiHei Pro'', 儷黑體, sans-serif; color: rgb(85, 85, 85); font-size: 15px; line-height: 30px;" />\r\n<br style="font-family: ''Noto Sans CJK TC'', ''LiHei Pro'', 儷黑體, sans-serif; color: rgb(85, 85, 85); font-size: 15px; line-height: 30px;" />\r\n<span style="color: rgb(85, 85, 85); font-family: ''Noto Sans CJK TC'', ''LiHei Pro'', 儷黑體, sans-serif; font-size: 15px; line-height: 30px;">很多業者都以為架設網路商店很簡單，只要網路商店開張了，自然就會有訂單流進來，直到購物網站架設好了，才發現購物網站竟然只有少少的訂單，是購物網站不好做嗎？當然不是，是業者對網路的行銷模式和經營經驗不足。</span><br style="font-family: ''Noto Sans CJK TC'', ''LiHei Pro'', 儷黑體, sans-serif; color: rgb(85, 85, 85); font-size: 15px; line-height: 30px;" />\r\n<br style="font-family: ''Noto Sans CJK TC'', ''LiHei Pro'', 儷黑體, sans-serif; color: rgb(85, 85, 85); font-size: 15px; line-height: 30px;" />\r\n<span style="color: rgb(85, 85, 85); font-family: ''Noto Sans CJK TC'', ''LiHei Pro'', 儷黑體, sans-serif; font-size: 15px; line-height: 30px;">其實開一間購物網站與開一間實體店面是一樣的道理，若是租了一間在深山裡、無人知曉的店面，每個月的人流肯定很稀疏，但若是一間每個月20萬元租在台北市西門町的實體店面，每個月自然有大量的人流，網路開店也是同理，在網路上架設一間網路商店，就如同開一間實體店面一般，只要網站每個月撥出一定的行銷預算，就會有一定的人流，而且網路上的人流比起實體店面的人流更容易創造，網路商店的行銷預算性價比也較實體店面更高，但絕不是想像中的「只要架設購物網站就有訂單」那麼簡單。</span><br style="font-family: ''Noto Sans CJK TC'', ''LiHei Pro'', 儷黑體, sans-serif; color: rgb(85, 85, 85); font-size: 15px; line-height: 30px;" />\r\n<br style="font-family: ''Noto Sans CJK TC'', ''LiHei Pro'', 儷黑體, sans-serif; color: rgb(85, 85, 85); font-size: 15px; line-height: 30px;" />\r\n<br style="font-family: ''Noto Sans CJK TC'', ''LiHei Pro'', 儷黑體, sans-serif; color: rgb(85, 85, 85); font-size: 15px; line-height: 30px;" />\r\n<br style="font-family: ''Noto Sans CJK TC'', ''LiHei Pro'', 儷黑體, sans-serif; color: rgb(85, 85, 85); font-size: 15px; line-height: 30px;" />\r\n<span style="color: rgb(85, 85, 85); font-family: ''Noto Sans CJK TC'', ''LiHei Pro'', 儷黑體, sans-serif; font-size: 15px; line-height: 30px;">網路上的免費開店平台真的是零成本嗎？</span><br style="font-family: ''Noto Sans CJK TC'', ''LiHei Pro'', 儷黑體, sans-serif; color: rgb(85, 85, 85); font-size: 15px; line-height: 30px;" />\r\n<br style="font-family: ''Noto Sans CJK TC'', ''LiHei Pro'', 儷黑體, sans-serif; color: rgb(85, 85, 85); font-size: 15px; line-height: 30px;" />\r\n<span style="color: rgb(85, 85, 85); font-family: ''Noto Sans CJK TC'', ''LiHei Pro'', 儷黑體, sans-serif; font-size: 15px; line-height: 30px;">有些人認為架設購物網站是零成本的生意，雖然架設購物網站的成本相對實體店面要低得多，但抱持著零成本的心態經營，是絕對不會有好收穫的，網路上有不少號稱零成本的開店平台，但這些號稱零成本的平台仍然需要收取廣告費、交易費、空間費等費用，而在這種免費平台中販售產品的業者，若是沒有每個月花費少則數千元、多則數十萬元的廣告費用，那麼消費者要搜尋到未付廣告費的產品，就像是在大海裡撈針，產品永遠石沉大海、乏人問津。</span><br style="font-family: ''Noto Sans CJK TC'', ''LiHei Pro'', 儷黑體, sans-serif; color: rgb(85, 85, 85); font-size: 15px; line-height: 30px;" />\r\n<br style="font-family: ''Noto Sans CJK TC'', ''LiHei Pro'', 儷黑體, sans-serif; color: rgb(85, 85, 85); font-size: 15px; line-height: 30px;" />\r\n<span style="color: rgb(85, 85, 85); font-family: ''Noto Sans CJK TC'', ''LiHei Pro'', 儷黑體, sans-serif; font-size: 15px; line-height: 30px;">因此只要稍有知名度的企業，多是選擇開發獨立的購物網站，而非與一群競爭激烈的個人店家在免費的購物平台攪和，擁有獨立的會員系統是一項重要的因素，對於業者來說，花了大筆廣告預算好不容易觸及到的消費者，不該僅有一次性的消費，而必須盡可能留下會員資料，並以電子報、社群功能等使消費者重複購物，為購物網站後續產生更多持續性的獲利。</span><br style="font-family: ''Noto Sans CJK TC'', ''LiHei Pro'', 儷黑體, sans-serif; color: rgb(85, 85, 85); font-size: 15px; line-height: 30px;" />\r\n<br style="font-family: ''Noto Sans CJK TC'', ''LiHei Pro'', 儷黑體, sans-serif; color: rgb(85, 85, 85); font-size: 15px; line-height: 30px;" />\r\n<span style="color: rgb(85, 85, 85); font-family: ''Noto Sans CJK TC'', ''LiHei Pro'', 儷黑體, sans-serif; font-size: 15px; line-height: 30px;">除了擁有獨立的會員系統、獨立的金流系統以外，最重要的是免費平台僅有平台的使用權，而非擁有該平台的所有權，因此就算花費大筆鈔票真的在免費平台上做出了口碑，後續想要架設自己的購物網站，就像是擺路邊攤的攤販改為店面經營一樣，一旦轉換平台便會流失大量既有的消費者，且會員資料必須全部從零開始累積，為了省錢而使用免費平台，反而在省錢的過程中繞了一大圈。</span><br style="font-family: ''Noto Sans CJK TC'', ''LiHei Pro'', 儷黑體, sans-serif; color: rgb(85, 85, 85); font-size: 15px; line-height: 30px;" />\r\n<br style="font-family: ''Noto Sans CJK TC'', ''LiHei Pro'', 儷黑體, sans-serif; color: rgb(85, 85, 85); font-size: 15px; line-height: 30px;" />\r\n<br style="font-family: ''Noto Sans CJK TC'', ''LiHei Pro'', 儷黑體, sans-serif; color: rgb(85, 85, 85); font-size: 15px; line-height: 30px;" />\r\n<br style="font-family: ''Noto Sans CJK TC'', ''LiHei Pro'', 儷黑體, sans-serif; color: rgb(85, 85, 85); font-size: 15px; line-height: 30px;" />\r\n<span style="color: rgb(85, 85, 85); font-family: ''Noto Sans CJK TC'', ''LiHei Pro'', 儷黑體, sans-serif; font-size: 15px; line-height: 30px;">架設購物網站會有哪些費用？</span><br style="font-family: ''Noto Sans CJK TC'', ''LiHei Pro'', 儷黑體, sans-serif; color: rgb(85, 85, 85); font-size: 15px; line-height: 30px;" />\r\n<br style="font-family: ''Noto Sans CJK TC'', ''LiHei Pro'', 儷黑體, sans-serif; color: rgb(85, 85, 85); font-size: 15px; line-height: 30px;" />\r\n<span style="color: rgb(85, 85, 85); font-family: ''Noto Sans CJK TC'', ''LiHei Pro'', 儷黑體, sans-serif; font-size: 15px; line-height: 30px;">開設網路商店在初期會花到的費用有購物網站的開發費用、網路行銷費用、人員薪資等等，而開發一個購物網站就像是為一間實體店面裝潢一樣，購物網站的設計好壞，有非常大的比例影響到一個消費者的購物決定，也進而影響到購物網站的營業收入，雖然開發一個功能齊全的獨立購物網站，至少需要二十萬元以上的開發預算，且若是希望購物網站具有質感或是與眾不同的系統設計，更會因為業者的需求，可能花上幾十萬元、上百萬元以上的價格。</span><br style="font-family: ''Noto Sans CJK TC'', ''LiHei Pro'', 儷黑體, sans-serif; color: rgb(85, 85, 85); font-size: 15px; line-height: 30px;" />\r\n<br style="font-family: ''Noto Sans CJK TC'', ''LiHei Pro'', 儷黑體, sans-serif; color: rgb(85, 85, 85); font-size: 15px; line-height: 30px;" />\r\n<span style="color: rgb(85, 85, 85); font-family: ''Noto Sans CJK TC'', ''LiHei Pro'', 儷黑體, sans-serif; font-size: 15px; line-height: 30px;">坊間仍有業者喊出開發費用只要十萬元以下的獨立購物網站，但這些號稱十萬元以下的購物網站，絕大多數都是假的獨立購物網站，這些購物網站看似擁有不同的外觀，然而對於網站資料庫、會員系統等卻沒有所有權，一切資料和所有權等重要的權力仍然在開發公司手上。</span><br style="font-family: ''Noto Sans CJK TC'', ''LiHei Pro'', 儷黑體, sans-serif; color: rgb(85, 85, 85); font-size: 15px; line-height: 30px;" />\r\n<br style="font-family: ''Noto Sans CJK TC'', ''LiHei Pro'', 儷黑體, sans-serif; color: rgb(85, 85, 85); font-size: 15px; line-height: 30px;" />\r\n<span style="color: rgb(85, 85, 85); font-family: ''Noto Sans CJK TC'', ''LiHei Pro'', 儷黑體, sans-serif; font-size: 15px; line-height: 30px;">除了購物網站的開發成本，另一個影響購物網站成敗的重要因素則是網路行銷，網路行銷的預算隨業者的行銷策略會有不同的成本，通常以購買廣告刊版、關鍵字廣告而有不等的費用，也有的業者以舉辦活動搭配贈品的方式行銷，而網路行銷講求的是創意，只要能利用創意吸引消費者的注意力，即使僅有少少的行銷預算，也有可能為購物網站創造一夕之間爆紅的可能性。</span><br style="font-family: ''Noto Sans CJK TC'', ''LiHei Pro'', 儷黑體, sans-serif; color: rgb(85, 85, 85); font-size: 15px; line-height: 30px;" />\r\n<br style="font-family: ''Noto Sans CJK TC'', ''LiHei Pro'', 儷黑體, sans-serif; color: rgb(85, 85, 85); font-size: 15px; line-height: 30px;" />\r\n<br style="font-family: ''Noto Sans CJK TC'', ''LiHei Pro'', 儷黑體, sans-serif; color: rgb(85, 85, 85); font-size: 15px; line-height: 30px;" />\r\n<br style="font-family: ''Noto Sans CJK TC'', ''LiHei Pro'', 儷黑體, sans-serif; color: rgb(85, 85, 85); font-size: 15px; line-height: 30px;" />\r\n<span style="color: rgb(85, 85, 85); font-family: ''Noto Sans CJK TC'', ''LiHei Pro'', 儷黑體, sans-serif; font-size: 15px; line-height: 30px;">比起實體店面，購物網站的優勢在哪裡？</span><br style="font-family: ''Noto Sans CJK TC'', ''LiHei Pro'', 儷黑體, sans-serif; color: rgb(85, 85, 85); font-size: 15px; line-height: 30px;" />\r\n<br style="font-family: ''Noto Sans CJK TC'', ''LiHei Pro'', 儷黑體, sans-serif; color: rgb(85, 85, 85); font-size: 15px; line-height: 30px;" />\r\n<span style="color: rgb(85, 85, 85); font-family: ''Noto Sans CJK TC'', ''LiHei Pro'', 儷黑體, sans-serif; font-size: 15px; line-height: 30px;">庫存壓力：實體店面&gt;購物網站（大至小）</span><br style="font-family: ''Noto Sans CJK TC'', ''LiHei Pro'', 儷黑體, sans-serif; color: rgb(85, 85, 85); font-size: 15px; line-height: 30px;" />\r\n<span style="color: rgb(85, 85, 85); font-family: ''Noto Sans CJK TC'', ''LiHei Pro'', 儷黑體, sans-serif; font-size: 15px; line-height: 30px;">消費者觸及率：購物網站&gt;實體店面（多至少）</span><br style="font-family: ''Noto Sans CJK TC'', ''LiHei Pro'', 儷黑體, sans-serif; color: rgb(85, 85, 85); font-size: 15px; line-height: 30px;" />\r\n<span style="color: rgb(85, 85, 85); font-family: ''Noto Sans CJK TC'', ''LiHei Pro'', 儷黑體, sans-serif; font-size: 15px; line-height: 30px;">行銷工具：購物網站&gt;實體店面（多至少）</span><br style="font-family: ''Noto Sans CJK TC'', ''LiHei Pro'', 儷黑體, sans-serif; color: rgb(85, 85, 85); font-size: 15px; line-height: 30px;" />\r\n<span style="color: rgb(85, 85, 85); font-family: ''Noto Sans CJK TC'', ''LiHei Pro'', 儷黑體, sans-serif; font-size: 15px; line-height: 30px;">統計資料：購物網站&gt;實體店面（多至少）</span><br style="font-family: ''Noto Sans CJK TC'', ''LiHei Pro'', 儷黑體, sans-serif; color: rgb(85, 85, 85); font-size: 15px; line-height: 30px;" />\r\n<br style="font-family: ''Noto Sans CJK TC'', ''LiHei Pro'', 儷黑體, sans-serif; color: rgb(85, 85, 85); font-size: 15px; line-height: 30px;" />\r\n<span style="color: rgb(85, 85, 85); font-family: ''Noto Sans CJK TC'', ''LiHei Pro'', 儷黑體, sans-serif; font-size: 15px; line-height: 30px;">電子商務這種東西看似簡單，卻又有不少智慧藏在裡頭，比起實體店面，購物網站少了實體店面的庫存壓力，甚至一個購物網站就能夠觸及世界各地的消費者，除了不會受到區域性的限制，在行銷工具的操作選擇上也更多，而且還能透過更多的科學統計，來計算消費者的來客率和購買轉換率，比起實體店面還是有相當大的優勢，但要如何正確的操作這些資源，就要仰賴業者能否確實瞭解網路產業的相關資訊，時時刻刻將資訊保持在最尖端，才能確保不被變化快速的網路市場給淘汰。</span>'),
(528502, '<img src="http://www.artdes.monash.edu.au/design/assets/design_courses_communication.jpg" style="font-family: ''Noto Sans CJK TC'', ''LiHei Pro'', 儷黑體, sans-serif; border: 0px; width: 520px; max-height: 520px; color: rgb(85, 85, 85); font-size: 15px; line-height: 30px;" /><br style="font-family: ''Noto Sans CJK TC'', ''LiHei Pro'', 儷黑體, sans-serif; color: rgb(85, 85, 85); font-size: 15px; line-height: 30px;" />\r\n<br style="font-family: ''Noto Sans CJK TC'', ''LiHei Pro'', 儷黑體, sans-serif; color: rgb(85, 85, 85); font-size: 15px; line-height: 30px;" />\r\n<span style="color: rgb(85, 85, 85); font-family: ''Noto Sans CJK TC'', ''LiHei Pro'', 儷黑體, sans-serif; font-size: 15px; line-height: 30px;">投資必備的條件是金錢？</span><br style="font-family: ''Noto Sans CJK TC'', ''LiHei Pro'', 儷黑體, sans-serif; color: rgb(85, 85, 85); font-size: 15px; line-height: 30px;" />\r\n<br style="font-family: ''Noto Sans CJK TC'', ''LiHei Pro'', 儷黑體, sans-serif; color: rgb(85, 85, 85); font-size: 15px; line-height: 30px;" />\r\n<span style="color: rgb(85, 85, 85); font-family: ''Noto Sans CJK TC'', ''LiHei Pro'', 儷黑體, sans-serif; font-size: 15px; line-height: 30px;">在這個升職加薪不易的年代，我們都知道光是上班賺錢、存錢是很難達到財務自由的，而投資則是致富最好的管道之一，但許多人提及「投資」這個名詞時，想到的總是「投資不是我玩得起的」因為「需要很多錢」，然而投資最重要的條件真的是錢嗎？</span><br style="font-family: ''Noto Sans CJK TC'', ''LiHei Pro'', 儷黑體, sans-serif; color: rgb(85, 85, 85); font-size: 15px; line-height: 30px;" />\r\n<br style="font-family: ''Noto Sans CJK TC'', ''LiHei Pro'', 儷黑體, sans-serif; color: rgb(85, 85, 85); font-size: 15px; line-height: 30px;" />\r\n<span style="color: rgb(85, 85, 85); font-family: ''Noto Sans CJK TC'', ''LiHei Pro'', 儷黑體, sans-serif; font-size: 15px; line-height: 30px;">根據美國的統計，中樂透獲得大筆獎金的樂透富翁，平均在五年以內會把獎金花光，而且許多人的生活反而變得比中樂透之前更糟糕，先不論這些樂透富翁到底是怎麼花錢的，在這個統計之中最值得注意的應該是「為什麼一般人留不住大筆的樂透獎金？」，因為這些中樂透的樂透富翁，並不具備投資理財的知識和心理素質，他們總是搞不清楚投資和支出的差別，也分不出機會和風險的差異性，即使理財專員告知他們可能賺錢的投資機會，他們也不具備辨識機會和風險的能力，還可能弄巧成拙，錯把風險當作機會、把支出當作投資，最後當然就是大筆大筆的把鈔票全部消耗殆盡了。</span><br style="font-family: ''Noto Sans CJK TC'', ''LiHei Pro'', 儷黑體, sans-serif; color: rgb(85, 85, 85); font-size: 15px; line-height: 30px;" />\r\n<br style="font-family: ''Noto Sans CJK TC'', ''LiHei Pro'', 儷黑體, sans-serif; color: rgb(85, 85, 85); font-size: 15px; line-height: 30px;" />\r\n<br style="font-family: ''Noto Sans CJK TC'', ''LiHei Pro'', 儷黑體, sans-serif; color: rgb(85, 85, 85); font-size: 15px; line-height: 30px;" />\r\n<br style="font-family: ''Noto Sans CJK TC'', ''LiHei Pro'', 儷黑體, sans-serif; color: rgb(85, 85, 85); font-size: 15px; line-height: 30px;" />\r\n<span style="color: rgb(85, 85, 85); font-family: ''Noto Sans CJK TC'', ''LiHei Pro'', 儷黑體, sans-serif; font-size: 15px; line-height: 30px;">不花錢也可以投資嗎？</span><br style="font-family: ''Noto Sans CJK TC'', ''LiHei Pro'', 儷黑體, sans-serif; color: rgb(85, 85, 85); font-size: 15px; line-height: 30px;" />\r\n<br style="font-family: ''Noto Sans CJK TC'', ''LiHei Pro'', 儷黑體, sans-serif; color: rgb(85, 85, 85); font-size: 15px; line-height: 30px;" />\r\n<span style="color: rgb(85, 85, 85); font-family: ''Noto Sans CJK TC'', ''LiHei Pro'', 儷黑體, sans-serif; font-size: 15px; line-height: 30px;">如果手上沒有現金投資別人的公司，若是具備足夠的知識、經驗、人脈，即使不需要任何金錢也可以投資，只要擁有足夠的能力，不但不必投資別人的公司，甚至還可以讓別人抱著鈔票投資自己的公司，當然前提是必須具備讓人信任這間公司的條件，例如：一款創新的產品、一個獨家的技術、一份具潛力的創業企劃書。</span><br style="font-family: ''Noto Sans CJK TC'', ''LiHei Pro'', 儷黑體, sans-serif; color: rgb(85, 85, 85); font-size: 15px; line-height: 30px;" />\r\n<br style="font-family: ''Noto Sans CJK TC'', ''LiHei Pro'', 儷黑體, sans-serif; color: rgb(85, 85, 85); font-size: 15px; line-height: 30px;" />\r\n<span style="color: rgb(85, 85, 85); font-family: ''Noto Sans CJK TC'', ''LiHei Pro'', 儷黑體, sans-serif; font-size: 15px; line-height: 30px;">任何投資都是有風險的，也因為比別人多承擔了風險，才會有豐厚的報酬，雖然投資者不可能將風險控制為零，但厲害的投資者卻能透過知識、經驗、人脈了解每一個投資的風險高低，並且把投資風險控制在容許的範圍內，因此我們能說，投資賺不賺錢，最重要的重點並不在於「手上有多少錢」，而是在於「專業能力」和「投資眼光的精準度」。</span><br style="font-family: ''Noto Sans CJK TC'', ''LiHei Pro'', 儷黑體, sans-serif; color: rgb(85, 85, 85); font-size: 15px; line-height: 30px;" />\r\n<br style="font-family: ''Noto Sans CJK TC'', ''LiHei Pro'', 儷黑體, sans-serif; color: rgb(85, 85, 85); font-size: 15px; line-height: 30px;" />\r\n<br style="font-family: ''Noto Sans CJK TC'', ''LiHei Pro'', 儷黑體, sans-serif; color: rgb(85, 85, 85); font-size: 15px; line-height: 30px;" />\r\n<br style="font-family: ''Noto Sans CJK TC'', ''LiHei Pro'', 儷黑體, sans-serif; color: rgb(85, 85, 85); font-size: 15px; line-height: 30px;" />\r\n<span style="color: rgb(85, 85, 85); font-family: ''Noto Sans CJK TC'', ''LiHei Pro'', 儷黑體, sans-serif; font-size: 15px; line-height: 30px;">[size=150]投資別人之前，必須先投資自己[/size]</span><br style="font-family: ''Noto Sans CJK TC'', ''LiHei Pro'', 儷黑體, sans-serif; color: rgb(85, 85, 85); font-size: 15px; line-height: 30px;" />\r\n<br style="font-family: ''Noto Sans CJK TC'', ''LiHei Pro'', 儷黑體, sans-serif; color: rgb(85, 85, 85); font-size: 15px; line-height: 30px;" />\r\n<span style="color: rgb(85, 85, 85); font-family: ''Noto Sans CJK TC'', ''LiHei Pro'', 儷黑體, sans-serif; font-size: 15px; line-height: 30px;">投資並非僅指金融證券、房地產上的有形體的投資，真正的投資應該在於知識、經驗、人脈上的無形投資，只有累積足夠的知識、經驗和人脈，才有可能透過投資賺錢，甚至讓人們跟著自己投資。</span><br style="font-family: ''Noto Sans CJK TC'', ''LiHei Pro'', 儷黑體, sans-serif; color: rgb(85, 85, 85); font-size: 15px; line-height: 30px;" />\r\n<br style="font-family: ''Noto Sans CJK TC'', ''LiHei Pro'', 儷黑體, sans-serif; color: rgb(85, 85, 85); font-size: 15px; line-height: 30px;" />\r\n<span style="color: rgb(85, 85, 85); font-family: ''Noto Sans CJK TC'', ''LiHei Pro'', 儷黑體, sans-serif; font-size: 15px; line-height: 30px;">人生是一條不斷面臨投資選擇的岔路，當我們選擇閱讀的書籍時屬於知識的投資，當我們在做每一件不同的工作時是經驗的投資，當我們在跟不同的朋友握手的時候則是人脈的投資，首先拋開「投資不是我玩得起的」的觀念，在腦海中劃出一條屬於自己的、清晰的道路，時時刻刻告訴自己「現在我做的事，決定我五年以後過的生活」，想要在未來的某一天能夠獲得財務自由，不但要走出自己的舒適圈，還要勇敢的投資自己。</span>');

-- --------------------------------------------------------

--
-- 資料表結構 `fs_pager`
--

CREATE TABLE IF NOT EXISTS `fs_pager` (
  `pagerid` mediumint(8) unsigned NOT NULL,
  `uid` mediumint(8) NOT NULL,
  `username` char(30) NOT NULL,
  `title` char(100) NOT NULL,
  `slug` char(100) NOT NULL,
  `href` char(100) NOT NULL,
  `classids` char(100) NOT NULL,
  `target` int(1) NOT NULL,
  `viewnum` mediumint(8) NOT NULL,
  `prioritynum` mediumint(8) NOT NULL,
  `updatetime` datetime NOT NULL,
  `locale` char(5) NOT NULL,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`pagerid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 資料表結構 `fs_pager_field`
--

CREATE TABLE IF NOT EXISTS `fs_pager_field` (
  `pagerid` mediumint(8) unsigned NOT NULL,
  `content` text NOT NULL,
  PRIMARY KEY (`pagerid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 資料表結構 `fs_pic`
--

CREATE TABLE IF NOT EXISTS `fs_pic` (
  `picid` mediumint(8) NOT NULL,
  `uid` mediumint(8) NOT NULL,
  `title` char(100) NOT NULL,
  `filename` char(100) NOT NULL,
  `size` mediumint(8) NOT NULL,
  `type` char(32) NOT NULL,
  `md5` char(16) NOT NULL,
  `classids` char(100) NOT NULL,
  `thumb` char(100) NOT NULL,
  `prioritynum` mediumint(8) NOT NULL,
  `updatetime` datetime NOT NULL,
  `status` int(1) NOT NULL,
  UNIQUE KEY `picid` (`picid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 資料表的匯出資料 `fs_pic`
--

INSERT INTO `fs_pic` (`picid`, `uid`, `title`, `filename`, `size`, `type`, `md5`, `classids`, `thumb`, `prioritynum`, `updatetime`, `status`) VALUES
(4, 528501, 'note1.jpg', 'note1.jpg', 49556, 'image/jpeg', '941ad429e9543e57', '', 'w50h50,w300h300,w600h600', 0, '2015-10-14 14:52:51', 1),
(5, 528501, 'note2.jpg', 'note2.jpg', 226158, 'image/jpeg', '9f56fab9f42c1cd3', '', 'w50h50,w300h300,w600h600', 0, '2015-10-14 14:53:00', 1);

-- --------------------------------------------------------

--
-- 資料表結構 `fs_project`
--

CREATE TABLE IF NOT EXISTS `fs_project` (
  `projectid` mediumint(8) NOT NULL,
  `uid` mediumint(8) NOT NULL,
  `name` char(100) NOT NULL,
  `permission_uids` char(100) NOT NULL,
  `working_days` mediumint(8) NOT NULL,
  `classids` char(100) NOT NULL,
  `designids` char(200) NOT NULL,
  `pay_name` char(32) NOT NULL,
  `pay_account` char(50) NOT NULL,
  `pay_price_total` mediumint(10) NOT NULL,
  `pay_price_receive` mediumint(10) NOT NULL,
  `pay_price_schedule` mediumint(3) NOT NULL,
  `pay_paytime` datetime NOT NULL,
  `pay_remark` text NOT NULL,
  `pay_status` int(1) NOT NULL,
  `paycheck_status` int(1) NOT NULL,
  `project_status` int(1) NOT NULL,
  `setuptime` datetime NOT NULL,
  `updatetime` datetime NOT NULL,
  `status` int(1) NOT NULL,
  UNIQUE KEY `projectid` (`projectid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 資料表的匯出資料 `fs_project`
--

INSERT INTO `fs_project` (`projectid`, `uid`, `name`, `permission_uids`, `working_days`, `classids`, `designids`, `pay_name`, `pay_account`, `pay_price_total`, `pay_price_receive`, `pay_price_schedule`, `pay_paytime`, `pay_remark`, `pay_status`, `paycheck_status`, `project_status`, `setuptime`, `updatetime`, `status`) VALUES
(528501, 528502, 'test', '528502\r\n528501', 30, '2', '1,2,5,6,7,3,4,21,20', '張琬君', '(700)1234567-1234567', 88000, 88000, 100, '2015-12-05 15:00:00', '無', 1, 1, 2, '2015-12-04 00:00:00', '2015-12-10 14:33:23', 1),
(528502, 528501, 'test2', '528501', 30, '4', '19,18,11,10,1,2,25,24,23,22,21,20', 'Mimi Chang', '(700)1111111-2222222', 36000, 0, 0, '2015-12-07 14:50:00', '付款備註', 1, 0, 1, '2015-12-07 14:34:19', '2015-12-10 14:32:45', 1);

-- --------------------------------------------------------

--
-- 資料表結構 `fs_project_design`
--

CREATE TABLE IF NOT EXISTS `fs_project_design` (
  `designid` mediumint(8) NOT NULL,
  `uid` mediumint(8) NOT NULL,
  `title` char(50) NOT NULL,
  `price` mediumint(10) NOT NULL,
  `synopsis` char(200) NOT NULL,
  `classids` char(100) NOT NULL,
  `prioritynum` mediumint(8) NOT NULL,
  `updatetime` datetime NOT NULL,
  `status` int(1) NOT NULL,
  UNIQUE KEY `designid` (`designid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 資料表的匯出資料 `fs_project_design`
--

INSERT INTO `fs_project_design` (`designid`, `uid`, `title`, `price`, `synopsis`, `classids`, `prioritynum`, `updatetime`, `status`) VALUES
(1, 528501, 'PHP網站系統後台架構', 18000, 'PHP網站系統後台架構 詳細內容', '9', 0, '2015-12-08 17:48:27', 1),
(2, 528501, 'PHP管理員登入系統', 18000, 'PHP管理員登入系統 詳細內容', '9', 0, '2015-12-08 17:48:22', 1),
(3, 528501, 'PHP網站標題、電子郵件資訊設置系統', 10000, 'PHP網站標題、電子郵件資訊設置系統 詳細內容', '9', 0, '2015-12-08 11:22:22', 1),
(4, 528501, 'PHP網站標籤基本設置系統', 8000, 'PHP網站標籤基本設置系統 詳細內容', '9', 0, '2015-12-08 11:22:16', 1),
(5, 528501, 'PHP第三方javascript外掛崁入系統', 8000, 'PHP第三方javascript外掛崁入系統 詳細內容', '9', 0, '2015-12-08 17:48:18', 1),
(6, 528501, 'PHP文章管理系統', 18000, 'PHP文章管理系統 詳細內容', '9', 0, '2015-12-08 17:48:13', 1),
(7, 528501, 'PHP文章分類標籤系統', 8000, 'PHP文章分類標籤系統 詳細內容', '9', 0, '2015-12-08 17:48:08', 1),
(8, 528501, 'PHP文章HTML編輯器', 8000, '', '9', 0, '2015-12-08 17:50:30', 1),
(9, 528501, 'PHP文章優先排序系統', 8000, '', '9', 0, '2015-12-08 17:50:43', 1),
(10, 528501, 'PHP照片管理系統', 18000, '', '9', 0, '2015-12-08 17:50:57', 1),
(11, 528501, 'PHP照片上傳系統', 18000, '', '9', 0, '2015-12-08 17:51:09', 1),
(12, 528501, 'PHP照片優先排序系統', 8000, '', '9', 0, '2015-12-08 17:51:20', 1),
(13, 528501, 'PHP相簿管理系統', 18000, '', '9', 0, '2015-12-08 17:51:29', 1),
(14, 528501, 'PHP聯繫單系統', 18000, '', '9', 0, '2015-12-08 17:51:39', 1),
(15, 528501, 'PHP動態頁面系統', 18000, '', '9', 0, '2015-12-08 17:51:49', 1),
(16, 528501, 'PHP動態頁面HTML編輯器', 8000, '', '9', 0, '2015-12-08 17:52:00', 1),
(17, 528501, 'PHP動態頁面頁籤分類系統', 8000, '', '9', 0, '2015-12-08 17:52:10', 1),
(18, 528501, 'PHP動態頁面分類標籤系統', 8000, '', '9', 0, '2015-12-08 17:52:20', 1),
(19, 528501, 'JS中英文語言切換系統', 18000, '', '9', 0, '2015-12-08 17:52:31', 1),
(20, 528501, 'A+級主視覺設計(PC)', 18000, '', '11', 0, '2015-12-08 17:54:57', 1),
(21, 528501, 'A+級主視覺設計(Mobile)', 18000, '', '12', 0, '2015-12-08 17:55:55', 1),
(22, 528501, 'A級頁面美術設計(關於我們)(PC)', 18000, '', '13', 0, '2015-12-08 17:56:05', 1),
(23, 528501, 'A級頁面美術設計(關於我們)(Mobile)', 18000, '', '14', 0, '2015-12-08 17:56:27', 1),
(24, 528501, 'A級頁面美術設計(最新消息)(PC)', 18000, '', '13', 0, '2015-12-08 17:56:43', 1),
(25, 528501, 'A級頁面美術設計(最新消息)(Mobile)', 18000, '', '14', 0, '2015-12-08 17:57:03', 1),
(26, 528501, 'A級頁面美術設計(最新消息)(Mobile)', 0, '', '14', 0, '2015-12-08 17:56:55', -1),
(27, 528501, 'A級頁面美術設計(聯繫資訊)(PC)', 18000, '', '13', 0, '2015-12-08 17:57:16', 1),
(28, 528501, 'A級頁面美術設計(聯繫資訊)(Mobile)', 18000, '', '14', 0, '2015-12-08 17:57:33', 1),
(29, 528501, 'A級頁面美術設計(動態頁面)(PC)', 18000, '', '13', 0, '2015-12-08 17:57:42', 1),
(30, 528501, 'A級頁面美術設計(動態頁面)(Mobile)', 18000, '', '14', 0, '2015-12-08 17:57:51', 1);

-- --------------------------------------------------------

--
-- 資料表結構 `fs_project_suggest`
--

CREATE TABLE IF NOT EXISTS `fs_project_suggest` (
  `suggestid` mediumint(8) NOT NULL,
  `projectid` mediumint(8) NOT NULL,
  `uid` mediumint(8) NOT NULL,
  `title` char(50) NOT NULL,
  `content` char(200) NOT NULL,
  `answer` char(200) NOT NULL,
  `suggest_time` datetime NOT NULL,
  `updatetime` datetime NOT NULL,
  `suggest_status` int(1) NOT NULL,
  `answer_status` int(1) NOT NULL,
  `status` int(1) NOT NULL,
  UNIQUE KEY `suggestid` (`suggestid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 資料表的匯出資料 `fs_project_suggest`
--

INSERT INTO `fs_project_suggest` (`suggestid`, `projectid`, `uid`, `title`, `content`, `answer`, `suggest_time`, `updatetime`, `suggest_status`, `answer_status`, `status`) VALUES
(2, 528501, 528501, '修改建議測試2', '建議測試內容', '123', '2015-12-04 18:14:55', '2015-12-07 18:16:51', 1, 1, 1),
(1, 528501, 528502, '修改建議測試', '測試內容', 'OK', '2015-12-04 18:08:40', '2015-12-04 18:17:56', 1, 3, 1);

-- --------------------------------------------------------

--
-- 資料表結構 `fs_sessions`
--

CREATE TABLE IF NOT EXISTS `fs_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text NOT NULL,
  PRIMARY KEY (`session_id`),
  UNIQUE KEY `session_id` (`session_id`),
  KEY `last_activity_idx` (`last_activity`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 資料表的匯出資料 `fs_sessions`
--

INSERT INTO `fs_sessions` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES
('0fa0daabeee060108ef3bb69aa8ce6f9', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/38.0.2125.111 Safari/537.36', 1415425109, ''),
('16453d17b059ead7fd00f43fd96f8830', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/38.0.2125.111 Safari/537.36', 1415424383, ''),
('167e7c94e1003a6eafe7d6f70c71965a', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/38.0.2125.111 Safari/537.36', 1415423735, ''),
('1cd7067f2b9a8a3033ecb1bd7a384a91', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/38.0.2125.111 Safari/537.36', 1415424502, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528501";}'),
('26d0056fd79217d7b8dd9f378d8de467', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/38.0.2125.111 Safari/537.36', 1415418447, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528501";}'),
('2ff895ab3c6a62feb8e74476d1d34ead', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/38.0.2125.111 Safari/537.36', 1415418437, ''),
('33698f973e134b4a782f377e91bf6195', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/38.0.2125.111 Safari/537.36', 1415423735, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528501";}'),
('45716e1319882f30c5606ff27c6be37d', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/38.0.2125.111 Safari/537.36', 1415425109, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528501";}'),
('46f4b0f5c47343e3ab8a616e51c3672c', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/38.0.2125.111 Safari/537.36', 1415424393, ''),
('55e646a97690beb453e88a715fe4d2d7', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/38.0.2125.111 Safari/537.36', 1415424383, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528501";}'),
('590771e3cab6be5256d3cbf9a8ac3293', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/38.0.2125.111 Safari/537.36', 1415424393, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528501";}'),
('6ace5af3e892b96994cb2b647c0a6347', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/38.0.2125.111 Safari/537.36', 1415418447, ''),
('77d4d6b7ff077b8125b5a316c970363e', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/38.0.2125.111 Safari/537.36', 1415423746, ''),
('8b5c1d333c1afdc7b25cf0ea7292309c', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/38.0.2125.111 Safari/537.36', 1415424393, ''),
('8d3d25eb6ccff5e7fb7a2fe35e868307', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/38.0.2125.111 Safari/537.36', 1415418759, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528501";}'),
('95de76f8b685a68b0faed2012188397f', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/38.0.2125.111 Safari/537.36', 1415422189, ''),
('98da793e9583144535a678d5dc39631e', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/38.0.2125.111 Safari/537.36', 1415418787, ''),
('a3c32d62c96f5a2bcdee743350f93704', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/38.0.2125.111 Safari/537.36', 1415424502, ''),
('c4e8c1468c5506056b1e7e2e03bf077e', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/38.0.2125.111 Safari/537.36', 1415418759, ''),
('c823e1199676f48fe3399c716932385f', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/38.0.2125.111 Safari/537.36', 1415418743, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528501";}'),
('cd28cb0c9a118af5f1018a625440e7a1', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/38.0.2125.111 Safari/537.36', 1415425109, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528501";}'),
('d773b4bc0f5e02b9d32a26741d758f12', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/38.0.2125.111 Safari/537.36', 1415418743, ''),
('d78f4018f2e5fb1de83e92ee5ead8520', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/38.0.2125.111 Safari/537.36', 1415423746, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528501";}'),
('fc8a59f602d2d5c2b02d6ee507f9e722', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/38.0.2125.111 Safari/537.36', 1415423068, ''),
('98dc9cc36a60877b782f6449c7c798a3', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/38.0.2125.111 Safari/537.36', 1415876555, ''),
('58982ff38fe8add915fd1adbfd480cc6', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/38.0.2125.111 Safari/537.36', 1415876555, 'a:1:{s:9:"user_data";s:0:"";}'),
('b7264337f9dec72e81acc371202698e1', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/38.0.2125.111 Safari/537.36', 1416018858, ''),
('817d581a82e8ee5b5e5411c81b28122b', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/38.0.2125.111 Safari/537.36', 1416018858, ''),
('f5fb459e3b956c9571f70b9df2cc38a5', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/38.0.2125.111 Safari/537.36', 1416018858, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528501";}'),
('899e022464798ad69c9c79e23205d157', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64; Trident/7.0; MAMIJS; rv:11.0) like Gecko', 1416377353, ''),
('512b68e09b5531e405d594d56f7cd2c1', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64; Trident/7.0; MAMIJS; rv:11.0) like Gecko', 1416377353, ''),
('dae229332e984cace410a8a53b13daa0', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64; Trident/7.0; MAMIJS; rv:11.0) like Gecko', 1425103707, 'a:1:{s:3:"uid";s:6:"528501";}'),
('cfab14d6dbff271ec38d3aa1414804a9', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.65 Safari/537.36', 1416385775, ''),
('a61b328b865836ebfa5706c54da017e8', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.65 Safari/537.36', 1416385775, ''),
('2afaa1d7f5b751d4e8892e6cc0cc30de', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.65 Safari/537.36', 1416385775, ''),
('2ca5ff6af8fddc48dea3383734aba7bb', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.65 Safari/537.36', 1416385775, ''),
('d023566675b01d6a37f4292d6ab156ef', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.65 Safari/537.36', 1416385775, ''),
('f35698d9590450588d797fd34812cd62', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.65 Safari/537.36', 1416385775, ''),
('15cceb1a7b9e423a7bb4aed2267f8a94', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.65 Safari/537.36', 1416385775, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528501";}'),
('0d41ffff36533c41737ea2e57426e8aa', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.65 Safari/537.36', 1416557773, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528501";}'),
('3e9e59417f30da1e20fc3fc283ec0318', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.65 Safari/537.36', 1416560574, ''),
('b3502ef3a097378eda46f8208308dbd1', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.65 Safari/537.36', 1416560574, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528501";}'),
('fa384b2322dad8cba6ebcd1adc5a15b9', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.65 Safari/537.36', 1416762412, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528501";}'),
('c8db4c4791486904cbea19b284ef3764', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.71 Safari/537.36', 1417010480, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528501";}'),
('ee47e632c83db821989781d1ab138e55', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.71 Safari/537.36', 1417437246, ''),
('7ccffc0128ff1e82f109cabea1d75223', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.71 Safari/537.36', 1417440278, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528501";}'),
('0c3fe2a18dbceedca779ac49cba2b488', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.71 Safari/537.36', 1417442659, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528501";}'),
('a436896c85fce8f55b091ec498e71e3c', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.71 Safari/537.36', 1417691818, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528503";}'),
('5008633a4d5ab058b36e1b2250b5ec9e', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', 1418466483, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528501";}'),
('a533936c065f355457c9b29bc0fb480a', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64; rv:34.0) Gecko/20100101 Firefox/34.0', 1418574117, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528501";}'),
('272d4fe5559370d5a7f12b786c526334', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', 1418712836, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528501";}'),
('db06ee64119e0d4a7f399f6b6d44ecd5', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', 1418788056, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528501";}'),
('d7beea8a8018e2db6fe9184b3c5bf7d3', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', 1418832151, ''),
('f6f14138442ab183f8185ea6d4901814', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', 1418887752, ''),
('19f4d099f692d7a95312b23f597baf19', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', 1418887752, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528501";}'),
('8aa52e6136ebd770d5d748efe00f8c61', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', 1419690683, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528501";}'),
('0be965b6dac28aee06df2950c2ec7a56', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', 1419823651, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528501";}'),
('69349035722651eb201a1d6d4d5067c0', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', 1419838323, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528501";}'),
('364410134e9570a519dbafb4292b8e32', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', 1419908688, ''),
('e4e4f21d363e51fa032115a6e63d70f1', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', 1419908689, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528501";}'),
('141ecf33016852fe8e7c5cfb450623e8', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', 1420125533, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528501";}'),
('bc18a3f3a9f419b6797a1aaada18302a', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', 1420514073, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528501";}'),
('a75499287530aac56ab023b8eff1a52e', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', 1420628887, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528501";}'),
('575546c1971af1f2bbd1ca64105a1616', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', 1420632175, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528503";}'),
('6455beb395357cf89f27621ba01514ee', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', 1420716040, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528503";}'),
('cde4d1072ab56c37cd5e6f738dad4cb8', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', 1421086189, ''),
('a943853fe5d612400a12d57bc79ed14c', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', 1421127016, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528501";}'),
('48b5e9b27bea80462f5f6f729448273f', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', 1421138001, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528501";}'),
('fa59a9a2597eb2a489313863f9e51c8f', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', 1421138130, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528501";}'),
('3de0c901317575de5f5b3f98c4b5590f', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', 1421159994, ''),
('b8a219684c624c0a648a0b9b501b4abf', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', 1421169250, ''),
('e503fc0a41a94fece1f670d44d47ed27', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', 1421174789, ''),
('306c7e502325730545a56b9a9c8285b4', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', 1421175353, ''),
('9f89d46db234580da60d27849faf39cd', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', 1421176129, ''),
('8977dcccd35fdb9f1d6e6df23c6c8e1b', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', 1421270093, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528503";}'),
('19e1d79873445fcba0d6f1280c11f055', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', 1421396580, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528503";}'),
('85ce07fef330bdb020424d0947789309', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.99 Safari/537.36', 1421420980, ''),
('4f9a471c51d4d743dff65f65f0925891', '127.0.0.1', 'Mozilla/5.0 (Linux; Android 4.2.2; GT-I9505 Build/JDQ39) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/31.0.1650.59 Mobi', 1421436881, ''),
('98b2e7c6e6c574048080d4403434de84', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.99 Safari/537.36', 1421436904, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528503";}'),
('40a5c8b53a17fe393eba24061b2178ca', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.99 Safari/537.36', 1421682540, ''),
('fa6e17195fd966cda8a6773c1882f474', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.99 Safari/537.36', 1421687193, ''),
('1b6f02710ba520e190667cfd5a96422c', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.99 Safari/537.36', 1421688333, ''),
('9bfa341c7a6c48eb6488a85fcd10d5fb', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.99 Safari/537.36', 1421689888, ''),
('c75b13122e87c706642224598eef08f9', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.99 Safari/537.36', 1421694433, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528503";}'),
('28e78eb1385c341f02b59acbcbc223a8', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.99 Safari/537.36', 1421934209, ''),
('a5a330530b60c9cabd6dd286d893015f', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.99 Safari/537.36', 1421994616, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528503";}'),
('4caf69cbcbf135fa91a4344b71cb59d9', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.99 Safari/537.36', 1422008558, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528503";}'),
('fa998a02f162bb59ef55373f60fe51de', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.99 Safari/537.36', 1422092368, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528503";}'),
('90435b9a756ef4b6c12e52ac7e403ed9', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.99 Safari/537.36', 1422180459, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528503";}'),
('1442394280ef2f2b0a3ced98de7020f0', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.99 Safari/537.36', 1422243887, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528503";}'),
('5de37dac3291eb46b06e7768178bdb13', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.99 Safari/537.36', 1422244594, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528503";}'),
('b845f17512969ce136889fdaf6c4c2e5', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/40.0.2214.91 Safari/537.36', 1422247274, ''),
('c12f5121bf161a20864da4c67ffb7df7', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/40.0.2214.91 Safari/537.36', 1422247284, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528503";}'),
('1fbe1d08d15efc90b1fa66bd81f292b7', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/40.0.2214.91 Safari/537.36', 1422269981, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528503";}'),
('05f088f32f833d804b67deb459bf1739', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/40.0.2214.93 Safari/537.36', 1422605968, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528503";}'),
('c8f8ee6fcd9eb66acadc8ca22d5f7c80', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/40.0.2214.93 Safari/537.36', 1422609634, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528503";}'),
('f01ca3dcb114f900487206482b772e9e', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/40.0.2214.93 Safari/537.36', 1422609877, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528503";}'),
('bd756e3891ec5480e2a386807a17f02e', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/40.0.2214.93 Safari/537.36', 1422642189, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528503";}'),
('9cb2dd529c3f2891816758d827d0e4a4', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/40.0.2214.93 Safari/537.36', 1422874389, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528503";}'),
('aa80678f7e7e4751639368c4c88ea8f0', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/40.0.2214.93 Safari/537.36', 1423031324, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528503";}'),
('4ec105a8bcbc8ecf14eda980641a071a', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/40.0.2214.94 Safari/537.36', 1423123987, ''),
('21cd2181100ce217d80e1d1f94de22dc', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/40.0.2214.94 Safari/537.36', 1423126669, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528503";}'),
('b26c8318e5ab897eae8b3c1118c284d9', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/40.0.2214.111 Safari/537.36', 1423325923, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528503";}'),
('7849fb71d0a2cc51200c0f36c439c17c', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/40.0.2214.111 Safari/537.36', 1423372485, 'a:1:{s:9:"user_data";s:0:"";}'),
('b552576bcc7ee024d06aed833a7ee6d9', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/40.0.2214.111 Safari/537.36', 1423453908, ''),
('c1a0bd1b9a9485d5bebf7f2ab09bec14', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/40.0.2214.111 Safari/537.36', 1423457078, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528503";}'),
('e27079a428af63b0a0dd398139f1e2b8', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/40.0.2214.111 Safari/537.36', 1423490544, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528503";}'),
('08e0c26239a7a7ce05a1b1c512d172e3', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/40.0.2214.111 Safari/537.36', 1423544765, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528503";}'),
('61ddea20f8e9f41f430adad9d2332bcf', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/40.0.2214.111 Safari/537.36', 1423548394, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528503";}'),
('66f02987fb066695e2d264b7b2e3c57a', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/40.0.2214.111 Safari/537.36', 1423635639, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528503";}'),
('2cc9d7ba5667474462db92a58c01d9c3', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/40.0.2214.111 Safari/537.36', 1423648797, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528503";}'),
('4f4b481cc161007cf64ec07fcdc634a5', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/40.0.2214.111 Safari/537.36', 1423658640, ''),
('e56ba988bacf86c6606b5f42aa031287', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/40.0.2214.111 Safari/537.36', 1423727786, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528503";}'),
('c347921c96671bf94df065287907f271', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/40.0.2214.111 Safari/537.36', 1423740019, ''),
('6336803107be8f0a899ad5ec501e2006', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/40.0.2214.111 Safari/537.36', 1423745007, ''),
('04814696da4588ef0ffb46cc4aa82adf', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/40.0.2214.111 Safari/537.36', 1423747439, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528503";}'),
('7cbfc532afb26808aaa816a447bfc414', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/40.0.2214.111 Safari/537.36', 1423751903, ''),
('64dfe4443fa6f632a1bc16b8bf860e98', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/40.0.2214.111 Safari/537.36', 1423753162, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528503";}'),
('01621011b54e6dc80e0a754f01803353', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/40.0.2214.111 Safari/537.36', 1423754290, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528503";}'),
('3e7838296c5a1a8b6321433c5632ae19', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/40.0.2214.111 Safari/537.36', 1423770801, ''),
('30eda8405cf6c66a5f457ce72c976283', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/40.0.2214.111 Safari/537.36', 1423802647, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528503";}'),
('c8123186e695894d1242af3641fe121a', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/40.0.2214.111 Safari/537.36', 1423816459, ''),
('719067b01aab58b6fecb36b4b1f908bd', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/40.0.2214.111 Safari/537.36', 1423821273, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528503";}'),
('c48a776f6ba8f30ed4270dd51accc9b8', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/40.0.2214.111 Safari/537.36', 1424206344, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528503";}'),
('c955af9254999def0dc4a63a31b56b94', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/40.0.2214.111 Safari/537.36', 1424210127, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528503";}'),
('a9a7c7f1d94eb5430d33448ad1f66172', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/40.0.2214.111 Safari/537.36', 1424267875, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528503";}'),
('eee766faffcc07333fb8ac9ab1c9f5d9', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/40.0.2214.115 Safari/537.36', 1424438733, ''),
('b7ee4e41edc947abb75387a24e9e9d90', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/40.0.2214.115 Safari/537.36', 1424438733, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528503";}'),
('9710c78ea71c090e8507a616e02d9708', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/40.0.2214.115 Safari/537.36', 1424594293, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528503";}'),
('03a2a1945c0158150289b1b06e27e304', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/40.0.2214.115 Safari/537.36', 1424788136, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528503";}'),
('c27c687d9278fff8ea33b80bee48b38e', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/40.0.2214.115 Safari/537.36', 1424793132, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528503";}'),
('646d0b7c91f19ae1b801863ec62bcd24', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/40.0.2214.115 Safari/537.36', 1424842965, ''),
('9a8d3561dbf6abcbafed2cee9e38f7be', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/40.0.2214.115 Safari/537.36', 1424843179, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528503";}'),
('10e4d5b22a165f7847ad533c48d612a5', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/40.0.2214.115 Safari/537.36', 1424890989, ''),
('f8b51f615f0a0f03af9b840663637bd8', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/40.0.2214.115 Safari/537.36', 1424898931, ''),
('f44c646f0168aecbef4719feb7633ba4', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/40.0.2214.115 Safari/537.36', 1424898945, ''),
('82afd40e7e9a26a5489368c7f57632fc', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/40.0.2214.115 Safari/537.36', 1424898945, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528503";}'),
('4fe6b402f702b106dec9e6a69c42cc02', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/40.0.2214.115 Safari/537.36', 1424990811, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528503";}'),
('76aef7f34752571dc3b7ed24ecae1565', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/40.0.2214.115 Safari/537.36', 1424991058, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528503";}'),
('577c0928277e9955f6267712f69a2330', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/40.0.2214.115 Safari/537.36', 1425017787, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528503";}'),
('621244382356109a6530b73fe2d6496e', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/40.0.2214.115 Safari/537.36', 1425018806, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528503";}'),
('0f5d5df52dce80f0e9248128524427ca', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/40.0.2214.115 Safari/537.36', 1425105737, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528503";}'),
('faff77415d9ffba507274a9b9ab923a9', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/40.0.2214.115 Safari/537.36', 1425105943, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528503";}'),
('3651db34edf4b3df04fb5885a9e2700e', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/40.0.2214.115 Safari/537.36', 1425108571, 'a:1:{s:3:"uid";s:6:"528503";}'),
('13c70bc79daa8ef52257b003d42433b8', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/40.0.2214.115 Safari/537.36', 1425108590, ''),
('79936404fd9bbad88f4730c0775b2220', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/40.0.2214.115 Safari/537.36', 1425264441, ''),
('f16fb530748606a36d810d8fb2f30010', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/40.0.2214.115 Safari/537.36', 1425266299, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528503";}'),
('dd03e56aeed1ab9c6549d3ee6f3caf63', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/40.0.2214.115 Safari/537.36', 1425287403, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528503";}'),
('f18148ab024ece3701517277d9be90c5', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/40.0.2214.115 Safari/537.36', 1425317396, ''),
('1041cbcc62723586e9fe9b11a55e9c9c', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/40.0.2214.115 Safari/537.36', 1425317852, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528503";}'),
('8ec9e7ceed928915d1613d9bd9859df3', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/40.0.2214.115 Safari/537.36', 1425339054, ''),
('a42a37c2be7137e1293442edf1788e92', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/40.0.2214.115 Safari/537.36', 1425368921, ''),
('17e505dcbefcd38ecef5d8c4a5868c84', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/40.0.2214.115 Safari/537.36', 1425401819, ''),
('f2d5cb3b2a825155b667bb6b1923c5b3', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/40.0.2214.115 Safari/537.36', 1425401819, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528503";}'),
('3a11352307195cb3fbb3d339b8f0e240', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/40.0.2214.115 Safari/537.36', 1425463381, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528503";}'),
('108a49a3c36812cb809e0412ea95c2dc', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/40.0.2214.115 Safari/537.36', 1425629482, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528503";}'),
('7320624ee03f5933ce9b45df6bf40b9d', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/40.0.2214.115 Safari/537.36', 1425836972, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528503";}'),
('1737f4cc47da40147bc939d02a9f2da6', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/40.0.2214.115 Safari/537.36', 1425843505, ''),
('86da5df0b3a95188647e1c37e39b2e12', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/40.0.2214.115 Safari/537.36', 1425845035, ''),
('d2e9722a61b6cafb233da60ad28968d0', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/40.0.2214.115 Safari/537.36', 1425881574, ''),
('d94b82a8f96a7d4342ef4e85fb08ae32', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/40.0.2214.115 Safari/537.36', 1425889735, ''),
('77e515a9505cde07304889fa52178248', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/40.0.2214.115 Safari/537.36', 1425907260, ''),
('78739f1a4874fc7cc901dda0cd9fc8d3', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/40.0.2214.115 Safari/537.36', 1425918671, ''),
('436c3421d4dedc0539883e72d116fd54', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/40.0.2214.115 Safari/537.36', 1425953597, ''),
('1a2c66ab5faebda22780719725d2606e', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/40.0.2214.115 Safari/537.36', 1425953598, ''),
('a775a2d393d3bec25491719bc0453a76', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/40.0.2214.115 Safari/537.36', 1425954747, ''),
('a8cbf6d1194753cb0b847b782112daba', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/40.0.2214.115 Safari/537.36', 1425957288, ''),
('8c4966b8943fe91c95d5e986f8c61304', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/40.0.2214.115 Safari/537.36', 1425957289, ''),
('f5e6ac5d0c529d4a46f892f09e471a0e', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/40.0.2214.115 Safari/537.36', 1425957290, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528503";}'),
('cff5db3038945a4043f7d2491129dfc0', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/40.0.2214.115 Safari/537.36', 1425962179, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528503";}'),
('b2949fd6838e533c5e7ad914607d2038', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/40.0.2214.115 Safari/537.36', 1425962862, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528503";}'),
('731a686c36d0fcda806941f67192063c', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/40.0.2214.115 Safari/537.36', 1425968023, ''),
('296b967b9fd658d445ff0b64e7fbaead', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/40.0.2214.115 Safari/537.36', 1425968410, ''),
('6035f85889ce6e473511db5228b91b9e', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/40.0.2214.115 Safari/537.36', 1425968956, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528503";}'),
('0e09504305d95c68e1486ba11826d94b', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/40.0.2214.115 Safari/537.36', 1425970265, ''),
('9533c51558b83e31072b1253de915281', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2272.89 Safari/537.36', 1426155950, ''),
('54f394a29c2f9036b6a384d26b31cf52', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2272.89 Safari/537.36', 1426155950, ''),
('ffe97af230c092b3c5b96641b3647324', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2272.89 Safari/537.36', 1426157068, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528503";}'),
('c8a88dbc2f7ed4b06f73e0d682598749', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2272.89 Safari/537.36', 1426307394, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528503";}'),
('f6fd8f24b3b2a8a75140533aaca29819', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2331.3 Safari/537.36', 1426315784, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528503";}'),
('9583098cef4590bb79daf216f7e8acda', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2331.3 Safari/537.36', 1426329983, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528503";}'),
('6c9acbf73dcbbeefc56ff18272df362a', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2331.3 Safari/537.36', 1426330188, 'a:1:{s:9:"user_data";s:0:"";}'),
('bc8a8a3764bf9d147a1863cd57ddf2f3', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2331.3 Safari/537.36', 1426330192, ''),
('5faaaac0236d1c4ad39cfe61996b52c0', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2331.3 Safari/537.36', 1426331449, ''),
('d7c329ee7bb78c8227bc046727344694', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2331.3 Safari/537.36', 1426331893, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528503";}'),
('d73e8ac7729b33e156bd40148da595a1', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2331.3 Safari/537.36', 1426332748, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528503";}'),
('a6e5f6d58ccefcf85e5926e65a9f3480', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2331.4 Safari/537.36', 1426350625, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528503";}'),
('c3af1a4bf0e169e97fe5c125594e500c', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2332.2 Safari/537.36', 1426400193, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528501";}'),
('3ce5075791cbbb782db3d537ef6f7d6e', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2332.4 Safari/537.36', 1426430484, ''),
('85a4984d115705f9268c8ca76b72eab6', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2332.4 Safari/537.36', 1426441955, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528501";}'),
('90043407160847f00e0d31cdd334b4db', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2332.4 Safari/537.36', 1426445224, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528501";}'),
('c92b5db0d1394159f4965cc8da29c8d9', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2332.4 Safari/537.36', 1426448617, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528501";}'),
('d2a97acc973af95dcda52730693f99c5', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2332.4 Safari/537.36', 1426448789, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528501";}'),
('4d7622d6d07a5fffe11e2d23bd5e7679', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2332.4 Safari/537.36', 1426450380, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528501";}'),
('c3b1795d44ed956e990e20c7447548ab', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2332.4 Safari/537.36', 1426451106, 'a:1:{s:9:"user_data";s:0:"";}'),
('5f26bb0c68e4648a35a928d585a2a1a3', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64; Trident/7.0; MAMIJS; rv:11.0) like Gecko', 1426455974, 'a:1:{s:9:"user_data";s:0:"";}'),
('1a2f78d7d37d1349798d1f62064f9063', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2332.4 Safari/537.36', 1426506133, ''),
('335560b127c4cc4e9e13bad1f64572d1', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2332.4 Safari/537.36', 1426528763, ''),
('95d5498b3498e5431bcc756df2ab1daa', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2332.4 Safari/537.36', 1426672535, ''),
('11360f28dccb3fee9e7e33649281c1da', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2332.4 Safari/537.36', 1426691630, ''),
('296d271886ad76ba4d07be087bbb496d', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2332.4 Safari/537.36', 1426745998, ''),
('d95ed59fb1e117e858f46709bfc726bb', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2332.4 Safari/537.36', 1426793718, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528501";}'),
('653d7195d273183bea6e9bdc7943c488', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2332.4 Safari/537.36', 1426831855, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528501";}'),
('d703f2ed3d4cb7c0329aa687af336b8e', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2332.4 Safari/537.36', 1426843609, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528501";}'),
('7e962baf8df7e66ce126e544067192e9', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2332.4 Safari/537.36', 1426955338, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528501";}'),
('dd93ab829112c3d93da884e060a5b414', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2332.4 Safari/537.36', 1426963690, ''),
('159d99f81de09eb569e4ffb535fff88f', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2332.4 Safari/537.36', 1426963724, ''),
('95bcd06a62cdfb4fd6c99db003fa8df9', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2338.2 Safari/537.36', 1427004126, 'a:1:{s:9:"user_data";s:0:"";}'),
('867a75c820119bbf80f32e1b148ffb98', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2338.2 Safari/537.36', 1427028646, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528501";}'),
('e59d780b9279637cc2b29c128c1f79cc', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2338.2 Safari/537.36', 1427095803, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528501";}'),
('dd796e0383ad3300c930998c026cfbe7', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2338.2 Safari/537.36', 1427095947, 'a:1:{s:9:"user_data";s:0:"";}'),
('fd9c31d7663c587af296cb66eaad67ce', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2338.2 Safari/537.36', 1427129913, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528501";}'),
('186bbdddd8bbbe7dab1f41686394a335', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2338.2 Safari/537.36', 1427130096, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528501";}'),
('36fbab3c3e73faac0516a809e06b184f', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2338.2 Safari/537.36', 1427193968, ''),
('0228f7234ac4f2e1d327cd91c7f79c84', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2342.2 Safari/537.36', 1427195373, ''),
('113e4524d90fc1e54d3a1d8f12d4c5ce', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2342.2 Safari/537.36', 1427195374, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528501";}'),
('e21a84c28a8b22ea7d6317758a145222', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2342.2 Safari/537.36', 1427226580, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528510";}'),
('8fbe7fad6fe0e0ab100b89ef743adc6c', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2342.2 Safari/537.36', 1427282123, ''),
('7bde1e1ffc87c2831e8965ce849c3cec', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2342.2 Safari/537.36', 1427282123, ''),
('b6b6f68ac431794e1ff877f3e21cb3d9', '::1', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2347.0 Safari/537.36', 1427553083, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528501";}'),
('e975d459b9efd407c56b581121bd4861', '::1', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2347.0 Safari/537.36', 1427711651, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528511";}'),
('db1a21bcd4a79ead4bdb99f62a43219c', '::1', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2347.0 Safari/537.36', 1427715957, ''),
('30b07da3f3c3b6c5886627fb342e419c', '::1', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2352.0 Safari/537.36', 1428033011, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528501";}'),
('112ae06488ebd429784a4871154dc52e', '::1', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2352.0 Safari/537.36', 1428047756, ''),
('f4b68eaf8a4e3b0819b541c7ebf4c3ca', '::1', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2355.0 Safari/537.36', 1428082425, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528501";}'),
('46c4ee0088d6b65a29441e6087e63a94', '::1', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2355.0 Safari/537.36', 1428345399, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528501";}'),
('f4dc494e18fe784ac80e77636ea0b3c1', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64; Trident/7.0; MAMIJS; rv:11.0) like Gecko', 1428348153, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528501";}'),
('f0121e6d92cef3e7b6dc2f3cce4230d7', '::1', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2355.0 Safari/537.36', 1428349401, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528511";}'),
('7504d967e9ab24ca8ed3713b1c2f5991', '::1', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2355.0 Safari/537.36', 1428433842, ''),
('621544c33391561ccb7483f07c36f37b', '::1', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2355.0 Safari/537.36', 1428445452, ''),
('f9f308927af776b341e589f3778f62ca', '::1', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2355.0 Safari/537.36', 1428477474, 'a:1:{s:9:"user_data";s:0:"";}'),
('fc715bf7cc51d9818084a7172299a9fd', '::1', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2355.0 Safari/537.36', 1428559118, ''),
('264a4f5b2f4325af91222c3efbc1ad72', '::1', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2355.0 Safari/537.36', 1428603023, ''),
('4e9f2c64987d79ee320273aea9bb1298', '::1', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2355.0 Safari/537.36', 1428608369, ''),
('71ffcc74f26744ee70076dcbfdb25188', '::1', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2362.0 Safari/537.36', 1428614231, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528501";}'),
('65154a1dfde7528da7614381b1cdc885', '::1', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2362.0 Safari/537.36', 1428649614, ''),
('2445937b770d84c3222de5b3d5fd7ec3', '::1', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2362.0 Safari/537.36', 1428650528, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528512";}'),
('03c23e2f39104733899f5ef8ba3b7da4', '::1', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2364.0 Safari/537.36', 1428783136, ''),
('91b69bd04d069833852bc65fbf69579c', '::1', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2366.0 Safari/537.36', 1428835147, ''),
('6fae4af2f0708bea99a546564f00fb76', '::1', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2366.0 Safari/537.36', 1428839056, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528501";}'),
('7fff1520b35e2f0c99d9c2b4220b3d39', '::1', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2366.0 Safari/537.36', 1428903745, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528501";}'),
('9b9ec5007d94059bd5202862a80f5ea0', '::1', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2366.0 Safari/537.36', 1428995181, '');
INSERT INTO `fs_sessions` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES
('07fdaceccebb7311a595414a9bf0922b', '::1', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2368.0 Safari/537.36', 1429029870, ''),
('66bc9367d1874101de5c95756981aafa', '::1', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2369.0 Safari/537.36', 1429083923, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528501";}'),
('46101061f42548d34c24614f0483c82f', '::1', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2369.0 Safari/537.36', 1429087624, ''),
('5889e526e0f6a02818061986943df4a6', '::1', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2369.0 Safari/537.36', 1429088140, ''),
('7ac6211f81b730d11eed11eba1f2099d', '::1', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2369.0 Safari/537.36', 1429088685, ''),
('be9dd11b48ab94b06bfa8441c46373c2', '::1', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2369.0 Safari/537.36', 1429105563, ''),
('fd78d8d461ac645b85b1b2e2db9ec8f5', '::1', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2369.0 Safari/537.36', 1429120258, ''),
('72b0793025602ab6686bc18e30a4ea52', '::1', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2369.0 Safari/537.36', 1429120259, ''),
('fc752be1b2a7b07e89390d214855bc23', '::1', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2369.0 Safari/537.36', 1429120778, ''),
('51b5a5d295e6d690fb463bf97484eeb4', '::1', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2369.0 Safari/537.36', 1429170512, ''),
('9891578d40ca5f977bbbcf19ed755379', '::1', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2369.0 Safari/537.36', 1429170512, ''),
('1292434b1a5ce814511330fdaddb58dd', '::1', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2374.0 Safari/537.36', 1429424271, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528501";}'),
('c00bcb37bb8f68dd374f689fcee4ebed', '::1', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2374.0 Safari/537.36', 1429461012, ''),
('271c3e5ae7995173c234c561d5586710', '::1', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2374.0 Safari/537.36', 1429461012, ''),
('4e9d483294a898340f7a67aabdce2cfd', '::1', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2374.0 Safari/537.36', 1429517140, ''),
('91373abe440f5f495bda0ed1d0494a93', '::1', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2374.0 Safari/537.36', 1429585648, ''),
('37b8f9ca0f6172aa3aad0ff4d8709508', '::1', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2374.0 Safari/537.36', 1429645306, ''),
('5a1ad152fdf0a61fa4c1d29da4b7f995', '::1', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2374.0 Safari/537.36', 1429645306, ''),
('3a0d5a236d6610222166f5959c63bb07', '::1', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2374.0 Safari/537.36', 1429648399, ''),
('04506d6c308af18734276412a1c39726', '::1', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2374.0 Safari/537.36', 1429648399, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528501";}'),
('74806a1dd939afc0a3701cca25189cf7', '::1', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2374.0 Safari/537.36', 1429707335, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528501";}'),
('4204dfb5595abaa191f14a5a7896cc06', '::1', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2374.0 Safari/537.36', 1429841037, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528501";}'),
('264839d64e9ab7e6b938e2db141eed56', '::1', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2381.0 Safari/537.36', 1429931348, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528501";}'),
('26fa45e415fbb1bc954f30d5bce27af8', '::1', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2381.0 Safari/537.36', 1429969279, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528501";}'),
('9ac1048fbbe8387f5da51209aaed4185', '::1', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2381.0 Safari/537.36', 1430134463, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528501";}'),
('01c8397ca2577dc181d4d0718aedd168', '::1', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2381.0 Safari/537.36', 1430200923, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528501";}'),
('b3bec8068b329bf1ea81cf4aa0da9d48', '::1', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2384.4 Safari/537.36', 1430230958, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528501";}'),
('7c8502dfd173c01d1340a05281e34ece', '::1', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2384.4 Safari/537.36', 1430240982, ''),
('6b5fb55508f98c9a056b7c2280a605fe', '::1', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2384.4 Safari/537.36', 1430245122, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528501";}'),
('3e28bd0dc36b6124b1e5acf340af2743', '::1', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2384.4 Safari/537.36', 1430327692, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528501";}'),
('2d9b378f9cda3c989d2f23593c223cc2', '::1', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2384.4 Safari/537.36', 1430372955, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528501";}'),
('dea0fd1e4eabd1ca6dc38baa6b09f5cc', '::1', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2389.0 Safari/537.36', 1430627789, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528501";}'),
('3d4a7df66aafa322af2d1ded196798c2', '::1', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2389.0 Safari/537.36', 1430726046, ''),
('ebf455028b49b1ce2da0bdc7e55eafc6', '::1', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2389.0 Safari/537.36', 1430726047, ''),
('456c5369a3081a4d27746a05daed84d9', '::1', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2389.0 Safari/537.36', 1430746290, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528501";}'),
('fc27464b5b8d92534df16c2971b1465b', '::1', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2389.0 Safari/537.36', 1430815788, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528501";}'),
('3f32f8e5fdc9b8ddbb6cdba7b69cb256', '::1', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2395.5 Safari/537.36', 1431244456, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528501";}'),
('7278d02e8baafeb5eb0b178ce94f0597', '::1', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2395.5 Safari/537.36', 1431255367, ''),
('6b3f26ee6a29fa39f7d0ce498060188b', '::1', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2395.5 Safari/537.36', 1431255413, ''),
('f5437e02d2f073cbb0c354106e66ff97', '39.9.36.63', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2395.5 Safari/537.36', 1431370117, ''),
('799bdbbf7805b242f27a7b8d0f50e91a', '118.168.223.40', 'Mozilla/5.0 (Windows NT 5.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2272.101 Safari/537.36', 1431394438, ''),
('b69cee22b8ccc2cbc9e3573e26d14f02', '118.163.98.241', 'Mozilla/5.0 (Windows NT 5.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.135 Safari/537.36', 1431406774, ''),
('b4c2da92870ac1d711e4a7daad7a1724', '118.163.98.241', 'Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 5.1; Trident/4.0; InfoPath.1; .NET CLR 2.0.50727; .NET CLR 3.0.4506.2152; ', 1431424606, ''),
('eabc0a9ba2945a22c41e3088f1fe041f', '118.163.98.241', 'Mozilla/5.0 (Windows NT 5.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.152 Safari/537.36', 1431672163, ''),
('ecc12cbe670f84f1e70224b1a51146e2', '220.136.43.205', 'Mozilla/5.0 (Windows NT 6.1; Trident/7.0; rv:11.0) like Gecko', 1432029021, ''),
('ea882a83d9c2856df7fac055e2657c7d', '220.136.43.205', 'Mozilla/5.0 (Windows NT 6.1; Trident/7.0; rv:11.0) like Gecko', 1432273372, ''),
('d7cd67a995718ed2b2769336538b5990', '123.194.115.138', 'Mozilla/5.0 (Windows NT 6.3; WOW64; Trident/7.0; ASU2JS; rv:11.0) like Gecko', 1432306205, ''),
('33558ccf6d288d91569e37b38a512a87', '123.194.115.138', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64; Trident/7.0; ASU2JS; rv:11.0) like Gecko', 1432306351, ''),
('481d661eaa0eff271d302d9097e6722f', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', 1433450809, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528501";}'),
('5ac77e86ab3fad35d1eabfeaa3434aee', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', 1433452263, ''),
('6f3c123b15b7fe12b73cc1fabc550cf7', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', 1433473595, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528501";}'),
('116aedc490efb0f1b952d959a0a10317', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', 1433477925, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528501";}'),
('bf480a7a841944a1423e294f0e5ab622', '::1', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.81 Safari/537.36', 1434021880, 'a:1:{s:9:"user_data";s:0:"";}'),
('f27ca5214e03df9249d9c018b634663f', '::1', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.124 Safari/537.36', 1434203783, ''),
('15e62af83baeaf0e48c96c3edb6e7122', '::1', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.124 Safari/537.36', 1434203811, ''),
('8b0c65a7f8911644b3ee18fdbcfa9173', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64; Trident/7.0; MAMIJS; rv:11.0) like Gecko', 1434204952, ''),
('441a2a132c729302618f5f1d0e8280bb', '::1', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.124 Safari/537.36', 1434250296, ''),
('5aac96622c19db870a94f8e433993a15', '::1', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.124 Safari/537.36', 1434253548, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528501";}'),
('d06ba1806356ee99a711ffeff4032f91', '::1', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.124 Safari/537.36', 1434323101, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528501";}'),
('f0840eeca775ad6d991970ca6d5732ba', '::1', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.124 Safari/537.36', 1434464512, ''),
('908e3a8e7662f80bf0e89c4983d8a5e5', '::1', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.124 Safari/537.36', 1434468124, ''),
('fc353651a5b3d98a6cbf7e753ca56884', '::1', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.124 Safari/537.36', 1434468230, ''),
('659e12a90056172b2229dd4f32df6732', '::1', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.124 Safari/537.36', 1434468232, ''),
('bc479ec0811990b9038230311f4e031d', '::1', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.124 Safari/537.36', 1434468233, ''),
('874c27575493b61eeac72c8fd111045e', '::1', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.124 Safari/537.36', 1434468249, ''),
('241804fbf458ce961c6d6b272178be2a', '::1', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.124 Safari/537.36', 1434473101, ''),
('0cf8f363a4ed65dc9a7b81f398df0041', '::1', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.124 Safari/537.36', 1434476170, ''),
('276262bc7cbbf0be2ba4c467e6e69fc6', '::1', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.124 Safari/537.36', 1434476945, ''),
('57657c1d8c9354eeee89036d7072dbc1', '::1', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.124 Safari/537.36', 1434490227, ''),
('f870b9d494e58503dbf2b10f28554ac2', '::1', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.124 Safari/537.36', 1434492293, ''),
('14005bcfae64422aa4dad90c38dfbe10', '::1', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.124 Safari/537.36', 1434526159, ''),
('61ee39f00d5d496a026905bd6120da1a', '::1', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.124 Safari/537.36', 1434527289, ''),
('7f10618f928449449f3537fdda903b5b', '::1', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.124 Safari/537.36', 1434619657, ''),
('6f5294356fdfa75427654e4326eca1e2', '::1', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.124 Safari/537.36', 1434625510, ''),
('76d4392c199c80b6609d897259ad2059', '::1', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.124 Safari/537.36', 1434625635, ''),
('0415f4116bb9b522a1f65f4b0102af35', '::1', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.124 Safari/537.36', 1434632498, ''),
('6bdcabfe7c906c937129dd18eb94a5ce', '::1', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.124 Safari/537.36', 1434657227, ''),
('90676e6a5069dee8710482e9fc95a99c', '::1', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.124 Safari/537.36', 1434810319, ''),
('ab69ce832c491f6101709122b670b486', '::1', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.124 Safari/537.36', 1434843302, ''),
('1d6fb7037269bfa3beba4cc1bd37f85e', '::1', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.124 Safari/537.36', 1434936538, ''),
('bd393337093ffb90f7aa667ebe2c87ea', '::1', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.130 Safari/537.36', 1435034251, ''),
('dc99662b77745bada931b8fa53c2c910', '::1', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.130 Safari/537.36', 1435066963, ''),
('cef823b71c939d8c927d2d158e5f5fa7', '::1', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.130 Safari/537.36', 1435111856, ''),
('fc5f583e857031d382d84e389b12a551', '::1', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.130 Safari/537.36', 1435111872, ''),
('5c84e565114359c5e62afd9f23729aaa', '::1', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.130 Safari/537.36', 1435381056, ''),
('801d7a2d2daa84667d642789f9364946', '::1', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.130 Safari/537.36', 1435647129, ''),
('ba933ba5114d7d8a179122e6d5b6cffb', '::1', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.130 Safari/537.36', 1435919574, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528501";}'),
('b52942ee02c9d450da74e9de8f3dd0c0', '::1', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.130 Safari/537.36', 1435951587, ''),
('17fff30c369ffd925ddaac70d5a46b02', '::1', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.130 Safari/537.36', 1436343533, ''),
('240e926374b79dda2dc9d7b92e2f5e1e', '::1', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.132 Safari/537.36', 1436346175, 'a:1:{s:9:"user_data";s:0:"";}'),
('7a49c0aa7e4a60b1761c3341a6824645', '::1', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.132 Safari/537.36', 1436760130, ''),
('75ffbf6d6063b9b11758114749edec41', '::1', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.132 Safari/537.36', 1436783474, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528501";}'),
('9012358ae20948b3abc52013c048aa5e', '::1', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.132 Safari/537.36', 1436864963, ''),
('edff4bd9813254ea2b5efd6743ddc553', '::1', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.132 Safari/537.36', 1436923870, 'a:1:{s:9:"user_data";s:0:"";}'),
('a5287d6f501a3a106eed83fe62b66df8', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64; Trident/7.0; MASBJS; rv:11.0) like Gecko', 1436940070, ''),
('184a829ab7669f97a304734da4422ee8', '220.133.138.76', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/45.0.2454.6 Safari/537.36', 1436945703, ''),
('db409ed953f1cca19903d0e554bfef08', '::1', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.134 Safari/537.36', 1436950180, ''),
('3b72a0d8a3a5502d41100040f8ebcd06', '110.26.186.234', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.134 Safari/537.36', 1436986578, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528501";}'),
('1375e2b358390752f8965e5a64327ea8', '101.14.132.63', 'Mozilla/5.0 (iPhone; CPU iPhone OS 8_2 like Mac OS X) AppleWebKit/600.1.4 (KHTML, like Gecko) Mobile/12D508 Safari Line/', 1437039609, ''),
('d238808aebe095d94979cdd640bc0b48', '114.36.240.233', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_3) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.132 Safari/537.3', 1437062031, ''),
('00c64d96be1cb8803b00c81891b381b6', '111.80.25.46', 'Mozilla/5.0 (iPhone; CPU iPhone OS 8_3 like Mac OS X) AppleWebKit/600.1.4 (KHTML, like Gecko) Mobile/12F70 Safari Line/5', 1437062643, ''),
('8d33a775509f93a4c4e395f639cd7264', '49.219.185.168', 'Mozilla/5.0 (iPhone; CPU iPhone OS 8_1_3 like Mac OS X) AppleWebKit/600.1.4 (KHTML, like Gecko) Mobile/12B466 Safari Lin', 1437064633, ''),
('7c54f6a33ad207f5fe38a93ad5208c2d', '140.118.22.165', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.134 Safari/537.36', 1437119559, ''),
('0eb26a4db6685dddaa4d2ff06465e079', '1.200.128.75', 'Mozilla/5.0 (Linux; Android 5.0.1; SAMSUNG GT-I9500 Build/LRX22C) AppleWebKit/537.36 (KHTML, like Gecko) SamsungBrowser/', 1437122815, ''),
('a949dc1a9fb89201a1e965a80abde49e', '220.133.138.76', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2457.0 Safari/537.36', 1437124325, ''),
('2f7b4cb6ff19e1246c70709f5afab2ae', '61.230.116.23', 'Mozilla/5.0 (iPad; CPU OS 8_4 like Mac OS X) AppleWebKit/600.1.4 (KHTML, like Gecko) Version/8.0 Mobile/12H143 Safari/60', 1437150519, ''),
('fd433f6e3b77b317fe566c3ea7500093', '223.136.233.253', 'Mozilla/5.0 (iPhone; CPU iPhone OS 8_4 like Mac OS X) AppleWebKit/600.1.4 (KHTML, like Gecko) Version/8.0 Mobile/12H143 ', 1437214400, ''),
('e67a2051ab61781cd8860f0e2f5d9fd4', '220.133.138.76', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2457.0 Safari/537.36', 1437354160, ''),
('0e5b94ee2f56f8ca9a1f5826c7d84fb4', '1.165.125.77', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_4) AppleWebKit/600.7.12 (KHTML, like Gecko) Version/8.0.7 Safari/600.7.12', 1437363614, ''),
('0c351b1702d84a73768ad1260b9f136b', '1.165.125.77', 'Mozilla/5.0 (iPhone; CPU iPhone OS 8_1 like Mac OS X) AppleWebKit/600.1.4 (KHTML, like Gecko) Version/8.0 Mobile/12B410 ', 1437363614, ''),
('cee461d0353be6424dcc37c9c707b9ee', '::1', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.134 Safari/537.36', 1437365692, ''),
('6a6b468cadaa31743eab8f167bbcc655', '220.133.138.76', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.134 Safari/537.36', 1437371805, ''),
('8b6dbec1467a8ab6b021509a88170a43', '123.193.98.30', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_3) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.130 Safari/537.3', 1437380189, ''),
('74decac6a23f75dff074887c96024c59', '110.28.85.204', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.134 Safari/537.36', 1437398280, ''),
('123990b8793ae2eed045883fe8e7ad71', '61.224.160.193', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_4) AppleWebKit/600.7.12 (KHTML, like Gecko) Version/8.0.7 Safari/600.7.12', 1437441472, ''),
('930cab49c7dd6f9eda595a0a4435c7f4', '39.9.23.179', 'Mozilla/5.0 (iPhone; CPU iPhone OS 8_4 like Mac OS X) AppleWebKit/600.1.4 (KHTML, like Gecko) Version/8.0 Mobile/12H143 ', 1437483001, ''),
('4f00532a65a6a4c7c2fd45deaa0b51b1', '220.133.138.76', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.134 Safari/537.36', 1437531848, ''),
('d9bf57a00a07f99a9dd4d7b9231025f0', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64; rv:39.0) Gecko/20100101 Firefox/39.0', 1437532082, ''),
('5e9d3627f56625499af504e1ce0ebaa3', '::1', 'Mozilla/5.0 (Windows NT 6.2; WOW64) AppleWebKit/534.57.2 (KHTML, like Gecko) Version/5.1.7 Safari/534.57.2', 1437532092, ''),
('01aecd9c97540f7f0b060f5c4f7dbb36', '1.164.213.131', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_3) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.134 Safari/537.3', 1437539412, ''),
('2bd95ff89b9c454a21c00e2f4d8ffed2', '173.252.88.186', 'facebookexternalhit/1.1 (+http://www.facebook.com/externalhit_uatext.php)', 1437539596, ''),
('f82819aae64ee23eda93b1ad1f7aff2a', '117.19.99.134', 'Mozilla/5.0 (iPhone; CPU iPhone OS 8_2 like Mac OS X) AppleWebKit/600.1.4 (KHTML, like Gecko) Mobile/12D508 [FBAN/Messen', 1437539611, ''),
('f56b6d09d969ea728360bc6a87fbe138', '111.70.221.102', 'Mozilla/5.0 (iPhone; CPU iPhone OS 8_3 like Mac OS X) AppleWebKit/600.1.4 (KHTML, like Gecko) Mobile/12F70 [FBAN/Messeng', 1437539622, ''),
('807381e505c9fd286d8d07c97a8de6a7', '101.14.195.208', 'Mozilla/5.0 (iPhone; CPU iPhone OS 8_2 like Mac OS X) AppleWebKit/600.1.4 (KHTML, like Gecko) Mobile/12D508 [FBAN/Messen', 1437543119, ''),
('787155898cb1aa23b0958a0cb6991b2f', '220.133.138.76', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2461.3 Safari/537.36', 1437617784, ''),
('37d1785d0083b3de9d8bd6b8d869c344', '::1', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.134 Safari/537.36', 1437644757, ''),
('3789ecbf9e099a4caad81673bd4e46cc', '::1', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.89 Safari/537.36', 1437645068, ''),
('95c43e219ab1d0e33b0605bc34d696cc', '39.13.142.90', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.134 Safari/537.36', 1437664071, ''),
('e9114ac4746175a98d2b2c1c54c4f4c5', '111.81.221.102', 'Mozilla/5.0 (iPhone; CPU iPhone OS 8_3 like Mac OS X) AppleWebKit/600.1.4 (KHTML, like Gecko) Version/8.0 Mobile/12F70 S', 1437668576, ''),
('088acdf410c8da5554a71f6a7ff8b235', '111.184.35.162', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_3) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.89 Safari/537.36', 1437724994, ''),
('4e17883eb07c51da744851b6a5c9cb46', '61.223.253.202', 'Mozilla/5.0 (iPhone; CPU iPhone OS 8_1 like Mac OS X) AppleWebKit/600.1.4 (KHTML, like Gecko) Version/8.0 Mobile/12B410 ', 1437726322, ''),
('ba7434d379aa7cfcce5c6737fd705c04', '101.13.53.86', 'Mozilla/5.0 (iPhone; CPU iPhone OS 8_2 like Mac OS X) AppleWebKit/600.1.4 (KHTML, like Gecko) Version/8.0 Mobile/12D508 ', 1437764171, ''),
('ca40dda99a8bbb255db0dd515bb6b56b', '101.8.3.206', 'Mozilla/5.0 (Linux; U; Android 4.1.2; zh-tw; GT-I9100 Build/JZO54K) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 M', 1437812282, ''),
('0a3aea6eb263bbc9f590e8190d743913', '61.228.88.26', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.107 Safari/537.36', 1437887209, ''),
('584feb0a71176b129e38e3fcb8df74ef', '39.12.58.88', 'Mozilla/5.0 (Linux; Android 5.0; SM-G900I Build/LRX21T) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.93 Mobil', 1437898088, ''),
('760d42e054fab6b506f1ad5d37a44c5c', '::1', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.107 Safari/537.36', 1437958420, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528501";}'),
('79b8c0e9dc05b0d52da0ade85b2e741b', '61.224.167.196', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_4) AppleWebKit/600.7.12 (KHTML, like Gecko) Version/8.0.7 Safari/600.7.12', 1438072402, ''),
('0612946b07edc5ad121454cbbfda666c', '61.224.167.196', 'Mozilla/5.0 (iPhone; CPU iPhone OS 8_1 like Mac OS X) AppleWebKit/600.1.4 (KHTML, like Gecko) Version/8.0 Mobile/12B410 ', 1438072403, ''),
('e992c33b909c590fd9f24598cdc17503', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.125 Safari/537.36', 1438197661, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528501";}'),
('2b010a6acc03620e424b25d0c208f7f7', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.125 Safari/537.36', 1438197676, ''),
('38d67a7ccdc4000fb78058e2daebf7b8', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.125 Safari/537.36', 1438198344, ''),
('932998d373e6e1250e7f586d79f68a1a', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.125 Safari/537.36', 1438277239, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528501";}'),
('a6f86f59e57284a0dd6180fa95d9792d', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.125 Safari/537.36', 1438282410, ''),
('b36176bbfbe00012ea267ba104a053e4', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.125 Safari/537.36', 1438284231, ''),
('07397526b70a2dd33773532dbeac5fd8', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.125 Safari/537.36', 1438339656, ''),
('36114e463b74a9616070cda91d88c72d', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.125 Safari/537.36', 1438433961, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528501";}'),
('3f830e3fc2d76f4dbb075ff059309a45', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.125 Safari/537.36', 1438453087, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528501";}'),
('34ebc1d8cc585bb390ed0a33a2b05fb1', '::1', 'Mozilla/5.0 (iPhone; CPU iPhone OS 8_0 like Mac OS X) AppleWebKit/600.1.3 (KHTML, like Gecko) Version/8.0 Mobile/12A4345', 1438530386, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528501";}'),
('9a2ff61e1d49cd391fab08b01501cd28', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.125 Safari/537.36', 1438531879, ''),
('92f26b60013b2c66f87fd391989dc043', '::1', 'Mozilla/5.0 (iPhone; CPU iPhone OS 8_0 like Mac OS X) AppleWebKit/600.1.3 (KHTML, like Gecko) Version/8.0 Mobile/12A4345', 1438533758, ''),
('a6a5798166d79b980b25b1723a753321', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.125 Safari/537.36', 1438534797, ''),
('922d924bdb2652612ec5e79d98ab81bc', '::1', 'Mozilla/5.0 (Linux; Android 4.4.2; GT-I9505 Build/JDQ39) AppleWebKit/537.36 (KHTML, like Gecko) Version/1.5 Chrome/28.0.', 1438534807, ''),
('5497685991ae51ffa0baff9e448e63f7', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.125 Safari/537.36', 1438535020, ''),
('38a5f8e28f5b64afa03ba5ee8c9db7da', '::1', 'Mozilla/5.0 (iPhone; CPU iPhone OS 8_0 like Mac OS X) AppleWebKit/600.1.3 (KHTML, like Gecko) Version/8.0 Mobile/12A4345', 1438535190, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528501";}'),
('8438b6210b21d1a32a9eb6a1816f29ca', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.125 Safari/537.36', 1438547987, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528501";}'),
('4ce7dbbf2422ef779f581bcb163fc192', '::1', 'Mozilla/5.0 (iPhone; CPU iPhone OS 8_0 like Mac OS X) AppleWebKit/600.1.3 (KHTML, like Gecko) Version/8.0 Mobile/12A4345', 1438548001, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528501";}'),
('002091e4f592038f172aa1241ee4a64f', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.125 Safari/537.36', 1438549252, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528501";}'),
('5ca46c9af178eb19c994708bc4af07cb', '::1', 'Mozilla/5.0 (iPhone; CPU iPhone OS 8_0 like Mac OS X) AppleWebKit/600.1.3 (KHTML, like Gecko) Version/8.0 Mobile/12A4345', 1438549264, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528501";}'),
('ad693590d27ef6c46add0ed1e8190a22', '::1', 'Mozilla/5.0 (Linux; Android 4.4.2; GT-I9505 Build/JDQ39) AppleWebKit/537.36 (KHTML, like Gecko) Version/1.5 Chrome/28.0.', 1438549499, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528501";}'),
('0d752d688d463ebbf01dad2c8b0b1f22', '::1', 'Mozilla/5.0 (Linux; Android 4.3; Nexus 7 Build/JSS15Q) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2307.2 Safari/', 1438549511, ''),
('e850900efb8eece3d55a0d90f12fc741', '::1', 'Mozilla/5.0 (Linux; U; Android 4.1; en-us; GT-N7100 Build/JRO03C) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Mob', 1438549520, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528501";}'),
('762055860cfa87a7ef888831d74bff5d', '::1', 'Mozilla/5.0 (iPhone; CPU iPhone OS 8_0 like Mac OS X) AppleWebKit/600.1.3 (KHTML, like Gecko) Version/8.0 Mobile/12A4345', 1438549525, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528501";}'),
('a5d9ff885b85a8a9ea3bb7f3f747f7a1', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.125 Safari/537.36', 1438550876, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528501";}'),
('d53a74b9341b56511c5d6738aa48349f', '::1', 'Mozilla/5.0 (iPhone; CPU iPhone OS 8_0 like Mac OS X) AppleWebKit/600.1.3 (KHTML, like Gecko) Version/8.0 Mobile/12A4345', 1438550883, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528501";}'),
('8c0e34fd85975f621a228e0847e432c0', '::1', 'Mozilla/5.0 (iPhone; CPU iPhone OS 8_0 like Mac OS X) AppleWebKit/600.1.3 (KHTML, like Gecko) Version/8.0 Mobile/12A4345', 1438551383, ''),
('47c96edbc21d3be3be1b42ec45e5a41c', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.125 Safari/537.36', 1438551650, ''),
('b198c1754807ea8ff225b22ca82c7a26', '::1', 'Mozilla/5.0 (iPhone; CPU iPhone OS 8_0 like Mac OS X) AppleWebKit/600.1.3 (KHTML, like Gecko) Version/8.0 Mobile/12A4345', 1438551656, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528501";}'),
('a9db7f9e2976a9f5b85f797e530778a4', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.125 Safari/537.36', 1438590923, ''),
('0ba66fd99b50cbc40c2152df1658990d', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.125 Safari/537.36', 1438612782, ''),
('94c5f833fb16c5fbd6f12cf0cfb17591', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.125 Safari/537.36', 1438702001, ''),
('7ef1b62fce1697a45f0d4ca9882fdc3f', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.125 Safari/537.36', 1438704047, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528501";}'),
('c4759474f2f2c1d025d40e161d9cb98d', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.125 Safari/537.36', 1438789759, ''),
('e66a3c398a0b13e8e4c5f60d83369df8', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.125 Safari/537.36', 1438872464, ''),
('b99f8e37624c11f98a64ed829bbcd3be', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.125 Safari/537.36', 1438884188, ''),
('b3f08a66c6a5a950861f92868a8fbd55', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', 1439052899, ''),
('c007d6de9ca51150cc0f8057f69de6c5', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', 1439144785, ''),
('0f9029cfe79c896e87e015c160089e78', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', 1439144966, ''),
('5a029f94fce80b978d40358f9367ac54', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', 1439180848, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528501";}'),
('c495fb8e12acc89f57364b6e126e7356', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', 1439192571, ''),
('174fbeebe2d65de8985f34b62cac6d9a', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', 1439205829, ''),
('32c32526855d5397e1dabc38ddef457c', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', 1439211789, ''),
('52611d57d9ed00c8b3b1b19afcd7b41c', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', 1439213738, ''),
('8b1d25c0c9f6e92ee6740e8232a8d63a', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; Trident/7.0; MAMIJS; rv:11.0) like Gecko', 1439284747, ''),
('455d45136fd43fb3bc29fda0406262d8', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.135 Safari/537.36 Edge', 1439300055, ''),
('b90d369d64720451dc7cbe3436eb805d', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.135 Safari/537.36 Edge', 1439300093, ''),
('6c5b847d3596e002ecdfe02453f9db59', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', 1439303708, ''),
('4bbe4bd900ad00f36a4ad174d0ca5071', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36', 1439326814, ''),
('73835b942d01039de96eb39d4300ca53', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.155 Safari/537.36', 1439389427, ''),
('1f1ad20da5c88de0b42d2448de5c2e22', '::1', 'Mozilla/5.0 (iPhone; CPU iPhone OS 8_0 like Mac OS X) AppleWebKit/600.1.3 (KHTML, like Gecko) Version/8.0 Mobile/12A4345', 1439389430, ''),
('a01bec02b8933239ba3226b25db359e6', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.155 Safari/537.36', 1439389431, ''),
('6fd5310dd89531213aa1b8b59ebc8990', '::1', 'Mozilla/5.0 (iPhone; CPU iPhone OS 8_0 like Mac OS X) AppleWebKit/600.1.3 (KHTML, like Gecko) Version/8.0 Mobile/12A4345', 1439389433, ''),
('6a6c0a5f8667c1fcf1e7708d999a2e89', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.155 Safari/537.36', 1439396517, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528502";}'),
('3154c42f4a5b1d4ccd9ecd7888a689ce', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.155 Safari/537.36', 1439397854, ''),
('7fd01fdfa477d4980b4271568e95ee71', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.155 Safari/537.36', 1439399187, ''),
('d2a579a9c269d3a56d5e2cf4d775acec', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.155 Safari/537.36', 1439403928, ''),
('b21120aedf2ca71f2f06af1ec8f70dbb', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.155 Safari/537.36', 1439404483, ''),
('1d36c6e204437ee76719e7a3e4d25387', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.155 Safari/537.36', 1439618368, ''),
('73667a1b5b8e6325091bc2641e17f7ff', '::1', 'Mozilla/5.0 (iPhone; CPU iPhone OS 8_0 like Mac OS X) AppleWebKit/600.1.3 (KHTML, like Gecko) Version/8.0 Mobile/12A4345', 1439618397, ''),
('a7f090f0bba75c3d7f9df74dec31e2e7', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.155 Safari/537.36', 1439618427, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528501";}'),
('ce85187a7222e59a98646963981d76d6', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.155 Safari/537.36', 1439624844, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528501";}'),
('cb60065ec8a2a5f98152d2de8143b063', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.155 Safari/537.36', 1439625027, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528501";}'),
('cbcb88f9942142ae6f05aaaa4004870f', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.155 Safari/537.36', 1439625051, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528501";}'),
('dbefba3f22b279ba6a2328129f8d6349', '::1', 'Mozilla/5.0 (iPhone; CPU iPhone OS 8_0 like Mac OS X) AppleWebKit/600.1.3 (KHTML, like Gecko) Version/8.0 Mobile/12A4345', 1439630585, ''),
('89c095084c1b50a53c94d7673e660bf4', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.155 Safari/537.36', 1439630588, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528501";}'),
('773f5f72e7b9785ebcb5d0937e0ddbe0', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.155 Safari/537.36', 1439656270, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528501";}'),
('100dac48d5cb4fe165c815c59e42b328', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.155 Safari/537.36', 1439661693, ''),
('06fba29ea31f02d20604128b38b2715f', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; Trident/7.0; MAMIJS; rv:11.0) like Gecko', 1439826799, ''),
('d17b9eb930ea05cdac3063b841ee1656', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.135 Safari/537.36 Edge', 1444017733, ''),
('a4357588fe86e30ea079d65a3aef5be9', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.155 Safari/537.36', 1439909139, ''),
('f643eb063ebf833ffeb4e8104163b8b1', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.135 Safari/537.36 Edge', 1439909151, ''),
('e94909103749884f9807de37b8a2c7c9', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.155 Safari/537.36', 1440017287, ''),
('ddb97df4e54e2f01e7ec6cb5693a6dc3', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.135 Safari/537.36 Edge', 1440017385, ''),
('0040f5c281525c0f1a478c3c5ec930d1', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.155 Safari/537.36', 1440269702, ''),
('5b661a3d090548f8b899a0b98b126fd3', '::1', 'Mozilla/5.0 (iPhone; CPU iPhone OS 8_0 like Mac OS X) AppleWebKit/600.1.3 (KHTML, like Gecko) Version/8.0 Mobile/12A4345', 1440270644, ''),
('faef097f418b3c973a98b10b25bcfdb9', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.155 Safari/537.36', 1440270652, ''),
('dd51f5d06bb292ceac7e881e661847a7', '::1', 'Mozilla/5.0 (iPhone; CPU iPhone OS 8_0 like Mac OS X) AppleWebKit/600.1.3 (KHTML, like Gecko) Version/8.0 Mobile/12A4345', 1440270780, ''),
('45ebb41d5deceeb7090dbc40f739cd32', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.155 Safari/537.36', 1440270787, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528501";}'),
('b083742af0886e7ab067b1e3717d4d8c', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.155 Safari/537.36', 1440325048, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528501";}'),
('d757bdef9fbc69fffae12098e42259a1', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.155 Safari/537.36', 1440325057, ''),
('5e65af53201e819c5387eaf22ab9f966', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.155 Safari/537.36', 1440325072, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528501";}'),
('7cfc5f24a69efb065346d9a8f0ba5961', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.157 Safari/537.36', 1440326110, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528501";}'),
('30e7251ac03dd45b971a4af847c84191', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.157 Safari/537.36', 1440351212, ''),
('b92071fe404b56cdda7fa69ed1e92a51', '::1', 'Mozilla/5.0 (iPhone; CPU iPhone OS 8_0 like Mac OS X) AppleWebKit/600.1.3 (KHTML, like Gecko) Version/8.0 Mobile/12A4345', 1440351219, ''),
('4a125c5de5c16118b94c2fb9e213d51e', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.157 Safari/537.36', 1440351228, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528501";}'),
('3604eaeb19dd3581edac8d71dbe8e5c7', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.157 Safari/537.36', 1440538943, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528502";}'),
('c0fa8cfeb9556513284af8bc262f2387', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.157 Safari/537.36', 1440595575, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528502";}'),
('ce2f8a3feae5565c7ed4f756e83602d8', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.157 Safari/537.36', 1440623182, ''),
('fdd9b9102f97f0c69ebc809712a46922', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.157 Safari/537.36', 1440702484, ''),
('3d8a4f090764a1d2bc9430d08b2497e1', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.157 Safari/537.36', 1440832499, ''),
('c27ae6d27c68a76fa2018868f208b567', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.157 Safari/537.36', 1440977402, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528502";}'),
('1b8182ab6f0f957a81b8915b74a3ead7', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.135 Safari/537.36 Edge', 1441107752, ''),
('428781019662b01beb77361bc8a5e55c', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.157 Safari/537.36', 1441131580, ''),
('fdbf03f85e62df764583860135978ffe', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.157 Safari/537.36', 1441131586, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528501";}'),
('bea49faac68d4d4aee53be7c1834539c', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.157 Safari/537.36', 1441131621, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528502";}'),
('cef4b0ddd1894c341cabe292c919914f', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.157 Safari/537.36', 1441132066, ''),
('d3c8694a1e800da83009667d636bc516', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.157 Safari/537.36', 1441133590, ''),
('876dadd6637bd3268e915fe6ac0789e3', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.157 Safari/537.36', 1441140567, ''),
('64633f44571b8d7c855bb4e0b129531c', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2500.0 Safari/537.36', 1441280176, ''),
('ae51b9fed6f93a58357285142426c718', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.157 Safari/537.36', 1441351681, ''),
('e5952ba05aa31971231cd3b4943d3f7a', '::1', 'Mozilla/5.0 (iPhone; CPU iPhone OS 8_0 like Mac OS X) AppleWebKit/600.1.3 (KHTML, like Gecko) Version/8.0 Mobile/12A4345', 1441398501, ''),
('7a6bdb02a431a39cf0dacde2f4c73afe', '::1', 'Mozilla/5.0 (iPhone; CPU iPhone OS 8_0 like Mac OS X) AppleWebKit/600.1.3 (KHTML, like Gecko) Version/8.0 Mobile/12A4345', 1441398551, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528501";}'),
('c168bb2656189e814f77b3323f86eff5', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/45.0.2454.85 Safari/537.36', 1441561642, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528501";}'),
('391aaaed678adfd16cb061683604eb4b', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/45.0.2454.85 Safari/537.36', 1441565515, 'a:1:{s:9:"user_data";s:0:"";}'),
('6aac7fb940638d2e819231948e874ea5', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/45.0.2454.85 Safari/537.36', 1441567995, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528516";}'),
('84e1760861b1d5e65bc51a932ec4b0ab', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/45.0.2454.85 Safari/537.36', 1441702381, ''),
('5178ebab6d7dbdaae22839e645a2f929', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/45.0.2454.85 Safari/537.36', 1441746214, ''),
('1038cad515d2f6a56247206fbb15635c', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/45.0.2454.85 Safari/537.36', 1441951343, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528502";}'),
('ee6b41171a495365dde0d5ed1c63e432', '::1', 'Mozilla/5.0 (iPhone; CPU iPhone OS 8_0 like Mac OS X) AppleWebKit/600.1.3 (KHTML, like Gecko) Version/8.0 Mobile/12A4345', 1442442794, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528501";}'),
('39e9bb4479489c6be6df6c1ac3871034', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/45.0.2454.85 Safari/537.36', 1442443225, ''),
('73028feb312e41f4cdc64730aca4914d', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/45.0.2454.93 Safari/537.36', 1442565521, ''),
('74fa39bad312e531f3d77aa1b0accebc', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/45.0.2454.93 Safari/537.36', 1442607197, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528501";}'),
('b001c56a0ec5500449c26f576fa4e1c0', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/45.0.2454.93 Safari/537.36', 1442872220, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528504";}'),
('f22792748bf8d7243bcecbccd3874188', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/45.0.2454.99 Safari/537.36', 1443603640, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528501";}'),
('8794bf43e611a88f47b41006b00249eb', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/45.0.2454.101 Safari/537.36', 1443633994, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528502";}'),
('dd128f6a1d82f15e44767c8c17f897ad', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/45.0.2454.101 Safari/537.36', 1443940092, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528502";}'),
('146c7bfb0a15047e9984f3e3a2a51a89', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.135 Safari/537.36 Edge', 1444015887, ''),
('69fac1b5ad9a525cdd78ffa0db9b5498', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/45.0.2454.101 Safari/537.36', 1444017829, ''),
('6e2f51f9b54bf379e87afd1069a416d7', '::1', 'Mozilla/5.0 (iPhone; CPU iPhone OS 8_0 like Mac OS X) AppleWebKit/600.1.3 (KHTML, like Gecko) Version/8.0 Mobile/12A4345', 1444017833, ''),
('f2f1abfca21d681413e489f0eb0e0085', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.135 Safari/537.36 Edge', 1444027148, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528502";}'),
('464683120142ac5468276a9c4ee8a37b', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/45.0.2454.101 Safari/537.36', 1444160543, '');
INSERT INTO `fs_sessions` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES
('b851cfe3c4e14eefcbf64f8d4d94d982', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/45.0.2454.101 Safari/537.36', 1444414391, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528502";}'),
('c4155a24aed7bb287151be3b2aa02a8a', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/45.0.2454.101 Safari/537.36', 1444422575, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528502";}'),
('869fb7f995abe27e0dad671df9f0f77e', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/45.0.2454.101 Safari/537.36', 1444480306, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528502";}'),
('6df19f8ccf558d45eca795e6df82f5e2', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/45.0.2454.101 Safari/537.36', 1444615776, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528501";}'),
('4082f453709fa480df4c64cd0be5f934', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/45.0.2454.101 Safari/537.36', 1444639741, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528501";}'),
('b8f4dda4385dbe2218b61be9bb1b4632', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/45.0.2454.101 Safari/537.36', 1444642894, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528501";}'),
('78c0a84db946fe59a7846757bc04526e', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/45.0.2454.101 Safari/537.36', 1444715480, ''),
('fb6dcd4fec797f290076508666cb7436', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/45.0.2454.101 Safari/537.36', 1444716181, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528502";}'),
('b1dc22151cd618d298451ef2a94cf658', '::1', 'Mozilla/5.0 (iPhone; CPU iPhone OS 8_0 like Mac OS X) AppleWebKit/600.1.3 (KHTML, like Gecko) Version/8.0 Mobile/12A4345', 1444812449, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528501";}'),
('d449c636f1d9d94a91fbf155c8f3ae96', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/45.0.2454.101 Safari/537.36', 1444812560, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528501";}'),
('bde2a2b42d047dde117f2577f8e80f06', '::1', 'Mozilla/5.0 (iPhone; CPU iPhone OS 8_0 like Mac OS X) AppleWebKit/600.1.3 (KHTML, like Gecko) Version/8.0 Mobile/12A4345', 1444813076, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528501";}'),
('8c60395236efacb364443bd7f4acbaa2', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/45.0.2454.101 Safari/537.36', 1444813140, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528501";}'),
('be746f2ac39485a07b932896811e60ce', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/537.36', 1447406257, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528502";}'),
('ab4afbf46f10666b4f5f5def0b20b484', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/537.36', 1447407179, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528506";}'),
('9f5ac9b4cedec5e0bed56d98bb34dacb', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/537.36', 1447907839, 'a:1:{s:9:"user_data";s:0:"";}'),
('e3e334a4060554d21b7607d64a591332', '::1', 'Mozilla/5.0 (iPhone; CPU iPhone OS 7_0 like Mac OS X; en-us) AppleWebKit/537.51.1 (KHTML, like Gecko) Version/7.0 Mobile', 1449122268, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528501";}'),
('f73d9636c9ccc5985e415c553c9fac01', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/537.36', 1449122626, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528501";}'),
('d28c7f1907cd2acb3e4fc1455c50cc83', '::1', 'Mozilla/5.0 (iPhone; CPU iPhone OS 7_0 like Mac OS X; en-us) AppleWebKit/537.51.1 (KHTML, like Gecko) Version/7.0 Mobile', 1449123314, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528501";}'),
('e133b4bf86700f7f18054b220f0f13bb', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/537.36', 1449124005, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528501";}'),
('4044a6fbe4b91dbcd17ce2b523bfdbcd', '::1', 'Mozilla/5.0 (iPhone; CPU iPhone OS 7_0 like Mac OS X; en-us) AppleWebKit/537.51.1 (KHTML, like Gecko) Version/7.0 Mobile', 1449124491, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528501";}'),
('7bd73ed32bd8a33fe7575318b3082a9d', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/537.36', 1449124653, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528501";}'),
('36320acd9cb6c577b670e2c1b1480d41', '::1', 'Mozilla/5.0 (iPhone; CPU iPhone OS 7_0 like Mac OS X; en-us) AppleWebKit/537.51.1 (KHTML, like Gecko) Version/7.0 Mobile', 1449124661, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528501";}'),
('03920eac733fd6a48407ed39820b40a9', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/537.36', 1449125148, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528501";}'),
('67cd5b82155b50c24b41773a5ecb34e2', '::1', 'Mozilla/5.0 (iPhone; CPU iPhone OS 7_0 like Mac OS X; en-us) AppleWebKit/537.51.1 (KHTML, like Gecko) Version/7.0 Mobile', 1449126039, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528501";}'),
('fe386328c510952ea57757d6ae49b3cd', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/537.36', 1449126082, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528501";}'),
('1e1fc03a2ac695567f726045a10c9de4', '::1', 'Mozilla/5.0 (iPhone; CPU iPhone OS 7_0 like Mac OS X; en-us) AppleWebKit/537.51.1 (KHTML, like Gecko) Version/7.0 Mobile', 1449132843, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528501";}'),
('b40449c25711fc94bebe0df8617ce808', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/537.36', 1449134050, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528502";}'),
('355b92cf0ba98ea80c6bf9f2765b974a', '::1', 'Mozilla/5.0 (iPhone; CPU iPhone OS 8_0 like Mac OS X) AppleWebKit/600.1.3 (KHTML, like Gecko) Version/8.0 Mobile/12A4345', 1449223981, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528501";}'),
('c249528d1c6e724bb33661da909751e6', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/537.36', 1449224006, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528501";}'),
('c569f1a9dfbb45e1117ce8c5c4e659f0', '::1', 'Mozilla/5.0 (iPhone; CPU iPhone OS 8_0 like Mac OS X) AppleWebKit/600.1.3 (KHTML, like Gecko) Version/8.0 Mobile/12A4345', 1449467525, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528501";}'),
('dfa9b96f131dcb8c983b67f467f03a0c', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/537.36', 1449467670, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528501";}'),
('47ba191f7c22f70f8a3ed3d820108658', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64; Trident/7.0; MASBJS; rv:11.0) like Gecko', 1449475216, ''),
('ec08970c9ea849eb9aced512ee45fae2', '::1', 'Mozilla/5.0 (Windows NT 6.2; WOW64) AppleWebKit/534.57.2 (KHTML, like Gecko) Version/5.1.7 Safari/534.57.2', 1449475378, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528501";}'),
('2523a5491389a6e5d509590bbd16b204', '::1', 'Mozilla/5.0 (iPhone; CPU iPhone OS 8_0 like Mac OS X) AppleWebKit/600.1.3 (KHTML, like Gecko) Version/8.0 Mobile/12A4345', 1449542019, 'a:1:{s:9:"user_data";s:0:"";}'),
('b0fa4d59f18ff53b53e49c8bb2ee4b72', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/537.36', 1449542023, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528501";}'),
('f7799f77d4467e989eee0e30ca4f7b08', '::1', 'Mozilla/5.0 (iPhone; CPU iPhone OS 8_0 like Mac OS X) AppleWebKit/600.1.3 (KHTML, like Gecko) Version/8.0 Mobile/12A4345', 1449542616, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528501";}'),
('92d1a6385f18801fb541634a0e313613', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/537.36', 1449542638, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528501";}'),
('1c0062009362a6a0fe8593bd4edd39a5', '::1', 'Mozilla/5.0 (iPhone; CPU iPhone OS 8_0 like Mac OS X) AppleWebKit/600.1.3 (KHTML, like Gecko) Version/8.0 Mobile/12A4345', 1449547713, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528501";}'),
('384846170f8876533b422afd06d89ebb', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/537.36', 1449547975, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528501";}'),
('cbdf19b8475e9a1ea52be3db24240f70', '::1', 'Mozilla/5.0 (iPhone; CPU iPhone OS 8_0 like Mac OS X) AppleWebKit/600.1.3 (KHTML, like Gecko) Version/8.0 Mobile/12A4345', 1449548298, 'a:1:{s:9:"user_data";s:0:"";}'),
('22bd1248c89cf0bc6a7c57d78049bfbd', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/537.36', 1449548302, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528501";}'),
('c607377ad719d899b8cf0b85a4e6a640', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/537.36', 1449565583, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528501";}'),
('f1dcafdec8906c1bd5540cbe3a4b341f', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.80 Safari/537.36', 1449726750, 'a:2:{s:9:"user_data";s:0:"";s:3:"uid";s:6:"528501";}'),
('95506c5517d9e51d70798ccc80bc6fe3', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.80 Safari/537.36', 1449726750, '');

-- --------------------------------------------------------

--
-- 資料表結構 `fs_setting`
--

CREATE TABLE IF NOT EXISTS `fs_setting` (
  `settingid` mediumint(8) NOT NULL,
  `keyword` char(200) NOT NULL,
  `value` text NOT NULL,
  `modelname` char(32) NOT NULL DEFAULT '',
  `locale` char(5) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  UNIQUE KEY `settingid` (`settingid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 資料表的匯出資料 `fs_setting`
--

INSERT INTO `fs_setting` (`settingid`, `keyword`, `value`, `modelname`, `locale`, `status`) VALUES
(1, 'website_title_name', 'fansWoo', '', 'en-US', 1),
(2, 'website_title_introduction', 'testing', '', 'en-US', 1),
(3, 'website_title_name', 'fansWoo 瘋沃科技', '', 'zh-TW', 1),
(4, 'website_title_introduction', '網站測試中', '', 'zh-TW', 1),
(5, 'website_name', 'fansWoo website', '', 'en-US', 1),
(6, 'website_logo', 'fansWoo website', '', 'en-US', 1),
(7, 'website_metatag', 's', '', 'en-US', 1),
(8, 'smtp_account', 'mimi@fanswoo.com', 'smtp', 'zh-TW', 1),
(9, 'smtp_email', 'mimi@fanswoo.com', 'smtp', 'zh-TW', 1),
(10, 'smtp_password', 'qwe33117785200', 'smtp', 'zh-TW', 1),
(11, 'smtp_host', 'smtp.gmail.com', 'smtp', 'zh-TW', 1),
(12, 'smtp_username', 'fansWoo 瘋沃科技', 'smtp', 'zh-TW', 1),
(13, 'smtp_ssl_checkbox', '1', 'smtp', 'zh-TW', 1),
(14, 'bank_code', '中國信託（銀行代號：700）', 'shop_transfer', 'zh-TW', 1),
(15, 'bank_account', '123-456-789-000', 'shop_transfer', 'zh-TW', 1),
(16, 'bank_account_name', 'Fanswoo', 'shop_transfer', 'zh-TW', 1),
(17, 'bank_account_remark', '', 'shop_transfer', 'zh-TW', 1),
(18, 'website_name', 'fansWoo 瘋沃科技', '', 'zh-TW', 1),
(19, 'website_logo', 'img/favicon.ico', '', 'zh-TW', 1),
(20, 'website_email', 'service@fanswoo.com', '', 'zh-TW', 1),
(21, 'website_metatag', '網頁設計、fansWoo design,網頁設計,網站設計,網頁設計公司,台北網頁設計,瘋沃網頁設計\r\n中小型企業形象網站網頁設計瘋沃科技網頁設計公司提供最優質的網頁設計、網站架設、多媒體網頁設計等多項服務. 我們的客戶來自於各行各業，以最全面性的服務來滿足您對於網頁設計的需求', '', 'zh-TW', 1);

-- --------------------------------------------------------

--
-- 資料表結構 `fs_shop_cart`
--

CREATE TABLE IF NOT EXISTS `fs_shop_cart` (
  `cartid` mediumint(8) NOT NULL,
  `orderid` mediumint(8) NOT NULL,
  `productid` mediumint(8) NOT NULL,
  `stockid` mediumint(8) NOT NULL,
  `uid` mediumint(8) NOT NULL,
  `price` mediumint(8) NOT NULL,
  `amount` mediumint(8) NOT NULL,
  `status` int(1) NOT NULL,
  UNIQUE KEY `cartid` (`cartid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 資料表結構 `fs_shop_order`
--

CREATE TABLE IF NOT EXISTS `fs_shop_order` (
  `orderid` mediumint(8) NOT NULL,
  `uid` mediumint(8) NOT NULL,
  `receive_name` char(32) DEFAULT '',
  `receive_phone` char(32) DEFAULT '',
  `receive_time` char(32) DEFAULT '',
  `receive_address` char(100) DEFAULT '',
  `receive_remark` text,
  `pay_paytype` char(32) DEFAULT '',
  `pay_sendtype` char(32) DEFAULT '',
  `pay_price_total` mediumint(10) DEFAULT '0',
  `pay_price_freight` mediumint(10) DEFAULT '0',
  `pay_account` char(50) DEFAULT '',
  `pay_name` char(32) DEFAULT '',
  `pay_paytime` datetime DEFAULT NULL,
  `pay_remark` text,
  `pay_status` int(1) DEFAULT '0',
  `coupon_count` mediumint(8) NOT NULL,
  `tradein_count` mediumint(8) NOT NULL,
  `paycheck_status` int(1) DEFAULT '0',
  `product_status` int(1) DEFAULT '0',
  `order_status` int(1) DEFAULT '0',
  `sendtime` datetime NOT NULL,
  `setuptime` datetime DEFAULT NULL,
  `updatetime` datetime DEFAULT NULL,
  `status` int(1) DEFAULT '0',
  UNIQUE KEY `ordersid` (`orderid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 資料表的匯出資料 `fs_shop_order`
--

INSERT INTO `fs_shop_order` (`orderid`, `uid`, `receive_name`, `receive_phone`, `receive_time`, `receive_address`, `receive_remark`, `pay_paytype`, `pay_sendtype`, `pay_price_total`, `pay_price_freight`, `pay_account`, `pay_name`, `pay_paytime`, `pay_remark`, `pay_status`, `coupon_count`, `tradein_count`, `paycheck_status`, `product_status`, `order_status`, `sendtime`, `setuptime`, `updatetime`, `status`) VALUES
(528501, 528505, '張琬君', '0912345678', NULL, '台北市', NULL, 'atm', NULL, 0, 0, '', '', '2015-11-20 10:46:00', '', 0, 0, 0, 0, 0, 0, '2015-11-20 10:46:00', '2015-11-20 10:46:00', '2015-11-20 10:46:00', 1),
(528500, 528505, '張琬君', '0912345678', '', '台北市', '', 'atm', NULL, 0, 0, '(700)1234567-1234567', '張琬君', '2015-11-20 10:40:00', '', 1, 0, 0, 1, 1, 1, '2015-11-20 10:26:03', '2015-11-20 10:26:03', '2015-12-03 16:04:26', 1);

-- --------------------------------------------------------

--
-- 資料表結構 `fs_shop_product`
--

CREATE TABLE IF NOT EXISTS `fs_shop_product` (
  `productid` mediumint(8) NOT NULL,
  `uid` mediumint(8) NOT NULL,
  `name` char(100) NOT NULL,
  `price` mediumint(10) NOT NULL,
  `cost` mediumint(10) NOT NULL,
  `mainpicids` char(100) NOT NULL,
  `classids` char(100) NOT NULL,
  `content` text NOT NULL,
  `content_specification` text NOT NULL,
  `synopsis` text NOT NULL,
  `picids` char(100) NOT NULL,
  `warehouseid` text NOT NULL,
  `prioritynum` mediumint(8) NOT NULL,
  `updatetime` datetime NOT NULL,
  `shelves_status` int(1) NOT NULL,
  `status` int(1) NOT NULL,
  UNIQUE KEY `productid` (`productid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 資料表結構 `fs_shop_product_stock`
--

CREATE TABLE IF NOT EXISTS `fs_shop_product_stock` (
  `stockid` mediumint(8) NOT NULL,
  `stocknum` mediumint(8) NOT NULL,
  `color_rgb` char(6) NOT NULL,
  `status` int(1) NOT NULL,
  `productid` mediumint(8) NOT NULL,
  `classname1` char(100) NOT NULL,
  `classname2` char(100) NOT NULL,
  `prioritynum` mediumint(8) NOT NULL,
  UNIQUE KEY `stockid` (`stockid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 資料表結構 `fs_showpiece`
--

CREATE TABLE IF NOT EXISTS `fs_showpiece` (
  `showpieceid` mediumint(8) NOT NULL,
  `uid` mediumint(8) NOT NULL,
  `name` char(32) NOT NULL,
  `price` mediumint(10) NOT NULL,
  `classids` char(100) NOT NULL,
  `content` text NOT NULL,
  `content_specification` text NOT NULL,
  `synopsis` text NOT NULL,
  `picids` char(100) NOT NULL,
  `prioritynum` mediumtext NOT NULL,
  `updatetime` datetime NOT NULL,
  `status` int(1) NOT NULL,
  UNIQUE KEY `showpieceid` (`showpieceid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 資料表結構 `fs_user`
--

CREATE TABLE IF NOT EXISTS `fs_user` (
  `uid` mediumint(8) NOT NULL,
  `email` char(32) NOT NULL,
  `username` char(32) NOT NULL,
  `picids` char(100) NOT NULL,
  `groupids` char(100) NOT NULL,
  `updatetime` datetime NOT NULL,
  `status` int(1) NOT NULL,
  UNIQUE KEY `uid` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 資料表的匯出資料 `fs_user`
--

INSERT INTO `fs_user` (`uid`, `email`, `username`, `picids`, `groupids`, `updatetime`, `status`) VALUES
(528501, 'service@fanswoo.com', '系統管理員', '', '1', '2015-08-15 17:53:45', 1),
(528504, 'test@fanswoo.com', 'test@fanswoo.com', '', '100', '2015-09-15 22:56:05', 1),
(528503, 'admin2@fanswoo.com', '一般管理員', '', '3', '2015-08-16 01:24:52', 1),
(528502, 'admin@fanswoo.com', '總管理員', '', '2', '2015-09-16 01:33:39', 1),
(528505, 'mimi@fanswoo.com', 'mimi@fanswoo.com', '', '100', '2015-11-13 17:20:42', 1);

-- --------------------------------------------------------

--
-- 資料表結構 `fs_user_field_shop`
--

CREATE TABLE IF NOT EXISTS `fs_user_field_shop` (
  `uid` mediumint(8) NOT NULL,
  `receive_name` char(100) DEFAULT '',
  `receive_phone` char(100) NOT NULL DEFAULT '',
  `receive_address` char(100) NOT NULL DEFAULT '',
  `coupon_count` mediumint(8) NOT NULL,
  UNIQUE KEY `uid` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 資料表的匯出資料 `fs_user_field_shop`
--

INSERT INTO `fs_user_field_shop` (`uid`, `receive_name`, `receive_phone`, `receive_address`, `coupon_count`) VALUES
(528501, 'test', 'test', 'test', 222),
(528502, '', '', '', 5),
(528504, 'test', '123', 'rrr', 454),
(528503, '', '', '', 0),
(528505, '', '', '', 0);

-- --------------------------------------------------------

--
-- 資料表結構 `fs_user_group`
--

CREATE TABLE IF NOT EXISTS `fs_user_group` (
  `groupid` mediumint(8) NOT NULL,
  `groupname` char(40) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  UNIQUE KEY `groupid` (`groupid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 資料表的匯出資料 `fs_user_group`
--

INSERT INTO `fs_user_group` (`groupid`, `groupname`, `status`) VALUES
(1, '系統管理員', 1),
(100, '一般會員', 1),
(2, '總管理員', 1),
(3, '一般管理員', 1);

-- --------------------------------------------------------

--
-- 資料表結構 `fs_user_verification`
--

CREATE TABLE IF NOT EXISTS `fs_user_verification` (
  `uid` mediumint(8) NOT NULL,
  `email` char(32) NOT NULL,
  `password` char(32) NOT NULL,
  `password_salt` char(6) NOT NULL,
  `password_key` char(32) NOT NULL,
  `change_email_key` char(6) NOT NULL,
  `change_email_updatetime` datetime NOT NULL,
  `facebookid` mediumint(12) NOT NULL,
  `googleid` mediumint(12) NOT NULL,
  UNIQUE KEY `uid` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 資料表的匯出資料 `fs_user_verification`
--

INSERT INTO `fs_user_verification` (`uid`, `email`, `password`, `password_salt`, `password_key`, `change_email_key`, `change_email_updatetime`, `facebookid`, `googleid`) VALUES
(528501, 'service@fanswoo.com', 'f3ebc5fbce456c6f185f419c62461602', '0f7d26', '1234qwera', '53B9E1', '2015-04-10 23:00:53', 0, 0),
(528503, 'admin2@fanswoo.com', 'b2b5410b5f94eea7feff94aab7ba763e', 'f3ab44', '12345678', '', '0000-00-00 00:00:00', 0, 0),
(528502, 'admin@fanswoo.com', 'caf77603f131efe6b052eba84f65ff9d', 'db5afb', '12345678', '', '0000-00-00 00:00:00', 0, 0),
(528504, 'test@fanswoo.com', '4476e1b3311ef7703d03d8b7ec4d503c', '4da76f', '12345678', '', '0000-00-00 00:00:00', 0, 0),
(528505, 'mimi@fanswoo.com', '7b4147d7a28f8b61543b9dffd42f702c', '842bb8', '12345678', '', '0000-00-00 00:00:00', 0, 0);

-- --------------------------------------------------------

--
-- 資料表結構 `fs_wordpress_order`
--

CREATE TABLE IF NOT EXISTS `fs_wordpress_order` (
  `wordpress_orderid` mediumint(8) NOT NULL,
  `orderid` mediumint(8) NOT NULL,
  `uid` mediumint(8) NOT NULL,
  `username` char(100) NOT NULL,
  `email` char(100) NOT NULL,
  `phone` char(100) NOT NULL,
  `company` char(100) NOT NULL,
  `content` text NOT NULL,
  `classtype` char(100) NOT NULL,
  `address` char(100) NOT NULL,
  `years` mediumint(2) NOT NULL,
  `price` mediumint(8) NOT NULL,
  `updatetime` datetime NOT NULL,
  `status` int(1) NOT NULL,
  UNIQUE KEY `orderid` (`wordpress_orderid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 資料表的匯出資料 `fs_wordpress_order`
--

INSERT INTO `fs_wordpress_order` (`wordpress_orderid`, `orderid`, `uid`, `username`, `email`, `phone`, `company`, `content`, `classtype`, `address`, `years`, `price`, `updatetime`, `status`) VALUES
(528500, 528500, 528505, '張琬君', 'mimi@fanswoo.com', '0912345678', 'Fanswoo', '', '微型主機', '台北市', 2, 16800, '2015-11-20 10:26:03', 1),
(528501, 528501, 528505, '張琬君', 'mimi@fanswoo.com', '0912345678', 'Fanswoo', '', '標準主機', '台北市', 3, 54000, '2015-11-20 10:46:00', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
