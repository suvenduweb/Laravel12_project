@extends('admin.admin_master')
@section('admin')


    <!-- Start Content-->
<div class="container-xxl">

    <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#standard-modal">
                Add Blog Category
            </button>
    </div>
</div>


<!-- Datatables  -->
<div class="row">
    <div class="col-12">
        <div class="card">

            <div class="card-header">
                <h5 class="card-title mb-0">Basic Datatable</h5>
            </div><!-- end card header -->

            <div class="card-body">
                <table id="datatable" class="table table-bordered dt-responsive table-responsive nowrap">
                    <thead>
                    <tr>
                        <th>SL</th>
                        <th>Category Name</th>
                        <th>Category Slug</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($category as $key=> $item)

                        <tr>
                            <td>{{$key + 1}}</td>
                            <td>{{$item->category_name}}</td>
                            <td>{{$item->category_slug}}</td>

                            <td>

                                <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#category" id="{{$item->id}}" onclick="categoryEdit(this.id)">
                                    Edit
                                </button>
                                <a href="{{route('delete.blog.category',$item->id)}}" class="btn btn-danger btn-sm" id="delete">Delete</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>


<!-- Default Modal -->
<div class="modal fade" id="standard-modal" tabindex="-1" aria-labelledby="standard-modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="standard-modalLabel">Add Blog Category</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <form action="{{route('store.blog.category')}}" method="post">
                    @csrf
                    <div class="form-group col-md-12">
                        <label for="input1" class="form-label">Blog Category Name</label>
                        <input type="text" class="form-control" name="category_name" id="input1">
                    </div>


                    <div class="modal-footer">
                        {{-- <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button> --}}
                        <button type="sublit" class="btn btn-primary">Save changes</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>


<!-- Edit Category Id Modal -->
<div class="modal fade" id="category" tabindex="-1" aria-labelledby="standard-modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="standard-modalLabel">Edit Blog Category</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <form action="{{route('update.blog.category')}}" method="post">
                    @csrf
                    <input type="hidden"  name="cat_id" id="cat_id">
                    <div class="form-group col-md-12">
                        <label for="input1" class="form-label">Blog Category Name</label>
                        <input type="text" class="form-control" name="category_name" id="cat">
                    </div>


                    <div class="modal-footer">
                        {{-- <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button> --}}
                        <button type="sublit" class="btn btn-primary">Save changes</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>



</div> <!-- end card-body -->

<script>
    function categoryEdit($id){
        $('#cat').val('');
        $('#cat_id').val('');
        $.ajax({
            type: 'GET',
            url: '/edit/blog/category/'+$id,
            dataType: 'json',
            success:function(data){
                // console.log(data);
                $('#cat').val(data.category_name);
                $('#cat_id').val(data.id);
            }
        })
    }
</script>

@endsection
