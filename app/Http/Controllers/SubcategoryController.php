<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Subcategory;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class SubcategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $category = Category::all();
        $subcategory = Subcategory::with('category')->get();

        if ($request->ajax()) {
            $rowData = [];

            foreach ($subcategory as $row) {
                $category = $row->category;

                $rowData[] = [
                    'id_subcategory' => $row->id_subcategory,
                    'category' => $category->name,
                    'name' => $row->name,
                ];
            }

            return DataTables::of($rowData)->toJson();
        }

        return view('pages.subcategory.index', ['category' => $category]);
    }

    public function show(Request $request)
    {
        $subcategory = Subcategory::onlyTrashed()->get();

        if ($request->ajax()) {
            $rowData = [];

            foreach ($subcategory as $row) {
                $category = $row->category;

                $rowData[] = [
                    'id_subcategory' => $row->id_subcategory,
                    'category' => $category->name,
                    'name' => $row->name,
                ];
            }
            return DataTables::of($rowData)->toJson();
        }

        return view('pages.subcategory.show');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'category' => 'required|exists:tbl_categories,id_category'
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $subcategory = new Subcategory();
            $subcategory->name = $request->name;
            $subcategory->id_category = $request->category;
            $subcategory->save();

            return redirect()->route('admin.subcategory.index')->with('success', 'Successfully added a new subcategory.');
        } catch (\Exception $e) {
            return back()->withInput()->withErrors(['error' => 'Failed to add new subcategory. Please try again later.']);
        }
    }

    public function update(Request $request)
    {
        $id = $request->id_subcategory;
        $subcategory = Subcategory::find($id);

        if (!$subcategory) {
            return back()->withErrors(['error' => 'Subcategory not found. Please try again']);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'category' => 'required|exists:tbl_categories,id_category'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $subcategory->name = $request->name;
            $subcategory->id_category = $request->category;
            $subcategory->save();

            return redirect()->route('admin.subcategory.index')->with('success', 'Successfully updated subcategory name');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => 'An error occurred while updating data'])->withInput();
        }
    }

    public function destroy($id)
    {
        $subcategory = Subcategory::find($id);
        if ($subcategory) {
            $subcategory->delete();
            return response()->json(['message' => 'Data deleted successfully.']);
        }
        return response()->json(['message' => 'Data not found.'], 404);
    }

    public function restore($id)
    {
        $subcategory = Subcategory::withTrashed()->find($id);
        if ($subcategory) {
            $subcategory->restore();
            return response()->json(['message' => 'Data restored successfully.']);
        }
        return response()->json(['message' => 'Data not found.'], 404);
    }

    public function forceDelete($id)
    {
        $subcategory = Subcategory::withTrashed()->find($id);
        if ($subcategory) {
            $subcategory->forceDelete();
            return response()->json(['message' => 'Data has been successfully deleted permanently.']);
        }
        return response()->json(['message' => 'Data not found.'], 404);
    }
}
