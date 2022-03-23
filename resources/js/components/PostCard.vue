<template>
  <div class="col-12 col-lg-4">
        <div class="card post-card m-2 text_card">
            <div class="card-body bg-dark rounded">
                <img class="img-fluid rounded" :src="post.image" alt="" />
                <h5 class="card-title mt-4">{{ post.title }}</h5>

                <em>Autore: {{ post.user.name }}<br />
                    Data: {{ dateFormat(post.created_at) }}</em><br />
                <strong v-if="post.category">{{ post.category.genre }}</strong>

                <div class="mt-3 pt-3 border-top border-secondary"> 
                    <router-link :to="{ name: 'posts.show', params: { post: post.slug },}"
                        class="details-link">
                        Details<i class="fas fa-chevron-right ms-2"></i>
                    </router-link>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import dayjs from "dayjs";

export default {
    props: {
        post: Object,
    },
    data() {
        return {};
    },
    methods: {
        dateFormat(date) {
        return dayjs(date).format("DD/MM/YYYY HH:mm");
    }
    },
    mounted() {},
};
</script>

<style lang="scss" scoped>
.card{
    transform: scale(1.0);
    transition: all 0.5s;
    &:hover {
        transform: scale(1.1);
        transition: all 0.5s;
    }
}
.text_card{
     color: #aabbc3;
}
.details-link {
    color: #b3c0c7;
    text-decoration: none;
    cursor: pointer;
}
</style>
