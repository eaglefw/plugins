<?php

namespace Eagle\Plugins;

use Phalcon\Config;

/**
 * Interface PluginInterface
 * @package Plugins
 */

interface PluginInterface {

	/**
	 * Get plugin configuration
	 *
	 * @return Config
	 */

	public function getConfiguration();

}