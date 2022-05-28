<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <div class="alert alert-danger" role="alert" v-if="error !== null">
                    {{ error }}
                </div>

                <div class="card card-default">
                    <div class="card-header">Create pin</div>
                    <div class="card-body">
                        <form>
                            <div class="form-group row">
                                <label for="email" class="col-sm-4 col-form-label text-md-right">Title</label>
                                <div class="col-md-6">
                                    <input id="title" type="text" class="form-control" v-model="title" required
                                           autofocus autocomplete="off">

                                    <div class="text text-danger" v-if="errors.title">
                                        {{ errors.title[0] }}
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-sm-4 col-form-label text-md-right">Image url</label>
                                <div class="col-md-6">
                                    <input id="image" type="url" class="form-control" v-model="image" required
                                           autofocus autocomplete="off">

                                    <div class="text text-danger" v-if="errors.image">
                                        {{ errors.image[0] }}
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary" @click="handleSubmit">
                                        Save
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
import Vue from 'vue'
export default {
    data() {
        return {
            image: "",
            title: "",
            errors: {
                title: null,
                message: null
            },
            error: null,
        }
    },
    methods: {
        handleSubmit(e) {
            e.preventDefault()
            axios.get('/sanctum/csrf-cookie').then(response => {
                axios.post('api/pins/create', {
                    image: this.image,
                    title: this.title
                })
                    .then(response => {
                        if (response.data.success) {
                            this.$router.push('/')
                        }
                    })
                    .catch(error => {
                        this.errors = error.response.data.errors
                        this.error = error.response.data.message
                    });
            })
        }
    },
    beforeRouteEnter(to, from, next) {
        next(vm => {
            if(!vm.$root.user.isLoggedIn) {
                return next('/login');
            }

            next();
        })
    }
}
</script>
