<?php

namespace ShadowMikado\CustomSize\command;

use CortexPE\Commando\args\FloatArgument;
use CortexPE\Commando\args\RawStringArgument;
use CortexPE\Commando\BaseCommand;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;
use ShadowMikado\CustomSize\Main;

class size extends BaseCommand
{

    public function onRun(CommandSender $sender, string $aliasUsed, array $args): void
    {

        if (!$sender->hasPermission("size.cmd")) {
            $this->sendError(1);
            return;
        }

        if (!isset($args["size"])) {
            $this->sendUsage();
            return;
        }

        if (!$sender instanceof Player) {
            $this->sendError(2);
            return;
        }

        if (!isset($args["player"])) {
            $sender->setScale($args["size"]);
            $sender->sendMessage(
                str_replace("{size}", $args["size"], Main::$config->getNested("messages.success.without_target"))
            );
            return;
        }

        if (isset($args["player"])) {
            $target = $sender->getServer()->getPlayerExact($args["player"]);

            if (!$target instanceof Player) {
                $this->sendError(3);
                return;
            }
            $target->setScale($args["size"]);
            $sender->sendMessage(
                str_replace(["{target}", "{size}"], [$target->getName(), $args["size"]], Main::$config->getNested("messages.success.with_target"))
            );
            return;
        }

    }

    public function getPermission()
    {
        // TODO: Implement getPermission() method.
    }

    protected function prepare(): void
    {

        /** Error Codes:
         * No Permission: 1
         * Sender not Player: 2
         * Target not exists: 3
         */
        $this->registerArgument(0, new FloatArgument("size", true));
        $this->registerArgument(1, new RawStringArgument("player", true));
        $this->setPermission("size.cmd");
        $this->setErrorFormat(1, Main::$config->getNested("messages.sender_no_permission"));
        $this->setErrorFormat(2, Main::$config->getNested("messages.sender_not_player"));
        $this->setErrorFormat(3, Main::$config->getNested("messages.target_not_exists"));
    }
}