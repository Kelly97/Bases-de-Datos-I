--INSERT Registros Tipo Notificacion
INSERT INTO TBL_TIPO_NOTIFICACION (TIPO_NOTIFICACION)
VALUES ('Seguimiento');
INSERT INTO TBL_TIPO_NOTIFICACION (TIPO_NOTIFICACION)
VALUES ('Comentario');
INSERT INTO TBL_TIPO_NOTIFICACION (TIPO_NOTIFICACION)
VALUES ('Reacción');
INSERT INTO TBL_TIPO_NOTIFICACION (TIPO_NOTIFICACION)
VALUES ('Añadió historia');

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
INSERT INTO tbl_lugares (codigo_lugar_padre,codigo_tipo_lugar,nombre_lugar,latitud,longitud) 
VALUES (1,1,'Honduras','14°41′00″N','87°25′00″W');
INSERT INTO tbl_lugares (codigo_lugar_padre,codigo_tipo_lugar,nombre_lugar,latitud,longitud) 
VALUES (2,1,'España','43°10′49″N','06°59′08″W');
INSERT INTO tbl_lugares (codigo_lugar_padre,codigo_tipo_lugar,nombre_lugar,latitud,longitud) 
VALUES (3,1,'Emiratos Árabes Unidos','24°28′00″N','54°22′00″E');

--INSERT Registros Usuarios
INSERT INTO tbl_usuarios (codigo_tipo_usuario,codigo_lugar_residencia,codigo_estado_usuario,nombre_usuario,alias_usuario,correo,contrasenia,url_foto_perfil,descripcion) 
VALUES (1,4,2,'Marco Polo','Marc2345','marco_99@gmail.com','asd.456','images/foto_perfiles/3d-Wallpaper-Hd-3.jpg','Entretenimiento para todos.');
INSERT INTO tbl_usuarios (codigo_tipo_usuario,codigo_lugar_residencia,codigo_estado_usuario,nombre_usuario,alias_usuario,correo,contrasenia) 
VALUES (3,4,1,'Administrador','Administrador','web_admin@flipboard.com','asd.456');
INSERT INTO tbl_usuarios (codigo_tipo_usuario,codigo_lugar_residencia,codigo_estado_usuario,nombre_usuario,alias_usuario,correo,contrasenia,url_foto_perfil,descripcion) 
VALUES (2,4,1,'National Geographic','NatGeo','NationalGeographic@natgeo.com','asd.456','images/foto_perfiles/National-Geographic-logo.png','Flipboard oficial de la revista National Geographic España. Actualidad, reportajes, fotos espectaculares, exploración, vídeos...');
INSERT INTO tbl_usuarios (codigo_tipo_usuario,codigo_lugar_residencia,codigo_estado_usuario,nombre_usuario,alias_usuario,correo,contrasenia,url_foto_perfil) 
VALUES (1,5,2,'Rosa Betancourt','Rosy4521','rosybet@gmail.com','asd.456','images/foto_perfiles/AnimalesVectoriales_Wahyu_Romdhoni.jpg');
INSERT INTO tbl_usuarios (codigo_tipo_usuario,codigo_lugar_residencia,codigo_estado_usuario,nombre_usuario,alias_usuario,correo,contrasenia,url_foto_perfil) 
VALUES (1,6,2,'Abdel Hadi','abdelhadi_43','abdel_43@yahoo.com','asd.456','images/foto_perfiles/Mokona.Modoki.full.35354 (1).jpg');

--INSERT Registros Seguidores
INSERT INTO tlb_seguidores (codigo_usuario_seguidor,codigo_usuario_seguido) 
VALUES (1,3);
INSERT INTO tlb_seguidores (codigo_usuario_seguidor,codigo_usuario_seguido) 
VALUES (2,3);
INSERT INTO tlb_seguidores (codigo_usuario_seguidor,codigo_usuario_seguido) 
VALUES (4,1);
INSERT INTO tlb_seguidores (codigo_usuario_seguidor,codigo_usuario_seguido) 
VALUES (1,4);
INSERT INTO tlb_seguidores (codigo_usuario_seguidor,codigo_usuario_seguido) 
VALUES (5,1);
INSERT INTO tlb_seguidores (codigo_usuario_seguidor,codigo_usuario_seguido) 
VALUES (5,3);
INSERT INTO tlb_seguidores (codigo_usuario_seguidor,codigo_usuario_seguido) 
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

--INSERT Registros Notificaciones
--INSERT Registros Revistas
--INSERT Registros Revistas Seguidas
--INSERT Registros Noticias
--INSERT Registros Reacciones por Noticia
--INSERT Registros Colaboradores
--INSERT Registros Comentarios
--INSERT Registros Reacciones por Comentario
--INSERT Registros Flips por Usuario