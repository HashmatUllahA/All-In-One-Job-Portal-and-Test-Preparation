<template>
  <div class="row">
    <div class="mainbody col-2">
      <sidebar-component></sidebar-component>
    </div>

    <div class="col-10">
      <div>
        <button type="button" class="btn btn-info folat-right mr-3" data-toggle="modal" data-target="#addBookModalCenter">
          + Book
        </button>
      </div>

      <div class="header bg-info text-center mt-2 p-2">
        <span class="h5">lest of the books</span>
      </div>
      <div class="books-container">
        <div class="book-card" v-for="book in allBooks" :key="book.id">
          <div class="book-images">
            <div v-for="image in book.images" :key="image.id" class="book-image">
              <img :src="image.image_path" :alt="book.title" />
            </div>
          </div>
          <div class="book-details">
            <h3>{{ book.title }}</h3>
            <p>{{ book.description }}</p>

            <button style="float: right;" class="btn-danger" @click="DeleteBook(book.id)">delete</button>
            <button style="float: right;" class="btn-info" @click="previewBook(book.file_path)">Preview</button>
          </div>
        </div>
      </div>
    </div>
    <!--add book in  Modal -->
    <div class="modal fade" id="addBookModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
      aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Add New Book </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label for="departmentSelect">Select Department</label>
              <select id="departmentSelect" @change="fetchSubDepartmentsForSubjects" v-model="selected_department_id"
                class="form-control">
                <option value="" disabled>Select an option</option>
                <option v-for="data in departmentRecordForSubdepartment" :key="data.id" :value="data.id">{{
                  data.title }}
                </option>
              </select>
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Select Sub Department</label>
              <select class="form-control" v-model="sub_departemnt_selected_id">
                <option value="" disabled>Select option</option>
                <option v-for="subd in subdepartemnts" :key="subd.id" :value="subd.id">{{ subd.title }}
                </option>
              </select>
            </div>
            <div class="form-group">
              <div style="color: red;" v-if="errorMessage" class="error-message">{{ errorMessage }}</div>
              <label for="exampleInputEmail1">Title</label>
              <input type="email" v-model="BookTitle" class="form-control" id="exampleInputEmail1"
                aria-describedby="emailHelp" placeholder="Enter Book Title">
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Description</label>
              <input type="text" v-model="bookDescription" class="form-control" id="exampleInputPassword1"
                placeholder="enter Description">
            </div>
            <div class="form-group">
              <label for="bookFileInput">Select Book File</label>
              <input type="file" @change="onBookFileChange" class="form-control-file" id="bookFileInput">
            </div>
            <div class="form-group">
              <label for="bookImageInput">Select Book Image</label>
              <input type="file" @change="onBookImageChange" class="form-control-file" id="bookImageInput">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" @click="addBook">Add Book</button>
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

export default {
  components: {
    SidebarComponent,
  },
  data() {
    return {
      selected_department_id: '',
      sub_departemnt_selected_id: '',
      BookTitle: '',
      bookDescription: '',
      bookFile: null,
      bookImage: null,
      departmentRecordForSubdepartment: [],
      subdepartemnts: [],
      errorMessage: '',
      allBooks: []
    };
  },
  created() {
    this.getBooks();
    this.selectDepartmentForSubdepartment();
  },
  methods: {
    previewBook(filePath) {
      // Open the file path in a new tab
      window.open(filePath, '_blank');
    },
    DeleteBook(bookId) {
      Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.isConfirmed) {
          axios.delete(`/delete-book/${bookId}`)
            .then(response => {
              console.log(response.data);
              this.getBooks(); // Refresh the book list after deletion
              Swal.fire(
                'Deleted!',
                'Your book has been deleted.',
                'success'
              );
            })
            .catch(error => {
              console.error(error);
              Swal.fire(
                'Error!',
                'There was an error deleting the book.',
                'error'
              );
            });
        }
      });
    },
    onBookFileChange(event) {
      this.bookFile = event.target.files[0];
      this.bookFileType = this.bookFile.type;
    },
    onBookImageChange(event) {
      this.bookImage = event.target.files[0];
    },
    addBook() {
      const formData = new FormData();
      formData.append('department_id', this.selected_department_id);
      formData.append('sub_department_id', this.sub_departemnt_selected_id); // Ensure this is correct
      formData.append('title', this.BookTitle);
      formData.append('description', this.bookDescription);
      formData.append('book_file', this.bookFile);
      formData.append('book_image', this.bookImage);
      formData.append('file_type', this.bookFileType);
      formData.append('original_name', this.bookFile.name);
      formData.append('file_path', '');

      axios.post('/add-new-book', formData, {
        headers: {
          'Content-Type': 'multipart/form-data'
        }
      })
        .then(response => {
          this.getBooks();
          console.log(response.data);
          Swal.fire({
            title: 'Success!',
            text: 'Book and image added successfully.',
            icon: 'success',
            confirmButtonText: 'OK'
          });
        })
        .catch(error => {
          // Handle error
          console.error(error);
          this.errorMessage = error.response.data.message; // Display error message
        });
    },
    selectDepartmentForSubdepartment() {
      axios.get('/get-subDepartemnt-for-subdepartment').then((response) => {
        this.departmentRecordForSubdepartment = response.data.departmentRecordForSubdepartment;
      }).catch(error => {
        console.error('Error fetching departments:', error);
      });
    },
    getBooks() {
      axios.get('/get-all-books').then((response) => {
        this.allBooks = response.data;
      }).catch(error => {
        console.error('Error fetching departments:', error);
      });
    },
    fetchSubDepartmentsForSubjects() {
      if (this.selected_department_id) {
        axios.get(`/get-subDepartemnt-for-subject/${this.selected_department_id}`).then((response) => {
          this.subdepartemnts = response.data;
          this.fetchSubject(); // Fetch subjects when sub-departments are loaded
        }).catch(error => {
          console.error('Error fetching subdepartments:', error);
        });
      } else {
        this.subdepartemnts = [];
        this.fetchSubject(); // Fetch subjects without filtering by sub-department
      }
    },

  },



}

</script>
    
<style scoped>
.books-container {
  display: flex;
  flex-wrap: wrap;
  gap: 20px;
  justify-content: center;
}

.book-card {
  background: #fff;
  border: 1px solid #ddd;
  border-radius: 8px;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  overflow: hidden;
  width: 300px;
  margin: 10px;
  transition: transform 0.3s;
}

.book-card:hover {
  transform: translateY(-5px);
}

.book-images {
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
  align-items: center;
  background: #f8f8f8;
  padding: 10px;
}

.book-image img {
  max-width: 100%;
  height: auto;
  margin: 5px;
  border-radius: 4px;
}

.book-details {
  padding: 15px;
  text-align: center;
}

.book-details h3 {
  margin: 10px 0;
  font-size: 1.5em;
}

.book-details p {
  color: #555;
  font-size: 1em;
}

.bg-info {
  color: white;
  --bs-bg-opacity: 1;
  background-color: rgb(66 96 133) !important;
}

.totalDepartment {
  padding-left: 906px;
  margin-right: 0px !important;
  margin-top: -35px;
}

.maincontainer {
  margin-left: 261px;
  margin-top: -2px;
}

.customTable {
  width: 1090px;
}

.btn-info {
  background-color: rgb(66 96 133) !important;
  color: white;
  border: 2px solid;
}


.btn-info:hover {
  background-color: white !important;
  color: black;
  border: 2px solid;
}
</style>
    