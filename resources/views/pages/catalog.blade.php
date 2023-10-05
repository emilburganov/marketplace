@extends('layouts.app')

@section('content')
    <main>
        <div class="container">
            {{-- Catalog page --}}
            <div class="catalog">
                <div class="catalog__container">
                    {{-- Products --}}
                    <section class="products">
                        <div class="products__title-container">
                            <h2>Products ({{ $products_info['count'] }})</h2>
                            <div class="products__controls">
                                <form action="{{ route('catalog') }}" method="GET">
                                    <label class="filter-input-group">
                                        <select
                                            onchange="this.form.submit();"
                                            class="form-input" name="sorting">
                                            <option @selected(Session::get('sorting') === 'discount_price-asc')
                                                    value="discount_price-asc">
                                                Price Low to High
                                            </option>
                                            <option @selected(Session::get('sorting') === 'discount_price-desc')
                                                    value="discount_price-desc">
                                                Price High to Low
                                            </option>
                                        </select>
                                    </label>
                                </form>
                            </div>
                        </div>
                        @if($products->count())
                            <div class="products__container">
                                @foreach($products as $product)
                                    <div class="card">
                                        <div class="card__image">
                                            <a
                                                class="card__link"
                                                href="{{ route('product', ['id' => $product->id]) }}">
                                                <img src="{{ Vite::asset($product->image) }}" alt="product">
                                            </a>
                                            @if($product->discount)
                                                <p class="card__discount">
                                                    -<span>{{ $product->discount }}</span>%
                                                </p>
                                            @endif
                                            <a href="{{ route('createCart', ['id' => $product->id]) }}"
                                               class="button card__cart-button">
                                                Add To Cart
                                            </a>
                                        </div>
                                        <div class="card__info">
                                            <p class="card__name">{{ $product->name }}</p>
                                            <div class="card__price">
                                                <p class="card__new-price">
                                                    $<span>{{ $product->discount_price }}</span>
                                                </p>
                                                @if ($product->discount)
                                                    <p class="card__old-price">
                                                        $<span>{{ $product->price }}</span>
                                                    </p>
                                                @endif
                                            </div>
                                            <div class="card__rating">
                                                <div class="card__stars">
                                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                                         xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M14.673 7.17173C15.7437 6.36184 15.1709 4.65517 13.8284 4.65517H11.3992C10.7853 4.65517 10.243 4.25521 10.0617 3.66868L9.33754 1.32637C8.9309 0.0110568 7.0691 0.0110563 6.66246 1.32637L5.93832 3.66868C5.75699 4.25521 5.21469 4.65517 4.60078 4.65517H2.12961C0.791419 4.65517 0.215919 6.35274 1.27822 7.16654L3.39469 8.78792C3.85885 9.1435 4.05314 9.75008 3.88196 10.3092L3.11296 12.8207C2.71416 14.1232 4.22167 15.1704 5.30301 14.342L7.14861 12.9281C7.65097 12.5432 8.34903 12.5432 8.85139 12.9281L10.6807 14.3295C11.7636 15.159 13.2725 14.1079 12.8696 12.8046L12.09 10.2827C11.9159 9.71975 12.113 9.10809 12.5829 8.75263L14.673 7.17173Z"
                                                            fill="#FFAD33"/>
                                                    </svg>
                                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                                         xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M14.673 7.17173C15.7437 6.36184 15.1709 4.65517 13.8284 4.65517H11.3992C10.7853 4.65517 10.243 4.25521 10.0617 3.66868L9.33754 1.32637C8.9309 0.0110568 7.0691 0.0110563 6.66246 1.32637L5.93832 3.66868C5.75699 4.25521 5.21469 4.65517 4.60078 4.65517H2.12961C0.791419 4.65517 0.215919 6.35274 1.27822 7.16654L3.39469 8.78792C3.85885 9.1435 4.05314 9.75008 3.88196 10.3092L3.11296 12.8207C2.71416 14.1232 4.22167 15.1704 5.30301 14.342L7.14861 12.9281C7.65097 12.5432 8.34903 12.5432 8.85139 12.9281L10.6807 14.3295C11.7636 15.159 13.2725 14.1079 12.8696 12.8046L12.09 10.2827C11.9159 9.71975 12.113 9.10809 12.5829 8.75263L14.673 7.17173Z"
                                                            fill="#FFAD33"/>
                                                    </svg>
                                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                                         xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M14.673 7.17173C15.7437 6.36184 15.1709 4.65517 13.8284 4.65517H11.3992C10.7853 4.65517 10.243 4.25521 10.0617 3.66868L9.33754 1.32637C8.9309 0.0110568 7.0691 0.0110563 6.66246 1.32637L5.93832 3.66868C5.75699 4.25521 5.21469 4.65517 4.60078 4.65517H2.12961C0.791419 4.65517 0.215919 6.35274 1.27822 7.16654L3.39469 8.78792C3.85885 9.1435 4.05314 9.75008 3.88196 10.3092L3.11296 12.8207C2.71416 14.1232 4.22167 15.1704 5.30301 14.342L7.14861 12.9281C7.65097 12.5432 8.34903 12.5432 8.85139 12.9281L10.6807 14.3295C11.7636 15.159 13.2725 14.1079 12.8696 12.8046L12.09 10.2827C11.9159 9.71975 12.113 9.10809 12.5829 8.75263L14.673 7.17173Z"
                                                            fill="#FFAD33"/>
                                                    </svg>
                                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                                         xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M14.673 7.17173C15.7437 6.36184 15.1709 4.65517 13.8284 4.65517H11.3992C10.7853 4.65517 10.243 4.25521 10.0617 3.66868L9.33754 1.32637C8.9309 0.0110568 7.0691 0.0110563 6.66246 1.32637L5.93832 3.66868C5.75699 4.25521 5.21469 4.65517 4.60078 4.65517H2.12961C0.791419 4.65517 0.215919 6.35274 1.27822 7.16654L3.39469 8.78792C3.85885 9.1435 4.05314 9.75008 3.88196 10.3092L3.11296 12.8207C2.71416 14.1232 4.22167 15.1704 5.30301 14.342L7.14861 12.9281C7.65097 12.5432 8.34903 12.5432 8.85139 12.9281L10.6807 14.3295C11.7636 15.159 13.2725 14.1079 12.8696 12.8046L12.09 10.2827C11.9159 9.71975 12.113 9.10809 12.5829 8.75263L14.673 7.17173Z"
                                                            fill="#FFAD33"/>
                                                    </svg>
                                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                                         xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M14.673 7.17173C15.7437 6.36184 15.1709 4.65517 13.8284 4.65517H11.3992C10.7853 4.65517 10.243 4.25521 10.0617 3.66868L9.33754 1.32637C8.9309 0.0110568 7.0691 0.0110563 6.66246 1.32637L5.93832 3.66868C5.75699 4.25521 5.21469 4.65517 4.60078 4.65517H2.12961C0.791419 4.65517 0.215919 6.35274 1.27822 7.16654L3.39469 8.78792C3.85885 9.1435 4.05314 9.75008 3.88196 10.3092L3.11296 12.8207C2.71416 14.1232 4.22167 15.1704 5.30301 14.342L7.14861 12.9281C7.65097 12.5432 8.34903 12.5432 8.85139 12.9281L10.6807 14.3295C11.7636 15.159 13.2725 14.1079 12.8696 12.8046L12.09 10.2827C11.9159 9.71975 12.113 9.10809 12.5829 8.75263L14.673 7.17173Z"
                                                            fill="#FFAD33"/>
                                                    </svg>
                                                    <div
                                                        class="card__stars-cover"
                                                        style="width: {{ 100 - ($product->averageRating * 20) }}%;">
                                                    </div>
                                                </div>
                                                <p class="card__rating-users-count">({{ $product->ratings_count }})</p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            {{-- Pagination --}}
                            <div class="products__pagination">
                                {!! $products->onEachSide(1)->onEachSide(1)->withQueryString()->links() !!}
                            </div>
                        @else
                            <div class="products__empty">
                                <p>The items you have selected are not found :(</p>
                                <a href="{{ route('catalog',
                                    ['price_from' => $products_info['min_price'],
                                     'price_to' => $products_info['max_price'],
                                     'discount_from' => $products_info['min_discount'],
                                     'discount_to' => $products_info['max_discount'],
                                     'category_id' => 'all']) }}"
                                    class="button primary-button">
                                    View All Products
                                </a>
                            </div>
                        @endif
                    </section>

                    {{-- Filters --}}
                    <section class="filters">
                        <form
                            class="form"
                            action="{{ route('catalog') }}"
                            method="GET"
                            target="filters">
                            <div class="form__fields">
                                <div class="filter-input-group">
                                    <label for="price_from">Price From:</label>
                                    <input
                                        id="price_from"
                                        class="form-input"
                                        type="number"
                                        value="{{ Session::get('price_from') ?? $products_info['min_price'] }}"
                                        min="0"
                                        max="999999999"
                                        name="price_from"
                                        required>
                                </div>
                                <div class="filter-input-group">
                                    <label for="price_to">Price To:</label>
                                    <input
                                        id="price_to"
                                        class="form-input"
                                        type="number"
                                        value="{{ Session::get('price_to') ?? $products_info['max_price'] }}"
                                        min="0"
                                        max="999999999"
                                        name="price_to"
                                        required>
                                </div>
                                <div class="filter-input-group">
                                    <label for="discount_from">Discount Percentage From:</label>
                                    <input
                                        id="discount_from"
                                        class="form-input"
                                        type="number"
                                        value="{{ Session::get('discount_from') ?? $products_info['min_discount'] }}"
                                        min="0"
                                        max="100"
                                        name="discount_from"
                                        required>
                                </div>
                                <div class="filter-input-group">
                                    <label for="discount_to">Discount Percentage To:</label>
                                    <input
                                        id="discount_to"
                                        class="form-input"
                                        type="number"
                                        value="{{ Session::get('discount_to') ?? $products_info['max_discount'] }}"
                                        min="0"
                                        max="100"
                                        name="discount_to"
                                        required>
                                </div>
                                <div class="filter-input-group">
                                    <label for="category_id">Category:</label>
                                    <select
                                        id="category_id"
                                        class="form-input"
                                        name="category_id"
                                        required>
                                        <option value="all" selected>-- All categories --</option>
                                        @foreach($categories as $category)
                                            <option
                                                @selected($category->id == Session::get('category_id'))
                                                value="{{ $category->id }}">
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <button type="submit" class="button primary-button">
                                    Apply Filters
                                </button>
                            </div>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </main>
@endsection
