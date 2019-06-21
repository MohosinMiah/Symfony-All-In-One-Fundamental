<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use App\Entity\Address;
use App\Entity\Post;
use App\Entity\Pdf;
use App\Entity\Word;

use App\Services\MyFriends;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use App\Services\MySecondService;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use App\Form\UserType;

class DefaultController extends AbstractController
{


     public function __construct(MyFriends $myFriends,$logger,$param1,$adminEmail,MySecondService $mySecondService)
     {
         dump($mySecondService);
         dump($mySecondService->from);
      
        dump($param1);
        dump($adminEmail);
        $logger->info("fee");
        $myFriends->friends = ["Change_from_controller_one"];
     }
     /**
 * @Route("/form2_example", name="form2_example")
 */
public function form2_example(Request $request)
{
//      // creates a task and gives it some dummy data for this example
     $user = new User();
     $user->setName('Write User Name');
     $form = $this->createForm(UserType::class,$user);
     
         $form->handleRequest($request);

         if ($form->isSubmitted() && $form->isValid()) {
            //  $form->getData() holds the submitted values
             // but, the original `$task` variable has also been updated
             $user = $form->getData();
    
             // ... perform some action, such as saving the task to the database
             // for example, if Task is a Doctrine entity, save it!
             $entityManager = $this->getDoctrine()->getManager();
             $entityManager->persist($user);
             $entityManager->flush();
    
     return $this->render('default/index.html.twig', [
         'form' => $form->createView(),
     ]);
 }
 return $this->render('default/index.html.twig', [
    'form' => $form->createView(),
]);


}

     /**
 * @Route("/form_example", name="form_example")
 */
     public function form_example(Request $request)
     {
         // creates a task and gives it some dummy data for this example
         $user = new User();
         $user->setName('Write User Name');
         $form = $this->createFormBuilder($user)
         ->add('name', TextType::class)
         ->add('save', SubmitType::class, ['label' => 'Create Task'])
             ->getForm();
             $form->handleRequest($request);

             if ($form->isSubmitted() && $form->isValid()) {
                //  $form->getData() holds the submitted values
                 // but, the original `$task` variable has also been updated
                 $user = $form->getData();
         
                 // ... perform some action, such as saving the task to the database
                 // for example, if Task is a Doctrine entity, save it!
                 $entityManager = $this->getDoctrine()->getManager();
                 $entityManager->persist($user);
                 $entityManager->flush();
         
         return $this->render('default/index.html.twig', [
             'form' => $form->createView(),
         ]);
     }
     return $this->render('default/index.html.twig', [
        'form' => $form->createView(),
    ]);

    
     }
     
/**
 * @Route("/polimorphic_query", name="polimorphic_query")
 */
public function polimorphic_query()
{
    $em = $this->getDoctrine()->getManager();
//       //Save User then Pdf and at last Word File
//       for ($i=1; $i <4 ; $i++) { 
//           $user = new User();
//           $user->setName("User ".$i);
//           $em->persist($user);
         


//           for ($j=1; $j <7 ; $j++) { 
//             $pdf = new Pdf();
//             $pdf->setFileName("PDF ".$j);
//             $pdf->setSize("Size ".$j);
//             $pdf->setDescription("Description ".$j);
//             $pdf->setUser($user);
//             $em->persist($pdf);
            
//         }

//         for ($k=1; $k <7 ; $k++) { 
//             $word = new Word();
//             $word->setFileName("PDF ".$k);
//             $word->setName("Word ".$k);
//             $word->setDescription("Description ".$k);
//             $word->setUser($user);
//             $em->persist($word);
            
//         }
//   }
//       $em->flush();

// dump( $em->getRepository(User::class)->find(2)->getFiles());
dump( $em->getRepository(User::class)->findwithPosts(7));
dump( $em->getRepository(User::class)->findwithFiles(16));

  return $this->render('default/index.html.twig', [
  
   
]);
}


/**
 * @Route("/eager_loading", name="eager_loading")
 */
public function eager_loading()
{
    $em = $this->getDoctrine()->getManager();
    
    dump($em->getRepository(User::class)->findwithPosts(1));
    foreach($em->getRepository(User::class)->findwithPosts(1)->getPosts() as $daa){
        dump($daa->getTitle());
    }
  exit();

    return $this->redirectToRoute('create');
}



/**
 * @Route("/user_address", name="user_address")
 */
public function user_address()
{
    $em = $this->getDoctrine()->getManager();
    $user = new User();
    $address = new Address();
    $user->setName("Md Khalid");
    $address->setStret("KSA");
    $user->setAddress($address);
   $em->persist($user);
 
    $em->flush();
  exit();

    return $this->redirectToRoute('create');
}


/**
 * @Route("/delete_user/{id}", name="delete_user")
 */
public function delete_user($id)
{
    $em = $this->getDoctrine()->getManager();
    $user = $em->getRepository(User::class)->find($id);

    if ($user) {
        $em->remove($user);
        $em->flush();
    }
  exit();

    return $this->redirectToRoute('create');
}

/**
 * @Route("/add_post", name="add_post")
 */
public function add_post()
{
    $em = $this->getDoctrine()->getManager();
   $user = new User();
$user->setName("Mohosin");
$em->persist($user);
$em->flush();
   for ($i=0; $i < 5; $i++) { 
      $posts = new Post();
      $posts->setTitle('Post One');
      $user->addPost($posts);
      $em->persist($posts);


   }
   $em->flush();

    //  dump($this->getDoctrine()->getRepository(Post::class)->find(1)->getUser()->getName());
    // $posts = $this->getDoctrine()->getRepository(User::class)->find(2);
    // dump($posts);

    // foreach($posts->getPosts() as $post){
    //     dump($post->getTitle());
    // }
     die();
     exit();

    return $this->redirectToRoute('add_post');
}
         

/**
 * @Route("/param_converter/{id}", name="param_converter")
 * @ParamConverter("id", class="User.php", options={"id": "id"})
 */
public function param_converter(User $user)
{
     dump($user);
     die();
     exit();

    return $this->redirectToRoute('create');
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
