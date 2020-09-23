<?php

declare(strict_types=1);

namespace App\Controller;

use App\Exception\CommentCannotBeEmptyException;
use App\Repository\CommentRepository;
use App\Repository\RoomRepository;
use App\Service\CommentPageService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Save and remove comments.
 *
 * @author Dmytro Lytvynchuk <dmytrolutv@gmail.com>
 */
final class CommentsController extends AbstractController
{
    private RoomRepository $roomRepository;
    private EntityManagerInterface $em;
    private CommentPageService $commentPageService;
    private CommentRepository $commentRepository;

    public function __construct(EntityManagerInterface $em, RoomRepository $roomRepository, CommentRepository $commentRepository, CommentPageService $commentPageService)
    {
        $this->roomRepository = $roomRepository;
        $this->em = $em;
        $this->commentRepository = $commentRepository;
        $this->commentPageService = $commentPageService;
    }

    /**
     * @Route("/room/saveComment", methods={"POST"}, name="app_save_comment")
     */
    public function saveComment(Request $request): RedirectResponse
    {
        $roomId = $request->get('roomId');
        try {
            $this->commentPageService->saveComment($request);
        } catch (CommentCannotBeEmptyException $e) {
            return $this->redirect('/room/'.$roomId);
        }

        return $this->redirect('/room/'.$roomId);
    }

    /**
     * @Route("/room/removeComment/{commentId}", requirements={"id"="\d+"}, methods={"GET"}, name="app_remove_comment")
     */
    public function removeComment(int $commentId): RedirectResponse
    {
        $comment = $this->commentRepository->find($commentId);
        if($comment->getUser()->getId() != $this->getUser()->getId()) {
            return $this->redirectToRoute("app_home");
        }
        $this->em->remove($comment);
        $this->em->flush();

        $roomId = $comment->getRoom()->getId();

        return $this->redirect("/room/$roomId");
    }
}
