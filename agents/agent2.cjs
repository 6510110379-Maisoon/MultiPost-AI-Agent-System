const { PrismaClient } = require('@prisma/client');
const SummaryTool = require('node-summary');
const { promisify } = require('util');

const db = new PrismaClient();
const summarizeAsync = promisify(SummaryTool.summarize);

// ฟังก์ชันดึง hashtag จากเนื้อหาข่าว
function extractHashtags(text, limit = 3) {
    // แทนที่อักขระพิเศษทั้งหมด ยกเว้นภาษาไทย/อังกฤษ/ตัวเลข/ช่องว่าง
    const words = text
        .replace(/[^ก-๛a-zA-Z0-9\s]/g, '') // ก-๛ = ตัวอักษรไทยครบ (รวมวรรณยุกต์)
        .split(/\s+/)
        .filter(w => w.length > 2); // กรองคำสั้น ๆ เช่น "AI" ก็เก็บได้

    const freq = {};
    words.forEach(w => {
        const word = w.toLowerCase();
        freq[word] = (freq[word] || 0) + 1;
    });

    const topWords = Object.entries(freq)
        .sort((a, b) => b[1] - a[1])
        .slice(0, limit)
        .map(([word]) => `#${word}`);

    return topWords.join(' ');
}

async function runAgent2() {
    const articles = await db.article.findMany({ where: { processed: false } });
    console.log(`Found ${articles.length} articles to process`);

    for (const article of articles) {
        try {
            const summary = await summarizeAsync(article.title, article.content);

            // ดึง hashtag จาก title + content
            const hashtags = extractHashtags(article.title + ' ' + article.content);

            const processedText = `${summary} ${hashtags}`;

            const pa = await db.processedArticle.create({
                data: {
                    articleId: article.id,
                    content: processedText,
                    posted: false,
                },
            });

            await db.article.update({
                where: { id: article.id },
                data: { processed: true },
            });

            console.log(`Processed article ID: ${article.id}, ProcessedArticle ID: ${pa.id}`);
        } catch (error) {
            console.error(`Error processing article ID ${article.id}:`, error);
        }
    }

    console.log('All articles processed!');
}

runAgent2();
