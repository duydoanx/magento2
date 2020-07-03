<?php


namespace Magenest\Movie\Block;


use Magento\Framework\View\Element\Template;

class Movie extends Template
{
    private $_movie;
    private $_director;
    private $_actor;


    public function __construct(
        Template\Context $context,
        array $data = [],
        \Magenest\Movie\Model\ResourceModel\Movie\CollectionFactory $movie,
        \Magenest\Movie\Model\ResourceModel\Director\CollectionFactory $director,
        \Magenest\Movie\Model\ResourceModel\Actor\CollectionFactory $actor
    )
    {
        parent::__construct($context, $data);
        $this->_movie = $movie;
        $this->_director = $director;
        $this->_actor = $actor;

    }

    public function getMovies()
    {
        $result = [];
        $collectionMovie = $this->_movie->create();
        $collectionMovie->setPageSize(10, 2);
        $collectionDirector = $this->_director->create();
        $collectionActor = $this->_actor->create();

        $dataMovie = $collectionMovie->getData();
        foreach ($dataMovie as $movie) {
            $movie['director_name'] = $collectionDirector->getItemById($movie['director_id'])->getName();
            $result[$movie['movie_id']] = $movie;
        }

        $collectionMovie = $this->_movie->create();
        $collectionMovie->join('magenest_movie_actor','main_table.movie_id = magenest_movie_actor.movie_id');
        $dataMovie = $collectionMovie->getData();
        $arrayActors = [];
        for ($i = 0; $i < count($dataMovie); $i++) {
//            array_push($arrayActors,
//                ['actor_name' => $collectionActor->getItemById($dataMovie[$i]['movie_id'])->getName()] );
            if (!isset($result[$dataMovie[$i]['movie_id']]['actor_name']))
                $result[$dataMovie[$i]['movie_id']]['actor_name'] = [];
            array_push($result[$dataMovie[$i]['movie_id']]['actor_name'], $collectionActor->getItemById($dataMovie[$i]['actor_id'])->getName());

            //$result[$i]['actors']
        }
        return $result;
    }

}
