                                --PROCEDIMIENTOS ALMACENADOS

--Procedimiento para flipear un noticia.
create or replace PROCEDURE P_FLIPEAR
  (
    P_CODIGO_NOTICIA IN INTEGER,
    P_CODIGO_USUARIO IN INTEGER,
    P_CODIGO_REVISTA IN INTEGER,
    P_CODIGO_RESP OUT INTEGER,
    P_MENSAJE_RESP OUT VARCHAR2
  )
AS
  V_CANT_CONINCIDEN INTEGER;
  V_NOMBRE_REVISTA VARCHAR2(300);
BEGIN
  SELECT COUNT(A.CODIGO_FLIP)
  INTO  V_CANT_CONINCIDEN
  FROM TBL_FLIPS A
  WHERE A.CODIGO_NOTICIA = P_CODIGO_NOTICIA
  AND A.CODIGO_USUARIO_FLIP = P_CODIGO_USUARIO
  AND A.CODIGO_REVISTA = P_CODIGO_REVISTA;
  
  SELECT NOMBRE_REVISTA
  INTO V_NOMBRE_REVISTA
  FROM TBL_REVISTAS
  WHERE CODIGO_REVISTA = P_CODIGO_REVISTA;

  IF (V_CANT_CONINCIDEN > 0) THEN
    P_CODIGO_RESP:=0;
    P_MENSAJE_RESP:='La historia ya exste en '||V_NOMBRE_REVISTA||'.';
  ELSE
    INSERT INTO TBL_FLIPS (
						    CODIGO_NOTICIA,
						    CODIGO_USUARIO_FLIP,
						    CODIGO_REVISTA,
						    FECHA
						) VALUES (
						    P_CODIGO_NOTICIA,
						    P_CODIGO_USUARIO,
						    P_CODIGO_REVISTA,
						    SYSDATE
						);
    COMMIT;
    P_CODIGO_RESP:=1;
    P_MENSAJE_RESP:='Flipeado en '||V_NOMBRE_REVISTA||'.';
  END IF;
END;

--Procedimiento para dar o quitar like
CREATE OR REPLACE PROCEDURE P_LIKE
  (
    P_CODIGO_NOTICIA IN INTEGER,
    P_CODIGO_USUARIO IN INTEGER,
    P_CODIGO_RESPUESTA OUT INTEGER,
    P_MENSAJE_RESPUESTA OUT VARCHAR2
  )
AS
  V_CODIGO_NOTICIA INTEGER;
BEGIN
  SELECT COUNT(CODIGO_NOTICIA)
  INTO V_CODIGO_NOTICIA
  FROM TBL_REACCIONES_X_NOTICIAS
  WHERE CODIGO_USUARIO = P_CODIGO_USUARIO
  AND CODIGO_NOTICIA = P_CODIGO_NOTICIA;

  IF (V_CODIGO_NOTICIA > 0) THEN
    DELETE FROM TBL_REACCIONES_X_NOTICIAS 
            WHERE CODIGO_NOTICIA =P_CODIGO_NOTICIA
            AND CODIGO_USUARIO =P_CODIGO_USUARIO
            AND CODIGO_REACCION =1;
    COMMIT;
    P_CODIGO_RESPUESTA:='0';
    P_MENSAJE_RESPUESTA:='Has indicado que ya no te gusta una historia.';
  ELSE
    INSERT INTO TBL_REACCIONES_X_NOTICIAS (
                CODIGO_NOTICIA,
                CODIGO_USUARIO,
                CODIGO_REACCION
            ) VALUES (
              P_CODIGO_NOTICIA,
              P_CODIGO_USUARIO,
              1
            );
    COMMIT;
    P_CODIGO_RESPUESTA:='1';
    P_MENSAJE_RESPUESTA:='Has indicado que te gusta una historia.';
  END IF;
  EXCEPTION
    WHEN OTHERS THEN
        P_CODIGO_RESPUESTA := '0';
        P_MENSAJE_RESPUESTA := 'Ocurrio un error.'||sqlerrm||', '||sqlcode;
        ROLLBACK;
END;
/

--Procedimiento para eliminar interés
CREATE OR REPLACE PROCEDURE P_ELIMINAR_INTERES
    (
        P_CODIGO_USUARIO IN INTEGER,
        P_CODIGO_INTERES IN INTEGER,
        P_CODIGO_RESP OUT INTEGER,
        P_MENSAJE_RESP OUT VARCHAR2
    )
AS
    V_VERIFICADOR INTEGER;
BEGIN
    SELECT COUNT(1)
    INTO V_VERIFICADOR
    FROM TBL_INTERESES_X_USUARIO
    WHERE P_CODIGO_INTERES = P_CODIGO_INTERES
    AND CODIGO_USUARIO = P_CODIGO_USUARIO;

    IF (V_VERIFICADOR>0) THEN
       DELETE FROM tbl_intereses_x_usuario
        WHERE codigo_usuario = P_CODIGO_USUARIO
        AND codigo_categoria_interes = P_CODIGO_INTERES;
        COMMIT;
        P_CODIGO_RESP:=1;
        P_MENSAJE_RESP:= 'Interés eliminado exitosamente.';
    ELSE
        P_CODIGO_RESP:=0;
        P_MENSAJE_RESP:= 'No puedes eliminar un interés que no sigues.';
    END IF;


END;
/


--Procedimiento para Insertar Revista
CREATE OR REPLACE PROCEDURE P_INSERTAR_REVISTA (p_CODIGO_USUARIO IN INTEGER,
                                                p_NOMBRE_REVISTA IN VARCHAR2,
                                                p_DESCRIPCION IN VARCHAR2,
                                                p_CODIGO_TIPO_REVISTA IN INTEGER,
                                                p_FECHA_CREACION IN DATE,
                                                p_RESULTADO OUT INTEGER)
AS
      V_CODIGO_USUARIO INTEGER := p_CODIGO_USUARIO;
      V_NOMBRE_REVISTA VARCHAR(300) := p_NOMBRE_REVISTA;
      V_DESCRIPCION VARCHAR2(300) := p_DESCRIPCION;
      V_CODIGO_TIPO_REVISTA INTEGER := p_CODIGO_TIPO_REVISTA;
      V_FECHA_CREACION DATE := p_FECHA_CREACION;
BEGIN
      INSERT INTO TBL_REVISTAS (CODIGO_USUARIO,
                              NOMBRE_REVISTA,
                              DESCRIPCION,
                              CODIGO_TIPO_REVISTA,
                              FECHA_DE_CREACION,
                              URL_PORTADA)
      VALUES (V_CODIGO_USUARIO,
              V_NOMBRE_REVISTA,
              V_DESCRIPCION,
              V_CODIGO_TIPO_REVISTA,
              V_FECHA_CREACION,
              'images/revista.jpg'
             );
      COMMIT;
      p_RESULTADO := 1;
EXCEPTION
  WHEN OTHERS THEN
    p_RESULTADO := 0;
END P_INSERTAR_REVISTA;
/

--Procedimiento para Insertar Noticia
CREATE OR REPLACE PROCEDURE P_INSERTAR_NOTICIA(p_CODIGO_USUARIO IN INTEGER,
                                               p_CODIGO_REVISTA IN INTEGER,
                                               p_CODIGO_CATEGORIA IN INTEGER,
                                               p_AUTOR_NOTICIA IN VARCHAR2,
                                               p_TITULO_NOTICIA IN VARCHAR2,
                                               p_DESCRIPCION_NOTICIA IN VARCHAR2,
                                               p_CONTENIDO_NOTICIA IN CLOB,
                                               p_URL_PORTADA IN VARCHAR2,
                                               p_RESULTADO OUT INTEGER)
AS
  V_CODIGO_USUARIO INTEGER := p_CODIGO_USUARIO;
  V_CODIGO_REVISTA INTEGER := p_CODIGO_REVISTA;
  V_CODIGO_CATEGORIA INTEGER := p_CODIGO_CATEGORIA;
  V_AUTOR_NOTICIA VARCHAR2(200) := p_AUTOR_NOTICIA;
  V_TITULO_NOTICIA VARCHAR2(300) := p_TITULO_NOTICIA;
  V_DESCRIPCION_NOTICIA VARCHAR2(300) := p_DESCRIPCION_NOTICIA;
  V_CONTENIDO_NOTICIA CLOB := p_CONTENIDO_NOTICIA;
  V_URL_PORTADA VARCHAR2(200) := p_URL_PORTADA;

BEGIN
  INSERT INTO TBL_NOTICIAS(CODIGO_USUARIO,
                           CODIGO_REVISTA,
                           CODIGO_CATEGORIA,
                           AUTOR_NOTICIA,
                           TITULO_NOTICIA,
                           DESCRIPCION_NOTICIA,
                           CONTENIDO_NOTICIA,
                           FECHA_PUBLICACION,
                           URL_PORTADA_NOTI)
      VALUES (V_CODIGO_USUARIO ,
              V_CODIGO_REVISTA ,
              V_CODIGO_CATEGORIA ,
              V_AUTOR_NOTICIA,
              V_TITULO_NOTICIA,
              V_DESCRIPCION_NOTICIA,
              V_CONTENIDO_NOTICIA,
              SYSDATE,
              V_URL_PORTADA);
  COMMIT;
  p_RESULTADO := 1;
EXCEPTION 
  WHEN OTHERS THEN
  p_RESULTADO := 0;
END;
/
--Procedimiento para cambiar estado de notificacion a vista
CREATE OR REPLACE PROCEDURE P_ACTUALIZAR_NOTI (NOTIFICACION IN NUMBER)
AS
BEGIN
    UPDATE TBL_NOTIFICACIONES SET CODGIO_ESTADO_NOTIFICACION = 1
    WHERE CODIGO_NOTIFICACION = NOTIFICACION;
END;
/

--------------------------------------------------------
--  DDL for Procedure ACTUALIZAR_USUARIO
--------------------------------------------------------
set define off;

  CREATE OR REPLACE PROCEDURE "DB_FLIPBOARD"."ACTUALIZAR_USUARIO" (
    P_CODIGO_USUARIO integer,
    P_CODIGO_TIPO_USUARIO INTEGER,
    P_CODIGO_LUGAR_RESIDENCIA INTEGER,
    P_CODIGO_ESTADO_USUARIO INTEGER,
    P_NOMBRE_USUARIO VARCHAR2,
    P_ALIAS_USUARIO VARCHAR2,
    P_CORREO VARCHAR2,
    P_CONTRASENIA VARCHAR2,
    P_URL_FOTO_PERFIL VARCHAR2,
    P_DESCRIPCION VARCHAR2,
    P_FECHA DATE,
    p_codigo_resultado out INTEGER,
    p_mensaje_resultado out varchar2
) AS 
    V_CORREO INTEGER;
    V_ALIAS INTEGER;
BEGIN
    SELECT COUNT(1) INTO V_CORREO
    FROM TBL_USUARIOS
    WHERE CORREO = P_CORREO
    AND CODIGO_USUARIO != P_CODIGO_USUARIO; 
    
    SELECT COUNT(1) INTO V_ALIAS
    FROM TBL_USUARIOS
    WHERE ALIAS_USUARIO = P_ALIAS_USUARIO
    AND CODIGO_USUARIO != P_CODIGO_USUARIO;
    
    IF V_CORREO=1 THEN
        p_codigo_resultado := 0;
        p_mensaje_resultado := 'Este correo ya se encuentra registrado por otro usuario';
        RETURN;
    END IF;
    
    IF V_ALIAS=1 THEN
        p_codigo_resultado := 0;
        p_mensaje_resultado := 'Este alias ya se encuentra registrado por otro usuario';
        RETURN;
    END IF;

    UPDATE TBL_USUARIOS
    SET CODIGO_USUARIO = P_CODIGO_USUARIO,
	    CODIGO_TIPO_USUARIO = P_CODIGO_TIPO_USUARIO,
	    CODIGO_LUGAR_RESIDENCIA = P_CODIGO_LUGAR_RESIDENCIA,
	    CODIGO_ESTADO_USUARIO = P_CODIGO_ESTADO_USUARIO,
	    NOMBRE_USUARIO = P_NOMBRE_USUARIO,
	    ALIAS_USUARIO = P_ALIAS_USUARIO,
	    CORREO = P_CORREO,
	    CONTRASENIA = P_CONTRASENIA,
	    URL_FOTO_PERFIL = P_URL_FOTO_PERFIL,
	    DESCRIPCION = P_DESCRIPCION,
        FECHA_REGISTRO = P_FECHA
	WHERE CODIGO_USUARIO = P_CODIGO_USUARIO;
	   
    COMMIT;
    p_codigo_resultado := 1;
    p_mensaje_resultado := 'El usuario se actualizo correctamente.';
EXCEPTION
    WHEN OTHERS THEN
        p_codigo_resultado := 0;
        p_mensaje_resultado := 'Ocurrio un error.'||sqlerrm||', '||sqlcode;
    ROLLBACK;
END;

/
--------------------------------------------------------
--  DDL for Procedure ELIMINAR_USUARIO
--------------------------------------------------------
set define off;

  CREATE OR REPLACE PROCEDURE "DB_FLIPBOARD"."ELIMINAR_USUARIO" (
    P_CODIGO_USUARIO integer,
    P_CORREO VARCHAR2,
    p_codigo_resultado out INTEGER,
    p_mensaje_resultado out varchar2
) AS 
    V_USUARIO INTEGER;
BEGIN
    SELECT COUNT(1) INTO V_USUARIO
    FROM TBL_USUARIOS
    WHERE CORREO = P_CORREO
    AND CODIGO_USUARIO = P_CODIGO_USUARIO; 

    IF V_USUARIO=0 THEN
        p_codigo_resultado := 0;
        p_mensaje_resultado := 'Usuario no encontrado';
        RETURN;
    END IF;

    DELETE FROM TBL_USUARIOS
    WHERE CODIGO_USUARIO = P_CODIGO_USUARIO;
    
    COMMIT;
    p_codigo_resultado := 1;
    p_mensaje_resultado := 'El usuario se elimino correctamente.';
EXCEPTION
    WHEN OTHERS THEN
        p_codigo_resultado := 0;
        p_mensaje_resultado := 'Ocurrio un error.'||sqlerrm||', '||sqlcode;
    ROLLBACK;
END;

/
--------------------------------------------------------
--  DDL for Procedure INSERTAR_USUARIO
--------------------------------------------------------
set define off;

  CREATE OR REPLACE PROCEDURE "DB_FLIPBOARD"."INSERTAR_USUARIO" (
    P_CODIGO_USUARIO out integer,
    P_CODIGO_TIPO_USUARIO INTEGER,
    P_CODIGO_LUGAR_RESIDENCIA INTEGER,
    P_CODIGO_ESTADO_USUARIO INTEGER,
    P_NOMBRE_USUARIO VARCHAR2,
    P_ALIAS_USUARIO VARCHAR2,
    P_CORREO VARCHAR2,
    P_CONTRASENIA VARCHAR2,
    P_URL_FOTO_PERFIL VARCHAR2,
    P_DESCRIPCION VARCHAR2,
    P_FECHA DATE,
    p_codigo_resultado out INTEGER,
    p_mensaje_resultado out varchar2
) AS 
    V_CORREO INTEGER;
BEGIN
    SELECT COUNT(1) INTO V_CORREO
    FROM TBL_USUARIOS
    WHERE CORREO = P_CORREO; 
    
    IF V_CORREO=1 THEN
        p_codigo_resultado := 0;
        p_mensaje_resultado := 'Este correo ya lo tiene un usuario registrado';
        RETURN;
    END IF;

    P_CODIGO_USUARIO:=TBL_USUARIOS_CODIGO_USUARIO.NEXTVAL;
    INSERT INTO TBL_USUARIOS(
	    CODIGO_USUARIO,
	    CODIGO_TIPO_USUARIO,
	    CODIGO_LUGAR_RESIDENCIA,
	    CODIGO_ESTADO_USUARIO,
	    NOMBRE_USUARIO,
	    ALIAS_USUARIO,
	    CORREO,
	    CONTRASENIA,
	    URL_FOTO_PERFIL,
	    DESCRIPCION,
        FECHA_REGISTRO
	)
	VALUES (
	    P_CODIGO_USUARIO,
	    P_CODIGO_TIPO_USUARIO,
	    P_CODIGO_LUGAR_RESIDENCIA,
	    P_CODIGO_ESTADO_USUARIO,
	    INITCAP(P_NOMBRE_USUARIO),
	    INITCAP(P_ALIAS_USUARIO||P_CODIGO_USUARIO),
	    P_CORREO,
	    P_CONTRASENIA,
	    P_URL_FOTO_PERFIL,
	    P_DESCRIPCION,
        P_FECHA
	);    
    COMMIT;
    p_codigo_resultado := 1;
    p_mensaje_resultado := 'El usuario se registro correctamente.';
EXCEPTION
    WHEN OTHERS THEN
        p_codigo_resultado := 0;
        p_mensaje_resultado := 'Ocurrio un error.'||sqlerrm||', '||sqlcode;
    ROLLBACK;
END;

/






--EJEMPLO PARA LLAMAR PROCEDIMIENTOS DESDE SQL-DEVELOPER
--para activar consola utilizar:
--SET serveroutput ON;
DECLARE
  V_CODIGO_RESP INTEGER;
  V_MENSAJE_RESP VARCHAR2(300);
BEGIN
  P_FLIPEAR(5,3,3,V_CODIGO_RESP,V_MENSAJE_RESP);
  DBMS_OUTPUT.PUT_LINE(V_MENSAJE_RESP);
END;

--EJEMPLO DE COMO UTILIZAR EL PROCEDIMIENTO EN EL CODIGO
$conn = oci_connect('DB_FLIPBOARD', 'oracle', 'localhost/XE','AL32UTF8');
if (!$conn) {
    $e = oci_error();
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}
$codRevista=$_POST["codRevista"];
$codNoticia=$_POST["codNoticia"];     
$sql="
  BEGIN
    P_FLIPEAR(:codNoticia,
          :codigoUsuario,
          :codRevista,
          :codigoRespuesta,
          :mensajeRespuesta);
  END;
    ";
$procedure = oci_parse($conn, $sql);
oci_bind_by_name($procedure, ':codNoticia', $codNoticia);
oci_bind_by_name($procedure, ':codigoUsuario', $codigoUsuario);
oci_bind_by_name($procedure, ':codRevista', $codRevista);
oci_bind_by_name($procedure, ':codigoRespuesta', $codigoRespuesta,5);
oci_bind_by_name($procedure, ':mensajeRespuesta', $mensajeRespuesta,200);
oci_execute($procedure);
echo $mensajeRespuesta;
oci_free_statement($procedure);
oci_close($conn);
