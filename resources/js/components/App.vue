<template>
    <div class="h-100 container">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="collapse navbar-collapse">
                <!-- for logged-in user-->
                <div class="navbar-nav" v-if="$root.user.isLoggedIn">
                    <router-link to="/" class="nav-item nav-link">Home</router-link>
                    <router-link to="/books" class="nav-item nav-link">Books</router-link>
                    <a class="nav-item nav-link" style="cursor: pointer;" @click="logout">Logout</a>
                    <router-link to="/about" class="nav-item nav-link">About (404 url)</router-link>
                </div>
                <!-- for non-logged user-->
                <div class="navbar-nav" v-else>
                    <router-link to="/" class="nav-item nav-link">Home</router-link>
                    <router-link to="/login" class="nav-item nav-link">login</router-link>
                    <router-link to="/register" class="nav-item nav-link">Register</router-link>
                    <router-link to="/about" class="nav-item nav-link">About (404 url)</router-link>
                </div>
            </div>
        </nav>

        <router-view :key="$route.fullPath"></router-view>
    </div>
</template>

<script>
export default {
    name: "App",
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
