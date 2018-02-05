<?php


namespace Eagle\Plugins;

use Phalcon\Di;
use Phalcon\Events\Manager as EventsManager;

/**
 * Class Loader
 * @package Eagle\Plugins
 */

class Loader {

	/** @var EventsManager */

	protected $eventsManager;

	/** @var Di */

	protected $depencyInjector;

	/**
	 * Loader constructor.
	 *
	 * @param EventsManager $eventsManager
	 */

	public function __construct(EventsManager $eventsManager, Di $depencyInjector) {

		$this->eventsManager = $eventsManager;
		$this->dependencyInjector = $depencyInjector;
	}

}