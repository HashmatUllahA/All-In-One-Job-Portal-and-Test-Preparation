<template>
    <div>
        <h1>Department Books page</h1>
        <p>Department ID: {{ departmentId }}</p>
    </div>
</template>

<script>
// import axios from 'axios';
// import Footer from '../footer.vue';

export default {
    // components: {
    //     Footer,
    // },
    data() {
        return {
            departmentId: this.$route.params.id
       
    };
},
created() {
    // this.fetchDepartments();
},

methods:{

}

}
</script>


<style scoped>

</style>