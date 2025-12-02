<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductMedia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShopController extends Controller
{
    public function manage_shops()
    {
        $productListing = Product::with("images")->inRandomOrder()->orderByDesc("created_at")->paginate(10);
        return view('users.shops.index', [
            'products' => $productListing,
        ]);
    }

    public function test()
    {
        $productListing = Product::with("images")->inRandomOrder()->orderByDesc("created_at")->paginate(10);
        return view('users.shops.index2', [
            'products' => $productListing,
        ]);
    }

    public function create_products(Request $request)
    {
        if ($request->isMethod(FORM_METHOD_POST)) {

            $request->validate([
                'product_name' => 'required',
                'product_price' => 'required|numeric',
                'product_description' => 'required',
                'media_input.*' => 'required|file|max:51200',
            ]);

            $Product = Product::create([
                'name' => $request->product_name,
                'description' => $request->product_description,
                'price' => $request->product_price,
                'is_featured' => 0,
                'slug' => strtolower(str_replace(' ', '-', $request->product_name)),
                'uploaded_by' => Auth::user()->user_id,
            ]);

            if ($Product && $request->hasFile('media_input')) {

                foreach ($request->file('media_input') as $file) {

                    $extension = $file->getClientOriginalExtension();
                    $uniqueName = Auth::user()->username . '-' . uniqid('product_media_') . '_' . time() . '.' . $extension;

                    $destination = public_path('uploads/product_media');
                    $file->move($destination, $uniqueName);

                    ProductMedia::create([
                        'product_id' => $Product->product_id,
                        'media_type' => $extension,
                        'file_path' => 'uploads/product_media/'.$uniqueName,
                    ]);
                }
            }

            return redirect()->back()->with("success", "Product Uploaded Successfully.");
        }

        return view('users.shops.create');
    }

    public function view_product($id){
        dd($id);
    }

}
