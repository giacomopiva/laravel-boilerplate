<?php

namespace App\Http\Controllers\User;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
 * Base controller for the user area, providing authorization and validation traits.
 */
class UserController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
}
