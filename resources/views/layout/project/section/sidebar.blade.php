<div class="profile-sidebar">
    <div class="border rounded-3 py-3">
        <div class="d-flex justify-content-between align-items-center px-3">
            <div class="d-flex align-items-center">
                <div class="profile-img">
                    <img width="60"
                    src="{{ Auth::user()->avatar ?? url('assets/library/shadonic/icons/no.jpg') }}">
                </div>
                <div class="me-3">
                    <h6 class="fw-bold m-0">{{ Auth::user()->name ?? 'کاربر مهمان' }}</h6>
                    <span class="profile-number">{{ Auth::user()->mobile ?? '09xxxxxxxxx' }}</span>
                </div>
            </div>
        </div>
        <div class="d-flex mx-4">
            <div class="d-flex align-items-center position-relative profile-dot me-2 pt-4">
                <div class="me-1">
                    <svg xmlns="http://www.w3.org/2000/svg" width="9" height="9" viewBox="0 0 9 9" fill="none">
                        <circle cx="4.5" cy="4.5" r="4.5" fill="#D9D9D9" />
                    </svg>
                </div>
                <div class="me-2">
                    <h6 class="profile-text-detail">
                        elc
                    </h6>
                    <a class="profile-active-wallet">
                        v0.00
                    </a>
                </div>
            </div>
        </div>
        <ul class="m-0 p-0 mt-3">
            <li class="my-2">
                <a class="d-block profile-link px-4 active-link" href="{{ url('profile/dashboard') }}">
                    <div class="border-bottom py-3 d-flex align-items-center justify-content-center">
                        <span class="me-2">الکترونیک</span>
                    </div>
                </a>
            </li>
            <li class="nav-item has-submenu">
                <a class="nav-link profile-link nav-link-1" href="#">
                    <div class="d-flex align-items-center">
                        <div class="border-bottom py-3 d-flex align-items-center mx-3 w-100">
                            <span class="me-2">
                                <img src="{{ url('assets/icons/project.svg') }}" width="23" height="23" />
                            </span>
                            <div class="d-flex justify-content-between w-100 align-items-center">
                                <span class="me-2 fs-14">پروژه</span>
                                    <img src="{{ url('assets/library/shadonic/icons/arrow.svg') }}" width="20" height="16" />
                            </div>
                        </div>
                    </div>
                </a>
                <ul class="submenu p-0 {{ request()->is('project*') ? 'has-submenu' : 'collapse' }}">
                    <li class="{{ request()->is('project*') ? 'active-link' : '' }}">
                        <a class="nav-link py-2 pe-4" href="{{ url('project') }}">پروژه</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item has-submenu">
                <a class="nav-link profile-link nav-link-1" href="#">
                    <div class="d-flex align-items-center">
                        <div class="border-bottom py-3 d-flex align-items-center mx-3 w-100">
                            <span class="me-2">
                                <img src="{{ url('assets/icons/micro.svg') }}" width="23" height="23" />
                            </span>
                            <div class="d-flex justify-content-between w-100 align-items-center">
                                <span class="me-2 fs-14">میکرو و برد</span>
                                    <img src="{{ url('assets/library/shadonic/icons/arrow.svg') }}" width="20" height="16" />
                            </div>
                        </div>
                    </div>
                </a>
                <ul class="submenu p-0 {{ request()->is('micro*') || request()->is('board*') ? 'has-submenu' : 'collapse' }}">
                    <li class="{{ request()->is('micro*') ? 'active-link' : '' }}">
                        <a class="nav-link py-2 pe-4" href="{{ url('micro') }}">میکرو</a>
                    </li>
                    <li class="{{ request()->is('board*') ? 'active-link' : '' }}">
                        <a class="nav-link py-2 pe-4" href="{{ url('board') }}">برد</a>
                    </li>
                </ul>
            </li>
            <li>
                <a class="d-block profile-link px-4" href="{{ url('/logout') }}">
                    <div class=" py-3">
                        <img src="{{ url('assets/library/shadonic/icons/exit.svg') }}" width="23" height="23" />
                        <span class="me-2 fs-14">خروج</span>
                    </div>
                </a>
            </li>
        </ul>
    </div>
</div>
