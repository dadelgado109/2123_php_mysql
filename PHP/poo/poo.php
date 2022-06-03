
<?php

	class cuadrado {

		/*
			En php tenemos 3 Tipos de atributos
			public: Se pueden acceder desde cualquier lado y son heredables
			
			protected: Se solo se puede acceder dentro de la clase y son heredables
			
			private: Solo se puede acceder dentro de la clase y no son heredables

		*/
		
		//Esta es una propiedad
		public $largo;
		//Esta es una propiedad
		public $grosor;
		//Esta es una propiedad
		protected $color;
		//Esta es una propiedad
		private $angulo = 90;

		public function __construct($largo, $grosor, $color){

			$this->largo 	= $largo;
			$this->grosor 	= $grosor;
			$this->color 	= $color;

		}	

		// Esto es un metodo
		public function calcularArea(){

			$area = 0;
			$area = $this->largo * $this->largo;
			return $area;

		}

		public function calcularPerimetro(){

			$perimetro = $this->largo * 4;
			return $perimetro;

		}

		public function cargarColor($color){

			$this->color = $color;

		}

		public function devolverColor(){

			return $this->color;

		}

		public function devolverAngulo(){

			return $this->angulo;

		}

	}

	class rectangunlo extends cuadrado{

		public $ancho;

		private $angulo = 90;

		public function calcularArea(){

			$area = $this->largo * $this->ancho;
			return $area;

		}

		public function calcularPerimetro(){

			$perimetro = ($this->largo + $this->ancho) * 2;
			return $perimetro;

		}

	}



	$objCuadrado = new cuadrado(6,10,"Verde");

	echo("<br>Largo del cuadrado:".$objCuadrado->largo."<br>");

	$resArea = $objCuadrado->calcularArea();

	echo("<br>Area del cuadrado:".$resArea."<br>");

	$resPerimetro = $objCuadrado->calcularPerimetro();

	echo("<br>Perimetro del cuadrado:".$resPerimetro."<br>");

	$objCuadrado->largo = 10;

	echo("<br>Largo del cuadrado:".$objCuadrado->largo."<br>");

	$resArea = $objCuadrado->calcularArea();

	echo("<br>Area del cuadrado:".$resArea."<br>");

	$resPerimetro = $objCuadrado->calcularPerimetro();

	echo("<br>Perimetro del cuadrado:".$resPerimetro."<br>");

	echo("<br>Grosor del cuadrado:".$objCuadrado->grosor."<br>");

	echo("<br>Color del cuadrado:".$objCuadrado->devolverColor()."<br>");

	echo("<br>Angulo del cuadrado:".$objCuadrado->devolverAngulo()."<br>");



	$objCuadraDos = new cuadrado(7,2,"Verde");

	echo("<hr>");
	echo("<br>Largo del cuadrado 2:".$objCuadraDos->largo."<br>");
	echo("<br>Grosor del cuadrado 2:".$objCuadraDos->grosor."<br>");
	echo("<br>Perimetro del cuadrado 2:".$objCuadraDos->calcularPerimetro()."<br>");
	echo("<hr>");
	
	echo("Area Cudrado 1:".$objCuadrado->calcularArea()." - VS - Area del cuadrado 2:".$objCuadraDos->calcularArea());	
	echo("<hr>");



	$objRectangulo = new rectangunlo(0,0,0);

	$objRectangulo->largo = 10;
	$objRectangulo->ancho = 5;
	echo("<hr>");
	echo("<br>Largo del Rectangulo :".$objRectangulo->largo."<br>");
	echo("<br>Ancho del Rectangulo :".$objRectangulo->ancho."<br>");
	echo("<br>Perimetro del Rectangulo :".$objRectangulo->calcularPerimetro()."<br>");
	echo("<br>Angulos del Rectangulo :".$objRectangulo->devolverAngulo()."<br>");



?>


















