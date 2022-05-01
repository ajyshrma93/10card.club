<div class="tab-pane fade chat-tab" id="chatTab" role="tabpanel" aria-labelledby="chat-tab">
    <div class="mb-4">
        <div class="d-flex align-items-center justify-content-between">
            <select class="form-select chat-filter-dropdown">
                <option value="1">Public</option>
                <option value="2">Own</option>
                <option value="3">Favourite</option>
            </select>
            <a data-bs-toggle="collapse" href="#collapseSearch" role="button" aria-expanded="false" aria-controls="collapseSearch" class="chat-search-btn"></a>
        </div>
        <div class="collapse" id="collapseSearch">
            <form method="post" action="{{route('card_chat_search',['id' => $card->id])}}" novalidate @submit.prevent="searchMessage" enctype="multipart/form-data">
                <div class="chat-searchbar global-search mt-2 position-relative">
                    <input type="text" class="form-control" placeholder="Search" id="chat_search" data-id="{{$card['id']}}" name="search" v-model="searchQuery">
                    <a href="#" class="speech-to-search-btn position-absolute"></a>
                </div>
            </form>
        </div>
    </div>
    <div id="userChatMessagesOld">
        <div class="user-chat-list">
            <div v-for="message in userMessages" :key="message.id">
                <user-message :message="message" inline-template>
                    <div class="chat-row d-flex">
                        <div class="user-profile-photo">
                            <div class="user-avatar" v-bind:style="{ 'background-image': 'url(/' + message.user.image + ')' }"></div>
                            <!-- <div class="user-short-name pt-1 text-center">(me)</div> -->
                        </div>
                        <div class="chat-container">
                            <div class="d-flex flex-wrap justify-content-between mb-1">
                                <h4 v-if="message.user.user_type.name == 'customer'">@{{message.user.name}}</h4>
                                <h4 class="chat-reply-admin" v-else>@{{message.user.name}} (@{{message.user.user_type.label}})</h4>
                                <div class="chat-date">@{{message.created_time}}</div>
                            </div>
                            <div class="chat-details position-relative pe-3">
                                <p>@{{message.message}}</p>
                                <div class="dropdown">
                                    <button class="btn dropdown-toggle p-0" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="4" height="16" viewBox="0 0 4 16">
                                            <g id="Group_346" data-name="Group 346" transform="translate(0.215 -0.197)" opacity="0.76">
                                                <circle id="Ellipse_45" data-name="Ellipse 45" cx="2" cy="2" r="2" transform="translate(-0.215 0.197)" fill="#707070" />
                                                <circle id="Ellipse_46" data-name="Ellipse 46" cx="2" cy="2" r="2" transform="translate(-0.215 6.197)" fill="#707070" />
                                                <circle id="Ellipse_47" data-name="Ellipse 47" cx="2" cy="2" r="2" transform="translate(-0.215 12.197)" fill="#707070" />
                                            </g>
                                        </svg>
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                        @if (auth()->check())
                                        <li @click="chatReply = true"><a class="dropdown-item" href="javascript:void(0)">Add Reply</a></li>
                                        @endif
                                        <li><a class="dropdown-item" href="#">Favourite it</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="chat-reply" :class="{'customer': childMessage.user.user_type.name == 'customer'}" v-for="childMessage in message.child" :key="childMessage.id">
                                <h4 v-if="childMessage.user.user_type.name == 'customer'">@{{childMessage.user.name}}</h4>
                                <h4 v-else>@{{childMessage.user.name}} (@{{childMessage.user.user_type.label}})</h4>
                                <p>@{{childMessage.message}}</p>
                            </div>
                            <div class="chat-reply" v-if="chatReply">
                                <form method="post" action="{{route('addMessage',['id' => $card->id])}}" novalidate @submit.prevent="addMessage" enctype="multipart/form-data" @change="form.onChange($event)" @keydown="form.onKeydown($event)">
                                    <div class="d-flex justify-content-center row chat-searchbar mt-2 position-relative">
                                        <div class="bg-light p-2">
                                            <div class="d-flex flex-row align-items-start">
                                                <textarea placeholder="Type your reply" cols="5" :id="'chat_message'+message.id" name="message" v-model="form.message" class="form-control ml-1 shadow-none textarea"></textarea>
                                            </div>
                                            <div class="mt-2 text-right">
                                                <button class="btn btn-primary btn-sm shadow-none post-comment-button" type="submit" style="width: 86px;" :disabled="form.busy"> <i class="spinner-border spinner-border-sm" v-if="form.busy"></i> <span v-else>Post reply</span></button>
                                                <button class="btn btn-secondary btn-sm shadow-none post-comment-button" type="button" @click="chatReply = false">Cancel</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </user-message>
            </div>
        </div>
    </div>
    @if (auth()->check())
    <form method="post" action="{{route('addMessage',['id' => $card->id])}}" novalidate @submit.prevent="addMessage" enctype="multipart/form-data" @change="form.onChange($event)" @keydown="form.onKeydown($event)">
        <div class="d-flex justify-content-center row chat-searchbar mt-2 position-relative">
            <div class="bg-light p-2">
                <div class="d-flex flex-row align-items-start">
                    <textarea placeholder="Type your message" cols="5" id="chat_message" name="message" v-model="form.message" class="form-control ml-1 shadow-none textarea"></textarea>
                </div>
                <div class="mt-2 text-right">
                    <button class="btn btn-primary btn-sm shadow-none post-comment-button" type="submit" style="width: 140px;" :disabled="form.busy"> <i class="spinner-border spinner-border-sm" v-if="form.busy"></i> <span v-else>Post comment</span></button>
                </div>
            </div>
        </div>
    </form>
    @endif

    <div id="userChatMessagesSearch"></div>
</div>
