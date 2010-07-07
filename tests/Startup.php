<?php
require_once 'PHPUnit/Framework/TestCase.php';

include_once(dirname(__FILE__) . '/../classes/ClassLoader.class.php');

$GLOBALS['ClassLoader'] = new ClassLoader();
$GLOBALS['ClassLoader']->addPath(dirname(__FILE__) . '/../classes');

function __autoload($name) {
	$GLOBALS['ClassLoader']->includeClass($name. '.class.php');
}
?>