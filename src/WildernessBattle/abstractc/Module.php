<?php

/**                            
* 引用此版权
* Copyright (c) 2017-2018 TeaTech All right Reserved.
* 该版权所属class，略作更改
* 原作者: Teaclon(我想说你拼的字看不清)
* 改编者: xMing
**/


namespace WildernessBattle\abstractc;

use pocketmine\command\CommandExecutor;
use pocketmine\command\CommandSender;
use pocketmine\command\PluginCommand;
use WildernessBattle\Main;

abstract class Module
{
	protected $main;
	private $status = false;
	protected $commands = [];
	public $name = null;
	
	
	public function __construct(Main $main)
	{
		$this->main = $main;
	}
	
	
	public function enable()
	{
		$this->status = true;
	}
	
	
	public function disable()
	{
		$this->status = false;
	}
	
	public function getStatus()
	{
		return $this->status;
	}
	
	protected final function registerCommands()
	{
		if(empty($this->commands))
		{
			return;
		}
		if(!($this instanceof CommandExecutor))
		{
			throw new \Exception('该类没有继承CommandExecutor接口');
		}
		
		foreach($this->commands as $command)
		{
			$command = $this->main->getServer()->getCommandMap()->getCommand($command);
			if(($command !== null) && ($command instanceof PluginCommand) && ($command->getPlugin() === $this->main))
			{
				$command->setExecutor($this);
			}
		}
	}
	
	
	public final function sendMessage(CommandSender $sender, $msg) // 发送消息(仅限CommandSender);
	{
		$sender->sendMessage($this->getPrefix().$msg);
	}
	
	public final function getName() // 获取模块名称;
	{
		return $this->name;
	}
	
	
}
?>