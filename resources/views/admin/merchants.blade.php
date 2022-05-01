@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-md-6">
                <h3>Merchant List</h3>
            </div>
            <div class="col-md-6 mt-4 mt-md-0 productFormSm-area">
                <div class="create-new-items text-end">
                    <button class="btn btn-primary new-shop-btn" type="button" data-bs-toggle="modal" data-bs-target="#addCatModal" data-bs-original-title="" title="">
                        Add Merchant
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <!-- Individual column searching (text inputs) Starts-->
        <div class="col-sm-12">
            <div class="card">
                @if(session()->has('success'))
                <div class="alert alert-dismissible fade show alert-success" role="alert">
                    {{ session()->get('success')}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
                @if(session()->has('error'))
                <div class="alert alert-dismissible fade show alert-danger" role="alert">
                    {{ session()->get('error')}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
                <div class="card-header">
                    <h5>Merchant List </h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive product-table">
                        <table class="table row-border stripe hover " id="basic-5">
                            <thead>
                                <tr>
                                    <td>#</td>
                                    <td>Logo</td>
                                    <td>Name</td>
                                    <td>Action</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($merchants as $merchant)
                                <tr>
                                    <td>{{++$loop->index}}</td>
                                    <td><img src="{{asset($merchant->merchant_image)}}" width="50px" height="50px" style="border-radius:50%" /></td>
                                    <td>{{$merchant->merchant_name}}</td>
                                    <td>
                                        <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                                            <button onclick="viewMerchant('{{$merchant->id}}')" class="btn btn-primary" title="View Merchant Details"><i class="fa fa-eye"></i></button>
                                            <button class=" approve_btn btn btn-{{$merchant->is_approved ?'warning':'success'}}" data-message="{{$merchant->is_approved ?' want to unapprove this merchant ?' :'want to approve this merchant?'}}" data-href="{{route('admin.merchant.change-status',$merchant->id)}}" data-bs-original-title="" title="{{ $merchant->is_approved ? 'Un-Approve Merchant' :'Approve Merchant'}}"><i class="fa fa-{{ $merchant->is_approved ? 'times' :'check'}}"></i></button>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- Individual column searching (text inputs) Ends-->
    </div>
</div>
<div class="modal fade" id="merchant_details" tabindex="-1" aria-labelledby="product-modal-2" style="display: none;" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content p-4">
            <div class="modal-header border-0 mb-3">
                <h4 class="modal-title">Merchant Details</h4>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close" data-bs-original-title="" title=""></button>
            </div>
            <div class="modal-body"></div>
            <div class="modal-footer border-0 text-center text-sm-end">
                <button class="btn btn-secondary" data-bs-dismiss="modal" data-bs-original-title="" title="">Close</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="addCatModal" tabindex="-1" aria-labelledby="addCatModal" style="display: none;" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content p-4">
            <div class="modal-header border-0 mb-3">
                <h4 class="modal-title">Add Category</h4>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close" data-bs-original-title="" title=""></button>
            </div>
            <form class="theme-form" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label class="col-form-label pt-0">Merchant Name</label>
                    <input type="text" name="merchant_name" value="{{old('merchant_name')}}" class="form-control @error('merchant_name') is-invalid @enderror" required />
                    @error('merchant_name')
                    <span class="invalid-feedback text-danger" role="alert">
                        <strong>{{$message}}</strong>
                    </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="col-form-label pt-0">Category</label>

                    <select class="form-control @error('merchant_name') is-invalid @enderror" name="category_id" required>
                        <option value="">Select Category</option>
                        @foreach (\App\Models\Categories::get() as $cat)
                        <option value="{{$cat->id}}">{{$cat->category}}</option>
                        @endforeach
                    </select>
                    @error('category_id')
                    <span class="invalid-feedback text-danger" role="alert">
                        <strong>{{$message}}</strong>
                    </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="col-form-label pt-0">Merchant Logo</label>
                    <div class="input-group">
                        <input type="file" name="merchant_image" class="form-control @error('merchant_image') is-invalid @enderror" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04" aria-label="Upload" required>
                        @error('merchant_image')
                        <span class="invalid-feedback text-danger" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                        @enderror
                    </div>

                </div>

                <div class="modal-footer border-0 text-center text-sm-end">
                    <button class="btn btn-secondary" data-bs-dismiss="modal" data-bs-original-title="" title="">Cancel</button>
                    <button class="btn btn-primary" data-bs-original-title="" title="">Add </button>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection


@section('scripts')
<script src=" {{asset('assets/admin/js/datatable/datatables/jquery.dataTables.min.js')}}"></script>
<script>
    $('#basic-5').DataTable({});
    $('body').on('click', '.approve_btn', function() {
        var msg = $(this).attr('data-message');
        swal({
            text: msg,
            title: 'Are you sure',
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                location.replace($(this).attr("data-href"));
            }
        });
    })

    function viewMerchant(id) {
        $.ajax({
            url: '{{route("admin.merchant.view")}}',
            data: {
                id: id
            },
            method: 'POST',
            success: function(response) {
                if (response.status == 200) {
                    $('#merchant_details').modal('show');
                    $('#merchant_details .modal-body').html(response.html);
                } else {
                    swal({
                        title: 'Something Went Wrong !!!',
                        icon: "warning",
                    })
                }
            }
        })
    }
</script>
@if($errors->any())
<script>
    $('.new-shop-btn').trigger('click');
</script>
@endif
@endsection
