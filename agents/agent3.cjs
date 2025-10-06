const { PrismaClient } = require('@prisma/client');
const fs = require('fs');

const prisma = new PrismaClient();

async function runAgent3() {
    const processedArticles = await prisma.processedArticle.findMany({ where: { posted: false } });
    console.log(`Found ${processedArticles.length} articles to post`);

    if (processedArticles.length === 0) {
        console.log("No articles to post. Exiting...");
        return;
    }

    for (const pa of processedArticles) {
        const postText = `🚀 Post: ${pa.content}`;
        fs.appendFileSync('posts.txt', postText + '\n\n');

        await prisma.processedArticle.update({
            where: { id: pa.id },
            data: { posted: true },
        });

        console.log(`Created post for processed article ID: ${pa.articleId}`);
    }
}

runAgent3();
