-- phpMyAdmin SQL Dump
-- version 3.2.3
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 24, 2010 at 11:03 AM
-- Server version: 5.0.67
-- PHP Version: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `empty`
--

-- --------------------------------------------------------

--
-- Table structure for table `tgp_bien`
--

CREATE TABLE IF NOT EXISTS `tgp_bien` (
  `ten` varchar(32) NOT NULL,
  `gia_tri` text NOT NULL,
  PRIMARY KEY  (`ten`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tgp_bien`
--

INSERT INTO `tgp_bien` (`ten`, `gia_tri`) VALUES
('email', ''),
('lien_ket', ''),
('title', 'CÃ”NG TY TNHH CÃ”NG NGHá»† PHáº¦N Má»€M THáº¾ GIá»šI PHáº²NG');

-- --------------------------------------------------------

--
-- Table structure for table `tgp_cat`
--

CREATE TABLE IF NOT EXISTS `tgp_cat` (
  `id` varchar(20) NOT NULL,
  `ten` varchar(255) NOT NULL,
  `thu_tu` int(11) NOT NULL default '1',
  `_cms` int(1) NOT NULL default '0',
  `_product` int(1) default '0',
  `_gallery` int(1) NOT NULL default '0',
  `_doc` int(1) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tgp_cat`
--


-- --------------------------------------------------------

--
-- Table structure for table `tgp_cms`
--

CREATE TABLE IF NOT EXISTS `tgp_cms` (
  `id` int(11) NOT NULL auto_increment,
  `cat` int(11) NOT NULL,
  `ten` varchar(255) NOT NULL,
  `chu_thich` text NOT NULL,
  `hinh` varchar(255) default 'no',
  `hinh_note` varchar(255) NOT NULL,
  `noi_dung` text NOT NULL,
  `hien_thi` int(1) NOT NULL default '1',
  `time` int(11) NOT NULL,
  `user` int(11) NOT NULL default '0',
  `luot_xem` int(11) NOT NULL default '0',
  `noi_bat` int(1) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tgp_cms`
--


-- --------------------------------------------------------

--
-- Table structure for table `tgp_cms_menu`
--

CREATE TABLE IF NOT EXISTS `tgp_cms_menu` (
  `id` int(11) NOT NULL auto_increment,
  `cat` varchar(20) NOT NULL,
  `ten` varchar(255) NOT NULL,
  `type` int(1) default '0',
  `thu_tu` int(11) NOT NULL,
  `hien_thi` int(1) NOT NULL default '1',
  `noi_bat` int(1) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tgp_cms_menu`
--


-- --------------------------------------------------------

--
-- Table structure for table `tgp_customers`
--

CREATE TABLE IF NOT EXISTS `tgp_customers` (
  `id` int(11) NOT NULL auto_increment,
  `ten` varchar(255) NOT NULL,
  `cat` int(11) NOT NULL,
  `hinh` varchar(255) default 'no',
  `dia_chi` varchar(255) NOT NULL,
  `gioi_thieu` text NOT NULL,
  `thu_tu` int(11) NOT NULL,
  `dem_click` int(11) default '0',
  `dem_view` int(11) default '0',
  `hien_thi` int(1) NOT NULL,
  `noi_bat` int(1) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tgp_customers`
--


-- --------------------------------------------------------

--
-- Table structure for table `tgp_customers_cat`
--

CREATE TABLE IF NOT EXISTS `tgp_customers_cat` (
  `id` int(11) NOT NULL auto_increment,
  `ten` varchar(255) NOT NULL,
  `thu_tu` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tgp_customers_cat`
--


-- --------------------------------------------------------

--
-- Table structure for table `tgp_doc`
--

CREATE TABLE IF NOT EXISTS `tgp_doc` (
  `id` int(11) NOT NULL auto_increment,
  `cat` int(11) NOT NULL,
  `ten` varchar(255) NOT NULL,
  `chu_thich` text NOT NULL,
  `file` varchar(255) default 'no',
  `file_size` varchar(255) NOT NULL,
  `noi_dung` text NOT NULL,
  `hien_thi` int(1) NOT NULL default '1',
  `gia` double default NULL,
  `time` int(11) NOT NULL,
  `luot_tai` int(11) NOT NULL default '0',
  `noi_bat` int(1) NOT NULL default '0',
  `user` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tgp_doc`
--


-- --------------------------------------------------------

--
-- Table structure for table `tgp_doc_menu`
--

CREATE TABLE IF NOT EXISTS `tgp_doc_menu` (
  `id` int(11) NOT NULL auto_increment,
  `cat` varchar(20) NOT NULL,
  `ten` varchar(255) NOT NULL,
  `thu_tu` int(11) NOT NULL,
  `hien_thi` int(1) NOT NULL default '1',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tgp_doc_menu`
--


-- --------------------------------------------------------

--
-- Table structure for table `tgp_gallery`
--

CREATE TABLE IF NOT EXISTS `tgp_gallery` (
  `id` int(11) NOT NULL auto_increment,
  `cat` int(11) NOT NULL,
  `ten` varchar(255) NOT NULL,
  `chu_thich` text NOT NULL,
  `hinh` varchar(255) default 'no',
  `hien_thi` int(1) NOT NULL default '1',
  `time` int(11) NOT NULL,
  `user` int(11) NOT NULL default '0',
  `luot_xem` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tgp_gallery`
--


-- --------------------------------------------------------

--
-- Table structure for table `tgp_gallery_menu`
--

CREATE TABLE IF NOT EXISTS `tgp_gallery_menu` (
  `id` int(11) NOT NULL auto_increment,
  `cat` varchar(20) NOT NULL,
  `ten` varchar(255) NOT NULL,
  `thu_tu` int(11) NOT NULL,
  `hien_thi` int(1) NOT NULL default '1',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tgp_gallery_menu`
--


-- --------------------------------------------------------

--
-- Table structure for table `tgp_online`
--

CREATE TABLE IF NOT EXISTS `tgp_online` (
  `ip` varchar(255) NOT NULL default '',
  `time` varchar(255) NOT NULL default '',
  `site` varchar(255) NOT NULL default '',
  `agent` varchar(255) NOT NULL default '',
  `user` int(11) NOT NULL default '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tgp_online`
--


-- --------------------------------------------------------

--
-- Table structure for table `tgp_online_daily`
--

CREATE TABLE IF NOT EXISTS `tgp_online_daily` (
  `ngay` varchar(10) NOT NULL default '',
  `bo_dem` int(11) NOT NULL default '0',
  PRIMARY KEY  (`ngay`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tgp_online_daily`
--


-- --------------------------------------------------------

--
-- Table structure for table `tgp_page`
--

CREATE TABLE IF NOT EXISTS `tgp_page` (
  `id` int(11) NOT NULL auto_increment,
  `alias` varchar(255) NOT NULL,
  `ten` varchar(255) NOT NULL,
  `noi_dung` text NOT NULL,
  `time` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `luot_xem` int(11) default '1',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `alias` (`alias`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tgp_page`
--


-- --------------------------------------------------------

--
-- Table structure for table `tgp_product`
--

CREATE TABLE IF NOT EXISTS `tgp_product` (
  `id` int(11) NOT NULL auto_increment,
  `cat` int(11) NOT NULL,
  `ten` varchar(255) NOT NULL,
  `chu_thich` text NOT NULL,
  `hinh` varchar(255) default 'no',
  `noi_dung` text NOT NULL,
  `hien_thi` int(1) NOT NULL default '1',
  `gia` double default NULL,
  `time` int(11) NOT NULL,
  `luot_xem` int(11) NOT NULL default '0',
  `noi_bat` int(1) NOT NULL default '0',
  `user` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tgp_product`
--


-- --------------------------------------------------------

--
-- Table structure for table `tgp_product_menu`
--

CREATE TABLE IF NOT EXISTS `tgp_product_menu` (
  `id` int(11) NOT NULL auto_increment,
  `cat` varchar(20) NOT NULL,
  `ten` varchar(255) NOT NULL,
  `thu_tu` int(11) NOT NULL,
  `hien_thi` int(1) NOT NULL default '1',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tgp_product_menu`
--


-- --------------------------------------------------------

--
-- Table structure for table `tgp_user`
--

CREATE TABLE IF NOT EXISTS `tgp_user` (
  `id` int(11) NOT NULL auto_increment,
  `username` varchar(20) NOT NULL default '',
  `password` varchar(32) default 'no',
  `ten` varchar(255) NOT NULL default '',
  `email` varchar(255) NOT NULL default '',
  `dien_thoai` varchar(20) NOT NULL default '',
  `dia_chi` varchar(255) NOT NULL default '',
  `level` int(1) default '0',
  `trang_thai` int(1) NOT NULL default '0',
  `time` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tgp_user`
--

INSERT INTO `tgp_user` (`id`, `username`, `password`, `ten`, `email`, `dien_thoai`, `dia_chi`, `level`, `trang_thai`, `time`) VALUES
(1, 'admin', '5be86bf0fdca3c611e0def8384a54000', '', '', '', '', 0, 1, 0),
(2, 'tgp_linhnh', 'ebd4201823f87c144cc7b12794077c1b', 'LinhNH', 'linhnh@tgp.vn', '', 'thegioiphang.com.vn', 0, 1, 1283150730),
(3, 'tgp_thienh', '08b2734441ff26dd1900519cee13bd94', 'ThienH', 'thienh@tgp.vn', '', '0123456789', 0, 1, 1283243509),
(4, 'tgp_tunght', '85227a54436455ae23d66689f747ded7', 'TungHT', 'tunght@tgp.vn', '0934723613', 'ÄÃ  Náºµng', 0, 1, 1283267739);
