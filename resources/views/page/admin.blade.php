<table class="table">
    <tr>
        <th>Name</th>
        <th>Service</th>
        <th>Amount</th>
        <th>Status</th>
        <th>Date</th>
    </tr>

    @foreach($payments as $p)
    <tr>
        <td>{{ $p->name }}</td>
        <td>{{ $p->service }}</td>
        <td>{{ $p->amount }}</td>
        <td>{{ $p->status }}</td>
        <td>{{ $p->created_at }}</td>
    </tr>
    @endforeach
</table>
