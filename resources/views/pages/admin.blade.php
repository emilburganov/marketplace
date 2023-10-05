@extends('layouts.app')

@section('content')
    <main>
        {{-- Admin page --}}
        <section class="admin">
            <div class="container">
                <div class="admin__crud">
                    {{-- Users --}}
                    <div class="users">
                        <h3 class="admin__crud-title">
                            Users
                        </h3>
                        <form
                            name="users"
                            class="form"
                            action="{{ session()->has('user_flash')
                                       ? route('updateUser', ['id' => session()->get('user_flash')->id])
                                       : route('createUser') }}"
                            method="POST">
                            @csrf
                            @if(session()->has('user_flash'))
                                @method('PUT')
                            @endif
                            <div class="form__title">
                                <h3>
                                    @if(session()->has('user_flash'))
                                        Update
                                    @else
                                        Create
                                    @endif
                                </h3>
                            </div>
                            <div class="form__fields">
                                <label>
                                    <input
                                        class="form-input"
                                        type="text"
                                        placeholder="Name"
                                        name="user_name"
                                        required
                                        value="{{ old('user_name') ?: session()->get('user_flash')?->name }}">
                                    @error('user_name')
                                    <span class="form__error">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </label>
                                <label>
                                    <input
                                        class="form-input"
                                        type="email"
                                        placeholder="Email"
                                        name="user_email"
                                        required
                                        value="{{ old('user_email') ?: session()->get('user_flash')?->email }}">
                                    @error('user_email')
                                    <span class="form__error">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </label>
                                <label>
                                    <input
                                        class="form-input"
                                        type="password"
                                        placeholder="Password"
                                        name="user_password"
                                        required
                                        value="{{ old('user_password') ?: session()->get('user_flash')?->password }}">
                                    @error('user_password')
                                    <span class="form__error">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </label>
                                <label>
                                    <input
                                        class="form-input"
                                        type="password"
                                        placeholder="Password Repeat"
                                        name="user_password_repeat"
                                        required
                                        value="{{ old('user_password_repeat')
                                                  ?: session()->get('user_flash')?->password }}">
                                    @error('user_password_repeat')
                                    <span class="form__error">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </label>
                                <label>
                                    <select
                                        class="form-input"
                                        name="user_role_id"
                                        required>
                                        <option selected disabled>-- Select role --</option>
                                        @foreach($roles as $role)
                                            <option @selected($role->id === session()->get('user_flash')?->role_id
                                                              || old('user_role_id'))
                                                    value="{{ $role->id }}">{{ $role->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('user_role_id')
                                    <span class="form__error">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </label>
                            </div>
                            <div class="form__buttons">
                                <button type="submit" class="button primary-button">
                                    @if(session()->has('user_flash'))
                                        Update
                                    @else
                                        Create
                                    @endif
                                </button>
                                @if(session()->has('user_message'))
                                    <span class="form__success form__base-success">
                                        {{ session()->get('user_message') }}
                                    </span>
                                @endif
                            </div>
                        </form>
                        <div class="products__container">
                            @foreach($users as $user)
                                <div class="users__card users__admin-card">
                                    <div class="admin__crud-buttons">
                                        <a
                                            class="admin__update"
                                            href="{{ route('editUser', ['id' => $user->id]) }}">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                 width="24" height="24"
                                                 viewBox="0 0 528.899 528.899">
                                                <g>
                                                    <path
                                                        d="m328.883 89.125 107.59 107.589-272.34 272.34L56.604 361.465l272.279-272.34zm189.23-25.948-47.981-47.981c-18.543-18.543-48.653-18.543-67.259 0l-45.961 45.961 107.59 107.59 53.611-53.611c14.382-14.383 14.382-37.577 0-51.959zM.3 512.69c-1.958 8.812 5.998 16.708 14.811 14.565l119.891-29.069L27.473 390.597.3 512.69z"
                                                        fill="black"></path>
                                                </g>
                                            </svg>
                                        </a>
                                        <form
                                            class="admin__delete"
                                            action="{{ route('deleteUser', $user->id) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button>
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                     width="24" height="24"
                                                     viewBox="0 0 365.717 365">
                                                    <g>
                                                        <g fill="black">
                                                            <path
                                                                d="M356.34 296.348 69.727 9.734c-12.5-12.5-32.766-12.5-45.247 0L9.375 24.816c-12.5 12.504-12.5 32.77 0 45.25L295.988 356.68c12.504 12.5 32.77 12.5 45.25 0l15.082-15.082c12.524-12.48 12.524-32.75.02-45.25zm0 0"
                                                                fill="black"></path>
                                                            <path
                                                                d="M295.988 9.734 9.375 296.348c-12.5 12.5-12.5 32.77 0 45.25l15.082 15.082c12.504 12.5 32.77 12.5 45.25 0L356.34 70.086c12.504-12.5 12.504-32.766 0-45.246L341.258 9.758c-12.5-12.524-32.766-12.524-45.27-.024zm0 0"
                                                                fill="black"></path>
                                                        </g>
                                                    </g>
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                    <p class="users__field">
                                        <span>ID:</span>
                                        {{ $user->id }}
                                    </p>
                                    <p class="users__field">
                                        <span>Name:</span>
                                        {{ $user->name }}
                                    </p>
                                    <p class="users__field">
                                        <span>Email:</span>
                                        {{ $user->email }}
                                    </p>
                                    <p class="users__field">
                                        <span>Password:</span>
                                        {{ $user->password }}
                                    </p>
                                    <p class="users__field">
                                        <span>Role:</span>
                                        {{ $user->role->name }}
                                    </p>
                                </div>
                            @endforeach
                        </div>

                        {{-- Pagination --}}
                        <div class="products__pagination">
                            {{ $users->onEachSide(1)->withQueryString()->links() }}
                        </div>
                    </div>

                    {{-- Categories --}}
                    <div class="categories">
                        <h3 class="admin__crud-title">Categories</h3>
                        <form
                            class="form"
                            action="{{ session()->has('category_flash')
                                       ? route('updateCategory', ['id' => session()->get('category_flash')->id])
                                       : route('createCategory') }}"
                            method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @if(session()->has('category_flash'))
                                @method('PUT')
                            @endif
                            <div class="form__title">
                                <h3>
                                    @if(session()->has('category_flash'))
                                        Update
                                    @else
                                        Create
                                    @endif
                                </h3>
                            </div>
                            <div class="form__fields">
                                <label>
                                    <input
                                        class="form-input"
                                        type="text"
                                        placeholder="Name"
                                        name="category_name"
                                        required
                                        value="{{ old('category_name')
                                                  ?: session()->get('category_flash')?->name }}">
                                    @error('category_name')
                                    <span class="form__error">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </label>
                                <label>
                                    <input
                                        class="form-input"
                                        type="file"
                                        name="category_icon"
                                        required>
                                    @error('category_icon')
                                    <span class="form__error">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </label>
                            </div>
                            <div class="form__buttons">
                                <button type="submit" class="button primary-button">
                                    @if(session()->has('category_flash'))
                                        Update
                                    @else
                                        Create
                                    @endif
                                </button>
                                @if(session()->has('category_message'))
                                    <span class="form__success form__base-success">
                                        {{ session()->get('category_message') }}
                                    </span>
                                @endif
                            </div>
                        </form>
                        <div class="categories__container products__container">
                            @foreach($categories as $category)
                                <div class="categories__card categories__admin-card">
                                        <?php echo $category->icon ?>
                                    <p>{{ $category->name }}</p>
                                    <div class="admin__crud-buttons">
                                        <a
                                            class="admin__update"
                                            href="{{ route('editCategory', ['id' => $category->id]) }}">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                 width="16" height="16"
                                                 viewBox="0 0 528.899 528.899">
                                                <g>
                                                    <path
                                                        d="m328.883 89.125 107.59 107.589-272.34 272.34L56.604 361.465l272.279-272.34zm189.23-25.948-47.981-47.981c-18.543-18.543-48.653-18.543-67.259 0l-45.961 45.961 107.59 107.59 53.611-53.611c14.382-14.383 14.382-37.577 0-51.959zM.3 512.69c-1.958 8.812 5.998 16.708 14.811 14.565l119.891-29.069L27.473 390.597.3 512.69z"
                                                        fill="black"></path>
                                                </g>
                                            </svg>
                                        </a>
                                        <form
                                            class="admin__delete"
                                            action="{{ route('deleteCategory', $category->id) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button>
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                     width="16" height="16"
                                                     viewBox="0 0 365.717 365">
                                                    <g>
                                                        <g fill="black">
                                                            <path
                                                                d="M356.34 296.348 69.727 9.734c-12.5-12.5-32.766-12.5-45.247 0L9.375 24.816c-12.5 12.504-12.5 32.77 0 45.25L295.988 356.68c12.504 12.5 32.77 12.5 45.25 0l15.082-15.082c12.524-12.48 12.524-32.75.02-45.25zm0 0"
                                                                fill="black"></path>
                                                            <path
                                                                d="M295.988 9.734 9.375 296.348c-12.5 12.5-12.5 32.77 0 45.25l15.082 15.082c12.504 12.5 32.77 12.5 45.25 0L356.34 70.086c12.504-12.5 12.504-32.766 0-45.246L341.258 9.758c-12.5-12.524-32.766-12.524-45.27-.024zm0 0"
                                                                fill="black"></path>
                                                        </g>
                                                    </g>
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        {{-- Pagination --}}
                        <div class="products__pagination">
                            {!! $categories->onEachSide(1)->onEachSide(1)->withQueryString()->links() !!}
                        </div>
                    </div>

                    {{-- Products --}}
                    <div class="products">
                        <h3 class="admin__crud-title">Products</h3>
                        <form
                            class="form"
                            action="{{ session()->has('product_flash')
                                       ? route('updateProduct', ['id' => session()->get('product_flash')->id])
                                       : route('createProduct') }}"
                            method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @if(session()->has('product_flash'))
                                @method('PUT')
                            @endif
                            <div class="form__title">
                                <h3>
                                    @if(session()->has('product_flash'))
                                        Update
                                    @else
                                        Create
                                    @endif
                                </h3>
                            </div>
                            <div class="form__fields">
                                <label>
                                    <input
                                        class="form-input"
                                        type="text"
                                        placeholder="Name"
                                        name="product_name"
                                        required
                                        value="{{ old('product_name') ?: session()->get('product_flash')?->name }}">
                                    @error('product_name')
                                    <span class="form__error">{{ $message }}</span>
                                    @enderror
                                </label>
                                <label>
                                    <input
                                        class="form-input"
                                        type="text"
                                        placeholder="Description"
                                        name="product_description"
                                        required
                                        value="{{ old('product_description')
                                                  ?: session()->get('product_flash')?->description }}">
                                    @error('product_description')
                                    <span class="form__error">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </label>
                                <label>
                                    <input
                                        class="form-input"
                                        type="file"
                                        name="product_image"
                                        required>
                                    @error('product_image')
                                    <span class="form__error">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </label>
                                <label>
                                    <input
                                        class="form-input"
                                        type="number"
                                        placeholder="Price"
                                        name="product_price"
                                        min="0"
                                        max="999999999"
                                        required
                                        value="{{ old('product_price')
                                                  ?: session()->get('product_flash')?->price }}">
                                    @error('product_price')
                                    <span class="form__error">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </label>
                                <label>
                                    <input
                                        class="form-input"
                                        type="number"
                                        placeholder="Discount"
                                        name="product_discount"
                                        min="0"
                                        max="100"
                                        required
                                        value="{{ old('product_discount')
                                                  ?: session()->get('product_flash')?->discount }}">
                                    @error('product_discount')
                                    <span class="form__error">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </label>
                                <label>
                                    <select
                                        class="form-input"
                                        name="product_category_id"
                                        required>
                                        <option selected disabled>-- Select category --</option>
                                        @foreach($categories as $category)
                                            <option @selected($category->id
                                                              == session()->get('product_flash')?->category_id
                                                              || $category['id'] == old('product_category_id'))
                                                    value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('product_category_id')
                                    <span class="form__error">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </label>
                                <label>
                                    <select class="form-input"
                                            name="product_seller_id"
                                            required>
                                        <option selected disabled>-- Select seller --</option>
                                        @foreach($sellers as $seller)
                                            <option @selected($seller->id == session()->get('product_flash')?->seller_id
                                                              || $seller->id == old('product_seller_id'))
                                                    value="{{ $seller->id }}">
                                                {{ $seller->name . ', ' . $seller->email }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('product_category_id')
                                    <span class="form__error">{{ $message }}</span>
                                    @enderror
                                </label>
                            </div>
                            <div class="form__buttons">
                                <button type="submit" class="button primary-button">
                                    @if(session()->has('product_flash'))
                                        Update
                                    @else
                                        Create
                                    @endif
                                </button>
                                @if(session()->has('product_message'))
                                    <span class="form__success form__base-success">
                                        {{ session()->get('product_message') }}
                                    </span>
                                @endif
                            </div>
                        </form>
                        <div class="products__container">
                            @foreach($products as $product)
                                <div class="card products__admin-card">
                                    <div class="card__image">
                                        <img class="card__link" src="{{ Vite::asset($product->image)}}" alt="product">
                                        @if($product->discount)
                                            <p class="card__discount">
                                                -<span>{{ $product->discount }}</span>%
                                            </p>
                                        @endif
                                        <div class="admin__crud-buttons">
                                            <a
                                                class="admin__update"
                                                href="{{ route('editProduct', ['id' => $product->id]) }}">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                     width="24" height="24"
                                                     viewBox="0 0 528.899 528.899">
                                                    <g>
                                                        <path
                                                            d="m328.883 89.125 107.59 107.589-272.34 272.34L56.604 361.465l272.279-272.34zm189.23-25.948-47.981-47.981c-18.543-18.543-48.653-18.543-67.259 0l-45.961 45.961 107.59 107.59 53.611-53.611c14.382-14.383 14.382-37.577 0-51.959zM.3 512.69c-1.958 8.812 5.998 16.708 14.811 14.565l119.891-29.069L27.473 390.597.3 512.69z"
                                                            fill="black"></path>
                                                    </g>
                                                </svg>
                                            </a>
                                            <form
                                                class="admin__delete"
                                                action="{{ route('deleteProduct', $product->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                         width="24"
                                                         height="24" viewBox="0 0 365.717 365">
                                                        <g>
                                                            <g fill="black">
                                                                <path
                                                                    d="M356.34 296.348 69.727 9.734c-12.5-12.5-32.766-12.5-45.247 0L9.375 24.816c-12.5 12.504-12.5 32.77 0 45.25L295.988 356.68c12.504 12.5 32.77 12.5 45.25 0l15.082-15.082c12.524-12.48 12.524-32.75.02-45.25zm0 0"
                                                                    fill="black"></path>
                                                                <path
                                                                    d="M295.988 9.734 9.375 296.348c-12.5 12.5-12.5 32.77 0 45.25l15.082 15.082c12.504 12.5 32.77 12.5 45.25 0L356.34 70.086c12.504-12.5 12.504-32.766 0-45.246L341.258 9.758c-12.5-12.524-32.766-12.524-45.27-.024zm0 0"
                                                                    fill="black"></path>
                                                            </g>
                                                        </g>
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="card__info">
                                        <p class="card__name">{{ $product->name }}</p>
                                        <div class="card__price">
                                            <p class="card__new-price">
                                                $<span>{{ $product->discount_price }}</span>
                                            </p>
                                            <p class="card__old-price">
                                                $<span>{{ $product->price }}</span>
                                            </p>
                                        </div>
                                        <div class="card__rating">
                                            <div class="card__stars">
                                                @for($i = 0; $i < 5; $i++)
                                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                                         xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M14.673 7.17173C15.7437 6.36184 15.1709 4.65517 13.8284 4.65517H11.3992C10.7853 4.65517 10.243 4.25521 10.0617 3.66868L9.33754 1.32637C8.9309 0.0110568 7.0691 0.0110563 6.66246 1.32637L5.93832 3.66868C5.75699 4.25521 5.21469 4.65517 4.60078 4.65517H2.12961C0.791419 4.65517 0.215919 6.35274 1.27822 7.16654L3.39469 8.78792C3.85885 9.1435 4.05314 9.75008 3.88196 10.3092L3.11296 12.8207C2.71416 14.1232 4.22167 15.1704 5.30301 14.342L7.14861 12.9281C7.65097 12.5432 8.34903 12.5432 8.85139 12.9281L10.6807 14.3295C11.7636 15.159 13.2725 14.1079 12.8696 12.8046L12.09 10.2827C11.9159 9.71975 12.113 9.10809 12.5829 8.75263L14.673 7.17173Z"
                                                            fill="#FFAD33"/>
                                                    </svg>
                                                @endfor
                                            </div>
                                            <p class="card__rating-users-count">(0)</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        {{-- Pagination --}}
                        <div class="products__pagination">
                            {!! $products->onEachSide(1)->onEachSide(1)->withQueryString()->links() !!}
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
