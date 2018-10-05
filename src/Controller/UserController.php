<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController
{
    /**
     * Finds users based on the given property filters
     *
     * @Route("/users", methods={"GET"}, name="find_users")
     * @return Response
     */
    public function find(): Response
    {
        return new Response('test');
    }

    /**
     * Creates a new user and persists it to the noSQL db
     *
     * @Route("/users", methods={"POST"}, name="create_user")
     *
     * @return Response
     */
    public function create(): Response
    {
        return new Response('User create being called');
    }

    /**
     * Finds a user given an id
     *
     * @Route("/users/{id}", methods={"GET"}, name="find_user_by_id")
     * @param string $id
     * @return Response
     */
    public function findByID($id): Response
    {
        return new Response('finding a user with an id of: ' . htmlspecialchars($id));
    }
}

?>