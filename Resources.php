<?php
	declare(strict_types=1);

	final class Resources {
	
		private static $instance = null;
		private $fileName;
		private $fileStream;
		private $constants;
		
		private function __construct()
		{
			$this->fileName = "Constants.json";
			$this->fileStream = fopen($this->fileName, "r+") or die("Unable to open/create file");
			$this->constants = json_decode(fread($this->fileStream, filesize($this->fileName)), true);
		}

		public function getLength(): int {return $this->constants["length"];}
		
		public function getDigits(): int {return $this->constants["digits"];}
		
		public function getCapitals(): int {return $this->constants["capitals"];}
		
		public function getLowers(): int {return $this->constants["lowers"];}
		
		public function getSpecials(): int {return $this->constants["specials"];}
		
		static function getInstance(): Resources {
			self::$instance = self::$instance == null?
				new Resources() : self::$instance;
			
			return self::$instance;
		}
	
		public function __destruct() {fclose($this->fileStream);}
	}
?>