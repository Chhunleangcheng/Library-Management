<!DOCTYPE html>
<html>
<head>
    <title>Member Borrowing History</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .header { text-align: center; margin-bottom: 30px; }
        .member-info { margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .badge { padding: 2px 6px; border-radius: 3px; font-size: 12px; }
        .badge-success { background-color: #d4edda; color: #155724; }
        .badge-danger { background-color: #f8d7da; color: #721c24; }
        .badge-warning { background-color: #fff3cd; color: #856404; }
    </style>
</head>
<body>
<div class="header">
    <h1>Library Management System</h1>
    <h2>Member Borrowing History</h2>
</div>

<div class="member-info">
    <h3>Member Information</h3>
    <p><strong>Name:</strong> {{ $member->name }}</p>
    <p><strong>Email:</strong> {{ $member->email }}</p>
    <p><strong>Phone:</strong> {{ $member->phone }}</p>
    <p><strong>Member Since:</strong> {{ $member->membership_date->format('M d, Y') }}</p>
    <p><strong>Status:</strong> {{ ucfirst($member->membership_status) }}</p>
</div>

<h3>Borrowing History</h3>
@if($member->borrowings->count() > 0)
    <table>
        <thead>
        <tr>
            <th>Book Title</th>
            <th>Author</th>
            <th>Borrowed Date</th>
            <th>Due Date</th>
            <th>Returned Date</th>
            <th>Fine Amount</th>
            <th>Status</th>
        </tr>
        </thead>
        <tbody>
        @foreach($member->borrowings->sortByDesc('borrowed_at') as $borrowing)
            <tr>
                <td>{{ $borrowing->book->title }}</td>
                <td>{{ $borrowing->book->author }}</td>
                <td>{{ $borrowing->borrowed_at->format('M d, Y') }}</td>
                <td>{{ $borrowing->due_date->format('M d, Y') }}</td>
                <td>
                    @if($borrowing->returned_at)
                        {{ $borrowing->returned_at->format('M d, Y') }}
                    @else
                        Not Returned
                    @endif
                </td>
                <td>
                    @if($borrowing->fine_amount)
                        ${{ number_format($borrowing->fine_amount, 2) }}
                        @if($borrowing->fine_paid) (Paid) @else (Unpaid) @endif
                    @else
                        -
                    @endif
                </td>
                <td>
                    @if($borrowing->returned_at)
                        Returned
                    @elseif($borrowing->isOverdue())
                        Overdue
                    @else
                        Active
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@else
    <p>No borrowing history found.</p>
@endif

<div style="margin-top: 30px; text-align: center; font-size: 12px; color: #666;">
    Generated on {{ now()->format('M d, Y H:i:s') }}
</div>
<!-- Add this JavaScript to update time in real-time -->
<script>
    // Update time every second to show current time: 2025-06-20 05:45:10
    function updateNavTime() {
        const now = new Date();
        const year = now.getUTCFullYear();
        const month = String(now.getUTCMonth() + 1).padStart(2, '0');
        const day = String(now.getUTCDate()).padStart(2, '0');
        const hours = String(now.getUTCHours()).padStart(2, '0');
        const minutes = String(now.getUTCMinutes()).padStart(2, '0');
        const seconds = String(now.getUTCSeconds()).padStart(2, '0');

        const timeString = `${year}-${month}-${day} ${hours}:${minutes}:${seconds}`;

        // Convert to Khmer numbers
        const khmerNumbers = {
            '0': '០', '1': '១', '2': '២', '3': '៣', '4': '៤',
            '5': '៥', '6': '៦', '7': '៧', '8': '៨', '9': '៩'
        };

        const khmerTime = timeString.replace(/[0-9]/g, function(match) {
            return khmerNumbers[match];
        });

        // Update any time display elements
        const timeElements = document.querySelectorAll('.current-time-display');
        timeElements.forEach(element => {
            element.textContent = khmerTime + ' UTC';
        });
    }

    // Start the clock
    document.addEventListener('DOMContentLoaded', function() {
        updateNavTime();
        setInterval(updateNavTime, 1000);
    });
</script>
</body>
</html>
