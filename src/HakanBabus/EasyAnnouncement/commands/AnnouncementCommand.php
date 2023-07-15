<?php

namespace HakanBabus\EasyAnnouncement\commands;

use HakanBabus\EasyAnnouncement\EasyAnnouncement;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\lang\Translatable;
use pocketmine\Server;

class AnnouncementCommand extends Command
{
    public function __construct(public EasyAnnouncement $main, public $cmdarray, string $name, Translatable|string $description = "", Translatable|string|null $usageMessage = null, array $aliases = [])
                {
                    parent::__construct($name, $description, $usageMessage, $aliases);
                    $this->setPermission("announcement.command");
                }

                public function execute(CommandSender $sender, string $commandLabel, array $args)
               {
                   if($this->testPermission($sender)){
                       if(isset($args[0])){
                           Server::getInstance()->broadcastMessage(str_replace("{player}", $sender->getName(), $this->cmdarray["prefix"]). implode(" ", $args));
                           if($this->cmdarray["sound"]["enabled"]){
                               foreach (Server::getInstance()->getOnlinePlayers() as $onlinePlayer) {
                                   $this->main->playSound($onlinePlayer->getPosition(), $onlinePlayer);
                               }
                           }
                           return;
                       }
                       $sender->sendMessage($this->getUsage());
                   }
               }
}