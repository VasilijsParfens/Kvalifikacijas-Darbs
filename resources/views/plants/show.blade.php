<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plant Details</title>
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        /* Improved General Styles */
        body {
            font-family: 'DM Sans', sans-serif;
            margin: 0;
            padding: 0;
            background: var(--bg-gradient);
            color: var(--text-color);
            line-height: 1.6;
        }

        h2,
        h3 {
            color: var(--primary-color);
            margin: 0 0 var(--spacing-small) 0;
            letter-spacing: 0.5px;
        }

        h2 {
            font-size: var(--font-size-large);
        }

        h3 {
            font-size: 1.8rem;
        }

        p {
            margin: 0 0 var(--spacing-small) 0;
            font-size: var(--font-size-medium);
            color: var(--dark-text);
        }

        .button:hover {
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        /* Improved Container Styles */
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: var(--spacing-large);
        }

        /* Improved Plant Info Section */
        .plant-info {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: var(--spacing-large);
            background-color: var(--bg-light);
            border-radius: var(--border-radius-large);
            box-shadow: var(--box-shadow-medium);
            overflow: hidden;
            padding: var(--spacing-large);
        }

        .plant-info img {
            max-width: 100%;
            object-fit: cover;
            height: auto;
            border-radius: var(--border-radius);
            transition: transform 0.3s ease-in-out;
        }

        .plant-info img:hover {
            transform: scale(1.05);
        }

        .plant-image {
            position: relative;
            width: 100%;
            padding-top: 75%;
            /* 4:3 aspect ratio */
        }

        .plant-image img {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: var(--border-radius);
        }

        .info-text {
            padding: var(--spacing-medium);
        }

        .info-text h2 {
            margin-bottom: var(--spacing-medium);
        }

        .info-text p {
            font-size: var(--font-size-medium);
            margin-bottom: var(--spacing-small);
            color: var(--dark-text);
        }

        .info-text i {
            color: var(--secondary-color);
            margin-right: var(--spacing-small);
        }

        /* Improved Comment Section */
        .comments-section {
            margin-top: var(--spacing-large);
            background-color: var(--bg-light);
            padding: var(--spacing-large);
            border-radius: var(--border-radius-large);
            box-shadow: var(--box-shadow-light);
        }

        .comments-section h3 {
            margin-bottom: var(--spacing-medium);
        }

        .comment-form {
            display: flex;
            flex-direction: column;
            gap: var(--spacing-small);
            width: 50%;
            margin: auto;
            margin-top: var(--spacing-medium);
        }

        .comment-form textarea {
            resize: vertical;
            padding: var(--padding-medium);
            font-size: var(--font-size-medium);
            border: 1px solid #ddd;
            border-radius: var(--border-radius);
            font-family: var(--font-primary);
        }

        .comment-form button {
            padding: var(--padding-medium);
            background-color: var(--secondary-color);
            color: var(--text-light);
            border: none;
            border-radius: var(--border-radius);
            cursor: pointer;
            font-size: var(--font-size-medium);
            transition: background-color var(--transition-speed);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .comment-form button:hover {
            background-color: var(--tertiary-color);
        }

        .comment-form textarea:focus {
            border-color: var(--secondary-color);
            outline: none;
            box-shadow: 0 0 0 2px rgba(100, 200, 255, 0.2);
        }

        .comment {
            margin-top: var(--spacing-medium);
            padding: var(--spacing-medium);
            background-color: var(--text-light);
            border: 1px solid #ddd;
            border-left: 4px solid var(--primary-color);
            border-radius: var(--border-radius);
            line-height: 1.6;
            display: flex;
            flex-direction: column;
            gap: var(--spacing-small);
            position: relative;
            padding-bottom: var(--spacing-large);
        }

        .comment p {
            margin: 0;
        }

        .comment strong {
            color: var(--primary-color);
        }

        .comment .comment-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .comment .comment-header .user-info {
            display: flex;
            flex-direction: column;
        }

        .comment .comment-header .user-info strong {
            font-size: var(--font-size-medium);
        }

        .comment .comment-header .user-info span {
            font-size: var(--font-size-small);
            color: var(--dark-text);
        }

        .comment .comment-content {
            background-color: var(--bg-light);
            padding: var(--spacing-small);
            border-radius: var(--border-radius);
            border: 1px solid #ddd;
        }

        .comment .comment-meta {
            display: flex;
            justify-content: space-between;
            font-size: var(--font-size-small);
            color: var(--dark-text);
        }

        .comment .comment-actions {
            position: absolute;
            bottom: var(--spacing-small);
            right: var(--spacing-small);
            display: flex;
            gap: var(--spacing-small);
            font-size: var(--font-size-medium);
        }

        .comment .comment-actions button {
            background: none;
            border: none;
            color: var(--secondary-color);
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 5px;
        }

        .comment .comment-actions button:hover {
            color: var(--primary-color);
        }

        /* Modal Styles */
        #deleteConfirmationModal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            background-color: rgba(0, 0, 0, 0.5);
        }

        #deleteConfirmationModal.show {
            display: flex;
            opacity: 1;
        }

        .modal-content {
            background: white;
            padding: 30px;
            border-radius: 10px;
            width: 400px;
            box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.2);
            text-align: center;
        }

        .modal-header {
            font-size: 1.5em;
            margin-bottom: 20px;
            color: var(--primary-color);
        }

        .modal-body {
            margin-bottom: 20px;
            font-size: 1.1em;
        }

        .modal-footer {
            display: flex;
            justify-content: space-around;
        }

        .modal-button {
            padding: 10px 20px;
            border-radius: 5px;
            border: none;
            cursor: pointer;
            font-size: 1em;
            transition: all 0.3s ease;
        }

        .modal-button.cancel {
            background-color: #ccc;
        }

        .modal-button.cancel:hover {
            background-color: #aaa;
        }

        .modal-button.confirm {
            background-color: #f44336;
            color: white;
        }

        .modal-button.confirm:hover {
            background-color: #d32f2f;
        }

        /* Improved Responsive Design */
        @media (max-width: 768px) {
            .plant-info {
                grid-template-columns: 1fr;
            }

            .info-text {
                padding: 0;
            }

            .comment-form {
                width: 100%;
            }

            .modal-content {
                width: 90%;
                padding: 20px;
            }

            h2 {
                font-size: var(--font-size-large);
            }

            h3 {
                font-size: var(--font-size-medium);
            }
        }
    </style>
</head>

<body>
    <x-navbar />
    <!-- Container for the plant details -->
    <div class="container">
        <!-- Plant Info Section -->
        <div class="plant-info">
            <div class="plant-image">
                <img src="{{ asset('storage/images/plants/' . ($plant->image && file_exists(storage_path('app/public/images/plants/' . $plant->image)) ? $plant->image : 'no_image.jpg')) }}"
                    alt="{{ $plant->name }}" loading="lazy">
            </div>
            <div class="info-text">
                <h2>{{ $plant->name }}</h2>
                <h3>Scientific Name: {{ $plant->scientific_name }}</h3>
                <p><i class="fas fa-tint"></i> Watering Frequency: {{ $plant->watering_frequency }}</p>
                <p><i class="fas fa-sun"></i> Sunlight: {{ $plant->sunlight }}</p>
                <p><i class="fas fa-leaf"></i> Soil Type: {{ $plant->soil_type }}</p>
                <p><i class="fas fa-seedling"></i> Fertilizing: {{ $plant->fertilizing }}</p>
                <p><i class="fas fa-info-circle"></i> Additional Info: {{ $plant->additional_info }}</p>
            </div>
            <!-- Collection Type Section -->
            <form id="collection-form" action="{{ route('user_plant_collection.store', $plant->id) }}" method="POST">
                @csrf
                <div class="collection-options">
                    <label for="have">
                        <input type="radio" name="collection_type" id="have" value="have"
                            {{ $userCollectionType == 'have' ? 'checked' : '' }}> Have
                    </label>
                    <label for="had">
                        <input type="radio" name="collection_type" id="had" value="had"
                            {{ $userCollectionType == 'had' ? 'checked' : '' }}> Had
                    </label>
                    <label for="want">
                        <input type="radio" name="collection_type" id="want" value="want"
                            {{ $userCollectionType == 'want' ? 'checked' : '' }}> Want
                    </label>
                    <button type="submit" class="button">Save to Collection</button>
                    <button type="button" id="remove-collection" class="button"
                        style="display: {{ $userCollectionType ? 'inline-block' : 'none' }};">Remove from
                        Collection</button>
                </div>
            </form>
        </div>

        <!-- Comment Form -->
        <form id="comment-form" class="comment-form" action="{{ route('plant_comments.store', $plant->id) }}"
            method="POST">
            @csrf
            <textarea name="content" id="comment-content" rows="4" placeholder="Write your comment here..." required></textarea>
            <button type="submit">
                <span class="button-text">Submit Comment</span>
                <i class="fas fa-spinner fa-spin" style="display: none;"></i>
            </button>
            <p id="comment-error" class="error-message" style="color: red; display: none;"></p>
            <p id="comment-success" class="success-message" style="color: green; display: none;">Comment submitted
                successfully!</p>
        </form>

        <!-- Comment List -->
        <div id="comment-list">
            @foreach ($plant->comments as $comment)
                <div class="comment" data-comment-id="{{ $comment->id }}">
                    <div class="comment-header">
                        <div class="user-info">
                            <strong>{{ $comment->user->name ?? 'Anonymous' }}</strong>
                            <span>{{ $comment->user->role ?? 'Regular User' }}</span>
                        </div>
                        <span>{{ $comment->created_at->format('F j, Y \a\t h:i A') }}</span>
                    </div>
                    <div class="comment-content">
                        <p>{{ $comment->content }}</p>
                    </div>
                    <div class="comment-meta">
                        <span>Commented on: {{ $comment->created_at->format('F j, Y') }}</span>
                        @if ($comment->user)
                            <span>Joined: {{ $comment->user->created_at->format('F j, Y') }}</span>
                        @endif
                    </div>
                    @if (auth()->check() && auth()->user()->id === $comment->user_id)
                        <div class="comment-actions">
                            <button class="edit-comment" data-comment-id="{{ $comment->id }}">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="delete-comment" data-comment-id="{{ $comment->id }}">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="deleteConfirmationModal">
        <div class="modal-content">
            <div class="modal-header">
                Confirm Delete
            </div>
            <div class="modal-body">
                Are you sure you want to delete this comment?
            </div>
            <div class="modal-footer">
                <button id="cancelDelete" class="modal-button cancel">Cancel</button>
                <button id="confirmDelete" class="modal-button confirm">Confirm</button>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Comment form submission
            const commentForm = document.getElementById('comment-form');
            if (commentForm) {
                commentForm.addEventListener('submit', function(e) {
                    e.preventDefault();

                    const submitButton = commentForm.querySelector('button');
                    const spinner = submitButton.querySelector('.fa-spinner');
                    const errorMsg = document.getElementById('comment-error');
                    const successMsg = document.getElementById('comment-success');

                    // Show loading spinner
                    spinner.style.display = 'inline-block';
                    submitButton.disabled = true;
                    errorMsg.style.display = 'none';

                    fetch(commentForm.action, {
                        method: 'POST',
                        body: new FormData(commentForm),
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                            'Accept': 'application/json'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Clear form and show success message
                            document.getElementById('comment-content').value = '';
                            successMsg.style.display = 'block';
                            setTimeout(() => successMsg.style.display = 'none', 3000);

                            // Add new comment to the list
                            const commentList = document.getElementById('comment-list');
                            const newComment = createCommentElement(data.comment);
                            commentList.prepend(newComment);
                        } else {
                            errorMsg.textContent = data.message || 'Failed to post comment.';
                            errorMsg.style.display = 'block';
                        }
                    })
                    .catch(error => {
                        errorMsg.textContent = 'Error: ' + error.message;
                        errorMsg.style.display = 'block';
                    })
                    .finally(() => {
                        spinner.style.display = 'none';
                        submitButton.disabled = false;
                    });
                });
            }

            // Delete comment functionality
            const deleteModal = document.getElementById('deleteConfirmationModal');
            let commentIdToDelete = null;

            // Event delegation for delete buttons
            document.addEventListener('click', function(e) {
                // Delete button click
                if (e.target.closest('.delete-comment')) {
                    e.preventDefault();
                    commentIdToDelete = e.target.closest('.delete-comment').getAttribute('data-comment-id');
                    deleteModal.classList.add('show');
                }

                // Cancel button in modal
                if (e.target.id === 'cancelDelete') {
                    deleteModal.classList.remove('show');
                    commentIdToDelete = null;
                }

                // Confirm delete button in modal
                if (e.target.id === 'confirmDelete' && commentIdToDelete) {
                    deleteComment(commentIdToDelete);
                    deleteModal.classList.remove('show');
                    commentIdToDelete = null;
                }
            });

            function deleteComment(commentId) {
                fetch(`/comments/${commentId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        document.querySelector(`.comment[data-comment-id="${commentId}"]`).remove();
                    } else {
                        alert('Failed to delete comment: ' + (data.message || 'Unknown error'));
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Error deleting comment');
                });
            }

            function createCommentElement(commentData) {
                const comment = document.createElement('div');
                comment.className = 'comment';
                comment.setAttribute('data-comment-id', commentData.id);

                const user = commentData.user || {};
                const date = new Date(commentData.created_at);
                const formattedDate = date.toLocaleString('en-US', {
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric',
                    hour: 'numeric',
                    minute: 'numeric',
                    hour12: true
                });

                comment.innerHTML = `
                    <div class="comment-header">
                        <div class="user-info">
                            <strong>${user.name || 'Anonymous'}</strong>
                            <span>${user.role || 'Regular User'}</span>
                        </div>
                        <span>${formattedDate}</span>
                    </div>
                    <div class="comment-content">
                        <p>${commentData.content}</p>
                    </div>
                    <div class="comment-meta">
                        <span>Commented on: ${date.toLocaleDateString('en-US', { year: 'numeric', month: 'long', day: 'numeric' })}</span>
                        ${user.created_at ? `<span>Joined: ${new Date(user.created_at).toLocaleDateString('en-US', { year: 'numeric', month: 'long', day: 'numeric' })}</span>` : ''}
                    </div>
                    <div class="comment-actions">
                        <button class="edit-comment" data-comment-id="${commentData.id}">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="delete-comment" data-comment-id="${commentData.id}">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                `;

                return comment;
            }

            // Collection form handling
            const removeCollectionBtn = document.getElementById('remove-collection');
            if (removeCollectionBtn) {
                removeCollectionBtn.addEventListener('click', function() {
                    if (confirm('Are you sure you want to remove this plant from your collection?')) {
                        const form = document.createElement('form');
                        form.action = "{{ route('user_plant_collection.remove', $plant->id) }}";
                        form.method = 'POST';
                        form.innerHTML = '@csrf <input type="hidden" name="_method" value="DELETE">';
                        document.body.appendChild(form);
                        form.submit();
                    }
                });
            }
        });
    </script>
</body>
</html>
