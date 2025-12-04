<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Order;
use App\Models\Product;
use App\Models\Country;
use Illuminate\Support\Str;
use App\Models\ProductMedia;
use Illuminate\Http\Request;
use App\Models\OrderLineItem;
use App\Models\ProductCategory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class ShopController extends Controller
{
    public function manage_shops()
    {
        $productListing = Product::with('images')->whereNot('uploaded_by', Auth::user()->user_id)->inRandomOrder()->orderByDesc('created_at')->paginate(10);

        return view('users.shops.index', [
            'products' => $productListing,
        ]);
    }

    public function test()
    {
        $productListing = Product::with('images')->inRandomOrder()->orderByDesc('created_at')->paginate(10);

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
                    $uniqueName = Auth::user()->username.'-'.uniqid('product_media_').'_'.time().'.'.$extension;

                    $destination = public_path('uploads/product_media');
                    $file->move($destination, $uniqueName);

                    ProductMedia::create([
                        'product_id' => $Product->product_id,
                        'media_type' => $extension,
                        'file_path' => 'uploads/product_media/'.$uniqueName,
                    ]);
                }
            }

            if ($request->filled('categories')) {
                $categories = array_filter(array_map('trim', explode(',', $request->categories)));

                foreach ($categories as $key => $value) {
                    ProductCategory::create([
                        'name' => $value,
                        'product_id' => $Product->product_id,
                    ]);
                }
            }

            return redirect()->back()->with('success', 'Product Uploaded Successfully.');
        }

        return view('users.shops.create');
    }

    public function view_product($id)
    {
        return view('users.shops.view_product', [
            'product' => Product::with('getUploader')->find($id),
        ]);
    }

    public function add_to_cart(Request $request)
    {
        $userID = Auth::user()->user_id;
        $productID = $request->product_id;
        $getProductVendor = Product::where(['product_id' => $productID])->value('uploaded_by');
        $orderLineItem = new OrderLineItem;

        if ($orderLineItem->where(['user_id' => $userID, 'product_id' => $productID, 'status' => "pending"])->exists()) {
            return response()->json([
                'status' => REQUEST_PROCESSED,
                'count' => 1,
            ]);
        } else {

            $newOrder = $orderLineItem->create([
                'product_id' => $productID,
                'user_id' => $userID,
                'quantity' => 1,
                'status' => 'Pending',
                'vendor_id' => $getProductVendor,
            ]);

            if ($newOrder) {
                return response()->json([
                    'status' => REQUEST_PROCESSED,
                    'count' => 0,
                ]);
            }
        }
    }

    public function manage_cart(Request $request)
    {
        if ($request->isMethod(FORM_METHOD_POST)) {

            foreach ($request->cart as $key => $value) {
                OrderLineItem::where([
                    'order_line_item_id' => $key,
                ])->update([
                    'quantity' => $value['qty'],
                    'user_id' => Auth::user()->user_id,
                ]);
            }

            return redirect()->back()->with('success', 'Cart Updated Succesfully.');
        } else {
            $pendingOrder = OrderLineItem::with('getLineItemProduct.images')->where(['user_id' => Auth::user()->user_id])->where(['status' => 'pending'])->get();

            return view('users.shops.manage_cart', [
                'orders' => $pendingOrder,
            ]);
        }
    }

    public function delete_item($id)
    {
        OrderLineItem::where(['order_line_item_id' => $id])->delete();

        return redirect()->back()->with('success', 'Item Removed From The Cart.');
    }

    public function checkout(Request $request)
    {
        if ($request->isMethod(FORM_METHOD_POST)) {
            $request->validate([
                'billing_first_name' => 'required',
                'billing_last_name' => 'required',
                'billing_company' => 'nullable',
                'billing_country' => 'required',
                'billing_address_1' => 'required',
                'billing_address_2' => 'required',
                'billing_city' => 'required',
                'billing_state' => 'required',
                'billing_postcode' => 'required',
                'billing_phone' => 'required',
                'billing_email' => 'required',
                'order_comments' => 'nullable',
            ]);

            $billingAddress = [$request->billing_address_1, $request->billing_address_2, $request->billing_city, $request->billing_state];

            $total = OrderLineItem::with('getLineItemProduct')
                ->where('user_id', Auth::user()->user_id)
                ->where('status', 'pending')
                ->get()
                ->sum(function ($item) {
                    return $item->getLineItemProduct->price * $item->quantity;
                });

            $order = Order::create([
                'billing_address' => implode(',', ($billingAddress)),
                'billing_email' => $request->billing_email,
                'billing_phone' => $request->billing_phone,
                'notes' => $request->order_comments,
                'billing_name' => $request->billing_first_name . ' ' . $request->billing_last_name,
                'company_name' => $request->billing_company,
                'order_number' => Str::uuid(),
                'payment_method' => 'cash',
                'status' => 'processing',
                'user_id' => Auth::user()->user_id,
                'total' => $total,
                'subtotal' => $total,
                'region' => $request->billing_state,
            ]);

            if ($order) {
                OrderLineItem::where([
                    'status' => 'pending',
                    'user_id' => Auth::user()->user_id,
                ])->update([
                    'status' => 'processing',
                    'order_id' => $order->order_id,
                ]);
            }

            return redirect()->route('shops.manage_cart')->with('success', 'Your Order Have Been Placed Successfully.');

        } else {
            return view('users.shops.checkout', [
                'items' => OrderLineItem::with('getLineItemProduct.images')->where(['user_id' => Auth::user()->user_id])->where(['status' => 'pending'])->get(),
                'countries' => Country::cursor(),
            ]);
        }
    }

    public function placed_orders(){
        $scheduledOrders = Order::with("getLineItems.getLineItemProduct.images")->where([
            'user_id' => Auth::user()->user_id,
            'status' => "processing",
        ])->paginate(10);

        return view('users.shops.placed_orders', [
            'orders' => $scheduledOrders,
        ]);
    }

    public function scheduled_cart_items($id){
        $decryptedID = '';

        try {
            $decryptedID = Crypt::decrypt($id);
        } catch(Exception $ex){
            return redirect()->route('suspicious');
        }

        $orderData = Order::with("getLineItems.getLineItemProduct.images")->where(['order_id' => $decryptedID])->first();
        return view('users.shops.scheduled_cart_items', [
            'orderID' => $orderData->order_number,
            'orderData' => $orderData,
        ]);
    }

    public function manage_orders(){
        return view('users.shops.manage_orders');
    }
}
