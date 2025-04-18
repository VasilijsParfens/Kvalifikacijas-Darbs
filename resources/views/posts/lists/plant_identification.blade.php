<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plant Identification Gallery</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <style>
        body {
            font-family: var(--font-primary);
            margin: 0;
            padding: 0;
            background: var(--bg-light);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            transition: background-color 0.3s ease;
        }

        .container {
            max-width: 1200px;
            width: 90%;
            padding: var(--spacing-large);
            background: var(--white);
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow-light);
            transition: box-shadow 0.3s ease, transform 0.3s ease;
            margin-top: 20px;
        }

        h1 {
            color: var(--primary-color);
            text-align: center;
            margin-bottom: var(--spacing-medium);
            font-weight: 600;
            font-size: var(--font-size-large);
            letter-spacing: 1px;
        }

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

        .identification-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: var(--spacing-medium);
            margin-top: var(--spacing-medium);
        }

        .identification-card {
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

        .identification-card:hover {
            transform: translateY(-15px);
            box-shadow: var(--box-shadow-medium);
            background-color: rgba(0, 0, 0, 0.02);
        }

        .identification-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: var(--border-radius);
            margin-bottom: var(--spacing-small);
        }

        .identification-card h3 {
            font-size: 1.5rem;
            color: var(--secondary-color);
            margin-bottom: var(--spacing-small);
            font-weight: 600;
            text-transform: uppercase;
        }

        .identification-card p {
            font-size: var(--font-size-medium);
            color: var(--dark-text);
            line-height: 1.6;
            flex-grow: 1;
            padding: 0 var(--spacing-small);
        }

        .identification-card .view-btn {
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

        .identification-card .view-btn:hover {
            transform: scale(1.1);
        }

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
    <x-navbar />

    <div class="container">
        <h1>Plant Identification Gallery</h1>

        <div class="filters">
            <div class="search-bar">
                <input type="text" id="search" placeholder="Search Identifications..." oninput="searchIdentifications()">
            </div>
            <div class="sort-options">
                <select id="sort" onchange="sortIdentifications()">
                    <option value="latest">Sort by: Latest</option>
                    <option value="alphabetical">Sort by: Alphabetical</option>
                    <option value="type">Sort by: Type</option>
                </select>
            </div>
        </div>

        <div class="identification-grid" id="identificationGrid">
            @forelse ($posts as $post)
                @if ($post->type === 'plant_identification')
                    <div class="identification-card">
                        <img src="{{ $post->image ? asset('storage/' . $post->image) : asset('images/placeholder.jpg') }}"
                            alt="{{ $post->title }}" loading="lazy">
                        <h3>{{ $post->title }}</h3>
                        <p>{{ $post->content }}</p>
                        <a class="view-btn"><i class="fas fa-eye"></i> View Identification</a>
                    </div>
                @endif
            @empty
                <p class="no-identifications">
                    No plant identification posts available. Be the first to add one!
                </p>
            @endforelse
        </div>
    </div>

    <script>
        let debounceTimeout;

        function searchIdentifications() {
            clearTimeout(debounceTimeout);
            debounceTimeout = setTimeout(() => {
                let searchTerm = document.getElementById('search').value.toLowerCase();
                let grid = document.getElementById('identificationGrid');
                let identifications = Array.from(document.querySelectorAll('.identification-card'));

                identifications.forEach(identification => {
                    const title = identification.querySelector('h3').textContent.toLowerCase();
                    const description = identification.querySelector('p').textContent.toLowerCase();
                    identification.style.display = (title.includes(searchTerm) || description.includes(
                        searchTerm)) ? 'block' : 'none';
                });
            }, 300);
        }

        function sortIdentifications() {
            let sortValue = document.getElementById('sort').value;
            let identifications = Array.from(document.querySelectorAll('.identification-card'));

            if (sortValue === 'alphabetical') {
                identifications.sort((a, b) => a.querySelector('h3').innerText.localeCompare(b.querySelector('h3').innerText));
            } else if (sortValue === 'type') {
                identifications.sort((a, b) => a.querySelector('p').innerText.localeCompare(b.querySelector('p').innerText));
            }

            const grid = document.getElementById('identificationGrid');
            grid.innerHTML = '';
            identifications.forEach(identification => grid.appendChild(identification));
        }
    </script>
</body>

</html>
