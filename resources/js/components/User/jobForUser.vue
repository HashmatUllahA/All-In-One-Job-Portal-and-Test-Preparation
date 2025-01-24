<template>
    <div>
        <div class="header col-10">
            <h5 class="header-text">List of Latest Projects. Click 'Apply Now' for Online Application Form</h5>
            <table class="table table-striped table-bordered mt-4">
                    <thead class="thead-dark">
                        <tr>
                            <th>S.NO</th>
                            <th>Project Title</th>
                            <th>province</th>
                            <th>Last Date</th>
                            <th>Advertisement</th>
                            <th>Online Apply</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(job, index) in jobs" :key="job.id">
                            <td>{{ index + 1 }}</td>
                            <td>{{ job.job_title }}</td>
                            <td>{{ job.province }}</td>
                            <td>{{ job.last_Date }}</td>
                            <td ><a :href="job.file_path" target="_blank">View Ad</a></td>

                            <td style="text-align: center;"><a class="btn btn-primary btn-sm" :href="job.apply_url" target="_blank">Apply Now</a></td>
                        </tr>
                        
                    </tbody>
                </table>
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
            jobs:[],
       
    };
},
created() {
    this.fethchAllJob();
},

methods:{
    fethchAllJob(){
        axios.get('/fetch-jobs-forUser').then((response )=>{
            this.jobs = response.data.jobs;
        });
    },
    // getAdUrl(job) {
    //   // Construct the full URL to the advertisement file
    //   return `${window.location.origin}/${job.file_path}`;
    // },
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
    background: #4c9967;
    color: white;
    border: 0px;
}
</style>