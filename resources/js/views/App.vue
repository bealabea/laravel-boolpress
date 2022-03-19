<template>
    <div>
        <div class="row justify-content-center row-cols-1 row-cols-md-2">
            <div class="card m-2" v-for="post of posts" :key="post.id">
                <div class="card-body">
                    <h5 class="card-title">{{ post.title }}</h5>
                    <p class="card-text" v-html="post.content"></p>

                    <em>Autore: {{ post.user.name }};
                        Data: {{ post.created_at }}</em
                    ><br />
                    <strong v-if="post.category">{{ post.category.genre }}</strong>
                </div>

                <div class="card-footer">
                    <a href="#">Dettagli</a>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";
export default {
    components: {},
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

<style lang="scss"></style>
