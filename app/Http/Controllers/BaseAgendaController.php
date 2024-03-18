<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class BaseAgendaController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    protected array $authorized = [
        'roles' => [
            // Admin abilities = Create, Read, Update, and Delete
            'admin',
            // Manager abilities = Create, Read, and Update
            'manager',
            // User abilities = Create, Read, Update (only to return vehicle)
            // Do not add `user` here
        ],
        'emails' => [
            // As an example
            'ines.mineiro@roboplan.pt',
            'douglascnlobo@icloud.com'
        ],
    ];

    public function __construct()
    {
        view()->share('authorized', $this->authorized);
    }
}
