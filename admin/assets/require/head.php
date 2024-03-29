<?php
require('page_deco_auto.php');
require('session_regenerate.php'); ?>

<!doctype html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Diplome Admin</title>
    <link rel="canonical" href="https://getbootstrap.com/docs/5.2/examples/dashboard/">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    <link href="./css/bootstrap.min.css" rel="stylesheet">
    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }

        .b-example-divider {
            height: 3rem;
            background-color: rgba(0, 0, 0, .1);
            border: solid rgba(0, 0, 0, .15);
            border-width: 1px 0;
            box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
        }

        .b-example-vr {
            flex-shrink: 0;
            width: 1.5rem;
            height: 100vh;
        }

        .bi {
            vertical-align: -.125em;
            fill: currentColor;
        }

        .nav-scroller {
            position: relative;
            z-index: 2;
            height: 2.75rem;
            overflow-y: hidden;
        }

        .nav-scroller .nav {
            display: flex;
            flex-wrap: nowrap;
            padding-bottom: 1rem;
            margin-top: -1px;
            overflow-x: auto;
            text-align: center;
            white-space: nowrap;
            -webkit-overflow-scrolling: touch;
        }

        .pt-3 {
            padding-top: 5rem !important;
        }

        .sticky-top {
            position: fixed;
            width: 100vw;
        }

        .modal_messages {
            display: none;
            position: fixed;
            z-index: 1500;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgb(0, 0, 0, 0.7);
            flex-direction: column;
            justify-content: center;
        }

        .modal_messages .modal_content {
            display: flex;
            justify-content: center;
        }


        .modal_form h2 {
            font-size: 18px;
        }

        .modal_form label {
            font-size: 12px;
        }


        .modal_content {
            margin: 5% auto;
            width: 60%;
            overflow: auto;
        }

        .modal_form_content {
            background-color: white;
            border: 2px solid rgba(255, 255, 255, 0.1);
            padding: 1rem 2rem 1rem 2rem;
            display: flex;
            display: flex;
            flex-direction: column;
            align-items: center;
            font-size: 1rem;
            border-radius: 16px;
            text-align: center;
        }

        .modal_description {
            overflow: hidden;
            white-space: pre-line;
            display: flex;
            justify-content: center;
        }

        #input_price,
        #input_contact,
        #input_description,
        #input_composer,
        #input_title,
        #input_password,
        #input_name_lastname,
        #input_credits_reporting,
        #input_content {
            display: none;
        }
    </style>
    <link href="./css/dashboard.css" rel="stylesheet">
</head>

<body>

    <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
        <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 fs-6" href="#">Beyond The Abyss</a>
        <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="form-control form-control-dark w-100 rounded-0 border-0" type="text" placeholder="Search" aria-label="Search"></div>
        <div class="navbar-nav">
            <div class="nav-item text-nowrap">
                <a class="nav-link px-3" href="/Diplome/index.php" style="width: 5rem;">Home</a>
            </div>
        </div>
    </header>

    <div class="container-fluid">
        <div class="row">
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
                <div class="position-sticky pt-3">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link" href="contents.php">
                                <span data-feather="shopping-cart" class="align-text-bottom"></span>
                                Contents
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="users.php">
                                <span data-feather="bar-chart-2" class="align-text-bottom"></span>
                                Users
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="purchased_contents.php">
                                <span data-feather="file" class="align-text-bottom"></span>
                                Purchased contents
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="comments.php">
                                <span data-feather="layers" class="align-text-bottom"></span>
                                Comments
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="notifications.php">
                                <span data-feather="layers" class="align-text-bottom"></span>
                                Notifications
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="contacts.php">
                                <span data-feather="layers" class="align-text-bottom"></span>
                                Contacts
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="reportings.php">
                                <span data-feather="layers" class="align-text-bottom"></span>
                                Reportings
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4" style="margin-top: 7rem;">