<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\StoreRegistrationRequest;
use App\Services\Auth\RegistrationService;
use Illuminate\Http\JsonResponse;

class RegistrationController extends Controller
{
    private RegistrationService $registrationService;

    public function __construct(RegistrationService $registrationService)
    {
        $this->registrationService = $registrationService;
    }

    public function store(StoreRegistrationRequest $request): JsonResponse
    {
        $result = $this->registrationService->store($request->validated(), true);

        return responder()->success($result)->respond();
    }
}
