<template>
    <div>
        <div class="row">
            <div class="col-2 sidebar">
                <sidebar-component></sidebar-component>
            </div>
            <!-- <div class="col-10">
                <div class="col-8 bg-info">

                </div>
            </div> -->
            <div class="col-10">
                <div>
                    <div class="row">
                        <div class="col text-right">
                            <button class="btn btn-primary sub-action custom" data-toggle="modal"
                                data-target="#exampleModalLong">
                                <i class="feather icon-plus"></i>Quiz
                            </button>
                        </div>
                    </div>
                    <div class="ml-3">
                        <div class="card d-flex" v-for="q in quizzes" :key="q.id">
                            <div class="d-flex align-items-center w-100 p-3">
                                <i class="feather icon-file"></i>
                                <h4 class="ml-2 flex-grow-1">{{ q.title }}</h4>
                                <div class="ml-auto">
                                    <!-- <button class="btn btn-primary mr-2">Preview</button> -->
                                    <button class="btn btn-secondary mr-2" @click="addQuestions(q.id)">
                                        Add Question
                                    </button>
                                    <i style="color: red;" class="feather icon-trash"
                                        @click="deleteDepartmentQuiz(q.id)"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">
                                        Create Quiz
                                    </h5>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="departmentSelect">Select Department</label>
                                        <select id="departmentSelect" 
                                            v-model="selected_department_id" @click="fetchDepartmentForQuiz" class="form-control">
                                            <option value="" disabled>Select an option</option>
                                            <option v-for="data in departmentInfo" :key="data.id"
                                                :value="data.id">{{ data.title }}
                                            </option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="departmentSelect">Select Sub Department</label>
                                        <select id="departmentSelect" 
                                            v-model="selected_sub_department_id" @click="fetchSubDepartmentForQuiz" class="form-control">
                                            <option value="" disabled>Select an option</option>
                                            <option v-for="subd in subDepartmentInfo" :key="subd.id"
                                                :value="subd.id">{{ subd.title }}
                                            </option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="floatingInputValue">Title</label>
                                        <input type="text" v-model="quizTitle" class="form-control"
                                            placeholder="Enter Quiz Title" />
                                    </div>
                                   
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                        Close
                                    </button>
                                    <button type="button" class="btn btn-primary" @click="CreatQuiz">
                                        Create Quiz
                                    </button>
                                </div>
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
            quizTitle: "",
            departmentId: 1,
            quizzes: [],
            selected_department_id: '',
            departmentInfo:[],
            selected_sub_department_id:'',
            subDepartmentInfo:[]
        };
    },
    created() {
        this.getDepartmentQuizzes();
    },
    methods: {
        fetchSubDepartmentForQuiz(){
            axios
                .get(`/get-sub-department-for-quizzes/${this.selected_department_id}`)
                .then(response => {
                    this.subDepartmentInfo = response.data;
                })
                .catch(error => {
                    console.error(error);
                });
        },
        fetchDepartmentForQuiz(){
            axios
                .get('/get-department-for-quizzes')
                .then(response => {
                    this.departmentInfo = response.data;
                })
                .catch(error => {
                    console.error(error);
                });
        },
        CreatQuiz() {
            axios
                .post("/create-quiz", { 
                    title: this.quizTitle,
                     department_id:this.selected_department_id,
                     sub_department_id:this.selected_sub_department_id
                    })
                .then(response => {})
                .catch(error => {
                    console.error(error);
                });
        },
        // getDepartmentQuizzes() {
        //     axios
        //         .get(`/get-department-quizzes/${this.departmentId}`)
        //         .then(response => {
        //             this.quizzes = response.data;
        //         })
        //         .catch(error => {
        //             console.error(error);
        //         });
        // },
        getDepartmentQuizzes() {
        const params = {
            department_id: this.selected_department_id,
            sub_department_id: this.sub_department_selected_id,
        };

        axios.get('/get-department-quizzes', { params })
            .then(response => {
            this.quizzes = response.data;
            })
            .catch(error => {
            console.error('Error:', error);
            });
        },
        addQuestions(id) {
            this.$router.push(`/app/add-questions/${id}`);
        },
        deleteDepartmentQuiz(quiz_id){
            axios.delete(`/delete-department-quiz/${quiz_id}`)
        .then(response => {
            this.getQuestions();
            // console.log(response.data);
        })
        .catch(error => {
          console.error(error);
        });
        }

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
}
</style>