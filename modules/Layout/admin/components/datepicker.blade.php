<script type="text/x-template" id="bc-datepicker-template">
    <div>
        <input type="text" :value="display_value" :placeholder="placeholder" class="form-control" readonly style="background: transparent" :disabled="disabled">
    </div>
</script>

<script>
    Vue.component('bc-datepicker', {
        template:'#bc-datepicker-template',
        data() {
            return {
                dpk: null,
                display_value:''
            };
        },
        model: {
            event: 'change',
            prop: 'value'
        },
        props: {
            id: {
                type: String,
                default: ''
            },
            name: {
                type: String,
                default: ''
            },
            placeholder: {
                type: String,
                default: ''
            },
            format: {
                type: String,
                default: 'YYYY/MM/DD'
            },
            options: {
                type: Array,
                default: () => []
            },
            disabled: {
                type: Boolean,
                default: false
            },
            required: {
                type: Boolean,
                default: false
            },
            settings: {
                type: Object,
                default: () => {}
            },
            value: null,
        },
        watch: {
            value(val) {
                if(val)
                this.setValue(val);
            }
        },
        methods: {
            setValue(val) {
                if(val){
                    this.display_value = moment(val).format(this.settings.locale.format);
                    this.dpk.setStartDate(moment(val))
                    this.dpk.setEndDate(moment(val))
                }
            }
        },
        mounted() {
            var me = this;
            this.dpk = $(this.$el)
                .find('input')
                .daterangepicker(this.settings).on('apply.daterangepicker', function (ev, picker) {
                    me.setValue(picker.startDate.format('YYYY-MM-DD HH:mm:ss'));
                }).data('daterangepicker');

            this.setValue(this.value);
        },
        beforeDestroy() {
        }
    });
</script>
