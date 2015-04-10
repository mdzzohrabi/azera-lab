<?php
namespace Azera\Lab;

use Azera\Core\String;
use Azera\Annotation\Annotation as AnnotationReader;

class TestCase {

	/**
	 * Test Case Name
	 * @var string
	 */
	private $name;

	/**
	 * Default scale
	 * @var integer
	 */
	private $defaultScale = 1;

	/**
	 * @var Azera\Lab\Annotation\TestCase
	 */
	private $annotation;

	/**
	 * Tests
	 * @var Azera\Lab\Test[]
	 */
	private $tests = array();

	function __construct( $name = null ) {

		$this->name = $name;

		$this->prepareAnnotation();

		$this->setUp();

	}

	protected function setUp() {}

	private function prepareAnnotation() {

		Annotation\Reader::registerFile( __DIR__ . '/Annotation/Test.php' );
		Annotation\Reader::registerFile( __DIR__ . '/Annotation/TestCase.php' );
		Annotation\Reader::registerNamespace( 'Azera\Lab\Annotation' , __DIR__ . '/Annotation' );

		$this->annotation = $testCase = AnnotationReader::readClass( $this , Annotation\TestCase::class );

		if ( $testCase )
		{
			$this->name = $testCase->name;
			$this->defaultScale = $testCase->defaultScale;
		}

		foreach ( ( new \ReflectionClass( $this ) )->getMethods() as $method ) {

			if ( $test = AnnotationReader::readMethod( $method , Annotation\Test::class ) ) {
				$this->add( new Test(
						$test->name,
						[ $this , $method->getName() ],
						$test->scale ?: $this->defaultScale,
						$test->description
					) );
			}

		}

	}

	function add( ...$tests ) {

		$this->tests = array_merge( $this->tests , $tests );

	}

	function getTests() {

		$ref = new \ReflectionClass( $this );
		$base = new \ReflectionClass( TestCase::class );
		$tests = array_diff( $ref->getMethods() , $base->getMethods() );

		var_dump( $tests );

	}

	function run() {

		$totalTime = 0;

		$md = $this->annotation->markdown;

		print ( $md ? '# ' : null ) . "Azera Lab v1.0\n";
		print ( $md ? '## ' : null ) . "Case : $this->name\n\n";

		$table = new Console_Table;

		if ( $this->annotation->markdown )
			$table->setBorder( [ 'intersection' => '|' , 'vertical' => '|' , 'horizontal' => '-' ] );

		$table->setHeaders([ 'Test' , 'Scale' , 'Time' , 'Memory' , 'Description' ]);

		foreach ( $this->tests as &$test ) {

			$test->run();

			$table->addRow( [ $test->getName() , $test->getScale() , sprintf( $this->annotation->timePattern , $test->getTime() ) , $test->getMemory() , $test->getDescription() ] );

			$totalTime += $test->getTime();

		}

		$table->addRow( [ '-' , '-' , sprintf( $this->annotation->timePattern , $totalTime ) , '-' , '-' ] );

		print $table->getTable();

	}

	static function runTest() {

		if ( static::class == self::class )
			throw new \RuntimeException( 'Class must extends Azera\Lab\TestCase' );

		$name = String::humanize( String::underscore( static::class ) );

		$case = new static( $name );

		return $case->run();

	}

}
?>