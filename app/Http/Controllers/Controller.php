<?php

namespace App\Http\Controllers;

use App\Services\JsonResponseService;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    protected JsonResponseService $response;

    public function __construct()
    {
        $this->response = new JsonResponseService;
    }
    
}
