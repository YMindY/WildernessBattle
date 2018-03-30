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
                                "The information in the room &id is as follows: \n Center Point: &pos\n range: &range\nMax Player: &mp\nWaiting Place: &wp",
                                "This command cannot be used because you are not setting up a room or you are not doing this step",
                                "You have quit settings, just set the data clear.",
                                "Set the center point to be successful. Next, please go to the waiting area in the air (if you have already built it) and use the [/ymwb room wait] settings.",
                                "Unable to complete setting, cause: no center point, waiting place or chests",
                                "Congratulations, set it up!",
                                "The Chest has been set up successfully, and there are currently &d Chests,Click other Chests to continue,or use[/ymwb room end] to finish the room setting",
                                "The Chest is already setted! Do not repeat it"
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
                                "房间配置创建中，id&1，范围&2，最大玩家数&3\n请站在一个方块上，作为地图的中心点，并使用[/ymwb room cen]设置。",//2
                                "使用方法: /ymwb room &cmd [房间ID]",//3
                                "不存在此房间!",//4
                                "房间&id的信息如下:\n中心点: &pos\n范围: &range\n最大人数: &mp\n等待区:&wp",//5
                                "不能使用这个指令，原因: 你并不在设置房间或你不是在进行这一步骤",//6
                                "你已退出设置，刚刚设置的数据清除。",//7
                                "设置中心点成功，接下来请去空中的等待区(假如您已经建好了)，并使用[/ymwb room wait]设置。",//8
                                "设置等待区成功，进入房间的玩家会被传送到这里。接下来请逐一点击地图内的箱子，推荐数量为[范围²/玩家数/10]",//9
                                "无法完成设置，原因: 未设置中心点、等待区或箱子。",//10
                                "恭喜你，设置完成!",//11
                                "箱子设置成功，当前共&d个箱子,点箱子继续设置，完成设置使用[/ymwb room end]",//12
                                "该箱子已存在!请勿重复设置"//13
                               ],
                       "game"=>[
                               ]
                      ]
              ]
    ];
}