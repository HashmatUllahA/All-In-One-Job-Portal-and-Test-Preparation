<template>
  <div>
    <div class="row">
      <div class="col-2 " style="background: #839cbb;">
        <sidebar-component></sidebar-component>
      </div>

      <div class="col-10">
        <div>
          <h5>Department: {{ departmentName[0] }}</h5>
        </div>
        <div>
          <!-- <button class="btn btn-info ml-2" @click="addSubDepartment">+ Sub Department</button> -->
          <button type="button" class="btn btn-info ml-2" data-toggle="modal"
            data-target="#addSubDepartmentModel">
            + Sub Department
          </button>
          <button class="btn btn-info" @click="goToPastPaper(DepartmentId)">Past Papers</button>
          <button class="btn btn-info ml-2" @click="goToPastPaper(DepartmentId)">Books</button>
          
        </div>

        <div class="col-lg-12 d-flex">

          <div class="ml-3 ">
            <div class="d-flex">
              <div class="form-group ">
                <label for="exampleInputEmail1">Search Mcqs by Question</label>
                <input type="text" class="form-control" v-model="serchQuestion" placeholder="Search Question...">
              </div>
              <div v-if="serchQuestion !== ''">
                <buttion style="margin-top: 32px;" class="btn btn-info ml-2 mr-2" @click="serchQuestions">Search</buttion>
              </div>
            </div>
          </div>

          <div class="DepartmentSubject ml-2">
            <label for="exampleInputEmail1">Select Subject.</label>
            <br>
            <select class="form-control" v-model="selectedSubject" @click="getDepartmentSubject"
              @change="fetchMcqsBySubject" :disabled="!DepartmentId">
              <option value="" disabled>Select subject..</option>
              <option value="all">all Mcqs</option>
              <option v-for="subject in DepartmentSubject" :key="subject.id" :value="subject.subject_name">{{
                subject.subject_name }}</option>
            </select>
          </div>
          <!-- <div class="ml-2 ImportendMcqs">
            <button style="margin-top: 34px;" class="btn btn-info">Importend MCQS ??</button>
          </div> -->
          <div class="ml-2 float-right" style="padding-top: 39px;">
            <b>Total Mcqs: {{ SubjectMcqs.length }}</b>
          </div>
        </div>




        <div class="mcqsContainer ml-2">
          <div class="row">
            <div class="col-lg-8 border ">
              <div v-if="SubjectMcqs.length > 0" class="mt-2">
                <div class="mcqs-container mt-4">
                  <div v-for="(data, index) in SubjectMcqs" :key="data.id" class="card mb-3">
                    <div class="card-body">
                      <h5 class="card-title">Question {{ index + 1 }}</h5>
                      <p class="card-text">{{ data.question }}</p>
                      <ul>
                        <li v-for="(option, optIndex) in data.options" :key="option.id" class="list-group-item"
                          :class="{ 'bg-primary text-white': option.is_correct }">
                          {{ option.option }}
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>

              </div>
              <div v-else-if="noMcqs" class="col-lg-8 border">
                <span>NO MCQS</span>
              </div>
              <div v-else class="col-lg-8 ">
                <span class="border-0"> Select Subject</span>
              </div>
            </div>

            <div class="col-lg-3 border ml-1 pl-0 pr-0">
              <div class="SyllabusContainer w-100">
                <h5>Department Syllabus</h5>
                <table class="">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Description</th>
                      <th>Marks</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="(Syllabus, index) in DepartmentSyllabus" :key="Syllabus.id">
                      <td>{{ index + 1 }}</td>
                      <td>{{ Syllabus.description }}</td>
                      <td>{{ Syllabus.marks }}</td>
                    </tr>
                  </tbody>
                </table>

              </div>
              <hr>
              <div class="SyllabusContainer w-100">
                <h5>Sub Departments</h5>
                <div v-for="(subd, index) in subdepartemnts" :key="subd.id">
                  <span>{{ index + 1 }}.</span>
                  <span>{{subd.title }}: </span>
                  <span>{{subd.bps_skill }}</span>
                </div>

              </div>
            </div>

          </div>
        </div>

      </div>


    </div>
  </div>
    <!-- add department Modal -->
    <div class="modal fade" id="addSubDepartmentModel" tabindex="-1" role="dialog"
        aria-labelledby="addSubDepartmentModelTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLongTitle">Add Sub Department</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">

              <div class="form-group">
                <label for="exampleInputEmail1">Title</label>
                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                  v-model="title" placeholder="Enter sub department here">
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">BPS Skill</label>
                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                  v-model="bpsSkill" placeholder="Enter BPS Skill">
              </div>
              <!-- <div v-if="errors.title" class="text-danger">
                <p>{{ errors.title[0] }}</p>
              </div> -->
            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="button" @click="addSubDepartment" class="btn btn-primary">Save</button>
            </div>

          </div>
        </div>
      </div>
</template>

<script>
import SidebarComponent from '../SidebarComponent.vue';
import axios from 'axios';
import Swal from 'sweetalert2';
import { routeLocationKey } from 'vue-router';

export default {
  components: {
    SidebarComponent,
  },

  data() {
    return {
      DepartmentId: this.$route.params.id,
      departmentName: '',
      DepartmentSubject: [],
      selectedSubject: '',
      SubjectMcqs: [],
      noMcqs: false,
      departmenAllMcqs: '',
      DepartmentSyllabus: [],
      serchQuestion: '',
      title:'',
      bpsSkill:'',
      subdepartemnts:[],
    };
  },
  created() {
    this.getDepartmentName();
    this.fetchDepartmentSyllabus();
    this.fetchSubDepartment();
  },
  methods: {
    fetchSubDepartment(){
      axios.get('/get-sub-department/' + this.DepartmentId).then((response) => {
        this.subdepartemnts = response.data;
      });
    },
    addSubDepartment() {
    axios.post('/save-sub-department', {
        title: this.title,
        bps_skill: this.bpsSkill,
        department_id: this.DepartmentId
    })
    .then(response => {
        console.log(response.data);
        Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: 'Department added successfully!',
            timer: 1000,
            showConfirmButton: false,
        });
        this.fetchSubDepartment();
        $('#addSubDepartmentModel').modal('hide');
        
    })
    .catch(error => {
        console.error('There was an error!', error.response);
    });
},

    fetchDepartmentSyllabus() {
      // alert('get-department-Syllabus');
      axios.get('/get-department-Syllabus/' + this.$route.params.id).then((response) => {
        this.DepartmentSyllabus = response.data;
      });
    },
    getDepartmentName() {
      axios.get('/get-department-name/' + this.DepartmentId).then((response) => {
        this.departmentName = response.data;
      });
    },
    getDepartmentSubject() {
      // alert('yes');
      axios.get('/fetch-department-subject/' + this.DepartmentId).then((response) => {
        this.DepartmentSubject = response.data;
      });
    },
    serchQuestions() {
      // alert(this.selectedSubject);
      axios.get('/search-mcqs-question/' + this.serchQuestion).then((response) => {
        this.SubjectMcqs = response.data;
        if (response.data.length === 0) {
          this.noMcqs = true;
        } else {
          this.noMcqs = false;
        }
      }).catch((error) => {
        console.error('Error fetching all MCQs:', error);
      });
    },
    fetchMcqsBySubject() {
      // alert(this.selectedSubject);
      if (this.selectedSubject === 'all') {
        axios.get('/fetch-all-department-mcqs/' + this.DepartmentId).then((response) => {
          this.SubjectMcqs = response.data;
          if (response.data.length === 0) {
            this.noMcqs = true;
          } else {
            this.noMcqs = false;
          }
        }).catch((error) => {
          console.error('Error fetching all MCQs:', error);
        });
      }

      else {
        axios.get('/fetch-mcqs-by-subject/' + this.selectedSubject + '/' + this.DepartmentId).then((response) => {
          this.SubjectMcqs = response.data;
          if (response.data.length === 0) {
            this.noMcqs = true;
          } else {
            this.noMcqs = false;
          }
        }).catch((error) => {
          console.error('Error fetching MCQs:', error);
        });
      }
    },
    goToPastPaper(DepartmentId) {
      this.$router.push({ name: 'pastPaper', params: { DepartmentId } });
    },

  },


}
</script>

<style scoped>
.btn {
  background: #426085;
  color: white;
}

.mainbody {
  width: 1068px;
  /* position: fixed; */
  /* top: 54px; */
  left: 279px;
}

/* .DepartmentSubject{
  margin-right: 51px;
    float: right;
    width: 180px !important;
} */
.DepartmentSubject select {
  width: 146px;
}

.custom-header h5 {
  margin: 5px;
  display: grid;
  top: 10px;
  width: 100%;
  background: #426085;
  color: white !important;
  padding: 10px 10px;
}

.custom-header {
  margin-top: 10px;
}

/* .mcqsContainer{
  overflow: scroll;
    width: 1080px !important;
    height: 70vh;
} */
.SyllabusContainer {
  width: 300px;
  height: fit-content;
}

.SyllabusContainer h5 {
  margin: 3px;
  background: #426085;
  padding: 2px 2px 2px 9px;
  color: white;
}

.correctOption span {
  border-radius: 6px;
  padding: 5px;
  color: white;
  background: #426085;
}</style>