<?php 
	define('BASEURL', 'http://localhost/SeriCine/');
	define('ASSETS', BASEURL.'Assets/');
	define('CSS', ASSETS.'css/');
	define('FOTOS', ASSETS.'Fotos/');
	define('CONFIG', BASEURL.'Config/');
    define('APP', CONFIG.'App/');
	define('CONTROLLERS', BASEURL.'Controllers/');
	define('MODELS', BASEURL.'Models/');
	define('VIEWS', BASEURL.'Views/');
	define('PLATFORMS', VIEWS.'Platforms/');
	define('TEMPLATES', VIEWS.'Templates/');
	
	//Variables Gobales

	
	//Zona horaria
	date_default_timezone_set('America/Guatemala');

	//Datos de conexión a Base de Datos
	
	define('DBHOST', 'localhost');
	define('DBUSER', 'root');
	define('DBPASS', 'root');
	define('DBNAME', 'dbsericine');
	
 ?>