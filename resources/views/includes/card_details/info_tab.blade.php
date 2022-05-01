<div class="tab-pane fade show active" id="infoTab" role="tabpanel" aria-labelledby="info-tab">
    <ul class="nav nav-pills mb-0 cash-tabs" id="pills-tab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link {{(($card['point_or_cashrebate'] == 'cash' || $card['point_or_cashrebate'] == 'both')) ? 'active' : ''}} {{($card['point_or_cashrebate'] == 'point') ? 'disabled' : ''}}" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-cash-rebate" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Cash Rebate</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link {{($card['point_or_cashrebate'] == 'point') ? 'active' : ''}} {{($card['point_or_cashrebate'] == 'cash') ? 'disabled' : ''}}" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-point-collection" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Point Collection</button>
        </li>
    </ul>
    <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade {{($card['point_or_cashrebate'] == 'point') ? 'show active' : ''}}" id="pills-point-collection" role="tabpanel" aria-labelledby="pills-home-tab">
            <ul class="list-unstyled cash-rebate-list">
                <li class="d-flex flex-wrap">
                    <div class="cash-type rounded-circle dollar-type d-flex align-items-center justify-content-center">
                    </div>
                    <div class="cash-debate-info">
                        <h4 class="fw-medium">Point Rebate <span>{{$card['point_rebate_percentage']}}%</span></h4>
                        <p>{{$card['point_or_cashrebate_description']}}</p>
                    </div>
                </li>
            </ul>
        </div>
        <div class="tab-pane fade {{($card['point_or_cashrebate'] == 'cash' || $card['point_or_cashrebate'] == 'both') ? 'show active' : ''}}" id="pills-cash-rebate" role="tabpanel" aria-labelledby="pills-home-tab">
            <ul class="list-unstyled cash-rebate-list">
                <li class="d-flex flex-wrap">
                    <div class="cash-type rounded-circle dollar-type d-flex align-items-center justify-content-center">
                    </div>
                    <div class="cash-debate-info">
                        <h4 class="fw-medium"><span></span></h4>
                        <p>{{$card['point_or_cashrebate_description']}}</p>
                    </div>
                </li>
            </ul>
        </div>
        <div class="tab-pane fade show active" role="tabpanel">
            <ul class="list-unstyled cash-rebate-list">
                <li class="d-flex flex-wrap">
                    <div class="cash-type rounded-circle free-type fw-semibold text-white d-flex align-items-center justify-content-center text-uppercase">
                        <i class="fas fa-coins"></i>
                    </div>
                    <div class="cash-debate-info">
                        @if ($card['annual_fee'] == 0 || $card['annual_fee'] == null)
                        <h4 class="fw-medium">Annual Fee</span></h4>
                        <p>This card is free for life time.</p>
                        @elseif ($card['annual_fee_free_1_year'] == 'yes')
                        <h4 class="fw-medium">Annual Fee <span>RM {{$card['annual_fee']}}</span></h4>
                        <p>First year annual fee waived.</p>
                        @elseif ($card['annual_fee_free_1_year'] == 'no' || $card['annual_fee_free_1_year'] == null)
                        <h4 class="fw-medium">Annual Fee <span>RM {{$card['annual_fee']}}</span></h4>
                        <p>This annual fee is charged yearly.</p>
                        @endif
                    </div>
                </li>
                <li>
                    <div class="card-charges text-center">
                        @if ($card['annual_fee_sub'] == 0)
                        Subsequent Cards are free of charge.
                        @else
                        Subsequent cards are charged RM {{$card['annual_fee_sub']}} per card
                        @endif
                    </div>
                </li>
                @if ($card['annual_fee_waived'] != null)
                <li class="d-flex flex-wrap">
                    <div class="cash-type rounded-circle free-type fw-semibold text-white d-flex align-items-center justify-content-center text-uppercase">
                        Free
                    </div>
                    <div class="cash-debate-info">
                        <h4 class="fw-medium">How to waive annual fee?</h4>
                        <p>{{$card['annual_fee_waived']}}</p>
                    </div>
                </li>
                @endif
                <li class="d-flex flex-wrap">
                    <div class="cash-type rounded-circle free-type fw-semibold text-white d-flex align-items-center justify-content-center text-uppercase">
                        Web
                    </div>
                    <div class="cash-debate-info">
                        <h4 class="fw-medium">Redeem Web</h4>
                        <p><a href="{{$card['bank']['redeem_web']}}" target="_blank">{{$card['bank']['redeem_web']}}</a></p>
                    </div>
                </li>
                <li class="d-flex flex-wrap">
                    <div class="cash-type rounded-circle free-type fw-semibold text-white d-flex align-items-center justify-content-center text-uppercase">
                        Fee
                    </div>
                    <div class="cash-debate-info">
                        <h4 class="fw-medium">Late Charge</h4>
                        <p>RM {{$card['late_charge_fee']}}</p>
                    </div>
                </li>
                <li class="d-flex flex-wrap">
                    <div class="cash-type rounded-circle free-type fw-semibold text-white d-flex align-items-center justify-content-center text-uppercase">
                        Fee
                    </div>
                    <div class="cash-debate-info">
                        <h4 class="fw-medium">Can Cashout</h4>
                        @if ($card['cashout_can'] == 'yes')
                        <p>{{ucfirst($card['cashout_can'])}}, {{$card['cash_out_interest']}}% Per Annum</p>
                        <p>Each Transaction RM {{$card['cash_out_first_charge']}}</p>
                        @else
                        <p>{{ucfirst($card['cashout_can'])}}</p>
                        @endif
                    </div>
                </li>
                <li class="d-flex flex-wrap">
                    <div class="cash-type rounded-circle free-type fw-semibold text-white d-flex align-items-center justify-content-center text-uppercase">
                        Min
                    </div>
                    <div class="cash-debate-info">
                        <h4 class="fw-medium">Minimum Income</h4>
                        <p>RM {{$card['min_income']}}</p>
                    </div>
                </li>
                <li class="d-flex flex-wrap">
                    <div class="cash-type rounded-circle free-type fw-semibold text-white d-flex align-items-center justify-content-center text-uppercase">
                        Age
                    </div>
                    <div class="cash-debate-info">
                        <h4 class="fw-medium">Minimum Age</h4>
                        <p>{{$card['bank']['min_age']}}</p>
                    </div>
                </li>
                <li>
                    <div class="card-charges text-center">
                        @if ($card['bank']['min_age_sub'] == 0)
                        No minimum age for Subsequent Card.
                        @else
                        Minimum age required for Subsequent cards is {{$card['bank']['min_age_sub']}}.
                        @endif
                    </div>
                </li>
            </ul>
        </div>

    </div>
</div>