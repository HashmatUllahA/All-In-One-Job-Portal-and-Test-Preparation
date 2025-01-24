<template>
  <div class="row no-gutters">
    <div class="col-2">
      <sidebar-component></sidebar-component>
    </div>
    <div class="col-10 main-content">
      <button type="button" class="btn btn-primary mt-2" data-toggle="modal" data-target="#addmcqsModel">
        Add Mcqs
      </button>
      <button type="button" class="btn btn-primary mt-2 ml-3" data-toggle="modal" data-target="#importmcqsfileModel">
        import subject Mcqs
      </button>
      <div class="row">
        <div class="col-3">
          <div class="form-group">
            <label for="departmentSelect">Select Department</label>
            <select id="departmentSelect" @change="fetchSubDepartmentsForSubjects" v-model="selected_department_id"
              class="form-control">
              <option value="" disabled>Select an option</option>
              <option v-for="data in departmentRecordForSubdepartment" :key="data.id" :value="data.id">{{ data.title }}
              </option>
            </select>
          </div>
        </div>
        <div class="col-3">
          <div class="form-group">
            <label for="exampleInputEmail1">Select Sub Department</label>
            <select class="form-control" @change="fetchsubjectMcqsQuestions" v-model="sub_department_selected_id">
              <option value="" disabled>Select option</option>
              <option v-for="subd in subdepartemnts" :key="subd.id" :value="subd.id">{{ subd.title }}</option>
            </select>
          </div>
        </div>
        <div class="col-3">
          <div class="form-group">
            <label for="exampleInputEmail1">Select Subject</label>
            <select class="form-control" v-model="subject_id" @click="fetchSubjectForMcqsQuestion" @change="fetchsubjectMcqsQuestions">
              <option value="" disabled>Select option</option>
              <option v-for="s in subjects" :key="s.id" :value="s.id">{{ s.subject_name }}</option>
            </select>
          </div>
        </div>
        <div class="col-3 text-center" style="margin-top: 33px;">
          <h4 >Totla Questions: {{ subjectMcqsQuestions.length }}</h4>
        </div>

      </div>
      <div class="mcqs-container mt-4">
        <div v-for="(data, index) in subjectMcqsQuestions" :key="data.id" class="card mb-3">
          <div class="card-body">
            <h5 class="card-title">Question {{ index + 1 }}</h5>
            <p class="card-text">{{ data.question }}</p>
            <ul>
              <li v-for="(option, optIndex) in data.options" :key="option.id" class="list-group-item"
                :class="{ 'bg-primary text-white': option.is_correct }">
                {{ option.option }}
              </li>
            </ul>
            <div class="mt-3">
              <span v-if="data.subject">Subject: {{ data.subject.subject_name }}</span>
              <div class="float-right">
                <button class="btn btn-info mr-2" @click="EditSubjectMcqs(data.id)" data-toggle="modal">Edit</button>
                <button class="btn btn-danger" @click="deleteSubjectMcqs(data.id)">Delete</button>
              </div>
             
            </div>
          </div>
        </div>
      </div>


      <!-- </div>-->
    </div>



  </div>
  <!-- edit mcqs -->
  <div class="modal fade" id="editmcqsModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Edit Question and Options</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

          <div class="form-group">
            <label for="questionInput">Question</label>
            <input id="questionInput" class="form-control" type="text" v-model="editmcqsQuestionOptions.question"
              required>
          </div>

          <div class="form-group">
            <label>Options</label>
            <div v-for="(option, index) in editmcqsQuestionOptions.options" :key="option.id" class="input-group mb-2">
              <div class="input-group-prepend">
                <div class="input-group-text" :class="{ 'bg-primary text-white': option.is_correct }">
                  <input type="checkbox" :checked="option.is_correct" @change="toggleCorrectOption(index)">
                </div>
              </div>
              <input type="text" class="form-control" v-model="option.option" placeholder="Option text">
            </div>
          </div>
          <div class="form-group">
            <label for="explanationInput">Explanation</label>
            <input id="explanationInput" class="form-control" type="text" v-model="editmcqsQuestionOptions.explanation">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" @click="updateSubjectMcqs">update Mcqs</button>
        </div>
      </div>
    </div>
  </div>
  <!--add mcqs Modal -->
  <div class="modal fade" id="addmcqsModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Add MCQs</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group" @click="fetchDepartmentForMcqs">
            <label for="departmentSelect">Select Department</label>
            <select id="departmentSelect" v-model="selected_department_id"
              class="form-control">
              <option value="" disabled>Select an option</option>
              <option v-for="data in departmantRercord" :key="data.id" :value="data.id">{{ data.title }}</option>
            </select>
          </div>
          <div class="form-group">
                <label for="exampleInputEmail1">Select Sub Department</label>
                <select class="form-control" v-model="sub_department_selected_id" @click="fetchSubDepartments">
                  <option value="" disabled>Select option</option>
                  <option v-for="subd in subdepartemnts" :key="subd.id" :value="subd.id">{{ subd.title }}
                  </option>
                </select>
              </div>

          <div class="form-group">
            <label for="subjectSelect">Select Subject</label>
            <select id="subjectSelect"  @click="selectSubjectForMcqsQuestion" v-model="selected_subject" class="form-control">
              <option value="" disabled>Select an option</option>
              <option v-for="data in subjectRectrecord" :key="data.id" :value="data.id">{{ data.subject_name }}</option>
            </select>
          </div>

          <div class="form-group">
            <label for="questionInput">Question</label>
            <input id="questionInput" class="form-control" type="text" v-model="Question" required>
          </div>

          <div v-for="(option, index) in options" :key="index" class="form-group d-flex align-items-center">
            <input type="text" class="form-control mr-2" v-model="option.text" placeholder="Option" required />
            <input type="radio" :name="'is_correct'" :value="index" v-model="is_correct" class="mr-2" />
            <button type="button" class="btn btn-danger" @click="removeOption(index)">x</button>
          </div>

          <button type="button" class="btn btn-info mb-2" @click="addOption">+ Option</button>

          <div class="form-group">
            <label for="explanationInput">Explanation</label>
            <input id="explanationInput" class="form-control" type="text" v-model="Explanation">
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" @click="submitForm">Save</button>
        </div>
      </div>
    </div>
  </div>
  <!-- import subject mcqs file Modal -->
  <div class="modal fade" id="importmcqsfileModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">import mcqs file</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="exampleInputEmail1">select file</label>
            <input type="file" @change="handleFileUpload" />
            <small id="emailHelp" class="form-text text-muted">import mcqs throung the excel file.</small>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" @click="importData">Import</button>
        </div>
      </div>
    </div>
  </div>
  <!-- <p  class="totalDepartment">total subject {{ SubjectRecord.length }}</p> -->
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
        selected_subject: '',
        optionA: "",
        optionB: "",
        optionC: "",
        optionD: "",
        Question: "",
        currectOption: "",
        id: "",
      },
      departmantRercord: [],
      selected_department: '',
      subjectRectrecord: [],
      options: [],
      currectOption: '',
      dynamicOptions: [],
      subjectMcqsQuestions: [],
      file: null,
      sub_department_selected_id: '',
      Question: '',
      options: [{ text: '' }],
      is_correct: null,
      Explination: '',
      selected_subject: '',
      editmcqsQuestionOptions: [],
      subdepartemnts: [],
      selected_department_id:'',
      departmentRecordForSubdepartment:[],
      subjects:[],
      subject_id:''
    };
  },
  created() {
    this.fetchsubjectMcqsQuestions();
    this.selectDepartmentForSubdepartment();
  },

  methods: {
   
    addOption() {
      this.options.push({ text: '' });
    },
    removeOption(index) {
      this.options.splice(index, 1);
      if (this.correctOption === index) {
        this.correctOption = null;
      }
    },
    
    fetchsubjectMcqsQuestions() {
      const params = {
        department_id: this.selected_department_id,
        sub_department_id: this.sub_department_selected_id,
        subject_id:this.subject_id
      };

      axios.get('/fetch-subject-Mcqs', { params })
        .then(response => {
          this.subjectMcqsQuestions = response.data;
        })
        .catch(error => {
          console.error('Error:', error);
        });
    },
    fetchSubDepartmentsForSubjects() {
      if (this.selected_department_id) {
        axios.get(`/get-subDepartemnt-for-subject/${this.selected_department_id}`).then((response) => {
          this.subdepartemnts = response.data;
          this.fetchsubjectMcqsQuestions(); // Fetch subjects when sub-departments are loaded
        }).catch(error => {
          console.error('Error fetching subdepartments:', error);
        });
      } else {
        this.subdepartemnts = [];
        this.fetchsubjectMcqsQuestions(); // Fetch subjects without filtering by sub-department
      }
    },
    submitForm() {
      //  alert(this.selected_department_id);
      const requestData = {
       
        selected_department: this.selected_department_id,
        subject_id: this.selected_subject,
        sub_department_selected_id:this.sub_department_selected_id,
        Question: this.Question,
        options: this.options.map((option, index) => ({
          text: option.text,
          is_correct: index === this.is_correct
        })),
        explanation: this.Explanation
      };

      axios.post("/submit-subject-mcqs", requestData)
        .then(response => {
          console.log(response.data);
          Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: 'MCQs added successfully!',
            timer: 1000,
            showConfirmButton: false,
          });
          $('#addmcqsModel').modal('hide');
          this.fetchsubjectMcqsQuestions();
        })
        .catch(error => {
          console.error("Error submitting form:", error);
        });
    },

    fetchSubDepartments() {
      if (!this.selected_department_id) {
        console.error('No department selected');
        return;
      }
      axios.get(`/get-subDepartemnt-for-mcqs/${this.selected_department_id}`)
        .then((response) => {
          this.subdepartemnts = response.data;
        })
        .catch((error) => {
          console.error('Error fetching sub-departments:', error);
        });
    },
    fetchDepartmentForMcqs() {
      axios.get('/fetchDepartmentForMcqs')
        .then((response) => {
          this.departmantRercord = response.data;
        })
        .catch((error) => {
          console.error('Error fetching departments:', error);
        });
    },
    selectDepartmentForSubdepartment() {
      axios.get('/get-subDepartemnt-for-subdepartment').then((response) => {
        this.departmentRecordForSubdepartment = response.data.departmentRecordForSubdepartment;
      }).catch(error => {
        console.error('Error fetching departments:', error);
      });
    },
    selectSubjectForMcqsQuestion() {
      // alert(this.sub_department_selected_id);
      axios.get(`/select-SubjectFor-Mcqs-Question/${this.sub_department_selected_id}`).then((response) => {
        this.subjectRectrecord = response.data;
      });

    },
    EditSubjectMcqs(id) {
      axios.get(`/edit-subject-mcqs/${id}`,).then((response) => {
        this.editmcqsQuestionOptions = response.data;
        $('#editmcqsModel').modal('show');
      });
    },
    toggleCorrectOption(index) {
      this.editmcqsQuestionOptions.options.forEach((option, idx) => {
        if (idx === index) {
          option.is_correct = !option.is_correct;
        } else {
          option.is_correct = false; // Ensure only one checkbox can be checked at a time
        }
      });
    },

    updateSubjectMcqs() {
      axios.put(`/update-subject-mcqs/${this.editmcqsQuestionOptions.id}`, this.editmcqsQuestionOptions)
        .then(response => {

          $('#editmcqsModel').modal('hide');
          this.fetchsubjectMcqsQuestions();
        })
        .catch(error => {
          console.error('Error updating MCQs:', error);
        });
    },
    deleteSubjectMcqs(id) {
      // Show SweetAlert confirmation dialog
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
          // User confirmed deletion, make axios request
          axios.delete(`/delete-subject-mcqs/${id}`)
            .then(response => {
              this.fetchsubjectMcqsQuestions();
              console.log(response.data);
              Swal.fire({
                icon: 'success',
                title: 'Deleted!',
                text: 'MCQ has been deleted.',
                timer: 1000,
                showConfirmButton: false,
              });
               // Refresh the data after deletion
            })
            .catch(error => {
              console.error("Error deleting MCQ:", error);
              // Handle errors and show appropriate messages to the user
            });
        }
      });
    },
    handleFileUpload(event) {
      this.file = event.target.files[0];
    },
    importData() {
      const formData = new FormData();
      formData.append('excel_file', this.file);

      axios.post('/import-subject-mcqs', formData)
        .then(response => {
          console.log(response.data);
          // Handle the success and redirection here
          // You might want to navigate to a different page or handle it in some way
        })
        .catch(error => {
          console.error(error);
        });
    },
    fetchSubjectForMcqsQuestion(){
      axios.get(`/get-subject-for-mcqs-questions/${this.sub_department_selected_id}`)
      .then((response) => {
        this.subjects = response.data;
      });

    }
  }
}
</script>

<style scoped>
.main-content {
    margin-left: 16.6667%; /* 2/12 of the grid */
    padding: 20px;
}

.custom-mergin {
  margin-left: 40px;
}

.customTable {
  width: 1090px;
}

.correct-option {
  background-color: blue;
  color: white;
  /* To ensure text is readable on blue background */
}
</style>