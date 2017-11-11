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
