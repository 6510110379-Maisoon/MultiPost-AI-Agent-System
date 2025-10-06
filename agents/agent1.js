// agents/agent1.js
import fetch from "node-fetch";

const API_URL = "https://jsonplaceholder.typicode.com/posts"; // ตัวอย่าง JSON API
const LARAVEL_API = "http://127.0.0.1:8000/api/articles"; // Laravel endpoint

async function runAgent1() {
    try {
        console.log("🟢 Agent 1 started — fetching data...");

        // ดึงข้อมูลจาก API
        const res = await fetch(API_URL);
        const posts = await res.json();

        // จำกัดให้เอาแค่ 3-5 รายการแรก
        const limited = posts.slice(0, 5);

        // วนส่งข้อมูลเข้า Laravel API
        for (const post of limited) {
            const payload = {
                title: post.title,
                content: post.body,
            };

            const response = await fetch(LARAVEL_API, {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify(payload),
            });

            if (response.ok) {
                console.log(`✅ Added article: ${post.title}`);
            } else {
                console.error(`❌ Failed to add: ${post.title}`);
            }
        }

        console.log("🟢 Agent 1 finished.");
    } catch (error) {
        console.error("❌ Error in Agent 1:", error);
    }
}

runAgent1();
