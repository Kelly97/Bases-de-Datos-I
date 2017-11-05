--INSERT Registros Tipo Notificacion
INSERT INTO TBL_TIPO_NOTIFICACION (TIPO_NOTIFICACION)
VALUES ('Seguimiento');
INSERT INTO TBL_TIPO_NOTIFICACION (TIPO_NOTIFICACION)
VALUES ('Comentario');
INSERT INTO TBL_TIPO_NOTIFICACION (TIPO_NOTIFICACION)
VALUES ('Reacción noticia');
INSERT INTO TBL_TIPO_NOTIFICACION (TIPO_NOTIFICACION)
VALUES ('Reacción comentario');
INSERT INTO TBL_TIPO_NOTIFICACION (TIPO_NOTIFICACION)
VALUES ('Flip');

--INSERT Registros Estado Notificacion
INSERT INTO TBL_ESTADO_NOTIFICACION (ESTADO_NOTIFICACION)
VALUES ('Vista');
INSERT INTO TBL_ESTADO_NOTIFICACION (ESTADO_NOTIFICACION)
VALUES ('Pendiente');

--INSERT Registros Categorías
INSERT INTO tbl_categoria (categoria) 
VALUES ('Tecnología');
INSERT INTO tbl_categoria (categoria) 
VALUES ('Ciencia');
INSERT INTO tbl_categoria (categoria) 
VALUES ('Automotríz');
INSERT INTO tbl_categoria (categoria) 
VALUES ('Celebridades');
INSERT INTO tbl_categoria (categoria) 
VALUES ('Hogar');
INSERT INTO tbl_categoria (categoria) 
VALUES ('Viajes');
INSERT INTO tbl_categoria (categoria) 
VALUES ('Videojuegos');
INSERT INTO tbl_categoria (categoria) 
VALUES ('Diseño');
INSERT INTO tbl_categoria (categoria) 
VALUES ('Fotografía');
INSERT INTO tbl_categoria (categoria) 
VALUES ('Negocios');
INSERT INTO tbl_categoria (categoria) 
VALUES ('Salud y Ejercicio');
INSERT INTO tbl_categoria (categoria) 
VALUES ('Gastronomía');
INSERT INTO tbl_categoria (categoria) 
VALUES ('Música');
INSERT INTO tbl_categoria (categoria) 
VALUES ('Cine');

--INSERT Registros Estado Usuario
INSERT INTO tbl_estado_usuario (estado) 
VALUES ('Cuenta Verificada');
INSERT INTO tbl_estado_usuario (estado) 
VALUES ('Cuenta No Verificada');
INSERT INTO tbl_estado_usuario (estado) 
VALUES ('Eliminado');

--INSERT Registros Tipos de Usuario
INSERT INTO tbl_tipos_usuario (tipo_usuario) 
VALUES ('Normal');
INSERT INTO tbl_tipos_usuario (tipo_usuario) 
VALUES ('Proveedor de Noticias');
INSERT INTO tbl_tipos_usuario (tipo_usuario) 
VALUES ('Administrador');

--INSERT Registros Reacciones
INSERT INTO tbl_reacciones (tipo_reaccion) 
VALUES ('Me gusta');

--INSERT Registros Tipo de Revistas
INSERT INTO tbl_tipo_revistas (tipo_revista) 
VALUES ('Pública');
INSERT INTO tbl_tipo_revistas (tipo_revista) 
VALUES ('Privada');

--INSERT Registros Tipo de Lugar
INSERT INTO tbl_tipo_lugar (tipo_lugar) 
VALUES ('País');
INSERT INTO tbl_tipo_lugar (tipo_lugar) 
VALUES ('Provincia');
INSERT INTO tbl_tipo_lugar (tipo_lugar) 
VALUES ('Departamento');
INSERT INTO tbl_tipo_lugar (tipo_lugar) 
VALUES ('Estado');
INSERT INTO tbl_tipo_lugar (tipo_lugar) 
VALUES ('Continente');

--INSERT Registros Lugares
INSERT INTO tbl_lugares (codigo_tipo_lugar,nombre_lugar,latitud,longitud) 
VALUES (5,'América','02°43′00″S','132°18′00″E');
INSERT INTO tbl_lugares (codigo_tipo_lugar,nombre_lugar,latitud,longitud) 
VALUES (5,'Europa','52°05′00″N','07°23′00″E');
INSERT INTO tbl_lugares (codigo_tipo_lugar,nombre_lugar,latitud,longitud) 
VALUES (5,'Asia','36°22′13″N','127°28′26″E');
INSERT INTO tbl_lugares (codigo_tipo_lugar,nombre_lugar,latitud,longitud) 
VALUES (5,'África','36°22′13″N','127°28′26″E');
INSERT INTO tbl_lugares (codigo_tipo_lugar,nombre_lugar,latitud,longitud) 
VALUES (5,'Oceanía','36°22′13″N','127°28′26″E');
INSERT INTO tbl_lugares (codigo_tipo_lugar,nombre_lugar,latitud,longitud) 
VALUES (5,'Antártida','36°22′13″N','127°28′26″E');
INSERT INTO tbl_lugares (codigo_lugar_padre,codigo_tipo_lugar,nombre_lugar,latitud,longitud) 
VALUES (1,1,'Honduras','14°41′00″N','87°25′00″W');
INSERT INTO tbl_lugares (codigo_lugar_padre,codigo_tipo_lugar,nombre_lugar,latitud,longitud) 
VALUES (1,1,'Guatemala','14°41′00″N','87°25′00″W');
INSERT INTO tbl_lugares (codigo_lugar_padre,codigo_tipo_lugar,nombre_lugar,latitud,longitud) 
VALUES (1,1,'El Salvador','14°41′00″N','87°25′00″W');
INSERT INTO tbl_lugares (codigo_lugar_padre,codigo_tipo_lugar,nombre_lugar,latitud,longitud) 
VALUES (1,1,'Belice','14°41′00″N','87°25′00″W');
INSERT INTO tbl_lugares (codigo_lugar_padre,codigo_tipo_lugar,nombre_lugar,latitud,longitud) 
VALUES (1,1,'Estados Unidos','14°41′00″N','87°25′00″W');
INSERT INTO tbl_lugares (codigo_lugar_padre,codigo_tipo_lugar,nombre_lugar,latitud,longitud) 
VALUES (1,1,'Canadá','14°41′00″N','87°25′00″W');
INSERT INTO tbl_lugares (codigo_lugar_padre,codigo_tipo_lugar,nombre_lugar,latitud,longitud) 
VALUES (2,1,'España','43°10′49″N','06°59′08″W');
INSERT INTO tbl_lugares (codigo_lugar_padre,codigo_tipo_lugar,nombre_lugar,latitud,longitud) 
VALUES (3,1,'Emiratos Árabes Unidos','24°28′00″N','54°22′00″E');

--INSERT Registros Usuarios
--ADMINISTRADOR
INSERT INTO tbl_usuarios (codigo_tipo_usuario,codigo_lugar_residencia,codigo_estado_usuario,nombre_usuario,alias_usuario,correo,contrasenia,fecha_registro) 
VALUES (3,4,1,'Administrador','Administrador','web_admin@flipboard.com','asd.456',TO_DATE('19/10/2017','DD/MM/YYYY'));
--USUARIOS NORMALES
INSERT INTO tbl_usuarios (codigo_tipo_usuario,codigo_lugar_residencia,codigo_estado_usuario,nombre_usuario,alias_usuario,correo,contrasenia,url_foto_perfil,descripcion,fecha_registro) 
VALUES (1,4,2,'Marco Polo','Marc2345','marco_99@gmail.com','asd.456','images/foto_perfiles/3d-Wallpaper-Hd-3.jpg','Entretenimiento para todos.',TO_DATE('19/10/2017','DD/MM/YYYY'));
INSERT INTO tbl_usuarios (codigo_tipo_usuario,codigo_lugar_residencia,codigo_estado_usuario,nombre_usuario,alias_usuario,correo,contrasenia,url_foto_perfil,fecha_registro) 
VALUES (1,5,2,'Rosa Betancourt','Rosy4521','rosybet@gmail.com','asd.456','images/foto_perfiles/AnimalesVectoriales_Wahyu_Romdhoni.jpg',TO_DATE('19/10/2017','DD/MM/YYYY'));
INSERT INTO tbl_usuarios (codigo_tipo_usuario,codigo_lugar_residencia,codigo_estado_usuario,nombre_usuario,alias_usuario,correo,contrasenia,url_foto_perfil,fecha_registro) 
VALUES (1,6,2,'Abdel Hadi','abdelhadi_43','abdel_43@yahoo.com','asd.456','images/foto_perfiles/Mokona.Modoki.full.35354 (1).jpg',TO_DATE('19/10/2017','DD/MM/YYYY'));
--USUARIOS CON CUENTAS VERIFICADAS
INSERT INTO tbl_usuarios (codigo_tipo_usuario,codigo_lugar_residencia,codigo_estado_usuario,nombre_usuario,alias_usuario,correo,contrasenia,url_foto_perfil,descripcion,fecha_registro) 
VALUES (2,4,1,'National Geographic','NatGeo','NationalGeographic@natgeo.com','asd.456','images/foto_perfiles/National-Geographic-logo.png','Flipboard oficial de la revista National Geographic España. Actualidad, reportajes, fotos espectaculares, exploración, vídeos...',TO_DATE('19/10/2017','DD/MM/YYYY'));
INSERT INTO tbl_usuarios (codigo_tipo_usuario,codigo_lugar_residencia,codigo_estado_usuario,nombre_usuario,alias_usuario,correo,contrasenia,url_foto_perfil,descripcion,fecha_registro) 
VALUES (2,4,1,'REVISTA ¡HOLA!','Hola1234','revistahola@hotmail.com','asd.456','http://claudinehandbags.com/wp-content/uploads/2015/08/hola-revista.jpg','Las novedades sobre las estrellas de cine y música, tendencias de moda, belleza, recetas de cocina y las Casas Reales en el portal femenino líder en Internet. ',TO_DATE('05/03/2017','DD/MM/YYYY'));
INSERT INTO tbl_usuarios (codigo_tipo_usuario,codigo_lugar_residencia,codigo_estado_usuario,nombre_usuario,alias_usuario,correo,contrasenia,url_foto_perfil,descripcion,fecha_registro) 
VALUES (2,4,1,'XATAKA','XATAKA23','xataka@xataka.com','asd.456','images/foto_perfiles/Xataca-Honor.png','Apasionados por la tecnología.',TO_DATE('01/11/2017','DD/MM/YYYY'));
INSERT INTO tbl_usuarios (codigo_tipo_usuario,codigo_lugar_residencia,codigo_estado_usuario,nombre_usuario,alias_usuario,correo,contrasenia,url_foto_perfil,descripcion,fecha_registro) 
VALUES (2,4,1,'HIPERTEXTUAL','hipertextual12','hipertextual12@hipertextual12.com','asd.456','images/foto_perfiles/hipertextual.png','Tecnología, ciencia y cultura digital',TO_DATE('19/10/2015','DD/MM/YYYY'));
INSERT INTO tbl_usuarios (codigo_tipo_usuario,codigo_lugar_residencia,codigo_estado_usuario,nombre_usuario,alias_usuario,correo,contrasenia,url_foto_perfil,descripcion,fecha_registro) 
VALUES (2,4,1,'MOTORPASIÓN','motorpasion43','motorpasion@motorpasion.com','asd.456','images/foto_perfiles/uEfEeLyc.png','Coches y actualidad del mundo del Motor',TO_DATE('04/05/2013','DD/MM/YYYY'));
INSERT INTO tbl_usuarios (codigo_tipo_usuario,codigo_lugar_residencia,codigo_estado_usuario,nombre_usuario,alias_usuario,correo,contrasenia,url_foto_perfil,descripcion,fecha_registro) 
VALUES (2,4,1,'DIRECTO AL PALADAR','directopaladar','directoalpaladar@directoalpaladar.com','asd.456','images/foto_perfiles/directopaladar_1489507825_280.jpg','Las mejores recetas, postres, vinos, turismo gastronómico...',TO_DATE('20/11/2012','DD/MM/YYYY'));

--INSERT Registros Seguidores
INSERT INTO tbl_seguidores (codigo_usuario_seguidor,codigo_usuario_seguido) 
VALUES (1,3);
INSERT INTO tbl_seguidores (codigo_usuario_seguidor,codigo_usuario_seguido) 
VALUES (2,3);
INSERT INTO tbl_seguidores (codigo_usuario_seguidor,codigo_usuario_seguido) 
VALUES (4,1);
INSERT INTO tbl_seguidores (codigo_usuario_seguidor,codigo_usuario_seguido) 
VALUES (1,4);
INSERT INTO tbl_seguidores (codigo_usuario_seguidor,codigo_usuario_seguido) 
VALUES (5,1);
INSERT INTO tbl_seguidores (codigo_usuario_seguidor,codigo_usuario_seguido) 
VALUES (5,3);
INSERT INTO tbl_seguidores (codigo_usuario_seguidor,codigo_usuario_seguido) 
VALUES (1,5);

--INSERT Registros Intereses por Usuario
INSERT INTO tbl_intereses_x_usuario (codigo_usuario,codigo_categoria_interes) 
VALUES (1,1);
INSERT INTO tbl_intereses_x_usuario (codigo_usuario,codigo_categoria_interes) 
VALUES (1,3);
INSERT INTO tbl_intereses_x_usuario (codigo_usuario,codigo_categoria_interes) 
VALUES (1,4);
INSERT INTO tbl_intereses_x_usuario (codigo_usuario,codigo_categoria_interes) 
VALUES (1,10);
INSERT INTO tbl_intereses_x_usuario (codigo_usuario,codigo_categoria_interes) 
VALUES (4,3);
INSERT INTO tbl_intereses_x_usuario (codigo_usuario,codigo_categoria_interes) 
VALUES (4,11);
INSERT INTO tbl_intereses_x_usuario (codigo_usuario,codigo_categoria_interes) 
VALUES (4,12);
INSERT INTO tbl_intereses_x_usuario (codigo_usuario,codigo_categoria_interes) 
VALUES (4,4);
INSERT INTO tbl_intereses_x_usuario (codigo_usuario,codigo_categoria_interes) 
VALUES (3,1);
INSERT INTO tbl_intereses_x_usuario (codigo_usuario,codigo_categoria_interes) 
VALUES (3,7);
INSERT INTO tbl_intereses_x_usuario (codigo_usuario,codigo_categoria_interes) 
VALUES (3,10);
INSERT INTO tbl_intereses_x_usuario (codigo_usuario,codigo_categoria_interes) 
VALUES (3,3);
INSERT INTO tbl_intereses_x_usuario (codigo_usuario,codigo_categoria_interes) 
VALUES (3,5);
INSERT INTO tbl_intereses_x_usuario (codigo_usuario,codigo_categoria_interes) 
VALUES (3,6);
INSERT INTO tbl_intereses_x_usuario (codigo_usuario,codigo_categoria_interes) 
VALUES (5,10);
INSERT INTO tbl_intereses_x_usuario (codigo_usuario,codigo_categoria_interes) 
VALUES (5,2);
INSERT INTO tbl_intereses_x_usuario (codigo_usuario,codigo_categoria_interes) 
VALUES (5,3);
INSERT INTO tbl_intereses_x_usuario (codigo_usuario,codigo_categoria_interes) 
VALUES (5,5);
INSERT INTO tbl_intereses_x_usuario (codigo_usuario,codigo_categoria_interes) 
VALUES (5,13);
INSERT INTO tbl_intereses_x_usuario (codigo_usuario,codigo_categoria_interes) 
VALUES (5,7);

--INSERT Registros Revistas
INSERT INTO TBL_REVISTAS (CODIGO_TIPO_REVISTA, CODIGO_USUARIO, NOMBRE_REVISTA, DESCRIPCION, FECHA_DE_CREACION,URL_PORTADA)
VALUES (1, 1, 'Entretenimiento de Marco', 'Entretenimiento para todos!', TO_DATE('18/10/2017', 'DD/MM/YYYY'),'http://mouse.latercera.com/wp-content/uploads/2017/10/fortnite.jpg');
INSERT INTO TBL_REVISTAS (CODIGO_TIPO_REVISTA, CODIGO_USUARIO, NOMBRE_REVISTA, DESCRIPCION, FECHA_DE_CREACION,URL_PORTADA)
VALUES (1, 3, 'África Salvaje', '¡Descubre África de la manera mas autentica!', TO_DATE('6/5/2015', 'DD/MM/YYYY'),'https://altonivel-impresionesaerea.netdna-ssl.com/assets/images/gourmet/entretenimiento.jpg');
INSERT INTO TBL_REVISTAS (CODIGO_TIPO_REVISTA, CODIGO_USUARIO, NOMBRE_REVISTA, DESCRIPCION, FECHA_DE_CREACION,URL_PORTADA)
VALUES (1, 4, 'Noticias de España', 'Mantente al día de lo que sucede en España.', TO_DATE('28/4/2016', 'DD/MM/YYYY'),'http://mouse.latercera.com/wp-content/uploads/2017/10/fortnite.jpg');
INSERT INTO TBL_REVISTAS (CODIGO_TIPO_REVISTA, CODIGO_USUARIO, NOMBRE_REVISTA, DESCRIPCION, FECHA_DE_CREACION,URL_PORTADA)
VALUES (1, 5, 'Economía en los EAU', 'Descubre como marcha la economía en los Emiratos Árabes Unidos.', TO_DATE('17/01/2017', 'DD/MM/YYYY'),'http://static.t13.cl/images/sizes/1200x675/1498132806-96591486gettyimages-503387922.jpg');
INSERT INTO TBL_REVISTAS (CODIGO_TIPO_REVISTA, CODIGO_USUARIO, NOMBRE_REVISTA, DESCRIPCION, FECHA_DE_CREACION,URL_PORTADA)
VALUES (1, 10, 'DIRECTO AL PALADAR', 'Las mejores recetas, postres, vinos, turismo gastronómico...', TO_DATE('18/10/2017', 'DD/MM/YYYY'),'images/revistas/1366_2000.jpg');
INSERT INTO TBL_REVISTAS (CODIGO_TIPO_REVISTA, CODIGO_USUARIO, NOMBRE_REVISTA, DESCRIPCION, FECHA_DE_CREACION,URL_PORTADA)
VALUES (1, 7, 'XATAKA', 'Apasionados por la tecnología.', TO_DATE('17/01/2017', 'DD/MM/YYYY'),'images/revistas/1366_2000 (1).jpg');
INSERT INTO TBL_REVISTAS (CODIGO_TIPO_REVISTA, CODIGO_USUARIO, NOMBRE_REVISTA, DESCRIPCION, FECHA_DE_CREACION,URL_PORTADA)
VALUES (1, 8, 'HIPERTEXTUAL', 'Tecnología, ciencia y cultura digital', TO_DATE('17/01/2017', 'DD/MM/YYYY'),'images/revistas/YEvW6EJ.jpg');
INSERT INTO TBL_REVISTAS (CODIGO_TIPO_REVISTA, CODIGO_USUARIO, NOMBRE_REVISTA, DESCRIPCION, FECHA_DE_CREACION,URL_PORTADA)
VALUES (1, 9, 'MOTORPASIÓN', 'Coches y actualidad del mundo del Motor', TO_DATE('01/11/2017', 'DD/MM/YYYY'),'https://i.blogs.es/97adc8/tesla-model-x-motorpasion-prueba-31/450_1000.jpg');
INSERT INTO TBL_REVISTAS (CODIGO_TIPO_REVISTA, CODIGO_USUARIO, NOMBRE_REVISTA, DESCRIPCION, FECHA_DE_CREACION,URL_PORTADA)
VALUES (1, 6, 'REVISTA ¡HOLA!', 'Las novedades sobre las estrellas de cine y música, tendencias de moda, belleza, recetas de cocina y las Casas Reales en el portal femenino líder en Internet. ', TO_DATE('17/10/2017', 'DD/MM/YYYY'),'https://www.himgs.com/imagenes/hola/comunes/svg/holacom-pos-16.svg');

--INSERT Registros Revistas Seguidas
INSERT INTO TBL_REVISTAS_SEGUIDAS (CODIGO_SEGUIDOR, CODIGO_REVISTA)
VALUES (1,2);
INSERT INTO TBL_REVISTAS_SEGUIDAS (CODIGO_SEGUIDOR, CODIGO_REVISTA)
VALUES (4,2);
INSERT INTO TBL_REVISTAS_SEGUIDAS (CODIGO_SEGUIDOR, CODIGO_REVISTA)
VALUES (5,2);
INSERT INTO TBL_REVISTAS_SEGUIDAS (CODIGO_SEGUIDOR, CODIGO_REVISTA)
VALUES (4,1);
INSERT INTO TBL_REVISTAS_SEGUIDAS (CODIGO_SEGUIDOR, CODIGO_REVISTA)
VALUES (1,4);
INSERT INTO TBL_REVISTAS_SEGUIDAS (CODIGO_SEGUIDOR, CODIGO_REVISTA)
VALUES (4,4);
INSERT INTO TBL_REVISTAS_SEGUIDAS (CODIGO_SEGUIDOR, CODIGO_REVISTA)
VALUES (1,3);
INSERT INTO TBL_REVISTAS_SEGUIDAS (CODIGO_SEGUIDOR, CODIGO_REVISTA)
VALUES (5,3);
INSERT INTO TBL_REVISTAS_SEGUIDAS (CODIGO_SEGUIDOR, CODIGO_REVISTA)
VALUES (1,3);
INSERT INTO TBL_REVISTAS_SEGUIDAS (CODIGO_SEGUIDOR, CODIGO_REVISTA)
VALUES (1,6);
INSERT INTO TBL_REVISTAS_SEGUIDAS (CODIGO_SEGUIDOR, CODIGO_REVISTA)
VALUES (1,7);
INSERT INTO TBL_REVISTAS_SEGUIDAS (CODIGO_SEGUIDOR, CODIGO_REVISTA)
VALUES (1,8);
INSERT INTO TBL_REVISTAS_SEGUIDAS (CODIGO_SEGUIDOR, CODIGO_REVISTA)
VALUES (1,9);
INSERT INTO TBL_REVISTAS_SEGUIDAS (CODIGO_SEGUIDOR, CODIGO_REVISTA)
VALUES (1,5);

--INSERT Registros Noticias
INSERT INTO TBL_NOTICIAS (CODIGO_USUARIO, CODIGO_REVISTA, CODIGO_CATEGORIA, AUTOR_NOTICIA, TITULO_NOTICIA, DESCRIPCION_NOTICIA, CONTENIDO_NOTICIA, FECHA_PUBLICACION, URL_PORTADA_NOTI)
VALUES(1, 1, 7, 'Enrique García', 'Fortnite Battle Royale supera los 10 millones de jugadores', 'El título de Epic Games atrae a los seguidores del género.', 'El modo Battle Royale de Fortnite, que se puede descargar gratis en PC, PS4 y Xbox One, ha conseguido atrapar a más de diez millones de jugadores desde su lanzamiento realizado hace un par de semanas. En Fortnite Battle Royale, los jugadores se embarcan en una lucha por la supervivencia en partidas de 100 usuarios dentro de un mismo servidor. Los participantes deben recolectar objetos y armas, fortificar su posición y avanzar cuando sea necesario para sobrevivir.', TO_DATE('19/10/2017','DD/MM/YYYY'), 'http://mouse.latercera.com/wp-content/uploads/2017/10/fortnite.jpg');
INSERT INTO TBL_NOTICIAS (CODIGO_USUARIO, CODIGO_REVISTA, CODIGO_CATEGORIA, AUTOR_NOTICIA, TITULO_NOTICIA, DESCRIPCION_NOTICIA, CONTENIDO_NOTICIA, FECHA_PUBLICACION, URL_PORTADA_NOTI)
VALUES(3, 2, 6, 'Nat Geo', 'Por qué la muerte de miles de antílopes es una buena noticia en África', 'Cada año, 1,2 millones de ñus migran de Tanzania hacia Kenia en busca de nuevos pastizales. Miles mueren ahogados cruzando el río Mara y, al hacerlo, le dan una nueva vida a todos los demás animales que habitan este ecosistema.', 'Cada año en el mes de septiembre, más de un millón antílopes africanos migran -acompañados de cebras, gacelas y otros mamíferos- en el este de África en busca de nuevos pastizales. Este viaje de Tanzania hacia Kenia es la migración animal más grande sobre la Tierra, pero también una de las más peligrosas. En la zona norte de su recorrido, los antílopes deben cruzar repetidas veces el Mara, un río poco profundo de unos 40 metros de ancho. Y, al hacerlo, miles mueren ahogados o en las fauces de los cocodrilos que habitan el lugar. Aunque a primera vista esto pueda parecer una tragedia de la naturaleza, es todo lo contrario: los cadáveres de estos animales aportan numerosos nutrientes que le dan una nueva vida al ecosistema del río, según asegura un estudio publicado recientemente en la revista PNSAS.', TO_DATE('22/6/2017','DD/MM/YYYY'), 'http://static.t13.cl/images/sizes/1200x675/1498132806-96591486gettyimages-503387922.jpg');
INSERT INTO TBL_NOTICIAS (CODIGO_USUARIO, CODIGO_REVISTA, CODIGO_CATEGORIA, AUTOR_NOTICIA, TITULO_NOTICIA, DESCRIPCION_NOTICIA, CONTENIDO_NOTICIA, FECHA_PUBLICACION, URL_PORTADA_NOTI)
VALUES(4, 3, 4, 'Emol', '"Fuerza Barcelona": Celebridades muestran su apoyo tras atentado en la ciudad española','Lionel Messi, Alejandro Sanz, Ricky Martin, Rafael Nadal y Ellen Degeneres, entre otros, expresaron sus condolencias a las víctimas a través de redes sociales.','Celebridades reconocidas a nivel mundial han mostrado sus condolencias a las víctimas del atentado terrorista ocurrido el jueves en Barcelona, cuando una furgoneta atropelló a decenas de personas. El ataque, que fue reivindicado por el ISIS, dejó 14 fallecidos y un centenar de heridos. Ciudadanos de alrededor de 34 países resultaron muertos o lesionados tras el atentado. Horas después del ataque, cinco sospechosos murieron en la ciudad de Tarragona en un operativo para prevenir otra agresión. Allí se registraron siete personas afectadas. Tras esto, catantes como Alejandro Sanz, Ricky Martin, Miguel Bosé, actores como Antonio Banderas y Penelope Cruz, deportistas como Rafael Nadal, Lionel Messi o Fernando Alonso, además de presentadores de televisión como la estadounidense Ellen Degeneres han brindado su apoyo a través de redes sociales bajo las consignas "Fuerza Barcelona" o "Barcelona Contigo".',TO_DATE('20/8/2017','DD/MM/YYYY'),'http://static.emol.cl/emol50/Fotos/2017/08/20/file_20170820145336.jpg');
INSERT INTO TBL_NOTICIAS (CODIGO_USUARIO, CODIGO_REVISTA, CODIGO_CATEGORIA, AUTOR_NOTICIA, TITULO_NOTICIA, DESCRIPCION_NOTICIA, CONTENIDO_NOTICIA, FECHA_PUBLICACION, URL_PORTADA_NOTI)
VALUES(5, 4, 10, 'Anonimo', 'Emiratos Árabes Unidos: Economía', 'Emiratos Árabes Unidos es la economía número 31 por volumen de PIB.', 'Emiratos Árabes Unidos tiene las séptimas mayores reservas de gas natural del mundo y es uno de los países exportadores de petróleo más activos.', TO_DATE('20/10/2017','DD/MM/YYYY'), 'http://4.bp.blogspot.com/-psKEykiPsKw/VYaakrHqd-I/AAAAAAAAAss/Uhf_ics4meA/s1600/dubai.jpeg'); 
INSERT INTO TBL_NOTICIAS (CODIGO_USUARIO, CODIGO_REVISTA, CODIGO_CATEGORIA, AUTOR_NOTICIA, TITULO_NOTICIA, DESCRIPCION_NOTICIA, CONTENIDO_NOTICIA, FECHA_PUBLICACION, URL_PORTADA_NOTI)
VALUES(1, 1, 4, 'europapress', 'Indrustria del entretenimiento en España', 'La industria del entretenimiento y los medios en España crecerá un 2,9% entre 2016 y 2021.', 'Según un estudio de PwC cuando alcanzará los 27.629 millones de euros, según concluye el informe Entertainment and Media Outlook 2017-2021 en España, que cada año elabora PwC, y donde se analizan retos y oportunidades del sector a través de segmentos como televisión y vídeo, publicidad en televisión, publicidad en Internet, videojuegos, radio, música, cine, libros, revistas, prensa y publicidad exterior.', TO_DATE('19/10/2017','DD/MM/YYYY'),'https://altonivel-impresionesaerea.netdna-ssl.com/assets/images/gourmet/entretenimiento.jpg');
INSERT INTO TBL_NOTICIAS (CODIGO_USUARIO, CODIGO_REVISTA, CODIGO_CATEGORIA, TITULO_NOTICIA, DESCRIPCION_NOTICIA, CONTENIDO_NOTICIA, FECHA_PUBLICACION, URL_PORTADA_NOTI)
VALUES(10, 5, 12,  'Siete recetas saladas con membrillo para el picoteo del finde', 'El membrillo es un fruto otoñal originario de la antigua Persia que no consumimos crudo debido al sabor amargo de su carne. Sin embargo, cocido y endulzado es un manjar que generalmente se consume como en meriendas y desayunos, como...', 'El membrillo es un fruto otoñal originario de la antigua Persia que no consumimos crudo debido al sabor amargo de su carne. Sin embargo, cocido y endulzado es un manjar que generalmente se consume como en meriendas y desayunos, como postre o ingrediente de otros dulces, como esta tarta de queso con dulce de membrillo y pomelo. No obstante, el membrillo también se puede utilizar para recetas saladas con resultados sorprendentes. La combinación salado y dulce funciona de maravilla con este fruto. Hoy os vamos a dar siete recetas saladas con membrillo para el picoteo del finde para que lo comprobéis, si es que no lo habéis hecho ya antes.', TO_DATE('19/10/2017','DD/MM/YYYY'),'https://i.blogs.es/176c8f/1366_2000-2-/1366_2000.jpg');
INSERT INTO TBL_NOTICIAS (CODIGO_USUARIO, CODIGO_REVISTA, CODIGO_CATEGORIA, AUTOR_NOTICIA, TITULO_NOTICIA, DESCRIPCION_NOTICIA, CONTENIDO_NOTICIA, FECHA_PUBLICACION, URL_PORTADA_NOTI)
VALUES(7, 6, 1, 'Xataka', 'World of Warcraft Classic, la anhelada vuelta a los orígenes se hace realidad', 'Blizzard Entertainment ha escuchado las plegarias de millones de fans quienes suplicaban por un servidor basado en la versión original de World of Warcraft, sí, de aquel que se lanzó hace ya 13 años. La respuesta a esto será World of Warcraft Classic, el cual traerá de regreso la experiencia de un servidor "vainilla".', 'Blizzard Entertainment ha escuchado las plegarias de millones de fans quienes suplicaban por un servidor basado en la versión original de World of Warcraft, sí, de aquel que se lanzó hace ya 13 años. La respuesta a esto será World of Warcraft Classic, el cual traerá de regreso la experiencia de un servidor "vainilla". Durante la conferencia de inicio de la BlizzCon 2017, la compañía confirmó que tendremos nuevamente la experiencia clásica de WoW, esto después de años que llevó a los fans a crear sus propios servidores, los cuales se han ido cerrando debido a derechos de autor.', TO_DATE('19/10/2017','DD/MM/YYYY'),'https://i.blogs.es/b7c1ff/world-of-warcraft-classic/1366_2000.jpg');
INSERT INTO TBL_NOTICIAS (CODIGO_USUARIO, CODIGO_REVISTA, CODIGO_CATEGORIA, AUTOR_NOTICIA, TITULO_NOTICIA, DESCRIPCION_NOTICIA, CONTENIDO_NOTICIA, FECHA_PUBLICACION, URL_PORTADA_NOTI)
VALUES(8, 7, 4, 'Mónica Redondo', 'El final de House of Cards podría desarrollarse sin Kevin Spacey', 'La suspensión temporal del rodaje podría aprovecharse para reescribir el final de la serie sin el personaje de Frank Underwood.', 'House of Cards podría estar a punto de dar un cambio radical. Netflix y la productora Media Right Capital (MRC) suspendieron el rodaje de la sexta y última temporada de la serie después de que Kevin Spacey fuera acusado de acoso sexual. En ese momento no se especificó si se retomaría la producción de House of Cards aunque, según afirmaron fuentes cercanas al servicio de streaming, los últimos capítulos podrían emitirse sin el personaje de Frank Underwood.Según las fuentes consultadas por The Hollywood Reporter, la sexta temporada ya estaba casi escrita antes de que Anthony Rapp denunciara al protagonista de la serie. Después de la acusación, se unieron otras víctimas como el director y productor Tony Montana, además de todo el equipo de House of Cards, quienes afirmaron que los constantes actos de acoso sexual por parte del actor habían convertido el ambiente de trabajo en algo "tóxico". La suspensión del rodaje, supuestamente temporal, tendría como objetivo tener más tiempo para reescribir la historia, en la que no se incluirían a Kevin Spacey.Esta es una de las posibilidades que se plantean para afrontar el problema de acoso contra el protagonista y también productor ejecutivo de la serie, la cual podría ser cancelada definitivamente, aunque esto se perfila como una opción menos probable.La salida de Kevin Spacey de House of Cards podría significar la muerte de su personaje, Frank Underwood. De hecho, el libro de Michael Dobbs en el que está basado la serie finaliza con la muerte del protagonista. Por otro lado, la actriz Robin Wright, que da vida a Claire Underwood, ha tenido un papel cada vez más relevante dentro de la serie, y este nuevo giro podría convertirla en la pieza central.Netflix y MRC anunciaron que el final del rodaje tenía como objetivo "darnos tiempo para revisar la situación actual y abordar cualquier preocupación de nuestro reparto y equipo" además de evaluar el camino a seguir en lo que respecto a la producción.', TO_DATE('19/10/2017','DD/MM/YYYY'),'https://i2.wp.com/hipertextual.com/files/2017/11/frankunderwood.jpg?resize=670%2C413&ssl=1');
INSERT INTO TBL_NOTICIAS (CODIGO_USUARIO, CODIGO_REVISTA, CODIGO_CATEGORIA, AUTOR_NOTICIA, TITULO_NOTICIA, DESCRIPCION_NOTICIA, CONTENIDO_NOTICIA, FECHA_PUBLICACION, URL_PORTADA_NOTI)
VALUES(9, 8, 3, 'MARÍA VIDAL','La retirada de la Fórmula 1 de Felipe Massa ya es oficial (y ahora parece que es en serio)', 'Cuando uno anuncia por todo lo alto que cuelga los guantes en la Fórmula 1 suele ser algo definitivo. Sin embargo, Felipe Massa, tras anunciar el año pasado sus intenciones de abandonar...', 'Cuando uno anuncia por todo lo alto que cuelga los guantes en la Fórmula 1 suele ser algo definitivo. Sin embargo, Felipe Massa, tras anunciar el año pasado sus intenciones de abandonar la categoría y de recibir un gran homenaje en su tierra natal, volvió.Williams, tras perder a Valtteri Bottas, necesitaba de los servicios de un piloto experimentado para acompañar a Lance Stroll en sus primeros pasos en la categoría y él, aceptó. No tardó mucho en confesar que la retirada había sido forzosa al encontrarse sin un equipo para 2017. Y por sus palabras a lo largo de este año, estaba dispuesto a no volver a hacerlo. Pero una vez más, no ha habido otra opción y Massa no estará en la parrilla de salida del GP de Australia en 2018.', TO_DATE('19/10/2017','DD/MM/YYYY'),'https://i.blogs.es/7776e0/dnybbzzueaevv13/1366_2000.jpg');
INSERT INTO TBL_NOTICIAS (CODIGO_USUARIO, CODIGO_REVISTA, CODIGO_CATEGORIA, AUTOR_NOTICIA, TITULO_NOTICIA, DESCRIPCION_NOTICIA, CONTENIDO_NOTICIA, FECHA_PUBLICACION, URL_PORTADA_NOTI)
VALUES(6, 9, 4, 'HOLA.COM', 'Antonio Banderas agradece las muestras de cariño y apoyo tras la muerte de su madre', 'El actor malagueño ha utilizado una vez sus redes sociales para mandar a todos los que sienten la pérdida de su madre un abrazo', 'El actor Antonio Banderas vive uno de los momentos más tristes de su vida tras sufrir a primera hora de la mañana la pérdida de su madre, Ana Bandera Gallego. Una noticia que él mismo quiso revelar a los medios a través de un comunicado y a todos sus seguidores y amigos a través de las redes sociales. Ante las innumerables muestras de apoyo y cariño recibidas, el malagueño ha querido responder a todas elllas con un emotivo mensaje. "Muchas gracias a todos por tantas muestras de apoyo y cariño. Me quedo los abrazos y os envío uno de parte de toda la familia", escribía en su cuenta de Twitter. El intérprete asistía al mediodía al tanatorio de la ciudad malagueña de la mano de su pareja, Nicole Kimpel, y de su hermano Javier. Visiblemente afectados pero serenos, se enfrentaban a una jornada dura y larga en la que han recibido el apoyo y el cariño de multitud de familiares y amigos. Banderas, a pesar de que en la actualidad está afincado en Londres, se encontraba en su ciudad natal grabando una serie documental para National Georgraphic y Fox 21 sobre la vida del pintor Pablo Picasso. - Antonio Banderas de la mano de Nicole Kimpel y junto a su hermano Javier llegan al tanatorio Muy unida a sus hijos, Doña Aña- como se la conocía popularmente- sufría Alzheimer. Fue el propio actor quien lo revelaba en una entrevista con Bertín Osborne, en la que definió a su madre como "una persona con magia". ', TO_DATE('19/10/2017','DD/MM/YYYY'),'https://ac.hola.com/imagenes/actualidad/20171104101533/antonio-banderas-agradece-muestras-apoyo-carino/0-504-4/banderas-t.jpg');

--INSERT Registros Flips
INSERT INTO TBL_FLIPS (CODIGO_NOTICIA, CODIGO_REVISTA, CODIGO_USUARIO_FLIP, FECHA)
VALUES (5, 3, 4, TO_DATE('20/10/2017','DD/MM/YYYY'));

--INSERT Registros Reacciones por Noticia
INSERT INTO TBL_REACCIONES_X_NOTICIAS (CODIGO_NOTICIA, CODIGO_FLIP, CODIGO_USUARIO, CODIGO_REACCION)
VALUES (1,null,5,1);
INSERT INTO TBL_REACCIONES_X_NOTICIAS (CODIGO_NOTICIA, CODIGO_FLIP, CODIGO_USUARIO, CODIGO_REACCION)
VALUES (2,null,4,1);
INSERT INTO TBL_REACCIONES_X_NOTICIAS (CODIGO_NOTICIA, CODIGO_FLIP, CODIGO_USUARIO, CODIGO_REACCION)
VALUES (2,null,5,1);
INSERT INTO TBL_REACCIONES_X_NOTICIAS (CODIGO_NOTICIA, CODIGO_FLIP, CODIGO_USUARIO, CODIGO_REACCION)
VALUES (3,null,1,1);
INSERT INTO TBL_REACCIONES_X_NOTICIAS (CODIGO_NOTICIA, CODIGO_FLIP, CODIGO_USUARIO, CODIGO_REACCION)
VALUES (3,null,3,1);
INSERT INTO TBL_REACCIONES_X_NOTICIAS (CODIGO_NOTICIA, CODIGO_FLIP, CODIGO_USUARIO, CODIGO_REACCION)
VALUES (3,null,4,1);
INSERT INTO TBL_REACCIONES_X_NOTICIAS (CODIGO_NOTICIA, CODIGO_FLIP, CODIGO_USUARIO, CODIGO_REACCION)
VALUES (3,null,5,1);
INSERT INTO TBL_REACCIONES_X_NOTICIAS (CODIGO_NOTICIA, CODIGO_FLIP, CODIGO_USUARIO, CODIGO_REACCION)
VALUES (4,null,3,1);
INSERT INTO TBL_REACCIONES_X_NOTICIAS (CODIGO_NOTICIA, CODIGO_FLIP, CODIGO_USUARIO, CODIGO_REACCION)
VALUES (4,null,4,1);
INSERT INTO TBL_REACCIONES_X_NOTICIAS (CODIGO_NOTICIA, CODIGO_FLIP, CODIGO_USUARIO, CODIGO_REACCION)
VALUES (5,null,4,1);
INSERT INTO TBL_REACCIONES_X_NOTICIAS (CODIGO_NOTICIA, CODIGO_FLIP, CODIGO_USUARIO, CODIGO_REACCION)
VALUES (5,null,5,1);

--INSERT Registros Comentarios
INSERT INTO TBL_COMENTARIOS (CODIGO_USUARIO, CODIGO_NOTICIA, CODIGO_FLIP, CONTENIDO, FECHA)
VALUES (5,1,null, 'Fortnite se ha vuelto muy popular, es todo un exito.', to_date('20/10/2017','DD/MM/YYYY'));
INSERT INTO TBL_COMENTARIOS (CODIGO_USUARIO, CODIGO_NOTICIA, CODIGO_FLIP, CONTENIDO, FECHA)
VALUES (4,2,null, 'Increible, la naturaleza funciona de una manera genial.', to_date('20/10/2017','DD/MM/YYYY'));
INSERT INTO TBL_COMENTARIOS (CODIGO_USUARIO, CODIGO_NOTICIA, CODIGO_FLIP, CONTENIDO, FECHA)
VALUES (1,3,null, '¡Fuerza Barcelona!', to_date('21/8/2017','DD/MM/YYYY'));
INSERT INTO TBL_COMENTARIOS (CODIGO_USUARIO, CODIGO_NOTICIA, CODIGO_FLIP, CONTENIDO, FECHA)
VALUES (4,5,null, 'Excelente noticia para el país.', to_date('20/10/2017','DD/MM/YYYY'));
INSERT INTO TBL_COMENTARIOS (CODIGO_USUARIO, CODIGO_NOTICIA, CODIGO_FLIP, CONTENIDO, FECHA)
VALUES (1,null,6, '¡Gracias por compartir la noticia!', to_date('20/10/2017','DD/MM/YYYY'));

--INSERT Registros Reacciones por Comentario
INSERT INTO TBL_REACCIONES_X_COMENTARIOS(CODIGO_COMENTARIO, CODIGO_REACCION, CODIGO_USUARIO)
VALUES (1, 1, 1);
INSERT INTO TBL_REACCIONES_X_COMENTARIOS(CODIGO_COMENTARIO, CODIGO_REACCION, CODIGO_USUARIO)
VALUES (2, 1, 5);
INSERT INTO TBL_REACCIONES_X_COMENTARIOS(CODIGO_COMENTARIO, CODIGO_REACCION, CODIGO_USUARIO)
VALUES (2, 1, 1);
INSERT INTO TBL_REACCIONES_X_COMENTARIOS(CODIGO_COMENTARIO, CODIGO_REACCION, CODIGO_USUARIO)
VALUES (3, 1, 4);
INSERT INTO TBL_REACCIONES_X_COMENTARIOS(CODIGO_COMENTARIO, CODIGO_REACCION, CODIGO_USUARIO)
VALUES (4, 1, 1);
INSERT INTO TBL_REACCIONES_X_COMENTARIOS(CODIGO_COMENTARIO, CODIGO_REACCION, CODIGO_USUARIO)
VALUES (5, 1, 4);

--INSERT Registros Notificaciones
INSERT INTO TBL_NOTIFICACIONES (CODIGO_TIPO_NOTIFICACION, CODGIO_ESTADO_NOTIFICACION, CODIGO_USUARIO_RECEPTOR, CODIGO_USUARIO_EMISOR, CODIGO_REVISTA, CODIGO_NOTICIA, CODIGO_REACCION, HORA_NOTIFICACION)
VALUES(5, 2, 1, 4, 3, 5, null, TO_DATE('20/10/17', 'DD/MM/YYYY'));
INSERT INTO TBL_NOTIFICACIONES (CODIGO_TIPO_NOTIFICACION, CODGIO_ESTADO_NOTIFICACION, CODIGO_USUARIO_RECEPTOR, CODIGO_USUARIO_EMISOR, CODIGO_REVISTA, CODIGO_NOTICIA, CODIGO_REACCION, HORA_NOTIFICACION)
VALUES(2, 2, 1, 5, 1, 1, NULL, TO_DATE('20/10/2017', 'DD/MM/YYYY'));
INSERT INTO TBL_NOTIFICACIONES (CODIGO_TIPO_NOTIFICACION, CODGIO_ESTADO_NOTIFICACION, CODIGO_USUARIO_RECEPTOR, CODIGO_USUARIO_EMISOR, CODIGO_REVISTA, CODIGO_NOTICIA, CODIGO_REACCION, HORA_NOTIFICACION)
VALUES(1, 2, 1, 5, NULL, NULL, NULL, TO_DATE('01/10/2017', 'DD/MM/YYYY'));
INSERT INTO TBL_NOTIFICACIONES (CODIGO_TIPO_NOTIFICACION, CODGIO_ESTADO_NOTIFICACION, CODIGO_USUARIO_RECEPTOR, CODIGO_USUARIO_EMISOR, CODIGO_REVISTA, CODIGO_NOTICIA, CODIGO_REACCION, HORA_NOTIFICACION)
VALUES(3, 2, 1, 5, 1, 1, 1, TO_DATE('20/10/2017', 'DD/MM/YYYY'));
INSERT INTO TBL_NOTIFICACIONES (CODIGO_TIPO_NOTIFICACION, CODGIO_ESTADO_NOTIFICACION, CODIGO_USUARIO_RECEPTOR, CODIGO_USUARIO_EMISOR, CODIGO_REVISTA, CODIGO_NOTICIA, CODIGO_REACCION, HORA_NOTIFICACION)
VALUES(4, 2, 1, 4, 3, 3, 1, TO_DATE('20/10/2017', 'DD/MM/YYYY'));

--INSERT Registros Colaboradores
INSERT INTO tbl_colaboradores (codigo_colaborador,codigo_revista) 
VALUES (1,2);
INSERT INTO tbl_colaboradores (codigo_colaborador,codigo_revista) 
VALUES (1,4);
INSERT INTO tbl_colaboradores (codigo_colaborador,codigo_revista) 
VALUES (2,2);
INSERT INTO tbl_colaboradores (codigo_colaborador,codigo_revista) 
VALUES (3,3);
INSERT INTO tbl_colaboradores (codigo_colaborador,codigo_revista) 
VALUES (4,2);
INSERT INTO tbl_colaboradores (codigo_colaborador,codigo_revista) 
VALUES (5,3);
INSERT INTO tbl_colaboradores (codigo_colaborador,codigo_revista) 
VALUES (5,1);

--Insert Resgistros Configuraciones
INSERT INTO tbl_configuraciones (descripcion) 
VALUES ('Recomendaciones de Contenido');
INSERT INTO tbl_configuraciones (descripcion) 
VALUES ('Acerca de tus revistas');
INSERT INTO tbl_configuraciones (descripcion) 
VALUES ('Acerca de tus amigos');
INSERT INTO tbl_configuraciones (descripcion) 
VALUES ('Actualizaciones de producto y educación');
INSERT INTO tbl_configuraciones (descripcion) 
VALUES ('Actualizaciones de la comunidad');
INSERT INTO tbl_configuraciones (descripcion) 
VALUES ('Selecciones Diarias (Diez para Hoy, Selecciones de Flipboard, etc.)');

--Insert Resgistros Configuraciones activas por Usuario
INSERT INTO tbl_config_activa_x_usuario (codigo_configuracion,codigo_usuario) 
VALUES (1,1);

--INSERT Registros Estado Solicitud
INSERT INTO tbl_estado_solicitud (estado_solicitud) 
VALUES ('Aprobada');
INSERT INTO tbl_estado_solicitud (estado_solicitud) 
VALUES ('Denegada');
INSERT INTO tbl_estado_solicitud (estado_solicitud) 
VALUES ('Solicitud en Proceso');

--Insert Resgistros Solicitudes de Verificación
INSERT INTO tbl_solicitudes_de_verific (codigo_usuario,codigo_estado_solicitud,fecha_solicitud) 
VALUES (2,3,TO_DATE('19/10/2017','DD/MM/YYYY'));

--Insert Resgistros Historial de accesos
INSERT INTO tbl_historial_accesos (codigo_usuario,fecha_acceso) 
VALUES (1,TO_DATE('19/10/2017','DD/MM/YYYY'));

COMMIT;