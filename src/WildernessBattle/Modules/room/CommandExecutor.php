<?php
namespace WildernessBattle\Modules\room;

use WildernessBattle\Main;

use pocketmine\command\CommandSender;
use pocketmine\utils\Config;
use pocketmine\event\Listener;

use pocketmine\event\player\PlayerInteractEvent;

class CommandExecutor implements Listener{
   	private $room;
   	private $main;
   	public function __construct(Main $main){
	     	$this->main=$main;
   	}
   	public function onClickBlock(PlayerInteractEvent $e){
   	   $p=$e->getPlayer();
   	   if(isset($this->{$p->getName()})){
   	      if($this->{$p->getName()}["state"]=="wait"){
   	         if($e->getBlock()->getID()==54){
   	            $list=$this->{$p->getName()};
   	            $conf=$this->createConfig("r".$list["id"]);
   	            $che=$conf->get("Chests");
   	            $b=$e->getBlock();
   	            if(!in_array($b->getX().":".$b->getY().":".$b->getZ(),$che)){
   	               $che[]=$b->getX().":".$b->getY().":".$b->getZ();
   	               $conf->set("Chests",$che);
   	               $conf->save();
   	               $p->sendMessage(str_replace("&d",count($che),$this->getMessage(12)));
   	               $e->setCancelled();
   	               unset($conf);
   	               unset($che);
   	            }else{
   	               $p->sendMessage($this->getMessage(13));
   	               $e->setCancelled();
   	            }
   	            unset($list);
   	            unset($b);
   	            unset($p);
   	         }
   	      }
   	   }
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
   	         $this->createConfig("r".$id,array("id"=>$id,"waitPlace"=>"x:x:x:x","pos"=>"x:x:x:x","range"=>$args[2],"MaxPlayer"=>$args[3],"Chests"=>array()));
   	         $sender->sendMessage(str_replace(array("&1","&2","&3"),array($id,$args[2],$args[3]),$this->getMessage(2)));
   	         $this->{$sender->getName()}=array("id"=>$id,"state"=>"add");
   	         unset($id);
   	         return true;
          break;
          case "remove":
             if($this->checkArg2("remove",$args,$sender)){
                return false;
             }
             unlink($this->getDataFolder()."r".$args[2]);
             $rl=RoomManager::getModule()->config->get("RoomList");
             $rc=RoomManager::getModule()->config->get("RoomCount");
             $rl=$this->removeArrItembyValue($rl,"r".$arg[2]);
             $rc--;
             RoomManager::getModule()->config->set("RoomList",$rl);
             RoomManager::getModule()->config->set("RoomCount",$rc);
             RoomManager::getModule()->config->save();
             unset($rl);
             unset($rc);
             return true;
          break;
          case "info":
             if($this->checkArg2("info",$args,$sender)){
                return false;
             }
             $ri=$this->createConfig("r".$args[2])->getAll();
             $sender->sendMessage(str_replace(array("&pos","&range","&mp","&wp"),array($ri["pos"],$ri["range"],$ri["MaxPlayer"],$ri["waitPlace"]),$this->getMessage(5)));
             unset($ri);
             return true;
          break;
          case "cen":
             if(!$this->isSettingPlayer($sender)){
                return false;
             }
             $conf=$this->createConfig("r".$this->{$sender->getName()}["id"]);
             $player=$this->main->getServer()->getPlayer($sender->getName());
             $conf->set("pos",$player->getLevel()->getName().":".$player->getX().":".$player->getZ());
             $conf->save();
             $sender->sendMessage($this->getMessage(8));
             $this->{$sender->getName()}["state"]="cen";
             unset($conf);
             unset($player);
             return true;
          break;
          case "wait":
             if(!$this->isSettingPlayer($sender)){
                return false;
             }
             $conf=$this->createConfig("r".$this->{$sender->getName()}["id"]);
             $player=$this->main->getServer()->getPlayer($sender->getName());
             $conf->set("waitPlace",$player->getLevel()->getName().":".$player->getX().":".$player->getZ());
             $conf->save();
             $sender->sendMessage($this->getMessage(9));
             $this->{$sender->getName()}["state"]="wait";
             unset($conf);
             unset($player);
             return true;
          break;
          case "quit":
             if(!$this->isSettingPlayer($sender)){
                return false;
             }
             unlink($this->getDataFolder()."r".$this->{$sender->getName()}["id"]);
             unset($this->{$sender->getName()});
             $sender->sendMessage($this->getMessage(7));
             return false;
   	      break;
   	      case "end":
   	         if(!$this->isSettingPlayer($sender)){
                return false;
             }
             $conf=$this->createConfig("r".$this->{$sender->getName()}["id"]);
             $player=$this->main->getServer()->getPlayer($sender->getName());
             if($conf->get("pos")=="x:x:x:x" || $conf->get("waitPlace")=="x:x:x:x" || count($conf->get("Chests"))<1){
                unset($this->{$sender->getName()});
                $sender->sendMessage($this->getMessage(10));
                return false;
             }
             $id=RoomManager::getModule()->config->get("RoomCount")+1;
             RoomManager::getModule()->config->set("RoomCount",$id);
   	         $rl=RoomManager::getModule()->config->get("RoomList");
   	         $rl[]="r".$id;
   	         RoomManager::getModule()->config->set("RoomList",$rl);
   	         RoomManager::getModule()->config->save();
   	         $sender->sendMessage($this->getMessage(11));
   	         return true;
   	      break;
          default:
   	         $sender->sendMessage($this->getMessage(0));
   	         return false;
   	   }
   	}
   	private function getMessage($key){
   	   return $this->main->getMessage("cmd")["room"][$key];
   	}
   	private function createConfig($file,array $args=[]){
   	   return new Config($this->main->getDataFolder()."room/rooms/".$file,Config::YAML,$args);
   	}
   	private function getDataFolder(){
   	   return ($this->main->getDataFolder()."room/rooms/");
   	}
   	private function removeArrItembyValue(array $arr,$value){
   	   return array_merge(array_diff($arr, array($value)));
   	}
   	private function checkArg2($cmd,array $args,$sender):bool{
   	   if(!isset($args[2]) || !is_numeric($args[2])){
          $sender->sendMessage(str_replace("&cmd",$cmd,$this->getMessage(3)));
          return true;
       }
       if(!in_array("r".$args[2],RoomManager::getModule()->config->get("RoomList"))){
          $sender->sendMessage($this->getMessage(4));
          return true;
       }
       return false;
   	}
   	private function isSettingPlayer($sender){
   	   if(!isset($this->{$sender->getName()})){
   	      $sender->sendMessage($this->getMessage(6));
   	      return false;
   	   }
   	   return true;
   	}
}