<template>
    <div>
        <div class="row mt-3">
                <div class="col-5 " style="margin-left: 128px;">
                    <div class="card h-100">
                        <div class="card-body">
                            <!-- <h5 class="card-title" v-if="departmentMcqs.length > 0">{{ departmentinfo.title }}</h5> -->
                            <h5 class="card-title" >Select the Department for Past Papers.</h5>
                            <p class="card-text">Our effort is to provide those MCQs questions that will help you in the test.</p>
                            <p class="card-text">We will assist you in every possible way for your test.</p>
                            <!-- <div class="d-flex gap-2" v-if="departmentMcqs.length > 0">
                                <button class="btn btn-primary">Past Paper</button>
                                <button class="btn btn-primary">Syllabus</button>
                                <button class="btn btn-primary" @click="goToDepartmentBooks(departmentinfo.id)">Books</button>
                            </div> -->
                            <p class="card-text">Here, you can easily obtain <b>past papers</b>, <b>syllabi</b>, and <b>books</b>.</p>
                        </div>
                    </div>
                </div>
            </div>
        <div class="header col-10 ">
            <h5 class="header-text">List of past paper</h5>
            
            <div class="d-flex">
                <div class="col-8 p-0">
                    <h5 v-if="selectedSubdepartmentInfo">{{selectedSubdepartmentInfo.title}} past Papers</h5>
                    <h5 v-else>All Past Paper</h5>
                    <table class="table table-striped table-bordered mt-4">
                        <thead class="thead-dark">
                            <tr>
                                <th>Paper Title</th>
                                <th>Test Center</th>
                                <th>Test Date</th>
                                <th>View Paper</th>
                            </tr>
                        </thead>
                        <tbody>

                            <tr v-if="pastPapers.length > 0" v-for="paper in pastPapers" :key="paper.id">
                                <!-- <td>{{ index + 1 }}</td> -->
                                <td>{{ paper.title }}</td>
                                <td>{{ paper.test_center }}</td>
                                <td>{{ paper.test_date }}</td>
                                <td><a :href="paper.file_path" target="_blank">View paper</a></td>
                            </tr>
                            <tr v-else>
                                <td colspan="4">We will be looking for the <b>{{selectedSubdepartmentInfo.title}}</b> past paper. If we find it, we will upload it.</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- deparment div -->
                <div class="col-4 mt-5">
                    <div class="card p-3">
                    <label for="label">Select Department for Mcqs</label>
                    <div class="d-flex">
                        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                        <i class="fas fa-search custom-icon-style searchbtn"></i>
                    </div>
                    <div v-for="d in DepartmentData" :key="d.id">
                        <div class="DepartmentTitle" @click="toggleSubDepartment(d.id)">
                            <span>{{ d.title }}</span>
                        </div>
                        <!-- Department and Subdepartment Loop -->
                        <div v-if="activeDepartment === d.id">
                            <div v-for="sub in subdepartments" @click="fetchPastPapers(sub.id)" :key="sub.id"
                                class="SubDepartment">
                                <span>{{ sub.title }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            </div>


        </div>
        <div class="footer">
            <Footer />
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import Footer from '../footer.vue';

export default {
    components: {
        Footer,
    },
    data() {
        return {
            pastPapers: [],
            DepartmentRecord: [],
            departmentPastPapers:[],
            DepartmentData:[],
            subdepartments:[],
            activeDepartment: null,
            departmentId: '',
            sub_department_id:'',
            selectedSubdepartmentInfo:[],

        };
    },
    created() {
        this.fetchDepartments();
        this.fetchPastPapers();
        this.getDepartmentForPastPaper();
    },

    methods: {
        fetchPastPapers(sub_department_id = null) {
            axios.get('/fetch-past-paper-forUser', {
                params: {
                sub_department_id: sub_department_id
                }
            })
            .then((response) => {
                this.pastPapers = response.data.pastpapers;
                this.selectedSubdepartmentInfo = response.data.selectedSubdepartmentInfo;
            });
            },
        getDepartmentForPastPaper() {
            axios.get('/department-for-past-paper').then((response) => {
                this.DepartmentRecord = response.data.deparmentRecord;
            });
        },
        getPastPaperByDepartment(id) {
            axios.get(`/get-pastPaper-toDepartment/${id}`).then(response => {
                this.departmentPastPapers = response.data.departmentPastPapers;
            });
        },
        toggleSubDepartment(departmentId) {
            // alert(departmentId);
            if (this.activeDepartment === departmentId) {
                // If the clicked department is already active, close it
                this.activeDepartment = null;
                this.subdepartments = [];
            } else {
                // Otherwise, set the clicked department as active and fetch its sub-departments
                this.activeDepartment = departmentId;
                this.getSubDepartment(departmentId);
            }
        },
        getSubDepartmentforpastpaper(sub_department_id) {
            // alert(sub_department_id);
            this.sub_department_id = sub_department_id;
            // this.sub_department_subject_id = sub_department_subject_id;

            axios.get(`/fetch-sub-department-pastpaper-forUser`, {
                params: {
                    sub_department_id: sub_department_id,
                }
            })
                .then(response => {
                    this.departmentMcqs = response.data.mcqs.data;
                    this.departmentinfo = response.data.departmentinfo;
                    this.subdepartmentSubject = response.data.subdepartmentSubject;

                    this.currentDepartmentPage = response.data.mcqs.current_page;
                    this.lastDepartmentPage = response.data.mcqs.last_page;
                    this.subjectMcqs = [];
                    this.subjectName = {};
                })
                .catch(error => {
                    console.error('Error fetching department MCQs:', error);
                });
        },
        fetchDepartments() {
            axios.get('/getDepartmentData').then((response) => {
                this.DepartmentData = response.data;
                
                
            });
        },
        getSubDepartment(departmentId) {
            axios.get(`get-sub-department-forUser-mcqs/${departmentId}`)
                .then(response => {
                    console.log(response.data); // Log the response for debugging
                    this.subdepartments = response.data;
                })
                .catch(error => {
                    console.error("Error fetching subdepartments:", error);
                });
        },

    }

}
</script>


<style scoped>
.header-text{
    background: #4c9967;
    margin-top: 30px;
    text-align: center;
    color: white;
    padding: 4px;
}

.header {
    margin: 0 auto;
    float: none;
}

.btn-primary {
    background: #839cbb;
    border: 0px;
}
.department-container{
    margin-top: 48px;
    padding: 10px;
    box-shadow: rgba(0, 0, 0, 0.02) 0px 1px 3px 0px, rgba(27, 31, 35, 0.15) 0px 0px 0px 1px;
}
.department-item:hover{
    background: #839cbb;
    padding: 5px;
    color: white;
}
.department-item{
    margin-bottom: 4px;
    box-shadow: rgba(0, 0, 0, 0.02) 0px 1px 3px 0px, rgba(27, 31, 35, 0.15) 0px 0px 0px 1px;
    padding: 5px;
}
.search-btn{
    border-radius: 4px;
    padding: 9px;
    color: white;
    background: #839cbb;
}
.DepartmentTitle {
    cursor: pointer;
    padding: 5px;
    background-color: #f5f5f5;
    margin-bottom: 5px;
}
.DepartmentTitle {
    padding: 6px;
    margin-top: 4px;
    box-shadow: rgba(0, 0, 0, 0.02) 0px 1px 3px 0px, rgba(27, 31, 35, 0.15) 0px 0px 0px 1px;
}

.DepartmentTitle:hover {
    background: #839cbb;
}
.SubDepartment {
    padding-left: 20px;
    background-color: #e9e9e9;
    margin-bottom: 5px;
}
</style>