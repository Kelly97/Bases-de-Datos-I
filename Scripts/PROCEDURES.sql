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
$conn = oci_connect('DB_FLIPBOARD', 'oracle', 'localhost/XE');
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
oci_bind_by_name($procedure, ':codigoRespuesta', $codigoRespuesta,100);
oci_bind_by_name($procedure, ':mensajeRespuesta', $mensajeRespuesta,100);
oci_execute($procedure);
echo $mensajeRespuesta;
oci_free_statement($procedure);
oci_close($conn);