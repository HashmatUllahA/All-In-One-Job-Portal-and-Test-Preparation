<template>
    <div class="sidebar">
        <div class="header-cover">
            <div class="image-container text-center">
                <div class="sidebar-image">
                    <h5 style="font-size: 13px;">All-in-1 JP & JP</h5>
                </div>
            </div>
        </div>
        <ul class="nav flex-column">
            <li>
                <router-link to="/dashboard" class="nav-link" active-class="active-link">
                    <i class="fas fa-tachometer-alt" aria-hidden="true"></i>
                    <span class="e-text"> Dashboard</span>
                </router-link>
            </li>
            <li>
                <router-link to="/department" class="nav-link" active-class="active-link">
                    <i class="fas fa-building" aria-hidden="true"></i>
                    <span class="e-text"> Department</span>
                </router-link>
            </li>
            <li>
                <router-link to="/subjects" class="nav-link" active-class="active-link">
                    <i class="fas fa-book" aria-hidden="true"></i>
                    <span class="e-text"> Subjects</span>
                </router-link>
            </li>
            <li>
                <router-link to="/subjectMcqs" class="nav-link" active-class="active-link">
                    <i class="fas fa-list" aria-hidden="true"></i>
                    <span class="e-text"> Subjects Mcqs</span>
                </router-link>
            </li>
            <li>
                <router-link to="/subjectQuiz" class="nav-link" active-class="active-link">
                    <i class="fas fa-chalkboard-teacher" aria-hidden="true"></i>
                    <span class="e-text"> Subject Quiz</span>
                </router-link>
            </li>



            <li>
                <router-link to="/sub-d-quizz" class="nav-link" active-class="active-link">
                    <i class="fas fa-puzzle-piece" aria-hidden="true"></i>
                    <span class="e-text"> Sub Department Quiz</span>
                </router-link>
            </li>
            <li>
                <router-link to="/new-jobs" class="nav-link" active-class="active-link">
                    <i class="fas fa-briefcase" aria-hidden="true"></i>
                    <span class="e-text"> Jobs</span>
                </router-link>
            </li>
            <li>
                <router-link to="/testsyllabus" class="nav-link" active-class="active-link">
                    <i class="fas fa-scroll" aria-hidden="true"></i>
                    <span class="e-text"> Test Syllabus</span>
                </router-link>
            </li>
            <li>
                <router-link to="/tp/books" class="nav-link" active-class="active-link">
                    <i class="fas fa-book" aria-hidden="true"></i>
                    <span class="e-text"> Books</span>
                </router-link>
            </li>
            <li>
                <router-link to="/tp/messages" class="nav-link" active-class="active-link">
                    <i class="fas fa-message" aria-hidden="true"></i>
                    <span class="e-text"> messages</span>
                </router-link>
            </li>
            <li>
                <a href="#" class="nav-link" @click.prevent="logout">
                    <i class="fas fa-sign-out-alt" aria-hidden="true"></i>
                    <span class="e-text"> Logout</span>
                </a>
            </li>
        </ul>
    </div>
</template>

<script>
import axios from 'axios';
export default {
    methods: {
        logout() {
            axios.post('/logout')
                .then(response => {
                    this.$router.push({ path: '/home' });
                })
                .catch(error => {
                    console.error('Logout failed:', error);
                });
        }
    }
}
</script>

<style scoped>
.active-link {
    background: #426085;
    font-weight: bold;
    color: white !important;
}

.nav.flex-column :hover {
    background: #426085;
    font-weight: bold;
    color: white !important;
}

.sidebar {
    position: fixed;
    top: 0;
    left: 0;
    height: 100vh;
    overflow-y: auto;
    background-color: #f8f9fa;
    width: 16.6667%;
    padding-top: 20px;
}

.nav-link {
    color: black;
}

.flex-column li {
    margin: 1px;
    color: black;
    background-color: white;
    box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;
}</style>
