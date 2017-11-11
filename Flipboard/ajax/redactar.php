<?php
switch ($_GET["accion"]) {
    case '1':
        if (isset($_FILES["file"]))
        {
            $file = $_FILES["file"];
            $nombre = $file["name"];
            $tipo = $file["type"];
            $ruta_provisional = $file["tmp_name"];
            $size = $file["size"];
            $dimensiones = getimagesize($ruta_provisional);
            $width = $dimensiones[0];
            $height = $dimensiones[1];
            $carpeta = "images/";
            
            if ($tipo != 'image/jpg' && $tipo != 'image/jpeg' && $tipo != 'image/png' && $tipo != 'image/gif')
            {
              echo "Error, el archivo no es una imagen"; 
            }
            else if ($size > 1024*1024)
            {
              echo "Error, el tamaño máximo permitido es un 1MB";
            }
            else if ($width > 500 || $height > 500)
            {
                echo "Error la anchura y la altura maxima permitida es 500px";
            }
            else if($width < 60 || $height < 60)
            {
                echo "Error la anchura y la altura mínima permitida es 60px";
            }
            else
            {
                $src = $carpeta.$nombre;
                move_uploaded_file($ruta_provisional, "../".$src);
                echo "<img src='$src'>";
            }
        }else{
            echo "No hay archivo";
        }
        break;

    case '2':
        //Agregar noticia
        $conn = oci_connect('DB_FLIPBOARD', 'oracle', 'localhost/XE','AL32UTF8');
        if (!$conn) {
            $e = oci_error();
            trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
        }

        $codigo_usuario = $_POST["codigo_usuario"];
        $codigo_revista = $_POST["codigo_revista"];
        $codigo_categoria = $_POST["categoria_noticia"];
        $autor = $_POST["autor"];
        $titulo = $_POST["titulo"];
        $descripcion = $_POST["descripcion"];
        $contenido = $_POST["content"];
        
        $resultado = 0;

        if(is_null($codigo_usuario)){
            echo $resultado;
            break;
        }

        if(is_null($codigo_revista)){
            echo $resultado;
            break;
        }

        if(is_null($titulo)){
            echo $resultado;
            break;
        }

        if(is_null($autor)){
            echo $resultado;
            break;
        }

        if(is_null($descripcion)){
            echo $resultado;
            break;
        }

        if(is_null($contenido)){
            echo $resultado;
            break;
        }
        
        if(is_null($_POST["file"])){
           $url_portada = $_POST["fileURL"];
        } 
        elseif (is_null(_POST["fileURL"])) {
           $url_portada = $_POST["file"];
        }
        else{
            echo $resultado;
            break;
        }
        $sql="
            BEGIN
                  P_INSERTAR_NOTICIA(:p_CODIGO_USUARIO 
                                     :p_CODIGO_REVISTA 
                                     :p_CODIGO_CATEGORIA 
                                     :p_AUTOR_NOTICIA 
                                     :p_TITULO_NOTICIA 
                                     :p_DESCRIPCION_NOTICIA 
                                     :p_CONTENIDO_NOTICIA 
                                     :p_URL_PORTADA 
                                     :p_RESULTADO);
            END;";

        $procedure = oci_parse($conn, $sql);
        oci_bind_by_name($procedure, ':p_CODIGO_USUARIO', $codigo_usuario);
        oci_bind_by_name($procedure, ':p_CODIGO_REVISTA', $codigo_revista);
        oci_bind_by_name($procedure, ':p_CODIGO_CATEGORIA', $codigo_categoria);
        oci_bind_by_name($procedure, ':p_AUTOR_NOTICIA', $autor, 200);
        oci_bind_by_name($procedure, ':p_TITULO_NOTICIA', $titulo, 300);
        oci_bind_by_name($procedure, ':p_DESCRIPCION_NOTICIA', $descripcion, 300);
        oci_bind_by_name($procedure, ':p_CONTENIDO_NOTICIA', $contenido, 3999);
        oci_bind_by_name($procedure, ':p_URL_PORTADA', $url_portada, 200);
        oci_bind_by_name($procedure, ':p_RESULTADO', $resultado);
        oci_execute($procedure);
        echo $resultado;
        oci_free_statement($procedure);
        oci_close($conn);
        break;
    
    default:
        # code...
        break;
}
