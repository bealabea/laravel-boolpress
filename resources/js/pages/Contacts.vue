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
            <!-- attachment -->
            <div class="mb-3">
                <label for="exampleFormControlInput3" class="form-label"
                    >Allegato</label
                >
                <input
                    type="file"
                    class="form-control"
                    id="exampleFormControlInput3"
                    placeholder="Name-Surname"
                    @change="onAttachmentChange"
                />
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
      attachment: null
    }
  }
},
methods: {
  async formSubmit() {
    try{
      const formDataInstance = new FormData();
      formDataInstance.append('name', this.formData.name);
      formDataInstance.append('email', this.formData.email);
      formDataInstance.append('message', this.formData.message);
      if(this.formData.attachment){
      formDataInstance.append('attachment', this.formData.attachment);
      }

    const resp= await axios.post("/api/contacts", formDataInstance);
    
    this.formSubmitted = true;
    resp.data
    } catch(er) {
      alert('errore, non è possibile inviare la richiesta!')
    }
  },
  onAttachmentChange(event) {
    // event.target.files leggiamo elenco dei files scelti dall'utente
    this.formData.attachment = event.target.files[0];
  }
}

};
</script>

<style></style>
