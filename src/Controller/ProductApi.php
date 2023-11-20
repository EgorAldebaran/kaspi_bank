<?php  

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ProductApi extends AbstractController
{
    #[Route('/api/product')]
    public function apiProduct(): Response
    {
        return new Response('welcome api product');
    }
}
