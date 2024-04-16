<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\ServiceModel;

class serviceUserController extends Controller
{
    private $service;
    public $title;
    public function __construct()
    {
        $this->service = new ServiceModel();
        $this->title = 'Dịch vụ';
    }

    public function initService($data)
    {
        $getServiceName = $this->service->getServiceName($data);
        $serviceName = $getServiceName->service_name;
        $title = $this->title . ' | ' . $serviceName;
        $service = $this->service->getServiceList($data);
        return view('Pages.User.service.service', compact('title', 'service', 'serviceName'));
    }


    public function detailService($data)
    {
        $getServiceTypeName = $this->service->getServiceTypeName($data);
        $serviceTypeName = $getServiceTypeName->service_type_name;
        $title = $this->title . ' | ' . $serviceTypeName;
        $detailService = $this->service->getDetailService($data);
        return view('Pages.User.service.serviceDetail', compact('title', 'detailService', 'serviceTypeName'));
    }
}
