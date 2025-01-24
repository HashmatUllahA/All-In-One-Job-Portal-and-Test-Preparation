<template>
  <div class="row">
    <div class="mainbody col-2">
      <sidebar-component></sidebar-component>
    </div>
    <div class="col-10">
      <div class="header">
        <h3>List of messages</h3>
      </div>

      <table class="table table-striped table-bordered mt-4">
        <thead>
          <tr>
            <th>#</th>
            <th>name</th>
            <th>email</th>
            <th>Mobile number</th>
            <th>city</th>
            <th>message</th>
            <th>Reply</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(message, index) in messages" :key="message.id">
            <td>{{ index + 1 }}</td>
            <td>{{ message.name }}</td>
            <td>{{ message.email }}</td>
            <td>{{ message.mobile_number }}</td>
            <td>{{ message.city }}</td>
            <td>{{ message.message }}</td>
            <td v-if="message.reply == 1"><i class="fa fa-check" aria-hidden="true"></i></td>
            <td v-else>
            
              <input type="radio"  @change="messagesReply(message.id)">
            </td>
          </tr>

        </tbody>
      </table>
    </div>

  </div>
</template>
<script>
import axios from "axios";
import SidebarComponent from '../components/SidebarComponent.vue';
// import HeaderComponent from '../components/HeaderComponent.vue';

export default {
  components: {
    SidebarComponent,
  },
  data() {
    return {
      messages: [],
    }
  },
  created() {
    this.allmessages();
  },
  methods: {
    allmessages(messageId) {
      // alert(messageId);
      axios.get('/all-messages').then(response => {
        this.messages = response.data;
        // 
      })
    },
    messagesReply(messageId) {
      axios.post(`/message-reply/${messageId}`).then(response => {
        console.log(response.data);
        this.allmessages();
        // Optionally, you might want to update the message list here
       
      }).catch(error => {
        console.error(error);
      });
    }
  }



};
</script>
<style scoped>
.mainbody {
  /* position: fixed; */
  /* left: 279px; */
  box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;
}

.header {
  text-align: center;
  margin-top: 10px;
  background: #426085;
  color: white;
  padding: 1px;

}
</style>