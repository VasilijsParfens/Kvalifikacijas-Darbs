<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tip Details</title>
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&display=swap" rel="stylesheet">
    <style>
        :root {
    --primary-color: #2d6a4f;
    --secondary-color: #388e3c;
    --tertiary-color: #1b5e20;
    --text-color: #ffffff;
    --dark-text: #333; /* Deep dark text color */
    --danger-color: #d32f2f;
    --hover-color: #b71c1c;
    --bg-light: rgba(255, 255, 255, 0.95);
    --font-primary: "Inter", sans-serif;
    --border-radius: 8px;
    --border-radius-large: 12px;
    --box-shadow-light: 0 4px 15px rgba(0, 0, 0, 0.1);
    --box-shadow-medium: 0 10px 30px rgba(0, 0, 0, 0.15);
    --box-shadow-hover: 0 0 5px rgba(45, 106, 79, 0.3);
    --transition-speed: 0.3s;
    --gradient-bg: linear-gradient(135deg, #f0f4f8, #d9e2ec);
    --spacing-small: 10px;
    --spacing-medium: 20px;
    --spacing-large: 40px;
    --font-size-large: 2rem;
    --font-size-medium: 1rem;
    --font-size-small: 0.875rem;
    --font-size-xsmall: 0.75rem;
    --font-weight-bold: bold;
    --font-weight-regular: 500;
    --margin-medium: 16px;
    --margin-large: 24px;
    --padding-small: 6px 10px;
    --padding-medium: 10px 16px;
    --padding-large: 12px;
    --gap-medium: 8px;
    --gap-large: 16px;
    --bg-light-transparent: rgba(255, 255, 255, 0.8);
    --white: #fff;
    --light-gray: #f0f0f0;

    /* Dark Theme Variables */
    --dark-primary-color: #4caf50;
    --dark-secondary-color: #81c784;
    --dark-tertiary-color: #388e3c;
    --dark-text-color: #e0e0e0;
    --dark-bg-light: rgba(33, 33, 33, 0.95);
    --dark-gradient-bg: linear-gradient(135deg, #2c3e50, #34495e);
    --dark-box-shadow-light: 0 4px 15px rgba(0, 0, 0, 0.3);
    --dark-box-shadow-medium: 0 10px 30px rgba(0, 0, 0, 0.5);
}
        body {
            font-family: "DM Sans", sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(135deg, #e0f7e9, #a3d9a5);
            color: #333;
        }

        h2, h3 {
            color: #4CAF50;
            font-weight: 600;
        }

        h3 {
            margin-bottom: 15px;
        }

        /* Container Styles */
        .container {
            max-width: 1000px;
            margin: 0 auto;
            padding: 20px;
        }

        /* Tip Info Section */
        .tip-info {
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 30px;
            margin-top: 20px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .tip-info:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }

        .info-text {
            padding: 20px;
        }

        .info-text h2 {
            font-size: 2rem;
            margin-bottom: 10px;
            font-weight: bold;
        }

        .info-text p {
            font-size: 1rem;
            line-height: 1.6;
            margin-bottom: 20px;
            color: #555;
        }

        /* Comment Section Styles */
        .comments-section {
            margin-top: 40px;
            background-color: #f7f7f7;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .comments-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .sort-bar, .search-bar {
            display: flex;
            gap: 10px;
        }

        .sort-bar select, .search-bar input {
            padding: 8px;
            font-size: 1rem;
            border: 1px solid #ddd;
            border-radius: 8px;
        }

        .comment-form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .comment-form textarea {
            resize: vertical;
            padding: 15px;
            font-size: 1rem;
            line-height: 1.5;
            border: 1px solid #ddd;
            border-radius: 8px;
            background-color: #ffffff;
            color: #333;
            transition: border-color 0.3s ease;
        }

        .comment-form textarea:focus {
            border-color: #4CAF50;
            outline: none;
        }

        .comment-form button {
            padding: 12px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 1rem;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .comment-form button:hover {
            background-color: #45a049;
            transform: translateY(-3px);
        }

        /* Comment Styles */
        .comment {
            margin-top: 25px;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            border: 1px solid #ddd;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .comment:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .comment p {
            margin: 0;
            font-size: 1rem;
            line-height: 1.6;
        }

        .comment strong {
            font-weight: bold;
            font-size: 1.1rem;
        }

        .comment i {
            color: #4CAF50;
            margin-right: 10px;
        }

        .comment .date {
            font-size: 0.9rem;
            color: #777;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .tip-info {
                flex-direction: column;
            }

            .info-text {
                max-width: 100%;
            }

            .comment-form textarea {
                font-size: 1.1rem;
            }
        }

    </style>
</head>
<body>

    <!-- Container for the tip details -->
    <div class="container">
        <!-- Tip Info Section -->
        <div class="tip-info">
            <div class="info-text">
                <h2>{{ $tip->title }}</h2>
                <p>{{ $tip->content }}</p>
            </div>
        </div>

        <!-- Comment Section -->
        <div class="comments-section">
            <div class="comments-header">
                <!-- Sorting Bar -->
                <div class="sort-bar">
                    <select id="sort-comments">
                        <option value="newest">Newest First</option>
                        <option value="oldest">Oldest First</option>
                    </select>
                </div>

                <!-- Search Bar -->
                <div class="search-bar">
                    <input type="text" id="search-comment" placeholder="Search Comments">
                </div>
            </div>

            <!-- Comment Form -->
            <form class="comment-form" action="{{ route('tip_comments.store', $tip->id) }}" method="POST">
                @csrf
                <textarea name="content" rows="4" placeholder="Write your comment here..." required></textarea>
                <button type="submit"><i class="fas fa-paper-plane"></i> Submit Comment</button>
            </form>

            <!-- Displaying Comments -->
            <div id="comments-list">
                @forelse ($tip->comments as $comment)
                    <div class="comment" data-date="{{ $comment->created_at }}">
                        <p><i class="fas fa-user"></i><strong>{{ $comment->user->name ?? 'Anonymous' }}:</strong> {{ $comment->content }}</p>
                        <p class="date"><i class="fas fa-calendar-alt"></i> {{ \Carbon\Carbon::parse($comment->created_at)->format('M d, Y') }}</p>
                    </div>
                @empty
                    <p>No comments yet. Be the first to comment!</p>
                @endforelse
            </div>
        </div>
    </div>

    <script>
        document.getElementById('sort-comments').addEventListener('change', function() {
            let sortOrder = this.value;
            let comments = Array.from(document.querySelectorAll('.comment'));
            comments.sort(function(a, b) {
                let aDate = new Date(a.getAttribute('data-date'));
                let bDate = new Date(b.getAttribute('data-date'));
                return sortOrder === 'newest' ? bDate - aDate : aDate - bDate;
            });
            let commentsContainer = document.getElementById('comments-list');
            comments.forEach(function(comment) {
                commentsContainer.appendChild(comment);
            });
        });

        document.getElementById('search-comment').addEventListener('input', function() {
            let searchTerm = this.value.toLowerCase();
            let comments = Array.from(document.querySelectorAll('.comment'));
            comments.forEach(function(comment) {
                let content = comment.querySelector('p').textContent.toLowerCase();
                if (content.includes(searchTerm)) {
                    comment.style.display = '';
                } else {
                    comment.style.display = 'none';
                }
            });
        });
    </script>
</body>
</html>
