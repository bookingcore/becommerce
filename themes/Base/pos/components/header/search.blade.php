<script type="text/x-template" id="POS_header_search">
    <div class="bc-form--quick-search" >
        <input class="form-control" v-model="s" type="text" placeholder="{{__("Search products (F3)")}}">
    </div>
</script>
<script>
    Vue.component('pos-header-search', {
        template: '#POS_header_search',
        data() {
            return {
                s:[]
            }
        },
    })
</script>
