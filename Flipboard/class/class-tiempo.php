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
			if ($this->minutos < 60)//menos de 1 hora
				$this->tiempoTranscurrido = 'Hace '.(int)$this->minutos.' minutos.';
			elseif ($this->minutos < 1440)//menos de 1 dia
				$this->tiempoTranscurrido = 'Hace '.(int)($this->minutos/60).' horas.';
			elseif ($this->minutos < 10080)//menos de 1 semana
				$this->tiempoTranscurrido = 'Hace '.(int)($this->minutos/1440).' días.';
			elseif ($this->minutos < 50040)//menos de 5 semanas
				$this->tiempoTranscurrido = 'Hace '.(int)($this->minutos/10080).' semanas.';
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