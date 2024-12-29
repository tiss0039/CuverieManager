<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Méthode générique pour gérer les redirections après des opérations CRUD.
     */
    protected function redirectWithMessage($route, $message, $status = 'success')
    {
        return redirect()->route($route)->with($status, $message);
    }

    /**
     * Méthode générique pour valider des données selon des règles.
     */
    protected function validateData($request, $rules)
    {
        return $request->validate($rules);
    }
}
