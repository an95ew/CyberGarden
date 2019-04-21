function getData(id){
	$.getJSON("../news_view_id.php?id="+id, function (finalArray) {
				$('#content_user').replaceWith(
				"<div class='title_u' style='color: red;'><b>"+finalArray['title']+"</b></div>"
				+"<div class='date_u'>"+finalArray['date']+"</div>"
				+"<div class='time_u'>"+finalArray['time']+"</div><br />"
				+"<div class='text_u'>"+finalArray['text']+"</div><br />"
				+"<div class='author_u'>Author: <b>"+finalArray['author']+"</b></div><br />"
			);
	});
}
