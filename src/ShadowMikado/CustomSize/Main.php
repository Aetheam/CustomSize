<?php

namespace ShadowMikado\CustomSize;

use CortexPE\Commando\PacketHooker;
use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;
use pocketmine\utils\SingletonTrait;
use ShadowMikado\CustomSize\command\size;

class Main extends PluginBase implements Listener
{
    use SingletonTrait;

    public static Config $config;

    protected function onLoad(): void
    {
        $this->getLogger()->info("Loading...");
        self::setInstance($this);

    }

    protected function onEnable(): void
    {
        $this->getLogger()->info("Enabling...");

        if (!PacketHooker::isRegistered()) {
            PacketHooker::register($this);
        }
        $this->saveDefaultConfig();
        self::$config = $this->getConfig();

        $this->getServer()->getCommandMap()->register("", new size($this, self::$config->getNested("command.name"), self::$config->getNested("command.description"), self::$config->getNested("command.aliases")));
    }

    protected function onDisable(): void
    {
        $this->getLogger()->info("Disabling...");
    }
}