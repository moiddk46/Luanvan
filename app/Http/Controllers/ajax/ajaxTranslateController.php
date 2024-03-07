<?php

namespace App\Http\Controllers\ajax;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Stichoza\GoogleTranslate\GoogleTranslate;

class ajaxTranslateController extends Controller
{
    private $translate;
    public function __construct()
    {
        $this->translate = new GoogleTranslate;
    }

    public function translateLang(Request $request): string
    {
        $formData = $request->all();
        $this->translate->setSource(); // Ngôn ngữ nguồn (nếu cần)
        $this->translate->setTarget('en'); // Ngôn ngữ đích
        $sh = $this->translate->translate($formData['lang']);
        return $sh;
    }
}
