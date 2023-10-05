@extends('layouts.app')

@section('content')
    <main>
        <div class="container">
            {{-- Main --}}
            <section class="main">
                {{-- Navigation --}}
                <aside class="navigation">
                    <ul class="navigation__list">
                        @foreach($categories as $category)
                            <li class="navigation__item">
                                <a
                                    class="navigation__item-link"
                                    href="{{ route('catalog', ['category_id' => $category->id]) }}">
                                    {{ $category->name }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </aside>

                {{-- Banner --}}
                <div class="banner">
                    <div class="banner__info">
                        <div class="banner__brand">
                            <img
                                width="40"
                                height="49"
                                src="{{ Vite::asset('resources/assets/images/banner/brand.svg') }}"
                                alt="banner-brand">
                            <span>iPhone 14 Series</span>
                        </div>
                        <h3 class="banner__title">Up to 10% off Voucher</h3>
                        <div class="banner-button">
                            <a href="{{ route('catalog') }}">Go Shopping</a>
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path d="M3.5 12H20M20 12L13 5M20 12L13 19" stroke="#FAFAFA" stroke-width="2"
                                      stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                    </div>
                    <img
                        width="325"
                        height="271"
                        src="{{ Vite::asset('resources/assets/images/banner/background.svg') }}" alt="banner">
                </div>
            </section>

            {{-- Fresh Sales --}}
            <section class="swiper sales-swiper products">
                <div class="section-subtitle">
                    <span></span>
                    <p>Today’s</p>
                </div>
                <div class="products__title-container">
                    <h2>Flash Sales</h2>
                    <div class="products__controls">
                        <button
                            class="button arrow-button sales-swiper-button-prev"
                            aria-label="swipe fresh sales left">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path d="M11 5L4 12L11 19M4 12H20" stroke="black" stroke-width="2"
                                      stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </button>
                        <button
                            class="button arrow-button sales-swiper-button-next"
                            aria-label="swipe fresh sales right">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path d="M3.5 12H20M20 12L13 5M20 12L13 19" stroke="black" stroke-width="2"
                                      stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </button>
                    </div>
                </div>
                <div class="swiper-wrapper products__container">
                    @foreach($sales_products as $product)
                        <div class="swiper-slide card">
                            <div class="card__image">
                                <a class="card__link" href="{{ route('product', ['id' => $product->id]) }}">
                                    <img src="{{ Vite::asset($product->image) }}" alt="product">
                                </a>
                                @if($product->discount)
                                    <p class="card__discount">
                                        -<span>{{ $product->discount }}</span>%
                                    </p>
                                @endif
                                <a
                                    href="{{ route('createCart', ['id' => $product->id]) }}"
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
                                        <p class="card__rating-users-count">
                                            ({{ $product->ratings_count }})
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <a href="{{ route('catalog') }}" class="button primary-button">View All Products</a>
            </section>

            {{-- Browse By Category--}}
            <section class="swiper categories-swiper categories products">
                <div class="section-subtitle">
                    <span></span>
                    <p>Categories</p>
                </div>
                <div class="products__title-container">
                    <h2>Browse By Category</h2>
                    <div class="products__controls">
                        <button
                            class="button arrow-button categories-swiper-button-prev"
                            aria-label="swipe categories left">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path d="M11 5L4 12L11 19M4 12H20" stroke="black" stroke-width="2"
                                      stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </button>
                        <button
                            class="button arrow-button categories-swiper-button-next"
                            aria-label="swipe categories right">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path d="M3.5 12H20M20 12L13 5M20 12L13 19" stroke="black" stroke-width="2"
                                      stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </button>
                    </div>
                </div>
                <div class="swiper-wrapper categories__container products__container">
                    @foreach($categories as $category)
                        <a
                            href="{{ route('catalog', ['category_id' => $category->id]) }}"
                            class="categories__card swiper-slide">
                                <?php echo $category->icon ?>
                            <p>
                                {{ $category->name }}
                            </p>
                        </a>
                    @endforeach
                </div>
            </section>

            {{-- Best Selling Products --}}
            <section class="products">
                <div class="section-subtitle">
                    <span></span>
                    <p>This Month</p>
                </div>
                <div class="products__title-container">
                    <h2>Best Selling Products</h2>
                    <div class="products__controls">
                        <a href="{{ route('catalog') }}" class="button primary-button">View All</a>
                    </div>
                </div>
                <div class="products__container">
                    @foreach($best_selling_products as $product)
                        <div class="card">
                            <div class="card__image">
                                <a class="card__link" href="{{ route('product', ['id' => $product->id]) }}">
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
                        </div>
                    @endforeach
                </div>
            </section>

            {{-- Explore Our Products --}}
            <section class="swiper products-swiper products">
                <div class="section-subtitle">
                    <span></span>
                    <p>Our Products</p>
                </div>
                <div class="products__title-container">
                    <h2>Explore Our Products</h2>
                    <div class="products__controls">
                        <button
                            class="button arrow-button products-swiper-button-prev"
                            aria-label="swipe products left">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path d="M11 5L4 12L11 19M4 12H20" stroke="black" stroke-width="2"
                                      stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </button>
                        <button
                            class="button arrow-button products-swiper-button-next"
                            aria-label="swipe products right">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path d="M3.5 12H20M20 12L13 5M20 12L13 19" stroke="black" stroke-width="2"
                                      stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </button>
                    </div>
                </div>
                <div class="swiper-wrapper products__container">
                    @foreach($products as $product)
                        <div class="swiper-slide card">
                            <div class="card__image">
                                <a class="card__link" href="{{ route('product', ['id' => $product->id]) }}">
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
                                        <p class="card__rating-users-count">
                                            ({{ $product->ratings_count }})
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <a href="{{ route('catalog') }}" class="button primary-button">View All Products</a>
            </section>

            {{-- New Arrival --}}
            <section class="featured products">
                <div class="section-subtitle">
                    <span></span>
                    <p>Featured</p>
                </div>
                <div class="products__title-container">
                    <h2>New Arrival</h2>
                </div>
                <div class="featured__container products__container">
                    <div class="featured__card featured__card-1">
                        <img src="{{ Vite::asset('resources/assets/images/cards/featured/featured1.jpg') }}"
                             alt="feature">
                        <div class="featured__info">
                            <h3>PlayStation 5</h3>
                            <p>Black and White version of the PS5 coming out on sale.</p>
                            <div class="banner-button">
                                <a href="{{ route('catalog') }}">Go Shopping</a>
                            </div>
                        </div>
                    </div>
                    <div class="featured__card featured__card-2">
                        <img src="{{ Vite::asset('resources/assets/images/cards/featured/featured2.jpg') }}"
                             alt="featured">
                        <div class="featured__info">
                            <h3>Women’s Collections</h3>
                            <p>Featured woman collections that give you another vibe.</p>
                            <div class="banner-button">
                                <a href="{{ route('catalog') }}">Go Shopping</a>
                            </div>
                        </div>
                    </div>
                    <div class="featured__card featured__card-3">
                        <img src="{{ Vite::asset('resources/assets/images/cards/featured/featured3.jpg') }}"
                             alt="featured">
                        <div class="featured__info">
                            <h3>Speakers</h3>
                            <p>Amazon wireless speakers.</p>
                            <div class="banner-button">
                                <a href="{{ route('catalog') }}">Go Shopping</a>
                            </div>
                        </div>
                    </div>
                    <div class="featured__card featured__card-4">
                        <img src="{{ Vite::asset('resources/assets/images/cards/featured/featured4.jpg') }}"
                             alt="featured">
                        <div class="featured__info">
                            <h3>Perfume</h3>
                            <p>Perfume Bulgari Note Eau de toilette</p>
                            <div class="banner-button">
                                <a href="{{ route('catalog') }}">Go Shopping</a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            {{-- Services --}}
            <section class="services">
                <div class="services__container">
                    <div class="services__card">
                        <img src="{{ Vite::asset('resources/assets/images/cards/services/services1.svg') }}"
                             alt="service">
                        <div class="services__info">
                            <h3>FREE AND FAST DELIVERY</h3>
                            <p>Free delivery for all orders over $140</p>
                        </div>
                    </div>
                    <div class="services__card">
                        <img src="{{ Vite::asset('resources/assets/images/cards/services/services2.svg') }}"
                             alt="service">
                        <div class="services__info">
                            <h3>24/7 CUSTOMER SERVICE</h3>
                            <p>Friendly 24/7 customer support</p>
                        </div>
                    </div>
                    <div class="services__card">
                        <img src="{{ Vite::asset('resources/assets/images/cards/services/services3.svg') }}"
                             alt="service">
                        <div class="services__info">
                            <h3>MONEY BACK GUARANTEE</h3>
                            <p>We return money within 30 days</p>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main>
@endsection
