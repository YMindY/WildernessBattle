<?php
/**
* Copyright (c) 2017-2018 YMind&xMing All right Reserved.
* 作者: xMing
* 写于2018.1.23
**/
namespace WildernessBattle;

use WildernessBattle\abstractc\CommandManager;

class Main extends CommandManager {
   public function onLoad(){
      $this->Log("| WildernessBattle | is Loading...","n");
   }
   public function onEnable(){
      $this->CreateConfig();	
      $start = microtime(true);
      $this->Log("§a▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼","i");
      $this->Log(">> 插件系统开始加载","n");
      $this->Log("<<<<<<<<<<<<<<<<<<<<<","i");
      $this->registerClass();
      $this->Log("<<<<<<<<<<<<<<<<<<<<<","i");
      $this->registerExecutors();
      $this->Log("[".$this->getName()."]§d插件系统加载完毕, 耗时 [§a".round(microtime(true) - $start,3)."§d] s.","i");
      $this->Log("§a▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲","i");
      $this->Log("| WildernessBattle | is Enabled! author: xMing","n");
   }
   	public function onDisable() {
     	$this->Log("| WildernessBattle | Disabled.","n");
   	}
   	public function CreateConfig(){
      $paths=["","room/","error_logs/"];
      foreach($paths as $path){
    		   if(!is_dir($this->getDataFolder().$path))
    		   mkdir($this->getDataFolder().$path,0777,true);
      }
      unset($paths);
   	}
   	public function getDateT(){
    		return date("Y-m-d H:i:s");
   	}
}