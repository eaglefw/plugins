<?php

require '../vendor/autoload.php';

use Phalcon\Config;
use Phalcon\Di\FactoryDefault;
use Phalcon\Loader as AutoLoader;

try {

	$loader = new AutoLoader();

	$loader->registerDirs([
		__DIR__ . '/plugins'
	]);

	$loader->register();

	/**
	 * Let's start with Dependency Injector
	 */

	$di = new FactoryDefault();

	$config = new Config([
		'plugins' => [
			\SuperEasyPlugin\SuperEasyPlugin::class
		]
	]);
	
	$di->set('config', $config);

	/**
	 * Events manager...
	 */

	$eventsManager = new \Phalcon\Events\Manager();

	/**
	 * ... and Plugin Loader.
	 */

	$pluginLoader = new \Eagle\Plugins\Loader($eventsManager, $di);

	/**
	 * Finally load plugins.
	 */

	$pluginLoader->loadPlugins();

	/**
	 * All is set.
	 *
	 * Create application
	 */

	$application = new \Phalcon\Mvc\Application();

	/**
	 * Now set the events manager...
	 */

	$application->setEventsManager($pluginLoader->getEventsManager());

	var_dump($pluginLoader->getPlugins());

	exit;

} catch (Exception $e) {

	echo $e->getMessage();
}