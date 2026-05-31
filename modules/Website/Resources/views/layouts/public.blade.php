<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
<head>
    @include('website::partials._head')
    @stack('styles')
</head>
<body class="font-sans antialiased text-gray-900 bg-white">

    @include('website::partials._header')

    <main>
        @yield('content')
    </main>

    @include('website::partials._footer')

    @stack('scripts')

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('opacity-100', 'translate-y-0');
                        entry.target.classList.remove('opacity-0', 'translate-y-8');
                    }
                });
            }, { threshold: 0.1 });

            document.querySelectorAll('.fade-in').forEach(el => observer.observe(el));
        });
    </script>
</body>
</html>
