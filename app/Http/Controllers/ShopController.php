<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderLineItem;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Support\Str;
use App\Models\ProductMedia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShopController extends Controller
{
    public function manage_shops()
    {
        $productListing = Product::with("images")->whereNot("uploaded_by", Auth::user()->user_id)->inRandomOrder()->orderByDesc("created_at")->paginate(10);
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

            if($request->filled("categories")){
                $categories = array_filter(array_map('trim', explode(',', $request->categories)));

                foreach($categories as $key => $value){
                    ProductCategory::create([
                        'name' => $value,
                        'product_id' => $Product->product_id,
                    ]);
                }
            }

            return redirect()->back()->with("success", "Product Uploaded Successfully.");
        }

        return view('users.shops.create');
    }

    public function view_product($id){
        return view('users.shops.view_product', [
            'product' => Product::with("getUploader")->find($id),
        ]);
    }

    public function add_to_cart(Request $request) {
        $userID = Auth::user()->user_id;
        $productID = $request->product_id;
        $getProductVendor = Product::where(['product_id' => $productID])->value("uploaded_by");
        $order = new Order();
        $orderLineItem = new OrderLineItem();

        if($orderLineItem->where(['user_id' => $userID, 'product_id' => $productID])->exists()){
            return response()->json([
                'status' => REQUEST_PROCESSED,
                'count' => 1,
            ]);
        } else {

            $newOrder = $orderLineItem->create([
                'product_id' => $productID,
                'user_id' => $userID,
                'quantity' => 1,
                'status' => "Pending",
                'vendor_id' => $getProductVendor,
            ]);

            if($newOrder){
                $order->create([
                    'cart_id' => $newOrder->order_line_item_id,
                    'order_number' => Str::uuid(),
                    'user_id' => $userID,
                    'status' => "Pending",
                ]);
            }

            return response()->json([
                'status' => REQUEST_PROCESSED,
                'count' => 0,
            ]);
        }
    }

    public function manage_cart(){
        $pendingOrder = Order::with("getLineItems", "getLineItems.getLineItemProduct.images")->where(['user_id' => Auth::user()->user_id])->first();
        return view('users.shops.manage_cart', [
            'orders' => $pendingOrder,
        ]);
    }
}
