<div class="m-stack__item m-stack__item--middle m-stack__item--fluid">
    <button class="m-aside-header-menu-mobile-close  m-aside-header-menu-mobile-close--skin-light "
            id="m_aside_header_menu_mobile_close_btn"><i class="la la-close"></i></button>
    <div id="m_header_menu"
         class="m-header-menu m-aside-header-menu-mobile m-aside-header-menu-mobile--offcanvas  m-header-menu--skin-dark m-header-menu--submenu-skin-light m-aside-header-menu-mobile--skin-light m-aside-header-menu-mobile--submenu-skin-light ">
        <ul class="m-menu__nav  m-menu__nav--submenu-arrow ">
            <li class="m-menu__item m-menu__item{{ request()->is('dashboard') ? '--active': '' }}" aria-haspopup="true">
                <a href="{{ url('/dashboard') }}" class="m-menu__link ">
                    <span class="m-menu__item-here"></span>
                    <span class="m-menu__link-text">الرئيسية</span>
                </a>
            </li>

            <li class="m-menu__item m-menu__item{{ request()->is('dashboard/admins*') ? '--active': '' }}" aria-haspopup="true">
                <a href="{{ url('/dashboard/admins') }}" class="m-menu__link ">
                    <span class="m-menu__item-here"></span>
                    <span class="m-menu__link-text">المديرين</span>
                </a>
            </li>

            <li class="m-menu__item m-menu__item{{ request()->is('dashboard/drivers*') ? '--active': '' }}" aria-haspopup="true">
                <a href="{{ url('/dashboard/drivers') }}" class="m-menu__link ">
                    <span class="m-menu__item-here"></span>
                    <span class="m-menu__link-text">السائقين</span>
                </a>
            </li>

            <li class="m-menu__item m-menu__item{{ request()->is('dashboard/delegates*') ? '--active': '' }}" aria-haspopup="true">
                <a href="{{ url('/dashboard/delegates') }}" class="m-menu__link ">
                    <span class="m-menu__item-here"></span>
                    <span class="m-menu__link-text">المندوبين</span>
                </a>
            </li>

            <li class="m-menu__item m-menu__item{{ request()->is('dashboard/clients*') ? '--active': '' }}" aria-haspopup="true">
                <a href="{{ url('/dashboard/clients') }}" class="m-menu__link ">
                    <span class="m-menu__item-here"></span>
                    <span class="m-menu__link-text">العملاء</span>
                </a>
            </li>

            <li class="m-menu__item m-menu__item{{ request()->is('dashboard/confirmation_requests*') ? '--active': '' }}" aria-haspopup="true">
                <a href="{{ url('/dashboard/confirmation_requests') }}" class="m-menu__link ">
                    <span class="m-menu__item-here"></span>
                    <span class="m-menu__link-text">طلبات التوثيق</span>
                </a>
            </li>

            <li class="m-menu__item m-menu__item{{ request()->is('dashboard/delivery_orders*') ? '--active': '' }}" aria-haspopup="true">
                <a href="{{ url('/dashboard/delivery_orders') }}" class="m-menu__link ">
                    <span class="m-menu__item-here"></span>
                    <span class="m-menu__link-text">طلبات التوصيل</span>
                </a>
            </li>

            <li class="m-menu__item m-menu__item{{ request()->is('dashboard/taxi_orders*') ? '--active': '' }}" aria-haspopup="true">
                <a href="{{ url('/dashboard/taxi_orders') }}" class="m-menu__link ">
                    <span class="m-menu__item-here"></span>
                    <span class="m-menu__link-text">طلبات المشاوير</span>
                </a>
            </li>

            <li class="m-menu__item m-menu__item{{ request()->is('dashboard/payments*') ? '--active': '' }}" aria-haspopup="true">
                <a href="{{ url('/dashboard/payments') }}" class="m-menu__link ">
                    <span class="m-menu__item-here"></span>
                    <span class="m-menu__link-text">الدفعات</span>
                </a>
            </li>

            <li class="m-menu__item m-menu__item{{ request()->is('dashboard/complaints*') ? '--active': '' }}" aria-haspopup="true">
                <a href="{{ url('/dashboard/complaints') }}" class="m-menu__link ">
                    <span class="m-menu__item-here"></span>
                    <span class="m-menu__link-text">الشكاوى </span>
                </a>
            </li>

            <li class="m-menu__item m-menu__item{{ request()->is('dashboard/notifications*') ? '--active': '' }}" aria-haspopup="true">
                <a href="{{ url('/dashboard/notifications') }}" class="m-menu__link ">
                    <span class="m-menu__item-here"></span>
                    <span class="m-menu__link-text">الاشعارات </span>
                </a>
            </li>
            <li class="m-menu__item m-menu__item{{ request()->is('dashboard/settings*') ? '--active': '' }}" aria-haspopup="true">
                <a href="{{ url('/dashboard/settings') }}" class="m-menu__link ">
                    <span class="m-menu__item-here"></span>
                    <span class="m-menu__link-text">الاعدادات </span>
                </a>
            </li>

        </ul>
    </div>
</div>
