<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Customer;
use App\Models\Order;


class DashboardController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $categoriesCount = $categories->count();
        $products = Product::where('deleted', 0)->get();
        $productsCount = $products->count();
        $customer = Customer::all();
        $customerCount = $customer->count();
        $order = Order::all();
        $orderCount = $order->count();

        return view('admin.dashboard', [
            'categoriesCount' => $categoriesCount,
            'productsCount' => $productsCount,
            'customerCount' => $customerCount,
            'orderCount' => $orderCount,
        ]);
    }
    public function getAllCategories(Request $request)
    {

        if ($request->ajax()) {
            return datatables()->of(Category::all())->toJson();
        }
        return view('manage.categories');
    }
    public function getAllProducts(Request $request)
    {
        if ($request->ajax()) {
            $products = Product::where('deleted', 0)->get();
            return datatables()->of($products)->toJson();
        }
        return view('manage.products');
    }
    public function getAllProductsInTrash(Request $request)
    {
        if ($request->ajax()) {
            $products = Product::where('deleted', 1)->get();
            return datatables()->of($products)->toJson();
        }
        return view('manage.trash');
    }
    public function getAllCustomers(Request $request)
    {
        if ($request->ajax()) {
            return datatables()->of(Customer::all())->toJson();
        }
        return view('manage.customers');
    }
    public function getAllOrders(Request $request)
    {
        if ($request->ajax()) {
            return datatables()->of(Order::all())->toJson();
        }
        return view('manage.orders');
    }
    public function softDelete(Request $request, $id)
    {
        // Kiểm tra xác thực của yêu cầu
        // $this->validate($request, [
        //     'id' => 'required|exists:products,id',
        // ]);

        // Tìm sản phẩm để update trường deleted
        $product = Product::find($id);

        if (!$product) {
            return redirect()->back()->with('error', 'Sản phẩm không tồn tại.');
        }

        // Update trường deleted của sản phẩm
        $product->update(['deleted' => true]);

        return redirect()->back()->with('success', 'Sản phẩm đã được xóa tạm thời.');
    }
    public function restore(Request $request, $id)
    {
        // Kiểm tra xác thực của yêu cầu
        // $this->validate($request, [
        //     'id' => 'required|exists:products,id',
        // ]);

        // Tìm sản phẩm để update trường deleted
        $product = Product::find($id);

        if (!$product) {
            return redirect()->back()->with('error', 'Sản phẩm không tồn tại.');
        }

        // Update trường deleted của sản phẩm
        $product->update(['deleted' => false]);

        return redirect()->back()->with('success', 'Retore success');
    }
    public function addNewProduct(Request $request)
    {
        // Validate dữ liệu
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'price' => 'required|numeric',
            'category_id' => 'required|numeric|exists:categories,id',
        ]);

        // Kiểm tra nếu có lỗi
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }


        $imageContent = base64_encode(file_get_contents($request->file('image')->path()));
        $base64Image = 'data:image/png;base64,' . $imageContent;

        $product = new Product();
        $product->name = $request->input('name');
        $product->image = $base64Image;
        $product->price = $request->input('price');
        $product->category_id = $request->input('category_id');
        $product->save();


        return redirect()->back()->with('success', 'Thêm sản phẩm mới thành công.');
    }
    public function updateProduct(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'price' => 'required|numeric',
            'category_id' => 'required|numeric|exists:categories,id',
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $updateData = [
            'name' => $request->input('name'),
            'price' => $request->input('price'),
            'category_id' => $request->input('category_id'),
        ];
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $base64Image = base64_encode(file_get_contents($image->getRealPath()));
            $updateData['image'] = $base64Image;
        }

        Product::where('id', $id)->update($updateData);
        return redirect()->back()->with('success', 'Update success');
    }




    // API

    public function get_all_products()
    {
        $products = Product::all();
        return response()->json($products, 200);
    }
    public function find_product_by_id($id)
    {
        $product = Product::find($id);
        if ($product === null) {
            return response()->json(['message' => 'Not found'], 404);
        } else {
            return response()->json($product, 200);
        }
    }
    public function add_new_product(Request $request)
    {
        // Validate dữ liệu
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'price' => 'required|numeric',
            'category_id' => 'required|numeric|exists:categories,id',
        ]);

        // Kiểm tra nếu có lỗi
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }


        $imageContent = base64_encode(file_get_contents($request->file('image')->path()));
        $base64Image = 'data:image/png;base64,' . $imageContent;

        $product = new Product();
        $product->name = $request->input('name');
        $product->image = $base64Image;
        $product->price = $request->input('price');
        $product->category_id = $request->input('category_id');
        $product->save();
        return response()->json(['mesage' => 'success!'], 201);
    }
}
