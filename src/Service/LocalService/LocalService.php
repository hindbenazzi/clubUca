<?php

namespace App\Service\LocalService;

use App\Entity\Capacite;
use App\Entity\Local;
use App\Entity\TypeLocal;
use App\Repository\CapaciteRepository;
use App\Repository\LocalRepository;
use App\Repository\TypeLocalRepository;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class LocalService
{

    private $localRepository;
    private $typeRepository;
    private $capaciteRepository;

    public function __construct(LocalRepository $localRepository, TypeLocalRepository $typeLocalRepository, CapaciteRepository $capaciteRepository)
    {
        $this->localRepository = $localRepository;
        $this->typeRepository = $typeLocalRepository;
        $this->capaciteRepository=$capaciteRepository;
    }
    public function findAll(): array
    {
        $locals = $this->localRepository->findAll();
        $data = [];
        foreach ($locals as $local) {
            $data[] = [
                'id' => $local->getId(),
                'nom' => $local->getNom(),
                'description' => $local->getDescription(),
                'adresse' => $local->getAdresse(),
                'prix' => $local->getPrix(),
                'capacite' => $local->getCapacite()->toArray(),
                'type' => $local->getType()->toArray()
            ];
        }
        return $data;
    }
    public function add($data): int
    {
        $newLocal = new Local();

        $newLocal
            ->setNom($data['nom'])
            ->setDescription($data['description'])
            ->setAdresse($data['adresse'])
            ->setPrix($data['prix']);
        $cap = $data['capacite'];
        $type = $data['type'];
        $typeLocal=$this->typeRepository->findOneBy(['label' => $type]);
        $capacite=$this->capaciteRepository->findOneBy(['reference' => $cap]);
        if($typeLocal==null){
            $typeLocal=new TypeLocal();
            $typeLocal->setLabel($type);
            $this->typeRepository->save($typeLocal);
            $newLocal->setType($typeLocal);
        }else{
            $newLocal->setType($typeLocal);
        }
        if($capacite==null){
            $capacite=new Capacite();
            $capacite
                   ->setReference($cap)
                   ->setAdults($cap['adults'])
                   ->setEnfants($cap['enfants']);
            $this->capaciteRepository->save($capacite);
            $newLocal->setCapacite($capacite
        );
        }else{
            $newLocal->setCapacite($capacite);
        }
        
       
        if (empty($newLocal->getNom()) || empty($newLocal->getDescription()) || empty($newLocal->getAdresse()) || empty($newLocal->getPrix())) {
            throw new NotFoundHttpException('Expecting mandatory parameters!');
        }
        $this->localRepository->saveLocal($newLocal);
        return 1;
    }
    public function getById($id): array
    {
        $local = $this->localRepository->findOneBy(['id' => $id]);
        if ($local == null) {
            $data = [];
            return $data;
        }

        $data = [
            'id' => $local->getId(),
            'nom' => $local->getNom(),
            'description' => $local->getDescription(),
            'adresse' => $local->getAdresse(),
            'prix' => $local->getPrix(),
            'capacite' => $local->getCapacite()->toArray(),
            'type' => $local->getType()->toArray()
        ];
        return $data;
    }

    public function update($id, $data): array
    {
        $local = $this->localRepository->findOneBy(['id' => $id]);
        $local->setNom($data['nom'])
            ->setDescription($data['description'])
            ->setAdresse($data['adresse'])
            ->setPrix($data['prix'])
            ->setCapacite($data['capacite'])
            ->setType($data['type']);
        $updatedLocal = $this->localRepository->updateLocal($local);
        return $updatedLocal->toArray();
    }
    public function delete($id): int
    {
        $local = $this->localRepository->findOneBy(['id' => $id]);
        if ($local == null) {
            return -1;
        }

        $this->localRepository->removeLocal($local);
        return 1;
    }
}
