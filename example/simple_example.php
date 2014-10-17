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
	
	// Initialise
	$weather = new WeatherAPI();
	
	// Define Project & API-Key
	$weather->setProject('development');
	$weather->setAPIKey('d09df07c312609d38e952d8496dcd0cf');
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Wetter.com - Simple Example</title>
		<meta charset="UTF-8" />
		
		<style type="text/css">
			body {
				font-family:		Helvetica, arial, sans-serif;
				color:				#333333;
				background:			#EEEEEE;
			}
			
			.clear {
				clear:				both;
			}
			
			a {
				color:				#999999;
				text-decoration:	none;
			}
			
			a:hover {
				color:				#000000;
				text-decoration:	underline;
			}
			
			header, footer {
				text-align:			center;
				font-size:			12px;
			}
			
			form.form {
				width:				500px;
				margin:				0 auto 0 auto;
				text-align:			center;
			}
			
			form.form input[type="submit"] {
				border:				1px solid #333333;
				font-size:			16px;
				margin:				0;
				padding:			5px 10px;
				border-radius:		0px;
				cursor:				pointer;
				width:				100px;
			}
			
			form.form input[type="search"] {
				border:				1px solid #333333;
				font-size:			16px;
				margin:				0;
				padding:			5px 10px;
				border-radius:		0px;
				width:				300px;
			}
			
			article {
				width:				500px;
				margin:				0 auto 0 auto;
				padding:			10px 0;
			}
			
			article p.error {
				color:				#800000;
				text-align:			center;
			}
			
			article div.entry {
				border-bottom:		1px solid #444444;
				padding:			5px;
				font-size:			12px;
			}
			
			article div.entry:hover {
				background:			rgba(255, 255, 255, 0.8);
			}
			
			article div.entry form {
				float:				right;
			}
			
			article div.entry form input[type="submit"] {
				border:				1px solid #333333;
				margin:				0;
				padding:			auto 10px;
				border-radius:		0px;
				cursor:				pointer;
			}
			
			article div.day {
				display:			inline-block;
				width:				24%;
				border-right:		1px solid #DDDDDD;
			}
			
			article div.day:last-child {
				border:				none;
			}
			
			article div.day label {
				font-weight:		bold;
				color:				#000080;
				text-align:			center;
				display:			block;
			}
			
			article div.day img, article div.day p, article div.day h3 {
				display:			block;
				text-align:			center;
				width:				100%;
			}
		</style>
	</head>
	<body>
		<header>
			<h1><a href="http://www.wetter.com/" target="_blank"><img src="icons/wettercom_184x36.png" alt="wetter.com" /></a></h1>
		</header>
		<section>
			<form method="post" class="form" action="simple_example.php">
				<input type="search" name="city" value="<?php print (!empty($_POST['city']) ? $_POST['city'] : ''); ?>" placeholder="Search for a City..." />
				<input type="submit" name="search" value="Search" />
			</form>
			<article>
				<?php
					$default_city		= 'Cupertino';
					$default_code		= '';
					
					if(isset($_POST['city'])) {
						$default_city	= $_POST['city'];
					}
					
					if(isset($_POST['code'])) {
						$default_code	= $_POST['code'];
					}
					
					$search		= $weather->makeSearch($default_city, Format::OBJECT);
					$results	= $search->getResults();
					
					if(!$search->isEmpty() && empty($default_code)) {
						$results = $search->getResults();
						
						if($search->countResults() > 1) {
							?>
							<p class="info">We found more Citys:</p>
							<?php
								foreach($results AS $index => $city) {
									?>
										<div class="entry">
											<label><?php print $city->getName(); ?> (<?php print (!empty($city->getZIP()) ? $city->getZIP() . ', ' : ''); print $city->getCountry(); ?>)</label>
											<form method="post" action="simple_example.php">
												<input type="hidden" name="code" value="<?php print $city->getCode(); ?>" />
												<input type="submit" name="search" value="Select" />
											</form>
											<div class="clear"></div>
										</div>
									<?php
								}
						} else {
							$default_code = $results[0]->getCode();
						}
					}
					
					if(!$search->isEmpty() && empty($default_code)) {
						?>
							<p class="error">No Citys found.</p>
						<?php
					}
					
					if(!empty($default_code)) {
						$day		= $weather->makeForecast($default_code, Format::OBJECT);
						$days		= $day->getDays();
						$city		= $day->getCity();
						
						foreach($days AS $index => $entry) {
							$times	= $entry->getTimes();
							?>
								<h2>Actual Date: <?php print date('d.m.Y', $entry->getUnixTimestamp()); ?> for <?php print $city->getName(); ?></h2>
								<br />
								<?php
									foreach($times AS $i => $time) {
										?>
											<div class="day">
												<label><?php print $time->getTime(); ?></label>
												<img src="icons/<?php print $time->getConditionsIcon(); ?>" alt="<?php print $time->getConditionsText(); ?>" />
												<p><?php print $time->getConditionsText(); ?></p>
												<h3><?php print $time->getMinimumTemperature(); ?> / <?php print $time->getMaximumTemperature(); ?> &deg;C</h3>
											</div>
										<?php
									}
								?>
								<p>See it on wetter.com: <a href="<?php print $city->getURL(); ?>" target="_blank"><?php print $city->getURL(); ?></a></p>
							<?php
						}
					}
				?>
			</article>
		</section>
		<footer>
			<p><a href="http://www.adi-code.de/" target="_blank" title="Webdesign Aachen">&lt;adi | Web- &amp; Softwaredevelopment</a></p>
		</footer>
	</body>
</html>