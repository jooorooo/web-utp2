<template>
    <div class="h-100 container">

        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <button class="navbar-toggler" type="button" @click="navCollapse = !navCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" :class="{show: navCollapse}">

                <div class="navbar-nav">
                    <router-link to="/" class="nav-item nav-link">Home</router-link>
                    <router-link to="/create-pin" class="nav-item nav-link" v-if="$root.user.isLoggedIn">Create pin</router-link>
                    <a class="nav-item nav-link" style="cursor: pointer;" @click="logout" v-if="$root.user.isLoggedIn">Logout</a>
                    <router-link to="/login" class="nav-item nav-link" v-if="!$root.user.isLoggedIn">login</router-link>
                    <router-link to="/register" class="nav-item nav-link" v-if="!$root.user.isLoggedIn">Register</router-link>
                    <router-link to="/about" class="nav-item nav-link">About (404 url)</router-link>
                </div>

                <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </nav>

        <router-view :key="$route.fullPath"></router-view>
    </div>
</template>

<script>
export default {
    name: "App",
    data() {
        return {
            navCollapse: false
        }
    },
    methods: {
        logout(e) {
            e.preventDefault()
            axios.get('/sanctum/csrf-cookie').then(response => {
                axios.post('/api/logout')
                    .then(response => {
                        if (response.data.success) {
                            this.$root.user = {
                                isLoggedIn: false
                            }

                            if(this.$route.name !== 'home') {
                                this.$router.push('/')
                            }
                        } else {
                            console.log(response)
                        }
                    })
                    .catch(function (error) {
                        console.error(error);
                    });
            })
        }
    },
}
</script>
