<?php

declare(strict_types = 1);

namespace Miste\autoupdater;

use pocketmine\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;

class AutoUpdater extends PluginBase{

public $config;

public function onEnable() : void{

	$this->getServer()->getPluginManager()->registerEvents(new EventHandler($this), $this);

	if (!is_dir($this->getDataFolder())){
		mkdir($this->getDataFolder());
	}
	$this->saveResource("config.yml");

	$this->config = new Config($this->getDataFolder() . "config.yml");
	
	}
}
