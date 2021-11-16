<?php

namespace App\Controller;

use App\Service\CapaciteService\CapaciteService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;


class CapaciteController extends AbstractController
{
   
    private $capaciteService;

    public function __construct(CapaciteService $capaciteService )
    {
        $this->capaciteService= $capaciteService;
    }
    
    /**
     * @Route("/capacite", name="add_capacite", methods={"POST"})
     */
    public function add(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        if($this->capaciteService->add($data)==1){
            return new JsonResponse(['status' => 'capacite created!'], Response::HTTP_CREATED);
        }
    
        return new JsonResponse(['status' => 'capacite created!'], Response::HTTP_CREATED);
    }

    /**
         * @Route("/capacites", name="get_all_capacites", methods={"GET"})
    */
      public function getAll(): JsonResponse
     {
       
       $data = $this->capaciteService->findAll();
       $response = new JsonResponse($data, Response::HTTP_OK);
       $response->headers->set('Access-Control-Allow-Origin', '*');
        return $response;
     }

    
      /**
     * @Route("/capacite/id/{id}", name="get_capacite_by_id", methods={"GET"})
    */
     public function getById($id): JsonResponse
     {
        $data=$this->capaciteService->getById($id);
        $response=new JsonResponse($data, Response::HTTP_OK);
        $response->headers->set('Access-Control-Allow-Origin', '*');
        return $response;
      }

       /**
        * @Route("/capacite/{id}", name="update_capacite", methods={"PUT"})
        */
        public function update($id, Request $request): JsonResponse
       {
         $data = json_decode($request->getContent(), true);
         $updatedcapacite=$this->capaciteService->update($id, $data);
         return new JsonResponse($updatedcapacite, Response::HTTP_OK);
        }

     /**
      * @Route("/capacite/{id}", name="delete_capacite", methods={"DELETE"})
     */
     public function delete($id): JsonResponse
     {
      
      if($this->capaciteService->delete($id)==-1){
        $response=new JsonResponse(['status' => 'No capacite with this id'], Response::HTTP_OK);
        $response->headers->set('Access-Control-Allow-Origin', '*');
        return $response;
      }
      $response=new JsonResponse(['status' => 'capacite deleted'], Response::HTTP_OK);
      $response->headers->set('Access-Control-Allow-Origin', '*');

      return $response;
     }


}
