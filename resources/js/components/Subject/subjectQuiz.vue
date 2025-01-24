<template>
  <div class="row">
    <div class="mainbody col-2">
      <sidebar-component></sidebar-component>
    </div>
    <div class="col-10">
      <button type="button" class="btn btn-primary mt-2" data-toggle="modal" data-target="#addQuizModel">
        Add Quiz
      </button>


      <table v-if="QuizRercord.length > 0" style=" margin-top: 62px !important;" class="w-100 mt-3 ">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">title</th>
            <th scope="col">department name</th>
            <th scope="col">subject name</th>
            <th scope="col">Quiz time</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="data in QuizRercord" :key="data.id">
            <td>{{ data.id }}</td>
            <td>{{ data.title }}</td>
            <td v-if="data.department && data.department.title">{{ data.department.title }}</td>
            <td v-else>null</td>
            <td v-if="data.subject && data.subject.subject_name">{{ data.subject.subject_name }}</td>
            <td v-else>null</td>
            <td>{{ data.time }}</td>

            <td>
              <button type="button" class="btn btn-primary mt-2" @click="editquiz(data.id)" data-toggle="modal" data-target="#editQuizModel">
                edit 
              </button>

              <button class="btn btn-danger" @click="deletequiz(data.id)">Delete</button>
            </td>
          </tr>
        </tbody>
      </table>
      <div v-else>
        <p>no record</p>

      </div>


    </div>
   
    <!-- add Quiz -->
    <div class="modal fade" id="addQuizModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
      aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Add quiz by subject</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group" @click="fetchDepartmentForMcqs">
              <label for="exampleInputEmail1">Select Department</label>
              <select @change="selectDepartmentForSubject" v-model="selected_department" class="form-control">
                <option value="" disabled>Select an option</option>
                <option v-for="data in departmantRercord" :key="data.id" :value="data.id">{{ data.title }}</option>
              </select>
            </div>

            <div class="form-group">
              <label for="exampleInputEmail1">Select subject</label>
              <select v-model="formData.selected_subject" class="form-control">
                <option value="" disabled>Select an option</option>
                <option v-for="data in subjectRectrecord" :key="data.id" :value="data.id">{{ data.subject_name }}</option>
              </select>
            </div>

            <!-- Display added options with radio buttons -->

            <div class="form-group">
              <label for="optionA">Quiz Title:</label>
              <input class="form-control" v-model="formData.title" type="text" required>
            </div>
            <div class="form-group">
              <label for="exampleInputTime">Quiz Time (minutes):</label>
              <input class="form-control" v-model="formData.time" type="number" required>
            </div>
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" @click="saveQuiz">Save</button>
          </div>
        </div>
      </div>
    </div>

     <!--start  Edit subject  Modal ////////////////////////////////////////////////////////////////////////-->
     <!-- <div class="form-group">
              <label for="exampleInputEmail1">quiz title</label>
              <input type="text" class="form-control" v-model="formData.title">
              <button type="button" class="btn btn-primary" @click="updateQuiz">Update</button>
            </div> -->
            <div class="modal fade" id="editQuizModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
      aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Edit quiz</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label for="exampleInputEmail1">quiz title</label>
              <!-- <input type="text" class="form-control" v-model="formData.title"> -->
            </div> 
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" @click="updateQuiz">Update</button>
          </div>
        </div>
      </div>
    </div>
    <!--end  Edit Modal ////////////////////////////////////////////////////////////////////////-->
    <div v-if="errorMessage" class="alert alert-danger">{{ errorMessage }}</div>
  </div>
</template>

<script>
import axios from 'axios';
import Swal from 'sweetalert2';
import SidebarComponent from '../SidebarComponent.vue';
export default {
  components: {
    SidebarComponent,
  },
  data() {
    return {
      formData: {
        selected_subject: '',
        selected_department: '',
        title: '',
        time: '',

      },
      title: '',


      QuizRercord: [],
      errorMessage: '',
      departmantRercord: [],
      subjectRectrecord: [],
    };
  },
  created() {
    this.fetchQuiz();
  },

  methods: {
    updateQuiz() {
      axios.put(`/updateQuiz/${this.formData.id}`, { title: this.formData.title })
        .then(response => {
          console.log(response.data);
          Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: 'Department updated successfully!',
            timer: 1000,
            showConfirmButton: false,
          });

          this.formData.id = null;
          this.formData.title = '';

          $('#editquiz').modal('hide');

          this.fetchQuiz();
        })
        .catch(error => {
          console.error('There was an error!', error.response);

          if (error.response.status === 422) {
            this.errors = error.response.data.errors || { title: [error.response.data.message] };
            console.log('Error Message:', this.errors.title[0]);
          }
        });
    },

    editquiz(id) {
      // Find the department with the specified ID
      const quiz = this.QuizRercord.find(data => data.id === id);

      // Set the data to be edited
      this.formData.id = id;
      this.formData.title = quiz ? quiz.title : '';

      // Open the modal
      $('#editQuizModel').modal('show');
    },
    fetchQuiz() {
      // alert('subject quiz record');
      axios.get('/fetchQuiz').then((response) => {
        this.QuizRercord = response.data.QuizRercord;
      })
        .catch(error => {
          console.error('There was an error!', error.response);
          // Add this line to display the error in the console
          this.errorMessage = error.response.data.error || 'An error occurred';
        })
    },
    saveQuiz() {
      const requestData = {
        selected_department: this.selected_department,
        selected_subject: this.formData.selected_subject,
        title: this.formData.title,
        time: this.formData.time,

      };
      axios.post('/saveQuiz', requestData)
        .then(response => {
          console.log(response.data);
          Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: 'Quiz added successfully!',
            timer: 1000,
            showConfirmButton: false,
          });
          $('#addQuizModel').modal('hide');
          this.fetchQuiz();
        })
        .catch(error => {
          console.error('There was an error!', error.response);

          if (error.response.status === 422) {
            this.errors = error.response.data.errors || { title: [error.response.data.message] };
            console.log('Error Message:', this.errors.title[0]); // Correct the property name
          }
        });
    },


    fetchDepartmentForMcqs() {
      axios.get('/fetchDepartmentForSubjectQuiz').then((response) => {
        this.departmantRercord = response.data;

      });

    },
    selectDepartmentForSubject() {
      axios.get('/selectSubjectForSubjectQuiz', {
        params: { selected_department: this.selected_department }
      }).then((response) => {
        this.subjectRectrecord = response.data;
      });

    },

    deletequiz(id) {
      // Display a confirmation dialog before deleting
      Swal.fire({
        title: 'Are you sure?',
        text: 'You won\'t be able to revert this!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.isConfirmed) {
          // User confirmed, proceed with the deletion
          axios.delete(`/deleteQuiz/${id}`)
            .then(response => {
              console.log(response.data);
              Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: 'quiz deleted successfully!',
                timer: 1000,
                showConfirmButton: false,
              });

              // Fetch updated department data
              this.fetchQuiz();
            })
            .catch(error => {
              console.error('There was an error!', error.response);
              // Handle error
            });
        }
      });
    },

  },



}

</script>
  

<style scoped>
.mainbody {
  /* position: fixed; */
  /* top: 54px;
    left: 283px; */
  box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;
}

/* .custom-mergin {
  margin-left: 40px; }*/
/* } */
</style>