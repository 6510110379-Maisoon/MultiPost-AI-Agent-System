// agents/agent1.cjs
const Parser = require('rss-parser');
const { PrismaClient } = require('@prisma/client');

const prisma = new PrismaClient();
const parser = new Parser();

const RSS_URL = "https://www.thairath.co.th/rss/news";

async function runAgent1() {
    try {
        console.log("🟢 Agent 1 started — fetching RSS feed...");

        const feed = await parser.parseURL(RSS_URL);
        // เอาแค่ 5 ข่าวล่าสุด
        const items = feed.items.slice(0, 5);

        for (const item of items) {
            await prisma.article.create({
                data: {
                    title: item.title,
                    content: item.content || item.contentSnippet || '',
                    processed: false,
                },
            });
            console.log(`✅ Added article: ${item.title}`);
        }

        console.log("🟢 Agent 1 finished.");
    } catch (error) {
        console.error("❌ Error in Agent 1:", error);
    }
}

runAgent1();
