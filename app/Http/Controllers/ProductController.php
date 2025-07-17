<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        if (request('search')) {
            $products = Product::where('name', 'like', '%' . request('search') . '%')->get();
        } else {
            $products = Product::latest()->paginate(5);
        }
        
        
        return view('products.index',compact('products'))
                    ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required',
            'detail' => 'required',
            'price' => 'required',
            'file' => 'required|mimes:jpg,png,pdf|max:2048',
        ]);
        $file = $request->file('file');
        $file_title = $file->getClientOriginalName();
        $file_extension = $file->getClientOriginalExtension();
        $file_name = md5(microtime().$file_title).'.'.$file_extension;
        

        Storage::disk('public')->put($file_name, fopen($file , 'r+'), 'public');
        $input = $request->all();

        
        $product = new Product([
            'name' => $request->get('name'),
            'detail' => $request->get('detail'),
            'price' => $request->get('price'),
            'publish' => $request->get('publish'),
            'file' => $file_name,
            
        ]);
        $product->save();
        
        
        return redirect()->route('products.index')
                        ->with('success','Product created successfully.');
    }
  
    /**
     * Display the specified resource.
     */
    public function show(Product $product): View
    {
       return view('products.show',compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product): View
    {
        return view('products.edit',compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product): RedirectResponse
    {
        $request->validate([
            'name' => 'required',
            'detail' => 'required',
            'price' => 'required',
        ]);

        $file = $request->file('file');
        $file_title = $file->getClientOriginalName();
        $file_extension = $file->getClientOriginalExtension();
        $file_name = md5(microtime().$file_title).'.'.$file_extension;
        

        Storage::disk('public')->put($file_name, fopen($file , 'r+'), 'public');

    
        $products = Product::find($product)->first();
        $products->name = $request->get('name');
        $products->detail = $request->get('detail');
        $products->price = $request->get('price');
        $products->publish = $request->get('publish');
        $products->file = $file_name;
        $products->save();
        
        return redirect()->route('products.index')
                        ->with('success','Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product): RedirectResponse
    {
         $product->delete();
         
        return redirect()->route('products.index')
                        ->with('success','Product deleted successfully');
    }

    public function cart()
    {
        return view('products.cart');
    }
  
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function addToCart($id)
    {
        $product = Product::findOrFail($id);
          
        $cart = session()->get('cart', []);
  
        if(isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                "name" => $product->name,
                "quantity" => 1,
                "price" => $product->price
            ];
        }
          
        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }
  
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function cartupdate(Request $request)
    {
        if($request->id && $request->quantity){
            $cart = session()->get('cart');
            $cart[$request->id]["quantity"] = $request->quantity;
            session()->put('cart', $cart);
            session()->flash('success', 'Cart updated successfully');
        }
    }
  
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function remove(Request $request)
    {
        if($request->id) {
            $cart = session()->get('cart');
            if(isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            session()->flash('success', 'Product removed successfully');
        }
    }
}
