<!DOCTYPE html>
<html lang="en">

<head><meta charset="gb18030">
    
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    
    <?php if(isset($reload)): ?>
    
     <meta http-equiv="refresh" content="60"> 
     
    <?php endif; ?>
    <title>ninetofab</title>
    <link href="/css/styles.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
    <link rel="icon" type="image/x-icon" href="/assets/img/ninetofab_logo_4.png" />
    <script data-search-pseudo-elements defer src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.24.1/feather.min.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="/css/selectize.css" />
    <script type="text/javascript" src="/js/selectize.js"></script>

</head>

<body class="nav-fixed">
    <nav class="topnav navbar navbar-expand shadow navbar-light bg-white" id="sidenavAccordion">
        <a class="navbar-brand d-none d-sm-block" href="/"><img src="/assets/img/ninetofab_logo_4.png"/></a><button class="btn btn-icon btn-transparent-dark order-1 order-lg-0 mr-lg-2" id="sidebarToggle" href="#"><i class="text-red" data-feather="menu"></i></button>
        <ul class="navbar-nav align-items-center ml-auto">
            <li class="mr-3">
                <a class="btn btn-transparent-dark" href="/user/logout">Logout? (<?= $_SESSION['user_name']; ?>) </a>
            </li>
        </ul>
    </nav>