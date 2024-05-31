<?php

namespace App\Http\Controllers\Apps;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;

class PostController extends Controller
{
    
    public function index()
    {
        addVendors(['datatables']);
		addJavascriptFile('assets/js/custom/apps/post/createvalidation.js');
        return view('pages/apps/posts/index');
    }

    public function getPosts(Request $request){
        $columns = array(
			0 => 'id',
			1 => 'title',
			2 => 'body',
			4 => 'created_at',
			5 => 'action'
		);
		
		$totalData = Post::count();
		$limit = $request->input('length');
		$start = $request->input('start');
		$order = $columns[$request->input('order.0.column')];
		$dir = $request->input('order.0.dir');
		
		if(empty($request->input('search.value'))){
			$posts = Post::offset($start)
				->limit($limit)
				->orderBy($order,$dir)
				->get();
			$totalFiltered = Post::count();
		}else{
			$search = $request->input('search.value');
			$posts = Post::where([
				['title', 'like', "%{$search}%"],
			])
				->orWhere('created_at','like',"%{$search}%")
				->offset($start)
				->limit($limit)
				->orderBy($order, $dir)
				->get();
			$totalFiltered = Post::where([
				
				['title', 'like', "%{$search}%"],
			])
				->orWhere('title', 'like', "%{$search}%")
				->orWhere('created_at','like',"%{$search}%")
				->count();
		}
		
		
		$data = array();
		
		if($posts){
			foreach($posts as $r){
				$edit_url = route('posts.edit',$r->id);
				
				$nestedData['title'] = $r->title;
				$nestedData['body'] = $r->body;
				$nestedData['created_at'] = date('d-m-Y',strtotime($r->created_at));
				$nestedData['action'] = '
                                <div>
                                <td>
                                    <a class="btn btn-sm btn-success" onclick="event.preventDefault();viewInfo('.$r->id.');" title="View Post" href="javascript:void(0)">
                                        view
                                    </a>
                                    <a title="Edit Post" class="btn btn-sm btn-primary" onclick="event.preventDefault();editInfo('.$r->id.');"
                                       href="javascript:void(0)">
                                       edit
                                    </a>
                                    <a class="btn btn-sm btn-danger" onclick="event.preventDefault();del('.$r->id.');" title="Delete Post" href="javascript:void(0)">
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
	public function postDetail(Request $request){
        $post = Post::findOrFail($request->id);
		return view('pages.apps.posts.detail', ['title' => 'Post Detail', 'post' => $post]);
	}
	public function postEdit(Request $request){
        $post = Post::findOrFail($request->id);
		return view('pages.apps.posts.edit', ['title' => 'Post Edit', 'post' => $post]);
	}
   

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
        ]);

        Auth::user()->posts()->create($request->all());
        $editUrl = route('posts.index');
        
        return response()->json([
            'editUrl' => $editUrl
        ]);

    }

    public function update(Request $request, string $id)
    {
        $post = Post::where('id',$id)->update([
			'title' => $request->title,
			'body'	=> $request->body
		]);
		$editUrl = route('posts.index');
        
        return redirect()->route('posts.index');
    }

    public function destroy(string $id)
    {
        $post  = Post::find($id);
        $post->delete();
        return redirect()->back();
    }
}
