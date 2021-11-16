<?php

namespace App\Service\LocalService;

use App\Entity\Local;
use App\Repository\LocalRepository;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class LocalService{

    private $localRepository;

    public function __construct(LocalRepository $localRepository)
    {
        $this->localRepository = $localRepository;
        
    }
    public function findAll():array{
        $locals = $this->localRepository->findAll();
        $data=[];
        foreach ($locals as $local) {
            $data[] = [
              'id' => $local->getId(),
              'Nom' => $local->getNom(),
              'Description' => $local->getDescription(),
              'Adresse' => $local->getAdresse(),
              'Prix' => $local->getPrix(),
              'Capacite' => $local->getCapacite(),
              'Type' => $local->getType()
             ];
     }
     return $data;

    }
    public function add($data):int{
        $newLocal = new Local();

        $newLocal
            ->setNom($data['Nom'])
            ->setDescription($data['Description'])
            ->setAdresse($data['Adresse'])
            ->setPrix($data['Prix']);
            $cap=$data['Capacite'];
            $type=$data['Type'];
        
         if (empty($newLocal->getNom()) || empty($newLocal->getDescription()) || empty($newLocal->getAdresse()) || empty($newLocal->getPrix())) {
                throw new NotFoundHttpException('Expecting mandatory parameters!');
            }
        $this->localRepository->saveLocal($newLocal);
        return 1;
    }
    public function getById($id):array{
        $local = $this->localRepository->findOneBy(['id' => $id]);
        if($local==null){
            $data=[];
            return $data;
        }

        $data = [
            'id' => $local->getId(),
              'Nom' => $local->getNom(),
              'Description' => $local->getDescription(),
              'Adresse' => $local->getAdresse(),
              'Prix' => $local->getPrix(),
              'Capacite' => $local->getCapacite(),
              'Type' => $local->getType()
           ];
        return $data;

    }
   
    public function update($id,$data):array{
        $local = $this->localRepository->findOneBy(['id' => $id]);
        $local ->setNom($data['Nom'])
        ->setDescription($data['Description'])
        ->setAdresse($data['Adresse'])
        ->setPrix($data['Prix'])
        ->setCapacite($data['Capacite'])
        ->setType($data['Type']);
        $updatedLocal = $this->localRepository->updateLocal($local);
        return $updatedLocal->toArray();
    }
    public function delete($id):int{
        $local = $this->localRepository->findOneBy(['id' => $id]);
        if($local==null){
          return -1;
        }
  
       $this->localRepository->removeLocal($local);
       return 1;
    }

}