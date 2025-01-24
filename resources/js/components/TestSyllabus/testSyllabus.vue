<template>
    <div class="row">
        <div class="mainbody col-2">
            <sidebar-component></sidebar-component>
        </div>
        <div class="col-10">
            <button type="button" class="btn btn-primary mt-2" data-toggle="modal" data-target="#addsyllabusModel">
                Add Syllabus
            </button>

            <table class="w-100 mt-4">
            <thead>
                <th>#</th>
                <th>Description</th>
                <th>Department</th>
                <th>Marks</th>
                <th>Action</th>
            </thead>
            <tbody>
                <tr v-for="(data, index ) in syllabusData" :key="data.id">
                    <td>{{ index + 1 }}</td>
                    <td v-if="data.department.title.length > 0">{{ data.department.title }}</td>
                    <td v-else>-</td>
                    <td>{{ data.description }}</td>
                    <td>{{ data.marks }}</td>
                    <!-- <td>{{ data.syllabus_image }}</td> -->

                    <td>
                        <button class="btn btn-info mr-2" data-toggle="modal" data-target="#viewImageModal"
                            @click="editDepartmentSyllabus(data.id)">Edit</button>

                        <button class="btn btn-danger" @click="DeleteDepartmentSyllabus(data.id)">delete</button>
                    </td>
                </tr>
            </tbody>


        </table>

        <div class="modal fade" id="viewImageModal" tabindex="-1" role="dialog" aria-labelledby="viewImageModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewImageModalLabel">Update Department Syllabus</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Syllabus title</label>
                        <input type="text" class="form-control" v-model="departmentSyllabus.description">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Marks </label>
                        <input type="text" class="form-control" v-model="departmentSyllabus.marks">
                    </div>
                    <!-- <img class="syllabusImage" v-if="selectedSyllabus && selectedSyllabus.syllabus_image"
                            :src="getImageUrl(selectedSyllabus.syllabus_image)" alt="Syllabus Image"> -->
                    <!-- <p v-else>No image available</p> -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-info"
                        @click="updateDepartmentSyllabus(departmentSyllabus.id)">Update</button>
                </div>
            </div>
        </div>
    </div>
    <!-- add syllabus Modal -->
    <div class="modal fade" id="addsyllabusModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
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
                        <label for="exampleInputEmail1">Select Department</label>
                        <select class="form-control" @click="fetchDepartmentForSyllabus" v-model="formFields.Department_id">
                            <option value="" disabled>Select an option</option>
                            <option v-for="data in DepartmentData" :key="data.id" :value="data.id">{{ data.title }}
                            </option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Syllabus title</label>
                        <input type="text" class="form-control" v-model="formFields.description">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Marks </label>
                        <input type="text" class="form-control" v-model="formFields.marks">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" @click="submiDemartmentSyllabus">Submit</button>
                </div>
            </div>
        </div>
    </div>

        </div>

    </div>
 
</template>
<script>
import axios from "axios";
import SidebarComponent from '../SidebarComponent.vue';
export default {
    components: {
        SidebarComponent,
    },
    data() {
        return {
            formFields: {
                Department_id: '',
                description: '',
                marks: '',

            },
            DepartmentData: [],
            syllabusData: [],
            selected_department: '',
            selectedSyllabus: null,
            departmentSyllabus: '',
            success: '',
        }
    },
    created() {
        this.fetchSyllabus();
    },
    methods: {
        editDepartmentSyllabus(id) {
            axios.get('/edit-department-syllabus/' + id).then((response) => {
                this.departmentSyllabus = response.data;

            });
        },
        updateDepartmentSyllabus(id) {
            // Assuming you have description and marks stored in data properties
            const data = {
                description: this.departmentSyllabus.description,
                marks: this.departmentSyllabus.marks
            };

            axios.post('/update-department-syllabus/' + id, data).then((response) => {
                this.success = response.data;
                $('#viewImageModal').modal('hide');
                this.fetchSyllabus();
            });

        },
        DeleteDepartmentSyllabus(id) {
            // alert(id);
            swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then(result => {
                if (result.value) {
                    axios.delete("/delete-user-department-syllabus/" + id)
                        .then(() => {
                            swal.fire("Deleted!", "syllabus has been deleted.", "success");
                            this.fetchSyllabus();
                        })
                        .catch((error) => {
                            console.error(error);
                            swal.fire("Error", "Unable to delete the syllabus.", "error");
                        });
                }
            });
        },




        // onFileChange(event) {
        //     this.formFields.syllabus_image = event.target.files[0];
        // },
        submiDemartmentSyllabus() {
            let formData = new FormData();

            formData.append("marks", this.formFields.marks);
            formData.append("Department_id", this.formFields.Department_id);
            formData.append("description", this.formFields.description);

            axios.post('/submit-department-syllabus', formData)
                .then((res) => {
                    console.log(res);
                    this.fetchSyllabus();
                    $('#addsyllabusModel').modal('hide');


                })
                .catch((error) => {
                    console.log(error);
                });
        },
        fetchSyllabus() {
            // alert('ss');
            axios.get('/fetchSyllabusdata').then((response) => {
                this.syllabusData = response.data;
            });
            console.log('departe reocrd', this.syllabusData);
        },

        fetchDepartmentForSyllabus() {
            // alert('ss');
            axios.get('/fetchDepForSyllabus').then((response) => {
                this.DepartmentData = response.data;
            });
            console.log('departe reocrd', this.DepartmentData);
        },
    }

};
</script>
<style scoped>
.mainbody {

    box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;
}

.customTable {
    width: 1090px;
}

.syllabusImage {
    height: 326px;
    width: 464px;
}
</style>