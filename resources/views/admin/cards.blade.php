@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-md-6">
                <h3>Card Type List</h3>
            </div>
            <div class="col-md-6 mt-4 mt-md-0 productFormSm-area">

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
                                    <td>Image</td>
                                    <td>Name</td>
                                    <td>Card Type</td>
                                    <td>Bank </td>
                                    <td>Action</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cards as $card)
                                <tr>
                                    <td>{{++$loop->index}}</td>
                                    <td> <img src="{{asset($card->card_image)}}" width="50" /></td>
                                    <td> {!!$card->card_name!!}</td>
                                    <td> {!!$card->type->label!!}</td>
                                    <td> {!!$card->bank->bank_name!!}</td>
                                    <td>
                                        <button onclick="viewCard('{{$card->id}}')" class="btn btn-primary" title="View Card Details"><i class="fa fa-eye"></i></button>
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
                <h4 class="modal-title">Card Details</h4>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close" data-bs-original-title="" title=""></button>
            </div>
            <div class="modal-body" id="card-details"></div>
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
    $('#basic-5').DataTable({
        aoColumnDefs: [{
            bSortable: false,
            aTargets: [3, 4]
        }],
        initComplete: function() {
            this.api().columns([3, 4]).every(function() {
                var column = this;
                var select = $('<select><option value="">All ' + column.header().textContent + '</option></select>')
                    .appendTo($(column.header()).empty())
                    .on('change', function() {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );

                        column
                            .search(val ? '^' + val + '$' : '', true, false)
                            .draw();
                    });

                column.data().unique().sort().each(function(d, j) {
                    select.append('<option value="' + d + '">' + d + '</option>')
                });
            });
        }
    });

    function viewCard(id) {
        $.ajax({
            url: '{{route("admin.cards.view")}}',
            method: 'POST',
            data: {
                id: id,
            },
            success: function(response) {

                if (response.status == 200) {
                    $('#card-details').html(response.html);
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
