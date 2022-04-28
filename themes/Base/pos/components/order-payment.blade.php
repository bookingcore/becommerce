<script type="text/x-template" id="POS_payment">
    <div class="pos-payment flex-shrink-0">
        <div class="sum-item  text-end">
            <label for="">{{__("Subtotal")}}</label>
            <div>@{{subtotal}}</div>
        </div>
        <div class="sum-item  text-end">
            <label for="">{{__("Subtotal")}}</label>
            <div>@{{subtotal}}</div>
        </div>
    </div>
</script>
<script>
    Vue.component('pos-payment', {
        template: '#POS_payment',
        data() {
            return {
                items:[]
            }
        },
        props:{
            subtotal:{
                type:Math.decimal,
                default:0
            },
            order:{
                type:Object,
                default:{}
            },
        }
    })
</script>
