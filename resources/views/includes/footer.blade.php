{{-- Footer --}}
<footer class="footer" id="footer">
    <div class="container footer__container">
        <div class="footer__columns">
            <div class="footer__column">
                <h3>Exclusive</h3>
                <h3>Subscribe</h3>
                <div class="footer__column-info">
                    <p>Get 10% off your first order</p>
                    <div class="email-input">
                        <label>
                            <input type="email" placeholder="Enter your email">
                        </label>
                        <button aria-label="get discount">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M9.91199 11.9998H3.99999L2.02299 4.1348C2.01033 4.0891 2.00262 4.04216 1.99999 3.9948C1.97799 3.2738 2.77199 2.7738 3.45999 3.1038L22 11.9998L3.45999 20.8958C2.77999 21.2228 1.99599 20.7368 1.99999 20.0288C2.00201 19.9655 2.01313 19.9029 2.03299 19.8428L3.49999 14.9998"
                                    stroke="#FAFAFA" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
            <div class="footer__column">
                <h3>Support</h3>
                <div class="footer__column-info">
                    <p>marketplace@gmail.com</p>
                    <p>+7 (999) 999-99-99</p>
                </div>
            </div>
            <div class="footer__column">
                <h3>Quick Links</h3>
                <div class="footer__column-info">
                    <a href="#">Privacy Policy</a>
                    <a href="#">Terms Of Use</a>
                    <a href="#">FAQ</a>
                    <a href="#">Contact</a>
                </div>
            </div>
            <div class="footer__column">
                <h3>Follow Us</h3>
                <div class="footer__column-info">
                    <div class="footer__social-media">
                        <a href="#">
                            <img
                                width="20"
                                height="20"
                                src="{{ Vite::asset('resources/assets/images/footer/social-media/vk.svg') }}"
                                alt="vk">
                        </a>
                        <a href="#">
                            <img
                                width="20"
                                height="20"
                                src="{{ Vite::asset('resources/assets/images/footer/social-media/youtube.svg') }}"
                                alt="youtube">
                        </a>
                        <a href="#">
                            <img
                                width="20"
                                height="20"
                                src="{{ Vite::asset('resources/assets/images/footer/social-media/telegram.svg') }}"
                                alt="telegram">
                        </a>
                        <a href="#">
                            <img
                                width="20"
                                height="20"
                                src="{{ Vite::asset('resources/assets/images/footer/social-media/classmates.svg') }}"
                                alt="classmates">
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer__copyright">
            <p>Copyright © 2023 Marketplace®. All rights reserved.</p>
        </div>
    </div>
</footer>
