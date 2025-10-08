<!DOCTYPE html>
<html>
<head>
  <title>Data Parkir</title>
  <style>
    table { border-collapse: collapse; width: 60%; margin: 20px auto; }
    th, td { border: 1px solid #ddd; padding: 8px; text-align: center; }
    th { background-color: #f2f2f2; }
  </style>
</head>
<body>
  <h2 style="text-align:center;">Data Parkir Terbaru</h2>
  <table>
    <tr>
      <th>Waktu</th>
      <th>Sensor</th>
      <th>Status</th>
    </tr>
    @foreach($logs as $log)
    <tr>
      <td>{{ $log->created_at }}</td>
      <td>{{ $log->topic }}</td>
      <td>{{ $log->status }}</td>
    </tr>
    @endforeach
  </table>
</body>
</html>
