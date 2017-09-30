<?php

	class Conexion{

		private $usuario="DB_FLIPBOARD";
		private $contrasena="oracle";
		private $host="localhost/XE";
		private $link;

		public function __construct(){
			$this->establecerConexion();			
		}

		public function establecerConexion(){
			/*$conn = oci_connect('hr', 'welcome', 'localhost/XE');
				if (!$conn) {
				    $e = oci_error();
				    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
				}*/
			$this->link = oci_connect($this->usuario, $this->contrasena, $this->host);

			if (!$this->link){
				echo "No se pudo conectar con oracle";
				exit;
			}
		}

		public function cerrarConexion(){
			oci_close($this->link);
		}
		public function commit(){
			oci_commit($this->link);
		}
		public function rollback(){
			oci_rollback($this->link);
		}
		public function ejecutarInstruccion($sql){
			$instruccion = oci_parse($this->link, $sql);
			oci_execute($instruccion);
			return $instruccion;
		}

		public function obtenerFila($resultado){
			return oci_fetch_array($resultado);
		}

		public function obtenerArregloAsociativo($resultado){
			return oci_fetch_assoc($resultado);
		}

		public function cantidadRegistros($resultado){
			return oci_num_rows($resultado);
		}

		public function liberarResultado($resultado){
			oci_free_statement($resultado);
		}
		public function getUsuario(){
			return $this->usuario;
		}
		public function setUsuario($usuario){
			$this->usuario = $usuario;
		}
		public function getContrasena(){
			return $this->contrasena;
		}
		public function setContrasena($contrasena){
			$this->contrasena = $contrasena;
		}
		public function getHost(){
			return $this->host;
		}
		public function setHost($host){
			$this->host = $host;
		}		
		public function getLink(){
			return $this->link;
		}
		public function setLink($link){
			$this->link = $link;
		}

	}
?>