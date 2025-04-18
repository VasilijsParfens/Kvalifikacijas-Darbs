<nav class="navbar">
    <div class="navbar-brand">
        <a href="/" style="text-decoration: none; color: inherit;">
            <i class="fas fa-leaf"></i> UrbanGarden
        </a>
    </div>
    <div class="menu-toggle" id="menuToggle" onclick="toggleMenu()">
        <i class="fas fa-bars"></i>
    </div>
    <div class="navbar-menu" id="navbarMenu">
        <!-- Links for unauthenticated users -->
        @guest
            <a href="/register" class="navbar-link">
                <i class="fas fa-user-plus"></i> Register
            </a>
            <a href="/login" class="navbar-link">
                <i class="fas fa-sign-in-alt"></i> Login
            </a>
        @endguest

        <!-- Links for authenticated users -->
        @auth
            <a href="{{ route('profile.show', auth()->user()->id) }}" class="navbar-link">
                <i class="fas fa-user"></i> Profile
            </a>

            <!-- Link only available to admin users -->
            @if (auth()->user()->is_admin == 1)
                <a href="/admin/plants" class="navbar-link">
                    <i class="fas fa-tools"></i> Admin Panel
                </a>
            @endif
        @endauth

        <!-- Search Bar -->
        <div class="search-container">
            <form action="{{ route('search') }}" method="GET" class="search-form">
                <input type="text" name="query" class="search-input"
                    placeholder="Search for plants, tips, questions..." required>
                <button type="submit" class="search-btn">
                    <i class="fas fa-search"></i>
                </button>
            </form>
        </div>


        <button id="themeToggle" class="navbar-link" onclick="toggleTheme()">
            <i class="fas fa-moon"></i> Dark Mode
        </button>
    </div>
</nav>



<style>
    /* Navbar Styling */
    .navbar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        background: var(--white);
        padding: 12px 24px;
        box-shadow: var(--box-shadow-medium);
        position: sticky;
        top: 0;
        width: 100%;
        z-index: 1000;
        box-sizing: border-box;
    }

    .navbar-brand {
        font-size: 1.8rem;
        font-weight: 700;
        color: var(--primary-color);
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .navbar-menu {
        display: flex;
        gap: 1.5rem;
        align-items: center;
    }

    .navbar-link {
        color: var(--primary-color);
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 1rem;
        font-weight: 500;
        padding: 0.75rem 1rem;
        border-radius: var(--border-radius);
        transition: all var(--transition-speed) ease;
    }

    .navbar-link:hover {
        background-color: rgba(26, 115, 232, 0.1);
        transform: translateY(-2px);
    }

    .menu-toggle {
        display: none;
        font-size: 1.8rem;
        color: var(--primary-color);
        cursor: pointer;
    }

    .search-container {
        background-color: #f0f4f8;
        border-radius: 9999px;
        /* pill shape */
        padding: 0.25rem 0.5rem;
        display: flex;
        align-items: center;
        border: 1px solid var(--primary-color);
        transition: box-shadow 0.2s ease;
    }

    .search-container:focus-within {
        box-shadow: 0 0 0 3px rgba(26, 115, 232, 0.3);
    }

    .search-form {
        display: flex;
        align-items: center;
        width: 100%;
    }

    .search-input {
        border: none;
        outline: none;
        background: transparent;
        padding: 0.5rem 1rem;
        font-size: 1rem;
        flex: 1;
        color: var(--primary-color);
    }

    .search-input::placeholder {
        color: #888;
    }

    .search-btn {
        background-color: var(--primary-color);
        border: none;
        padding: 0.5rem 0.75rem;
        border-radius: 9999px;
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: background-color 0.2s ease;
        cursor: pointer;
    }

    .search-btn:hover {
        background-color: #1a73e8cc;
    }

    .search-btn i {
        font-size: 1rem;
    }


    @media (max-width: 768px) {
        .navbar-menu {
            display: none;
            flex-direction: column;
            position: absolute;
            top: 100%;
            left: 0;
            width: 100%;
            background: var(--white);
            box-shadow: var(--box-shadow-medium);
        }

        .navbar-menu.active {
            display: flex;
        }

        .menu-toggle {
            display: block;
        }
    }
</style>

<script>
    let debounceTimeout;

    function toggleMenu() {
        const navbarMenu = document.getElementById('navbarMenu');
        navbarMenu.classList.toggle('active');
    }

    function toggleTheme() {
        document.body.classList.toggle('dark-theme');
    }
</script>
