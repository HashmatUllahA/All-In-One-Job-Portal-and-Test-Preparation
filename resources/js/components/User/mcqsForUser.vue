<template>
    <div>
        <div class="row mt-3">
            <div class="menu-container text-center">
                <button class="btn btn-primary mx-2 mb-2" @click="getMcqsBySubject('English')">English</button>
                <button class="btn btn-primary mx-2 mb-2" @click="getMcqsBySubject('Maths')">Maths</button>
                <button class="btn btn-primary mx-2 mb-2" @click="getMcqsBySubject('Biology')">Biology</button>
                <button class="btn btn-primary mx-2 mb-2" @click="getMcqsBySubject('General Knowledge')">General Knowledge</button>
                <button class="btn btn-primary mx-2 mb-2" @click="getMcqsBySubject('Physics')">Physics</button>
                <button class="btn btn-primary mx-2 mb-2" @click="getMcqsBySubject('Chemistry')">Chemistry</button>
            </div>
            <div class="row">
                <div class="col-5 ml-3">
                    <div class="card h-100">
                        <div class="card-body departentCurd">
                            <h5 class="card-title" v-if="departmentMcqs.length > 0">{{ departmentinfo.title }}</h5>
                            <h5 class="card-title" v-else>Select the Department for Mcqs.</h5>
                            <p class="card-text">Our effort is to provide those MCQs questions that will help you in the test.</p>
                            <p class="card-text">We will assist you in every possible way for your test.</p>
                            <div class="d-flex gap-2" v-if="departmentMcqs.length > 0">
                                <button class="btn btn-primary">Past Paper</button>
                                <button class="btn btn-primary">Syllabus</button>
                                <button class="btn btn-primary" @click="goToDepartmentBooks(departmentinfo.id)">Books</button>
                            </div>
                            <p class="card-text" v-else>Here, you can easily obtain <b>past papers</b>, <b>syllabi</b>, and <b>books</b>.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-8 mt-3">
                <div class="card ml-3 p-3" v-if="subjectMcqs.length > 0">
                    <h3 class="ml-3" v-if="subjectName.subject_name">{{ subjectName.subject_name }}: importance Mcqs</h3>
                    <div v-for="(data, index) in subjectMcqs" :key="data.id" class="card mb-3 ml-2 mr-2">
                        <div class="card-body">
                            <p class="card-text"><strong>{{ data.question }}</strong></p>
                            <ul>
                                <li v-for="(option, optIndex) in data.options" :key="option.id" class="list-group-item"
                                    :class="{ 'is_correct text-white': option.is_correct }">
                                    {{ option.option }}
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="pagination-controls-wrapper">
                        <div class="pagination-controls">
                            <button class="Previousbtn" @click="prevPage('subject')"
                                :disabled="currentSubjectPage === 1">Previous</button>

                            <button v-for="page in subjectPages" :key="page" @click="goToPage('subject', page)"
                                :class="{ 'active-page-number': currentSubjectPage === page, 'btn-default': currentSubjectPage !== page }"
                                class="btn mx-1">
                                {{ page }}
                            </button>

                            <button class="nextbtn" @click="nextPage('subject')"
                                :disabled="currentSubjectPage === lastSubjectPage">Next</button>
                        </div>
                    </div>
                </div>

                <div class="card ml-1 p-3" v-if="departmentMcqs.length > 0">
                    <div class="d-flex">
                        <h6 class="ml-3">Department: {{ departmentinfo.title }}</h6>
                        <h6 class="ml-3">Skill: {{ departmentinfo.bps_skill }}</h6>
                       
                    </div>
                    <div style="border: 0px;" class="card mb-3 mt-3 ml-2 mr-2">
                        <!-- Subject Buttons -->
                        <div class="d-flex flex-wrap">
                            <div v-for="s in subdepartmentSubject" :key="s.id" class="mr-2 mb-2">
                                <button class="btn btn-outline-primary selected-department-subject"
                                    @click="getSubDepartmentMcqs(sub_department_id, s.id)"
                                    >{{ s.subject_name }}</button>
                            </div>
                        </div>
                    </div>

                    <div v-for="(data, index) in departmentMcqs" :key="data.id" class="card mb-3 ml-2 mr-2">
                        <div class="card-body">
                            <p class="card-text"><strong>{{ data.question }}</strong></p>
                            <ul>
                                <li v-for="(option, optIndex) in data.options" :key="option.id" class="list-group-item"
                                    :class="{ 'is_correct text-white': option.is_correct }">
                                    {{ option.option }}
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="pagination-controls-wrapper">
                        <div class="pagination-controls">
                            <button class="Previousbtn" @click="prevPage('sub_department_id')"
                                :disabled="currentDepartmentPage === 1">Previous</button>

                            <button v-for="page in departmentPages" :key="page" @click="goToPage('sub_department_id', page)"
                                :class="{ 'active-page-number': currentDepartmentPage === page, 'btn-default': currentDepartmentPage !== page }"
                                class="btn mx-1">
                                {{ page }}
                            </button>

                            <button class="nextbtn" @click="nextPage('sub_department_id')"
                                :disabled="currentDepartmentPage === lastDepartmentPage">Next</button>
                        </div>
                    </div>
                </div>

                <div style="height: 300px;" class="card ml-3 mb-2"
                    v-if="subjectMcqs.length === 0 && departmentMcqs.length === 0">
                    <div class="mt-3 ml-3">
                        Select Subject or Department for Mcqs
                    </div>
                </div>
            </div>


            <div class="col-4 mt-3" style="padding: 2px;">
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
                            <div v-for="sub in subdepartments" @click="getSubDepartmentMcqs(sub.id)" :key="sub.id"
                                class="SubDepartment"
                                :class="{ 'active-department-name': departmentinfo.title == sub.title }">
                                <span
                                >{{ sub.title }}</span>
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
            DepartmentData: [],
            selectedSubject: 'English',
            subjectMcqs: [],
            departmentMcqs: [],
            subjectName: {},
            departmentId: '',
            subdepartments: [],
            activeDepartment: null,
            departmentinfo: [],
            currentSubjectPage: 1,
            lastSubjectPage: 1,
            currentDepartmentPage: 1,
            lastDepartmentPage: 1,
            department: '',
            sub_department_id: null,
            sub_department_subject_id: null, // Added to store selected subject id
            subdepartmentSubject: [],

        };
    },
    created() {
        this.fetchDepartments();
        this.getMcqsBySubject(this.selectedSubject); 
    },
    computed: {
        subjectPages() {
            let pagesArray = [];
            for (let i = 1; i <= this.lastSubjectPage; i++) {
                pagesArray.push(i);
            }
            return pagesArray;
        },
        departmentPages() {
            let pagesArray = [];
            for (let i = 1; i <= this.lastDepartmentPage; i++) {
                pagesArray.push(i);
            }
            return pagesArray;
        }
    },
    methods: {

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
        toggleSubDepartment(departmentId) {
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
        goToDepartmentBooks(departmentId) {
            this.$router.push({ name: 'DepartmentBooks', params: { id: departmentId } });
        },
        fetchDepartments() {
            axios.get('/getDepartmentData').then((response) => {
                this.DepartmentData = response.data;
                
                
            });
        },
        getMcqsBySubject(subject, page = 1) {
            this.selectedSubject = subject;
            axios.get(`/get-subject-mcqs/${subject}?page=${page}`)
                .then(response => {
                    this.subjectMcqs = response.data.mcqs.data;
                    this.subjectName = response.data.subject;
                    this.currentSubjectPage = response.data.mcqs.current_page;
                    this.lastSubjectPage = response.data.mcqs.last_page;
                    this.departmentMcqs = [];
                    this.departmentinfo = '';
                })
                .catch(error => {
                    console.error('Error fetching subject MCQs:', error);
                });
        },
        prevPage(type) {
            if (type === 'sub_department_id' && this.currentDepartmentPage > 1) {
                this.getSubDepartmentMcqs(this.sub_department_id, this.sub_department_subject_id, this.currentDepartmentPage - 1);
            }
        },
        nextPage(type) {
            if (type === 'sub_department_id' && this.currentDepartmentPage < this.lastDepartmentPage) {
                this.getSubDepartmentMcqs(this.sub_department_id, this.sub_department_subject_id, this.currentDepartmentPage + 1);
            }
        },
        goToPage(type, page) {
            if (type === 'sub_department_id' && page !== this.currentDepartmentPage) {
                this.getSubDepartmentMcqs(this.sub_department_id, this.sub_department_subject_id, page);
            }
        },
        getSubDepartmentMcqs(sub_department_id, sub_department_subject_id = this.sub_department_subject_id, page = 1) {
            this.sub_department_id = sub_department_id;
            this.sub_department_subject_id = sub_department_subject_id;

            axios.get(`/fetch-sub-department-mcqs-forUser`, {
                params: {
                    sub_department_id: sub_department_id,
                    sub_department_subject_id: sub_department_subject_id,
                    page: page
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
        }
    }

}
</script>


<style scoped>
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
    background: #4c9967;
    color: white;
}

.SubDepartment {
    padding-left: 20px;
    background-color: #e9e9e9;
    margin-bottom: 5px;
}
.SubDepartment:hover {
    padding-left: 20px;
    background-color: #6cac83;
    margin-bottom: 5px;
    color: white;
}
.departmentDiv span {
    background-color: red;
}

.menu-container {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    margin-top: 20px;
}

.searchbtn {
    padding: 11px 11px;
    font-size: 16px;
    border-radius: 5px;
    background: #4c9967;
    color: white;
}

.btn-primary {
    background: #4c9967;
    border: 0px;
}



.is_correct {
    background: #4c9967;
}

.nextbtn {
    margin-right: 7px;
    border: 0px;
    color: black;
    margin-left: 8px;
    border-radius: 5px;
    box-shadow: rgba(0, 0, 0, 0.02) 0px 1px 3px 0px, rgba(27, 31, 35, 0.15) 0px 0px 0px 1px;
}

.Previousbtn {
    border: 0px;
    background-color: white;
    color: black;
    margin-left: 8px;
    border-radius: 5px;
    box-shadow: rgba(0, 0, 0, 0.02) 0px 1px 3px 0px, rgba(27, 31, 35, 0.15) 0px 0px 0px 1px;
}

.booksbtn {
    margin-right: 25px;
    right: 0px;
    position: absolute;
}

.pagination-controls-wrapper {
    white-space: nowrap;
    overflow-x: auto;
    background-color: #4c9967;
}
.SubDepartment span{
    cursor: pointer
}
.departentCurd{
    background-color: #4c9967;
    color: white;
}
.btn-default{
    color:white;
}
.active-page-number{
    background: white;
    border-radius: 21px;
    color: #4c9967;

}
.active-department-name{
    background-color: #4c9967;
    color: white;
}
.selected-department-subject{
    border: 1px solid #4c9967;
    color: #4c9967;
}
.selected-department-subject:hover{
    background-color:  #4c9967;
    color: white;
}
</style>