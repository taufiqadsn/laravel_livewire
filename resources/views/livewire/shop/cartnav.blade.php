<div class="mt-1">
    <li class="nav-item">
        <a href="{{ route('shop.cart') }}" class="nav-link fas fa-cart-shopping position-relative">
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                    {{ $cartTotal }}
                    <span class="visually-hidden">unread messages</span>
                </span>
        </a>
    </li>
</div>
