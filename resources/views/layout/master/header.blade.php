<header id="sochead" class="site-header social-header user-nav-active">
    <nav class="navbar kmk-navbar social fixed-top">
        <div class="container">
            <div id="kmk-ajax-search" class="kmk-ajax-search">
                <form role="search" method="get" id="ajax-search-form" class="ajax-search-form form-inline"
                    action="./">
                    <div class="search-field">
                        <i class="icon ion-android-search"></i>
                        <input id="ajax-search-textfield" type="text" name="s" placeholder="Search..."
                            value="" autocomplete="off" required>
                        <span class="kmk-loading-ring"></span>
                    </div>
                    <div class="search-button">
                        <button type="submit" class="search-submit"><i class="icon ion-android-search"></i></button>
                    </div>
                </form>
                <div id="ajax-search-result"></div>
            </div>

            <ul id="navbar-user" class="navbar-nav navbar-user">
                <li class="mini-cart nav-item"><a href="./cart/" class="cart-contents nav-link" title="View Cart"><i
                            class="uil-cart"></i></a></li>
                <li class="nav-item">
                    <a href="#" class="nav-link login" data-toggle="modal" data-target="#login-modal">Login</a>
                </li>

                <li class="nav-item">
                    <a href="./register/" class="nav-link register">Register</a>
                </li>
            </ul>
        </div>
    </nav>
</header>
