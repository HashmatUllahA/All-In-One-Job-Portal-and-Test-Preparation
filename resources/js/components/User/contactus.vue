<template>
    <div>
        <div class="bg"></div>
        <div class="overlay"></div>
        <div class="container content">
            <div class="header col-12">
                <h1 class="text-center">Contact Us</h1>
                <div v-if="showAlert" class="alert alert-success mt-3" role="alert">
                    Message sent successfully!
                </div>
                <p class="text-center">At "All In One job portial and job preparation", we are dedicated to supporting your journey towards academic and professional success. Our platform provides an extensive array of MCQs, past papers,Advertisement, and syllabi specifically for test preparation in Pakistan. Whether aiming for a government position or a private sector role, our resources are meticulously curated to ensure you have the tools you need to succeed. Join our community and stay informed with the latest updates and study materials.</p>
            </div>
            <div class="main-div row d-flex">
                <div class="col-6">
                    <h3>Address</h3>
                    <div class="d-flex mb-3">
                        <i class="fa fa-map-marker-alt mr-2"></i>
                        <h6 style="color: white;">Kohat KDA GATE NO 2</h6>
                    </div>
                    <h3>Phone</h3>
                    <div class="d-flex mb-3">
                        <i class="fa fa-phone mr-2"></i>
                        <h6 style="color: white;">0334 0910607</h6>
                    </div>
                    <h3>Email</h3>
                    <div class="d-flex mb-3">
                        <i class="fas fa-envelope mr-2"></i>
                        <h6 style="color: white;">allinonetp@gmail.com</h6>
                    </div>
                </div>
                <div class="col-6 card">
                    <h1 class="text-center">Send Message</h1>
                    <div class="form-group">
                        <label for="name">Full Name</label>
                        <input type="text" class="form-control" v-model="name" placeholder="Type your Name">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" v-model="email" placeholder="Type your email">
                        <small v-if="!isValidEmail" class="text-danger">Please enter a valid email address.</small>
                    </div>
                    <div class="form-group">
                        <label for="mobileNumber">Mobile number</label>
                        <input type="text" class="form-control" v-model="mobileNumber"
                            placeholder="Type your mobile number">
                    </div>
                    <div class="form-group">
                        <label for="city">City</label>
                        <input type="text" class="form-control" v-model="city" placeholder="City name...">
                    </div>
                    <div class="form-group">
                        <label for="message">Type Your Message</label>
                        <textarea class="form-control" v-model="message" rows="3"
                            placeholder="Type your message..."></textarea>
                    </div>
                    <button type="button" class="btn btn-info btn-block" @click="sendContactMessage">Send</button>
                </div>

            </div>
        </div>
        <div class="footer">
            <Footer />
        </div>
    </div>
</template>

<script>
import Footer from '../footer.vue';
import axios from 'axios';
export default {
    components: {
        Footer,
    },
    data() {
        return {
            name: '',
            email: '',
            city: '',
            message: '',
            mobileNumber: '',
            isValidEmail: true,
            showAlert: false
        };
    },
    created() {
    },
    methods: {
        sendContactMessage() {
            if (!this.isValidEmailFormat(this.email)) {
                this.isValidEmail = false;
                return;
            }
            const formData = {
                name: this.name,
                email: this.email,
                city: this.city,
                message: this.message,
                mobileNumber: this.mobileNumber
            };
            axios.post('/save-contect-message', formData)
                .then(response => {
                    console.log(response.data);
                    this.showAlert = true;  // Show alert message
                    setTimeout(() => {
                        this.showAlert = false;  // Hide alert message after 2 seconds
                    }, 2000);
                    this.resetForm();  // Optional: Reset form fields
                })
                .catch(error => {
                    console.error('Error sending message:', error);
                });
        },
        isValidEmailFormat(email) {
            // Simple email format validation
            return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
        },
        resetForm() {
            this.name = '';
            this.email = '';
            this.city = '';
            this.message = '';
            this.mobileNumber = '';
            this.isValidEmail = true;
        }

    }
}
</script>

<style scoped>
.bg {
    background: url('/resources/js/components/Department/contecusbgimage.JPG') no-repeat center center fixed;
    background-size: cover;
    position: fixed;
    width: 100%;
    height: 100%;
    z-index: -1;

}

.overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.7);
    z-index: -1;
}

.content {
    position: relative;
    z-index: 1;
    color: white;
    padding-top: 50px;
}

.header {
    margin-top: 50px;
    color: white;
}

.main-div {
    margin-top: 30px;
    color: white;
    padding: 20px;
    border-radius: 10px;
}

.main-div h3,
.main-div h6 {
    color: #17a2b8;
}

.main-div .card {
    background: white;
    padding: 20px;
    border-radius: 10px;
}

.main-div .form-group label {
    color: black;
}
</style>
