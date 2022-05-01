<div class="tab-pane fade" id="flightTab" role="tabpanel" aria-labelledby="flight-tab">
    <div class="mb-4">
        <div class="discover-lists d-flex scrollbar-outer">
            @foreach ($merchants as $merchant)
            @php
                $merchantLogo = asset($merchant['logo']);
            @endphp
            <a href="#"
                data-bs-toggle="modal"
                data-bs-target="#merchantModal"
                data-merchantName="{{$merchant['name']}}"
                data-merchantDescription="{{$merchant['description']}}"
                data-merchantLogo="{{asset($merchant['logo'])}}"
                class="discover-product overflow-hidden rounded-circle d-flex align-items-center justify-content-center flex-wrap bg-img-full"
                style="background-image: url({{$merchantLogo}});">
            </a>
            @endforeach
        </div>
    </div>
    <!-- <ul class="list-unstyled cash-rebate-list">
    <li class="d-flex">
        <figure class="flight-info-icon d-flex align-items-center justify-content-center mb-0">
            <img src="assets/images/trael-insurance-icon.svg" class="img-fluid"
                alt="Travel Insurance" />
        </figure>
        <div class="cash-debate-info pt-1">
            <h4 class="fw-medium mb-3 d-flex justify-content-between">Travel Insurance <span
                class="badge text-white rounded-pill bg-success">auto</span></h4>
            <p>RM 500,000</p>
        </div>
    </li>
    <li class="d-flex">
        <figure class="flight-info-icon d-flex align-items-center justify-content-center mb-0">
            <img src="assets/images/lounge-icon.svg" class="img-fluid" alt="Travel Insurance" />
        </figure>
        <div class="cash-debate-info pt-1">
            <h4 class="fw-medium mb-3">Lounge</h4>
            <p>Plaza Premium Lounge x3</p>
        </div>
    </li>
    </ul> -->
</div>
