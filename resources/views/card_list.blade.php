@extends('layouts.app')
@section('title', 'Card List')
@section('content')
<div class="main-wrapper">
    <div class="mainContainer">
        @include('includes.sidemenu')
        <div id="site-wrapper">
            <!-- Topbar -->
            <nav class="navbar header-topbar navbar-light mb-3">
                <div class="container d-flex justify-content-between align-items-center flex-fill">
                    <div class="d-flex align-items-center">
                        <a href="{{route('home')}}" class="page-back-btn rounded-circle d-block"></a>
                    </div>
                    <div>
                        <h1 class="small fw-medium text-center m-0">Card List</h1>
                    </div>
                    <div>
                        <a href="#" class="humburger-menu-btn toggle-nav d-block"></a>
                    </div>
                </div>
            </nav>
            <div class="wrapper">
                <div class="container">
                    <div class="card">
                        <div class="card-header">
                            <h5>Cards List</h5>
                        </div>
                        <div class="card-body">
                            <div class="alert alert-dismissible fade show" :class="{'alert-danger': message.type == 'error','alert-success': message.type == 'success'}" v-for="message in messageBox" :index="message.index" role="alert">
                                @{{ message.message }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                            <a href="{{route('card_add')}}" class="btn btn-primary">Add Card</a>
                            <table class="table table-bordeless" id="cardsList">
                                <thead>
                                    <tr>
                                        <th scope="col">Index</th>
                                        <th scope="col">Image</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(card,index) in cardsList" :key="card.id">
                                        <td>@{{index + 1}}</td>
                                        <td><img :src="card.card_image" style="width: 100px;height: 50px;" /></td>
                                        <td>@{{card.card_name}}</td>
                                        <td><a :href="card.edit_path">Edit</a> | <a href="javascript:void(0);" @click="deleteCard(card)">Delete</a></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js_script')
<script src="{{asset('/js/axios.js')}}"></script>
<script src="{{asset('/js/vue.js')}}"></script>
<script type="text/javascript">
    var cards = '{!! addslashes(json_encode($cards)) !!}';
    var asset = "{{asset('/')}}";
    var base_url = "{{url('/')}}";
    var app = new Vue({
        el: '#app',
        data() {
            return {
                cardsList: [],
                messageBox: [],
            }
        },
        mounted() {
            var cardsList = JSON.parse(cards);
            var vm = this;
            cardsList.forEach(element => {
                element.card_image = asset + element.card_image;
                element.edit_path = base_url + "/cards/edit/" + element.id
                this.cardsList.push(element);
            });

        },
        methods: {
            deleteCard(card) {
                this.messageBox = [];
                if (confirm('Are you sure you want to delete this card ?')) {
                    var url = base_url+'/cards/delete/' + card.id;
                    const response = axios.delete(url);
                    response.then((response) => {
                        if (response.data.success) {
                            this.messageBox.push({
                                type: 'success',
                                message: response.data.message
                            });
                            var check = this.cardsList.indexOf(card);
                            if (check >= 0) {
                                this.cardsList.splice(check, 1);
                            }
                        } else {
                            this.messageBox.push({
                                type: 'error',
                                message: response.data.message
                            });
                        }
                        const element = document.getElementsByClassName('mainContainer')[0];
                        element.scrollIntoView({
                            behavior: "smooth",
                            block: "start",
                        });
                    });
                }
            },
        },
    })
</script>
@endsection
