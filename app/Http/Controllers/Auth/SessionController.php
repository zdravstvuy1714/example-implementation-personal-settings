<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\Auth\SessionService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SessionController extends Controller
{
    private SessionService $sessionService;

    public function __construct(SessionService $sessionService)
    {
        $this->sessionService = $sessionService;
    }

    public function store(Request $request): JsonResponse
    {
        $token = $this->sessionService->store($request->all());

        return responder()->success(compact('token'))->respond();
    }

    public function update(): JsonResponse
    {
        $token = $this->sessionService->update();

        return responder()->success(compact('token'))->respond();
    }

    public function destroy(): JsonResponse
    {
        $this->sessionService->destroy();

        return responder()->success()->respond();
    }
}
