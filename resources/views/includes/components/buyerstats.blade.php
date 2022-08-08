<div class="flex-row overflow-x-scroll  ">
    <table class="zebra table-space mt-10">
        <thead class="subtitle-sm text-secondary">
            <th></th>
            <th>1 month</th>
            <th>3 months</th>
            <th>1 year</th>
            <th>All time</th>
        </thead>
        <tbody>
            <tr class="description">
                <td>total transactions</td>
                <td>{{ $user->totalOrdersCompleted(1) }}</td>
                <td>{{ $user->totalOrdersCompleted(3) }}</td>
                <td>{{ $user->totalOrdersCompleted(12) }}</td>
                <td>{{ $user->totalOrdersCompleted() }}</td>
            </tr>
            <tr class="description">
                <td>total spent</td>
                <td>XMR {{ $user->totalSpent($user, 1) }}</td>
                <td>XMR {{ $user->totalSpent($user, 3) }}</td>
                <td>XMR {{ $user->totalSpent($user, 12) }}</td>
                <td>XMR {{ $user->totalSpent($user) }}</td>
            </tr>
            <tr class="description">
                <td>dispute rate</td>
                <td>{{ $user->rateDispute(1) }}</td>
                <td>{{ $user->rateDispute(3) }}</td>
                <td>{{ $user->rateDispute(12) }}</td>
                <td>{{ $user->rateDispute() }}</td>
            </tr>
        </tbody>
    </table>
</div>