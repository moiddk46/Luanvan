<?php

namespace App\Http\Controllers\ajax;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ajax\ajaxServiceModel;

class ajaxServiceController extends Controller
{
    private $service;
    public function __construct()
    {
        $this->service = new ajaxServiceModel;
    }
    public function getServiceTypeAjax(Request $request): array
    {
        $servicecode=$request->all();
        $data = $this->service->getServiceType($servicecode['service_code']);
        return $data;
    }
}
