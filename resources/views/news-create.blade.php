@extends('layouts.app')
@section('title', (isset($news_form['title'])) ? 'Edit news or ads' : 'Add news or ads')
@section('css')

<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<style>
    .quill-editor {
        margin-bottom: 41px;
    }

    .mb-3 .btn {
        margin-top: 10px !important;
    }
</style>
@endsection

@section('content')
<div class="main-wrapper">
    <div class="mainContainer">
        @include('includes.sidemenu')
        <div id="site-wrapper">
            <!-- Topbar -->
            <nav class="navbar header-topbar navbar-light mb-3">
                <div class="container d-flex justify-content-between align-items-center flex-fill">
                    <div class="d-flex align-items-center">
                        <a href="{{route('news_list')}}" class="page-back-btn rounded-circle d-block"></a>
                    </div>
                    <div>
                        <h1 class="small fw-medium text-center m-0">Create News or Ads</h1>
                    </div>
                    <div>
                        <a href="#" class="humburger-menu-btn toggle-nav d-block"></a>
                    </div>
                </div>
            </nav>
            <div class="wrapper">
                <div class="container">
                    <div class="alert alert-dismissible fade show" :class="{'alert-danger': message.type == 'error','alert-success': message.type == 'success'}" v-for="message in messageBox" :index="message.index" role="alert">
                        @{{ message.message }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    <form method="post" novalidate @submit.prevent="addNews" enctype="multipart/form-data" @change="form.onChange($event)" @keydown="form.onKeydown($event)" action="{{$form_action}}" id="news_form">
                        @csrf
                        <div class="mb-3" :class="{'has-error': form.errors.has('title')}">
                            <label for="title" class="form-label">Title *</label>
                            <input type="text" class="form-control" name="title" id="title" v-model="form.title" aria-describedby="titleHelp">
                            <span class="text-danger" v-if="form.errors.has('title')" v-html="form.errors.get('title')"></span>
                        </div>
                        <img :src="cover_image" v-if="cover_image !== null" style="width: 100px;height: 50px;" />
                        <div class="mb-3" :class="{'has-error': form.errors.has('cover_image')}">
                            <label for="cover_image" class="form-label">Cover Image</label>
                            <input class="form-control" type="file" id="cover_image" name="cover_image" @change="handleFile($event,'cover_image')" />
                            <div class="text-danger" v-if="form.errors.has('cover_image')" v-html="form.errors.get('cover_image')"></div>
                        </div>
                        <div class="mb-3" :class="{'has-error': form.errors.has('bank_id')}">
                            <label for="bank_id" class="form-label">Bank *</label>
                            <select class="form-select" aria-label="Default select example" name="bank_id" v-model="form.bank_id">
                                <option value="">--Select--</option>
                                @foreach ($banks as $bank)
                                <option value="{{$bank->id}}">{{$bank->bank_name}}</option>
                                @endforeach
                            </select>
                            <span class="text-danger" v-if="form.errors.has('bank_id')" v-html="form.errors.get('bank_id')"></span>
                        </div>
                        <div class="mb-3" :class="{'has-error': form.errors.has('card_type_id')}">
                            <label for="card_type_id" class="form-label">Card Type *</label>
                            <select class="form-select" aria-label="Default select example" v-model="form.card_type_id" name="card_type_id">
                                <option value="">--Select--</option>
                                @foreach ($card_types as $card_type)
                                <option value="{{$card_type->id}}">{{$card_type->label}}</option>
                                @endforeach
                            </select>
                            <span class="text-danger" v-if="form.errors.has('card_type_id')" v-html="form.errors.get('card_type_id')"></span>
                        </div>
                        <div class="mb-3" :class="{'has-error': form.errors.has('description')}">
                            <label for="description" class="form-label">Description *</label>
                            <quill-editor ref="quillEditor" class="editor" formnovalidate="formnovalidate" style="height: 210px;" v-model="form.description" novalidate :options="editorOption" @change="onEditorChange($event)" />

                        </div>
                        <span class="text-danger" v-if="form.errors.has('description')" v-html="form.errors.get('description')"></span>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary"><span>Submit</span></button>
                            <button type="button" class="btn btn-secondary">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js_script')
<script src="{{asset('/js/axios.js')}}"></script>
<script src="{{asset('/js/vue.js')}}"></script>
<script src="{{asset('/js/vform.js')}}"></script>
<script src="{{asset('/js/quill.js')}}"></script>
<script src="{{asset('/js/vue-quill-editor.js')}}"></script>
<script type="text/javascript">
    Vue.use(VueQuillEditor);

    var form_type = '{!! $form_type !!}';
    var form_action = '{{ $form_action }}';
    var news_form = '{!! addslashes(json_encode($news_form)) !!}';

    var app = new Vue({
        el: '#app',
        data() {
            return {
                form: new Form.Form({
                    title: '',
                    cover_image: null,
                    bank_id: '',
                    card_type_id: '',
                    description: ''
                }),
                cover_image: null,
                messageBox: [],
                editorOption: {
                    theme: 'snow',
                    modules: {
                        toolbar: [
                            [{
                                'size': []
                            }],
                            ['blockquote'],
                            [{
                                'align': []
                            }],
                            ['bold', 'italic', 'underline'],
                            [{
                                'list': 'ordered'
                            }, {
                                'list': 'bullet'
                            }],
                            ['link'],
                            [{
                                "color": [],
                            }, {
                                "background": [],
                            }, ],
                        ]
                    }

                },
            }
        },
        mounted() {
            if (form_type == 'edit') {
                var temp_news = JSON.parse(news_form);
                var cover_image = temp_news.cover_image;
                temp_news.cover_image = null;
                if (cover_image != null) {
                    this.cover_image = cover_image;
                }
                this.form.fill(JSON.parse(news_form));
            }
        },
        methods: {
            handleFile(event, field_name) {
                const file = event.target.files[0];
                this.cover_image = URL.createObjectURL(event.target.files[0]);
                this.form[field_name] = file
            },
            addNews() {
                this.messageBox = [];
                const response = this.form.post(form_action);
                response.then((response) => {
                    if (response.data.success) {
                        this.messageBox.push({
                            type: 'success',
                            message: response.data.message
                        });
                        if (form_type == 'edit') {

                        } else {
                            this.form.reset();
                            this.cover_image = null;
                        }
                        $("#cover_image")[0].value = '';
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
                }).catch((error) => {
                    if (error.response.status == '422') {
                        this.messageBox.push({
                            type: 'error',
                            message: 'The given data is invalid! Please fill all required fields'
                        });
                    }
                    const element = document.getElementsByClassName('mainContainer')[0];
                    element.scrollIntoView({
                        behavior: "smooth",
                        block: "start",
                    });
                });
            },
            onEditorChange({
                quill,
                html,
                text
            }) {},
        },
    });
</script>
@endsection
