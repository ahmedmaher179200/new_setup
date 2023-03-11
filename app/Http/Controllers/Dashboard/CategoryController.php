<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\CategoryTranslation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function index(){
        $categories = Category::tree()->get();
        return view('admins.categories.index')->with([
            'categories'    => $categories,
        ]);
    }

    public function create(){
        $categories = Category::tree(0)->get();

        return view('admins.categories.create')->with([
            'categories'    => $categories,
        ]);
    }

    public function store(Request $request){
        try{
            DB::beginTransaction();
                ($request->status== 1)? $active = 1: $active = 0;

                $new_category = Category::create([
                    'status'            => $active,
                    'parent_id'         => $request->parent_id,
                ]);

                foreach($request->categories as $key=>$category){
                    CategoryTranslation::create([
                        'name'              => $category['name'],
                        'locale'            => $key,
                        'category_id'       => $new_category['id'],
                    ]);
                }

            DB::commit();
            return redirect('dashboard/categories')->with('success', 'success');
        } catch(\Exception $ex){
            return redirect('dashboard/categories')->with('error', 'faild');
        }
    }

    public function edit($id){
        $categories = Category::tree(0)->get();
        $data = Category::findOrFail($id);

        return view('admins.categories.edit')->with([
            'categories'    => $categories,
            'data'  => $data,
        ]);
    }

    public function update(Request $request, $id){
        $category = Category::findOrFail($id);
        $categoriesTranslation = CategoryTranslation::where('category_id', $id)->get();

        try{
            DB::beginTransaction();
                ($request->status== 1)? $active = 1: $active = 0;

                $category->status            = $active;
                $category->parent_id         = $request->parent_id;
                $category->save();

                foreach($categoriesTranslation as $categoryTranslation){
                    $categoryTranslation->name = $request->categories[$categoryTranslation->locale]['name'];
                    $categoryTranslation->save();
                }

            DB::commit();
            return redirect('dashboard/categories')->with('success', 'success');
        } catch(\Exception $ex){
            return redirect('dashboard/categories')->with('error', 'faild');
        }
    }

    public function destroy($id){
        $category = Category::findOrFail($id);
        $category->delete();
        return redirect('dashboard/categories')->with('success', 'success');
    }
}
