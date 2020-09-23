<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\Comment;
use App\Exception\CommentCannotBeEmptyException;
use App\Repository\CommentRepository;
use App\Repository\RoomRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;

class CommentPageService implements CommentPageServiceInterface
{
    private RoomRepository $roomRepository;
    private CommentRepository $commentRepository;
    private EntityManagerInterface $em;
    private Security $security;

    public function __construct(Security $security, EntityManagerInterface $em, CommentRepository $commentRepository, RoomRepository $roomRepository)
    {
        $this->roomRepository = $roomRepository;
        $this->em = $em;
        $this->commentRepository = $commentRepository;
        $this->security = $security;
    }

    public function saveComment(Request $request)
    {
        $roomId = $request->get('roomId');
        $room = $this->roomRepository->find($roomId);
        $user = $this->security->getUser();

        if (!$request->get('text')) {
            throw new CommentCannotBeEmptyException();
        }

        $comment = new Comment(
            $request->get('text'),
            $room,
            $user,
        );

        $this->em->persist($comment);
        $this->em->flush();
    }
}
