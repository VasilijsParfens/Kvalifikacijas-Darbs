<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Share Your Tip</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: "DM Sans", sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(135deg, #c3e4cd, #75b79e);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .container {
            max-width: 500px;
            width: 90%;
            padding: 30px;
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
            animation: fadeIn 1s ease-in-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        h2 {
            color: #388e3c;
            text-align: center;
            margin-bottom: 20px;
            font-weight: 700;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin: 10px 0 5px;
            font-weight: bold;
            color: #2e7d32;
        }

        input[type="text"],
        textarea,
        input[type="file"] {
            padding: 12px 15px;
            border: 1px solid #ccc;
            border-radius: 10px;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        input:focus,
        textarea:focus {
            outline: none;
            border-color: #66bb6a;
            box-shadow: 0 0 8px rgba(102, 187, 106, 0.5);
        }

        textarea {
            resize: vertical;
        }

        button {
            margin-top: 20px;
            padding: 12px;
            background: linear-gradient(135deg, #66bb6a, #43a047);
            color: white;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            font-size: 1.1rem;
            transition: background 0.3s ease;
        }

        button:hover {
            background: linear-gradient(135deg, #43a047, #2e7d32);
        }

        button:active {
            transform: scale(0.98);
        }
    </style>
</head>
<body>
    <div class="container">
        <h2><i class="fas fa-lightbulb"></i> Share Your Plant Tip</h2>
        <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="type" value="tip">  {{-- Ensures the post is stored as a tip --}}

            <label for="title">Tip Title</label>
            <input type="text" id="title" name="title" placeholder="Give your tip a title..." required>

            <label for="content">Tip Content</label>
            <textarea id="content" name="content" rows="4" placeholder="Share your plant tip..." required></textarea>

            <label for="image">Upload Image</label>
            <input type="file" id="image" name="image" accept="image/*">

            <button type="submit"><i class="fas fa-paper-plane"></i> Share Tip</button>
        </form>
    </div>
</body>
</html>
