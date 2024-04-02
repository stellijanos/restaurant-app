<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomepageController extends Controller
{
    public function show_homepage_settings() {
        return view('admin.options.homepage.index',[
            'page_title' => 'Settings | Admin Panel | Restaurant App',
            'images' => []
        ]);
    }


    public function create_homepage_image() {
        
    }
}
