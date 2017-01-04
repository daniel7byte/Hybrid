/*
MySQL Backup
Source Server Version: 5.6.34
Source Database: hybrid
Date: 11/29/2016 09:16:54
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
--  Table structure for `registros`
-- ----------------------------
DROP TABLE IF EXISTS `registros`;
CREATE TABLE `registros` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `fechaManual` date NOT NULL,
  `eS` enum('ENTRADA','SALIDA') COLLATE utf8_unicode_ci NOT NULL,
  `tipoDocumento` enum('CXC','DISTRIJUEGOS','SIN IVA','FUERA INVENTARIO','COMPRA','DEVOLUCION','SIN FACTURA','SEPARADO','AVERIADO') COLLATE utf8_unicode_ci NOT NULL,
  `consecutivoManual` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `referencia` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `cantidad` int(100) NOT NULL,
  `proveedor` varchar(6) COLLATE utf8_unicode_ci NOT NULL,
  `estado` enum('NO APLICA','PAGADO','ABONADO','PENDIENTE','ANULADO','DEVOLUCION','CRUCE DE CUENTAS') COLLATE utf8_unicode_ci NOT NULL,
  `descripcion` text COLLATE utf8_unicode_ci NOT NULL,
  `refAdmin` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `contabilizadoAdmin` tinyint(1) NOT NULL DEFAULT '0',
  `error` tinyint(1) NOT NULL DEFAULT '0',
  `fechaCreacion` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `idUsuario` bigint(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
--  Table structure for `usuarios`
-- ----------------------------
DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE `usuarios` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `contrasenia` text COLLATE utf8_unicode_ci NOT NULL,
  `rol` enum('ADMIN','USER') COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
--  Records 
-- ----------------------------
INSERT INTO `registros` VALUES ('12','2016-11-28','SALIDA','CXC','654436','FT0013','10','000083','ABONADO','Sale a prestamos','','0','1','2016-11-28 20:03:56','10'), ('13','2016-11-28','SALIDA','CXC','64754','TC0001','5','000004','PENDIENTE','Sale taco en cxc  pagan mañana','','0','0','2016-11-28 20:12:06','15'), ('14','2016-11-29','ENTRADA','CXC','Prueba 7','1862MD','14','000070','PENDIENTE','xhg','','0','1','2016-11-29 08:40:19','10'), ('15','2016-11-29','ENTRADA','CXC','Prueba 8','460-038','777','000068','NO APLICA','asfasd','','0','0','2016-11-29 08:51:50','10');
INSERT INTO `usuarios` VALUES ('10','enriqueposso','$2y$12$o/ryDlGe6uDhiyVdOWlHMOC5GQhuRbCR.J9oI6qK3Aq91j.DZhOle','ADMIN'), ('11','luzbedoya','$2y$12$vw2VHalk8zM5FI3zOT.8LOg6RkPv6mYyNiaX5wM3L7gB06G2/Ubxu','ADMIN'), ('12','alextrejos78','$2y$12$cEn1.GXkTLtq7yKk/x5KrOcphvxcZ4q956Cid.R2PZCgCDuTCRIvC','ADMIN'), ('13','kathe','$2y$12$L63w65PD0Ne6PlxAJliBhejPD/NBKgKdjrN.98XoDUkoBcFzA4HkW','ADMIN'), ('14','jose','$2y$12$aNLfTr/OWTq7IGOmIg2UlO8ntoeYDcfgvDXmwWU223Mb5xqgQlZXK','USER'), ('15','sandra','$2y$12$qX02fpoLNw8acBZ3VYMyT.YN3eyQWj/e8c17DENt13ghp0puQfZ9m','USER'), ('16','yaneth','$2y$12$zYvp29x1zyqhkay/JQ5RL.DQp374y029yeoJKoPfGpPkSn.djH8nq','USER'), ('17','luis','$2y$12$zIGPeitqkE7jCV3WWsMEJeR0XnvvRbVzq542iHl.Nr6Vz7yszZc4a','USER');
