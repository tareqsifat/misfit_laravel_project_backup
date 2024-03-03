<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prescription</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.7.0/dist/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 90vh;
        }
        
        .container {
    max-width: 800px;
    width: 100%;
    padding: 10px;
    background-color: #fff;
    border: 1px solid #ccc;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    background-image: url({{ asset('assets/admin/images/prescription.avif') }});
    background-size: cover;
    background-position: center center;
    background-attachment: fixed;
}

        
        .header {
            text-align: center;
        }
        
        .header h2 {
            background-color: ;
            color: black;
            padding: 0px;
            border-radius: 5px;
            width: 150px;
            text-align: center;
            display: inline-block;
            font-size: 35px;
        }
        
        .patient-doctor-details {
            display: flex;
            justify-content: space-between;
            margin-top: 15px;
        }
        
        .details {
            background-color: #f2f2f2;
            padding: 15px;
            border-radius: 5px;
        }
        
        .details h5 {
            color: #333;
        }
        
        .details p {
            margin: 5px 0;
        }
        
        .prescription-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        
        .prescription-table th, .prescription-table td {
            padding: 15px;
            border: 1px solid #ccc;
            text-align: center;
            font-weight: bold;
        }
        
        .prescription-table th {
            background-color: #e1e8f0;
            color: #black;
        }
        
        .prescription-table td {
            background-color: #ffdd97;
        }
        
        .doctor-info {
            background-color: gray;
            color: #fff;
            padding: 10px;
            border-radius: 5px;
            text-align: center;
            margin-top: 10px;
        }
        .signature {
            text-align: right;
            margin-top: 20px;
        }
        
        .signature p {
            padding: 15px;
            margin: 5px 0;
        }
        
        .signature img {
            width: 150px;
            height: auto;
        }
        
        
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Prescription</h2>
        </div>

        <div class="doctor-info">
            <h2>Dr. Messi</h2>
            <p>Cardiologist</p>
            <p>Contact: +880</p>
        </div>
        
        <div class="patient-doctor-details">
            <div class="details">
                <h5>Patient Details</h5>
                <p><strong>Name:</strong> {{ $user->name }}</p>
                <p><strong>Date of Birth:</strong> {{ $user->profile->birthday }}</p>
                <p><strong>Gender:</strong> {{ $user->profile->gender }}</p>
            </div>
        </div>
        
        <div class="prescription-info">
            <h4>Appointment ID: {{ $prescription->appointment_id }}</h4>
        </div>
        
        @php
            $prescriptionItems = json_decode($prescription->prescription, true);
        @endphp
        
        <table class="prescription-table">
            <thead>
                <tr>
                    <th>Medicine</th>
                    <th>Frequency</th>
                    <th>Duration</th>
                    <th>Instruction</th>
                    <th>Medication Refill</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($prescriptionItems as $item)
                    <tr>
                        <td>{{ $item['medicine'] }}</td>
                        <td>{{ $item['frequency'] }}</td>
                        <td>{{ $item['duration'] }}</td>
                        <td>{{ $item['instruction'] }}</td>
                        <td>{{ $item['medication_refill'] ?? '' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        
        <p class="timestamp">Prescription created at: {{ $prescription->created_at->format('jS F Y') }}</p>
        <p class="timestamp">Prescription updated at: {{ $prescription->updated_at->format('jS F Y') }}</p>
        
        <div class="signature">
            <p>Doctor's Signature: ____________________</p>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.7.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
