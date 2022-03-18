<template>
    <div>
        <h1>CIAONE</h1>
        <div class="card" style="width: 18rem" v-for="post in posts" :key="post.id">
            <img src="" class="card-img-top" alt="..." />
            <div class="card-body">
                <h5 class="card-title">{{post.title}}</h5>
                <p class="card-text">
                    {{post.content}}
                </p>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
export default {
    components: {
        data() {
            return {
                posts: []
            }
        },
    },

    methods: {
        getPosts() {
            axios.get('http://127.0.0.1:8000/api/posts').then((response) => {
                this.posts = response.data.data;
                console.log(this.posts);
            });
        },
    },
    mounted() {
        this.getPosts();
    },
};
</script>

<style lang="scss"></style>
