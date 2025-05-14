<div class="header">
    <div class="nav-header">
        <div class="nav-control">
            <div class="hamburger"><span class="line"></span> <span class="line"></span> <span class="line"></span>
            </div>
        </div>
    </div>
    <div class="header-content">
        <div class="header-left">
            <ul>
                <li class="icons position-relative"><a href="javascript:void(0)"><i
                            class="icon-magnifier f-s-16"></i></a>
                    <div class="drop-down animated bounceInDown">
                        <div class="dropdown-content-body">
                            <div class="header-search" id="header-search">
                                <form action="#">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Search">
                                        <div class="input-group-append"><span class="input-group-text"><i
                                                    class="icon-magnifier"></i></span></div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>

        <!-- Move the account icon to the right -->
        <div class="header-right ml-auto"> <!-- ml-auto will push the element to the right -->
            <ul>
                <li class="icons">
                    <a href="javascript:void(0)">
                        <i class="mdi mdi-account f-s-20" aria-hidden="true"></i>
                    </a>
                    <div class="drop-down dropdown-profile animated bounceInDown">
                        <div class="dropdown-content-body">
                            <ul>
                                {{-- Profile Page --}}
                                <li>
                                    <a href="{{ route('profile.edit') }}"
                                        style="background: none; border: none; color: inherit; cursor: pointer;">
                                        <i class="mdi mdi-account f-s-20"></i>
                                        <span>Profile</span></a>
                                </li>
                                <!-- Logout Form -->
                                <li>
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit"
                                            style="background: none; border: none; color: inherit; cursor: pointer;">
                                            <i class="icon-power"></i>
                                            <span>Logout</span>
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>
