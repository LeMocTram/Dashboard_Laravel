<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ApiController extends Controller
{
    //Register
    public function register(Request $request)
    {
        // Validate
        $request->validate([
            "name" => "required|string",
            "email" => "required|string|email|unique:users",
            "password" => "required|confirmed"
        ]);
        User::create([
            "name" => $request->name,
            "email" => $request->email,
            "password" => bcrypt($request->password)
        ]);
        return response()->json([
            "status" => true,
            "message" => "User registered successfully!",
            "data" => []
        ]);
    }
    // Login
    public function login(Request $request)
    {
        // Validate
        $request->validate([
            "email" => "required|string|email",
            "password" => "required"
        ]);
        // Check PassWord
        $user = User::where("email", $request->email)->first();
        if (!empty($user)) {
            if (Hash::check($request->password, $user->password)) {
                $token = $user->createToken("myToken")->plainTextToken;
                return response()->json([
                    "status" => true,
                    "message" => "Login successfully!",
                    "token" => $token
                ]);
            } else {
                return response()->json([
                    "status" => false,
                    "message" => "Password was wrong!",
                    "data" => []
                ]);
            }
        } else {
            return response()->json([
                "status" => false,
                "message" => "Email not exist!",
                "data" => []
            ]);
        }
        // Auth token
    }
    public function profile()
    {
        $userData = auth()->user();
        return response()->json([
            "status" => true,
            "message" => "Profile Information",
            "data" => $userData
        ]);
    }
    // Logout
    public function logout()
    {
        auth()->user()->tokens()->delete();
        return response()->json([
            "status" => true,
            "message" => "Logout successfully!"
        ]);
    }

    public function get_all_products()
    {
        $products = Product::where('deleted', 0)->get();
        return response()->json([
            "status" => true,
            "message" => "Get all products successfully!",
            "data" => $products
        ]);
    }
    public function find_product_by_id($id)
    {
        $product = Product::find($id);
        if (!empty($product)) {
            return response()->json([
                "status" => true,
                "message" => "Get all products successfully!",
                "data" => $product
            ]);
        } else {
            return response()->json([
                "status" => false,
                "message" => "Product not exist!"
            ]);
        }
    }
    public function get_all_products_in_trash()
    {
        $products = Product::where('deleted', 1)->get();
        if (!empty($products)) {
            return response()->json([
                "status" => true,
                "message" => "get all products in trash successfully",
                "data" => $products
            ]);
        }
    }
    public function add_new_product(Request $request)
    {
        // Validate dữ liệu
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'price' => 'required|numeric',
            'category_id' => 'required|numeric|exists:categories,id',
        ]);
        $imageContent = base64_encode(file_get_contents($request->image->path()));
        $base64Image = 'data:image/png;base64,' . $imageContent;


        Product::create([
            "name" => $request->name,
            "image" => $base64Image,
            "price" => $request->price,
            "category_id" => $request->category_id
        ]);

        return response()->json([
            "status" => true,
            "message" => "Add new successfully!",
            "data" => []
        ]);
    }
    public function soft_delete($id)
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json([
                "status" => false,
                "message" => "Product not exist",
            ]);
        } else {
            Product::updated(['deleted' => true]);
            return response()->json([
                "status" => true,
                "message" => "Delete successfully!",
            ]);
        }
    }
    public function get_all_customers()
    {
        $customers = Customer::all();
        return response()->json([
            "status" => true,
            "message" => "get all customers successfully!",
            "data" => $customers
        ]);
    }
    public function get_all_orders()
    {
        $orders = Order::all();
        return response()->json([
            "status" => true,
            "message" => "get all orders successfully!",
            "data" => $orders
        ]);
    }

    public function get_all_orderdetails()
    {
        $orderDetails = OrderDetail::all();
        return response()->json([
            "status" => true,
            "message" => "get all orderDetails successfully!",
            "data" => $orderDetails
        ]);
    }
}
