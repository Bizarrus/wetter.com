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
	
	class WeatherRequest {
		private $hostname	= 'api.wetter.com';
		private $secured	= false;
		private $language	= 'en';
		private $parameters	= array();
		private $controller	= '';
		private $action		= '';
		
		public function __construct($controller, $action) {
			$this->controller	= $controller;
			$this->action		= $action;
		}
		
		public function addParameter($name, $value) {
			$this->parameters[$name] = $value;
		}
		
		public function call($format) {
			$buffer = new StringBuffer();
			$buffer->append($this->secured === true ? 'https' : 'http');
			$buffer->append('://');
			$buffer->append($this->hostname);
			$buffer->append('/');
			$buffer->append($this->controller);
			$buffer->append('/');
			$buffer->append($this->action);
			$buffer->append('/');
			
			if(count($this->parameters) > 0) {
				foreach($this->parameters AS $name => $value) {
					$buffer->append($name);
					$buffer->append('/');
					$buffer->append($value);
					$buffer->append('/');
				}
			}
			
			$content = file_get_contents($buffer->toString());
			
			switch($format) {
				case Format::XML:
					$content = simplexml_load_string($content);
				break;
				case Format::JSON:
					$content = json_decode($content);
				break;
				case Format::OBJECT:
					$json		= json_decode($content);
					$weather	= (Object) NULL;
					
					if(isset($json->search)) {
						$weather	= new Results();
						$weather->setQuery($json->search->search_string);
						$weather->setCredits($json->search->credit);
						
						if(count($json->search->result) > 0) {
							foreach($json->search->result AS $index => $data) {
								$city = new City();
								
								$city->setCode($data->city_code);
								$city->setZIP($data->plz);
								$city->setName($data->name);
								$city->setQuarter($data->quarter);
								$city->setCountry($data->adm_1_code);
								$city->setState($data->adm_2_name);
								$city->setDistrict($data->adm_4_name);
								
								$weather->addResult($city);
							}
						}
					} else if(isset($json->city)) {
						$weather	= new Weather();
						$weather->setCredits($json->city->credit);
						
						$city		= new City();
						
						$city->setCode($json->city->city_code);
						$city->setURL(sprintf('http://www.wetter.com/%s', $json->city->url));
						$city->setName($json->city->name);
						
						$weather->setCity($city);
						
						if(count($json->city->forecast) > 0) {
							foreach($json->city->forecast AS $date => $data) {
								$day = new Day();
								
								$day->setConditionsCode($data->w);
								$day->setPrognosticTime($data->p);
								$day->setUnixTimestamp($data->d);
								$day->setMinimumTemperature($data->tn);
								$day->setMaximumTemperature($data->tx);
								$day->setConditionsText($data->w_txt);
								$day->setDate($date);
								
								foreach($data AS $name => $value) {
									if(strpos($name, ':') !== false){
										$time = new Time();
										$time->setTime($name);
										$time->setConditionsCode($value->w);
										$time->setPrognosticTime($value->p);
										$time->setUnixTimestamp($value->d);
										$time->setMinimumTemperature($value->tn);
										$time->setMaximumTemperature($value->tx);
										$time->setConditionsText($value->w_txt);
										$day->addTime($time);
									}
								}
								
								$weather->addDay($day);
							}
						}					
					}					
					
					$content	= $weather;			
				break;
			}
			
			return $content;
		}
	}
?>