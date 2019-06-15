<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DefaultController  extends AbstractController
{
     /**
     * Matches /index exactly
     *
     * @Route("/index", name="index")
     */
    public function index()
    {
        $number = random_int(0, 100);
        dump( $number);
        dump( $number);

        return new Response(
            '<html><body>Lucky number: '.$number.'</body></html>'
        );
    }
    
     /**
     * Matches /about exactly
     *
     * @Route("/about", name="about")
     */
    public function about()
    {
        
        return new Response(
            '<html><body>I am Md.Mohosin Miah student of IUBAT</body></html>'
        );
    }
}
