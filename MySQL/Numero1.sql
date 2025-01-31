USE animes_bd;

-- seleccionamos todo lo de animes
SELECT * FROM animes;
/*
Esto tambien es un comentario
*/
SELECT * FROM animes ORDER BY anno_estreno; -- orden ascendente
SELECT * FROM animes ORDER BY anno_estreno DESC; -- orden ascendente
SELECT * FROM animes WHERE titulo = "Frieren";
SELECT * FROM animes WHERE titulo LIKE "f%";
SELECT * FROM animes WHERE titulo LIKE "%n";
SELECT * FROM animes WHERE titulo LIKE "%a%";
SELECT * FROM animes WHERE titulo LIKE "%frieren%";
SELECT * FROM animes WHERE titulo LIKE "%tragones%";
SELECT titulo, nombre_estudio, anno_estreno 
	FROM animes
    WHERE anno_estreno BETWEEN 2010 AND 2020
    ORDER BY titulo;-- el order by se ponia lo ultimo
    
SELECT * FROM estudios;
SELECT * FROM animes;
-- Vamos a mostrar el titulo del anime, su estudio y la ciudad del estudio

SELECT a.titulo, e.nombre_estudio, e.ciudad
	FROM animes a RIGHT JOIN estudios e
		ON a.nombre_estudio = e.nombre_estudio; -- igualamos la clave foranea con la clave primaria con la que se relaciona.
		-- como es la misma podemos poner o a o e pero no lo podemos poner sin nada porque no lo reconoce eso si es un join normal si es right o left seria el que le digamos que tiene prioridad
        
SET AUTOCOMMIT = 0; -- 0 es que no y 1 es que si "autoguardado"
SET SQL_SAFE_UPDATES = 0; -- Deshabilitamos el modo niños "cono esto podemos cragarnos la base de datos"

DELETE FROM animes; -- Borramos toda la tabla
SELECT * FROM animes; -- Vemos que no hay nada
ROLLBACK; -- Volvemos a cuando hicimos el autocommit
SELECT * FROM animes; -- Vemos que ahora si esta todo
INSERT INTO estudios VALUES ("Wanolo", "Mozambique del norte", 2024);
SELECT * FROM estudios;
COMMIT;
INSERT INTO estudios VALUES ("Wanolo", "Mozambique del sur", 2024);
ROLLBACK;
SELECT * FROM estudios; -- Vemos que hemos venido a lo anterior
/*
COMMIT -> GUARDAR
ROLLBACK -> VOLVER AL ULTIMO GUARDADO
*/

/*
update ACCOUNTS set SALDO -=30 where ID = "1331";
update ACCOUNTS set SALDO +=30 where ID = "0123";
COMMIT;
*/

-- Se realiza como bloque hace el commit si esta todo bien, si da error no se guarda

USE animes_bd;

ALTER TABLE animes ADD COLUMN imagen VARCHAR(40);

SELECT * FROM animes;

USE animes_bd;

CREATE TABLE usuarios (
	usuario VARCHAR(15) PRIMARY KEY,
    contrasena VARCHAR(255)
);

select * from usuarios;