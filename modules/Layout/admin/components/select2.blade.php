<script type="text/x-template" id="bc-select2-template">
    <div>
        <select class="form-control" :id="id" :name="name" :disabled="disabled" :required="required"></select>
    </div>
</script>

<script>
    Vue.component('bc-select2', {
        template:'#bc-select2-template',
        data() {
            return {
                select2: null
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
            value: null
        },
        watch: {
            options(val) {
                this.setOption(val);
            },
            value(val) {
                this.setValue(val);
            }
        },
        methods: {
            setOption(val = []) {
                this.select2.empty();
                this.select2.select2({
                    placeholder: this.placeholder,
                    ...this.settings,
                    data: val
                });
                this.setValue(this.value);
            },
            setValue(val) {
                if (val instanceof Array) {
                    this.select2.val([...val]);
                } else {
                    this.select2.val([val]);
                }
                this.select2.trigger('change');
            }
        },
        mounted() {
            this.select2 = $(this.$el)
                .find('select')
                .select2({
                    placeholder: this.placeholder,
                    ...this.settings,
                    data: this.options
                })
                .on('select2:select select2:unselect', ev => {
                    this.$emit('change', this.select2.val());
                    this.$emit('select', ev['params']['data']);
                })
                .on('select2:closing', ev => {
                    this.$emit('closing', ev);
                })
                .on('select2:close', ev => {
                    this.$emit('close', ev);
                })
                .on('select2:opening', ev => {
                    this.$emit('opening', ev);
                })
                .on('select2:open', ev => {
                    this.$emit('open', ev);
                })
                .on('select2:clearing', ev => {
                    this.$emit('clearing', ev);
                })
                .on('select2:clear', ev => {
                    this.$emit('clear', ev);
                });
            this.setValue(this.value);
        },
        beforeDestroy() {
            this.select2.select2('destroy');
        }
    });
</script>
