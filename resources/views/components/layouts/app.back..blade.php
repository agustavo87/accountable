<head>
    <title>Accounts</title>
    @livewireStyles
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div class="container">
        <main>
            <div class="top-bar">
                <div class="logo">
                    <a href="/">Accountable</a> 
                </div>
                <div class="options">
                    @auth
                        <nav>
                            <li> <a href="{{ route('account.index') }}">Accounts</a></li>
                            <li> <a href="{{ route('operation.create') }}">Create Operation</a></li>
                            <li> <a href="{{ route('operation.index') }}">View Operations</a></li>
                        </nav>
                    @endauth
                    <x-user-detail />
                    {{ $topbar ?? '' }}
                </div>
            </div>
            {{ $slot }}
        </main>
    </div>
    @livewireScripts
</body>