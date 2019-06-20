<?php   
namespace App\Services;

use Psr\Log\LoggerInterface;
use App\Services\MySecondService;

class MyFriends {
  public $friends = ["Sajib","Forhad","Easin","Rayhan"];

  public function __constructor(MySecondService $mySecondService,  LoggerInterface $logger){
      dump($mySecondService->from);

        $this->friends;
      
  }

 


}


?>