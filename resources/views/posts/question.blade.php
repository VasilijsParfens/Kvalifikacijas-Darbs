<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Question Details</title>
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link
        href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&display=swap"
        rel="stylesheet">
    <style>
        body {
            background: var(--gradient-bg);
            font-family: var(--font-primary);
            margin: 0;
            padding: 0;
            color: var(--text-color);
            line-height: 1.6;
        }

        h2,
        h3 {
            color: var(--primary-color);
            font-weight: 700;
            /* Bold for headings */
        }

        h3 {
            margin-bottom: var(--spacing-small);
        }

        .container {
            max-width: 1000px;
            margin: 0 auto;
            padding: var(--spacing-large);
        }

        .question-info {
            background-color: var(--white);
            border-radius: var(--border-radius-large);
            box-shadow: var(--box-shadow-light);
            padding: var(--spacing-large);
            margin-top: var(--spacing-medium);
            transition: transform var(--transition-speed), box-shadow var(--transition-speed);
        }

        .question-info:hover {
            transform: translateY(-5px);
            box-shadow: var(--box-shadow-medium);
        }

        .info-text h2 {
            font-size: var(--font-size-large);
            margin-bottom: var(--spacing-small);
            font-weight: var(--font-weight-bold);
            color: var(--tertiary-color);
        }

        .info-text p {
            font-size: var(--font-size-medium);
            line-height: 1.8;
            margin-bottom: var(--spacing-medium);
            color: var(--dark-text);
            font-weight: 500;
        }

        .answers-section {
            margin-top: var(--spacing-large);
            background-color: var(--white);
            padding: var(--spacing-large);
            border-radius: var(--border-radius-large);
            box-shadow: var(--box-shadow-light);
        }

        .answer-form {
            display: flex;
            flex-direction: column;
            gap: var(--gap-medium);
        }

        .answer-form textarea {
            resize: vertical;
            padding: var(--padding-medium);
            font-size: var(--font-size-medium);
            line-height: 1.5;
            border: 1px solid #ddd;
            border-radius: var(--border-radius);
            background-color: var(--light-gray);
            color: var(--dark-text);
            transition: border-color var(--transition-speed), box-shadow var(--transition-speed);
        }

        .answer-form textarea:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 8px rgba(76, 175, 80, 0.3);
            outline: none;
        }

        .answer-form button {
            padding: var(--padding-small);
            background-color: var(--primary-color);
            color: var(--white);
            border: none;
            border-radius: var(--border-radius);
            cursor: pointer;
            font-size: var(--font-size-medium);
            transition: background-color var(--transition-speed), transform var(--transition-speed);
        }

        .answer-form button:hover {
            background-color: var(--secondary-color);
            transform: translateY(-3px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .answer {
            margin-top: var(--spacing-large);
            padding: var(--spacing-medium);
            background-color: var(--white);
            border-radius: var(--border-radius-large);
            border: 1px solid #ccc;
            transition: transform var(--transition-speed), box-shadow var(--transition-speed);
            display: flex;
            flex-direction: column;
            gap: var(--gap-medium);
            box-shadow: var(--box-shadow-light);
        }

        .answer:hover {
            transform: translateY(-5px);
            box-shadow: var(--box-shadow-medium);
        }

        .answer p {
            margin: 0;
            font-size: var(--font-size-medium);
            line-height: 1.6;
            color: var(--dark-text);
        }

        .answer strong {
            font-weight: var(--font-weight-bold);
            font-size: var(--font-size-medium);
        }

        .answer .date {
            font-size: var(--font-size-xsmall);
            color: var(--dark-text);
        }

        .vote-btn-container {
            display: flex;
            gap: var(--gap-small);
            align-items: center;
        }

        .vote-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: var(--border-radius);
            padding: var(--padding-small);
            font-size: var(--font-size-medium);
            cursor: pointer;
            transition: background-color var(--transition-speed), transform var(--transition-speed), box-shadow var(--transition-speed);
            border: 2px solid transparent;
            color: var(--white);
            font-weight: var(--font-weight-regular);
        }

        .vote-btn-up {
            background-color: var(--primary-color);
        }

        .vote-btn-down {
            background-color: var(--danger-color);
        }

        .vote-btn-up:hover {
            background-color: var(--secondary-color);
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .vote-btn-down:hover {
            background-color: var(--hover-color);
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .vote-btn:active {
            transform: translateY(0);
            box-shadow: none;
        }

        .vote-btn i {
            margin-right: var(--spacing-small);
        }

        .vote-count {
            font-size: var(--font-size-medium);
            color: var(--white);
            margin-left: var(--spacing-small);
            transition: transform 0.2s ease;
        }

        .vote-btn:hover .vote-count {
            transform: scale(1.1);
        }

        .best-answer {
            background-color: #ffeb3b;
            border: 1px solid #fbc02d;
            padding: var(--padding-small);
            border-radius: var(--border-radius);
            font-weight: var(--font-weight-bold);
        }

        .fab {
            position: fixed;
            bottom: var(--spacing-medium);
            right: var(--spacing-medium);
            background-color: var(--primary-color);
            color: var(--white);
            border: none;
            border-radius: 50%;
            width: 60px;
            height: 60px;
            font-size: 1.5rem;
            cursor: pointer;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            transition: background-color var(--transition-speed), transform var(--transition-speed);
        }

        .fab:hover {
            background-color: var(--secondary-color);
            transform: scale(1.1);
        }

        .loading-spinner {
            display: none;
            border: 4px solid #f3f3f3;
            border-top: 4px solid var(--primary-color);
            border-radius: 50%;
            width: 40px;
            height: 40px;
            animation: spin 1s linear infinite;
            margin: var(--spacing-medium) auto;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        @media (max-width: 768px) {
            .fab {
                width: 50px;
                height: 50px;
                font-size: 1.2rem;
            }
        }
    </style>
</head>

<body>
    <x-navbar />
    <div class="container">
        <div class="question-info">
            <div class="info-text">
                <h2>{{ $question->title }}</h2>
                <p>{{ $question->content }}</p>
            </div>
        </div>

        <div class="answers-section">
            <form class="answer-form" action="{{ route('question_answers.store', $question->id) }}" method="POST">
                @csrf
                <textarea name="content" rows="4" placeholder="Write your answer here..." required></textarea>
                <span id="word-count">Word count: 0</span>
                <button type="submit"><i class="fas fa-paper-plane"></i> Submit Answer</button>
            </form>

            <div id="answers-list">
                @forelse ($question->answers as $answer)
                    <div class="answer {{ $answer->is_best ? 'best-answer' : '' }}"
                        data-date="{{ $answer->created_at }}">
                        <p><i class="fas fa-user"></i><strong>{{ $answer->user->name ?? 'Anonymous' }}:</strong>
                            {{ $answer->content }}</p>
                        <p class="date"><i class="fas fa-calendar-alt"></i>
                            {{ \Carbon\Carbon::parse($answer->created_at)->format('M d, Y') }}</p>

                        <div class="vote-btn-container">
                            <form action="{{ route('answer_votes.upvote', $answer->id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                <button type="submit" class="vote-btn vote-btn-up">
                                    <i class="fas fa-thumbs-up"></i>
                                    <span class="vote-count">{{ $answer->upvotesCount() }}</span>
                                </button>
                            </form>

                            <form action="{{ route('answers.downvote', $answer->id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                <button type="submit" class="vote-btn vote-btn-down">
                                    <i class="fas fa-thumbs-down"></i>
                                    <span class="vote-count">{{ $answer->downvotesCount() }}</span>
                                </button>
                            </form>
                        </div>

                        @if ($answer->is_best)
                            <span class="best-answer">Best Answer</span>
                        @endif
                    </div>
                @empty
                    <p>No answers yet. Be the first to answer!</p>
                @endforelse
            </div>
        </div>
    </div>

    <button class="fab" onclick="scrollToTop()"><i class="fas fa-arrow-up"></i></button>

    <div class="loading-spinner" id="loadingSpinner"></div>

    <script>
        document.querySelector('textarea').addEventListener('input', function() {
            let wordCount = this.value.trim().split(/\s+/).filter(Boolean).length;
            document.getElementById('word-count').textContent = 'Word count: ' + wordCount;
        });

        function scrollToTop() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        }

        document.querySelector('form').addEventListener('submit', function() {
            document.getElementById('loadingSpinner').style.display = 'block';
        });
    </script>
</body>

</html>
