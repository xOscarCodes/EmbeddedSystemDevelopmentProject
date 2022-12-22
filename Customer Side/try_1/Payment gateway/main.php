<!DOCTYPE html>
<html>
    
<body>
<script
  src="https://code.jquery.com/jquery-3.6.1.min.js"
  integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ="
  crossorigin="anonymous"></script>
  
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <form>
        <input type="text" name="name" placeholder="Enter Name" id="name"><br><br>
        <input type="text" name="amount" placeholder="Enter Amount" id="amount"><br><br>
        <input type="button" name="button" value="pay Now" onclick="Makepayment()">
    </form>

    <p id="demo">name is sfdd</p>

    <script>
        function Makepayment() {
            var name = document.getElementById("name").value;
            var amount = document.getElementById("amount").value;
            var status = "done";
            var id;


            var options = {
                "key": "rzp_test_sqYZW8I7vHfK0E",
                "amount": amount * 100,
                "currency": "INR",
                "name": "total bill payment",
                "description": "Test Transaction",
                "image": "https://example.com/your_logo",
                "callback_url": "https://eneqd3r9zrjok.x.pipedream.net/",

                "prefill": {
                    "name": "Harshdeep",
                },
                "handler": function (response) {
                    jQuery.ajax({
                        type:"POST",
                        url:"payment.php",
                        data:"pay_id="+response.razorpay_payment_id+"&amount="+amount+"&name="
                        +name,
                        success:function(result)
                        {
                            //window.location.href="sucess.php";
                        }
                    });

                },

                "modal": {
                    "ondismiss": function () {
                        if (confirm("Are you sure, you want to cancel the payment")) {
                            console.log("Checkout form closed by the user");
                            status = "pending";
                            document.getElementById("demo").innerHTML = status;
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

            document.getElementById("demo").innerHTML = status;
            var rzp1 = new Razorpay(options);
            rzp1.open();
        }

    </script>

</body>

</html>
