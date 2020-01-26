<?php

namespace App\Controller;

use App\Exception\ValidationException;
use App\Service\MarsTimeInterface;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class MarsTimeController extends AbstractController
{
    /**
     * @Route ("/" , name="index", methods={"GET"})
     *
     * @param Request $request
     */
    public function index(Request $request, MarsTimeInterface $marsTimeService)
    {
        $inputDate = $request->get('date', null);

        if (!$inputDate) {
            throw new ValidationException('date can not be empty');
        }

        $format = 'Y-m-d H:i:s';

        $date = DateTime::createFromFormat($format, $inputDate);

        if (!$date || $date->format($format) !== $inputDate) {
            throw new ValidationException('date is not acceptable please send date with ' . $format . ' format');
        }

        return new JsonResponse([
            'MSD' => $marsTimeService->getMarsSolDate($date),
            'MTC' => $marsTimeService->getCoordinatedMarsTime($date),
        ]);
    }
}
