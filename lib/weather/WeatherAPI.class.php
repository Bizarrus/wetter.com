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
	
	define('WEATHER_LIB_PATH', dirname(__FILE__));
	
	// Helper
	require_once(WEATHER_LIB_PATH . '/StringBuffer.class.php');
	
	// Models / Data
	require_once(WEATHER_LIB_PATH . '/Time.class.php');
	require_once(WEATHER_LIB_PATH . '/Day.class.php');
	require_once(WEATHER_LIB_PATH . '/Weather.class.php');
	require_once(WEATHER_LIB_PATH . '/City.class.php');
	require_once(WEATHER_LIB_PATH . '/Results.class.php');
	
	// Core
	require_once(WEATHER_LIB_PATH . '/Format.class.php');
	require_once(WEATHER_LIB_PATH . '/WeatherRequest.class.php');
	
	class WeatherAPI {
		private $project	= '';
		private $api_key	= '';
		private $language	= 'en';
		
		public function setProject($project) {
			$this->project = $project;
		}
		
		public function setAPIKey($api_key) {
			$this->api_key = $api_key;
		}
		
		public function setLanguage($language) {
			$this->language = $language;
		}
		
		public function makeSearch($query, $format = NULL) {
			if(empty($format)) {
				$format = Format::JSON;
			}
			
			$request = new WeatherRequest('location', 'index');
			
			$request->addParameter('search',	$query);
			$request->addParameter('project',	$this->project);
			$request->addParameter('language',	$this->language);
			$request->addParameter('output',	Format::getString($format));
			$request->addParameter('cs',		$this->getChecksum($query));
			
			return $request->call($format);
		}
		
		public function makeForecast($city, $format = NULL) {
			if(empty($format)) {
				$format = Format::JSON;
			}
			
			$request = new WeatherRequest('forecast', 'weather');
			
			$request->addParameter('city',		$city);
			$request->addParameter('project',	$this->project);
			$request->addParameter('language',	$this->language);
			$request->addParameter('output',	Format::getString($format));
			$request->addParameter('cs',		$this->getChecksum($city));
			
			return $request->call($format);
		}
		
		private function getChecksum($data) {
			$buffer = new StringBuffer();
			
			$buffer->append($this->project);
			$buffer->append($this->api_key);
			$buffer->append($data);
			
			return MD5($buffer->toString());
		}
	}
?>