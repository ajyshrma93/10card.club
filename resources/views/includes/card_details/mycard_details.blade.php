@php
$ownedCard = \App\Models\UserCard::where('card_id',$card->id)->where('user_id',auth()->id())->first();
@endphp


<div class="tab-pane fade" id="userTab" role="tabpanel" aria-labelledby="user-tab">
    <ul class="list-unstyled user-credit-card-info">
        @include('includes.card_details.owned_card_detail')
    </ul>
    @include('includes.card_details.card_notes')
</div>
