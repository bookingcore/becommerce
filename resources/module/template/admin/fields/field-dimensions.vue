<template>
    <div class="dimensions-inputs form-inline">
        <div class="form-group mx-sm-3 mb-2">
            <input type="number" class="form-control" v-model="value.length" :placeholder="schema.i18n.length">
        </div>
        <div class="form-group mx-sm-3 mb-2">
            <input type="number" class="form-control" v-model="value.width" :placeholder="schema.i18n.width">
        </div>
        <div class="form-group mx-sm-3 mb-2">
            <input type="number" class="form-control" v-model="value.height" :placeholder="schema.i18n.height">
        </div>
    </div>
</template>
<script>

    import { abstractField } from "vue-form-generator";

    export default {
        mixins: [ abstractField ],
        data(){
            return {
                options:[],
            }
        },
        methods:{

        },
        created: function () {
        },
        watch: {

        },
        destroyed: function () {

        }
    };
</script>