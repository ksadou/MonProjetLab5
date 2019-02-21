<?php

namespace App\Controller;

use App\Entity\Content;
use App\Service\ContentGenerator;
use MongoDB\Driver\Manager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Cache\Adapter\RedisAdapter;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;


class ContentController extends AbstractController
{
    /**
     * @Route("/content", name="content")
     * @param ContentGenerator $cachedContents
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function home(ContentGenerator $cachedContents)
    {
            $contents =  $cachedContents->getItems();
            return $this->render('content/index.html.twig', [
                'contents' => $contents
            ]);

    }
    /**
     * @Route("/content/update", name="update")
     * @param ContentGenerator $cachedContents
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function update(ContentGenerator $cachedContents){
        $contents =  $cachedContents->moulinette();
        return $this->render('content/content.html.twig', [
            'contents' => $contents
        ]);
    }



}
