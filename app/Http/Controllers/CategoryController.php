<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\CategoryModel;
use App\Models\SubCategoryModel;
use Illuminate\Support\Facades\File;

class CategoryController extends Controller
{
    public function index()
    {
        $cates = CategoryModel::orderBy('sort_order')->get();

        return view('addCategory', compact('cates'));
    }
    public function subCateIndex()
    {
        $cates = CategoryModel::orderBy('category_name')->get();
        $subCates = SubCategoryModel::orderBy('id', 'desc')->get();
        return view('addSubCategory', compact('cates', 'subCates'));
    }

    // Store Category
    public function storeCategory(Request $request)
    {
        $request->validate([
            'category_name'  => 'required|max:100|unique:categories,category_name',
            'category_icon'  => 'required|image|mimes:png,jpg,jpeg,svg,webp|max:2048',
            'category_image' => 'required|image|mimes:png,jpg,jpeg,webp|max:4096',
            'status'         => 'required|in:0,1',
        ]);

        $targetPath = public_path('uploads/category_images');

        // Create Folder if not exists
        if (!file_exists($targetPath)) {
            mkdir($targetPath, 0777, true);
        }

        // Upload Category Icon
        $iconName = null;
        if ($request->hasFile('category_icon')) {

            $icon = $request->file('category_icon');

            $iconName = 'icon_' . time() . '_' . rand(1000, 9999) . '.' . $icon->getClientOriginalExtension();

            $icon->move($targetPath, $iconName);
        }

        // Upload Category Image
        $imageName = null;
        if ($request->hasFile('category_image')) {

            $image = $request->file('category_image');

            $imageName = 'image_' . time() . '_' . rand(1000, 9999) . '.' . $image->getClientOriginalExtension();

            $image->move($targetPath, $imageName);
        }

        CategoryModel::create([
            'category_name'  => $request->category_name,
            'category_icon'  => 'uploads/category_images/' . $iconName,
            'category_image' => 'uploads/category_images/' . $imageName,
            'sort_order'     => $request->sort_order ?? 0,
            'status'         => $request->status,
        ]);

        return back()->with('success', 'Category Added Successfully.');
    }

    // Edit Category
    public function editCategory($id)
    {
        $cate = CategoryModel::findOrFail($id);

        return view('editCategory', compact('cate'));
    }

    // Update Category
    public function updateCategory(Request $request, $id)
    {
        $category = CategoryModel::findOrFail($id);

        $request->validate([
            'category_name' => [
                'required',
                'max:100',
                Rule::unique('categories', 'category_name')->ignore($category->id),
            ],
            'category_icon'  => 'nullable|image|mimes:png,jpg,jpeg,svg,webp|max:2048',
            'category_image' => 'nullable|image|mimes:png,jpg,jpeg,webp|max:4096',
            'status' => 'required|in:0,1',
        ]);

        $targetPath = public_path('uploads/category_images');


        // Category Icon
        if ($request->hasFile('category_icon')) {

            // Delete Old Icon
            if ($category->category_icon && File::exists(public_path($category->category_icon))) {
                File::delete(public_path($category->category_icon));
            }

            $icon = $request->file('category_icon');

            $iconName = 'icon_' . time() . '_' . rand(1000, 9999) . '.' . $icon->getClientOriginalExtension();

            $icon->move($targetPath, $iconName);

            $category->category_icon = 'uploads/category_images/' . $iconName;
        }

        // Category Image
        if ($request->hasFile('category_image')) {

            // Delete Old Image
            if ($category->category_image && File::exists(public_path($category->category_image))) {
                File::delete(public_path($category->category_image));
            }

            $image = $request->file('category_image');

            $imageName = 'image_' . time() . '_' . rand(1000, 9999) . '.' . $image->getClientOriginalExtension();

            $image->move($targetPath, $imageName);

            $category->category_image = 'uploads/category_images/' . $imageName;
        }

        $category->category_name = $request->category_name;
        $category->sort_order    = $request->sort_order ?? 0;
        $category->status        = $request->status;

        $category->save();

        return back()->with('success', 'Category Updated Successfully.');
    }

    // Delete Category
    public function deleteCategory($id)
    {
        $category = CategoryModel::findOrFail($id);

        if (SubCategoryModel::where('category_id', $id)->count() > 0) {
            return back()->with('error', 'First delete all sub categories.');
        }

        $category->delete();

        return back()->with('success', 'Category Deleted Successfully.');
    }

    // Store Sub Category
    // Store Sub Category
    public function storeSubCategory(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',

            'sub_category_name' => [
                'required',
                Rule::unique('sub_categories')->where(function ($q) use ($request) {
                    return $q->where('category_id', $request->category_id);
                }),
            ],

            'icon' => 'required|image|mimes:png,jpg,jpeg,svg,webp|max:2048',
            'status' => 'required|in:0,1',
        ]);

        $targetPath = public_path('uploads/category_images');


        if (!File::exists($targetPath)) {
            File::makeDirectory($targetPath, 0777, true);
        }

        $iconName = null;

        if ($request->hasFile('icon')) {

            $icon = $request->file('icon');

            $iconName = 'sub_icon_' . time() . '_' . rand(1000, 9999) . '.' . $icon->getClientOriginalExtension();

            $icon->move($targetPath, $iconName);
        }

        SubCategoryModel::create([
            'category_id'          => $request->category_id,
            'sub_category_name'    => $request->sub_category_name,
            'icon'                 => 'uploads/category_images/' . $iconName,
            'base_price'           => $request->base_price ?? 0.00,
            'visiting_fee'         => $request->visiting_fee ?? 0.00,
            'tax_rate'             => $request->tax_rate ?? 18.00,
            'tax_type'             => $request->tax_type ?? 'inclusive',
            'service_charge'       => $request->service_charge ?? 0.00,
            'delivery_charge'      => $request->delivery_charge ?? 0.00,
            'delivery_charge_type' => $request->delivery_charge_type ?? 'service_wise',
            'commission_value'     => $request->commission_value ?? 10.00,
            'commission_type'      => $request->commission_type ?? 'percentage',
            'status'               => $request->status,
        ]);

        return back()->with('success', 'Sub Category Added Successfully.');
    }

    // Edit Sub Category
    public function editSubCategory($id)
    {
        $subCate = SubCategoryModel::findOrFail($id);
        $cates = CategoryModel::orderBy('category_name')->get();
        return view('editSubCategory', compact('cates', 'subCate'));
    }

    // Update Sub Category
    public function updateSubCategory(Request $request, $id)
    {
        $subcategory = SubCategoryModel::findOrFail($id);

        $request->validate([
            'category_id' => 'required|exists:categories,id',

            'sub_category_name' => [
                'required',
                Rule::unique('sub_categories')
                    ->where(function ($q) use ($request) {
                        return $q->where('category_id', $request->category_id);
                    })
                    ->ignore($subcategory->id),
            ],

            'icon' => 'nullable|image|mimes:png,jpg,jpeg,svg,webp|max:2048',
            'status' => 'required|in:0,1',
        ]);

        $targetPath = public_path('uploads/category_images');

        if ($request->hasFile('icon')) {

            // Delete Old Icon
            if ($subcategory->icon && File::exists(public_path($subcategory->icon))) {
                File::delete(public_path($subcategory->icon));
            }

            $icon = $request->file('icon');

            $iconName = 'sub_icon_' . time() . '_' . rand(1000, 9999) . '.' . $icon->getClientOriginalExtension();

            $icon->move($targetPath, $iconName);

            $subcategory->icon = 'uploads/category_images/' . $iconName;
        }

        $subcategory->category_id          = $request->category_id;
        $subcategory->sub_category_name    = $request->sub_category_name;
        $subcategory->base_price           = $request->base_price ?? 0.00;
        $subcategory->visiting_fee         = $request->visiting_fee ?? 0.00;
        $subcategory->tax_rate             = $request->tax_rate ?? 18.00;
        $subcategory->tax_type             = $request->tax_type ?? 'inclusive';
        $subcategory->service_charge       = $request->service_charge ?? 0.00;
        $subcategory->delivery_charge      = $request->delivery_charge ?? 0.00;
        $subcategory->delivery_charge_type = $request->delivery_charge_type ?? 'service_wise';
        $subcategory->commission_value     = $request->commission_value ?? 10.00;
        $subcategory->commission_type      = $request->commission_type ?? 'percentage';
        $subcategory->status               = $request->status;

        $subcategory->save();

        return back()->with('success', 'Sub Category Updated Successfully.');
    }

    // Delete Sub Category
    public function deleteSubCategory($id)
    {
        SubCategoryModel::findOrFail($id)->delete();

        return back()->with('success', 'Sub Category Deleted Successfully.');
    }
}
