<?php
namespace Azera\Lab\Annotation;

/**
 * @Annotation
 * @Target( { "CLASS" } )
 */
class TestCase {
	
	/**
	 * @var string
	 * @Required
	 */
	public $name;

	/**
	 * @var integer
	 */
	public $defaultScale = 1;

}
?>