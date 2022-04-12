<?php 
date_default_timezone_set("Asia/Calcutta");
$date = date("Y-m-d",time());
$time = date("H:i:s",time());
$day  = date("l");
$id   = "";
$pass = "";
$pm25  = 0;
$pm10  = 0;
$co   = 0;
$no2   = 0;
$o3  = 0;
$nh3  = 0;
$so2  = 0;
$temp = 18;
$temp+=rand(-5,5);
$press= 1017;
$press+=rand(-10,10);
$alt  = 190;
$alt+=rand(-2,2);
$humid= 68;
$humid+=rand(-5,5);
$lt   = 28.327155;
$ln	  = 77.351031;
$at	  = 190;
$aqi	=	0;


foreach($_REQUEST as $key => $value)  //
{
	switch($key)
	{
		case "id" : $id = $value;
		            break;
		case "pw" : $pass = $value;
		            break;
		case "PM25" : $pm25 = $value;
		            break;
		case "PM10" : $pm10 = $value;
		            break;
		case "CO" : $co = $value;
		            break;
		case "NO2" : $no2 = $value;
		            break;
		case "O3" : $o3 = $value;
		            break;
		case "NH3" : $nh3 = $value;
		            break;
		case "SO2" : $so2 = $value;
		            break;
		case "BME1" : $temp = $value;
		            break;
		case "BME2" : $press = $value;
		            break;
		case "BME3" : $alt = $value;
		            break;
		case "BME4" : $humid = $value;
		            break;
		case "LT" : $lt = $value;
		            break;
		case "LN" : $ln = $value;
		            break;
		case "AT" : $at = $value;
		            break;
		case "AQI" : $aqi = $value;
		            break;
		default : break;
	}
}

$host="localhost";
 	$duser="root";
 	$dpaswd="";
 	$dname="IOT-db";

if($id=="1" AND $pass=="12345")
{
	
	
    $db=mysqli_connect($host,$duser,$dpaswd,$dname);
    if(!$db)
    {
    	$msg="Unable to connect to database:";
    }
    else
    {
		
		$qry="INSERT INTO ap VALUES(NULL,'$date','$time','$day','$pm25','$pm10','$co','$no2','$o3','$nh3',
									'$so2','$temp','$press','$alt','$humid','$lt','$ln','$aqi')";
		if(($result=mysqli_query($db,$qry)))
		{
			echo "success";
		}
		else
		{
			echo "Fail";
		}
	}
}
/*
    $db=mysqli_connect($host,$duser,$dpaswd,$dname);
    if(!$db)
    {
    	$msg="Unable to connect to database:";
    }
    else
    {
		echo"connected";
		$qry="CREATE TABLE `frsiv_27429126_IOT_db`.`ap` ( `sno` SERIAL, 
											`Date` DATE NULL DEFAULT NULL , 
											`Time` TIME NULL DEFAULT NULL, 
											`DAY` VARCHAR(20) NULL DEFAULT NULL , 
											`PM25` FLOAT UNSIGNED NULL DEFAULT NULL , 
											`PM10` FLOAT UNSIGNED NULL DEFAULT NULL , 
											`CO` FLOAT UNSIGNED NULL DEFAULT NULL , 
											`NO2` FLOAT UNSIGNED NULL DEFAULT NULL , 
											`O3` FLOAT UNSIGNED NULL DEFAULT NULL , 
											`NH3` FLOAT UNSIGNED NULL DEFAULT NULL , 
											`SO2` FLOAT UNSIGNED NULL DEFAULT NULL , 
											`TEMPRATURE` FLOAT NULL DEFAULT NULL , 
											`PRESSURE` FLOAT NULL DEFAULT NULL , 
											`ALTITUDE` FLOAT NULL DEFAULT NULL , 
											`HUMIDITY` FLOAT UNSIGNED NULL DEFAULT NULL , 
											`LATITUDE` DOUBLE NULL DEFAULT NULL , 
											`LONGITUDE` DOUBLE NULL DEFAULT NULL , 
											`AQI` INT UNSIGNED NULL DEFAULT NULL )";
		if(($result=mysqli_query($db,$qry)))
		{
			echo "Sucess1";
		}
		else{echo "FAIL1";}
	}
*/	

/*
CREATE TABLE `frsiv_27429126_IOT_db`.`hr_data_ap` (`sno` SERIAL NULL ,
												`Date` DATE NULL DEFAULT NULL ,
												`Time` TIME NULL DEFAULT NULL ,
												`PM25` FLOAT UNSIGNED NULL DEFAULT NULL , 
												`PM10` FLOAT UNSIGNED NULL DEFAULT NULL , 
												`CO` FLOAT UNSIGNED NULL DEFAULT NULL , 
												`NO2` FLOAT UNSIGNED NULL DEFAULT NULL , 
												`O3` FLOAT UNSIGNED NULL DEFAULT NULL , 
												`NH3` FLOAT UNSIGNED NULL DEFAULT NULL , 
												`SO2` FLOAT UNSIGNED NULL DEFAULT NULL , 
												`TEMPRATURE` FLOAT NULL DEFAULT NULL , 
												`PRESSURE` FLOAT NULL DEFAULT NULL , 
												`ALTITUDE` FLOAT NULL DEFAULT NULL , 
												`HUMIDITY` FLOAT UNSIGNED NULL DEFAULT NULL ,
												`AQI` INT UNSIGNED NULL DEFAULT NULL );
*/

/*
CREATE TABLE `frsiv_27429126_IOT_db`.`dly_data_ap` (`Date` DATE NULL DEFAULT NULL ,
												`PM25` FLOAT UNSIGNED NULL DEFAULT NULL , 
												`PM10` FLOAT UNSIGNED NULL DEFAULT NULL , 
												`CO` FLOAT UNSIGNED NULL DEFAULT NULL , 
												`NO2` FLOAT UNSIGNED NULL DEFAULT NULL , 
												`O3` FLOAT UNSIGNED NULL DEFAULT NULL , 
												`NH3` FLOAT UNSIGNED NULL DEFAULT NULL , 
												`SO2` FLOAT UNSIGNED NULL DEFAULT NULL , 
												`TEMPRATURE` FLOAT NULL DEFAULT NULL , 
												`PRESSURE` FLOAT NULL DEFAULT NULL , 
												`ALTITUDE` FLOAT NULL DEFAULT NULL , 
												`HUMIDITY` FLOAT UNSIGNED NULL DEFAULT NULL ,
												`AQI` INT UNSIGNED NULL DEFAULT NULL ,
												PRIMARY KEY(Date));
*/

/*
INSERT INTO `hr_data_ap` (	`Date` ,`Time`,`PM25` ,`PM10` ,`CO` , `NO2` ,`O3` ,`NH3` ,
						`SO2` ,`TEMPRATURE` ,`PRESSURE` ,`ALTITUDE` ,`HUMIDITY` ,`AQI`)
SELECT 	`Date`,`Time`,ROUND(AVG(`PM25`),0)`PM25`,ROUND(AVG(`PM10`),0)`PM10`,ROUND(AVG(`CO`),0)`CO`,
				ROUND(AVG(`NO2`),0)`NO2`,ROUND(AVG(`O3`),0)`O3`,ROUND(AVG(`NH3`),0)`NH3`,ROUND(AVG(`SO2`),0)`SO2`,ROUND(AVG(`TEMPRATURE`),0)`TEMPRATURE`,ROUND(AVG(`PRESSURE`),0)`PRESSURE`,
				ROUND(AVG(`ALTITUDE`),0)`ALTITUDE`,ROUND(AVG(`HUMIDITY`),0)`HUMIDITY`,ROUND(AVG(`AQI`),0)`AQI`
FROM `ap`	
GROUP BY hour(Time),Date
*/		

/*
INSERT INTO `dly_data_ap` (`Date` ,`PM25` ,`PM10` ,`CO` , `NO2` ,`O3` ,`NH3` ,
						`SO2` ,`TEMPRATURE` ,`PRESSURE` ,`ALTITUDE` ,`HUMIDITY` ,`AQI` )
SELECT 	`Date`,ROUND(AVG(`PM25`),0)`PM25`,ROUND(AVG(`PM10`),0)`PM10`,ROUND(AVG(`CO`),0)`CO`,
				ROUND(AVG(`NO2`),0)`NO2`,ROUND(AVG(`O3`),0)`O3`,ROUND(AVG(`NH3`),0)`NH3`,ROUND(AVG(`SO2`),0)`SO2`,ROUND(AVG(`TEMPRATURE`),0)`TEMPRATURE`,ROUND(AVG(`PRESSURE`),0)`PRESSURE`,
				ROUND(AVG(`ALTITUDE`),0)`ALTITUDE`,ROUND(AVG(`HUMIDITY`),0)`HUMIDITY`,ROUND(AVG(`AQI`),0)`AQI`
FROM `ap`	
GROUP BY Date
*/

/*

/*	
SELECT `Date`,`TEMPRATURE` FROM `hr_4cast` ORDER BY Date ;
/*
	
CREATE TABLE `frsiv_27429126_IOT_db`.`aqi_description` ( `Level` VARCHAR(100) NOT NULL ,
											`Quality` VARCHAR(100) NOT NULL ,
											`Description` VARCHAR(500) NOT NULL , 
											`Concern` VARCHAR(500) NOT NULL , 
											`Effects` VARCHAR(500) NOT NULL , 
											`Solution` VARCHAR(600) NOT NULL , 
											PRIMARY KEY (`Level`)) ENGINE = InnoDB;


INSERT INTO `aqi_description` (`Level`,`Quality`, `Description`, `Concern`, `Effects`, `Solution`) 
		VALUES  ('Good','Good', 'Air quality is good and air pollution poses no risk', 'Nobody need to concern', 'No health effects seen', 'It’s a great day to be active outside'),
				('Satisfactory','Satisfactory', 'Air quality is acceptable. However, there may be a risk for some people, particularly those who are unusually sensitive to air pollution',
					'Some people who may be unusually sensitive to air pollution', 'Symptoms such as coughing or shortness of breath ',
					'Unusually sensitive people Consider reducing prolonged or heavy outdoor exertion Everyone else It’s a good day to be active outside.'),
                ('Moderate','Unhealthy for Sensitive Groups', 
			        'Members of sensitive groups may experience health effects. The general public is less likely to be affected.',
					'Sensitive groups include people with lung disease such as asthma, older adults, children and teenagers, and people who are active outdoors.',
					'Symptoms such as coughing or shortness of breath', 'Reduce prolonged or heavy outdoor exertion. Take more breaks, do less intense activities. People with asthma should follow their asthma action plans and keep quick- relief medicine handy.'),
				('Poor','Unhealthy', 'Some members of the general public may experience health effects; members of sensitive groups may experience more serious health effects.', 
					'Everyone', 'coughing, breathing difficulty and asthma attack', 'Avoid prolonged or heavy outdoor exertion. Take more breaks, do less intense activities, Consider moving activities indoors. People with asthma, keep quick-relief medicine handy. '),
				('Very Poor','Very Unhealthy', 'Health alert: The risk of health effects is increased for everyone.', 'Everyone', 
					'Coughing, breathing difficulty,unusual fatigue, make the lungs more susceptible to infection, aggravate lung diseases, increase the frequency of asthma attacks, and increase the risk of early death from heart or lung disease', 
					'Avoid all physical activity outdoors. Move activities indoors or reschedule to a time when air quality is better. People with asthma, keep quick-relief medicine handy.'),
				('Severe','Hazardous', 'Health warning of emergency conditions: everyone is more likely to be affected.', 'Everyone', 
					'Coughing, breathing difficulty,unusual fatigue and lung damage. make the lungs more susceptible to infection, aggravate lung diseases, increase the frequency of asthma attacks, and increase the risk of early death from heart or lung disease',
					'Everyone avoid all physical activity outdoors')
*/
?>