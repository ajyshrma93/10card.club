<?php

namespace App\Http\Controllers;

use App\Models\Card;
use App\Models\User;
use App\Models\UserMessage;
use App\Models\UserType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

class UserMessageController extends Controller
{
    protected $userMessage;
    protected $card;
    protected $user;
    protected $userType;

    public function __construct(
        Card $card,
        UserMessage $userMessage,
        User $user,
        UserType $userType
    ) {
        $this->card = $card;
        $this->user = $user;
        $this->userMessage = $userMessage;
        $this->userType = $userType;
    }

    public function addMessage(Request $request, $card_id)
    {
        $data = $request->except('_token');
        $validation = [
            'message' => 'required'
        ];

        $this->validate($request, $validation);

        DB::beginTransaction();
        try {
            if ($card_id) {
                $user = Auth::user();
                $user_type = $this->userType->find($user->user_type_id);
                $data['card_id'] = $card_id;
                $data['user_id'] = $user->id;
                $message = $this->userMessage->create($data);
                $user['user_type'] = $user_type;
                $message['user'] = $user;
            }
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json(['success' => false, 'message' => 'Something went wrong!.', 'data' => []]);
        }

        return response()->json(['success' => true, 'message' => 'Message Added successfully.', 'data' => $message]);
    }

    public function listMessage($card_id)
    {
        $messages = $this->userMessage->with(['user' => function ($query) {
            $query->with('user_type');
        }])->where('card_id', $card_id)->get();

        $user_messages = [];
        foreach ($messages as $message) {
            if ($message['parent_message_id'] != null) {
                $user_messages[$message['parent_message_id']]['child'][] = $message->toArray();
            } else {
                $user_messages[$message['id']] = $message->toArray();
                $user_messages[$message['id']]['child'] = [];
            }
        }

        $user_messages = array_values($user_messages);

        return response()->json(['success' => true, 'message' => '', 'data' => $user_messages]);
    }

    public function searchMessage($id, Request $request)
    {
        $card = $this->card->find($id);
        $query = $request->input('query');
        $user_messages = [];
        if (isset($query)) {
            $messages = $this->userMessage->with(['user' => function ($query) {
                $query->with('user_type');
            }])->where('card_id', $id)->where('message', 'like', '%' . $request->input('query') . '%')->get();

            $parent_ids = [];
            foreach ($messages as $message) {
                if ($message['parent_message_id'] != null) {
                    $parent_ids[] = $message['parent_message_id'];
                } else {
                    $parent_ids[] = $message['id'];
                }
            }
            $parent_ids = array_unique($parent_ids);

            $messages = $this->userMessage->with(['user' => function ($query) {
                $query->with('user_type');
            }])->whereIn('id', $parent_ids)->orWhereIn('parent_message_id', $parent_ids)->get();

            foreach ($messages as $message) {
                if ($message['parent_message_id'] != null) {
                    $user_messages[$message['parent_message_id']]['child'][] = $message->toArray();
                } else {
                    $user_messages[$message['id']] = $message->toArray();
                    $user_messages[$message['id']]['child'] = [];
                }
            }


            $user_messages = array_values($user_messages);
        }

        return response()->json(['success' => true, 'message' => '', 'data' => $user_messages]);
    }
}
