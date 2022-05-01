@extends('layouts.admin')

@section('content')
<style>
    p img {
        width: 100% !important;
    }
</style>
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-md-6">
                <h3>News List</h3>
            </div>
            <div class="col-md-6 mt-4 mt-md-0 productFormSm-area">
                <div class="create-new-items text-end">

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
                    <h5>News List </h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive product-table">
                        <table class="table row-border stripe hover " id="basic-5">
                            <thead>
                                <tr>
                                    <td>#</td>
                                    <td>Cover Image</td>
                                    <td>Title</td>
                                    <td>Is Approved</td>
                                    <td>Action</td>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($news as $singleNews)
                                @php
                                    $image = 'assets/images/default-news-image.png';
                                    if($singleNews->cover_image)
                                    {
                                    $image = $singleNews->cover_image;
                                    }
                                @endphp
                                <tr>
                                    <td>{{++$loop->index}}</td>
                                    <td><img src="{{asset($image)}}" width="100px" /></td>
                                    <td>{{$singleNews->title}}</td>
                                    <td>{{$singleNews->is_approved ? 'Approved' :' Not-Approved'}}</td>
                                    <td>
                                        <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                                            <button class="btn btn-primary " onclick="viewNews('{{$singleNews->id}}')" title="View News"><i class="fa fa-eye"></i></button>
                                            <button class="btn btn-{{$singleNews->is_approved ?'warning':'success'}} approve_btn" data-href="{{route('admin.news.change-status',$singleNews->id)}}" data-message="{{$singleNews->is_approved ?' want to unapprove this news?' : 'want to approve this news?'}}" data-id="{{$singleNews->id}}" title="{{$singleNews->is_approved ?'Un-approve News':'Approve News'}}"><i class="fa fa fa-{{$singleNews->is_approved ?'times':'check'}}"></i></button>
                                            <button class=" delete_news btn btn-xs btn-secondary" data-href="{{route('admin.news.delete',$singleNews->id)}}" title="Delete News"><i class="fa fa-trash"></i></button>
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
<div class="modal fade" id="News_details" tabindex="-1" aria-labelledby="product-modal-2" style="display: none;" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content p-4">
            <div class="modal-header border-0 mb-3">
                <h4 class="modal-title">News Details</h4>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close" title=""></button>
            </div>
            <div class="modal-body"></div>
            <div class="modal-footer border-0 text-center text-sm-end">
                <button class="btn btn-secondary" data-bs-dismiss="modal" title="">Close</button>
            </div>
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

    function viewNews(id) {
        $.ajax({
            url: '{{route("admin.news.view")}}',
            data: {
                id: id
            },
            method: 'POST',
            success: function(response) {
                if (response.status == 200) {
                    $('#News_details').modal('show');
                    $('#News_details .modal-body').html(response.html);
                } else {
                    swal({
                        title: 'Something Went Wrong !!!',
                        icon: "warning",
                    })
                }
            }
        })
    }

    $('body').on('click', '.delete_news', function() {
        swal({
            type: 'warning',
            title: 'Are you sure ?',
            text: 'Want to delete this News',
            buttons: [
                'No, cancel it!',
                'Yes, I am sure!'
            ],
            dangerMode: true,
        }).then((confirmed) => {
            if (confirmed) {
                location.replace($(this).attr('data-href'));
            }
        })
    })
</script>

@endsection
