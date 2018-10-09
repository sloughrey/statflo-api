<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Validator\Exception\ValidatorException;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use App\Entity\User;
use App\Repository\UserRepository;
use App\Factory\UserFactory;

class UserController extends AbstractController
{
    /**
     * Finds users based on the given property filters (strict searching)
     *
     * @Route("/users", methods={"GET"}, name="find_users")
     * @param UserRepository $repository
     * @return JsonResponse
     */
    public function find(UserRepository $repository): JsonResponse
    {
        $request = Request::createFromGlobals();
        $role = $request->query->get('role');
        $name = $request->query->get('name');
        
        $searchParams = [];
        if ($role) {
            $searchParams['role'] =  $role;
        }
        if ($name) {
            $searchParams['name'] = $name;
        }
        
        $results = $repository->findBy($searchParams);
        $users = [];
        foreach ($results as $user)
        {
            $users[] = $user->toArray();
        }

        return new JsonResponse($users);
    }

    /**
     * Creates a new user and persists it to the db
     *
     * @Route("/users", methods={"POST"}, name="create_user")
     * @param ValidatorInterface $validator
     * @param UserFactory $userFactory
     *
     * @return JsonResponse
     */
    public function create(ValidatorInterface $validator, UserFactory $userFactory): JsonResponse
    {
        $request = Request::createFromGlobals();
        $name = $request->request->get('name');
        $role = $request->request->get('role');

        $user = $userFactory::createUser();
        $user->setRole($role);
        $user->setName($name);

        $errors = $validator->validate($user);
        if (count($errors) > 0) {
            $err = (string) $errors;

            return new JsonResponse([
                'status' => 'error',
                'error_msg' => $err
            ], 400);
        }

        $em = $this->getDoctrine()->getManager();
        $em->persist($user);
        $em->flush();

        return new JsonResponse($user->toArray());
    }

    /**
     * Finds a user given an id
     * @Route("/users/{id}", methods={"GET"}, name="find_user_by_id")
     * @throws ValidatorException      If no user id is supplied
     * @throws CreateNotFoundException      If no user is found with the given id
     * @param string $id
     * @param UserRepository $repository
     * @return JsonResponse
     */
    public function findByID($id, UserRepository $repository): JsonResponse
    {
        if (!$id) {
            throw new ValidatorException('A user id must be provided');
        }

        //$user = $this->getDoctrine()->getRepository(User::class)->find($id);
        $user = $repository->find($id);
        if (!$user) {
            throw $this->createNotFoundException(
                'No user found for id '. $id
            );
        }

        return new JsonResponse([
            'name' => $user->getName(),
            'role' => $user->getRole()
        ]);
    }
}
