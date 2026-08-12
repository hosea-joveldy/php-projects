    <h1>Create a recipe</h1>
    <label for="name">Recipe name: </label>
    <input type="text" name="name">

    <label for="author">Author: </label>
    <input type="text" name="author">

    <label for="step">Recipe step: </label>
    <textarea name="step"></textarea>

    <select name="sayur">

    </select>

    <?php
        echo password_hash("admin123", PASSWORD_DEFAULT);
    ?>