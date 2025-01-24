<template>
  <div class="row">
    <div class="mainbody col-2">
      <sidebar-component></sidebar-component>
    </div>
    <div class="col-10">
      <button type="button" class="btn btn-primary mt-2" data-toggle="modal" data-target="#createQuizModel">
        create Quiz
      </button>

      <table v-if="subjectQuizMcqs.length > 0" style=" margin-top: 62px !important;" class="table mt-3 custom-table">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Quiz Title</th>
          <th scope="col">Question</th>
          <th scope="col">Option A</th>
          <th scope="col">Option B</th>
          <th scope="col">Option C</th>
          <th scope="col">Option D</th>
          <th scope="col">Correct Option</th>

          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="data in subjectQuizMcqs" :key="data.id">
          <td>{{ data.id }}</td>
          <td>{{ data.quiz.title }}</td>
          <td>{{ data.Question }}</td>
          <td>{{ data.OptionA }}</td>
          <td>{{ data.OptionB }}</td>
          <td>{{ data.OptionC }}</td>
          <td>{{ data.OptionD }}</td>
          <td>{{ data.correctOption }}</td>

          <td>
            <button data-toggle="modal" @click="editQuizMcqs(data.id)" data-target="#editquizmcqs"
              class="btn btn-info mr-3">Edit</button>

            <button class="btn btn-danger" @click="deleteSubjectQuizmcqs(data.id)">Delete</button>
          </td>
        </tr>
      </tbody>
    </table>
    <div v-else>
      <p>no record</p>

    </div>
    <div class="modal fade" id="editquizmcqs" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">edit Quiz</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <!-- Display added options with radio buttons -->
          <div>
            <label for="optionA">Question:</label>
            <input class="custom-mergin" type="text" v-model="formData.Question" required>
          </div>
          <div>
            <label for="optionA">Option A:</label>
            <input class="custom-mergin" type="text" v-model="formData.optionA" required>
          </div>
          <div>
            <label for="optionB">Option B:</label>
            <input class="custom-mergin" type="text" v-model="formData.optionB" required>
          </div>
          <div>
            <label for="optionC">Option C:</label>
            <input class="custom-mergin" type="text" v-model="formData.optionC" required>
          </div>
          <div>
            <label for="optionD">Option D:</label>
            <input class="custom-mergin" type="text" v-model="formData.optionD" required>
          </div>
          <div>
            <label for="optionD">Correct option:</label>
            <input class="custom-mergin" type="text" v-model="formData.correctOption" required>
          </div>

        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" @click="updatequizMcqs">update</button>
        </div>
      </div>
    </div>
  </div>
  <!-- create Quiz Model -->
  <div class="modal fade" id="createQuizModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Create new Quiz</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">


          <div class="form-group" @click="fetchQuizzesForCreationMcqs">
            <label for="exampleInputEmail1">Select Quiz</label>
            <select v-model="formData.selected_quiz" class="form-control">
              <option value="" disabled>Select an option</option>
              <option v-for="data in fetchQuizForCreationMcqs" :key="data.id" :value="data.id">{{ data.title }}</option>
            </select>
          </div>

          <!-- Display added options with radio buttons -->

          <div>
            <label for="optionA">Question:</label>
            <input class="custom-mergin" type="text" v-model="formData.Question" required>
          </div>
          <div>
            <label for="optionA">Option A:</label>
            <input class="custom-mergin" type="text" v-model="formData.optionA" required>
          </div>
          <div>
            <label for="optionB">Option B:</label>
            <input class="custom-mergin" type="text" v-model="formData.optionB" required>
          </div>
          <div>
            <label for="optionC">Option C:</label>
            <input class="custom-mergin" type="text" v-model="formData.optionC" required>
          </div>
          <div>
            <label for="optionD">Option D:</label>
            <input class="custom-mergin" type="text" v-model="formData.optionD" required>
          </div>
          <div>
            <label for="optionD">Correct option:</label>
            <input class="custom-mergin" type="text" v-model="formData.correctOption" required>
          </div>

        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" @click="createSubjectQuizMcqs">Save</button>
        </div>
      </div>
    </div>
  </div>
    </div>

  </div>
  
 
</template>
<script>
import axios from 'axios';
import SidebarComponent from '../SidebarComponent.vue';
export default {
  components: {
    SidebarComponent,
  },
  data() {
    return {
      formData: {
        selected_quiz: '',
        optionA: "",
        optionB: "",
        optionC: "",
        optionD: "",
        Question: "",
        correctOption: "",
      },
      fetchQuizForCreationMcqs: [],
      subjectQuizMcqs: [], // Renamed the data property
    };
  },
  created() {
    // this.fetchSubjectQuizMcqs();
  },

  methods: {
    // editQuizMcqs(id) {
    //   const selectedMCQ = this.subjectQuizMcqs.find(mcq => mcq.id === id);

    //   // Set the data to the formData object
    //   this.formData.id = selectedMCQ.id;
    //   this.formData.Question = selectedMCQ.Question;
    //   this.formData.optionA = selectedMCQ.OptionA;
    //   this.formData.optionB = selectedMCQ.OptionB;
    //   this.formData.optionC = selectedMCQ.OptionC;
    //   this.formData.optionD = selectedMCQ.OptionD;
    //   this.formData.correctOption = selectedMCQ.correctOption;
    //   $('#editmcqsModel').modal('show');
    // },
    // updatequizMcqs() {
    //   // console.log('Updating with ID:', this.formData.id);
    //   const requestData = {
    //     id: this.formData.id,
    //     Question: this.formData.Question,
    //     OptionA: this.formData.optionA,
    //     OptionB: this.formData.optionB,
    //     OptionC: this.formData.optionC,
    //     OptionD: this.formData.optionD,
    //     correctOption: this.formData.correctOption,
    //   };

    //   axios.put(`/updateQuizMcqs/${requestData.id}`, requestData)
    //     .then(response => {
    //       console.log(response.data);
    //       Swal.fire({
    //         icon: 'success',
    //         title: 'Success!',
    //         text: 'Mcqs updated successfully!',
    //         timer: 1000,
    //         showConfirmButton: false,
    //       });
    //       $('#editquizmcqs').modal('hide');
    //       this.fetchSubjectQuizMcqs(); // Refresh the data after update
    //     })
    //     .catch(error => {
    //       console.error("Error updating Mcqs:", error);
    //       // Handle errors and show appropriate messages to the user
    //     });
    // },

    // createSubjectQuizMcqs() 
    // {
    //   const requestData = {
    //     selected_quiz: this.formData.selected_quiz,
    //     Question: this.formData.Question,
    //     OptionA: this.formData.optionA,
    //     OptionB: this.formData.optionB,
    //     OptionC: this.formData.optionC,
    //     OptionD: this.formData.optionD,
    //     correctOption: this.formData.correctOption,
    //   };

    //       axios.post("/createSubjectQuizMcqs", requestData)
    //     .then(response => {
    //       console.log(response.data);
    //       this.fetchSubjectQuizMcqs();
    //       Swal.fire({
    //         icon: 'success',
    //         title: 'Success!',
    //         text: 'Department added successfully!',
    //         timer: 1000,
    //         showConfirmButton: false,
    //       });
    //       $('#createQuizModel').modal('hide');
    //     })
    //     .catch(error => {
    //       console.error("Error submitting form:", error);
    //       // Handle errors and show appropriate messages to the user
    //     });
    // },
    // fetchSubjectQuizMcqs() {
    //   axios.get('/fetchSubjectQuizMcqs').then((response) => {
    //     this.subjectQuizMcqs = response.data.subjectQuizMcqs; // Updated the assignment
    //   });
    // },
    // fetchQuizzesForCreationMcqs() {
    //   axios.get('/fetchQuizForCreationMcqs').then((response) => {
    //     this.fetchQuizForCreationMcqs = response.data.fetchQuizForCreationMcqs;
    //   });
    // },
    // deleteSubjectQuizmcqs(id) {
    //   Swal.fire({
    //     title: 'Are you sure?',
    //     text: 'You won\'t be able to revert this!',
    //     icon: 'warning',
    //     showCancelButton: true,
    //     confirmButtonColor: '#3085d6',
    //     cancelButtonColor: '#d33',
    //     confirmButtonText: 'Yes, delete it!'
    //   }).then((result) => {
    //     if (result.isConfirmed) {
    //       // User confirmed deletion, make axios request
    //       axios.delete(`/deleteSubjectQuizmcqs/${id}`)
    //         .then(response => {
    //           // Handle success
    //           console.log(response.data);
    //           Swal.fire({
    //             icon: 'success',
    //             title: 'Deleted!',
    //             text: 'MCQ has been deleted.',
    //             timer: 1000,
    //             showConfirmButton: false,
    //           });
    //           this.fetchSubjectQuizMcqs(); // Refresh the data after deletion
    //         })
    //         .catch(error => {
    //           console.error("Error deleting MCQ:", error);
    //           // Handle errors and show appropriate messages to the user
    //         });
    //     }
    //   });
    // },
  },
};
</script>

<style scoped>
.mainbody {

  box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;
}
</style>