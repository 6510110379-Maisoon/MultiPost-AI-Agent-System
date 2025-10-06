# AI Multi-Agent Auto Post System

โปรเจคนี้เป็นระบบ **Multi-Agent** สำหรับดึงข้อมูล, ประมวลผล และสร้างข้อความอัตโนมัติ พร้อม Dashboard สำหรับการจัดการและดูข้อมูล โดยใช้ **Laravel**, **Node.js**, และ **N8N** เพื่อสร้าง workflow อัตโนมัติ

---

## โครงสร้างโฟลเดอร์

project-root/
├─ backend-laravel/ # Laravel backend สำหรับ API และ Dashboard
│ ├─ app/
│ ├─ database/
│ ├─ routes/
│ │ ├─ api.php
│ │ └─ web.php
│ └─ ...
├─ agents/ # Node.js agents สำหรับดึงข้อมูลและประมวลผล
│ ├─ index.js
│ └─ package.json
├─ n8n/ # Workflow N8N (optional)
├─ README.md
└─ .gitignore

---

## การติดตั้งและรัน

### Laravel (Backend)

cd backend-laravel
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan serve
API จะรันที่: http://127.0.0.1:8000

---

ตัวอย่าง endpoint:

GET /api/articles → ดึงบทความทั้งหมด

POST /api/articles → สร้างบทความใหม่

---

### Agents

Node.js Agents
ติดตั้ง dependencies:
cd agents
npm install

รัน Agent:
node index.js

Agent จะดึงข้อมูลจาก API ของ Laravel และประมวลผลตาม logic ที่ตั้งไว้

---

### N8N Workflow
ติดตั้ง N8N: https://n8n.io/

ตั้ง Cron Job ให้รัน workflow ของ Agent อัตโนมัติ

ตัวอย่าง workflow:
Cron → Agent 1 → Agent 2 → Agent 3 → เก็บลง DB / Google Sheet