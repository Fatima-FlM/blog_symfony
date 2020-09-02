<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Article;
use App\Repository\ArticleRepository;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

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
    public function home()
    {
        return $this->render('blog/home.html.twig', [
            'title'=>"Bienvenue ici les amis !",
            'age'=>15
    ]);
    }

    /**
     * @Route("/blog/new", name="blog_create")
     */
    public function create(Request $request, EntityManagerInterface $manager)
    {
        $article = new Article();

        $form = $this->createFormBuilder($article)
                    ->add('title', TextType::class, [
                        'attr'=>[
                            'placeholder' =>"Titre de l'article",
                            'class'=> 'form-control'
                            ]
                    ])
                    ->add('content', TextareaType::class, [
                        'attr'=>[
                            'placeholder' =>"Contenu de l'article",
                            'class'=> 'form-control'
                            ]
                    ])
                    ->add('image', TextType::class, [
                        'attr'=>[
                            'placeholder' =>"Image de l'article",
                            'class'=> 'form-control'
                            ]
                    ])
                    ->getForm();


               
        return $this->render('blog/create.html.twig', [
            'formArticle'=> $form->createView()
        ]);
    }

    /**
     * @Route("/blog/{id}", name="blog_show")
     */
    public function show(Article $article)
    {
        return $this->render('blog/show.html.twig', [
            'article'=> $article
            
        ]);
    }
}
