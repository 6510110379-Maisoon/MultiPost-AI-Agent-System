// agents/agent1.cjs
const fetch = require('node-fetch');
const { PrismaClient } = require('@prisma/client');

const API_URL = "https://jsonplaceholder.typicode.com/posts";
const prisma = new PrismaClient();

async function runAgent1() {
    const res = await fetch(API_URL);
    const posts = await res.json();
    const limited = posts.slice(0, 5);

    for (const post of limited) {
        await prisma.article.create({
            data: {
                title: post.title,
                content: post.body,
                processed: false,
            },
        });
        console.log(`✅ Added article: ${post.title}`);
    }

    console.log("🟢 Agent 1 finished.");
}

runAgent1();
