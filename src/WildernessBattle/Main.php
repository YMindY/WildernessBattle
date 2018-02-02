<?php
/**
* Copyright (c) 2017-2018 YMind&xMing All right Reserved.
* 作者: xMing
* 写于2018.1.23
**/
namespace WildernessBattle;

use WildernessBattle\abstractc\RegisterModules;

class Main extends RegisterModules {
   public function onLoad(){
      $this->Log("| WildernessBattle | is Loading...","n");
   }
   public function onEnable(){
      $this->CreateConfig();
      $this->registerClass();
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