<?php

namespace App\Http\Controllers;

<<<<<<< Updated upstream
use App\Models\Category;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $category = Category::all();

        if ($request->ajax()) {
            $rowData = [];

            foreach ($category as $row) {

                $rowData[] = [
                    'id_category' => $row->id_category,
                    'name' => $row->name,
                ];
            }
            return DataTables::of($rowData)->toJson();
        }

        return view('pages.category.index');
    }

    public function show(Request $request)
    {
        $category = Category::onlyTrashed()->get();

        if ($request->ajax()) {
            $rowData = [];

            foreach ($category as $row) {

                $rowData[] = [
                    'id_category' => $row->id_category,
                    'name' => $row->name,
                ];
            }
            return DataTables::of($rowData)->toJson();
        }

        return view('pages.category.show');
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255'
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $category = new Category();
            $category->name = $request->name;
            $category->save();

            return redirect()->route('admin.category.index')->with('success', 'Successfully added a new category.');
        } catch (Exception $e) {
            return back()->withInput()->withErrors(['error' => 'Failed to add new category. Please try again.']);
        }
    }

    public function update(Request $request)
    {
        $id = $request->id_category;
        $category = Category::find($id);

        if (!$category) {
            return back()->withErrors(['error' => 'Category not found. Please try again']);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $category->name = $request->name;
            $category->save();

            return redirect()->route('admin.category.index')->with('success', 'Successfully updated category name');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => 'An error occurred while updating data'])->withInput();
        }
    }

    public function destroy($id)
    {
        $category = Category::find($id);
        if ($category) {
            $category->delete();
            return response()->json(['message' => 'Data berhasil dihapus.']);
        }
        return response()->json(['message' => 'Data tidak ditemukan.'], 404);
    }

    public function restore($id)
    {
        $category = Category::withTrashed()->find($id);
        if ($category) {
            $category->restore();
            return response()->json(['message' => 'Data berhasil dikembalikan.']);
        }
        return response()->json(['message' => 'Data tidak ditemukan.'], 404);
    }

    public function forceDelete($id)
    {
        $category = Category::withTrashed()->find($id);
        if ($category) {
            $category->forceDelete();
            return response()->json(['message' => 'Data berhasil dihapus secara permanen.']);
        }
        return response()->json(['message' => 'Data tidak ditemukan.'], 404);
    }
}
=======
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //
}
>>>>>>> Stashed changes
