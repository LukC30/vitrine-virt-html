CREATE TABLE `PROFILIA_FOTO` (
	`CODPROD` INT(11) NOT NULL DEFAULT '0',
	`ID_FOTO` INT(11) NOT NULL AUTO_INCREMENT,
	`CAMINHO` VARCHAR(4000) NULL DEFAULT NULL COLLATE 'utf8_general_ci',
	`NOME_ARQUIVO_ORIGINAL` VARCHAR(150) NULL DEFAULT NULL COLLATE 'utf8_general_ci',
	`DT_FOTO` DATE NULL DEFAULT NULL,
	PRIMARY KEY (`CODPROD`, `ID_FOTO`) USING BTREE
)
COLLATE='utf8_general_ci'
ENGINE=MyISAM
ROW_FORMAT=DYNAMIC
AUTO_INCREMENT=1
MAX_ROWS=999999
;

#Criação de view para facilitar as buscas 

create view produtos as
select a.codprod as id, a.descricao, a.prvenda as preco, a.codgru as grupo, b.nomegru as nome_grupo , c.caminho
from profilia a
inner join grupo b on b.codgru = a.codgru
inner join profilia_foto c on c.codprod = a.codprod
where c.id_foto = 1
