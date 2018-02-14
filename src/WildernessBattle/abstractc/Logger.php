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
       //获取插件语言
    public function getLanguage(){
       @$conf=new Config($this->getDataFolder()."lauguage.yml",Config::YAML,array("ChooseOne"=>"eng,chs","PluginLanguage"=>"eng"));
       return $conf->get("PluginLanguage");
    }
       //获取消息
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
               "cmd"=>["room"=>["usage: /ymwb room [add/remove/info]",
                                "usage: /ymwb room add [range(field diameter)] [players maximum number]",
                                "Room configuration creation, id&1, range &2, the maximum number of players &3\nPlease stand on a block as the center of the map and use [/ymwb room cen].",
                                "usage: /ymwb room &cmd [ID]",
                                "There is no room for this!",
                                "The information in the room &id is as follows: \n Center Point: &pos\n range: &range\nMax Player: &mp",
                                "This command cannot be used because you are not setting up a room or you are not doing this step",
                                "You have quit settings, just set the data clear."
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
               "cmd"=>["room"=>["使用方法: /ymwb room [add/remove/info]",//0
                                "使用方法: /ymwb room add [范围(场地直径)] [最大玩家数]",//1
                                '房间配置创建中，id&1，范围&2，最大玩家数&3\n请点击一个方块，作为地图的中心点。',//2
                                "使用方法: /ymwb room &cmd [房间ID]",//3
                                "不存在此房间!",//4
                                "房间&id的信息如下:\n中心点: &pos\n范围: &range\n最大人数: &mp",//5
                                "不能使用这个指令，原因: 你并不在设置房间或你不是在进行这一步骤",//6
                                "你已退出设置，刚刚设置的数据清除。"//7
                               ],
                       "game"=>[
                               ]
                      ]
              ]
    ];
}