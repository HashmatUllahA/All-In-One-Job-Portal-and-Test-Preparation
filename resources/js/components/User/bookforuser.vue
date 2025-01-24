<template>
    <div>
        <div class="header col-10">
            <div class="d-flex flex-wrap">
                <div class="book-card" v-for="book in allBooks" :key="book.id">
                    <div class="book-images">
                        <div v-for="image in book.images" :key="image.id" class="book-image">
                            <img :src="image.image_path" :alt="book.title">
                        </div>
                        <!-- Add a click event to toggle book details -->
                        <div class="dots" @click="toggleDetails(book)">...</div>
                        <!-- Book details card -->
                        <div class="book-details-card" v-if="book.showDetails">
                            <p>Title: {{ book.title }}</p>
                            <p>Description: {{ book.description }}</p>
                            <button class="btn-info float-right" @click="previewBook(book.file_path)">Open</button>
                        </div>
                    </div>
                </div>
            </div>
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
            allBooks: [],
        };
    },
    created() {
        this.getBooks();
    },
    methods: {
        getBooks() {
            axios.get('/get-all-books').then((response) => {
                this.allBooks = response.data;
            }).catch(error => {
                console.error('Error fetching books:', error);
            });
        },
        toggleDetails(clickedBook) {
            // Toggle the showDetails property of the clicked book
            clickedBook.showDetails = !clickedBook.showDetails;
            
            // Hide details of other books
            this.allBooks.forEach(book => {
                if (book !== clickedBook) {
                    book.showDetails = false;
                }
            });
        },
         previewBook(filePath) {
      // Open the file path in a new tab
      window.open(filePath, '_blank');
    },
    }
}
</script>


<style scoped>
.btn-info {
  background-color: rgb(66 96 133) !important;
  color: white;
  border: 2px solid;
}
.book-details-card {
    position: absolute;
    top: 30px; /* Adjust as needed to position below the dots */
    right: 0;
    background-color: #f0f0f0;
    border: 1px solid #ccc;
    padding: 10px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    z-index: 1000; /* Ensure it's above other content */
    max-width: 300px; /* Adjust width as needed */
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
    position: relative;
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
    padding: 10px;
}

.dots {
    position: absolute;
    top: 10px;
    right: 10px;
    cursor: pointer;
    font-size: 24px;
    display: none;
    color: white;
    background-color: #363636;
    padding: 5px;
    border-radius: 20%;
    position: absolute;
}

.book-card:hover .dots {
    display: block;
}
</style>


<style scoped>
 .book-card {
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            width: 300px;
            margin: 10px;
            transition: transform 0.3s;
            position: relative;
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

        /* .book-details {
            display: none;
            padding: 10px;
        } */

        .dots {
            position: absolute;
            top: 10px;
            right: 10px;
            cursor: pointer;
            font-size: 24px;
            display: none;
        }

        .book-card:hover .dots {
            display: block;
        }
</style>