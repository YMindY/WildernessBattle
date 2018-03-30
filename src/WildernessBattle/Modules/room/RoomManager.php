<?php
namespace WildernessBattle\Modules\room;

//插件内部主要引用
use WildernessBattle\Main;
use WildernessBattle\abstractc\Module;

//内部监听器引用
use WildernessBattle\Modules\room\CommandExecutor;

//pm引用
use pocketmine\utils\Config;

class RoomManager extends Module{
	  /*继承到的变量:
	    $main 插件主类
	    $status 模块状态
	  */
	  //模块名称
   public $name;
   //存储此模块的监听器，便于注册
   protected $listeners = [];
   protected $listenerNames = [];
   //用于返回$this实例
   private static $own;
   //模块主配置文件
   public $config;
   //创建(初始化)模块主配置文件
   private function createMuduleConfig(){
      return new Config($this->main->getDataFolder()."room/Config.yml",Config::YAML,array("RoomCount"=>0,"RoomList"=>array()));
   }

   //模块启动执行项
   public function enable(){
      $this->name=$this->main->getMessage("mod")[1];
      $this->fillListeners();
      $this->registerListeners();
      $this->config=$this->createMuduleConfig();
      self::$own=$this;
      parent::enable();
   }
   //返回实例$this
   public static function getModule(){
      return self::$own;
   }
   //返回模块配置文件夹路径
   public static function getDataFolder(){
      return self::$own->main->getDataFolder()."room/";
   }
   private function fillListeners(){
      $this->listeners[]=$this->main->getExecutor("room");
      foreach($this->listenerNames as $n){
         $this->listeners[]=new $n($this->main);
      }
   }
}