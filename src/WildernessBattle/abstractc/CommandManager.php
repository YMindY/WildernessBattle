<?php
namespace WildernessBattle\abstractc;

//pm指令引用
use pocketmine\command\Command;
use pocketmine\command\CommandExecutor;
use pocketmine\command\CommandSender;
//内部指令类引用
use WildernessBattle\Modules\room\CommandExecutor as rce;
use WildernessBattle\Modules\game\CommandExecutor as gce;

class CommandManager extends RegisterModules{
   protected $executors = [
      "room" => rce::class,
      "game" => gce::class
   ];
   public final function registerExecutors(){
      $this->Log(">> §e指令系统加载中\n>>>>>>>>>>>>>>>>>>>>","n");
     	$start = microtime(true);
      foreach($this->executors as $n => $c){
         try{
            $this->$n=new $c($this);
         }catch(\Exception $e){
       					$this->Log("§6指令 §e".$n."指令§c加载失败","e");
			       		$this->Log($e->getMessage(),"e");
			       		$this->err_log_record(date("[Y-m-d H:i:s]").$this->getDescription()->getName()." >> "."ClassName: ".$n.";  "."Error_Message: ".$e->getMessage(), date("Y-m-d-H-i-s").$n."指令加载日志.log");
		  	      		$this->Log($this->getName()."§6已生成日志记录".date("Y-m-d-H").$n."指令加载日志.log, 请提供文件夹中的日志给开发者.","e");
			     	}
      }
      $this->Log("§e指令系统加载完毕, 耗时 [§a".round(microtime(true) - $start,3)."§e] s.","i");
   }
   public function onCommand(CommandSender $sender, Command $cmd,/* string */$label, array $arg)/*:bool*/{
      if($cmd->getName()=="ymwb"){
         if(!isset($arg[0])){
            $sender->sendMessage("usage: /ymwb");
            return false;
         }
         if($arg[0]=="room"){
            $this->room->runCommand($sender,$arg);
         }
         if($arg[0]=="game"){
            $this->game->runCommand($sender,$arg);
         }
      }
   }
}