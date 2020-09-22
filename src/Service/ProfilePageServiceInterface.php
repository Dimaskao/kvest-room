<?php


namespace App\Service;


use Symfony\Component\HttpFoundation\Request;

interface ProfilePageServiceInterface
{
    public function savePhoto(Request $request);
}