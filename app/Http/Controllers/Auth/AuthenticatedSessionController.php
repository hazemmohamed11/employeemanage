<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class AuthenticatedSessionController extends Controller
{
    public function destroy()
    {
        Auth::logout(); // Log the user out
        return Redirect::route('login'); // Redirect to the login page
    }
}
