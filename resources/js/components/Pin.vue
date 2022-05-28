<template>
    <div v-if="item">
        <div class="card shadow-sm">
            <div class="card-title">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="ps-1">
                            <router-link :to="'/user/' + item.user.id" class="btn btn-light">
                                <img :src="item.user.avatar" class="bd-placeholder-img rounded-circle" :alt="item.user.name" style="width:40px;height:40px">
                                <span class="ms-1">{{item.user.name}}</span>
                            </router-link>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center">
                <img :src="item.image" class="card-img-top" :alt="item.title" :style="{width: item.width + 'px'}" style="max-width: 100%; height: auto">
            </div>
            <div class="card-body">
                <p class="card-text" v-html="item.title"></p>
            </div>
            <div class="card-footer">
                <div class="row">
                    <div class="col-sm-12 text-start pt-1">
                        <font-awesome-icon icon="fa-solid fa-comments" /> {{item.comments_count}}
                    </div>
                </div>
            </div>
        </div>

        <div class="accordion mt-2" v-if="item.comments_count > 0">
            <div class="accordion-item" v-for="comment in item.comments">
                <h2 class="accordion-header">
                    <div class="accordion-button" type="button">
                        <img :src="comment.user.avatar" class="bd-placeholder-img rounded-circle" :alt="comment.user.name" style="width:40px;height:40px">
                        <span class="ms-2">{{comment.user.name}}</span>
                    </div>
                </h2>
                <div class="accordion-collapse collapse show">
                    <div class="accordion-body">
                        {{comment.comment}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div v-else-if="item === false">
        404
    </div>
</template>

<script>
export default {
    data() {
        return {
            item: null,
        }
    },
    mounted() {
        this.getItem()
    },
    methods: {
        getItem() {
            axios.get('/api/pins/view/' + this.$route.params.id).then(response => {
                this.item = response.data
            })
                .catch(error => {
                    this.item = false
                    console.log(error)
                })
        }
    }
}
</script>

<style>
.accordion-button:after {
    display: none;
}
</style>
