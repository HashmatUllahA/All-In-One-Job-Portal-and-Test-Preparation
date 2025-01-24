<template>
  <!-- <img src="./Department/pakistian.JPG" alt=""> -->
  <div> 
    <div id="slideshow">
      <div class="slide-wrapper">
        <div class="slide"><img src="/resources/js/components/Department/finger.JPG" alt="Image 1"></div>
        <div class="slide"><img src="/resources/js/components/Department/finger.JPG" alt="Image 2"></div>
        <div class="slide"><img src="/resources/js/components/Department/finger.JPG" alt="Image 3"></div>
        <div class="slide"><img src="/resources/js/components/Department/finger.JPG" alt="Image 3"></div>
      </div>
    </div>
    <!-- Start of Service section
	============================================= -->
	<section id="in-service-2" class="in-service-section-2 position-relative">
		<span class="in-service-bg position-absolute"><img src="./images/img/bg/ser-bg1.png" alt=""></span>
		<div class="container">
			<div class="in-service-top-content d-flex flex-wrap justify-content-between align-items-center">
				<div class="in-service-title-text wow fadeInLeft" data-wow-delay="200ms" data-wow-duration="1000ms">
					<div class="in-section-title-2 headline">
						<div class="sub-title text-uppercase basic-backround">
							What We Do
						</div>
						<h2>We’re delivering the best test material.</h2>
					</div>
					<div class="in-service-title-desc">
            Explore a comprehensive collection of past papers, MCQs, and books to enhance your test preparation. Stay updated with the latest job opportunities and access detailed syllabi to guide your study journey. 
					</div>
				</div>
				<div class="in-service-title-img wow fadeInRight" data-wow-delay="300ms" data-wow-duration="1000ms">
					<!-- <img src="./images/img/about/ser-title2.jpg" alt=""> -->
          <img src="./images/img/about/ser-title3.jpg" alt="">
				</div>
			</div>
	
		</div>
	</section>
<!-- End of service section
	============================================= -->
    <div class="row" style="justify-content: center; gap: 10px; margin-top: 17px;">
      <div class="col-2 border card in-service" style="height: 200px;">
        <div style="height: 150px; display: grid; height: 150px; align-items: center; text-align: center;"
          class="bg-blck">
          <i class="fas fa-briefcase custom-icon-style basic-color"></i>
        </div>
        <div style="height: 45px; border-top: 1px solid #4c9967;" class="text-center h3 basic-color">
          <span class="span basic-color">ALL JOBS</span>
        </div>
      </div>
      <div class="col-2 border card in-service " style="height: 200px;">
        <div style="height: 150px; display: grid; height: 150px; align-items: center; text-align: center;"
          class="bg-blck">
          <i class="fas fa-tasks custom-icon-style basic-color"></i>
        </div>
        <div style="height: 45px; border-top: 1px solid #4c9967;" class="text-center h3 basic-color">
          <span class="span basic-color">MCQS</span>
        </div>
      </div>
      <div class="col-2 border card in-service" style="height: 200px;">
        <div style="height: 150px; display: grid; height: 150px; align-items: center; text-align: center;"
          class="bg-blck">
          <i class="fas fa-clipboard-list custom-icon-style basic-color"></i>
        </div>
        <div style="height: 45px; border-top: 1px solid #4c9967;" class="text-center h3 basic-color">
          <span class="span basic-color basic-color">SYLLABUS</span>
        </div>
      </div>
      <div class="col-2 border card in-service" style="height: 200px;">
        <div style="height: 150px; display: grid; height: 150px; align-items: center; text-align: center;"
          class="bg-blck">
          <i class="fas fa-file custom-icon-style basic-color"></i>
        </div>
        <div style="height: 45px; border-top: 1px solid #4c9967;" class="text-center h3 ">
          <span class="span basic-color">PAST PAPERS</span>
        </div>
      </div>
    </div>
    <div class=" text-center pera-content mt-3 wow fadeInUp" data-wow-delay="600ms" data-wow-duration="1000ms">
      <p>Test metairls For You <button class="btn in-btn">Find YOur Services</button></p>
    </div>
    <!-- Start of About section
	============================================= -->
	<section id="in-about-2" class="in-about-section-2 position-relative">
		<div class="container">
			<div class="in-about-content-2">
				<div class="row">
					<div class="col-lg-6  wow fadeInLeft">
						<div class="in-about-img-2" data-tilt data-tilt-max="5">
							<img src="./images/img/about/Aboutusimg1.jpg" alt="">
					<!-- <img src="./images/img/about/ser-title1.jpg" alt=""> -->

						</div>
					</div>
					<div class="col-lg-6">
						<div class="in-about-text-wrapper-2">
							<div class="in-section-title-2 headline  wow fadeInUp" data-wow-delay="300ms" data-wow-duration="1000ms">
								<div class="sub-title text-uppercase basic-backround">
									About Us
								</div>
								<h4>We Provide the Best Test Preparation Resources</h4>
							</div>
							<div class="in-about-text-area-1 wow fadeInUp" data-wow-delay="500ms" data-wow-duration="1000ms">
								<p>At Test Preparation, we are dedicated to empowering students and job seekers with the resources they need to succeed. Our comprehensive approach includes:</p>
                <p>Quality Materials: We offer a wide range of past papers, MCQs, and study books, carefully curated to ensure effective preparation.</p>
                <p>Updated Information: Stay informed with the latest job opportunities and relevant syllabi, helping you stay ahead in your career.</p>
                <p>Join us on your journey to success, and let us help you achieve your goals!</p>
							</div>
							
							<div class="in-btn-div">
								<button class="in-btn" href="about.html">Get Started Now</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
<!-- End of About section
	============================================= -->
    <div class="container">
      <div class="row">
        <div class="col">
          <h2 style="margin-top: 15px;text-align:center;margin-bottom: -10px;" class="basic-backround text-white">UPDATED JOBS </h2>
        </div>
      </div>
      <div class="job-container">
    <div class="row">
      <!-- First 5 jobs -->
      <div class="col-md-6">
        <div class="job-list">
          <div class="job-item" v-for="(job, index) in firstFiveJobs" :key="index">
            <span class="job-title">{{ job.job_title }}</span>
            <button class="in-btn">Apply</button>
          </div>
        </div>
      </div>
      <!-- Next 5 jobs -->
      <div class="col-md-6">
        <div class="job-list">
          <div class="job-item" v-for="(job, index) in nextFiveJobs" :key="index">
            <span class="job-title">{{ job.job_title }}</span>
            <button class="in-btn">Apply</button>
          </div>
        </div>
      </div>
    </div>
  </div>
    </div>

    <div class="container mt-3">
      <h2 class="text-center mb-4 basic-backround text-white">OUR PROVINCES</h2>

      <div class="slider">
        <div class="slider-wrapper">
          <div class="col-4 col-md-3">
            <div class="border province-card card">
              <div class="card-body">
                <div class="image-overlay">
                  <img src="./images/istockphoto-619503842-612x612.jpg" alt="">
                  <div class="overlay-text">
                    <h5 class="card-title">Punjab</h5>
                    <p>Job and test preparation materials for Punjab can be easily obtained.</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-4 col-md-3">
            <div class="border province-card card">
              <div class="card-body">
                <div class="image-overlay">
                  <img src="./images/360_F_428549695_phWJXeUkKLqCMTikwNeBVc9ISH9UA2Uq.jpg" alt="">
                  <div class="overlay-text">
                    <h5 class="card-title">Sind</h5>
                    <p>Job and test preparation materials for Sind can be easily obtained.</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-4 col-md-3">
            <div class="border province-card card">
              <div class="card-body">
                <div class="image-overlay">
                  <img src="./images/istockphoto-619503842-612x612.jpg" alt="">
                  <div class="overlay-text">
                    <h5 class="card-title">Khyber Pakhtunkhwa</h5>
                    <p>Job and test preparation materials for Khyber Pakhtunkhwa can be easily obtained.</p>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-4 col-md-3">
            <div class="border province-card card">
              <div class="card-body">
                <div class="image-overlay">
                  <img src="./images/Balochistan-2.jpg" alt="">
                  <div class="overlay-text">
                    <h5 class="card-title">Balouchistan</h5>
                    <p>Job and test preparation materials for Balouchistan can be easily obtained.</p>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-4 col-md-3">
            <div class="border province-card card">
              <div class="card-body">
                <div class="image-overlay">
                  <img src="./images\haji-peer-azad-kashmir-4405256_640.jpg" alt="">
                  <div class="overlay-text">
                    <h5 class="card-title">Azad Kashmir</h5>
                    <p>Job and test preparation materials for Azad Kashmir can be easily obtained.</p>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-4 col-md-3">
            <div class="border province-card card">
              <div class="card-body">
                <div class="image-overlay">
                  <img src="./images/My_gilgit_baltistan.jpg" alt="">
                  <div class="overlay-text">
                    <h5 class="card-title">Gilgit Baltistan</h5>
                    <p>Job and test preparation materials for Gilgit Baltistan can be easily obtained.</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Start of Benefit section
	============================================= -->
	<section id="in-benefit" class="in-benefit-section position-relative">
		<span class="shape-side position-absolute">
      <!-- <img src="./images/img/bg/shape-bg.png" alt=""> -->
    </span>
		<div class="container">
			<div class="in-benefit-content">
				<div class="row">
					<div class="col-lg-7 wow fadeInLeft" data-wow-delay="200ms" data-wow-duration="1000ms">
						<div class="in-benefit-img">
							<!-- <img src="./images//img/about/bn.jpg" alt=""> -->
							<img src="./images//img/about/bn1.jpg" alt="">
						</div>
					</div>
					<div class="col-lg-5">
						<div class="in-benefit-text">
							<div class="in-section-title-2 headline wow fadeInUp" data-wow-delay="200ms" data-wow-duration="1000ms">
								<div class="sub-title text-uppercase basic-backround">
									your Benifit
								</div>
								<h4>Your Complete Guide to Test Preparation Success</h4>
							</div>
							<div class="in-about-text-area-1 wow fadeInUp" data-wow-delay="400ms" data-wow-duration="1000ms">
                Our platform provides everything you need for successful test preparation. With a vast collection of past papers, MCQs, and study guides tailored to specific tests and syllabi, you'll be fully prepared for any challenge. Stay updated with the latest job openings and test dates, so you never miss an opportunity. Plus, our user-friendly platform ensures that you can access all these resources anytime, anywhere, making it easy to study on the go. We're here to support your journey, guiding you step by step towards achieving your career or academic goals.
							</div>
							<!-- <div class="in-btn-2 position-relative wow fadeInUp" data-wow-delay="600ms" data-wow-duration="1000ms">
								<a href="contact.html">Get Started Now</a>
							</div> -->
						</div>
					</div>
				</div>
			</div>
      <div class="in-benefit-feature">
          <div class="row">
              <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="400ms" data-wow-duration="1000ms">
                  <div class="in-benefit-feature-item position-relative">
                      <span class="serial position-absolute">01</span>
                      <div class="inner-icon">
                          <i class="flaticon-privacy-policy"></i>
                          <!-- <i class="fi fi-ss-diary-clasp"></i> -->
                          <i
class=
"fi fi-rr-rules-alt"
></i>
                      </div>
                      <div class="inner-text headline">
                          <h3>Extensive Study Materials</h3> <!-- Changed from Choice and Value -->
                      </div>
                  </div>
              </div>
              <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="600ms" data-wow-duration="1000ms">
                  <div class="in-benefit-feature-item position-relative">
                      <span class="serial position-absolute">02</span>
                      <div class="inner-icon">
                          <i class="flaticon-insurance-1"></i>
                      </div>
                      <div class="inner-text headline">
                          <h3>Cost-Effective Solutions</h3> <!-- Changed from Money Saving -->
                      </div>
                  </div>
              </div>
              <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="700ms" data-wow-duration="1000ms">
                  <div class="in-benefit-feature-item position-relative">
                      <span class="serial position-absolute">03</span>
                      <div class="inner-icon">
                          <i class="flaticon-family-insurance"></i>
                      </div>
                      <div class="inner-text headline">
                          <h3>Flexible Learning Options</h3> <!-- Changed from Get Flexibility -->
                      </div>
                  </div>
              </div>
              <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="800ms" data-wow-duration="1000ms">
                  <div class="in-benefit-feature-item position-relative">
                      <span class="serial position-absolute">04</span>
                      <div class="inner-icon">
                          <i class="flaticon-family"></i>
                      </div>
                      <div class="inner-text headline">
                          <h3>Achieve Exam Success</h3> <!-- Changed from Secure Life -->
                      </div>
                  </div>
              </div>
          </div>
      </div>

		</div>
	</section>								
<!-- End of Benefit section
	============================================= -->
    <div class="footer">
      <Footer />
    </div>

  </div>
</template>
  
<script>
import axios from 'axios';
import Footer from '../components/footer.vue';

export default {
  components: {
        Footer,
    },
  data() {
    return {
      newJobs: []
    };
  },
  created() {
    this.getNewJob();
  },
  methods: {
    getNewJob() {
      axios.get('/tp-newJobs').then(response => {
        this.newJobs = response.data;
      }).catch(error => {
        console.error("There was an error fetching the jobs!", error);
      });
    }
  },
  computed: {
    firstFiveJobs() {
      return this.newJobs.slice(0, 5);
    },
    nextFiveJobs() {
      return this.newJobs.slice(5, 10);
    }
  }
};
</script>

<style scoped>
body {
  font-family: Helvetica, sans-serif;
  padding: 5%;
  margin: 0;
  overflow-x: hidden;
  /* Prevent horizontal scroll */
}
.in-about-img-2 {
  position: relative;
  width: 100%;
  height: 100%;
  overflow: hidden;
}

.in-about-img-2 img {
  width: 100%;
  height: 100%;
  object-fit: cover;
}


#slideshow {
  text-align: center;
  overflow: hidden;
  height: 300px;
  /* Set height of the slider */
  width: 100%;
  /* Full width */
  /* margin: 0 auto; */
  margin-top: 10px;
  border: 1px solid black;
}

.slide-wrapper {
  width: 100%;
  /* 100% * number of slides */
  display: flex;
  /* Use flexbox for layout */
  animation: slide 30s ease infinite;
}
.basic-color{
  color: #4c9967 !important;
}
.basic-backround{
  background: #4c9967;
}
.in-btn {
  background: linear-gradient(90deg, #4c9967 0%, #4c9967 100%); /* Gradient background */
  color: white;
  padding: 10px 30px;
  border: 2px solid transparent; /* Transparent border */
  border-radius: 30px; /* Rounded corners */
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  font-weight: bold;
  cursor: pointer; /* Pointer cursor for buttons */
  transition: all 0.3s ease;
}

.in-btn:hover {
  background: white; /* Change background to white on hover */
  color: #4c9967; /* Text color changes to blue */
  border: 2px solid #4c9967; /* Add blue border on hover */
}

.basic-btn:hover {
  color: #4c9967;
  box-shadow: rgba(76, 153, 103, 0.5) 0px 7px 29px 0px; /* Change the shadow color */
  background-color: white;
}

.in-service:hover {
  background: #4c9967; /* Change background color on hover */
}

.in-service:hover .custom-icon-style,
.in-service:hover .basic-color {
  color: white !important; /* Change both icon and text color to white on hover */
}
.in-service:hover div {
  border-top-color: white; /* Change the border-top color to white on hover */
}
.slide {
  flex: 1 0 100%;
  /* Each slide takes up full width */
  height: 300px;
  /* Set height of each slide */
}

.slide img {
  width: 100%;
  /* Full width */
  height: 100%;
  /* Full height */
  object-fit: cover;
  /* Cover the container */
}

@keyframes slide {
  20% {
    transform: translateX(0);
  }

  30% {
    transform: translateX(-100%);
  }

  50% {
    transform: translateX(-100%);
  }

  60% {
    transform: translateX(-200%);
  }

  70% {
    transform: translateX(-200%);
  }

  80% {
    transform: translateX(-300%);
  }

  90% {
    transform: translateX(-300%);
  }
}

.custom-icon-style {
  color: #89c7e1;
  font-size: 50px;
}

.continorTwo {
  display: grid;
  align-items: center;
  height: 200px;
  text-align: center;
}

.span {
  color: #89c7e1;
}

.jobContainer {
  margin-top: 17px;
}

.jobContainer .col-6 {
  padding: 10px;
}

.jobContainer .col-6 .d-grid {
  gap: 10px;
}

.jobContainer .col-6 .d-grid span {
  display: block;
  padding: 5px;
  background-color: #f0f0f0;
  border: 1px solid #ccc;
  text-align: center;
}

.job-container {
  padding: 20px;
}

.job-list {
  display: flex;
  flex-direction: column;
}

.job-item {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 10px;
  border: 1px solid #ddd;
  margin-bottom: 10px;
  background-color: #f9f9f9;
}

.job-title {
  font-size: 16px;
}

.apply-button {
  background-color: #007bff;
  color: white;
  border: none;
  padding: 5px 10px;
  border-radius: 3px;
  cursor: pointer;
}

.apply-button:hover {
  background-color: #0056b3;
}
/* .province-card {
      height: 200px;
    }
    .province-card .card-body {
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      height: 100%;
      padding: 10px;
      background-color: #f0f0f0;
      border: 1px solid #ccc;
      text-align: center;
    }
    .province-card .card-body .fas {
      font-size: 3rem;
      margin-bottom: 10px;
    }
    .province-card .card-body .card-title {
      font-size: 1.5rem;
      font-weight: bold;
      color: #333;
    }
     */
.province-card {
  height: 200px;
}

.province-card .card-body {
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  height: 100%;
  border-radius: 10px;
  padding: 0px;
  background-color: #f0f0f0;
  border: 1px solid #ccc;
  text-align: center;
}

.province-card .card-body .fas {
  font-size: 3rem;
  margin-bottom: 10px;
}

.province-card .card-body .card-title {
  font-size: 1.5rem;
  font-weight: bold;
  color: white;
}

/* //////////////////////////////////////////////////// */
body {
  font-family: Arial, sans-serif;
  margin: 0;
  padding: 0;
}

.slider {
  width: 100%;
  overflow: hidden;
  background-color: #f4f4f4;
  padding: 20px 0;
}

.slider-wrapper {
  display: flex;
  width: 200%;
  /* Adjust based on the number of items */
  animation: slide-left 20s infinite linear;
}

.province-card {
  flex: 1;
  margin: 10px;
  transition: transform 0.5s ease;
}

.card {
  background-color: white;
  border-radius: 5px;
  padding: 20px;
  text-align: center;
}
.in-service:hover {
  background: #4c9967;
}

.in-service:hover .custom-icon-style {
  color: #ffffff; /* Change the icon color on hover */
}

.in-service:hover .span {
  color: #ffffff; /* Change the span text color on hover */
}
.card-body i {
  font-size: 2em;
  margin-bottom: 10px;
  color: #333;
}

.card-title {
  font-size: 1.2em;
  margin: 0;
}

@keyframes slide-left {
  0% {
    transform: translateX(0);
  }

  100% {
    transform: translateX(-50%);
    /* Adjust based on the number of items */
  }
}

.image-overlay {
  position: relative;
  overflow: hidden;
  border-radius: 5px;
}

.image-overlay img {
  width: 100%;
  vertical-align: middle;
  transition: transform 0.3s ease;
}

.overlay-text {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  text-align: center;
  color: #fff;
  padding: 20px;
  /* background-color: rgba(0, 0, 0, 0.7); */
  border-radius: 5px;
  width: 90%;
  /* Adjust as needed */
}

.overlay-text h5,
.overlay-text p {
  margin: 0;
  color: #fff;
}

.overlay-text p {
  font-size: 0.9em;
}

/* @keyframes slide {
  0% {
    transform: translateX(0);
  }
  100% {
    transform: translateX(-100%);
  }
} */</style>
  