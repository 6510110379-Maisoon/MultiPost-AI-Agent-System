const { PrismaClient } = require('@prisma/client');
const SummaryTool = require('node-summary');
const { promisify } = require('util');

const db = new PrismaClient();
const summarizeAsync = promisify(SummaryTool.summarize);

async function runAgent2() {
    const articles = await db.article.findMany({ where: { processed: false } });
    console.log(`Found ${articles.length} articles to process`);

    for (const article of articles) {
        try {
            const summary = await summarizeAsync(article.title, article.content);
            const processedText = `[Summary] ${summary} #news #AI`;

            const pa = await db.processedArticle.create({
                data: {
                    articleId: article.id,
                    content: processedText,
                    posted: false, // ระบุ explicit
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

    console.log("All articles processed!");
}

runAgent2();
