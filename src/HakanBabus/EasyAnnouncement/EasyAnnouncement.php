<?php

declare(strict_types=1);

namespace HakanBabus\EasyAnnouncement;

use HakanBabus\EasyAnnouncement\commands\AnnouncementCommand;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\lang\Translatable;
use pocketmine\network\mcpe\protocol\PlaySoundPacket;
use pocketmine\player\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\scheduler\ClosureTask;
use pocketmine\Server;
use pocketmine\world\Position;

class EasyAnnouncement extends PluginBase{

    public function onEnable(): void
    {
        $this->saveDefaultConfig();
        if(($ao = $this->getConfig()->get("auto-announcement"))["enabled"]){
            $this->getScheduler()->scheduleRepeatingTask(new ClosureTask(function () use ($ao): void{
                $this->getServer()->broadcastMessage($ao["prefix"].$ao["messages"][array_rand($ao["messages"])]);
                if($ao["sound"]["enabled"]){
                    foreach ($this->getServer()->getOnlinePlayers() as $onlinePlayer) {
                        $this->playSound($onlinePlayer->getPosition(), $onlinePlayer);
                    }
                }
            }), $ao["time"]*20);
        }
        if(($pa = $this->getConfig()->get("player-announcement"))["enabled"]){
            $this->getServer()->getCommandMap()->register(
                "hb", 
                new AnnouncementCommand(
                    $this,
                    $pa,
                    $pa["command-settings"]["name"],
                    $pa["command-settings"]["description"],
                    $pa["command-settings"]["usage"],
                    $pa["command-settings"]["aliases"]
                )
            );
        }
    }
    
    public function onDisable(): void
    {
    
    }

    public function playSound(Position $pos, Player $player)
    {
        $pk = new PlaySoundPacket();
        $pk->soundName = $this->getConfig()->get("sound")[array_rand($this->getConfig()->get("sound"))];
        $pk->volume = 1.0;
        $pk->pitch = 1.0;
        $pk->x = $pos->x;
        $pk->y = $pos->y;
        $pk->z = $pos->z;
        $player->getNetworkSession()->sendDataPacket($pk);
    }

}
