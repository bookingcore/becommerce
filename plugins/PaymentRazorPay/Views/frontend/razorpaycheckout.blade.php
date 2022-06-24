<script src="{{ asset('libs/jquery-3.6.0.min.js') }}"></script>

<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
    var options = {
        "key": "{{ $key }}",
        "amount": {{ $data['amount'] }},
        "currency": "{{ strtoupper($data['currency'])}}",
        "name": '{{ $data["description"]??""}}',
        "image": "",
        "order_id": "{{ $order_id }}",
        "handler": function (response){
            let data = response;
            data['_token'] = '{{ csrf_token() }}'
            $.ajax({
                url: '{{ $callback_url }}',
                type: 'post',
                data: response,
                datatype: 'JSON',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                success: function (msg) {
                    window.location.href = msg;
                }
            });
        },
        "prefill": {
            "name": "{{ $data['card_holder_name'] }}",
            "email": "{{ $data['email'] }}",
            "contact": ""
        },
        "notes": {
            "address": ""
        },
        "modal": {
            "ondismiss": function(){
                window.location.replace("{{ $data['cancel_url'] }}");
            }
        }
    };
    var rzp1 = new Razorpay(options);
    rzp1.open();
</script>
