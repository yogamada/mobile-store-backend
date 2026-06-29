<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    /**
     * Show Admin Login Page.
     */
    public function showLogin()
    {
        if (Auth::check()) {
            if (Auth::user()->role === 'admin') {
                return redirect()->route('admin.dashboard');
            }
            Auth::logout();
        }
        return view('admin.login');
    }

    /**
     * Show Admin Registration Page.
     */
    public function showRegister()
    {
        if (Auth::check()) {
            if (Auth::user()->role === 'admin') {
                return redirect()->route('admin.dashboard');
            }
            Auth::logout();
        }
        return view('admin.register');
    }

    /**
     * Handle Admin Registration.
     */
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'admin',
        ]);

        Auth::login($user);

        $request->session()->regenerate();

        return redirect()->route('admin.dashboard');
    }

    /**
     * Handle Admin Login.
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if ($user->role === 'admin') {
                $request->session()->regenerate();
                return redirect()->route('admin.dashboard');
            }
            Auth::logout();
            return back()->withErrors([
                'email' => 'Access denied: You are not authorized as an administrator.',
            ]);
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    /**
     * Log out the Admin.
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }

    /**
     * Overview Dashboard.
     */
    public function index()
    {
        $totalSales = Order::where('status', 'completed')->sum('total_amount');
        $totalProducts = Product::count();
        $totalCustomers = User::where('role', 'customer')->count();

        $recentOrders = Order::with('user')->orderBy('created_at', 'desc')->take(5)->get();

        return view('admin.index', compact(
            'totalSales',
            'totalProducts',
            'totalCustomers',
            'recentOrders'
        ));
    }

    /*
     * --------------------------------------------------------------------------
     * PRODUCTS CRUD
     * --------------------------------------------------------------------------
     */

    public function products()
    {
        $products = Product::orderBy('name', 'asc')->get();
        return view('admin.products.index', compact('products'));
    }

    public function createProduct()
    {
        return view('admin.products.create');
    }

    public function storeProduct(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'image_url' => 'nullable|url',
            'description' => 'nullable|string',
        ]);

        Product::create($request->all());

        return redirect()->route('admin.products')->with('success', 'Product created successfully.');
    }

    public function editProduct($id)
    {
        $product = Product::findOrFail($id);
        return view('admin.products.edit', compact('product'));
    }

    public function updateProduct(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'image_url' => 'nullable|url',
            'description' => 'nullable|string',
        ]);

        $product->update($request->all());

        return redirect()->route('admin.products')->with('success', 'Product updated successfully.');
    }

    public function deleteProduct($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect()->route('admin.products')->with('success', 'Product deleted successfully.');
    }

    /*
     * --------------------------------------------------------------------------
     * MONITORING PAGES
     * --------------------------------------------------------------------------
     */

    public function orders()
    {
        $orders = Order::with(['user', 'items.product'])->orderBy('created_at', 'desc')->get();
        return view('admin.orders.index', compact('orders'));
    }

}
