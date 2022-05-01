@extends('layouts.app')
@section('title', 'Bank Details - '.$bank['bank_name'])
@section('content')
<div class="main-wrapper">
    <div class="mainContainer">
        @include('includes.sidemenu')
        <div id="site-wrapper">
            <!-- Topbar -->
            <nav class="navbar header-topbar navbar-light mb-3">
                <div class="container d-flex justify-content-between align-items-center flex-fill">
                    <div class="d-flex align-items-center">
                        <a href="{{route('home')}}" class="page-back-btn rounded-circle d-block"></a>
                    </div>
                    <div>
                        <h1 class="small fw-medium text-center m-0">Bank Details</h1>
                    </div>
                    <div>
                        <a href="#" class="humburger-menu-btn toggle-nav d-block"></a>
                    </div>
                </div>
            </nav>
            <div class="wrapper">
                <div class="container">
                    @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @elseif (session('success'))
                    <div class="alert alert-success alert-dismissible alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif

                    @if(count($errors))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Whoops!</strong> There were some problems with your input.
                        <br />
                        <ul>
                            @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif
                    <form method="post" enctype="multipart/form-data" action="{{route('bank_details_update')}}" id="card_add_form">
                        @csrf
                        <div class="mb-3 {{ $errors->has('bank_name') ? 'has-error' : ''}}">
                            <label for="bank_name" class="form-label">Bank Name *</label>
                            <input type="text" class="form-control" name="bank_name" required id="bank_name" value="{{count($errors) ? old('bank_name') : $bank['bank_name']}}" />
                            <span class="text-danger">{{ $errors->first('bank_name') }}</span>
                        </div>
                        <div class="mb-3 {{ $errors->has('bank_hotline') ? 'has-error' : '' }}">
                            <label for="bank_hotline" class="form-label">Bank Hotline *</label>
                            <input type="text" class="form-control" name="bank_hotline" required id="bank_hotline" value="{{count($errors) ? old('bank_hotline') : $bank['bank_hotline']}}" />
                            <span class="text-danger">{{ $errors->first('bank_hotline') }}</span>
                        </div>
                        <div class="mb-3 {{ $errors->has('shortcut_speak') ? 'has-error' : '' }}">
                            <label for="shortcut_speak" class="form-label">Shortcut Speak *</label>
                            <input type="text" class="form-control" name="shortcut_speak" required id="shortcut_speak" value="{{count($errors) ? old('shortcut_speak') : $bank['shortcut_speak']}}" />
                            <span class="text-danger">{{ $errors->first('shortcut_speak') }}</span>
                        </div>
                        <div class="mb-3 {{ $errors->has('redeem_web') ? 'has-error' : '' }}">
                            <label for="redeem_web" class="form-label">Redeem Web *</label>
                            <input type="text" class="form-control" name="redeem_web" required id="redeem_web" value="{{count($errors) ? old('redeem_web') : $bank['redeem_web']}}" />
                            <span class="text-danger">{{ $errors->first('redeem_web') }}</span>
                        </div>
                        <div class="mb-3 {{ $errors->has('min_age') ? 'has-error' : '' }}">
                            <label for="min_age" class="form-label">Minimum Age *</label>
                            <input type="number" class="form-control" name="min_age" required min="1" max="150" id="min_age" value="{{count($errors) ? old('min_age') : $bank['min_age']}}" />
                            <span class="text-danger">{{ $errors->first('min_age') }}</span>
                        </div>
                        <div class="mb-3 {{ $errors->has('min_age_sub') ? 'has-error' : '' }}">
                            <label for="min_age_sub" class="form-label">Minimum Age for Subsequent *</label>
                            <input type="number" class="form-control" name="min_age_sub" id="min_age_sub" required min="1" max="150" value="{{count($errors) ? old('min_age_sub') : $bank['min_age_sub']}}" />
                            <span class="text-danger">{{ $errors->first('min_age_sub') }}</span>
                        </div>
                        <div class="mb-3 ">
                            <label for="point_name" class="form-label ">Point Name</label>
                            <input type="text" class="form-control" name="point_name" id="point_name" value="{{count($errors) ? old('point_name') : $bank['point_name']}}" />
                        </div>
                        <div class="mb-3 {{ $errors->has('point_value_rm') ? 'has-error' : '' }}">
                            <label for="point_value_rm" class="form-label">Point Value in RM*</label>
                            <input type="number" step="0.01" class="form-control" name="point_value_rm" id="point_value_rm" value="{{count($errors) ? old('point_value_rm') : $bank['point_value_rm']}}" />
                            <span class="text-danger">{{ $errors->first('point_value_rm') }}</span>
                        </div>
                        <div class="mb-3 {{ $errors->has('point_rebate_percentage') ? 'has-error' : '' }} ">
                            <label for="point_rebate_percentage" class="form-label">Point Rebate Percentage*</label>
                            <input type="number" step="0.01" class="form-control" name="point_rebate_percentage" id="point_rebate_percentage" value="{{count($errors) ? old('point_rebate_percentage') : $bank['point_rebate_percentage']}}" />
                            <span class="text-danger">{{ $errors->first('point_rebate_percentage') }}</span>
                        </div>
                        <div class="mb-3 {{ $errors->has('late_charge_fee') ? 'has-error' : '' }}">
                            <label for="late_charge_fee" class="form-label">Late Charge Fee *</label>
                            <input type="number" step="0.01" class="form-control" name="late_charge_fee" id="late_charge_fee" value="{{count($errors) ? old('late_charge_fee') : $bank['late_charge_fee']}}" />
                            <span class="text-danger">{{ $errors->first('late_charge_fee') }}</span>
                        </div>
                        <div class="mb-3 {{ $errors->has('interest_rate') ? 'has-error' : '' }}">
                            <label for="interest_rate" class="form-label">Interest Rate(%) *</label>
                            <input type="number" step="0.01" class="form-control" name="interest_rate" id="interest_rate" value="{{count($errors) ? old('interest_rate') : $bank['interest_rate']}}" />
                            <span class="text-danger">{{ $errors->first('interest_rate') }}</span>
                        </div>
                        <div class="mb-3 {{ $errors->has('cash_out_interest') ? 'has-error' : '' }} ">
                            <label for="cash_out_interest" class="form-label">Cashout Interest(%) *</label>
                            <input type="number" step="0.01" class="form-control" name="cash_out_interest" id="cash_out_interest" value="{{count($errors) ? old('cash_out_interest') : $bank['cash_out_interest']}}" />
                            <span class="text-danger">{{ $errors->first('cash_out_interest') }}</span>
                        </div>
                        <div class="mb-3 {{ $errors->has('cash_out_first_charge') ? 'has-error' : '' }} ">
                            <label for="cash_out_first_charge" class="form-label">Cashout Fee *</label>
                            <input type="text" class="form-control" name="cash_out_first_charge" id="cash_out_first_charge" value="{{count($errors) ? old('cash_out_first_charge') : $bank['cash_out_first_charge']}}" />
                            <span class="text-danger">{{ $errors->first('cash_out_first_charge') }}</span>
                        </div>
                        <div class="mb-3">
                            <label for="min_age_sub" class="form-label">Hotline Timings *</label>
                            <table class="table table-bordeless">
                                <thead>
                                    <tr>
                                        <th scope="col">Day</th>
                                        <th scope="col">Serviceable</th>
                                        <th scope="col">From</th>
                                        <th scope="col">To</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($bank['hotline_time'] as $key => $time)
                                    <tr>
                                        @php
                                        $hotline_time = (isset($time) && $time['start_time'] == '' && $time['end_time'] == '') ? true : false
                                        @endphp
                                        <th scope="row">{{ucfirst($key)}}</th>
                                        <td>
                                            @if (isset($hotline_serviceable))
                                                {{$hotline_serviceable[$key]}}
                                            @endif
                                            <select class="hotline_serviceable" name="hotline_serviceable[{{$key}}]">
                                                <option value="yes">Yes</option>
                                                <option value="no" {{((isset($hotline_serviceable) && $hotline_serviceable[$key] == 'no') || $hotline_time) ? 'selected': ''}}>No</option>
                                            </select>
                                        </td>
                                        <td><input type="time" name="hotline_time[{{$key}}][start_time]" {{($hotline_time) ? 'disabled': ''}} required value="{{$time['start_time']}}"/></td>
                                        <td><input type="time" name="hotline_time[{{$key}}][end_time]" {{($hotline_time) ? 'disabled': ''}} required value="{{$time['end_time']}}"/></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <button type="submit" class="btn btn-primary" >Submit</button>
                        <a class="btn btn-secondary" href="{{route('bank_details')}}">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@section('js_script')
<script type="text/javascript">
    $(".hotline_serviceable").on("change", function() {
        if ($(this).val() == 'no') {
            $(this).closest('tr').find('input').val('');
            $(this).closest('tr').find('input').attr('disabled', true);
        } else {
            $(this).closest('tr').find('input').removeAttr('disabled');
        }

    });
</script>
@endsection