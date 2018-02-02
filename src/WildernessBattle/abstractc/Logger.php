<?php
namespace WildernessBattle\abstractc;

use pocketmine\plugin\PluginBase;

//继承了PluginBase的初始化类
abstract class Logger extends PluginBase {
	//更加方便的控制台显示
   public function Log(String $text,$type) {
       switch($type){
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
}