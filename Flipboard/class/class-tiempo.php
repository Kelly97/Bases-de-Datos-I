<?php
	class Tiempo{

		private static $minutos;
		private static $tiempoTranscurrido;

		public function __construct(){
			self::$minutos = 0;	
			self::$tiempoTranscurrido = '';	
		}

		public static function calcularTiempoTranscurrido($minutos){
			self::setMinutos($minutos);
			if (self::$minutos < 60){//menos de 1 hora
				$tiempoTemp = (int)self::$minutos;
				if ($tiempoTemp == 1)
					self::$tiempoTranscurrido = 'Hace '.$tiempoTemp.' minuto.';
				else
					self::$tiempoTranscurrido = 'Hace '.$tiempoTemp.' minutos.';
			}
			elseif (self::$minutos < 1440){//menos de 1 dia
				$tiempoTemp = (int)(self::$minutos/60);
				if ($tiempoTemp == 1)
					self::$tiempoTranscurrido = 'Hace '.$tiempoTemp.' hora.';
				else
					self::$tiempoTranscurrido = 'Hace '.$tiempoTemp.' horas.';
			}
			elseif (self::$minutos < 10080){//menos de 1 semana
				$tiempoTemp = (int)(self::$minutos/1440);
				if ($tiempoTemp == 1)
					self::$tiempoTranscurrido = 'Hace '.$tiempoTemp.' día.';
				else
					self::$tiempoTranscurrido = 'Hace '.$tiempoTemp.' días.';
			}
			elseif (self::$minutos < 50040){//menos de 5 semanas
				$tiempoTemp = (int)(self::$minutos/10080);
				if ($tiempoTemp == 1)
					self::$tiempoTranscurrido = 'Hace '.$tiempoTemp.' semana.';
				else
					self::$tiempoTranscurrido = 'Hace '.$tiempoTemp.' semanas.';
			}
			else
				self::$tiempoTranscurrido = 'Hace mucho tiempo.';
			return self::$tiempoTranscurrido;
		}

		public static function getMinutos(){
			return self::$minutos;
		}

		public static function setMinutos($minutos){
			self::$minutos = $minutos;
		}

		public static function getTiempoTranscurrido(){
			return self::$tiempoTranscurrido;
		}

		public static function setTiempoTranscurrido($tiempoTranscurrido){
			self::$tiempoTranscurrido = $tiempoTranscurrido;
		}
	}
?>