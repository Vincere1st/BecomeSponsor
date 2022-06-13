<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin', name: 'admin')]
class AdminController extends AbstractController
{
    #[Route('/home', name: 'admin_home', methods: 'GET')]
    public function Home()
    {
        return $this->render('admin/admin_home.html.twig');
    }
}
