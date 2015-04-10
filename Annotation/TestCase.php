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

	/**
	 * @var string
	 */
	public $timePattern = '%.4f s';

	/**
	 * @var boolean
	 */
	public $markdown = false;

}
?>