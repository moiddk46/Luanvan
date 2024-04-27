<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title }}</title>
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body>
    <header class="bg-light">
        @if (isset($count['order']) && isset($count['priceRequest']) && isset($count['countNotice']))
            <x-User.Header :prop="$header" :title="$title" :order="$count['order']" :priceRequest="$count['priceRequest']" :listNotice="$count['listNotice']"
                :countNotice="$count['countNotice']" />
        @else
            <x-User.Header :prop="$header" :title="$title" />
        @endif
    </header>
    <main role="main">
        <div class="mt-5">
            @yield('content')
        </div>
        {{--  @extends('Pages.User.Home', compact('data'))  --}}
    </main>
    <footer class="bg-secondary">
        <x-User.footer />
    </footer>
    <div class="contact-buttons" style="position: fixed; right: 20px; bottom: 20px; z-index: 1000;">
        <a href="https://zalo.me/0854172887" class="zalo-button" target="_blank">
            <img class="img-zalo" src="{{ asset('assets/images/zalo_icon.png') }}" alt="Chat Zalo">
        </a>
        <a href="tel:+0854172887" class="call-button" target="_blank">
            <img src="{{ asset('assets/images/phone_icon.png') }}" alt="Gọi điện">
        </a>
    </div>


</body>
<script src="{{ asset('assets/js/popper.js') }}"></script>
<script src="{{ asset('assets/js/bootstap.js') }}"></script>
<script src="{{ asset('assets/js/jquery.js') }}"></script>
<script src="{{ asset('assets/js/custom.js') }}"></script>
<script src="{{ asset('assets/js/ajax.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
<script src="https://cdn.tiny.cloud/1/n9mq20pv5j3u8w8yootjsq2z0d9ubki83b1tw30h0p6byc8t/tinymce/7/tinymce.min.js"
    referrerpolicy="origin"></script>
<script>
    tinymce.init({
        selector: 'textarea#mytext',
        plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed linkchecker a11ychecker tinymcespellchecker permanentpen powerpaste advtable advcode editimage advtemplate ai mentions tinycomments tableofcontents footnotes mergetags autocorrect typography inlinecss markdown',
        toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
        tinycomments_mode: 'embedded',
        tinycomments_author: 'Author name',
        mergetags_list: [{
                value: 'First.Name',
                title: 'First Name'
            },
            {
                value: 'Email',
                title: 'Email'
            },
        ],
        ai_request: (request, respondWith) => respondWith.string(() => Promise.reject(
            "See docs to implement AI Assistant")),
    });
</script>

</html>
