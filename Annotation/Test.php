<?php
namespace Azera\Lab\Annotation;

/**
 * @Annotation
 * @Target({ "METHOD" })
 */
class Test {

	/**
	 * @var string
	 * @Required
	 */
	public $name;

	/**
	 * @var integer
	 */
	public $scale;

	/**
	 * @var string
	 */
	public $description;

}
?>