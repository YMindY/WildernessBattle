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
       "eng" => ["log"=>["Plugin system started to load",//0
                       "Module system is loading",//1
                       "Module system has finished loading. Timeconsuming: ",//2
                       "Command system is loading",//3
                       "Command system has finished loading. Timeconsuming: ",//4
                       "Plugin system has finished loading. Timeconsuming: ",//5
                       "| WildernessBattle | Enabled! author: xMing",//6
                       "| WildernessBattle | Disabled.",//7
                       "| WildernessBattle | is Loading..."//8
                      ],
               "mod"=>["Module",//0
                       "RoomModule",//1
                       "GameModule",//2
                       "ToolModule",//3
                       //"DemoModule"
                       "Command",//4
                       "Command Load-Log",//5
                       "Load Failure",//6
                       "Load-Log",//7
                       "Generated log records",//8
                       "Please provide the developer with the log in the folder to the developer"//9
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
               "mod"=>["模块",
                       "房间模块",
                       "游戏模块",
                       "工具模块",
                       //"备用模块"
                       "指令",
                       "指令加载日志",
                       "加载失败",
                       "加载日志",
                       "已生成日志记录",
                       "请提供文件夹中的日志给开发者"
                      ],
               "cmd"=>["room"=>[
                               ],
                       "game"=>[
                               ]
                      ]
              ]
    ];
}