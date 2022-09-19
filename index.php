<?php
    session_start();
    if(isset($_SESSION['user-email'])) {
        header("Location: home.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Baybayin Restaurant</title>

    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/font-awesome.css" />
    <link rel="stylesheet" href="css/main.css" />
    <link rel="stylesheet" href="css/mobile.css" />
    <link rel="stylesheet" href="css/modals.css" />
    <script src='js/jquery-3.4.1.js'></script>
    <script>
        $(document).ready(function() {
            $("#signup").click(function() {
                $("#modal-signup").addClass("showmodal");
                $(".cover").addClass("showcover");
            });
            $("#login").click(function() {
                $("#modal-login").addClass("showmodal");
                $(".cover").addClass("showcover");
            });
            $(".fa-close").click(function() {
                $("#modal-signup").removeClass("showmodal");
                $("#modal-login").removeClass("showmodal");
                $(".cover").removeClass("showcover");
            });


            $("#submit-signup").click(function() {
                var email = $("#emailS").val();
                var pwd = $("#passwordS").val();
                var lname = $("#lname").val();
                var fname = $("#fname").val();
                var mobile = $("#mobile").val();

                $.post("php/signup.php",
                {
                    email: email,
                    password: pwd,
                    lname: lname,
                    fname: fname,
                    mobile: mobile
                },
                function(data, status) {
                    $("#emailS").val("");
                    $("#passwordS").val("");
                    $("#lname").val("");
                    $("#fname").val("");
                    $("#mobile").val("");
                    alert(data);
                });

            });
             
            $("#submit-login").click(function() {
                var emailL = $("#emailL").val();
                var pwdL = $("#passwordL").val();

                $.post("php/login.php",
                {
                    email: emailL,
                    password: pwdL
                },
                function(data, status) {
                    if(data !== "success") {
                        alert(data);
                    } else {
                        alert("You are logged in. Redirecting to homepage.");
                        window.location = 'home.php';
                    }
                });
            });

        });
    </script>
</head>
<body>

    <div class="cover">

    </div>

    <div id="modal-signup" class='modals'>
        <div class="conx"><i class='fa fa-close'></i></div>
        <div class="modal-title">Signup</div>
        <form>
            <input id='emailS' type="text" placeholder='Email'/>
            <input id='passwordS' type="password" placeholder='Password'/>
            <input id='lname' type="text" placeholder='Lastname'/>
            <input id='fname' type="text" placeholder='Firstname'/>
            <input id='mobile' type="number" placeholder='Mobile number (11 digits)'/>
            <button type='button' class='btn btn-primary' id='submit-signup'>Signup</button>
        </form>
    </div>

    <div id="modal-login" class='modals'>
        <div class="conx"><i class='fa fa-close'></i></div>
        <div class="modal-title">Login</div>
        <form>
            <input id='emailL' type="text" placeholder='Email'/>
            <input id='passwordL' type="password" placeholder='Password'/>
            <button type='button' class='btn btn-primary' id='submit-login'>Login</button>
        </form>
    </div>

    <div id="container">
    <header id='top'>
        <div class="header-contacts">
            <div class="icons-container">
                <a class="fa fa-facebook icon-border facebook icons-socmedia"></a>
                <a class="fa fa-twitter icon-border twitter icons-socmedia"></a>
                <a class="fa fa-google-plus icon-border googleplus icons-socmedia"></a>
            </div>
            <div class="contacts-container">
                <div><i class='fa fa-envelope'></i> baybayinrestau90@gmail.com</div>
                <div><i class='fa fa-phone'></i> +63 909 559 0663</div>
                <div><i class='fa fa-phone'></i> +63 909 559 0663</div>
            </div>
        </div>
        <div class="header-menu">
            <div class="banner"><a href="index.php">BAYBAYIN<small>FILIPINO RESTAURANT</small></a></div>
            <nav>
                <ul class='nav justify-content-end'>
                    <li><a href="#about">ABOUT</a></li>
                    <li><a href="#services">SERVICES</a></li>
                    <li><a id='menu-link' href="#slider-image-1">MENU</a></li>
                    <li><a href="#contact">CONTACT US</a></li>
                </ul>
            </nav>
        </div>
    </header>

        <div class='main'>
            <h1 class="restau-name">BAYBAYIN<p>RESTAURANT</p></h1>
            <p class='tagline'>Experience pleasure from delicious foods & beautiful setting fit for families and friends</p>
            <br>
            <div class="main-btns">
                <button id='signup' class='btn-main'><i class='fa fa-user-plus'></i> SIGN UP</button>
                <button id='login' class='btn-main'><i class='fa fa-sign-in'></i> LOGIN</button>
            </div>
        </div>

        <div id="about">
            <div class='about-area'>
                <h3 class="title">ABOUT</h3>
                <p class="about-desc text-center">
                    <span>Baybayin</span> restaurant is a filipino-cultured restaurant that serves the best filipino delicacies in a sophisticated setting with beautiful sceneries around the baybayin (seashore) of Maharlika beach. <br>
                </p>
                    <img src="images/about.jpg" alt="babayin-photos" />
            </div>
        </div>

        <div id="services" class="services-area">
            <h3 class="title" style='color: #fff !important;'>SERVICES</h3>

            <div class="box-container">

                <div class="services-box">
                    <i class="fa fa-spoon service-icons"></i>
                    <div class="service-title">
                        Cuisine
                    </div>
                    <div class="service-desc text-justify">
                        We offer a variety of popular & local filipino food and healthy drinks, with the service of our hospitable team.
                        <div class="checklist">
                            <p><i class="fa fa-check"></i>Unli rice</p>
                            <p><i class="fa fa-check"></i>Eat all you can promos</p>
                            <p><i class="fa fa-check"></i>Relaxing music</p>
                            <p><i class="fa fa-check"></i>High speed wifi</p>
                        </div>
                    </div>
                </div>

                <div class="services-box">
                    <i class="fa fa-book service-icons"></i>
                    <div class="service-title">
                        Catering
                    </div>
                    <div class="service-desc text-justify">
                        We will help you make the best of your special moments, providing you food catering and a themed setting of your choice. 
                        <div class="checklist">
                            <p><i class="fa fa-check"></i>Birthday celebrations</p>
                            <p><i class="fa fa-check"></i>Wedding receptions</p>
                            <p><i class="fa fa-check"></i>Friends and family reunions</p>
                            <p><i class="fa fa-check"></i>Special occassions</p>
                        </div>
                    </div>
                </div>

                <div class="services-box">
                    <i class="fa fa-motorcycle service-icons"></i>
                    <div class="service-title">
                        Delivery
                    </div>
                    <div class="service-desc text-justify">
                        Staying at home? No problem! You can request a food delivery with a minimum order within the vicinity of Maharlika.
                        <div class="checklist">
                            <p><i class="fa fa-check"></i>Low delivery fees</p>
                            <p><i class="fa fa-check"></i>Minimum order of Php 150</p>
                            <p><i class="fa fa-check"></i>On the go hotline</p>
                            <p><i class="fa fa-check"></i>Delivered while still hot</p>
                        </div>
                    </div>
                </div>

            </div>

        </div>
            
        <div id="menu">
            <div class="slide-container">
                <span id="slider-image-1"></span>
                <span id="slider-image-2"></span>
                <span id="slider-image-3"></span>
                <span id="slider-image-4"></span>
                <span id="slider-image-5"></span>

                <div class="image-container">
                    <div class="slider-image">
                        <h3 class="title">MENU</h3>
                        Budget Meals

                        <div class="menu-container">
                            <div class="item-box">
                                <img src="images/menu/budget1.jpg" alt="budgetmeal1" />
                                <h5>Classic Beef Tapa</h5>
                                <span>₱ 50.00</span>
                            </div>
                            <div class="item-box">
                                <img src="images/menu/budget2.jpg" alt="budgetmeal2" />
                                <h5>Lumpiang Shanghai</h5>
                                <span>₱ 30.00</span>
                            </div>
                            <div class="item-box">
                                <img src="images/menu/budget3.jpg" alt="budgetmeal3" />
                                <h5>Barbecue</h5>
                                <span>₱ 30.00</span>
                            </div>
                            <div class="item-box">
                                <img src="images/menu/budget4.jpg" alt="budgetmeal4" />
                                <h5>Pansit</h5>
                                <span>₱ 45.00</span>
                            </div>
                            <div class="hidden"></div>
                            <div class="hidden"></div>
                            <div class="hidden"></div>
                            <button type='button' class="view-more btn btn-warning">View more...</button>
                        </div>

                    </div>
                    <div class="slider-image">
                        <h3 class="title">MENU</h3>
                        Main Dishes
                        
                        <div class="menu-container">
                            <div class="item-box">
                                <img src="images/menu/main1.jpg" alt="budgetmeal1" />
                                <h5>Adobong Manok</h5>
                                <span>₱ 100.00</span>
                            </div>
                            <div class="item-box">
                                <img src="images/menu/main2.jpg" alt="budgetmeal2" />
                                <h5>Bangus Sisig</h5>
                                <span>₱ 120.00</span>
                            </div>
                            <div class="item-box">
                                <img src="images/menu/main3.jpg" alt="budgetmeal3" />
                                <h5>Sinigang</h5>
                                <span>₱ 95.00</span>
                            </div>
                            <div class="item-box">
                                <img src="images/menu/main4.jpg" alt="budgetmeal4" />
                                <h5>Kinilaw</h5>
                                <span>₱ 85.00</span>
                            </div>

                            <div class="hidden"></div>
                            <div class="hidden"></div>
                            <div class="hidden"></div>
                            <button type='button' class="view-more btn btn-warning">View more...</button>
                        </div>

                    </div>
                    <div class="slider-image">
                        <h3 class="title">MENU</h3>
                        Vegetarian Diet
                        
                        <div class="menu-container">
                            <div class="item-box">
                                <img src="images/menu/veggie1.jpg" alt="budgetmeal1" />
                                <h5>Chopsuey</h5>
                                <span>₱ 35.00</span>
                            </div>
                            <div class="item-box">
                                <img src="images/menu/veggie2.jpg" alt="budgetmeal2" />
                                <h5>Pinakbet</h5>
                                <span>₱ 45.00</span>
                            </div>
                            <div class="item-box">
                                <img src="images/menu/veggie3.jpg" alt="budgetmeal3" />
                                <h5>Vegan Pancit Bihon</h5>
                                <span>₱ 35.00</span>
                            </div>
                            <div class="item-box">
                                <img src="images/menu/veggie4.jpg" alt="budgetmeal4" />
                                <h5>Tortang Talong</h5>
                                <span>₱ 50.00</span>
                            </div>
                            
                            <div class="hidden"></div>
                            <div class="hidden"></div>
                            <div class="hidden"></div>
                            <button type='button' class="view-more btn btn-warning">View more...</button>
                        </div>

                    </div>

                    <div class="slider-image">
                        <h3 class="title">MENU</h3>
                        Desserts
                        
                        <div class="menu-container">
                            <div class="item-box">
                                <img src="images/menu/dessert1.jpg" alt="meal1" />
                                <h5>Classic Halohalo</h5>
                                <span>₱ 75.00</span>
                            </div>
                            <div class="item-box">
                                <img src="images/menu/dessert2.jpg" alt="meal2" />
                                <h5>Buko Pie</h5>
                                <span>₱ 60.00</span>
                            </div>
                            <div class="item-box">
                                <img src="images/menu/dessert3.jpg" alt="meal3" />
                                <h5>Maja Blanca</h5>
                                <span>₱ 10.00</span>
                            </div>
                            <div class="item-box">
                                <img src="images/menu/dessert4.jpg" alt="meal4" />
                                <h5>Classic Bibingka</h5>
                                <span>₱ 25.00</span>
                            </div>
                            
                            <div class="hidden"></div>
                            <div class="hidden"></div>
                            <div class="hidden"></div>
                            <button type='button' class="view-more btn btn-warning">View more...</button>
                        </div>
                    </div>

                    <div class="slider-image">
                        <h3 class="title">MENU</h3>
                        Drinks
                        
                        <div class="menu-container">
                            <div class="item-box">
                                <img src="images/menu/drink1.jpg" alt="meal1" />
                                <h5>Buko Juice</h5>
                                <span>₱ 15.00</span>
                            </div>
                            <div class="item-box">
                                <img src="images/menu/drink2.jpg" alt="meal2" />
                                <h5>Lemon Juice</h5>
                                <span>₱ 15.00</span>
                            </div>
                            <div class="item-box">
                                <img src="images/menu/drink3.jpg" alt="meal3" />
                                <h5>Strawberry Juice</h5>
                                <span>₱ 25.00</span>
                            </div>
                            <div class="item-box">
                                <img src="images/menu/drink4.jpg" alt="meal4" />
                                <h5>Mango Juice</h5>
                                <span>₱ 20.00</span>
                            </div>
                            
                            <div class="hidden"></div>
                            <div class="hidden"></div>
                            <div class="hidden"></div>
                            <button type='button' class="view-more btn btn-warning">View more...</button>
                        </div>
                    </div>
                </div>

                <div class="button-container">
                    <a href="#slider-image-1" class="slider-button active"></a>
                    <a href="#slider-image-2" class="slider-button"></a>
                    <a href="#slider-image-3" class="slider-button"></a>
                    <a href="#slider-image-4" class="slider-button"></a>
                    <a href="#slider-image-5" class="slider-button"></a>
                </div>
            </div>
        </div>

        <div id="contact">
            <div id='contact-area'>
                <h3 class="title">CONTACT US</h3>
                <div class="content-box">
                    <div class="con-title">
                        <h1 id='con-name' class="restau-name">BAYBAYIN<p style='font-size: 15px; color: #fff;'>RESTAURANT</p></h1>
                        <p id='con-tag' class='tagline'>Experience pleasure from delicious foods & beautiful setting fit for families and friends</p>
                    </div>
                    <div class="con-details">
                        <ul class='list-group'>
                            <li><i class="fa fa-facebook icon-border facebook"></i> facebook.com/baybayinrestaurant</li>
                            <li><i class="fa fa-twitter icon-border twitter"></i> @baybayinrestau</li>
                            <li><i class="fa fa-google-plus icon-border googleplus"></i> baybayinrestau@gmail.com</li>
                            <li><i class='fa fa-envelope' style='color: #fff; background: #0f2453;'></i> baybayinrestau90@gmail.com</li>
                            <li><i class='fa fa-phone' style='color: #fff; background: #0f2453;'></i> +63 909 559 0663</li>
                            <li><i class='fa fa-phone' style='color: #fff; background: #0f2453;'></i> +63 909 559 0663</li>
                        </ul>
                        
                        
                        
                    </div>
                </div>
            </div>
        </div>

        <a href="#top" id='back-to-top'>TOP</a>
    </div>
    <script>
        $(document).ready(function() {
            $(document).on('click', '.slider-button', function() {
                $('.slider-button').removeClass("active");
                $(this).addClass("active");
            });
            $("#menu-link").click(function() {
                $('.slider-button').removeClass("active");
                $('.slider-button:nth-child(1)').addClass("active");
            });
            $("#back-to-top").click(function() {
                $('.slider-button').removeClass("active");
                $('.slider-button:nth-child(1)').addClass("active");
            });
            $(".view-more").click(function() {
                alert("This button is just for prototyping purposes.");
            });
        });
    </script>
</body>
</html>