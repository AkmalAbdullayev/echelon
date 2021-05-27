<div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item mr-auto">
                <a class="navbar-brand" href="">
                    <div class="brand-logo">
                        <img class="logo" src="{{ asset('app-assets/images/logo/logo.png') }}"/>
                    </div>
                    <h2 class="brand-text mb-0">Echelon</h2>
                </a>
            </li>
            <li class="nav-item nav-toggle">
                <a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse">
                    <i class="bx bx-x d-block d-xl-none font-medium-4 primary"></i>
                    <i class="toggle-icon bx bx-disc font-medium-4 d-none d-xl-block primary" data-ticon="bx-disc"></i>
                </a>
            </li>
        </ul>
    </div>
    <div class="shadow-bottom"></div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation"
            data-icon-style="lines">

            <li class="nav-item active">
                <a href="">
                    <i class="menu-livicon" data-icon="home"></i>
                    <span class="menu-title">Новый заказ</span>
                </a>
            </li>

            <li class=" nav-item">
                <a href="#">
                    <i class="menu-livicon" data-icon="notebook"></i>
                    <span class="menu-title" data-i18n="Invoice">Товары</span>
                </a>
                <ul class="menu-content">
                    <li>
                        <a href="{{ route('mtrade-category-goods.index') }}">
                            <i class="bx bx-right-arrow-alt"></i>
                            <span class="menu-item" data-i18n="Invoice List">Категория товара</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('mtrade-attributes.index') }}">
                            <i class="bx bx-right-arrow-alt"></i>
                            <span class="menu-item" data-i18n="Invoice List">Атрибуты</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('mtrade-good-attribute.index') }}">
                            <i class="bx bx-right-arrow-alt"></i>
                            <span class="menu-item" data-i18n="Invoice List">Атрибуты товара</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route("mtrade-good.index")}}">
                            <i class="bx bx-right-arrow-alt"></i>
                            <span class="menu-item" data-i18n="Invoice">Товары</span>
                        </a>
                    </li>
                    <li><a href="app-invoice-edit.html"><i class="bx bx-right-arrow-alt"></i><span class="menu-item"
                                                                                                   data-i18n="Invoice Edit">Приход товара</span></a>
                    </li>
                    <li><a href="app-invoice-edit.html"><i class="bx bx-right-arrow-alt"></i><span class="menu-item"
                                                                                                   data-i18n="Invoice Edit">Первичный продукт</span></a>
                    </li>
                    <li><a href="app-invoice-add.html"><i class="bx bx-right-arrow-alt"></i><span class="menu-item"
                                                                                                  data-i18n="Invoice Add">Импорт Excel</span></a>
                    </li>
                    <li><a href="app-invoice-add.html"><i class="bx bx-right-arrow-alt"></i><span class="menu-item"
                                                                                                  data-i18n="Invoice Add">Цены</span></a>
                    </li>
                    <li><a href="app-invoice-add.html"><i class="bx bx-right-arrow-alt"></i><span class="menu-item"
                                                                                                  data-i18n="Invoice Add">Списание</span></a>
                    </li>
                </ul>
            </li>

            <li class=" nav-item"><a href="#"><i class="menu-livicon" data-icon="notebook"></i><span class="menu-title"
                                                                                                     data-i18n="Invoice">Клиент</span></a>
                <ul class="menu-content">
                    <li><a href="app-invoice-list.html"><i class="bx bx-right-arrow-alt"></i><span class="menu-item"
                                                                                                   data-i18n="Invoice List">Список клиентов</span></a>
                    </li>
                    <li><a href="app-invoice.html"><i class="bx bx-right-arrow-alt"></i><span class="menu-item"
                                                                                              data-i18n="Invoice">Баланс клиентов</span></a>
                    </li>
                    <li><a href="app-invoice-edit.html"><i class="bx bx-right-arrow-alt"></i><span class="menu-item"
                                                                                                   data-i18n="Invoice Edit">Дисконтная карта</span></a>
                    </li>
                </ul>
            </li>

            <li class=" nav-item"><a href="#"><i class="menu-livicon" data-icon="notebook"></i><span class="menu-title"
                                                                                                     data-i18n="Invoice">Отчёты</span></a>
                <ul class="menu-content">
                    <li><a href="app-invoice-list.html"><i class="bx bx-right-arrow-alt"></i><span class="menu-item"
                                                                                                   data-i18n="Invoice List">Отчёт о продажах</span></a>
                    </li>
                    <li><a href="app-invoice.html"><i class="bx bx-right-arrow-alt"></i><span class="menu-item"
                                                                                              data-i18n="Invoice"> Отчет о товаре</span></a>
                    </li>
                    <li><a href="app-invoice-edit.html"><i class="bx bx-right-arrow-alt"></i><span class="menu-item"
                                                                                                   data-i18n="Invoice Edit">Отчёт о долгах</span></a>
                    </li>
                    <li><a href="app-invoice-edit.html"><i class="bx bx-right-arrow-alt"></i><span class="menu-item"
                                                                                                   data-i18n="Invoice Edit">Остаток</span></a>
                    </li>
                </ul>
            </li>

            <li class=" nav-item"><a href="#"><i class="menu-livicon" data-icon="notebook"></i><span class="menu-title"
                                                                                                     data-i18n="Invoice">Транзакции</span></a>
                <ul class="menu-content">
                    <li><a href="app-invoice-list.html"><i class="bx bx-right-arrow-alt"></i><span class="menu-item"
                                                                                                   data-i18n="Invoice List">Внутренние расходы</span></a>
                    </li>
                    <li><a href="app-invoice.html"><i class="bx bx-right-arrow-alt"></i><span class="menu-item"
                                                                                              data-i18n="Invoice">Касса</span></a>
                    </li>
                    <li><a href="app-invoice-edit.html"><i class="bx bx-right-arrow-alt"></i><span class="menu-item"
                                                                                                   data-i18n="Invoice Edit">Оплата</span></a>
                    </li>
                    <li><a href="app-invoice-edit.html"><i class="bx bx-right-arrow-alt"></i><span class="menu-item"
                                                                                                   data-i18n="Invoice Edit">Способы оплаты</span></a>
                    </li>
                </ul>
            </li>

            <li class=" nav-item"><a href="#"><i class="menu-livicon" data-icon="notebook"></i><span class="menu-title"
                                                                                                     data-i18n="Invoice">Опции</span></a>
                <ul class="menu-content">
                    <li><a href="app-invoice-list.html"><i class="bx bx-right-arrow-alt"></i><span class="menu-item"
                                                                                                   data-i18n="Invoice List">Пользователь</span></a>
                    </li>
                    <li><a href="app-invoice.html"><i class="bx bx-right-arrow-alt"></i><span class="menu-item"
                                                                                              data-i18n="Invoice">Журнал</span></a>
                    </li>
                    <li><a href="app-invoice-edit.html"><i class="bx bx-right-arrow-alt"></i><span class="menu-item"
                                                                                                   data-i18n="Invoice Edit">Курс</span></a>
                    </li>
                    <li><a href="app-invoice-edit.html"><i class="bx bx-right-arrow-alt"></i><span class="menu-item"
                                                                                                   data-i18n="Invoice Edit">Деньги</span></a>
                    </li>
                    <li><a href="app-invoice-edit.html"><i class="bx bx-right-arrow-alt"></i><span class="menu-item"
                                                                                                   data-i18n="Invoice Edit">Единицы измерения</span></a>
                    </li>
                    <li><a href="app-invoice-edit.html"><i class="bx bx-right-arrow-alt"></i><span class="menu-item"
                                                                                                   data-i18n="Invoice Edit">Настройки</span></a>
                    </li>
                    <li>
                        <a href="frest/html/ltr/vertical-menu-template-semi-dark/index.html"><i class="bx bx-right-arrow-alt"></i>
                            <span class="menu-item" data-i18n="Invoice Edit">Шаблон</span>
                        </a>
                    </li>
                </ul>
            </li>

        <!--
                <li class="nav-item">
                    <a href="/frest/html/ltr/vertical-menu-template-semi-dark/index.html">
                        <i class="menu-livicon" data-icon="briefcase"></i>
                        <span class="menu-title">Template</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('category-primary-product.index') }}">
                        <i class="menu-livicon" data-icon="briefcase"></i>
                        <span class="menu-title">Category P.Product</span>
                    </a>
                </li>
            -->

        </ul>
    </div>
</div>
