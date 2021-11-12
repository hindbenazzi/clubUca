<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Service\UserService\UserService;

class UserController extends AbstractController
{
    private $userRepository;
    private $userService;

    public function __construct(UserRepository $userRepository,UserService $userService )
    {
        $this->userRepository = $userRepository;
        $this->userService= $userService;
    }
    /**
     * @Route("/login", name="login", methods={"GET"})
     */
    public function index(): Response
    {
        
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/LoginController.php',
        ]);
    }
    /**
     * @Route("/user", name="add_user", methods={"POST"})
     */
    public function add(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        if($this->userService->add($data)==1){
            return new JsonResponse(['status' => 'User created!'], Response::HTTP_CREATED);
        }
    
        return new JsonResponse(['status' => 'User created!'], Response::HTTP_CREATED);
    }

    /**
         * @Route("/users", name="get_all_users", methods={"GET"})
    */
      public function getAll(): JsonResponse
     {
       
       $data = $this->userService->findAll();
        return new JsonResponse($data, Response::HTTP_OK);
     }

    /**
     * @Route("/user/numAdesion/{numAdesion}", name="get_user_adesion", methods={"GET"})
    */
     public function getByAdesion($numAdesion): JsonResponse
     {
        
        $data=$this->userService->getByAdesion($numAdesion);
        return new JsonResponse($data, Response::HTTP_OK);
      }

      /**
     * @Route("/user/id/{id}", name="get_user_id", methods={"GET"})
    */
     public function getById($id): JsonResponse
     {
        $data=$this->userService->getById($id);

        return new JsonResponse($data, Response::HTTP_OK);
      }

       /**
        * @Route("/user/{id}", name="update_user", methods={"PUT"})
        */
        public function update($id, Request $request): JsonResponse
       {
         $data = json_decode($request->getContent(), true);
         $updatedUser=$this->userService->update($id, $data);
         return new JsonResponse($updatedUser, Response::HTTP_OK);
        }

     /**
      * @Route("/user/{id}", name="delete_user", methods={"DELETE"})
     */
     public function delete($id): JsonResponse
     {
      
      if($this->userService->delete($id)==-1){
        return new JsonResponse(['status' => 'No User with this id'], Response::HTTP_OK);
      }

      return new JsonResponse(['status' => 'User deleted'], Response::HTTP_OK);
     }


}
