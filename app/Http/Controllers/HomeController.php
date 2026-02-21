<?php

namespace App\Http\Controllers;

use App\Mail\Forgetpasswordmail;
use App\Mail\OrderEmail;
use App\Models\CartItem;
use App\Models\Contact;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Session;

class HomeController extends Controller
{

     public function home()
    {
        return view('home');
    }

    // In HomeController.php
    public function about()
    {
        return view('about');
    }

    public function product()
    {
        $allproducts = Product::with(['variants','category'])->get();
        // print_r($allproducts);
        // exit;
        return view('product',compact('allproducts'));
    }

    public function cart()
    {
        $user = Auth::check() ? Auth::user()->id : '1';
        $cartItems = CartItem::with(['product'])->where('user_id',$user)->get();
        return view('cart',compact('cartItems'));
    }

    public function productdetails($slug)
    {
       $product_details = Product::with(['variants','category'])->where('slug',$slug)->first();
        return view('productdetails',compact('product_details'));
    }

    public function contact()
    {
        return view('contact');
    }


    /**
     * Show the form for creating a new resource.
     */
    // cart
    // public function cart()
    // {
    //     $cartItems = \App\Models\CartItem::with('product')
    //         ->where('user_id', Auth::id())
    //         ->get();
    //     return view('cart.cart', compact('cartItems'));
    // }

    public function checkout()
    {
        $getcheckout = CartItem::with('product')
            ->where('user_id', Auth::id())
            ->get();

        if ($getcheckout->isEmpty()) {
            $subtotal = 0;
            $tax = 0.00;
            $discount = 0;
            $total = 0;
        } else {

            $subtotal = $getcheckout->sum(function ($item) {
                return $item->quantity * $item->product->price;
            });


            $tax = 22.40;


            $discount = 0;


            if (session()->has('promo_code')) {
                $coupon = Coupon::where('code', session('promo_code'))->first();
                if ($coupon) {

                    if (!$coupon->expires_at || now()->lessThan($coupon->expires_at)) {
                        if ($coupon->type === 'fixed') {
                            $discount = $coupon->value;
                        } elseif ($coupon->type === 'percentage') {
                            $discount = ($subtotal * $coupon->value) / 100;
                        }
                    } else {

                        session()->forget('promo_code');
                        $discount = 0;
                    }
                } else {
                    session()->forget('promo_code');
                }
            }

            $total = $subtotal + $tax - $discount;
        }

        session()->put([
            'product_price' => $total,
            'user_id'       => Auth::user()->id
        ]);

        return view('cart.checkout', compact(
            'getcheckout',
            'subtotal',
            'tax',
            'discount',
            'total'
        ));
    }




    public function thankyou()
    {
        return view('cart.thankyou');
    }

    // login-controller
    public function login()
    {
        return view('cart.login');
    }

    public function cartDelete($id)
    {
        $cartDelete = CartItem::findOrFail($id)->delete();
        if ($cartDelete) {
            return back()->with('success', 'Cart Deleted !');
        }
    }

    // Register-controller
    public function register()
    {
        return view('cart.register');
    }

    // millets-product
    public function milletsproduct()
    {
        return view('milletsproduct');
    }

    // product-details
    // public function productdetails()
    // {
    //     return view('product.details');
    // }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
            'phone' => 'required|numeric',
        ]);

        $users = new User();
        $users->name = $request->name;
        $users->email = $request->email;
        $users->password = Hash::make($request->password);
        $users->phone = $request->phone;
        $data = $users->save();
        if (empty($data)) {
            return back()->with('error', 'User Registration Failed !');
        } else {
            return redirect('/');
        }
    }


    public function show(string $id)
    {
        //
    }


    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function login_user(Request $request)
    {

        
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect('/');
            $user = Auth::user();
            session()->put('users', $user);
        } else {
            return redirect()->back()->with('error', 'Invalid Email or Password');
        }
    }
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }

    public function addToCart(Request $request)
    {
        $request->validate([
            'product_id' => 'required|integer',
            'user_id'    => 'required|integer',
            'quantity'   => 'required|integer|min:1',
        ]);

        $cart = CartItem::create([
            'user_id'    => $request->user_id,
            'product_id' => $request->product_id,
            'quantity'   => $request->quantity,
        ]);
        if($cart){
            return redirect('cart');
        }else{
            return back();
        }
        return response()->json([
            'status' => true,
            'message' => 'Product added to cart successfully!',
            'cart' => $cart
        ]);
        
    }
  public function updateQuantity(Request $request)
{
    $owner = auth()->check() ? auth()->id() : session()->getId();

    $cartItem = CartItem::with('product')
        ->where('id', $request->cart_id)
        ->where('user_id', $owner)
        ->first();

    if (!$cartItem) {
        return response()->json(['status' => 'error', 'message' => 'Cart item not found']);
    }

    // Update quantity safely
    $cartItem->quantity = max(1, intval($request->quantity));
    $cartItem->save();

    // Get all items again after update
    $cartItems = CartItem::with('product')->where('user_id', $owner)->get();

    // Calculate total
    $cartTotal = $cartItems->sum(function ($c) {
        return $c->product->price * $c->quantity;
    });

    if ($cartItems->isEmpty()) {
        $tax = 0;
    } else {
        
        $tax = 180; 
    }

    $finalTotal = $cartTotal + $tax;

    // Store total in session
    session(['cart_total' => $finalTotal]);

    return response()->json([
        'status' => 'success',
        'quantity' => $cartItem->quantity,
        'item_total_price' => $cartItem->product->price * $cartItem->quantity,
        'cart_total' => $cartTotal,
        'tax' => $tax,
        'final_total' => $finalTotal,
        'original_price' => $cartItem->product->price,
    ]);
}



    public function delete($id)
    {
        $owner = auth()->check() ? auth()->id() : session()->getId();
        // session()->getId()

        $cartItem = CartItem::where('id', $id)->where('user_id', $owner)->first();
        if ($cartItem) {
            $cartItem->delete();
        }
        return back()->with('success', 'Cart Deleted !');
    }

    public function add_address(Request $request)
    {
        $request->validate([
            'address' => 'required|string|max:255'
        ]);

        $user = auth()->user();

        $user->update([
            'address' => $request->address
        ]);

        return redirect('/checkout')->with('address', 'Save Address Successfully');
    }


    public function orderConfirm(Request $request)
    {
        $total = session()->get('cart_total');
        $user =  Auth::user();
        $user_id = $user->id;
        $orderNumber = 'ORD-' . date('Ymd') . '-' . strtoupper(uniqid());

        $cartItems = CartItem::where('user_id', $user_id)->with('product')->get();
        if ($cartItems->isEmpty()) {
            return redirect()->back()->with('error', 'Your cart is empty!');
        }

        $order = new Order();
        $order->user_id          = $user_id;
        $order->order_number     = $orderNumber;
        $order->total_amount     = $total;
        $order->status           = 'pending';
        $order->save();

        foreach ($cartItems as $cart) {
            OrderItem::create([
                'order_id'   => $order->id,
                'product_id' => $cart->product_id,
                'quantity'   => $cart->quantity,
                'price'      => $cart->product->price,
            ]);
        }

        Mail::to($user->email)->send(new OrderEmail($order));
        CartItem::where('user_id', $user_id)->delete();
        return redirect()->to('/thanks')->with([
            'order_id'     => $order->id,
            'order_number' => $order->order_number,
            'success'=> 'Please Check Your Email Indox'
        ]);
    }



    public function addOffer(Request $request)
    {
        $request->validate([
            'code'       => 'required|string|unique:coupons,code',
            'value'      => 'required|numeric|min:1',
            'expires_at' => 'required|date_format:d/m/Y',
        ]);

        $expires_at = \Carbon\Carbon::createFromFormat('d/m/Y', $request->expires_at)->endOfDay();
        $coupon = Coupon::create([
            'code'       => $request->code,
            'value'      => $request->value,
            'type'       => 'fixed',
            'expires_at' => $expires_at,
        ]);

        session()->put('promo_code', $coupon->code);
       
        return back()->with('coupons', 'Coupon added successfully!');
    }



    public function applyCoupon(Request $request)
    {
        $request->validate([
            'promo_code' => 'required|string'
        ]);

        $coupon = Coupon::where('code', $request->promo_code)->first();

        if (!$coupon) {
            return back()->withErrors(['promo_code' => 'Invalid coupon code']);
        }

        if ($coupon->expires_at && now()->greaterThan($coupon->expires_at)) {
            return back()->withErrors(['promo_code' => 'Coupon expired']);
        }

        session()->put('promo_code', $coupon->code);

        return back()->with('success', 'Coupon applied successfully!');
    }

    public function searchproduct(Request $request)
    {
        $query = $request->input('query');

        $products = Product::with(['variants', 'category'])
            ->whereRaw('LOWER(name) LIKE ?', ['%' . strtolower($query) . '%'])
            ->get();
        return view('welcome', compact('products', 'query'));
    }

    public function account()
    {
        return view('account-overview');
    }

    public function forgetpassword_email(Request $request)
    {
        $userdata = Auth::check() ? Auth::user() : '';
        $userEmail = $userdata->email;
        $data = [
            'links' => 'http://127.0.0.1:8000/get_forgetpass'
        ];
        Mail::to($userEmail)->send(new Forgetpasswordmail($data));
        return redirect()->back()->with('fsuc', 'Please Check Your Email Inbox');
    }
    public function get_forget()
    {
        return view('reset_password');
    }
    
   public function resetPassword(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'new_password' => 'required|min:6|confirmed',
    ]);
    $user = User::where('email', $request->email)->first();
    if (!$user) {
        return redirect()->back()->with('emailerror', 'Invalid Email!');
    }
    $user->password = Hash::make($request->new_password);
    $user->save();
    return redirect()->route('login');
}

public function BuyNow(Request $request)
    {
        $product_price = Product::where('id',$request->product_id)->first();
        $cartTotal = $product_price->price;
        $request->merge([
            'quantity' => 1,
            'user_id' => $request->user_id,
            'product_id' => $request->product_id
        ]);
         $finalTotal = $cartTotal + 180;
         session(['cart_total' => $finalTotal]);
        $this->addToCart($request);
        return redirect()->route('cart');
    }
    public function thanks (){
        return view('thanks');
    }

    public function contactUs(Request $request){
        
        $contact = new Contact();
        $contact->fname = $request->first_name;
        $contact->lname=$request->last_name;
        $contact->email = $request->email;
        $contact->subject=$request->subject;
        $contact->message = $request->message;
        $contact->inquiry_type=$request->inquiry_type;
        $success = $contact->save();
        if($success){
            return back()->with('conatct','Thanks For You Connect With me.');
        }
    } 
}