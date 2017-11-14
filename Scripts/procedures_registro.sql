--------------------------------------------------------
--  File created - Tuesday-November-07-2017   
--------------------------------------------------------
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
