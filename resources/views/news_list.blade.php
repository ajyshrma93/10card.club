@extends('layouts.app')
@section('title', 'News List')
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
                        <h1 class="small fw-medium text-center m-0">News List</h1>
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
                            <h5>News List</h5>
                        </div>
                        <div class="card-body">
                            <div class="alert alert-dismissible fade show" :class="{'alert-danger': message.type == 'error','alert-success': message.type == 'success'}" v-for="message in messageBox" :index="message.index" role="alert">
                                @{{ message.message }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                            <a href="{{route('news_create')}}" class="btn btn-primary">Add News</a>
                            <table class="table table-bordeless" id="cardsList">
                                <thead>
                                    <tr>
                                        <th scope="col">Index</th>
                                        <th scope="col">Cover Image</th>
                                        <th scope="col">Title</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(news,index) in newsList" :key="news.id">
                                        <td>@{{index + 1}}</td>
                                        <td><img :src="news.cover_image" style="width: 100px;height: 50px;" /></td>
                                        <td>@{{news.title}}</td>
                                        <td><a :href="news.edit_path">Edit</a> | <a href="javascript:void(0);" @click="deleteNews(news)">Delete</a></td>
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
    var news_list = '{!! addslashes(json_encode($news_list)) !!}';
    var asset = "{{asset('/')}}";
    var app = new Vue({
        el: '#app',
        data() {
            return {
                newsList: [],
                messageBox: [],
            }
        },
        mounted() {
            var newsList = JSON.parse(news_list);
            var vm = this;
            newsList.forEach(element => {
                if (element.cover_image != null) {
                    element.cover_image = asset + element.cover_image;
                } else {
                    element.cover_image = asset + '/assets/images/default-news-image.png'
                }
                element.edit_path = "/news/edit/" + element.id
                this.newsList.push(element);
            });

        },
        methods: {
            deleteNews(news) {
                this.messageBox = [];
                if (confirm('Are you sure you want to delete this news ?')) {
                    var url = '/news/delete/' + news.id;
                    const response = axios.delete(url);
                    response.then((response) => {
                        if (response.data.success) {
                            this.messageBox.push({
                                type: 'success',
                                message: response.data.message
                            });
                            var check = this.newsList.indexOf(news);
                            console.log(check);
                            if (check >= 0) {
                                this.newsList.splice(check, 1);
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
        }
    });
</script>
@endsection
