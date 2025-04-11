<h2>{{ $details['subject'] }}</h2>
<p><strong>Name:</strong> {{ $details['name'] }}</p>
<p><strong>Phone:</strong> {{ $details['phone'] }}</p>
<p><strong>Gender:</strong> {{ ucfirst($details['gender']) }}</p>
<p><strong>Services:</strong> {{ $details['services'] }}</p>
<p><strong>Date:</strong> {{ $details['date'] }}</p>
<p><strong>Time:</strong> {{ $details['time'] }}</p>
<p><strong>Total Price:</strong> ₹{{ $details['total_price'] }}</p>
