<?php require_once("contents.import.php");?>

<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" href="/favicon.ico" type="image/x-icon">
    <title>ZZAMTOON</title>
</head>

<body>
<body id="manager_body">
    <?php require_once("inc/header.php"); ?>
    <main class="manager_wrapper product">
        <div class ="main_wrapper review_write">
        <form name="write_form" class="write_form" method="POST" action="insertepisode.php?content_code=<?php echo $_GET['content_code']?>" enctype="multipart/form-data">
            <div class="write_title">웹툰 업로드</div>
            <section class="form_wrapper2">
                <textarea class="write_text_area" name="name" placeholder="제목을 입력해주세요"  required></textarea>
                <div>
                    <label for="input_file">사진 첨부하기</label> 
                    <input class="upload-name" value="썸네일 선택" disabled="disabled" style="width: 200px;">
                    <input name="thumbnail" type="file" id="input_file" class="upload-hidden" >
                </div>
                <div>
                    <label for="input_file">사진 첨부하기</label> 
                    <input class="upload-name" value="웹툰 선택" disabled="disabled" style="width: 200px;">
                    <input name="toon" type="file" id="input_file" class="upload-hidden" >
                </div>
            </section>
        
            <div class="writeBtn">
                <input class="upload" type="submit" name="action" value="등록">
                <input type="button" value="취소" onclick="history.back(1)">
            </div>
        </form>
		</div>
    </main>
</body>

</html>