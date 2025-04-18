<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plant Tips</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <style>
        /* Body Styling */
        body {
            font-family: var(--font-primary);
            margin: 0;
            padding: 0;
            background: var(--bg-light);
            display: flex;
            flex-direction: column;
            justify-content: center;
            /* Center vertically */
            align-items: center;
            /* Center horizontally */
            min-height: 100vh;
            transition: background-color 0.3s ease;
        }

        /* Main Container */
        .container {
            max-width: 1200px;
            width: 90%;
            padding: var(--spacing-large);
            background: var(--white);
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow-light);
            transition: box-shadow 0.3s ease, transform 0.3s ease;
            margin-top: 20px;
            /* Adjust margin to avoid overlap with navbar */
        }

        /* Header Styling */
        h1 {
            color: var(--primary-color);
            text-align: center;
            margin-bottom: var(--spacing-medium);
            font-weight: 600;
            font-size: var(--font-size-large);
            letter-spacing: 1px;
        }

        /* Filters Section */
        .filters {
            display: flex;
            justify-content: space-between;
            margin-bottom: var(--spacing-medium);
            align-items: center;
        }

        .filters input[type="text"],
        .filters select {
            padding: var(--spacing-small);
            border: 1px solid #ccc;
            border-radius: 30px;
            font-size: var(--font-size-medium);
            background-color: #f9f9f9;
            color: var(--dark-text);
            width: 100%;
            transition: all 0.3s ease;
        }

        .filters input[type="text"]:focus,
        .filters select:focus {
            border-color: var(--secondary-color);
            outline: none;
            background-color: #eef9e5;
        }

        .filters input[type="text"]::placeholder {
            color: var(--dark-text);
            opacity: 0.6;
        }

        .filters select {
            max-width: 200px;
        }

        /* Tips Grid */
        .tips-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: var(--spacing-medium);
            margin-top: var(--spacing-medium);
        }

        /* Tip Card Styling */
        .tip-card {
            background: var(--white);
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow-light);
            padding: var(--spacing-medium);
            text-align: center;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            min-height: 300px;
            position: relative;
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .tip-card:hover {
            transform: translateY(-15px);
            box-shadow: var(--box-shadow-medium);
            background-color: rgba(0, 0, 0, 0.02);
        }

        .tip-card h3 {
            font-size: 1.5rem;
            color: var(--secondary-color);
            margin-bottom: var(--spacing-small);
            font-weight: 600;
            text-transform: uppercase;
        }

        .tip-card p {
            font-size: var(--font-size-medium);
            color: var(--dark-text);
            line-height: 1.6;
            flex-grow: 1;
            padding: 0 var(--spacing-small);
        }

        .tip-card .author {
            font-size: var(--font-size-medium);
            color: var(--secondary-color);
            font-weight: 600;
            margin-top: var(--spacing-small);
        }

        .tip-card .date {
            font-size: var(--font-size-small);
            color: var(--dark-text);
            margin-top: var(--spacing-small);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .tip-card .date i {
            color: var(--secondary-color);
        }

        .tip-card .view-btn {
            padding: var(--spacing-small) var(--spacing-medium);
            background: var(--primary-color);
            color: var(--white);
            border: 2px solid #388e3c;
            border-radius: var(--border-radius);
            cursor: pointer;
            font-size: var(--font-size-medium);
            font-weight: 500;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            text-decoration: none;
        }

        .tip-card .view-btn:hover {
            transform: scale(1.1);
        }

        /* Media Query for Mobile Responsiveness */
        @media (max-width: 768px) {
            .filters {
                flex-direction: column;
                gap: var(--spacing-medium);
            }

            .filters input[type="text"],
            .filters select {
                width: 100%;
            }
        }
    </style>
</head>

<body>

    <!-- Navbar Component -->
    <x-navbar />

    <!-- Main Content -->
    <div class="container">
        <h1>Tips Posts</h1>

        <!-- Filters Section: Search & Sort -->
        <div class="filters">
            <div class="search-bar">
                <input type="text" id="search" placeholder="Search Tips..." oninput="searchTips()">
            </div>
            <div class="sort-options">
                <select id="sort" onchange="sortTips()">
                    <option value="latest">Sort by: Latest</option>
                    <option value="alphabetical">Sort by: Alphabetical</option>
                    <option value="author">Sort by: Author</option>
                    <option value="length">Sort by: Content Length</option>
                </select>
            </div>
        </div>

        <!-- Tips Grid -->
        <div class="tips-grid" id="tipsGrid">
            @forelse ($posts as $tip)
                <div class="tip-card">
                    <h3>{{ $tip->title }}</h3>
                    <p>{{ Str::limit($tip->content, 100) }}</p>
                    <p class="author">Posted by: {{ $tip->user->name }}</p>
                    <p class="date">
                        <i class="fas fa-calendar-alt"></i> {{ $tip->created_at->format('M d, Y') }}
                    </p>
                    <a class="view-btn"><i class="fas fa-eye"></i> View Tip</a>
                </div>
            @empty
                <p class="no-tips">
                    No tips available. Be the first to add one!
                </p>
            @endforelse
        </div>

    </div>

    <script>
        // Function to search tips based on the input value
        function searchTips() {
            const input = document.getElementById('search').value.toLowerCase();
            const tipCards = document.querySelectorAll('.tip-card');

            tipCards.forEach(card => {
                const title = card.querySelector('h3').textContent.toLowerCase();
                const content = card.querySelector('p').textContent.toLowerCase();
                const author = card.querySelector('.author').textContent.toLowerCase();

                if (title.includes(input) || content.includes(input) || author.includes(input)) {
                    card.style.display = '';
                } else {
                    card.style.display = 'none';
                }
            });
        }

        // Function to sort tips based on the selected option
        function sortTips() {
            const sortOption = document.getElementById('sort').value;
            const tipsGrid = document.getElementById('tipsGrid');
            const tipCards = Array.from(tipsGrid.querySelectorAll('.tip-card'));

            tipCards.sort((a, b) => {
                switch (sortOption) {
                    case 'alphabetical':
                        return a.querySelector('h3').textContent.localeCompare(b.querySelector('h3').textContent);
                    case 'author':
                        return a.querySelector('.author').textContent.localeCompare(b.querySelector('.author').textContent);
                    case 'length':
                        return a.querySelector('p').textContent.length - b.querySelector('p').textContent.length;
                    case 'latest':
                    default:
                        return new Date(b.querySelector('.date').textContent.split(' ').slice(1).join(' ')) -
                               new Date(a.querySelector('.date').textContent.split(' ').slice(1).join(' '));
                }
            });

            // Clear the current grid and append sorted cards
            tipsGrid.innerHTML = '';
            tipCards.forEach(card => tipsGrid.appendChild(card));
        }

        // JavaScript for Navbar Toggle
        function toggleMenu() {
            const menu = document.getElementById('navbarMenu');
            menu.classList.toggle('active');
        }

        function toggleTheme() {
            document.body.classList.toggle('dark-mode');
        }
    </script>




</body>

</html>
