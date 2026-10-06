@extends('layouts.app')

@section('title', 'Contact Us')
@section('meta_description', 'Get in touch with Shaya Skin. We\'re here to answer your questions about our products, shipping, and returns.')

@section('content')

    <section class="bg-white py-20 lg:py-28" aria-labelledby="contact-heading">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-2 gap-16">
                
                {{-- ── CONTACT INFO ────────────────────────────────────────── --}}
                <div>
                    <p class="flex items-center gap-2.5 text-rose-500 text-[10px] font-semibold tracking-[0.2em] uppercase mb-4">
                        <span class="block w-5 h-px bg-rose-400"></span> GET IN TOUCH
                    </p>
                    <h1 id="contact-heading" class="font-serif text-5xl font-medium tracking-tight text-stone-800 mb-6">
                        We're here to help.
                    </h1>
                    <p class="text-stone-500 text-lg leading-relaxed mb-12 max-w-md">
                        Have a question about a product, your order, or just want to say hello? Fill out the form or reach out directly. Our team typically responds within 24 hours.
                    </p>

                    <div class="space-y-8">
                        <div>
                            <h3 class="text-sm font-bold uppercase tracking-widest text-stone-400 mb-2">Email Us</h3>
                            <a href="mailto:hello@shayaskin.com" class="text-xl font-medium text-stone-800 hover:text-rose-500 transition-colors duration-150">hello@shayaskin.com</a>
                        </div>
                        
                        <div>
                            <h3 class="text-sm font-bold uppercase tracking-widest text-stone-400 mb-2">Call Us</h3>
                            <p class="text-xl font-medium text-stone-800">1-800-SHAYA-SKIN</p>
                            <p class="text-base text-stone-500 mt-1">Mon-Fri: 9am - 6pm EST</p>
                        </div>

                        <div>
                            <h3 class="text-sm font-bold uppercase tracking-widest text-stone-400 mb-3">Follow Us</h3>
                            <div class="flex gap-4">
                                <a href="#" class="w-10 h-10 rounded-full bg-rose-50 text-rose-500 hover:bg-rose-500 hover:text-white flex items-center justify-center transition-all duration-200">IG</a>
                                <a href="#" class="w-10 h-10 rounded-full bg-rose-50 text-rose-500 hover:bg-rose-500 hover:text-white flex items-center justify-center transition-all duration-200">FB</a>
                                <a href="#" class="w-10 h-10 rounded-full bg-rose-50 text-rose-500 hover:bg-rose-500 hover:text-white flex items-center justify-center transition-all duration-200">TT</a>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- ── CONTACT FORM ────────────────────────────────────────── --}}
                <div class="bg-rose-50 p-8 sm:p-10 rounded-3xl shadow-sm">
                    <form id="page-contact-form" class="space-y-6" novalidate>
                        <div class="grid sm:grid-cols-2 gap-6">
                            <div>
                                <label for="first-name" class="block text-sm font-semibold uppercase tracking-wide text-stone-600 mb-2">First Name</label>
                                <input type="text" id="first-name" class="w-full px-4 py-3 rounded-xl border border-rose-200 bg-white focus:outline-none focus:ring-2 focus:ring-rose-400 transition-shadow">
                            </div>
                            <div>
                                <label for="last-name" class="block text-sm font-semibold uppercase tracking-wide text-stone-600 mb-2">Last Name</label>
                                <input type="text" id="last-name" class="w-full px-4 py-3 rounded-xl border border-rose-200 bg-white focus:outline-none focus:ring-2 focus:ring-rose-400 transition-shadow">
                            </div>
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-semibold uppercase tracking-wide text-stone-600 mb-2">Email Address *</label>
                            <input type="email" id="email" required class="w-full px-4 py-3 rounded-xl border border-rose-200 bg-white focus:outline-none focus:ring-2 focus:ring-rose-400 transition-shadow">
                        </div>

                        <div>
                            <label for="subject" class="block text-sm font-semibold uppercase tracking-wide text-stone-600 mb-2">Subject</label>
                            <select id="subject" class="w-full px-4 py-3 rounded-xl border border-rose-200 bg-white focus:outline-none focus:ring-2 focus:ring-rose-400 transition-shadow text-stone-700">
                                <option>Order Inquiry</option>
                                <option>Product Question</option>
                                <option>Returns / Exchanges</option>
                                <option>Press / Partnerships</option>
                                <option>Other</option>
                            </select>
                        </div>

                        <div>
                            <label for="message" class="block text-sm font-semibold uppercase tracking-wide text-stone-600 mb-2">Message *</label>
                            <textarea id="message" rows="5" required class="w-full px-4 py-3 rounded-xl border border-rose-200 bg-white focus:outline-none focus:ring-2 focus:ring-rose-400 transition-shadow resize-none"></textarea>
                        </div>

                        <button type="submit" id="submit-btn" class="w-full bg-rose-500 hover:bg-rose-600 text-white font-semibold uppercase tracking-widest text-base py-4 rounded-xl transition-all duration-200 shadow-lg shadow-rose-200">
                            Send Message
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </section>

@endsection

@push('scripts')
<script>
    document.getElementById('page-contact-form').addEventListener('submit', function(e) {
        e.preventDefault();
        const btn = document.getElementById('submit-btn');
        btn.textContent = 'Message Sent Successfully!';
        btn.classList.add('bg-green-500', 'shadow-green-200');
        btn.classList.remove('bg-rose-500', 'hover:bg-rose-600', 'shadow-rose-200');
        
        setTimeout(() => {
            btn.textContent = 'Send Message';
            btn.classList.remove('bg-green-500', 'shadow-green-200');
            btn.classList.add('bg-rose-500', 'hover:bg-rose-600', 'shadow-rose-200');
            e.target.reset();
        }, 3000);
    });
</script>
@endpush
