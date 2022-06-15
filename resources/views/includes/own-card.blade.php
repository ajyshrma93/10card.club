@auth
@if(auth()->user()->user_type_id == 1)
@if(auth()->user()->hasCard($card->id))
<div class="mb-0 mt-2"><span class="d-inline-block me-1 check-sign"><svg fill="none" height="24" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
            <path d="M22 11.07V12a10 10 0 1 1-5.93-9.14"></path>
            <polyline points="23 3 12 14 9 11"></polyline>
        </svg></span>
    You Owned this card
</div>
@else
<div class="row mt-2">
    <!-- <a class="col-md-12 col-6 " style="text-decoration: none;color: #000944;" data-bs-toggle="modal" data-card-id="{{$card->id}}" data-card-title="{{$card->card_name}}" data-bs-target="#addCardToOwn">
        <i class="fa fa-bookmark-o" style="color:#03c966;font-size:20px"></i>
        Mark As Owned
    </a> -->
    <div class="col-md-12  col-6 ">
        @if(auth()->user()->hasApplication($card->id))
        <a href="{{route('my_applications')}}" style="text-decoration: none;color: #000944;">
            <i class="fa fa-id-card"></i>
            Already Applied
        </a>
        @else
        <a href="{{route('apply_for_card',$card->id)}}" style="text-decoration: none;color: #000944;">
            <i class="fa fa-id-card" style="color:#03c966;font-size:20px"></i>
            You can apply
        </a>
        @endif
    </div>
</div>
@endif
@endif
@endauth
