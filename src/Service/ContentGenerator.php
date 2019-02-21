<?php

namespace App\Service;


use App\Entity\Content;
use Symfony\Component\Cache\Adapter\RedisAdapter;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class ContentGenerator
{
    private $parameters;

    public function __construct(ParameterBagInterface $parameterBag)
    {
        $this->parameters = $parameterBag;
    }

    /**
     * @return array
     * @throws \Psr\Cache\InvalidArgumentException
     */
    public function getItems()
    {
        $client = RedisAdapter::createConnection($this->parameters->get('redis'));
        $cache = new RedisAdapter($client);
        // crée un nouvel élément extrait du cache
        $cachedContents = $cache->getItem('mmi_contents');
        if (!$cachedContents->isHit()) {
            $contents = $this->getDoctrine()->getRepository(Content::class)->findAll();
            $cachedContents->set($contents);
            $cache->save($cachedContents);
            return $contents;
        } else {
            return $cachedContents->get();

        }


    }

    public function moulinette(){
        $array_content = [];
        $i=1;
        $contents = $this->getItems();
        //dump($contents);die;
        do{
            $key_content_ran=(array_rand($contents,1));
            $array_content[$i]= $contents[$key_content_ran];
            unset($contents[$key_content_ran]);
            $i++;
           }while($i <= 5000);
        return $array_content;
    }

}