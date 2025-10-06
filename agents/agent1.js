require('dotenv').config();
const axios = require('axios');

async function fetchArticles() {
    try {
        const response = await axios.get('https://jsonplaceholder.typicode.com/posts');
        console.log(response.data);
    } catch (error) {
        console.error(error);
    }
}

fetchArticles();
