@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-6">
                <h3>Dashboard</h3>
            </div>
            <div class="col-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}" data-bs-original-title="" title=""> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home">
                                <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                <polyline points="9 22 9 12 15 12 15 22"></polyline>
                            </svg></a></li>
                    <li class="breadcrumb-item active">Banks List</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <!-- Individual column searching (text inputs) Starts-->
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5>Banks List </h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive product-table">
                        <table class="table row-border stripe hover " id="basic-5">
                            <thead>
                                <tr>
                                    <td>#</td>
                                    <td>Logo</td>
                                    <td>Name</td>
                                    <td>Total Added Cards</td>
                                    <td>Action</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($banks as $bank)
                                <tr>
                                    <td>{{++$loop->index}}</td>
                                    <td><img src="{{asset($bank->bank_logo)}}" width="50px" height="50px" style="border-radius:50%" /></td>
                                    <td>{{$bank->bank_name}}</td>
                                    <td>{{$bank->cards->count()}}</td>
                                    <td>
                                        <button onclick="viewBank('{{$bank->id}}')" class="btn btn-primary" title="View Bank Details"><i class="fa fa-eye"></i></button>
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
<div class="modal fade" id="detail_modal" tabindex="-1" aria-labelledby="product-modal-2" style="display: none;" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content p-4">
            <div class="modal-header border-0 mb-3">
                <h4 class="modal-title">Bank Details</h4>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close" data-bs-original-title="" title=""></button>
            </div>
            <div class="modal-body" id="bank-details"></div>
            <div class="modal-footer border-0 text-center text-sm-end">
                <button class="btn btn-secondary" data-bs-dismiss="modal" data-bs-original-title="" title="">Close</button>
            </div>
        </div>
    </div>
</div>
@endsection


@section('scripts')
<script src="{{asset('assets/admin/js/datatable/datatables/jquery.dataTables.min.js')}}"></script>
<script>
    $('#basic-5').DataTable({});

    function viewBank(id) {
        $.ajax({
            url: '{{route("admin.banks.view")}}',
            method: 'POST',
            data: {
                id: id,
            },
            success: function(response) {

                if (response.status == 200) {
                    $('#bank-details').html(response.html);
                    $('#detail_modal').modal('show');
                } else {
                    swal({
                        type: 'error',
                        title: 'Error',
                        text: 'Something went wrong. Please try again'
                    });
                }
            }
        })
    }
</script>
@endsection
