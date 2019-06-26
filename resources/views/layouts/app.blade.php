<!DOCTYPE html>
<html lang="en">

<head>

    <title>Engenharia de Software</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('assets/css/vendor.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/styles.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Ubuntu" />
    <link rel="shortcut icon" href="assets/demo/default/media/img/logo/favicon.ico" />

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([ 'csrf' => csrf_token(), 'url' => url('/') ]); ?>;
    </script>

</head>

<body>

	<div class="wrapper">
        <main>@yield('content')</main>
	</div>

    <footer>
        <div class="container">
            <div class="info">
                <span class="title">Engenharia de Software</span>
                <div class="names">
                    <span>Victor Noleto</span>
                    <span>Victor Nery</span>
                    <span>Lucas Costa</span>
                    <span>Kéthlyn</span>
                    <span>João Pedro</span>
                </div>
            </div>
        </div>
    </footer>

	<script src="{{ asset('assets/js/vendor.min.js') }}"></script>
	<script src="{{ asset('assets/js/scripts.min.js') }}"></script>

</body>
</html>
