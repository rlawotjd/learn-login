<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>회원가입</h1>
    <!-- if로작성 -->
    <?php if (isset($this->errMsg)) {?>
        <div>
            <span><?echo $this->errMsg?></span>
        </div>
        <?}?>
        <!-- 삼항연산자로 작성 -->
        <div>
            <span><?echo (isset($this->errMsg)?$this->errMsg:"")?></span>
        </div>
    <form action="/user/regis" method="post">
        <label for="id">ID</label>
        <input type="text" name="id" id="id">
        <button type="button" onclick="chkDuplicationId()">중복체크</button>
        <span id="errMsgId">
            <?php 
            if (isset($this->arrError["id"])) {
                echo $this->arrError["id"];
            }
            ?>
        </span>
        <br>
        <label for="pw">PW</label>
        <input type="text" name="pw" id="pw">
        <span>
            <?php 
            if (isset($this->arrError["pw"])) {
                echo $this->arrError["pw"];
            }
            ?>
        </span>
        <br>
        <label for="pwChk">PW Check</label>
        <input type="text" name="pwChk" id="pwChk">
        <span>
            <?php 
            if (isset($this->arrError["pwChk"])) {
                echo $this->arrError["pwChk"];
            }
            ?>
        </span>
        <br>
        <label for="name">Name</label>
        <input type="text" name="name" id="name">
        <span>
            <?php 
            if (isset($this->arrError["name"])) {
                echo $this->arrError["name"];
            }
            ?>
        </span>
        <button>regis</button>
    </form>
    <script src="/application/view/js/common.js"></script>
</body>
</html>