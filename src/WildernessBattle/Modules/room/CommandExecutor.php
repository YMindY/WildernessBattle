<?php
namespace WildernessBattle\Modules\room;

use WildernessBattle\Main;

use pocketmine\command\CommandSender;

class CommandExecutor{
	  private $room;
   	private $main;
   	public function __construct(Main $main){
	     	$this->main=$main;
   	}
   	public function runCommand(CommandSender $sender,array $args){
   	   if(!isset($args[2])){
   	      $sender->sendMessage("usage: /ymwb room [add/remove/info]");
   	      return false;
   	   }
   	   switch($args[2]){
   	      case "add":
   	         if(count($args)<5){
   	            $sender->sendMessage("");
   	         }
          break;
          case "remove":
          break;
          case "info":
          break;
          case "set":
          break;
          case "quit":
   	      break;
   	      case "end":
   	      break;
          default:
   	         $sender->sendMessage("usage: /ymwb room [add/remove/info]");
   	         return false;
   	   }
   	}
}