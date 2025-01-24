<template>
  <div class="row">
    <header id="in-header" class="in-header-section header-style-two">
		<div class="in-header-content-wrapper">
			<!-- <div class="in-header-top-content d-flex align-items-center justify-content-between">
				<div class="header-top-info ul-li">
					<ul>
						<li><i class="fas fa-map-marker-alt"></i> 80 St Kilda Road, Australia</li>
						<li><i class="fas fa-clock"></i> Sat - Thursday (9am - 10 pm)</li>
					</ul>
				</div>
				<div class="header-top-social ul-li d-flex align-items-center">
					<span>Get Our Socials:</span>
					<ul>
						<li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
						<li><a href="#"><i class="fab fa-twitter"></i></a></li>
						<li><a href="#"><i class="fab fa-dribbble"></i></a></li>
						<li><a href="#"><i class="fab fa-behance"></i></a></li>
					</ul>
				</div>
			</div> -->
			<div class="in-header-main-menu-wrapper d-flex justify-content-between align-items-center">
				<div class="brand-logo">
          <img src="./images/img/logo/logo-3.png" alt="Logo">
				</div>
				<div class="in-header-main-menu-cta-btn  justify-content-between align-items-center">
					<nav class="in-main-navigation-area clearfix ul-li ">
						<ul id="main-nav" class="nav navbar-nav clearfix " >
							<li class="dropdown in-megamenu">
								<router-link to="/home">Home</router-link>
							</li>
							<li><router-link to="/about-us">About Us</router-link></li>
							<li><router-link to="/job-for-u">Jobs</router-link></li>
							<li >
                                    <router-link to="/mcqs-for-u" >Mcqs</router-link>
                                </li>
                                <li >
                                    <router-link to="/past-p-for-usr" >Past Paper</router-link>
                                </li>
                                <li >
                                    <router-link to="/tp/books-user" >Books</router-link>
                                </li>
                                <li >
                                    <router-link to="/tp/contact-Us" >Contact Us</router-link>
                                </li>
								<!-- <li  v-if="!Userinfo">
                                    <button  data-toggle="modal" data-target="#registerModalCenter">Register</button>
                                </li>
                                <li  v-if="!Userinfo">
                                    <botton  data-toggle="modal" data-target="#loginModalCenter">Log In</botton>
                                </li> -->
							<li class="dropdown">
								<a >Register</a>
								<ul class="dropdown-menu clearfix">
									<li><a target="_blank" >Register</a></li>
									<li><a target="_blank" >Log In</a></li>
								</ul>
							</li>
						</ul>
					</nav>
					<!-- <div class="header-cta-btn">
						<a href="contact.html">Lets Talk</a>
					</div> -->
				</div>
				<div class="header-cta-info d-flex align-items-center">
					<div class="inner-icon d-flex justify-content-center align-items-center">
						<i class="fas fa-phone-alt"></i>
					</div>
					<div class="inner-text headline">
						<span>Need any help?</span>
						<h6>Call: <a href="#">0000 0910607</a></h6>
					</div>
				</div>
			</div>
			<div class="mobile_menu position-relative">
				<div class="mobile_menu_button open_mobile_menu mt-3">
					<i class="fal fa-bars"></i>
				</div>
				<div class="mobile_menu_wrap">
					<div class="mobile_menu_overlay open_mobile_menu"></div>
					<div class="mobile_menu_content">
						<div class="mobile_menu_close open_mobile_menu">
							<i class="fal fa-times"></i>
						</div>
						<div class="m-brand-logo">
							<a  href="%21.html#"><img src="./images/img/logo/logo-1.png" alt="logo"></a>
						</div>
						<!-- <div class="in-m-search">
							<form action="#">
								<input type="text" name="search" placeholder="Search..">
								<button type="submit"><i class="far fa-search"></i></button>
							</form>
						</div> -->
						<nav class="mobile-main-navigation  clearfix ul-li">
							<ul id="m-main-nav" class="nav navbar-nav clearfix">
							
								<li><router-link to="/home">home</router-link></li>
								<li><router-link to="/about-us">About Us</router-link></li>
							<li><router-link to="/job-for-u">Jobs</router-link></li>
							<li >
                                    <router-link to="/mcqs-for-u" >Mcqs</router-link>
                                </li>
                                <li >
                                    <router-link to="/past-p-for-usr" >Past Paper</router-link>
                                </li>
                                <li >
                                    <router-link to="/tp/books-user" >Books</router-link>
                                </li>
                                <li >
                                    <router-link to="/tp/contact-Us" >Contact Us</router-link>
                                </li>
								<li  v-if="!Userinfo">
                                    <button class="btn btn-link" data-toggle="modal" data-target="#registerModalCenter">Register</button>
                                </li>
                                <li  v-if="!Userinfo">
                                    <button class="btn btn-link" data-toggle="modal" data-target="#loginModalCenter">Log In</button>
                                </li>
								<li class="dropdown">
									<a href="%21.html#">Shop</a>
									<ul class="dropdown-menu clearfix">
										<li><a target="_blank" href="shop.html">Shop Page </a></li>
										<li><a target="_blank" href="shop-single.html">Shop Details</a></li>
									</ul>
								</li>
								<!-- <li class="dropdown">
									<a href="%21.html#">Pages</a>
									<ul class="dropdown-menu clearfix">
										<li><a target="_blank" href="service.html">Services</a></li>
										<li><a target="_blank" href="service-2.html">Service Page 2</a></li>
										<li class="dropdown">
											<a href="service-single.html">Services Details</a>
											<ul class="dropdown-menu clearfix">
												<li><a target="_blank" href="service-single.html">Life Insurence</a></li>
												<li><a target="_blank" href="service-single.html">Health Insurence</a></li>
												<li><a target="_blank" href="service-single.html">Car Insurence</a></li>
												<li><a target="_blank" href="service-single.html">Home Insurence</a></li>
												<li><a target="_blank" href="service-single.html">Credit Insurence</a></li>
												<li><a target="_blank" href="service-single.html">Transport Insurence</a></li>
												<li><a target="_blank" href="service-single.html">Energy Insurence</a></li>
											</ul>
										</li>
										<li class="dropdown">
											<a href="%21.html#">Testimonial</a>
											<ul class="dropdown-menu clearfix">
												<li><a target="_blank" href="testimonial.html">Testimonial</a></li>
												<li><a target="_blank" href="testimonial-carousel.html">Testimonial Carousel</a></li>

											</ul>
										</li>
										<li><a target="_blank" href="team.html">Team Page</a></li>
										<li><a target="_blank" href="team-single.html">Team Details</a></li>
										<li><a target="_blank" href="faq.html">FAQ Page</a></li>
										<li><a target="_blank"  href="pricing.html">Pricing Page</a></li>
										<li><a target="_blank" href="contact.html">Contact Page</a></li>
										<li><a target="_blank" href="insurance-calculator.html">Insurence Calculator</a></li>
										<li><a target="_blank" href="404.html">404</a></li>
									</ul>
								</li>
								<li class="dropdown">
									<a class="" href="%21.html#">Blog</a>
									<ul class="dropdown-menu clearfix">
										<li><a target="_blank" href="blog-list.html">News </a></li>
										<li><a target="_blank" href="blog-grid.html">News Grid</a></li>
										<li><a target="_blank" href="blog-list-2.html">News List</a></li>
										<li><a target="_blank" href="blog-slider.html">News Slider</a></li>
										<li><a target="_blank" href="blog-single.html">News Details</a></li>
									</ul>
								</li>
								<li class="dropdown">
									<a class="" href="%21.html#">Portfolio</a>
									<ul class="dropdown-menu clearfix">
										<li><a target="_blank" href="portfolio-slide.html">Portfolio Slide </a></li>
										<li><a target="_blank" href="portfolio-grid.html">Portfolio Grid</a></li>
										<li><a target="_blank" href="portfolio-masonry.html">Porfolio Masonry</a></li>
										<li><a target="_blank" href="portfolio-single.html">Portfolio Details</a></li>
									</ul>
								</li> -->
							</ul>
						</nav>
					</div>
				</div>
			</div>
		</div>
	</header>
    <div class="col-2 text-white" style="margin-top: 9px;
    padding-top: 13px;
    height: 46px;
    background: rgb(131, 156, 187) ">
            <div class="header-cover">
                <div class="image-container text-center">
                    <div class="sidebar-image">
                      <h5 style="font-size: 13px;">All-in-1 JP & JP</h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-10" style="padding: 0px;">
            <!-- Admin Header -->
            <header v-if="Userinfo && Userinfo.usertype == 'admin'" style="background: white;">
                <div class="w-100 costumHeader">
                    <div v-if="Userinfo">
                        <div class="dropdown">
                            <button class="btn btn-white dropdown-toggle d-inline loginbtn" type="button" id="dropdownMenuButton"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{ Userinfo.name }}
                            </button>
                            <div class="dropdown-menu dropdown-menu-minimized" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="#" @click.prevent="logout">Logout</a>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <!-- Non-Admin Header -->
            <header v-else style="background: white;">
                <nav class="navbar navbar-expand-lg navbar-light bg-light w-100">
                    <div class="container-fluid costumHeader">
                        <!-- Toggler/collapsible Button -->
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        <!-- Navbar links -->
                        <div class="collapse navbar-collapse bg-light" id="navbarNav">
                            <ul class="navbar-nav ml-auto">
                                <li class="nav-item">
                                    <router-link to="/home" class="nav-link">Home</router-link>
                                </li>
                                <li class="nav-item">
                                    <router-link to="/about-us" class="nav-link">About Us</router-link>
                                </li>
                                <li class="nav-item">
                                    <router-link to="/job-for-u" class="nav-link">Jobs</router-link>
                                </li>
                                <li class="nav-item">
                                    <router-link to="/mcqs-for-u" class="nav-link">Mcqs</router-link>
                                </li>
                                <li class="nav-item">
                                    <router-link to="/past-p-for-usr" class="nav-link">Past Paper</router-link>
                                </li>
                                <li class="nav-item">
                                    <router-link to="/tp/books-user" class="nav-link">Books</router-link>
                                </li>
                                <li class="nav-item">
                                    <router-link to="/tp/contact-Us" class="nav-link">Contact Us</router-link>
                                </li>
                                <li class="nav-item" v-if="!Userinfo">
                                    <button class="nav-link btn btn-link" data-toggle="modal" data-target="#registerModalCenter">Register</button>
                                </li>
                                <li class="nav-item mr-3" v-if="!Userinfo">
                                    <button class="nav-link btn btn-link" data-toggle="modal" data-target="#loginModalCenter">Log In</button>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div v-if="Userinfo">
                        <div class="dropdown">
                            <button class="btn btn-white dropdown-toggle loginbtn" type="button" id="dropdownMenuButton"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{ Userinfo.name }}
                            </button>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="#" @click.prevent="logout">Logout</a>
                            </div>
                        </div>
                    </div>
                </nav>
            </header>
        </div>

    <!--log in  Modal -->
    <div class="modal fade" id="loginModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
      aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">log in </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <div style="color: red;" v-if="errorMessage" class="error-message">{{ errorMessage }}</div>
              <label for="exampleInputEmail1">Email address</label>
              <input type="email" v-model="email" class="form-control" id="exampleInputEmail1"
                aria-describedby="emailHelp" placeholder="Enter email">
              <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Password</label>
              <input type="password" v-model="password" class="form-control" id="exampleInputPassword1"
                placeholder="Password">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" @click="login">Login</button>
            <a href="/auth/facebook" class="btn btn-primary">Login with Facebook</a>
            <a href="/auth/google" class="btn btn-primary">Login with Google</a>
          </div>
        </div>
      </div>
    </div>
    <!--refgister in  Modal -->
    <div class="modal fade" id="registerModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
      aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Register </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label for="exampleInputEmail1">Full name</label>
              <input type="email" v-model="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                placeholder="Enter email">
            </div>

            <div class="form-group">
              <label for="exampleInputEmail1">Email address</label>
              <input type="email" v-model="email" class="form-control" id="exampleInputEmail1"
                aria-describedby="emailHelp" placeholder="Enter email">
              <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
            </div>
            <div style="color: red;" v-if="errorMessage" class="error-message">{{ errorMessage }}</div>

            <div class="form-group">
              <label for="exampleInputPassword1">Password</label>
              <input type="password" v-model="password" class="form-control" id="exampleInputPassword1"
                placeholder="Password">
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Confirm Password</label>
              <input type="password" v-model="confirmpassword" class="form-control" id="exampleInputPassword1"
                placeholder="Password">
            </div>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" @click="register">Register</button>
            <a href="/auth/facebook" class="btn btn-primary">Register with Facebook</a>
            <a href="/auth/google" class="btn btn-primary">Register with Google</a>
          </div>
        </div>
      </div>
    </div>
    <!-- Add any other header content you need -->
  </div>
</template>
  
<script>
import axios from 'axios';
export default {
  data() {
    return {
      name: '',
      lastname: '',
      email: '',
      password: '',
      confirmpassword: '',
      errorMessage: '',
      Userinfo: [],
      showDropdown: false,
      Userinfo: null,
      userType: [],
    }
  },
  created() {
    this.getuserInfo();
  },
  methods: {
    register() {

      if (this.password !== this.confirmpassword) {
        this.errorMessage = "Passwords do not match";
        return; // Exit early if passwords do not match
      }

      // Clear previous error message
      this.errorMessage = '';

      // Proceed with registration
      const data = {
        name: this.name,
        // lastname: this.lastname,
        email: this.email,
        password: this.password,
        password_confirmation: this.confirmpassword,
      };

      axios.post('/auth-register', data)
        .then(response => {
          this.$router.push('/home');
          $('#registerModalCenter').modal('hide');
          this.getuserInfo();
          console.log(response.data);
          // Optionally, redirect user or show success message
        })
        .catch(error => {
          // Handle error
          console.error(error.response.data);
          this.errorMessage = error.response.data.message; // Display error message
        });
    },
    login() {
      const data = {
        email: this.email,
        password: this.password,
      };

      axios.post('/auth-login', data)
        .then(response => {
          $('#loginModalCenter').modal('hide');
          const userType = response.data.user_type;
          if (userType === 'admin') {
            this.$router.push('/dashboard');
          } else {
            this.$router.push('/home');
          }

          this.getuserInfo();
          console.log(response.data);
        })
        .catch(error => {
          // Handle error
          console.error(error.response.data);
          this.errorMessage = error.response.data.message; // Display error message
        });
    },

    getuserInfo() {
      // alert('yes');
      axios.get('/get-user-info', {
        withCredentials: true // Include cookies with the request
      })
        .then(response => {
          this.Userinfo = response.data; // Set user info if request is successful
        })
        .catch(error => {
          console.error('There was an error!', error);
          this.Userinfo = null; // Ensure Userinfo is null if there's an error
        });
    },

    logout() {
      axios.post('/logout')
        .then(response => {
          this.getuserInfo();
          this.$router.push('/home');

        })
        .catch(error => {
          console.error('Logout failed:', error);
        });
    }

  }
};
</script>
  
<style scoped>
.costumHeader {
  display: grid;
  justify-content: end;
  height: 46px;
  padding: 5px 4px 7px 5px;
  box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;
}

.button {
  margin: 0 5px;
}

/* .loginbtn {
  display: grid;
  justify-content: end;
  margin-right: 10px;
  float: right;
  background: #ffffff;
  border: 0px;
  color: black;
} */

.btn-primary {
  background: #ffffff;
  border: 0px;
  color: black;
}

.btn-primary :hover {
  background: #426085;
  border: 0px;
  color: #fffdfd;
}

.costumHeader {
  height: 46px;
  padding: 5px 4px 7px 5px;
  box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;
}
.nav-item:hover{
  background-color: #426085;
}

.nav-link:hover{
 color: white !important;
}
/* .costumHeader button {
  display: grid;
  justify-content: end;
  margin-right: 10px;
  float: right;
 
} */
/* Add your styles here */
</style>
  