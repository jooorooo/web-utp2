<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <div class="alert alert-danger" role="alert" v-if="error !== null">
                    {{ error }}
                </div>

                <div class="card card-default">
                    <div class="card-header">Register</div>
                    <div class="card-body">
                        <form>
                            <div class="form-group row">
                                <label for="name" class="col-sm-4 col-form-label text-md-right">Name</label>
                                <div class="col-md-6">
                                    <input id="name" type="email" class="form-control" v-model="name" required
                                           autofocus autocomplete="off">

                                    <div class="text text-danger" v-if="errors.name">
                                        {{ errors.name[0] }}
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-sm-4 col-form-label text-md-right">E-Mail Address</label>
                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" v-model="email" required
                                           autofocus autocomplete="off">

                                    <div class="text text-danger" v-if="errors.email">
                                        {{ errors.email[0] }}
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>
                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" v-model="password"
                                           required autocomplete="off">

                                    <div class="text text-danger" v-if="errors.password">
                                        {{ errors.password[0] }}
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary" @click="handleSubmit">
                                        Register
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            name: "",
            email: "",
            password: "",
            error: null,
            errors: {
                name: null,
                email: null,
                password: null,
            },
        }
    },
    methods: {
        handleSubmit(e) {
            e.preventDefault()
            axios.get('/sanctum/csrf-cookie').then(response => {
                axios.post('api/register', {
                    name: this.name,
                    email: this.email,
                    password: this.password
                })
                    .then(response => {
                        this.$router.push('/login')
                    })
                    .catch(error => {
                        if(error.response.data.errors) {
                            this.errors = error.response.data.errors
                        }
                        this.error = error.response.data.message
                    });
            })
        }
    },
    beforeRouteEnter(to, from, next) {
        next(vm => {
            if (vm.$root.user.isLoggedIn) {
                return next('/');
            }

            next();
        })
    }
}
</script>
