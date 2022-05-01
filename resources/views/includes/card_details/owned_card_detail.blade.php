<li class="text-end">
    <a href="#" class="btn" data-bs-toggle="modal" data-bs-target="#ownedCardDetails">
        <svg xmlns="http://www.w3.org/2000/svg" width="9.886" height="9.886" viewBox="0 0 9.886 9.886">
            <path id="Icon_material-edit" data-name="Icon material-edit" d="M4.5,12.323v2.059H6.559l6.074-6.074L10.574,6.249Zm9.726-5.607a.547.547,0,0,0,0-.774L12.941,4.657a.547.547,0,0,0-.774,0l-1,1,2.059,2.059Z" transform="translate(-4.5 -4.496)" fill="#000944" opacity="0.2"></path>
        </svg>
    </a>
</li>
<li class="d-flex align-items-center justify-content-between">
    <div class="cc-label">Card Number:
    </div>
    <div class="d-flex align-items-center">
        <div class="cc-label-value me-2">
            xxxx xxxx xxxx {{$ownedCard->card_number ? $ownedCard->card_number :'xxxx'}}
        </div>
    </div>
</li>
<li class="d-flex align-items-center justify-content-between">
    <div class="cc-label">

    </div>
</li>
<li class="d-flex align-items-center justify-content-between">
    <div class="cc-label">Card Expiry :</br>
        @if(auth()->user()->cards->count() > 1)
        <a href="#" class="btn" data-bs-toggle="modal" data-bs-target="#expiryDateModal" style="color:#1BB4ED">View all </a>
        @endif
    </div>
    <div class="d-flex align-items-center">
        <div class="cc-label-value me-2">
            {{$ownedCard->expiry_month ? $ownedCard->expiry_month :'XX'}} / {{$ownedCard->expiry_year ? $ownedCard->expiry_year :'XX'}}
        </div>
    </div>
</li>
<li class="d-flex align-items-center justify-content-between">
    <div class="cc-label">Statement Date :</br>
        @if(auth()->user()->cards->count() > 1)
        <a href="#" class="btn" data-bs-toggle="modal" data-bs-target="#statementDateModal" style="color:#1BB4ED">View all </a>
        @endif
    </div>
    <div class="d-flex align-items-center">
        <div class="cc-label-value me-2">{{date('jS F',strtotime('2000-'.$ownedCard->statement_month.'-'.$ownedCard->statement_date))}}</div>

    </div>
</li>
<li class="d-flex align-items-center justify-content-between">
    <div class="cc-label">Due Date :</br>
        @if(auth()->user()->cards->count() > 1)
        <a href="#" class="btn" data-bs-toggle="modal" data-bs-target="#dueDateModal" style="color:#1BB4ED">View all </a>
        @endif
    </div>
    <div class="d-flex align-items-center">
        <div class="cc-label-value me-2">{{date('jS F',strtotime('2000-'.$ownedCard->due_month.'-'.$ownedCard->due_date))}}</div>

    </div>
</li>
<li class="d-flex align-items-center justify-content-between">
    <div class="cc-label">Annual Fee Date :</br>
        @if(auth()->user()->cards->count() > 1)
        <a href="#" class="btn" data-bs-toggle="modal" data-bs-target="#annualDateModal" style="color:#1BB4ED">View all </a>
        @endif
    </div>
    <div class="d-flex align-items-center">
        <div class="cc-label-value me-2">{{date('jS F',strtotime('2000-'.$ownedCard->annual_fee_month.'-'.$ownedCard->annual_fee_date))}}</div>

    </div>
</li>
<li class="d-flex align-items-center justify-content-between">
    <div class="cc-label">Services Tax :</br>
        @if(auth()->user()->cards->count() > 1)
        <a href="#" class="btn" data-bs-toggle="modal" data-bs-target="#serviceTaxModal" style="color:#1BB4ED">View all </a>
        @endif
    </div>
    <div class="d-flex align-items-center">
        <div class="cc-label-value me-2">{{date('jS F',strtotime('2000-'.$ownedCard->tax_month.'-'.$ownedCard->tax_date))}}</div>
    </div>
</li>

<li class="d-flex align-items-center justify-content-between">
    <div class="cc-label">Is this Sub Card ?</div>
    <div class="d-flex align-items-center">
        <input type="checkbox" id="is_sub_card" {{$ownedCard->cardholder_name ? 'checked':''}}>
    </div>
</li>
@if($ownedCard->cardholder_name)
<li class="d-flex align-items-center justify-content-between">
    <div class="cc-label">Card is used by :</div>
    <div class="d-flex align-items-center">
        <div class="cc-label-value me-2">{{$ownedCard->cardholder_name}}</div>
        @if ($ownedCard->cardholder_name )
        <a href="#" class="btn" data-bs-toggle="modal" data-bs-target="#subCardModal">
            <svg xmlns="http://www.w3.org/2000/svg" width="9.886" height="9.886" viewBox="0 0 9.886 9.886">
                <path id="Icon_material-edit" data-name="Icon material-edit" d="M4.5,12.323v2.059H6.559l6.074-6.074L10.574,6.249Zm9.726-5.607a.547.547,0,0,0,0-.774L12.941,4.657a.547.547,0,0,0-.774,0l-1,1,2.059,2.059Z" transform="translate(-4.5 -4.496)" fill="#000944" opacity="0.2"></path>
            </svg>
        </a>
        @endif
    </div>
</li>
@endif
