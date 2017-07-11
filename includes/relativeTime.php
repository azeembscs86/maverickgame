<?php

class RelativeTime{

	// The period names
	private $names = array('second','minute','hour','day','week','month','year');

	// How many of the previous period are contained in the next
	private $divisions = array(1,60,60,24,7,4.34,12); 

	private $time = NULL;

	public function __construct($timestr = NULL){
		// You can pass a timestamp when constructing an object
		$this->timestampFromString($timestr);
	}

	public function getOffsetFrom($timestr = NULL){

		// This method calculates the relative string

		$this->timestampFromString($timestr);

		if(is_null($this->time)){
			throw new Exception("Timestamp not specified!");
		}

		$time = $this->time;
		$name = "";

		if($time < 10){
			return "just now";
		}

		for($i=0; $i<count($this->divisions); $i++){
			if($time < $this->divisions[$i]) break;

			$time = $time/$this->divisions[$i];
			$name = $this->names[$i];
		}

		$time = round($time);

		if($time != 1){
			$name.= 's';
		}

		return "$time $name ago";
	}

	public function __toString(){

		// __toString cannot throw exceptions

		try{
			return $this->getOffsetFrom();
		}
		catch(Exception $e){
			return $e->getMessage();
		}
	}

	private function timestampFromString($time){

		if(is_numeric($time)){
			// a unix timestamp (number of seconds since 1st Jan 1970)
			$this->time = time() - $time;
		}
		else if(is_string($time)){
			// a string timestamp
			$this->time = time() - strtotime($time);
		}
	}
}