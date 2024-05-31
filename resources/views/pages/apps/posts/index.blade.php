<x-default-layout>

    @section('title')
        Posts
    @endsection
        <div class="card card-custom">
        <div class="card-header">
            <div class="card-title">
           
            </div>
            <div class="card-toolbar">

                <!--begin::Button-->
                <a href="{{ route('posts.create') }}" class="btn btn-primary btn-sm font-weight-bolder" data-bs-toggle="modal" data-bs-target="#kt_modal_2">
                    <span class="svg-icon svg-icon-md">
                        <!--begin::Svg Icon | path:assets/media/svg/icons/Design/Flatten.svg-->
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                            height="24px" viewBox="0 0 24 24" version="1.1">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <rect x="0" y="0" width="24" height="24" />
                                <circle fill="#000000" cx="9" cy="15" r="6" />
                                <path
                                    d="M8.8012943,7.00241953 C9.83837775,5.20768121 11.7781543,4 14,4 C17.3137085,4 20,6.6862915 20,10 C20,12.2218457 18.7923188,14.1616223 16.9975805,15.1987057 C16.9991904,15.1326658 17,15.0664274 17,15 C17,10.581722 13.418278,7 9,7 C8.93357256,7 8.86733422,7.00080962 8.8012943,7.00241953 Z"
                                    fill="#000000" opacity="0.3" />
                            </g>
                        </svg>
                        <!--end::Svg Icon-->
                    </span>New Post</a>
                    <div class="modal fade" tabindex="-1" id="kt_modal_2">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h3 class="modal-title">Add Post</h3>
                    
                                    <!--begin::Close-->
                                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                                        <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                                    </div>
                                    <!--end::Close-->
                                </div>
                    
                                <div class="modal-body">
                                    <form action="{{route('posts.store')}}" method="post" id="post" >
                                        @csrf
                                        <div class="fv-row mb-10">
                                            <label for="exampleFormControlInput1" class="required form-label">Post Title</label>
                                            <input type="text" name="title" id="title" class="form-control" placeholder="Enter Post title"/>
                                        </div>
                                        <div class="fv-row mb-10">
                                            <label for="exampleFormControlInput1" class="required form-label">Post Description</label>
                                            <textarea type="text" name="body" id="body" class="form-control" placeholder="Enter Post Description"></textarea>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-light  btn-sm" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" id="kt_post" class="btn btn-primary btn-sm">Submit</button>
                                        </div>
                                    </form>
                                </div>
                    
                               
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" tabindex="-1" id="kt_modal_3">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h3 class="modal-title">Add Post </h3>
                    
                                    <!--begin::Close-->
                                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                                        <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                                    </div>
                                    <!--end::Close-->
                                </div>
                    
                                <div class="modal-body">
                                   
                                </div>
                    
                               
                            </div>
                        </div>
                    </div>
            </div>
        </div>
        <div class="card-body">
            
            <div class="table-responsive">
              
                   
                <table class="table table-bordered table-hover table-checkable" id="posts"
                    style="margin-top: 13px !important">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Decription</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                </table>
            
            </div>
        </div>
     

        <div class="modal fade" tabindex="-1" id="kt_modal_1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title">Post  Detail</h3>

                        <!--begin::Close-->
                        <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                            <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                        </div>
                        <!--end::Close-->
                    </div>

                    <div class="modal-body">
                    
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    
                    </div>
                </div>
            </div>
        </div>
        
    </div>

</x-default-layout>

  



