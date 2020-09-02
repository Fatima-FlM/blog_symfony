<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Article;
use App\Repository\ArticleRepository;

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
    public function create(Request $request, EntityManagerInterface $manager){
        dump($request);

        if($request->request->count() > 0){
            $article = new Article();
            $article->setTitle($request->request->get('title'))
                    ->setContent($request->request->get('content'))
                    ->setImage($request->request->get('image'))
                    ->setCreatedAt(new \DateTime());

            $manager->persist($article);
            $manager->flush();
            
            return $this->redirectToRoute('blog_show',['id'-> $article->getId()]);
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
