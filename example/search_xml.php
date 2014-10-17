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
	
	// Include the Library
	require_once('../lib/weather/WeatherAPI.class.php');
	
	// For a better View
	header('Content-Type: text/plain; charset=UTF-8');
	
	// Initialise
	$weather = new WeatherAPI();
	
	// Define Project & API-Key
	$weather->setProject('YourProjectName');
	$weather->setAPIKey('YourAPIKey');
	
	// Make a Search Request as XML-Format
	$search = $weather->makeSearch('Cupertino', Format::XML);
	print_r($search);
?>