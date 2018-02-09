<?php
namespace WildernessBattle\Modules\room;

use WildernessBattle\Main;
use WildernessBattle\abstractc\Module;

use pocketmine\utils\Config;

class RoomManager extends Module{
   public $name;
   protected $listeners = [];
   private static $own;
   public $config;
      private function createMuduleConfig(){
      return new Config($this->main->getDataFolder()."room/Config.yml",Config::YAML,array("RoomCount"=>0,"RoomList"=>array()));
   }
   public function enable(){
      $this->name=$this->main->getMessage("mod")[1];
      $this->registerListeners();
      $this->config=$this->createMuduleConfig();
      self::$own=$this;
      parent::enable();
   }
   public static function getModule(){
      return self::$own;
   }
   public static function getDataFolder(){
      return self::$own->main->getDataFolder()."room/";
   }
}