<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h1>Login</h1>
    <h3 style="color: red;"><?php echo isset($this->errMsg)?$this->errMsg:"";?></h3>
    <form action="/user/login" method="post">
        <label for="id">ID</label>
        <input type="text" name="id" id="id">
        <label for="pw">PW</label>
        <input type="password" name="pw" id="pw">
        <button type="submit">login</button>
        <?php
        if (isset($this->loginFlg)) {?>
            <a href="/user/logout">로그아웃</a>
        <?php ;}
        else {?>
            <a href="/user/regis">회원가입</a>
        <?php ;}
        ?>
    </form>
</body>
</html>