<?php
#/*
# ╔═══╗ ╔════╗ ╔════╗ ╔╗ ╔╗ ╔════╗ ╔═══╗  ╔════╗  ╔═════╗╔═════╗
# ║╔══╝ ║╔═╗ ║ ║╔═══╝ ║║ ║║ ║╔╗╔╗║ ║╔══╝  ║╔═╗ ║  ║ ╔═╗ ║║ ╔═╗ ║
# ║╚══╗ ║╚═╝ ║ ║╚═══╗ ║╚═╝║ ╚╝║║╚╝ ║╚══╗  ║╚═╝ ║  ║ ║ ║ ║║ ║ ║ ║
# ║╔══╝ ║ ╔╗ ║ ╚═══╗║ ╚═║║╝   ║║   ║╔══╝  ║ ╔╗ ║  ║ ║ ║ ╚╝ ║ ║ ║
# ║╚══╗ ║ ║║ ║ ╔═══╝║   ║║    ║║   ║╚══╗  ║ ║║ ║  ║ ║ ╚════╝ ║ ║
# ╚═══╝ ╚═╝╚═╝ ╚════╝   ╚╝    ╚╝   ╚═══╝  ╚═╝╚═╝  ╚═╝        ╚═╝
# discord.gg/easyteam*/
namespace GhostSushi\Loupe\Listener;

use GhostSushi\Loupe\Main;
use pocketmine\entity\animation\TotemUseAnimation;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\event\Listener;
use pocketmine\item\EnderPearl;
use pocketmine\item\GoldenApple;
use pocketmine\item\Potion;
use pocketmine\item\SplashPotion;
use pocketmine\item\VanillaItems;
use pocketmine\player\Player;
use pocketmine\Server;
use pocketmine\world\sound\TotemUseSound;

class EventListener implements Listener{

    private static array $coolDown = [];

    public function onDeath(EntityDamageByEntityEvent $event){
        ## discord.gg/easyteam
            $player = $event->getEntity();
            $damage = $event->getDamager();
            if ($player instanceof Player and $damage instanceof Player){
                if ($damage->getInventory()->getItemInHand()->getId() === Main::getInstance()->getConfig()->get("id-item") & $damage->getInventory()->getItemInHand()->getMeta() === Main::getInstance()->getConfig()->get("meta-item")){
                    if (!isset(self::$coolDown[$damage->getName()]) or self::$coolDown[$damage->getName()] - time() <= 0) {
                        self::$coolDown[$damage->getName()] = time() + Main::getInstance()->getConfig()->get("time-cooldown");

                        $gapple = $this->Gapple($damage);
                        $potions = $this->Pottions($damage);
                        $ender = $this->EnderPerl($damage);
                        $messagelist = Main::getInstance()->getConfig()->get("message-succes");
                        $messagelist = str_replace(["{playerattack}", "{playerdamage}", "{gapple}", "{potions}", "{enderperl}"], [$damage->getName(), $player->getName(), $gapple, $potions, $ender], $messagelist);

                        $message = Main::getInstance()->getConfig()->get("message-player");
                        $message = str_replace(["{playerattack}", "{playerdamage}"], [$damage->getName(), $player->getName()], $message);
                        $damage->sendMessage($messagelist);
                        $player->sendMessage($message);
                        $player->broadcastSound(new TotemUseSound());
                        $player->broadcastAnimation(new TotemUseAnimation($player));
                    }else{
                        $timeRestant = self::$coolDown[$damage->getName()] - time();
                        $minutes = intval(abs($timeRestant / 60));
                        $secondes = intval(abs($timeRestant - $minutes * 60));
                        if ($minutes > 0) {
                            $formatTemp = "$minutes minute(s) et $secondes seconde(s)";
                        } else {
                            $formatTemp = "$secondes seconde(s)";
                        }
                        $messagecooldown = Main::getInstance()->getConfig()->get("message-cooldown");
                        $messagecooldown = str_replace(["{time}"], [$formatTemp], $messagecooldown);
                        $damage->sendMessage($messagecooldown);
                    }
                }
            }
    }

    public function Gapple(Player $entity): int{
        $gapple = 0;
        foreach ($entity->getInventory()->getContents() as $item){
            if ($item instanceof Potion or $item instanceof GoldenApple){
                $gapple += $item->getCount();
            }
        }

        return $gapple;
    }
    public function Pottions(Player $dammager): int{
        $pottion = 0;
        foreach ($dammager->getInventory()->getContents() as $item){
            if ($item instanceof Potion or $item instanceof SplashPotion){
                $pottion += $item->getCount();
            }
        }

        return $pottion;
    }

    public function EnderPerl(Player $damager): int{
        $ender = 0;
        foreach ($damager->getInventory()->getContents() as $item){
            if ($item instanceof Potion or $item instanceof EnderPearl){
                $ender += $item->getCount();
            }
        }

        return $ender;
    }

}