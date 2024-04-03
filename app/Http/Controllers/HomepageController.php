<?php

namespace App\Http\Controllers;

use App\Models\HomepageImage;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class HomepageController extends Controller
{
    public function show_homepage_settings() {
        return view('admin.options.homepage.index',[
            'page_title' => 'Settings | Admin Panel | Restaurant App',
            'images' => HomepageImage::orderBy('position')->get()
        ]);
    }


    public function create() {
        request()->validate([
            'image-caption' => 'required|string|max:64',
            'image' => 'required|file|mimes:jpeg,jpg,png|max:2048'
        ]);

        $image = new HomepageImage();

        $file = request()->file('image');
        $file_name = bin2hex(random_bytes(10)).'.'.$file->getClientOriginalExtension();
        Storage::putFileAs('public/images/homepage', $file, $file_name);


        $image->image = $file_name;
        $image->caption = filter_var(request()->get('image-caption'),FILTER_SANITIZE_STRING);
        $image->position = HomepageImage::count() + 1;

        $image->save();

        return redirect()->back()->with(['create_message' => 'Successfully added!']);

    }


    public function update($id) {

        request()->validate([
            'caption' => 'required|string|min:1|max:64'
        ]);

        try {

            $image = HomepageImage::findOrFail($id);

            $image->caption = request()->get('caption');
            $image->show_on_homepage = request()->has('show') ? 1 : 0;

            if (request()->hasFile('new_image')) {

                $file = request()->file('new_image');
                $file_name = bin2hex(random_bytes(10)).'.'. $file->getClientOriginalExtension();
                
                Storage::delete('public/images/homepage/'.$image->image);
                Storage::putFileAs('public/images/homepage', $file, $file_name);
    
                $image->image = $file_name;
            }

            $image->save();

            return redirect()->back()->with('message', 'Updated successfully!');

        } catch (ModelNotFoundException $e) {
            abort(404);
        }
    }



    public function patch($id) {
        try {
            $image = HomepageImage::findOrFail($id);

            $otherImage = HomepageImage::findOrFail(request()->get('prev'));
            [$image->position, $otherImage->position] = [$otherImage->position,  $image->position];

            $image->save();
            $otherImage->save();

            return redirect()->back()->with('message', 'Moved successfully!');

        } catch (ModelNotFoundException $e) {
            abort(404);
        }
    }


    public function delete($id) {
        try {
            $image = HomepageImage::findOrFail($id);
            $position = $image->position;
            Storage::delete("public/images/homepage/".$image->image);
            $image->delete();
           
            DB::update("UPDATE homepage_settings set position = position - 1 WHERE position > ? ", [$position]);
            return redirect()->route('admin_panel_show_homepage')->with('message');
        } catch (ModelNotFoundException $e) {
            abort(404);
        }
    }
}

