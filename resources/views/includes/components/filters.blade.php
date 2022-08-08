<div class="container">
    <form class="flex-row items-center  " action="{{ route('result') }}" method="get">
        <div>
            <input type="hidden" id="terms" name="terms" value="{{ isset($terms) ? $terms : ''}}">
            <label for="category">Category</label>
            <select id="category" name="category" class="dropdown-wrapper">
                <option value="all">All</option>
                @foreach(App\Models\Category::get() as $category_filter)
                <option value="{{ $category_filter->slug }}" @if(isset($category) && $category==$category_filter)
                    selected @endif)>{{ $category_filter->name }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="order_by">Order by</label>
            <select id="order_by" name="order_by" class="dropdown-wrapper">
                @foreach(config('general.order_by') as $index => $order_by)
                <option value="{{ $index }}" @if(isset($orderBy) && $orderBy==$index) selected @endif>{{ $order_by }}
                </option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="ships_from">Ships from:</label>
            <select id="ships_from" name="ships_from" class="dropdown-wrapper">
                <option value="all">All</option>
                @foreach(config('countries') as $index => $country)
                <option value="{{ $index }}" @if(isset($ships_from) && $ships_from==$index) selected @endif>
                    {{ $country }}
                </option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="ships_to">Ships to:</label>
            <select id="ships_to" name="ships_to" class="dropdown-wrapper">
                <option value="all">All</option>
                @foreach(config('countries') as $index => $country)
                <option value="{{ $index }}" @if(isset($ships_to) && $ships_to==$index) selected @endif>{{ $country }}
                </option>
                @endforeach
            </select>
        </div>
        <button type="submit">Filter</button>
    </form>
</div>