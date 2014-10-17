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
	
	class City {
		private $code		= NULL;
		private $zip		= NULL;
		private $name		= NULL;
		private $quarter	= NULL;
		private $country	= NULL;
		private $state		= NULL;
		private $url		= NULL;
		private $district	= NULL;
		
		public function getCode() {
			return $this->code;
		}
		
		public function setCode($code) {
			$this->code = $code;
		}
		
		public function getZIP() {
			return $this->zip;
		}
		
		public function setZIP($zip) {
			$this->zip = $zip;
		}
		
		public function getName() {
			return $this->name;
		}
		
		public function setName($name) {
			$this->name = $name;
		}
		
		public function getQuarter() {
			return $this->quarter;
		}
		
		public function setQuarter($quarter) {
			$this->quarter = $quarter;
		}
		
		public function getCountry() {
			return $this->country;
		}
		
		public function setCountry($country) {
			$this->country = $country;
		}
		
		public function getState() {
			return $this->state;
		}
		
		public function setState($state) {
			$this->state = $state;
		}
		
		public function getDistrict() {
			return $this->district;
		}
		
		public function setDistrict($district) {
			$this->district = $district;
		}
		
		public function getURL() {
			return $this->url;
		}
		
		public function setURL($url) {
			$this->url = $url;
		}
	}
?>