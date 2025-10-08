const Parser = require('rss-parser');
const { PrismaClient } = require('@prisma/client');
const axios = require('axios');
const cheerio = require('cheerio');

const prisma = new PrismaClient();
const parser = new Parser();

const RSS_URL = "https://www.thairath.co.th/rss/news";

async function fetchFullContent(url) {
    try {
        const { data } = await axios.get(url);
        const $ = cheerio.load(data);

        // ดึงเนื้อหาข่าว
        const content = $('.article-body p')
            .map((i, el) => $(el).text().trim())
            .get()
            .join('\n\n');

        // พยายามหาภาพหลักจากหลายแหล่ง
        let image_url =
            $('meta[property="og:image"]').attr('content') || // ใช้รูปจาก meta
            $('figure img').first().attr('src') ||
            $('.article-body img').first().attr('src') ||
            '';

        // ถ้าได้ลิงก์แบบ relative (ไม่ขึ้นต้นด้วย http)
        if (image_url && !image_url.startsWith('http')) {
            image_url = 'https://www.thairath.co.th' + image_url;
        }

        return { content, image_url };
    } catch (error) {
        console.error('Error fetching full content:', error.message);
        return { content: '', image_url: '' };
    }
}

async function runAgent1() {
    try {
        console.log("🟢 Agent 1 started — fetching RSS feed...");
        const feed = await parser.parseURL(RSS_URL);
        const items = feed.items.slice(0, 5);

        for (const item of items) {
            const exists = await prisma.article.findFirst({ where: { title: item.title } });
            if (!exists) {
                const { content, image_url } = await fetchFullContent(item.link);

                await prisma.article.create({
                    data: {
                        title: item.title,
                        content: content || item.contentSnippet || item.description || '',
                        image_url,
                        processed: false,
                    },
                });

                console.log(`✅ Added article: ${item.title}`);
            } else {
                console.log(`⚠️ Skipped duplicate article: ${item.title}`);
            }
        }

        console.log("🟢 Agent 1 finished.");
    } catch (error) {
        console.error("❌ Error in Agent 1:", error);
    }
}

runAgent1();
