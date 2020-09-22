<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Comment;
use App\Repository\CommentRepository;
use App\Repository\RoomRepository;
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
    private CommentRepository $commentRepository;

    public function __construct(EntityManagerInterface $em, RoomRepository $roomRepository, CommentRepository $commentRepository)
    {
        $this->roomRepository = $roomRepository;
        $this->em = $em;
        $this->commentRepository = $commentRepository;
    }

    /**
     * @Route("/room/saveComment", methods={"POST"}, name="app_save_comment")
     */
    public function saveComment(Request $request): RedirectResponse
    {
        $roomId = $request->get('roomId');
        $room = $this->roomRepository->find($roomId);
        $user = $this->getUser();

        $comment = new Comment(
            $request->get('text'),
            $room,
            $user,
        );

        $this->em->persist($comment);
        $this->em->flush();

        return $this->redirect('/room/'.$roomId);
    }

    /**
     * @Route("/room/removeComment/{commentId}", requirements={"id"="\d+"}, methods={"GET"}, name="app_remove_comment")
     */
    public function removeComment(int $commentId): RedirectResponse
    {
        $comment = $this->commentRepository->find($commentId);
        $this->em->remove($comment);
        $this->em->flush();

        $roomId = $comment->getRoom()->getId();
        return $this->redirect("/room/$roomId");
    }
}
