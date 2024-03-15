<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{


    /**
     * Display the home page of the admin panel.
     * 
     * This methods returns a view that represents the home page of the admin panel.
     * 
     * @return \Illuminate\Contracts\View\View
     */
    public function show_home() {
        return view('admin.admin_panel', [
            'page_title' => 'Admin Panel - Restaurant App'
        ]);
    }


    /**
     * Display the orders page of the admin panel.
     * 
     * This method returns a view that represents the orders page of the admin panel.
     * 
     * @return \Illuminate\Contracts\View\View
     */
    public function show_orders() {
        return view('admin.admin_panel',[
            'page_title' => 'Admin Panel - Restaurant App'
        ]);
    }

 
    /**
     * Display the customers page of the admin panel.
     * 
     * This method returns a view that represents the customers page of the admin panel.
     * 
     * @return \Illuminate\Contracts\View\View
     */
    public function show_customers() {
        return view('admin.admin_panel',[
            'page_title' => 'Admin Panel - Restaurant App'
        ]);
    }


    public function show_edit_menu() {
        return view('admin.admin_panel', [
            'page_title' => 'Admin Panel - Restaurant App',
            'categories' => Category::orderBy('menu_position')->get()
        ]);
    }


    private function isCorrectPassword($password) {
        return Hash::check(request()->get('current_password'), $password);
    }

    public function update_profile() {

        request()->validate([
            'name' => 'required|string|min:1|max:255',
            'email' => 'required|string|min:1|max:255',
            'current_password' => 'required|string|min:1,max:255'
        ]);

        $user = auth()->user();


        if (!$this->isCorrectPassword($user->password)) {
            return redirect()->back()->withErrors(['password' => 'Incorrect password']);
        }

        if (request()->has('new_password')) {
            
            request()->validate([
                'confirm_password' => 'same:new_password'
            ]);

            $new_password = request()->get('new_password');

            $user->password = Hash::make($new_password);

        }


        if (request()->has('remove_picture')) {
            Storage::delete('public/images/profile/'.$user->image);
            $user->image = 'blank-profile-picture.png';
        } 
        else if (request()->hasFile('new_image')) {

            $file = request()->file('new_image');
            $file_name = bin2hex(random_bytes(10)).'.'. $file->getClientOriginalExtension();

            if ($user->image != 'blank-profile-picture.png') {
                Storage::delete('public/images/profile/'.$user->image);
            }
            
            Storage::putFileAs('public/images/profile/', $file, $file_name);

            $user->image = $file_name;
        }


        $user->name = request()->get('name');
        $user->email = request()->get('email');

        $user->save();


        return redirect()->back()->with(['message' => 'Successfully updated']);

    }

}

