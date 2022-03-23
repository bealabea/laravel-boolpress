<template>
        <div class="container mt-5 text-center">
            <h6 v-if="user">Made with &hearts; by {{user.name}}
            </h6>
        </div>
</template>

<script>
export default {
     data() {
    return {
      user: null,
    };
  },
  methods: {
    getStoredUser() {
      const storedUser = localStorage.getItem("user");

      if (storedUser) {
        this.user = JSON.parse(storedUser);
      } else {
        this.user = null;
      }
    },
  },
  mounted() {
    this.getStoredUser();
    window.addEventListener("storedUserChanged", () => {
      // ogni volta che cambia l'utente, aggiorniamo la variabile user.
      this.getStoredUser();
    });
  },
};
</script>

<style></style>
