<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\Comment;
use App\Exception\CommentCannotBeEmptyException;
use App\Repository\CommentRepository;
use App\Repository\RoomRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Security;

/**
 * This class get data for comments.
 *
 * @author Dmytro Lytvynchuk <dmytrolutv@gmail.com>
 */
final class CommentService implements CommentServiceInterface
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

    public function saveComment($roomId, $text): void
    {
        $room = $this->roomRepository->find($roomId);
        $user = $this->security->getUser();

        if (!$text) {
            throw new CommentCannotBeEmptyException();
        }

        $comment = new Comment(
            $text,
            $room,
            $user,
        );

        $this->em->persist($comment);
        $this->em->flush();
    }

    public function removeComment($comment): void
    {
        $this->em->remove($comment);
        $this->em->flush();
    }
}
