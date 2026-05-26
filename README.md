#download vite tailwindcss
npm install -D tailwindcss @tailwindcss/vite

#Siapkan Thunderclient 
untuk melakukan testing post and get

#flowchart
flowchart TD

    A[Sensor Infrared FC-51] --> B[ESP32 / NodeMCU]

    B --> C[Koneksi WiFi]

    C --> D[Laravel API /api/sensor]

    D --> E[Controller Laravel]

    E --> F[(Database MySQL)]

    F --> G[Dashboard Monitoring]

    G --> H[Grafik Realtime Chart.js]

    G --> I[Status Sensor Online/Offline]

    G --> J[Riwayat Data Sensor]

#
