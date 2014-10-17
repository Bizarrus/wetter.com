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
	
	class Results {
		private $query		= '';
		private $credits	= null;
		private $results	= array();
		
		public function getQuery() {
			return $this->query;
		}
		
		public function setQuery($query) {
			$this->query = $query;
		}
		
		public function getCredits($name = NULL) {
			if(!empty($name) && !empty($this->credits->{$name})) {
				return $this->credits->{$name};
			}
			
			return $this->credits;
		}
		
		public function setCredits($credits) {
			$this->credits = $credits;
		}
		
		public function isEmpty() {
			return $this->countResults() == 0;
		}
		
		public function countResults() {
			return count($this->results);
		}
		
		public function getResults() {
			return $this->results;
		}
		
		public function addResult($result) {
			$this->results[] = $result;
		}
	}
?>