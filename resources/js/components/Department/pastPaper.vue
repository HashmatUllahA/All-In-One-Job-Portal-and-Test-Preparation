<template>
  <div>
    <div class="row">
      <div class="col-2 bg-info">
        <sidebar-component></sidebar-component>
      </div>
      <div class="col-10">
        <div class="mainbody ">

          <div class="custom-header text-center">
            <h5>Department: {{ departmentName[0] }}</h5>
          </div>
          <div>
            <button class="btn btn-info" data-toggle="modal" data-target="#addPastPaperModel" type="button">Add Paper</button>
          </div>
          <div class="col-2">
            <!-- <div class="mt-2 border " v-for="paper in papers" :key="paper.id">
        <h4 class="ml-2">{{ paper.title }}</h4>
        <P class="text-center">{{ paper.test_center }}</P>
        <P class="text-center">{{ paper.test_date }}</P>
        
      </div> -->
          </div>
          <div class="mt-3 ml-3  row">
            <div class=" col-3 mb-2  p-0" v-for="paper in papers" :key="paper.id">
              <div class="mx-1  shadow-lg  p-4">

                <div @click="goToDepartment(paper.id)">
                  <div class="dropdown">
                    <button class="btn dropdown-toggle" type="button" data-toggle="dropdown">
                      <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-right"> <!-- added 'dropdown-menu-right' class -->
                      <!-- <li><button @click="editDepartment(paper.id)" class="w-100 border-0">Edit</button></li> -->
                      <li> <button class="w-100 border-0"><a :href="paper.file_path" target="_blank">View Paper</a></button></li>
                      <li><button class="w-100 border-0" @click="deletePastPaper(paper.id)">Delete</button></li>
                    </ul>
                  </div>
                  <h5 class="text-center">{{ paper.title }}</h5>
                  <p class="text-center">{{ paper.test_center }}</p>
                  <p class="text-center">{{ paper.test_date }}</p>
                </div>
              </div>
            </div>

          </div>
        </div>
        <!--add paper Modal -->
        <div class="modal fade" id="addPastPaperModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
          aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Add Past Paper</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div>
                  <label for="optionA">Select Sub department</label>
                  <select id="subjectSelect"  v-model="selected_sub_department_id"  class="form-control">
                    <option value="" disabled>Select Subd epartment</option>
                    <option v-for="subd in Subdepartments" :key="subd.id" :value="subd.id">{{ subd.title }}</option>
                  </select>
                </div>
                <div>
                  <label for="optionA">Test Center</label>
                  <input class="custom-mergin form-control" type="text" v-model="testCenter" required>
                </div>
                <div>
                  <label for="optionA">Paper Title:</label>
                  <input class="custom-mergin form-control" type="text" v-model="paperTitle" required>
                </div>
                <div class="form-group">
                  <label for="optionB">Paper Date:</label>
                  <input class="custom-mergin form-control" type="date" v-model="paperDate" required>
                </div>
                <div class="form-group">
                  <label for="optionB">Select Paper:</label>
                  <input type="file" class="form-control-file" @change="fileUpload($event)" />

                </div>
              </div>

              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-info" @click="SubmitPastPaper">Save</button>
              </div>
            </div>
          </div>
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
      DepartmentId: this.$route.params.DepartmentId,
      departmentName: '',
      testCenter: '',
      title: '',
      paperDate: '',
      file: '',
      papers: [],
      Subdepartments:[],
      selected_sub_department_id:''
    }
  },
  created() {
    this.getDepartmentName();
    this.FetchSudepartment();
    this.getpastPaper();
  },
  methods: {
    FetchSudepartment() {
      axios.get('/get-subdepartment-for-PastPaper/' + this.DepartmentId).then((response) => {
        this.Subdepartments = response.data;
      })
    },
    getpastPaper() {
      axios.get('/get-past-paper/' + this.DepartmentId).then((response) => {
        this.papers = response.data.pastpapers;
      })
    },
    getDepartmentName() {
      axios.get('/get-department-name/' + this.DepartmentId).then((response) => {
        this.departmentName = response.data;
      }).catch(error => {
        console.log('get error:', error);
      });
    },
    fileUpload(event) {
      let files = event.target.files;
      if (files.length) {
        this.file = files[0];
      }
    },

    SubmitPastPaper() {
      let formData = new FormData();
      formData.append('paperTitle', this.paperTitle);
      formData.append('paperDate', this.paperDate);
      formData.append('testCenter', this.testCenter);
      formData.append('file', this.file);
      formData.append('selected_sub_department_id', this.selected_sub_department_id);


      axios.post(`/upload-past-paper/${this.DepartmentId}`, formData)
        .then(response => {
          console.log('Paper uploaded successfully');
          this.getpastPaper();
          $('#addPastPaperModel').modal('hide');
        })
        .catch(error => {
          console.error('Error uploading paper:', error);
        });
    },
    deletePastPaper(id) {
            if (confirm("Are you sure you want to delete this past paper?")) {
                axios.delete(`/delete-past-paper/${id}`).then((response) => {
                    this.papers = this.papers.filter(paper => paper.id !== id);
                    alert(response.data.message);
                }).catch((error) => {
                    console.error("There was an error deleting the past paper:", error);
                });
            }
        },
    
  }


};
</script>
<style scoped>
.custom-header h5 {

  background: #426085;
  color: white !important;
  padding: 10px 10px;
}

.custom-header {
  margin-top: 10px;
}

.mainbody {
  /* position: fixed; */
  left: 279px;
  box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;
}

.btn-info {
  color: white;
  background: #426085;
}

/* .paper-container {
    gap: 10px;
} */
.paperDiv {
  box-shadow: rgba(50, 50, 93, 0.25) 0px 6px 12px -2px, rgba(0, 0, 0, 0.3) 0px 3px 7px -3px;
  height: 150px;
  text-align: center;
  position: relative;


}

.paperDiv:hover h5 {
  color: rgb(247, 246, 246);
}

.paperDiv:hover {
  background: #426085;
}

.paperDiv h5 {
  padding: 10px;


}

.dropdown {
  position: absolute;
  /* Position the dropdown button absolutely */
  top: 0;
  right: 0;
  /* Align the dropdown button to the top right corner */
}

.dropdown :hover {
  background: white !important;
  color: black;
}
</style>