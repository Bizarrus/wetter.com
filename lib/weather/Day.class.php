<?php
	/**
	*	Copyright 2014 by <?adi | Web- & Software development
	*
	*	Licensed under the Apache License, Version 2.0 (the "License");
	*	you may not use this file except in compliance with the License.
	*	You may obtain a copy of the License at
	*		http://www.apache.org/licenses/LICENSE-2.0
	*
	*	Unless required by applicable law or agreed to in writing, software
	*	distributed under the License is distributed on an "AS IS" BASIS,
	*	WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
	*	See the License for the specific language governing permissions and
	*	limitations under the License.
	*
	*	@version	1.0.0
	*	@author		Adrian Preuß
	*	@email		info@adi-code.de
	*	@web		www.adi-code.de
	*/
	
	class Day {
		private $timestamp				= 0;
		private $date					= NULL;
		private $temperature_minimum	= 0;
		private $temperature_maximum	= 0;
		private $condition_code			= 999;
		private $condition_text			= '';
		private $time_prognostic		= 0;
		private $times					= array();
		
		public function getPrognosticTime() {
			return $this->time_prognostic;
		}
		
		public function setPrognosticTime($time) {
			$this->time_prognostic = $time;
		}
		
		public function getUnixTimestamp() {
			return $this->timestamp;
		}
		
		public function setUnixTimestamp($timestamp) {
			$this->timestamp = $timestamp;
		}
		
		public function getDate() {
			return $this->date;
		}
		
		public function setDate($date) {
			$this->date = $date;
		}
		
		public function getMinimumTemperature() {
			return $this->temperature_minimum;
		}
		
		public function setMinimumTemperature($temperature) {
			$this->temperature_minimum = $temperature;
		}
		
		public function getMaximumTemperature() {
			return $this->temperature_maximum;
		}
		
		public function setMaximumTemperature($temperature) {
			$this->temperature_maximum = $temperature;
		}
		
		public function getConditionsText() {
			return $this->condition_text;
		}
		
		public function setConditionsText($text) {
			$this->condition_text = $text;
		}
		
		public function getConditionsCode() {
			return $this->condition_code;
		}
		
		public function setConditionsCode($code) {
			$this->condition_code = $code;
		}
		
		public function getTimes() {
			return $this->times;
		}
		
		public function addTime($time) {
			$this->times[] = $time;
		}
	}
?>