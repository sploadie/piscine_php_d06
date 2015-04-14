<?php
Class Color {
	public static $verbose = FALSE;
	public $red = 0;
	public $green = 0;
	public $blue = 0;

	public function __construct( array $input ) {
		if (array_key_exists('rgb', $input))
		{
			$this->red = ($input['rgb'] >> 16) & 0xFF;
			$this->green = ($input['rgb'] >> 8) & 0xFF;
			$this->blue = $input['rgb'] & 0xFF;
		}
		else if (array_key_exists('red', $input) && array_key_exists('green', $input) && array_key_exists('blue', $input))
		{
			$this->red = intval($input['red']);
			$this->green = intval($input['green']);
			$this->blue = intval($input['blue']);
		}
		if (self::$verbose)
			print($this . " constructed.\n");
		return ;
	}

	public function __destruct() {
		if (self::$verbose)
			print ($this . " destructed.\n");
		return ;
	}

	public function __toString() {
		return "Color( red: " . sprintf("% 3d", $this->red) . ", green: " . sprintf("% 3d", $this->green) . ", blue: " . sprintf("% 3d", $this->blue) . " )";
	}

	public function add(Color $added) {
		$new_color = new Color( array('red' => $this->red + $added->red, 'green' => $this->green + $added->green, 'blue' => $this->blue + $added->blue));
		// if (self::$verbose)
		// 	print($new_color . "\n");
		return $new_color;
	}

	public function sub(Color $subtracted) {
		$new_color = new Color( array('red' => $this->red - $subtracted->red, 'green' => $this->green - $subtracted->green, 'blue' => $this->blue - $subtracted->blue));
		// if (self::$verbose)
		// 	print($new_color . "\n");
		return $new_color;
	}

	public function mult($factor) {
		$new_color = new Color( array('red' => $this->red * $factor, 'green' => $this->green * $factor, 'blue' => $this->blue * $factor));
		// if (self::$verbose)
		// 	print($new_color . "\n");
		return $new_color;
	}

	public static function doc() {
		return file_get_contents("./Color.doc.txt");
	}
}
?>