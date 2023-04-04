select@@autocommit;
set autocommit=0;
CREATE DATABASE IF NOT EXISTS `sistema_medico` ;
USE `sistema_medico`;

-- Volcando estructura para tabla sistema_medico.medicamentos
CREATE TABLE IF NOT EXISTS `medicamentos` (
  `id_medicamento` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_medicamento` varchar(45) NOT NULL,
  `via_administracion` enum('Oral','Cutánea','Oftalmológica','Inhalatoria','Intramuscular') NOT NULL,
  `precio` decimal(10,2) NOT NULL DEFAULT '0.00',
  `estatus` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_medicamento`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla sistema_medico.medicamentos: ~24 rows (aproximadamente) 
INSERT INTO `medicamentos` (`id_medicamento`, `nombre_medicamento`, `via_administracion`, `precio`, `estatus`) VALUES
	(1, 'Paracetamol', 'Oral', 65.00, 1),
	(2, 'Naproxeno', 'Oral', 120.00, 1),
	(3, 'Ampicilina', 'Cutánea', 45.00, 1),
	(4, 'Ephedrine', 'Oral', 56.00, 1),
	(5, 'Penicilina', 'Intramuscular', 35.00, 1),
	(6, 'Dermalog', 'Cutánea', 78.00, 1),
	(7, 'Ergotamine', 'Oral', 68.00, 1),
	(8, 'Simvastatina', 'Oral', 156.00, 1),
	(9, 'Aspirina', 'Oral', 23.00, 1),
	(10, 'Omeprazol', 'Oral', 105.00, 1),
	(11, 'Salbutamol', 'Inhalatoria', 320.00, 1),
	(12, 'Cloranfenicol', 'Oftalmológica', 253.00, 1),
	(13, 'Nafazolina', 'Oftalmológica', 32.00, 1),
	(14, 'Ambroxol', 'Oral', 65.00, 1),
	(15, 'Hidrocortisona', 'Cutánea', 36.00, 1),
	(16, 'Ácido aminocaproico', 'Intramuscular', 259.00, 1),
	(17, 'Miconazol', 'Cutánea', 45.00, 1),
	(18, 'Óxido de zinc', 'Cutánea', 18.00, 1),
	(19, 'Fluticasona', 'Inhalatoria', 159.00, 1),
	(20, 'Deferasirox', 'Intramuscular', 396.00, 1),
	(21, 'Bencilo', 'Cutánea', 96.00, 1),
	(22, 'Oximetolona', 'Oral', 348.00, 1),
	(23, 'Salmeterol', 'Inhalatoria', 91.00, 1),
	(24, 'Terbutalina', 'Intramuscular', 63.00, 1); 

-- Volcando estructura para tabla sistema_medico.medicamentos_recetados
CREATE TABLE IF NOT EXISTS `medicamentos_recetados` (
  `id_receta` smallint(4) NOT NULL,
  `id_medicamento` int(11) NOT NULL,
  `cantidad` smallint(2) NOT NULL,
  `indicaciones` varchar(100) NOT NULL,
  PRIMARY KEY (`id_receta`,`id_medicamento`),
  KEY `fk_medicamentos_recetados_recetas1_idx` (`id_receta`),
  KEY `fk_medicamentos_recetados_medicamentos1_idx` (`id_medicamento`),
  CONSTRAINT `fk_medicamentos_recetados_medicamentos1` FOREIGN KEY (`id_medicamento`) REFERENCES `medicamentos` (`id_medicamento`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_medicamentos_recetados_recetas1` FOREIGN KEY (`id_receta`) REFERENCES `recetas` (`id_receta`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla sistema_medico.medicamentos_recetados: ~2 rows (aproximadamente)
INSERT INTO `medicamentos_recetados` (`id_receta`, `id_medicamento`, `cantidad`, `indicaciones`) VALUES
	(1, 3, 2, 'Tomar cada 5 horas'),
	(1, 9, 1, 'Tomar en ayunas'),
	(2, 7, 1, 'Tomar cada 3 horas'),
	(3, 14, 1, 'Cada 8 horas por 10 días'),
	(4, 19, 1, 'Cada 48 horas'),
	(5, 2, 2, 'Tomar cada que se presente los síntomas'),
	(6, 20, 1, 'Seguir indicaciones del medicamento'),
	(6, 21, 1, 'Aplicar cada 8 horas'),
	(7, 24, 1, 'Cada 12 horas'),
	(8, 8, 3, 'Cada 4 horas'),
	(9, 1, 1, 'Cuando se presente el síntoma'),
	(9, 4, 4, 'Aplicar cada 4 horas'),
	(10, 3, 3, 'Aplicar cada 48 horas'),
	(10, 10, 1, 'Tomar cada 12 horas después de cada comida'),
	(10, 18, 2, 'Aplicación despues del baño en la zona afectada'),
	(11, 11, 1, 'Cada 6 horas'),
	(11, 23, 1, 'Cada 12 horas'),
	(12, 6, 1, 'Aplicar dos veces al días cada 12 horas'),
	(12, 17, 1, 'Aplicar en la parte afectada'),
	(13, 6, 1, 'Aplicar en la parte afectada'),
	(14, 5, 2, 'Aplicar cada 12 horas'); 

-- Volcando estructura para tabla sistema_medico.medicos
CREATE TABLE IF NOT EXISTS `medicos` (
  `id_medico` smallint(6) NOT NULL AUTO_INCREMENT,
  `nombre_medico` varchar(45) NOT NULL,
  `apellidos_medico` varchar(45) DEFAULT NULL,
  `cedula_profesional` varchar(10) NOT NULL,
  `estatus` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_medico`),
  UNIQUE KEY `cedula_profesional_UNIQUE` (`cedula_profesional`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla sistema_medico.medicos: ~7 rows (aproximadamente) 
INSERT INTO `medicos` (`id_medico`, `nombre_medico`, `apellidos_medico`, `cedula_profesional`, `estatus`) VALUES
	(1, 'Julian', 'Aguilar Estrada', '1234567', 1),
	(2, 'Rafael', 'Villegas Velasco', '8901234', 1),
	(3, 'Ruben', 'Poot Peña', '5678901', 1),
	(4, 'Mayra', 'Fuentes Sosa', '2345678', 1),
	(5, 'Sandra', 'Hernández Chacón', '9012345', 1),
	(6, 'Rocio', 'Arceo Díaz', '6789012', 1),
	(7, 'Francisco', 'González López', '3456789', 1); 

-- Volcando estructura para tabla sistema_medico.pacientes
CREATE TABLE IF NOT EXISTS `pacientes` (
    `id_paciente` INT(11) NOT NULL AUTO_INCREMENT,
    `nombre_paciente` VARCHAR(45) NOT NULL,
    `apellidos_paciente` VARCHAR(45) DEFAULT NULL,
    `edad` INT(45) NOT NULL,
    `fecha_alta` DATE NOT NULL,
    `estatus` TINYINT(1) NOT NULL DEFAULT '1',
    PRIMARY KEY (`id_paciente`)
)  ENGINE=INNODB AUTO_INCREMENT=15 DEFAULT CHARSET=UTF8;
ALTER TABLE `sistema_medico`.`pacientes` 
CHANGE COLUMN `edad` `edad` INT NOT NULL ;


-- Volcando datos para la tabla sistema_medico.pacientes: ~14 rows (aproximadamente) 
INSERT INTO `pacientes` (`id_paciente`, `nombre_paciente`, `apellidos_paciente`, `edad`, `fecha_alta`, `estatus`) VALUES
	(1, 'Maria', 'Parra Medina', 20, '2022-01-20', 1),
	(2, 'Jose Alejandro', 'Cordero Paza', 21, '2022-02-15', 1),
	(3, 'Josefina', 'Vázquez Mota', 56, '2022-02-23', 1),
	(4, 'Andrés Manuel', 'López Obrado', 62, '2022-02-28', 1),
	(5, 'Beatriz', 'Muller Iñiguez', 52, '2022-02-28', 1),
	(6, 'Mirelle', 'Sosa Caballero', 35, '2022-03-02', 1),
	(7, 'Daniel', 'Orrante Guzmán', 26, '2022-03-02', 1),
	(8, 'Julio César', 'Celis Medina', 35, '2022-03-02', 1),
	(9, 'Eduardo', 'Abuxabqui Moo', 29, '2022-03-05', 1),
	(10, 'Joel ', 'Canché Dzib', 25, '2022-03-07', 1),
	(11, 'Jonhatan', 'Dos Santos Hernández', 36, '2022-03-09', 1),
	(12, 'Nancy', 'Aguas Madero', 42, '2022-03-10', 1),
	(13, 'Rodrigo', 'Mendez Guillén', 58, '2022-03-10', 1),
	(14, 'Ian', 'Valdéz Rodríguez', 15, '2022-03-14', 1); 
select * from pacientes;
-- Volcando estructura para tabla sistema_medico.recetas
CREATE TABLE IF NOT EXISTS `recetas` (
  `id_receta` smallint(4) NOT NULL AUTO_INCREMENT,
  `fecha_receta` date NOT NULL,
  `proxima_cita` datetime NOT NULL,
  `id_medico` smallint(6) NOT NULL,
  `id_paciente` int(11) NOT NULL,
  `estatus` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_receta`,`id_medico`,`id_paciente`),
  KEY `fk_Recetas_Medicos_idx` (`id_medico`),
  KEY `fk_Recetas_Pacientes_idx` (`id_paciente`),
  CONSTRAINT `fk_Recetas_Medicos` FOREIGN KEY (`id_medico`) REFERENCES `medicos` (`id_medico`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Recetas_Pacientes1` FOREIGN KEY (`id_paciente`) REFERENCES `pacientes` (`id_paciente`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla sistema_medico.recetas: ~14 rows (aproximadamente) 
INSERT INTO `recetas` (`id_receta`, `fecha_receta`, `proxima_cita`, `id_medico`, `id_paciente`, `estatus`) VALUES
	(1, '2022-03-02', '2022-04-02 00:00:00', 1, 7, 1),
	(2, '2022-03-02', '2022-03-22 00:00:00', 1, 8, 1),
	(3, '2022-03-02', '2022-04-02 00:00:00', 2, 6, 1),
	(4, '2022-03-05', '2022-03-25 00:00:00', 2, 9, 1),
	(5, '2022-03-07', '2022-03-27 00:00:00', 2, 10, 1),
	(6, '2022-02-28', '2022-02-28 00:00:00', 3, 5, 1),
	(7, '2022-03-09', '2022-03-29 00:00:00', 3, 11, 1),
	(8, '2022-02-28', '2022-03-08 00:00:00', 4, 4, 1),
	(9, '2022-02-23', '0000-00-00 00:00:00', 5, 3, 1),
	(10, '2022-02-15', '2022-02-25 00:00:00', 6, 2, 1),
	(11, '2022-03-10', '2022-03-30 00:00:00', 6, 12, 1),
	(12, '2022-03-10', '2022-04-10 00:00:00', 6, 13, 1),
	(13, '2022-03-14', '2022-04-24 00:00:00', 6, 14, 1),
	(14, '2022-01-20', '2022-01-30 00:00:00', 7, 1, 1);
drop table usuario;
CREATE TABLE `sistema_medico`.`usuario` (
  `id_usuario` INT NOT NULL AUTO_INCREMENT,
  `nombre_usuario` VARCHAR(50) NOT NULL,
  `apellidos_usuario` VARCHAR(50) NOT NULL,
  `correo_electronico` VARCHAR(50) NOT NULL,
  `contrasenia` VARCHAR(50) NOT NULL,
  PRIMARY KEY (`id_usuario`),
  UNIQUE KEY `id_usuario` (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;


INSERT INTO `usuario` (`id_usuario`, `nombre_usuario`, `apellidos_usuario`, `correo_electronico`, `contrasenia`) VALUES
	(1, 'Yadira', 'Hernandez Cordova', 'yadirahc30@gmail.com', 'hc30yadira');
CREATE TABLE IF NOT EXISTS `medicos` (
  `id_medico` smallint(6) NOT NULL AUTO_INCREMENT,
  `nombre_medico` varchar(45) NOT NULL,
  `apellidos_medico` varchar(45) DEFAULT NULL,
  `cedula_profesional` varchar(10) NOT NULL,
  `estatus` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_medico`),
  UNIQUE KEY `cedula_profesional_UNIQUE` (`cedula_profesional`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;


/*   hasta aqui no se ejecuta en my*/
-- sp que funciona------------------------------------------------------------------------
SELECT id_medico,CONCAT(nombre_medico,' ',apellidos_medico) 
AS nombre_completo FROM medicos where estatus >0;

delimiter //
create procedure todos_los_medicos()
begin
select id_medico, concat(nombre_medico,' ', apellidos_medico)
as nombre_completo from medicos 
where estatus >0;
end;
demiliter;
call todos_los_medicos();
-- trigeer de ingregar, actualizar y eliminar un medicoi-------------------------------------------
drop table log_medico;
CREATE TABLE log_medico (
	id int not null auto_increment primary key,
    fecha_registro DATETIME DEFAULT CURRENT_TIMESTAMP,
    accion varchar(500)
);
select * from log_medico;
drop trigger registromedico;
delimiter //
create trigger registromedico after insert on medicos
for each row
begin
	insert into log_medico (accion)
    value (concat ('se inserto el medico ', NEW.nombre_medico, ' ',NEW.apellidos_medico, ' ', NEW.cedula_profesional, ' ', NEW.estatus, ''));
end //
delimiter ;
-- actualiar-------------------------------
delimiter //
create trigger updatemedico after update on medicos
for each row
begin
	insert into log_medico (accion)
    value (concat ('informacion vieja ', OLD.nombre_medico, ' ',OLD.apellidos_medico, ' ', OLD.cedula_profesional, ' ', OLD.estatus, ''));
    insert into log_medico (accion)
	value (concat ('actualizacion ', NEW.nombre_medico, ' ',NEW.apellidos_medico, ' ', NEW.cedula_profesional, ' ', NEW.estatus, ''));
end //
delimiter ;
drop trigger deletemedico;

delimiter //
create trigger deletemedico before delete on medicos
for each row
begin
	insert into log_medico (accion)
    value (concat ('se elimino el medico ', OLD.nombre_medico, ' ',OLD.apellidos_medico, ' ', OLD.cedula_profesional, ' ', OLD.estatus, ''));
end //
delimiter ;
/*nnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnn sp medicamentos*/
SELECT id_medicamento,CONCAT(nombre_medicamento) 
AS nombre_medicamento FROM medicamentp where estatus >0;

/*nnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnn sp medicamentos_recetados*/
SELECT id_receta, id_medicamento, cantidad, indicaciones FROM medicamentos_recetados where id_receta >0;



/*sp de llamar todos lo emdicamentos*/

/*create procedure todos_los_medicamentos()
begin
SELECT id_medicamento,CONCAT(nombre_medicamento) 
AS nombre_medicamento FROM medicamentos where estatus >0; 
end;
demiliter;
call todos_los_medicamentos();*/



USE `sistema_medico`;
DROP procedure IF EXISTS `todos_los_medicamentos`;

DELIMITER $$
USE `sistema_medico`$$
CREATE PROCEDURE `todos_los_medicamentos` ()
BEGIN
SELECT id_medicamento,CONCAT(nombre_medicamento) 
AS nombre_medicamento FROM medicamentos where estatus >0;
END$$

DELIMITER ;

/**/

