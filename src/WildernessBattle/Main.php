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
   	public function CreateConfig(){
    		if(!is_dir($this->getDataFolder())) mkdir($this->getDataFolder(),0777,true);
    		if(!is_dir($this->getDataFolder()."room/")) mkdir($this->getDataFolder()."room/",0777,true);
   	}
   	public function getDateT(){
    		return date("Y-m-d H:i:s");
   	}
}