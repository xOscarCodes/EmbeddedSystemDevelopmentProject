<!DOCTYPE html>
<!-- new -->
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project - SEES</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css" />

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/style2.css">

</head>

<body>

    <!-- header section starts      -->

    <header>

        <a href="#" class="logo"><i class="fas fa-eye"></i>SEES</a>

        <nav class="navbar">
            <a class="active" href="#home">home</a>
            <a href="#dishes">dishes</a>
            <a href="#about">about</a>
            <a href="#menu">menu</a>
            <!-- <a href="#cart">Cart</a> -->

            <!-- <a href="#order">Cart</a> -->
            <a href="#more_about_us">more_about_us</a>
            
        </nav>
        <!-- <h1> <a href="#menu"  class = "notfication">place order</a> </h1> -->

        <div class="icons">
            
            <i class="fas fa-bars" id="menu-bars"></i>
            <i class="fa fa-camera" id="search-icon"></i>
            <a href="#" class="fas fa-heart" onclick="location.reload();"></a>
            <a href="#" id="cart" class="fas fa-shopping-cart"></a>

        </div>

    </header>

    <!-- header section ends-->

    <!-- search form  -->

    <form action="" id="search-form">
        <span>Would you like us to capture your Facials?</span>
        <i class="fas fa-times" id="close"></i>
        <div>
            <input type="button" value="YES" class="btn" id="YES" onclick="approve()">
            <input type="button" value="NO" class="btn" id="NO" onclick = "no()">
        </div>
    </form>

    <!-- home section starts  -->

    <section class="home" id="home">

        <div class="swiper mySwiper home-slider">

            <div class="swiper-wrapper wrapper">

                <div class="swiper-slide slide">
                    <div class="content">
                        <span>our special dish</span>
                        <h3>Chole Bhature</h3>
                        <p>Chole stands for a spiced tangy chickpea curry and Bhatura is a soft and fluffy fried
                            leavened bread.</p>
                        <!-- <a href="#" class="btn add-to-cart">Add to Cart</a> -->
                    </div>
                    <div class="image_cholle">
                        <img src="new_images/chole_bhature.png" alt="">
                    </div>
                </div>

                <div class="swiper-slide slide">
                    <div class="content">
                        <span>our special dish</span>
                        <h3>Pav Bhaji</h3>
                        <p>Pav Bhaji is a flavorsome and hearty meal that has a delicious blend of spicy mixed
                            vegetables, served alongside soft butter toasted dinner rolls, crunchy onions and lemon
                            wedges.</p>
                        <!-- <a href="#" class="btn add-to-cart">Add to Cart</a> -->
                    </div>
                    <div class="image">
                        <img src="new_images/pav_bhaji.png" alt="">
                    </div>
                </div>

                <div class="swiper-slide slide">
                    <div class="content">
                        <span>our special dish</span>
                        <h3>Paneer Tikka Masala </h3>
                        <p>This spicy snack is a dry dish, however it is not dry anymore and will provide its exotic
                            taste in the gravy itself</p>
                        <!-- <a href="#" class="btn add-to-cart">Add to Cart</a> -->
                    </div>
                    <div class="image">
                        <img src="new_images/paneer_tikka_masala.png" alt="">
                    </div>
                </div>

                <div class="swiper-slide slide">
                    <div class="content">
                        <span>our special dish</span>
                        <h3>Garlic Naaaaaan </h3>
                        <p>Soft and delicious this is the only Garlic Naan that you will ever need!</p>
                        <!-- <a href="#" class="btn add-to-cart">Add to Cart</a> -->
                    </div>
                    <div class="image">
                        <img src="new_images/Garlic_naan.png" alt="">
                    </div>
                </div>

            </div>

            <div class="swiper-pagination"></div>

        </div>

    </section>

    <!-- home section ends -->

    <!-- dishes section starts  -->

    <section class="dishes" id="dishes">

        <h3 class="sub-heading"> Recommendations </h3>
        <h1 class="heading">Best of the Best</h1>


        <div class="box-container">
           <div class = "rec-data">
               
            </div>

        </div>

    </section>

    <!-- dishes section ends -->

    <!-- about section starts  -->

    <section class="about" id="about">

        <h3 class="sub-heading"> About us</h3>
        <h1 class="heading"> Know something about us... </h1>

        <div class="row">

            <div class="image">
                <img src="new_images/SEES.png" alt="">
            </div>

            <div class="content">
                <h3>Project SEES</h3>
                <h4>
                    <p>Even though there are many waiters at many restaurants and cafes these days, many patrons still
                        have to wait for them to get to their seats. Additionally, the majority of order-taking methods
                        are manual, which not only results in inefficiency but also unintentional errors.
                        On the other hand, orders placed using internet systems are both incredibly user-friendly and
                        effective.
                        Second, every year, more than 8000 restaurants in the USA suffer fire damage from gas leaks or
                        electrical shorts, and many people lose their lives as a result of the lack of working
                        evacuation systems.
                        One of the most prevalent and significant issues facing restaurants today is these two issues.
                    </p>
                </h4>
                <h3>Solution</h3>
                <h4>
                    <p>
                        One project includes both the management of the emergency system and food ordering.
                        The customer can use the payment wall to place meal orders and make payments. Previous clients
                        will see their prior orders and be given suggestions based on their preferences. Orders can be
                        accepted by the staff or chef, who will then specify when the dish will be ready to be served.
                        Any type of perturbations in the gas level will be detected by the sensors operating in the
                        backend. Any aberrant readings will change the behaviour of every client and employee and
                        activate the evacuation mechanisms.
                        All of the doors will automatically open as part of the evacuation systems, which also provide
                        additional departing information.</p>
                </h4>
                <div class="icons-container">
                    <div class="icons">
                        <i class="fas fa-shipping-fast"></i>
                        <span>Dine In Only</span>
                    </div>
                    <div class="icons">
                        <i class="fas fa-dollar-sign"></i>
                        <span>Online Payments only</span>
                    </div>
                    <div class="icons">
                        <i class="fas fa-headset"></i>
                        <span>SIT 210</span>
                    </div>
                </div>
                <a href="#more_about_us" class="btn">More About us</a>
            </div>

        </div>

    </section>

    <!-- about section ends -->

    <!-- menu section starts  -->

    <section class="menu" id="menu">

        <h3 class="sub-heading"> Food You won't forget </h3>
        <h1 class="heading"> Menu </h1>

        <div class="box-container">

            <div class="box">
                <img class="product-image" src="new_images/butter_chicken.png" alt="">
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                </div>
                <h3 class="product-name">Butter Chicken</h3>
                <p>It's slightly spicy and tastes earthy. The chicken has a chargrilled flavor that pairs perfectly with
                    the creamy sauce.</p>
                <span class="product-price price">₹450</span>
                <button class="btn add-to-cart">Add to cart</button>
            </div>

            <div class="box">
                <img class="product-image" src="new_images/Malai_tikka.png" alt="">
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                </div>
                <h3 class="product-name">Malai Chicken Tikka</h3>
                <p>This delicious chicken malai tikka recipe made with chicken chunks marinated in a creamy sauce is
                    perfect for iftar.</p>
                <span class="product-price price">₹260</span>
                <button class="btn add-to-cart">Add to cart</button>
            </div>

            <div class="box">
                <img class="product-image" src="new_images/Mutton_Curry.png" alt="">
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                </div>
                <h3 class="product-name">Mutton Curry</h3>
                <p>Mutton curry also known as Mutton masala or Mutton gravy is a delicious Indian curried dish of soft
                    tender chunks of meat in spicy onion tomato gravy.</p>
                <span class="product-price price">₹400</span>
                <button class="btn add-to-cart">Add to cart</button>
            </div>

            <div class="box">
                <img class="product-image" src="new_images/chole_bhature.png" alt="">
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                </div>
                <h3 class="product-name">Cholle Bhature</h3>
                <p>Chole stands for a spiced tangy chickpea curry and Bhatura is a soft and fluffy fried leavened bread.
                </p>
                <span class="product-price price">₹130</span>
                <button class="btn add-to-cart">Add to cart</button>
            </div>

            <div class="box">
                <img class="product-image" src="new_images/Mix_Vege.png" alt="">
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                </div>
                <h3 class="product-name">Mix Vegetable</h3>
                <p>This marvellous Punjabi mixed vegetable sabzi, which features a horde of colourful and juicy veggies.
                </p>
                <span class="product-price price">₹180</span>
                <button class="btn add-to-cart">Add to cart</button>
            </div>

            <div class="box">
                <img class="product-image" src="new_images/paneer_tikka_masala.png" alt="">
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                </div>
                <h3 class="product-name">Paneer Tikka Masala</h3>
                <p>Paneer tikka masala is a North Indian dish of grilled paneer (Indian cheese) served in a spicy gravy
                    known as Tikka masala. </p>
                <span class="product-price price">₹300</span>
                <button class="btn add-to-cart">Add to cart</button>
            </div>

            <div class="box">

                <img class="product-image" src="new_images/soya_chaap.png" alt="">
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                </div>
                <h3 class="product-name">Soya Chaap Masala</h3>
                <p>a unique and protein-rich indian curry recipe made with soya chaap and a unique spice rich gravy
                    sauce.</p>
                <span class="product-price price">₹300</span>
                <button class="btn add-to-cart">Add to cart</button>
            </div>

            <div class="box">

                <img class="product-image" src="new_images/pav_bhaji.png" alt="">
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                </div>
                <h3 class="product-name">Pav Bhaji</h3>
                <p>Pav Bhaji is a flavorsome and hearty meal that has a delicious blend of spicy mixed vegetables,
                    served alongside soft butter toasted dinner rolls, crunchy onions and lemon wedges.</p>
                <span class="product-price price">₹180</span>
                <button class="btn add-to-cart">Add to cart</button>
            </div>

            <div class="box">

                <img class="product-image" src="new_images/butter_naan.png" alt="">
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                </div>
                <h3 class="product-name">Butter Naaaaaan</h3>
                <p>Butter naan is soft and extremely yummy, it is often served at buffets in festivals or special
                    occasions.</p>
                <span class="product-price price">₹30</span>
                <button class="btn add-to-cart">Add to cart</button>
            </div>

            <div class="box">

                <img class="product-image" src="new_images/lachcha parantha.png" alt="">
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                </div>
                <h3 class="product-name">lachcha Prantha</h3>
                <p>Lachha Paratha are crispy flaky layered whole wheat flatbreads made with a simple unleavened dough.
                </p>
                <span class="product-price price">₹20</span>
                <button class="btn add-to-cart">Add to cart</button>
            </div>

            <div class="box">

                <img class="product-image" src="new_images/tandoori_roti.png" alt="">
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                </div>
                <h3 class="product-name">Tandoori Roti </h3>
                <p>a traditional and tasty north indian flatbread recipe made with wheat flour using tawa on a top gas
                    stove.</p>
                <span class="product-price price">₹10</span>
                <button class="btn add-to-cart">Add to cart</button>
            </div>

            <div class="box">

                <img class="product-image" src="new_images/Garlic_naan.png" alt="">
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                </div>
                <h3 class="product-name">Garlic Naaaaaan</h3>
                <p>Soft and delicious this is the only Garlic Naan that you will ever need!</p>
                <span class="product-price price">₹60</span>
                <button class="btn add-to-cart">Add to cart</button>
            </div>

        </div>

    </section>

    <!-- menu section ends -->


    <!-- order cart starts  -->

    <section class="cart" id="cart">
        <div class="cart-modal-overlay">
            <div class="cart-modal">
                <i id="close-btn" class="fas fa-times"></i>
                <!-- <h1 class="cart-is-empty">Cart is empty</h1> -->

                <div class="product-rows">
                </div>
                <div class="total">
                    <h1 class="cart-total">Cart is empty</h1>
                    <!-- <span class="total-product_price price">0</span> -->
                    <button class="purchase-btn">PURCHASE</button>
                </div>
            </div>
        </div>
    </section>
    <!-- llllllll -->


    <section class="more_about_us" id="more_about_us">
        <div class="container">
            <div class="card">
                <div class="content">
                    <div class="image">
                        <img src="new_images/charan.jpg" alt="">
                    </div>
                    <div class="image_content">
                        <h3>Charanpreet Singh<br><span>Team Leader</span>
                        </h3>
                    </div>
                </div>
            </div>
            <ul class="sci">
                <li style="--i:1"><a href="#"><i class="fa fa-github" style="font-size:24px"></i></a></li>
                <li style="--i:2"><a href="#"><i class="fa fa-phone" style="font-size:24px"></i></a></li>
                <li style="--i:3"><a href="#"><i class="fa fa-envelope" style="font-size:24px"></i></a></li>
            </ul>
        </div>

        <div class="container">
            <div class="card">
                <div class="content">
                    <div class="image">
                        <img src="new_images/yohjit.jpg" alt="">
                    </div>
                    <div class="image_content">
                        <h3>Yohjit Chopra<br><span>Team Member</span>
                        </h3>
                    </div>
                </div>
            </div>
            <ul class="sci">
                <li style="--i:1"><a href="#"><i class="fa fa-github" style="font-size:24px"></i></a></li>
                <li style="--i:2"><a href="#"><i class="fa fa-phone" style="font-size:24px"></i></a></li>
                <li style="--i:3"><a href="#"><i class="fa fa-envelope" style="font-size:24px"></i></a></li>
            </ul>
        </div>

        <div class="container">
            <div class="card">
                <div class="content">
                    <div class="image">
                        <img src="new_images/ishaan.jpeg" alt="">
                    </div>
                    <div class="image_content">
                        <h3>Ishaan Gupta<br><span>Team Member</span>
                        </h3>
                    </div>
                </div>
            </div>
            <ul class="sci">
                <li style="--i:1"><a href="#"><i class="fa fa-github" style="font-size:24px"></i></a></li>
                <li style="--i:2"><a href="#"><i class="fa fa-phone" style="font-size:24px"></i></a></li>
                <li style="--i:3"><a href="#"><i class="fa fa-envelope" style="font-size:24px"></i></a></li>
            </ul>
        </div>

        <div class="container">
            <div class="card">
                <div class="content">
                    <div class="image">
                        <img src="new_images/harsh.jpeg" alt="">
                    </div>
                    <div class="image_content">
                        <h3>Harshdeep Singh<br><span>Team Member</span>
                        </h3>
                    </div>
                </div>
            </div>
            <ul class="sci">
                <li style="--i:1"><a href="#"><i class="fa fa-github" style="font-size:24px"></i></a></li>
                <li style="--i:2"><a href="#"><i class="fa fa-phone" style="font-size:24px"></i></a></li>
                <li style="--i:3"><a href="#"><i class="fa fa-envelope" style="font-size:24px"></i></a></li>
            </ul>
        </div>
    </section>

    <!-- order section ends -->

    <!-- footer section starts  -->

    <!-- footer section ends -->

    <!-- loader part  -->
    <div class="loader-container">
    <img src="images/loader.gif" alt="">
</div>


    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.1.min.js"
        integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>

    <!-- custom js file link  -->
    <script src="jscript.js"></script>

</html>



<!-- 


Basis for revised IDLH: Because L.P.G. may cause asphyxia [Proctor et al. 1988] at concentrations well above the lower explosive limit (LEL), 
the revised IDLH for L.P.G. is 2,000 ppm based strictly on safety considerations (i.e., being about 10% of the LELs of 1.9% for butane and 2.1% for propane).
Current administrative OELs for LPG and butane are 1,000 and 600 ppm, respectively (propane not established).

As CO levels increase and remain above 70 ppm, symptoms become more noticeable and can include headache, fatigue and nausea. 
At sustained CO concentrations above 150 to 200 ppm, disorientation, unconsciousness, and death are possible.

Levels of carbon monoxide exposure range from low to dangerous: Low level: 50 PPM and less. Mid level: Between 51 PPM and 100 PPM. 
High level: Greater than 101 PPM if no one is experiencing symptoms\



Low level: 50 PPM and less. Mid level: Between 51 PPM and 100 PPM. High level: Greater than 101 PPM if no one 
is experiencing symptoms. Dangerous level: Greater than 101 PPM if someone is experiencing symptoms -->