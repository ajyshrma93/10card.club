<style>
    p {
        word-break: break-all;
    }

    .card-details {
        max-height: 450px;
        overflow-y: auto;
    }
</style>
<div class="card-details">

    <p><img src="{{asset($card->card_image)}}" class="img-fluid" width="100px" /></p>
    <p><b>Card Name : </b> {!!$card->card_name!!}</p>
    <p><b>Card Type : </b> {!!$card->type->label!!}</p>
    <p><b>Bank Name : </b> {!!$card->bank->bank_name!!}</p>
    <p><b>Short Description : </b> {!!$card->card_des!!}</p>
    <p><b>Card Information URL : </b> {!!$card->card_info_url!!}</p>
    <p><b>Card Rebate (Points / Cash) : </b> {!! ucwords($card->point_or_cashrebate)!!}</p>
    <p><b>Rebate Description :</b>{!!$card->point_or_cashrebate_description!!}</p>
    @if($card->point_or_cashrebate == 'point')
    <p><b>Point Name :</b>{!!$card->point_name!!}</p>
    <p><b>Point Value in RM :</b>{!!$card->point_value_rm!!}</p>
    <p><b>Point Rebate (%) :</b>{!!$card->point_rebate_percentage!!}</p>
    @endif
    <p><b>Annual Fee :</b> {!!$card->annual_fee!!}</p>
    <p><b>Annual Fee of Subsidiary :</b> {!!$card->annual_fee_sub!!}</p>
    <p><b>Annual Fee Waived Description :</b> {!!$card->annual_fee_waived!!}</p>
    <p><b>Intreset Rate (%) :</b> {!!$card->interest_rate!!}</p>
    <p><b>Intreset Rate Type :</b> {!!$card->interest_type!!}</p>
    <p><b>Can Cashout ? :</b> {!! ucwords($card->cashout_can)!!}</p>
    <p><b>Cashout Interest(%) :</b> {!!$card->cash_out_interest!!}</p>
    <p><b>Cashout Fee :</b> {!!$card->cash_out_first_charge!!}</p>
    <p><b>Minimum Income to Apply This Card :</b> {!!$card->min_income!!}</p>


</div>
