<div class="content-sidebar">
    <div class="notices">
        <span class="subtitle text-primary">Staff links</span>
        <ul class="notices-list">
            <li><a href="{{ route('staff.products') }}">Products</a></li>
            <li><a href="{{ route('staff.disputes') }}">Disputes</a></li>
            <li><a href="{{ route('staff.reports') }}">Reported Products</a></li>
            <li><a href="{{ route('staff.notices') }}">Notifications</a></li>
            <li><a href="{{ route('staff.support') }}">Support</a></li>
            <li><a href="{{ route('staff.massmessage') }}">Mass message</a></li>
        </ul>
        @admin
        <br>
        <span class="subtitle text-primary">Admin links</span>
        <ul class="notices-list">
            <li><a href="{{ route('admin.dashboard') }}">Market settings</a></li>
            <li><a href="{{ route('admin.users') }}">Users</a></li>
            <li><a href="{{ route('admin.categories') }}">Categories</a></li>
        </ul>
        @endadmin
    </div>
</div>