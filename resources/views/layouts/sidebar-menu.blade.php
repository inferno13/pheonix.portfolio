<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
            <router-link to="/dashboard" class="nav-link">
                <i class="nav-icon fas fa-tachometer-alt blue"></i>
                <p>
                    Панель управления
                </p>
            </router-link>
        </li>

        <li class="nav-item">
            <router-link to="/products" class="nav-link">
                <i class="nav-icon fas fa-list orange"></i>
                <p>
                    Продукты
                </p>
            </router-link>
        </li>

        @can('isAdmin')
            <li class="nav-item">
                <router-link to="/users" class="nav-link">
                    <i class="fa fa-users nav-icon blue"></i>
                    <p>Пользователи</p>
                </router-link>
            </li>
        @endcan

        <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-wallet yellow"></i>
                <p>
                    Финансы
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">

                <li class="nav-item">
                    <router-link to="/wallet/deposit" class="nav-link">
                        <i class="nav-icon fas fa-arrow-up yellow"></i>
                        <p>
                            Пополение
                        </p>
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link to="/wallet/transfer" class="nav-link">
                        <i class="nav-icon fas fa-history yellow"></i>
                        <p>
                            Перевод
                        </p>
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link to="/wallet/withdrawal" class="nav-link">
                        <i class="nav-icon fas fa-arrow-down yellow"></i>
                        <p>
                            Выводы
                        </p>
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link to="/wallet/history" class="nav-link">
                        <i class="nav-icon fas fa-history yellow"></i>
                        <p>
                            История
                        </p>
                    </router-link>
                </li>
            </ul>
        </li>

        @can('isAdmin')
            <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-cog green"></i>
                    <p>
                        Настройки
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">

                    <li class="nav-item">
                        <router-link to="/product/category" class="nav-link">
                            <i class="nav-icon fas fa-list-ol green"></i>
                            <p>
                                Категории
                            </p>
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link to="/product/tag" class="nav-link">
                            <i class="nav-icon fas fa-tags green"></i>
                            <p>
                                Теги
                            </p>
                        </router-link>
                    </li>

                    <li class="nav-item">
                        <router-link to="/developer" class="nav-link">
                            <i class="nav-icon fas fa-cogs white"></i>
                            <p>
                                Разработчик
                            </p>
                        </router-link>
                    </li>
                </ul>
            </li>
        @endcan



        <li class="nav-item">
            <a href="#" class="nav-link"
                onclick="event.preventDefault();
          document.getElementById('logout-form').submit();">
                <i class="nav-icon fas fa-power-off red"></i>
                <p>
                    {{ __('Logout') }}
                </p>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </li>
    </ul>
</nav>
