<?php


namespace Eagle\Plugins;

use Phalcon\Di;
use Phalcon\Config;
use Eagle\Plugins\Loader\Exception;
use Phalcon\Events\Manager as EventsManager;

/**
 * Class Loader
 * @package Eagle\Plugins
 */

class Loader {

	/** @var PluginInterface[] */

	private $plugins = [];

	/** @var EventsManager */

	protected $eventsManager;

	/** @var Di */

	protected $dependencyInjector;

	/**
	 * Loader constructor.
	 *
	 * @param EventsManager $eventsManager
	 */

	public function __construct(EventsManager $eventsManager, Di $depencyInjector) {

		$this->eventsManager = $eventsManager;
		$this->dependencyInjector = $depencyInjector;
	}

	/**
	 * Load plugin into application factory
	 *
	 * @param PluginInterface $plugin
	 */

	public function loadPlugins() {

		$config = $this->dependencyInjector->get('config');

		if(!$config instanceof Config)
			throw new Exception('Configuration file must be instance of \Phalcon\Config.');

		$plugins = $config->get('plugins');

		if(!is_null($plugins)) {

			foreach($plugins as $plugin) {

				if(!class_exists($plugin))
					throw new Exception('Plugin class `' . $plugin . '` doesn\'t exist.');

				$plugin = new $plugin;

				if(!$plugin instanceof PluginInterface)
					throw new Exception('Plugin class `' . $plugin . '` must be instance of ' . PluginInterface::class . '.');

				$this->plugins[] = $plugin;
			}
		}
	}

	public function getEventsManager() {

		return $this->eventsManager;
	}

	public function getPlugins(){

		return $this->plugins;
	}

}