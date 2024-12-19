<?php

namespace App\Controller;

use App\Entity\Activity;
use App\Entity\Supplier;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Doctrine\ORM\EntityManagerInterface;

class SupplierController extends AbstractController
{


    private $activityRepository;
    private $supplierRepository;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->activityRepository = $entityManager->getRepository(Activity::class);
        $this->supplierRepository = $entityManager->getRepository(Supplier::class);
    }
    #[Route('/supplier', name: 'app_supplier')]
    public function index(): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/SupplierController.php',
        ]);
    }
    /**
     * This function return all suppliers in the database
     *      
     */
    #[Route('/suppliers', name: 'listSuppliers', methods: ['GET'])]
    public function listSuppliers(SerializerInterface $serializer): JsonResponse
    {
        $suppliers = $this->supplierRepository->findAll();

        $data = array_map(function ($suppliers) {
            return [
                'id' => $suppliers->getId(),
                'name' => $suppliers->getName(),                
            ];
        }, $suppliers);

        return $this->json($data);
    }
    /**
     * This function return all suppliers in the database in two objects, one with supplier and other without supplier
     *      
     */
    #[Route('/activities-suppliers', name: 'ListActivitySupplier', methods: ['GET'])]
    public function ListActivitySupplier(NormalizerInterface  $normalizer): JsonResponse
    {
        $activities = $this->activityRepository->findAll();

        $acitivtiySupplier = array_filter($activities, fn($activity) => $activity->getSupplier() !== null);
        $activityWithoutSupplier = array_filter($activities, fn($activity) => $activity->getSupplier() === null);

        return $this->json([
            'withSupplier' => $normalizer->normalize($acitivtiySupplier, 'json', ['groups' => 'list']),
            'noSupplier' => $normalizer->normalize($activityWithoutSupplier, 'json', ['groups' => 'list']),
        ]);
    }
}
