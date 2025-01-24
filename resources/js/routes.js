// resources/js/routes.js
import { createRouter, createWebHistory } from 'vue-router';
import Dashboard from './components/Dashboard.vue'; 
import Home from './components/home.vue'; 
import Department from './components/department.vue'; 
import Subject from './components/Subject/subjects.vue'; 
import SubjectMcqs from './components/Subject/subjectMcqs.vue'; 
import SubjectQuiz from './components/Subject/subjectQuiz.vue'; 
// import CreateSubjectQuiz from './components/Subject/createSubjectQuiz.vue'; 
import TestSyllabus from './components/TestSyllabus/testSyllabus.vue'; 
import DepartmentRecord from './components/Department/DepartmentRecord.vue';
import pastPaper from './components/Department/pastPaper.vue';
import DepartmentBooks from './components/Department/departmentBooks.vue';

import DepartmentMcqsEtc from './components/User/DepartmentMcqsEtc.vue';
import NewJobs from './components/Jobs/allJob.vue';
import Footer from './components/footer.vue';
 
import AdminSideBar from './components/SidebarComponent.vue'; 
import AboutUs from './components/AboutUs.vue';
import McqsforU from './components/User/mcqsForUser.vue';
import JobForUser from './components/User/jobForUser.vue';
import PastPaperForUser from './components/User/pastPaperForUser.vue';
// import SubDepartmentQuiz from './components/Department/subdepartmentquiz.vue';
import SubDepartmentQuestion from './components/Department/subdepartmentQuestions.vue';
import SubDepartmentQuizz from './components/Department/subdepartmentquizz.vue';
import AllBooks from './components/Department/allbooks.vue';
import BookForUser from './components/user/bookforuser.vue';
import ContactUs from './components/user/contactus.vue';
import Messages from './components/messages.vue';

import HomeNew from './components/homenew.vue'; 

const routes = [
    { path: '/', redirect: '/home' }, // Redirect root path to the Dashboard
    { path: '/new/home', component: HomeNew }, 
    { path: '/tp/contact-Us', component: ContactUs }, 
    { path: '/tp/messages', component: Messages }, 
    
    { path: '/tp/books-user', component: BookForUser }, 
    { path: '/past-p-for-usr', component: PastPaperForUser }, 
    { path: '/sub-d-quizz', component: SubDepartmentQuizz }, 
    { path: '/tp/books', component: AllBooks }, 
    // { path: '/sub-departmetn-quiz', component: SubDepartmentQuiz },

    { path: '/job-for-u', component: JobForUser }, 
    { path: '/mcqs-for-u', component: McqsforU }, 
    { path: '/about-us', component: AboutUs }, 
    { path: '/dashboard', component: Dashboard },
    { path: '/department', component: Department },
    { path: '/subjects', component: Subject },
    { path: '/subjectMcqs', component: SubjectMcqs },
    { path: '/subjectQuiz', component: SubjectQuiz },
    // { path: '/createSubjectQuiz', component: CreateSubjectQuiz },
    { path: '/testSyllabus', component: TestSyllabus },
    { path: '/newjobs', component: NewJobs },
    { path: '/footer', component: Footer },
    // { path: '/DepartmentRecord', component: DepartmentRecord },
    { 
      path: '/DepartmentRecord/:id', name: 'DepartmentRecord', component: DepartmentRecord 
    },
    { 
      path: '/app/add-questions/:quiz_id', name: 'SubDepartmentQuestion', component: SubDepartmentQuestion 
    },
    { 
      path: '/department-books/:id', name: 'DepartmentBooks', component: DepartmentBooks 
    },
    
    {
      path: '/pastPaper/:DepartmentId', name: 'pastPaper', component: pastPaper
    },
    // { path: '/getData', component: GetData },
    { path: '/sidebar', component: AdminSideBar },
  { 
    path: '/home', component: Home 
  },
  {
    path: '/department-mcqs-etc', name: 'DepartmentMcqsEtc', component: DepartmentMcqsEtc
  },
  {
    path: '/new-jobs', name: 'NewJobs', component: NewJobs
  }
  // Add more routes as needed
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;

