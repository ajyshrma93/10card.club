@extends('layouts.app')
@section('title', (isset($card_form['card_name'])) ? 'Edit Card - '.$card_form['card_name'] : 'Add Card')
@section('css')
<style type="text/css">
    .hide {
        display: none;
    }

    input[type="text"][disabled] {
        color: #a1a1a1;
        cursor: not-allowed;
    }

    input[type="number"][disabled] {
        color: #a1a1a1;
        cursor: not-allowed;
    }

    form.cmxform label.error,
    label.error {
        color: red;
        font-style: italic;
    }

    form.cmxform div.error,
    div.error {
        color: red;
        font-style: italic;
    }

    select.error {
        border: 1px solid red;
    }

    textarea.error {
        border: 1px solid red;
    }

    .card {
        margin-bottom: 10px;
    }
</style>
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
@endsection
@section('content')
<div class="main-wrapper">
    <div class="mainContainer">
        @include('includes.sidemenu')
        <div id="site-wrapper">
            <!-- Topbar -->
            <nav class="navbar header-topbar navbar-light mb-3">
                <div class="container d-flex justify-content-between align-items-center flex-fill">
                    <div class="d-flex align-items-center">
                        <a href="{{route('card_list')}}" class="page-back-btn rounded-circle d-block"></a>
                    </div>
                    <div>
                        <h1 class="small fw-medium text-center m-0">Add Card</h1>
                    </div>
                    <div>
                        <a href="#" class="humburger-menu-btn toggle-nav d-block"></a>
                    </div>
                </div>
            </nav>
            <div class="wrapper">
                <div class="container">
                    <div class="alert alert-dismissible fade show" :class="{'alert-danger': message.type == 'error','alert-success': message.type == 'success'}" v-for="message in messageBox" :index="message.index" role="alert">
                        @{{ message.message }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    <form method="post" novalidate @submit.prevent="addCard" enctype="multipart/form-data" @change="form.onChange($event)" @keydown="form.onKeydown($event)" action="{{$form_action}}" id="card_add_form">
                        @csrf
                        <div class="card">
                            <div class="card-header">
                                <h5>Card Information</h5>
                            </div>
                            <div class="card-body">
                                <div class="form-group row">
                                    <div class="mb-3" :class="{'has-error': form.errors.has('card_type_id')}">
                                        <label for="card_type_id" class="form-label">Card Type *</label>
                                        <select class="form-select" name="card_type_id" v-model="form.card_type_id">
                                            <option value="">--Select--</option>
                                            <option v-for="card_type in card_types" :key="card_type.id" v-bind:value="card_type.id">
                                                @{{ card_type.label }}
                                            </option>
                                        </select>
                                        <div class="text-danger" v-if="form.errors.has('card_type_id')" v-html="form.errors.get('card_type_id')"></div>
                                    </div>

                                    <div class="mb-3" :class="{'has-error': form.errors.has('card_name')}">
                                        <label for="card_name" class="form-label">Card Name *</label>
                                        <input type="text" class="form-control" name="card_name" v-model="form.card_name" id="card_name" value="{{ old('card_name') }}" />
                                        <div class="text-danger" v-if="form.errors.has('card_name')" v-html="form.errors.get('card_name')"></div>
                                    </div>
                                    <img :src="card_image" v-if="card_image !== null" style="width: 100px;height: 50px;" />
                                    <div class="mb-3" :class="{'has-error': form.errors.has('card_image')}">
                                        <label for="card_image" class="form-label">Card Image *</label>
                                        <input class="form-control" type="file" id="card_image" name="card_image" @change="handleFile($event,'card_image')" />
                                        <div class="text-danger" v-if="form.errors.has('card_image')" v-html="form.errors.get('card_image')"></div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="card_des" class="form-label">Short Description</label>
                                        <textarea class="form-control" id="card_des" v-model="form.card_des" rows="6" name="card_des"></textarea>
                                    </div>
                                    <div class="mb-3" :class="{'has-error': form.errors.has('card_info_url')}">
                                        <label for="card_info_url" class="form-label">Card Information URL *</label>
                                        <input type="text" class="form-control" name="card_info_url" id="card_info_url" v-model="form.card_info_url" />
                                        <div class="text-danger" v-if="form.errors.has('card_info_url')" v-html="form.errors.get('card_info_url')"></div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="redeem_web" class="form-label">Redeem Website</label>
                                        <input type="text" class="form-control" name="redeem_web" id="redeem_web" disabled readonly value="{{$bank->redeem_web}}" />
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header">
                                <h5>Bank Details</h5>
                            </div>
                            <div class="card-body">
                                <div class="form-group row">
                                    <div class="mb-3">
                                        <label for="bank_name" class="form-label">Bank</label>
                                        <input type="text" class="form-control" name="bank_name" id="bank_name" value="{{$bank->bank_name}}" disabled readonly />
                                    </div>
                                    <div class="mb-3">
                                        <label for="bank_hotline" class="form-label">Bank Hotline No</label>
                                        <input type="text" class="form-control" name="bank_hotline" id="bank_hotline" value="{{$bank->bank_hotline}}" disabled readonly />
                                    </div>
                                    <div class="mb-3">
                                        <ul class="list-unstyled cash-rebate-list banking-info mb-2">
                                            <li class="d-flex flex-wrap">
                                                <div class="cash-debate-info">
                                                    <h4 class="fw-medium">Service Hour Call</h4>
                                                    <div class="days-hours">
                                                        @foreach ($bank->hotline_time as $key => $value)
                                                        <p class="d-flex">
                                                            <span class="d-inline-block day-name me-2">{{ substr(ucfirst($key),0,3) }}</span>
                                                            @if ($value['start_time'] != '' || $value['end_time'] != '')
                                                            {{date("h:i A", strtotime($value['start_time']))}} - {{date("h:i A", strtotime($value['end_time']))}}
                                                            @else
                                                            Not serviceable
                                                            @endif

                                                        </p>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="mb-3">
                                        <label for="shortcut_speak" class="form-label">Shortcut Speak</label>
                                        <input type="text" class="form-control" name="shortcut_speak" id="shortcut_speak" disabled readonly value="{{$bank->shortcut_speak}}" />
                                    </div>
                                    <div class="mb-3">
                                        <label for="min_age" class="form-label">Minimum Age</label>
                                        <input type="number" class="form-control" name="min_income" id="min_age" disabled readonly value="{{$bank->min_age}}" />
                                    </div>
                                    <div class="mb-3">
                                        <label for="min_age_sub" class="form-label">Minimum Age Sub</label>
                                        <input type="number" class="form-control" name="min_age_sub" id="min_age_sub" disabled readonly value="{{$bank->min_age_sub}}" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h5>Card Rebate</h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="pointRebate" value="point" name="rebate_type[]" v-model="form.rebate_type">
                                        <label class="form-check-label" for="pointRebate">Point Rebate</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="cashRebate" value="cash" name="rebate_type[]" v-model="form.rebate_type">
                                        <label class="form-check-label" for="cashRebate">Cash Rebate</label>
                                    </div>
                                    <div class="text-danger" v-if="form.errors.has('rebate_type')" v-html="form.errors.get('rebate_type')"></div>
                                </div>
                                <div class="mb-3" :class="{'has-error': form.errors.has('point_value_rm'),'hide': !form.rebate_type.includes('point')}">
                                    <label for="point_value_rm" class="form-label">Point Value in RM*</label>
                                    <input type="number" step="0.01" class="form-control" name="point_value_rm" id="point_value_rm" v-model="form.point_value_rm" />
                                    <div class="text-danger" v-if="form.errors.has('point_value_rm')" v-html="form.errors.get('point_value_rm')"></div>
                                </div>
                                <div class="mb-3" :class="{'has-error': form.errors.has('point_rebate_percentage'),'hide': !form.rebate_type.includes('point')}">
                                    <label for="point_rebate_percentage" class="form-label">Point Rebate Percentage*</label>
                                    <input type="number" step="0.01" class="form-control" name="point_rebate_percentage" id="point_rebate_percentage" v-model="form.point_rebate_percentage" />
                                    <div class="text-danger" v-if="form.errors.has('point_rebate_percentage')" v-html="form.errors.get('point_rebate_percentage')"></div>
                                </div>
                                <div class="mb-3">
                                    <label for="point_or_cashrebate_description" class="form-label">Rebate Description</label>
                                    <textarea class="form-control" id="point_or_cashrebate_description" rows="6" name="point_or_cashrebate_description" v-model="form.point_or_cashrebate_description"></textarea>
                                </div>
                                <div class="mb-3" :class="{'hide': !form.rebate_type.includes('point')}">
                                    <label for="point_name" class="form-label ">Point Name</label>
                                    <input type="text" class="form-control" name="point_name" id="point_name" v-model="form.point_name" />
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h5>Card Charges</h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-3" :class="{'has-error': form.errors.has('annual_fee_free_for')}">
                                    <label for="annual_fee_free_for" class="form-label">Annual Fee Free For ? *</label>
                                    <select class="form-select" name="annual_fee_free_for" id="annual_fee_free_for" v-model="form.annual_fee_free_for">
                                        <option value="">--Select--</option>
                                        <option value="one_year">Free for 1 year</option>
                                        <option value="lifetime">Free for lifetime</option>
                                        <option value="no">Not applicable</option>
                                    </select>
                                    <div class="text-danger" v-if="form.errors.has('annual_fee_free_for')" v-html="form.errors.get('annual_fee_free_for')"></div>
                                </div>
                                <div class="mb-3" :class="{'has-error': form.errors.has('annual_fee'),'hide': form.annual_fee_free_for == 'lifetime' || form.annual_fee_free_for == ''}">
                                    <label for="annual_fee" class="form-label">Annual Fee*</label>
                                    <input type="number" step="0.01" class="form-control" name="annual_fee" id="annual_fee" v-model="form.annual_fee" />
                                    <div class="text-danger" v-if="form.errors.has('annual_fee')" v-html="form.errors.get('annual_fee')"></div>
                                </div>
                                <div class="mb-3" :class="{'has-error': form.errors.has('annual_fee_sub'),'hide': form.annual_fee_free_for == 'lifetime' || form.annual_fee_free_for == ''}">
                                    <label for="annual_fee_sub" class="form-label">Annual Fee of Subsidiary*</label>
                                    <input type="number" step="0.01" class="form-control" name="annual_fee_sub" id="annual_fee_sub" v-model="form.annual_fee_sub" />
                                    <div class="text-danger" v-if="form.errors.has('annual_fee_sub')" v-html="form.errors.get('annual_fee_sub')"></div>
                                </div>
                                <div class="mb-3" :class="{'hide': form.annual_fee_free_for == 'lifetime' || form.annual_fee_free_for == 'no' ||form.annual_fee_free_for == ''}">
                                    <label for="annual_fee_waived" class="form-label">Annual Fee Waived Description</label>
                                    <textarea class="form-control" id="annual_fee_waived" rows="6" name="annual_fee_waived" v-model="form.annual_fee_waived"></textarea>
                                </div>
                                <div class="mb-3" :class="{'has-error': form.errors.has('late_charge_fee')}">
                                    <label for="late_charge_fee" class="form-label">Late Charge Fee *</label>
                                    <input type="number" step="0.01" class="form-control" name="late_charge_fee" id="late_charge_fee" v-model="form.late_charge_fee" />
                                    <div class="text-danger" v-if="form.errors.has('late_charge_fee')" v-html="form.errors.get('late_charge_fee')"></div>
                                </div>
                                <div class="mb-3" :class="{'has-error': form.errors.has('interest_rate')}">
                                    <label for="interest_rate" class="form-label">Interest Rate(%) *</label>
                                    <input type="number" step="0.01" class="form-control" name="interest_rate" id="interest_rate" v-model="form.interest_rate" />
                                    <div class="text-danger" v-if="form.errors.has('interest_rate')" v-html="form.errors.get('interest_rate')"></div>
                                </div>
                                <div class="mb-3" :class="{'has-error': form.errors.has('cashout_can')}">
                                    <label for="cashout_can" class="form-label">Can Cashout ? *</label>
                                    <select class="form-select" name="cashout_can" id="cashout_can" v-model="form.cashout_can">
                                        <option value="">--Select--</option>
                                        <option value="yes">Yes</option>
                                        <option value="no">No</option>
                                    </select>
                                    <div class="text-danger" v-if="form.errors.has('cashout_can')" v-html="form.errors.get('cashout_can')"></div>
                                </div>
                                <div class="mb-3" :class="{'has-error': form.errors.has('cash_out_interest'),'hide': form.cashout_can == 'no' || form.cashout_can == ''}">
                                    <label for="cash_out_interest" class="form-label">Cashout Interest(%) *</label>
                                    <input type="number" step="0.01" class="form-control" name="cash_out_interest" id="cash_out_interest" v-model="form.cash_out_interest" />
                                    <div class="text-danger" v-if="form.errors.has('cash_out_interest')" v-html="form.errors.get('cash_out_interest')"></div>
                                </div>
                                <div class="mb-3" :class="{'has-error': form.errors.has('cash_out_first_charge'),'hide': form.cashout_can == 'no' || form.cashout_can == ''}">
                                    <label for="cash_out_first_charge" class="form-label">Cashout Fee *</label>
                                    <input type="text" class="form-control" name="cash_out_first_charge" id="cash_out_first_charge" v-model="form.cash_out_first_charge" />
                                    <div class="text-danger" v-if="form.errors.has('cash_out_first_charge')" v-html="form.errors.get('cash_out_first_charge')"></div>
                                </div>
                                <div class="mb-3" :class="{'has-error': form.errors.has('min_income')}">
                                    <label for="min_income" class="form-label">Minimum Income to Apply This Card *</label>
                                    <input type="text" class="form-control" name="min_income" id="min_income" v-model="form.min_income" />
                                    <div class="text-danger" v-if="form.errors.has('min_income')" v-html="form.errors.get('min_income')"></div>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header">
                                <h5>Merchant Benefits</h5>
                            </div>
                            <div class="card-body">
                                <input type="hidden" :value="form.benefitList" />
                                <a href="#" data-bs-toggle="modal" class="btn btn-primary" data-bs-target="#benefitsAddModal">Add Benefits</a>
                                <table class="table table-bordeless" id="cardBenefits">
                                    <thead>
                                        <tr>
                                            <th scope="col">Index</th>
                                            <th scope="col">Image</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Benefits Day</th>
                                            <th scope="col">Description</th>
                                            <th scope="col">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(benefit,index) in benefitList" :key="index">
                                            <td>@{{index + 1}}</td>
                                            <td>
                                                <div class="discover-product overflow-hidden rounded-circle d-flex align-items-center justify-content-center flex-wrap bg-img-full" :style="{ backgroundImage: 'url(/' + benefit.merchant_image + ')' }"></div>
                                            </td>
                                            <td>@{{benefit.merchant_name}}</td>
                                            <td>@{{benefit.benefit_string}}</td>
                                            <td>@{{(benefit.benefit_description_text.length > 20) ? benefit.benefit_description_text.substring(0, 20)+'...' : benefit.benefit_description_text}}</td>
                                            <td><a href="javascript:void(0)" @click="editBenefit(index)">Edit</a> | <a href="javascript:void(0)" @click="deleteBenefit(benefit,index)">Delete</a></td>
                                        </tr>
                                    </tbody>
                                </table>

                            </div>
                        </div>
                        <div class="col-12">
                            <button class="btn btn-primary" type="submit" :disabled="form.busy">
                                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" v-if="form.busy"></span>
                                <span v-if="form.busy">Saving..</span>
                                <span v-else>Submit</span>
                            </button>
                            <button class="btn btn-secondary" type="button" :disabled="form.busy" @click="refreshPage">Cancel</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="benefitsAddModal" tabindex="-1" aria-labelledby="benefitsAddModalLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body pt-2">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <a href="#" class="text-danger text-decoration-none" @click="cancelBenefit">Cancel</a>
                    <a href="#" class="text-primary text-decoration-none" id="benefitsSave" @click="saveBenefit">Save</a>
                </div>
                <form id="benefitsAddForm">
                    <div class="alert alert-danger alert-dismissible" id="benefitErrorBox" style="display: none;" role="alert">
                        Please fill all required fields
                    </div>
                    <div class="px-2">
                        <div class="mb-3">
                            <label for="merchant_id" class="form-label">Merchant *</label>
                            <select class="form-select benefits-input" name="merchant_id" id="merchant_id" v-model="benefitForm.merchant_id">
                                <option value="">--Select--</option>
                                <option v-for="merchant in merchants" :key="merchant.id" v-bind:value="merchant.id">
                                    @{{ merchant.merchant_name }}
                                </option>
                            </select>
                            <div class="error" v-if="submitStatus == 'ERROR' && !$v.benefitForm.merchant_id.$model">Field is required</div>
                            <!-- <label id="merchant_id_error" style="display: none;" for="merchant_id">This field is required.</label> -->
                        </div>
                        <div class="mb-3" style="height: 300px;">
                            <label for="benefit_description" class="form-label">Benefit description *</label>
                            <quill-editor ref="quillEditor" class="editor" formnovalidate="formnovalidate" style="height: 210px;" v-model="benefitForm.merchant_benefit_description" novalidate :options="editorOption" @change="onEditorChange($event)" />
                        </div>
                        <div class="error" v-if="submitStatus == 'ERROR' && !$v.benefitForm.merchant_benefit_description.$model">Field is required</div>
                        <!-- <label id="benefit_description_error" style="display: none;" for="merchant_id">This field is required.</label> -->
                        <div class="mb-3">
                            <label for="benefit_day" class="form-label">Benefit Day *</label>
                            <div class="form-check">
                                <input class="form-check-input benefits-input benefits-day-checkbox" data-name="Mon" type="checkbox" id="benefit_day_mon" name="benefit_day_mon" v-model="benefitForm.benefit_day_mon">
                                <label class="form-check-label" for="benefit_day_mon">
                                    Monday
                                </label>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input benefits-input benefits-day-checkbox" data-name="Tue" type="checkbox" id="benefit_day_tue" name="benefit_day_tue" v-model="benefitForm.benefit_day_tue">
                                <label class="form-check-label" for="benefit_day_tue">
                                    Tuesday
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input benefits-input benefits-day-checkbox" data-name="Wed" type="checkbox" id="benefit_day_wed" name="benefit_day_wed" v-model="benefitForm.benefit_day_wed">
                                <label class="form-check-label" for="benefit_day_wed">
                                    Wednesday
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input benefits-input benefits-day-checkbox" data-name="Thu" type="checkbox" id="benefit_day_thu" name="benefit_day_thu" v-model="benefitForm.benefit_day_thu">
                                <label class="form-check-label" for="benefit_day_thu">
                                    Thursday
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input benefits-input benefits-day-checkbox" data-name="Fri" type="checkbox" id="benefit_day_fri" name="benefit_day_fri" v-model="benefitForm.benefit_day_fri">
                                <label class="form-check-label" for="benefit_day_fri">
                                    Friday
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input benefits-input benefits-day-checkbox" data-name="Sat" type="checkbox" id="benefit_day_sat" name="benefit_day_sat" v-model="benefitForm.benefit_day_sat">
                                <label class="form-check-label" for="benefit_day_sat">
                                    Saturday
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input benefits-input benefits-day-checkbox" data-name="Sun" type="checkbox" id="benefit_day_sun" name="benefit_day_sun" v-model="benefitForm.benefit_day_sun">
                                <label class="form-check-label" for="benefit_day_sun">
                                    Sunday
                                </label>
                            </div>
                        </div>
                        <input type="hidden" v-model="benefitForm.index" name="index" />
                        <div id="benefit_day_error" style="display: none;">Please select atleast one day for benefit.</div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js_script')
<script src="{{asset('/js/axios.js')}}"></script>
<script src="{{asset('/js/vue.js')}}"></script>
<script src="{{asset('/js/vform.js')}}"></script>
<script src="{{asset('/js/quill.js')}}"></script>
<script src="{{asset('/js/vue-quill-editor.js')}}"></script>
<script src="{{asset('/js/vuelidate.min.js')}}"></script>
<script src="{{asset('/js/validators.min.js')}}"></script>

<script type="text/javascript">
    Vue.use(VueQuillEditor);
    Vue.use(window.vuelidate.default)
    const {
        required,
        minLength
    } = window.validators

    var count = 1;
    var formData = {
        'card_types': '{!! addslashes(json_encode($card_types)) !!}',
        'merchants': '{!! addslashes(json_encode($merchants)) !!}'
    };
    var form_type = '{!! $form_type !!}';
    var card_form = '{!!  addslashes(json_encode($card_form)) !!}';
    var form_action = '{{ $form_action }}';
    const originalBenefitForm = JSON.stringify({
        merchant_id: "",
        merchant_benefit_description: "",
        benefit_description_text: "",
        benefit_day: false,
        benefit_day_mon: false,
        benefit_day_tue: false,
        benefit_day_wed: false,
        benefit_day_thu: false,
        benefit_day_fri: false,
        benefit_day_sat: false,
        benefit_day_sun: false,
        index: null
    });

    var app = new Vue({
        el: '#app',
        data() {
            return {
                form: new Form.Form({
                    card_type_id: "",
                    card_name: '',
                    card_image: null,
                    card_des: '',
                    card_info_url: "",
                    rebate_type: [],
                    point_value_rm: '{!! $bank->point_value_rm !!}',
                    point_rebate_percentage: '{!! $bank->point_rebate_percentage !!}',
                    point_or_cashrebate_description: "",
                    point_name: '{!! $bank->point_name !!}',
                    annual_fee_free_for: "",
                    annual_fee: "",
                    annual_fee_sub: "",
                    annual_fee_waived: "",
                    late_charge_fee: '{!! $bank->late_charge_fee !!}',
                    interest_rate: '{!! $bank->interest_rate !!}',
                    cashout_can: "",
                    cash_out_interest: '{!! $bank->cash_out_interest !!}',
                    cash_out_first_charge: '{!! $bank->cash_out_first_charge !!}',
                    min_income: "",
                    benefits: [],
                    deletedBenefits: [],
                }),
                card_image: null,
                benefitList: [],
                card_types: JSON.parse(formData.card_types),
                benefitForm: JSON.parse(originalBenefitForm),
                merchants: JSON.parse(formData.merchants),
                messageBox: [],
                content: '',
                editorOption: {
                    theme: 'snow',
                    modules: {
                        toolbar: [
                            [{
                                'size': []
                            }],
                            ['blockquote'],
                            [{
                                'align': []
                            }],
                            ['bold', 'italic', 'underline'],
                            [{
                                'list': 'ordered'
                            }, {
                                'list': 'bullet'
                            }],
                            ['link'],
                            [{
                                "color": [],
                            }, {
                                "background": [],
                            }, ],
                        ]
                    }
                },
                submitStatus: null
            }
        },
        validations() {
            return {
                benefitForm: {
                    merchant_id: {
                        required
                    },
                    merchant_benefit_description: {
                        required
                    }
                }
            }
        },
        mounted() {
            var vm = this;
            if (form_type == 'edit') {
                var temp_card = JSON.parse(card_form);
                var Title = $('<textarea />').html(temp_card).text();
                var card_image = temp_card.card_image;
                temp_card.card_image = null;
                this.card_image = card_image;
                var temp_card_benefits = temp_card.benefits;

                this.benefitList = temp_card_benefits;
                this.form.fill(JSON.parse(card_form));
                this.form.deletedBenefits = [];
            }
        },
        methods: {
            handleFile(event, field_name) {
                const file = event.target.files[0];
                this.card_image = URL.createObjectURL(event.target.files[0]);
                this.form[field_name] = file
            },
            addCard() {
                const benefitsJson = JSON.stringify(this.benefitList);
                this.form.benefits = benefitsJson;
                this.messageBox = [];

                const response = this.form.post(form_action);
                response.then((response) => {
                    if (response.data.success) {
                        this.messageBox.push({
                            type: 'success',
                            message: response.data.message
                        });
                        if (form_type == 'edit') {
                            var temp_card = JSON.parse(JSON.stringify(response.data.data));
                            var card_image = temp_card.card_image;
                            temp_card.card_image = null;
                            this.card_image = card_image;
                            var temp_card_benefits = temp_card.benefits;

                            this.benefitList = temp_card_benefits;
                            this.form.fill(JSON.parse(JSON.stringify(response.data.data)));
                            this.form.deletedBenefits = [];
                        } else {
                            this.form.reset();
                            this.benefitList = [];
                            this.card_image = null;
                        }
                        $("#card_image")[0].value = '';

                    } else {
                        this.messageBox.push({
                            type: 'error',
                            message: response.data.message
                        });
                    }
                    const element = document.getElementsByClassName('mainContainer')[0];
                    element.scrollIntoView({
                        behavior: "smooth",
                        block: "start",
                    });
                }).catch((error) => {
                    if(error.response.status == '422'){
                        this.messageBox.push({
                            type: 'error',
                            message: 'The given data is invalid! Please fill all required fields'
                        });
                    }
                    const element = document.getElementsByClassName('mainContainer')[0];
                    element.scrollIntoView({
                        behavior: "smooth",
                        block: "start",
                    });
                });
            },
            changeForm(event) {
                console.log(event);
            },
            saveBenefit(event) {
                this.submitStatus = null;
                this.$v.$touch();
                var atleastOneCheckbox = false;
                var benefitString = '';
                $(".benefits-day-checkbox").each(function() {
                    if ($(this).is(":checked")) {
                        atleastOneCheckbox = true;
                        benefitString += $(this).data('name') + ',';
                    }
                });
                if (!atleastOneCheckbox) {
                    $("#benefit_day_error").addClass('error');
                    $("#benefitErrorBox").show();
                    $("#benefit_day_error").show();
                } else {
                    $("#benefit_day_error").removeClass('error');
                    $("#benefit_day_error").hide();
                }
                if (this.$v.$invalid) {
                    $("#benefitErrorBox").show();
                    this.submitStatus = 'ERROR'
                } else {
                    if (atleastOneCheckbox) {
                        $("#benefitErrorBox").hide();
                        const merchant_id = this.benefitForm.merchant_id;
                        const merchant = this.merchants.find(function(elem, index) {
                            return elem.id == merchant_id
                        });

                        var tempBenefitForm = this.benefitForm;
                        tempBenefitForm['merchant_name'] = merchant.merchant_name;
                        tempBenefitForm['merchant_image'] = merchant.merchant_image;
                        tempBenefitForm['benefit_string'] = benefitString.replace(/,(\s+)?$/, '');
                        if (this.benefitForm.index != null) {
                            this.benefitList[this.benefitForm.index] = tempBenefitForm;
                        } else {
                            this.benefitList.push(tempBenefitForm);
                        }

                        this.benefitForm = JSON.parse(originalBenefitForm);
                        $('#benefitsAddModal').modal('toggle');
                    } else {
                        $("#benefitErrorBox").show();
                    }
                }
            },
            cancelBenefit() {
                this.benefitForm = JSON.parse(originalBenefitForm);
                $("#benefit_day_error").hide();
                $("#benefit_day_error").removeClass('error');
                $("#benefitErrorBox").hide();
                this.submitStatus = null;
                $('#benefitsAddModal').modal('toggle');
            },
            editBenefit(index) {
                var benefit = this.benefitList[index];
                var tempBenefitForm = benefit;
                tempBenefitForm['index'] = index;
                this.benefitForm = tempBenefitForm;
                $('#benefitsAddModal').modal('toggle');
            },
            deleteBenefit(benefit,index) {
                var vm = this;
                if (confirm('Are you sure you want to remove this benefit ?')) {
                    if(typeof benefit.id != 'undefined' && benefit.id != '' && benefit.id != 0){
                        this.form.deletedBenefits.push(benefit.id);
                    }
                    vm.$delete(vm.benefitList, index);
                }
            },
            onEditorChange({
                quill,
                html,
                text
            }) {
                this.benefitForm.benefit_description_text = text;
            },
            refreshPage() {
                window.location.reload();
            }
        }
    })
</script>
@endsection
