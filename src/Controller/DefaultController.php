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
        dump($number);
        dump($number);
        // redirect to a route with parameters
        return $this->redirectToRoute('about', ['max' => 10]);
        return new Response(
            '<html><body>Lucky number: ' . $number . '</body></html>'
        );
    }

    /**
     * Matches /about exactly
     *
     * @Route("/about/{max}", name="about")
     */
    public function about($max)
    {
        dump($max);
        return new Response(
            '<html><body>I am Md.Mohosin Miah student of IUBAT</body></html>'
        );
    }



    /**
     * Matches /country_name exactly
     *
     * @Route("/country_name/{country}", name="country_name")
     */
    public function country_name($country)
    {
        dump($country);
        return new Response(
            "<html><body>Hi,You from $country</body></html>"
        );
    }

}
