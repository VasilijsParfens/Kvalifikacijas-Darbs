<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Search Results - UrbanGarden</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <style>
        body {
            font-family: var(--font-primary);
            margin: 0;
            padding: 0;
            background: var(--gradient-bg);
            color: var(--dark-text);
        }

        .container {
            padding: var(--spacing-large);
            max-width: 1200px;
            margin: auto;
        }

        h1 {
            font-size: var(--font-size-xlarge);
            color: var(--primary-color);
            margin-bottom: var(--spacing-large);
        }

        section {
            margin-bottom: var(--spacing-large);
        }

        section h2 {
            font-size: var(--font-size-large);
            color: var(--primary-color);
            margin-bottom: var(--spacing-medium);
        }

        .grid-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: clamp(12px, 3vw, 24px);
        }

        .card {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            background: var(--bg-light);
            border-radius: var(--border-radius-large);
            box-shadow: var(--box-shadow-light);
            padding: var(--padding-large);
            text-align: center;
            transition: transform var(--transition-speed) ease, box-shadow var(--transition-speed) ease, opacity var(--transition-speed) ease;
            cursor: pointer;
            overflow: hidden;
            height: 100%;
        }

        .card-content {
            flex-grow: 1;
        }

        .card:hover {
            transform: translateY(-3px) scale(1.03);
            box-shadow: var(--box-shadow-medium);
        }

        .card h3 {
            font-size: var(--font-size-medium);
            margin: var(--spacing-small) 0;
            color: var(--primary-color);
        }

        .card img {
            width: 100%;
            height: 150px;
            object-fit: cover;
            border-radius: var(--border-radius);
            transition: transform var(--transition-speed) ease;
        }

        .card:hover img {
            transform: scale(1.05);
        }

        .card p {
            font-size: var(--font-size-small);
            color: var(--secondary-color);
        }

        .no-results {
            color: var(--secondary-color);
            font-style: italic;
        }

        @media (max-width: 768px) {
            .grid-container {
                grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            }
        }

        @media (max-width: 480px) {
            .grid-container {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <x-navbar />
    <div class="container">
        <h1>Search Results for "{{ request('query') }}"</h1>

        <!-- Plants -->
        <section>
            <h2>🌿 Plants</h2>
            @if($plants->count())
                <div class="grid-container">
                    @foreach($plants as $plant)
                        <div class="card">
                            <div class="card-content">
                                <img src="{{ asset('storage/images/plants/' . ($plant->image && file_exists(storage_path('app/public/images/plants/' . $plant->image)) ? $plant->image : 'no_image.jpg')) }}" alt="{{ $plant->name }}">
                                <h3>{{ $plant->name }}</h3>
                                <p><em>{{ $plant->scientific_name }}</em></p>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="no-results">No matching plants found.</p>
            @endif
        </section>

        <!-- Users -->
        <section>
            <h2>👤 Users</h2>
            @if($users->count())
                <div class="grid-container">
                    @foreach($users as $user)
                        <div class="card">
                            <div class="card-content">
                                <h3>{{ $user->name }}</h3>
                                <p>{{ $user->email }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="no-results">No matching users found.</p>
            @endif
        </section>

        <!-- Posts -->
        <section>
            <h2>📝 Posts</h2>
            @if($posts->count())
                <div class="grid-container">
                    @foreach($posts as $post)
                        <div class="card">
                            <div class="card-content">
                                <h3>{{ $post->title }}</h3>
                                <p>{{ Str::limit($post->content, 100) }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="no-results">No matching posts found.</p>
            @endif
        </section>
    </div>
</body>
</html>
