<!-- fieldAwesome.vue -->
<template>
    <div class="">
        <textarea v-model="value"></textarea>
    </div>
</template>

<script>
    import { abstractField } from "vue-form-generator";


    export default {
        mixins: [ abstractField ],
        data(){
            return {
                config:{
                }
            }
        },
        components:{
        }
    };
</script>