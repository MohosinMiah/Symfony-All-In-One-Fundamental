<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use App\Services\MyFriends;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;

class DefaultController extends AbstractController
{


     public function __construct(MyFriends $myFriends)
     {
      
        $myFriends->friends = ["Change_from_controller_one"];
     }
     

 /**
     * @Route("/blog/{page<\d+>?1}", name="blog")
 */
    public function blog($page,Session $session)
    {
           // Set session value 
        $session->set('name','value');
        //remove session value
        $session->remove('name');
  //check session value based on name
        if($session->has('name')){
            // get session value
                dump($session->get('name'));
        }

        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
            'page' =>$page
            
        ]);
    }





















    /**
     * @Route("/default", name="default")
     */
    public function index(MyFriends $myFriends)
    {
        
        $entityManager = $this->getDoctrine()->getManager();
        // $user = new User;

        // $user->setName("Md.Mohosin Miah");

        // $user2 = new User;


        // $user2->setName("Md.Rayhan Miah");
        // $user3 = new User;

        // $user3->setName("Md.Forhad Miah");
        //    // tell Doctrine you want to (eventually) save the user (no queries yet)
        //    $entityManager->persist($user);
        //    // actually executes the queries (i.e. the INSERT query)
        //    $entityManager->persist($user2);
        //    // actually executes the queries (i.e. the INSERT query)
        //    $entityManager->persist($user3);
           
        //    $entityManager->flush();

           $users = $this->getDoctrine()
           ->getRepository(User::class)
           ->findAll();


        $data =[
'one',
'two',
'three'

        ];
        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
            'msg' =>"Send Data from controller to view ",
            'datas' =>$data,
            'myFriends' => $myFriends->friends,
        ]);
    }
}
