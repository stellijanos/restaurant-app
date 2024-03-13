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
        return view('login_form',  ['page_title' => 'Login - Restaurant App']);
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

        request()->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if(auth()->attempt(request()->only('email', 'password'))) {
            return redirect()->route('admin_panel_show_home');
        }
        return redirect()->back()->withErrors(['email' => 'Invalid Credentials']);
    }



    /**
     * Process the logout request.
     * 
     * This method removes the token cookie and redirects the user to the login form.
     * 
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout() {

        auth()->logout();

        return redirect()->route('login');
    }

}


