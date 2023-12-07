CREATE DATABASE  IF NOT EXISTS `inggraph` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `inggraph`;
-- MySQL dump 10.13  Distrib 8.0.32, for Win64 (x86_64)
--
-- Host: localhost    Database: inggraph
-- ------------------------------------------------------
-- Server version	8.0.32

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Dumping events for database 'inggraph'
--

--
-- Dumping routines for database 'inggraph'
--
/*!50003 DROP PROCEDURE IF EXISTS `add_producto` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`ventas_ing_graph`@`%` PROCEDURE `add_producto`(IN p_producto_id int(11), IN p_cantidad int(11), IN p_precio decimal(10,2), IN p_usuario_id int(11))
BEGIN
	INSERT INTO entradas(id_producto,cantidad,precio,usuario_id) 
    VALUES (p_producto_id, p_cantidad, p_precio, p_usuario_id);
    
    UPDATE producto set existencia=p_cantidad,precio=p_precio 
    where id_producto=p_producto_id;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `obtener_proveedor` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`ventas_ing_graph`@`%` PROCEDURE `obtener_proveedor`()
BEGIN
    SELECT id_proveedor, razon_social, telefono, colonia,calle,numero_ext, numero_int FROM proveedor ORDER BY razon_social;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `obtener_usuario` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`ventas_ing_graph`@`%` PROCEDURE `obtener_usuario`(IN p_usuario VARCHAR(40), IN p_clave VARCHAR(40))
BEGIN
    SELECT u.id_usuario, u.nombre, u.correo, u.usuario, r.id_rol, r.rol
    FROM usuario u
    INNER JOIN rol r ON u.rol_id = r.id_rol
    WHERE u.usuario = p_usuario AND u.clave = p_clave;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `obtener_ventas` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`ventas_ing_graph`@`%` PROCEDURE `obtener_ventas`()
BEGIN
    SELECT id_factura, fecha,cliente_id, totalfactura, estado FROM factura ORDER BY id_factura DESC;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `RealizarCompra` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `RealizarCompra`(
    IN productosCompra JSON,
    IN compraTotal DECIMAL(10, 2),
    IN p_usuario_id INT,
    IN p_cliente_id INT
)
BEGIN
    DECLARE cantidadProducto INT;
    DECLARE exist INT;
    DECLARE idProducto INT;
    DECLARE contador INT DEFAULT 0;
    DECLARE fechaEjecucion DATE;
    DECLARE cancelarCompra BOOLEAN DEFAULT FALSE;

    START TRANSACTION;
    REPEAT
        SET idProducto = JSON_UNQUOTE(JSON_EXTRACT(productosCompra, CONCAT('$[', contador, '][0]')));
        SET cantidadProducto = JSON_UNQUOTE(JSON_EXTRACT(productosCompra, CONCAT('$[', contador, '][1]')));
        SET fechaEjecucion = NOW();
        
        SELECT existencia INTO exist FROM producto WHERE id_producto = idProducto;
        IF exist >= cantidadProducto THEN
            UPDATE producto SET existencia = exist - cantidadProducto WHERE id_producto = idProducto;
        ELSE
            SET cancelarCompra = TRUE;
        END IF;

        SET contador = contador + 1;

    UNTIL contador >= (SELECT JSON_LENGTH(productosCompra)) END REPEAT;

    IF NOT cancelarCompra THEN
        INSERT INTO factura(fecha, totalfactura, estado, usuario_id, cliente_id)
        VALUES (fechaEjecucion, compraTotal, 1, p_usuario_id, p_cliente_id);

        SET @venta_id = LAST_INSERT_ID();
    END IF;

    CREATE TEMPORARY TABLE IF NOT EXISTS tmp_detallefactura (
        producto_id INT,
        cantidad INT,
        precio DECIMAL(10, 2)
    );
    SET contador = 0;
    REPEAT
        SET idProducto = JSON_UNQUOTE(JSON_EXTRACT(productosCompra, CONCAT('$[', contador, '][0]')));
        SET cantidadProducto = JSON_UNQUOTE(JSON_EXTRACT(productosCompra, CONCAT('$[', contador, '][1]')));

        SELECT precio INTO @precioProducto FROM producto WHERE id_producto = idProducto;

        IF @precioProducto IS NOT NULL THEN
            INSERT INTO tmp_detallefactura (producto_id, cantidad, precio)
            VALUES (idProducto, cantidadProducto, @precioProducto);
        ELSE
            SIGNAL SQLSTATE '45000';
            SET cancelarCompra = TRUE;
        END IF;

        SET contador = contador + 1;

    UNTIL contador >= (SELECT JSON_LENGTH(productosCompra)) END REPEAT;

    IF NOT cancelarCompra THEN
        INSERT INTO detallefactura (factura_id, producto_id, cantidad, precio_venta)
        SELECT @venta_id, producto_id, cantidad, precio FROM tmp_detallefactura;
    END IF;

    DROP TEMPORARY TABLE IF EXISTS tmp_detallefactura;

    IF cancelarCompra THEN
        ROLLBACK;
    ELSE
        COMMIT;
    END IF;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `update_cliente` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`ventas_ing_graph`@`%` PROCEDURE `update_cliente`(IN p_id_cliente int(11), in p_rfc varchar(12), in p_nombre varchar(100), in p_telefono varchar(20), in p_colonia varchar(80), in p_calle varchar(80),in p_num_ext varchar(5),in p_num_int varchar(5))
BEGIN
    UPDATE cliente 
    SET rfc=p_rfc, telefono=p_telefono, nombre=p_nombre,colonia=p_colonia, calle=p_calle,numero_ext=p_num_ext, numero_int=p_num_int 
    where id_cliente=p_id_cliente;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `update_producto` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`ventas_ing_graph`@`%` PROCEDURE `update_producto`(IN p_producto varchar(200), IN  p_precio decimal(10,2), p_proveedor_id int(11), IN p_id_producto int(11))
BEGIN
    UPDATE producto 
    SET descripcion=p_producto, precio=p_precio, proveedor_id=p_proveedor_id
    where id_producto=p_id_producto;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `update_proveedor` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`ventas_ing_graph`@`%` PROCEDURE `update_proveedor`(IN p_proveedor varchar(100), IN  p_telefono VARCHAR(20), IN p_colonia VARCHAR(80), IN p_calle VARCHAR(80),IN p_num_ext VARCHAR(5),IN p_num_int VARCHAR(5),   IN p_usuario_id INT(11), IN p_id_proveedor INT(11))
BEGIN
    UPDATE proveedor 
    SET razon_social=p_proveedor, telefono=p_telefono ,colonia=p_colonia,calle=p_calle,numero_ext=p_num_ext, numero_int=p_num_int, usuario_id=p_usuario_id
    where id_proveedor=p_id_proveedor;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `update_usuario` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`ventas_ing_graph`@`%` PROCEDURE `update_usuario`(IN p_id_usuario int(11), IN  p_id_rol int(11), IN p_usuario varchar(20), IN p_correo varchar(100))
BEGIN
    UPDATE usuario 
    SET rol_id=p_id_rol, correo=p_correo ,usuario=p_usuario
    where id_usuario=p_id_usuario;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-12-06 19:40:25
