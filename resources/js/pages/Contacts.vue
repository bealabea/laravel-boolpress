<template>
    <div>
        <h1>Contacts</h1>
        <div v-if="!formSubmitted">
          <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label"
                    >Name and Surname</label
                >
                <input
                    type="email"
                    class="form-control"
                    id="exampleFormControlInput2"
                    placeholder="Name-Surname"
                    v-model="formData.name"
                />
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label"
                    >Email address</label
                >
                <input
                    type="email"
                    class="form-control"
                    id="exampleFormControlInput1"
                    placeholder="name@example.com"
                    v-model="formData.email"
                />
            </div>
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label"
                    >Message</label
                >
                <textarea
                    class="form-control"
                    id="exampleFormControlTextarea1"
                    rows="3"
                    v-model="formData.message"
                ></textarea>
            </div>
            <div>
              <button type="submit" class="btn btn-primary" @click="formSubmit">Send</button>
            </div>
        </div>
        <div v-else>
          <h2>Grazie per averci contattato</h2>
        </div>
    </div>
</template>

<script>
import axios from "axios";
export default {
data(){
  return {
    formSubmitted: false,
    formData: {
      name: "",
      email: "",
      message: "",
    }
  }
},
methods: {
  async formSubmit() {
    try{
    const resp= await axios.post("/api/contacts", this.formData);
    this.formSubmitted = true;
    resp.data
    } catch(er) {
      alert('errore, non è possibile inviare la richiesta!')
    }
  }
}

};
</script>

<style></style>
