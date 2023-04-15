<?php
#/*
# ╔═══╗ ╔════╗ ╔════╗ ╔╗ ╔╗ ╔════╗ ╔═══╗  ╔════╗  ╔═════╗╔═════╗
# ║╔══╝ ║╔═╗ ║ ║╔═══╝ ║║ ║║ ║╔╗╔╗║ ║╔══╝  ║╔═╗ ║  ║ ╔═╗ ║║ ╔═╗ ║
# ║╚══╗ ║╚═╝ ║ ║╚═══╗ ║╚═╝║ ╚╝║║╚╝ ║╚══╗  ║╚═╝ ║  ║ ║ ║ ║║ ║ ║ ║
# ║╔══╝ ║ ╔╗ ║ ╚═══╗║ ╚═║║╝   ║║   ║╔══╝  ║ ╔╗ ║  ║ ║ ║ ╚╝ ║ ║ ║
# ║╚══╗ ║ ║║ ║ ╔═══╝║   ║║    ║║   ║╚══╗  ║ ║║ ║  ║ ║ ╚════╝ ║ ║
# ╚═══╝ ╚═╝╚═╝ ╚════╝   ╚╝    ╚╝   ╚═══╝  ╚═╝╚═╝  ╚═╝        ╚═╝
# discord.gg/easyteam*/
namespace GhostSushi\Loupe;
## discord.gg/easyteam
use GhostSushi\Loupe\Listener\EventListener;
use pocketmine\plugin\PluginBase;## discord.gg/easyteam
use pocketmine\utils\Config;
use pocketmine\utils\SingletonTrait;

class Main extends PluginBase{
    public static Config $config;

    use SingletonTrait;

    protected function onLoad(): void {
        self::setInstance($this);
    }
## discord.gg/easyteam

    public function onEnable(): void
    {
        $this->getResource("config.yml");
        $this->saveDefaultConfig();
        $this->getServer()->getPluginManager()->registerEvents(new EventListener(), $this);
       $this->getServer()->getLogger()->notice("La plugin Loupe de ghost est enable\n§c
  ╔═══╗ ╔════╗ ╔════╗ ╔╗ ╔╗ ╔════╗ ╔═══╗  ╔════╗  ╔═════╗╔═════╗
  ║╔══╝ ║╔═╗ ║ ║╔═══╝ ║║ ║║ ║╔╗╔╗║ ║╔══╝  ║╔═╗ ║  ║ ╔═╗ ║║ ╔═╗ ║
  ║╚══╗ ║╚═╝ ║ ║╚═══╗ ║╚═╝║ ╚╝║║╚╝ ║╚══╗  ║╚═╝ ║  ║ ║ ║ ║║ ║ ║ ║
  ║╔══╝ ║ ╔╗ ║ ╚═══╗║ ╚═║║╝   ║║   ║╔══╝  ║ ╔╗ ║  ║ ║ ║ ╚╝ ║ ║ ║
  ║╚══╗ ║ ║║ ║ ╔═══╝║   ║║    ║║   ║╚══╗  ║ ║║ ║  ║ ║ ╚════╝ ║ ║
  ╚═══╝ ╚═╝╚═╝ ╚════╝   ╚╝    ╚╝   ╚═══╝  ╚═╝╚═╝  ╚═╝        ╚═╝
       discord.gg/easyteam");
    }
    public function onDisable(): void
    {
        $this->getServer()->getLogger()->notice("La plugin Loupe de ghost est disable");
    }
}## discord.gg/easyteam
