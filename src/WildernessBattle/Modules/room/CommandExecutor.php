<?php
namespace WildernessBattle\Modules\room;

use WildernessBattle\Main;

use pocketmine\command\CommandSender;
use pocketmine\utils\Config;

class CommandExecutor{
	  private $room;
   	private $main;
   	public function __construct(Main $main){
	     	$this->main=$main;
   	}
   	public function runCommand(CommandSender $sender,array $args){
   	   if(!isset($args[1])){
   	      $sender->sendMessage($this->getMessage(0));
   	      return false;
   	   }
   	   switch($args[1]){
   	      case "add":
   	         if(count($args)<4 || !is_numeric($args[2]) || !is_numeric($args[3])){
   	            $sender->sendMessage($this->getMessage(1));
   	            return false;
   	         }
   	         $id=RoomManager::getModule()->config->get("RoomCount")+1;
   	         RoomManager::getModule()->config->set("RoomCount",$id);
   	         $rl=RoomManager::getModule()->config->get("RoomList");
   	         $rl[]="r".$id;
   	         RoomManager::getModule()->config->set("RoomList",$rl);
   	         RoomManager::getModule()->config->save();
   	         $conf=$this->createConfig("r".$id,array("id"=>$id,"range"=>$args[2],"MaxPlayer"=>$args[3],"Chests"=>array()));
   	         $sender->sendMessage(str_replace(array("&1","&2","&3"),array($id,$args[2],$args[3]),$this->getMessage(2)));
   	         unset($id);
   	         unset($conf);
   	         unset($rl);
   	         return true;
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
   	         $sender->sendMessage($this->getMessage(0));
   	         return false;
   	   }
   	}
   	private function getMessage($key){
   	   return $this->main->getMessage("cmd")["room"][$key];
   	}
   	private function createConfig($file,array $args){
   	   return new Config($this->main->getDataFolder()."room/rooms/".$file,Config::YAML,$args);
   	}
}