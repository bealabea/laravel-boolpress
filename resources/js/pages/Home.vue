<template>
    <div class="row">
        <PostCard v-for="post of posts" :key="post.id" :post="post"> </PostCard>
    </div>
</template>

<script>
import axios from "axios";
import PostCard from "../components/PostCard";
export default {
    components: {
        PostCard,
    },
    data() {
        return {
            posts: [],
        };
    },
    methods: {
        getPosts() {
            axios.get("http://127.0.0.1:8000/api/posts").then((response) => {
                this.posts = response.data;
                console.log(this.posts);
            });
        },
    },
    mounted() {
        this.getPosts();
    },
};
</script>

<style lang="scss" scoped>
</style>
