<div class="card-datatable table-responsive">
    <form action="{{route('posts.update',$post->id)}}" method="post" id="post" >
        @csrf
        @method('put')
        <div class="fv-row mb-10">
            <label for="exampleFormControlInput1" class="required form-label">Post Title</label>
            <input type="text" name="title" id="title"  value="{{$post->title}}"  class="form-control" placeholder="Enter Product title" required/>
        </div>
        <div class="fv-row mb-10">
            <label for="exampleFormControlInput1" class="required form-label">Product Body</label>
            <textarea type="text" name="body" id="body" class="form-control" placeholder="Enter Post Description" required>{{$post->body}}</textarea>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-light  btn-sm" data-bs-dismiss="modal">Close</button>
            <button type="submit" id="kt_post" class="btn btn-primary btn-sm">Submit</button>
        </div>
    </form>
</div>