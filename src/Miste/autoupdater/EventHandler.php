<?php

declare(strict_types = 1);

namespace Miste\autoupdater;

use pocketmine\event\Listener;
use pocketmine\event\server\UpdateNotifyEvent;
use pocketmine\utils\Utils;

class EventHandler implements Listener{

	/** @var AutoUpdater */
	private $plugin;

    public function __construct(AutoUpdater $plugin){
        $this->plugin = $plugin;
    }

    public function onUpdateNotifyEvent(UpdateNotifyEvent $event) : void{
    	$updateInfos = $event->getUpdater()->getUpdateInfo();

        if($this->plugin->config->get("lastUpdateDate") !== $updateInfos["date"]){
            $this->plugin->getLogger()->alert("A new update is available ! " . $updateInfos["base_version"] . " for " . $updateInfos["mcpe_version"]);
            if($this->plugin->config->get("autoUpdate") === true){

                $this->plugin->getLogger()->alert("Preparing the update..");
                $this->plugin->getLogger()->alert("Disabling all the plugins..");

                foreach($this->plugin->getServer()->getPluginManager()->getPlugins() as $plugin){
                    if($plugin->getName() !== "AutoUpdater"){
                        $this->plugin->getServer()->getPluginManager()->disablePlugin($plugin);
                    }
                }
    

                $phar = Utils::getURL($updateInfos["download_url"]);
                file_put_contents($this->plugin->getServer()->getDataPath() . "PocketMine-MP.phar", $phar);

                $this->plugin->config->set("lastUpdateDate", $updateInfos["date"]);
                $this->plugin->config->save(false);
    

                $this->plugin->getServer()->getLogger()->alert("The server has been updated and is now restarting !");
                $this->plugin->getServer()->shutdown();
            }else{
                $this->plugin->getLogger()->alert("If you want to update your software please change autoUpdate in config.yml to true.");
            }
        }
    }
}