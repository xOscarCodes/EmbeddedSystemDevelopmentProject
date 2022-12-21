
let menu = document.querySelector('#menu-bars');
var p = 0;
let navbar = document.querySelector('.navbar');
setTimeout('val12()', 2000);
const cart = document.querySelector('#cart');
const cartModalOverlay = document.querySelector('.cart-modal-overlay');
var Total = 0;

menu.onclick = () => {
    menu.classList.toggle('fa-times');
    navbar.classList.toggle('active');
}

let section = document.querySelectorAll('section');
let navLinks = document.querySelectorAll('header .navbar a');

window.onscroll = () => {

    menu.classList.remove('fa-times');
    navbar.classList.remove('active');

    section.forEach(sec => {

        let top = window.scrollY;
        let height = sec.offsetHeight;
        let offset = sec.offsetTop - 150;
        let id = sec.getAttribute('id');

        if (top >= offset && top < offset + height) {
            navLinks.forEach(links => {
                links.classList.remove('active');
                document.querySelector('header .navbar a[href*=' + id + ']').classList.add('active');
            });
        };

    });

}


document.querySelector('#search-icon').onclick = () => {
    document.querySelector('#search-form').classList.toggle('active');
}

document.querySelector('#close').onclick = () => {
    document.querySelector('#search-form').classList.remove('active');
}

var swiper = new Swiper(".home-slider", {
    spaceBetween: 30,
    centeredSlides: true,
    autoplay: {
        delay: 7500,
        disableOnInteraction: false,
    },
    pagination: {
        el: ".swiper-pagination",
        clickable: true,
    },
    loop: true,
});

var swiper = new Swiper(".review-slider", {
    spaceBetween: 20,
    centeredSlides: true,
    autoplay: {
        delay: 7500,
        disableOnInteraction: false,
    },
    loop: true,
    breakpoints: {
        0: {
            slidesPerView: 1,
        },
        640: {
            slidesPerView: 2,
        },
        768: {
            slidesPerView: 2,
        },
        1024: {
            slidesPerView: 3,
        },
    },
});



function loader() {
    document.querySelector('.loader-container').classList.add('fade-out');
}

function fadeOut() {
    setInterval(loader, 3000);
}

window.onload = fadeOut;

cart.addEventListener('click', () => {
    if (cartModalOverlay.style.transform === 'translateX(-200%)') {
        cartModalOverlay.style.transform = 'translateX(0)';
    } else {
        cartModalOverlay.style.transform = 'translateX(-200%)';
    }
})
// end of open cart modal

// close cart modal
const closeBtn = document.querySelector('#close-btn');

closeBtn.addEventListener('click', () => {
    cartModalOverlay.style.transform = 'translateX(-200%)';
});

cartModalOverlay.addEventListener('click', (e) => {
    if (e.target.classList.contains('cart-modal-overlay')) {
        cartModalOverlay.style.transform = 'translateX(-200%)'
    }
})
// end of close cart modal

// add products to cart
const addToCart = document.getElementsByClassName('add-to-cart');
const productRow = document.getElementsByClassName('product-row');

for (var i = 0; i < addToCart.length; i++) {
    button = addToCart[i];
    button.addEventListener('click', addToCartClicked)
}

function addToCartClicked(event) {
    button = event.target;
    var cartItem = button.parentElement;
    var price = cartItem.getElementsByClassName('product-price')[0].innerText;
    var pname = cartItem.getElementsByClassName('product-name')[0].innerHTML;
    var imageSrc = cartItem.getElementsByClassName('product-image')[0].src;
    addItemToCart(price, imageSrc, pname);
    updateCartPrice()
}

function addItemToCart(price, imageSrc, pname) {
    var productRow = document.createElement('div');
    productRow.classList.add('product-row');
    var productRows = document.getElementsByClassName('product-rows')[0];
    var cartImage = document.getElementsByClassName('cart-image');

    for (var i = 0; i < cartImage.length; i++) {
        if (cartImage[i].src == imageSrc) {
            alert('This item has already been added to the cart')
            return;
        }
    }

    var cartRowItems = `
        <div class="product-row">
        <img class="cart-image" src="${imageSrc}" alt="">
        <span class ="cart-price">${price}</span>
        <h6 hidden class = "cart-pname">${pname}</h6>
        <input class="product-quantity" type="number" value="1">
        <button class="remove-btn">Remove</button>
        </div>
      `
    productRow.innerHTML = cartRowItems;
    productRows.append(productRow);
    productRow.getElementsByClassName('remove-btn')[0].addEventListener('click', removeItem)
    productRow.getElementsByClassName('product-quantity')[0].addEventListener('change', changeQuantity)
    updateCartPrice()
}
// end of add products to cart

// Remove products from cart
const removeBtn = document.getElementsByClassName('remove-btn');
for (var i = 0; i < removeBtn.length; i++) {
    button = removeBtn[i]
    button.addEventListener('click', removeItem)
}

function removeItem(event) {
    btnClicked = event.target
    btnClicked.parentElement.parentElement.remove()
    updateCartPrice()
}

// update quantity input
var quantityInput = document.getElementsByClassName('product-quantity')[0];

for (var i = 0; i < quantityInput; i++) {
    input = quantityInput[i]
    input.addEventListener('change', changeQuantity)
}

function changeQuantity(event) {
    var input = event.target
    if (isNaN(input.value) || input.value <= 0) {
        input.value = 1
    }
    updateCartPrice()
}
// end of update quantity input

// update total price
function updateCartPrice() {
    var total = 0
    for (var i = 0; i < productRow.length; i += 2) {
        cartRow = productRow[i]
        var priceElement = cartRow.getElementsByClassName('cart-price')[0]
        var quantityElement = cartRow.getElementsByClassName('product-quantity')[0]
        var price = parseFloat(priceElement.innerText.replace('₹', ''))
        var quantity = quantityElement.value
        total = total + (price * quantity)
    }

    Total = total;
    document.getElementsByClassName('cart-total')[0].innerText = "TOTAL: ₹" + Total

    document.getElementsByClassName('cart-quantity')[0].textContent = i /= 2
}
// end of update total price

// purchase items
const purchaseBtn = document.querySelector('.purchase-btn');

const closeCartModal = document.querySelector('.cart-modal');

purchaseBtn.addEventListener('click', purchaseBtnClicked)


function purchaseBtnClicked() {

    if (Total == 0)
        alert('please add item in cart')

    else {
        Makepayment()
    }

}

function clearcart() {
    cartModalOverlay.style.transform = 'translateX(-100%)'
    var cartItems = document.getElementsByClassName('product-rows')[0]
    while (cartItems.hasChildNodes()) {
        cartItems.removeChild(cartItems.firstChild)
    }

    updateCartPrice()
  
}

function add_to_custid(name) {
    var request = new XMLHttpRequest();
    request.open("GET", "custid.php", true);
    request.send();
    request.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            var data = JSON.parse(this.responseText);
            data = data.Customer_ID
            jQuery.ajax({
                type: "POST",
                url: "recodata.php",
                data: "cust_id=" + data + "&food=" + name,
                success: function (result) { 
                   post()
                }
                    
            });
          






        };
    }
}

function post()
{
    jQuery.ajax({
                type: "POST",
                url: "update.php",
            });
}

function addID(ID) {

    for (var i = 0; i < productRow.length; i += 2) {
        cartRow = productRow[i]
        //var priceElement = cartRow.getElementsByClassName('cart-price')[0]
        var quantityElement = cartRow.getElementsByClassName('product-quantity')[0]
        var quantity = quantityElement.value
        var pname = cartRow.getElementsByClassName('cart-pname')[0]
        var name = pname.innerHTML
        jQuery.ajax({
            type: "POST",
            url: "addID.php",
            data: "order_id=" + ID + "&food=" + name + "&quantity="
                + quantity + "&Total=" + Total
        });

        add_to_custid(name);
    }
}


function Makepayment() {

    var name = "Sees project";
    var amount = Total;
    var options = {
        "key": "rzp_test_sqYZW8I7vHfK0E",
        "amount": amount * 100,
        "currency": "INR",
        "name": "Project SEES",
        "description": "Test Transaction",
        "image": "new_images/SEES.png",

        "prefill": {
            "name": name,
            "email": "sees.project@gmail.com",
            "contact": +919999999999,
        },
        config: {
            display: {
                blocks: {
                    hdfc: {
                        name: "Pay using QRcode or UPI",
                        instruments: [
                            {
                                method: "upi"
                            },
                            {
                                method: "netbanking",
                                banks: ["HDFC"]
                            },
                        ]
                    },
                    other: {
                        name: "Other Payment modes",
                        instruments: [
                            {
                                method: 'netbanking',
                            }
                        ]
                    }
                },
                hide: [
                    {
                        method: "card"
                    }
                ],
                sequence: ["block.hdfc", "block.other"],
                preferences: {
                    show_default_blocks: false
                }
            }
        },
        "handler": function (response) {
            jQuery.ajax({
                type: "POST",
                url: "payment.php",
                data: "pay_id=" + response.razorpay_payment_id + "&amount=" + amount + "&name="
                    + name,
                success: function (result) {
                    alert('Thank you for your purchase');
                    addID(response.razorpay_payment_id)
                    clearcart()
                
                }
            });
        },

        "modal": {
            "ondismiss": function () {
                if (confirm("Are you sure, you want to cancel the payment")) {
                    console.log("Checkout form closed by the user");
                }
                else {
                    txt = "You pressed Cancel!";
                    console.log("Complete the Payment")
                }
            },
        },

        "theme": {
            "color": "#3399cc"
        }

    };

    var rzp1 = new Razorpay(options);
    rzp1.open();

}



function addrecommendations() {
    var ajax = new XMLHttpRequest();
    ajax.open("GET", "fetchid.php", true);
    ajax.send();
    ajax.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            var data = JSON.parse(this.responseText);
            refresh(data)
        };
    }
  
}


function refresh(data1) {
    var refresh1
    var request = new XMLHttpRequest();
    request.open("GET", "refresh.php", true);
    request.send();
    request.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            var data = JSON.parse(this.responseText);
            refresh1 = data
            addtorec(data1, refresh1)
        };
    }


}
var val = 1;

function no() {
    document.querySelector('#search-form').classList.remove('active');
}

function approve() {
    jQuery.ajax({
        type: "POST",
        url: "raspdata.php",
        data: "approve=" + '1',
    });

    document.querySelector('#search-form').classList.remove('active');
}


function addtorec(data, refresh) {

    if (refresh.refreshen == 1) {
        location.reload();
    }

    var productRow = document.createElement('div');
    productRow.classList.add('rec-row');
    var recommend = document.getElementsByClassName('rec-data')[0];
    var cartRowItems;

    var length1 = data.length;
    var length = length1 - 4;

    if (length1 <= 5)
        length = 1;

    var j = 0;

    



    for (var i = length - 1; i < length1; i++) {

        var pname = data[i].Food_ID;
        var imgSrc = "new_images/new_customer.png"
        var pprice = 130

        if (pname == "Butter Chicken") {
            imgSrc = "new_images/butter_chicken.png"
            pprice = 450
        }

        if (pname == "Malai Chicken Tikka") {
            imgSrc = "new_images/Malai_tikka.png"
            pprice = 260
        }

        if (pname == "Mutton Curry") {
            imgSrc = "new_images/Mutton_Curry.png"
            pprice = 400
        }

        if (pname == "Cholle Bhature") {
            imgSrc = "new_images/chole_bhature.png"
            pprice = 130
        }

        if (pname == "Mix Vegetable") {
            imgSrc = "new_images/Mix_Vege.png"
            pprice = 180
        }

        if (pname == "Paneer Tikka Masala") {
            imgSrc = "new_images/paneer_tikka_masala.png"
            pprice = 300
        }

        if (pname == "Soya Chaap Masala") {
            imgSrc = "new_images/soya_chaap.png"
            pprice = 300
        }

        if (pname == "Pav Bhaji") {
            imgSrc = "new_images/pav_bhaji.png"
            pprice = 180
        }

        if (pname == "Butter Naaaaaan") {
            imgSrc = "new_images/butter_naan.png"
            pprice = 30
        }

        if (pname == "lachcha Prantha") {
            imgSrc = "new_images/lachcha parantha.png"
            pprice = 20
        }

        if (pname == "Tandoori Roti ") {
            imgSrc = "new_images/tandoori_roti.png"
            pprice = 10
        }

        if (pname == "Garlic Naaaaaan") {
            imgSrc = "new_images/Garlic_naan.png"
            pprice = 60
        }
        
       

        if (val == 1) {
            if (i == length - 1) {
                cartRowItems = `
            <div class="rec-row">
            <div class="box">
                <a href="#" class="fas fa-heart"></a>
                <a href="#" class="fas fa-eye"></a>
                <img class="rec-image" src=${imgSrc} alt="">
                <h3 class = "rec-name">${pname}</h3>
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                </div>
                <span class="rec-price price">₹${pprice}</span>
                <button class="btn" onclick =  "vals(${j})">Add to cart</button>
            </div>
            </div>
            `
            }


            else {
                cartRowItems = cartRowItems + `
                <div class="rec-row">
                <div class="box">
                    <a href="#" class="fas fa-heart"></a>
                    <a href="#" class="fas fa-eye"></a>
                    <img class="rec-image" src="${imgSrc}" alt="">
                    <h3 class = "rec-name">${pname}</h3>
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                    <span class="rec-price price">₹${pprice}</span>
                    <button class="btn" onclick =  "vals(${j})">Add to cart</button>
                </div>
                </div>
            `
            }
            productRow.innerHTML = cartRowItems;
            recommend.append(productRow);
            j++;
        }
    }


    val = 0;
    // document.querySelector('#search-form').classList.remove('active');
}

function vals(i) {
    var price = document.getElementsByClassName('rec-price')[i].innerText;
    var pname = document.getElementsByClassName('rec-name')[i].innerHTML;
    var imageSrc = document.getElementsByClassName('rec-image')[i].src;
    addItemToCart(price, imageSrc, pname);
}


function val12() {

    //     document.getElementsByClassName('notfication').innerHTML = "done";
    //    // console.log("done")
    //     var ajax = new XMLHttpRequest();
    //     ajax.open("GET", "prac2.php", true);
    //     ajax.send();

    //     ajax.onreadystatechange = function () {
    //         if (this.readyState == 4 && this.status == 200) {
    //             var data = JSON.parse(this.responseText);
    //             if (data == "click")
    //                 document.getElementsByClassName('notfication').innerHTML = data;
    //         };
    //     }

    addrecommendations()

    setTimeout('val12()', 2000);
    // console.log("p" + p)

}









