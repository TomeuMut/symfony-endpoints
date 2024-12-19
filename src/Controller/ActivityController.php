<?php

namespace App\Controller;

use App\Entity\Activity;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;


class ActivityController extends AbstractController
{

    private $activityRepository;    

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->activityRepository = $entityManager->getRepository(Activity::class);        
    }
    #[Route('/activity', name: 'app_activity')]
    public function index(): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/ActivityController.php',
        ]);
    }

    /**
     * This function return all activities in the database
     *      
     */
    #[Route('/activities', name: 'getActivities', methods: ['GET'])]
    public function getActivities(SerializerInterface $serializer): JsonResponse
    {
        $activities = $this->activityRepository->findAll();

        $json = $serializer->serialize($activities, 'json', ['groups' => 'list']);

        return JsonResponse::fromJsonString($json);
    }
    /**
     * This function return a specific activity by id
     *      
     */
    #[Route('/activities/{id}', name: 'detailsActivities', methods: ['GET'])]
    public function detailsActivities(int $id, SerializerInterface $serializer): JsonResponse
    {
        $actividad = $this->activityRepository->find($id);

        if (!$actividad) {
            return $this->json(['error' => 'Activity not found'], 404);
        }

        $json = $serializer->serialize($actividad, 'json', ['groups' => 'detail']);

        return JsonResponse::fromJsonString($json);
    }
    /**
     * This function search an activity by name
     *      
     */
    #[Route('/activities-search', name: 'searchActivites', methods: ['GET'])]
    public function searchActivites(Request $request, SerializerInterface $serializer): JsonResponse
    {
        $name = $request->query->get('name');
        $activities = $this->activityRepository->findBy(['name' => $name]);

        $json = $serializer->serialize($activities, 'json', ['groups' => 'list']);

        return JsonResponse::fromJsonString($json);
    }

    /**
     * This function create an activity by POST method with JSON data with fileds name, short_description, long_description and price
     *      
     */
    #[Route('/create-activities', name: 'createActivity', methods: ['POST'])]
    public function createActivity(Request $request, ValidatorInterface $validator, EntityManagerInterface $entityManager): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $actividad = new Activity();
        $actividad->setName($data['name']);
        $actividad->setShortDescription($data['short_description']);
        $actividad->setLongDescription($data['long_description']);
        $actividad->setPrice($data['price']);

        $errors = $validator->validate($actividad);

        if (count($errors) > 0) {
            $errorMessages = [];
            foreach ($errors as $error) {
                $errorMessages[] = $error->getMessage();
            }

            return $this->json(['errors' => $errorMessages], 400);
        }
        
        $entityManager->persist($actividad);
        $entityManager->flush();

        return $this->json(['message' => 'Activity create success!'], 201);
    }
}
