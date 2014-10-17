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
	
	class Format {
		const XML		= 0x01;
		const XML_RAW	= 0x02;
		const JSON		= 0x03;
		const JSON_RAW	= 0x04;
		const OBJECT	= 0x05;
		
		public static function getString($format) {
			switch($format) {
				case self::XML:
					return 'xml';
				break;
				case self::XML_RAW:
					return 'xml';
				break;
				case self::JSON:
					return 'json';
				break;
				case self::JSON_RAW:
					return 'json';
				break;
				case self::OBJECT:
					return 'json';
				break;
			}
			
			return $format;
		}
	}
?>