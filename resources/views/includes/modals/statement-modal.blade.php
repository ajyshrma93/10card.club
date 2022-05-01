<div class="modal fade" id="statementDateModal" tabindex="-1" aria-labelledby="allCardModal" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">All Card Statetment Date</h5>
                <a href="#" data-bs-dismiss="modal" aria-label="Close" class="btn text-danger text-decoration-none"><i class="fa fa-times"></i></a>
            </div>
            <div class="modal-body pt-2">
                <div class="credit-card-details">
                    <div class="credit-card">
                        <table class="table">
                            @foreach ($userCards as $userCard)
                            @php
                            $card = $userCard->card;
                            @endphp
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>
                                    <b>{{$card->bank->bank_name}}</b></br>
                                    xxxx xxxx xxxx {{{$userCard->card_number}}}
                                </td>
                                <td>{{date('jS F',strtotime('2000-'.$userCard->statement_month.'-'.$userCard->statement_date))}}</td>
                            </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
