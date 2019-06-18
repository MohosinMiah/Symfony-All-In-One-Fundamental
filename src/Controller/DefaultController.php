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
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class DefaultController extends AbstractController
{


     public function __construct(MyFriends $myFriends,$logger)
     {
      $logger->info("fee");
        $myFriends->friends = ["Change_from_controller_one"];
     }

         

/**
 * @Route("/raw_sql", name="raw_sql")
 */
public function raw_sql()
{
    $em = $this->getDoctrine()->getManager();
   $conn = $em->getConnection();
   $sql = "SELECT * FROM User";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
     dump($stmt->fetchAll());
     exit();

    return $this->redirectToRoute('create');
}

/**
 * @Route("/delete/{id}", name="delete")
 */
public function delete($id)
{
    $em = $this->getDoctrine()->getManager();
    // $user = $em->getRepository(User::class)->find($id);
    $user = $em->getRepository(User::class)->findAll();

    if ($user) {
        $em->remove($user);
        $em->flush();
    }


    return $this->redirectToRoute('create');
}
/**
 * @Route("/update/{id}", name="update")
 */
  
public function update($id)
{
    $em = $this->getDoctrine()->getManager();
    $product = $em->getRepository(User::class)->find($id);

    if (!$product) {
        throw $this->createNotFoundException(
            'No User found for id '.$id
        );
    }

    $product->setName('Kamal Pasha');
    $em->flush();

    return $this->redirectToRoute('create');
}
 /**
     * @Route("/create", name="create")
 */

public function create()
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

        return $this->render('default/index.html.twig', [
            'users' =>$users,
           
        ]);
 
}



//Use this method in view

public function popular_posts($number = 3)
{
    $popular_posts = ['Post 1','Post 2','Post 3','Post 4','Post 5'];
    return $this->render('default/popular_posts.html.twig', [
        'popular_posts' =>$popular_posts,

        
    ]);
}

 /**
     * @Route("/forward_method/{name}", name="forward_method")
 */

public function forward_method($name)
{
    $response = $this->forward('App\Controller\DefaultController::fancy', [
        'name'  => $name,
        'color' =>'Green'
    ]);
    return $response;
}


 /**
     * @Route("/fanc/{name}/{color}", name="fancy")
 */

public function fancy($name,$color)
{
    exit("I am from frowarding method Name ".$name." Color " .$color);

}





 /**
     * @Route("/generate_url/{id<\d+>?1}", name="generate_url")
 */
public function generate_url($id)
{
    dump($this->generateUrl('generate_url',array('id'=> $id)));
 exit($this->generateUrl('generate_url',array('id'=> $id), UrlGeneratorInterface::ABSOLUTE_URL));
}


 /**
     * @Route("/download/", name="download")
 */
public function download()
{
/**
 * First   way
 */
//    $path = $this->getParameter('download_dir');
//    return $this->file($path.'/check.php');

/**
 * Second  way
 */
$path = $this->get('kernel')->getRootDir(). "../public/"; 
$file = $path.'check.php'; // Path to the file on the server
$response = new BinaryFileResponse($file);
// Give the file a name:
$response->setContentDisposition(ResponseHeaderBag::DISPOSITION_ATTACHMENT,'my_file_name.php');
return $response;
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
            'controller_namee' => 'DefaultController',
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
