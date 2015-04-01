<?php
namespace Azera\Lab\Annotation;

use Azera\Annotation\Annotation as AnnotationReader;
use Doctrine\Common\Annotations\AnnotationRegistry;

class Reader extends AnnotationReader {

	public static function registerNamespace( $ns , $path ) {

		AnnotationRegistry::registerAutoloadNamespace( $ns , $path );

	}

	public static function registerFile( $file ) {
		
		AnnotationRegistry::registerFile( $file );

	}

}
?>