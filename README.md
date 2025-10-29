# 🎧 AI-Powered Audio & Video Transcription Platform (Laravel & JavaScript)

An advanced **Laravel-based AI Transcription Platform** that allows users to upload **audio or video files** and automatically generate **highly accurate transcriptions** in **50+ languages**.  
It includes **proofreading**, **speaker identification**, **subscription plans**, and a **powerful admin dashboard** — all built with scalability and usability in mind.

---

## 🚀 Features

### 🧠 AI Transcription
- Supports **50+ languages** for multilingual transcription.
- Automatically detects speech and converts it to text.
- Works with both **audio** and **video** files.
- Background job processing for smooth performance.

### ✍️ Proofreading Interface
- User-friendly **text editor** for proofreading and editing transcripts.
- Manage and label **multiple speakers** easily.
- Real-time text saving and updates.

### 💳 Subscription Plans & Payments
- Integrated **payment gateway** for secure plan purchases.
- Flexible **plans and credits** system to limit transcription usage.
- Automatic plan renewal and usage tracking.

### 👤 User Dashboard
- View and manage uploaded files.
- Access and edit transcriptions anytime.
- Track plan usage and payment history.

### 🛠️ Admin Panel
- Manage users, plans, payments, and transcriptions.
- Monitor overall system usage and AI API logs.
- Dashboard with key analytics and system insights.

---

## 🧩 Tech Stack

**Backend:** Laravel (PHP 8+)  
**Frontend:** JQuery & Bootstrap
**Database:** MySQL  
**Queue System:** Laravel Queue
**AI Integration:** OpenAI Whisper/Custom API  
**Payment Gateway:** Razorpay 
**Storage:** Local Storage

---

## ⚙️ Installation


### 1️⃣ Clone the Repository
```bash
git clone https://github.com/shahrukh14/transcription-ai.git
cd transcription-ai
```
2️⃣ Install Dependencies
```bash
composer install
```

3️⃣ Configure Environment
- Set your databse name databse username and password in uout **.env** file.

4️⃣ Run Migrations and Seeders
```bash
php artisan migrate
php artisan db:seed
```

5️⃣ Run the development server 
```bash
php artisan serve
```

🧾 Usage Workflow

* Login / Register
* Upload an audio or video file.
* The system automatically transcribes it using AI.
* Review and proofread the transcription.
* Edit speakers, text, and metadata.
*Download or share the final transcript.

🧠💻 Developer
Developed by Mohammed Shahrukh
Laravel & AI Enthusiast 💻 | Building Intelligent Web Applications 🚀
