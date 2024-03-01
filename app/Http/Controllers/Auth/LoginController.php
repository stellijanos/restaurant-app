<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{


    /**
     * Display the login form.
     * 
     * This method returns the view containing the login form.
     * 
     * @return \Illuminate\Contracts\View\View
     */
    public function show_login_form() {
        return view('login_form');
    }



    /**
     * Process the login reques
     * 
     * This method validates the username and the password provided in the request.
     * If the credentials are correct, it sets a token cookie and redirects the user to the admin panel.
     * If the credentials are incorrect, it redirects the user back to the login form with an error message.
     * 
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login() {

        if (request('username') != env('RESTAURANT_ADMIN_USERNAME')) {
            return redirect()->route('login_form')->with('error_message', 'Incorrect Username!');
        }

        if (request('password') != env('RESTAURANT_ADMIN_PASSWORD')) {
            return redirect()->route('login_form')->with('error_message', 'Incorrect Password!');
        }

        setcookie('token', env('RESTAURANT_TOKEN'), time() + 3600, '/');

        return redirect()->route('admin_panel');
    }



    /**
     * Process the logout request.
     * 
     * This method removes the token cookie and redirects the user to the login form.
     * 
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout() {

        setcookie('token', '', time()-3600, '/');

        return redirect()->route('login_form');
    }

}



