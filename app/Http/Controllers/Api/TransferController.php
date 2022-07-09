<?php

namespace App\Http\Controllers\Api;

use App\Domains\Transfer\Services\Abstract\ITransferService;
use App\Exceptions\SystemDefaultException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Transfer\TransferRequest;
use App\Support\Models\BaseResponse;
use Symfony\Component\HttpFoundation\Response;

class TransferController extends Controller
{
    private ITransferService $transferService;

    public function __construct(ITransferService $transferService)
    {
        $this->transferService = $transferService;
    }

    public function postTransfer(TransferRequest $request): Response
    {
        try {
            $transferSuccess = $this->transferService->transfer($request);
            return BaseResponse::builder()
                ->setMessage('Success transfer!')
                ->setData($transferSuccess)
                ->response();
        } catch (SystemDefaultException $exception) {
            return $exception->response();
        }
    }
}
