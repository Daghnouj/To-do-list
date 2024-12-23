<h1>Register Page</h1>
<form action="" method="POST">
    @csrf
    <input type="text" name="username" placeholder="username"><br>
    <input type="text" name="email" placeholder="email"><br>
    <input type="password" name="password" placeholder="password"><br>
    <button type="submit"> register </button>
</form>