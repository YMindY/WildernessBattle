<?php
namespace WildernessBattle\abstractc;

use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;

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
    public function getLanguage(){
       $conf=new Config($this->getDataFolder()."lauguage.yml",Config::YAML,array("PluginLanguage"=>"eng"));
       return $conf->get("PluginLanguage");
    }
    public function getMessage($kind){
       return $this->PluginMessage[$this->getLanguage()][$kind];
    }
        //多语言消息
    public $PluginMessage = [
       "eng" => ["log"=>["Plugin system started to load",
                       "Module system is loading",
                       "Module system has finished loading. Timeconsuming: ",
                       "Command system is loading",
                       "Command system has finished loading. Timeconsuming: ",
                       "Plugin system has finished loading. Timeconsuming: ",
                       "| WildernessBattle | Enabled! author: xMing",
                       "| WildernessBattle | Disabled.",
                       "| WildernessBattle | is Loading..."
                      ],
               "cmd"=>["room"=>[
                               ],
                       "game"=>[
                               ]
                      ]
              ],
       "chs" => ["log"=>["插件系统开始加载",
                       "模块系统加载中",
                       "模块系统加载完毕，耗时: ",
                       "指令系统加载中",
                       "指令系统加载完毕，耗时: ",
                       "插件系统加载完毕，耗时: ",
                       "| 荒野大逃杀 | 已启动! 作者: xMing",
                       "| 荒野大逃杀 | 已关闭",
                       "| 荒野大逃杀 | 正在加载中...",
                      ],
               "cmd"=>["room"=>[
                               ],
                       "game"=>[
                               ]
                      ]
              ]
    ];
}