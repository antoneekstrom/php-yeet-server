<div class="create_user">
    <form action="user.php" method="POST">
        <h2>Create User</h2>

        <div class="section">
            <label>Username: </label>
            <input required type="text" name="username" value=<?= '"' . (isset($POST['username']) ? $_POST['username'] : '') . '"' ?>>
        </div>

        <div class="section">
            <label>First Name: </label>
            <input required type="text" name="firstname" value=<?= '"' . (isset($POST['firstname']) ? $_POST['firstname'] : '') . '"' ?>>
        </div>

        <div class="section">
            <label>Last Name: </label>
            <input required type="text" name="lastname" value=<?= '"' . (isset($POST['lastname']) ? $_POST['lastname'] : '') . '"' ?>>
        </div>

        <div class="section">
            <label>Password: </label>
            <input required type="password" name="password" value=<?= '"' . (isset($POST['password']) ? $_POST['password'] : '') . '"' ?>>
        </div>

        <div class="section">
            <label>Confirm Password: </label>
            <input required type="password" name="confirm_password" value=<?= '"' . (isset($POST['confirm_password']) ? $_POST['confirm_password'] : '') . '"' ?>>
        </div>

        <div class="section">
            <label>Birthday: </label>
            <input required type="date" name="birthday" value=<?= '"' . (isset($POST['birthday']) ? $_POST['birthday'] : '') . '"' ?>>
        </div>


        <input type="submit" name="create_user" value="Submit">
    </form>
</div>