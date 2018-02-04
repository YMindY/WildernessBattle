<?php
namespace WildernessBattle\Modules\room;

use WildernessBattle\Main;
use WildernessBattle\abstractc\Module;

class RoomManager extends Module{
   public $name = "房间模块";
   protected $listeners = [];
   public function enable(){
      $this->registerListeners();
      parent::enable();
   }
}