@extends('layouts.app')

@section('frontmatter')
    <nav id="sidebar" aria-label="Main Navigation">
        <div class="bg-header-dark">
            <div class="content-header bg-white-5 py-5">
                <a class="fw-semibold text-white tracking-wide" href=".">
                    <span class="smini-visible">
                        P<span class="opacity-75">H</span>
                    </span>
                    <span class="smini-hidden">
                        <img src="/media/logos/logo-short-white.png" class="img-fluid" style="width: 200px" />
                    </span>
                </a>
                <div>
                    <button type="button" class="btn btn-alt-secondary d-lg-none ms-1" data-toggle="layout"
                        data-action="sidebar_close">
                        <i class="fa fa-fw fa-times"></i>
                    </button>
                </div>
            </div>
        </div>

        <div class="js-sidebar-scroll">
            <div class="content-side">
                <ul class="nav-main text-light">
                    <li class="nav-main-item">
                        <a class="nav-main-link" href=".">
                            <i class="nav-main-link-icon fa fa-home"></i>
                            <span class="nav-main-link-name text-light">ГЛАВНАЯ</span>
                        </a>
                    </li>
                    <li class="nav-main-item">
                        <a class="nav-main-link" href="#about-company">
                            <i class="nav-main-link-icon fa fa-users"></i>
                            <span class="nav-main-link-name text-light">О КОМПАНИИ</span>
                        </a>
                    </li>
                    <li class="nav-main-item">
                        <a class="nav-main-link" href="#about-product">
                            <i class="nav-main-link-icon fas fa-star"></i>
                            <span class="nav-main-link-name text-light">О ПРОДУКТЕ</span>
                        </a>
                    </li>
                    <li class="nav-main-item">
                        <a class="nav-main-link" href="#tariffs">
                            <i class="nav-main-link-icon fas fa-cubes"></i>
                            <span class="nav-main-link-name text-light">ТАРИФЫ</span>
                        </a>
                    </li>
                    <li class="nav-main-item">
                        <a class="nav-main-link" href="#page-footer">
                            <i class="nav-main-link-icon fa fa-envelope"></i>
                            <span class="nav-main-link-name text-light">КОНТАКТЫ</span>
                        </a>
                    </li>
                    <li class="nav-main-item">
                        <a class="nav-main-link active" href="login">
                            <i class="nav-main-link-icon fa fa-user"></i>
                            <span class="nav-main-link-name">ЛИЧНЫЙ КАБИНЕТ</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <header id="page-header" class="py-3 animated bounceInDown">
        <div class="content-header">
            <div class="d-flex align-items-center">
                <a class="fs-lg fw-semibold text-dark" href=".">
                    <img src="/media/logos/logo-short-white.png" class="img-fluid" style="width: 200px" />
                </a>
            </div>

            <div class="d-flex align-items-center">
                <div class="d-none d-lg-block">
                    <ul class="nav-main nav-main-horizontal nav-main-hover">
                        <li class="nav-main-item">
                            <a class="nav-main-link" href=".">
                                <i class="nav-main-link-icon fa fa-home"></i>
                                <span class="nav-main-link-name text-light">ГЛАВНАЯ</span>
                            </a>
                        </li>
                        <li class="nav-main-item">
                            <a class="nav-main-link" href="#about-company">
                                <i class="nav-main-link-icon fa fa-users"></i>
                                <span class="nav-main-link-name text-light">О КОМПАНИИ</span>
                            </a>
                        </li>
                        <li class="nav-main-item">
                            <a class="nav-main-link" href="#about-product">
                                <i class="nav-main-link-icon fas fa-star"></i>
                                <span class="nav-main-link-name text-light">О ПРОДУКТЕ</span>
                            </a>
                        </li>
                        <li class="nav-main-item">
                            <a class="nav-main-link" href="#tariffs">
                                <i class="nav-main-link-icon fas fa-cubes"></i>
                                <span class="nav-main-link-name text-light">ТАРИФЫ</span>
                            </a>
                        </li>
                        <li class="nav-main-item">
                            <a class="nav-main-link" href="#page-footer">
                                <i class="nav-main-link-icon fa fa-envelope"></i>
                                <span class="nav-main-link-name text-light">КОНТАКТЫ</span>
                            </a>
                        </li>
                        <li class="nav-main-item">
                            <a class="nav-main-link active" href="login">
                                <i class="nav-main-link-icon fa fa-user"></i>
                                <span class="nav-main-link-name">ЛИЧНЫЙ КАБИНЕТ</span>
                            </a>
                        </li>
                    </ul>
                </div>
                <button type="button" class="btn btn-alt-secondary d-lg-none ms-1" data-toggle="layout"
                    data-action="sidebar_toggle">
                    <i class="fa fa-fw fa-bars"></i>
                </button>
            </div>
        </div>

        <div id="page-header-loader" class="overlay-header bg-primary-darker">
            <div class="content-header">
                <div class="w-100 text-center">
                    <i class="fa fa-fw fa-2x fa-sun fa-spin text-white"></i>
                </div>
            </div>
        </div>
    </header>
@endsection

@section('content')
    <style>
        .bg-hero {
            background-image: url("media/welcome/hero2.jpg");
            background-size: cover;
            background-repeat: no-repeat;
            background-position: top;
        }
    </style>
    <div class="bg-image bg-hero" id="index">
        <div class="hero bg-primary-dark-op">
            <div class="hero-inner">
                <div class="content content-full">
                    <div class="row  animated fadeIn">
                        <div class="col-lg-5 text-center text-lg-start d-lg-flex align-items-lg-center">
                            <div>
                                <h1 class="display-6 fw-bold text-light mb-3">
                                    Сложное в простом
                                </h1>
                                <h2 class="fw-normal fs-4 text-light mb-5">
                                    Создаём эффективные инновационные технологии, повышая качество жизни
                                    общества,
                                    реализуя и продвигая современные IT-решения
                                </h2>
                                <div>
                                    <a class="btn btn-primary px-3 py-2 m-1" href="#about-company">
                                        Узнать подробнее
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 offset-lg-1 d-none d-lg-block">
                            <img src="/media/logos/logo-icon-colorfull.png" class="img-fluid" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="hero-meta">
                <div>
                    <span class="d-inline-block animated bounce infinite">
                        <i class="si si-arrow-down text-muted fa-2x"></i>
                    </span>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-body-extra-light" id="about-company">
        <div class="content content-full">
            <div class="py-5 push">
                <h2 class="mb-2 text-center">
                    О компании
                </h2>
                <h4 class="text-muted mb-0 text-center">
                    Компания Pheonix Technology занимается разработкой программного обеспечения для
                    торговых<br />терминалов,
                    реализуя сложные идеи в IT-решения, доступные каждому
                </h4>
            </div>
        </div>
    </div>

    <div class="bg-body-light" id="about-product">
        <div class="content content-full">
            <div class="py-5 push">
                <h2 class="mb-2 text-center">
                    О продукте
                </h2>
                <h4 class="text-muted mb-0 text-center">
                    Наши уникальные торговые алгоритмы позволяют <br /> упростить процесс работы с торговыми
                    терминалами
                </h4>
            </div>

            <div class="d-flex justify-content-between align-items-center mb-5">
                <div class="me-md-5">
                    <div class="d-flex flex-row align-items-center mb-5 justify-content-center">
                        <i class="fa fa-3x fa-tachometer-alt text-primary"></i>
                        <div class="ms-3">
                            <h3 class="mb-0">Скорость</h3>
                            <p class="mb-0">Высокая скорость обработки сигналов и совершения сделок на их
                                основе</p>
                        </div>
                    </div>
                    <div class="d-flex flex-row align-items-center mb-5 justify-content-center">
                        <i class="fa fa-3x fa-layer-group text-primary"></i>
                        <div class="ms-3">
                            <h3 class="mb-0">Удобный интерфейс</h3>
                            <p class="mb-0">Мы продумали всё до мелочей, чтобы у Вас остался только
                                положительный пользовательский опыт</p>
                        </div>
                    </div>
                    <div class="d-flex flex-row align-items-center mb-5 justify-content-center">
                        <i class="fa fa-3x fa-chart-line text-primary"></i>
                        <div class="ms-3">
                            <h3 class="mb-0">Уникальные алгоритмы</h3>
                            <p class="mb-0">Наши эксперты реализовали уникальные и сильные алгоритмы
                                торговли, демонстрирующие впечатляющие результаты</p>
                        </div>
                    </div>
                </div>
                <div class="d-none d-lg-block">
                    <img src="/media/welcome/macbook_1.png" class="img-fluid" />
                </div>
            </div>
        </div>
    </div>

    <div class="bg-body-extra-light" id="about-product">
        <div class="content content-full">
            <div class="py-5 push">
                <h2 class="mb-2 text-center">
                    Преимущества
                </h2>
                <h4 class="text-muted mb-0 text-center">
                    Нам важно чтобы Вы были довольны
                </h4>

                <div class="row py-3 text-center mt-5">
                    <div class="col-sm-6 col-md-4 mb-5">
                        <div class="my-3">
                            <i class="fa fa-3x fa-star text-xsmooth"></i>
                        </div>
                        <h4 class="h5 mb-2">
                            Уникальные алгоритмы
                        </h4>
                        <p class="mb-0 text-muted">
                            Наши уникальные алгоритмы торговли качественно выделяются среди других подобных
                            решений
                        </p>
                    </div>
                    <div class="col-sm-6 col-md-4 mb-5">
                        <div class="my-3">
                            <i class="fa fa-3x fa-coins text-xsmooth"></i>
                        </div>
                        <h4 class="h5 mb-2">
                            Доступные условия
                        </h4>
                        <p class="mb-0 text-muted">
                            Условия нашей подписки подойдут всем, вне зависимости от того кто вы -
                            профессионал или новичок
                        </p>
                    </div>
                    <div class="col-sm-6 col-md-4 mb-5">
                        <div class="my-3">
                            <i class="fa fa-3x fa-network-wired text-xsmooth"></i>
                        </div>
                        <h4 class="h5 mb-2">
                            Бонусная система
                        </h4>
                        <p class="mb-0 text-muted">
                            Всем клиентам доступна бонусная система вознаграждений за использование наших
                            продуктов
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-body-light" id="tariffs">
        <div class="content content-full">
            <div class="py-5 push">
                <h2 class="mb-0 text-center">
                    Уже используете наши продукты?
                </h2>
            </div>
            <div class="row py-3 text-center">
                <div class="col-sm-6 col-md-4 mb-5">
                    <div class="my-3">
                        <i class="fa fa-3x fa-repeat text-xsmooth"></i>
                    </div>
                    <h4 class="h5 mb-2">
                        Продление лицензии
                    </h4>
                    <p class="mb-0 text-muted">
                        Уже есть активная лицензия, но заканчивается срок? Продлите её в несколько кликов в
                        своём личном кабинете.
                    </p>
                </div>
                <div class="col-sm-6 col-md-4 mb-5">
                    <div class="my-3">
                        <i class="fa fa-3x fa-key text-xsmooth"></i>
                    </div>
                    <h4 class="h5 mb-2">
                        Личный кабинет
                    </h4>
                    <p class="mb-0 text-muted">
                        Управляйте своими лицензиями и оформляйте другие услуги в своём личном кабинете.
                    </p>
                </div>
                <div class="col-sm-6 col-md-4 mb-5">
                    <div class="my-3">
                        <i class="fa fa-3x fa-headset text-xsmooth"></i>
                    </div>
                    <h4 class="h5 mb-2">
                        Техническая поддержка
                    </h4>
                    <p class="mb-0 text-muted">
                        Есть вопросы? Наша техническая поддержка ответит на любые вопросы по
                        нашим
                        продуктам.
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('backmatter')
    <footer id="page-footer" class="footer-static bg-body-extra-light">
        <div class="content py-4">
            <div class="row items-push fs-sm border-bottom pt-4 justify-content-center">
                <div class="col-md-4">
                    <h3 class="fw-semibold">Правовые документы</h3>
                    <ul class="list list-simple-mini">
                        <li>
                            <a class="fw-semibold" href="license-agreement" target="_blank">
                                <i class="fa fa-fw fa-link text-primary-lighter me-1"></i> Лицензионное соглашение
                            </a>
                        </li>
                        <li>
                            <a class="fw-semibold" href="privacy-policy" target="_blank">
                                <i class="fa fa-fw fa-link text-primary-lighter me-1"></i> Политика
                                конфиденциальности
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-4 text-center d-none d-lg-block">
                    <img src="/media/logos/logo-long-black.png" class="img-fluid w-75" /><br />
                </div>
                <div class="col-md-4">
                    <h3 class="fw-semibold">Контакты</h3>
                    <div class="fs-sm push">
                        <div>IBC Company name: PHEONIX TECHNOLOGY LTD</div>
                        <div>Registered office: Suite 101, 1626 Buttonwood Bay Blvd, Belize City, Belize </div>
                        <div>E-mail address: support@pheonix.tech</div>
                    </div>
                </div>
            </div>
            <!-- END Footer Navigation -->

            <!-- Footer Copyright -->
            <div class="fs-sm pt-4 text-center">
                <a class="fw-semibold" href="." target="_blank">{{ config('app.name') }}</a> &copy; <span
                    data-toggle="year-copy"></span> Все права защищены.
            </div>
            <!-- END Footer Copyright -->
        </div>
    </footer>
@endsection
