<template>
    <footer>
  <div class="footer-container">
    <div class="footer-section contact-section">
      <h3>Contact Us</h3>
      <div class="contact-info">
        <p><i class="fas fa-phone-alt"></i> (123) 456-7890</p>
        <p><i class="fas fa-envelope"></i> testpreparation@gmail.com</p>
        <div class="social-links d-grid" style="gap: 10px;">
            <a href="https://facebook.com"><i class="fab fa-facebook"></i> Facebook</a>
          <a href="https://twitter.com"><i class="fab fa-twitter"></i> Twitter</a>
          <a href="https://instagram.com"><i class="fab fa-instagram"></i> Instagram</a>
          <a href="https://linkedin.com"><i class="fab fa-linkedin"></i> LinkedIn</a>
        </div>
      </div>
    </div>
    <div class="footer-section navigation-section">
      <h3>Quick Links</h3>
      <div class="navigation-links">
        <p><a href="/home">Home</a></p>
        <p><a href="/about-us">About Us</a></p>
        <!-- <p><a href="/advertisement">Advertisement</a></p> -->
        <p><a href="/tp/contact-Us">Contact Us</a></p>
        <p><a href="/past-p-for-usr">Past Papers</a></p>
        <p><a href="/mcqs-for-u">MCQs</a></p>
        <p><a href="/tp/books-user">Books</a></p>
      </div>
    </div>
    <div class="footer-section description-section">
      <h3>About Us</h3>
      <div class="footer-description">
        <p>At "All In One job portial and job preparation", we are dedicated to supporting your journey towards academic and professional success. Our platform provides an extensive array of MCQs, past papers,Advertisement, and syllabi specifically for test preparation in Pakistan. Whether aiming for a government position or a private sector role, our resources are meticulously curated to ensure you have the tools you need to succeed. Join our community and stay informed with the latest updates and study materials.</p>
      </div>
    </div>
    
  </div>
  <div class="footer-bottom" style="color: white;">
    <p style="text-align: center;">&copy; 2024 All In One job portial and job preparation. All rights reserved.</p>
  </div>
</footer>

</template>

<script>
export default {
  name: 'Footer',
  data() {
    return {};
  }
};
</script>

<style scoped>
footer {
  background-color: #4c9967 ;
  color: #fff;
  padding: 5px 0;
  font-family: Arial, sans-serif;
}

.footer-container {
  display: flex;
  flex-wrap: wrap;
  justify-content: space-between;
  max-width: 1200px;
  margin: 0 auto;
}

.footer-section {
  flex: 1;
  margin: 10px;
  padding: 20px;
  min-width: 250px;
}

.footer-section h3 {
  margin-bottom: 20px;
  font-size: 1.5em;
  border-bottom: 2px solid #fff;
  display: inline-block;
}

.contact-info p,
.navigation-links p,
.footer-description p {
  margin: 10px 0;
}

.social-links a {
  display: inline-block;
  margin-right: 10px;
  color: #fff;
  text-decoration: none;
  transition: color 0.3s ease;
}

.social-links a:hover {
  color: #ccc;
}

.navigation-links a {
  color: #fff;
  text-decoration: none;
  display: block;
  margin: 5px 0;
  transition: color 0.3s ease;
}

.navigation-links a:hover {
  color: #ccc;
}

.footer-description {
  line-height: 1.6;
}

/* Responsive design */
@media (max-width: 768px) {
  .footer-container {
    flex-direction: column;
  }
}

</style>