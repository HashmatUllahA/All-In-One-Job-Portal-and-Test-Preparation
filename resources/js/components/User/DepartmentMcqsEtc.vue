<template>
  <div >
      <div class="row subjectDiv">
          <div class="d-flex w-100">
              <div class="menu" v-for="subject in DepatmentSubject" :key="subject.id">
                  <button class="btn btn-primary mr-2" @click="getSubjectmsqcs(subject.id)">{{ subject.subject_name }}</button>
                  
              </div>
              <button class="btn btn-primary mr-2" @click="DepartmentSyllabus" >Syllabus</button>
              <button class="btn btn-primary mr-2"  >Department Quiz</button>
              <button class="btn btn-primary mr-2"  >Subject Quiz</button>
          </div>
          <div v-for="ss in s" :key="ss.id">
            <p>syllabus{{ ss.description }}</p>
          </div>
      </div>
        <div class="header mt-3" style="color: #426085; ">
          <h4 class="ml-5">{{ SubjectmsqcByDepartment.departmentTitle }}</h4>
        </div>
        <div class="mcqsContainer col-6" v-if="SubjectmsqcByDepartment.subjectMCQs.length > 0">
          <div v-for="(mcq, index) in SubjectmsqcByDepartment.subjectMCQs" :key="mcq.id" class="card mb-3">
            <div class="card-body">
              <h5 class="card-title">{{ index + 1 }}. {{ mcq.Question }}</h5>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="option{{ mcq.id }}" id="optionA{{ mcq.id }}" :value="mcq.OptionA">
                <label class="form-check-label" for="optionA{{ mcq.id }}">
                  Option A: {{ mcq.OptionA }}
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="option{{ mcq.id }}" id="optionB{{ mcq.id }}" :value="mcq.OptionB">
                <label class="form-check-label" for="optionB{{ mcq.id }}">
                  Option B: {{ mcq.OptionB }}
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="option{{ mcq.id }}" id="optionC{{ mcq.id }}" :value="mcq.OptionC">
                <label class="form-check-label" for="optionC{{ mcq.id }}">
                  Option C: {{ mcq.OptionC }}
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="option{{ mcq.id }}" id="optionD{{ mcq.id }}" :value="mcq.OptionD">
                <label class="form-check-label" for="optionD{{ mcq.id }}">
                  Option D: {{ mcq.OptionD }}
                </label>
              </div>
              <div class="correctOption mt-3 ml-2">
                <span class="card-text">Correct Ospantion: {{ mcq.currectOption }}</span>
              </div>
            </div>
          </div>
        </div>
        <div v-else-if="subjectMCQs === 0">
          <span>Not Assign Mcqs</span>
        </div>
        <div v-else>
          <span>Select a subject Learn Mcqs Question</span>
        </div>

  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
      return {
        SubjectmsqcByDepartment: {
        departmentTitle: "",
        subjectMCQs: [],
      },
          DepartmentId: this.$route.query.id,
          DepatmentSubject:[],
          departmentTitle:"",
          subjectMCQs:[],
          departmentTitle:"",
          s:"",
      }
  },
  created() {
      this.getSubject();
      
  },
  methods: {
    DepartmentSyllabus(){
      axios.get(`/fetch-department-syllabus/${this.DepartmentId}`)
                .then(response => {
                  this.s = response.data;
                   
                })
                .catch(error => {
                    // Handle errors
                    console.error('Error fetching subject MCQs by department:', error);
                });
        },
      getSubjectmsqcs(ids) {
        // alert(ids);
            axios.get(`/fetch-subjectMcqs-ByDeprtment/${this.DepartmentId}/${ids}`)
                .then(response => {
                  this.SubjectmsqcByDepartment = response.data;
                    // const departmentTitle = response.data.departmentTitle;
                    // const subjectMCQs = response.data.subjectMCQs;
                    // this.SubjectmsqcByDepartment = {
                    //     departmentTitle: departmentTitle,
                    //     subjectMCQs: subjectMCQs
                    // };
                })
                .catch(error => {
                    // Handle errors
                    console.error('Error fetching subject MCQs by department:', error);
                });
        },
      getSubject() {
            axios.get(`/fetch-subjects/${this.DepartmentId}`)
                .then(response => {
                    this.DepatmentSubject = response.data;
                })
                .catch(error => {
                    console.error('Error fetching subject MCQs by department:', error);
                });
        }
  }
};
</script>

<style scoped>
.subjectDiv{
  display: grid;
    justify-content: center;
    position: relative;
    top: 10px;
}
.subjectDiv button{
  background-color: #426085 !important;
}
.correctOption span{
  border: 1px solid;
    font-size: large;
    padding: 10px;
    background: white;
    border-radius: 6px;
}
</style>
