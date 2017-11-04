<?php
	//date_default_timezone_set('America/Tegucigalpa');
	class fechaIntervalo{

		public function __construct(){
			
		}

		public static function calcularintervalo($fecha,$fechaActual){
			$fecha1 = new DateTime($fecha);//fecha inicial
			$fecha2 = new DateTime($fechaActual);//fecha de cierre
			$fecha = $fecha1->diff($fecha2);
			if($fecha->y!=0){
				printf('Hace %d años.',$fecha->y);
			}else if($fecha->m!=0){
				printf('Hace %d meses.',$fecha->m);
			}
			else if($fecha->d!=0){
				printf('Hace %d días.',$fecha->d);
			}
			else if($fecha->h!=0){
				printf('Hace %d horas.',$fecha->h);
			}
			else if($fecha->i!=0){
				printf('Hace %d minutos.',$fecha->i);
			}
			else{
				printf('Hace %d segundos.',$fecha->s);
			}


		}

	}
?>