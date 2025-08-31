@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <div class="content">

            <!-- Start Content-->
        <div class="container-xxl">

            <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
                <div class="flex-grow-1">
                    {{-- <h4 class="fs-18 fw-semibold m-0">Edit Slider</h4> --}}
                </div>
            </div>




            <div class="row">
                <div class="col-12">
                    <div class="card">

                        <div class="card-body">







                                <div class="tab-pane pt-4" id="profile_setting" role="tabpanel" aria-labelledby="setting_tab">
                                    <div class="row">

                                        <div class="row">
                                            <div class="col-lg-12 col-xl-12">
                                                <div class="card border mb-0">
                                        <form action="{{route('update.aboutus')}}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" name="id" id="id" value="{{$about->id}}">
                                            <div class="card-header">
                                                <div class="row align-items-center">
                                                    <div class="col">
                                                        <h4 class="card-title mb-0">Edit About</h4>
                                                    </div><!--end col-->
                                                </div>
                                            </div>

                                            <div class="card-body">
                                                <div class="form-group mb-3 row">
                                                    <label class="form-label"> Title</label>
                                                    <div class="col-lg-12 col-xl-12">
                                                        <input class="form-control" type="text" name='title' value="{{$about->title}}">
                                                    </div>
                                                </div>



                                                <div class="form-group mb-3 row">
                                                    <label class="form-label">Description</label>
                                                    <div class="col-lg-12 col-xl-12">

                                                        <textarea name="description" id="description"  class="form-control" style="display: none"></textarea>

                                                        <div id="quill-editor" style="height: 200px;">
                                                            {!! $about->description !!}
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group mb-3 row">
                                                    <label class="form-label">About Photo</label>
                                                    <div class="col-lg-12 col-xl-12">
                                                        <input class="form-control" type="file" name="image" id="image">
                                                    </div>
                                                </div>

                                                <div class="form-group mb-3 row">
                                                    <label class="form-label"> </label>
                                                    <div class="col-lg-12 col-xl-12">
                                                        <img id="showImage" src="{{asset($about->image)}}" class="rounded-circle avatar-xxl img-thumbnail float-start" alt="image profile">
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <div class="col-lg-12 col-xl-12">
                                                        <button type="submit" class="btn btn-primary">Save Changes </button>
                                                        {{-- <button type="button" class="btn btn-danger">Cancel</button> --}}
                                                    </div>
                                                </div>

                                            </div><!--end card-body-->

                                        </form>
                                                </div>
                                            </div>



                                        </div>
                                    </div>
                                </div> <!-- end education -->


                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
<script>
    document.querySelector('form').onsubmit = function () {
        var description = document.querySelector('#description');
        description.value = quill.root.innerHTML;
    };





    $(document).ready(function() {
        $('#image').change(function(e){
            var reader = new FileReader();
            reader.onload = function(e){
                $('#showImage').attr('src',e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        })
    })
</script>
@endsection
