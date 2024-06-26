<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>+OC | Dashboard</title>

    <link href="/onlineCourse/public/css/bootstrap.min.css" rel="stylesheet">
    <link href="/onlineCourse/public/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="/onlineCourse/public/css/animate.css" rel="stylesheet">
    <link href="/onlineCourse/public/css/style.css" rel="stylesheet">

    <!-- Sweet Alert -->
    <link href="/onlineCourse/public/css/plugins/sweetalert/sweetalert.css" rel="stylesheet">

</head>

<body class="top-navigation">

    <div id="wrapper">
        <div id="page-wrapper" class="gray-bg">
        <div class="row border-bottom white-bg">
        <nav class="navbar navbar-static-top" role="navigation">
            <div class="navbar-header">
                <button aria-controls="navbar" aria-expanded="false" data-target="#navbar" data-toggle="collapse" class="navbar-toggle collapsed" type="button">
                    <i class="fa fa-reorder"></i>
                </button>
                <a href="/onlineCourse/" class="navbar-brand">+OC</a>
            </div>
            <div class="navbar-collapse collapse" id="navbar">
                <ul class="nav navbar-nav">
                    <li class="dropdown">
                        <a aria-expanded="false" role="button" href="/onlineCourse/courses"> Courses</a>
                    </li>
                    <li class="dropdown">
                        <a aria-expanded="false" role="button" href="/onlineCourse/my/courses" > My Courses</a>
                    </li>

                </ul>
                <ul class="nav navbar-top-links navbar-right">
                    <li class="dropdown">
                        <a aria-expanded="false" role="button" href="#" class="dropdown-toggle" data-toggle="dropdown"> <?php echo $_SESSION['user']['name'] ?> <span class="caret"></span></a>
                        <ul role="menu" class="dropdown-menu">
                            <li><a href="/onlineCourse/profile">Profile</a></li>
                            <li><a href="/onlineCourse/logout">
                            <i class="fa fa-sign-out"></i> Log out
                        </a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
        </div>