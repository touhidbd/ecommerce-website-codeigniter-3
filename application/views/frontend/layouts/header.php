<body>
    
    <!-- ***** Preloader Start ***** -->
    <div id="preloader">
        <div class="jumper">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>  
    <!-- ***** Preloader End ***** -->
    
    
    <!-- ***** Header Area Start ***** -->
    <header class="header-area header-sticky">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav class="main-nav">
                        <!-- ***** Logo Start ***** -->
                        <a href="<?= base_url(); ?>" class="logo">
                            <img src="<?= base_url(); ?>assets/frontend/images/logo.png">
                        </a>
                        <!-- ***** Logo End ***** -->
                        <!-- ***** Menu Start ***** -->
                        <ul class="nav">
                            <li class="scroll-to-section"><a href="#top">Home</a></li>
                            <li class="scroll-to-section"><a href="#men">Men's</a></li>
                            <li class="scroll-to-section"><a href="#women">Women's</a></li>
                            <li class="scroll-to-section"><a href="#kids">Kid's</a></li>
                            <li><a href="<?= base_url('shop'); ?>">Shop</a></li>
                            <li class="scroll-to-section"><a href="#explore">Explore</a></li>
                            <li class="submenu">
                                <?php if(isset($_SESSION['authenticated'])): ?>
                                <a href="javascript:;"><?= $_SESSION['auth_user']['first_name'] .' '. $_SESSION['auth_user']['last_name']; ?></a>
                                <ul>
                                    <li><a href="<?= base_url('account'); ?>">Details</a></li>
                                    <li><a href="<?= base_url('logout'); ?>">Logout</a></li>
                                </ul>
                                <?php else: ?>
                                <a href="javascript:;">Register</a>
                                <ul>
                                    <li><a href="<?= base_url('login'); ?>">login</a></li>
                                    <li><a href="<?= base_url('register'); ?>">Register</a></li>
                                </ul>
                                <?php endif; ?>
                            </li>
                            <li>
                                <a class="cart" href="<?= base_url('cart'); ?>">
                                    <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                    <span class="bg-info text-white rounded-circle p-1 cart-number"><small>0</small></span>
                                </a>
                            </li>
                        </ul>        
                        <a class='menu-trigger'>
                            <span>Menu</span>
                        </a>
                        <!-- ***** Menu End ***** -->
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <!-- ***** Header Area End ***** -->