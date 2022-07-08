<?php

namespace App\Http\Controllers\Api;

use App\Domains\RegistrationRequest\Services\Abstract\IRegistrationRequestConfirmService;
use App\Domains\RegistrationRequest\Services\Abstract\IRegistrationRequestListingService;
use App\Exceptions\SystemDefaultException;
use App\Http\Controllers\Controller;
use App\Support\Models\BaseResponse;
use Symfony\Component\HttpFoundation\Response;

class RegistrationRequestController extends Controller
{
    private IRegistrationRequestListingService $registrationRequestListingService;
    private IRegistrationRequestConfirmService $registrationRequestConfirmService;

    public function __construct(
        IRegistrationRequestListingService $registrationRequestListingService,
        IRegistrationRequestConfirmService $registrationRequestConfirmService
    )
    {
        $this->registrationRequestListingService = $registrationRequestListingService;
        $this->registrationRequestConfirmService = $registrationRequestConfirmService;
    }


    public function getRegistrationRequests(): Response
    {
        try {
            $listRequests = $this->registrationRequestListingService->getRegistrationRequestsPendants();
            return BaseResponse::builder()
                ->setMessage('Success get registration requests')
                ->setData($listRequests->toArray())
                ->response();
        } catch (SystemDefaultException $e) {
            return $e->response();
        }
    }

    public function postConfirm(int $registrationRequestId): Response
    {
        try {
            $this->registrationRequestConfirmService->confirmRegistration($registrationRequestId);
            return BaseResponse::builder()
                ->setMessage('Success confirm registration requests')
                ->setData(true)
                ->response();
        } catch (SystemDefaultException $e) {
            return $e->response();
        }
    }
}
