<?php
    session_start();
    if(!isset($_SESSION['user-email'])) {
        header("Location: index.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Baybayin Restaurant | Home</title>

    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/font-awesome.css" />
    <link rel="stylesheet" href="css/main.css" />
    <link rel="stylesheet" href="css/mobile.css" />
    <link rel="stylesheet" href="css/modals.css" />
    <script src='js/jquery-3.4.1.js'></script>
    <script>
        $(document).ready(function() {
            $("#upcoming").load("php/upcoming.php", function(responseTxt, statusTxt, xhr) {
                $("#upcoming").html(responseTxt);
            });

            $("#last").load("php/last.php", function(responseTxt, statusTxt, xhr) {
                $("#last").html(responseTxt);
            });

            $(document).on('click', '.btn-cancel', function() {
                var id = parseInt($(this).attr("id").split('-')[1]);
                var sure = confirm("Cancellation cannot be undone. Are you sure to cancel this reservation?");

                if(sure == true) {
                    $.post("php/cancel.php",
                    {
                        id: id
                    },
                    function(data, status) {
                        alert(data);
                        
                        $("#upcoming").load("php/upcoming.php", function(responseTxt, statusTxt, xhr) {
                            $("#upcoming").html(responseTxt);
                        });
                    });
                }
            });
            
            $(document).on('click', '.btn-delete', function() {
                var id = parseInt($(this).attr("id").split('-')[1]);
                var sure = confirm("Are you sure you want to delete this record?");

                if(sure == true) {
                    $.post("php/delete.php",
                    {
                        id: id
                    },
                    function(data, status) {
                        $("#last").load("php/last.php", function(responseTxt, statusTxt, xhr) {
                            $("#last").html(responseTxt);
                        });
                    });
                }
            });

            $("#reserve").click(function() {
                $("#modal-reserve").addClass("showmodal");
                $(".cover").addClass("showcover");
            });
            $(".fa-close").click(function() {
                $("#modal-reserve").removeClass("showmodal");
                $("#modal-edit").removeClass("showmodal");
                $(".cover").removeClass("showcover");
            });
            $("#acc-edit").click(function() {
                $("#modal-edit").addClass("showmodal");
                $(".cover").addClass("showcover");
            });

            $("#submit-acc-edit").click(function() {
                var oldPass = $("#passwordO").val();
                var newPass = $("#passwordN").val();
                var retype = $("#passwordR").val();
                var mobile = $("#mobileE").val();

                $.post("php/acc-edit.php",
                {
                    oldPass: oldPass,
                    newPass: newPass,
                    retype: retype,
                    mobile: mobile
                },
                function(data, status) {
                    $("#passwordO").val("");
                    $("#passwordN").val("");
                    $("#passwordR").val("");
                    $("#mobileE").val("");

                    alert(data);
                });

            });
            
            $("#submit-reserve").click(function() {
                var date = $("#date").val();
                var time = $("#time").val();
                var type = $("#tabletype").val();

                $.post("php/reserve.php",
                {
                    date: date,
                    time: time,
                    type: type
                },
                function(data, status) {
                    $("#date").val("");
                    $("#time").val("");
                    $("#tabletype").val("");

                    alert(data);
                });

            });
        });
    </script>
</head>
<body>

    <div class="cover">

    </div>

    <?php
        require_once 'php/dbh.inc.php';

        $email = $_SESSION['user-email'];
        $sql = "SELECT * FROM customers WHERE email='$email'";
        $result = mysqli_query($con, $sql) or die("Database error: ".mysqli_error($con));
        $row = mysqli_fetch_assoc($result);
    ?>

    <div id="modal-edit" class='modals'>
        <div class="conx"><i class='fa fa-close'></i></div>
        <div class="modal-title">Account Settings</div>
        <form>
            <label for="email" style='margin: 10px 0; overflow: hidden; text-align:center;'>Email:<br><b><?php echo $row['email']; ?></b></label>
            <input id='passwordO' type="password" placeholder='Old password'/>
            <input id='passwordN' type="password" placeholder='New password'/>
            <input id='passwordR' type="password" placeholder='Retype new password'/>
            <input id='mobileE' type="number" placeholder='Mobile number (11 digits)' value='<?php echo $row['mobile']; ?>'/>
            <button type='button' class='btn btn-primary' id='submit-acc-edit'>Update</button>
        </form>
    </div>

    <div id="modal-reserve" class='modals'>
        <div class="conx"><i class='fa fa-close'></i></div>
        <div class="modal-title">Reserve a Table</div>
        <form>
            <label for="date">Date</label>
            <input type="date" id='date'/>
            <select id="time">
                <option value="">Time</option>
                <option value="8">8AM - 9AM</option>
                <option value="9">9AM - 10AM</option>
                <option value="10">10AM - 11AM</option>
                <option value="11">11AM - 12PM</option>
                <option value="12">12PM - 1PM</option>
                <option value="13">1PM - 2PM</option>
                <option value="14">2PM - 3PM</option>
                <option value="15">3PM - 4PM</option>
                <option value="16">4PM - 5PM</option>
                <option value="17">5PM - 6PM</option>
                <option value="18">6PM - 7PM</option>
                <option value="19">7PM - 8PM</option>
                <option value="20">8PM - 9PM</option>
                <option value="21">9PM - 10PM</option>
            </select>
            <select id="tabletype">
                <option value="">Table type</option>
                <option value="1">Table for 1</option>
                <option value="2">Table for 2</option>
                <option value="4">Table for 4</option>
                <option value="6">Table for 6</option>
                <option value="10">Table for 10</option>
                <option value="12">Table for 12</option>
            </select>
            <button type='button' class='btn btn-primary' id='submit-reserve'>Reserve</button>
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
                <div><i class='fa fa-phone'></i> +63 905 988 5157</div>
            </div>
        </div>
        <div class="header-menu">
            <div class="banner"><a href="index.php">BAYBAYIN<small>FILIPINO RESTAURANT</small></a></div>
            <nav>
                <ul class='nav justify-content-end'>
                    <li><a href="#reservations">RESERVATIONS</a></li>
                    <li><a href="#about">ABOUT</a></li>
                    <li><a href="#services">SERVICES</a></li>
                    <li><a id='menu-link' href="#slider-image-1">MENU</a></li>
                    <li><a href="#contact">CONTACT US</a></li>
                    <li><a href="php/logout.php">LOGOUT</a></li>
                </ul>
            </nav>
        </div>
    </header>

        <div class='main'>
            <p class='welcome'>Welcome, <span id='name'><?php echo $row['firstname']." ".$row['lastname']; ?></span>! &nbsp<span id='acc-edit'>Edit settings</a></span>
            <h1 class="restau-name">BAYBAYIN<p>RESTAURANT</p></h1>
            <p class='tagline'>Experience pleasure from delicious foods & beautiful setting fit for families and friends</p>
            <br>
            <div class="main-btns">
                <button id='reserve' class='btn-main'><i class='fa fa-table'></i> &nbspRESERVE A TABLE</button>
            </div>
        </div>

        <div id="reservations">
            <h3 class="title">YOUR RESERVATIONS</h3>
            <div id="res-content">
                <p><b>Upcoming reservations</b></p>
                <hr>
                <table id='upcoming'>

                </table>
                <p><b>Last reservations</b></p>
                <hr>
                <table id='last'>

                </table>
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
                                <img src="images/menu/budget1.jpg" alt="meal1" />
                                <h5>Classic Beef Tapa</h5>
                                <span>₱ 50.00</span>
                            </div>
                            <div class="item-box">
                                <img src="images/menu/budget2.jpg" alt="meal2" />
                                <h5>Lumpiang Shanghai</h5>
                                <span>₱ 30.00</span>
                            </div>
                            <div class="item-box hide">
                                <img src="images/menu/budget3.jpg" alt="meal3" />
                                <h5>Barbecue</h5>
                                <span>₱ 30.00</span>
                            </div>
                            <div class="item-box hide">
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
                                <img src="images/menu/main1.jpg" alt="meal1" />
                                <h5>Adobong Manok</h5>
                                <span>₱ 100.00</span>
                            </div>
                            <div class="item-box">
                                <img src="images/menu/main2.jpg" alt="meal2" />
                                <h5>Bangus Sisig</h5>
                                <span>₱ 120.00</span>
                            </div>
                            <div class="item-box hide">
                                <img src="images/menu/main3.jpg" alt="meal3" />
                                <h5>Sinigang</h5>
                                <span>₱ 95.00</span>
                            </div>
                            <div class="item-box hide">
                                <img src="images/menu/main4.jpg" alt="meal4" />
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
                                <img src="images/menu/veggie1.jpg" alt="meal1" />
                                <h5>Chopsuey</h5>
                                <span>₱ 35.00</span>
                            </div>
                            <div class="item-box">
                                <img src="images/menu/veggie2.jpg" alt="meal2" />
                                <h5>Pinakbet</h5>
                                <span>₱ 45.00</span>
                            </div>
                            <div class="item-box hide">
                                <img src="images/menu/veggie3.jpg" alt="meal3" />
                                <h5>Vegan Pancit Bihon</h5>
                                <span>₱ 35.00</span>
                            </div>
                            <div class="item-box hide">
                                <img src="images/menu/veggie4.jpg" alt="meal4" />
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
                            <div class="item-box hide">
                                <img src="images/menu/dessert3.jpg" alt="meal3" />
                                <h5>Maja Blanca</h5>
                                <span>₱ 10.00</span>
                            </div>
                            <div class="item-box hide">
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
                            <div class="item-box hide">
                                <img src="images/menu/drink3.jpg" alt="meal3" />
                                <h5>Strawberry Juice</h5>
                                <span>₱ 25.00</span>
                            </div>
                            <div class="item-box hide">
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
                            <li><i class="fa fa-facebook icon-border facebook"></i> facebook.com/baybayinrestau</li>
                            <li><i class="fa fa-twitter icon-border twitter"></i> @baybayinrestau</li>
                            <li><i class="fa fa-google-plus icon-border googleplus"></i> baybayinrestau@gmail.com</li>
                            <li><i class='fa fa-envelope' style='color: #fff; background: #0f2453;'></i> baybayinrestau90@gmail.com</li>
                            <li><i class='fa fa-phone' style='color: #fff; background: #0f2453;'></i> +63 909 559 0663</li>
                            <li><i class='fa fa-phone' style='color: #fff; background: #0f2453;'></i> +63 905 988 5157</li>
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