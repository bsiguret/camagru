var views = document.getElementById('views');
var loadMoreButton = document.getElementById('load-more');

var modal = document.getElementById('modal');
var imgModal = document.getElementById('img-modal');

var last = null;

function loadMore(lastMontage, imagePerPages) {
	if (last != null) {
		lastMontage = last;
	}
	var xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function() {
		if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0) && xhr.responseText != null && xhr.responseText != "") {
			if (xhr.responseText === "KO") {
				return;
			}
			var responseJSON = JSON.parse(xhr.responseText);
			var len = 0;
			while (responseJSON[len]) {
				len++;
			}
			last = responseJSON[len - 1]['image_id'];
			for (var i = 0; responseJSON[i]; i++) {
				var div = document.createElement("div");

				var commentsHTML = "";
				for (var j = 0; responseJSON[i]['text'] != null && responseJSON[i]['text'][j] != null; j++) {
					commentsHTML += "<span class=\"comment\">" + escapeHtml(responseJSON[i]['text'][j]['username']) + ": " + escapeHtml(responseJSON[i]['text'][j]['text']) + "</span>";
				}

				div.innerHTML =
				"<img onclick=\"showModal2(\'" + responseJSON[i]['path'] + "\');\" class=\"icon removable\" src=\"montage/" + responseJSON[i]['path'] + "\"></img>" +
				"<div id=\"buttons-like\">" +
					"<img onclick=\"onLike(this);\" class=\"button-like\" src=\"img/up.png\" data-image=\""+ responseJSON[i]['path'] +"\"></img>" +
					"<span class=\"nb-like\" data-src=\""+ responseJSON[i]['path'] +"\">" + responseJSON[i]['likes'] + "</span>" +
					"<img onclick=\"onDislike(this);\" class=\"button-dislike\" src=\"img/down.png\" data-image=\""+ responseJSON[i]['path'] +"\"></img>" +
					"<span class=\"nb-dislike\" data-src=\""+ responseJSON[i]['path'] +"\">" + responseJSON[i]['dislikes'] + "</span>" +
					commentsHTML +
				"</div>";
				div.className = "img";
				div.setAttribute("data-img", responseJSON[i]['path']);
				views.appendChild(div);
			}
			if (typeof(responseJSON['more']) === 'undefined') {
				loadMoreButton.style.display = "none";
			}
		}
	};
	xhr.open("POST", "./controller/getmontages.php", true);
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.send("id=" + lastMontage + "&nb=" + imagePerPages);
}

function escapeHtml(unsafe) {
	return unsafe
			.replace(/&/g, "&amp;")
			.replace(/</g, "&lt;")
			.replace(/>/g, "&gt;")
			.replace(/"/g, "&quot;")
			.replace(/'/g, "&#039;");
 }

 function showModal2(src) {
	 modal.style.display = "block";
	 imgModal.src = 'montage/' + src;
	 imageSelected = 'montage/' + src;
 }

function onLike(srcElement) {
	var src = srcElement.getAttribute('data-image');
	var xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function() {
		if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0) && xhr.responseText != null && xhr.responseText == "ADD") {
			current_user_add_like(src);
		} else if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0) && xhr.responseText != null && xhr.responseText == "CHANGE") {
			clientDislikes[src] = true;
			current_user_add_like(src);
		}
	};
	xhr.open("POST", "./controller/like.php", true);
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.send("path=" + src + "&liked=1");
}

function onDislike(srcElement) {
	var src = srcElement.getAttribute('data-image');
	var xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function() {
		if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0) && xhr.responseText != null && xhr.responseText == "ADD") {
			current_user_add_dislike(src);
		} else if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0) && xhr.responseText != null && xhr.responseText == "CHANGE") {
			clientLikes[src] = true;
			current_user_add_dislike(src);
		}
	};
	xhr.open("POST", "./controller/like.php", true);
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.send("path=" + src + "&liked=-1");
}
