<style>
    .checkout-button{
        background: {{setting_item('style_main_color','#5191fa')}};
        margin: 2rem auto;
        padding: 1rem;
        color: #fff;
        border: 1px solid;
        border-radius: 0.25rem;
        display: flex;
    }

</style>

<form class="text-center py-5">
    <script src="https://checkout.flutterwave.com/v3.js"></script>
    <button type="button" class="checkout-button" onClick="makePayment()">{{__("Pay Now")}}</button>
</form>
<script src="{{asset('libs/jquery-3.6.0.min.js')}}"></script>
<script>
    function makePayment() {
        FlutterwaveCheckout({
            public_key: "{{$data['public_key']}}",
            tx_ref: "{{$data['tx_ref']}}",
            amount: {{$data['amount']}},
            currency: "{{$data['currency']}}",
            // country: "US",
            payment_options: "1",
            customer: {
                email: "{{$billing['email']??""}}",
                phone_number: "{{$billing['phone']??""}}",
                name: "{{__(':first_name :last_name',['first_name'=>$billing['first_name']??"",'last_name'=>$billing['last_name']??""])}}",
            },
            callback: function (data) { // specified callback function
                data['checkoutNormal']  = "{{$data['checkoutNormal']}}"
                $.post("{{route('confirmFlutterWaveGateway',['order_id'=>$order->id])}}", data).promise().then((result) => {
                    if(result.message){
                        alert(result.message);
                    }
                    if(result.url_redirect){
                        window.location.href=result.url_redirect
                    }
                });
            },
            customizations: {
                title: "{{$data['service_title']}}",
                description: "{{$data['description']}}",
                logo: "",
            },
        });
    }
</script>
