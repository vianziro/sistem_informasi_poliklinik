-- MySQL dump 10.13
--
-- Host: 192.168.100.51    Database: hasbi
-- ------------------------------------------------------
-- Server version	5.0.51a-24+lenny4

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Not dumping tablespaces as no INFORMATION_SCHEMA.FILES table on this server
--

--
-- Table structure for table `dokter`
--

DROP TABLE IF EXISTS `dokter`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `dokter` (
  `KodeDokter` varchar(5) NOT NULL,
  `NmDokter` varchar(50) default NULL,
  `AlmDokter` varchar(60) default NULL,
  `TelpDokter` varchar(12) default NULL,
  `KodePoli` varchar(5) default NULL,
  PRIMARY KEY  (`KodeDokter`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `dokter`
--

LOCK TABLES `dokter` WRITE;
/*!40000 ALTER TABLE `dokter` DISABLE KEYS */;
INSERT INTO `dokter` VALUES ('d-29J','Reyvando Alief','Belakang sekolah','08278657834',''),('d-1fw','Reyvando Alief Kedua','Belakang sekolah','087123456234','p-5qs'),('d-3nw','Riska Gunawan','Mojosongo, Boyolali','087123456234','p-2Ha'),('d-23v','Bagas Haidar WP','Kerten','08535235127','p-5qs');
/*!40000 ALTER TABLE `dokter` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jadwalpraktek`
--

DROP TABLE IF EXISTS `jadwalpraktek`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `jadwalpraktek` (
  `KodeJadwal` varchar(5) NOT NULL,
  `Hari` varchar(8) default NULL,
  `JamMulai` time default NULL,
  `JamSelesai` time default NULL,
  `KodeDokter` varchar(5) default NULL,
  PRIMARY KEY  (`KodeJadwal`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `jadwalpraktek`
--

LOCK TABLES `jadwalpraktek` WRITE;
/*!40000 ALTER TABLE `jadwalpraktek` DISABLE KEYS */;
INSERT INTO `jadwalpraktek` VALUES ('j-89A','Minggu','20:00:08','22:00:13','d-29J'),('j-98C','Senin','00:00:00','00:00:00','d-5p9'),('j-1ll','Senin','19:00:00','22:00:00','d-1ll'),('j-3nw','Selasa','14:00:00','17:00:00','d-3nw'),('j-1fw','Rabu','15:00:00','18:00:00','d-1fw'),('j-23v','Rabu','08:00:00','11:00:00','d-23v');
/*!40000 ALTER TABLE `jadwalpraktek` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jenisbiaya`
--

DROP TABLE IF EXISTS `jenisbiaya`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `jenisbiaya` (
  `IDJenisBiaya` varchar(5) NOT NULL,
  `NamaBiaya` varchar(50) default NULL,
  `Tarif` int(11) default NULL,
  `NoPendaftaran` varchar(10) default NULL,
  PRIMARY KEY  (`IDJenisBiaya`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `jenisbiaya`
--

LOCK TABLES `jenisbiaya` WRITE;
/*!40000 ALTER TABLE `jenisbiaya` DISABLE KEYS */;
INSERT INTO `jenisbiaya` VALUES ('b-5A9','Pemeriksaan dan Obat',125000,'pen-A3N845'),('b-4v6','',0,'pen-uhato'),('b-29s','Pemeriksaan dan Obat',75000,'pen-uxkw6'),('b-69y','Pemeriksaan dan Obat',85000,'pen-2it9uk');
/*!40000 ALTER TABLE `jenisbiaya` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `login`
--

DROP TABLE IF EXISTS `login`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `login` (
  `UserName` varchar(15) NOT NULL,
  `Password` varchar(225) default NULL,
  `TypeUser` varchar(15) default NULL,
  `NIP` varchar(10) default NULL,
  PRIMARY KEY  (`UserName`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `login`
--

LOCK TABLES `login` WRITE;
/*!40000 ALTER TABLE `login` DISABLE KEYS */;
INSERT INTO `login` VALUES ('admin','21232f297a57a5a743894a0e4a801fc3','admin','1122334455'),('','','',''),('ichsan','3938eed097dc4741b186f7c18f36cf4b','apoteker','13004111'),('reinforce','28390b10ea99f48472760c35d12af6a1','apoteker','7689769769'),('apotek','326dd0e9d42a3da01b50028c51cf21fc','apoteker','6457457457'),('entah','36471498d56905c10b75456b80264d3b','resepsionis','3904634623');
/*!40000 ALTER TABLE `login` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `obat`
--

DROP TABLE IF EXISTS `obat`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `obat` (
  `KodeObat` varchar(10) NOT NULL,
  `NmObat` varchar(50) default NULL,
  `Merk` varchar(50) default NULL,
  `Satuan` varchar(20) default NULL,
  `HargaJual` int(11) default NULL,
  PRIMARY KEY  (`KodeObat`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `obat`
--

LOCK TABLES `obat` WRITE;
/*!40000 ALTER TABLE `obat` DISABLE KEYS */;
INSERT INTO `obat` VALUES ('APTX4869','Obat Flu','Panadol','Kaplet',10000),('obt-3bps82','Obat Pusing','Konimeks','senti',12000);
/*!40000 ALTER TABLE `obat` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pasien`
--

DROP TABLE IF EXISTS `pasien`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `pasien` (
  `NoPasien` varchar(10) NOT NULL,
  `NamaPas` varchar(50) default NULL,
  `AlmPas` varchar(60) default NULL,
  `TelpPas` varchar(12) default NULL,
  `TglLahirPas` date default NULL,
  `JnsKelPas` varchar(2) default NULL,
  `TglRegistrasi` date default NULL,
  PRIMARY KEY  (`NoPasien`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `pasien`
--

LOCK TABLES `pasien` WRITE;
/*!40000 ALTER TABLE `pasien` DISABLE KEYS */;
INSERT INTO `pasien` VALUES ('pas-8c346A','Rizky Bagus Saputro','Klaten','081563487123','1998-10-02','Lk','2016-02-29'),('pas-uihbu','Muhammad Anwar A','Bonoloyo','08525412354','1998-03-17','Lk','2016-03-01');
/*!40000 ALTER TABLE `pasien` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pegawai`
--

DROP TABLE IF EXISTS `pegawai`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `pegawai` (
  `NIP` varchar(10) NOT NULL,
  `NamaPeg` varchar(50) default NULL,
  `AlmPeg` varchar(60) default NULL,
  `TelpPeg` varchar(12) default NULL,
  `TglLhrPeg` date default NULL,
  `JnsKelPeg` varchar(2) default NULL,
  PRIMARY KEY  (`NIP`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `pegawai`
--

LOCK TABLES `pegawai` WRITE;
/*!40000 ALTER TABLE `pegawai` DISABLE KEYS */;
INSERT INTO `pegawai` VALUES ('1122334455','Muktazam Hasbi Ashidiqi','Widororejo Rt 02/01','089123571923','1998-08-25','Lk'),('7689769769','Muhammad','Sukoharjo','08329305823','1993-12-03','08'),('13004111','Yoga Ichsan Permana','Sukoharjo','081234567890','1997-09-20','Lk'),('6457457457','Apotek Hahaha','huighuigiy','0899778524','1998-12-12','Lk'),('3904634623','Feng Chung','China','08989569834','1992-07-30','08');
/*!40000 ALTER TABLE `pegawai` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pemeriksaan`
--

DROP TABLE IF EXISTS `pemeriksaan`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `pemeriksaan` (
  `NoPemeriksaan` varchar(10) NOT NULL,
  `Keluhan` varchar(225) default NULL,
  `Diagnosa` varchar(225) default NULL,
  `Perawatan` varchar(225) default NULL,
  `Tindakan` varchar(225) default NULL,
  `BeratBadan` int(3) default NULL,
  `TensiDiastolik` int(11) default NULL,
  `TensiSistolik` int(11) default NULL,
  `NoPendaftaran` varchar(10) default NULL,
  PRIMARY KEY  (`NoPemeriksaan`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `pemeriksaan`
--

LOCK TABLES `pemeriksaan` WRITE;
/*!40000 ALTER TABLE `pemeriksaan` DISABLE KEYS */;
INSERT INTO `pemeriksaan` VALUES ('pem-98Ac8a','Pusing dan mual','Sakit kepala','Tidur yang nyenyak','Diberi obat sakit kepala',60,112,221,'pen-A3N845'),('pem-gxfsk','sakit dok, ah tidaaaakkk, tangan saya dok ....','sakit','ke rumah sakit aja','dibawa ke rumah sakit terdekat',73,123,12,'pen-2it9uk');
/*!40000 ALTER TABLE `pemeriksaan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pendaftaran`
--

DROP TABLE IF EXISTS `pendaftaran`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `pendaftaran` (
  `NoPendaftaran` varchar(10) NOT NULL,
  `TglPendaftaran` date default NULL,
  `NoUrut` int(3) default NULL,
  `NoPasien` varchar(10) default NULL,
  `IDJenisBiaya` varchar(5) default NULL,
  `KodeJadwal` varchar(5) default NULL,
  `NIP` varchar(10) default NULL,
  PRIMARY KEY  (`NoPendaftaran`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `pendaftaran`
--

LOCK TABLES `pendaftaran` WRITE;
/*!40000 ALTER TABLE `pendaftaran` DISABLE KEYS */;
INSERT INTO `pendaftaran` VALUES ('pen-A3N845','2016-02-29',1,'pas-8c346A','b-5A9','j-1fw','3904634623'),('pen-2it9uk','2002-03-16',2,'pas-uihbu','b-69y','j-1fw','3904634623');
/*!40000 ALTER TABLE `pendaftaran` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `poliklinik`
--

DROP TABLE IF EXISTS `poliklinik`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `poliklinik` (
  `KodePoli` varchar(5) NOT NULL default '',
  `NamaPoli` varchar(50) default NULL,
  PRIMARY KEY  (`KodePoli`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `poliklinik`
--

LOCK TABLES `poliklinik` WRITE;
/*!40000 ALTER TABLE `poliklinik` DISABLE KEYS */;
INSERT INTO `poliklinik` VALUES ('p-2Ha','Poli Anak'),('p-5qs','Poli Gigi'),('p-2vf','<marquee alternate=\"behavior\">anu</marquee>'),('p-6e6','Poli Tron'),('p-1e9','Poli Ponik');
/*!40000 ALTER TABLE `poliklinik` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `resep`
--

DROP TABLE IF EXISTS `resep`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `resep` (
  `NoResep` varchar(5) NOT NULL,
  `Dosis` varchar(20) default NULL,
  `Jumlah` int(11) default NULL,
  `KodeObat` varchar(10) default NULL,
  `NoPemeriksaan` varchar(10) default NULL,
  PRIMARY KEY  (`NoResep`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `resep`
--

LOCK TABLES `resep` WRITE;
/*!40000 ALTER TABLE `resep` DISABLE KEYS */;
INSERT INTO `resep` VALUES ('r-9s8','1 x sehari',10,'obt-3bps82','pem-98Ac8a'),('r-uy','1 x sehari',6,'APTX4869','pem-gxfsk');
/*!40000 ALTER TABLE `resep` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-03-03  1:15:08
