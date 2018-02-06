<?php

namespace SuperEasyPlugin;

use Eagle\Plugins\PluginInterface;


class SuperEasyPlugin implements PluginInterface {


	public function getConfiguration() {
		// TODO: Implement getConfiguration() method.

		return new \Phalcon\Config([]);
	}
}