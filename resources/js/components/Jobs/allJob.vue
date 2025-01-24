<template>
    <div class="row">
      <div class="mainbody col-2">
        <sidebar-component></sidebar-component>
      </div>
      <div class="col-10">
         <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary mt-2" data-toggle="modal" data-target="#addJobModalCenter">
      Add job
    </button>
    <p  class="totalDepartment">Total Jobs: {{ jobs.length }}</p>
  
  
  
    <!-- <table style=" margin-top: 62px !important;" class="w-100 mt-3 "> -->
      <table class="table table-striped table-bordered mt-4">
      <thead>
        <tr class="border border-bold">
          <th scope="col">#</th>
          <th scope="col">Title</th>
          <th scope="col">Province</th>
          <th scope="col">Apply Website</th>
          <th scope="col">zone</th>
          <th scope="col">Start Date</th>
          <th scope="col">Last Date</th>
          <th scope="col">Advertisement</th>
          <th scope="col">apply On</th>
          
          <th scope="col " style="text-align: center;">Action</th>
        </tr>
      </thead>
      <tbody>
        <tr class="border mt-3" v-for="(j , index) in jobs" :key="j.id">
          <td>{{index + 1 }}</td>
          <td>{{ j.job_title }}</td>
          <td style="text-align: center;">{{ j.province }}</td>
          <td style="text-align: center;" >{{ j.apply_on_website }}</td>
          <td style="text-align: center;">{{ j.zone }}</td>
          <td >{{ j.start_date }}</td>
          <td >{{ j.last_Date }}</td>
          <td>
            <!-- <button @click="downloadPDF(j.file_path, j.advertisement_file)" class="btn btn-primary">Download PDF</button> -->
            <td><a :href="j.file_path" target="_blank">View Ad</a></td>
          </td>
          <td style="text-align: center;"><a :href="j.apply_url" target="_blank">Visit</a></td>
          <td>
            <button j-toggle="modal" @click="editJob(j.id)" j-target="#editJob"
              class="btn btn-info mr-3">Edit</button>
  
            <button class="btn btn-danger" @click="deleteJob(j.id)">Delete</button>
          </td>
        </tr>
      </tbody>
    </table>
  
  
    <!--start  Edit subject  Modal ////////////////////////////////////////////////////////////////////////-->
    <div class="modal fade" id="editJob" tabindex="-1" role="dialog" aria-labelledby="addJobModalCenterTitle"
      aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Update Job</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
  
            <div class="form-group">
              <label for="exampleInputEmail1">Job Title</label>
              <input type="text" class="form-control" v-model="editRecord.job_title" >
            </div>
           
            <div class="form-group">
              <label for="province">Province</label>
              <input type="text" v-model="editRecord.province" class="form-control" id="province" placeholder="Enter province here">
            </div>
            <div class="form-group">
              <label for="zone">Zone</label>
              <input type="text" v-model="editRecord.zone" class="form-control" id="zone" placeholder="Enter zone here">
            </div>
            <div class="form-group">
              <label for="applyWebsite">Apply Website</label>
              <input type="text" v-model="editRecord.apply_on_website" class="form-control" id="applyWebsite" placeholder="Enter apply website here">
            </div>
            <div class="form-group">
              <label for="applyWebsite">Website Link</label>
              <input type="text" v-model="editRecord.apply_url" class="form-control" id="applyWebsite" placeholder="Enter apply website here">
            </div>
           
            <div class="form-group">
              <label for="startDate">Start Date</label>
              <input type="date" v-model="editRecord.start_date" class="form-control" id="startDate" placeholder="Enter start date here">
            </div>
            <div class="form-group">
              <label for="lastDate">End Date</label>
              <input type="date" v-model="editRecord.last_Date" class="form-control" id="lastDate" placeholder="Enter end date here">
            </div>
            <div class="form-group">
              <label for="advertisementFile">Advertisement File</label>
              <input type="file" class="form-control-file" @change="AdvertisementFileUpload" />
            </div>
          </div>
  
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" @click="updateJob" class="btn btn-primary">Update</button>
          </div>
  
        </div>
      </div>
    </div>
    <!--end  Edit Modal ////////////////////////////////////////////////////////////////////////-->
  
    <!-- Modal -->
    <div class="modal fade" id="addJobModalCenter" tabindex="-1" role="dialog" aria-labelledby="addJobModalCenterTitle"
      aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Add Job</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label for="jobTitle">Job Title</label>
              <input type="email" v-model="job_title" class="form-control" id="jobTitle" placeholder="Enter department here">
            </div>
            <div class="form-group">
              <label for="province">Province</label>
              <input type="text" v-model="province" class="form-control" id="province" placeholder="Enter province here">
            </div>
            <div class="form-group">
              <label for="zone">Zone</label>
              <input type="text" v-model="zone" class="form-control" id="zone" placeholder="Enter zone here">
            </div>
            <div class="form-group">
              <label for="applyWebsite">Apply Website</label>
              <input type="text" v-model="apply_on_website" class="form-control" id="applyWebsite" placeholder="Enter apply website here">
            </div>
            <div class="form-group">
              <label for="applyWebsite">Website Link</label>
              <input type="text" v-model="apply_link" class="form-control" id="applyWebsite" placeholder="Enter apply website here">
            </div>
            <div class="form-group">
              <label for="startDate">Start Date</label>
              <input type="date" v-model="start_date" class="form-control" id="startDate" placeholder="Enter start date here">
            </div>
            <div class="form-group">
              <label for="lastDate">End Date</label>
              <input type="date" v-model="last_Date" class="form-control" id="lastDate" placeholder="Enter end date here">
            </div>
            <div class="form-group">
              <label for="advertisementFile">Advertisement File</label>
              <input type="file" class="form-control-file" @change="updateAdvertisementFile" />
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" @click="addJob" class="btn btn-primary">Save</button>
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
        job_title: '',
      province: '',
      zone: '',
      apply_on_website: '',
      start_date: '',
      last_Date: '',
      apply_link:'',
      AdvertisementFile: null,
      editRecord:[],
        // old RECORD
        title: null,
        fromData: {
          subject_name: '',
          Department_id: '',
  
        },
        errors: {},
        DepartmentData: [],
        jobs: [],
        edit_department_id: null,
      };
    },
    created() {
      this.fetchJobs();
    },
    methods: {

        AdvertisementFileUpload(event) {
            let files = event.target.files;
            if (files.length) {
                this.AdvertisementFile = files[0];
            }
        },
       
       
      addJob() {
        const formData = new FormData();
      formData.append('jobTitle', this.job_title);
      formData.append('province', this.province);
      formData.append('applyWebsite', this.apply_on_website);
      formData.append('zone', this.zone);
      formData.append('start_date', this.start_date);
      formData.append('last_Date', this.last_Date);
      formData.append('apply_link', this.apply_link);
      if (this.AdvertisementFile) {
        formData.append('File', this.AdvertisementFile);
      }
        axios.post('/submit-job',formData, {
          jobTitle: this.job_title,
          province: this.province,
          applyWebsite: this.apply_on_website,
          zone: this.zone,
          start_date: this.start_date,
          last_Date: this.last_Date,
          apply_link: this.apply_link,
          File: this.AdvertisementFile,
        })
          .then(response => {
            console.log(response.data);
            Swal.fire({
              icon: 'success',
              title: 'Success!',
              text: 'Job added successfully!',
              timer: 1000,
             
            });
            $('#addJobModalCenter').modal('hide');
            this.fetchJobs();
          })
          .catch(error => {
            console.error('There was an error!', error.response);
  
          
          });
      },
      downloadPDF(filePath, fileName) {
      // Construct the download URL
      const url = `/download-pdf/${encodeURIComponent(filePath)}`;

      // Create a link element
      const link = document.createElement('a');
      link.href = url;

      // Set the download attribute to the file name
      link.setAttribute('download', fileName);

      // Append the link to the body and click it to trigger the download
      document.body.appendChild(link);
      link.click();

      // Remove the link from the body
      document.body.removeChild(link);
    },
      fetchJobs() {
        axios.get('/get-jobs').then((response) => {
          this.jobs = response.data.jobs;
        });
      },
   // old RECORD
   deleteJob(id) {
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
          axios.delete(`/delete-job/${id}`)
            .then(response => {
              console.log(response.data);
              Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: 'Job deleted successfully!',
                timer: 1000,
              });
              this.fetchJobs();
            })
            .catch(error => {
              console.error('There was an error!', error.response);
            });
        }
      });
    },
      updateAdvertisementFile(event) {
      let files = event.target.files;
      if (files.length) {
        this.AdvertisementFile = files[0];
      }
    },
    updateJob() {
      let formData = new FormData();
      formData.append('job_title', this.editRecord.job_title);
      formData.append('province', this.editRecord.province);
      formData.append('zone', this.editRecord.zone);
      formData.append('apply_on_website', this.editRecord.apply_on_website);
      formData.append('apply_url', this.editRecord.apply_url);
      formData.append('start_date', this.editRecord.start_date);
      formData.append('last_Date', this.editRecord.last_Date);
      if (this.AdvertisementFile) {
        formData.append('AdvertisementFile', this.AdvertisementFile);
      }

      axios.post(`/update-job/${this.editRecord.id}`, formData, {
        headers: {
          'Content-Type': 'multipart/form-data'
        }
      })
      .then(response => {
        console.log(response.data);
        Swal.fire({
          icon: 'success',
          title: 'Success!',
          text: 'Job updated successfully!',
          timer: 1000,
        });
        $('#editJob').modal('hide');
        this.fetchJobs();
      })
      .catch(error => {
        console.error('There was an error!', error.response);
      });
    },
  
      editJob(id) {
      axios.get(`/edit-job/${id}`)
        .then(response => {
          this.editRecord = response.data;
          $('#editJob').modal('show');
        })
        .catch(error => {
          console.error("There was an error fetching the job data!", error);
        });
    },
  
      fetchDepartments() {
        // alert('ss');
        axios.get('/getDepartmentDataForSubject').then((response) => {
          this.DepartmentData = response.data;
        });
        console.log('departe reocrd', this.DepartmentData);
      },
  
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
  }
  </style>
    