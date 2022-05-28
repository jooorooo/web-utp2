<template>
    <div :visible="!loading">
        <div
            class="row  masonryGridSystem" ref="masonryGridSystem"
        >
            <div class="grid-item col-sm-6 col-lg-3" style="height: 0 !important;font-size: 0 !important; margin-bottom: 0 !important;">
                <div class="card shadow-sm cart-dimensions"></div>
            </div>
            <div class="grid-item col-sm-6 col-lg-3 mb-4" v-for="(item, index) in items" :key="index"
                 ref="masonryGridItem">
                <div class="card shadow-sm">
                    <div class="card-title">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="ps-1">
                                    <router-link :to="'/user/' + item.user.id" class="btn btn-light">
                                        <img :src="item.user.avatar" class="bd-placeholder-img rounded-circle" :alt="item.user.name" style="width:40px;height:40px">
                                        {{item.user.name}}
                                    </router-link>
                                </div>
                            </div>
                        </div>
                    </div>
                    <router-link :to="'/view/' + item.id" class="btn btn-light p-0 border-0 text-start">
                        <img :src="item.image" class="card-img-top" :alt="item.title" :style="itemImageDimensions(item)">
                        <div class="card-body">
                            <p class="card-text" v-html="item.title"></p>
                        </div>
                    </router-link>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-sm-3 text-start pt-1">
                                <font-awesome-icon icon="fa-solid fa-comments" /> {{item.comments_count}}
                            </div>
                            <div class="col-sm-9 text-end">
                                <router-link :to="'/view/' + item.id" class="btn btn-danger">View more</router-link>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Masonry from "masonry-layout"
import imgloaded from "imagesloaded"
import _ from 'lodash'

export default {
    name: 'PinsList',
    props: {
        getItemsAxios: {
            required: true,
            type: Function
        }
    },
    data() {
        return {
            items: [],
            loading: false,
            itemWidth: 0,
            page: 1,
            hasMore: 1,
        }
    },
    mounted() {
        this.items = [];
        this.getItems()
        this.getNextPage()
        this.itemWidth = (function() {
            let t = document.querySelector('.cart-dimensions');
            if(!t) {
                return 320;
            }

            return t.scrollWidth || t.clientWidth;
        })()
    },
    methods: {
        getItems() {
            if(!this.hasMore || this.loading) {
                return;
            }
            this.loading = true
            this.getItemsAxios(this.page)
                .then(response => {
                    if(response.data.data.length < 1) {
                        this.hasMore = false
                        return
                    }
                    this.items = this.items.concat(response.data.data)
                    this.loading = false
                    this.page++;
                })
                .catch(error => {
                    this.loading = false
                    console.log(error)
                })
        },
        getNextPage() {
            window.onscroll = () => {
                let bottomOfWindow = document.documentElement.scrollTop + window.innerHeight > (document.documentElement.offsetHeight - 100);
                if (bottomOfWindow && !this.loading) {
                    this.getItems();
                }
            }
        },
        initMasonry() {
            let elem = this.$refs.masonryGridSystem;
            if(!elem) {
                return;
            }

            imgloaded( elem, function() {
                const msnry = new Masonry( elem, {
                    itemSelector: '.grid-item',
                    percentPosition: true,
                })
            })
        },
        itemImageDimensions(item) {
            let k = item.width / this.itemWidth;
            return {
                width: this.itemWidth + 'px',
                height: Math.round(item.height / k) + 'px'
            }
        },
    },
    watch: {
        items() {
            this.initMasonry()
        }
    }
}
</script>
