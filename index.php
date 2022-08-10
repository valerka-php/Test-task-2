<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <title> page </title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous"/>
    <link rel="stylesheet" href="main.css">
</head>
<body>
<div class="counter">
    <h1 class="header-counter"> COUNTER </h1>
    <div class="content-counter">
        <div class="positive" ><p id="positive"> </p>Positive posts</div>
        <div class="all" ><p id="all"></p>All posts </div>
        <div class="negative"><p id="negative"></p>Negative posts</div>
    </div>
</div>

<div class="posts">
    <h1> POSTS </h1>
    <div class="btn-add-post">
        <button type="button" class="btn-add btn btn-primary btn-addPost" data-bs-toggle="modal" data-bs-target="#addPost">
            add posts
        </button>
    </div>
    <div class="modal fade" id="addPost" tabindex="-1" aria-labelledby="add" aria-hidden="true">
        <div class="modal-dialog">
            <form id="sendPost" method="post" onsubmit="return false">
                <div class="modal-content">
                    <label for="title"> Title* </label>
                    <input name="title" placeholder="title" required>
                    <label for="text"> Text* </label>
                    <textarea class="area" name="text" required autofocus></textarea>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary"> add post </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="addComment" tabindex="-1" aria-labelledby="addComment" aria-hidden="true">
    <div class="modal-dialog">
        <form id="comment" method="post" onsubmit="return false">
            <div class="modal-content">
                <label for="title"> Name </label>
                <input id="id-post" name="id" value="" hidden>
                <input name="name" placeholder="title" value="Anonymous" required>
                <label for="text"> Comment </label>
                <textarea class="area" name="text" required autofocus></textarea>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary"> add comment </button>
                </div>
            </div>
        </form>
    </div>
</div>
<div id="posts">

</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js"
        integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc"
        crossorigin="anonymous"></script>
<script src="main.js"> </script>
</body>
</html>