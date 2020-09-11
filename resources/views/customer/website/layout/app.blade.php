<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
          integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <title>@yield('title')</title>

    <style>

        .images-box {
            /* top: -1px; */
            position: absolute;
            left: 0;
            right: 0;
            margin: 0 auto;
            bottom: 20px;
        }

        .btnsss {
            background-color: transparent;
            color: #343a40;
            font-weight: bold;
            text-transform: capitalize;
            border: 1px solid black;

        }

        .btnsss:hover {
            background-color: whitesmoke;
            color: #2a91d6;
            font-weight: bolder;
            text-transform: uppercase;
            border: 1px solid #50b8c9;
            outline: none;
            box-shadow: 0 8px 6px -6px #50b8c9 !important;
        }

        .round_button {
            border-radius: 50px;
        }

        @yield('css')

    </style>
</head>
<body>
<div class="fluid-container">
    <div class="container pt-3">
        @yield('contents')

    </div>
</div>
        <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="
        crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN"
        crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
        integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV"
        crossorigin="anonymous"></script>
@yield('scripts')
</body>
</html>
