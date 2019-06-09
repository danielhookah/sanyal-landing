<?php

namespace App\Controllers;

use Slim\Http\{Request, Response};
use App\Controllers\Controller;

class FormController extends Controller
{

    public function postForm(Request $request, Response $response)
    {
        var_dump(123); die;
    }

}