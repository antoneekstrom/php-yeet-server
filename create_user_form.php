<div class="create_user">
    <form action="create_user.php" method="POST">
        <h2>Create User</h2>

        <div class="section">
            <label>Username: </label>
            <input type="text" name="username" value="">
        </div>

        <div class="section">
            <label>First Name: </label>
            <input type="text" name="firstname" value="">
        </div>

        <div class="section">
            <label>Last Name: </label>
            <input type="text" name="lastname" value="">
        </div>

        <div class="section">
            <label>Password: </label>
            <input type="password" name="password" value="">
        </div>

        <div class="section">
            <label>Confirm Password: </label>
            <input type="password" name="confirm_password" value="">
        </div>

        <div class="section">
            <label>Birthday: </label>
            <input type="date" name="birthday" value="">
        </div>


        <input type="submit" name="create_user" value="Submit">
    </form>
</div>