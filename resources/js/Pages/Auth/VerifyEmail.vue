<template>
    <layout-dashboard>
        <div class="row">
            <div class="col-md-12">
                <alert-email-verify :verified_email="verified_email" :email_time_expiration="email_time_expiration"
                    :routes_fortify="routes_fortify"></alert-email-verify>
            </div>
        </div>
    </layout-dashboard>
</template>
<script>
import { router } from '@inertiajs/vue3';
import AlertEmailVerify from '../../components_static/AlertEmailVerify.vue';
export default {
    data() {
        return {

        }
    },
    components: {
        'alert-email-verify': AlertEmailVerify
    },
    computed: {
        monthNowFormat() {
            let date = new Date();
            let month = date.getMonth() + 1;
            const formattedMonth = month < 10 ? `0${month}` : month.toString();
            return formattedMonth + "/" + date.getFullYear();
        }
    },
    props: {
        verified_email: Boolean,
        email_time_expiration: Number,
        routes_fortify: Object
    },
    methods: {

    }
}
</script>
