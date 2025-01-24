<template>
  <div>
    <div class="row no-gutters">
      <div class="col-2 " >
        <sidebar-component></sidebar-component>
      </div>

      <div class="col-10 main-content">
        <div>
          <!-- Button trigger modal -->
          <button type="button" class="btn btn-primary mt-2 custombtn" data-toggle="modal"
            data-target="#exampleModalCenter">
            + Department
          </button>
        </div>
        <!-- <p  class="totalDepartment">total department {{ DepartmentData.length }}</p> -->
        <div class="mt-3 ml-3 department-container row">
          <div class="departmentDiv col-3" v-for="d in DepartmentData" :key="d.id">
            <div @click="goToDepartment(d.id)">
              <div class="dropdown">
                <button class="btn dropdown-toggle" type="button" data-toggle="dropdown">
                  <span class="caret"></span>
                </button>
                <ul class="dropdown-menu dropdown-menu-right"> <!-- added 'dropdown-menu-right' class -->
                  <!-- <li><button data-toggle="modal" @click="editDepartment(data.id)" data-target="#editDepartment" class="w-100 border-0">Edit</button></li> -->
                  <li><button @click="editDepartment(d.id)" class="w-100 border-0">Edit</button></li>
                  <li><button class="w-100 deletebtn" @click="deleteDepartment(d.id)">Delete</button></li>
                </ul>
              </div>

              <h5>{{ d.title }}</h5>
            </div>
          </div>
        </div>







      </div>
      <!-- add department Modal -->
      <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLongTitle">Add Department</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">

              <div class="form-group">
                <label for="exampleInputEmail1">Title</label>
                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                  v-model="fromData.title" placeholder="Enter department here">
              </div>

              <div v-if="errors.title" class="text-danger">
                <p>{{ errors.title[0] }}</p>
              </div>
            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="button" @click="addDepartment" class="btn btn-primary">Save</button>
            </div>

          </div>
        </div>
      </div>
      <!--start  Edit Modal ////////////////////////////////////////////////////////////////////////-->
      <div class="modal fade" id="editDepartment" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLongTitle">Edit Department</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="form-group">
                <input type="text" class="form-control" v-model="fromData.title">
              </div>

              <div v-if="errors.title" class="text-danger">
                <p>{{ errors.title[0] }}</p>
              </div>
            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="button" @click="updateDepartment" class="btn btn-primary">Update</button>
            </div>

          </div>
        </div>
      </div>
      <!--end  Edit Modal ////////////////////////////////////////////////////////////////////////-->
    </div>
  </div>
</template>

<script>
import SidebarComponent from '../components/SidebarComponent.vue';
import axios from 'axios';
import Swal from 'sweetalert2';
import { routeLocationKey } from 'vue-router';

export default {
  components: {
    SidebarComponent,
  },
  data() {
    return {
      fromData: {
        title: '',
      },
      errors: {},
      DepartmentData: [],
      edit_department_id: null,
    };
  },
  created() {
    this.fetchDepartments();
  },
  methods: {
    goToDepartment(id) {
      this.$router.push({ name: 'DepartmentRecord', params: { id: id } });
    },
    deleteDepartment(id) {
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
          axios.delete(`/department/${id}`)
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
              this.fetchDepartments();
            })
            .catch(error => {
              console.error('There was an error!', error.response);
              // Handle error
            });
        }
      });
    },
    updateDepartment() {
      // alert('update depatment');
      axios.put(`/department/${this.fromData.id}`, { title: this.fromData.title })
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
          this.fromData.title = '';

          $('#editDepartment').modal('hide');

          this.fetchDepartments();
        })
        .catch(error => {
          console.error('There was an error!', error.response);

          if (error.response.status === 422) {
            this.errors = error.response.data.errors || { title: [error.response.data.message] };
            console.log('Error Message:', this.errors.title[0]);
          }
        });
    },

    editDepartment(id) {
      // alert('edit department')
      // Find the department with the specified ID
      const department = this.DepartmentData.find(data => data.id === id);

      // Set the data to be edited
      this.fromData.id = id;
      this.fromData.title = department ? department.title : '';

      // Open the modal
      $('#editDepartment').modal('show');
    },
    addDepartment() {
      axios.post('/department', { title: this.fromData.title })
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
          this.fetchDepartments();
        })
        .catch(error => {
          console.error('There was an error!', error.response);

          if (error.response.status === 422) {
            this.errors = error.response.data.errors || { title: [error.response.data.message] };
            console.log('Error Message:', this.errors.title[0]); // Add this line for logging
          }
        });
    },

    fetchDepartments() {
      axios.get('/getDepartmentData').then((response) => {
        this.DepartmentData = response.data;
      });
    },
  },



}

</script>

<style scoped>
.main-content {
    margin-left: 16.6667%; /* 2/12 of the grid */
    padding: 20px;
}
.deletebtn {
  width: 100%;
  border: 0px;
  box-shadow: rgba(50, 50, 93, 0.25) 0px 6px 12px -2px, rgba(0, 0, 0, 0.3) 0px 3px 7px -3px;
}

.dropdown :hover {
  background: white !important;
}

.dropdown {
  position: absolute;
  /* Position the dropdown button absolutely */
  top: 0;
  right: 0;
  /* Align the dropdown button to the top right corner */
}

.departmentDiv {
  box-shadow: rgba(50, 50, 93, 0.25) 0px 6px 12px -2px, rgba(0, 0, 0, 0.3) 0px 3px 7px -3px;
  text-align: center;

}

.departmentDiv:hover h5 {
  color: white;
}

.departmentDiv h5 {
  padding: 52px;

}

.department-container :hover {
  background-color: #426085;
}

.department-container {
  gap: 10px;
  display: flex;
  justify-content: start;
  grid-template-columns: 1fr 1fr 1fr;
  flex-wrap: wrap;
  flex-direction: row;
}



.custombtn {
  background: #426085 !important;
  margin-left: 15px;
  margin-top: 29px !important;
}

.customtable {
  box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;
  margin-left: 10px;
  /* margin-right: 10px; */
}</style>
