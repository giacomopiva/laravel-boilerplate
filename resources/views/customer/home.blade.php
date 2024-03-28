@extends('layouts.app')

@section('content')
    <div id="app">
        <div class="container-fluid">
            <div class="block-header">
                <h2>@{{ title }}
                    <small>@{{ smallTitle }}</small>
                </h2>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        const {
            createApp
        } = Vue;

        var app = createApp({
            data() {
                return {
                    title: '',
                    smallTitle: 'Home del customer'
                }
            },

            mounted() {
                this.startup();
            },

            methods: {
                startup: function() {
                    this.title = "Home";
                },
            },
        }).mount('#app');
    </script>
@endsection
