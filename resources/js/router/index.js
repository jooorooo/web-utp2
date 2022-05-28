import Vue from 'vue';
import Router from 'vue-router';

import home from './home';
import user from './user';
import pin from './pin';
import login from './auth/login';
import register from './auth/register';
import createPin from './create-pin';
import error404 from './error404';

Vue.use(Router)

const router = new Router({
    // 2
    routes: [
        ...error404,
        ...home,
        ...user,
        ...pin,
        ...createPin,
        ...register,
        ...login,
    ],
    // 3
    mode: 'history'
});

export default router
