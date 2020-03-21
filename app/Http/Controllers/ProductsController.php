<?php

namespace App\Http\Controllers;

use App\Category;
use App\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Products::latest()->paginate(15);
        return view('index', compact('products'))
            ->with('i', (request()->input('page', 1) - 1) * 15);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_name' => 'required',
            'product_price' => 'required|numeric',
            'product_image' => 'required',
            'category_id' => 'required'
        ]);

        $image = $request->file('product_image');
        $image_len = count($image);
        $images = [];
        for ($i = 0; $i < $image_len; $i++) {
            $new_image_name = rand() . $i . '.' . $image[$i]->
                getClientOriginalExtension();
            array_push($images, $new_image_name);
            $image[$i]->move(public_path('images'), $new_image_name);
        }

        $form_data = array(
            'product_name' => $request->get('product_name'),
            'product_price' => intval($request->get('product_price')),
            'product_image' => json_encode($images),
            'category_id' => $request->get('category_id'),
        );

        Products::create($form_data);
        return redirect('products')->with('success', 'Product added successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Products::find($id);
        $images = json_decode($product->product_image);

        return view('view', compact('product', 'images'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Products::findOrFail($id);
        $categories = Category::all();
        $images = json_decode($product->product_image);
        return view('edit', compact('product', 'categories', 'images'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $images = json_decode($request->hidden_image);
        $image = $request->file('product_image');
        if (!empty($image)) {
            $request->validate([
                'product_name' => 'required',
                'product_price' => 'required|numeric',
                'product_image' => 'required',
            ]);

            $image_len = count($image);
            for ($i = 0; $i < $image_len; $i++) {
                $new_image_name = rand() . $i . '.' . $image[$i]->
                    getClientOriginalExtension();
                array_push($images, $new_image_name);
                $image[$i]->move(public_path('images'), $new_image_name);
            }
        } else {
            $request->validate([
                'product_name' => 'required',
                'product_price' => 'required|integer',
            ]);
        }
        $form_data = array(
            'product_name' => $request->get('product_name'),
            'product_price' => $request->get('product_price'),
            'product_image' => json_encode($images),
        );
        // TODO create opportunity to change the product category
        Products::whereId($id)->update($form_data);
        return redirect('products')->with('success', 'Product is successfully update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Products::find($id);
        $images = json_decode($product->product_image);
        foreach ($images as $image) {
            $image_path = public_path() . '/images/' . $image;
            unlink($image_path);
        }
        $product->delete();

        return redirect('products')->with('success', 'Product has been deleted Successfully');
    }
}
