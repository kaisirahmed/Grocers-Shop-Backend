<!Doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title> @yield('title') | Admin </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Gocer Login Panel" name="description" />
    <meta content="Learning" name="author" />
    <!-- App favicon -->
    
    @include('admin.components.link.link')

</head>

<body>

    <div id="main-wrapper">

        <div class="unix-login">
            <div class="container-fluid">
                @yield('content')
            </div>
        </div>

    </div>

    @include('admin.components.script.script')
</body>
</html>
