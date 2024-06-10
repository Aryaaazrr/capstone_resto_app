<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Produk;
use App\Models\Kategori;
use App\Models\Product;
use App\Models\Subcategory;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $product = Product::with('subcategory')->get();
        $subcategory = Subcategory::all();

        if ($request->ajax()) {
            $rowData = [];

            foreach ($product as $row) {
                $subcategory = $row->subcategory;

                $rowData[] = [
                    'id_product' => $row->id_product,
                    'image' => $row->image,
                    'name' => $row->name,
                    'description' => $row->description,
                    'price' => $row->price,
                    'subcategory' => $subcategory->name,
                ];
            }
            return DataTables::of($rowData)->toJson();
        }

        return view('pages.product.index', ['subcategory' => $subcategory]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'subcategory' => 'required|integer|exists:tbl_subcategories,id_subcategory',
            'price' => 'required|numeric|min:0',
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/menu'), $imageName);
            }

            $category = new Product();
            $category->id_subcategory = $request->subcategory;
            $category->name = $request->name;
            $category->image = $imageName;
            $category->description = $request->description;
            $category->price = $request->price;
            $category->save();

            return redirect()->route('admin.product.index')->with('success', 'Successfully added a new product.');
        } catch (Exception $e) {
            return back()->withInput()->withErrors(['error' => 'Failed to add new product. Please try again.']);
        }
    }

    public function show(Product $produk)
    {
        return view('pages.product.show', compact('produk'));
    }

    public function update(Request $request)
    {
        $id = $request->id_product;
        $product = Product::find($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'subcategory' => 'required|integer|exists:tbl_subcategories,id_subcategory',
            'price' => 'required|numeric|min:0',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/menu'), $imageName);

                if (file_exists(public_path('uploads/menu/' . $product->image))) {
                    unlink(public_path('uploads/menu/' . $product->image));
                }

                $product->image = $imageName;
            }

            $product->id_subcategory = $request->subcategory;
            $product->name = $request->name;
            $product->description = $request->description;
            $product->price = $request->price;
            $product->save();

            return redirect()->route('admin.product.index')->with('success', 'Successfully updated the product.');
        } catch (Exception $e) {
            return back()->withInput()->withErrors(['error' => 'Failed to update the product. Please try again.']);
        }
    }

    public function destroy($id)
    {
        $product = Product::find($id);
        if ($product) {
            $product->delete();
            return response()->json(['message' => 'Data deleted successfully.']);
        }
        return response()->json(['message' => 'Data not found.'], 404);
    }

    public function restore($id)
    {
        $product = Product::withTrashed()->find($id);
        if ($product) {
            $product->restore();
            return response()->json(['message' => 'Data restored successfully.']);
        }
        return response()->json(['message' => 'Data not found.'], 404);
    }

    public function forceDelete($id)
    {
        $product = Product::withTrashed()->find($id);
        if ($product) {
            $product->forceDelete();
            return response()->json(['message' => 'Data has been successfully deleted permanently.']);
        }
        return response()->json(['message' => 'Data not found.'], 404);
    }
}
