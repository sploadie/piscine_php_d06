<?php
require_once 'Vertex.class.php';
Class Vector {
	private $_x = 0.0;
	private $_y = 0.0;
	private $_z = 0.0;
	private $_w = 0.0;
	public static $verbose = FALSE;

	public function __construct( array $input ) {
		if (array_key_exists('orig', $input))
			$orig = $input['orig'];
		else
			$orig = new Vertex( array( 'x' => 0.0, 'y' => 0.0, 'z' => 0.0 ) );
		if (!array_key_exists('dest', $input))
			trigger_error("Fatal error:\nVector instance created without dest:\n" . var_dump($input), E_USER_ERROR);
		$this->_x = $input['dest']->getX() - $orig->getX();
		$this->_y = $input['dest']->getY() - $orig->getY();
		$this->_z = $input['dest']->getZ() - $orig->getZ();
		if (self::$verbose)
			print($this." constructed\n");
		return ;
	}

	public function __destruct() {
		if (self::$verbose)
			print($this." destructed\n");
		return ;
	}

	public function __toString() {
		$s = "Vector( x:" . number_format($this->getX(), 2, '.', '');
		$s = $s  . ", y:" . number_format($this->getY(), 2, '.', '');
		$s = $s  . ", z:" . number_format($this->getZ(), 2, '.', '');
		return $s. ", w:" . number_format($this->getW(), 2, '.', '') . " )";
	}

	public function opposite() {
		return (new Vector( array( 'dest' => new Vertex( array(
			'x' => $this->getX() * -1,
			'y' => $this->getY() * -1,
			'z' => $this->getZ() * -1)
		))));
	}

	public function dotProduct(Vector $rhs) {
		return ($this->getX() * $rhs->getX() + $this->getY() * $rhs->getY() + $this->getZ() * $rhs->getZ());
	}

	public function scalarProduct($k) {
		return (new Vector( array( 'dest' => new Vertex( array(
			'x' => $this->getX() * $k,
			'y' => $this->getY() * $k,
			'z' => $this->getZ() * $k)
		))));
	}

	public function magnitude() {
		return sqrt($this->getX() * $this->getX() + $this->getY() * $this->getY() + $this->getZ() * $this->getZ());
	}

	public function normalize() {
		$norme = $this->magnitude();
		$normalised = new Vertex( array(
			'x' => $this->getX() / $norme,
			'y' => $this->getY() / $norme,
			'z' => $this->getZ() / $norme)
		);
		return (new Vector( array( 'dest' => $normalised ) ));
	}

	public function cos($rhs) {
		$ret = $this->dotProduct($rhs) / $this->magnitude() / $rhs->magnitude();
		return ($ret);
	}

	public function crossProduct(Vector $rhs) {
		return (new Vector(array('dest' => (new Vertex (array(
			'x' => $this->getY() * $rhs->getZ() - $this->getZ() * $rhs->getY(),
			'y' => $this->getZ() * $rhs->getX() - $this->getX() * $rhs->getZ(),
			'z' => $this->getX() * $rhs->getY() - $this->getY() * $rhs->getX())
		)))));
	}

	public function add(Vector $rhs) {
		return (new Vector( array( 'dest' => new Vertex( array(
			'x' => $this->getX() + $rhs->getX(),
			'y' => $this->getY() + $rhs->getY(),
			'z' => $this->getZ() + $rhs->getZ())
		))));
	}

	public function sub(Vector $rhs) {
		return (new Vector( array( 'dest' => new Vertex( array(
			'x' => $this->getX() - $rhs->getX(),
			'y' => $this->getY() - $rhs->getY(),
			'z' => $this->getZ() - $rhs->getZ())
		))));
	}

	
	public function getX() { return $this->_x; }
	public function getY() { return $this->_y; }
	public function getZ() { return $this->_z; }
	public function getW() { return $this->_w; }

	public static function doc() {
		return file_get_contents("./Vector.doc.txt");
	}
}
?>