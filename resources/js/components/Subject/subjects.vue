<template>
  <div class="row">
    <div class="mainbody col-2">
      <sidebar-component></sidebar-component>
    </div>

    <div class="col-10">
      <!-- Button trigger modal -->
      <button type="button" class="btn btn-primary mt-2" data-toggle="modal" data-target="#exampleModalCenter">
        Add Subject
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
            <select class="form-control" @change="fetchSubject" v-model="sub_department_selected_id">
              <option value="" disabled>Select option</option>
              <option v-for="subd in subdepartemnts" :key="subd.id" :value="subd.id">{{ subd.title }}</option>
            </select>
          </div>
        </div>

        <div class="col-3 text-center" style="margin-top: 33px;">
          <h4 >Totla Subject: {{ subjectRecord.length }}</h4>
        </div>
      </div>



      <table style=" margin-top: 62px !important;" class="w-100 mt-3 ">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Subject name</th>
            <th scope="col">Department name</th>
            <th scope="col">Sub Department</th>
            <th scope="col">Mcqs Question</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(data, index) in subjectRecord" :key="data.id">
            <td>{{index + 1}}</td>
            <td >{{ data.subject_name }}</td>
            <td v-if="data.department && data.department.title">{{ data.department.title }}</td>
            
            <td v-else>null</td>
            <td v-if="data.subdepartment && data.subdepartment.title">{{ data.subdepartment.title }}</td>
            <td v-else>null</td>
            
            <td>
              <button data-toggle="modal" @click="editSubject(data.id)" data-target="#editSubject"
                class="btn btn-info mr-3">Edit</button>

              <button class="btn btn-danger" @click="deletesubject(data.id)">Delete</button>
            </td>
          </tr>
        </tbody>
      </table>


      <!--start  Edit subject  Modal ////////////////////////////////////////////////////////////////////////-->
      <div class="modal fade" id="editSubject" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLongTitle">Edit Subject</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">

              <div class="form-group">
                <label for="exampleInputEmail1">Subject Name</label>
                <input type="text" class="form-control" v-model="subject_name">
              </div>

              <div v-if="errors.subject_name" class="text-danger">
                <p>{{ errors.subject_name[0] }}</p>
              </div>
            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="button" @click="updatesubject" class="btn btn-primary">Update</button>
            </div>

          </div>
        </div>
      </div>
      <!--end  Edit Modal ////////////////////////////////////////////////////////////////////////-->

      <!-- Modal -->
      <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLongTitle">Add Subject</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="form-group">
                <label for="departmentSelect">Select Department</label>
                <select id="departmentSelect" @change="fetchSubDepartmentsForSubjects" v-model="selected_department_id"
                  class="form-control">
                  <option value="" disabled>Select an option</option>
                  <option v-for="data in departmentRecordForSubdepartment" :key="data.id" :value="data.id">{{ data.title
                  }}</option>
                </select>
              </div>


              <div class="form-group">
                <label for="exampleInputEmail1">Select Sub Department</label>
                <select class="form-control" v-model="sub_departemnt_selected_id">
                  <option value="" disabled>Select option</option>
                  <option v-for="subd in subdepartemnts" :key="subd.id" :value="subd.id">{{ subd.title }}</option>
                </select>
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Subject name</label>
                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                  v-model="subject_name" placeholder="Enter Subject here">
              </div>


              <!-- <div v-if="errors.subject_name" class="text-danger">
                  <p>{{ errors.subject_name[0] }}</p>
                </div> -->
            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="button" @click="addSubject" class="btn btn-primary">Save</button>
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

export default {
  components: {
    SidebarComponent,
  },
  data() {
    return {
      title: null,
      subject_name: '',

      errors: {},
      DepartmentData: [],
      subjectRecord: [],
      edit_department_id: null,
      selectedDepartmentId: '', // Use this for selected department
      subdepartemnts: [],
      sub_departemnt_selected_id: '',
      subjectRectrecord: [],
      departmentRecordForSubdepartment: [],
      selected_department_id: '', // Use this for storing department_id
    };
  },
  created() {
    this.fetchSubject();
    this.selectDepartmentForSubdepartment();
  },
  methods: {
  
    fetchDepartmentForMcqs() {
      axios.get('/fetchDepartmentForMcqs')
        .then((response) => {
          this.departmantRercord = response.data;
        })
        .catch((error) => {
          console.error('Error fetching departments:', error);
        });
    },
    selectSubjectForMcqsQuestion() {
      // alert(this.sub_department_selected_id);
      axios.get(`/select-SubjectFor-Mcqs-Question/${this.sub_department_selected_id}`).then((response) => {
        this.subjectRectrecord = response.data;
      });

    },
    addSubject() {
      axios.post('/addsubject', {
        subject_name: this.subject_name,
        Department_id: this.selected_department_id,
        sub_department_id: this.sub_departemnt_selected_id
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
          $('#exampleModalCenter').modal('hide');
          this.fetchSubject();
        })
        .catch(error => {
          console.error('There was an error!', error.response);

          if (error.response.status === 422) {
            this.errors = error.response.data.errors || { subject_name: [error.response.data.message] };
            console.log('Error Message:', this.errors.subject_name[0]); // Add this line for logging
          }
        });
    },




    deletesubject(id) {
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
          axios.delete(`/deletesubject/${id}`)
            .then(response => {
              console.log(response.data);
              Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: 'Department deleted successfully!',
                timer: 1000,
                showConfirmButton: false,
              });

              // Fetch updated department data
              this.fetchSubject();
            })
            .catch(error => {
              console.error('There was an error!', error.response);
              // Handle error
            });
        }
      });
    },
    
    updatesubject() {
      axios.put(`/updateSubject/${this.fromData.id}`, { subject_name: this.fromData.subject_name })
        .then(response => {
          console.log(response.data);
          Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: 'Department updated successfully!',
            timer: 1000,
            showConfirmButton: false,
          });

          this.fromData.id = null;
          this.fromData.subject_name = '';

          $('#editSubject').modal('hide');

          this.fetchSubject();
        })
        .catch(error => {
          console.error('There was an error!', error.response);

          if (error.response.status === 422) {
            this.errors = error.response.data.errors || { subject_name: [error.response.data.message] };
            console.log('Error Message:', this.errors.subject_name[0]);
          }
        });
    },

    editSubject(id) {
      // Find the department with the specified ID
      const subject = this.subjectRecord.find(data => data.id === id);

      // Set the data to be edited
      // this.fromData.id = id;
      this.subject_name = subject ? subject.subject_name : '';

      // Open the modal
      $('#editSubject').modal('show');
    },

    selectDepartmentForSubdepartment() {
      axios.get('/get-subDepartemnt-for-subdepartment').then((response) => {
        this.departmentRecordForSubdepartment = response.data.departmentRecordForSubdepartment;
      }).catch(error => {
        console.error('Error fetching departments:', error);
      });
    },
    fetchSubDepartmentsForSubjects() {
      if (this.selected_department_id) {
        axios.get(`/get-subDepartemnt-for-subject/${this.selected_department_id}`).then((response) => {
          this.subdepartemnts = response.data;
          this.fetchSubject(); // Fetch subjects when sub-departments are loaded
        }).catch(error => {
          console.error('Error fetching subdepartments:', error);
        });
      } else {
        this.subdepartemnts = [];
        this.fetchSubject(); // Fetch subjects without filtering by sub-department
      }
    },
    fetchSubject() {
      const params = {
        department_id: this.selected_department_id,
        sub_department_id: this.sub_department_selected_id
      };

      axios.get('/getSubject', { params }).then((response) => {
        this.subjectRecord = response.data;
      }).catch(error => {
        console.error('Error fetching subject records:', error);
      });
    }

  },



}

</script>
  
<style scoped>
.totalDepartment {
  padding-left: 906px;
  margin-right: 0px !important;
  margin-top: -35px;
}

.maincontainer {
  margin-left: 261px;
  margin-top: -2px;
}

.customTable {
  width: 1090px;
}</style>
  