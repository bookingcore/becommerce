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
                email: "{{$booking->email}}",
                phone_number: "{{$booking->phone}}",
                name: "{{__(':first_name :last_name',['first_name'=>$booking->first_name,'last_name'=>$booking->last_name])}}",
            },
            callback: function (data) { // specified callback function
                data['checkoutNormal']  = "{{$data['checkoutNormal']}}"
                $.post("{{route('confirmFlutterWaveGateway',['code'=>$booking->code])}}", data).promise().then((result) => {
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
<form id="checkoutForm" method="POST" action="{{route('confirmFlutterWaveGateway',['code'=>$code])}}">
{{--<form id="checkoutForm" method="POST" action="/charge">--}}
    {{csrf_field()}}
    <input type="hidden" name="omiseToken">
    <input type="hidden" name="omiseSource">
    <input type="hidden" name="checkoutNormal" value="{{$data['checkoutNormal']??0}}">
</form>
<script type="text/javascript" src="https://cdn.omise.co/omise.js"
{{--        data-key="{{$data['api_key']}}"--}}
{{--        data-amount="{{$data['amount']}}"--}}
{{--        data-currency="{{$data['currency']}}"--}}
{{--        data-frame-label="{{setting_item('site_title')}}"--}}
{{--        data-image="{{get_file_url(setting_item('logo_id'),'full')}}"--}}
{{--        data-button-label="{{__('Pay now')}}"--}}
{{--        data-submit-label="{{__('Submit')}}"--}}
{{--        data-other-payment-methods="{{$data['defaultPaymentMethod']}}"--}}
>
</script>
