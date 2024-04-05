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
                $token = $user->createToken("myToken", expiresAt: now()->addHour())->plainTextToken;
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
        $product = Product::where('id', $id)
            ->where('deleted', 0)
            ->first();
        if (!$product) {
            return response()->json([
                "status" => false,
                "message" => "Product not exist",
            ]);
        } else {
            $product->update(['deleted' => true]);
            return response()->json([
                "status" => true,
                "message" => "Delete successfully!",
            ]);
        }
    }

    public function restore($id)
    {

        $product = Product::where('id', $id)
            ->where('deleted', 1)
            ->first();

        if (!$product) {
            return response()->json([
                "status" => false,
                "message" => "Product not exist in trash.",
            ]);
        } else {
            $product->update(['deleted' => false]);
            return response()->json([
                "status" => true,
                "message" => "Restore successfully!",
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

    public function get_all_orderdetails($id)
    {
        // Lấy tất cả các chi tiết đơn hàng có order_id là $id_order, kèm theo thông tin sản phẩm
        $orderDetails = OrderDetail::with('product')->where('order_id', $id)->get();
        if ($orderDetails->isEmpty()) {
            return response()->json([
                "status" => false,
                "message" => "No order details found for the given order ID.",
                "data" => []
            ], 404);
        }

        return response()->json([
            "status" => true,
            "message" => "Get all orderDetails successfully!",
            "data" => $orderDetails
        ]);
    }
    public function edit_product(Request $request, $id)
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'price' => 'required|numeric',
            'category_id' => 'required|numeric|exists:categories,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $updateData = [
            'name' => $request->input('name'),
            'price' => $request->input('price'),
            'category_id' => $request->input('category_id'),
        ];

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $base64Image = base64_encode(file_get_contents($image->getRealPath()));
            $updateData['image'] = 'data:image/png;base64,' . $base64Image;
        }

        $product->update($updateData);

        return response()->json(['message' => 'Product updated successfully', 'product' => $product], 200);
    }
}
