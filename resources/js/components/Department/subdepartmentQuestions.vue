<template>
    <div>
        <div class="row">
            <div class="col-2 " style="background: #839cbb;">
                <sidebar-component></sidebar-component>
            </div>

            <div class="col-10">
                <div>
        <div class="row">
            <div class="addQuestionDiv col-4 card">
                <p class="pt-4">Add Question</p>
                <div class="form-group">
                <label for="floatingInputValue">Question</label>
                <input type="text" class="form-control" v-model="question" placeholder="question..." />
                </div>
                <div class="form-group">
                <label for="floatingInputValue">Question Marks</label>
                <input type="number" class="form-control" v-model="marks" placeholder="question marks" />
                </div>
                
                <!-- <div v-for="(option, index) in options" :key="index" class="form-floating">
                <label for="floatingInputValue">Option</label>
                <div class="d-flex">
                    <input type="text" class="form-control" v-model="option.option" placeholder="option..." />
                    <input type="radio" class="ml-2" v-model="selectedOption" :value="index" />
                    <button class="btn btn-info ml-2" @click="removeOption(index)">x</button>
                </div> -->
                <div class="form-group" v-for="(option, index) in options" :key="index" >
                    <label for="floatingInputValue">Option</label>
                    <div class="d-flex">
                    <input type="text" class="form-control" v-model="option.option" placeholder="option..." />
                    <input type="radio" class="ml-2" v-model="selectedOption" :value="index" />
                    <button class="btn btn-info ml-2" @click="removeOption(index)">x</button>
                </div>
                <!-- </div> -->
                </div>
                <div>
                <button class="btn btn-info mt-2" @click="assignQuestion">Submit</button>
                <button class="btn btn-info float-right mt-2" @click="addOption">+ Option</button>
                </div>
            </div>
            <div class="col-8 card" >
                <div class="container my-4">
                    <div class="text-center">
                        <span class="h3 ">Quiz Title: {{ Quiz.title }}</span>
                    </div>
                    <div style="text-align: end; margin-left: 10px;">
                        <span >Total Question: {{ quizQuestions.length }}</span>
                    </div>
                    <div class="display-questions">
                        <div v-for="(question, index) in quizQuestions" :key="question.id" class="card mb-3 shadow-sm">
                            <div class="card-header">
                            <h5 class="mb-0">
                                {{ index + 1 }}. {{ question.question }}
                            </h5>
                            </div>
                            <div>
                                <span class="float-right">Marks: <strong>{{ question.marks }}</strong></span>
                            </div>
                            <ul class="list-group list-group-flush">
                                <li 
                                    v-for="(option, optIndex) in question.options" 
                                    :key="option.id" 
                                    class="list-group-item" 
                                    :class="{ 'bg-info text-white': option.is_correct == 1 }"
                                >
                                    <span>{{ optIndex + 1 }}. {{ option.option }}</span>
                                </li>
                            </ul>
                            <div>
                                <button class="float-right btn btn-danger" @click="deleteQuestion(question.id)">Delete Question</button>
                            </div>
                            
                        </div>
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
            // quiz_id: this.$route.params.quiz_id,
            question: '',
      
            options: [
                { option: '' },
                { option: '' }
            ],
            selectedOption: null,
            quiz_id: null,
            marks:'',
            quizQuestions:[],
            Quiz:[]
        };
    },
    created() {
    this.quiz_id = this.$route.params.quiz_id;
    this.getQuestions();
  },
    methods: {
        addOption() {
      this.options.push({ option: '' });
    },
    removeOption(index) {
      this.options.splice(index, 1);
    },
    assignQuestion() {
        alert(this.quiz_id);
      const payload = {
        question: this.question,
        options: this.options,
        marks:this.marks,
        selectedOption: this.selectedOption,
        quiz_id:this.quiz_id
      };

      axios.post('/create-questions', payload)
        .then(response => {
        this.getQuestions();
          console.log(response.data);
          
        })
        .catch(error => {
          console.error(error);
        });
    },
    getQuestions() {
      axios.get(`/get-questions/${this.quiz_id}`)
        .then(response => {
          this.quizQuestions = response.data.Qquestions;
          this.Quiz = response.data.Quiz;
        })
        .catch(error => {
          console.error(error);
        });
    },
    deleteQuestion(questionId) {
      axios.delete(`/delete-question/${questionId}`)
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
    /* position: fixed; */
    /* left: 279px; */
    box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;
}
</style>