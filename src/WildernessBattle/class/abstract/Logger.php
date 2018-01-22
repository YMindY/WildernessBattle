<?php
namespace WildernessBattle\class\abstract;

use pocketmine\plugin\PluginBase;

//继承了PluginBase的初始化类
abstract class Logger extends PluginBase {
	 public function onEnable() {
	    $this->Log("| WildernessBattle | Enabled by xMing,(somebody)...","n");
 	}
	public function onLoad() {
    	$this->Log("| WildernessBattle | is Loading...","i");
 	}
	public function onDisable() {
    	$this->Log("| WildernessBattle | Disabled.","n");
 	}
	//更加方便的控制台显示
   public function Log($text,$mode) {
       switch($mode){
       case "i":
          $this->getLogger()->info($text);
       break;
       case "w":
          $this->getLogger()->warning($text);
       break;
       case "e":
          $this->getLogger()->error($text);
       break;
       case "n":
          $this->getLogger()->notice($text);
       break;
       }
    } 
   //获取主类
   public static function getOwn() {}
}