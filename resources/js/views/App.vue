<template>
    <div>
        <Navbar></Navbar>
        <div class="container">
        <router-view></router-view>
        </div>
        <Footer></Footer>
    </div>
</template>

<script>
import Footer from '../components/Footer.vue';
import Navbar from "../components/Navbar.vue";
export default {
    components: {
        Navbar,
        Footer,
    },
};
</script>

<style>
body {
    font-family: "Nunito", sans-serif;
    font-weight: 200;
    height: 100vh;
    margin: 0;
}
</style>
