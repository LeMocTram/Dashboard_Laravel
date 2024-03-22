<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
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
}
