@extends('applayout')

@section('content')

<link rel="stylesheet" href="{{ asset('css/profile.css') }}" />

<div class="container-lg">
    @if (session('success'))
        <div class="alert alert-success mt-3">{{ session('success') }}</div>
    @endif

    @if (session('error'))
        <div class="col-12">
            <div class="alert alert-danger">{{ session('error') }}</div>
        </div>
    @endif


    <div class="d-flex flex-wrap justify-content-between align-items-center mt-1">
        <h2 class="p-2 rounded" style="color:  rgb(236, 232, 232);">
            All Items
        </h2>
        <div>
            {{-- showitems list --}}
            <a href="{{ route('show-items-list') }}">
                <span class="material-symbols-outlined" style="font-size: 36px; color:rgb(255, 243, 243); ">
                    list
                </span>
            </a>
            {{-- showitems square --}}
            <a href="{{ route('show-items-square') }}">
                <span class="material-symbols-outlined" style="font-size: 36px; padding-right:1%; color:rgba(255, 255, 255, 0.568);">
                    capture
                </span>
            </a>
        </div>
        <div class="w-100"></div> <!-- Add this empty div to create a new line -->
        <div class="w-100">
            <form class="d-flex" id="search-form" style="margin: 20px 20px 20px 0; padding: 0;">
                @csrf
                <div class="input-group" style="width: 100%;">
                    <input class="form-control" type="search" placeholder="Search" aria-label="Search" name="search" id="search-input" value="{{ old('search', request('search')) }}" style="height: 38px; font-size: 16px; width: 70%;">
                    <select class="form-select" aria-label="category" name="category" id="category-select" style="width: 5%; margin-right: 5px;">
                        <option value="All Items" {{ old('category', $category) == 'All Items' ? 'selected' : '' }}>All Items</option>
                        <option value="Home & Living" {{ old('category', $category) == 'Home & Living' ? 'selected' : '' }}>Home & Living</option>
                        <option value="Fashion" {{ old('category', $category) == 'Fashion' ? 'selected' : '' }}>Fashion</option>
                        <option value="Lifestyle" {{ old('category', $category) == 'Lifestyle' ? 'selected' : '' }}>Lifestyle</option>
                        <option value="Electronics" {{ old('category', $category) == 'Electronics' ? 'selected' : '' }}>Electronics</option>
                        <option value="Health & Beauty" {{ old('category', $category) == 'Health & Beauty' ? 'selected' : '' }}>Health & Beauty</option>
                        <option value="Baby & Toys" {{ old('category', $category) == 'Baby & Toys' ? 'selected' : '' }}>Baby & Toys</option>
                    </select>
                </div>
            </form>
        </div>
    </div>

    <div id="search-results">

        @if ($items->count() > 0)
        <div class="container-lg-list">
            <table class="table table-striped table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">No.</th>
                        <th scope="col">Image</th>
                        <th scope="col">Item Details</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $no = 0;
                    @endphp
                    @foreach ($items as $item)
                    <tr>
                        <th scope="row">{{ ++$no }}</th>
                        <td>
                            @if ($item->image)
                                <img src="{{ asset($item->image) }}" class="img-thumbnail" alt="Item Image" style="width: 100px; height: 100px; object-fit: cover;">
                            @else
                                <span>No Image</span>
                            @endif
                        </td>
                        <td>
                            <div>
                                <strong><a href="{{ route('bid-view', $item->id) }}" style="text-decoration: none; color:black;">{{ $item->title }}</a></strong>
                            </div>
                            <div>Current Price: RM{{ $item->price }}</div>
                            <div>
                                Time remaining:
                                <span id="countdown-{{ $item->id }}"></span>
                            </div>
                            <div>
                                <em>{{ $item->bids_count }} bids</em>
                            </div>
                            <div class=" mt-2">
                                <a href="{{ route('bid-view', $item->id) }}" class="btn btn-primary btn-sm bid-button" data-item-id="{{ $item->id }}" >BID</a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
@else
    <div class="container-sm text-center ">
        <h2>No items available for bidding right now :(</h2>
    </div>
@endif

    </div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.countdown/2.2.0/jquery.countdown.min.js"></script>

<script>
    $(document).ready(function() {
        @foreach ($items as $item)
        $('#countdown-{{ $item->id }}').countdown('{{ $item->countdown_date->format('Y/m/d H:i:s') }}', function(event) {
                    var $this = $(this);
                    $this.html(event.strftime('%D days %H:%M:%S'));

                    if (event.elapsed) {
                        $this.html('SOLD/EXPIRED');
                        var button = $('.bid-button[data-item-id="{{ $item->id }}"]');
                        button.prop('disabled', true).text('Bidding Closed').removeAttr('href').css('cursor', 'not-allowed');
                    }
                });
        @endforeach

        $('#search-input, #category-select').on('input change', function() {
            var search = $('#search-input').val();
            var category = $('#category-select').val();

            $.ajax({
                url: "{{ route('search-item-ajax2') }}",
                method: "GET",
                data: {
                    search: search,
                    category: category,
                },
                success: function(data) {
                    $('#search-results').html(data);
                }
            });
        });
    });
</script>
@endsection
