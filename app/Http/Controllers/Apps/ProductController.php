<?php

namespace App\Http\Controllers\Apps;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    
    public function index()
    {
        addVendors(['datatables']);
		addJavascriptFile('assets/js/custom/apps/products/createvalidation.js');
        return view('pages/apps/products/index');

    }
	public function getProduct(Request $request){
        $columns = array(
			0 => 'id',
			1 => 'name',
			2 => 'price',
			4 => 'created_at',
			5 => 'action'
		);
		
		$totalData = Product::count();
		$limit = $request->input('length');
		$start = $request->input('start');
		$order = $columns[$request->input('order.0.column')];
		$dir = $request->input('order.0.dir');
		
		if(empty($request->input('search.value'))){
			$products = Product::offset($start)
				->limit($limit)
				->orderBy($order,$dir)
				->get();
			$totalFiltered = Product::count();
		}else{
			$search = $request->input('search.value');
			$products = Product::where([
				['name', 'like', "%{$search}%"],
			])
				->orWhere('created_at','like',"%{$search}%")
				->offset($start)
				->limit($limit)
				->orderBy($order, $dir)
				->get();
			$totalFiltered = Product::where([
				
				['name', 'like', "%{$search}%"],
			])
				->orWhere('name', 'like', "%{$search}%")
				->orWhere('created_at','like',"%{$search}%")
				->count();
		}
		
		
		$data = array();
		
		if($products){
			foreach($products as $r){
				$edit_url = route('products.edit',$r->id);
				
				$nestedData['name'] = $r->name;
				$nestedData['price'] = $r->price;
				$nestedData['created_at'] = date('d-m-Y',strtotime($r->created_at));
				$nestedData['action'] = '
                                <div>
                                <td>
                                    <a class="btn btn-sm btn-success" onclick="event.preventDefault();viewInfo('.$r->id.');" title="View Product" href="javascript:void(0)">
                                        view
                                    </a>
                                    <a title="Edit Product" class="btn btn-sm btn-primary" onclick="event.preventDefault();editInfo('.$r->id.');"
                                       href="javascript:void(0)">
                                       edit
                                    </a>
                                    <a class="btn btn-sm btn-danger" onclick="event.preventDefault();del('.$r->id.');" title="Delete Product" href="javascript:void(0)">
                                      delete
                                    </a>
                                </td>
                                </div>
                            ';
				$data[] = $nestedData;
			}
		}
		
		$json_data = array(
			"draw"			=> intval($request->input('draw')),
			"recordsTotal"	=> intval($totalData),
			"recordsFiltered" => intval($totalFiltered),
			"data"			=> $data
		);
		
		echo json_encode($json_data);
	}
	public function productDetail(Request $request){
        $product = Product::findOrFail($request->id);
		return view('pages.apps.products.detail', ['title' => 'Product Detail', 'product' => $product]);
	}
	public function productEdit(Request $request){
        $product = Product::findOrFail($request->id);
		return view('pages.apps.products.edit', ['title' => 'Product Edit', 'product' => $product]);
	}
    public function create()
    {
        //
    }

   
    public function store(Request $request)
    {
        
		$product = Product::create([
			'name' => $request->title,
			'price'	=> $request->price
		]);
		$editUrl = route('products.index');
        
        return response()->json([
            'editUrl' => $editUrl
        ]);
   
    }

    public function show(string $id)
    {
        //
    }


    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        $product = Product::where('id',$id)->update([
			'name' => $request->title,
			'price'	=> $request->price
		]);
		$editUrl = route('products.index');
        
        return response()->json([
            'editUrl' => $editUrl
        ]);
    }


    public function destroy( Request $request, $id)
    {
       
        $product  = Product::find($id);
        $product->delete();
        return redirect()->back();
    }
}
