 Weather App – Full Stack Guide
This is a decoupled weather application built with:

Frontend: Next.js + TypeScript + TailwindCSS + RippleUI

Backend: Laravel 12 API that fetches weather data from OpenWeatherMap


 Requirements
Node.js (v18+)

PHP (v8.2+)

Composer

Git


Clone the Repository
bash
Copy
Edit
git clone https://github.com/your-username/weather-app.git
cd weather-app


Backend (Laravel 12 API)
📦 Setup

cd backend
🖥️ Start the Backend Dev Server
php artisan serve
The API will be running at http://localhost:8000

💻 Frontend (Next.js + TailwindCSS)
📦 Setup

cd ../frontend
npm install
⚙️ Configure API Endpoint
In .env.local, set the backend URL:

NEXT_PUBLIC_API_URL=http://localhost:8000/api
🖥️ Start the Frontend Dev Server

npm run dev
The app will be running at http://localhost:3000

✅ Features
🌍 Search weather by city name

🌡️ View current temperature, humidity, and wind

📅 Forecast for the next 3 days

🌗 Toggle temperature units (°C / °F)

📦 Decoupled architecture (Laravel API + Next.js UI)

🧪 API Test
You can test the weather API directly:

GET http://localhost:8000/api/weather?city=Nairobi
