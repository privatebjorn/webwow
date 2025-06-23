<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Upload Files</title>
</head>
<body>
    <h1>File Upload Interface</h1>

    <!-- Form to Create a New Collection -->
    <h2>Create New Collection</h2>
    <form action="modules/uploader.php" method="post" enctype="multipart/form-data">
        <!-- Use collection_type "collection" to indicate a new collection creation -->
        <input type="hidden" name="collection_type" value="collection">
        <label for="collection_name">Collection Name:</label>
        <input type="text" id="collection_name" name="collection_name" required>
        <br>
        <label for="type">Collection Type:</label>
        <select id="type" name="type" required>
            <option value="music">Music</option>
            <option value="software">Software</option>
            <option value="image">Image</option>
        </select>
        <br>
        <button type="submit">Create Collection</button>
    </form>

    <hr>

    <!-- Form to Upload Music -->
    <h2>Upload Music</h2>
    <form action="modules/uploader.php" method="post" enctype="multipart/form-data">
        <!-- Specify collection_type as music -->
        <input type="hidden" name="collection_type" value="music">
        <label for="collection_id_music">Collection ID:</label>
        <input type="text" id="collection_id_music" name="collection_id" required>
        <br>
        <label for="title_music">Track Title:</label>
        <input type="text" id="title_music" name="title" required>
        <br>
        <label for="description_music">Description:</label>
        <textarea id="description_music" name="description" required></textarea>
        <br>
        <label for="file_music">Select Music File:</label>
        <input type="file" id="file_music" name="file" required>
        <br>
        <button type="submit">Upload Music</button>
    </form>

    <hr>

    <!-- Form to Upload Software -->
    <h2>Upload Software</h2>
    <form action="modules/uploader.php" method="post" enctype="multipart/form-data">
        <!-- Specify collection_type as software -->
        <input type="hidden" name="collection_type" value="software">
        <label for="collection_id_software">Collection ID:</label>
        <input type="text" id="collection_id_software" name="collection_id" required>
        <br>
        <label for="title_software">Title:</label>
        <input type="text" id="title_software" name="title" required>
        <br>
        <label for="description_software">Description:</label>
        <textarea id="description_software" name="description" required></textarea>
        <br>
        <label for="upload_type">Upload Type:</label>
        <select id="upload_type" name="upload_type" required>
            <option value="download">Download File</option>
            <option value="screenshot">Screenshot</option>
        </select>
        <br>
        <label for="os">Operating System (for download):</label>
        <select id="os" name="os">
            <option value="windows">Windows</option>
            <option value="macos">macOS</option>
            <option value="linux">Linux</option>
        </select>
        <br>
        <label for="file_software">Select Software File:</label>
        <input type="file" id="file_software" name="file" required>
        <br>
        <button type="submit">Upload Software</button>
    </form>

    <hr>

    <!-- Form to Upload Image -->
    <h2>Upload Image</h2>
    <form action="modules/uploader.php" method="post" enctype="multipart/form-data">
        <!-- Specify collection_type as image -->
        <input type="hidden" name="collection_type" value="image">
        <label for="collection_id_image">Collection ID:</label>
        <input type="text" id="collection_id_image" name="collection_id" required>
        <br>
        <label for="title_image">Image Title:</label>
        <input type="text" id="title_image" name="title" required>
        <br>
        <label for="description_image">Description:</label>
        <textarea id="description_image" name="description" required></textarea>
        <br>
        <label for="file_image">Select Image File:</label>
        <input type="file" id="file_image" name="file" required>
        <br>
        <button type="submit">Upload Image</button>
    </form>
</body>
</html>
