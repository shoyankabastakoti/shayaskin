<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="theme-color" content="#F9ECE8">
        <meta name="description" content="Shaya Skin — Premium skincare and makeup crafted for every skin type. Discover your new daily ritual with our thoughtfully curated collection.">
        <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
        <link rel="apple-touch-icon" href="{{ asset('images/logo.png') }}">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,500;0,600;1,400;1,500&family=Jost:wght@300;400;500;600&display=swap" rel="stylesheet">

        <title>Shaya Skin — Feel Good in Your Skin</title>

        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @endif
    </head>
    <body>

        {{-- Announcement Bar --}}
        <div class="announcement" role="banner" aria-label="Promotional announcement">
            <span>🌸 Free Shipping on orders over $50</span>
            <span class="ann-divider">|</span>
            <span>✨ Get 10% off on your first order — Use code: <strong>GLOW10</strong></span>
            <span class="ann-divider">|</span>
            <span>🌿 Clean &amp; Cruelty-Free</span>
        </div>

        {{-- Header / Navigation --}}
        <header class="site-header" id="home" role="banner">
            <a class="wordmark" href="#home" aria-label="Shaya Skin home">
                <img class="brand-logo" src="{{ asset('images/logo.png') }}" alt="Shaya Skin logo">
                <span class="brand-name">shaya <span>skin</span></span>
            </a>

            <button class="nav-toggle" id="nav-toggle" aria-expanded="false" aria-controls="main-nav" aria-label="Toggle navigation">
                <span></span><span></span><span></span>
            </button>

            <nav class="main-nav" id="main-nav" aria-label="Main navigation">
                <a href="#home" class="nav-link active" id="nav-home">Home</a>
                <a href="#makeup" class="nav-link" id="nav-makeup">Makeup</a>
                <a href="#skincare" class="nav-link" id="nav-skincare">Skincare</a>
                <a href="#about" class="nav-link" id="nav-about">About Us</a>
                <a href="#contact" class="nav-link" id="nav-contact">Contact Us</a>
            </nav>

            <a class="header-cta" href="#skincare" id="header-shop-btn">Shop Now <span aria-hidden="true">↗︎</span></a>
        </header>

        <main>

            {{-- ══════════════════════════════ HERO SECTION ══════════════════════════════ --}}
            <section class="hero-section" aria-label="Hero — Shaya Skin">
                <div class="hero-content">
                    <p class="eyebrow"><span class="eyebrow-line"></span> NEW COLLECTION 2025</p>
                    <h1>Glow Naturally.<br><em>Shine Confidently.</em></h1>
                    <p class="hero-desc">Skincare and beauty essentials that bring out your natural radiance. Made for real skin, every day.</p>
                    <div class="hero-actions">
                        <a class="btn btn-primary" href="#skincare" id="hero-shop-btn">Shop Now <span aria-hidden="true">→</span></a>
                        <a class="btn btn-outline" href="#makeup" id="hero-explore-btn">Explore Collection <span aria-hidden="true">→</span></a>
                    </div>
                    <div class="hero-badges">
                        <div class="badge-item">
                            <svg class="badge-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 14.5v-9l6 4.5-6 4.5z"/></svg>
                            <span>Clean<br>Ingredients</span>
                        </div>
                        <div class="badge-item">
                            <svg class="badge-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M12 21.7C5.4 15.5 2 10.6 2 7.5 2 4.4 4.4 2 7.5 2c1.8 0 3.5.9 4.5 2.3C13 2.9 14.7 2 16.5 2 19.6 2 22 4.4 22 7.5c0 3.1-3.4 8-10 14.2z"/></svg>
                            <span>Cruelty<br>Free</span>
                        </div>
                        <div class="badge-item">
                            <svg class="badge-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            <span>Dermatologist<br>Tested</span>
                        </div>
                        <div class="badge-item">
                            <svg class="badge-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2M12 11a4 4 0 100-8 4 4 0 000 8z"/></svg>
                            <span>All Skin<br>Types</span>
                        </div>
                    </div>
                </div>
                <div class="hero-visual">
                    <div class="hero-img-wrap">
                        <img src="{{ asset('images/products/hero_model.jpg') }}" alt="Beautiful woman with glowing skin using Shaya Skin products" class="hero-img" loading="eager">
                        <div class="hero-product-badge">
                            <img src="{{ asset('images/products/shaya_serum.jpg') }}" alt="Daily Glow Serum" class="hero-product-img">
                            <div class="hero-product-info">
                                <strong>Daily Glow Serum</strong>
                                <span>⭐⭐⭐⭐⭐ (128)</span>
                                <span class="product-price">$42.00</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="hero-slide-indicator" aria-hidden="true">
                    <span class="slide-dot active"></span>
                    <span class="slide-dot"></span>
                    <span class="slide-dot"></span>
                </div>
            </section>

            {{-- ══════════════════════════════ TRUST BADGES ══════════════════════════════ --}}
            <section class="trust-bar" aria-label="Why shop with Shaya Skin">
                <div class="trust-grid">
                    <div class="trust-item">
                        <svg class="trust-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"/></svg>
                        <div><strong>Free Shipping</strong><span>On orders over $50</span></div>
                    </div>
                    <div class="trust-divider"></div>
                    <div class="trust-item">
                        <svg class="trust-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                        <div><strong>Easy Returns</strong><span>30-day return policy</span></div>
                    </div>
                    <div class="trust-divider"></div>
                    <div class="trust-item">
                        <svg class="trust-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                        <div><strong>Secure Payment</strong><span>100% secure checkout</span></div>
                    </div>
                    <div class="trust-divider"></div>
                    <div class="trust-item">
                        <svg class="trust-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                        <div><strong>Customer Support</strong><span>We're here to help</span></div>
                    </div>
                </div>
            </section>

            {{-- ══════════════════════════════ SHOP BY CATEGORY ══════════════════════════ --}}
            <section class="categories-section section-pad" aria-labelledby="categories-heading">
                <div class="container">
                    <div class="section-header">
                        <p class="eyebrow"><span class="eyebrow-line"></span> EXPLORE OUR RANGE</p>
                        <h2 id="categories-heading">Shop by Category</h2>
                        <div class="heading-underline"></div>
                    </div>

                    <div class="categories-grid">
                        <a class="category-card" href="#skincare" id="cat-skincare" aria-label="Shop Skincare">
                            <div class="category-img-wrap">
                                <img src="{{ asset('images/products/skincare_products.jpg') }}" alt="Shaya Skin skincare collection" class="category-img">
                                <div class="category-overlay">
                                    <span>Shop Now →</span>
                                </div>
                            </div>
                            <div class="category-label">
                                <h3>Skincare</h3>
                                <p>Serums, moisturisers, toners &amp; more</p>
                            </div>
                        </a>

                        <a class="category-card" href="#makeup" id="cat-makeup" aria-label="Shop Makeup">
                            <div class="category-img-wrap">
                                <img src="{{ asset('images/products/makeup_products.jpg') }}" alt="Shaya Skin makeup collection" class="category-img">
                                <div class="category-overlay">
                                    <span>Shop Now →</span>
                                </div>
                            </div>
                            <div class="category-label">
                                <h3>Makeup</h3>
                                <p>Foundation, lipstick, eyeshadow &amp; more</p>
                            </div>
                        </a>
                    </div>
                </div>
            </section>

            {{-- ══════════════════════════════ SKINCARE SECTION ══════════════════════════ --}}
            <section class="products-section section-pad alt-bg" id="skincare" aria-labelledby="skincare-heading">
                <div class="container">
                    <div class="section-header">
                        <p class="eyebrow"><span class="eyebrow-line"></span> SKINCARE COLLECTION</p>
                        <h2 id="skincare-heading">Best Sellers</h2>
                        <div class="heading-underline"></div>
                        <p class="section-subtitle">Our most-loved formulas for healthy, radiant skin</p>
                    </div>

                    <div class="products-grid">
                        <article class="product-card" id="product-serum">
                            <div class="product-img-wrap">
                                <img src="{{ asset('images/products/shaya_serum.jpg') }}" alt="Daily Glow Serum" class="product-img" loading="lazy">
                                <span class="product-tag new">NEW</span>
                                <button class="quick-add" id="add-serum" aria-label="Add Daily Glow Serum to cart">+ Add to Cart</button>
                            </div>
                            <div class="product-info">
                                <div class="product-rating" aria-label="4.9 out of 5 stars">
                                    ★★★★★ <span>(128)</span>
                                </div>
                                <h3 class="product-name">Daily Glow Serum</h3>
                                <p class="product-desc">Vitamin C + Hyaluronic Acid brightening formula</p>
                                <div class="product-price-row">
                                    <span class="product-price">$42.00</span>
                                    <a href="#contact" class="product-link" aria-label="Shop Daily Glow Serum">Shop →</a>
                                </div>
                            </div>
                        </article>

                        <article class="product-card" id="product-cream">
                            <div class="product-img-wrap">
                                <img src="{{ asset('images/products/hydra_cream.jpg') }}" alt="Hydra Moisture Cream" class="product-img" loading="lazy">
                                <span class="product-tag bestseller">BEST SELLER</span>
                                <button class="quick-add" id="add-cream" aria-label="Add Hydra Moisture Cream to cart">+ Add to Cart</button>
                            </div>
                            <div class="product-info">
                                <div class="product-rating" aria-label="4.8 out of 5 stars">
                                    ★★★★★ <span>(96)</span>
                                </div>
                                <h3 class="product-name">Hydra Moisture Cream</h3>
                                <p class="product-desc">Deep hydration with Ceramide &amp; Peptide complex</p>
                                <div class="product-price-row">
                                    <span class="product-price">$36.00</span>
                                    <a href="#contact" class="product-link" aria-label="Shop Hydra Moisture Cream">Shop →</a>
                                </div>
                            </div>
                        </article>

                        <article class="product-card" id="product-skincare-set">
                            <div class="product-img-wrap">
                                <img src="{{ asset('images/products/skincare_products.jpg') }}" alt="Complete Skincare Set" class="product-img" loading="lazy">
                                <span class="product-tag new">NEW</span>
                                <button class="quick-add" id="add-skincare-set" aria-label="Add Complete Skincare Set to cart">+ Add to Cart</button>
                            </div>
                            <div class="product-info">
                                <div class="product-rating" aria-label="4.7 out of 5 stars">
                                    ★★★★★ <span>(74)</span>
                                </div>
                                <h3 class="product-name">Glow Ritual Set</h3>
                                <p class="product-desc">Complete 5-step skincare routine in one set</p>
                                <div class="product-price-row">
                                    <span class="product-price">$89.00</span>
                                    <a href="#contact" class="product-link" aria-label="Shop Glow Ritual Set">Shop →</a>
                                </div>
                            </div>
                        </article>
                    </div>

                    <div class="view-all-wrap">
                        <a class="btn btn-outline" href="#contact" id="view-all-skincare">View All Skincare →</a>
                    </div>
                </div>
            </section>

            {{-- ══════════════════════════════ MAKEUP SECTION ════════════════════════════ --}}
            <section class="products-section section-pad" id="makeup" aria-labelledby="makeup-heading">
                <div class="container">
                    <div class="section-header">
                        <p class="eyebrow"><span class="eyebrow-line"></span> MAKEUP COLLECTION</p>
                        <h2 id="makeup-heading">Feel-Good Colour</h2>
                        <div class="heading-underline"></div>
                        <p class="section-subtitle">Makeup that celebrates your unique beauty</p>
                    </div>

                    <div class="products-grid">
                        <article class="product-card" id="product-foundation">
                            <div class="product-img-wrap">
                                <img src="{{ asset('images/products/luminous_foundation.jpg') }}" alt="Luminous Foundation" class="product-img" loading="lazy">
                                <span class="product-tag bestseller">BEST SELLER</span>
                                <button class="quick-add" id="add-foundation" aria-label="Add Luminous Foundation to cart">+ Add to Cart</button>
                            </div>
                            <div class="product-info">
                                <div class="product-rating" aria-label="4.8 out of 5 stars">
                                    ★★★★★ <span>(74)</span>
                                </div>
                                <h3 class="product-name">Luminous Foundation</h3>
                                <p class="product-desc">SPF 20 — Hydrating radiant finish, all-day wear</p>
                                <div class="product-price-row">
                                    <span class="product-price">$34.00</span>
                                    <a href="#contact" class="product-link" aria-label="Shop Luminous Foundation">Shop →</a>
                                </div>
                            </div>
                        </article>

                        <article class="product-card" id="product-makeup-set">
                            <div class="product-img-wrap">
                                <img src="{{ asset('images/products/makeup_products.jpg') }}" alt="Glow Makeup Collection" class="product-img" loading="lazy">
                                <span class="product-tag new">NEW</span>
                                <button class="quick-add" id="add-makeup-set" aria-label="Add Glow Makeup Collection to cart">+ Add to Cart</button>
                            </div>
                            <div class="product-info">
                                <div class="product-rating" aria-label="4.9 out of 5 stars">
                                    ★★★★★ <span>(58)</span>
                                </div>
                                <h3 class="product-name">Glow Makeup Collection</h3>
                                <p class="product-desc">Eyeshadow, blush, lipstick &amp; mascara bundle</p>
                                <div class="product-price-row">
                                    <span class="product-price">$68.00</span>
                                    <a href="#contact" class="product-link" aria-label="Shop Glow Makeup Collection">Shop →</a>
                                </div>
                            </div>
                        </article>

                        <article class="product-card" id="product-lip">
                            <div class="product-img-wrap">
                                <img src="{{ asset('images/products/luminous_foundation.jpg') }}" alt="Soft Velvet Lipstick" class="product-img" loading="lazy">
                                <span class="product-tag"></span>
                                <button class="quick-add" id="add-lip" aria-label="Add Soft Velvet Lipstick to cart">+ Add to Cart</button>
                            </div>
                            <div class="product-info">
                                <div class="product-rating" aria-label="4.6 out of 5 stars">
                                    ★★★★☆ <span>(110)</span>
                                </div>
                                <h3 class="product-name">Soft Velvet Lipstick</h3>
                                <p class="product-desc">12-hour wear, ultra-pigmented, 16 shades</p>
                                <div class="product-price-row">
                                    <span class="product-price">$28.00</span>
                                    <a href="#contact" class="product-link" aria-label="Shop Soft Velvet Lipstick">Shop →</a>
                                </div>
                            </div>
                        </article>
                    </div>

                    <div class="view-all-wrap">
                        <a class="btn btn-outline" href="#contact" id="view-all-makeup">View All Makeup →</a>
                    </div>
                </div>
            </section>

            {{-- ══════════════════════════════ ABOUT US SECTION ══════════════════════════ --}}
            <section class="about-section section-pad" id="about" aria-labelledby="about-heading">
                <div class="container about-grid">
                    <div class="about-visual">
                        <div class="about-img-wrap">
                            <img src="{{ asset('images/products/hero_model.jpg') }}" alt="Shaya Skin — the story of natural beauty" class="about-img" loading="lazy">
                            <div class="about-stat-card">
                                <strong>5,000+</strong>
                                <span>Happy customers</span>
                            </div>
                        </div>
                    </div>
                    <div class="about-content">
                        <p class="eyebrow"><span class="eyebrow-line"></span> OUR STORY</p>
                        <h2 id="about-heading">Good skin isn't a look.<br><em>It's feeling like yourself.</em></h2>
                        <p class="about-text">At Shaya Skin, we believe beauty should feel natural — never forced. Founded with a love for clean, effective formulas, every product is crafted to help you feel at home in your own skin.</p>
                        <p class="about-text">No impossible standards. No unnecessary chemicals. Just thoughtful essentials made for real people, with real skin.</p>
                        <div class="about-values">
                            <div class="value-item">
                                <span class="value-icon">🌿</span>
                                <div><strong>Clean Beauty</strong><p>Free from harsh chemicals &amp; parabens</p></div>
                            </div>
                            <div class="value-item">
                                <span class="value-icon">🐰</span>
                                <div><strong>Cruelty-Free</strong><p>Never tested on animals, always ethical</p></div>
                            </div>
                            <div class="value-item">
                                <span class="value-icon">🧪</span>
                                <div><strong>Dermatologist Tested</strong><p>Clinically proven, skin-safe formulas</p></div>
                            </div>
                        </div>
                        <a class="btn btn-primary" href="#contact" id="about-contact-btn">Get in Touch →</a>
                    </div>
                </div>
            </section>

            {{-- ══════════════════════════════ TESTIMONIALS ══════════════════════════════ --}}
            <section class="testimonials-section section-pad alt-bg" aria-labelledby="reviews-heading">
                <div class="container">
                    <div class="section-header">
                        <p class="eyebrow"><span class="eyebrow-line"></span> CUSTOMER LOVE</p>
                        <h2 id="reviews-heading">What Our Customers Say</h2>
                        <div class="heading-underline"></div>
                    </div>
                    <div class="testimonials-grid">
                        <blockquote class="testimonial-card" id="review-1">
                            <div class="stars" aria-label="5 out of 5 stars">★★★★★</div>
                            <p>"The Daily Glow Serum completely transformed my skin. I've never felt so confident going makeup-free!"</p>
                            <footer>— <cite>Priya S., Mumbai</cite></footer>
                        </blockquote>
                        <blockquote class="testimonial-card" id="review-2">
                            <div class="stars" aria-label="5 out of 5 stars">★★★★★</div>
                            <p>"I love that everything is cruelty-free. The Hydra Cream keeps my skin hydrated all day — absolute game changer."</p>
                            <footer>— <cite>Aisha M., Dubai</cite></footer>
                        </blockquote>
                        <blockquote class="testimonial-card" id="review-3">
                            <div class="stars" aria-label="5 out of 5 stars">★★★★★</div>
                            <p>"Shaya Skin's foundation is the only one I've found that actually matches and lasts all day. Obsessed!"</p>
                            <footer>— <cite>Sarah L., London</cite></footer>
                        </blockquote>
                    </div>
                </div>
            </section>

        </main>

        {{-- ══════════════════════════════ CONTACT / FOOTER ════════════════════════════ --}}
        <footer class="site-footer" id="contact" role="contentinfo">
            <div class="footer-top">
                <div class="container footer-grid">

                    {{-- Brand Column --}}
                    <div class="footer-brand">
                        <a class="wordmark footer-wordmark" href="#home" aria-label="Shaya Skin home">
                            <img class="brand-logo" src="{{ asset('images/logo.png') }}" alt="">
                            <span class="brand-name">shaya <span>skin</span></span>
                        </a>
                        <p class="footer-tagline">Feel good in your skin. Every single day.</p>
                        <div class="social-links" aria-label="Follow us on social media">
                            <a href="#" class="social-link" id="social-instagram" aria-label="Follow us on Instagram">
                                <svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                            </a>
                            <a href="#" class="social-link" id="social-facebook" aria-label="Follow us on Facebook">
                                <svg viewBox="0 0 24 24" fill="currentColor"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                            </a>
                            <a href="#" class="social-link" id="social-tiktok" aria-label="Follow us on TikTok">
                                <svg viewBox="0 0 24 24" fill="currentColor"><path d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72.02 1.48-.04 2.96-.04 4.44-.99-.32-2.15-.23-3.02.37-.63.41-1.11 1.04-1.36 1.75-.21.51-.15 1.07-.14 1.61.24 1.64 1.82 3.02 3.5 2.87 1.12-.01 2.19-.66 2.77-1.61.19-.33.4-.67.41-1.06.1-1.79.06-3.57.07-5.36.01-4.03-.01-8.05.02-12.07z"/></svg>
                            </a>
                        </div>
                    </div>

                    {{-- Quick Links --}}
                    <div class="footer-links">
                        <h4>Quick Links</h4>
                        <ul>
                            <li><a href="#home" id="footer-home">Home</a></li>
                            <li><a href="#skincare" id="footer-skincare">Skincare</a></li>
                            <li><a href="#makeup" id="footer-makeup">Makeup</a></li>
                            <li><a href="#about" id="footer-about">About Us</a></li>
                            <li><a href="#contact" id="footer-contact">Contact Us</a></li>
                        </ul>
                    </div>

                    {{-- Help --}}
                    <div class="footer-links">
                        <h4>Help</h4>
                        <ul>
                            <li><a href="#contact" id="footer-shipping">Shipping Info</a></li>
                            <li><a href="#contact" id="footer-returns">Returns</a></li>
                            <li><a href="#contact" id="footer-faq">FAQ</a></li>
                            <li><a href="#contact" id="footer-track">Track Order</a></li>
                        </ul>
                    </div>

                    {{-- Contact Form --}}
                    <div class="footer-contact-col">
                        <h4>Get in Touch</h4>
                        <form class="contact-form" id="contact-form" novalidate>
                            <div class="form-group">
                                <label for="contact-name" class="sr-only">Your Name</label>
                                <input type="text" id="contact-name" name="name" placeholder="Your Name" required autocomplete="name">
                            </div>
                            <div class="form-group">
                                <label for="contact-email" class="sr-only">Email Address</label>
                                <input type="email" id="contact-email" name="email" placeholder="Email Address" required autocomplete="email">
                            </div>
                            <div class="form-group">
                                <label for="contact-message" class="sr-only">Message</label>
                                <textarea id="contact-message" name="message" placeholder="How can we help you?" rows="3" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary" id="contact-submit">Send Message →</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="footer-bottom">
                <div class="container footer-bottom-inner">
                    <small>© {{ date('Y') }} Shaya Skin. Made with love &amp; care.</small>
                    <div class="footer-legal">
                        <a href="#" id="footer-privacy">Privacy Policy</a>
                        <a href="#" id="footer-terms">Terms of Service</a>
                    </div>
                </div>
            </div>
        </footer>

        <script>
            // Mobile nav toggle
            const navToggle = document.getElementById('nav-toggle');
            const mainNav = document.getElementById('main-nav');
            navToggle.addEventListener('click', () => {
                const isOpen = mainNav.classList.toggle('is-open');
                navToggle.setAttribute('aria-expanded', isOpen);
                navToggle.classList.toggle('is-open', isOpen);
            });

            // Active nav highlight on scroll
            const sections = ['home', 'makeup', 'skincare', 'about', 'contact'];
            const navLinks = {
                home: document.getElementById('nav-home'),
                makeup: document.getElementById('nav-makeup'),
                skincare: document.getElementById('nav-skincare'),
                about: document.getElementById('nav-about'),
                contact: document.getElementById('nav-contact'),
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        sections.forEach(id => navLinks[id] && navLinks[id].classList.remove('active'));
                        const id = entry.target.id;
                        if (navLinks[id]) { navLinks[id].classList.add('active'); }
                    }
                });
            }, { threshold: 0.35 });

            sections.forEach(id => {
                const el = document.getElementById(id) || document.querySelector(`[id="${id}"]`);
                if (el) { observer.observe(el); }
            });

            // Sticky header shadow
            const header = document.querySelector('.site-header');
            window.addEventListener('scroll', () => {
                header.classList.toggle('scrolled', window.scrollY > 10);
            });

            // Contact form (demo)
            document.getElementById('contact-form').addEventListener('submit', (e) => {
                e.preventDefault();
                const btn = document.getElementById('contact-submit');
                btn.textContent = '✓ Message Sent!';
                btn.style.background = '#4CAF50';
                setTimeout(() => {
                    btn.textContent = 'Send Message →';
                    btn.style.background = '';
                    e.target.reset();
                }, 3000);
            });

            // Quick add buttons
            document.querySelectorAll('.quick-add').forEach(btn => {
                btn.addEventListener('click', () => {
                    const orig = btn.textContent;
                    btn.textContent = '✓ Added!';
                    btn.classList.add('added');
                    setTimeout(() => { btn.textContent = orig; btn.classList.remove('added'); }, 2000);
                });
            });
        </script>
    </body>
</html>
