<?php


namespace App\Http\Controllers\Admin;

use App\Helpers\MyHelper;
use App\Http\Controllers\Controller;

use App\Services\CategoryService;
use Illuminate\Http\Request;
use App\Models\Category;
use DB;
use Auth;
use Illuminate\Support\Facades\Session;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Exception;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    protected $categoryService;
    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function index()
    {
        return view('admin.category.create');
    }

    public function categoryData(Request $request)
    {
        $columns = array(
            0 =>'id',
            2 =>'title_kh',
            3 =>'title_en',
            4=> 'is_active',
        );

        $totalData = Category::where('is_active',true)->count();
        $totalFiltered = $totalData;

        if($request->input('length') != -1)
            $limit = $request->input('length');
        else
            $limit = $totalData;
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        if(empty($request->input('search.value')))
            $categories = Category::offset($start)
                        ->where('is_active',true)
                        ->limit($limit)
                        ->orderBy($order,$dir)
                        ->get();
        else
        {
            $search = $request->input('search.value');
            $categories =  Category::where([
                            ['title_kh', 'LIKE', "%{$search}%"],
                            ['title_en', 'LIKE', "%{$search}%"],
                            ['is_active',true]
                        ])->offset($start)
                        ->limit($limit)
                        ->orderBy($order,$dir)->get();

            $totalFiltered = Category::where([
                            ['title_kh','LIKE',"%{$search}%"],
                            ['title_en','LIKE',"%{$search}%"],
                            ['is_active',true]
                        ])->count();
        }
        $data = array();
        if(!empty($categories))
        {
            foreach ($categories as $key=>$category)
            {
                $nestedData['id'] = $category->id;
                $nestedData['key'] = $key;

                if($category->image)
                    $nestedData['image'] = '<img src="'.url('images/category', $category->image).'" height="70" width="70">';
                else
                    $nestedData['image'] = '<img src="'.url('images/product/zummXD2dvAtI.png').'" height="80" width="80">';

                $nestedData['title_kh'] = $category->title_kh;
                $nestedData['title_en'] = $category->title_en;
                if ($category->is_active == true)
                    $nestedData['is_active'] = '<a href="'.route('category-status-update',[$category['id'],0]).'"  class=" btn btn-link" >Active</a>';
                elseif($category->is_active == false)
                    $nestedData['is_active'] = '<a href="'.route('category-status-update',[$category['id'],1]).'"  class=" btn btn-link" >Disabled</a>';
                $nestedData['options'] = '<div class="btn-group">
                            <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">'.trans("file.action").'
                              <span class="caret"></span>
                              <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <ul class="dropdown-menu edit-options dropdown-menu-right dropdown-default" user="menu">
                                <li>
                                    <button type="button" data-id="'.$category->id.'" class="open-EditCategoryDialog btn btn-link" data-toggle="modal" data-target="#editModal" ><i class="dripicons-document-edit"></i> '.trans("file.edit").'</button>
                                </li>
                                <li class="divider"></li>'.
                                \Form::open(["route" => ["category.destroy", $category->id], "method" => "DELETE"] ).'
                                <li>
                                  <button type="submit" class="btn btn-link" onclick="return confirmDelete()"><i class="dripicons-trash"></i> '.trans("file.delete").'</button>
                                </li>'.\Form::close().'
                            </ul>
                        </div>';
                $data[] = $nestedData;
            }
        }
        $json_data = array(
                    "draw"            => intval($request->input('draw')),
                    "recordsTotal"    => intval($totalData),
                    "recordsFiltered" => intval($totalFiltered),
                    "data"            => $data
                    );
        echo json_encode($json_data);
    }

    public function store(Request $request)
    {
        $data = $request->all();
        try {
            $this->categoryService->storeService($data);
        }catch (Exception $e){
            return redirect()->back()->with('not_permitted', $e->getMessage());
        }
        return redirect('category')->with('message', 'Category inserted successfully');
    }

    public function edit($id)
    {
        try {
            $lims_category_data = $this->categoryService->editService($id);
        }catch (Exception $e){
            return redirect()->back()->with('not_permitted', $e->getMessage());
        }
        return $lims_category_data;
    }

    public function update(Request $request)
    {
        $data = $request->all();
        try {
            $this->categoryService->updateService($data);
        }catch (Exception $e){
            return redirect()->back()->with('not_permitted', $e->getMessage());
        }
        return redirect('category')->with('message', 'Category updated successfully');
    }

    public function import(Request $request)
    {
        $upload=$request->file('file');
        try {
            $ext = pathinfo($upload->getClientOriginalName(), PATHINFO_EXTENSION);
            if($ext != 'csv')
                return redirect()->back()->with('not_permitted', 'Please upload a CSV file');
            $this->categoryService->importService($upload);
        }catch (Exception $e){
            return redirect()->back()->with('not_permitted', $e->getMessage());
        }
        return redirect('category')->with('message', 'Category imported successfully');
    }

    public function deleteBySelection(Request $request)
    {
        $category_id = $request['categoryIdArray'];
        try {
            $this->categoryService->deleteBySelectionService($category_id);
        }catch (Exception $e){
            return redirect()->back()->with('not_permitted', $e->getMessage());
        }
        return 'Category deleted successfully!';
    }

    public function destroy($id)
    {
        try {
            $this->categoryService->deleteService($id);
        }catch (Exception $e){
            return redirect()->back()->with('not_permitted', $e->getMessage());
        }
        return redirect('category')->with('not_permitted', 'Category deleted successfully');
    }


    public function status(Request $request)
    {
        $category = Category::find($request->id);
        $category->is_active = $request->is_active;
        $category->save();
        return back();
    }


}
