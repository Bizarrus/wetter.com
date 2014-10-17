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
	
	class Weather {
		private $credits	= NULL;
		private $city		= NULL;
		private $days		= array();
		
		public function getCredits($name = NULL) {
			if(!empty($name) && !empty($this->credits->{$name})) {
				return $this->credits->{$name};
			}
			
			return $this->credits;
		}
		
		public function setCredits($credits) {
			$this->credits = $credits;
		}
		
		public function getCity() {
			return $this->city;
		}
		
		public function setCity($city) {
			$this->city = $city;
		}
		
		public function getDays() {
			return $this->days;
		}
		
		public function addDay($day) {
			$this->days[] = $day;
		}
	}
?>