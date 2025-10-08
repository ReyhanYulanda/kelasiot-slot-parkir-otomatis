<!DOCTYPE html>
<html>
<head>
  <title>Realtime Slot Parkir</title>
  <script src="https://unpkg.com/mqtt/dist/mqtt.min.js"></script>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f4f4f4;
      text-align: center;
      padding: 20px;
    }
    h2 {
      margin-bottom: 30px;
    }
    .grid {
      display: grid;
      grid-template-columns: repeat(2, 200px);
      justify-content: center;
      gap: 20px;
    }
    .slot {
      border-radius: 10px;
      padding: 30px 0;
      color: white;
      font-size: 20px;
      font-weight: bold;
      box-shadow: 0 2px 5px rgba(0,0,0,0.2);
      transition: background-color 0.3s;
    }
    .kosong {
      background-color: #2ecc71;
    }
    .isi {
      background-color: #e74c3c;
    }
  </style>
</head>
<body>
  <h2>Status Parkiran Realtime</h2>
  <div class="grid">
    <div id="slot1" class="slot kosong">Slot 1 - KOSONG</div>
    <div id="slot2" class="slot kosong">Slot 2 - KOSONG</div>
    <div id="slot3" class="slot kosong">Slot 3 - KOSONG</div>
    <div id="slot4" class="slot kosong">Slot 4 - KOSONG</div>
  </div>

  <script>
    // === Konfigurasi MQTT WebSocket ===
    const clientId = "webClient_" + Math.random().toString(16).substr(2, 8);
    const options = {
      clean: true,
      connectTimeout: 4000,
      username: "reyhanyulanda",
      password: "MZnitDtN9JtK0tBP",
    };

    // Gunakan WebSocket shiftr.io (gunakan ws:// atau wss://)
    const client = mqtt.connect("wss://reyhanyulanda.cloud.shiftr.io:443", options);

    client.on("connect", () => {
      console.log("Terhubung ke MQTT Broker");
      client.subscribe("parkir/sensor1");
      client.subscribe("parkir/sensor2");
      client.subscribe("parkir/sensor3");
      client.subscribe("parkir/sensor4");
    });

    client.on("message", (topic, message) => {
      const status = message.toString();
      console.log(topic, status);

      // Tentukan slot berdasarkan topic
      let slotId = null;
      if (topic === "parkir/sensor1") slotId = "slot1";
      else if (topic === "parkir/sensor2") slotId = "slot2";
      else if (topic === "parkir/sensor3") slotId = "slot3";
      else if (topic === "parkir/sensor4") slotId = "slot4";

      if (slotId) {
        const slotEl = document.getElementById(slotId);
        slotEl.className = "slot " + (status === "ISI" ? "isi" : "kosong");
        slotEl.textContent = slotId.replace("slot", "Slot ") + " - " + status;
      }
    });

    client.on("error", (err) => {
      console.error("Gagal konek MQTT:", err);
    });
  </script>
</body>
</html>
