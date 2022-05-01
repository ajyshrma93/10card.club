<?php

namespace App\Http\Controllers;

use App\Models\Card;
use App\Models\UserCardNote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

class UserCardNoteController extends Controller
{
    protected $userCardNote;
    protected $card;

    public function __construct(
        UserCardNote $userCardNote,
        Card $card
    ) {
        $this->userCardNote  = $userCardNote;
        $this->card = $card;
    }

    public function userCardNotesList($card_id)
    {
        $user = Auth::user();
        $card = $this->card->find($card_id);
        if (!isset($card)) {
            $message = 'Card not found';
            return view('errors.404', compact('message'));
        }

        $notes = $this->userCardNote->where('user_id', $user->id)->where('card_id', $card_id)->get();

        return response()->json(['success' => true, 'message' => '', 'data' => $notes]);
    }

    public function addUserCardNote($card_id, Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required'
        ]);

        $user = Auth::user();
        $card = $this->card->find($card_id);
        if (!isset($card)) {
            $message = 'Card not found';
            return view('errors.404', compact('message'));
        }
        DB::beginTransaction();
        try {
            $data = $request->except('_token');
            $data['card_id'] = $card_id;
            $data['user_id'] = $user->id;

            $note = $this->userCardNote->create($data);

            DB::commit();
            return response()->json(['success' => true, 'message' => 'Note added successfully.', 'data' => $note]);
        } catch (\Throwable $th) {
            DB::rollback();

            return response()->json(['success' => false, 'message' => 'Something went wrong!.', 'data' => []]);
        }
    }

    public function deleteUserCardNote($id)
    {
        $user = Auth::user();
        $note = $this->userCardNote->where('user_id', $user->id)->where('id', $id)->first();
        if ($note) {
            $note->delete();
        }

        return response()->json(['success' => true, 'message' => 'Note delete successfully.', 'data' => []]);
    }
}
