<?php

namespace App\Service\TypeService;

use App\Entity\TypeLocal;
use App\Repository\TypeLocalRepository;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;


class TypeService{

    private $typeRepository;

    public function __construct(TypeLocalRepository $typeRepository)
    {
        $this->typeRepository = $typeRepository;
        
    }
    public function findAll():array{
        $types = $this->typeRepository->findAll();
        $data=[];
        foreach ($types as $type) {
            $data[] = [
              'id' => $type->getId(),
              'Label' => $type->getLabel()
             ];
     }
     return $data;

    }
    public function add($data):int{
        $newType = new TypeLocal();

        $newType
               ->setLabel($data['label']);
        
         if (empty($newType->getLabel())) {
                throw new NotFoundHttpException('Expecting mandatory parameters!');
            }
        $this->typeRepository->save($newType);
        return 1;
    }
    public function getById($id):array{
        $type = $this->typeRepository->findOneBy(['id' => $id]);
        if($type==null){
            $data=[];
            return $data;
        }
        $data = [
            'id' => $type->getId(),
            'label' => $type->getLabel()
           ];
        return $data;
    }
   
    public function update($id,$data):array{
        $type = $this->typeRepository->findOneBy(['id' => $id]);
        $type->setLabel($data['label']);
        $updatedType = $this->typeRepository->update($type);
        return $updatedType->toArray();
    }
    public function delete($id):int{
        $type = $this->typeRepository->findOneBy(['id' => $id]);
        if($type==null){
          return -1;
        }
       $this->typeRepository->remove($type);
       return 1;
    }

}