@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-md-6">
                <h3>Card Type List</h3>
            </div>
            <div class="col-md-6 mt-4 mt-md-0 productFormSm-area">
                <div class="create-new-items text-end">
                    <button class="btn btn-primary add-btn" type="button" data-bs-toggle="modal" data-bs-target="#addModal" data-bs-original-title="" title="">
                        Add Card Type
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
                <div class="card-header">
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
                </div>
                <div class="card-body">
                    <div class="table-responsive product-table">
                        <table class="table row-border stripe hover " id="basic-5">
                            <thead>
                                <tr>
                                    <td>#</td>
                                    <td>Name</td>
                                    <td>Total Added Cards</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($types as $type)
                                <tr>
                                    <td>{{++$loop->index}}</td>
                                    <td>{{$type->label}}</td>
                                    <td>{{$type->cards->count()}}</td>
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
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModal" style="display: none;" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content p-4">
            <div class="modal-header border-0 mb-3">
                <h4 class="modal-title">Add Card Type</h4>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close" data-bs-original-title="" title=""></button>
            </div>
            <form class="theme-form" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="col-form-label pt-0">Card Type Name</label>
                    <input type="text" name="label" value="{{old('label')}}" class="form-control @error('label') is-invalid @enderror" />
                    @error('label')
                    <span class="invalid-feedback text-danger" role="alert">
                        <strong>{{$message}}</strong>
                    </span>
                    @enderror
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
<script src="{{asset('assets/admin/js/datatable/datatables/jquery.dataTables.min.js')}}"></script>
<script>
    $('#basic-5').DataTable({});
</script>
@if($errors->any())
<script>
    $('.add-btn').trigger('click');
</script>
@endif
@endsection
