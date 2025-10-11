<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Smart Parking Realtime</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 font-sans min-h-screen flex flex-col items-center justify-center py-10 overflow-x-hidden">

  <!-- Logo -->
  <div class="absolute top-6 left-6 flex items-center space-x-2">
    <a href="/">
      <img src="{{ asset('images/parktech-logo.png') }}" alt="Parktech Logo" class="h-12"> 
    </a>
  </div>

  <h2 class="text-3xl md:text-5xl font-bold mb-12 text-gray-800 text-center">
    Smart Parking Dashboard
  </h2>

  <div class="flex flex-col md:flex-row items-center justify-center gap-20 px-6 w-full">

    <!-- Left Side (Row A & B) -->
    <div class="space-y-16">
      <!-- Row A -->
      <div>
        <p class="text-gray-600 font-semibold mb-4 text-center md:text-left text-2xl">← ROW A →</p>
        <div class="grid grid-cols-4 gap-8">
          <div id="slot1" class="slot bg-green-400 text-white rounded-2xl p-10 text-center text-3xl font-bold shadow-md">A1<br>FREE</div>
          <div id="slot2" class="slot bg-red-400 text-white rounded-2xl p-10 text-center text-3xl font-bold shadow-md">A2<br>TAKEN</div>
          <div id="slot3" class="slot bg-green-400 text-white rounded-2xl p-10 text-center text-3xl font-bold shadow-md">A3<br>FREE</div>
          <div id="slot4" class="slot bg-red-400 text-white rounded-2xl p-10 text-center text-3xl font-bold shadow-md">A4<br>TAKEN</div>
        </div>
      </div>

      <!-- Row B -->
      <div>
        <p class="text-gray-600 font-semibold mb-4 text-center md:text-left text-2xl">← ROW B →</p>
        <div class="grid grid-cols-4 gap-8">
          <div class="bg-red-400 text-white rounded-2xl p-10 text-center text-3xl font-bold shadow-md">B1<br>TAKEN</div>
          <div class="bg-green-400 text-white rounded-2xl p-10 text-center text-3xl font-bold shadow-md">B2<br>FREE</div>
          <div class="bg-green-400 text-white rounded-2xl p-10 text-center text-3xl font-bold shadow-md">B3<br>FREE</div>
          <div class="bg-red-400 text-white rounded-2xl p-10 text-center text-3xl font-bold shadow-md">B4<br>TAKEN</div>
        </div>
      </div>
    </div>

    <!-- Drive Lane -->
    <div class="flex flex-col items-center">
      <div class="bg-red-500 text-white px-6 py-2 rounded-t-lg mb-3 text-lg font-semibold shadow">
        ↑ EXIT
      </div>
      <div class="bg-gray-200 border-dashed border-4 border-gray-400 rounded-2xl w-32 md:w-48 h-[600px] flex flex-col justify-center items-center text-gray-700 font-semibold text-xl tracking-wide shadow-inner">
        <span>↑↑</span>
        <span>DRIVE LANE</span>
        <span>↑↑</span>
      </div>
      <div class="bg-green-500 text-white px-6 py-2 rounded-b-lg mt-3 text-lg font-semibold shadow">
        ↑ ENTRANCE
      </div>
    </div>

    <!-- Right Side (Row C & D) -->
    <div class="space-y-16">
      <!-- Row C -->
      <div>
        <p class="text-gray-600 font-semibold mb-4 text-center md:text-right text-2xl">← ROW C →</p>
        <div class="grid grid-cols-4 gap-8">
          <div class="bg-green-400 text-white rounded-2xl p-10 text-center text-3xl font-bold shadow-md">C1<br>FREE</div>
          <div class="bg-red-400 text-white rounded-2xl p-10 text-center text-3xl font-bold shadow-md">C2<br>TAKEN</div>
          <div class="bg-green-400 text-white rounded-2xl p-10 text-center text-3xl font-bold shadow-md">C3<br>FREE</div>
          <div class="bg-red-400 text-white rounded-2xl p-10 text-center text-3xl font-bold shadow-md">C4<br>TAKEN</div>
        </div>
      </div>

      <!-- Row D -->
      <div>
        <p class="text-gray-600 font-semibold mb-4 text-center md:text-right text-2xl">← ROW D →</p>
        <div class="grid grid-cols-4 gap-8">
          <div class="bg-green-400 text-white rounded-2xl p-10 text-center text-3xl font-bold shadow-md">D1<br>FREE</div>
          <div class="bg-red-400 text-white rounded-2xl p-10 text-center text-3xl font-bold shadow-md">D2<br>TAKEN</div>
          <div class="bg-green-400 text-white rounded-2xl p-10 text-center text-3xl font-bold shadow-md">D3<br>FREE</div>
          <div class="bg-green-400 text-white rounded-2xl p-10 text-center text-3xl font-bold shadow-md">D4<br>FREE</div>
        </div>
      </div>
    </div>
  </div>

  <!-- JS Realtime Update -->
  <script>
    async function updateSlots() {
      try {
        const response = await fetch('/api/parkir/status');
        const data = await response.json();

        for (let i = 1; i <= 4; i++) {
          const topic = `parkir/sensor${i}`;
          const status = data[topic] || "FREE";
          const slotEl = document.getElementById(`slot${i}`);
          
          if (slotEl) {
            slotEl.classList.remove("bg-green-400", "bg-red-400");
            if (status === "ISI") {
              slotEl.classList.add("bg-red-400");
              slotEl.innerHTML = `A${i}<br>TAKEN`;
            } else {
              slotEl.classList.add("bg-green-400");
              slotEl.innerHTML = `A${i}<br>FREE`;
            }
          }
        }
      } catch (error) {
        console.error("Gagal mengambil data parkir:", error);
      }
    }

    setInterval(updateSlots, 2000);
    updateSlots();
  </script>

</body>
</html>
