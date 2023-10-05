{{-- Header --}}
<header class="header">
    <div class="container header__container">
        <a href="{{ route('home') }}" class="header__logo">
            Marketplace
        </a>
        <nav class="header__nav">
            <ul>
                <li class="header__nav-link">
                    <a href="{{ route('home') }}">
                        Home
                    </a>
                </li>
                <li class="header__nav-link">
                    <a href="{{ route('catalog') }}">
                        Catalog
                    </a>
                </li>
                <li class="header__nav-link">
                    <a href="{{ route('home') . '#footer' }}">
                        Contacts
                    </a>
                </li>
                @guest
                    <li class="header__nav-link">
                        <a href="{{ route('signup') }}">
                            Sign up
                        </a>
                    </li>
                    <li class="header__nav-link">
                        <a href="{{ route('signin') }}">
                            Sign in
                        </a>
                    </li>
                @endguest
                @auth
                    @switch(auth()->user()['role_id'])
                        @case(2)
                            <li class="header__nav-link">
                                <a href="{{ route('admin') }}">
                                    Admin panel
                                </a>
                            </li>
                            @break
                        @case(3)
                            <li class="header__nav-link">
                                <a href="{{ route('seller') }}">
                                    Seller panel
                                </a>
                            </li>
                            @break
                    @endswitch
                @endauth
            </ul>
        </nav>
        <div class="header__menu">
            <form action="{{ route('catalog') }}" method="GET">
                <label>
                    <input
                        onchange="this.form.submit()"
                        class="search-input"
                        type="text"
                        value="{{ Session::get('search') }}"
                        placeholder="What are you looking for?"
                        name="search">
                </label>
            </form>
            @auth
                <div class="header__buttons">
                    <button class="header__user" aria-label="show profile">
                        <svg width="38" height="38" viewBox="0 0 24 24">
                            <rect width="32" height="32" fill="#C93434"></rect>
                            <g transform="matrix(0.7,0,0,0.7,3.6000000000000014,3.6000000000000014)">
                                <path
                                    d="M12 11.75c2.62 0 4.75-2.13 4.75-4.75S14.62 2.25 12 2.25 7.25 4.38 7.25 7s2.13 4.75 4.75 4.75zm0-8c1.79 0 3.25 1.46 3.25 3.25s-1.46 3.25-3.25 3.25S8.75 8.79 8.75 7 10.21 3.75 12 3.75zM15 13.25H9c-3.17 0-5.75 2.58-5.75 5.75 0 1.52 1.23 2.75 2.75 2.75h12c1.52 0 2.75-1.23 2.75-2.75 0-3.17-2.58-5.75-5.75-5.75zm3 7H6c-.69 0-1.25-.56-1.25-1.25A4.26 4.26 0 0 1 9 14.75h6A4.26 4.26 0 0 1 19.25 19c0 .69-.56 1.25-1.25 1.25z"
                                    fill="white"></path>
                            </g>
                        </svg>
                    </button>
                    <div class="header__dropdown">
                        <button>
                            <svg width="38" height="38" viewBox="0 2 24 24">
                                <g transform="matrix(0.85,0,0,0.85,3.6000000000000014,3.6000000000000014)">
                                    <path
                                        d="M12 11.75c2.62 0 4.75-2.13 4.75-4.75S14.62 2.25 12 2.25 7.25 4.38 7.25 7s2.13 4.75 4.75 4.75zm0-8c1.79 0 3.25 1.46 3.25 3.25s-1.46 3.25-3.25 3.25S8.75 8.79 8.75 7 10.21 3.75 12 3.75zM15 13.25H9c-3.17 0-5.75 2.58-5.75 5.75 0 1.52 1.23 2.75 2.75 2.75h12c1.52 0 2.75-1.23 2.75-2.75 0-3.17-2.58-5.75-5.75-5.75zm3 7H6c-.69 0-1.25-.56-1.25-1.25A4.26 4.26 0 0 1 9 14.75h6A4.26 4.26 0 0 1 19.25 19c0 .69-.56 1.25-1.25 1.25z"
                                        fill="white"></path>
                                </g>
                            </svg>
                            {{ Auth::user()->name }}
                        </button>
                        <a href="{{ route('cart') }}">
                            <div class="header__cart">
                                <svg width="38" height="38" viewBox="0 0 512 512">
                                    <g transform="matrix(0.7,0,0,0.7,76.79947357177736,76.7995502471924)">
                                        <path
                                            d="M405.387 362.612c-35.202 0-63.84 28.639-63.84 63.84s28.639 63.84 63.84 63.84 63.84-28.639 63.84-63.84-28.639-63.84-63.84-63.84zm0 89.376c-14.083 0-25.536-11.453-25.536-25.536s11.453-25.536 25.536-25.536c14.083 0 25.536 11.453 25.536 25.536s-11.453 25.536-25.536 25.536zM507.927 115.875a19.128 19.128 0 0 0-15.079-7.348H118.22l-17.237-72.12a19.16 19.16 0 0 0-18.629-14.702H19.152C8.574 21.704 0 30.278 0 40.856s8.574 19.152 19.152 19.152h48.085l62.244 260.443a19.153 19.153 0 0 0 18.629 14.702h298.135c8.804 0 16.477-6.001 18.59-14.543l46.604-188.329a19.185 19.185 0 0 0-3.512-16.406zM431.261 296.85H163.227l-35.853-150.019h341.003L431.261 296.85zM173.646 362.612c-35.202 0-63.84 28.639-63.84 63.84s28.639 63.84 63.84 63.84 63.84-28.639 63.84-63.84-28.639-63.84-63.84-63.84zm0 89.376c-14.083 0-25.536-11.453-25.536-25.536s11.453-25.536 25.536-25.536 25.536 11.453 25.536 25.536-11.453 25.536-25.536 25.536z"
                                            stroke="white" fill="white"></path>
                                    </g>
                                </svg>
                                <span class="header__cart-count">
                                    {{ Auth::user()->cart->count() }}
                                </span>
                            </div>
                            Shopping Cart
                        </a>
                        <a href="{{ route('logout') }}">
                            <svg width="38" height="38" viewBox="0 0 18 24">
                                <g transform="matrix(0.7,0,0,0.7,3.6000000000000014,3.6000000000000014)">
                                    <path
                                        d="M13.5 21h-4a.5.5 0 0 1 0-1h4c.827 0 1.5-.673 1.5-1.5v-5a.5.5 0 0 1 1 0v5c0 1.378-1.121 2.5-2.5 2.5zM23.5 11h-10a.5.5 0 0 1 0-1h10a.5.5 0 0 1 0 1z"
                                        stroke="white"></path>
                                    <path
                                        d="M8 24c-.22 0-.435-.037-.638-.109l-5.99-1.997A1.998 1.998 0 0 1 0 20V2C0 .897.897 0 2 0c.222 0 .438.037.639.11l5.989 1.996A1.996 1.996 0 0 1 10 4v18c0 1.103-.897 2-2 2zM2 1c-.552 0-1 .449-1 1v18a1 1 0 0 0 .688.946l6 2C8.344 23.179 9 22.654 9 22V4a.996.996 0 0 0-.688-.945l-6-2A.92.92 0 0 0 2 1z"
                                        stroke="white"></path>
                                    <path
                                        d="M15.5 8a.5.5 0 0 1-.5-.5v-5c0-.827-.673-1.5-1.5-1.5H2a.5.5 0 0 1 0-1h11.5C14.879 0 16 1.122 16 2.5v5a.5.5 0 0 1-.5.5zM19.5 15a.5.5 0 0 1-.354-.853l3.646-3.646-3.646-3.646a.5.5 0 0 1 .707-.707l4 4a.5.5 0 0 1 0 .707l-4 4A.501.501 0 0 1 19.5 15z"
                                        stroke="white"></path>
                                </g>
                            </svg>
                            Logout
                        </a>
                    </div>
                </div>
            @endauth
        </div>
    </div>
</header>
