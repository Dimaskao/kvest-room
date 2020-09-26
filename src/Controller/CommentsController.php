<?php

declare(strict_types=1);

namespace App\Controller;

use App\Exception\CommentCannotBeEmptyException;
use App\Repository\CommentRepository;
use App\Repository\RoomRepository;
use App\Service\CommentService;
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
    private CommentService $commentService;
    private CommentRepository $commentRepository;

    public function __construct(EntityManagerInterface $em, RoomRepository $roomRepository, CommentRepository $commentRepository, CommentService $commentService)
    {
        $this->roomRepository = $roomRepository;
        $this->em = $em;
        $this->commentRepository = $commentRepository;
        $this->commentService = $commentService;
    }

    /**
     * @Route("/room/saveComment", methods={"POST"}, name="app_save_comment")
     */
    public function saveComment(Request $request): RedirectResponse
    {
        $roomId = $request->get('roomId');
        $text = $request->get('text');
        try {
            $this->commentService->saveComment((int)$roomId, $text);
        } catch (CommentCannotBeEmptyException $e) {
            return $this->redirectToRoute('app_room', ['id' => $roomId]);
        }
        return $this->redirectToRoute('app_room', ['id' => $roomId]);
    }

    /**
     * @Route("/room/removeComment/{commentId}", requirements={"id"="\d+"}, methods={"GET"}, name="app_remove_comment")
     */
    public function removeComment(int $commentId): RedirectResponse
    {
        $comment = $this->commentRepository->find($commentId);
        if ($comment->getUser()->getId() != $this->getUser()->getId() && 'ROLE_ADMIN' !== $this->getUser()->getRoles()[0]) {
            return $this->redirectToRoute('app_home');
        }

        $this->commentService->removeComment($comment);
        $roomId = $comment->getRoom()->getId();

        return $this->redirectToRoute('app_room', ['id' => $roomId]);
    }
}
