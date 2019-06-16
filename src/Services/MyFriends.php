<?php   
namespace App\Services;

use Psr\Log\LoggerInterface;

class MyFriends {
  public $friends = ["Sajib","Forhad","Easin","Rayhan"];

  public function __constructor(LoggerInterface $logger){
        $this->friends;
        $this->test($logger);
  }

 public function test(LoggerInterface $logger)
 {  
   
 
  $logger->info("I am From MyFriends Service");

 }



}


?>