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
      $this->Log($this->getMessage("log")[8],"n");
   }
   public function onEnable(){
      $this->CreateConfig();	
      $start = microtime(true);
      $this->Log("\n>>> §a".$this->getMessage("log")[0]."\n","n");
      $this->Log("<<<<<<<<<<<<<<<<<<<<<","i");
      $this->registerClass();
      $this->Log("<<<<<<<<<<<<<<<<<<<<<","i");
      $this->registerExecutors();
      $this->Log("\n>>> §d".$this->getMessage("log")[5]." [§a".round(microtime(true) - $start,3)."§d] s.\n","i");
      $this->Log($this->getMessage("log")[6],"n");
      if($this->getLanguage()=="eng"){
         $this->Log("For Language,the default language is English. If you want to change into Chinese,please write over the config file in\n".$this->getDataFolder()."language.yml","n");
      }
   }
   	public function onDisable() {
     	$this->Log($this->getMessage("log")[7],"n");
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