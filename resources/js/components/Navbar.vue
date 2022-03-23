<template>
    <div>
        <nav class="navbar navbar-dark bg-dark navbar-expand-md shadow">
            <!-- container navbar -->
            <div class="container">
                <a class="navbar-brand" href="/">Boolpress</a>

                <button
                    class="navbar-toggler"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent"
                    aria-bs-controls="navbarSupportedContent"
                    aria-bs-expanded="false"
                >
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div
                    class="collapse navbar-collapse"
                    id="navbarSupportedContent"
                >
                    <!-- /Left Side Of Navbar -->

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item" v-for="route in routes" :key="route.path">
                            <router-link
                                :to="!route.path ? '/' : route.path"
                                class="nav-link">
                                {{ route.meta.linkText }}
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/login" v-if="!user">Login</a>
                            <a class="nav-link" href="/admin" v-else><i class="user_icon fas fa-user-ninja"></i> <strong>{{user.name}}</strong></a>
                        </li>
                    </ul>
                    <!-- /Right Side Of Navbar -->
                </div>
            </div>
            <!-- /container navbar -->
        </nav>
    </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      routes: [],
      user: null,
    };
  },
  methods: {
      getUser() {
          axios.get('/api/user')
          .then(resp => {
              console.log(resp.data);
            this.user = resp.data;
            // salvo l'utente in localStorage con stringify che prende un oggetto e lo converte in JSON
            localStorage.setItem("user", JSON.stringify(resp.data));
            // evento custom
            window.dispatchEvent(new CustomEvent("storedUserChanged"));

          }).catch((er) => {
              console.error("utente non loggato")
              localStorage.removeItem('user');
              window.dispatchEvent(new CustomEvent("storedUserChanged"));
          });
      }
  },
  mounted() {
    this.routes = this.$router.getRoutes().filter((route) => !!route.meta.linkText);
    this.getUser();
  },
};
</script>

<style>
.user_icon {
    color: #00ff77;
}
</style>
