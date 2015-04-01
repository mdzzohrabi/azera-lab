<?php
namespace Azera\Lab;

class Test {

	private $name;
	private $test;
	private $scale = 1;
	private $executeTime;
	private $executeMemory;

	function __construct( $name , $test , $scale = 1 ) {

		$this->name = $name;
		$this->test = $test;
		$this->scale = $scale;

	}

	function run() {

		$memory = memory_get_usage();
		$time = microtime( true );
		for ( $i = 0 ; $i < $this->scale ; $i++ )
			call_user_func( $this->test );
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

}
?>