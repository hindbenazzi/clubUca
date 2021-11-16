<?php

namespace App\Service\CapaciteService;

use App\Entity\Capacite;
use App\Repository\CapaciteRepository;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;


class CapaciteService{

    private $capaciteRepository;

    public function __construct(CapaciteRepository $capaciteRepository)
    {
        $this->capaciteRepository = $capaciteRepository;
        
    }
    public function findAll():array{
        $types = $this->capaciteRepository->findAll();
        $data=[];
        foreach ($types as $type) {
            $data[] = [
              'id' => $type->getId(),
              'Adults' => $type->getAdults(),
              'Enfants' => $type->getEnfants()
             ];
     }
     return $data;

    }
    public function add($data):int{
        $newCapacite = new Capacite();

        $newCapacite
               ->setAdults($data['Adults'])
               ->setEnfants($data['Enfants']);
        
         if (empty($newCapacite->getAdults())) {
                throw new NotFoundHttpException('Expecting mandatory parameters!');
            }
        $this->capaciteRepository->save($newCapacite);
        return 1;
    }
    public function getById($id):array{
        $capacite = $this->capaciteRepository->findOneBy(['id' => $id]);
        if($capacite==null){
            $data=[];
            return $data;
        }
        $data = [
            'id' => $capacite->getId(),
            'Adults' => $capacite->getAdults(),
            'Enfants'=>$capacite->getEnfants()
           ];
        return $data;
    }
   
    public function update($id,$data):array{
        $capacite = $this->capaciteRepository->findOneBy(['id' => $id]);
        $capacite->setAdults($data['Adults']);
        $capacite->setEnfants($data['Enfants']);
        $updatedCapacite= $this->capaciteRepository->update($capacite);
        return $updatedCapacite->toArray();
    }
    public function delete($id):int{
        $capacite = $this->capaciteRepository->findOneBy(['id' => $id]);
        if($capacite==null){
          return -1;
        }
       $this->capaciteRepository->remove($capacite);
       return 1;
    }

}