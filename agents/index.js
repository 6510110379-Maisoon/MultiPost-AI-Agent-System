const fetch = require('node-fetch'); // ต้องใช้ node-fetch@2
const API_URL = 'http://127.0.0.1:8000/api/articles';

async function runAgent() {
    try {
        const response = await fetch(API_URL);

        if (!response.ok) {
            console.error('HTTP error', response.status, response.statusText);
            return;
        }

        // แปลงเป็น text ก่อน
        const text = await response.text();
        console.log('Raw response:', text);

        // parse JSON
        const articles = JSON.parse(text);
        console.log('Articles:', articles);

    } catch (err) {
        console.error('Error fetching articles:', err);
    }
}

runAgent();
