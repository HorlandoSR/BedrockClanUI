<?php

namespace Clan;

use pocketmine\plugin\PluginBase;
use pocketmine\Player; 
use pocketmine\Server;
use pocketmine\event\Listener;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;

class Main extends PluginBase implements Listener {

	public function onEnable(){
		$this->getLogger()->info("§l§aPlugin Enable, Create by LetTIHL And HaykalPRO");
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
	}

	public function onLoad(){
		$this->getLogger()->info("§l§6Load Plugin...");
	}

	public function onDisable(){
		$this->getLogger()->info("§l§cPlugin Disable, Not Detected FormAPI");
	}
	
	public function onCommand(CommandSender $player, Command $cmd, String $label, array $args) : bool {
        switch($cmd->getName()){
            case "clanui":
            $this->FormClan($player);
            return true;
        }
        return true;
	}
	
	 public function FormClan($player){
        $formapi = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
        $form = $formapi->createSimpleForm(function(Player $player, $data){
          if($data == null)return;
          switch($data){
              case 0:break;
              case 1:
	      $this->Create($player);
              break;
              case 2:
              $this->getServer()->getCommandMap()->dispatch($player, "clan delete");
              break;
              case 3:
              $this->getServer()->getCommandMap()->dispatch($player, "clan leave");
              break;
              case 4:
              $this->Invite($player);
              break;
              case 5:
              $this->getServer()->getCommandMap()->dispatch($player,"clan accept");
              break;
              case 6:
              $this->Demote($player);  
              break;
              case 7:
              $this->Join($player);  
              break;
              case 8:
              $this->Leader($player);  
              break;
              case 9:
              $this->Kick($player);  
              break;
              case 10:
              $this->Chat($player);  
              break;
              case 11:
              $this->Info($player);  
              break;              
              case 12:
              $this->getServer()->getCommandMap()->dispatch($player,"clan sethome");
              break; 
              case 13:
              $this->getServer()->getCommandMap()->dispatch($player,"clan home");
              break; 
              case 14:
              $this->Withdraw($player);
              break;
              case 15:
              $this->Deposite($player); 
              break;
              case 16:
              $this->Promote($player); 
              break; 
              case 17:
              $this->getServer()->getCommandMap()->dispatch($player,"clan leave");
              break;               
          }
        });
        $form->setTitle("§l§9Clan Menu");
        $form->setContent("================================= \n                §l§9CLAN§r \n           ------------- \n§l§9»» §r§fSelect The Menu Listed Below: \n=================================");
		$form->addButton("§c§lExit", 0, "textures/ui/cancel");
		$form->addButton("§l§0Create\n§l§9»» §r§fTap To check", 0, "textures/ui/icon_recipe_nature");
		$form->addButton("§l§0Delete\n§l§9»» §r§fTap To check", 0, "textures/ui/trash");
		$form->addButton("§l§0Leave\n§l§9»» §r§fTap to check", 0, "textures/ui/NetherPortal");
    $form->addButton("§l§0Invite\n§l§9»» §r§fTap To check", 0, "textures/ui/icon_alex");
		$form->addButton("§l§0Accept\n§l§9»» §r§fTap To Check", 0, "textures/ui/confirm");
		$form->addButton("§l§0Demote\n§l§9»» §r§fTap To Check", 0, "textures/ui/icon_alex");
		$form->addButton("§l§0Join\n§l§9»» §r§fTap To Check", 0, "textures/ui/icon_steve");
		$form->addButton("§l§0Give Leader\n§l§9»» §r§fTap To Check", 0, "textures/ui/gear");
		$form->addButton("§l§0Kick\n§l§9»» §r§fTap To Check", 0, "textures/ui/icon_alex");
		$form->addButton("§l§0Chat\n§l§9»» §r§fTap To Check", 0, "textures/ui/comment");
		$form->addButton("§l§0Info\n§l§9»» §r§fTap To Check", 0, "textures/ui/copy");
		$form->addButton("§l§0Home\n§l§9»» §r§fTap To Check", 0, "textures/ui/accessibility_glyph_color");
		$form->addButton("§l§0set Home\n§l§9»» §r§fTap To Check", 0, "textures/ui/World");
		$form->addButton("§l§0Withdraw\n§l§9»» §r§fTap To Check", 0, "textures/items/MCoin");
		$form->addButton("§l§0Deposite\n§l§9»» §r§fTap To Check", 0, "textures/items/map_filled");		
		$form->addButton("§l§0Promote\n§l§9»» §r§fTap To Check", 0, "textures/ui/FriendsIcon");
        $form->sendToPlayer($player);
	}
	
	public function Promote($player){
		$formapi = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
		$form = $formapi->createCustomForm(function(Player $player, $data){
			if(!$data === null){
			$this->getServer()->getCommandMap()->dispatch($player,"clan promote $data[0]");
			}
		});
		$form->setTitle("§l§0Promote Clan");
		$form->addInput("§bname player");
		$form->sendToPlayer($player);
	}
	
	public function Deposite($player){
		$formapi = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
		$form = $formapi->createCustomForm(function(Player $player, $data){
			if(!$data == null && is_numeric($data[0])){
			   $this->getServer()->getCommandMap()->dispatch($player,"clan deposit $data[0]");
			}
		});
		$form->setTitle("§l§0Deposite Clan");
		$form->addInput("§bNumber");
		$form->sendToPlayer($player);
	}		
	
	public function Withdraw($player){
		$formapi = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
		$form = $formapi->createCustomForm(function(Player $player, $data){
			if(!$data == null && is_numeric($data[0])){
			   $this->getServer()->getCommandMap()->dispatch($player,"clan withdraw $data[0]");
			}
		});
		$form->setTitle("§l§0Withdraw Clan");
		$form->addInput("§bNumber");
		$form->sendToPlayer($player);
	}	
	
	
	public function Create($player){
		$formapi = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
		$form = $formapi->createCustomForm(function(Player $player, $data){
			if(!$data == null){
			$this->getServer()->getCommandMap()->dispatch($player,"clan create $data[0]");
			}
		});
		$form->setTitle("§l§0Create Clan");
		$form->addInput("§bname clan");
		$form->sendToPlayer($player);
	}
	
	public function Invite($player){
		$formapi = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
		$form = $formapi->createCustomForm(function(Player $player, $data){
			if(!$data == null){
			$this->getServer()->getCommandMap()->dispatch($player,"clan invite $data[0]");
			}
		});
		$form->setTitle("§l§0Invite Clan");
		$form->addInput("§bname player");
		$form->sendToPlayer($player);
	}	
	
	public function Join($player){
		$formapi = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
		$form = $formapi->createCustomForm(function(Player $player, $data){
			if(!$data === null){
			$this->getServer()->getCommandMap()->dispatch($player,"clan join $data[0]");
			}
		});
		$form->setTitle("§l§0Join Clan");
		$form->addInput("§bName Clan");
		$form->sendToPlayer($player);
	}
	
	public function Leader($player){
		$formapi = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
		$form = $formapi->createCustomForm(function(Player $player, $data){
			if(!$data == null){
			$this->getServer()->getCommandMap()->dispatch($player,"clan leader $data[0]");
			}
		});
		$form->setTitle("§l§0Leader Clan");
		$form->addInput("§bName Clan");
		$form->sendToPlayer($player);
	}
	
	public function Kick($player){
		$formapi = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
		$form = $formapi->createCustomForm(function(Player $player, $data){
			if(!$data == null){
			$this->getServer()->getCommandMap()->dispatch($player,"clan Kick $data[0]");
			}
		});
		$form->setTitle("§l§0Kick Clan");
		$form->addInput("§bName Player");
		$form->sendToPlayer($player);
	}		

	public function Demote($player){
		$formapi = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
		$form = $formapi->createCustomForm(function(Player $player, $data){
			if(!$data == null){
			$this->getServer()->getCommandMap()->dispatch($player,"clan demoto $data[0]");
			}
		});
		$form->setTitle("§l§0Demote Clan");
		$form->addInput("§bName Player");
		$form->sendToPlayer($player);
	}
	
	public function Chat($player){
		$formapi = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
		$form = $formapi->createCustomForm(function(Player $player, $data){
			if(!$data == null){
			$this->getServer()->getCommandMap()->dispatch($player,"clan chat $data[0]");
			}
		});
		$form->setTitle("§l§0Chat Clan");
		$form->addInput("§bMessage");
		$form->sendToPlayer($player);
	}
	
	public function Info($player){
		$formapi = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
		$form = $formapi->createCustomForm(function(Player $player, $data){
			if(!$data == null){
			$this->getServer()->getCommandMap()->dispatch($player,"clan info $data[0]");
			}
		});
		$form->setTitle("§l§0Info Clan");
		$form->addInput("§bName Clan");
		$form->sendToPlayer($player);
	}		
	
}
