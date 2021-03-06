import Vue from 'vue';
import router from '@router';
import FontAwesomeIcon from '@faIcons';
import App from '@components/App.vue';

Vue.component('font-awesome-icon', FontAwesomeIcon)

const vuejs = new Vue({
    el: '#app',
    router,
    data() {
        return {
            user: Laravel
        }
    },
    render: h => h(App),
})

