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
     * @Route ("/mars-time" , name="index", methods={"GET"})
     *
     * @param Request $request
     */
    public function index(Request $request, MarsTimeInterface $marsTimeService)
    {
        $inputDate = $request->get('time', null);

        if (!$inputDate) {
            throw new ValidationException('time can not be empty');
        }

        $format = 'Y-m-d H:i:s';

        $date = DateTime::createFromFormat($format, $inputDate);

        if (!$date || $date->format($format) !== $inputDate) {
            throw new ValidationException('time is not acceptable please send valid time with ' . $format . ' format');
        }

        return new JsonResponse([
            'MSD' => $marsTimeService->getMarsSolDate($date),
            'MTC' => $marsTimeService->getCoordinatedMarsTime($date),
        ]);
    }
}
