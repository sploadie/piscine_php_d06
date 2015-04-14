<?php
require_once 'Color.class.php';
Class Vertex {
	public static $verbose = FALSE;
	private $_x = 0;
	private $_y = 0;
	private $_z = 0;
	private $_w = 1.0;
	private $_color;

/*
$unitX = new Vertex( array( 'x' => 1.0, 'y' => 0.0, 'z' => 0.0, 'color' => $green ) );
$unitY = new Vertex( array( 'x' => 0.0, 'y' => 1.0, 'z' => 0.0, 'color' => $red   ) );
$unitZ = new Vertex( array( 'x' => 0.0, 'y' => 0.0, 'z' => 1.0, 'color' => $blue  ) );

print( $unitX . PHP_EOL );
print( $unitY . PHP_EOL );
print( $unitZ . PHP_EOL );

Vertex::$verbose = False;

$sqrA = new Vertex( array( 'x' => 0.0, 'y' => 0.0, 'z' => 0.0 ) );
$sqrB = new Vertex( array( 'x' => 4.2, 'y' => 0.0, 'z' => 0.0 ) );
$sqrC = new Vertex( array( 'x' => 4.2, 'y' => 4.2, 'z' => 0.0 ) );
$sqrD = new Vertex( array( 'x' => 0.0, 'y' => 4.2, 'z' => 0.0 ) );

print( $sqrA . PHP_EOL );
print( $sqrB . PHP_EOL );
print( $sqrC . PHP_EOL );
print( $sqrD . PHP_EOL );

$A = new Vertex( array( 'x' => 3.0, 'y' => 3.0, 'z' => 3.0 ) );
print( $A . PHP_EOL );
$equA = new Vertex( array( 'x' => 9.0, 'y' => 9.0, 'z' => 9.0, 'w' => 3.0 ) );
*/

	public function __construct( array $input ) {
		//Default Color
		$this->_color = new Color( array( 'rgb' => 0xffffff ) );
		//Set values from input
		if (array_key_exists('x', $input)) { $this->_x = floatval($input['x']); }
		if (array_key_exists('y', $input)) { $this->_y = floatval($input['y']); }
		if (array_key_exists('z', $input)) { $this->_z = floatval($input['z']); }
		if (array_key_exists('w', $input)) { $this->_w = floatval($input['w']); }
		//Set color if actually color
		if (array_key_exists('color', $input) && ($input['color'] instanceof Color)) {
			$this->_color = $input['color'];
		}
		//Verbose
		if (self::$verbose)
			print($this . " constructed\n");
		return ;
	}

	public function __destruct() {
		if (self::$verbose)
			print ($this . " destructed\n");
		return ;
	}

	public function __toString() {
		$s = "Vertex( x: " . number_format($this->getX(), 2, '.', '');
		$s = $s  . ", y: " . number_format($this->getY(), 2, '.', '');
		$s = $s  . ", z:" . number_format($this->getZ(), 2, '.', '');
		$s = $s  . ", w:" . number_format($this->getW(), 2, '.', '');
		if (self::$verbose)
			$s = $s . ", " . $this->getColor() . " )";
		else
			$s = $s . " )";
		return $s;
	}

	public function setX( $x ) { $this->_x = floatval($x); }
	public function setY( $y ) { $this->_y = floatval($y); }
	public function setZ( $z ) { $this->_z = floatval($z); }
	public function setW( $w ) { $this->_w = floatval($w); }

	public function getX() { return $this->_x; }
	public function getY() { return $this->_y; }
	public function getZ() { return $this->_z; }
	public function getW() { return $this->_w; }

	public function setColor( Color $color ) { $this->_color = $color; }

	public function getColor() { return $this->_color; }

	public static function doc() {
		return file_get_contents("./Vertex.doc.txt");
	}
}
?>