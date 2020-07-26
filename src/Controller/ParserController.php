<?php

namespace App\Controller;

use App\Entity\Parsing;
use App\Entity\Post;
use App\Interfaces\BeautyPostsCropperInterface;
use App\Interfaces\ParserDispatcherInterface;
use App\Repository\ParsingRepository;
use App\Repository\PostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ParserController extends AbstractController
{
    /**
     * @var ParserDispatcherInterface
     */
    private $dispatcher;

    /**
     * @var ParsingRepository
     */
    private $parsingRepository;

    /**
     * @var PostRepository
     */
    private $postRepository;

    /**
     * @var BeautyPostsCropperInterface
     */
    private $cropper;

    /**
     * ParserController constructor.
     *
     * @param ParserDispatcherInterface $dispatcher
     * @param ParsingRepository $parsingRepository
     * @param PostRepository $postRepository
     * @param BeautyPostsCropperInterface $cropper
     */
    public function __construct(
        ParserDispatcherInterface $dispatcher,
        ParsingRepository $parsingRepository,
        PostRepository $postRepository,
        BeautyPostsCropperInterface $cropper
    ) {
        $this->dispatcher = $dispatcher;
        $this->parsingRepository = $parsingRepository;
        $this->postRepository = $postRepository;
        $this->cropper = $cropper;
    }

    public function index()
    {
        $currentParsing = $this->parsingRepository->findLastOne();
        $this->cropper->cropPostsForParsingEntity($currentParsing);
        return $this->render('index/dashboard.html.twig', ['currentParsingState' => $currentParsing]);

    }

    public function run()
    {
        $this->dispatcher->dispatch();
        return $this->redirectToRoute('parsing_current');
    }

    public function list()
    {

    }

    public function detail()
    {

    }

    public function postDetail(Parsing $parsing, Post $post)
    {
        return 1;
    }

}
