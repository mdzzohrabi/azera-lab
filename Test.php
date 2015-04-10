<?php
namespace Azera\Lab;

class Test {

	private $name;
	private $test;
	private $scale = 1;
	private $executeTime;
	private $executeMemory;
	private $description;

	function __construct( $name , $test , $scale = 1 , $description = null ) {

		$this->name = $name;
		$this->test = $test;
		$this->scale = $scale;
		$this->description = $description;

	}

	function run() {

		$memory = memory_get_usage();
		$time = microtime( true );
		for ( $i = 0 ; $i < $this->scale ; $i++ )
			call_user_func_array( $this->test , [ $this ] );
		$memory = memory_get_usage() - $memory;
		$time = microtime( true ) - $time;

		$this->executeMemory = $memory;
		$this->executeTime = $time;

	}

	function setScale( $scale ) { $this->scale = $scale; }

	function getScale() { return $this->scale; }

	function getTime () { return $this->executeTime; }

	function getMemory() { return $this->executeMemory; }

	function getName() { return $this->name; }

	function getDescription() { return $this->description; }

	function setDescription( $des )
	{
		$this->description = $des;
	}

}
?>