<?php
	class Tiempo{

		private $minutos;
		private $tiempoTranscurrido;

		public function __construct(){
			$this->minutos = 0;	
			$this->tiempoTranscurrido = '';	
		}
		public function calcularTiempoTranscurrido($minutos){
			$this->setMinutos($minutos);
			if ($this->minutos < 60){//menos de 1 hora
				$tiempoTemp = (int)$this->minutos;
				if ($tiempoTemp == 1)
					$this->tiempoTranscurrido = 'Hace '.$tiempoTemp.' minuto.';
				else
					$this->tiempoTranscurrido = 'Hace '.$tiempoTemp.' minutos.';
			}
			elseif ($this->minutos < 1440){//menos de 1 dia
				$tiempoTemp = (int)($this->minutos/60);
				if ($tiempoTemp == 1)
					$this->tiempoTranscurrido = 'Hace '.$tiempoTemp.' hora.';
				else
					$this->tiempoTranscurrido = 'Hace '.$tiempoTemp.' horas.';
			}
			elseif ($this->minutos < 10080){//menos de 1 semana
				$tiempoTemp = (int)($this->minutos/1440);
				if ($tiempoTemp == 1)
					$this->tiempoTranscurrido = 'Hace '.$tiempoTemp.' día.';
				else
					$this->tiempoTranscurrido = 'Hace '.$tiempoTemp.' días.';
			}
			elseif ($this->minutos < 50040){//menos de 5 semanas
				$tiempoTemp = (int)($this->minutos/10080);
				if ($tiempoTemp == 1)
					$this->tiempoTranscurrido = 'Hace '.$tiempoTemp.' semana.';
				else
					$this->tiempoTranscurrido = 'Hace '.$tiempoTemp.' semanas.';
			}
			else
				$this->tiempoTranscurrido = 'Hace mucho tiempo.';
			return $this->tiempoTranscurrido;
		}
		public function getMinutos(){
			return $this->minutos;
		}
		public function setMinutos($minutos){
			$this->minutos = $minutos;
		}
		public function getTiempoTranscurrido(){
			return $this->tiempoTranscurrido;
		}
		public function setTiempoTranscurrido($tiempoTranscurrido){
			$this->tiempoTranscurrido = $tiempoTranscurrido;
		}
	}
?>