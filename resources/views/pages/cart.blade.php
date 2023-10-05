@extends('layouts.app')

@section('content')
    <main>
        <div class="container">
            {{-- Cart page --}}
            <section class="cart">
                <h3>Shopping Cart</h3>
                <div class="cart__list">
                    @if ($cart->count())
                        <div class="products__container">
                            @foreach($cart as $cart_item)
                                <div class="card">
                                    <div class="card__image">
                                        <a
                                            class="card__link"
                                            href="{{ route('product', ['id' => $cart_item->product_id]) }}">
                                            <img src="{{ Vite::asset($cart_item->image) }}" alt="product">
                                        </a>
                                        @if($cart_item->discount)
                                            <p class="card__discount">
                                                -<span>{{ $cart_item->discount }}</span>%
                                            </p>
                                        @endif
                                    </div>
                                    <div class="card__info">
                                        <p class="card__name">{{ $cart_item->name }}</p>
                                        <div class="card__price">
                                            <p class="card__new-price">
                                                $<span>{{ $cart_item->discount_price }}</span>
                                            </p>
                                            @if ($cart_item->discount)
                                                <p class="card__old-price">
                                                    $<span>{{ $cart_item->price }}</span>
                                                </p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="card__price">
                                        <form
                                            action="{{ route('updateCart', ['id' => $cart_item->id]) }}"
                                            method="POST">
                                            @csrf
                                            @method('PUT')
                                            <label class="cart__counter">
                                                <input
                                                    onfocusout="event.target.defaultValue !== event.target.value
                                                           && this.form.submit();"
                                                    type="number"
                                                    name="count"
                                                    value="{{ $cart_item->count }}"
                                                    min="0"
                                                    max="999999999">
                                            </label>
                                        </form>
                                        <p class="card__new-price">
                                            Subtotal: $<span>{{ $cart_item->total }}</span>
                                        </p>
                                    </div>
                                    <form
                                        action="{{ route('deleteCart', ['id' => $cart_item->id]) }}"
                                        method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="button primary-button">
                                            Remove
                                        </button>
                                    </form>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="products__empty">
                            <p>Your cart is currently empty :(</p>
                            <a href="{{ route('catalog') }}" class="button primary-button">Return To Shop</a>
                        </div>
                    @endif
                </div>
                @if ($cart->count())
                    <div class="cart__total">
                        <p class="cart__total-title">Cart Total</p>
                        <div class="cart__total-field">
                            <span>Subtotal:</span>
                            <p class="card__total-price">
                                $<span>{{ $cart->sum('total') }}</span>
                            </p>
                        </div>
                        <div class="cart__total-field">
                            <span>Shipping:</span>
                            <p class="card__total-price">
                                <span>Free</span>
                            </p>
                        </div>
                        <div class="cart__total-field">
                            <span>Total:</span>
                            <p class="card__total-price">
                                $<span>{{ $cart->sum('total') }}</span>
                            </p>
                        </div>
                        <button class="button primary-button">Procees To Checkout</button>
                    </div>
                @endif
            </section>
        </div>
    </main>
@endsection
