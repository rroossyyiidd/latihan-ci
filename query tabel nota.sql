CREATE TABLE `nota` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tanggal` date DEFAULT NULL,
  `nomor` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

CREATE TABLE `nota_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idnota` int(11) DEFAULT NULL,
  `karyawanid` int(11) DEFAULT NULL,
  `biaya` float DEFAULT NULL,
  `qty` float DEFAULT NULL,
  `subtotal` float DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
