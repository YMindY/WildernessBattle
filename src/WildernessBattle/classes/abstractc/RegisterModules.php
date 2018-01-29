<?php

/**                            
* 引用此版权
* Copyright (c) 2017-2018 TeaTech All right Reserved.
* 该版权所属class，略作更改
**/
namespace WildernessBattle\classes\abstractc;

/* Modules的引用 */
use WildernessBattle\classes\Modules\room\RoomManager;
use WildernessBattle\classes\Modules\game\GameManager;
use WildernessBattle\classes\Modules\tool\ToolManager;
//这个备用
//use WildernessBattle\classes\Modules\demo\Demo;
/* ---- END ---- */

abstract class RegisterModules extends Logger{
	/**
	 * 这个类存放Modules;
	**/
	
	const MOD_ROOMMODULE = 0;               // 房间模块;
	const MOD_GAMEMODULE = 1;          // 游戏模块;
	const MOD_TOOLMODULE = 2;              // 工具模块;
	const MOD_DEMOMODULE = 3;        // 备用模块;
	
	public $name =
	[
		self::MOD_ROOMMODULE=>"房间模块",         
		self::MOD_GAMEMODULE=>"游戏模块",      
		self::MOD_TOOLMODULE=>"工具模块",  
		self::MOD_DEMOMODULE=>"备用模块"
	];
	
	public $class =
	[
		self::MOD_ROOMMODULE            => RoomManager::class,
		self::MOD_GAMEMODULE       => GameManager::class,
		self::MOD_TOOLMODULE           => ToolManager::class,
		self::MOD_DEMOMODULE     => Demo::class,
	];
	public $modules_id = [];    // 存放模块的临时数组;
	
	
	public function getAllCommands()
	{
		return "/ymwb";
	}
	
	
	
	public final function registerClass() // 注册类;
	{
		$this->Log("[".$this->getName()."]>> §e正在加载模块......","n");
		$start = microtime(true);
		foreach($this->class as $id => $class)
		{
				try
				{
					$this->modules_id[$id] = new $class($this);
					$this->modules_id[$id]->enable();
				}
				catch(\Exception $e)
				{
					$this->Log("[".$this->getName()."]§6模块§e ".$this->name[$id]." §c加载失败","e");
					$this->Log($e->getMessage(),"e");
					$this->err_log_record(date("[Y-m-d H:i:s]").$this->getDescription()->getName()." >> "."ClassName: ".$this->name[$id].";  "."Error_Message: ".$e->getMessage(), date("Y-m-d-H-i-s")."Modules");
					$this->Log($this->getName()."§6已生成日志记录".date("Y-m-d-H")."Modules.log, 请提供文件夹中的日志给开发者.","e");
				}
		}
		
		
		$this->Log("[".$this->getName()."]§d所有模块加载完毕, 耗时 [§a".round(microtime(true) - $start,3)."§d] s.","i");
		$this->Log("[".$this->getName()."]§e查询指令帮助请输入 §d/§6ymwb §e.","i");
	}
	
	
	
	
	
	public final function getModule(int $id) // 获取模块;
	{
		return $this->modules_id[$id] ?? null;
	}
	
	public final function setModule(int $id, $status = false) // 设置模块状态; 2017-11-05
	{
		if(array_key_exists($id, $this->modules_id))
		{
			($status)? $this->modules_id[$id]->enable(): $this->modules_id[$id]->disable();
			$this->module_config->set($this->name[$id], ($status)? true: false);
			$this->module_config->save();
			return $status;
		}
		throw new \Exception("模块未找到");
	}
	
	public final function getModuleStatus(int $id) // 获取模块状态; 2017-11-05
	{
		if($m = $this->getModule($id))
		{
			return $m->getStatus();
		}
		return false;
	}
		public function err_log_record($msg = null, $filename = "error_log", $path = "default")
	{
		if($path === "default") $path = $this->getDataFolder();
		if($filename !== null)
		{
			error_log($msg."\n", 3, $path.$filename.".log");
		}
		else
		{
			throw new \Exception("没有填写文件名");
		}
	}
	
}
?>