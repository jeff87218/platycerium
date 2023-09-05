<?php

namespace App\Http\Controllers\Admin;

use App\Carousel;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Str;

class CarouselController extends Controller
{

    public function __construct()
    {
        $this->middleware('role:admin');

    }

    public function index()
    {
        return view('admin.carouselList')->with('items', Carousel::paginate(15));
    }

    public function uploadImage(Request $request)
    {
        $imageData = [];

        foreach ($request->file('po_image') as $index => $imageFile) {
            $filename = Str::random(10) . '.png';
            $storagePath = "storage/uploads/images/{$filename}";


            Image::make($imageFile)->resize(6000, 1250)->save(public_path($storagePath));

            $imageData[] = [
                'image_url' => $filename,
                'name' => $request->input('name')[$index],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
        }

        Carousel::insert($imageData);

        // Session Message
        session()->flash('alert-success', '輪播圖新增成功');

        // Redirect Route
        return redirect()->back();
    }

    public function destroy($id)
    {
        $file = Carousel::query()->find($id);
        $file_path = "storage/uploads/images/{$file->image_url}";
        if (file_exists($file_path)) {
            session()->flash('alert-success', $file->name.' 圖片已經刪除');
            unlink($file_path);
            $file->delete();
        } else {
            session()->flash('alert-danger', '圖片不存在');
        }
        return redirect()->back();

    }
}
