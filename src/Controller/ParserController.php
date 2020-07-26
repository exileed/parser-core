<?php

namespace App\Controller;

use App\Interfaces\ParserDispatcherInterface;
use App\Repository\ParsingRepository;
use App\Repository\PostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ParserController extends AbstractController
{
    /**
     * @var ParserDispatcherInterface
     */
    protected $dispatcher;

    protected $parsingRepository;

    protected $postRepository;

    public function __construct(
        ParserDispatcherInterface $dispatcher,
        ParsingRepository $parsingRepository,
        PostRepository $postRepository
    ) {
        $this->dispatcher = $dispatcher;
        $this->parsingRepository = $parsingRepository;
        $this->postRepository = $postRepository;
    }

    public function index()
    {
        $parsingEntity = $this->parsingRepository->findLastOne();

        return $this->render('index/dashboard.html.twig', [
            //'parsingEntity' => $parsingEntity->,
        ]);
    }

    public function run()
    {
        $this->dispatcher->dispatch();
        return $this->redirect('parsing_current');
    }

    public function list()
    {

    }

    public function detail()
    {

    }

    public function postDetail()
    {

    }

}
