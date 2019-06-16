<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use App\Services\MyFriends;

class DefaultController extends AbstractController
{


     public function __construct(MyFriends $myFriends)
     {
        $myFriends->friends = ["Change_from_controller_one"];
     }
     

    /**
     * @Route("/default", name="default")
     */
    public function index(MyFriends $myFriends)
    {

        $entityManager = $this->getDoctrine()->getManager();
        $user = new User;

        $user->setName("Md.Mohosin Miah");

        $user2 = new User;


        $user2->setName("Md.Rayhan Miah");
        $user3 = new User;

        $user3->setName("Md.Forhad Miah");
           // tell Doctrine you want to (eventually) save the user (no queries yet)
           $entityManager->persist($user);
           // actually executes the queries (i.e. the INSERT query)
           $entityManager->persist($user2);
           // actually executes the queries (i.e. the INSERT query)
           $entityManager->persist($user3);
           
           $entityManager->flush();

           $users = $this->getDoctrine()
           ->getRepository(User::class)
           ->findAll();
           dump($users);


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
