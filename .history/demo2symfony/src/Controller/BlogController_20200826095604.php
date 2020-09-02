<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Article;
use App\Repository\ArticleRepository;
use Symfony\Component\Form\Forms;

class BlogController extends AbstractController
{
    /**
     * @Route("/blog", name="blog")
     */
    public function index(ArticleRepository $repo)
    {
       

        $articles = $repo->findAll();

        return $this->render('blog/index.html.twig', [
            'controller_name' => 'BlogController',
            'articles'=> $articles
        ]);
    }

     /**
     * @Route("/", name="home")
     */
    public function home(){
    
    return $this->render('blog/home.html.twig',[
        'title'=>"Bienvenue ici les amis !",
        'age'=>15
    ]);
    
    }

    /**
     * @Route("/blog/new", name="blog_create")
     */
    public function create(Request $request, EntityManagerInterface $manager, Forms $form){
       $article = new Article();

       $form = $this->creatFormBuilder($article)
                    ->add('title')
                    ->add('content')
                    ->add('image');
                    ->getForm();


        }        
        return $this->render('blog/create.html.twig');
    }

      /**
     * @Route("/blog/{id}", name="blog_show")
     */
    public function show(Article $article){


             
        return $this->render('blog/show.html.twig',[
            'article'=> $article
            
        ]);
    }

}
