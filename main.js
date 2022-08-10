$(document).ready(async function () {
    $("#sendPost").on("submit", function () {
        let data = $(this).serialize()
        sendAjax('/app/addPost.php', data)
        $('#sendPost')[0].reset();
    })

    $("#comment").on("submit", function () {
        console.log('click')
        let data = $(this).serialize()
        sendAjax('/app/addComment.php', data)
        $('#comment')[0].reset();

    })

    update()
});

function update(){
    getPosts();
    getComments();
    getRate()
}

function sendAjax(url, data) {
    $.ajax({
        url: url,
        method: 'post',
        dataType: 'html',
        data: data,
        async: true,
        success: function () {
            update()
        }
    });
}

function getComments() {
    $.getJSON('/app/getComments.php', function (data) {
        for (let key in data) {
            let comment = '';
            let idPost = "post-" + data[key].id_post;
            comment += `
              <div class="comment">
                <div class="time-comment">
                    <p>  ${data[key].user_name} </p>
                    <p> ${data[key].created_at} </p>
                </div>
                <p> ${data[key].comment} </p>
              </div>     
            `
            document.getElementById(idPost).innerHTML += comment
        }
    });
}

function getPosts() {
    $.getJSON('/app/getPosts.php', function (data) {
        $("#posts").html(postTamplate(data))
    });
}

function postTamplate(data) {
    let content = '';
    for (let key in data) {

        let voteForm = checkVote(data[key].idposts);

        content += `
            <div class="card">
                <h5 class="card-header">
                    <p>${data[key].title}</p>
                    <p>${data[key].created_at}</p>
                </h5>
                <div class="card-body">
                    <p class="card-text">${data[key].text}</p>
                    <div class="footer">
                        <button type="button" id="${data[key].idposts}" onclick='setId(${data[key].idposts})' class="btn btn-primary btn-comment" data-bs-toggle="modal" data-bs-target="#addComment">
                                       add comment
                        </button>
                        <div id="post-star-${data[key].idposts}" class="${voteForm}">
                             <div class="stars rating">
                                <label>☆
                                    <input type="radio" onclick="getStar(5,${data[key].idposts})" />
                                </label>
                                <label>☆
                                    <input type="radio" onclick="getStar(4,${data[key].idposts})" />
                                </label>
                                <label>☆
                                    <input type="radio" onclick="getStar(3,${data[key].idposts})" />
                                </label>
                                <label>☆
                                    <input type="radio" onclick="getStar(2,${data[key].idposts})" />
                                </label>
                                <label>☆
                                    <input type="radio" onclick="getStar(1,${data[key].idposts})" />
                                </label>
                        </div>
                        </div>
                    </div>
                </div>
                <div class="comments" id="post-${data[key].idposts}"></div>
            </div>     
        `
    }
    return content;
}

function getRate(){
    $.ajax({
        type: "POST",
        url: "/app/getRate.php",
        success: function (data) {
            let rate = JSON.parse(data);

            let countAll = 0;
            let countPositive = 0;
            let countNegative = 0;

            rate.forEach(item => {
                countAll++;
                if (item.rate >= 4) {
                    countPositive++;
                } else if (item.rate <= 2) {
                    countNegative++;
                }
            })

            $('#positive').text(countPositive);
            $('#negative').text(countNegative);
            $('#all').text(countAll);
        }
    })
}



function setId(id) {
    document.getElementById('id-post').value = id;
}

function getStar(stars,idPost){
    let form = "post-star-" + idPost;
    document.getElementById(`${form}`).hidden = true
    saveToStorage(stars,idPost);
    saveStartIntoDb(stars,idPost)
    increaseCounter(stars);
}

function increaseCounter(star){
    if (star >= 4){
        document.getElementById('positive').innerText++
    }else if(star <= 2){
        document.getElementById('negative').innerText++
    }
}

function saveStartIntoDb(star,postID){
    let data = {
        starValue: star,
        postId: postID
    }
    $.ajax({
        type: "POST",
        url: "/app/addStar.php",
        dataType: "json",
        data: data,
    })
}

function getLocalStorage(){
    let obj = [];
    if (JSON.parse(localStorage.getItem('vote') !== null)){
        obj = JSON.parse(localStorage.getItem('vote'))
    }
    return obj;
}

function saveToStorage(stars,idPost){
    let voted = {
        browser: getBrowserId(),
        idPost: idPost,
        stars: stars,
    }

    let storage = getLocalStorage();
    storage.push(voted);
    localStorage.setItem('vote', JSON.stringify(storage));

}

function getBrowserId () {
    var
        aKeys = ["MSIE", "Firefox", "Safari", "Chrome", "Opera"],
        sUsrAg = navigator.userAgent, nIdx = aKeys.length - 1;

    for (nIdx; nIdx > -1 && sUsrAg.indexOf(aKeys[nIdx]) === -1; nIdx--);

    return aKeys[nIdx]
}

function checkVote(id){
    let storage = JSON.parse(localStorage.getItem('vote'));
    for (let key in storage){
        if (storage[key].browser === getBrowserId() && id === storage[key].idPost){
            return 'non-active';
        }
    }
}